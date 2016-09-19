export class Path {

    public static fromURI(uri: string) : string
    {
        var path = uri;
        path = path.replace("file:///", "");
        path = path.replace("%3A", ":");

        // Handle Windows and Unix paths
        switch (process.platform) {
            case 'darwin':
            case 'linux':
                path = "/" + path;
                break;
            case 'win32':
                path = path.replace(/\//g, "\\");
                break;
        }

        return path;
    }

}