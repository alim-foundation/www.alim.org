// $Id: README.txt,v 1.4 2009/09/13 22:04:54 jonahellison Exp $

===========================================
Authenticated User Page Caching (Authcache)
===========================================

The Authcache module offers page caching for both anonymous users and logged-in
authenticated users. This allows Drupal/PHP to spend only 1-2 milliseconds
serving pages and greatly reduces server resources.

Please visit:

  http://drupal.org/project/authcache

For information, updates, configuration help, and support.

============
Installation
============

1. Setup a Drupal cache handler module (optional, but strongly recommended)

   Download a cache handler module, such as:

   -- Cache Router @ http://drupal.org/project/cacherouter (supports APC, eAcc, XCache, and Memcache), or
   -- Memcache API @ http://drupal.org/project/memcache

  Open your settings.php file and configure the cache handler module.

  Here are some examples:

  ------------
  CACHE ROUTER
  ------------
  $conf['cacherouter'] = array(
    'default' => array(
      'engine' => 'apc',               // apc, memcache, db, file, eacc or xcache
      'server' => array(),             // memcached (host:port, e..g, 'localhost:11211')
      'shared' => TRUE,                // memcached shared single process
      'prefix' => '',                  // cache key prefix (for multiple sites)
      'path' => 'files/filecache',     // file engine cache location
      'static' => FALSE,               // static array cache (advanced)
    ),
  );

  ---------------
  MEMCACHE MODULE
  ---------------
  $conf['memcache_servers']  = array('localhost:11211' => 'default');


2. In settings.php, make sure $conf['cache_inc'] loads Authcache:

  $conf['cache_inc'] = './sites/all/modules/authcache/authcache.inc';

  Authcache will automatically try to include the cache handler module. If you
  are using a cache module other than Cache Router or Memcache, or if the module
  is in a different parent directory than Authcache, define the the cache include
  path using:

  $conf['cache_inc_via_authcache'] = './sites/path/to/module/cacheinclude.inc';

  If no cache handler is setup or defined, Authcache will fallback to Drupal core
  database cache tables and "Authcache Debug" will say "cache_inc: database"
  
  If you are experimenting with multiple caching systems (db, apc, memcache),
  make sure to clear the cache each time you switch to remove stale data.

3. Enabled the module and configure the Authcache settings
   (Site Configuration -> Performance -> Authcache).

4. Modify your theme by tweaking user-customized elements (the final HTML
   must be the same for each user role). Template files (e.g., page.tpl.php)
   will have several new variables:

    $user_name to display the logged-in user name
    $user_link to display the name linked to their profile (both work for
      cached and non-cached pages).
    $is_page_authcache is set to TRUE in all template hooks if the page
      is to be cached.

===================
UPGRADING FROM BETA
===================

If you are upgrading from a beta version (if you have been using Authcache before
2009-09-13), please delete the "authcache" module directory and then extract the new release.

"ajax_authcache.php" also no longer needs to be in Drupal root directory.  Make sure to follow
the new configuration settings above (like downloading the latest Cache Router and using
the correct $conf values in settings.php).

=================
CACHE FLUSH NOTES
=================

Page cache is cleared when cron.php is executed.  This is normal Drupal core behavior.

========================
Authcache Example Module
========================

Please see ./modules/authcache_example for a demonstration on how to cache
blocks of user-customized content.

======
Author
======

Developed & maintained by Jonah Ellison.

Demo: http://authcache.httpremix.com

Email: jonah [at] httpremix.com
Drupal: http://drupal.org/user/217669

================
Credits / Thanks
================

- "Cache Router" module (Steve Rude) for the caching system/API
- "Boost" module (Arto Bendiken) for some minor code & techniques