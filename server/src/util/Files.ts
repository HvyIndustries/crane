/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

'use strict';

export class Files
{
    public static getPathFromUri(uri: string) : string
    {
        uri = uri.replace("file:///", "");

        var decoded = decodeURIComponent(uri);

        switch (process.platform) {
            case 'darwin':
            case 'linux':
                return "/" + decoded;

            case 'win32':
                decoded = decoded.replace(/\//g, "\\");
                return decoded;
        }
    }

    public static getUriFromPath(path: string) : string
    {
        let pathStart = "file://";

        // Handle Windows paths with backslashes
        if (process.platform == "win32") {
            path = path.replace(/\\/g, "\/");
            pathStart = "file:///";
        }

        let encoded = encodeURI(path);

        // Handle colons specially as encodeURI does not encode them
        encoded = encoded.replace(":", "%3A");

        return pathStart + encoded;
    }
}
