/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
import * as vscode from 'vscode';
import rebuildProject from './rebuildProject';
import cleanCache from './cleanCache';
import updateStubs from './updateStubs';

export default {
    "rebuildProject": rebuildProject,
    "cleanCache": cleanCache,
    "updateStubs": updateStubs
};