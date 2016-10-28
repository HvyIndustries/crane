# Crane - PHP code-completion for VS Code

Crane is a productivity enhancement extension for [Visual Studio Code](http://code.visualstudio.com) that provides code-completion for PHP. It has zero dependencies and largely works with projects of any size. It is still in development, and as such there may be bugs and/or missing features.

Please report any bugs that you find in our [issue tracker on GitHub](https://github.com/HvyIndustries/crane/issues).

Follow [@HvyIndustries](https://twitter.com/HvyIndustries) on Twitter for updates!

## How To Get Started

1. Install Crane by pressing <kbd>F1</kbd> in VS Code, then typing `ext install crane`
2. Open a PHP project
3. Check the status bar at the bottom and watch Crane parse all the PHP files it finds

- Optionally, install the PHP Stubs to get code-completion for the built in PHP classes by pressing <kbd>F1</kbd> in VS Code, then typing `crane php stubs` and selecting the appropriate option from the list.

For the best development experience, make sure you have the PHP linter enabled in your user settings, and set it to run `onType` instead of `onSave`!

---

## What's new in v0.2.2 (latest release)

- Added new setting `crane.ignoredPaths` that gives users the ability to ignore files/folders for parsing _(workaround for parser crashing issue)_
- Added "what's new" section to readme to highlight new features/bug fixes

---

## Current Features

- Code-completion _(in progress, not quite 100% complete yet)_
  - For user created code
  - Optionally for built-in PHP functions and classes (such as PDO)

## Planned Features:

* **Go to definition** (pressing F12)
* **Find references**
* Signature provider to show method parameter suggestions
* Hover provider to show information about symbol under the cursor
* Peek definition
* List symbols
* PhpDoc support (both for reading and writing documentation)

## User Feedback

> **Another total must have for PHP developers using Visual Studio Code.**  
> Jan Hajek

> **Essential extension for every PHP developer, just install :)**  
> Marcelo Rodrigo

> **Essential to every PHP developer, recommended!**  
> Gabriel Coronado

> That's the tweet I've been waiting for since the first public release of VS Code. Thanks.  
> [Bruno Baketaric](https://twitter.com/laphblog/status/719631906598449152)

> omg omg omg omg omg  
> [Rich Perez](https://twitter.com/imperez/status/719645661461921793)

> 👌👌👌 super awesome.  
> [яєαℓιѕт נανѕтαн](https://twitter.com/RHJOfficial/status/719630044310740992)

## Demo

![](http://i.imgur.com/7128zNV.png)
![](http://i.imgur.com/CT2S3yX.gif)

## Known Issues

* There may be duplicate suggestions for functions or variables. This is because VS Code has it's own (very limited) code-completion support for PHP, and there is currently no way to turn this off.
* There can be strange behaviour when working with PHP and HTML in the same file.
* If you have a syntax error in a file, you may not get a full list of suggestions for that file.

## Links

* [Repository](https://github.com/HvyIndustries/crane)
* [VS Code Marketplace](https://marketplace.visualstudio.com/items?itemName=HvyIndustries.crane)


**[Please report any bugs you find!](https://github.com/HvyIndustries/crane/issues)**


*"HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd*

*Icon by http://icons8.com/*
