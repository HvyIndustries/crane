import Crane from './crane';

const crypto = require('crypto');
const fs = require('fs');

export class Cranefs {

    public createProjectDir(workspaceRoot: string) {
        return new Promise((resolve, reject) => {
            var md5sum = crypto.createHash('md5');
            // Get the workspace location for the user
            var craneProjectDir: string = (
                process.env.APPDATA + '/crane' || (process.platform == 'darwin' ? process.env.HOME + 'Library/Preferences/crane' : '/var/local/crane')
            ) + '/' + (md5sum.update(workspaceRoot)).digest('hex');
            // Create the project folder if it does not exist
            fs.stat(craneProjectDir, (err, stat) => {
                if (err === null) {
                    Crane.debug(`[INFO] Project folder already exists: ${craneProjectDir}`);
                    resolve({ folderExists: true, folderCreated: false });
                } else if (err.code == 'ENOENT') {
                    if (!err) {
                        Crane.debug(`[INFO] Creating project folder: ${craneProjectDir}`);
                        resolve({ folderExists: true, folderCreated: true });
                    } else {
                        Crane.debug(`[INFO] Project folder already exists: ${craneProjectDir}`);
                        resolve({ folderExists: false, folderCreated: false });
                    }
                }
            });
        });
    }

}