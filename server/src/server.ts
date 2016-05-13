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

const glob = require("glob");
// const fq = require("fs");
const FileQueue = require('filequeue');
const fq = new FileQueue(200);
const util = require('util');

let connection: IConnection = createConnection(new IPCMessageReader(process), new IPCMessageWriter(process));

let documents: TextDocuments = new TextDocuments();
documents.listen(connection);

let treeBuilder: TreeBuilder = new TreeBuilder();
treeBuilder.SetConnection(connection);
let workspaceTree: FileNode[] = [];

let workspaceRoot: string;
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
                        toReturn.push({ label: node.name, kind: CompletionItemKind.Variable, detail: "global variable" });
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
                        toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: "parameter" });
                    });
                    func.globalVariables.forEach((globalVar) => {
                        toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: "global variable" });
                    });
                }
            });
            item.classes.forEach((classNode) => {
                if (classNode.startPos.line <= line && classNode.endPos.line >= line) {
                    classNode.methods.forEach((method) => {
                        if (method.startPos.line <= line && method.endPos.line >= line) {
                            method.params.forEach((param) => {
                                toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: "parameter" });
                            });

                            method.globalVariables.forEach((globalVar) => {
                                toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: "global variable" });
                            });
                        }
                    });

                    if (classNode.construct != null) {
                        if (classNode.construct.startPos.line <= line && classNode.construct.endPos.line >= line) {
                            classNode.construct.params.forEach((param) => {
                                toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: "parameter" });
                            });
                            classNode.construct.globalVariables.forEach((globalVar) => {
                                toReturn.push({ label: globalVar, kind: CompletionItemKind.Variable, detail: "global variable" });
                            });
                        }
                    }
                }
            });
        } else {
           recurseMethodCalls(toReturn, item, currentLine, line, lines, filePath, char);
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

            // Strip the leading $
            var insertText = subNode.name;

            if (!found) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: "property (static)", insertText: insertText });
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
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: "method (static)", insertText: subNode.name + "();" });
            }
        }
    });
}

function addStaticGlobalVariables(toReturn: CompletionItem[], item:FileNode)
{
}

function recurseMethodCalls(toReturn: CompletionItem[], item:FileNode, currentLine:string, line:number, lines:string[], filePath:string, char:number)
{
    currentLine = currentLine.replace(/\t/gm, " ");
    var parts = currentLine.trim().split("->");
    parts = parts.filter(item => {
        return item != "";
    });

    // TODO -- Handle properties set to class instances (ie. intellisense for $this->prop->)
    if (parts[0] == "$this")
    {
        // We're referencing the current class, show everything
        item.classes.forEach((classNode) => {
            if (item.path == filePath && classNode.startPos.line <= line && classNode.endPos.line >= line) {
                addClassPropertiesMethodsParentClassesAndTraits(toReturn, classNode, true, true);
            }
        });
    }
    else
    {
        // We're probably calling from a instantiated variable
        // Lookup the name in the tree to find what class it's set to at this point
        var matches = item.lineCache.filter(subItem => {

            var found = parts.filter(part => {
                var splitParts = part.split(" ");
                if (splitParts.length > 1) {
                    var matched = splitParts.filter(splitPart => {
                        return splitPart == subItem.name;
                    });
                    return matched.length > 0;
                } else {
                    return part == subItem.name;
                }
            })

            return found.length > 0;
        });

        if (matches.length > 0) {
            if (parts[0].search(matches[0].name) != 1) {
                let className = matches[0].value;
                var nodeMatches = [];
                // Lookup classname in tree
                workspaceTree.forEach(item => {
                    let found = item.symbolCache.filter(cache => {
                        return cache.name == className;
                    });

                    if (found.length != 0) {
                        nodeMatches.push(item);
                    }
                });

                if (nodeMatches.length != 0) {
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

function addClassTraitInterfaceNames(toReturn: CompletionItem[], item:FileNode)
{
    item.classes.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Class, detail: "class" });
    });

    item.traits.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Module, detail: "trait" });
    });

    item.interfaces.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Interface, detail: "interface" });
    });
}

function addFileLevelFuncsAndConsts(toReturn: CompletionItem[], item:FileNode)
{
    item.constants.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Value, detail: "constant" });
    });

    item.functions.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Function,  detail: "function", insertText: node.name + "()" });
    });
}

function addClassPropertiesMethodsParentClassesAndTraits(toReturn: CompletionItem[], classNode: ClassNode, includeProtected:boolean, includePrivate:boolean = true)
{
    classNode.constants.forEach((subNode) => {
        toReturn.push({ label: subNode.name, kind: CompletionItemKind.Value, detail: "constant" });
    });

    classNode.methods.forEach((subNode) => {
        var accessModifier = "method " + buildAccessModifier(subNode.accessModifier);
        var insertText = subNode.name + "();";

        if (subNode.isStatic) {
            accessModifier = "static " + accessModifier;
        }

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
            var accessModifier = "property " + buildAccessModifier(subNode.accessModifier);
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
            return "(public)";
        case 1:
            return "(private)";
        case 2:
            return "(protected)";
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

var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForDocument" };
connection.onRequest(requestType, (requestObj) =>
{
    var fileUri = requestObj.path;
    var text = requestObj.text;

    treeBuilder.Parse(text, fileUri).then(result => {
        addToWorkspaceTree(result.tree);
        notifyClientOfWorkComplete();
        return true;
    })
    .catch(error => {
        console.log(error);
        notifyClientOfWorkComplete();
        return false;
    });
});

let docsDoneCount = 0;
var docsToDo: string[] = [];
var stubsToDo: string[] = [];

var buildFromFiles: RequestType<any, any, any> = { method: "buildFromFiles" };
connection.onRequest(buildFromFiles, (data) => {
    docsToDo = data.files;
    docsDoneCount = 0;
    connection.console.log('starting work!');
    glob('/../phpstubs/*.php', { cwd: __dirname, root: __dirname }, (err, fileNames) => {
        // Process the php stubs
        stubsToDo = fileNames;
        connection.console.log(`Stub files to process: ${stubsToDo.length}`);
        processStub().then(data => {
            connection.console.log('stubs done!');
            connection.console.log(`Workspace files to process: ${docsToDo.length}`);
            processWorkspaceFile();
        }).catch(data => {
            connection.console.log('No stubs found!');
            connection.console.log(`Workspace files to process: ${docsToDo.length}`);
            processWorkspaceFile();
        });

        // Process the users workspace
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
function processWorkspaceFile() {
    var offset: number = 0;
    docsToDo.forEach(file => {
        fq.readFile(file, { encoding: 'utf8' }, (err, data) => {
            treeBuilder.Parse(data, file).then(result => {
                addToWorkspaceTree(result.tree);
                docsDoneCount++;
                connection.console.log(`(${docsDoneCount} of ${docsToDo.length}) File: ${file}`);
                connection.sendNotification({ method: "fileProcessed" }, { filename: file, total: docsDoneCount, error: null });
                if (docsToDo.length == docsDoneCount) {
                    connection.console.log('work done!');
                    notifyClientOfWorkComplete();
                }
            }).catch(data => {
                docsDoneCount++;
                if (docsToDo.length == docsDoneCount) {
                    connection.console.log('work done!');
                    notifyClientOfWorkComplete();
                }
                connection.console.log(util.inspect(data, false, null));
                connection.console.log(`Issue processing ${file}`);
                connection.sendNotification({ method: "fileProcessed" }, { filename: file, total: docsDoneCount, error: util.inspect(data, false, null) });
            });
        });
    });
}

var requestType: RequestType<any, any, any> = { method: "findSymbolInTree" };
connection.onRequest(requestType, (request) =>
{
    // If request.word starts with $ then variable
    // If request.word starts with $this-> then class property
    // If request.word contains ( then function or class instantiation
    // If request.word starts with $this-> and ( then class method

    let word = request.word;
    let position = request.position;

    word = word.toLowerCase();

    let node = null;

    // Search symbol cache
    workspaceTree.forEach(fileNode =>
    {
        let matches = fileNode.symbolCache.filter(item => {
            return item.name.toLowerCase() == word;
        });

        let t = "";
    });

    // Return filenodes with matches
    return { node: node };
});

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

connection.listen();
