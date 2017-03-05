/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

const fs = require("fs");
const zlib = require('zlib');
const util = require('util');

let isProcessing = false;
let waitProcessing = null;
let waitInterval = 5000;
let errHandler = null;
let pendingCb = [];

/**
 * Requests to flush the specified tree structure
 */
export function onError(cb: (err: Error) => void): void {
    errHandler = cb;
};

/**
 * Raise an error
 */
function raiseError(err: Error): void {
    if (errHandler) {
        errHandler(err);
    } else {
        console.error(err.stack ? err.stack : err);
    }
};

/**
 * Reads the specified filename
 */
export function read(filename: string, cb: (err?: Error, tree?:any) => void): void {
    if (isProcessing) {
        // bad things may happen, so delay it by 1 sec
        setTimeout(() => {
            read(filename, cb);
        }, 1000);
    } else {
        // reads the file
        fs.readFile(filename, (err, data) => {
            if (err) {
                raiseError(err);
                cb(err, null);
            } else {
                var treeStream = new Buffer(data);
                zlib.gunzip(treeStream, (err, buffer) => {
                    if (err) {
                        raiseError(err);
                        cb(err, null);
                    } else {
                        try {
                            var tree = JSON.parse(buffer.toString());
                        } catch(e) {
                            raiseError(e);
                            return cb(e, null);
                        }
                        cb(null, tree);
                    }
                });
            }
        });
    }
};

/**
 * Requests to flush the specified tree structure
 */
export function save(filename: string, tree: any, cb?: (result: boolean|Error) => void): void {
    if (waitProcessing) {
        clearTimeout(waitProcessing);
    }
    if (cb && pendingCb.indexOf(cb) === -1) {
        pendingCb.push(cb);
    }
    waitProcessing = setTimeout(
        processSave.bind(this, filename, tree),
        waitInterval
    );
};

/**
 * Flushing the error state
 */
function processSaveResult(result: Boolean|Error): void {
    isProcessing = false;
    if (result instanceof Error) {
        raiseError(result);
    }
    pendingCb.forEach((item) => {
        item(result);
    });
    pendingCb = [];
}

/**
 * The real function that writes file
 */
function processSave(filename, tree) {
    if (isProcessing) {
        // wait until current flush is finished
        return save(filename, tree);
    }
    isProcessing = true;
    try {
        var output = JSON.stringify(tree);
        fs.writeFile(filename + '.tmp', output, (err) => {
            if (err) {
                processSaveResult(err);
            } else {
                try {
                    var gzip = zlib.createGzip();
                    var inp = fs.createReadStream(filename + '.tmp');
                    var out = fs.createWriteStream(filename);
                    inp.pipe(gzip).pipe(out).on('close', function () {
                        try {
                            fs.unlinkSync(filename + '.tmp');
                            processSaveResult(true);
                        } catch(e) {
                            processSaveResult(e);
                        }
                    });
                } catch(e) {
                    processSaveResult(e);
                }
            }
        });
    } catch(e) {
        processSaveResult(e);
    }
}
