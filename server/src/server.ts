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
let saveCache: boolean = true;
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

    var line = textDocumentPosition.position.line;
    var char = textDocumentPosition.position.character;

    // Lookup what the last char typed was
    var doc = documents.get(textDocumentPosition.uri);
    var text = doc.getText();
    var lines = text.split(/\r\n|\r|\n/gm);

    var currentLine = lines[line];
    var lastChar = currentLine[char - 1];
    var filePath = buildDocumentPath(textDocumentPosition.uri);

    var toReturn: CompletionItem[] = [];

    workspaceTree.forEach(item =>
    {
        // Only add these top level when last char != ">"
        if (lastChar != ">") {
            // TODO -- Find last occurance of "->" and load suggestions (this will match cases of half entered props and methods)
            if (lastChar == "$") {
                // Only load these if they're in the same file
                if (item.path == filePath) {
                    // TODO -- Only show these if we're either not in a function/class
                    //         or if we're calling "global" to import them (or they've already been imported)
                    item.topLevelVariables.forEach((node) => {
                        toReturn.push({ label: node.name, kind: CompletionItemKind.Variable, detail: `(variable) : ${node.type}` });
                    });
                }
            } else if (lastChar == ":") {
                // Get static methods, properties, consts declared in scope
                if (currentLine.substr(char - 6, char - 1) === "self::") {
                    if (item.path == filePath) {
                        item.classes.forEach((node) => addStaticClassMembers(toReturn, node));
                    }
                    addStaticGlobalVariables(toReturn, item);
                } else {
                    if (currentLine.substr(char - 6, char - 1) !== " self:") {
                        // We're calling via ClassName::
                        lookupClassAndAddStaticMembers(toReturn, currentLine);
                    }
                }
            } else {
                addClassTraitInterfaceNames(toReturn, item);
            }

            // Only load these if they're in the same file
            if (item.path == filePath) {
                addFileLevelFuncsAndConsts(toReturn, item);
            }

            // Add parameters for functions and class methods
            item.functions.forEach((func) => {
                if (func.startPos.line <= line && func.endPos.line >= line) {
                    func.params.forEach((param) => {
                        toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: `(parameter) ${param.type}` });
                    });
                    func.globalVariables.forEach((globalVar) => {
                        toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: `(imported global) : unknown` });
                    });
                }
            });
            item.classes.forEach((classNode) => {
                if (classNode.startPos.line <= line && classNode.endPos.line >= line) {
                    classNode.methods.forEach((method) => {
                        if (method.startPos.line <= line && method.endPos.line >= line) {
                            method.params.forEach((param) => {
                                toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: `(parameter) : ${param.type}` });
                            });

                            method.globalVariables.forEach((globalVar) => {
                                toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: `(imported global) : unknown` });
                            });

                            method.scopeVariables.forEach((scopeVar) => {
                                toReturn.push({ label: scopeVar.name, kind: CompletionItemKind.Variable, detail: `(variable) : ${scopeVar.type}` });
                            });
                        }
                    });

                    if (classNode.construct != null) {
                        if (classNode.construct.startPos.line <= line && classNode.construct.endPos.line >= line) {
                            classNode.construct.params.forEach((param) => {
                                toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: `(parameter) : ${param.type}` });
                            });

                            classNode.construct.globalVariables.forEach((globalVar) => {
                                toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: `(imported global) : unknown` });
                            });

                            classNode.construct.scopeVariables.forEach((scopeVar) => {
                                toReturn.push({ label: scopeVar.name, kind: CompletionItemKind.Variable, detail: `(variable) : ${scopeVar.type}` });
                            });
                        }
                    }
                }
            });
        } else {
            try {
                recurseMethodCalls(toReturn, item, currentLine, line, lines, filePath, char);
            }
            catch(e) {
                console.error(e);
            }
        }
    });

    return toReturn;
});

function lookupClassAndAddStaticMembers(toReturn: CompletionItem[], currentLine:string)
{
    // Get the class name to lookup
    var words = currentLine.split("::");

    // Break out if we're not in a valid call
    if (words.length == 1 && words[0].indexOf("::") === -1) return;

    var name = words[words.length - 2];
    var className = name.trim();

    var classNode = getClassNodeFromTree(className);
    if (classNode != null) {
        addStaticClassMembers(toReturn, classNode);
    }
}

function addStaticClassMembers(toReturn: CompletionItem[], item:ClassNode)
{
    item.constants.forEach((subNode) => {
        // if (subNode.isStatic) {

        // }
    });
    item.properties.forEach((subNode) => {
        if (subNode.isStatic) {
            var found = false;
            toReturn.forEach((returnItem) => {
                if (returnItem.label == subNode.name) {
                    found = true;
                }
            });

            var insertText = subNode.name;

            if (!found) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: `(property) [static] : ${subNode.type}`, insertText: insertText });
            }
        }
    });
    item.methods.forEach((subNode) => {
        if (subNode.isStatic) {
            var found = false;
            toReturn.forEach((returnItem) => {
                if (returnItem.label == subNode.name) {
                    found = true;
                }
            });

            if (!found) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: `(method) [static] : ${subNode.returns}`, insertText: subNode.name + "()" });
            }
        }
    });
}

function addStaticGlobalVariables(toReturn: CompletionItem[], item:FileNode)
{
}

function findCaller(filePath:string, line:string, char:number) : string
{
    // Starting at char, go back through the line until we find a $, then return the value
    var partLine = line.substr(char, line.length - char);

    // TODO -- the line being passed through does not have leading spaces,
    //         so the char offset is incorrect at this point.

    // Return the matched caller. eg "$this", "$this->function()", "$this->prop", "$instVar", etc
    return null;
}

function recurseMethodCalls(toReturn: CompletionItem[], item:FileNode, currentLine:string, line:number, lines:string[], filePath:string, char:number)
{
    currentLine = currentLine.replace(/\t/gm, " ");
    var rawParts = currentLine.trim().match(/\$.*(?=->)/gm);

    var parts: string[] = [];

    if (rawParts[0].indexOf("->") > -1) {
        rawParts.forEach(part => {
            var splitParts = part.split("->");
            splitParts.forEach(splitPart => {
                parts.push(splitPart);
            });
        });
    } else {
        parts = rawParts;
    }

    //findCaller(filePath, currentLine, char);
    // if (findCaller(currentLine, char) == "$this") {
    // } else {
    // }

    // Check that we're calling this
    if (parts[0].indexOf("$this", parts[0].length - 5) !== -1)
    {
        // TODO -- Only chain method calls, not property calls (eg. $this->func()->func2())
        // TODO -- Handle properties set to class instances (ie. intellisense for $this->prop->)

        // We're referencing the current class, show everything
        item.classes.forEach((classNode) => {
            if (item.path == filePath && classNode.startPos.line <= line && classNode.endPos.line >= line) {
                addClassPropertiesMethodsParentClassesAndTraits(toReturn, classNode, true, true);
            }
        });
    }
    else
    {
        var doProcess = false;

        // We're probably calling from a instantiated variable
        // Check the variable is in scope for suggestions
        item.classes.forEach((classNode) => {
            if (item.path == filePath && classNode.startPos.line <= line && classNode.endPos.line >= line) {
                classNode.methods.forEach(method => {
                    if (method.startPos.line <= line && method.endPos.line >= line) {
                        // Check for params/scope/global
                        let found = checkVariableScopeForSuggestions(method, parts[0]);
                        if (found) {
                            doProcess = true;
                        }
                    }
                });

                if (classNode.construct && classNode.construct.startPos.line <= line && classNode.construct.endPos.line >= line) {
                    let found = checkVariableScopeForSuggestions(classNode.construct, parts[0]);
                    if (found) {
                        doProcess = true;
                    }
                }
            }
        });

        // Loop through functions outside a class
        item.functions.forEach(func => {
            let found = checkVariableScopeForSuggestions(func, parts[0]);
            if (found) {
                doProcess = true;
            }
        });

        // Loop though traits
        item.traits.forEach(trait => {
            trait.methods.forEach(method => {
                let found = checkVariableScopeForSuggestions(method, parts[0]);
                if (found) {
                    doProcess = true;
                }
            });
        });

        // Loop through top level (global) variables
        item.topLevelVariables.forEach(variable => {
            if (variable.name == parts[0]) {
                doProcess = true;
            }
        });

        // Break out if the variable isn't in scope
        if (!doProcess) {
            return;
        }


        // Lookup the name in the tree to find what class it's set to at this point
        var matches = item.lineCache.filter(subItem => {

            var found = parts.filter(part => {
                return part == subItem.name;
            });

            return found.length > 0;
        });

        // Check the matched variable is declared in scope
        // Check we're in the same file
        // We know the current line, so we know the current class and function for this file

        if (matches.length > 0) {
            if (parts[0].search(matches[0].name) != 1) {
                let className = matches[0].value;
                var nodeMatches = [];

                // Lookup classname in tree
                workspaceTree.forEach(item => {
                    let found = item.symbolCache.filter(cache => {
                        return cache.name == className;
                    });

                    if (found.length > 0) {
                        nodeMatches.push(item);
                    }
                });

                if (nodeMatches.length > 0) {
                    nodeMatches[0].classes.forEach(classNode => {
                        if (classNode.name == className) {
                            addClassPropertiesMethodsParentClassesAndTraits(toReturn, classNode, false, false);
                        }
                    });
                }
            }
        }
    }
}

function checkVariableScopeForSuggestions(method, passedVariable: string) {
    var matches:boolean[] = [];
                        
    if (method.hasOwnProperty("globalVariables")) {
        matches.push(method.globalVariables.some(variable => {
            return variable == passedVariable;
        }));
    }
    matches.push(method.params.some(variable => {
        return variable.name == passedVariable;
    }));
    matches.push(method.scopeVariables.some(variable => {
        return variable.name == passedVariable;
    }));

    var found = matches.filter(element => {
        return element == true;
    });

    if (found.length > 0) {
        return true;
    }

    return false;
}

function addClassTraitInterfaceNames(toReturn: CompletionItem[], item:FileNode)
{
    item.classes.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Class, detail: "(class)" });
    });

    item.traits.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Module, detail: "(trait)" });
    });

    item.interfaces.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Interface, detail: "(interface)" });
    });
}

function addFileLevelFuncsAndConsts(toReturn: CompletionItem[], item:FileNode)
{
    item.constants.forEach((node) => {
        let value = node.value;
        if (node.type == "string") {
            value = "\"" + value + "\"";
        }
        toReturn.push({ label: node.name, kind: CompletionItemKind.Value, detail: `(constant) : ${node.type} : ${value}` });
    });

    item.functions.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Function,  detail: `(function) : ${node.returns}`, insertText: node.name + "()" });
    });
}

function addClassPropertiesMethodsParentClassesAndTraits(toReturn: CompletionItem[], classNode: ClassNode, includeProtected:boolean, includePrivate:boolean = true)
{
    classNode.constants.forEach((subNode) => {
        let value = subNode.value;
        if (subNode.type == "string") {
            value = "\"" + value + "\"";
        }
        toReturn.push({ label: subNode.name, kind: CompletionItemKind.Value, detail: `(constant) : ${subNode.type} : ${value}` });
    });

    classNode.methods.forEach((subNode) => {
        var accessModifier = "(" + buildAccessModifier(subNode.accessModifier);
        var insertText = subNode.name + "()";

        if (subNode.isStatic) {
            accessModifier = accessModifier + " static";
        }

        accessModifier = accessModifier + ` method) : ${subNode.returns}`;

        if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: accessModifier, insertText: insertText });
        }
        if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: accessModifier, insertText: insertText });
        }
        if (subNode.accessModifier == AccessModifierNode.public) {
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: accessModifier, insertText: insertText });
        }
    });

    classNode.properties.forEach((subNode) => {
        if (!subNode.isStatic) {
            var accessModifier = "(" + buildAccessModifier(subNode.accessModifier) + ` property) : ${subNode.type}`;
            // Strip the leading $
            var insertText = subNode.name.substr(1, subNode.name.length - 1);

            if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
            }
            if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
            }
            if (subNode.accessModifier == AccessModifierNode.public) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
            }
        }
    });

    classNode.traits.forEach((traitName) => {
        // Look up the trait node in the tree
        var traitNode = getTraitNodeFromTree(traitName);
        if (traitNode != null) {
            addClassPropertiesMethodsParentClassesAndTraits(toReturn, traitNode, true, true);
        }
    });

    if (classNode.extends != null && classNode.extends != "")
    {
        // Look up the class node in the tree
        var extendedClassNode = getClassNodeFromTree(classNode.extends);
        if (extendedClassNode != null) {
            addClassPropertiesMethodsParentClassesAndTraits(toReturn, extendedClassNode, true, false);
        }
    }
}

function buildAccessModifier(modifier:number): string
{
    switch (modifier) {
        case 0:
            return "public";
        case 1:
            return "private";
        case 2:
            return "protected";
    }

    return "";
}

function buildDocumentPath(uri:string): string
{
    var path = uri;
    path = path.replace("file:///", "");
    path = path.replace("%3A", ":");

    // Handle Windows and Unix paths
    switch (process.platform) {
        case 'darwin':
            path = "/" + path;
            break;
        case 'win32':
            path = path.replace(/\//g, "\\");
            break;
    }

    return path;
}

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

var requestType: RequestType<{path:string,text:string,projectDir:string,projectTree:string}, any, any> = { method: "buildObjectTreeForDocument" };
connection.onRequest(requestType, (requestObj) =>
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

var saveTreeCache: RequestType<{ projectDir: string, projectTree: string }, any, any> = { method: "saveTreeCache" };
connection.onRequest(saveTreeCache, request => {
    saveProjectTree(request.projectDir, request.projectTree).then(saved => {
        notifyClientOfWorkComplete();
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
    saveCache: boolean,
    rebuild: boolean
}, any, any> = { method: "buildFromFiles" };
connection.onRequest(buildFromFiles, (project) => {
    if (project.rebuild) {
        workspaceTree = [];
        treeBuilder = new TreeBuilder();
    }
    saveCache = project.saveCache;
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

var buildFromProject: RequestType<{treePath:string, saveCache:boolean}, any, any> = { method: "buildFromProject" };
connection.onRequest(buildFromProject, (data) => {
    saveCache = data.saveCache;
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
                    Debug.info('Cache file successfullly read');
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

function getTraitNodeFromTree(traitName:string): ClassNode
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

function notifyClientOfWorkComplete()
{
    var requestType: RequestType<any, any, any> = { method: "workDone" };
    connection.sendRequest(requestType);
}

function saveProjectTree(projectPath: string, treeFile: string): Promise<boolean> {
    return new Promise((resolve, reject) => {
        if (!saveCache) {
            resolve(false);
        }else{
            Debug.info('packing tree file: ' + treeFile);
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
