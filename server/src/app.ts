/*!
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 */

import events = require('events');
import ISettings from './options/ISettings';
import Settings from './options/Settings';
import Message from './util/Message';
import { Repository } from 'php-reflection';

/**
 * The main application instance
 */
class App extends events.EventEmitter {
    /**
     * The application settings instance
     */
    settings: ISettings;

    /**
     * The reflection engine
     */
    workspace: Repository;

    /**
     * The messaging object
     */
    message: Message;

    /**
     * Defines the custom autocomplete handler
     */
    autocomplete: Function;

    /**
     * Current working directory
     */
    path: string;

    /**
     * Initialize the workspace
     */
    constructor(path: string, settings: any = null) {
        super();
        this.setPath(path);
        this.setSettings(settings || new Settings());
    }

    /**
     * Make an absolute path relative to current root repository
     */
    resolveUri(uri:string): string {
        let filename:string = uri;
        if (filename.substring(0, 7) === 'file://') {
            filename = filename.substring(7);
        }
        if (filename.startsWith(this.path)) {
            filename = filename.substring(this.path.length);
            if (filename[0] === '/') {
                filename = filename.substring(1);
            }
        }
        return filename;
    }

    /**
     * Changing the current path
     */
    setPath(path: string) {
        this.path = path;
        if (this.settings) {
            // rebuilds the workspace
            this.setSettings(this.settings);
        }
    }

    /**
     * Update settings
     */
    setSettings(settings: ISettings) {
        this.settings = settings;

        this.workspace = new Repository(this.path, {
            // @todo : bind parameters
            cacheByFileHash: true,
            lazyCache: function(type: String, name: String) {

            }
        });


        // forward events :
        this.workspace.on('read', this.emit.bind(this, ['read']));
        this.workspace.on('cache', this.emit.bind(this, ['cache']));
        this.workspace.on('parse', this.emit.bind(this, ['parse']));
        this.workspace.on('error', this.emit.bind(this, ['error']));
        this.workspace.on('progress', this.emit.bind(this, ['progress']));
    }
}

export default App;
