import {
    workspace, SymbolKind, Range, Definition,
    DefinitionProvider, TextDocument, Position, CancellationToken,
    Location, SymbolInformation, Uri
} from 'vscode';
import { NotificationType } from 'vscode-languageclient';
import Crane from '../crane';

export class PHPDefinitionProvider implements DefinitionProvider {

    public provideDefinition(document: TextDocument, position: Position, token: CancellationToken): Thenable<Location> {
        return workspace.saveAll(false).then(() => {
            return this.findDefinition(document, position, token);
        });
    }

    public findDefinition(document: TextDocument, position: Position, token: CancellationToken): Thenable<Location> {
        return new Promise((resolve, reject) => {

            let wordAtPosition = document.getWordRangeAtPosition(position);
            let word: string = document.getText(wordAtPosition);
            let namespaces: string[] = [];

            Crane.langClient.sendRequest({ method: 'findFileUsings' }, {
                path: document.uri.fsPath
            });

            var foundFileUsings: NotificationType<{ usings:Array<any> }> = { method: 'foundFileUsings' };
            Crane.langClient.onNotification(foundFileUsings, result => {

                // Get a list of namespaces to search
                result.usings.forEach(item => {
                    namespaces.push(item.parents.join('\\'));
                });

                // Find the definition
                Crane.langClient.sendRequest({ method: 'findDefinition' }, {
                    word: word,
                    namespaces: namespaces,
                    kind: 1
                });
            });

            var definitionInformation: NotificationType<{ path:string, position:any }> = { method: 'definitionInformation' };
            Crane.langClient.onNotification(definitionInformation, result => {
                var uri: Uri = Uri.parse('file:///' + result.path);
                var location = new Location(uri, new Range(result.position.startLine - 1, result.position.startChar, result.position.endLine - 1, result.position.endChar));
                resolve(location);
            });

        });
    }

}