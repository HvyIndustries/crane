/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { SymbolInformation, SymbolKind } from 'vscode-languageserver';

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
    VariableNode
} from './nodes';

export class TreeBuilderV2
{
    private symbolCache: SymbolInformation[];

    constructor()
    {
        this.symbolCache = [];
    }

    public processBranch(branch, tree: FileNode) : FileNode
    {
        if (Array.isArray(branch)) {
            branch.forEach(element => {
                this.processBranch(element, tree);
            });
        } else {
            switch (branch.kind) {
                case "namespace":
                    this.processBranch(branch.children, tree);
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
                    this.buildClass(branch, tree.classes);
                    break;

                case "trait":
                    this.buildTrait(branch, tree.traits);
                    break;

                case "interface":
                    this.buildInterface(branch, tree.interfaces);
                    break;
            }
        }

        // Save the generated symbol cache
        tree.symbolCache = this.symbolCache;

        return tree;
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
                // TODO -- handle namespace aliases (eg "use HVY\test as testAlias;")
                context.namespaceUsings.push(item.name);
            }
        });
    }

    private buildAssignment(branch, context: Array<any>)
    {
        if (branch.left.kind == "variable") {
            let node = new VariableNode();

            node.name = "$" + branch.left.name;
            node.startPos = this.buildPosition(branch.loc.start);
            node.endPos = this.buildPosition(branch.loc.end);

            if (branch.right.kind == "new") {
                node.type = "class";
                node.value = branch.right.what.name;
            }

            context.push(node);
        }
    }

    private buildInterface(branch, context: Array<any>)
    {
        let interfaceNode: InterfaceNode = new InterfaceNode();

        interfaceNode.name = branch.name;

        // TODO -- add namespace info

        if (branch.extends != null) {
            branch.extends.forEach(item => {
                interfaceNode.extends.push(item.name);
            });
        }

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

        interfaceNode.startPos = this.buildPosition(branch.loc.start);
        interfaceNode.endPos = this.buildPosition(branch.loc.end);

        context.push(interfaceNode);
    }

    private buildTrait(branch, context: Array<any>)
    {
        let traitNode: TraitNode = new TraitNode();

        traitNode.name = branch.name;

        // TODO -- add namespace info

        if (branch.extends != null) {
            traitNode.extends = branch.extends.name;
        }

        if (branch.implements != null) {
            branch.implements.forEach(item => {
                traitNode.implements.push(item.name);
            });
        }

        branch.body.forEach(classBodyBranch => {
            this.buildClassBody(classBodyBranch, traitNode);
        });

        traitNode.startPos = this.buildPosition(branch.loc.start);
        traitNode.endPos = this.buildPosition(branch.loc.end);

        context.push(traitNode);
    }

    private buildClass(branch, context: Array<any>)
    {
        let classNode: ClassNode = new ClassNode();

        classNode.name = branch.name;

        // TODO -- add namespace info

        if (branch.extends != null) {
            classNode.extends = branch.extends.name;
        }

        if (branch.implements != null) {
            branch.implements.forEach(item => {
                classNode.implements.push(item.name);
            });
        }

        classNode.isAbstract = branch.isAbstract;
        classNode.isFinal = branch.isFinal;

        branch.body.forEach(classBodyBranch => {
            this.buildClassBody(classBodyBranch, classNode);
        });

        classNode.startPos = this.buildPosition(branch.loc.start);
        classNode.endPos = this.buildPosition(branch.loc.end);

        //this.buildSymbol(branch, SymbolKind.Class);

        context.push(classNode);
    }

    private buildClassBody(branch, classNode: ClassNode)
    {
        switch (branch.kind) {
            case "property":
                this.buildProperty(branch, classNode);
                break;

            case "classconstant":
                this.buildConstant(branch, classNode.constants);
                break;

            case "doc":
                this.buildDocComment(branch, classNode);
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

        context.push(constNode);
    }

    private buildDocComment(branch, classNode: ClassNode)
    {
        // TODO
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

        node.params = this.buildFunctionArguments(branch.arguments);

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

    private buildFunctionArguments(methodArguments)
    {
        let args = new Array<ParameterNode>();

        methodArguments.forEach(item => {
            let arg = new ParameterNode();

            arg.name = item.name;
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

            args.push(arg);
        });

        return args;
    }

    private buildTraitUse(branch, classNode: ClassNode)
    {
        branch.traits.forEach(traitItem => {
            classNode.traits.push(traitItem.name);
        });
    }




    private buildSymbol(branch, sumbolKind: SymbolKind)
    {
        let symbol: SymbolInformation = {
            name: "",
            containerName: "",
            kind: sumbolKind,
            location: null
        };

        this.symbolCache.push(symbol);
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
