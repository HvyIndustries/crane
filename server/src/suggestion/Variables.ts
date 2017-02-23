/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import Context from '../util/Context';
import App from '../app';
import IFinder from './IFinder';
import { CompletionItem } from 'vscode-languageserver';

/**
 * Defines the structure of the extension settings
 */
class Variables implements IFinder {
    protected app:App;

    /**
     * Initialize a new instance
     */
    constructor(app:App) {
        this.app = app;
    }

    /**
     * Checks if finder can match
     */
    matches(context:Context): boolean {
        return true;
    }

    /**
     * Finds a list of completion items
     */
    find(context:Context) : CompletionItem[] {
        var result = [];
        var item = CompletionItem.create('$foo');
        item.kind = 1;
        result.push(item);
        return result;
    }
}

// exports
export default Variables;
