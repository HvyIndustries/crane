import { IConnection } from 'vscode-languageserver';


export class Debug{
    public static connection: IConnection;

    public static SetConnection(conn: IConnection) {
        Debug.connection = conn;
    }

    public static info(message: string) {
        Debug.connection.sendNotification({ method: 'serverDebugMessage' }, { type: 'info', message: message });
    }

    public static error(message: string) {
        Debug.connection.sendNotification({ method: 'serverDebugMessage' }, { type: 'error', message: message });
    }

    public static warning(message: string) {
        Debug.connection.sendNotification({ method: 'serverDebugMessage' }, { type: 'warning', message: message });
    }
}