"use strict";

import {
    languages, window, commands, DefinitionProvider,
    Location, SignatureInformation, ParameterInformation,
    TextDocument, Position, Range, CancellationToken
} from 'vscode';
import { LanguageClient, RequestType } from 'vscode-languageclient';
import { parameters } from './util';

export default class PhpDefinitionProvider implements DefinitionProvider
{
    public langClient: LanguageClient;

    constructor(languageClient: LanguageClient)
    {
        this.langClient = languageClient;
    }

    public findSymbol(document: TextDocument, position: Position) : Promise<any>
    {
        return new Promise((resolve, reject) => {

            // Lookup in tree -> get node back

            // Look in file cache for word, return all matches
            // Filter to functions and methods
            // If single match -> find match in tree and return params
            // If muliple match -> determine if on $this, self:: ClassName:: or instance variable
            //                     and filter matches appropriately

            let wordPos = document.getWordRangeAtPosition(position);
            let text = document.getText();
            let lines = text.split(/\r\n|\r|\n/gm);

            let callerName = lines[wordPos.start.line].substr(wordPos.start.character, wordPos.end.character);

            let requestType: RequestType<any, any, any> = { method: "findSymbolInTree" };
            this.langClient.sendRequest(requestType, { word: callerName, position: position }).then(response => {
                let node = response.node;
                resolve(node);
            });
        });
    }

    public provideDefinition(document: TextDocument, position: Position, token: CancellationToken) : Promise<Location>
    {
        return new Promise((resolve, reject) =>  {
            this.findSymbol(document, position).then(node =>
            {
                // Check node is null
                // If not null, check if has location

                let location = new Location(null, null);

                Promise.resolve(location);
            });
        });
    }

    private previousTokenPosition(document: TextDocument, position: Position): Position {
        while (position.character > 0) {
            let word = document.getWordRangeAtPosition(position);
            if (word) {
                return word.start;
            }
            position = position.translate(0, -1);
        }
        return null;
    }
}
