Bloghoven
=========

A blogging system, aiming to compete with Wordpress in usability, but with the code quality of a Symfony2 app.

## Ideas?

* SonataMediaBundle for... well, media.
* Storing content as Markdown, and handling WYSIWYG editing via HTML->Purifier->Markdown.

## Uncracked chestnuts

* It would be neat to be able to select a post template depending on type (image, video, et.c.). How could this be best handled?
* Is it perhaps a good idea to abstract entry providers? It would be neat to be able to support both a database backend (or why not a NoSQL?), and a blosxom-like file based backend. We could even support fetching entries from a Wordpress database.