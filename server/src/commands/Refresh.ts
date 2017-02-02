/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import { RequestType, IConnection } from 'vscode-languageserver';
import App from '../app';

/**
 * Defines a callback registration
 */
export function cmdRefresh(app:App, connection:IConnection) {
    connection.onRequest(
        new RequestType<any, any, any, any>("doRefresh"),
        (data) => {
            app.workspace.scan()
                .catch(function(e) {
                    app.message.error(e.message);
                    if (app.settings.debugMode) {
                        app.message.trace(e.stack);
                    }
                    return new Error()
                });
        }
    );
};
