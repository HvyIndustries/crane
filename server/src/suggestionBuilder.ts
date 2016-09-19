/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { TextDocumentPositionParams, TextDocument, CompletionItem, CompletionItemKind } from 'vscode-languageserver';
import {
    TreeBuilder, FileNode, FileSymbolCache,
    SymbolType, AccessModifierNode, ClassNode, TraitNode,
    MethodNode
} from "./hvy/treeBuilder";

const fs = require('fs');

export class SuggestionBuilder
{
    private workspaceTree: FileNode[];
    private currentFileNode: FileNode;

    private filePath: string;
    private lineIndex: number;
    private charIndex: number;

    private doc: TextDocument;
    private currentLine: string;
    private lastChar: string;

    public prepare(textDocumentPosition: TextDocumentPositionParams, document: TextDocument, workspaceTree: FileNode[])
    {
        this.workspaceTree = workspaceTree;

        this.filePath = this.buildDocumentPath(textDocumentPosition.textDocument.uri);
        this.lineIndex = textDocumentPosition.position.line;
        this.charIndex = textDocumentPosition.position.character;

        this.doc = document;
        var text = document.getText();
        var lines = text.split(/\r\n|\r|\n/gm);

        // Replace tabs with spaces
        this.currentLine = lines[this.lineIndex].replace(/\t/gm, " ");
        this.lastChar = this.currentLine[this.charIndex - 1];
        // Note - this.lastChar will always be the last character of the line
        // because whitespace is stripped from the text so the index is wrong

        this.currentFileNode = this.workspaceTree.filter(item => {
            return item.path == this.filePath;
        })[0];
    }

    public build() : CompletionItem[]
    {
        var scope = this.getScope();
        var toReturn: CompletionItem[] = [];
        var options = new ScopeOptions();

        if (this.lastChar == ">") {
            toReturn = toReturn.concat(this.checkAccessorAndAddMembers(scope));
        } else if (this.lastChar == ":") {
            if (this.currentLine.substr(this.charIndex - 6, this.charIndex - 1) == "self::") {
                // Accessing via self::
                this.currentFileNode.classes.forEach(classNode => {
                    if (this.withinBlock(classNode)) {
                        // Add static members for this class
                        toReturn = toReturn.concat(this.addClassMembers(classNode, true, true, true));
                    }
                });
            } else {
                // Probably accessing via [ClassName]::
                var classNames = this.currentLine.trim().match(/\S(\B[a-z]+?)(?=::)/ig);
                if (classNames.length > 0) {
                    var className = classNames[classNames.length - 1];
                    var classNode = this.getClassNodeFromTree(className);
                    if (classNode != null) {
                        // Add static members for this class
                        toReturn = toReturn.concat(this.addClassMembers(classNode, true, false, false));
                    }
                }
            }
        } else {
            switch (scope.level) {
                case ScopeLevel.Root:
                    if (scope.name == null) {
                        // Top level
                        // Suggestions:
                        //  / other top level variables/constants
                        //  / top level functions
                        //  / classes/interfaces/traits
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
                        //  / other top level functions
                        //  / local scope variables
                        //  / parameters
                        //  / variables included with 'global'
                        //  / classes
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
                        //  / classes (after '=' or 'extends')
                        //  / interfaces (after 'implements')
                        //  / traits (after 'use')
                        options.classes = true;
                        options.interfaces = true;
                        options.traits = true;
                        toReturn = this.buildSuggestionsForScope(scope, options);
                    } else {
                        if (scope.name == "constructor") {
                            // Within constructor
                            // Suggestions
                            //  / classes
                            //  / local variables
                            //  / parameters
                            options.classes = true;
                            options.localVariables = true;
                            options.parameters = true;
                            toReturn = this.buildSuggestionsForScope(scope, options);
                        } else {
                            // Within method
                            // Suggestions
                            //  / classes
                            //  / local variables
                            //  / parameters
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
        }

        // Remove duplicated (overwritten) items
        var filtered = [];
        toReturn.forEach(item => {
            var found = false;
            filtered.forEach(subItem => {
                if (subItem.label == item.label) {
                    found = true;
                }
            });

            if (!found) {
                filtered.push(item);
            }
        });

        return filtered;
    }

    private buildSuggestionsForScope(scope: Scope, options: ScopeOptions) : CompletionItem[]
    {
        var toReturn: CompletionItem[] = [];
        // Interpret the options object to determine what to include in suggestions
        // Interpret the scope object to determine what suggestions to include for -> and :: accessors, etc

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

        if (options.localVariables || options.parameters || options.globalVariables) {
            // Find out what top level function we're in
            var funcs = [];
            funcs = funcs.concat(this.currentFileNode.functions.filter(func => {
                return this.withinBlock(func);
            }));

            // Find out which method call/constructor we're in
            this.currentFileNode.classes.forEach(classNode => {
                funcs = funcs.concat(classNode.methods.filter(item => {
                    return this.withinBlock(item);
                }));

                if (classNode.construct != null && this.withinBlock(classNode.construct)) {
                    funcs.push(classNode.construct);
                }
            });

            // Find out which trait we're in
            this.currentFileNode.traits.forEach(traitNode => {
                funcs = funcs.concat(traitNode.methods.filter(item => {
                    return this.withinBlock(item);
                }));
            });

            if (funcs.length > 0) {
                if (options.localVariables) {
                    funcs[0].scopeVariables.forEach(item => {
                        toReturn.push({ label: item.name, kind: CompletionItemKind.Variable, detail: `(variable) : ${item.type}` });
                    });
                }

                if (options.parameters) {
                    funcs[0].params.forEach(item => {
                        toReturn.push({ label: item.name, kind: CompletionItemKind.Property, detail: `(parameter) : ${item.type}` });
                    });
                }

                if (options.globalVariables) {
                    funcs[0].globalVariables.forEach(item => {
                        // TODO -- look up original variable to find the type
                        toReturn.push({ label: item, kind: CompletionItemKind.Variable, detail: `(imported global) : mixed` });
                    });
                }
            }
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
        var scope = null;

        // Are we inside a class?
        this.currentFileNode.classes.forEach(classNode => {
            if (this.withinBlock(classNode)) {
                if (classNode.construct != null) {
                    if (this.withinBlock(classNode.construct)) {
                        scope = new Scope(ScopeLevel.Class, "constructor", classNode.name);
                        return;
                    }
                }
                classNode.methods.forEach(method => {
                    if (this.withinBlock(method)) {
                        scope = new Scope(ScopeLevel.Class, method.name, classNode.name);
                        return;
                    }
                });
                if (scope == null) {
                    scope = new Scope(ScopeLevel.Class, null, classNode.name);
                    return;
                }
            }
        });

        // Are we inside a trait?
        this.currentFileNode.traits.forEach(trait => {
            if (this.withinBlock(trait)) {
                if (trait.construct != null) {
                    if (this.withinBlock(trait.construct)) {
                        scope = new Scope(ScopeLevel.Trait, "constructor", trait.name);
                        return;
                    }
                }
                trait.methods.forEach(method => {
                    if (this.withinBlock(method)) {
                        scope = new Scope(ScopeLevel.Trait, method.name, trait.name);
                        return;
                    }
                });
                if (scope == null) {
                    scope = new Scope(ScopeLevel.Trait, null, trait.name);
                    return;
                }
            }
        });

        // Are we inside an interface?
        this.currentFileNode.interfaces.forEach(item => {
            if (this.withinBlock(item)) {
                scope = new Scope(ScopeLevel.Interface, null, item.name);
                return;
            }
        });

        // Are we inside a top level function?
        this.currentFileNode.functions.forEach(func => {
            if (this.withinBlock(func)) {
                scope = new Scope(ScopeLevel.Root, func.name, null);
                return;
            }
        });

        if (scope == null) {
            // Must be at the top level of a file
            return new Scope(ScopeLevel.Root, null, null);
        } else {
            return scope;
        }
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
        path = decodeURIComponent(path);

        // Handle Windows and Unix paths
        switch (process.platform) {
            case 'darwin':
            case 'linux':
                path = "/" + path;
                break;
            case 'win32':
                path = path.replace(/\//g, "\\");
                break;
        }

        return path;
    }

    private getClassNodeFromTree(className: string) : ClassNode
    {
        var toReturn = null;

        var fileNode = this.workspaceTree.forEach((fileNode) => {
            fileNode.classes.forEach((classNode) => {
                if (classNode.name.toLowerCase() == className.toLowerCase()) {
                    toReturn = classNode;
                }
            });
        });

        return toReturn;
    }

    private getTraitNodeFromTree(traitName: string) : TraitNode
    {
        var toReturn = null;

        var fileNode = this.workspaceTree.forEach((fileNode) => {
            fileNode.traits.forEach((traitNode) => {
                if (traitNode.name.toLowerCase() == traitName.toLowerCase()) {
                    toReturn = traitNode;
                }
            });
        });

        return toReturn;
    }

    private buildAccessModifierText(modifier: number) : string
    {
        switch (modifier) {
            case 0:
                return "public";
            case 1:
                return "private";
            case 2:
                return "protected";
        }

        return "";
    }




    private checkAccessorAndAddMembers(scope: Scope) : CompletionItem[]
    {
        var toReturn: CompletionItem[] = [];
        var rawParts = this.currentLine.trim().match(/\$\S*(?=->)/gm);
        var parts: string[] = [];

        var rawLast = rawParts.length - 1;
        if (rawParts[rawLast].indexOf("->") > -1) {
            rawParts.forEach(part => {
                var splitParts = part.split("->");
                splitParts.forEach(splitPart => {
                    parts.push(splitPart);
                });
            });
        } else {
            parts = rawParts;
        }

        // TODO -- handle instantiated properties (+ static) (eg. $this->prop->suggestion)

        // TODO -- use the char offset to work out which part to use instead of always last
        var last = parts.length - 1;

        if (parts[last].indexOf("$this", parts[last].length - 5) > -1) {
            // We're referencing the current class; show everything
            this.currentFileNode.classes.forEach(classNode => {
                if (this.withinBlock(classNode)) {
                    toReturn = this.addClassMembers(classNode, false, true, true);
                }
            });
        } else {
            // We're probably calling from a instantiated variable
            // Check the variable is in scope to work out which suggestions to provide
            toReturn = this.checkForInstantiatedVariableAndAddSuggestions(parts[last], scope);
        }

        return toReturn;
    }

    private checkForInstantiatedVariableAndAddSuggestions(variableName: string, scope: Scope) : CompletionItem[]
    {
        var toReturn = [];
        var variablesFound = [];

        // Check the scope paramater to find out where we're calling from
        switch (scope.level) {
            case ScopeLevel.Root:
                if (scope.name == null) {
                    // Top level variable
                    variablesFound = this.currentFileNode.topLevelVariables.filter(item => {
                        return item.name == variableName;
                    });
                } else {
                    // Top level function
                    this.currentFileNode.functions.forEach(func => {
                        if (func.name == scope.name) {
                            variablesFound = variablesFound.concat(func.params.filter(item => {
                                return item.name == variableName;
                            }));
                            variablesFound = variablesFound.concat(func.scopeVariables.filter(item => {
                                return item.name == variableName;
                            }));
                            // TODO -- Add global variables
                        }
                    });
                }
                break;

            case ScopeLevel.Trait:
            case ScopeLevel.Class:
                if (scope.name == null) {
                    // Within class, not in method or constructor
                } else {
                    if (scope.name == "constructor") {
                        // Within constructor
                        this.currentFileNode.classes.forEach(classNode => {
                            if (classNode.name == scope.parent) {
                                variablesFound = variablesFound.concat(classNode.construct.params.filter(item => {
                                    return item.name == variableName;
                                }));
                                variablesFound = variablesFound.concat(classNode.construct.scopeVariables.filter(item => {
                                    return item.name == variableName;
                                }));
                            }
                        });
                    } else {
                        // Within method
                        this.currentFileNode.classes.forEach(classNode => {
                            if (classNode.name == scope.parent) {
                                classNode.methods.forEach(method => {
                                    if (method.name == scope.name) {
                                        variablesFound = variablesFound.concat(method.params.filter(item => {
                                            return item.name == variableName;
                                        }));
                                        variablesFound = variablesFound.concat(method.scopeVariables.filter(item => {
                                            return item.name == variableName;
                                        }));
                                    }
                                });
                            }
                        });
                    }
                }
                break;

            case ScopeLevel.Interface:
            default:
                break;
        }

        if (variablesFound.length > 0) {
            var className = null;

            if (variablesFound[0].type == "class") {
                className = variablesFound[0].value;
            } else {
                className = variablesFound[0].type;
            }

            var classNode = this.getClassNodeFromTree(className);
            if (classNode != null) {
                toReturn = this.addClassMembers(classNode, false, false, false);
            }
        }

        return toReturn;
    }

    // Currently unused
    private buildParams(methodNode: MethodNode)
    {
        let toReturn: string = "";
        let params: string[] = [];

        if (methodNode.params && methodNode.params.length > 0) {
            methodNode.params.forEach(item => {
                var str = "";
                if (item.type != "mixed" || item.type != "unknown") {
                    str += item.type;
                }

                str += " " + item.name;

                if (item.optional) {
                    str += "]";
                    str = "[" + str;
                }

                params.push(str);
            });
        }

        toReturn = params.join(", ");

        return toReturn;
    }

    private addClassMembers(classNode: ClassNode, staticOnly: boolean, includePrivate: boolean, includeProtected: boolean)
    {
        var toReturn = [];

        classNode.constants.forEach((subNode) => {
            let value = subNode.value;
            if (subNode.type == "string") {
                value = "\"" + value + "\"";
            }
            toReturn.push({ label: subNode.name, kind: CompletionItemKind.Value, detail: `(constant) : ${subNode.type} : ${value}` });
        });

        classNode.methods.forEach((subNode) => {
            if (subNode.isStatic == staticOnly) {
                var accessModifier = "(" + this.buildAccessModifierText(subNode.accessModifier);
                var insertText = subNode.name;

                if (subNode.params.length == 0) {
                    insertText += "()";
                }

                accessModifier = accessModifier + ` method) : ${subNode.returns}`;

                if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Function, detail: accessModifier, insertText: insertText });
                }
                if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Function, detail: accessModifier, insertText: insertText });
                }
                if (subNode.accessModifier == AccessModifierNode.public) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Function, detail: accessModifier, insertText: insertText });
                }
            }
        });

        classNode.properties.forEach((subNode) => {
            if (subNode.isStatic == staticOnly) {
                var accessModifier = "(" + this.buildAccessModifierText(subNode.accessModifier) + ` property) : ${subNode.type}`;
                var insertText = subNode.name;

                if (!staticOnly) {
                    // Strip the leading $
                    insertText = subNode.name.substr(1, subNode.name.length - 1);
                }

                if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
                }
                if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
                }
                if (subNode.accessModifier == AccessModifierNode.public) {
                    toReturn.push({ label: subNode.name, kind: CompletionItemKind.Property, detail: accessModifier, insertText: insertText });
                }
            }
        });

        // Add items from included traits
        classNode.traits.forEach((traitName) => {
            // Look up the trait node in the tree
            var traitNode = this.getTraitNodeFromTree(traitName);
            if (traitNode != null) {
                toReturn = toReturn.concat(this.addClassMembers(traitNode, staticOnly, true, true));
            }
        });

        // Add items from parent(s)
        if (classNode.extends != null && classNode.extends != "") {
            // Look up the class node in the tree
            var extendedClassNode = this.getClassNodeFromTree(classNode.extends);
            if (extendedClassNode != null) {
                toReturn = toReturn.concat(this.addClassMembers(extendedClassNode, staticOnly, false, true));
            }
        }

        // Remove duplicated (overwritten) items
        var filtered = [];
        toReturn.forEach(item => {
            var found = false;
            filtered.forEach(subItem => {
                if (subItem.label == item.label) {
                    found = true;
                }
            });

            if (!found) {
                filtered.push(item);
            }
        });

        return filtered;
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