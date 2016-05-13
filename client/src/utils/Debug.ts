import { window, workspace, OutputChannel } from 'vscode';

const craneSettings = workspace.getConfiguration("crane");
const outputConsole = window.createOutputChannel("Crane Console");

export class Debug {

    private static debugMode: boolean = craneSettings ? craneSettings.get<boolean>("debugMode", false) : false;

    /**
     * Displays an info message prefixed with [INFO]
     */
    public static info(message: string) {
        Debug.showConsole();
        if (Debug.debugMode) {
            outputConsole.appendLine(`[INFO] ${message}`);
        }
    }

    /**
     * Displays an error message prefixed with [ERROR]
     */
    public static error(message: string) {
        Debug.showConsole();
        if (Debug.debugMode) {
            outputConsole.appendLine(`[ERROR] ${message}`);
        }
    }

    /**
     * Displays a warning message prefixed with [WARN]
     */
    public static warning(message: string) {
        Debug.showConsole();
        if (Debug.debugMode) {
            outputConsole.appendLine(`[WARN] ${message}`);
        }
    }

    private static showConsole() {
        if (Debug.debugMode) {
            outputConsole.show();
        }
    }

}