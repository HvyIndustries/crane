/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { DocumentSymbolParams, Location, Range, SymbolInformation, SymbolKind } from 'vscode-languageserver';
import { FileNode, BaseNode, PositionInfo } from "../hvy/nodes";
import { Namespaces } from "../util/namespaces";
import { Files } from "../util/Files";

const fs = require('fs');

export class DocumentSymbolProvider
{
    private positionInfo: DocumentSymbolParams;
    private tree: FileNode;

    constructor(positionInfo: DocumentSymbolParams, tree: FileNode)
    {
        this.positionInfo = positionInfo;
        this.tree = tree;
    }

    public findSymbols(): SymbolInformation | SymbolInformation[]
    {
        // Loop round current filenode
        return this.buildSymbolInformation();
    }

    private buildSymbolInformation(): SymbolInformation[]
    {
        var toReturn: SymbolInformation[] = [];

        this.tree.constants.forEach(constantItem => {
            toReturn.push(this.buildSymbol(constantItem, SymbolKind.Constant, null));
        });

        this.tree.functions.forEach(functionItem => {
            toReturn.push(this.buildSymbol(functionItem, SymbolKind.Function, null));
        });

        this.tree.topLevelVariables.forEach(variableItem => {
            toReturn.push(this.buildSymbol(variableItem, SymbolKind.Variable, null));
        });

        this.tree.namespaces.forEach(item => {
            toReturn.push(this.buildSymbol(item, SymbolKind.Namespace, null));
        });

        this.tree.classes.forEach(classItem => {
            toReturn.push(this.buildSymbol(classItem, SymbolKind.Class, classItem.namespace));
            this.buildClassTraitInterfaceBody(classItem, toReturn);
        });

        this.tree.traits.forEach(traitItem => {
            toReturn.push(this.buildSymbol(traitItem, SymbolKind.Class, traitItem.namespace));
            this.buildClassTraitInterfaceBody(traitItem, toReturn);
        });

        this.tree.interfaces.forEach(interfaceItem => {
            toReturn.push(this.buildSymbol(interfaceItem, SymbolKind.Interface, interfaceItem.namespace));
            this.buildClassTraitInterfaceBody(interfaceItem, toReturn);
        });

        return toReturn;
    }

    private buildClassTraitInterfaceBody(item, toReturn)
    {
        if (item.constants) {
            item.constants.forEach(constant => {
                toReturn.push(this.buildSymbol(constant, SymbolKind.Constant, item.name));
            });
        }

        if (item.properties) {
            item.properties.forEach(property => {
                toReturn.push(this.buildSymbol(property, SymbolKind.Property, item.name, "$" + property.name));
            });
        }

        if (item.methods) {
            item.methods.forEach(method => {
                toReturn.push(this.buildSymbol(method, SymbolKind.Method, item.name));
            });
        }

        if (item.construct) {
            toReturn.push(this.buildSymbol(item.construct, SymbolKind.Constructor, item.name));
        }
    }

    private buildSymbol(item: BaseNode, kind: SymbolKind, parent: string, name: string = null): SymbolInformation
    {
        if (!name) {
            name = item.name
        }

        return {
            name: name,
            containerName: parent,
            kind: kind,
            location: this.buildLocation(item.startPos, item.endPos)
        };
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

interface NodeInfo
{
    path: string;
    node: BaseNode;
}
