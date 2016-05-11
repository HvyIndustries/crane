/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { IConnection } from 'vscode-languageserver';

var phpParser = require("php-parser");

let connection: IConnection;

export class TreeBuilder
{
    // v1.3 - support for namespaces + use recursion
    // v1.2 - added option to suppress errors
    // v1.1

    // TODO -- Handle PHP written inside an HTML file (strip everything except php code)


    public SetConnection(conn: IConnection){
        connection = conn;
    }

    // Parse PHP code to generate an object tree for intellisense suggestions
    public Parse(text:string, filePath:string) : Promise<any>
    {
        return new Promise((resolve, reject) =>
        {

            // phpParser.parser.locations = true;
            // phpParser.parser.docBlocks = true;
            // phpParser.parser.suppressErrors = true;
            // var ast = phpParser.parseCode(text);
            // connection.console.log(filePath);
            var ast = phpParser.create({
                parser: {
                    locations: true,
                    docBlocks: true,
                    suppressErrors: true
                }
            }).parseCode(text);

            // connection.console.log(ast);

            this.BuildObjectTree(ast, filePath).then((tree) => {
                var symbolCache = this.BuildSymbolCache(tree, filePath).then(symbolCache => {
                    var returnObj = {
                        tree: tree,
                        symbolCache: symbolCache
                    };

                    resolve(returnObj);
                }).catch(data => {
                    reject(data);
                });
            }).catch(data => {
                reject(data);
            });
        });
    }

    // Convert the generated AST into a usable object tree
    private BuildObjectTree(ast, filePath:string) : Promise<FileNode>
    {
        return new Promise<FileNode>((resolve, reject) =>
        {
            let tree: FileNode = new FileNode();

            tree.path = filePath;
            tree = this.ProcessBranch(ast[1], [], tree);

            resolve(tree);
        });
    }

    private ProcessBranch(branch, parentBranches, tree:FileNode) : FileNode
    {
        if (Array.isArray(branch) && Array.isArray(branch[0]))
        {
            // Only foreach if branch is an array of arrays
            branch.forEach(element => {
                if (element != null) {
                    this.ProcessBranch(element, parentBranches, tree);
                }
            });
        }
        else
        {
            switch (branch[0]) {
                case "sys":
                    switch (branch[1]) {
                        case "require":
                        case "require_once":
                        case "include":
                        case "include_once":
                            // TODO -- Convert PHP constants such as dirname(__DIR__) and dirname(__FILE__) to absolute paths
                            // TODO -- Convert concatination to absolute paths (eg. "folder/" . "file.php")
                            if (branch[2].length == 2) {
                                let path = branch[2][1];
                                tree.fileReferences.push(path);
                            } else if (branch[2][0] == "bin" && branch[2][1] == ".") {
                                let path = "";
                                branch[2].forEach(item => {
                                    if (Array.isArray(item)) {
                                        if (item[0] == "string"){
                                            path += item[1];
                                        } else if (item[0] == "var") {
                                            // TODO -- Go lookup variable value (if possible)
                                        }
                                    }
                                });
                                tree.fileReferences.push(path);
                            }
                            break;
                    }
                    break;

                case "const":
                    let constantNode: ConstantNode = new ConstantNode();
                    constantNode.name = branch[1][0][0];
                    constantNode.type = branch[1][0][1][0];
                    if (constantNode.type == "string" || constantNode.type == "number") {
                        constantNode.value = branch[1][0][1][1];
                    }
                    // TODO -- Add location
                    tree.constants.push(constantNode);
                    break;

                case "use":
                    let namespaceUsingNode = new NamespaceUsingNode();
                    namespaceUsingNode.name = branch[2];
                    branch[1].forEach(item => {
                        if (item != namespaceUsingNode.name) {
                            namespaceUsingNode.parents.push(item);
                        }
                    });
                    // TODO -- Add location
                    tree.namespaceUsings.push(namespaceUsingNode);
                    break;

                case "namespace":
                    // branch[1] is array of namespace parts
                    // branch[2] is array of classes/interfaces/traits inside namespace
                    branch[2].forEach(item => {
                        this.ProcessBranch(item, branch[1], tree);
                    });
                    break;

                case "call":
                    // let calls = this.BuildFunctionCallsToOtherFunctions(branch);
                    break;

                case "set":
                    switch (branch[1][0]) {
                        case "var":
                            let variableNode: VariableNode = new VariableNode();

                            variableNode.name = branch[1][1];
                            variableNode.type = branch[2][0];
                            if (variableNode.type == "string" || variableNode.type == "number") {
                                variableNode.value = branch[2][1];
                            }
                            tree.topLevelVariables.push(variableNode);

                            // if (branch[2][0] == "call") {
                            //     let calls = this.BuildFunctionCallsToOtherFunctions(branch[2]);
                            // }
                            break;
                    }
                    break;

                case "position":
                    switch (branch[3][0]) {
                        case "function":
                            let methodNode: MethodNode = new MethodNode();

                            methodNode.startPos = this.BuildStartLocation(branch[1]);
                            methodNode.endPos = this.BuildEndLocation(branch[2]);

                            methodNode.name = branch[3][1];

                            methodNode.params = this.BuildFunctionParams(branch[3][2]);
                            if (branch[3][5] != null && Array.isArray(branch[3][5]))
                            {
                                methodNode.returns = branch[3][5][0];
                            }

                            branch[3][6].forEach(codeLevel =>
                            {
                                // Build local scope variable setters
                                let scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                                if (scopeVar != null)
                                {
                                    methodNode.scopeVariables.push(scopeVar);
                                }

                                // Build function calls
                                let functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
                                functionCalls.forEach(element => {
                                    methodNode.functionCalls.push(element);
                                });

                                // Build imported global variables
                                if (codeLevel[0] == "global")
                                {
                                    codeLevel[1].forEach(importGlobalLevel =>
                                    {
                                        if (importGlobalLevel[0] == "var")
                                        {
                                            methodNode.globalVariables.push(importGlobalLevel[1]);
                                        }
                                    });
                                }
                            });

                            tree.functions.push(methodNode);
                            break;

                        case "interface":
                            let interfaceNode: InterfaceNode = new InterfaceNode();

                            interfaceNode.name = branch[3][1];

                            // Build position
                            interfaceNode.startPos = this.BuildStartLocation(branch[1]);
                            interfaceNode.endPos = this.BuildEndLocation(branch[2]);

                            if (branch[3][3] != false) {
                                branch[3][3].forEach(extendedInterface =>
                                {
                                    interfaceNode.extends.push(extendedInterface[0]);
                                });
                            }

                            // Build constants
                            branch[3][4].constants.forEach(constant =>
                            {
                                let constantNode: ConstantNode = new ConstantNode();
                                constantNode.name = constant[3][0][3][0];
                                constantNode.type = constant[3][0][3][1][0];
                                if (constantNode.type == "string" || constantNode.type == "number") {
                                    constantNode.value = constant[3][0][3][1][1];
                                }

                                constantNode.startPos = this.BuildStartLocation(constant[3][0][1]);
                                constantNode.endPos = this.BuildEndLocation(constant[3][0][2]);

                                interfaceNode.constants.push(constantNode);
                            });

                            // Build methods
                            branch[3][4].methods.forEach(method =>
                            {
                                let methodNode: MethodNode = new MethodNode();
                                methodNode.name = method[3][1];

                                methodNode.startPos = this.BuildStartLocation(method[1]);
                                methodNode.endPos = this.BuildEndLocation(method[2]);

                                methodNode.params = this.BuildFunctionParams(method[3][2]);
                                if (method[3][5] != null && Array.isArray(method[3][5]))
                                {
                                    methodNode.returns = method[3][5][0];
                                }

                                interfaceNode.methods.push(methodNode);
                            });

                            tree.interfaces.push(interfaceNode);
                            break;

                        case "trait":
                            let traitNode: TraitNode = new TraitNode();

                            traitNode.name = branch[3][1];

                            // Build position
                            traitNode.startPos = this.BuildStartLocation(branch[1]);
                            traitNode.endPos = this.BuildEndLocation(branch[2]);

                            if (branch[3][2] != false) {
                                traitNode.extends = branch[3][2][0];
                            }

                            branch[3][4].properties.forEach(propLevel =>
                            {
                                let propNode: PropertyNode = new PropertyNode();

                                propNode.startPos = this.BuildStartLocation(propLevel[3][0][1]);
                                propNode.endPos = this.BuildEndLocation(propLevel[3][0][2]);

                                if (propLevel[4][0] == 0) {
                                    propNode.accessModifier = AccessModifierNode.public;
                                }
                                if (propLevel[4][0] == 1) {
                                    propNode.accessModifier = AccessModifierNode.protected;
                                }
                                if (propLevel[4][0] == 2) {
                                    propNode.accessModifier = AccessModifierNode.private;
                                }

                                if (propLevel[4][1] == 1) {
                                    propNode.isStatic = true;
                                }

                                propLevel = propLevel[3][0];
                                propNode.name = propLevel[3][0];

                                if (propLevel[3][1] != null) {
                                    propNode.type = propLevel[3][1][0];
                                }

                                traitNode.properties.push(propNode);
                            });

                            // Build constants
                            branch[3][4].constants.forEach(constant =>
                            {
                                let constantNode: ConstantNode = new ConstantNode();
                                constantNode.name = constant[3][0][3][0];
                                constantNode.type = constant[3][0][3][1][0];

                                constantNode.startPos = this.BuildStartLocation(constant[3][0][1]);
                                constantNode.endPos = this.BuildEndLocation(constant[3][0][2]);

                                traitNode.constants.push(constantNode);
                            });

                            // Build methods
                            branch[3][4].methods.forEach(method =>
                            {
                                let methodNode: MethodNode = new MethodNode();
                                methodNode.name = method[3][1];

                                methodNode.startPos = this.BuildStartLocation(method[1]);
                                methodNode.endPos = this.BuildEndLocation(method[2]);

                                methodNode.params = this.BuildFunctionParams(method[3][2]);

                                methodNode.isAbstract = false;

                                traitNode.methods.push(methodNode);
                            });

                            branch[3][4].use.traits.forEach(traitLevel =>
                            {
                                traitNode.traits.push(traitLevel[0]);
                            });

                            tree.traits.push(traitNode);
                            break;

                        case "class":
                            let classNode: ClassNode = new ClassNode();

                            classNode.startPos = this.BuildStartLocation(branch[1]);
                            classNode.endPos = this.BuildEndLocation(branch[2]);

                            classNode.name = branch[3][1];
                            if (branch[3][3] != false) {
                                classNode.extends = branch[3][3][0];
                            }

                            if (parentBranches != null && parentBranches.length > 0)
                            {
                                // Add namespaces
                                parentBranches.forEach(item => {
                                    classNode.namespaceParts.push(item);
                                });
                            }

                            branch = branch[3];

                            // Build interfaces
                            if (branch[4] != false)
                            {
                                for (let i = 0; i < branch[4].length; i++) {
                                    let subElement = branch[4][i];
                                    classNode.implements.push(subElement[0]);
                                }
                            }

                            if (branch[2] == 187) {
                                classNode.isAbstract = true;
                            }

                            if (branch[2] == 189) {
                                classNode.isFinal = true;
                            }

                            // Build properties
                            branch[5].properties.forEach(propLevel =>
                            {
                                let propNode: PropertyNode = new PropertyNode();

                                propNode.startPos = this.BuildStartLocation(propLevel[1]);
                                propNode.endPos = this.BuildEndLocation(propLevel[2]);

                                if (propLevel[4][0] == 0) {
                                    propNode.accessModifier = AccessModifierNode.public;
                                }
                                if (propLevel[4][0] == 1) {
                                    propNode.accessModifier = AccessModifierNode.protected;
                                }
                                if (propLevel[4][0] == 2) {
                                    propNode.accessModifier = AccessModifierNode.private;
                                }

                                if (propLevel[4][1] == 1) {
                                    propNode.isStatic = true;
                                }

                                propLevel = propLevel[3][0];
                                propNode.name = propLevel[3][0];

                                if (propLevel[3][1] != null) {
                                    propNode.type = propLevel[3][1][0];
                                }

                                classNode.properties.push(propNode);
                            });

                            // Build constants
                            branch[5].constants.forEach(constLevel =>
                            {
                                let constNode: ConstantNode = new ConstantNode();

                                constNode.startPos = this.BuildStartLocation(constLevel[1]);
                                constNode.endPos = this.BuildEndLocation(constLevel[2]);

                                constNode.name = constLevel[3][0][3][0];

                                if (constLevel[3][0][3][1] != null) {
                                    constNode.type = constLevel[3][0][3][1][0];
                                }

                                classNode.constants.push(constNode);
                            });

                            // Build methods
                            branch[5].methods.forEach(methodLevel =>
                            {
                                // Build constructor (newstyle + oldstyle)
                                if (methodLevel[3][1] == "__construct" || methodLevel[3][1] == classNode.name)
                                {
                                    let constructorNode: ConstructorNode = new ConstructorNode();

                                    constructorNode.name = methodLevel[3][1];
                                    constructorNode.startPos = this.BuildStartLocation(methodLevel[1]);
                                    constructorNode.endPos = this.BuildEndLocation(methodLevel[2]);

                                    if (methodLevel[3][1] == classNode.name)
                                    {
                                        constructorNode.isDeprecated = true;
                                    }

                                    constructorNode.params = this.BuildFunctionParams(methodLevel[3][2]);

                                    if (methodLevel[3][6] != null)
                                    {
                                        methodLevel[3][6].forEach(codeLevel =>
                                        {
                                            // Build local scope variable setters
                                            let scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                                            if (scopeVar != null)
                                            {
                                                constructorNode.scopeVariables.push(scopeVar);
                                            }

                                            // Build function calls
                                            let functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
                                            functionCalls.forEach(element => {
                                                constructorNode.functionCalls.push(element);
                                            });

                                            // Build imported global variables
                                            if (codeLevel[0] == "global")
                                            {
                                                codeLevel[1].forEach(importGlobalLevel =>
                                                {
                                                    if (importGlobalLevel[0] == "var")
                                                    {
                                                        constructorNode.globalVariables.push(importGlobalLevel[1]);
                                                    }
                                                });
                                            }
                                        });
                                    }

                                    classNode.construct = constructorNode;
                                }
                                else
                                {
                                    let methodNode: MethodNode = new MethodNode();

                                    methodNode.startPos = this.BuildStartLocation(methodLevel[1]);
                                    methodNode.endPos = this.BuildEndLocation(methodLevel[2]);

                                    // Build access modifier
                                    if (methodLevel[4][0] == 0) {
                                        methodNode.accessModifier = AccessModifierNode.public;
                                    }
                                    if (methodLevel[4][0] == 1) {
                                        methodNode.accessModifier = AccessModifierNode.protected;
                                    }
                                    if (methodLevel[4][0] == 2) {
                                        methodNode.accessModifier = AccessModifierNode.private;
                                    }

                                    methodNode.name = methodLevel[3][1];

                                    // Mark static
                                    if (methodLevel[4][1] == 1) {
                                        methodNode.isStatic = true;
                                    }

                                    // Mark abstract
                                    if (methodLevel[4][2] == 1) {
                                        methodNode.isAbstract = true;
                                    }

                                    methodNode.params = this.BuildFunctionParams(methodLevel[3][2]);

                                    if (methodLevel[3][6] != null)
                                    {
                                        methodLevel[3][6].forEach(codeLevel =>
                                        {
                                            // Build local scope variable setters
                                            let scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                                            if (scopeVar != null)
                                            {
                                                methodNode.scopeVariables.push(scopeVar);
                                            }

                                            // Build function calls
                                            let functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
                                            functionCalls.forEach(element => {
                                                methodNode.functionCalls.push(element);
                                            });

                                            // Build imported global variables
                                            if (codeLevel[0] == "global")
                                            {
                                                codeLevel[1].forEach(importGlobalLevel =>
                                                {
                                                    if (importGlobalLevel[0] == "var")
                                                    {
                                                        methodNode.globalVariables.push(importGlobalLevel[1]);
                                                    }
                                                });
                                            }
                                        });
                                    }

                                    classNode.methods.push(methodNode);
                                }
                            });

                            // Build Traits
                            branch[5].use.traits.forEach(traitLevel =>
                            {
                                classNode.traits.push(traitLevel[0]);
                            });

                            tree.classes.push(classNode);
                            break;
                    }
                    break;
            }
        }
        return tree;
    }

    // Crunch through the generated tree to build a cache of symbols in this file
    private BuildSymbolCache(tree:FileNode, filePath:string) : Promise<SymbolCache[]>
    {
        return new Promise<SymbolCache[]>((resolve, reject) => {
            let cache: SymbolCache[] = [];
            // TODO
            resolve(cache);
        });
    }

    private BuildStartLocation(start): PositionInfo
    {
        return new PositionInfo(start[0], start[1], start[2]);
    }

    private BuildEndLocation(end): PositionInfo
    {
        return new PositionInfo(end[0], end[1], end[2]);
    }

    // paramsArray == methodLevel[3][2]
    private BuildFunctionParams(paramsArray): ParameterNode[]
    {
        var params: ParameterNode[] = [];

        if (paramsArray != null && paramsArray.length != 0)
        {
            // Build parameters
            paramsArray.forEach(paramLevel =>
            {
                let paramNode: ParameterNode = new ParameterNode();
                paramNode.name = paramLevel[0];

                if (paramLevel[2] != null && paramLevel[2].length != 0) {
                    paramNode.optional = true;
                    paramNode.type = paramLevel[2][0];
                } else {
                    paramNode.type = paramLevel[1];
                }

                params.push(paramNode);
            });
        }

        return params;
    }

    // codeLevel == codeLevel
    private BuildFunctionScopeVariables(codeLevel): VariableNode
    {
        if (codeLevel[0] == "set")
        {
            if (codeLevel[1][0] == "var")
            {
                let variableNode: VariableNode = new VariableNode();
                variableNode.name = codeLevel[1][1];
                variableNode.type = codeLevel[2][0];
                if (variableNode.type == "string" || variableNode.type == "number") {
                    variableNode.value = codeLevel[2][1];
                }

                if (codeLevel[2][0] == "call") {
                    let calls = this.BuildFunctionCallsToOtherFunctions(codeLevel[2]);
                }

                return variableNode;
            }
        }

        return null;
    }

    private BuildFunctionCallsToOtherFunctions(codeLevel): FunctionCallNode[]
    {
        var functionCalls: FunctionCallNode[] = [];

        // Handle cases where the function call isn't at the start of the line (eg. echo myFunc())
        if (codeLevel[0] != "call" && Array.isArray(codeLevel[2]) && Array.isArray(codeLevel[2][0]) && codeLevel[2][0].length > 0)
        {
            // TODO -- Handle more than one nested array
            // TODO -- Handle a function being called as a parameter
            codeLevel = codeLevel[2][0];
        }

        if (codeLevel[0] == "call")
        {
            var funcNode: FunctionCallNode = new FunctionCallNode();

            if (codeLevel[1][0] == "ns")
            {
                var arrLength = codeLevel[1][1].length;
                funcNode.name = codeLevel[1][1][arrLength - 1];
                codeLevel[1][1].forEach(item => {
                    if (item != funcNode.name) {
                        funcNode.parents.push(item);
                    }
                })
            }
            else // Handle class function calls (ie. $this->call() instead of call())
            {
                // Set the name
                funcNode.name = codeLevel[1][codeLevel[1].length - 1][1];

                // Build parents of called function (eg. $this from $this->func(), etc)
                var parents = this.BuildParents(codeLevel[1], funcNode.name);
                if (parents != null)
                {
                    funcNode.parents = parents;
                }
            }

            codeLevel[2].forEach(funcCallLevel =>
            {
                var paramNode: ParameterNode = new ParameterNode();

                if (funcCallLevel.length == 2)
                {
                    paramNode.name = funcCallLevel[1];
                }
                else // Handle properties (ie. $this->var instead of just $var)
                {
                    // Set the name
                    paramNode.name = funcCallLevel[funcCallLevel.length - 1][1];

                    // Build parents of provided parameters (eg. $this from $this->myProp, etc)
                    var parents = this.BuildParents(funcCallLevel, paramNode.name);
                    if (parents != null)
                    {
                        paramNode.parents = parents;
                    }
                }

                funcNode.params.push(paramNode);
            });

            functionCalls.push(funcNode);
        }

        return functionCalls;
    }

    // Recurse through the provided array building up an array of parents
    private BuildParents(sourceArray, existingName): string[]
    {
        var toReturn: string[] = [];

        if (Array.isArray(sourceArray))
        {
            sourceArray.forEach(element =>
            {
                if (Array.isArray(element))
                {
                    if (element.length > 2)
                    {
                        var results = this.BuildParents(element, existingName);

                        results.forEach(subElement =>
                        {
                            toReturn.push(subElement);
                        });
                    }
                    else
                    {
                        if (typeof element[1] == "string")
                        {
                            if (element[1] != existingName)
                            {
                                toReturn.push(element[1]);
                            }
                        }
                    }
                }
            });
        }

        return toReturn;
    }
}




// Entity Schema
// TODO - if/else blocks
//      - switch blocks
//      - handle autoloaded files

class BaseNode
{
    public name: string;
    public startPos: PositionInfo;
    public endPos: PositionInfo;
}

export class FileNode
{
    public path: string;
    public constants: ConstantNode[] = [];
    public topLevelVariables: VariableNode[] = [];
    public functions: MethodNode[] = [];
    public namespaceUsings: NamespaceUsingNode[] = [];
    public classes: ClassNode[] = [];
    public interfaces: InterfaceNode[] = [];
    public traits: TraitNode[] = [];

    // Any files that we're referencing with include(), require(), include_once() or require_once()
    public fileReferences: string[] = [];
}

export class NamespaceUsingNode extends BaseNode
{
    // The parent parts in the correct order (eg. use [Parent1]\[Parent1]\Namespace)
    public parents: string[] = [];
}

export class ClassNode extends BaseNode
{
    public implements: string[] = [];
    public extends: string;
    public isAbstract: boolean = false;
    public isFinal: boolean = false;
    public isStatic: boolean = false;
    public properties: PropertyNode[] = [];
    public methods: MethodNode[] = [];
    public constants: ConstantNode[] = [];
    public traits: string[] = [];
    public namespaceParts: string[] = [];
    public construct: ConstructorNode;
}

export class TraitNode extends ClassNode {}

export class InterfaceNode extends BaseNode
{
    public extends: string[] = [];
    public constants: ConstantNode[] = [];
    public methods: MethodNode[] = [];
    public namespace: string[] = [];
}

export class MethodNode extends BaseNode
{
    public params: ParameterNode[] = [];
    public returns: string;
    public accessModifier: AccessModifierNode = AccessModifierNode.public;
    public isStatic: boolean = false;
    public isAbstract: boolean = false;
    public globalVariables: string[] = [];
    public scopeVariables: VariableNode[] = [];
    public functionCalls: FunctionCallNode[] = [];
}

export class ConstructorNode extends MethodNode
{
    public isDeprecated: boolean = false;
}

export class FunctionCallNode extends BaseNode
{
    public params: ParameterNode[] = [];
    public parents: string[] = [];
}

export class VariableNode extends BaseNode
{
    public type: string;
    public value: string;
}

export class ParameterNode extends VariableNode
{
    public optional: boolean = false;
    public parents: string[] = [];
}

export class PropertyNode extends BaseNode
{
    public type: string;
    public accessModifier: AccessModifierNode;
    public isStatic: boolean = false;
}

export class ConstantNode extends BaseNode
{
    // Constants are always public
    // Constants (should) only be basic types
    public type: string;
    public value: string;
}

export enum AccessModifierNode
{
    public,
    private,
    protected
}

export class PositionInfo
{
    constructor(line = 0, col = 0, offset = 0) {
        this.line = line;
        this.col = col;
        this.offset = offset;
    }

    public line: number;
    public col: number;
    public offset: number;
}



export class SymbolLookupCache
{
    public cache: SymbolCache[];
}

export class SymbolCache
{
    public name: string;
    public file: string;
    public line: number;
}
