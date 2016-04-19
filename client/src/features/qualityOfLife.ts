/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

"use strict";

import * as vscode from 'vscode';

export default class QualityOfLife
{
    private disposable: vscode.Disposable;

    private todoCommentDecoration: vscode.TextEditorDecorationType;

    constructor()
    {
        let subscriptions: vscode.Disposable[] = [];
        vscode.workspace.onDidChangeTextDocument((e) => this.onChangeTextHandler(e.document), null, subscriptions);
        vscode.window.onDidChangeActiveTextEditor(editor => { this.onChangeEditorHandler(editor) }, null, subscriptions);
        this.disposable = vscode.Disposable.from(...subscriptions);

        this.todoCommentDecoration = vscode.window.createTextEditorDecorationType({
            overviewRulerLane: vscode.OverviewRulerLane.Right,
            color: "rgba(91, 199, 235, 1)",
            overviewRulerColor: 'rgba(144, 195, 212, 0.7)' // Light Blue
        });

        this.styleTodoComments();
    }

    private onChangeEditorHandler(editor: vscode.TextEditor)
    {
        this.styleTodoComments();
    }

    private onChangeTextHandler(textDocument: vscode.TextDocument)
    {
        // Style todo comments as blue (+ add marker in sidebar)
        this.styleTodoComments();
    }

    public duplicateLineOrSelection()
    {
        var selection = vscode.window.activeTextEditor.selection;

        if (selection.isEmpty && selection.isSingleLine)
        {
            // Duplicate line
            vscode.window.activeTextEditor.edit((editBuilder) =>
            {
                // Get string to duplicate
                var oldLine = selection.start.line;
                var range = new vscode.Range(oldLine, 0, oldLine, 999999);
                var text = vscode.window.activeTextEditor.document.getText(range);
                text += "\n";

                var newPosition = new vscode.Position(oldLine + 1, 0);

                editBuilder.insert(newPosition, text);
            });
        }
        else
        {
            if (selection.isSingleLine)
            {
                // Duplicate selection on single line
                vscode.window.activeTextEditor.edit((editBuilder) =>
                {
                    // Get string to duplicate
                    var range = new vscode.Range(selection.start, selection.end);
                    var text = vscode.window.activeTextEditor.document.getText(range);

                    var line = selection.end.line;
                    var char = selection.end.character;
                    var newPosition = new vscode.Position(line, char);

                    editBuilder.insert(newPosition, text);
                    vscode.window.activeTextEditor.selection = selection;
                });
            }
            else
            {
                // Duplicate selection spanning multiple lines
                vscode.window.activeTextEditor.edit((editBuilder) =>
                {
                    // Get string to duplicate
                    var range = new vscode.Range(selection.start.line, 0, selection.end.line, 999999);
                    var text = vscode.window.activeTextEditor.document.getText(range);
                    text += "\n";

                    var newPosition = new vscode.Position(selection.end.line + 1, 0);

                    editBuilder.insert(newPosition, text);
                });
            }
        }
    }

    private styleTodoComments()
    {
        var editor = vscode.window.activeTextEditor;
        if (editor == null) return;

        // Reset any existing todo style decorations
        editor.setDecorations(this.todoCommentDecoration, []);

        var matchedLines = [];

        // Parse document searching for regex match
        for (var i = 0; i < editor.document.lineCount; i++) {
            var line = editor.document.lineAt(i);

            //var regex = /(\/\/|#)(.*todo|todo)/ig;
            var regex = /(\/\/|#)(\stodo|todo)/ig;
            var result = regex.exec(line.text);

            if (result != null)
            {
                var lineOption = { range: new vscode.Range(i, result.index, i, 99999) };
                matchedLines.push(lineOption);
            }
        }

        editor.setDecorations(this.todoCommentDecoration, matchedLines);
    }

    dispose()
    {
        this.disposable.dispose();
    }
}
