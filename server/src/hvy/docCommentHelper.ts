/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { DocComment, PositionInfo, DocCommentParam } from "./nodes";
import { Namespaces } from "../util/namespaces";

const docParser = require("doc-parser");
var docReader = new docParser();

export class DocCommentHelper
{
    private scalarTypes = ["bool", "boolean", "int", "integer", "float", "number", "string", "array", "null", "void"];

    public buildDocCommentFromBranch(branch, tree): DocComment
    {
        // TODO -- handle {@inheritDoc}
        var rawParsedComment = docReader.parse(branch.lines);

        var docComment = new DocComment(rawParsedComment.summary);
        docComment.startPos = this.buildPosition(branch.loc.start);
        docComment.endPos = this.buildPosition(branch.loc.end);

        if (rawParsedComment.body) {
            rawParsedComment.body.forEach(item => {
                if (item.kind) {
                    switch (item.kind) {
                        case "block":
                            if (item.name == "var" && item.options) {
                                var typeName = "";
                                item.options.forEach(namePart => {
                                    typeName += "\\" + namePart.value;
                                });
                                if (typeName != "" && typeName.charAt(0) == "\\") {
                                    typeName = typeName.substring(1, typeName.length);
                                }
                                docComment.returns = this.buildReturn(item, tree, typeName);
                            }
                            break;

                        case "return":
                            docComment.returns = this.buildReturn(item, tree);
                            break;

                        case "param":
                            docComment.params.push(this.buildParam(item, tree));
                            break;

                        case "throws":
                            docComment.throws.push(this.buildThrows(item, tree));
                            break;

                        case "deprecated":
                            docComment.deprecated = true;
                            docComment.deprecatedMessage = item.description;
                            break;
                    }
                }
            });
        }

        return docComment;
    }

    private buildParam(item, tree): DocCommentParam
    {
        var param = new DocCommentParam("$" + item.name, null, item.description);
        param.type = item.type.name;

        if (param.type == null) {
            return null;
        }

        if (this.scalarTypes.indexOf(param.type) == -1) {
            param.type = Namespaces.getFQNFromClassname(param.type, tree);
        }

        return param;
    }

    private buildThrows(item, tree): DocCommentParam
    {
        var param = new DocCommentParam(null, null, item.description);
        param.type = item.what.name;

        if (this.scalarTypes.indexOf(param.type) == -1) {
            param.type = Namespaces.getFQNFromClassname(param.type, tree);
        }

        return param;
    }

    private buildReturn(item, tree, type = null): DocCommentParam
    {
        if (type == null || type == "") {
            if (item.what == null) {
                return null;
            }

            type = item.what.name;
        }

        var returns = new DocCommentParam(null, type);

        if (item.description) {
            returns.summary = item.description;
        }

        if (returns.type == null) {
            return null;
        }

        if (this.scalarTypes.indexOf(returns.type) == -1) {
            returns.type = Namespaces.getFQNFromClassname(returns.type, tree);
        }

        return returns;
    }

    private buildPosition(position): PositionInfo
    {
        return new PositionInfo(position.line - 1, position.column, position.offset);
    }
}
