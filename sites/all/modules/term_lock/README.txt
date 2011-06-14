$Id: README.txt,v 1.1.2.2 2009/11/29 12:41:31 pounard Exp $

term_lock module
================

This module allow site administrator to lock taxonomy terms. Each term won't be
editable anymore by any role else that a specific one.

It also provide new permissions that will allow any role to edit vocabularies,
on a per-vocabulary basis.


Notes and caveats
=================

Hook usage and compat
---------------------

New 6.x-2.x version uses the hook_menu_alter() instead of hook_taxonomy(). This
should avoid some incompatibilities, since we don't try control consistency at
API anymore, but we only provide UI alteration.
 
Any other code that modify taxonomy, in a global way, can override term locking,
this is a UI locking for end user.

So, you shoud find a lot of module incompatibilities, the only way to know is to
test it.

