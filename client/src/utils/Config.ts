import { workspace } from 'vscode';
import { Debug } from './Debug';

var pkg = require('../../../package.json');

export class Config {

    public static craneSettings = workspace.getConfiguration("crane");

    public static reloadConfig() {
        Config.craneSettings = workspace.getConfiguration("crane");
    }

    public static get debugMode(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("debugMode", false) : false;
    }

    public static get enableCache(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("enableCache", true) : true;
    }

    public static get showBugReport(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("showStatusBarBugReportLink", false) : false;
    }

    public static get showStatusBarIcon(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("showStatusBarIcon", true) : true;
    }

    public static get phpstubsZipFile(): string {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<string>("phpstubsZipFile", "https://codeload.github.com/HvyIndustries/crane-php-stubs/zip/master") : "https://codeload.github.com/HvyIndustries/crane-php-stubs/zip/master";
    }

    public static get ignoredPaths(): Array<string> {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<Array<string>>("ignoredPaths", []) : [];
    }

    public static get enableErrorTelemetry(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("enableErrorTelemetry", false) : false;
    }

    public static get version(): string {
        return pkg.version.toString();
    }

    public static get phpFileTypes() {
        var fileSettings = workspace.getConfiguration("files");
        var obj: Object = fileSettings.get<Object>("associations", new Object());

        var extentions = { include: [], exclude: [] };
        for (var i in obj) {
            var value: string = '**/*' + i.replace(/^\*/, '');
            if (obj[i].toLowerCase() == 'php') {
                extentions.include.push(value);
            } else {
                extentions.exclude.push(value);
            }
        }
        if (extentions.include.indexOf('**/*.php') == -1) {
            extentions.include.push('**/*.php');
        }
        return extentions;
    }

}
