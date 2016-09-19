/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import {
    IPCMessageReader, IPCMessageWriter, SymbolKind,
    createConnection, IConnection, TextDocumentSyncKind,
    TextDocuments, InitializeResult, TextDocumentPositionParams,
    CompletionList, CompletionItem, CompletionItemKind, RequestType, FileChangeType
} from 'vscode-languageserver';

import { FileSymbolCache } from "./hvy/treeBuilder";
import { Debug } from './utils/Debug';
import { Path } from './utils/Path';
import { Index } from './index';
import { SuggestionBuilder } from './suggestionBuilder';

const fs = require("fs");
const mkdirp = require('mkdirp');

var pkg = require('./package.json');

let connection: IConnection = createConnection(new IPCMessageReader(process), new IPCMessageWriter(process));

let documents: TextDocuments = new TextDocuments();
documents.listen(connection);
Debug.SetConnection(connection);

let index: Index = new Index(connection);

export let workspaceRoot: string;
export let enableCache: boolean = true;

connection.onInitialize((params): InitializeResult =>
{
    workspaceRoot = params.rootPath;

    // Read initialization options if provided by client
    var opts = params.initializationOptions;
    if (opts && opts.enableCache) {
        enableCache = opts.enableCache;
    }

    checkVersion().then(indexTriggered => {
        if (!indexTriggered) {
            // Send request to server to build object tree for all workspace files
            index.build();
        }
    });

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

function checkVersion(): Thenable<boolean>
{
    Debug.info('Checking the current version of Crane');
    return new Promise((resolve, reject) => {
        getVersionFile().then(result => {
            if (result.err && result.err.code == "ENOENT") {
                // New install
                connection.window.showInformationMessage(`Welcome to Crane v${pkg.version}.`, { title: "Getting Started Guide" }).then(data => {
                    if (data != null) {
                        connection.sendNotification({ method: "window/openBrowser" },
                            { url: "https://github.com/HvyIndustries/crane/wiki/end-user-guide#getting-started" });
                    }
                });
                createOrUpdateVersionFile(false);
                index.deleteAllCaches().then(item => {
                    index.build();
                    resolve(true);
                });
            } else {
                // Strip newlines from data
                result.data = result.data.replace("\n", "");
                result.data = result.data.replace("\r", "");
                if (result.data && result.data != pkg.version) {
                    // Updated install
                    connection.window.showInformationMessage(`You're been upgraded to Crane v${pkg.version}.`, { title: "View Release Notes" }).then(data => {
                        if (data != null) {
                            connection.sendNotification({ method: "window/openBrowser" },
                                { url: "https://github.com/HvyIndustries/crane/releases" });
                        }
                    });
                    createOrUpdateVersionFile(true);
                    index.deleteAllCaches().then(item => {
                        index.build();
                        resolve(true);
                    });
                } else {
                    resolve(false);
                }
            }
        });
    });
}

export function getCraneDir(): string {
    if (process.env.APPDATA) {
        return process.env.APPDATA + '/Crane';
    }
    if (process.env.XDG_CONFIG_HOME) {
        return process.env.XDG_CONFIG_HOME + '/Crane';
    }
    if (process.platform == 'darwin') {
        return process.env.HOME + '/Library/Preferences/Crane';
    }
    if (process.platform == 'linux') {
        return process.env.HOME + '/.config/Crane';
    }
}

interface result {
    err;
    data;
}

function getVersionFile(): Thenable<result> {
    return new Promise((resolve, reject) => {
        var filePath = getCraneDir() + "/version";
        fs.readFile(filePath, "utf-8", (err, data) => {
            resolve({ err, data });
        });
    });
}

function createOrUpdateVersionFile(fileExists: boolean) {
    var filePath = getCraneDir() + "/version";

    if (fileExists) {
        // Delete the file
        fs.unlinkSync(filePath);
    }

    // Create the file + write Config.version into it
    mkdirp(getCraneDir(), err => {
        if (err) {
            Debug.error(err);
            return;
        }
        fs.writeFile(filePath, pkg.version, "utf-8", err => {
            if (err != null) {
                Debug.error(err);
            }
        });
    });

}

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

documents.onDidChangeContent((event) => {
    Debug.info('Document Changed: ' + event.document.uri);
    index.updateFile(Path.fromURI(event.document.uri), event.document.getText());
});

connection.onDidChangeWatchedFiles((change) =>
{
    change.changes.forEach(event => {
        switch (event.type) {
            case FileChangeType.Created:
                Debug.info('File Created: ' + event.uri);
                index.addFile(Path.fromURI(event.uri));
                break;
        
            case FileChangeType.Changed:
                Debug.info('File Changed: ' + event.uri);
                index.addFile(Path.fromURI(event.uri));
                break;

            case FileChangeType.Deleted:
                Debug.info('File Deleted: ' + event.uri);
                index.removeFile(Path.fromURI(event.uri));
                break;

            default:
                Debug.error('Unknown FileChangeType: ' + event.type);
                break;
        }
    });
});

// This handler provides the initial list of the completion items.
connection.onCompletion((textDocumentPosition: TextDocumentPositionParams): CompletionList =>
{
    var doc = documents.get(textDocumentPosition.textDocument.uri);
    var suggestionBuilder = new SuggestionBuilder();

    suggestionBuilder.prepare(textDocumentPosition, doc, index.tree);

    var toReturn: CompletionList = { isIncomplete: false, items: suggestionBuilder.build() };

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

var findNode: RequestType<{path:string}, any, any> = { method: "findNode" };
connection.onRequest(findNode, (requestObj) =>
{
    var node = index.getFileNode(requestObj.path);

    // connection.console.log(node);

});

/**
 * Finds all the symbols in a particular file
 */
var findFileDocumentSymbols: RequestType<{path:string}, any, any> = { method: "findFileDocumentSymbols" };
connection.onRequest(findFileDocumentSymbols, (requestObj) => {
    var node = index.getFileNode(requestObj.path);
    return { symbols: node.symbolCache };
});
// function getSymbolObject(node: any, query: string, path: string, usings: string[], parent: any = null): FileSymbolCache {
//     let symbol = null;
//     if (node.name == query) {
//         connection.console.log(usings);
//         if(parent !== null)
//             connection.console.log(parent.namespaceParts);
//         if (parent !== null && usings.indexOf(parent.namespaceParts.join('\\')) == -1) {
//             return null;
//         }
//         symbol = new FileSymbolCache();
//         symbol.kind = SymbolKind.Class;
//         symbol.startLine = node.startPos.line;
//         symbol.startChar = node.startPos.col;
//         symbol.endLine = node.endPos.line;
//         symbol.endChar = node.endPos.col;
//         symbol.path = path;
//         if (parent !== null) {
//             symbol.parentName = parent.name;
//         }
//     }
//     return symbol;
// }
/**
 * Finds all the symbols in the workspace
 */
var findWorkspaceSymbols: RequestType<{query:string,path:string}, any, any> = { method: "findWorkspaceSymbols" };
connection.onRequest(findWorkspaceSymbols, (requestObj) => {

    let query: string = requestObj.query;

    let symbols: FileSymbolCache[] = [];
    let usings: string[] = getFileUsings(requestObj.path);

    connection.console.log(query);

   index.tree.forEach(item => {
        // Search The interfaces
        item.interfaces.forEach(interfaceNode => {
            let ns: string = interfaceNode.namespaceParts.join('\\');
            if (interfaceNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                let symbol: FileSymbolCache = new FileSymbolCache();
                symbol.kind = SymbolKind.Class;
                symbol.startLine = interfaceNode.startPos.line;
                symbol.startChar = interfaceNode.startPos.col;
                symbol.endLine = interfaceNode.endPos.line;
                symbol.endChar = interfaceNode.endPos.col;
                symbol.path = item.path;
                symbols.push(symbol);
            }
            // Search the methods within the interface
            interfaceNode.methods.forEach(methodNode => {
                if (methodNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Method;
                    symbol.startLine = methodNode.startPos.line;
                    symbol.startChar = methodNode.startPos.col;
                    symbol.endLine = methodNode.endPos.line;
                    symbol.endChar = methodNode.endPos.col;
                    symbol.parentName = interfaceNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
            // Search the constants within the interface
            interfaceNode.constants.forEach(constNode => {
                if (constNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Constant;
                    symbol.startLine = constNode.startPos.line;
                    symbol.startChar = constNode.startPos.col;
                    symbol.endLine = constNode.endPos.line;
                    symbol.endChar = constNode.endPos.col;
                    symbol.parentName = interfaceNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
        });
        // Search the traits
        item.traits.forEach(traitNode => {
            let ns: string = traitNode.namespaceParts.join('\\');
            if (traitNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                let symbol: FileSymbolCache = new FileSymbolCache();
                symbol.kind = SymbolKind.Class;
                symbol.startLine = traitNode.startPos.line;
                symbol.startChar = traitNode.startPos.col;
                symbol.endLine = traitNode.endPos.line;
                symbol.endChar = traitNode.endPos.col;
                symbol.path = item.path;
                symbols.push(symbol);
            }
            // Search the methods within the traits
            traitNode.methods.forEach(methodNode => {
                if (methodNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Method;
                    symbol.startLine = methodNode.startPos.line;
                    symbol.startChar = methodNode.startPos.col;
                    symbol.endLine = methodNode.endPos.line;
                    symbol.endChar = methodNode.endPos.col;
                    symbol.parentName = traitNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
            // Search the properties within the traits
            traitNode.properties.forEach(propertyNode => {
                if (propertyNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Property;
                    symbol.startLine = propertyNode.startPos.line;
                    symbol.startChar = propertyNode.startPos.col;
                    symbol.endLine = propertyNode.endPos.line;
                    symbol.endChar = propertyNode.endPos.col;
                    symbol.parentName = traitNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
            // Search the constants within the trait
            traitNode.constants.forEach(constNode => {
                if (constNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Constant;
                    symbol.startLine = constNode.startPos.line;
                    symbol.startChar = constNode.startPos.col;
                    symbol.endLine = constNode.endPos.line;
                    symbol.endChar = constNode.endPos.col;
                    symbol.parentName = traitNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
        });
        // Search the classes
        item.classes.forEach(classNode => {
            let ns: string = classNode.namespaceParts.join('\\');
            if (classNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                let symbol: FileSymbolCache = new FileSymbolCache();
                symbol.kind = SymbolKind.Class;
                symbol.startLine = classNode.startPos.line;
                symbol.startChar = classNode.startPos.col;
                symbol.endLine = classNode.endPos.line;
                symbol.endChar = classNode.endPos.col;
                symbol.path = item.path;
                symbols.push(symbol);
            }
            // Search the methods within the classes
            classNode.methods.forEach(methodNode => {
                if (methodNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Method;
                    symbol.startLine = methodNode.startPos.line;
                    symbol.startChar = methodNode.startPos.col;
                    symbol.endLine = methodNode.endPos.line;
                    symbol.endChar = methodNode.endPos.col;
                    symbol.parentName = classNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
            // Search the properties within the classes
            classNode.properties.forEach(propertyNode => {
                if (propertyNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Property;
                    symbol.startLine = propertyNode.startPos.line;
                    symbol.startChar = propertyNode.startPos.col;
                    symbol.endLine = propertyNode.endPos.line;
                    symbol.endChar = propertyNode.endPos.col;
                    symbol.parentName = classNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
            // Search the constants within the class
            classNode.constants.forEach(constNode => {
                if (constNode.name == query && (usings.indexOf(ns) != -1 || usings.length == 0)) {
                    let symbol: FileSymbolCache = new FileSymbolCache();
                    symbol.kind = SymbolKind.Constant;
                    symbol.startLine = constNode.startPos.line;
                    symbol.startChar = constNode.startPos.col;
                    symbol.endLine = constNode.endPos.line;
                    symbol.endChar = constNode.endPos.col;
                    symbol.parentName = classNode.name;
                    symbol.path = item.path;
                    symbols.push(symbol);
                }
            });
        });
        item.functions.forEach(funcNode => {
            if (funcNode.name == query) {
                let symbol: FileSymbolCache = new FileSymbolCache();
                symbol.kind = SymbolKind.Function;
                symbol.startLine = funcNode.startPos.line;
                symbol.startChar = funcNode.startPos.col;
                symbol.endLine = funcNode.endPos.line;
                symbol.endChar = funcNode.endPos.col;
                symbol.path = item.path;
                symbols.push(symbol);
            }
        });
    });


    // var node = getFileNodeFromPath(requestObj.path);
    return { symbols: symbols };
});

/**
 * Finds the Usings in a file
 */
function getFileUsings(path: string): string[] {
    var node = index.getFileNode(path);

    var namespaces: string[] = [];
    node.classes.forEach(item => {
        let ns: string = item.namespaceParts.join('\\');
        if (ns.length > 0 && namespaces.indexOf(ns) == -1) {
            namespaces.push(ns);
        }
    });

    node.traits.forEach(item => {
        let ns: string = item.namespaceParts.join('\\');
        if (ns.length > 0 && namespaces.indexOf(ns) == -1) {
            namespaces.push(ns);
        }
    });

    node.namespaceUsings.forEach(item => {
        let ns: string = item.parents.join('\\');
        if (ns.length > 0 && namespaces.indexOf(ns) == -1) {
            namespaces.push(ns);
        }
    });

    return namespaces;
};

connection.listen();
