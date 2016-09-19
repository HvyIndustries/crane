import {
    workspace, Range, Location, Uri, commands, SymbolInformation,
    DefinitionProvider, TextDocument, Position, CancellationToken
} from 'vscode';
import { RequestType } from 'vscode-languageclient';
import Crane from '../crane';

export class PHPDefinitionProvider implements DefinitionProvider {

    public provideDefinition(document: TextDocument, position: Position, token: CancellationToken): Thenable<Location> {
        return workspace.saveAll(false).then(() => {
            return this.findDefinition(document, position, token);
        });
    }

    public findDefinition(document: TextDocument, position: Position, token: CancellationToken): Thenable<Location> {
        return new Promise((resolve, reject) => {

            let wordRange: Range = document.getWordRangeAtPosition(position);
            let word: string = document.getText(wordRange);

            word = word + "::#EXACT";

            commands.executeCommand('vscode.executeWorkspaceSymbolProvider', word).then((items: Array<SymbolInformation>) => {
                var locations: Location[] = [];
                items.forEach(item => {
                    locations.push(item.location);
                });
                resolve(locations);
            });
        });
    }
}