"use strict";

import * as vscode from 'vscode';
import { ThrottledDelayer } from './utils/async';

import { TreeBuilder, FileNode } from "./hvy/treeBuilder";

export default class Crane
{
    public objectTree: FileNode[] = [];

    private disposable: vscode.Disposable;
    private delayers: { [key: string]: ThrottledDelayer<void> };

    constructor()
    {
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
        // TODO -- Build object tree for every file in workspace
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
                // this.buildObjectTreeForDocument(textDocument).then(() =>
                // {
                //     resolve();
                // });
            })
        });
    }

    private onChangeEditorHandler(editor: vscode.TextEditor)
    {
    }

    private onSaveHandler()
    {
    }

    dispose()
    {
        this.disposable.dispose();
    }
}