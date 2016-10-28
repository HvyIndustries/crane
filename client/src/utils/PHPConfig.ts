import {workspace} from 'vscode';

export default class PHPConfig {

    private static phpConfig: { files?: string[], exclude?: string[] } = {};

    public static getFilePatterns(): { include: string, exclude: string } {
        let pattern = { include: '**/*.php', exclude: '' };

        if (this.phpConfig.files && this.phpConfig.files.length > 0) {
            pattern.include = '{' + this.phpConfig.files.join(',') + '}';
        } else if (this.phpConfig.exclude && this.phpConfig.exclude.length > 0) {
            pattern.exclude = '{' + this.phpConfig.exclude.join(',') + '}';
        }

        return pattern;
    }

    public static load() {
        try {
            let file = workspace.rootPath + '/phpconfig.json';
            this.phpConfig = require(file);
            delete require.cache[require.resolve(file)];
        } catch (e) { }
    }
}