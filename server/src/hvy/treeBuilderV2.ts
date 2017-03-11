/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import {
    FileNode,
    ClassNode,
    TraitNode,
    InterfaceNode,
    PropertyNode,
    ConstantNode,
    ConstructorNode,
    MethodNode,
    ParameterNode,
    AccessModifierNode,
    PositionInfo,
    VariableNode,
    NamespaceUsingNode,
    NamespaceNode,
    NamespacePart,
    DocComment
} from './nodes';
import { Namespaces } from "../util/namespaces";
import { DocCommentHelper } from "./docCommentHelper";

const docParser = require("doc-parser");
var docReader = new docParser();

export class TreeBuilderV2
{
    private tree: FileNode;
    private lastDocComment: DocComment = null;

    public processBranch(branch, tree: FileNode, parent) : FileNode
    {
        this.tree = tree;

        if (Array.isArray(branch)) {
            branch.forEach(element => {
                this.processBranch(element, tree, parent);
            });
        } else {
            switch (branch.kind) {
                case "doc":
                    this.saveDocComment(branch);
                    break;

                case "namespace":
                    this.buildNamespaceDeclaration(branch, tree);
                    this.processBranch(branch.children, tree, branch);
                    break;

                case "include":
                    this.buildfileInclude(branch, tree);
                    break;

                case "usegroup":
                    this.buildNamespaceUsings(branch, tree);
                    break;

                case "assign":
                    this.buildAssignment(branch, tree.topLevelVariables);
                    break;

                case "constant":
                    this.buildConstant(branch, tree.constants);
                    break;

                case "function":
                    this.buildMethod(branch, tree.functions);
                    break;

                case "call":
                    //this.buildCall(branch, tree);
                    break;

                case "class":
                    this.buildClass(branch, tree.classes, parent);
                    break;

                case "trait":
                    this.buildTrait(branch, tree.traits, parent);
                    break;

                case "interface":
                    this.buildInterface(branch, tree.interfaces, parent);
                    break;
            }
        }

        return tree;
    }

    public buildNamespaceParts(tree: FileNode)
    {
        let namespaces: NamespacePart[] = [];
        let fullyQualifiedNamespaces: string[] = [];

        // build up a list of all namespaces in the file
        tree.namespaces.forEach(namespaceNode => {
            fullyQualifiedNamespaces.push(namespaceNode.name);
        });

        fullyQualifiedNamespaces.forEach(namespace => {
            if (typeof namespace === 'string' || namespace instanceof String) {
                // break down the list into parts separated by "\"
                let parts = namespace.split("\\");
                let nsPart = new NamespacePart(parts[0]);
                let exists = false;

                namespaces.forEach(toplevelPart => {
                    if (toplevelPart.name == parts[0]) {
                        nsPart = toplevelPart;
                        exists = true;
                        return;
                    }
                });

                parts.splice(0, 1);
                this.buildNamespacePart(parts, nsPart);

                if (!exists) {
                    namespaces.push(nsPart);
                }
            }
        });

        tree.namespaceParts = namespaces;
    }

    private buildNamespacePart(parts:string[], nsPart: NamespacePart)
    {
        if (parts.length > 0) {
            let part = new NamespacePart(parts[0]);
            let exists = false;

            nsPart.children.forEach(subPart => {
                if (subPart.name == parts[0]) {
                    part = subPart;
                    exists = true;
                    return;
                }
            });

            parts.splice(0, 1);
            this.buildNamespacePart(parts, part);

            if (!exists) {
                nsPart.children.push(part);
            }
        }
    }

    private saveDocComment(branch)
    {
        if (branch.isDoc) {
            let docCommentHelper = new DocCommentHelper();
            this.lastDocComment = docCommentHelper.buildDocCommentFromBranch(branch, this.tree);
        }
    }

    private buildNamespaceDeclaration(branch, context: FileNode)
    {
        let namespace = new NamespaceNode(branch.name);
        namespace.startPos = this.buildPosition(branch.loc.start);
        namespace.endPos = this.buildPosition(branch.loc.end);
        context.namespaces.push(namespace);
    }

    private buildfileInclude(branch, context: FileNode)
    {
        switch (branch.target.kind) {
            case "string":
                // Simple case -> include "folder/file.php"
                context.fileReferences.push(branch.target.value);
                break;

            case "bin":
                // TODO
                // Use of constant -> include __DIR__ . "folder/file.php"
                // Use of variable -> include "/dir/{$folder}/file.php"
                break;
        }
    }

    private buildNamespaceUsings(branch, context: FileNode)
    {
        branch.items.forEach(item => {
            if (item.name) {
                let node = new NamespaceUsingNode(item.name);
                // Handle namespace aliases (eg "use HVY\test as testAlias;"
                node.alias = item.alias;

                context.namespaceUsings.push(node);
            }
        });
    }

    private buildAssignment(branch, context: Array<any>)
    {
        if (branch.left && branch.left.kind == "variable") {
            let node = new VariableNode();

            node.name = "$" + branch.left.name;
            node.startPos = this.buildPosition(branch.loc.start);
            node.endPos = this.buildPosition(branch.loc.end);

            if (branch.right && branch.right.kind == "new") {
                if (branch.right.what && branch.right.what.name) {
                    node.value = branch.right.what.name;

                    if (branch.right.what.kind == "identifier") {
                        // Get FQN (check namespace + check usings)
                        node.type = Namespaces.getFQNFromClassname(branch.right.what.name, this.tree);
                    } else {
                        node.type = branch.right.what.name;
                    }
                }
            }

            this.buildDocCommentForNode(node);

            if (node.docComment && node.docComment.returns && node.docComment.returns.type) {
                node.type = node.docComment.returns.type;
            }

            context.push(node);
        }
    }

    private buildDocCommentForNode(node)
    {
        if (this.lastDocComment && (node.startPos.line == (this.lastDocComment.endPos.line + 1))) {
            node.docComment = this.lastDocComment;
            this.lastDocComment = null;
        }
    }

    private buildNamespace(node, parent)
    {
        if (parent != null && parent.kind == "namespace") {
            node.namespace = parent.name;
        }
    }

    private buildInterface(branch, context: Array<any>, parent)
    {
        let interfaceNode: InterfaceNode = new InterfaceNode();

        interfaceNode.name = branch.name;

        this.buildNamespace(interfaceNode, parent);

        if (branch.extends != null) {
            branch.extends.forEach(item => {
                interfaceNode.extends.push(item.name);
            });
        }

        interfaceNode.startPos = this.buildPosition(branch.loc.start);
        interfaceNode.endPos = this.buildPosition(branch.loc.end);

        this.buildDocCommentForNode(interfaceNode);

        if (branch.body) {
            branch.body.forEach(interfaceBodyBranch => {
                switch (interfaceBodyBranch.kind) {
                    case "classconstant":
                        this.buildConstant(interfaceBodyBranch, interfaceNode.constants);
                        break;
                    case "method":
                        this.buildMethod(interfaceBodyBranch, interfaceNode.methods);
                        break;
                }
            });
        }
        context.push(interfaceNode);
    }

    private buildTrait(branch, context: Array<any>, parent)
    {
        let traitNode: TraitNode = new TraitNode();

        traitNode.name = branch.name;

        this.buildNamespace(traitNode, parent);

        if (branch.extends != null) {
            traitNode.extends = Namespaces.getFQNFromClassname(branch.extends.name, this.tree);
        }

        if (branch.implements != null) {
            branch.implements.forEach(item => {
                traitNode.implements.push(item.name);
            });
        }

        traitNode.startPos = this.buildPosition(branch.loc.start);
        traitNode.endPos = this.buildPosition(branch.loc.end);

        this.buildDocCommentForNode(traitNode);

        if (branch.body) {
            branch.body.forEach(classBodyBranch => {
                this.buildClassBody(classBodyBranch, traitNode);
            });
        }
        context.push(traitNode);
    }

    private buildClass(branch, context: Array<any>, parent)
    {
        let classNode: ClassNode = new ClassNode();

        classNode.name = branch.name;

        this.buildNamespace(classNode, parent);

        if (branch.extends != null) {
            classNode.extends = Namespaces.getFQNFromClassname(branch.extends.name, this.tree);
        }

        if (branch.implements != null) {
            branch.implements.forEach(item => {
                classNode.implements.push(item.name);
            });
        }

        classNode.isAbstract = branch.isAbstract;
        classNode.isFinal = branch.isFinal;

        classNode.startPos = this.buildPosition(branch.loc.start);
        classNode.endPos = this.buildPosition(branch.loc.end);

        this.buildDocCommentForNode(classNode);

        if (branch.body) {
            branch.body.forEach(classBodyBranch => {
                this.buildClassBody(classBodyBranch, classNode);
            });
        }
        context.push(classNode);
    }

    private buildClassBody(branch, classNode: ClassNode)
    {
        switch (branch.kind) {
            case "doc":
                this.saveDocComment(branch);
                break;

            case "property":
                this.buildProperty(branch, classNode);
                break;

            case "classconstant":
                this.buildConstant(branch, classNode.constants);
                break;

            case "method":
                this.buildMethodOrConstructor(branch, classNode);
                break;

            case "traituse":
                this.buildTraitUse(branch, classNode);
                break;
        }
    }

    private buildProperty(branch, classNode: ClassNode)
    {
        let propNode: PropertyNode = new PropertyNode();

        propNode.name = branch.name;

        propNode.startPos = this.buildPosition(branch.loc.start);
        propNode.endPos = this.buildPosition(branch.loc.end);

        propNode.isStatic = branch.isStatic;

        // TODO -- are these needed?
        //propNode.? = branch.isAbstract;
        //propNode.? = branch.isFinal;

        if (branch.value != null && (branch.value.kind == "string"
                                    || branch.value.kind == "number"
                                    || branch.value.kind == "array"
                                    || branch.value.kind == "boolean")) {
            propNode.type = branch.value.kind;
        }

        propNode.accessModifier = this.getVisibility(branch.visibility);

        this.buildDocCommentForNode(propNode);
        classNode.properties.push(propNode);
    }

    private buildConstant(branch, context: Array<any>)
    {
        let constNode: ConstantNode = new ConstantNode();

        constNode.startPos = this.buildPosition(branch.loc.start);
        constNode.endPos = this.buildPosition(branch.loc.end);

        constNode.name = branch.name;

        if (branch.value) {
            constNode.type = branch.value.kind;
            constNode.value = branch.value.value;
        }

        this.buildDocCommentForNode(constNode);
        context.push(constNode);
    }

    private buildMethodOrConstructor(branch, classNode: ClassNode)
    {
        if (branch.name == "__construct" || branch.name == classNode.name) {
            this.buildConstructor(branch, classNode);
        } else {
            this.buildMethod(branch, classNode.methods);
        }
    }

    private buildConstructor(branch, classNode: ClassNode)
    {
        let constructorNode: ConstructorNode = new ConstructorNode();

        if (branch.name == classNode.name) {
            constructorNode.isDeprecated = true;
        }

        this.buildMethodCore(constructorNode, branch);

        classNode.construct = constructorNode;
    }

    private buildMethod(branch, context: Array<any>)
    {
        let methodNode: MethodNode = new MethodNode();

        this.buildMethodCore(methodNode, branch);

        methodNode.isAbstract = branch.isAbstract;
        methodNode.isFinal = branch.isFinal;
        methodNode.isStatic = branch.isStatic;

        methodNode.accessModifier = this.getVisibility(branch.visibility);

        context.push(methodNode);
    }

    private buildMethodCore(node: MethodNode, branch)
    {
        node.name = branch.name;

        node.startPos = this.buildPosition(branch.loc.start);
        node.endPos = this.buildPosition(branch.loc.end);
        this.buildDocCommentForNode(node);

        node.params = this.buildFunctionArguments(branch.arguments, node);

        if (branch.body && branch.body.children) {
            branch.body.children.forEach(child => {
                switch (child.kind) {
                    case "assign":
                        this.buildAssignment(child, node.scopeVariables);
                        break;

                    case "global":
                        // Build imported global variables for suggestions
                        child.items.forEach(item => {
                            node.globalVariables.push("$" + item.name);
                        });
                        break;

                    // TODO -- handle variable assignments inside code blocks
                    // TODO -- change this to be blocks of code instead of scope variables to allow for scope-aware
                    //         accessing of variables inside loops

                    // TODO -- build scope functions calls

                    // TODO -- handle output variables ?

                    case "return":
                        // TODO -- build return type if possible
                        //node.returns = "";
                        break;
                }
            });
        }
    }

    private buildFunctionArguments(methodArguments, node: MethodNode)
    {
        let args = new Array<ParameterNode>();

        methodArguments.forEach(item => {
            let arg = new ParameterNode();

            arg.name = "$" + item.name;
            arg.byRef = item.byref;
            arg.nullable = item.nullable;

            arg.startPos = this.buildPosition(item.loc.start);
            arg.endPos = this.buildPosition(item.loc.end);

            if (item.value) {
                arg.optional = true;
                arg.type = item.value.kind;
            }

            if (item.type) {
                arg.type = item.type.name;
            }

            if (node.docComment && node.docComment.params.length > 0) {
                node.docComment.params.some(param => {
                    if (param.name == arg.name) {
                        arg.type = param.type;
                        arg.docType = param.type;
                        arg.docDescription = param.summary;
                        return true;
                    }
                });
            }

            args.push(arg);
        });

        return args;
    }

    private buildTraitUse(branch, classNode: ClassNode)
    {
        branch.traits.forEach(traitItem => {
            classNode.traits.push(Namespaces.getFQNFromClassname(traitItem.name, this.tree));
        });
    }





    private getVisibility(visibility)
    {
        switch (visibility) {
            case "protected":
                return AccessModifierNode.protected;

            case "private":
                return AccessModifierNode.private;

            default:
                return AccessModifierNode.public;
        }
    }

    private buildPosition(position)
    {
        return new PositionInfo(position.line - 1, position.column, position.offset);
    }

    private methodStub(branch, tree: FileNode)
    {
    }
}
