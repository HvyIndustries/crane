/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { SymbolInformation } from 'vscode-languageserver';
import { FileNode } from "../hvy/nodes";
import { DocumentSymbolProvider } from "./documentSymbol";

const fs = require('fs');

export class WorkspaceSymbolProvider
{
    private workspaceTree: FileNode[];
    private query: string;

    constructor(workspaceTree: FileNode[], query: string)
    {
        this.workspaceTree = workspaceTree;
        this.query = query;
    }

    public findSymbols(): SymbolInformation[]
    {
        var symbols: SymbolInformation[] = [];

        // Execute document symbol provider against every file in the tree
        for (var i = 0, l = this.workspaceTree.length; i < l; i++) {
            var fileNode = this.workspaceTree[i];

            let documentSymbolProvider = new DocumentSymbolProvider(fileNode, this.query);
            let fileSymbols = documentSymbolProvider.findSymbols();
            symbols = symbols.concat(fileSymbols);
        }

        return symbols;
    }
}
