<?php
// $Id$

/**
 * @file
 * Includes the cache handler (e.g., CacheRouter, Memcache API, Drupal core),
 * retrieves cached paged via page_cache_fastpath(),
 * and executes Ajax phase if XML/JS request detected
 * 
 * @var $conf['authcache_handler'] = display during debug mode
 * @see DRUPAL_BOOTSTRAP_EARLY_PAGE_CACHE in boostrap.inc
 */

$conf += array(
  // Force Drupal to execute page_cache_fastpath() function [see below] to serve cached pages.
  'page_cache_fastpath' => TRUE, 
  // May need to connect to db during page_cache_fastpath()
  'authcache_is_db' => FALSE, 
);

// Include third-party cache handler if path defined
if(isset($conf['cache_inc_via_authcache'])) {
  require_once $conf['cache_inc_via_authcache']; // Make sure to remove page_cache_fastpath() in include
  $conf['authcache_handler'] = basename($conf['cache_inc_via_authcache']); 
} 
// If cache handler path not defined, try to detect cache include based on $conf settings
// Assumes cache module is located is same parent directory as Authcache
else {

  $cache_includes = array( // $conf key => module path
    // http://drupal.org/project/memcache
    'memcache_servers' => 'memcache/memcache.inc', // Can't use memcache.db.inc since page_cache_fastpath() skips the database connection

    // http://drupal.org/project/cacherouter
    'cacherouter'     => 'cacherouter/cacherouter.inc',
    
    // http://drupal.org/project/cache
    'cache_settings'   => 'cache/cache.inc', 
  );
  
  foreach($cache_includes as $key => $inc) {
    if(isset($conf[$key])) {
      require_once dirname(__FILE__) . "/../$inc";
      // Save handler name for debugging
      $conf['authcache_handler'] = basename($inc);
      if($conf['authcache_handler'] == 'cacherouter.inc') {
        $conf['authcache_handler'] .= ' (' . $conf['cacherouter']['default']['engine'] . ')';
      }
      break;
    }
  }  
}

// Could not load cache handler -- fallback to Drupal core (database cache tables)
if(!function_exists('cache_get')) {
  require_once './includes/cache.inc';
  $conf['authcache_is_db'] = TRUE;
  $conf['authcache_handler'] = 'database';
}
// Check if alternate db cache is used
else {
  if (isset($conf['cacherouter']) && $conf['cacherouter']['default']['engine'] == 'db') {
    $conf['authcache_is_db'] = TRUE;
  }
}


// Check if in Ajax phase and return JSON.
// This is a custom HTTP header defined by the authcache.js XML request
if(isset($_SERVER['HTTP_AUTHCACHE'])) {
  require_once dirname(__FILE__) . "/ajax/authcache.php";
  exit;
}


/**
 * Main callback from DRUPAL_BOOTSTRAP_EARLY_PAGE_CACHE phase.
 * Sends cached page to browser, if found.
 * @return boolean for bootstrap (if TRUE, PHP will exit)
 */
function page_cache_fastpath() {
  global $base_root, $cache, $conf;

  // User is logged in but their role should not receive any cached pages
  // (i.e., cached anonymous pages, since they have no authcache key)
  if(isset($_COOKIE['drupal_user']) && !isset($_COOKIE['authcache'])) {
    return FALSE;
  }
  
  // Caching for browser session was temporarily disabled (most likely from drupal_set_message()/drupal_goto() redirect)
  if(isset($_COOKIE['nocache_temp'])) {
    setcookie('nocache', '', time() - 36000, ini_get('session.cookie_path'), ini_get('session.cookie_domain'), ini_get('session.cookie_secure') == '1');
    setcookie('nocache_temp', '', time() - 36000, ini_get('session.cookie_path'), ini_get('session.cookie_domain'), ini_get('session.cookie_secure') == '1');
    return FALSE;
  }
  
  // Attempt to retrieve page from cache
  if (empty($_POST)) {
  
    // Connect to database if 'db' engine selected
    if($conf['authcache_is_db']) {
      require_once './includes/database.inc';
      db_set_active();
    }
   
    // Authenticated cache role(s) key
    $key = (isset($_COOKIE['authcache']) && $_COOKIE['authcache']) ? $_COOKIE['authcache'] : '';
    $cache_key = $key . $base_root . request_uri();
    $page = cache_get($cache_key, 'cache_page');

    // Cached page found
    if (!empty($page)) {

      // Set HTTP headers in preparation for a cached page response.

      // The following headers force validation of cache:
      header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
      header("Cache-Control: must-revalidate");

      // Visitors can keep a local cache of the page, but must revalidate
      // it on every request.  Then, they are given a '304 Not Modified'
      // response with no body as long as they say page has not been modified.
      $last_modified = gmdate('D, d M Y H:i:s', $page->created) .' GMT';

      // See if the client has provided the required HTTP caching header
      // ETag used instead of Last-Modifed header, since browsers won't update
      // cookie if Last-Modifed is used? - http://us.php.net/manual/en/function.setcookie.php#90616
      $etag = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : FALSE;

      if ($etag == $page->created) {

        // Save cache benchmark
        if(isset($_COOKIE['authcache_debug'])) {
          setcookie('cache_render', timer_read('page'));
        }

        header('HTTP/1.1 304 Not Modified');
        return TRUE;
      }

      // Time from when page was saved to cache
      header("ETag: $page->created");

      // Send the original request headers.
      $headers = explode("\n", $page->headers);
      foreach ($headers as $header) {
        header($header);
      }

      // Checking if first chars are compressed (always the same pattern for every header)
      if (substr($page->data, 0,3) == "\x1f\x8b\x08") {

        // Determine if the browser accepts gzipped data.
        if (@strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') === FALSE && function_exists('gzencode')) {
          // Strip the gzip header and run uncompress.
          $page->data = gzinflate(substr(substr($page->data, 10), 0, -8));
        }
        elseif (function_exists('gzencode')) {
          // Send gzip header to the browser
          header('Content-Encoding: gzip');
        }
      }

      // Save cache benchmark
      if(isset($_COOKIE['authcache_debug'])) {
        setcookie('cache_render',timer_read('page'));
      }

      print $page->data;
      return TRUE;
    }
  }

  return FALSE;
}