/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
'use strict';

import * as vscode from 'vscode';

/**
 * Show some logging information
 */
export function log(...args: any[]): void {
    console.log.apply(console, ['crane:', ...args]);
}