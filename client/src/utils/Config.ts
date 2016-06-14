import { workspace } from 'vscode';
import { Debug } from './Debug';

export class Config {

    public static craneSettings = workspace.getConfiguration("crane");

    public static reloadConfig() {
        Config.craneSettings = workspace.getConfiguration("crane");
    }

    public static get debugMode(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("debugMode", false) : false;
    }

    public static get saveCache(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("saveCache", true) : true;
    }

    public static get showBugReport(): boolean {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<boolean>("showStatusBarBugReportLink", true) : true;
    }

    public static get phpstubsZipFile(): string {
        Config.reloadConfig();
        return Config.craneSettings ? Config.craneSettings.get<string>("phpstubsZipFile", "https://codeload.github.com/HvyIndustries/crane-php-stubs/zip/master") : "https://codeload.github.com/HvyIndustries/crane-php-stubs/zip/master";
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
        return extentions;
    }

}