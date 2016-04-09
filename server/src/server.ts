/* --------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * ------------------------------------------------------------------------------------------ */
'use strict';

import {
    IPCMessageReader, IPCMessageWriter,
    createConnection, IConnection, TextDocumentSyncKind,
    TextDocuments, ITextDocument, Diagnostic, DiagnosticSeverity,
    InitializeParams, InitializeResult, TextDocumentIdentifier, TextDocumentPosition,
    CompletionItem, CompletionItemKind, RequestType
} from 'vscode-languageserver';

import { TreeBuilder, FileNode, ClassNode } from "./hvy/treeBuilder";

const glob = require("glob")
const fs = require("fs");

let connection: IConnection = createConnection(new IPCMessageReader(process), new IPCMessageWriter(process));

let documents: TextDocuments = new TextDocuments();
documents.listen(connection);

let treeBuilder: TreeBuilder = new TreeBuilder();
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
    //var lines = text.replace(/\r/g, "").split(/\n/);
    var lines = text.split(/\r\n|\r|\n/gm);

    var currentLine = lines[line];
    var lastChar = currentLine[char - 1];
    var filePath = buildDocumentPath(textDocumentPosition.uri);

    var toReturn: CompletionItem[] = [];

    workspaceTree.forEach(item =>
    {
        // Only add these top level when last char != ">"
        if (lastChar != ">") {
            if (lastChar == "$") {
                // Only load these if they're in the same file
                if (item.path == filePath) {
                    item.topLevelVariables.forEach((node) => {
                        toReturn.push({ label: node.name, kind: CompletionItemKind.Variable });
                    });
                }
            } else if (lastChar == ":") {
                // Get static methods, properties, consts declared in scope
                if (currentLine.substr(char - 6, char - 1) === "self::") {
                    item.classes.forEach((node) => addStaticClassMembers(toReturn, node));
                    addStaticGlobalVariables(toReturn, item);
                } else {
                    if (currentLine.substr(char - 6, char - 1) !== " self:") {
                        // We're calling via ClassName::
                        lookupClassAndAddStaticMembers(toReturn, currentLine);
                    }
                }
            } else {
                addClassTraitInterfaceNames(toReturn, item);

                // Only load these if they're in the same file
                if (item.path == filePath) {
                    addFileLevelFuncsAndConsts(toReturn, item);
                }

                // Add parameters for functions and class methods
                item.functions.forEach((func) => {
                    if (func.startPos.line <= line && func.endPos.line >= line) {
                        func.params.forEach((param) => {
                            toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: "(parameter)" });
                        });
                    }
                });
                item.classes.forEach((classNode) => {
                    if (classNode.startPos.line <= line && classNode.endPos.line >= line) {
                        classNode.methods.forEach((method) => {
                            if (method.startPos.line <= line && method.endPos.line >= line) {
                                method.params.forEach((param) => {
                                    toReturn.push({ label: param.name, kind: CompletionItemKind.Property, detail: "(parameter)" });
                                });
                            }
                        });
                    }
                });
            }
        } else {
           recurseMethodCalls(toReturn, item, currentLine, line, lines, filePath);
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
        // if (subNode.isStatic) {
            
        // }
    });
    item.methods.forEach((subNode) => {
        if (subNode.isStatic) {
            var found = false;
            toReturn.forEach((returnItem) => {
                if (returnItem.label == subNode.name) {
                    found = true;
                }
            })

            if (!found) {
                toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: "(static)", insertText: subNode.name + "()" });
            }
        }
    });
}

function addStaticGlobalVariables(toReturn: CompletionItem[], item:FileNode)
{
}

function recurseMethodCalls(toReturn: CompletionItem[], item:FileNode, currentLine:string, line:number, lines:string[], filePath:string)
{
    var words = currentLine.split(" ");
    var expression = words[words.length - 1];
    if (expression.lastIndexOf("$this", 0) === 0 || expression.lastIndexOf("($this", 0) === 0 || expression.lastIndexOf("if($this", 0) === 0 || expression.lastIndexOf("elseif($this", 0) === 0 || expression.lastIndexOf("!$this", 0) === 0) {
        // We're referencing the current class
        item.classes.forEach((classNode) => {
            // NOTE -- This path checking works for $this, but won't for class instance variables
            if (item.path == filePath && classNode.startPos.line <= line && classNode.endPos.line >= line) {
                addClassPropertiesMethodsParentClassesAndTraits(toReturn, classNode, false);
            }
        });
    } else {
        if (expression.indexOf("->") === 0) {
            // Track back and check we're accessing $this
            var prevLine = lines[line - 1];

            var prevWords = prevLine.split(" ");
            var prevexpression = prevWords[prevWords.length - 1];

            // Recurse
            recurseMethodCalls(toReturn, item, prevLine, line - 1, lines, filePath);
        }
    }
}

function addClassTraitInterfaceNames(toReturn: CompletionItem[], item:FileNode)
{
    item.classes.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Class });
    });

    item.traits.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Module });
    });

    item.interfaces.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Interface });
    });
}

function addFileLevelFuncsAndConsts(toReturn: CompletionItem[], item:FileNode)
{
    item.constants.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Value });
    });

    item.functions.forEach((node) => {
        toReturn.push({ label: node.name, kind: CompletionItemKind.Function, insertText: node.name + "()" });
    });
}

function addClassPropertiesMethodsParentClassesAndTraits(toReturn: CompletionItem[], classNode: ClassNode, isParentClass)
{
    classNode.constants.forEach((subNode) => {
        toReturn.push({ label: subNode.name, kind: CompletionItemKind.Value });
    });

    classNode.methods.forEach((subNode) => {
        var accessModifier = buildAccessModifier(subNode.accessModifier);
        var insertText = subNode.name + "()";

        if (!isParentClass || (isParentClass && subNode.accessModifier != 1)) {
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Method, detail: accessModifier, insertText: insertText });
        }
    });

    classNode.properties.forEach((subNode) => {
        var accessModifier = buildAccessModifier(subNode.accessModifier);
        var insertText = subNode.name.substr(1, subNode.name.length - 1);

        if (!isParentClass || (isParentClass && subNode.accessModifier != 1)) {
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
        }
    });

    classNode.traits.forEach((traitName) =>
    {
        // Look up the trait node in the tree
        var traitNode = getTraitNodeFromTree(traitName);
        if (traitNode != null) {
            addClassPropertiesMethodsParentClassesAndTraits(toReturn, traitNode, false);
        }
    })

    if (classNode.extends != null && classNode.extends != "")
    {
        // Look up the class node in the tree
        var extendedClassNode = getClassNodeFromTree(classNode.extends);
        if (extendedClassNode != null) {
            addClassPropertiesMethodsParentClassesAndTraits(toReturn, extendedClassNode, true);
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
    // TODO
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
connection.onRequest(requestType, (fileUri) =>
{
    fs.readFile(fileUri, { encoding: "utf8" }, (err, data) => {
        treeBuilder.Parse(data, fileUri).then(result => {
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
});

var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForWorkspace" };
connection.onRequest(requestType, (data) =>
{
    // Load all PHP files in workspace
    glob("/**/*.php", { cwd: workspaceRoot, root: workspaceRoot }, function (err, fileNames)
    {
        var docsToDo = fileNames;
        var docsDoneCount = 0;
 
        docsToDo.forEach(docPath =>
        {
            fs.readFile(docPath, { encoding: "utf8" }, (err, data) => {
                treeBuilder.Parse(data, docPath).then(result => {
                    addToWorkspaceTree(result.tree);

                    docsDoneCount++;

                    if (docsToDo.length == docsDoneCount) {
                        notifyClientOfWorkComplete();
                        return true;
                    }
                })
                .catch(error => {
                    console.log(error);
                    notifyClientOfWorkComplete();
                    return false;
                });
            });
        });
    });
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

    connection.console.log("Parsed file: " + tree.path);
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
