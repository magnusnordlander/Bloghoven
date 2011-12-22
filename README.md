Bloghoven
=========

A blogging system, aiming to compete with Wordpress in usability, but with the code quality of a Symfony2 app.

Bloghoven abstracts the model to a collection of interfaces so that a plethora of providers are available.

Current providers:

  * Blosxom Dir provider (won't have native comments though)

Planned providers: 

  * Doctrine 2 ORM (default provider, fully featured)
  * Wordpress (might make this read-only)
  * Union provider (takes multiple providers and coalesce them into a single provider, with a designated write provider)

## Ideas?

* SonataMediaBundle for... well, media.
* Storing content as Markdown, and handling WYSIWYG editing via HTML->Purifier->Markdown.

## Uncracked chestnuts

* It would be neat to be able to select a post template depending on type (image, video, et.c.). How could this be best handled?