// $Id: README.txt,v 1.2 2009/07/13 02:55:01 jonahellison Exp $

=======================
Authcache Example Block
=======================

This module demonstrates how to create a block of user-customized content
and serve it on cached pages.

============
Installation
============

To configure, visit Site Configuration -> Blocks.

============
How it Works
============

The block itself simply grabs some user-entered text from the database.

"authcache_example.js" demonstrates how we interact with the Authcache module.

By passing the "max_age" key to Authcache's Ajax, the browser will be told to
cache the response for "max_age" seconds.  When the user updates their block,
we need to invalidate this cache, so a cookie called "authcache_example" keeps
track of the last time the block was updated (when it changes, the GET request
will change as well, giving us fresh content).

================
Development Tips
================

If you need to invalidate a block when an external update takes place
(e.g., the user does not update their block, but rather someone sends them a
private message and a "New Message" needs to appear), then a separate table
will need to be created that contains the last update timestamp.  You can use
hook_authcache_ajax() to add a value to ping the Ajax phase, then in
ajax_authcache_custom.php, add the function (named with the same value from
the hook) and query the table and update your cookie timestamp with its value
if needed. (Of course, using the caching engine instead of a database may be 
faster.)

======
Author
======

This is part of the Authcache module, developed & maintained by Jonah Ellison.

For updates, support, and documnetation, please visit:

  http://drupal.org/project/authcache

May your site be fast, your pages lean, and users happy.