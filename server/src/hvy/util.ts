/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { FileNode, ClassNode } from "./treeBuilder";

import {  } from 'vscode-languageserver';

export class Util
{
    public getWordAtOffset(text, offset)
    {
        // Perform type conversions.
        text = String(text);
        offset = Number(offset) >>> 0;

        // Search for the word's beginning and end.
        var left = text.slice(0, offset + 1).search(/\S+$/);
        var right = text.slice(offset).search(/\s/);

        // The last word in the string is a special case.
        if (right < 0) {
            return text.slice(left);
        }

        // Return the word, using the located bounds to extract it from the string.
        return text.slice(left, right + offset);
    }

    public getWordAtPosition(text, line, character)
    {
        // Perform type conversions.
        text = String(text);
        line = Number(line) >>> 0;
        character = Number(character) >>> 0;

        var lines = text.split(/\r\n|\r|\n/gm);

        return this.getWordAtOffset(lines[line], character);
    }

    public findIndexes(source, find) {
        var result = [];
        for (let i = 0; i < source.length; ++i) {
            // If you want to search case insensitive use 
            // if (source.substring(i, i + find.length).toLowerCase() == find) {
            if (source.substring(i, i + find.length) == find) {
            result.push(i);
            }
        }
        return result;
    }
}
