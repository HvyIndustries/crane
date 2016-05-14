import { workspace } from 'vscode';
import { NotificationType, RequestType } from 'vscode-languageclient';
import Crane from '../crane';
import { Debug } from './Debug';

const crypto = require('crypto');
const fs = require('fs');

export class Cranefs {

    public getCraneDir(): string {
        return (
            process.env.APPDATA + '/Crane' ||
            (process.platform == 'darwin' ? process.env.HOME + 'Library/Preferences/Crane' : '/var/local/Crane')
        );
    }

    public getProjectDir(): string {
        var md5sum = crypto.createHash('md5');
        // Get the workspace location for the user
        return this.getCraneDir() + '/' + (md5sum.update(workspace.rootPath)).digest('hex');
    }

    public createProjectDir(): Promise<{ folderExists:boolean, folderCreated:boolean, path:string }> {
        return new Promise((resolve, reject) => {
            this.createProjectFolder().then(projectCreated => {
                resolve(projectCreated);
            });
        });
    }

    public doesProjectTreeExist(): Promise<{exists:boolean, path:string}> {
        return new Promise((resolve, reject) => {
            fs.stat(this.getProjectDir() + '/tree.cache', (err, stat) => {
                if (err === null) {
                    resolve({exists: true, path: this.getProjectDir() + '/tree.cache'});
                } else {
                    resolve({exists: false, path: null});
                }
            });
        });
    }

    public processWorkspaceFiles() {
        if (workspace.rootPath == undefined) return;
        var fileProcessCount = 0;

        // Find all the php files to process
        workspace.findFiles('**/*.php', '').then(files => {
            Debug.info(`Preparing to parse ${files.length} PHP source files...`);

            fileProcessCount = files.length;
            var filePaths: string[] = [];

            // Get the objects path value for the current file system
            files.forEach(file => {
                filePaths.push(file.fsPath);
            });

            // Send the array of paths to the language server
            Crane.langClient.sendRequest({ method: "buildFromFiles" }, { files: filePaths, projectPath: this.getProjectDir(), treePath: this.getProjectDir() + '/tree.cache' });
        });

        // Update the UI so the user knows the processing status
        var fileProcessed: NotificationType<any> = { method: "fileProcessed" };
        Crane.langClient.onNotification(fileProcessed, data => {
            // Get the percent complete
            var percent: string = ((data.total / fileProcessCount) * 100).toFixed(2);
            Crane.statusBarItem.text = `$(zap) Processing source files (${data.total} of ${fileProcessCount} / ${percent}%)`;
            if (data.error) {
                Debug.error("There was a problem parsing PHP file: " + data.filename);
                Debug.error(`${data.error}`);
            } else {
                Debug.info(`Parsed file ${data.total} of ${fileProcessCount} : ${data.filename}`);
            }

            // Once all files have been processed, update the statusBarItem
            if (data.total == fileProcessCount) {
                Crane.statusBarItem.text = '$(check) Processing of PHP source files complete';
            }
        });
    }

    public processProject() {
        Debug.info('Building project from cache');
        Crane.langClient.sendRequest({ method: "buildFromProject" }, {treePath: this.getProjectDir() + '/tree.cache'});
    }

    private createCraneFolder(): Promise<boolean> {
        return new Promise((resolve, reject) => {
            var craneDir = this.getCraneDir();
            fs.stat(craneDir, (err, stat) => {
                if (err === null) {
                    resolve(true);
                } else if (err.code == 'ENOENT') {
                    fs.mkdirSync(craneDir);
                    resolve(true);
                }
            });
        });
    }

    private createProjectFolder(): Promise<{ folderExists:boolean, folderCreated:boolean, path:string }> {
        return new Promise((resolve, reject) => {
            this.createCraneFolder().then(craneCreated => {
                if (craneCreated) {
                    var projectDir = this.getProjectDir();
                    fs.stat(projectDir, (err, stat) => {
                        if (err === null) {
                            Debug.info(`Project folder: ${projectDir}`);
                            resolve({ folderExists: true, folderCreated: false, path: projectDir });
                        } else if (err.code == 'ENOENT') {
                            Debug.info(`Creating project folder: ${projectDir}`);
                            fs.mkdirSync(projectDir);
                            resolve({ folderExists: false, folderCreated: false, path: projectDir });
                        }
                    });
                }
            });
        });
    }

}