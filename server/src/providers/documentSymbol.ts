/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { Location, SymbolInformation, SymbolKind } from 'vscode-languageserver';
import { FileNode, BaseNode, PositionInfo } from "../hvy/nodes";
import { Files } from "../util/Files";

const fs = require('fs');

export class DocumentSymbolProvider
{
    private tree: FileNode;
    private query: string;

    constructor(tree: FileNode, query: string = null)
    {
        if (query == "") {
            query = null;
        }

        if (query != null) {
            query = query.toLowerCase();
        }

        this.query = query;
        this.tree = tree;
    }

    public findSymbols(): SymbolInformation[]
    {
        // Loop round current filenode
        return this.buildSymbolInformation();
    }

    private buildSymbolInformation(): SymbolInformation[]
    {
        var toReturn: SymbolInformation[] = [];

        for (let i = 0, l = this.tree.functions.length; i < l; i++) {
            var functionItem = this.tree.functions[i];
            this.addSymbol(toReturn, functionItem, SymbolKind.Function, null);
        }

        for (let i = 0, l = this.tree.namespaces.length; i < l; i++) {
            var item = this.tree.namespaces[i];
            this.addSymbol(toReturn, item, SymbolKind.Namespace, null);
        }

        for (let i = 0, l = this.tree.classes.length; i < l; i++) {
            var classItem = this.tree.classes[i];
            this.addSymbol(toReturn, classItem, SymbolKind.Class, classItem.namespace);
            this.buildClassTraitInterfaceBody(classItem, toReturn);
        }

        for (let i = 0, l = this.tree.traits.length; i < l; i++) {
            var traitItem = this.tree.traits[i];
            this.addSymbol(toReturn, traitItem, SymbolKind.Class, traitItem.namespace);
            this.buildClassTraitInterfaceBody(traitItem, toReturn);
        }

        for (let i = 0, l = this.tree.interfaces.length; i < l; i++) {
            var interfaceItem = this.tree.interfaces[i];
            this.addSymbol(toReturn, interfaceItem, SymbolKind.Interface, interfaceItem.namespace);
            this.buildClassTraitInterfaceBody(interfaceItem, toReturn);
        }

        return toReturn;
    }

    private buildClassTraitInterfaceBody(item, toReturn)
    {
        if (item.constants) {
            for (let i = 0, l = item.constants.length; i < l; i++) {
                var constant = item.constants[i];
                this.addSymbol(toReturn, constant, SymbolKind.Constant, item.name);
            }
        }

        if (item.properties) {
            for (let i = 0, l = item.properties.length; i < l; i++) {
                var property = item.properties[i];
                this.addSymbol(toReturn, property, SymbolKind.Property, item.name, "$" + property.name);
            }
        }

        if (item.methods) {
            for (let i = 0, l = item.methods.length; i < l; i++) {
                var method = item.methods[i];
                this.addSymbol(toReturn, method, SymbolKind.Method, item.name);
            }
        }

        if (item.construct) {
            this.addSymbol(toReturn, item.construct, SymbolKind.Constructor, item.name);
        }
    }

    private queryMatch(name: string)
    {
        if (this.query == null) {
            return true;
        }

        name = name.toLowerCase();

        if (name == this.query || name.indexOf(this.query) > -1) {
            return true;
        }

        // Support fuzzy searching
        // If the name contains all of the chars in the query, also return true
        let nameChars = name.split("");
        let queryChars = this.query.split("");

        // Note the "!" to reverse the result of some()
        // some() will return true if a query char is not found in the name
        let matchFound = !queryChars.some(char => {
            return nameChars.indexOf(char) == -1;
        });

        return matchFound;
    }

    private addSymbol(toReturn:SymbolInformation[], item: BaseNode, kind: SymbolKind, parent: string, name: string = null)
    {
        if (!name) {
            name = item.name
        }

        if (!this.queryMatch(name)) {
            return;
        }

        toReturn.push({
            name: name,
            containerName: parent,
            kind: kind,
            location: this.buildLocation(item.startPos, item.endPos)
        });
    }

    private buildLocation(startPos: PositionInfo, endPos: PositionInfo): Location
    {
        // Handle rare cases where there is no end position
        if (endPos == null) {
            endPos = startPos;
        }

        return {
            uri: Files.getUriFromPath(this.tree.path),
            range: {
                start: {
                    line: startPos.line,
                    character: startPos.col
                },
                end: {
                    line: endPos.line,
                    character: endPos.col
                }
            }
        };
    }
}
