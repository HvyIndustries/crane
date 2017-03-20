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
                for (var i = 0, l = this.currentFileNode.classes.length; i < l; i++) {
                    var classNode = this.currentFileNode.classes[i];

                    if (this.withinBlock(classNode)) {
                        // Add static members for this class
                        toReturn = toReturn.concat(this.addClassMembers(classNode, true, true, true));
                    }
                }
            } else {
                // Probably accessing via [ClassName]::
                if (this.currentLine.indexOf("::") > -1) {
                    var classNames = this.currentLine.trim().match(/\S(\B[\\a-z0-9]+)/ig);
                    if (classNames && classNames.length > 0) {
                        var determinedClassname = classNames[classNames.length - 1];
                        if (determinedClassname.indexOf("\\") > -1) {
                            determinedClassname = "\\" + determinedClassname;
                        }
                        var className = Namespaces.getFQNFromClassname(determinedClassname, this.currentFileNode);
                        var classNode = this.getClassNodeFromTree(className);
                        if (classNode != null) {
                            // Add static members for this class
                            toReturn = toReturn.concat(this.addClassMembers(classNode, true, false, false));
                        }
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
        var cache = {};

        for (var i = 0, l = toReturn.length; i < l; i++) {
            var item = toReturn[i];

            if (!(item.label in cache)) {
                filtered.push(item);
                cache[item.label] = true;
            }
        }

        return filtered;
    }

    private buildSuggestionsForNamespaceOrUseStatement(namespaceOnly = false): CompletionItem[]
    {
        let namespaces: NamespacePart[] = [];

        for (var i = 0, l = this.workspaceTree.length; i < l; i++) {
            var fileNode = this.workspaceTree[i];

            namespaces = namespaces.concat(fileNode.namespaceParts);
        }

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

        for (var i = 0, l = lineParts.length; i < l; i++) {
            var part = lineParts[i];

            let needChildren = false;

            for (var j = 0, sl = parent.length; j < sl; j++) {
                var namespace = parent[j];

                if (namespace.name == part) {
                    parent = namespace.children;
                    needChildren = true;
                    break;
                }
            }

            if (!needChildren) {
                for (var j = 0, sl = parent.length; j < sl; j++) {
                    var item = parent[j];

                    suggestions.push({ label: item.name, kind: CompletionItemKind.Module, detail: "(namespace)" });
                }
            }
        }

        // TODO -- update the code below to include classes, traits an interfaces as required (introduce new bool params)

        // Get namespace-aware suggestions for classes, traits and interfaces
        if (!namespaceOnly) {
            let namespaceToSearch = line.slice(0, line.length - 1);

            for (var i = 0, l = this.workspaceTree.length; i < l; i++) {
                var fileNode = this.workspaceTree[i];


                for (var j = 0, sl = fileNode.classes.length; j < sl; j++) {
                    var classNode = fileNode.classes[j];

                    if (classNode.namespace == namespaceToSearch) {
                        let docInfo = this.getDocCommentInfo(classNode);
                        suggestions.push({
                            label: classNode.name,
                            kind: CompletionItemKind.Class,
                            detail: "(class)",
                            documentation: docInfo.description
                        });
                    }
                }

                for (var j = 0, sl = fileNode.traits.length; j < sl; j++) {
                    var traitNode = fileNode.traits[j];

                    if (traitNode.namespace == namespaceToSearch) {
                        let docInfo = this.getDocCommentInfo(traitNode);
                        suggestions.push({
                            label: traitNode.name,
                            kind: CompletionItemKind.Class,
                            detail: "(trait)",
                            documentation: docInfo.description
                        });
                    }
                }

                for (var j = 0, sl = fileNode.interfaces.length; j < sl; j++) {
                    var interfaceNode = fileNode.interfaces[j];

                    if (interfaceNode.namespace == namespaceToSearch) {
                        let docInfo = this.getDocCommentInfo(interfaceNode);
                        suggestions.push({
                            label: interfaceNode.name,
                            kind: CompletionItemKind.Interface,
                            detail: "(interface)",
                            documentation: docInfo.description
                        });
                    }
                }
            }
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
            for (var i = 0, l = this.currentFileNode.constants.length; i < l; i++) {
                let item = this.currentFileNode.constants[i];

                let docInfo = this.getDocCommentInfo(item);
                toReturn.push({
                    label: item.name,
                    kind: CompletionItemKind.Value,
                    detail: `(constant) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            }
        }

        if (options.topVariables) {
            for (var i = 0, l = this.currentFileNode.topLevelVariables.length; i < l; i++) {
                let item = this.currentFileNode.topLevelVariables[i];

                let docInfo = this.getDocCommentInfo(item);
                toReturn.push({
                    label: item.name,
                    kind: CompletionItemKind.Variable,
                    detail: `(variable) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            }
        }

        if (options.classes && !options.noNamespaceOnly) {
            for (var i = 0, l = this.currentFileNode.namespaceUsings.length; i < l; i++) {
                let item = this.currentFileNode.namespaceUsings[i];

                if (item.alias != null) {
                    let docInfo = this.getDocCommentInfo(item, item.name);
                    toReturn.push({
                        label: item.alias,
                        kind: CompletionItemKind.Class,
                        detail: "(class) : " + docInfo.type,
                        documentation: docInfo.description
                    });
                }
            }
        }

        if (options.localVariables || options.parameters || options.globalVariables) {
            // Find out what top level function we're in
            var funcs = [];
            funcs = funcs.concat(this.currentFileNode.functions.filter(func => {
                return this.withinBlock(func);
            }));

            // Find out which method call/constructor we're in
            for (var i = 0, l = this.currentFileNode.classes.length; i < l; i++) {
                let classNode = this.currentFileNode.classes[i];

                funcs = funcs.concat(classNode.methods.filter(item => {
                    return this.withinBlock(item);
                }));

                if (classNode.construct != null && this.withinBlock(classNode.construct)) {
                    funcs.push(classNode.construct);
                }
            }

            // Find out which trait we're in
            for (var i = 0, l = this.currentFileNode.traits.length; i < l; i++) {
                let traitNode = this.currentFileNode.traits[i];

                funcs = funcs.concat(traitNode.methods.filter(item => {
                    return this.withinBlock(item);
                }));
            }

            if (funcs.length > 0) {
                if (options.localVariables) {
                    for (var i = 0, l:number = funcs[0].scopeVariables.length; i < l; i++) {
                        let item = funcs[0].scopeVariables[i];

                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Variable,
                            detail: `(variable) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    }
                }

                if (options.parameters) {
                    for (var i = 0, l:number = funcs[0].params.length; i < l; i++) {
                        let item = funcs[0].params[i];

                        let docInfo = this.getDocCommentInfo(item);
                        toReturn.push({
                            label: item.name,
                            kind: CompletionItemKind.Property,
                            detail: `(parameter) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    }
                }

                if (options.globalVariables) {
                    for (var i = 0, l:number = funcs[0].globalVariables.length; i < l; i++) {
                        let item = funcs[0].globalVariables[i];

                        // TODO -- look up original variable to find the type
                        let docInfo = this.getDocCommentInfo(item, "mixed");
                        toReturn.push({
                            label: item,
                            kind: CompletionItemKind.Variable,
                            detail: `(imported global) : ${docInfo.type}`,
                            documentation: docInfo.description
                        });
                    }
                }
            }
        }

        for (var i = 0, l:number = this.workspaceTree.length; i < l; i++) {
            let fileNode = this.workspaceTree[i];

            if (options.classes) {
                for (var j = 0, sl:number = fileNode.classes.length; j < sl; j++) {
                    let item = fileNode.classes[j];

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
                }
            }

            if (options.interfaces) {
                for (var j = 0, sl:number = fileNode.interfaces.length; j < sl; j++) {
                    let item = fileNode.interfaces[j];

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
                }
            }

            if (options.traits) {
                for (var j = 0, sl:number = fileNode.traits.length; j < sl; j++) {
                    let item = fileNode.traits[j];

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
                }
            }

            if (options.topFunctions) {
                for (var j = 0, sl:number = fileNode.functions.length; j < sl; j++) {
                    let item = fileNode.functions[j];

                    let docInfo = this.getDocCommentInfo(item);
                    let detail = this.getFunctionParamInfo(docInfo, item);
                    toReturn.push({
                        label: item.name,
                        kind: CompletionItemKind.Function,
                        detail: detail,
                        insertText: this.getFunctionInsertText(item),
                        documentation: docInfo.description
                    });
                }
            }

            if (options.namespaces) {
                for (var j = 0, sl:number = fileNode.namespaces.length; j < sl; j++) {
                    let item = fileNode.namespaces[j];

                    let docInfo = this.getDocCommentInfo(item);
                    toReturn.push({
                        label: item.name,
                        kind: CompletionItemKind.Module,
                        detail: `(namespace)`,
                        documentation: docInfo.description
                    });
                }
            }
        }

        return toReturn;
    }

    private getFunctionParamInfo(docInfo: DocCommentSuggestionInfo, item: MethodNode) {
        let detail = ": " + docInfo.type;

        let params: string[] = [];

        item.params.forEach(item => {
            let type = item.docType;

            if (type != null && type != "") {
                type += " ";
            }

            let itemInfo = type + item.name;

            if (item.optional) {
                itemInfo = "[" + itemInfo + "]";
            }

            params.push(itemInfo);
        });

        if (params.length > 0) {
            let joinedParams = params.join(", ");
            detail = "(" + joinedParams + ") : " + docInfo.type;
        }
        return detail;
    }

    private getInsertTextWithNamespace(node, options: ScopeOptions): string
    {
        if (node.namespace) {
            let namespace = node.namespace;
            let namespaceSearch = node.namespace + "\\" + node.name;
            let found = false;

            for (var i = 0, l:number = this.currentFileNode.namespaceUsings.length; i < l; i++) {
                let item = this.currentFileNode.namespaceUsings[i];

                if (item.name == namespaceSearch) {
                    found = true;
                    return null;
                }
            }

            for (var i = 0, l:number = this.currentFileNode.namespaces.length; i < l; i++) {
                let item = this.currentFileNode.namespaces[i];

                if (item.name == namespace) {
                    found = true;
                    return null;
                }
            }

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
        // Are we inside a class?
        for (var i = 0, l:number = this.currentFileNode.classes.length; i < l; i++) {
            let classNode = this.currentFileNode.classes[i];

            if (this.withinBlock(classNode)) {
                if (classNode.construct != null) {
                    if (this.withinBlock(classNode.construct)) {
                        return new Scope(ScopeLevel.Class, "constructor", classNode.name);
                    }
                }

                for (var j = 0, sl:number = classNode.methods.length; j < sl; j++) {
                    let method = classNode.methods[j];

                    if (this.withinBlock(method)) {
                        return new Scope(ScopeLevel.Class, method.name, classNode.name);
                    }
                }

                return new Scope(ScopeLevel.Class, null, classNode.name);
            }
        }

        // Are we inside a trait?
        for (var i = 0, l:number = this.currentFileNode.traits.length; i < l; i++) {
            let trait = this.currentFileNode.traits[i];

            if (this.withinBlock(trait)) {
                if (trait.construct != null) {
                    if (this.withinBlock(trait.construct)) {
                        return new Scope(ScopeLevel.Trait, "constructor", trait.name);
                    }
                }

                for (var j = 0, sl:number = trait.methods.length; j < sl; j++) {
                    let method = trait.methods[j];

                    if (this.withinBlock(method)) {
                        return new Scope(ScopeLevel.Trait, method.name, trait.name);
                    }
                }

                return new Scope(ScopeLevel.Trait, null, trait.name);
            }
        }

        // Are we inside an interface?
        for (var i = 0, l:number = this.currentFileNode.interfaces.length; i < l; i++) {
            let item = this.currentFileNode.interfaces[i];

            if (this.withinBlock(item)) {
                return new Scope(ScopeLevel.Interface, null, item.name);
            }
        }

        // Are we inside a top level function?
        for (var i = 0, l:number = this.currentFileNode.functions.length; i < l; i++) {
            let func = this.currentFileNode.functions[i];

            if (this.withinBlock(func)) {
                return new Scope(ScopeLevel.Root, func.name, null);
            }
        }

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
        return Files.getPathFromUri(uri);
    }

    private getClassNodeFromTree(className: string) : ClassNode
    {
        let namespaceInfo = Namespaces.getNamespaceInfoFromFQNClassname(className);
        var namespace = namespaceInfo.namespace;
        var rawClassname = namespaceInfo.classname

        for (var i = 0, l:number = this.workspaceTree.length; i < l; i++) {
            let fileNode = this.workspaceTree[i];

            for (var j = 0, sl:number = fileNode.classes.length; j < sl; j++) {
                let classNode = fileNode.classes[j];

                if (
                    classNode.name.toLowerCase() == rawClassname.toLowerCase()
                    && classNode.namespace == namespace
                ) {
                    return classNode;
                }
            }
        }
    }

    private getTraitNodeFromTree(traitName: string) : TraitNode
    {
        let namespaceInfo = Namespaces.getNamespaceInfoFromFQNClassname(traitName);
        var namespace = namespaceInfo.namespace;
        var rawTraitname = namespaceInfo.classname

        for (var i = 0, l:number = this.workspaceTree.length; i < l; i++) {
            let fileNode = this.workspaceTree[i];

            for (var j = 0, sl:number = fileNode.traits.length; j < sl; j++) {
                let traitNode = fileNode.traits[j];

                if (
                    traitNode.name.toLowerCase() == rawTraitname.toLowerCase()
                    && traitNode.namespace == namespace
                ) {
                    return traitNode;
                }
            }
        }
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
        var rawParts = this.currentLine.trim().match(/\$\S*(?=->)/gm);
        var parts: string[] = [];

        if (rawParts == null) {
            return null;
        }

        var rawLast = rawParts.length - 1;
        if (rawParts[rawLast].indexOf("->") > -1) {
            for (var i = 0, l:number = rawParts.length; i < l; i++) {
                let part = rawParts[i];

                var splitParts = part.split("->");

                for (var j = 0, sl:number = splitParts.length; j < sl; j++) {
                    let splitPart = splitParts[j];

                    parts.push(splitPart);
                }
            }
        } else {
            parts = rawParts;
        }

        // TODO -- handle instantiated properties (+ static) (eg. $this->prop->suggestion)

        // TODO -- use the char offset to work out which part to use instead of always last
        var last = parts.length - 1;

        if (parts[last].indexOf("$this", parts[last].length - 5) > -1) {
            // We're referencing the current class; show everything
            for (var i = 0, l:number = this.currentFileNode.classes.length; i < l; i++) {
                let classNode = this.currentFileNode.classes[i];

                if (this.withinBlock(classNode)) {
                    return this.addClassMembers(classNode, false, true, true);
                }
            }

            for (var i = 0, l:number = this.currentFileNode.traits.length; i < l; i++) {
                let traitNode = this.currentFileNode.traits[i];
                if (this.withinBlock(traitNode)) {
                    return this.addClassMembers(traitNode, false, true, true);
                }
            }
        }

        // We're probably calling from a instantiated variable
        // Check the variable is in scope to work out which suggestions to provide
        return this.checkForInstantiatedVariableAndAddSuggestions(parts[last], scope);
    }

    private checkForInstantiatedVariableAndAddSuggestions(variableName: string, scope: Scope) : CompletionItem[]
    {
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
                    for (var i = 0, l:number = this.currentFileNode.functions.length; i < l; i++) {
                        let func = this.currentFileNode.functions[i];

                        if (func.name == scope.name) {
                            variablesFound = variablesFound.concat(func.params.filter(item => {
                                return item.name == variableName;
                            }));
                            variablesFound = variablesFound.concat(func.scopeVariables.filter(item => {
                                return item.name == variableName;
                            }));
                            // TODO -- Add global variables
                        }
                    }
                }
                break;

            case ScopeLevel.Trait:
            case ScopeLevel.Class:
                if (scope.name == null) {
                    // Within class, not in method or constructor
                } else {
                    if (scope.name == "constructor") {
                        // Within constructor
                        for (var i = 0, l:number = this.currentFileNode.classes.length; i < l; i++) {
                            let classNode = this.currentFileNode.classes[i];

                            if (classNode.name == scope.parent) {
                                variablesFound = variablesFound.concat(classNode.construct.params.filter(item => {
                                    return item.name == variableName;
                                }));
                                variablesFound = variablesFound.concat(classNode.construct.scopeVariables.filter(item => {
                                    return item.name == variableName;
                                }));
                            }
                        }
                    } else {
                        // Within method
                        for (var i = 0, l:number = this.currentFileNode.classes.length; i < l; i++) {
                            let classNode = this.currentFileNode.classes[i];

                            if (classNode.name == scope.parent) {
                                for (var j = 0, sl:number = classNode.methods.length; j < sl; j++) {
                                    let method = classNode.methods[j];

                                    if (method.name == scope.name) {
                                        variablesFound = variablesFound.concat(method.params.filter(item => {
                                            return item.name == variableName;
                                        }));
                                        variablesFound = variablesFound.concat(method.scopeVariables.filter(item => {
                                            return item.name == variableName;
                                        }));
                                    }
                                }
                            }
                        }
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
                return this.addClassMembers(classNode, false, false, false);
            }
        }

        return [];
    }

    private addClassMembers(classNode: ClassNode, staticOnly: boolean, includePrivate: boolean, includeProtected: boolean)
    {
        var toReturn: CompletionItem[] = [];

        if (staticOnly == true) {
            for (var i = 0, l:number = classNode.constants.length; i < l; i++) {
                let subNode = classNode.constants[i];

                let docInfo = this.getDocCommentInfo(subNode);
                toReturn.push({
                    label: subNode.name,
                    kind: CompletionItemKind.Value,
                    detail: `(constant) : ${docInfo.type}`,
                    documentation: docInfo.description
                });
            }
        }

        for (var i = 0, l:number = classNode.methods.length; i < l; i++) {
            let subNode = classNode.methods[i];

            if (subNode.isStatic == staticOnly) {
                var insertText = this.getFunctionInsertText(subNode);
                let docInfo = this.getDocCommentInfo(subNode);
                let detail = this.getFunctionParamInfo(docInfo, subNode);

                var returnObject = {
                    label: subNode.name,
                    kind: CompletionItemKind.Function,
                    detail: detail,
                    insertText: insertText,
                    documentation: docInfo.description
                }

                if (includeProtected && subNode.accessModifier == AccessModifierNode.protected) {
                    toReturn.push(returnObject);
                }
                if (includePrivate && subNode.accessModifier == AccessModifierNode.private) {
                    toReturn.push(returnObject);
                }
                if (subNode.accessModifier == AccessModifierNode.public) {
                    toReturn.push(returnObject);
                }
            }
        }

        for (var i = 0, l:number = classNode.properties.length; i < l; i++) {
            let subNode = classNode.properties[i];

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
        }

        // Add items from included traits
        for (var i = 0, l:number = classNode.traits.length; i < l; i++) {
            let traitName = classNode.traits[i];

            // Look up the trait node in the tree
            var traitNode = this.getTraitNodeFromTree(traitName);
            if (traitNode != null) {
                toReturn = toReturn.concat(this.addClassMembers(traitNode, staticOnly, true, true));
            }
        }

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
        var cache = {};

        for (var i = 0, l = toReturn.length; i < l; i++) {
            var item = toReturn[i];

            if (!(item.label in cache)) {
                filtered.push(item);
                cache[item.label] = true;
            }
        }

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
