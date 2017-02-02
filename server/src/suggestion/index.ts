/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import Context from '../util/Context';
import App from '../app';
import Classes from './Classes';
import Variables from './Variables';
// ...etc...

/**
 * Creates a list of application suggestion resolvers
 */
export default function(app:App) {
    const resolvers = [
        new Classes(app),
        new Variables(app),
    ];

    /**
     * Resolves a context
     */
    return function(context:Context) {
        var result = [];

        for(let i = 0; i < resolvers.length; i++) {
            const item = resolvers[i];
            if (item.matches(context)) {
                const items = item.find(context);
                if (Array.isArray(items) && items.length > 0) {
                    result = result.concat(items);
                    if (result.length > app.settings.maxSuggestionSize) {
                        result = result.slice(0, app.settings.maxSuggestionSize);
                        if (app.settings.debugMode) {
                            app.message.warning(
                                "Reached the limit of "+app.settings.maxSuggestionSize+" suggested items"
                            );
                        }
                        break; // reached the end
                    }
                }
            }
        };

        return result;
    };
};
