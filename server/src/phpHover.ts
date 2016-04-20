/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { FileNode, ClassNode } from "./hvy/treeBuilder";

import { Hover, ITextDocument, TextDocumentPosition, Range, MarkedString } from 'vscode-languageserver';

export class PhpHover
{
    public doHover(document: ITextDocument, textDocumentPosition: TextDocumentPosition, tree: FileNode[]): Hover
    {
        let offset = document.offsetAt(textDocumentPosition.position);

        // TODO -- Check we're hovering on a class, interface, trait, function, property
        // TODO -- Return info in a style similar to VS/ReSharper does
        // TODO -- Class instance variables

        var position = textDocumentPosition.position;

        var createHover = (contents: MarkedString[]) => {
            let range = Range.create(document.positionAt(0), document.positionAt(0));
            let result: Hover = {
                contents: contents
            };
            return result;
        };

        return createHover(["**test**"]);

        // let location = node.getNodeLocation();
        // for (let i = this.contributions.length - 1; i >= 0; i--) {
        //     let contribution = this.contributions[i];
        //     let promise = contribution.getInfoContribution(textDocumentPosition.uri, location);
        //     if (promise) {
        //         return promise.then(htmlContent => createHover(htmlContent));
        //     }
        // }

        // return this.schemaService.getSchemaForResource(textDocumentPosition.uri, doc).then((schema) => {
        //     if (schema) {
        //         let matchingSchemas: Parser.IApplicableSchema[] = [];
        //         doc.validate(schema.schema, matchingSchemas, node.start);

        //         let description: string = null;
        //         matchingSchemas.every((s) => {
        //             if (s.node === node && !s.inverted && s.schema) {
        //                 description = description || s.schema.description;
        //             }
        //             return true;
        //         });
        //         if (description) {
        //             return createHover([description]);
        //         }
        //     }
        //     return void 0;
        // });
    }
}