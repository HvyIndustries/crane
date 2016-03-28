"use strict";

var phpParser = require("php-parser");

export class TreeBuilder
{
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

                resolve(returnObj);
            });
        });
    }

    // Convert the generated AST into a usable object tree
    private BuildObjectTree(ast, filePath:string) : Promise<FileNode>
    {
        return new Promise<FileNode>((resolve, reject) => {
            let tree: FileNode = new FileNode();

            tree.path = filePath;
            tree.classes = this.BuildClassDeclarations(ast);
            // tree.constants = this.BuildConstantDeclarations(ast);
            // tree.topLevelVariables = this.BuildVariableDeclarations(ast, 0);
            // tree.functions = this.BuildFunctionDeclarations(ast);
            // tree.interfaces = this.BuildInterfaceDeclarations(ast);
            // tree.traits = this.BuildTraitDeclarations(ast);
            // tree.fileReferences = this.BuildReferences(ast);

            resolve(tree);
            //return tree;
        });
    }

    // Crunch through the generated tree to build a cache of symbols in this file
    private BuildSymbolCache(tree:FileNode, filePath:string)
    {
        let cache: SymbolCache[] = [];
        // TODO
        return cache;
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

                    propLevel = propLevel[3][0];
                    propNode.name = propLevel[3][0];

                    if (propLevel[3][1] != null) {
                        propNode.type = propLevel[3][1];
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

                    if (methodLevel[3][2] != null && methodLevel[3][2].length != 0)
                    {
                        // Build parameters
                        methodLevel[3][2].forEach(paramLevel =>
                        {
                            let paramNode: ParameterNode = new ParameterNode();
                            paramNode.name = paramLevel[0];

                            if (paramLevel[2] != null && paramLevel[2].length != 0) {
                                paramNode.optional = true;
                                paramNode.type = paramLevel[2][0];
                            } else {
                                paramNode.type = paramLevel[1];
                            }

                            methodNode.params.push(paramNode);
                        });
                    }

                    // Build local variable setters
                    methodLevel[3][5].forEach(codeLevel =>
                    {
                        if (codeLevel[0] == "set")
                        {
                            if (codeLevel[1][0] == "var")
                            {
                                let variableNode: VariableNode = new VariableNode();
                                variableNode.name = codeLevel[1][1];
                                variableNode.type = codeLevel[2][0];

                                methodNode.scopeVariables.push(variableNode);
                            }
                        }

                        // Build function calls
                        if (codeLevel[0] == "call")
                        {
                            var funcNode: FunctionCallNode = new FunctionCallNode();

                            // TODO -- Handle class function calls (ie. $this->call() instead of call())
                            funcNode.name = codeLevel[1][1][0];

                            codeLevel[2].forEach(funcCallLevel =>
                            {
                                // TODO -- Handle properties (ie. $this->prop instead of just $var)
                                funcNode.params.push(funcCallLevel[1]);
                            });

                            methodNode.functionCalls.push(funcNode);
                        }

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

                    classNode.functions.push(methodNode);
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

    private BuildStartLocation(start): PositionInfo
    {
        return new PositionInfo(start[0], start[1], start[2]);
    }

    private BuildEndLocation(end): PositionInfo
    {
        return new PositionInfo(end[0], end[1], end[2]);
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
    public functions: MethodNode[] = [];
    public constants: ConstantNode[] = [];
    public traits: string[] = [];
}

export class TraitNode extends ClassNode {}

export class InterfaceNode extends BaseNode
{
    public extends: string[] = [];
    public constants: ConstantNode[] = [];
    public functions: MethodNode[] = [];
}

export class MethodNode extends BaseNode
{
    public params: ParameterNode[] = [];
    public returns: string;
    public accessModifier: AccessModifierNode = AccessModifierNode.public;
    public isStatic: boolean = false;
    public globalVariables: string[] = [];
    public scopeVariables: VariableNode[] = [];
    public functionCalls: FunctionCallNode[] = [];
}

export class FunctionCallNode extends BaseNode
{
    public params: string[] = [];
}

export class VariableNode extends BaseNode
{
    public type: string;
}

export class ParameterNode extends VariableNode
{
    public optional: boolean = false;
}

export class PropertyNode extends BaseNode
{
    public type: string;
    public accessModifier: AccessModifierNode;
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
