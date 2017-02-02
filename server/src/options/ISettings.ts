/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

/**
 * Defines the structure of the extension settings
 */
interface ISettings {
    /**
     * Enables additionnal informations into the console, and
     * shows informations in a new pannel
     */
    debugMode: boolean;

    /**
     * Enable parsing of a stub file
     */
    phpstubsZipFile: string;

    /**
     * Maximum number of suggestions
     */
    maxSuggestionSize: number;

    /**
     * List of excluded directory names
     * By default : '.git', '.svn', 'node_modules'
     */
    exclude: Array<string>;

    /**
     * List of included directories
     * By default : './'
     */
    include: Array<string>;

    /**
     * List of php extension files
     * By default : '*.php', '*.php3', '*.php5', '*.phtml',
     * '*.inc', '*.class', '*.req'
     */
    extensions: Array<string>;

    /**
     * extract vars from each scope (functions, classes)
     * may use memory but could be usefull for resolving
     * their type (on autocompletion)
     */
    scanVars: boolean;

    /**
     * Extract scopes from, improves auto-incremental parsing
     */
    scanExpr: boolean;

    /**
     * Default parsing encoding
     * By default : utf8
     */
    encoding: string;

    /**
     * should spawn a worker process to avoid blocking
     * the main loop (may be slower with small projects or single cpu)
     * By default : detects number of cores
     */
    forkWorker: number;

    /**
     * Enable caching to allow Crane to start faster after the
     * workspace has been indexed
     */
    enableCache: boolean;

    /**
     * use the file mtime property to check changes
     */
    cacheByFileDate: boolean;

    /**
     * use the file size to detect changes
     */
    cacheByFileSize: boolean;

    /**
     * use an hash algorithm to detect changes
     * if low cache hit, may slow down the parsing
     */
    cacheByFileHash: boolean;

    /**
     * should support PHP7
     */
    php7: boolean;
}

export default ISettings;
