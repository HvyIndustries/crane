import { workspace } from 'vscode';
import { Debug } from './Debug';

export class Config {

    public static craneSettings = workspace.getConfiguration("crane");

    public static reloadConfig() {
        Config.craneSettings = workspace.getConfiguration("crane");
    }

    public static get debugMode(): boolean {
        return Config.craneSettings ? Config.craneSettings.get<boolean>("debugMode", false) : false;
    }

    public static get saveCache(): boolean {
        return Config.craneSettings ? Config.craneSettings.get<boolean>("saveCache", true) : true;
    }

    public static get showBugReport(): boolean {
        return Config.craneSettings ? Config.craneSettings.get<boolean>("showStatusBarBugReportLink", true) : true;
    }

}