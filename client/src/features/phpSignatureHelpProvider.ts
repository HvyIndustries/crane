"use strict";

import {
    languages, window, commands, SignatureHelpProvider,
    SignatureHelp, SignatureInformation, ParameterInformation,
    TextDocument, Position, Range, CancellationToken
} from 'vscode';
import { LanguageClient, RequestType } from 'vscode-languageclient';
import { parameters } from './util';

export default class PhpSignatureHelpProvider implements SignatureHelpProvider
{
    public langClient: LanguageClient;

    constructor(languageClient: LanguageClient)
    {
        this.langClient = languageClient;
    }

    public provideSignatureHelp(document: TextDocument, position: Position, token: CancellationToken): Promise<SignatureHelp>
    {
        let theCall = this.walkBackwardsToBeginningOfCall(document, position);
        if (theCall == null) {
            return Promise.resolve(null);
        }

        let callerStartPosition = this.previousTokenPosition(document, theCall.openParen);
        if (callerStartPosition == null) {
            return Promise.resolve(null);
        }

        // TODO -- Lookup in tree
        // TODO -- Add cache to each filenode:
        //           / class/interface/trait names
        //           / class properties/methods/consts (with the parent classname)
        //           / top level functions and variables

        // Look in file cache for word, return all matches
        // Filter to functions and methods
        // If single match -> find match in tree and return params
        // If muliple match -> determine if on $this, self:: ClassName:: or instance variable
        //                     and filter matches appropriately

        let wordPos = document.getWordRangeAtPosition(callerStartPosition);
        let text = document.getText();
        let lines = text.split(/\r\n|\r|\n/gm);

        let callerName = lines[wordPos.start.line].substr(wordPos.start.character, wordPos.end.character);

        let requestType: RequestType<any, any, any> = { method: "findSymbolInTree" };
        this.langClient.sendRequest(requestType, callerName).then(response =>
        {
            let matches = response.matches;
            let types = response.types;

            if (types.length == 0) return void 0;

            if (types.length == 1)
            {
                
            }
            else
            {
                
            }
        });

        // return definitionLocation(document, callerPos).then(res => {
        //     if (!res) {
        //         // The definition was not found
        //         return null;
        //     }
        //     if (res.line === callerPos.line) {
        //         // This must be a function definition
        //         return null;
        //     }

        //     let result = new SignatureHelp();
        //     let text = res.lines[1];
        //     let nameEnd = text.indexOf(' ');
        //     let sigStart = nameEnd + 5; // ' func'
        //     let funcName = text.substring(0, nameEnd);
        //     let sig = text.substring(sigStart);
        //     let si = new SignatureInformation(funcName + sig, res.doc);
        //     si.parameters = parameters(sig).map(paramText =>
        //         new ParameterInformation(paramText)
        //     );
        //     result.signatures = [si];
        //     result.activeSignature = 0;
        //     result.activeParameter = Math.min(theCall.commas.length, si.parameters.length - 1);
        //     return result;
        // });

        Promise.resolve();
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

    private walkBackwardsToBeginningOfCall(document: TextDocument, position: Position): { openParen: Position, commas: Position[] } {
        let currentLine = document.lineAt(position.line).text.substring(0, position.character);
        let parenBalance = 0;
        let commas = [];
        for (let char = position.character; char >= 0; char--) {
            switch (currentLine[char]) {
                case '(':
                    parenBalance--;
                    if (parenBalance < 0) {
                        return {
                            openParen: new Position(position.line, char),
                            commas: commas
                        };
                    }
                    break;

                case ')':
                    parenBalance++;
                    break;

                case ',':
                    if (parenBalance === 0) {
                        commas.push(new Position(position.line, char));
                    }
            }
        }
        return null;
    }
}
