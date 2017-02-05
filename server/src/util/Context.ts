/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import App from '../app';
import phpParser from 'php-parser';
import fileReflection from 'php-reflection/src/file';

/**
 * Defines the scope structure
 */
interface IScope {
    file: any;
    offset: number;
    namespace: any;
    class: any;
    trait: any;
    interface: any;
    method: any;
    function: any;
    variables: any[];
    getVariables(): any[];
};

/**
 * With a context resolves everything
 */
export default class Context {
    public char:string;
    public word:string;
    public text:string;
    public scope:IScope;

    /**
     * Retrieves current state from the specified offset
     */
    constructor(text: string, offset: number) {
        this.text = text;
        let i = offset - 1
        for(; i > 0; i--) {
            const ch = text.charCodeAt(i);
            if (
                !(
                    (ch > 96 && ch < 123)
                    || (ch > 64 && ch < 91)
                    || ch === 95
                    || (ch > 47 && ch < 58)
                    || ch > 126
                )
            ) {
                break;
            }
        }
        this.char = text[offset];
        this.word = text.substring(i, offset).trim();
    }

    /**
     * Checks if is in a namespace context
     */
    inNamespace(): boolean {
        return this.scope.namespace !== null;
    }

    /**
     * Checks if is in a class/trait context
     */
    inClassOrTrait(): boolean {
        return this.scope.class !== null || this.scope.trait !== null;
    }

    /**
     * Checks if is in a method context
     */
    inMethod(): boolean {
        return this.inClassOrTrait() && this.scope.method !== null;
    }

    /**
     * Resolves the current context
     */
    resolve(app:App, filename:string, offset:number): Promise<any> {
        return new Promise((done, reject) => {
            app.message.trace(
                'Autocomplete from ' + offset + ' @ ' + this.char + ' / ' + this.word
            );
            // search the file
            app.workspace.has(filename).then((document) => {
                if (!document) {
                    // document not saved yet
                    try {
                        var reader = new phpParser({
                            ast: {
                                withPositions: true
                            },
                            parser: {
                                extractDoc: true,
                                suppressErrors: true
                            }
                        });
                        // virtual file (without putting it into the repository)
                        document = new fileReflection(
                            app.workspace,
                            filename,
                            reader.parseCode(this.text)
                        );
                    } catch (e) {
                        reject(e);
                    }
                }
                this.scope = document.scope(offset);
                done();
            });
        });
    }
}
