/**
 * Copyright (c) Hvy Industries. All rights reserved.
 * Licensed under the MIT License. See License.txt in the project root
 * for license information.
 * "HVY", "HVY Industries" and "Hvy Industries" are trading names of
 * JCKD (UK) Ltd
 */

import { IConnection } from 'vscode-languageserver';

/**
 * List of message types
 */
export enum MessageType {
    Info = 1,
    Success,
    Trace,
    Warning,
    Error,
    Status
};

/**
 * The debug/messaging class
 */
export default class Message {
    // the connection to the client
    protected connection: IConnection;

    /**
     * Initialize with the specified connection
     */
    constructor(connection: IConnection) {
        this.connection = connection;
    }

    /**
     * Sends a message to the client
     */
    protected sendMessage(type: MessageType, message) : Message {
        this.connection.sendNotification(
            'message', {
                type: type,
                message: message
            }
        );

        // sends the message to the error console
        if (type === MessageType.Error) {
            this.connection.console.error(message);
        } else if (type === MessageType.Info) {
            this.connection.console.info(message);
        } else if (type === MessageType.Trace) {
            this.connection.console.log(message);
        } else if (type === MessageType.Warning) {
            this.connection.console.warn(message);
        }

        return this;
    }

    /**
     * Shows an information message
     */
    public info(message: string) : Message {
        return this.sendMessage(MessageType.Info, message);
    }

    /**
     * Shows an information message
     */
    public success(message: string) : Message {
        return this.sendMessage(MessageType.Success, message);
    }

    /**
     * Shows a trace message
     */
    public trace(message: string) : Message {
        return this.sendMessage(MessageType.Trace, message);
    }

    /**
     * Shows a trace message
     */
    public error(message: string) : Message {
        return this.sendMessage(MessageType.Error, message);
    }

    /**
     * Shows a trace message
     */
    public warning(message: string) : Message {
        return this.sendMessage(MessageType.Warning, message);
    }

    /**
     * Shows a message into the status bar
     */
    public status(message: string) : Message {
        return this.sendMessage(MessageType.Status, message);
    }
}
