/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

import { TextDocumentPositionParams, TextDocument, CompletionItem, CompletionItemKind } from 'vscode-languageserver';
import { TreeBuilder } from "./hvy/treeBuilder";
import {
    FileNode,FileSymbolCache, SymbolType,
    AccessModifierNode, ClassNode, TraitNode,
    MethodNode, NamespaceNode, NamespacePart,
    DocCommentSuggestionInfo, BaseNode, DocComment
} from "./hvy/nodes";
import { Files } from "./util/Files";
import { Namespaces } from "./util/namespaces";

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

    private isSelf(): boolean
    {
        if (this.currentLine.substr(this.charIndex - 6, this.charIndex - 1) == "self::") {
            return true;
        }

        if (this.currentLine.substr(this.charIndex - 8, this.charIndex - 1) == "static::") {
            return true;
        }

        return false;
    }

    public build() : CompletionItem[]
    {
        var scope = this.getScope();
        var toReturn: CompletionItem[] = [];
        var options = new ScopeOptions();

        // Don't add suggestions if we're in a comment
        let commentIndex = this.currentLine.indexOf("//");
        if (commentIndex > -1 && commentIndex < this.charIndex) {
            return null;
        }

        if (this.lastChar == ">") {
            toReturn = toReturn.concat(this.checkAccessorAndAddMembers(scope));
        } else if (this.lastChar == ":") {
            if (this.isSelf()) {
                // Accessing via self:: or static::
                this.currentFileNode.classes.forEach(classNode => {
                    if (this.withinBlock(classNode)) {
                        // Add static members for this class
                        toReturn = toReturn.concat(this.addClassMembers(classNode, true, true, true));
                    }
                });
            } else {
                // Probably accessing via [ClassName]::
                var classNames = this.currentLine.trim().match(/\S(\B[a-z]+?)(?=::)/ig);
                if (classNames && classNames.length > 0) {
                    var className = classNames[classNames.length - 1];
                    var classNode = this.getClassNodeFromTree(className);
                    if (classNode != null) {
                        // Add static members for this class
                        toReturn = toReturn.concat(this.addClassMembers(classNode, true, false, false));
                    }
                }
            }
        } else {
            // Special cases for "extends", "implements", "use"
            let newIndex = this.currentLine.indexOf(" new ");
            let newNoSpaceIndex = this.currentLine.indexOf("=new ");
            let extendsIndex = this.currentLine.indexOf(" extends ");
            let implementsIndex = this.currentLine.indexOf(" implements ");
            let useIndex = this.currentLine.indexOf("use ");
            let namespaceIndex = this.currentLine.indexOf("namespace ");

            let newNonNamespaceIndex = this.currentLine.indexOf("new \\");
            let extendsNonNamespaceIndex = this.currentLine.indexOf("extends \\");
            let implementsNonNamespaceIndex = this.currentLine.indexOf("implements \\");

            let classIndex = this.currentLine.indexOf("class ");
            let traitIndex = this.currentLine.indexOf("trait ");
            let interfaceIndex = this.currentLine.indexOf("interface ");

            let specialCase = false;

            if (implementsIndex > -1 && implementsIndex < this.charIndex) {
                specialCase = true;

                // TODO -- use this.buildSuggestionsForNamespaceOrUseStatement() (issue #232)

                if (implementsNonNamespaceIndex > -1 && implementsNonNamespaceIndex < this.charIndex) {
                    options.noNamespaceOnly = true;
                    options.includeLeadingSlash = false;
                }

                // Show only interfaces
                options.interfaces = true;
                toReturn = this.buildSuggestionsForScope(scope, options);
            }

            if (!specialCase && (newIndex > -1 || newNoSpaceIndex > -1 || extendsIndex > -1)
                && (newIndex < this.charIndex || newNoSpaceIndex < this.charIndex || extendsIndex < this.charIndex )) {
                specialCase = true;

                // TODO -- use this.buildSuggestionsForNamespaceOrUseStatement() (issue #232)

                if ((newNonNamespaceIndex > -1 && newNonNamespaceIndex < this.charIndex)
                    || (extendsNonNamespaceIndex > -1 && extendsNonNamespaceIndex < this.charIndex)) {
                    options.noNamespaceOnly = true;
                    options.includeLeadingSlash = false;
                }

                // Show only classes
                options.classes = true;
                toReturn = this.buildSuggestionsForScope(scope, options);
            }

            if (!specialCase && (this.lastChar == "\\" || (useIndex > -1 && useIndex < this.charIndex))) {
                specialCase = true;
                toReturn = this.buildSuggestionsForNamespaceOrUseStatement(false);
            }

            if (namespaceIndex > -1 && namespaceIndex < this.charIndex) {
                specialCase = true;
                toReturn = this.buildSuggestionsForNamespaceOrUseStatement(true);
            }

            if (!specialCase
                && (classIndex > -1 || traitIndex > -1 || interfaceIndex > -1)
                && (classIndex < this.charIndex || traitIndex < this.charIndex || interfaceIndex < this.charIndex)) {
                return null;
            }

            if (!specialCase) {
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
                            // Within method or constructor
                            // Suggestions
                            //  / classes
                            //  / local variables
                            //  / parameters
                            options.classes = true;
                            options.localVariables = true;
                            options.parameters = true;
                            toReturn = this.buildSuggestionsForScope(scope, options);
                        }
                        break;

                    case ScopeLevel.Interface:
                    default:
                        break;
                }
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

    private buildSuggestionsForNamespaceOrUseStatement(namespaceOnly = false): CompletionItem[]
    {
        let namespaces: NamespacePart[] = [];
        this.workspaceTree.forEach(fileNode => {
            namespaces = namespaces.concat(fileNode.namespaceParts);
        });

        let line = this.currentLine;

        // TODO -- update this logic to handle use cases other than "use" and "namespace" (issue #232)

        let useStatement = (line.indexOf("use ") > -1);
        let namespaceDefinition = (line.indexOf("namespace ") > -1);

        line = line.trim();

        line = line.replace("namespace ", "");
        line = line.replace("use ", "");
        let lineParts = line.split("\\");

        let suggestions: CompletionItem[] = [];

        if (line.charAt(0) == "\\" || this.currentFileNode.namespaces.length == 0) {
            let scope = new Scope(null, null, null);
            let options = new ScopeOptions();
            options.classes = true;
            options.interfaces = true;
            options.traits = true;

            if (line.charAt(0) == "\\") {
                // We are looking for non-namespaced classes only
                options.noNamespaceOnly = true
            }

            options.includeLeadingSlash = false;
            suggestions.concat(this.buildSuggestionsForScope(scope, options));
        }

        let parent = namespaces;

        lineParts.forEach(part => {
            let needChildren = false;
            parent.forEach(namespace => {
                if (namespace.name == part) {
                    parent = namespace.children;
                    needChildren = true;
                    return;
                }
            });

            if (!needChildren) {
                parent.forEach(item => {
                    suggestions.push({ label: item.name, kind: CompletionItemKind.Module, detail: "(namespace)" });
                });
            }
        });

        // TODO -- update the code below to include classes, traits an interfaces as required (introduce new bool params)

        // Get namespace-aware suggestions for classes, traits and interfaces
        if (!namespaceOnly) {
            let namespaceToSearch = line.slice(0, line.length - 1);
            this.workspaceTree.forEach(fileNode => {
                fileNode.classes.forEach(classNode => {
                    if (classNode.namespace == namespaceToSearch) {
                        suggestions.push({ label: classNode.name, kind: CompletionItemKind.Class, detail: "(class)" });
                    }
                });
                fileNode.traits.forEach(traitNode => {
                    if (traitNode.namespace == namespaceToSearch) {
                        suggestions.push({ label: traitNode.name, kind: CompletionItemKind.Class, detail: "(trait)" });
                    }
                });
                fileNode.interfaces.forEach(interfaceNode => {
                    if (interfaceNode.namespace == namespaceToSearch) {
                        suggestions.push({ label: interfaceNode.name, kind: CompletionItemKind.Interface, detail: "(interface)" });
                    }
                });
            });
        }

        return suggestions;
    }

    private getDocCommentInfo(item, defaultType: string = null): DocCommentSuggestionInfo
    {
        let type = item.type;
        let description = "";

        if (defaultType != null) {
            type = defaultType;
        }

        if (type == null) {
            type = "unknown";
        }

        let docComment:DocComment = item.docComment;
        if (docComment) {
            if (docComment.deprecated) {
                description += "DEPRECATED";
                if (docComment.deprecatedMessage) {
                    description += " " + docComment.deprecatedMessage;
                }
                description += "\n\n";
            }

            if (docComment.returns) {
                type = docComment.returns.type;
            }

            if (docComment.summary) {
                description += docComment.summary;
            }

            if (docComment.throws && docComment.throws.length > 0) {
                description += "\n";
                docComment.throws.forEach(throwItem => {
                    description += `\nThrows ${throwItem.type} (${throwItem.summary})`;
                });
            }
        }

        if (description == "") {
            description = null;
        }

        return {
            type: type,
            description: description
        }
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
                let docInfo = this.getDocCommentInfo(item);
                toReturn.push({
                    label: item.name,
                    kind: CompletionItemKind.Value,
                    detail: `(constant) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            });
        }

        if (options.topVariables) {
            this.currentFileNode.topLevelVariables.forEach(item => {
                let docInfo = this.getDocCommentInfo(item);
                toReturn.push({
                    label: item.name,
                    kind: CompletionItemKind.Variable,
                    detail: `(variable) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            });
        }

        if (options.classes && !options.noNamespaceOnly) {
            this.currentFileNode.namespaceUsings.forEach(item => {
                if (item.alias != null) {
                    let docInfo = this.getDocCommentInfo(item, item.name);
                    toReturn.push({
                        label: item.alias,
                        kind: CompletionItemKind.Class,
                        detail: "(class) : " + docInfo.type,
                        documentation: docInfo.description
                    });
                }
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
                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Variable,
                            detail: `(variable) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    });
                }

                if (options.parameters) {
                    funcs[0].params.forEach(item => {
                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Property,
                            detail: `(parameter) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    });
                }

                if (options.globalVariables) {
                    funcs[0].globalVariables.forEach(item => {
                        // TODO -- look up original variable to find the type
                        let docInfo = this.getDocCommentInfo(item, "mixed");
                        toReturn.push({
                            label: item,
                            kind: CompletionItemKind.Variable,
                            detail: `(imported global) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    });
                }
            }
        }

        this.workspaceTree.forEach(fileNode => {
            if (options.classes) {
                fileNode.classes.forEach(item => {
                    let include = true;
                    if (options.noNamespaceOnly) {
                        if (item.namespace) {
                            include = false;
                        }
                    }

                    if (include) {
                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Class,
                            detail: "(class)" + this.getNamespace(item),
                            insertText: this.getInsertTextWithNamespace(item, options),
                            documentation: docInfo.description
                        });
                    }
                });
            }

            if (options.interfaces) {
                fileNode.interfaces.forEach(item => {
                    let include = true;
                    if (options.noNamespaceOnly) {
                        if (item.namespace) {
                            include = false;
                        }
                    }

                    if (include) {
                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Interface,
                            detail: "(interface)" + this.getNamespace(item),
                            insertText: this.getInsertTextWithNamespace(item, options),
                            documentation: docInfo.description
                        });
                    }
                });
            }

            if (options.traits) {
                fileNode.traits.forEach(item => {
                    let include = true;
                    if (options.noNamespaceOnly) {
                        if (item.namespace) {
                            include = false;
                        }
                    }

                    if (include) {
                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Class,
                            detail: "(trait)" + this.getNamespace(item),
                            insertText: this.getInsertTextWithNamespace(item, options),
                            documentation: docInfo.description
                        });
                    }
                });
            }

            if (options.topFunctions) {
                fileNode.functions.forEach(item => {
                    let docInfo = this.getDocCommentInfo(item);
                    toReturn.push({
                        label: item.name,
                        kind: CompletionItemKind.Function,
                        detail: `(function) : ${docInfo.type}`,
                        insertText: this.getFunctionInsertText(item),
                        documentation: docInfo.description
                    });
                });
            }

            if (options.namespaces) {
                fileNode.namespaces.forEach(item => {
                    let docInfo = this.getDocCommentInfo(item);
                    toReturn.push({
                        label: item.name,
                        kind: CompletionItemKind.Module,
                        detail: `(namespace)`,
                        documentation: docInfo.description
                    });
                });
            }
        });

        return toReturn;
    }

    private getInsertTextWithNamespace(node, options: ScopeOptions): string
    {
        if (node.namespace) {
            let namespace = node.namespace;
            let namespaceSearch = node.namespace + "\\" + node.name;
            let found = false;

            this.currentFileNode.namespaceUsings.forEach(item => {
                if (item.name == namespaceSearch) {
                    found = true;
                    return null;
                }
            });

            this.currentFileNode.namespaces.forEach(item => {
                if (item.name == namespace) {
                    found = true;
                    return null;
                }
            });

            if (!found) {
                return "\\" + namespaceSearch;
            }

            return null;
        }

        if (this.currentFileNode.namespaces.length > 0
            && options.includeLeadingSlash) {
            return "\\" + node.name;
        }

        return null;
    }

    private getNamespace(node): string
    {
        if (node.namespace) {
            return " " + node.namespace;
        }

        return "";
    }

    private getFunctionInsertText(node: MethodNode)
    {
        let text = node.name;

        if (node.params.length == 0) {
            text += "()";
        }

        return text;
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
        return Files.getPathFromUri(uri);
    }

    private getClassNodeFromTree(className: string) : ClassNode
    {
        var toReturn = null;

        let namespaceInfo = Namespaces.getNamespaceInfoFromFQNClassname(className);
        var namespace = namespaceInfo.namespace;
        var rawClassname = namespaceInfo.classname

        this.workspaceTree.forEach((fileNode) => {
            fileNode.classes.forEach((classNode) => {
                if (
                    classNode.name.toLowerCase() == rawClassname.toLowerCase()
                    && classNode.namespace == namespace
                ) {
                    toReturn = classNode;
                }
            });
        });

        return toReturn;
    }

    private getTraitNodeFromTree(traitName: string) : TraitNode
    {
        var toReturn = null;

        let namespaceInfo = Namespaces.getNamespaceInfoFromFQNClassname(traitName);
        var namespace = namespaceInfo.namespace;
        var rawTraitname = namespaceInfo.classname

        var fileNode = this.workspaceTree.forEach((fileNode) => {
            fileNode.traits.forEach((traitNode) => {
                if (
                    traitNode.name.toLowerCase() == rawTraitname.toLowerCase()
                    && traitNode.namespace == namespace
                ) {
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

        if (rawParts == null) {
            return null;
        }

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
            this.currentFileNode.traits.forEach(traitNode => {
                if (this.withinBlock(traitNode)) {
                    toReturn = this.addClassMembers(traitNode, false, true, true);
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

    private addClassMembers(classNode: ClassNode, staticOnly: boolean, includePrivate: boolean, includeProtected: boolean)
    {
        var toReturn: CompletionItem[] = [];

        if (staticOnly == true) {
            classNode.constants.forEach((subNode) => {
                let docInfo = this.getDocCommentInfo(subNode);
                toReturn.push({
                    label: subNode.name,
                    kind: CompletionItemKind.Value,
                    detail: `(constant) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            });
        }

        classNode.methods.forEach((subNode) => {
            if (subNode.isStatic == staticOnly) {
                var accessModifier = "(" + this.buildAccessModifierText(subNode.accessModifier);
                var insertText = this.getFunctionInsertText(subNode);
                let docInfo = this.getDocCommentInfo(subNode);

                accessModifier = accessModifier + ` method) : ${docInfo.type}`;

                if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Function,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
                }
                if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Function,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
                }
                if (subNode.accessModifier == AccessModifierNode.public) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Function,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
                }
            }
        });

        classNode.properties.forEach((subNode) => {
            if (subNode.isStatic == staticOnly) {
                var insertText = subNode.name;
                let docInfo = this.getDocCommentInfo(subNode);

                var accessModifier = "(" + this.buildAccessModifierText(subNode.accessModifier) + ` property) : ${docInfo.type}`;

                if (subNode.isStatic) {
                    // Add a the leading $
                    insertText = "$" + subNode.name;
                }

                if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Property,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
                }
                if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Property,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
                }
                if (subNode.accessModifier == AccessModifierNode.public) {
                    toReturn.push({
                        label: subNode.name,
                        kind: CompletionItemKind.Property,
                        detail: accessModifier,
                        insertText: insertText,
                        documentation: docInfo.description
                    });
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

    public noNamespaceOnly = false;
    public includeLeadingSlash = true;

    public withinNamespace: string = null;
}

enum ScopeLevel
{
    Root,
    Class,
    Interface,
    Trait
}
