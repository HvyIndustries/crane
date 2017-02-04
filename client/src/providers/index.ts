/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
"use strict";

import * as vscode from 'vscode';
import Completion from './Completion';

export function activate(context: vscode.ExtensionContext)  {

    context.subscriptions.push(
        vscode.languages.registerCompletionItemProvider(
            'php', new Completion(), "$", ">", ":"
        )
    );

};