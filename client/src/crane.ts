/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { Disposable, workspace, window, TextDocument, TextEditor, StatusBarAlignment, StatusBarItem } from 'vscode';
import { LanguageClient, RequestType, NotificationType } from 'vscode-languageclient';
import { ThrottledDelayer } from './utils/async';
import { Cranefs } from './utils/Cranefs';
import { Debug } from './utils/Debug';
import { Config } from './utils/Config';

const exec = require('child_process').exec;

let craneSettings = workspace.getConfiguration("crane");

const cranefs: Cranefs = new Cranefs();
console.log(process.platform)
export default class Crane
{
    public static langClient: LanguageClient;

    private disposable: Disposable;
    private delayers: { [key: string]: ThrottledDelayer<void> };

    public static statusBarItem: StatusBarItem;

    constructor(languageClient: LanguageClient) {
        Crane.langClient = languageClient;

        this.delayers = Object.create(null);

        let subscriptions: Disposable[] = [];

        workspace.onDidChangeTextDocument((e) => this.onChangeTextHandler(e.document), null, subscriptions);
        workspace.onDidCloseTextDocument((textDocument)=> { delete this.delayers[textDocument.uri.toString()]; }, null, subscriptions);
        workspace.onDidSaveTextDocument((document) => this.handleFileSave());

        this.disposable = Disposable.from(...subscriptions);

        if (!Crane.statusBarItem) {
            Crane.statusBarItem = window.createStatusBarItem(StatusBarAlignment.Left);
            Crane.statusBarItem.hide();
        }

        this.doInit();
    }

    public doInit() {
        console.log("Crane Initialised...");

        Crane.statusBarItem.text = "$(zap) Processing PHP source files...";
        Crane.statusBarItem.tooltip = "Crane is processing the PHP source files in your workspace to build code completion suggestions";
        Crane.statusBarItem.show();

        var serverDebugMessage: NotificationType<{ type: string, message: string }> = { method: "serverDebugMessage" };
        Crane.langClient.onNotification(serverDebugMessage, message => {
            switch (message.type) {
                case 'info': Debug.info(message.message); break;
                case 'error': Debug.error(message.message); break;
                case 'warning': Debug.warning(message.message); break;
                default: Debug.info(message.message); break;
            }
        });

        // Send request to server to build object tree for all workspace files
        this.processAllFilesInWorkspace();
    }

    public reportBug() {
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

    public handleFileSave() {
        var editor = window.activeTextEditor;
        if (editor == null) return;

        var document = editor.document;

        this.buildObjectTreeForDocument(document).then(() => {
            Crane.langClient.sendRequest({ method: 'saveTreeCache' }, { projectDir: cranefs.getProjectDir(), projectTree: cranefs.getTreePath() });
        });
    }

    public processAllFilesInWorkspace() {
        cranefs.createProjectDir().then(data => {
            var createTreeFile: boolean = false;
            // Folder was created so there is no tree cache
            if (data.folderCreated) {
                this.processWorkspaceFiles();
            } else {
                // Check for a tree file, if it exists load it;
                // otherwise we need to process the files in the workspace
                cranefs.doesProjectTreeExist().then(tree => {
                    if (!tree.exists) {
                        this.processWorkspaceFiles();
                    } else {
                        this.processProject();
                    }
                });
            }
        });
    }

    public rebuildProject() {
        cranefs.rebuildProject();
    }

    public downloadPHPLibraries() {
        cranefs.downloadPHPLibraries();
    }

    public processWorkspaceFiles() {
        cranefs.processWorkspaceFiles();
    }

    public processProject() {
        cranefs.processProject();
    }

    private onChangeTextHandler(textDocument: TextDocument) {
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
            var projectDir = cranefs.getProjectDir();
            var projectTree = cranefs.getTreePath();

            var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForDocument" };
            Crane.langClient.sendRequest(requestType, { path, text, projectDir, projectTree }).then(() => resolve() );
        });
    }

    dispose()
    {
        this.disposable.dispose();
        Crane.statusBarItem.dispose();
    }
}
