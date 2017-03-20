# v0.3.4 (latest release)
- Significant performance improvements when requesting suggestions *(up to 7,500% faster)*

# v0.3.3
- Document symbol provider - view top level symbols in the current file
- Workspace symbol provider - view top level symbols throughout the workspace
- Performance improvements

# v0.3.2
- **Added go to definition on classes, traits & interfaces**
- Fix several bugs introduced in v0.3.1
  - Namespace insert text should be prefixed with a backslash _(Thanks @TheColorRed for pointing out this mistake!)_
  - Crane no longer adds the fully qualified namespace to a class if the class is in the same namespace
  - Fixed issue where there were no suggestions for properties and methods defined in traits
- Disabled Crane suggestions when typing on a single line comment
- Bug report link now prefills basic information including vscode version, crane version and platform (win/linux/macos)

# v0.3.1
- **Improved namespace support**
  - Crane will now suggest scope-aware namespace parts in `namespace` and `use` statements
  - Crane will now suggest classes that have been aliased in `use` statements
  - When extending a class, Crane now only suggests classes
  - When implementing an interface, Crane now only suggest interfaces
  - Crane now doesn't suggest anything when declaring the name of a new class, trait or interface
  - Crane will now insert the fully qualified namespace of a class if there is no `use` statement for it
  - Crane now suggests non-namespaced classes after typing `\` (eg. `new \`) when inside a namespace
- Fix several bugs introduced in v0.3.0

# v0.3.0
- Updated the php-parser library to 2.0.0 stable, which **fixes nearly all crashes and parsing errors**
- Removed the Crane version indicator from the bottom right of the status bar
- Fixed a bug where the indexing statusbar item would be hidden if you disabled the bug report link

# v0.2.2
- Added new setting `crane.ignoredPaths` that gives users the ability to ignore files/folders for parsing _(workaround for parser crashing issue)_
- Added "what's new" section to readme to highlight new features/bug fixes
