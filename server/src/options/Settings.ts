/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import ISettings from './ISettings';

/**
 * List of default settings
 */
class Settings implements ISettings {
    debugMode = false;
    phpstubsZipFile = "https://codeload.github.com/HvyIndustries/crane-php-stubs/zip/master";
    maxSuggestionSize = 1024;
    exclude = [".git", ".svn", "node_modules"];
    include = ["./"];
    extensions = ['*.php', '*.php3', '*.php5', '*.phtml', '*.inc', '*.class', '*.req'];
    scanVars = true;
    scanExpr = true;
    encoding = "utf8";
    forkWorker = -1;
    enableCache = true;
    cacheByFileDate = true;
    cacheByFileSize = true;
    cacheByFileHash = true;
    php7 = true;
}

export default Settings;
