import {
    Position, WorkspaceEdit, commands,
    workspace, Range, SymbolInformation, WorkspaceSymbolProvider,
    RenameProvider, TextDocument, CancellationToken, Uri
} from 'vscode';
import { RequestType } from 'vscode-languageclient';
import Crane from '../crane';

const process = require('process');

export class PHPRenameProvider implements RenameProvider {

    public provideRenameEdits(document: TextDocument, postion: Position, newString: string, token: CancellationToken): Thenable<WorkspaceEdit> {
        return workspace.saveAll(false).then(() => {
            return this.renameSymbols(document, postion, newString, token);
        });
    }

    private renameSymbols(document: TextDocument, position: Position, newString: string, token: CancellationToken): Thenable<WorkspaceEdit> {
        return new Promise((resolve, reject) => {

            let wordRange: Range = document.getWordRangeAtPosition(position);
            let word: string = document.getText(wordRange);

            commands.executeCommand('vscode.executeWorkspaceSymbolProvider', word).then((items: Array<SymbolInformation>) => {
                var edit: WorkspaceEdit = new WorkspaceEdit();
                items.forEach(item => {
                    edit.replace(item.location.uri, item.location.range, newString);
                });
                resolve(edit);
            });
        });
    }

}