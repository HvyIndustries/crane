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
            let namespaceList: string[] = [];

            Crane.langClient.sendRequest({ method: 'findFileUsings' }, {
                path: document.uri.fsPath
            });

            var foundFileUsings: NotificationType<{ usings:Array<any>, namespaces:Array<string> }> = { method: 'foundFileUsings' };
            Crane.langClient.onNotification(foundFileUsings, result => {

                // Get a list of namespaces to search from the Usings
                result.usings.forEach(item => {
                    var ns: string = item.parents.join('\\');
                    if (ns.length > 0 && namespaceList.indexOf(ns) == -1) {
                        namespaceList.push(ns);
                    }
                });

                // Add The current namespace to the list
                result.namespaces.forEach(ns => {
                    if (ns.length > 0 && namespaceList.indexOf(ns) == -1) {
                        namespaceList.push(ns);
                    }
                });

                // Find the definition
                Crane.langClient.sendRequest({ method: 'findDefinition' }, {
                    word: word,
                    namespaces: namespaceList,
                    kind: 1
                });
            });

            var definitionInformation: NotificationType<{ path:string, position:any }> = { method: 'definitionInformation' };
            Crane.langClient.onNotification(definitionInformation, result => {
                var uri: Uri = Uri.parse('file://' + result.path);
                var location = new Location(uri, new Range(result.position.startLine - 1, result.position.startChar, result.position.endLine - 1, result.position.endChar));
                resolve(location);
            });

        });
    }

    private buildDocumentPath(uri: string) : string {
        var path = uri;
        path = path.replace("file:///", "");
        path = path.replace("%3A", ":");

        // Handle Windows and Unix paths
        switch (process.platform) {
            case 'darwin':
            case 'linux':
                return path = "/" + path;
            case 'win32':
                return path.replace(/\//g, "\\");
        }
    }
}