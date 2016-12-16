/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import { IConnection, SymbolKind } from 'vscode-languageserver';

var phpParser = require("php-parser");

let connection: IConnection;

function isset(value) {
    return typeof value != 'undefined';
}

export class TreeBuilder
{
    // v1.5 - added extra types for variables
    // v1.4 - added lineCache
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
            var parserInst = phpParser.create({
                parser: {
                    locations: true,
                    docBlocks: true,
                    suppressErrors: true
                }
            });

            var ast = parserInst.parseCode(text);
            parserInst = null;

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

    public Ping(): string
    {
        return "pong";
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
                            if (Array.isArray(branch[2]) && branch[2].length == 2) {
                                let path = branch[2][1];
                                tree.fileReferences.push(path);
                            } else if (Array.isArray(branch[2]) && branch[2][0] == "bin" && branch[2][1] == ".") {
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
                    // this fixes exception when trying ot get completion on file `use` statements
                    if (branch[1][0] === undefined || branch[1][0][1] === undefined || branch[1][0][1][0] === undefined) {
                        break;
                    }
                    let constantNode: ConstantNode = new ConstantNode();
                    if (Array.isArray(branch[1][0]) && Array.isArray(branch[1][0][1])) {
                        constantNode.name = branch[1][0][0];

                        constantNode.type = branch[1][0][1][0];
                        constantNode.value = branch[1][0][1][1];

                        // TODO -- Add location
                        tree.constants.push(constantNode);
                    }
                    break;

                case "use":
                    let namespaceUsingNode = new NamespaceUsingNode();
                    if (Array.isArray(branch[1]) && branch[1][branch[1].length - 1] != branch[2]) {
                        namespaceUsingNode.name = branch[1][branch[1].length - 1];
                        namespaceUsingNode.refName = branch[2];
                    } else {
                        namespaceUsingNode.name = branch[2];
                    }
                    if (Array.isArray(branch[1])) {
                        branch[1].forEach(item => {
                            if (item != namespaceUsingNode.name) {
                                namespaceUsingNode.parents.push(item);
                            }
                        });
                    }
                    // TODO -- Add location
                    tree.namespaceUsings.push(namespaceUsingNode);
                    break;

                case "namespace":
                    // branch[1] is array of namespace parts
                    // branch[2] is array of classes/interfaces/traits inside namespace
                    if (Array.isArray(branch[2])) {
                        branch[2].forEach(item => {
                            if (item != null) {
                                this.ProcessBranch(item, branch[1], tree);
                            }
                        });
                    }
                    break;

                case "call":
                    // let calls = this.BuildFunctionCallsToOtherFunctions(branch);
                    break;

                case "set":
                    let variable = this.BuildVariableOrProp(branch);
                    if (variable != null) {
                        tree.topLevelVariables.push(variable.variableNode);
                        if (variable.lineCache != null) {
                            tree.lineCache.push(variable.lineCache);
                        }

                        if (variable.variableNode.startPos && variable.variableNode.endPos) {
                            var symbolCache = new FileSymbolCache();
                            symbolCache.name = variable.variableNode.name;
                            symbolCache.type = SymbolType.TopLevelVariable;
                            symbolCache.kind = SymbolKind.Variable;
                            symbolCache.startLine = variable.variableNode.startPos.line;
                            symbolCache.endLine = variable.variableNode.endPos.line;
                            symbolCache.startChar = 0
                            symbolCache.endChar = 999;
                            tree.symbolCache.push(symbolCache);
                        }
                    }
                    break;

                case "position":
                    switch (branch[3][0]) {
                        case "function":
                            let methodNode: MethodNode = new MethodNode();

                            methodNode.startPos = this.BuildStartLocation(branch[1]);
                            methodNode.endPos = this.BuildEndLocation(branch[2]);

                            methodNode.name = branch[3][1];

                            // Build return type
                            if (Array.isArray(branch[3]) && Array.isArray(branch[3][5]) && branch[3][5][0] != null) {
                                methodNode.returns = branch[3][5][0];
                            }

                            methodNode.params = this.BuildFunctionParams(branch[3][2], tree.lineCache, methodNode.startPos);

                            if (Array.isArray(branch[3][6])) {
                                branch[3][6].forEach(codeLevel => {
                                    if (codeLevel != null) {
                                        // Build local scope variable setters
                                        let scopeVar = this.BuildVariableOrProp(codeLevel);
                                        if (scopeVar != null) {
                                            methodNode.scopeVariables.push(scopeVar.variableNode);
                                            if (scopeVar.lineCache != null) {
                                                tree.lineCache.push(scopeVar.lineCache);
                                            }
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
                                    }
                                });
                            }

                            var symbolCache = new FileSymbolCache();
                            symbolCache.name = methodNode.name;
                            symbolCache.type = SymbolType.TopLevelFunction;
                            symbolCache.kind = SymbolKind.Function;
                            symbolCache.startLine = methodNode.startPos.line;
                            symbolCache.startChar = methodNode.startPos.col;
                            symbolCache.endLine = methodNode.endPos.line;
                            symbolCache.endChar = methodNode.endPos.col;
                            tree.symbolCache.push(symbolCache);

                            tree.functions.push(methodNode);
                            break;

                        case "interface":
                            if (Array.isArray(branch[3])) {
                                let interfaceNode: InterfaceNode = new InterfaceNode();
                                interfaceNode.name = branch[3][1];

                                // Build position
                                interfaceNode.startPos = this.BuildStartLocation(branch[1]);
                                interfaceNode.endPos = this.BuildEndLocation(branch[2]);

                                if (branch[3][3] != false) {
                                    branch[3][3].forEach(extendedInterface => {
                                        interfaceNode.extends.push(extendedInterface[0]);
                                    });
                                }

                                if (parentBranches != null && parentBranches.length > 0) {
                                    // Add namespaces
                                    parentBranches.forEach(item => {
                                        interfaceNode.namespaceParts.push(item);
                                    });
                                }

                                if (Array.isArray(branch[3][4])) {
                                    // Build constants
                                    branch[3][4].constants.forEach(constant => {
                                        let constantNode: ConstantNode = new ConstantNode();
                                        constantNode.name = constant[3][0][3][0];

                                        if (Array.isArray(constant[3][0][3][1])) {
                                            constantNode.type = constant[3][0][3][1][0];
                                            constantNode.value = constant[3][0][3][1][1];
                                        }

                                        constantNode.startPos = this.BuildStartLocation(constant[3][0][1]);
                                        constantNode.endPos = this.BuildEndLocation(constant[3][0][2]);

                                        interfaceNode.constants.push(constantNode);
                                    });

                                    // Build methods
                                    branch[3][4].methods.forEach(method => {
                                        let methodNode: MethodNode = new MethodNode();
                                        methodNode.name = method[3][1];

                                        methodNode.startPos = this.BuildStartLocation(method[1]);
                                        methodNode.endPos = this.BuildEndLocation(method[2]);

                                        // Build return type
                                        if (method[3][5] != null && Array.isArray(method[3][5]) && method[3][5][0] != null) {
                                            methodNode.returns = method[3][5][0];
                                        }

                                        methodNode.params = this.BuildFunctionParams(method[3][2], tree.lineCache, methodNode.startPos);

                                        interfaceNode.methods.push(methodNode);
                                    });
                                }
                                var symbolCache = new FileSymbolCache();
                                symbolCache.name = interfaceNode.name;
                                symbolCache.type = SymbolType.Interface;
                                symbolCache.kind = SymbolKind.Interface;
                                symbolCache.startLine = interfaceNode.startPos.line;
                                symbolCache.startChar = interfaceNode.startPos.col;
                                symbolCache.endLine = interfaceNode.endPos.line;
                                symbolCache.endChar = interfaceNode.endPos.col;
                                tree.symbolCache.push(symbolCache);

                                tree.interfaces.push(interfaceNode);
                            }
                            break;

                        case "trait":
                            if (Array.isArray(branch[3])) {
                                var traitNode: TraitNode = new TraitNode();

                                traitNode.name = branch[3][1];

                                // Build position
                                traitNode.startPos = this.BuildStartLocation(branch[1]);
                                traitNode.endPos = this.BuildEndLocation(branch[2]);

                                if (branch[3][2] != false) {
                                    traitNode.extends = branch[3][2][0];
                                }

                                if (parentBranches != null && parentBranches.length > 0) {
                                    // Add namespaces
                                    parentBranches.forEach(item => {
                                        traitNode.namespaceParts.push(item);
                                    });
                                }

                                // Build Properties
                                this.buildTreeProperties(branch[3][4].properties, traitNode, tree);
                                // Build Constants
                                this.buildTreeConstants(branch[3][4].constants, traitNode, tree);
                                // Build Methods
                                this.buildTreeMethods(branch[3][4].methods, traitNode, tree);

                                branch[3][4].use.traits.forEach(traitLevel => {
                                    traitNode.traits.push(traitLevel[0]);
                                });

                                var symbolCache = new FileSymbolCache();
                                symbolCache.name = traitNode.name;
                                symbolCache.type = SymbolType.Trait;
                                symbolCache.kind = SymbolKind.Class;
                                symbolCache.startLine = traitNode.startPos.line;
                                symbolCache.startChar = traitNode.startPos.col;
                                symbolCache.endLine = traitNode.endPos.line;
                                symbolCache.endChar = traitNode.endPos.col;
                                tree.symbolCache.push(symbolCache);

                                tree.traits.push(traitNode);
                            }
                            break;

                        case "class":
                            if (Array.isArray(branch[3])) {
                                let classNode: ClassNode = new ClassNode();

                                classNode.startPos = this.BuildStartLocation(branch[1]);
                                classNode.endPos = this.BuildEndLocation(branch[2]);

                                classNode.name = branch[3][1];

                                if (branch[3][3] != false) {
                                    classNode.extends = branch[3][3][0];
                                }

                                if (parentBranches != null && parentBranches.length > 0) {
                                    // Add namespaces
                                    parentBranches.forEach(item => {
                                        classNode.namespaceParts.push(item);
                                    });
                                }

                                branch = branch[3];

                                // Build interfaces
                                if (Array.isArray(branch[4])) {
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

                                // Build Properties
                                this.buildTreeProperties(branch[5].properties, classNode, tree);
                                // Build Constants
                                this.buildTreeConstants(branch[5].constants, classNode, tree);
                                // Build Methods
                                this.buildTreeMethods(branch[5].methods, classNode, tree);

                                // Build Traits
                                branch[5].use.traits.forEach(traitLevel => {
                                    classNode.traits.push(traitLevel[0]);
                                });

                                var symbolCache = new FileSymbolCache();
                                symbolCache.name = classNode.name;
                                symbolCache.type = SymbolType.Class;
                                symbolCache.kind = SymbolKind.Class;
                                symbolCache.startLine = classNode.startPos.line;
                                symbolCache.startChar = classNode.startPos.col;
                                symbolCache.endLine = classNode.endPos.line;
                                symbolCache.endChar = classNode.endPos.col;
                                tree.symbolCache.push(symbolCache);

                                tree.classes.push(classNode);
                            }
                            break;
                    }
                    break;
            }
        }
        return tree;
    }

    private buildTreeProperties(properties: Array<any>, parentNode: ClassNode, tree:FileNode) {
        properties.forEach(propLevel => {
            propLevel[3].forEach(pLevel => {
                let propNode: PropertyNode = new PropertyNode();

                propNode.startPos = this.BuildStartLocation(propLevel[3][0][1]);
                propNode.endPos = this.BuildEndLocation(propLevel[3][0][2]);

                if (Array.isArray(propLevel[4]) && propLevel[4].length > 0) {
                    // What is the properties access level?
                    if (propLevel[4][0] == 0) {
                        propNode.accessModifier = AccessModifierNode.public;
                    }
                    if (propLevel[4][0] == 1) {
                        propNode.accessModifier = AccessModifierNode.protected;
                    }
                    if (propLevel[4][0] == 2) {
                        propNode.accessModifier = AccessModifierNode.private;
                    }

                    // is this property static?
                    if (propLevel[4][1] == 1) {
                        propNode.isStatic = true;
                    }
                }

                propNode.name = pLevel[3][0];

                if (pLevel[3][1] != null) {
                    let type = pLevel[3][1][0];

                    if (type == "position") {
                        type = pLevel[3][1][3][0];
                    }

                    if (type == "string" || type == "number" || type == "array") {
                        propNode.type = type;
                        //propNode.value = codeLevel[3][1][1];
                    } else if (type == "const") {
                        if (pLevel[3][1][1][0].toLowerCase() == "true" || pLevel[3][1][1][0].toLowerCase() == "false") {
                            propNode.type = "boolean";
                        } else if (pLevel[3][1][1][0].toLowerCase() == "null") {
                            propNode.type = "null";
                        }
                        //propNode.value = codeLevel[2][1];
                    }
                }

                var symbolCache = new FileSymbolCache();
                symbolCache.name = propNode.name;
                symbolCache.type = SymbolType.Property;
                symbolCache.kind = SymbolKind.Property;
                symbolCache.parentName = parentNode.name;
                symbolCache.startLine = propNode.startPos.line;
                symbolCache.startChar = propNode.startPos.col;
                symbolCache.endLine = propNode.endPos.line;
                symbolCache.endChar = propNode.endPos.col;
                tree.symbolCache.push(symbolCache);

                parentNode.properties.push(propNode);
            });
        });
    }

    private buildTreeConstants(constants: Array<any>, parentNode: ClassNode, tree: FileNode) {
        constants.forEach(constLevel => {
            constLevel[3].forEach(cLevel => {
                let constNode: ConstantNode = new ConstantNode();

                constNode.startPos = this.BuildStartLocation(constLevel[1]);
                constNode.endPos = this.BuildEndLocation(constLevel[2]);

                constNode.name = cLevel[3][0];
                if (cLevel[3][1] != null) {
                    constNode.type = cLevel[3][1][0];
                    constNode.value = cLevel[3][1][1];
                }

                var symbolCache = new FileSymbolCache();
                symbolCache.name = constNode.name;
                symbolCache.type = SymbolType.Constant;
                symbolCache.kind = SymbolKind.Field;
                symbolCache.parentName = parentNode.name;
                symbolCache.startLine = constNode.startPos.line;
                symbolCache.startChar = constNode.startPos.col;
                symbolCache.endLine = constNode.endPos.line;
                symbolCache.endChar = constNode.endPos.col;
                tree.symbolCache.push(symbolCache);

                parentNode.constants.push(constNode);
            });
        });
    }

    private buildTreeMethods(methods: Array<any>, parentNode: ClassNode, tree: FileNode) {
        methods.forEach(methodLevel => {
            // Build constructor (newstyle + oldstyle)
            if (Array.isArray(methodLevel[3]) && methodLevel[3].length > 0 &&
                methodLevel[3][1] == "__construct" || methodLevel[3][1] == parentNode.name) {
                let constructorNode: ConstructorNode = new ConstructorNode();

                constructorNode.name = methodLevel[3][1];
                constructorNode.startPos = this.BuildStartLocation(methodLevel[1]);
                constructorNode.endPos = this.BuildEndLocation(methodLevel[2]);

                if (methodLevel[3][1] == parentNode.name) {
                    constructorNode.isDeprecated = true;
                }

                constructorNode.params = this.BuildFunctionParams(methodLevel[3][2], tree.lineCache, constructorNode.startPos);

                if (methodLevel[3][6] != null) {
                    methodLevel[3][6].forEach(codeLevel => {
                        // Build local scope variable setters
                        let scopeVar = this.BuildVariableOrProp(codeLevel);
                        if (scopeVar != null) {
                            constructorNode.scopeVariables.push(scopeVar.variableNode);
                            if (scopeVar.lineCache != null) {
                                tree.lineCache.push(scopeVar.lineCache);
                            }
                        }

                        // Build function calls
                        let functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
                        functionCalls.forEach(element => {
                            constructorNode.functionCalls.push(element);
                        });

                        // Build imported global variables
                        if (codeLevel[0] == "global") {
                            codeLevel[1].forEach(importGlobalLevel => {
                                if (importGlobalLevel[0] == "var") {
                                    constructorNode.globalVariables.push(importGlobalLevel[1]);
                                }
                            });
                        }
                    });
                }

                parentNode.construct = constructorNode;
            } else {
                let methodNode: MethodNode = new MethodNode();

                methodNode.startPos = this.BuildStartLocation(methodLevel[1]);
                methodNode.endPos = this.BuildEndLocation(methodLevel[2]);

                // Build access modifier
                if (Array.isArray(methodLevel[4]) && methodLevel[4].length > 0) {
                    if (methodLevel[4][0] == 0) {
                        methodNode.accessModifier = AccessModifierNode.public;
                    }
                    if (methodLevel[4][0] == 1) {
                        methodNode.accessModifier = AccessModifierNode.protected;
                    }
                    if (methodLevel[4][0] == 2) {
                        methodNode.accessModifier = AccessModifierNode.private;
                    }

                    // Mark static
                    if (methodLevel[4][1] == 1) {
                        methodNode.isStatic = true;
                    }

                    // Mark abstract
                    if (methodLevel[4][2] == 1) {
                        methodNode.isAbstract = true;
                    }
                }

                methodNode.name = methodLevel[3][1];

                // Build return type
                if (methodLevel[3][5] != null && Array.isArray(methodLevel[3][5]) && methodLevel[3][5][0] != null) {
                    methodNode.returns = methodLevel[3][5][0];
                }

                methodNode.params = this.BuildFunctionParams(methodLevel[3][2], tree.lineCache, methodNode.startPos);

                if (Array.isArray(methodLevel[3][6])) {
                    methodLevel[3][6].forEach(codeLevel => {
                        if (Array.isArray(codeLevel)) {
                            // Build local scope variable setters
                            let scopeVar = this.BuildVariableOrProp(codeLevel);
                            if (scopeVar != null) {
                                methodNode.scopeVariables.push(scopeVar.variableNode);
                                if (scopeVar.lineCache != null) {
                                    tree.lineCache.push(scopeVar.lineCache);
                                }
                            }

                            // Build function calls
                            let functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
                            functionCalls.forEach(element => {
                                methodNode.functionCalls.push(element);
                            });

                            // Build imported global variables
                            if (codeLevel[0] == "global" && Array.isArray(codeLevel[1])) {
                                codeLevel[1].forEach(importGlobalLevel => {
                                    if (Array.isArray(importGlobalLevel) && importGlobalLevel[0] == "var") {
                                        methodNode.globalVariables.push(importGlobalLevel[1]);
                                    }
                                });
                            }
                        }
                    });
                }

                var symbolCache = new FileSymbolCache();
                symbolCache.name = methodNode.name;
                symbolCache.type = SymbolType.Method;
                symbolCache.kind = SymbolKind.Method;
                symbolCache.parentName = parentNode.name;
                symbolCache.startLine = methodNode.startPos.line;
                symbolCache.startChar = methodNode.startPos.col;
                symbolCache.endLine = methodNode.endPos.line;
                symbolCache.endChar = methodNode.endPos.col;
                tree.symbolCache.push(symbolCache);

                parentNode.methods.push(methodNode);
            }
        });
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
    private BuildFunctionParams(paramsArray, lineCache, methodStartPos): ParameterNode[]
    {
        var params: ParameterNode[] = [];

        if (Array.isArray(paramsArray) && paramsArray.length != 0)
        {
            // Build parameters
            paramsArray.forEach(paramLevel =>
            {
                let paramNode: ParameterNode = new ParameterNode();
                paramNode.name = paramLevel[0];
                paramNode.startPos = methodStartPos;

                if (Array.isArray(paramLevel[1])) {
                    paramNode.type = paramLevel[1][paramLevel[1].length - 1];
                    var lineCacheItem = new LineCache();
                    lineCacheItem.name = paramNode.name;
                    lineCacheItem.value = paramNode.type;
                    lineCacheItem.line = paramNode.startPos.line;
                    lineCache.push(lineCacheItem);
                } else {
                    paramNode.type = paramLevel[1];
                }

                if (Array.isArray(paramLevel[2]) && paramLevel[2].length != 0) {
                    paramNode.optional = true;
                    paramNode.type = paramLevel[2][0];
                }

                params.push(paramNode);
            });
        }

        return params;
    }

    private BuildVariableOrProp(codeLevel): any
    {
        if (codeLevel[0] == "set")
        {
            if (codeLevel[1][0] == "var")
            {
                let variableNode: VariableNode = new VariableNode();
                let lineCache: LineCache = null;

                variableNode.name = codeLevel[1][1];

                var type = codeLevel[2][0];
                if (type == "string" || type == "number") {
                    variableNode.type = type;
                    variableNode.value = codeLevel[2][1];
                } else if (type == "const") {
                    variableNode.type = "boolean";
                    variableNode.value = codeLevel[2][1];
                } else if (type == "position") {
                    if (codeLevel[2][3] != null && Array.isArray(codeLevel[2][3]) && codeLevel[2][3][0] == "new") {

                        if (codeLevel[2][3][1][0] == "ns") {
                            variableNode.type = codeLevel[2][3][1][1][0];
                        } else {
                            variableNode.type = codeLevel[2][3][1][0];
                            //variableNode.value = codeLevel[2][3][1][0];
                        }

                        variableNode.startPos = this.BuildStartLocation(codeLevel[2][1]);
                        variableNode.endPos = this.BuildEndLocation(codeLevel[2][2]);

                        lineCache = new LineCache();
                        lineCache.line = variableNode.startPos.line;
                        lineCache.name = variableNode.name;
                        lineCache.value = variableNode.value;
                    }
                } else if (type == "call") {
                    // TODO -- handle function return params
                    // TODO -- check if it's a namespaced class (?)
                }

                return { variableNode: variableNode, lineCache: lineCache };
            }
            else if (codeLevel[1][0] == "prop")
            {
                let propSetNode: VariableNode = new VariableNode();
                let lineCache: LineCache = null;

                if (codeLevel[1][1][1] == "$this") {
                    propSetNode.name = codeLevel[1][2][1];

                    let type = codeLevel[2][0];
                    if (type == "string" || type == "number") {
                        propSetNode.type = type;
                        propSetNode.value = codeLevel[2][1];
                    } else if (type == "const") {
                        propSetNode.type = "boolean";
                        propSetNode.value = codeLevel[2][1];
                    } else if (type == "position") {
                        if (codeLevel[2][3] != null && Array.isArray(codeLevel[2][3]) && codeLevel[2][3][0] == "new") {
                            propSetNode.type = codeLevel[2][3][1][0];
                            //propSetNode.value = codeLevel[2][3][1][0];
                            propSetNode.variableType = "property";

                            propSetNode.startPos = this.BuildStartLocation(codeLevel[2][1]);
                            propSetNode.endPos = this.BuildEndLocation(codeLevel[2][2]);

                            lineCache = new LineCache();
                            lineCache.line = propSetNode.startPos.line;
                            lineCache.name = propSetNode.name;
                            lineCache.value = propSetNode.value;
                        }
                    }
                }

                return { variableNode: propSetNode, lineCache: lineCache };
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

            if (Array.isArray(codeLevel[1]) && codeLevel[1][0] == "ns" && Array.isArray(codeLevel[1][1])) {
                var arrLength = codeLevel[1][1].length;
                funcNode.name = codeLevel[1][1][arrLength - 1];
                codeLevel[1][1].forEach(item => {
                    if (item != funcNode.name) {
                        funcNode.parents.push(item);
                    }
                });
            }
            else // Handle class function calls (ie. $this->call() instead of call())
            {
                if (Array.isArray(codeLevel[1])) {
                    // Set the name
                    funcNode.name = codeLevel[1][codeLevel[1].length - 1][1];

                    // Build parents of called function (eg. $this from $this->func(), etc)
                    var parents = this.BuildParents(codeLevel[1], funcNode.name);
                    if (parents != null) {
                        funcNode.parents = parents;
                    }
                }
            }

            codeLevel[2].forEach(funcCallLevel =>
            {
                var paramNode: ParameterNode = new ParameterNode();

                if (Array.isArray(funcCallLevel) && funcCallLevel.length == 2) {
                    paramNode.name = funcCallLevel[1];
                } else { // Handle properties (ie. $this->var instead of just $var)
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
    public name: string = '';
    public refName: string = '';
    public startPos: PositionInfo;
    public endPos: PositionInfo;
}

export class FileNode
{
    public path: string = '';
    public constants: ConstantNode[] = [];
    public topLevelVariables: VariableNode[] = [];
    public functions: MethodNode[] = [];
    public namespaceUsings: NamespaceUsingNode[] = [];
    public classes: ClassNode[] = [];
    public interfaces: InterfaceNode[] = [];
    public traits: TraitNode[] = [];

    // Any files that we're referencing with include(), require(), include_once() or require_once()
    public fileReferences: string[] = [];

    public symbolCache: FileSymbolCache[] = [];
    public lineCache: LineCache[] = [];
}

export class FileSymbolCache
{
    public name: string;
    public type: SymbolType;
    public kind: SymbolKind;
    public parentName: string = '';
    public startLine: number = 1;
    public endLine: number = 1;
    public startChar: number = 1;
    public endChar: number = 1;
    public path: string = '';
}

export class LineCache
{
    public line: number;
    public name: string = '';
    public value: string = '';
}

export enum SymbolType
{
    Unknown,
    Class,
    Interface,
    Trait,
    Property,
    Method,
    Constant,
    TopLevelVariable,
    TopLevelFunction
}

export class NamespaceUsingNode extends BaseNode
{
    // The parent parts in the correct order (eg. use [Parent1]\[Parent1]\Namespace)
    public parents: string[] = [];
}

export class ClassNode extends BaseNode
{
    public implements: string[] = [];
    public extends: string = '';
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
    public namespaceParts: string[] = [];
}

export class MethodNode extends BaseNode
{
    public params: ParameterNode[] = [];
    public returns: string = "unknown";
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
    public type: string = "unknown";
    public value: string = '';
    public variableType: string = "variable"; // "variable" or "property"
}

export class ParameterNode extends VariableNode
{
    public optional: boolean = false;
    public parents: string[] = [];
}

export class PropertyNode extends BaseNode
{
    public type: string = "unknown";
    public accessModifier: AccessModifierNode;
    public isStatic: boolean = false;
}

export class ConstantNode extends BaseNode
{
    // Constants are always public
    // Constants (should) only be basic types
    public type: string = "unknown";
    public value: string = '';
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
