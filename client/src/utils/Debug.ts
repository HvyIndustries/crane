import { window, workspace, OutputChannel } from 'vscode';
import { Config } from './Config';

const outputConsole = window.createOutputChannel("Crane Console");

export class Debug {

    private static calls: number = 0;

    /**
     * Displays an info message prefixed with [INFO]
     */
    public static info(message: string) {
        if (Config.debugMode) {
            Debug.showConsole();
            outputConsole.appendLine(`[INFO] ${message}`);
        }
    }

    /**
     * Displays and error message prefixed with [ERROR]
     */
    public static error(message: string) {
        if (Config.debugMode) {
            Debug.showConsole();
            outputConsole.appendLine(`[ERROR] ${message}`);
        }
    }

    /**
     * Displays and warning message prefixed with [WARN]
     */
    public static warning(message: string) {
        if (Config.debugMode) {
            Debug.showConsole();
            outputConsole.appendLine(`[WARN] ${message}`);
        }
    }

    public static clear() {
        outputConsole.clear();
        outputConsole.dispose();
    }

    private static showConsole() {
        if (Config.debugMode) {
            outputConsole.show();
        }
    }

}