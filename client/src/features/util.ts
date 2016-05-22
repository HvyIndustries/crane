"use strict";

// Takes a PHP function signature like:
//     (foo, thisClass bar, otherClass baz)
// and returns an array of parameter strings:
//     ["foo", "thisClass bar", "otherClass baz"]
// Takes care of balancing parens so to not get confused by signatures like:
//     (pattern string, handler func(ResponseWriter, &Request)) {
export function parameters(signature: string): string[] {
    let ret: string[] = [];
    let parenCount = 0;
    let lastStart = 1;
    for (let i = 1; i < signature.length; i++) {
        switch (signature[i]) {
            case '(':
                parenCount++;
                break;
            case ')':
                parenCount--;
                if (parenCount < 0) {
                    if (i > lastStart) {
                        ret.push(signature.substring(lastStart, i));
                    }
                    return ret;
                }
                break;
            case ',':
                if (parenCount === 0) {
                    ret.push(signature.substring(lastStart, i));
                    lastStart = i + 2;
                }
                break;
        }
    }
    return null;
}
