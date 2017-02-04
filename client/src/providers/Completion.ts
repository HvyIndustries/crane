/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */
'use strict';

import { CompletionItemProvider, CompletionItem, CompletionItemKind, CancellationToken, TextDocument, Position, Range, TextEdit } from 'vscode';

export default class PHPCompletionItemProvider implements CompletionItemProvider {
    public provideCompletionItems(document: TextDocument, position: Position, token: CancellationToken): Promise<CompletionItem[]> {
        let result:CompletionItem[] = [];
        var proposal: CompletionItem = new CompletionItem(
            "foo", CompletionItemKind.Class
        );
        var proposal: CompletionItem = new CompletionItem(
            "$foo", CompletionItemKind.Variable
        );
        result.push(proposal);
        return Promise.resolve(result);
    }
}