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

You can also set `php.suggest.basic` to `false` to disable VS Code's built-in php code completion and avoid duplicate suggestions.

## Demo

![](https://i.imgur.com/a9j3V9u.gif)

---

## What's new in v0.3.4 (latest release)
- Significant performance improvements when requesting suggestions *(up to 7,500% faster)*

## What's new in v0.3.3
- Document symbol provider - view top level symbols in the current file
- Workspace symbol provider - view top level symbols throughout the workspace
- Performance improvements

## What's new in v0.3.2
- **Added go to definition on classes, traits & interfaces**
- Fix several bugs introduced in v0.3.1
  - Namespace insert text should be prefixed with a backslash _(Thanks @TheColorRed for pointing out this mistake!)_
  - Crane no longer adds the fully qualified namespace to a class if the class is in the same namespace
  - Fixed issue where there were no suggestions for properties and methods defined in traits
- Disabled Crane suggestions when typing on a single line comment
- Bug report link now prefills basic information including vscode version, crane version and platform (win/linux/macos)

## What's new in v0.3.1

- **Improved namespace support**
  - Crane will now suggest scope-aware namespace parts in `namespace` and `use` statements
  - Crane will now suggest classes that have been aliased in `use` statements
  - When extending a class, Crane now only suggests classes
  - When implementing an interface, Crane now only suggest interfaces
  - Crane now doesn't suggest anything when declaring the name of a new class, trait or interface
  - Crane will now insert the fully qualified namespace of a class if there is no `use` statement for it
  - Crane now suggests non-namespaced classes after typing `\` (eg. `new \`) when inside a namespace
- Fix several bugs introduced in v0.3.0

## What's new in v0.3.0

- Updated the php-parser library to 2.0.0 stable, which **fixes nearly all crashes and parsing errors**
- Removed the Crane version indicator from the bottom right of the status bar
- Fixed a bug where the indexing statusbar item would be hidden if you disabled the bug report link

---

## Current Features

- Code-completion _(work in progress)_
  - For user created code
  - Optionally for built-in PHP functions and classes (such as PDO)
- **Go to definition** on classes, interfaces and traits
- Peek definition on classes, interfaces and traits
- Document & workspace symbol providers

## Planned Features:

- Find references
- Signature provider to show method parameter suggestions
- Hover provider to show information about symbol under the cursor
- Full go-to/Peek definition on variables, methods, properties, etc
- PhpDoc support (both for reading and writing documentation)

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

## Known Issues

* If you get duplicate suggestions for variables, etc. you can disable VS Code's built-in php code-completion by setting `php.suggest.basic` to `false` in your settings.
* There can be strange behaviour when working with PHP and HTML in the same file.
* If you have a syntax error in a file, you may not get a full list of suggestions for that file.
* Go to definition only works on classes, traits and interfaces

## Links

* [Repository](https://github.com/HvyIndustries/crane)
* [VS Code Marketplace](https://marketplace.visualstudio.com/items?itemName=HvyIndustries.crane)


**[Please report any bugs you find!](https://github.com/HvyIndustries/crane/issues)**


*"HVY", "HVY Industries" and "Hvy Industries" are trading names of JCKD (UK) Ltd*

*Icon by http://icons8.com/*
