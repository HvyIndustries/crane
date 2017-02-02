/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import * as path from 'path';
import { window, workspace, Disposable, ExtensionContext, commands, FileSystemWatcher, TextDocument } from "vscode";
import { LanguageClient, LanguageClientOptions, SettingMonitor, ServerOptions, TransportKind, RequestType } from "vscode-languageclient";

import Crane from "./crane";

export function activate(context: ExtensionContext) {
    let serverModule = context.asAbsolutePath(path.join("server", "server.js"));
    let debugOptions = { execArgv: ["--nolazy", "--debug=6004"] };

    let serverOptions: ServerOptions = {
        run: { module: serverModule, transport: TransportKind.ipc },
        debug: { module: serverModule, transport: TransportKind.ipc, options: debugOptions }
    }

    let clientOptions: LanguageClientOptions = {
        documentSelector: ["php"],
        synchronize: {
            configurationSection: "crane",
            fileEvents: workspace.createFileSystemWatcher("**/.clientrc")
        }
    }

    // Create the language client and start the client.
    var langClient: LanguageClient = new LanguageClient("Crane Language Server", serverOptions, clientOptions);
    let disposable = langClient.start();

    let crane: Crane = new Crane(langClient);

    // Use this to handle a request sent from the server
    // https://github.com/Microsoft/vscode/blob/80bd73b5132268f68f624a86a7c3e56d2bbac662/extensions/json/client/src/jsonMain.ts
    // https://github.com/Microsoft/vscode/blob/580d19ab2e1fd6488c3e515e27fe03dceaefb819/extensions/json/server/src/server.ts
    //langClient.onRequest()

    context.subscriptions.push(commands.registerCommand('crane.rebuildSources', () => crane.rebuildProject()));
    context.subscriptions.push(commands.registerCommand('crane.deleteCaches', () => crane.deleteCaches()));

    context.subscriptions.push(disposable);
}
