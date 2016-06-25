import {
    workspace, Range, Location, Uri,
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

            var findDefinition: RequestType<{path:string,word:string}, {path:string,position:any}, any> = {method: 'findDefinition'};
            Crane.langClient.sendRequest(findDefinition, {
                path: document.uri.fsPath,
                word: word
            }).then(result => {
                var uri: Uri = Uri.parse('file://' + result.path);
                var location = new Location(uri, new Range(result.position.startLine - 1, result.position.startChar, result.position.endLine - 1, result.position.endChar));
                resolve(location);
            });
        });
    }
}