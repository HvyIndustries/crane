/*---------------------------------------------------------------------------------------------
 *  Copyright (c) Hvy Industries. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *  "HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd
 *--------------------------------------------------------------------------------------------*/

import { FileNode } from "../hvy/nodes";

'use strict';

export class Namespaces
{
    public static getNamespaceInfoFromFQNClassname(className: string)
    {
        // Catch cases where classname does not have a namespace
        if (className.indexOf("\\") == -1) {
            return {
                namespace: null,
                classname: className
            };
        }

        let classParts = className.split("\\");

        // Remove the class name
        let rawClassname = classParts.pop();

        // Rebuild the namespace without the classname
        let namespace = classParts.join("\\");

        if (namespace.charAt(0) == "\\" && namespace.length >= 2) {
            // Strip off the leading backslash
            namespace = namespace.substr(1, namespace.length);
        }

        if (namespace == "") {
            namespace = null;
        }

        return {
            namespace: namespace,
            classname: rawClassname
        };
    }

    public static getFQNFromClassname(classname: string, tree: FileNode)
    {
        var nameFound = false;
        var type = classname;

        if (classname.startsWith("\\")) {
            // Assume FQN already
            nameFound = true;
        } else {
            // Check if we are "use"ing this class
            for (var i = 0, l = tree.namespaceUsings.length; i < l; i++) {
                var item = tree.namespaceUsings[i];

                if (
                    item.name.endsWith("\\" + classname)
                    || item.alias == classname
                ) {
                    // Class found, add namespace to name (handling alias)
                    type = item.name;
                    nameFound = true;
                    break;
                }
            }

            if (!nameFound && tree.namespaces.length > 0) {
                type = "\\" + tree.namespaces[0].name + "\\" + classname;
            }
        }

        return type;
    }
}
