/* --------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * ------------------------------------------------------------------------------------------ */
'use strict';

import {
    IPCMessageReader, IPCMessageWriter,
    createConnection, IConnection, TextDocumentSyncKind,
    TextDocuments, ITextDocument, Diagnostic, DiagnosticSeverity,
    InitializeParams, InitializeResult, TextDocumentIdentifier,
    CompletionItem, CompletionItemKind, RequestType
} from 'vscode-languageserver';

import { TreeBuilder, FileNode } from "./hvy/treeBuilder";

var glob = require("glob")

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

// The content of a text document has changed. This event is fired
// when the text document first opened or when its content has changed.
documents.onDidChangeContent((change) =>
{
    validateTextDocument(change.document);
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
    documents.all().forEach(validateTextDocument);
});

function validateTextDocument(textDocument: ITextDocument): void
{
    let diagnostics: Diagnostic[] = [];
    let lines = textDocument.getText().split(/\r?\n/g);
    let problems = 0;
    for (var i = 0; i < lines.length && problems < maxNumberOfProblems; i++) {
        let line = lines[i];
        let index = line.indexOf('typescript');
        if (index >= 0) {
            problems++;
            diagnostics.push({
                severity: DiagnosticSeverity.Warning,
                range: {
                    start: { line: i, character: index},
                    end: { line: i, character: index + 10 }
                },
                message: `${line.substr(index, 10)} should be spelled TypeScript`
            });
        }
    }
    // Send the computed diagnostics to VSCode.
    connection.sendDiagnostics({ uri: textDocument.uri, diagnostics });
}

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
connection.onCompletion((textDocumentPosition: TextDocumentIdentifier): CompletionItem[] =>
{
    // The pass parameter contains the position of the text document in 
    // which code complete got requested. For the example we ignore this
    // info and always provide the same completion items.
    return [
        {
            label: 'TypeScript',
            kind: CompletionItemKind.Text,
            data: 1
        },
        {
            label: 'JavaScript',
            kind: CompletionItemKind.Text,
            data: 2
        }
    ]
});

// This handler resolve additional information for the item selected in
// the completion list.
connection.onCompletionResolve((item: CompletionItem): CompletionItem =>
{
    if (item.data === 1) {
        item.detail = 'TypeScript details',
        item.documentation = 'TypeScript documentation'
    } else if (item.data === 2) {
        item.detail = 'JavaScript details',
        item.documentation = 'JavaScript documentation'
    }
    return item;
});

var requestType: RequestType<any, any, any> = { method: "getFileProblems" };
connection.onRequest(requestType, (data) =>
{
    var filePath = data;
    // TODO -- Browse constructed object tree and find any problems in the selected file
    // TODO -- Return the problems as an object array => [{ line: 0, start: 0, end: 0, type: enum }]
    return "test";
});

var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForWorkspace" };
connection.onRequest(requestType, (data) =>
{
    // Load all files in workspace
    glob("/**/*.php", { cwd: workspaceRoot, root: workspaceRoot }, function (err, fileNames)
    {
        var docsToDo = fileNames;
        var docsDoneCount = 0;

        docsToDo.forEach(docPath =>
        {
            // TODO -- use nodejs file reader to get contents of each file
            //var contents = doc.getText();

            // this.treeBuilder.Parse(contents, path)
            //     .then(data => {
            //         addToWorkspaceTree(data.tree);

                    docsDoneCount++;

                    if (docsToDo.length == docsDoneCount)
                    {
                        return true;
                    }
            //     })
            //     .catch(error => {
            //         console.log(error);
            //         return false;
            //     });
        });
    });
});

function addToWorkspaceTree(tree:FileNode)
{
    // TODO -- Loop through existing filenodes and replace if exists, otherwise add
    workspaceTree.push(tree);

    console.log("Parsed file: " + tree.path);
}

/*
connection.onDidOpenTextDocument((params) => {
    // A text document got opened in VSCode.
    // params.uri uniquely identifies the document. For documents store on disk this is a file URI.
    // params.text the initial full content of the document.
    connection.console.log(`${params.uri} opened.`);
});

connection.onDidChangeTextDocument((params) => {
    // The content of a text document did change in VSCode.
    // params.uri uniquely identifies the document.
    // params.contentChanges describe the content changes to the document.
    connection.console.log(`${params.uri} changed: ${JSON.stringify(params.contentChanges)}`);
});

connection.onDidCloseTextDocument((params) => {
    // A text document got closed in VSCode.
    // params.uri uniquely identifies the document.
    connection.console.log(`${params.uri} closed.`);
});
*/

// Listen on the connection
connection.listen();
