import { window, workspace, OutputChannel } from 'vscode';

const craneSettings = workspace.getConfiguration("crane");
const outputConsole = window.createOutputChannel("Crane Console");

export class Debug {

    private static debugMode: boolean = craneSettings ? craneSettings.get<boolean>("debugMode", false) : false;

    public static info(message: string) {
        Debug.showConsole();
        outputConsole.appendLine(`[INFO] ${message}`);
    }

    public static error(message: string) {
        Debug.showConsole();
        outputConsole.appendLine(`[ERROR] ${message}`);
    }

    public static warning(message: string) {
        Debug.showConsole();
        outputConsole.appendLine(`[WARN] ${message}`);
    }

    private static showConsole() {
        if (Debug.debugMode) {
            outputConsole.show();
        }
    }

}