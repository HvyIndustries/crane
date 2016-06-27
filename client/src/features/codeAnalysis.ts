/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { Disposable } from 'vscode';

export default class PhpCodeAnalysis
{
    private disposable: Disposable;

    constructor() {
        
    }

    public AnalyseDocument(document) {
        // TODO -- Process the filenode for the document
    }

    public DisplayAnalysisForDocument(filenode) {
        // TODO -- Loop though code analysis array, adding new decorators as appropriate
    }
}