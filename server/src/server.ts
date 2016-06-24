/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import {
    IPCMessageReader, IPCMessageWriter,
    createConnection, IConnection, TextDocumentSyncKind,
    TextDocuments, ITextDocument, Diagnostic, DiagnosticSeverity,
    InitializeParams, InitializeResult, TextDocumentIdentifier, TextDocumentPosition,
    CompletionItem, CompletionItemKind, RequestType, Position,
    SignatureHelp, SignatureInformation, ParameterInformation
} from 'vscode-languageserver';

import { TreeBuilder, FileNode, FileSymbolCache, SymbolType, AccessModifierNode, ClassNode } from "./hvy/treeBuilder";
import { Debug } from './util/Debug';
import { SuggestionBuilder } from './suggestionBuilder';

const fs = require("fs");
const util = require('util');
const zlib = require('zlib');

// Glob for file searching
const glob = require("glob");
// FileQueue for queuing files so we don't open too many
const FileQueue = require('filequeue');
const fq = new FileQueue(200);

let connection: IConnection = createConnection(new IPCMessageReader(process), new IPCMessageWriter(process));

let documents: TextDocuments = new TextDocuments();
documents.listen(connection);
Debug.SetConnection(connection);

let treeBuilder: TreeBuilder = new TreeBuilder();
treeBuilder.SetConnection(connection);
let workspaceTree: FileNode[] = [];

let workspaceRoot: string;
var craneProjectDir: string;
let enableCache: boolean = true;
connection.onInitialize((params): InitializeResult =>
{
    workspaceRoot = params.rootPath;

    return {
        capabilities:
        {
            textDocumentSync: documents.syncKind,
            completionProvider:
            {
                resolveProvider: true,
                triggerCharacters: ['.', ':', '$', '>']
            }
        }
    }
});

// The settings interface describe the server relevant settings part
interface Settings {
    languageServerExample: ExampleSettings;
}

// These are the example settings we defined in the client's package.json
// file
interface ExampleSettings {
    maxNumberOfProblems: number;
}

// hold the maxNumberOfProblems setting
let maxNumberOfProblems: number;
// The settings have changed. Is send on server activation
// as well.
connection.onDidChangeConfiguration((change) =>
{
    let settings = <Settings>change.settings;
    maxNumberOfProblems = settings.languageServerExample.maxNumberOfProblems || 100;
    // Revalidate any open text documents
    //documents.all().forEach(validateTextDocument);
});

// Use this to send a request to the client
// https://github.com/Microsoft/vscode/blob/80bd73b5132268f68f624a86a7c3e56d2bbac662/extensions/json/client/src/jsonMain.ts
// https://github.com/Microsoft/vscode/blob/580d19ab2e1fd6488c3e515e27fe03dceaefb819/extensions/json/server/src/server.ts
//connection.sendRequest()

connection.onDidChangeWatchedFiles((change) =>
{
    // Monitored files have change in VSCode
    connection.console.log('We recevied an file change event');
});

// This handler provides the initial list of the completion items.
connection.onCompletion((textDocumentPosition: TextDocumentPosition): CompletionItem[] =>
{
    if (textDocumentPosition.languageId != "php") return;

    var doc = documents.get(textDocumentPosition.uri);
    var suggestionBuilder = new SuggestionBuilder();

    suggestionBuilder.prepare(textDocumentPosition, doc, workspaceTree);

    var toReturn: CompletionItem[] = suggestionBuilder.build();

    return toReturn;
});

// This handler resolve additional information for the item selected in
// the completion list.
connection.onCompletionResolve((item: CompletionItem): CompletionItem =>
{
    // TODO -- Add phpDoc info
    // if (item.data === 1) {
    //     item.detail = 'TypeScript details',
    //     item.documentation = 'TypeScript documentation'
    // } else if (item.data === 2) {
    //     item.detail = 'JavaScript details',
    //     item.documentation = 'JavaScript documentation'
    // }
    return item;
});

var buildObjectTreeForDocument: RequestType<{path:string,text:string}, any, any> = { method: "buildObjectTreeForDocument" };
connection.onRequest(buildObjectTreeForDocument, (requestObj) =>
{
    var fileUri = requestObj.path;
    var text = requestObj.text;

    treeBuilder.Parse(text, fileUri).then(result => {
        addToWorkspaceTree(result.tree);
        // notifyClientOfWorkComplete();
        return true;
    })
    .catch(error => {
        console.log(error);
        notifyClientOfWorkComplete();
        return false;
    });
});

var deleteFile: RequestType<{path:string}, any, any> = { method: "findNode" };
connection.onRequest(deleteFile, (requestObj) =>
{
    var node = getFileNodeFromPath(requestObj.path);

    // connection.console.log(node);

});

/**
 * Finds all the symbols in a particular file
 */
var findFileDocumentSymbols: RequestType<{path:string}, any, any> = { method: "findFileDocumentSymbols" };
connection.onRequest(findFileDocumentSymbols, (requestObj) =>
{
    var node = getFileNodeFromPath(requestObj.path);
    connection.sendNotification({ method: 'documentSymbols' }, { symbols: node.symbolCache });
});

/**
 * Finds the Usings in a file
 */
var findFileUsings: RequestType<{path:string}, any, any> = { method: "findFileUsings" };
connection.onRequest(findFileUsings, (requestObj) =>
{
    var node = getFileNodeFromPath(requestObj.path);
    connection.sendNotification({ method: 'foundFileUsings' }, { usings: node.namespaceUsings });
});

/**
 * Finds the location to a symbol definition
 */
var findDefinition: RequestType<{word:string,namespaces:string[],kind:SymbolType}, any, any> = { method: "findDefinition" };
connection.onRequest(findDefinition, (requestObj) =>
{
    var word: string = requestObj.word;
    var kind: SymbolType = requestObj.kind;
    var namespaces: string[] = requestObj.namespaces;
    var BreakException = {};

    var path: string;
    var position = {
        startLine: 1,
        startChar: 1,
        endLine: 1,
        endChar: 1
    };

    try {
        for (var item = 0; item < workspaceTree.length; item++) {
            var element = workspaceTree[item];
            if (kind == SymbolType.Class) {
                for (var i = 0; i < element.classes.length; i++) {
                    var classNode = element.classes[i];
                    var ns: string = classNode.namespaceParts.join('\\');
                    if (namespaces.indexOf(ns) > -1 && word == classNode.name) {
                        path = element.path;
                        position.startLine = classNode.startPos.line;
                        position.startChar = classNode.startPos.col;
                        position.endLine = classNode.endPos.line;
                        position.endChar = classNode.endPos.col;
                        throw BreakException;
                    }
                }
            }
        }
    } catch (e) {}


    // var node = getFileNodeFromPath(requestObj.path);
    connection.sendNotification({ method: 'definitionInformation' }, { path: path, position: position });
});

var deleteFile: RequestType<{path:string}, any, any> = { method: "deleteFile" };
connection.onRequest(deleteFile, (requestObj) =>
{
    var node = getFileNodeFromPath(requestObj.path);
    if (node instanceof FileNode) {
        removeFromWorkspaceTree(node);
    }
});

var saveTreeCache: RequestType<{ projectDir: string, projectTree: string }, any, any> = { method: "saveTreeCache" };
connection.onRequest(saveTreeCache, request => {
    saveProjectTree(request.projectDir, request.projectTree).then(saved => {
        notifyClientOfWorkComplete();
    }).catch(error => {
        Debug.error(util.inspect(error, false, null));
    });
});

let docsDoneCount = 0;
var docsToDo: string[] = [];
var stubsToDo: string[] = [];

var buildFromFiles: RequestType<{
    files: string[],
    craneRoot: string,
    projectPath: string,
    treePath: string,
    enableCache: boolean,
    rebuild: boolean
}, any, any> = { method: "buildFromFiles" };
connection.onRequest(buildFromFiles, (project) => {
    if (project.rebuild) {
        workspaceTree = [];
        treeBuilder = new TreeBuilder();
    }
    enableCache = project.enableCache;
    docsToDo = project.files;
    docsDoneCount = 0;
    connection.console.log('starting work!');
    // Run asynchronously
    setTimeout(() => {
        glob(project.craneRoot + '/phpstubs/*/*.php', (err, fileNames) => {
            // Process the php stubs
            stubsToDo = fileNames;
            Debug.info(`Processing ${stubsToDo.length} stubs from ${project.craneRoot}/phpstubs`)
            connection.console.log(`Stub files to process: ${stubsToDo.length}`);
            processStub().then(data => {
                connection.console.log('stubs done!');
                connection.console.log(`Workspace files to process: ${docsToDo.length}`);
                processWorkspaceFiles(project.projectPath, project.treePath);
            }).catch(data => {
                connection.console.log('No stubs found!');
                connection.console.log(`Workspace files to process: ${docsToDo.length}`);
                processWorkspaceFiles(project.projectPath, project.treePath);
            });
        });
    }, 100);
});

var buildFromProject: RequestType<{treePath:string, enableCache:boolean}, any, any> = { method: "buildFromProject" };
connection.onRequest(buildFromProject, (data) => {
    enableCache = data.enableCache;
    fs.readFile(data.treePath, (err, data) => {
        if (err) {
            Debug.error('Could not read cache file');
            Debug.error((util.inspect(err, false, null)));
        } else {
            Debug.info('Unzipping the file');
            var treeStream = new Buffer(data);
            zlib.gunzip(treeStream, (err, buffer) => {
                if (err) {
                    Debug.error('Could not unzip cache file');
                    Debug.error((util.inspect(err, false, null)));
                } else {
                    Debug.info('Cache file successfully read');
                    workspaceTree = JSON.parse(buffer.toString());
                    Debug.info('Loaded');
                    notifyClientOfWorkComplete();
                }
            });
        }
    });
});

/**
 * Processes the stub files
 */
function processStub() {
    return new Promise((resolve, reject) => {
        var offset: number = 0;
        if (stubsToDo.length == 0) {
            reject();
        }
        stubsToDo.forEach(file => {
            fq.readFile(file, { encoding: 'utf8' }, (err, data) => {
                treeBuilder.Parse(data, file).then(result => {
                    addToWorkspaceTree(result.tree);
                    connection.console.log(`${offset} Stub Processed: ${file}`);
                    offset++;
                    if (offset == stubsToDo.length) {
                        resolve();
                    }
                }).catch(err => {
                    connection.console.log(`${offset} Stub Error: ${file}`);
                    Debug.error((util.inspect(err, false, null)));
                    offset++;
                    if (offset == stubsToDo.length) {
                        resolve();
                    }
                });
            });
        });
    });
}

/**
 * Processes the users workspace files
 */
function processWorkspaceFiles(projectPath: string, treePath: string) {
    docsToDo.forEach(file => {
        fq.readFile(file, { encoding: 'utf8' }, (err, data) => {
            treeBuilder.Parse(data, file).then(result => {
                addToWorkspaceTree(result.tree);
                docsDoneCount++;
                connection.console.log(`(${docsDoneCount} of ${docsToDo.length}) File: ${file}`);
                connection.sendNotification({ method: "fileProcessed" }, { filename: file, total: docsDoneCount, error: null });
                if (docsToDo.length == docsDoneCount) {
                    workspaceProcessed(projectPath, treePath);
                }
            }).catch(data => {
                docsDoneCount++;
                if (docsToDo.length == docsDoneCount) {
                    workspaceProcessed(projectPath, treePath);
                }
                connection.console.log(util.inspect(data, false, null));
                connection.console.log(`Issue processing ${file}`);
                connection.sendNotification({ method: "fileProcessed" }, { filename: file, total: docsDoneCount, error: util.inspect(data, false, null) });
            });
        });
    });
}

function workspaceProcessed(projectPath, treePath) {
    Debug.info("Workspace files have processed");
    saveProjectTree(projectPath, treePath).then(savedTree => {
        notifyClientOfWorkComplete();
        if (savedTree) {
            Debug.info('Project tree has been saved');
        }
    }).catch(error => {
        Debug.error(util.inspect(error, false, null));
    });
}

function addToWorkspaceTree(tree:FileNode)
{
    // Loop through existing filenodes and replace if exists, otherwise add

    var fileNode = workspaceTree.filter((fileNode) => {
        return fileNode.path == tree.path;
    })[0];

    var index = workspaceTree.indexOf(fileNode);

    if (index !== -1) {
        workspaceTree[index] = tree;
    } else {
        workspaceTree.push(tree);
    }

    // Debug
    // connection.console.log("Parsed file: " + tree.path);
}

function removeFromWorkspaceTree(tree: FileNode) {
    var index: number = workspaceTree.indexOf(tree);
    if (index > -1) {
        workspaceTree.splice(index, 1);
    }
}

function getClassNodeFromTree(className:string): ClassNode
{
    var toReturn = null;

    var fileNode = workspaceTree.forEach((fileNode) => {
        fileNode.classes.forEach((classNode) => {
            if (classNode.name.toLowerCase() == className.toLowerCase()) {
                toReturn = classNode;
            }
        })
    });

    return toReturn;
}

function getTraitNodeFromTree(traitName: string): ClassNode
{
    var toReturn = null;

    var fileNode = workspaceTree.forEach((fileNode) => {
        fileNode.traits.forEach((traitNode) => {
            if (traitNode.name.toLowerCase() == traitName.toLowerCase()) {
                toReturn = traitNode;
            }
        })
    });

    return toReturn;
}

function getFileNodeFromPath(path: string): FileNode {
    var returnNode = null;

    workspaceTree.forEach(fileNode => {
        if (fileNode.path == path) {
            returnNode = fileNode;
        }
    });

    return returnNode;
}

function notifyClientOfWorkComplete()
{
    var requestType: RequestType<any, any, any> = { method: "workDone" };
    connection.sendRequest(requestType);
}

function saveProjectTree(projectPath: string, treeFile: string): Promise<boolean> {
    return new Promise((resolve, reject) => {
        if (!enableCache) {
            resolve(false);
        } else {
            Debug.info('Packing tree file: ' + treeFile);
            fq.writeFile(`${projectPath}/tree.tmp`, JSON.stringify(workspaceTree), (err) => {
                if (err) {
                    Debug.error('Could not write to cache file');
                    Debug.error(util.inspect(err, false, null));
                    resolve(false);
                } else {
                    var gzip = zlib.createGzip();
                    var inp = fs.createReadStream(`${projectPath}/tree.tmp`);
                    var out = fs.createWriteStream(treeFile);
                    inp.pipe(gzip).pipe(out).on('close', function () {
                        fs.unlinkSync(`${projectPath}/tree.tmp`);
                    });
                    Debug.info('Cache file updated');
                    resolve(true);
                }
            });
        }
    });
}

connection.listen();
