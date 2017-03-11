/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

// Entity Schema
// TODO - if/else blocks
//      - switch blocks
//      - handle autoloaded files


export class BaseNode
{
    constructor(name = "") {
        this.name = name;
    }

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
    public namespaces: NamespaceNode[] = [];
    public namespaceParts: NamespacePart[] = [];

    // Any files that we're referencing with include(), require(), include_once() or require_once()
    public fileReferences: string[] = [];

    public symbolCache: FileSymbolCache[] = [];
    public lineCache: LineCache[] = [];
}

export class FileSymbolCache
{
    public name: string;
    public type: SymbolType;
    public parentName: string;
}

export class LineCache
{
    public line: number;
    public name: string;
    public value: string;
}

export class NamespaceCache
{
    public namespaces: NamespacePart[] = [];
}

export class NamespacePart
{
    constructor(name = null)
    {
        this.name = name;
    }

    public name: string;
    public children: NamespacePart[] = [];
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
    public alias: string;
}

export class NamespaceNode extends BaseNode {}

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
    public namespace: string;
    public construct: ConstructorNode;
}

export class TraitNode extends ClassNode {}

export class InterfaceNode extends BaseNode
{
    public extends: string[] = [];
    public constants: ConstantNode[] = [];
    public methods: MethodNode[] = [];
    public namespace: string;
}

export class MethodNode extends BaseNode
{
    public params: ParameterNode[] = [];
    public returns: string = "unknown";
    public accessModifier: AccessModifierNode = AccessModifierNode.public;
    public isStatic: boolean = false;
    public isAbstract: boolean = false;
    public isFinal: boolean = false;
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
    public value: string;
    public variableType: string = "variable"; // "variable" or "property"
}

export class ParameterNode extends VariableNode
{
    public optional: boolean = false;
    public parents: string[] = [];
    public byRef: boolean = false;
    public nullable: boolean = false;

    // To be used with doc comment parsing integration later on
    public docType: string = "";
    public docDescription: string = "";
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
