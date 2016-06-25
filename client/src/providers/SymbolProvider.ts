import {
    workspace, SymbolKind, Range,
    DocumentSymbolProvider, TextDocument, Position, CancellationToken,
    Location, SymbolInformation, CompletionItemKind
} from 'vscode';
import { NotificationType } from 'vscode-languageclient';
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

            Crane.langClient.sendRequest({ method: "findFileDocumentSymbols" }, {
                path: filename
            });

            var documentSymbols: NotificationType<{ symbols:any }> = { method: "documentSymbols" };
            Crane.langClient.onNotification(documentSymbols, result => {
                result.symbols.forEach((item) => {
                    var symbol = new SymbolInformation(item.name, item.kind - 1, new Range(item.startLine - 1, item.startChar, item.endLine - 1, item.endChar));
                    results.push(symbol);
                });
                resolve(results);
            });

        });
    }
}