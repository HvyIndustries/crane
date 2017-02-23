/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
'use strict';

import * as path from 'path';
import { LanguageClient, TransportKind } from "vscode-languageclient";
import * as vscode from 'vscode';
import * as nls from 'vscode-nls';
const localize = nls.config()();

export function activate(context: vscode.ExtensionContext) {

    // Create the language client and start the client.
    console.log('start the language client');

    let serverModule = context.asAbsolutePath(path.join("server", "server.js"));
    let debugOptions = { execArgv: ["--nolazy", "--debug=6004"] };

    var client: LanguageClient = new LanguageClient(
        localize('crane.name', "Crane Language Server"),
        // Server options
        {
            run: { 
                module: serverModule, 
                transport: TransportKind.ipc 
            },
            debug: { 
                module: serverModule, 
                transport: TransportKind.ipc, 
                options: debugOptions 
            }
        }, 
        // Client options
        {
            documentSelector: ["php"],
            synchronize: {
                configurationSection: "crane",
                fileEvents: vscode.workspace.createFileSystemWatcher(
                    "**/*.{php,phtml,php5,php4,inc,req}"
                )
            }
        },
        true
    );

    console.log('...');

    client.onReady().then(function() {
        console.log('Crane is Ready');
    }).catch(function(e) {
        console.error('FATAL ERROR / Unable to start server\n\n' + e.stack);
    });

}
