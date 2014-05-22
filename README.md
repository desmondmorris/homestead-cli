## Homestead CLI

A command line tool for managing your homestead environment and projects.

### Commands
* `homestead install` - Installs Homestead from git to ~/.homestead.
* `homestead update` - Updates Homestead installation
* `homestead sites` - Lists sites
* `homestead folders` - Lists shared folders
* `homestead keys` - Lists keys

### Roadmap
* `homestead status` - Returns Homestead VM status (Alias for vagrant status)
* `homestead reload` - Reloads Homestead VM (Alias for vagrant reload)
* `homestead ssh` - SSH into Homestead VM (Alias for vagrant ssh)

* `homestead auth` - Prints authorization key path
* `homestead keys add` - Adds private key
* `homestead keys rm` - Removes private key


* `homestead folders add` - Adds new folder to share within Homestead environment
* `homestead folders rm` - Removes folder from within Homestead environment

* `homestead sites add` - Adds site and associates it to the current directory or directory specified via paramaters
* `homestead sites rm` - Removes site and associates it to the current directory or directory specified via paramaters
