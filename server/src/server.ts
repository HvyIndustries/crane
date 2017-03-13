/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import {
    IPCMessageReader, IPCMessageWriter,
    createConnection, IConnection, TextDocumentSyncKind,
    TextDocuments, TextDocument, Diagnostic, DiagnosticSeverity,
    InitializeParams, InitializeResult, TextDocumentIdentifier, TextDocumentPositionParams,
    CompletionItem, CompletionItemKind, RequestType, Position,
    SignatureHelp, SignatureInformation, ParameterInformation
} from 'vscode-languageserver';

import { TreeBuilder } from "./hvy/treeBuilder";
import { FileNode, FileSymbolCache, SymbolType, AccessModifierNode, ClassNode } from "./hvy/nodes";
import { Debug } from './util/Debug';
import { SuggestionBuilder } from './suggestionBuilder';
import { DefinitionProvider } from "./providers/definition";

import Storage from './util/Storage';
import { Files } from "./util/Files";
import { DocumentSymbolProvider } from "./providers/documentSymbol";
import { WorkspaceSymbolProvider } from "./providers/workspaceSymbol";

const util = require('util');

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

let cache:Storage = new Storage();

// Prevent garbage collection of essential objects
let timer = setInterval(() => {
                treeBuilder.Ping();
                return workspaceTree.length;
            }, 15000);

let workspaceRoot: string;
var craneProjectDir: string;
let enableCache: boolean = true;
connection.onInitialize((params): InitializeResult =>
{
    workspaceRoot = params.rootPath;

    return {
        capabilities: {
            textDocumentSync: documents.syncKind,
            completionProvider: {
                resolveProvider: true,
                triggerCharacters: ['.', ':', '$', '>', "\\"]
            },
            definitionProvider: true,
            documentSymbolProvider: true,
            workspaceSymbolProvider: true
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
connection.onCompletion((textDocumentPosition: TextDocumentPositionParams): CompletionItem[] =>
{
    var doc = documents.get(textDocumentPosition.textDocument.uri);
    var suggestionBuilder = new SuggestionBuilder();

    suggestionBuilder.prepare(textDocumentPosition, doc, workspaceTree);

    var toReturn: CompletionItem[] = suggestionBuilder.build();

    return toReturn;
});

// This handler resolve additional information for the item selected in
// the completion list.
connection.onCompletionResolve((item: CompletionItem): CompletionItem => {
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

connection.onDefinition((params, cancellationToken) => {
    return new Promise((resolve, reject) => {
        let path = Files.getPathFromUri(params.textDocument.uri);
        let filenode = getFileNodeFromPath(path);
        let definitionProvider = new DefinitionProvider(params, path, filenode, workspaceTree);
        let locations = definitionProvider.findDefinition();
        resolve(locations);
    });
});

connection.onDocumentSymbol((params, cancellationToken) => {
    return new Promise((resolve, reject) => {
        let path = Files.getPathFromUri(params.textDocument.uri);
        let filenode = getFileNodeFromPath(path);
        let documentSymbolProvider = new DocumentSymbolProvider(filenode);
        let symbols = documentSymbolProvider.findSymbols();
        resolve(symbols);
    });
});

connection.onWorkspaceSymbol((params, cancellationToken) => {
    return new Promise((resolve, reject) => {
        let workspaceSymbolProvider = new WorkspaceSymbolProvider(workspaceTree, params.query);
        let symbols = workspaceSymbolProvider.findSymbols();
        resolve(symbols);
    });
});

var buildObjectTreeForDocument: RequestType<{path:string,text:string}, any, any, any> = new RequestType("buildObjectTreeForDocument");
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

var deleteFile: RequestType<{path:string}, any, any, any> = new RequestType("deleteFile");
connection.onRequest(deleteFile, (requestObj) =>
{
    var node = getFileNodeFromPath(requestObj.path);
    if (node instanceof FileNode) {
        removeFromWorkspaceTree(node);
    }
});

var saveTreeCache: RequestType<{ projectDir: string, projectTree: string }, any, any, any> = new RequestType("saveTreeCache");
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
}, any, any, any> = new RequestType("buildFromFiles");
connection.onRequest(buildFromFiles, (project) => {
    if (project.rebuild) {
        workspaceTree = [];
        treeBuilder = new TreeBuilder();
    }
    enableCache = project.enableCache;
    docsToDo = project.files;
    docsDoneCount = 0;
    Debug.info("Preparing to parse workspace...");

    // Run asynchronously
    setTimeout(() => {
        glob(project.craneRoot + '/phpstubs/*/*.php', (err, fileNames) => {
            // Process the php stubs
            stubsToDo = fileNames;
            Debug.info(`Processing ${stubsToDo.length} stubs from ${project.craneRoot}/phpstubs`)
            Debug.info(`Stub files to process: ${stubsToDo.length}`);
            processStub().then(data => {
                Debug.info('Stubs parsing done!');
                Debug.info(`Workspace files to process: ${docsToDo.length}`);
                processWorkspaceFiles(project.projectPath, project.treePath);
            }).catch(data => {
                Debug.info('No stubs found!');
                Debug.info(`Workspace files to process: ${docsToDo.length}`);
                processWorkspaceFiles(project.projectPath, project.treePath);
            });
        });
    }, 100);
});

var buildFromProject: RequestType<{treePath:string, enableCache:boolean}, any, any, any> = new RequestType("buildFromProject");
connection.onRequest(buildFromProject, (data) => {
    enableCache = data.enableCache;
    cache.read(data.treePath, (err, data) => {
        if (err) {
            Debug.error('Could not read cache file');
            Debug.error((util.inspect(err, false, null)));
        } else {
            Debug.info('Cache file successfully read');
            workspaceTree = data;
            notifyClientOfWorkComplete();
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
                    Debug.info(`${offset} Stub Processed: ${file}`);
                    offset++;
                    if (offset == stubsToDo.length) {
                        resolve();
                    }
                }).catch(err => {
                    Debug.error(`${offset} Stub Error: ${file}`);
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
                connection.sendNotification("fileProcessed", {
                    filename: file,
                    total: docsDoneCount,
                    error: null
                });
                if (docsToDo.length == docsDoneCount) {
                    workspaceProcessed(projectPath, treePath);
                }
            }).catch(data => {
                docsDoneCount++;
                if (docsToDo.length == docsDoneCount) {
                    workspaceProcessed(projectPath, treePath);
                }
                Debug.error(util.inspect(data, false, null));
                Debug.error(`Issue processing ${file}`);
                connection.sendNotification("fileProcessed", { filename: file, total: docsDoneCount, error: util.inspect(data, false, null) });
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

    for (var i = 0, l = workspaceTree.length; i < l; i++) {
        var fileNode = workspaceTree[i];

        for (var j = 0, sl = fileNode.classes.length; j < sl; j++) {
            var classNode = fileNode.classes[j];

            if (classNode.name.toLowerCase() == className.toLowerCase()) {
                toReturn = classNode;
            }
        }
    }

    return toReturn;
}

function getTraitNodeFromTree(traitName: string): ClassNode
{
    var toReturn = null;

    for (var i = 0, l = workspaceTree.length; i < l; i++) {
        var fileNode = workspaceTree[i];

        for (var j = 0, sl = fileNode.traits.length; j < sl; j++) {
            var traitNode = fileNode.traits[j];

            if (traitNode.name.toLowerCase() == traitName.toLowerCase()) {
                toReturn = traitNode;
            }
        }
    }

    return toReturn;
}

function getFileNodeFromPath(path: string): FileNode {
    var returnNode = null;

    for (var i = 0, l = workspaceTree.length; i < l; i++) {
        var fileNode = workspaceTree[i];

        if (fileNode.path == path) {
            returnNode = fileNode;
        }
    }

    return returnNode;
}

function notifyClientOfWorkComplete()
{
    connection.sendRequest("workDone");
}

function saveProjectTree(projectPath: string, treeFile: string): Promise<boolean> {
    return new Promise((resolve, reject) => {
        if (!enableCache) {
            resolve(false);
        } else {
            cache.save(treeFile, workspaceTree, (result) => {
                if (result === true) {
                    resolve(true);
                } else {
                    reject(result);
                }
            });
        }
    });
}

connection.listen();
