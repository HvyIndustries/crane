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
        return null;
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
        return null;
    }
}

// exports
export default Variables;
