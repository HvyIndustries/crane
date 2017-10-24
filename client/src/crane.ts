/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import {
    Disposable, workspace, window, TextDocument,
    TextEditor, StatusBarAlignment, StatusBarItem,
    FileSystemWatcher
} from 'vscode';
import { LanguageClient, RequestType, NotificationType } from 'vscode-languageclient';
import { ThrottledDelayer } from './utils/async';
import { Cranefs } from './utils/Cranefs';
import { Debug } from './utils/Debug';
import { Config } from './utils/Config';

var open = require("open");
const util = require('util');

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

        this.checkVersion().then(indexTriggered => {
            this.doInit(indexTriggered);
        });
    }

    private checkVersion(): Thenable<boolean>
    {
        var self = this;
        Debug.info('Checking the current version of Crane');
        return new Promise((resolve, reject) => {
            cranefs.getVersionFile().then(result => {
                if (result.err && result.err.code == "ENOENT") {
                    // New install
                    window.showInformationMessage(`Welcome to Crane v${Config.version}.`, "Getting Started Guide").then(data => {
                        if (data != null) {
                            open("https://github.com/HvyIndustries/crane/wiki/end-user-guide#getting-started");
                        }
                    });
                    cranefs.createOrUpdateVersionFile(false);
                    cranefs.deleteAllCaches().then(item => {
                        self.processAllFilesInWorkspace();
                        resolve(true);
                    });
                } else {
                    // Strip newlines from data
                    result.data = result.data.replace("\n", "");
                    result.data = result.data.replace("\r", "");
                    if (result.data && result.data != Config.version) {
                        // Updated install
                        window.showInformationMessage(`You're been upgraded to Crane v${Config.version}.`, "View Release Notes").then(data => {
                            if (data == "View Release Notes") {
                                open("https://github.com/HvyIndustries/crane/releases");
                            }
                        });
                        cranefs.createOrUpdateVersionFile(true);
                        cranefs.deleteAllCaches().then(item => {
                            self.processAllFilesInWorkspace();
                            resolve(true);
                        });
                    } else {
                        resolve(false);
                    }
                }
            });
        });
    }

    public doInit(indexInProgress: boolean) {
        console.log("Crane Initialised...");

        this.showIndexingStatusBarMessage();

        var statusBarItem: StatusBarItem = window.createStatusBarItem(StatusBarAlignment.Right);
        statusBarItem.text = Config.version;
        statusBarItem.tooltip = 'Crane (PHP Code-completion) version ' + Config.version;

        if (Config.showStatusBarIcon){
            statusBarItem.show();
        }

        var serverDebugMessage: NotificationType<{ type: string, message: string }> = { method: "serverDebugMessage" };
        Crane.langClient.onNotification(serverDebugMessage, message => {
            switch (message.type) {
                case 'info': Debug.info(message.message); break;
                case 'error': Debug.error(message.message); break;
                case 'warning': Debug.warning(message.message); break;
                default: Debug.info(message.message); break;
            }
        });

        var requestType: RequestType<any, any, any> = { method: "workDone" };
        Crane.langClient.onRequest(requestType, (tree) => {
            // this.projectBuilding = false;
            Crane.statusBarItem.text = '$(check) PHP File Indexing Complete!';
            // Load settings
            let craneSettings = workspace.getConfiguration("crane");
            Debug.info("Processing complete!");
            if (Config.showBugReport) {
                setTimeout(() => {
                    Crane.statusBarItem.tooltip = "Found a problem with the PHP Intellisense provided by Crane? Click here to file a bug report on Github";
                    Crane.statusBarItem.text = "$(bug) Found a PHP Intellisense Bug?";
                    Crane.statusBarItem.command = "crane.reportBug";
                    Crane.statusBarItem.show();
                }, 5000);
            } else {
                Crane.statusBarItem.hide();
            }
        });

        var types = Config.phpFileTypes;
        Debug.info(`Watching these files: {${types.include.join(',')}}`);

        var fsw: FileSystemWatcher = workspace.createFileSystemWatcher(`{${types.include.join(',')}}`);
        fsw.onDidChange(e => {
            workspace.openTextDocument(e).then(document => {
                if (document.languageId != 'php') return;
                Debug.info('File Changed: ' + e.fsPath);
                Crane.langClient.sendRequest({ method: 'buildObjectTreeForDocument' }, {
                    path: e.fsPath,
                    text: document.getText()
                });
            });
        });
        fsw.onDidCreate(e => {
            workspace.openTextDocument(e).then(document => {
                if (document.languageId != 'php') return;
                Debug.info('File Created: ' + e.fsPath);
                Crane.langClient.sendRequest({ method: 'buildObjectTreeForDocument' }, {
                    path: e.fsPath,
                    text: document.getText()
                });
            });
        });
        fsw.onDidDelete(e => {
            Debug.info('File Deleted: ' + e.fsPath);
            Crane.langClient.sendRequest({ method: 'deleteFile' }, {
                path: e.fsPath
            });
        });

        if (!indexInProgress) {
            // Send request to server to build object tree for all workspace files
            this.processAllFilesInWorkspace();
        }
    }

    private showIndexingStatusBarMessage() {
        Crane.statusBarItem.text = "$(zap) Indexing PHP source files...";
        Crane.statusBarItem.tooltip = "Crane is processing the PHP source files in the workspace to build code completion suggestions";
        Crane.statusBarItem.show();
    }

    public reportBug() {
        open("https://github.com/HvyIndustries/crane/issues");
    }

    public handleFileSave() {
        var editor = window.activeTextEditor;
        if (editor == null) return;

        var document = editor.document;

        this.buildObjectTreeForDocument(document).then(() => {
            Crane.langClient.sendRequest({ method: 'saveTreeCache' }, { projectDir: cranefs.getProjectDir(), projectTree: cranefs.getTreePath() });
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
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
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }


    public deleteCaches() {
        var self = this;
        cranefs.deleteAllCaches().then(success => {
            window.showInformationMessage('All PHP file caches were successfully deleted');
            self.processAllFilesInWorkspace();
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
            delayer = new ThrottledDelayer<void>(500);
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
