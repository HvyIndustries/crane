/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import {
    // not sure
    Diagnostic, DiagnosticSeverity,
    InitializeParams,  TextDocumentIdentifier,
    RequestType, Position,
    SignatureHelp, SignatureInformation, ParameterInformation,
    // used
    createConnection,
    IPCMessageReader,
    IPCMessageWriter,
    IConnection,
    TextDocuments,
    TextDocumentSyncKind,
    InitializeResult,
    FileChangeType,
    CompletionItem,
    CompletionItemKind,
    TextDocumentPositionParams
} from 'vscode-languageserver';

import App from './app';
import Message from './util/Message';
import Context from './util/Context';
import Autocomplete from './suggestion';
import cmdRefresh from './commands/Refresh';

let instance:App = null;

// Initialise the connection with the client
let connection: IConnection = createConnection(
    new IPCMessageReader(process),
    new IPCMessageWriter(process)
);

// creates the debug instance
let out:Message = new Message(connection);

// loads the workspace definition
let documents: TextDocuments = new TextDocuments();
documents.listen(connection);

/**
 * Here the application starts
 */
connection.onInitialize((params): InitializeResult => {
    out.status("Starting crane");

    instance = new App(params.rootPath, params.initializationOptions);
    instance.message = out;
    instance.autocomplete = Autocomplete(instance);
    // registers commands
    cmdRefresh(instance, connection);
    out.status("Crane extension is loaded");

    // automatically triggers errors
    instance.on('error', (e:any) => {
        out.error(typeof e === 'string' ? e : e.message);
        if (instance.settings.debugMode && e.stack) {
            out.trace(e.stack);
        }
    });

    // handle parsing progression
    let lastPercent = 0;
    instance.on('progress', (state) => {
        const percent = Math.round((state.loaded / state.total) * 100);
        if (lastPercent != percent) { // avoid hitting too much messages
            out.status(
                "Parsed "+state.loaded+" of "+state.total+" - "+percent+"%"
            );
            lastPercent = percent;
        }
    });

    // defines server capabilities
    return {
        capabilities: {
            textDocumentSync: documents.syncKind,
            completionProvider: {
                resolveProvider: true,
                triggerCharacters: [
                    '.', // "azerty" ^. $var
                    '+', // 1 ^+ $foo
                    '=', // $a ^= $b
                    ':', // self^::$var
                    '$', // ^$varname
                    '>', // $foo-^>property
                    '@', // ^@docblock || ^@triger_error()
                    '(', // if ^($test) || foo^($arg)
                    ' ', // triggered by any generic keyword like new
                    '\\' // triggered by a namespace classname
                ]
            }
        }
    }
});

/**
 * The settings have changed. This is sent on server activation as well.
 */
connection.onDidChangeConfiguration((change) => {
    if (instance) {
        instance.setSettings(change.settings);
        out.success(
            "Crane configuration changed as " + JSON.stringify(change.settings)
        );
    }
});

/**
 * Detected a change into the workspace
 */
connection.onDidChangeWatchedFiles((change) => {
    if (instance) {
        
        // workspace is ready to start
        change.changes.forEach(element => {
            // resolves the filename
            let filename:String = instance.resolveUri(element.uri);
            // add a new file to the parser cache
            if (element.type === FileChangeType.Created) {
                instance.workspace.parse(filename)
                    .catch(e => {
                        out.error(e.message);
                        if (instance.settings.debugMode) {
                            out.trace(e.stack);
                        }
                    });
            }
            // refresh the cache with the file changes
            else if (element.type === FileChangeType.Changed) {
                instance.workspace.parse(filename)
                    .catch(e => {
                        out.error(e.message);
                        if (instance.settings.debugMode) {
                            out.trace(e.stack);
                        }
                    });
            }
            // removes the file from the cache
            else if (element.type === FileChangeType.Deleted) {
                instance.workspace.removeFile(filename);
            }
        });
    }
});

/**
 * This handler provides the initial list of the completion items.
 */
connection.onCompletion(
    (where: TextDocumentPositionParams) : Thenable<CompletionItem[]> => {
    
    if (!instance) return;
    const doc = documents.get(where.textDocument.uri);
    if (doc.languageId != "php") return;

    var offset = doc.offsetAt(where.position);

    return new Promise(function(done, reject) {
        var context = new Context(doc.getText(), offset);
        context.resolve(
            instance,
            instance.resolveUri(doc.uri),
            offset
        ).then(function() {
            instance.autocomplete(context).then(done, reject);
        }, reject);
    });
});

connection.onCompletionResolve((item: CompletionItem): CompletionItem => {
    // TODO -- Add phpDoc info
    item.detail = "extra info here";
    return item;
});

connection.listen();
