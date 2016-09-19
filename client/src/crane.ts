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
import { Debug } from './utils/Debug';
import { Config } from './utils/Config';

var open = require("open");
const util = require('util');

let craneSettings = workspace.getConfiguration("crane");

console.log(process.platform)
export default class Crane
{
    public static langClient: LanguageClient;

    public static statusBarItem: StatusBarItem;

    constructor(languageClient: LanguageClient) {
        console.log("Crane Initialised...");

        Crane.langClient = languageClient;

        if (!Crane.statusBarItem) {
            Crane.statusBarItem = window.createStatusBarItem(StatusBarAlignment.Left);
            Crane.statusBarItem.hide();
        }

        this.showIndexingStatusBarMessage();

        var statusBarItem: StatusBarItem = window.createStatusBarItem(StatusBarAlignment.Right);
        statusBarItem.text = Config.version;
        statusBarItem.tooltip = 'Crane (PHP Code-completion) version ' + Config.version;
        statusBarItem.show();

        var serverDebugMessage: NotificationType<{ type: string, message: string }> = { method: "serverDebugMessage" };
        Crane.langClient.onNotification(serverDebugMessage, message => {
            switch (message.type) {
                case 'info': Debug.info(message.message); break;
                case 'error': Debug.error(message.message); break;
                case 'warning': Debug.warning(message.message); break;
                default: Debug.info(message.message); break;
            }
        });

        var openBrowserMessage: NotificationType<{ url: string }> = { method: "window/openBrowser" };
        Crane.langClient.onNotification(openBrowserMessage, message => {
            open(message.url);
        });

        // Update the UI so the user knows the processing status
        var fileProcessed: NotificationType<{ filename: string, count: number, total: number, error: any }> = { method: "index/fileProcessed" };
        Crane.langClient.onNotification(fileProcessed, data => {
            // Get the percent complete
            var percent: string = ((data.count / data.total) * 100).toFixed(1);
            Crane.statusBarItem.text = `$(zap) Indexing PHP files (${data.count} of ${data.total} / ${percent}%)`;
            if (data.error) {
                Debug.error("There was a problem parsing PHP file: " + data.filename);
                Debug.error(`${data.error}`);
            } else {
                Debug.info(`Parsed file ${data.count} of ${data.total} : ${data.filename}`);
            }
        });

        var requestType: RequestType<any, any, any> = { method: "index/workDone" };
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
        fsw.onDidCreate(e => {
            Crane.langClient.notifyFileEvent({ uri: e.fsPath, type: 1});
        });
        fsw.onDidChange(e => {
            Crane.langClient.notifyFileEvent({ uri: e.fsPath, type: 2});
        });
        fsw.onDidDelete(e => {
            Crane.langClient.notifyFileEvent({ uri: e.fsPath, type: 3});
        });
    }

    private showIndexingStatusBarMessage() {
        Crane.statusBarItem.text = "$(zap) Indexing PHP source files...";
        Crane.statusBarItem.tooltip = "Crane is processing the PHP source files in the workspace to build code completion suggestions";
        Crane.statusBarItem.show();
    }

    public reportBug() {
        open("https://github.com/HvyIndustries/crane/issues");
    }

    public deleteCaches() {
        Crane.langClient.sendRequest({ method: "index/deleteAllCaches" }, {});
    }

    public rebuildProject() {
        Crane.langClient.sendRequest({ method: "index/rebuild" }, {});
    }

    public downloadPHPLibraries() {
        Crane.langClient.sendRequest({ method: "index/downloadStubs" }, { url: Config.phpstubsZipFile });
    }

    dispose() {
        Crane.statusBarItem.dispose();
    }
}
