/* --------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * ------------------------------------------------------------------------------------------ */
'use strict';

import * as path from 'path';

import { workspace, Disposable, ExtensionContext, commands } from 'vscode';
import { LanguageClient, LanguageClientOptions, SettingMonitor, ServerOptions, TransportKind } from 'vscode-languageclient';

import Crane from "./crane";
import QualityOfLife from "./features/qualityOfLife";

export function activate(context: ExtensionContext)
{
    let qol: QualityOfLife = new QualityOfLife();
    let crane: Crane = new Crane();

    crane.doInit();

    let serverModule = context.asAbsolutePath(path.join('server', 'server.js'));
    let debugOptions = { execArgv: ["--nolazy", "--debug=6004"] };

    let serverOptions: ServerOptions = {
        run : { module: serverModule, transport: TransportKind.ipc },
        debug: { module: serverModule, transport: TransportKind.ipc, options: debugOptions }
    }

    let clientOptions: LanguageClientOptions = {
        documentSelector: ['php'],
        synchronize: {
            configurationSection: 'languageServerExample',
            fileEvents: workspace.createFileSystemWatcher('**/.clientrc')
        }
    }

    // Create the language client and start the client.
    var langClient = new LanguageClient('Language Server Example', serverOptions, clientOptions);

    // Use this to handle a request sent from the server
    // https://github.com/Microsoft/vscode/blob/80bd73b5132268f68f624a86a7c3e56d2bbac662/extensions/json/client/src/jsonMain.ts
    // https://github.com/Microsoft/vscode/blob/580d19ab2e1fd6488c3e515e27fe03dceaefb819/extensions/json/server/src/server.ts
    //langClient.onRequest()

    let disposable = langClient.start();

    // Register commands for QoL improvements
    let duplicateLineCommand = commands.registerCommand('crane.duplicateLine', () => qol.duplicateLineOrSelection());

    context.subscriptions.push(disposable);
    context.subscriptions.push(duplicateLineCommand);
}
