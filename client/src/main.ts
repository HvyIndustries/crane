/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
'use strict';

import * as path from 'path';
import {
    LanguageClient, 
    LanguageClientOptions, 
    SettingMonitor, 
    ServerOptions, 
    TransportKind, 
    RequestType
} from "vscode-languageclient";
import * as vscode from 'vscode';
import * as nls from 'vscode-nls';

import * as utils from './utils';
import commands from './commands';
import notifications from './notifications';
import * as providers from './providers';

const localize = nls.config()();

// import Crane from "./crane";

export function activate(context: vscode.ExtensionContext) {

    // Create the language client and start the client.
    utils.log('start the language client');

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
        }
    );

    client.onReady().then(function() {
        utils.log('registering notifications');
        for(let name in notifications) {
            notifications[name].activate(client);
        }
    }).catch(function(e) {
        utils.log('FATAL ERROR / Unable to start server\n\n' + e.stack);
    });
    
    context.subscriptions.push(client.start());

    utils.log('registering commands');
    for(let name in commands) {
        context.subscriptions.push(
            vscode.commands.registerCommand(
                'crane.' + name, () => commands[name]
            )
        );
    }

    utils.log('registering providers');
    providers.activate(context);

}
