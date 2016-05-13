/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { Disposable, workspace, window, TextDocument, TextEditor, StatusBarAlignment, StatusBarItem, OutputChannel } from 'vscode';
import { LanguageClient, RequestType, NotificationType } from 'vscode-languageclient';
import { ThrottledDelayer } from './utils/async';
import { Cranefs } from './cranefs';

const exec = require('child_process').exec;

let craneSettings = workspace.getConfiguration("crane");

const cranefs: Cranefs = new Cranefs();
const outputConsole: OutputChannel = window.createOutputChannel("Crane Console");

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

        this.statusBarItem.text = "$(zap) Processing PHP source files...";
        this.statusBarItem.tooltip = "Crane is processing the PHP source files in your workspace to build code completion suggestions";
        this.statusBarItem.show();

        cranefs.createProjectDir(workspace.rootPath);

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
        workspace.findFiles('**/.crane/tree', '').then(projectFile => {
            if (projectFile.length > 0) {
                console.log('Project File Found Loading File...');
                this.langClient.sendRequest({ method: "buildFromProject" });
            } else {
                this.processFiles();
            }
        });
    }

    public processFiles() {
        if (workspace.rootPath == undefined) return;

        var fileProcessCount = 0;

        // Find all the php files to process
        workspace.findFiles('**/*.php', '').then(files => {
            console.log(`Files to parse: ${files.length}`);

            Crane.debug(`[INFO] Preparing to parse ${files.length} PHP source files...`);

            fileProcessCount = files.length;
            var filePaths: string[] = [];

            // Get the objects path value for the current file system
            files.forEach(file => {
                filePaths.push(file.fsPath);
            });

            // Send the array of paths to the language server
            this.langClient.sendRequest({ method: "buildFromFiles" }, { files: filePaths });
        });

        // Update the UI so the user knows the processing status
        var fileProcessed: NotificationType<any> = { method: "fileProcessed" };
        this.langClient.onNotification(fileProcessed, data => {
            // Get the percent complete
            var percent: string = ((data.total / fileProcessCount) * 100).toFixed(2);
            this.statusBarItem.text = `$(zap) Processing source files (${data.total} of ${fileProcessCount} / ${percent}%)`;
            if (data.error) {
                Crane.debug("[ERROR] There was a problem parsing PHP file: " + data.filename);
                Crane.debug(`[ERROR] ${data.error}`);
            } else {
                Crane.debug(`[INFO] Parsed file ${data.total} of ${fileProcessCount} : ${data.filename}`);
            }

            // Once all files have been processed, update the statusBarItem
            if (data.total == fileProcessCount){
                Crane.debug("[INFO] Processing complete!");
                this.statusBarItem.text = '$(check) Processing of PHP source files complete';
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

    public static debug(message: string)
    {
        var debugMode: boolean = craneSettings ? craneSettings.get<boolean>("debugMode", false) : false;
        if (debugMode) {
            outputConsole.show();
            outputConsole.appendLine(message);
        }
    }

    dispose()
    {
        this.disposable.dispose();
        this.statusBarItem.dispose();
    }
}
