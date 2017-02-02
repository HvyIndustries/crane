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

let craneSettings = workspace.getConfiguration("crane");

console.log(process.platform)

export default class Crane
{
    public static langClient: LanguageClient;

    private disposable: Disposable;
    //private delayers: { [key: string]: ThrottledDelayer<void> };

    constructor(languageClient: LanguageClient) {
        Crane.langClient = languageClient;

        //this.delayers = Object.create(null);

        let subscriptions: Disposable[] = [];

        workspace.onDidChangeTextDocument((e) => this.onChangeTextHandler(e.document), null, subscriptions);
        //workspace.onDidCloseTextDocument((textDocument)=> { delete this.delayers[textDocument.uri.toString()]; }, null, subscriptions);
        workspace.onDidSaveTextDocument((document) => this.handleFileSave());

        this.disposable = Disposable.from(...subscriptions);

        this.doInit();
    }

    public doInit() {
        console.log("Crane Initialised...");
    }

    public handleFileSave() {
        console.log("file saved");
    }

    public deleteCaches() {
        console.log("delete caches");
    }

    public rebuildProject() {
        console.log("rebuild caches");
    }

    private onChangeTextHandler(textDocument: TextDocument) {
        // Only parse PHP files
        if (textDocument.languageId != "php") return;

        console.log("file changed");
    }

    dispose()
    {
        this.disposable.dispose();
    }
}
