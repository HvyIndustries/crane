/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { FileNode, SymbolCache } from "./hvy/treeBuilder";
import { Util } from "./hvy/util";

import { Hover, ITextDocument, TextDocumentPosition, Range, MarkedString, Definition, Location } from 'vscode-languageserver';

var fileUrl = require('file-url');

export class PhpDeclaration
{
    private util: Util = new Util();

    public findDefinition(document: ITextDocument, textDocumentPosition: TextDocumentPosition, tree: FileNode[], symbolCache: SymbolCache[]): Definition
    {
        // TODO -- Support for:
        //         - class name
        //         - trait name
        //         - interface name
        //         - top level function name
        //         - top level variable name
        //         - property
        //         - const
        //         - method
        //         - local variables

        var fileNode = tree.filter(item => {
            var uri = fileUrl(item.path);
            var positionUri = textDocumentPosition.uri.replace("%3A", ":");
            return uri == positionUri;
        })[0];

        var t = "";

        // // Get word under cursor
        // var selectedWord = this.util.getWordAtPosition(document.getText(), textDocumentPosition.position.line, textDocumentPosition.position.character);
        // selectedWord = selectedWord.replace(";", "");

        // if (this.util.findIndexes(selectedWord, "(").length == 1) {
        //     selectedWord = selectedWord.replace(/\(.*/gm, "");
        // }

        // // Lookup the word in the symbol cache. This will likely only match class/trait/interface names
        // var matches = symbolCache.filter(item => {
        //     // Search case insensitively
        //     return item.name.toLowerCase() == selectedWord.toLowerCase();
        // });

        // if (matches.length >= 1)
        // {
        //     var currentFileMatch = matches.filter(item => {
        //         var uri = fileUrl(item.file);
        //         return uri == textDocumentPosition.uri;
        //     })[0];

        //     if (currentFileMatch != null)
        //     {
        //         var uri = fileUrl(currentFileMatch.file);
        //         return this.returnLocation(uri, currentFileMatch.line, currentFileMatch.char);
        //     }
        //     else
        //     {
        //         var uri = fileUrl(matches[0].file);
        //         return this.returnLocation(uri, matches[0].line, matches[0].char);
        //     }
        // }
        // else
        // {
        //     // Detect if property, method or const belonging to $this, self:: or ClassName::
        // }

        return void 0;
    }

    private returnLocation(uri, line, char)
    {
        if (line == null || char == null) {
            return void 0;
        }

        return Location.create(uri, {
            start: {line: line - 1, character: char },
            end: {line: line - 1, character: char }
        });
    }
}
