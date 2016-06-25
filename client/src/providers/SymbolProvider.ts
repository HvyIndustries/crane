import {
    workspace, Range, SymbolInformation,
    DocumentSymbolProvider, TextDocument, CancellationToken,
} from 'vscode';
import { RequestType } from 'vscode-languageclient';
import Crane from '../crane';

export class PHPDocumentSymbolProvider implements DocumentSymbolProvider {
    public provideDocumentSymbols(document: TextDocument, token: CancellationToken): Thenable<SymbolInformation[]> {
        return workspace.saveAll(false).then(() => {
            return this.findSymbols(document, token);
        });
    }

    private findSymbols(document: TextDocument, token: CancellationToken): Thenable<SymbolInformation[]> {
        return new Promise((resolve, reject) => {

            let filename = document.uri.fsPath;

            let results: SymbolInformation[] = [];

            let findFileDocumentSymbols: RequestType<{path:string}, {symbols:any}, any> = {method: 'findFileDocumentSymbols'};
            Crane.langClient.sendRequest(findFileDocumentSymbols, {
                path: filename
            }).then(result => {
                result.symbols.forEach((item) => {
                    var symbol = new SymbolInformation(item.name, item.kind - 1, new Range(item.startLine - 1, item.startChar, item.endLine - 1, item.endChar));
                    results.push(symbol);
                });
                resolve(results);
            });
        });
    }
}