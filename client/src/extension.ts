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
        documentSelector: ['.php'],
        synchronize: {
            configurationSection: 'languageServerExample',
            fileEvents: workspace.createFileSystemWatcher('**/.clientrc')
        }
    }

    // Create the language client and start the client.
    let disposable = new LanguageClient('Language Server Example', serverOptions, clientOptions).start();

    // Register commands for QoL improvements
    let duplicateLineCommand = commands.registerCommand('crane.duplicateLine', () => qol.duplicateLineOrSelection());

    context.subscriptions.push(disposable);
    context.subscriptions.push(duplicateLineCommand);
}
