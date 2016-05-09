/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { Disposable, workspace, window, TextDocument, TextEditor, StatusBarAlignment, StatusBarItem } from 'vscode';
import { LanguageClient, RequestType, NotificationType } from 'vscode-languageclient';
import { ThrottledDelayer } from './utils/async';

const exec = require('child_process').exec;

export default class Crane
{
    public langClient: LanguageClient;

    private disposable: Disposable;
    private delayers: { [key: string]: ThrottledDelayer<void> };

    public statusBarItem: StatusBarItem;

    constructor(languageClient: LanguageClient)
    {
        this.langClient = languageClient;

        this.delayers = Object.create(null);

        let subscriptions: Disposable[] = [];

        workspace.onDidChangeTextDocument((e) => this.onChangeTextHandler(e.document), null, subscriptions);
        workspace.onDidCloseTextDocument((textDocument)=> { delete this.delayers[textDocument.uri.toString()]; }, null, subscriptions);
        workspace.onDidSaveTextDocument((document) => this.handleFileSave());

        this.disposable = Disposable.from(...subscriptions);

        if (!this.statusBarItem) {
            this.statusBarItem = window.createStatusBarItem(StatusBarAlignment.Left);
            this.statusBarItem.hide();
        }

        this.doInit();
    }

    public doInit()
    {
        console.log("Crane Initialised...");

        this.statusBarItem.text = "$(zap) Processing source files...";
        this.statusBarItem.tooltip = "Crane is processing the PHP source files in your workspace to build code completion suggestions";
        this.statusBarItem.show();

        // Send request to server to build object tree for all workspace files
        this.processAllFilesInWorkspace();
    }

    public reportBug()
    {
        let openCommand: string;

        switch (process.platform) {
            case 'darwin':
                openCommand = 'open ';
                break;
            case 'win32':
                openCommand = 'start ';
                break;
            default:
                return;
        }

        exec(openCommand + "https://github.com/HvyIndustries/crane/issues");
    }

    public handleFileSave()
    {
        var editor = window.activeTextEditor;
        if (editor == null) return;

        var document = editor.document;

        this.buildObjectTreeForDocument(document);
    }

    private processAllFilesInWorkspace()
    {
        var fileProcessCount = 0;
        workspace.findFiles('**/*.php', '').then(files => {
            console.log(`Files to parse: ${files.length}`);
            fileProcessCount = files.length;
            var paths: string[] = [];
            var i = 0;
            files.forEach(file => {
                paths.push(file.fsPath);
            });
            this.langClient.sendRequest({ method: "buildFromFiles" }, {files: paths});
        });
        var fileProcessed: NotificationType<any> = { method: "fileProcessed" };
        this.langClient.onNotification(fileProcessed, data => {
            var percent:string = ((data.total / fileProcessCount) * 100).toFixed(2);
            this.statusBarItem.text = `$(zap) Processing source files (${data.total} of ${fileProcessCount} / ${percent}%)`;
            if(data.total == fileProcessCount){
                this.statusBarItem.text = 'File Processing Complete';
            }
        });
    }

    private onChangeTextHandler(textDocument: TextDocument)
    {
        // Only parse PHP files
        if (textDocument.languageId != "php") return;

        let key = textDocument.uri.toString();
        let delayer = this.delayers[key];

        if (!delayer) {
            delayer = new ThrottledDelayer<void>(250);
            this.delayers[key] = delayer;
        }

        delayer.trigger(() => this.buildObjectTreeForDocument(textDocument));
    }

    private buildObjectTreeForDocument(document: TextDocument): Promise<void>
    {
        return new Promise<void>((resolve, reject) => {
            var path = document.fileName;
            var text = document.getText();

            var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForDocument" };
            this.langClient.sendRequest(requestType, { path, text }).then(() => resolve() );
        });
    }

    dispose()
    {
        this.disposable.dispose();
        this.statusBarItem.dispose();
    }
}
