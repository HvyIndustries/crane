/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import * as path from "path";

import { workspace, Disposable, ExtensionContext, commands, FileSystemWatcher, TextDocument, languages } from "vscode";
import { LanguageClient, LanguageClientOptions, SettingMonitor, ServerOptions, TransportKind, RequestType } from "vscode-languageclient";

import Crane from "./crane";
import QualityOfLife from "./features/qualityOfLife";
import { Debug } from './utils/Debug';
import { Config } from './utils/Config';
// import { PHPReferenceProvider } from './providers/ReferenceProvider';
import { PHPDocumentSymbolProvider, PHPWorkspaceSymbolProvider } from './providers/SymbolProvider';
import { PHPDefinitionProvider } from './providers/DefinitionProvider';

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
        },
        initializationOptions: {
            enableCache: Config.enableCache
        }
    }

    // Create the language client and start the client.
    var langClient: LanguageClient = new LanguageClient("crane", "Crane Language Server", serverOptions, clientOptions);

    // Use this to handle a request sent from the server
    // https://github.com/Microsoft/vscode/blob/80bd73b5132268f68f624a86a7c3e56d2bbac662/extensions/json/client/src/jsonMain.ts
    // https://github.com/Microsoft/vscode/blob/580d19ab2e1fd6488c3e515e27fe03dceaefb819/extensions/json/server/src/server.ts
    //langClient.onRequest()

    let disposable = langClient.start();

    let crane: Crane = new Crane(langClient);

    // Register commands
    context.subscriptions.push(commands.registerCommand("crane.reportBug", crane.reportBug));
    context.subscriptions.push(commands.registerCommand('crane.rebuildSources', () => {
        Debug.clear();
        Debug.info('Re-indexing PHP files in the workspace...');
        crane.rebuildProject();
    }));
    context.subscriptions.push(commands.registerCommand('crane.deleteCaches', () => {
        Debug.clear();
        Debug.info('Deleting all PHP caches....');
        crane.deleteCaches();
    }));
    context.subscriptions.push(commands.registerCommand('crane.downloadPHPLibraries', () => {
        Debug.clear();
        Debug.info('Downloading PHP Library Stubs...');
        crane.downloadPHPLibraries();
    }));

    context.subscriptions.push(disposable);

    // Register providers
    // context.subscriptions.push(languages.registerReferenceProvider('php', new PHPReferenceProvider()));
    context.subscriptions.push(languages.registerDocumentSymbolProvider('php', new PHPDocumentSymbolProvider()));
    context.subscriptions.push(languages.registerWorkspaceSymbolProvider(new PHPWorkspaceSymbolProvider()));
    context.subscriptions.push(languages.registerDefinitionProvider('php', new PHPDefinitionProvider()));

}
