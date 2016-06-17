/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { TextDocumentPosition, ITextDocument, CompletionItem, CompletionItemKind } from 'vscode-languageserver';
import {
    TreeBuilder, FileNode, FileSymbolCache,
    SymbolType, AccessModifierNode, ClassNode
} from "./hvy/treeBuilder";

export class SuggestionBuilder
{
    private workspaceTree: FileNode[];
    private currentFileNode: FileNode;

    private filePath: string;
    private lineIndex: number;
    private charIndex: number;

    private doc: ITextDocument;
    private text: string;
    private lines: string[];

    private currentLine: string;
    private lastChar: string;

    public prepare(textDocumentPosition: TextDocumentPosition, document: ITextDocument, workspaceTree: FileNode[])
    {
        this.workspaceTree = workspaceTree;

        this.filePath = this.buildDocumentPath(textDocumentPosition.uri);
        this.lineIndex = textDocumentPosition.position.line;
        this.charIndex = textDocumentPosition.position.character;

        this.doc = document;
        this.text = this.doc.getText();
        this.lines = this.text.split(/\r\n|\r|\n/gm);

        this.currentLine = this.lines[this.lineIndex];
        this.lastChar = this.currentLine[this.charIndex - 1];

        this.currentFileNode = this.workspaceTree.filter(item => {
            return item.path == this.filePath;
        })[0];
    }

    public build() : CompletionItem[]
    {
        var scope = this.getScope();
        var toReturn: CompletionItem[] = [];
        var options = new ScopeOptions();

        switch (scope.level) {
            case ScopeLevel.Root:
                if (scope.name == null) {
                    // Top level
                    // Suggestions:
                    //  - other top level variables/constants
                    //  - top level functions
                    //  - classes/interfaces/traits
                    //  - namespaces (after 'use')
                    options.topConstants = true;
                    options.topVariables = true;
                    options.topFunctions = true;
                    options.classes = true;
                    options.interfaces = true;
                    options.traits = true;
                    options.namespaces = true;
                    toReturn = this.buildSuggestionsForScope(scope, options);
                } else {
                    // Top level function
                    // Suggestions:
                    //  - other top level functions
                    //  - local scope variables
                    //  - parameters
                    //  - variables included with 'global'
                    //  - classes
                    options.topFunctions = true;
                    options.localVariables = true;
                    options.parameters = true;
                    options.globalVariables = true;
                    options.classes = true;
                    toReturn = this.buildSuggestionsForScope(scope, options);
                }
                break;

            case ScopeLevel.Trait:
            case ScopeLevel.Class:
                if (scope.name == null) {
                    // Within class, not in method or constructor
                    // Suggestions
                    //  - classes (after '=' or 'extends')
                    //  - interfaces (after 'implements')
                    //  - traits (after 'use')
                    options.classes = true;
                    options.interfaces = true;
                    options.traits = true;
                    toReturn = this.buildSuggestionsForScope(scope, options);
                } else {
                    if (scope.name == "constructor") {
                        // Within constructor
                        // Suggestions
                        //  - classes
                        //  - local variables
                        //  - parameters
                        options.classes = true;
                        options.localVariables = true;
                        options.parameters = true;
                        toReturn = this.buildSuggestionsForScope(scope, options);
                    } else {
                        // Within method
                        // Suggestions
                        //  - classes
                        //  - local variables
                        //  - parameters
                        options.classes = true;
                        options.localVariables = true;
                        options.parameters = true;
                        toReturn = this.buildSuggestionsForScope(scope, options);
                    }
                }
                break;

            case ScopeLevel.Interface:
            default:
                break;
        }


        return toReturn;
    }

    private buildSuggestionsForScope(scope: Scope, options: ScopeOptions) : CompletionItem[]
    {
        var toReturn: CompletionItem[] = [];
        // Interpret the options object to determine what to include in suggestions
        // Interpret the scope object to determine what suggestions to include for -> and :: accessors, etc

        // TODO -- Don't show all of the below for instance variables, etc

        // TODO -- Check we're on a line below where they're defined
        // TODO -- Include these if the file is included in the current file
        if (options.topConstants) {
            this.currentFileNode.constants.forEach(item => {
                let value = item.value;
                if (item.type == "string") {
                    value = "\"" + value + "\"";
                }
                toReturn.push({ label: item.name, kind: CompletionItemKind.Value, detail: `(constant) : ${item.type} : ${value}` });
            });
        }

        if (options.topVariables) {
            this.currentFileNode.topLevelVariables.forEach(item => {
                toReturn.push({ label: item.name, kind: CompletionItemKind.Variable, detail: `(variable) : ${item.type}` });
            });
        }

        if (options.topFunctions) {
            this.currentFileNode.functions.forEach(item => {
                toReturn.push({ label: item.name, kind: CompletionItemKind.Function,  detail: `(function) : ${item.returns}`, insertText: item.name + "()" });
            });
        }

        this.workspaceTree.forEach(fileNode => {
            if (options.classes) {
                fileNode.classes.forEach(item => {
                    toReturn.push({ label: item.name, kind: CompletionItemKind.Class, detail: "(class)" });
                });
            }

            if (options.interfaces) {
                fileNode.interfaces.forEach(item => {
                    toReturn.push({ label: item.name, kind: CompletionItemKind.Interface, detail: "(interface)" });
                });
            }

            if (options.traits) {
                fileNode.traits.forEach(item => {
                    toReturn.push({ label: item.name, kind: CompletionItemKind.Module, detail: "(trait)" });
                });
            }
        });

        return toReturn;
    }

    private getScope() : Scope
    {
        // Are we inside a class?
        this.currentFileNode.classes.forEach(classNode => {
            if (this.withinBlock(classNode)) {
                if (this.withinBlock(classNode.construct)) {
                    return new Scope(ScopeLevel.Class, "constructor", classNode.name);
                }
                classNode.methods.forEach(method => {
                    if (this.withinBlock(method)) {
                        return new Scope(ScopeLevel.Class, method.name, classNode.name);
                    }
                });
                return new Scope(ScopeLevel.Class, null, classNode.name);
            }
        });

        // Are we inside a trait?
        this.currentFileNode.traits.forEach(trait => {
            if (this.withinBlock(trait)) {
                if (this.withinBlock(trait.construct)) {
                    return new Scope(ScopeLevel.Trait, "constructor", trait.name);
                }
                trait.methods.forEach(method => {
                    if (this.withinBlock(method)) {
                        return new Scope(ScopeLevel.Trait, method.name, trait.name);
                    }
                });
                return new Scope(ScopeLevel.Trait, null, trait.name);
            }
        });

        // Are we inside an interface?
        this.currentFileNode.interfaces.forEach(item => {
            if (this.withinBlock(item)) {
                return new Scope(ScopeLevel.Interface, null, item.name);
            }
        });

        // Are we inside a top level function?
        this.currentFileNode.functions.forEach(func => {
            if (this.withinBlock(func)) {
                return new Scope(ScopeLevel.Root, func.name, null);
            }
        });

        // Must be at the top level of a file
        return new Scope(ScopeLevel.Root, null, null);
    }

    private withinBlock(block) : boolean
    {
        if (block.startPos.line <= this.lineIndex && block.endPos.line >= this.lineIndex) {
            return true;
        }

        return false;
    }

    private buildDocumentPath(uri: string) : string
    {
        var path = uri;
        path = path.replace("file:///", "");
        path = path.replace("%3A", ":");

        // Handle Windows and Unix paths
        switch (process.platform) {
            case 'darwin':
                path = "/" + path;
                break;
            case 'win32':
                path = path.replace(/\//g, "\\");
                break;
        }

        return path;
    }
}

class Scope
{
    public level: ScopeLevel;
    public name;
    public parent;

    constructor(level, name, parent) {
        this.level = level;
        this.name = name;
        this.parent = parent;
    }
}

class ScopeOptions
{
    public topVariables = false;
    public topConstants = false;
    public topFunctions = false;

    public classes = false;
    public interfaces = false;
    public traits = false;
    public namespaces = false;

    public localVariables = false;
    public globalVariables = false;
    public parameters = false;
}

enum ScopeLevel
{
    Root,
    Class,
    Interface,
    Trait
}