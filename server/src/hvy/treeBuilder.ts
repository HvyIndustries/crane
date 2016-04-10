/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

var phpParser = require("php-parser");

export class TreeBuilder
{
    // v1.1

    // TODO -- Handle PHP written inside an HTML file (strip everything except php code)

    // Parse PHP code to generate an object tree for intellisense suggestions
    public Parse(text:string, filePath:string) : Promise<any>
    {
        return new Promise((resolve, reject) =>
        {
            phpParser.parser.locations = true;
            phpParser.parser.docBlocks = true;
            var ast = phpParser.parseCode(text);

            this.BuildObjectTree(ast, filePath).then((tree) =>
            {
                // TODO -- Convert this to promise
                var symbolCache = this.BuildSymbolCache(tree, filePath);

                var returnObj = {
                    tree: tree,
                    symbolCache: symbolCache
                };

                // DEBUG
                //console.log("Built tree for file: " + filePath);

                resolve(returnObj);
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
            tree.fileReferences = this.BuildFileReferences(ast);
            tree.classes = this.BuildClassDeclarations(ast);
            tree.constants = this.BuildTopLevelConstantDeclarations(ast);
            tree.topLevelVariables = this.BuildTopLevelVariableDeclarations(ast);
            tree.functions = this.BuildTopLevelFunctionDeclarations(ast);
            tree.interfaces = this.BuildInterfaceDeclarations(ast);
            tree.traits = this.BuildTraitDeclarations(ast);

            resolve(tree);
        });
    }

    // Crunch through the generated tree to build a cache of symbols in this file
    private BuildSymbolCache(tree:FileNode, filePath:string)
    {
        let cache: SymbolCache[] = [];
        // TODO
        return cache;
    }

    private BuildFileReferences(ast): string[]
    {
        var refs: string[] = [];
        var topLevel = ast[1];

        topLevel.forEach(section =>
        {
            if (section[1] == "require" || section[1] == "require_once" || section[1] == "include" || section[1] == "include_once")
            {
                // TODO -- Convert PHP constants such as dirname(__DIR__) and dirname(__FILE__) to absolute paths
                // TODO -- Convert concatination to absolute paths (eg. "folder/" . "file.php")
                var path = section[2][1];
                refs.push(path);
            }
        });

        return refs;
    }

    private BuildClassDeclarations(ast)
    {
        var classes: ClassNode[] = [];
        var section = ast[1];

        section.forEach(topLevel =>
        {
            // Build classes
            if (topLevel[3] != null && topLevel[3][0] == "class")
            {
                var classNode: ClassNode = new ClassNode();

                classNode.startPos = this.BuildStartLocation(topLevel[1]);
                classNode.endPos = this.BuildEndLocation(topLevel[2]);

                classNode.name = topLevel[3][1];
                classNode.extends = topLevel[3][3][0];

                topLevel = topLevel[3];

                // Build interfaces
                if (topLevel[4] != false)
                {
                    for (var i = 0; i < topLevel[4].length; i++) {
                        var subElement = topLevel[4][i];
                        classNode.implements.push(subElement[0]);
                    }
                }

                if (topLevel[2] == 187) {
                    classNode.isAbstract = true;
                }

                if (topLevel[2] == 189) {
                    classNode.isFinal = true;
                }

                // Build properties
                topLevel[5].properties.forEach(propLevel =>
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
                topLevel[5].constants.forEach(constLevel =>
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
                topLevel[5].methods.forEach(methodLevel =>
                {
                    // Build constructor (newstyle + oldstyle)
                    if (methodLevel[3][1] == "__construct" || methodLevel[3][1] == classNode.name)
                    {
                        var constructorNode: ConstructorNode = new ConstructorNode();

                        constructorNode.name = methodLevel[3][1];
                        constructorNode.startPos = this.BuildStartLocation(methodLevel[1]);
                        constructorNode.endPos = this.BuildEndLocation(methodLevel[2]);

                        if (methodLevel[3][1] == classNode.name)
                        {
                            constructorNode.isDeprecated = true;
                        }

                        constructorNode.params = this.BuildFunctionParams(methodLevel[3][2]);

                        if (methodLevel[3][5] != null)
                        {
                            methodLevel[3][5].forEach(codeLevel =>
                            {
                                // Build local scope variable setters
                                var scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                                if (scopeVar != null)
                                {
                                    constructorNode.scopeVariables.push(scopeVar);
                                }

                                // Build function calls
                                var functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
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
                        var methodNode: MethodNode = new MethodNode();

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

                        if (methodLevel[3][5] != null)
                        {
                            methodLevel[3][5].forEach(codeLevel =>
                            {
                                // Build local scope variable setters
                                var scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                                if (scopeVar != null)
                                {
                                    methodNode.scopeVariables.push(scopeVar);
                                }

                                // Build function calls
                                var functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
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
                topLevel[5].use.traits.forEach(traitLevel =>
                {
                    classNode.traits.push(traitLevel[0]);
                });

                classes.push(classNode);
            }
        });

        return classes;
    }
    
    private BuildTopLevelConstantDeclarations(ast): ConstantNode[]
    {
        var constants: ConstantNode[] = [];
        var topLevel = ast[1];

        topLevel.forEach(element =>
        {
            if (element[0] == "const")
            {
                var constantNode: ConstantNode = new ConstantNode();
                constantNode.name = element[1][0][0];
                constantNode.type = element[1][0][1][0];

                // TODO -- Build location

                constants.push(constantNode);
            }
        });

        return constants;
    }
    
    private BuildTopLevelVariableDeclarations(ast): VariableNode[]
    {
        var variables: VariableNode[] = [];
        var topLevel = ast[1];

        topLevel.forEach(element =>
        {
            if (element[0] == "set")
            {
                var variableNode: VariableNode = new VariableNode();

                variableNode.name = element[1][1];
                variableNode.type = element[2][0];

                variables.push(variableNode);
            }
        });

        return variables;
    }

    private BuildTopLevelFunctionDeclarations(ast): MethodNode[]
    {
        var functions: MethodNode[] = [];
        var topLevel = ast[1];

        topLevel.forEach(element =>
        {
            if (element[0] == "position")
            {
                if (element[3][0] == "function")
                {
                    var methodNode: MethodNode = new MethodNode();

                    methodNode.startPos = this.BuildStartLocation(element[1]);
                    methodNode.endPos = this.BuildEndLocation(element[2]);

                    methodNode.name = element[3][1];

                    methodNode.params = this.BuildFunctionParams(element[3][2]);

                    element[3][5].forEach(codeLevel =>
                    {
                        // Build local scope variable setters
                        var scopeVar = this.BuildFunctionScopeVariables(codeLevel);
                        if (scopeVar != null)
                        {
                            methodNode.scopeVariables.push(scopeVar);
                        }

                        // Build function calls
                        var functionCalls = this.BuildFunctionCallsToOtherFunctions(codeLevel);
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

                    functions.push(methodNode);
                }
            }
        });

        return functions;
    }
    
    private BuildInterfaceDeclarations(ast): InterfaceNode[]
    {
        var interfaces: InterfaceNode[] = [];
        var topLevel = ast[1];

        topLevel.forEach(element =>
        {
            if (element[0] == "position")
            {
                if (element[3][0] == "interface")
                {
                    var interfaceNode: InterfaceNode = new InterfaceNode();

                    interfaceNode.name = element[3][1];

                    // Build position
                    interfaceNode.startPos = this.BuildStartLocation(element[1]);
                    interfaceNode.endPos = this.BuildEndLocation(element[2]);

                    element[3][3].forEach(extendedInterface =>
                    {
                        interfaceNode.extends.push(extendedInterface[0]);
                    });

                    // Build constants
                    element[3][4].constants.forEach(constant =>
                    {
                        var constantNode: ConstantNode = new ConstantNode();
                        constantNode.name = constant[3][0][3][0];
                        constantNode.type = constant[3][0][3][1][0];

                        constantNode.startPos = this.BuildStartLocation(constant[3][0][1]);
                        constantNode.endPos = this.BuildEndLocation(constant[3][0][2]);

                        interfaceNode.constants.push(constantNode);
                    });

                    // Build methods
                    element[3][4].methods.forEach(method =>
                    {
                        var methodNode: MethodNode = new MethodNode();
                        methodNode.name = method[3][1];

                        methodNode.startPos = this.BuildStartLocation(method[1]);
                        methodNode.endPos = this.BuildEndLocation(method[2]);

                        methodNode.params = this.BuildFunctionParams(method[3][2]);

                        // TODO -- Add return value

                        interfaceNode.methods.push(methodNode);
                    });

                    interfaces.push(interfaceNode);
                }
            }
        });

        return interfaces;
    }

    private BuildTraitDeclarations(ast): TraitNode[]
    {
        var traits: TraitNode[] = [];
        var topLevel = ast[1];

        topLevel.forEach(element =>
        {
            if (element[0] == "position")
            {
                if (element[3][0] == "trait")
                {
                    var traitNode: TraitNode = new TraitNode();

                    traitNode.name = element[3][1];

                    // Build position
                    traitNode.startPos = this.BuildStartLocation(element[1]);
                    traitNode.endPos = this.BuildEndLocation(element[2]);

                    traitNode.extends = element[3][2][0];

                    element[3][4].properties.forEach(propLevel =>
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
                    element[3][4].constants.forEach(constant =>
                    {
                        var constantNode: ConstantNode = new ConstantNode();
                        constantNode.name = constant[3][0][3][0];
                        constantNode.type = constant[3][0][3][1][0];

                        constantNode.startPos = this.BuildStartLocation(constant[3][0][1]);
                        constantNode.endPos = this.BuildEndLocation(constant[3][0][2]);

                        traitNode.constants.push(constantNode);
                    });

                    // Build methods
                    element[3][4].methods.forEach(method =>
                    {
                        var methodNode: MethodNode = new MethodNode();
                        methodNode.name = method[3][1];

                        methodNode.startPos = this.BuildStartLocation(method[1]);
                        methodNode.endPos = this.BuildEndLocation(method[2]);

                        methodNode.params = this.BuildFunctionParams(method[3][2]);

                        // TODO -- Abstract methods
                        methodNode.isAbstract = false;

                        traitNode.methods.push(methodNode);
                    });

                    // TODO -- Add traits used in this trait
                    element[3][4].use.traits.forEach(traitLevel =>
                    {
                        traitNode.traits.push(traitLevel[0]);
                    });

                    traits.push(traitNode);
                }
            }
        });

        return traits;
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
                funcNode.name = codeLevel[1][1][0];
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
//      - namespaces

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
    public classes: ClassNode[] = [];
    public interfaces: InterfaceNode[] = [];
    public traits: TraitNode[] = [];

    // Any files that we're referencing with include(), require(), include_once() or require_once()
    public fileReferences: string[];
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
    public construct: ConstructorNode;
}

export class TraitNode extends ClassNode {}

export class InterfaceNode extends BaseNode
{
    public extends: string[] = [];
    public constants: ConstantNode[] = [];
    public methods: MethodNode[] = [];
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
