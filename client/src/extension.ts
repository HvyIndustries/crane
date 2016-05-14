/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import * as path from "path";

import { workspace, Disposable, ExtensionContext, commands } from "vscode";
import { LanguageClient, LanguageClientOptions, SettingMonitor, ServerOptions, TransportKind, RequestType } from "vscode-languageclient";

import Crane from "./crane";
import QualityOfLife from "./features/qualityOfLife";
import { Debug } from './utils/Debug';

export function activate(context: ExtensionContext)
{
    let qol: QualityOfLife = new QualityOfLife();

    let serverModule = context.asAbsolutePath(path.join("server", "server.js"));
    let debugOptions = { execArgv: ["--nolazy", "--debug=6004"] };

    let serverOptions: ServerOptions = {
        run : { module: serverModule, transport: TransportKind.ipc },
        debug: { module: serverModule, transport: TransportKind.ipc, options: debugOptions }
    }

    let clientOptions: LanguageClientOptions = {
        documentSelector: ["php"],
        synchronize: {
            configurationSection: "languageServerExample",
            fileEvents: workspace.createFileSystemWatcher("**/.clientrc")
        }
    }

    // Create the language client and start the client.
    var langClient: LanguageClient = new LanguageClient("Crane Language Server", serverOptions, clientOptions);

    // Use this to handle a request sent from the server
    // https://github.com/Microsoft/vscode/blob/80bd73b5132268f68f624a86a7c3e56d2bbac662/extensions/json/client/src/jsonMain.ts
    // https://github.com/Microsoft/vscode/blob/580d19ab2e1fd6488c3e515e27fe03dceaefb819/extensions/json/server/src/server.ts
    //langClient.onRequest()

    let disposable = langClient.start();

    let crane: Crane = new Crane(langClient);

    var requestType: RequestType<{ treeSaved: boolean }, any, any> = { method: "workDone" };
    langClient.onRequest(requestType, (tree) => {
        Crane.statusBarItem.text = '$(check) Project Ready';
        // Load settings
        let craneSettings = workspace.getConfiguration("crane");
        if (tree.treeSaved) {
            Debug.info('Project tree has been saved');
        }
        Debug.info("Processing complete!");
        if (craneSettings) {
            var showStatusBarItem = craneSettings.get<boolean>("showStatusBarBugReportLink", true);
            if (showStatusBarItem) {
                setTimeout(() => {
                    Crane.statusBarItem.tooltip = "Found a problem with the PHP Intellisense provided by Crane? Click here to file a bug report on Github";
                    Crane.statusBarItem.text = "$(bug) Report PHP Intellisense Bug";
                    Crane.statusBarItem.command = "crane.reportBug";
                    Crane.statusBarItem.show();
                }, 5000);
            } else {
                Crane.statusBarItem.hide();
            }
        } else {
            Crane.statusBarItem.hide();
        }
    });

    // Register commands for QoL improvements
    let duplicateLineCommand = commands.registerCommand("crane.duplicateLine", qol.duplicateLineOrSelection);
    let reportBugCommand = commands.registerCommand("crane.reportBug", crane.reportBug);
    let rebuildSources = commands.registerCommand('crane.rebuildSources', () => {
        Debug.info('Rebuilding project sources');
        crane.processWorkspaceFiles();
    });

    context.subscriptions.push(rebuildSources);
    context.subscriptions.push(disposable);
    context.subscriptions.push(duplicateLineCommand);
}
