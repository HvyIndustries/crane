import {
    workspace,
    ReferenceProvider, TextDocument, Position, CancellationToken,
    SignatureHelp, Location
} from 'vscode';
import Crane from '../crane';

export class PHPReferenceProvider implements ReferenceProvider {

    public provideReferences(document: TextDocument, position: Position, options: { includeDeclaration: boolean }, token: CancellationToken): Thenable<Location[]> {
        return workspace.saveAll(false).then(() => {
            return this.doFindReferences(document, position, options, token);
        });
    }

    private doFindReferences(document: TextDocument, position: Position, options: { includeDeclaration: boolean }, token: CancellationToken): Thenable<Location[]> {
        return new Promise((resolve, reject) => {

            let filename = document.uri.fsPath;
            console.log(filename);
            let wordRange = document.getWordRangeAtPosition(position);
            if (!wordRange) {
                return resolve([]);
            }

            let results: Location[] = [];

            Crane.langClient.sendRequest({ method: "findNode" }, {
                path: filename
            });

            resolve(results);

        });
    }
}