import { workspace, window } from 'vscode';
import { NotificationType, RequestType } from 'vscode-languageclient';
import Crane from '../crane';
import { Debug } from './Debug';
import { Config } from './Config';

const crypto  = require('crypto');
const fs      = require('fs');
const fstream = require('fstream');
const http    = require('https');
const unzip   = require('unzip');
const util    = require('util');
const mkdirp  = require('mkdirp');
const rmrf    = require('rimraf');

let craneSettings = workspace.getConfiguration("crane");

interface result {
    err;
    data;
}

export class Cranefs {

    public isCacheable(): boolean {
        return Config.enableCache;
    }

    public getCraneDir(): string {
        if (process.env.APPDATA) {
            return process.env.APPDATA + '/Crane';
        }
        if (process.env.XDG_CONFIG_HOME) {
            return process.env.XDG_CONFIG_HOME + '/Crane';
        }
        if (process.platform == 'darwin') {
            return process.env.HOME + '/Library/Preferences/Crane';
        }
        if (process.platform == 'linux') {
            return process.env.HOME + '/.config/Crane';
        }
    }

    public getVersionFile(): Thenable<result> {
        return new Promise((resolve, reject) => {
            var filePath = this.getCraneDir() + "/version";
            fs.readFile(filePath, "utf-8", (err, data) => {
                resolve({ err, data });
            });
        });
    }

    public createOrUpdateVersionFile(fileExists: boolean) {
        var filePath = this.getCraneDir() + "/version";

        if (fileExists) {
            // Delete the file
            fs.unlinkSync(filePath);
        }

        // Create the file + write Config.version into it
        mkdirp(this.getCraneDir(), err => {
            if (err) {
                Debug.error(err);
                return;
            }
            fs.writeFile(filePath, Config.version, "utf-8", err => {
                if (err != null) {
                    Debug.error(err);
                }
            });
        });

    }

    public deleteAllCaches(): Promise<boolean> {
        return new Promise((resolve, reject) => {
            rmrf(this.getCraneDir() + '/projects/*', err => {
                if (!err) {
                    Debug.info('Project caches were deleted');
                    return resolve(true);
                }
                Debug.info('Project caches were not deleted');
                return resolve(false);
            });
        });
    }

    public getProjectDir(): string {
        var md5sum = crypto.createHash('md5');
        // Get the workspace location for the user
        return this.getCraneDir() + '/projects/' + (md5sum.update(workspace.rootPath)).digest('hex');
    }

    public getStubsDir(): string {
        return this.getCraneDir() + '/phpstubs';
    }

    public getTreePath(): string {
        return this.getProjectDir() + '/tree.cache';
    }

    public createProjectDir(): Promise<{ folderExists: boolean, folderCreated: boolean, path: string }> {
        return new Promise((resolve, reject) => {
            if (this.isCacheable()) {
                this.createProjectFolder().then(projectCreated => {
                    resolve(projectCreated);
                }).catch(error => {
                    Debug.error(util.inspect(error, false, null));
                });
            } else {
                resolve({folderExists: false, folderCreated: false, path: null})
            }
        });
    }

    public doesProjectTreeExist(): Promise<{exists:boolean, path:string}> {
        return new Promise((resolve, reject) => {
            fs.stat(this.getTreePath(), (err, stat) => {
                if (err === null) {
                    resolve({exists: true, path: this.getTreePath()});
                } else {
                    resolve({exists: false, path: null});
                }
            });
        });
    }

    public processWorkspaceFiles(rebuild: boolean = false) {
        if (workspace.rootPath == undefined) return;
        var fileProcessCount = 0;

        // Get PHP files from 'files.associations' to be processed
        var files = Config.phpFileTypes;

        // Find all the php files to process
        workspace.findFiles(`{${files.include.join(',')}}`, `{${files.exclude.join(',')}}`).then(files => {
            Debug.info(`Preparing to parse ${files.length} PHP source files...`);

            fileProcessCount = files.length;
            var filePaths: string[] = [];

            // Get the objects path value for the current file system
            files.forEach(file => {
                filePaths.push(file.fsPath);
            });

            Crane.statusBarItem.text = "$(zap) Indexing PHP files";

            // Send the array of paths to the language server
            Crane.langClient.sendRequest({ method: "buildFromFiles" }, {
                files: filePaths,
                craneRoot: this.getCraneDir(),
                projectPath: this.getProjectDir(),
                treePath: this.getTreePath(),
                enableCache: this.isCacheable(),
                rebuild: rebuild
            });

            // Update the UI so the user knows the processing status
            var fileProcessed: NotificationType<any> = { method: "fileProcessed" };
            Crane.langClient.onNotification(fileProcessed, data => {
                // Get the percent complete
                var percent: string = ((data.total / fileProcessCount) * 100).toFixed(1);
                Crane.statusBarItem.text = `$(zap) Indexing PHP files (${data.total} of ${fileProcessCount} / ${percent}%)`;
                if (data.error) {
                    Debug.error("There was a problem parsing PHP file: " + data.filename);
                    Debug.error(`${data.error}`);
                } else {
                    Debug.info(`Parsed file ${data.total} of ${fileProcessCount} : ${data.filename}`);
                }
            });
        });
    }

    public processProject(): void {
        Debug.info('Building project from cache file: ' + this.getTreePath());
        Crane.langClient.sendRequest({ method: "buildFromProject" }, {
            treePath: this.getTreePath(),
            enableCache: this.isCacheable()
        });
    }

    public rebuildProject(): void {
        Debug.info('Rebuilding the project files');
        fs.unlink(this.getTreePath(), (err) => {
            this.createProjectFolder().then(success => {
                if (success) {
                    this.processWorkspaceFiles(true);
                }
            });
        });
    }

    public downloadPHPLibraries(): void {
        var zip = Config.phpstubsZipFile;
        var tmp = this.getCraneDir() + '/phpstubs.tmp.zip';
        Debug.info(`Downloading ${zip} to ${tmp}`);
        this.createPhpStubsFolder().then(created => {
            if (created) {
                var file = fs.createWriteStream(tmp);
                http.get(zip, (response) => {
                    response.pipe(file);
                    response.on('end', () => {
                        Debug.info('PHPStubs Download Complete');
                        Debug.info(`Unzipping to ${this.getStubsDir()}`);
                        fs.createReadStream(tmp)
                            .pipe(unzip.Parse())
                            .pipe(fstream.Writer(this.getStubsDir()));
                        window.showInformationMessage('PHP Library Stubs downloaded and installed. You may need to re-index the workspace for them to work correctly.', 'Rebuild Now').then(item => {
                            this.rebuildProject();
                        });
                    });
                });
            }
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }

    private createProjectFolder(): Promise<{ folderExists: boolean, folderCreated: boolean, path: string }> {
        return new Promise((resolve, reject) => {
            mkdirp(this.getProjectDir(), (err) => {
                if (err) {
                    resolve(false);
                } else {
                    resolve(true);
                }
            });
        });
    }

    private createPhpStubsFolder(): Promise<boolean> {
        return new Promise((resolve, reject) => {
            var craneDir: string = this.getCraneDir();
            mkdirp(craneDir + '/phpstubs', (err) => {
                if (err) {
                    resolve(false);
                } else {
                    resolve(true);
                }
            });
        });
    }

}
