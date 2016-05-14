import { window, workspace, OutputChannel } from 'vscode';
import { Config } from './Config';

const outputConsole = window.createOutputChannel("Crane Console");

export class Debug {

    /**
     * Displays an info message prefixed with [INFO]
     */
    public static info(message: string) {
        Debug.showConsole();
        if (Config.debugMode) {
            outputConsole.appendLine(`[INFO] ${message}`);
        }
    }

    /**
     * Displays and error message prefixed with [ERROR]
     */
    public static error(message: string) {
        Debug.showConsole();
        if (Config.debugMode) {
            outputConsole.appendLine(`[ERROR] ${message}`);
        }
    }

    /**
     * Displays and warning message prefixed with [WARN]
     */
    public static warning(message: string) {
        Debug.showConsole();
        if (Config.debugMode) {
            outputConsole.appendLine(`[WARN] ${message}`);
        }
    }

    private static showConsole() {
        if (Config.debugMode) {
            outputConsole.show();
        }
    }

}