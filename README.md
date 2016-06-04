# README

![Icon](images/icon.png)

*Icon by http://icons8.com/*

## Crane - PHP Intellisense/code-completion for VS Code

Please go to https://github.com/HvyIndustries/crane for source code, bug tracking and feature requests.

Follow [@HvyIndustries](https://twitter.com/HvyIndustries) on Twitter for updates!

## Functionality

This extension provides semi-intelligent Intellisense and code-completion suggestions for VS Code.

For the best development experience, make sure you have the PHP linter enabled in your user settings, and set it to run `onType` instead of `onSave`!

## User Feedback

> **Another total must have for PHP developers using Visual Studio Code.**
> Jan Hajek

> That's the tweet I've been waiting for since the first public release of VS Code. Thanks.
> [Bruno Baketaric](https://twitter.com/laphblog/status/719631906598449152)

> omg omg omg omg omg
> [Rich Perez](https://twitter.com/imperez/status/719645661461921793)

> 👌👌👌 super awesome.
> [яєαℓιѕт נανѕтαн](https://twitter.com/RHJOfficial/status/719630044310740992)

## Demo

![](http://i.imgur.com/7128zNV.png)
![](http://i.imgur.com/CT2S3yX.gif)

## Customization

### Downloading PHP Libraries

To download additional php libraries, press `F1` and search for `Crane - Download PHP Libraries`
Once the libraries have been downloaded, you will need to rebuild the sources if sources have already been built.

### Rebuilding Sources

To rebuild sources, press `F1` and search for `Crane - Rebuild Sources`. This will instruct
Crane to rebuild the file sources. This can be useful if your sources somehow get out of sync.
This is also useful if new typings are added.

## Upcoming features

* **Go to definition** (pressing F12)
* **Find references**
* Signature provider to show method parameter suggestions
* Hover provider to show information about symbol under the cursor
* Peek definition
* List symbols
* PhpDoc support (both for reading and writing documentation)

## Known Issues

* The extension has some issues with showing suggestions for very large projects
* There are currently no suggestions for built-in classes such as `PDO` (support for this is coming soon)
* There can be strange behaviour when working with PHP and HTML in the same file

### More Info

* [Repository](https://github.com/HvyIndustries/crane)
* [VS Code Marketplace](https://marketplace.visualstudio.com/items?itemName=HvyIndustries.crane)


**[Please report any bugs you find!](https://github.com/HvyIndustries/crane/issues)**


*"HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd*
