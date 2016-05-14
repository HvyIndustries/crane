import { workspace } from 'vscode';
import { NotificationType, RequestType } from 'vscode-languageclient';
import Crane from '../crane';
import { Debug } from './Debug';
import { Config } from './Config';

const crypto = require('crypto');
const fs = require('fs');
let craneSettings = workspace.getConfiguration("crane");

export class Cranefs {

    public isCacheable(): boolean {
        return Config.saveCache;
    }

    public getCraneDir(): string {
        if (process.env.APPDATA) {
            return process.env.APPDATA + '/Crane';
        }
        if (process.platform == 'darwin') {
            return process.env.HOME + 'Library/Preferences/Crane';
        }
        if (process.platform == 'linux') {
            return process.env.HOME + '/Crane';
        }
    }

    public getProjectDir(): string {
        var md5sum = crypto.createHash('md5');
        // Get the workspace location for the user
        return this.getCraneDir() + '/' + (md5sum.update(workspace.rootPath)).digest('hex');
    }

    public createProjectDir(): Promise<{ folderExists: boolean, folderCreated: boolean, path: string }> {
        return new Promise((resolve, reject) => {
            if (this.isCacheable()) {
                this.createProjectFolder().then(projectCreated => {
                    resolve(projectCreated);
                });
            } else {
                resolve({folderExists: false, folderCreated: false, path: null})
            }
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

    public processWorkspaceFiles(rebuild: boolean = false) {
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
            Crane.langClient.sendRequest({ method: "buildFromFiles" }, {
                files: filePaths,
                projectPath: this.getProjectDir(),
                treePath: this.getProjectDir() + '/tree.cache',
                saveCache: this.isCacheable(),
                rebuild: rebuild
            });
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
        });
    }

    public processProject() {
        Debug.info('Building project from cache file: ' + this.getProjectDir() + '/tree.cache');
        Crane.langClient.sendRequest({ method: "buildFromProject" }, {
            treePath: this.getProjectDir() + '/tree.cache',
            saveCache: this.isCacheable()
        });
    }

    public rebuildProject() {
        Debug.info('Rebuilding the project files');
        fs.unlink(`${this.getCraneDir}/tree.cache`, (err) => {
            this.processWorkspaceFiles(true);
        });
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