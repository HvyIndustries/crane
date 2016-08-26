import { IConnection, RequestType } from 'vscode-languageserver';
import { workspaceRoot, enableCache, getCraneDir } from './server';
import { TreeBuilder, FileNode } from "./hvy/treeBuilder";
import { Debug } from './utils/Debug';

const crypto  = require('crypto');
const fs = require("fs");
const fstream = require('fstream');
const http = require('https');
const mkdirp = require('mkdirp');
const rmrf = require('rimraf');
const util = require('util');
const unzip = require('unzip');
const zlib = require('zlib');

// Glob for file searching
const glob = require("glob");

// FileQueue for queuing files so we don't open too many
const FileQueue = require('filequeue');
const fq = new FileQueue(200);

export class Index {

    public tree: FileNode[] = [];

    private connection: IConnection;
    private treeBuilder: TreeBuilder = new TreeBuilder();

    public constructor(connection: IConnection) {
        this.connection = connection;

        this.treeBuilder.SetConnection(connection);

        const downloadStubs: RequestType<{ url: string }, void, void> = { method: "index/downloadStubs" };
        connection.onRequest(downloadStubs, param => {
            this.downloadStubs(param.url);
        });

        const deleteAllCaches: RequestType<void, void, void> = { method: "index/deleteAllCaches" };
        connection.onRequest(deleteAllCaches, param => {
            this.deleteAllCaches().then(result => {
                this.connection.window.showInformationMessage('All PHP file caches were successfully deleted');
                this.rebuild();
            });
        });

        const rebuild: RequestType<void, void, void> = { method: "index/rebuild" };
        connection.onRequest(rebuild, param => {
            this.rebuild();
        });
    }

    public build(): void {
        this.createProjectDir().then(result => {
            // Folder was created so there is no tree cache
            if (result.folderCreated) {
                this.processWorkspace();
            } else {
                // Check for a tree file, if it exists load it;
                // otherwise we need to process the files in the workspace
                this.doesProjectTreeExist().then(tree => {
                    if (!tree.exists) {
                        this.processWorkspace();
                    } else {
                        this.restoreFromCache();
                    }
                });
            }
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }

    public rebuild(): void {
        Debug.info('Rebuilding the project files');
        fs.unlink(this.getTreePath(), (err) => {
            this.createProjectFolder().then(success => {
                if (success) {
                    this.processWorkspace(true);
                }
            });
        });
    }

    public deleteAllCaches(): Promise<boolean> {
        return new Promise((resolve, reject) => {
            rmrf(getCraneDir() + '/projects/*', err => {
                if (!err) {
                    Debug.info('Project caches were deleted');
                    return resolve(true);
                }
                Debug.info('Project caches were not deleted');
                return resolve(false);
            });
        });
    }

    public addFile(path: string): void {
        fq.readFile(path, { encoding: 'utf8' }, (err, data) => {
            this.updateFile(path, data, true);
        });
    }

    public updateFile(path: string, text: string, saveCache: boolean = false): void {
        this.treeBuilder.Parse(text, path).then(result => {
            this.addToWorkspaceTree(result.tree);
            if (saveCache) {
                this.saveCache();
            }
            // notifyClientOfWorkComplete();
            return true;
        })
        .catch(error => {
            console.log(error);
            this.notifyClientForWorkComplete();
            return false;
        });
    }

    public removeFile(path: string): void {
        var node = this.getFileNode(path);
        this.removeFromWorkspaceTree(node);
        this.saveCache();
    }

    public getFileNode(path: string): FileNode {
        var returnNode = null;

        this.tree.forEach(fileNode => {
            if (fileNode.path == path) {
                returnNode = fileNode;
            }
        });

        return returnNode;
    }

    private saveCache() {
        this.saveProjectTree(this.getProjectDir(), this.getTreePath()).then(saved => {
            this.notifyClientForWorkComplete();
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }

    private getProjectDir(): string {
        var md5sum = crypto.createHash('md5');
        // Get the workspace location for the user
        return getCraneDir() + '/projects/' + (md5sum.update(workspaceRoot)).digest('hex');
    }

    private getStubsDir(): string {
        return getCraneDir() + '/phpstubs';
    }

    private getTreePath(): string {
        return this.getProjectDir() + '/tree.cache';
    }

    private downloadStubs(url: String): void {
        var tmp = getCraneDir() + '/phpstubs.tmp.zip';
        Debug.info(`Downloading ${url} to ${tmp}`);
        this.createStubsFolder().then(created => {
            if (created) {
                var file = fs.createWriteStream(tmp);
                http.get(url, (response) => {
                    response.pipe(file);
                    response.on('end', () => {
                        Debug.info('PHPStubs Download Complete');

                        Debug.info(`Unzipping to ${this.getStubsDir()}`);
                        fs.createReadStream(tmp)
                            .pipe(unzip.Parse())
                            .pipe(fstream.Writer(this.getStubsDir()));
                        this.connection.window.showInformationMessage('PHP Library Stubs downloaded and installed. You may need to re-index the workspace for them to work correctly.', { title: 'Rebuild Now' }).then(item => {
                            this.rebuild();
                        });
                    });
                });
            }
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }

    private createStubsFolder(): Promise<boolean> {
        return new Promise((resolve, reject) => {
            mkdirp(getCraneDir() + '/phpstubs', (err) => {
                if (err) {
                    resolve(false);
                } else {
                    resolve(true);
                }
            });
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

    private createProjectDir(): Promise<{ folderExists: boolean, folderCreated: boolean, path: string }> {
        return new Promise((resolve, reject) => {
            if (enableCache) {
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

    private doesProjectTreeExist(): Promise<{exists:boolean, path:string}> {
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

    private processWorkspace(rebuild: boolean = false) {
        glob(workspaceRoot + '/**/*.php', (err, fileNames) => {
            this.buildIndexFromFiles(fileNames, rebuild);
        });
    }

    

    private buildIndexFromFiles(files: string[], rebuild: boolean) {
        if (rebuild) {
            this.tree = [];
            this.treeBuilder = new TreeBuilder();
        }
        this.connection.console.log('starting work!');
        // Run asynchronously
        setTimeout(() => {
            var craneRoot = getCraneDir()
            glob(craneRoot + '/phpstubs/*/*.php', (err, fileNames) => {
                // Process the php stubs
                var stubs: string[] = fileNames;
                Debug.info(`Processing ${stubs.length} stubs from ${craneRoot}/phpstubs`);
                this.connection.console.log(`Stub files to process: ${stubs.length}`);
                this.processStub(stubs).then(data => {
                    this.connection.console.log('stubs done!');
                    this.processWorkspaceFiles(files, this.getProjectDir(), this.getTreePath());
                }).catch(data => {
                    this.connection.console.log('No stubs found!');
                    this.processWorkspaceFiles(files, this.getProjectDir(), this.getTreePath());
                });
            });
        }, 100);
    }

    /**
     * Processes the stub files
     */
    private processStub(stubs: string[]) {
        return new Promise((resolve, reject) => {
            var offset: number = 0;
            if (stubs.length == 0) {
                reject();
            }
            stubs.forEach(file => {
                fq.readFile(file, { encoding: 'utf8' }, (err, data) => {
                    this.treeBuilder.Parse(data, file).then(result => {
                        this.addToWorkspaceTree(result.tree);
                        this.connection.console.log(`${offset} Stub Processed: ${file}`);
                        offset++;
                        if (offset == stubs.length) {
                            resolve();
                        }
                    }).catch(err => {
                        this.connection.console.log(`${offset} Stub Error: ${file}`);
                        Debug.error((util.inspect(err, false, null)));
                        offset++;
                        if (offset == stubs.length) {
                            resolve();
                        }
                    });
                });
            });
        });
    }

    /**
     * Processes the users workspace files
     */
    private processWorkspaceFiles(files: string[], projectPath: string, treePath: string) {
        this.connection.console.log(`Workspace files to process: ${files.length}`);
        var progress = 0;
        files.forEach(file => {
            fq.readFile(file, { encoding: 'utf8' }, (err, data) => {
                this.treeBuilder.Parse(data, file).then(result => {
                    this.addToWorkspaceTree(result.tree);
                    progress++;
                    this.connection.console.log(`(${progress} of ${files.length}) File: ${file}`);
                    this.connection.sendNotification({ method: "index/fileProcessed" }, { filename: file, count: progress, total: files.length, error: null });
                    if (files.length == progress) {
                        this.workspaceProcessed(projectPath, treePath);
                    }
                }).catch(data => {
                    progress++;
                    if (files.length == progress) {
                        this.workspaceProcessed(projectPath, treePath);
                    }
                    this.connection.console.log(util.inspect(data, false, null));
                    this.connection.console.log(`Issue processing ${file}`);
                    this.connection.sendNotification({ method: "index/fileProcessed" }, { filename: file, count: progress, total: files.length, error: util.inspect(data, false, null) });
                });
            });
        });
    }

    private workspaceProcessed(projectPath, treePath) {
        Debug.info("Workspace files have processed");
        this.saveProjectTree(projectPath, treePath).then(savedTree => {
            this.notifyClientForWorkComplete();
            if (savedTree) {
                Debug.info('Project tree has been saved');
            }
        }).catch(error => {
            Debug.error(util.inspect(error, false, null));
        });
    }

    private restoreFromCache(): void {
        Debug.info('Restoring index from cache file: ' + this.getTreePath());
        fs.readFile(this.getTreePath(), (err, data) => {
            if (err) {
                Debug.error('Could not read cache file');
                Debug.error((util.inspect(err, false, null)));
            } else {
                Debug.info('Unzipping the file');
                var treeStream = new Buffer(data);
                zlib.gunzip(treeStream, (err, buffer) => {
                    if (err) {
                        Debug.error('Could not unzip cache file');
                        Debug.error((util.inspect(err, false, null)));
                    } else {
                        Debug.info('Cache file successfully read');
                        this.tree = JSON.parse(buffer.toString());
                        Debug.info('Loaded');
                        this.notifyClientForWorkComplete();
                    }
                });
            }
        });
    }

    private notifyClientForWorkComplete()
    {
        var requestType: RequestType<any, any, any> = { method: "index/workDone" };
        this.connection.sendRequest(requestType);
    }

    private addToWorkspaceTree(tree: FileNode) {
        // Loop through existing filenodes and replace if exists, otherwise add

        var fileNode = this.tree.filter((fileNode) => {
            return fileNode.path == tree.path;
        })[0];

        var index = this.tree.indexOf(fileNode);

        if (index !== -1) {
            this.tree[index] = tree;
        } else {
            this.tree.push(tree);
        }

        // Debug
        // connection.console.log("Parsed file: " + tree.path);
    }

    private removeFromWorkspaceTree(tree: FileNode) {
        var index: number = this.tree.indexOf(tree);
        if (index > -1) {
            this.tree.splice(index, 1);
        }
    }

    private saveProjectTree(projectPath: string, treeFile: string): Promise<boolean> {
        return new Promise((resolve, reject) => {
            if (!enableCache) {
                resolve(false);
            } else {
                Debug.info('Packing tree file: ' + treeFile);
                fq.writeFile(`${projectPath}/tree.tmp`, JSON.stringify(this.tree), (err) => {
                    if (err) {
                        Debug.error('Could not write to cache file');
                        Debug.error(util.inspect(err, false, null));
                        resolve(false);
                    } else {
                        var gzip = zlib.createGzip();
                        var inp = fs.createReadStream(`${projectPath}/tree.tmp`);
                        var out = fs.createWriteStream(treeFile);
                        inp.pipe(gzip).pipe(out).on('close', function () {
                            fs.unlinkSync(`${projectPath}/tree.tmp`);
                        });
                        Debug.info('Cache file updated');
                        resolve(true);
                    }
                });
            }
        });
    }

}