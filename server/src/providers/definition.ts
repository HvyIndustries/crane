/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { TextDocumentPositionParams, Location, Range } from 'vscode-languageserver';
import { FileNode, BaseNode } from "../hvy/nodes";
import { Namespaces } from "../util/Namespaces";
import { Files } from "../util/Files";

const fs = require('fs');

export class DefinitionProvider
{
    private positionInfo: TextDocumentPositionParams;
    private path: string;
    private tree: FileNode;
    private workspaceTree: FileNode[];

    constructor(positionInfo: TextDocumentPositionParams, path: string, tree: FileNode, workspaceTree: FileNode[])
    {
        this.positionInfo = positionInfo;
        this.path = path;
        this.tree = tree;
        this.workspaceTree = workspaceTree;
    }

    public findDefinition(): Location | Location[]
    {
        let word = this.getWordAtPosition();
        if (word == "" || word == null) {
            return null;
        }

        var results: Location[] = [];

        if (word.indexOf("\\") > -1 && word.charAt(0) != "\\") {
            word = "\\" + word;
        }

        // Get FQN of class under caret
        let fqn = Namespaces.getFQNFromClassname(word, this.tree);
        let classInfo = Namespaces.getNamespaceInfoFromFQNClassname(fqn);

        // Search all classes (+ namespace) for provided FQN
        let nodes: NodeInfo[] = this.findTopLevelSymbols(classInfo);

        // Convert nodes into locations
        results = this.convertNodesIntoLocations(nodes);

        return results;
    }

    private getWordAtPosition(): string
    {
        // TODO -- find a way to read the text from vscode, instead of from the file
        // this will allow unsaved edits to work here
        var text:string = fs.readFileSync(this.path, { encoding: 'utf8' });
        var lines = text.split(/\r\n|\r|\n/gm);

        let lineNum = this.positionInfo.position.line;
        let charNum = this.positionInfo.position.character;

        var line = lines[lineNum];

        // Handle situation where file has not been saved
        if (line == null) {
            return null;
        }

        var lineStart = line.substring(0, charNum);
        var lineEnd = line.substr(charNum, line.length);

        let startResult = this.stepBackward(lineStart);
        let endResult = this.stepForward(lineEnd);

        return startResult + endResult;
    }

    private stepForward(line)
    {
        let string = "";

        for (var i = 0; i < line.length; i++) {
            var char = line[i];
            if (/\w/.test(char) || char == "\\") {
                string += char;
            } else {
                i = line.length;
            }
        }

        return string;
    }

    private stepBackward(line)
    {
        let string = "";

        for (var i = (line.length - 1); i > -1; i--) {
            var char = line[i];
            if (/\w/.test(char) || char == "\\" || char == "$" || char == ">" || char == ":") {
                string = char + string;
            } else {
                i = -1;
            }
        }

        return string;
    }

    private findTopLevelSymbols(classInfo)
    {
        var namespace = classInfo.namespace;
        var rawClassname = classInfo.classname

        var toReturn = [];

        for (var i = 0, l = this.workspaceTree.length; i < l; i++) {
            var filenode = this.workspaceTree[i];

            for (var j = 0, sl = filenode.classes.length; j < sl; j++) {
                var classNode = filenode.classes[j];
                if (
                    classNode.name.toLowerCase() == rawClassname.toLowerCase()
                    && classNode.namespace == namespace
                ) {
                    let nodeInfo: NodeInfo = {
                        node: classNode,
                        path: filenode.path
                    };

                    toReturn.push(nodeInfo);
                }
            }

            for (var j = 0, sl = filenode.traits.length; j < sl; j++) {
                var traitNode = filenode.traits[j];
                if (
                    traitNode.name.toLowerCase() == rawClassname.toLowerCase()
                    && traitNode.namespace == namespace
                ) {
                    let nodeInfo: NodeInfo = {
                        node: traitNode,
                        path: filenode.path
                    };

                    toReturn.push(nodeInfo);
                }
            }

            for (var j = 0, sl = filenode.interfaces.length; j < sl; j++) {
                var interfaceNode = filenode.interfaces[j];
                if (
                    interfaceNode.name.toLowerCase() == rawClassname.toLowerCase()
                    && interfaceNode.namespace == namespace
                ) {
                    let nodeInfo: NodeInfo = {
                        node: interfaceNode,
                        path: filenode.path
                    };

                    toReturn.push(nodeInfo);
                }
            }
        }

        return toReturn;
    }

    private convertNodesIntoLocations(nodes: NodeInfo[]): Location[]
    {
        var toReturn: Location[] = [];

        for (var i = 0, l = nodes.length; i < l; i++) {
            var item = nodes[i];

            let location: Location = {
                uri: Files.getUriFromPath(item.path),
                range: {
                    start: {
                        line: item.node.startPos.line,
                        character: item.node.startPos.col
                    },
                    end: {
                        line: item.node.startPos.line,
                        character: item.node.startPos.col
                    }
                }
            };

            toReturn.push(location);
        }

        return toReturn;
    }
}

interface NodeInfo
{
    path: string;
    node: BaseNode;
}
