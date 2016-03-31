"use strict";

import * as vscode from 'vscode';
import { ThrottledDelayer } from './utils/async';

import { TreeBuilder, FileNode } from "./hvy/treeBuilder";

import { LanguageClient, RequestType } from 'vscode-languageclient';

export default class Crane
{
    public objectTree: FileNode[] = [];

    public treeBuilder: TreeBuilder = new TreeBuilder();
    public langClient: LanguageClient;

    private disposable: vscode.Disposable;
    private delayers: { [key: string]: ThrottledDelayer<void> };

    constructor(languageClient: LanguageClient)
    {
        this.langClient = languageClient;

        this.delayers = Object.create(null);

        let subscriptions: vscode.Disposable[] = [];

        vscode.workspace.onDidChangeTextDocument((e) => this.onChangeTextHandler(e.document), null, subscriptions);
        vscode.workspace.onDidSaveTextDocument(this.onSaveHandler, this, subscriptions);
        vscode.window.onDidChangeActiveTextEditor(editor => { this.onChangeEditorHandler(editor) }, null, subscriptions);
        vscode.workspace.onDidCloseTextDocument((textDocument)=> { delete this.delayers[textDocument.uri.toString()]; }, null, subscriptions);

        this.disposable = vscode.Disposable.from(...subscriptions);
    }

    public doInit()
    {
        console.log("Crane Initialised...");

        // Send request to server to build object tree for all workspace files
        var requestType: RequestType<any, any, any> = { method: "buildObjectTreeForWorkspace" };

        // TODO -- Display message in status bar indicating loading

        this.langClient.sendRequest(requestType).then((success) =>
        {
            if (success)
            {
                // Remove loading indicator
            }
            else
            {
                // Remove loading indicator
                // Show error
            }
        });
    }

    public suggestFixes()
    {
        // TODO -- Suggest fixes for any error under the caret
    }

    private onChangeTextHandler(textDocument: vscode.TextDocument)
    {
        // TODO -- Do this on server instead?

        let key = textDocument.uri.toString();
        let delayer = this.delayers[key];

        if (!delayer)
        {
            delayer = new ThrottledDelayer<void>(250);
            this.delayers[key] = delayer;
        }

        delayer.trigger(() =>
        {
            return new Promise<void>((resolve, reject) =>
            {
                this.buildObjectTreeForDocument(textDocument).then(() =>
                {
                    resolve();
                });
            })
        });
    }

    private buildObjectTreeForDocument(document: vscode.TextDocument): Promise<void>
    {
        return new Promise<void>((resolve, reject) =>
        {
            // Only run parser if there are no linter errors
            // TODO
            if (true)
            {
                this.treeBuilder.Parse(document.getText(), document.fileName).then((data) => 
                {
                    var t = data.tree;
                    resolve();
                })
                .catch((error) =>
                {
                    console.log(error);
                    resolve();
                });
            }
            else
            {
                //resolve();
            }
        });
    }

    private onChangeEditorHandler(editor: vscode.TextEditor)
    {
        // Analyse file to find undefined variables, functions, classes, etc
        var path = editor.document.fileName;
        var requestType: RequestType<any, any, any> = { method: "getFileProblems" };

        this.langClient.sendRequest(requestType, path).then((data) =>
        {
            var t = "test";
            // TODO -- Show decorations
            // TODO -- Update list of errors in current document + their types
        });
    }

    private onSaveHandler()
    {
    }

    dispose()
    {
        this.disposable.dispose();
    }
}
