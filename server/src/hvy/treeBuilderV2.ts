/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import {
    FileNode,
    ClassNode,
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
    public processBranch(branch, context) : FileNode
    {
        if (Array.isArray(branch)) {
            branch.forEach(element => {
                this.processBranch(element, context);
            });
        } else {
            switch (branch.kind) {
                case "namespace":
                    this.processBranch(branch.children, context);
                    break;

                case "include":
                    this.buildfileInclude(branch, context);
                    break;

                case "usegroup":
                    this.buildNamespaceUsings(branch, context);
                    break;

                case "assign":
                    this.buildAssignment(branch, context);
                    break;

                case "call":
                    this.buildCall(branch, context);
                    break;

                case "class":
                    this.buildClass(branch, context);

                // TODO -- trait, interface, constant

                default:
                    break;
            }
        }

        return context;
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
                // TODO -- handle namespace aliases (eg "HVY\test as testy")
                context.namespaceUsings.push(item.name);
            }
        });
    }

    private buildAssignment(branch, context)
    {
        // TODO -- add assignments to context
    }

    private buildCall(branch, context)
    {
        // TODO -- add method calls to context
    }

    private buildClass(branch, context: FileNode)
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

        context.classes.push(classNode);
    }

    private buildClassBody(branch, classNode: ClassNode)
    {
        switch (branch.kind) {
            case "property":
                this.buildProperty(branch, classNode);
                break;

            case "classconstant":
                this.buildClassConstant(branch, classNode);
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

    private buildClassConstant(branch, classNode: ClassNode)
    {
        let constNode: ConstantNode = new ConstantNode();

        constNode.startPos = this.buildPosition(branch.loc.start);
        constNode.endPos = this.buildPosition(branch.loc.end);

        constNode.name = branch.name;

        if (branch.value) {
            constNode.type = branch.value.kind;
            constNode.value = branch.value.value;
        }

        classNode.constants.push(constNode);
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
            this.buildMethod(branch, classNode);
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

    private buildMethod(branch, classNode: ClassNode)
    {
        let methodNode: MethodNode = new MethodNode();

        this.buildMethodCore(methodNode, branch);

        methodNode.isAbstract = branch.isAbstract;
        methodNode.isFinal = branch.isFinal;
        methodNode.isStatic = branch.isStatic;

        methodNode.accessModifier = this.getVisibility(branch.visibility);

        classNode.methods.push(methodNode);
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
                        // Build scope variables for suggestions
                        if (child.left.kind == "variable") {
                            let variableNode = new VariableNode();
                            variableNode.name = child.left.name;
                            variableNode.startPos = this.buildPosition(child.loc.start);
                            variableNode.endPos = this.buildPosition(child.loc.end);

                            node.scopeVariables.push(variableNode);
                        }
                        break;

                    case "global":
                        // Build imported global variables for suggestions
                        child.items.forEach(item => {
                            node.globalVariables.push(item.name);
                        });
                        break;

                    // TODO -- handle variable assignments inside code blocks
                    // TODO -- change this to be blocks of code instead of scope variables to allow for scope-aware
                    //         accessing of variables inside loops

                    // TODO -- build scope functions calls

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
        return new PositionInfo(position.line, position.column, position.offset);
    }

    private methodStub(branch, tree: FileNode)
    {
    }
}
