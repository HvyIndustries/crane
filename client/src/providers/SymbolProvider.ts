import {
    workspace, Range, SymbolInformation, WorkspaceSymbolProvider,
    DocumentSymbolProvider, TextDocument, CancellationToken, Uri
} from 'vscode';
import { RequestType } from 'vscode-languageclient';
import Crane from '../crane';

const process = require('process');

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
                    let symbol = new SymbolInformation(item.name, item.kind - 1, new Range(item.startLine - 1, item.startChar, item.endLine - 1, item.endChar));
                    results.push(symbol);
                });
                resolve(results);
            });
        });
    }
}

export class PHPWorkspaceSymbolProvider implements WorkspaceSymbolProvider {

    public provideWorkspaceSymbols(query: string, token: CancellationToken): Thenable<SymbolInformation[]> {
        return workspace.saveAll(false).then(() => {
            return this.findSymbols(query, token);
        });
    }

    protected findSymbols(query: string, token: CancellationToken) {
        return new Promise((resolve, reject) => {

            let results: SymbolInformation[] = [];

            let findFileDocumentSymbols: RequestType<{query:string}, {symbols:any}, any> = {method: 'findWorkspaceSymbols'};
            Crane.langClient.sendRequest(findFileDocumentSymbols, {
                query: query
            }).then(result => {
                result.symbols.forEach((item) => {
                    let uri: Uri = this.getUri(item.path);
                    if (uri == null) { return; }
                    let symbol = new SymbolInformation(
                        item.name, item.kind - 1,
                        new Range(item.startLine - 1, item.startChar, item.endLine - 1, item.endChar),
                        uri,
                        item.parentName
                    );
                    results.push(symbol);
                });
                resolve(results);
            });
        });
    }

    private getUri(path: string): Uri {
        if (path == '' || path == '\\'){
            return;
        }
        let uri: Uri = null;
        switch (process.platform) {
            case 'win32':
                uri = Uri.parse('file:///' + path);
                break;
            default:
                uri = Uri.parse('file://' + path);
                break;
        }
        return uri;
    }
}