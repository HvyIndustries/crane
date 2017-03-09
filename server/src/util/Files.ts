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
        var path = uri;
        path = path.replace("file:///", "");
        path = path.replace("%3A", ":");

        // Handle Windows and Unix paths
        switch (process.platform) {
            case 'darwin':
            case 'linux':
                path = "/" + path;
                break;
            case 'win32':
                path = path.replace(/\//g, "\\");
                break;
        }

        return path;
    }

    public static getUriFromPath(path: string) : string
    {
        path = path.replace(":", "%3A");

        // Handle Windows paths with backslashes
        switch (process.platform) {
            case 'win32':
                path = path.replace(/\\/g, "\/");
                break;
        }

        path = "file:///" + path;

        return path;
    }
}
