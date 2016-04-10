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

    var requestType: RequestType<any, any, any> = { method: "workDone" };
    langClient.onRequest(requestType, () => {
        // Load settings
        let craneSettings = workspace.getConfiguration("crane");
        if (craneSettings) {
            var showStatusBarItem = craneSettings.get<boolean>("showStatusBarBugReportLink", true);
            if (showStatusBarItem) {
                crane.statusBarItem.text = "$(bug) Report PHP Intellisense Bug";
                crane.statusBarItem.tooltip = "Found a problem with the PHP Intellisense provided by Crane? Click here to file a bug report on Github";
                crane.statusBarItem.command = "crane.reportBug";
                crane.statusBarItem.show();
            } else {
                crane.statusBarItem.hide();
            }
        } else {
            crane.statusBarItem.hide();
        }
    });

    // Register commands for QoL improvements
    let duplicateLineCommand = commands.registerCommand("crane.duplicateLine", qol.duplicateLineOrSelection);
    let reportBugCommand = commands.registerCommand("crane.reportBug", crane.reportBug);
    let semiColonCommand = commands.registerCommand("crane.handleSemiColonPress", () => crane.handleKeypress(";"));
    let curlyBraceCommand = commands.registerCommand("crane.handleClosingCurlyBracePress", () => crane.handleKeypress("}"));
    let bracketCommand = commands.registerCommand("crane.handleClosingBracketPress", () => crane.handleKeypress(")"));

    context.subscriptions.push(disposable);
    context.subscriptions.push(duplicateLineCommand);
    context.subscriptions.push(semiColonCommand);
    context.subscriptions.push(curlyBraceCommand);
    context.subscriptions.push(bracketCommand);
}
