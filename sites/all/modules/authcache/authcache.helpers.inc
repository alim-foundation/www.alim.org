<?php
// $Id: authcache.helpers.inc,v 1.5 2009/09/12 16:41:00 jonahellison Exp $

/**
 * @file
 * Helper functions for the Authcache module (no Drupal hooks here). 
 */
 

/**
 * Should the current page be cached?
 */
function _authcache_is_cacheable() {
  global $user, $authcache_debug_info;

  // Do not cache POST, users with JS disabled, admin account,
  // Drupal messages, PHP files (cron.php, update.php, etc),
  // if settings.php $conf['cache_inc'] is incorrect,
  // or caching is disabled for session
  if(
    !empty($_POST)
    || ($user->uid && !isset($_COOKIE['has_js']))
    || $user->uid == 1
    || drupal_set_message() != NULL
    || substr(array_shift(explode('?', basename($_SERVER['REQUEST_URI']))), -4) == '.php'
    || (strpos(variable_get('cache_inc',''), 'authcache') === FALSE)
    || isset($_COOKIE['nocache'])
    ) {
    return FALSE;
  }
  
  // Check if caching is enabled for user's role
  if(!_authcache_is_account_cacheable($user)) {
    return FALSE;
  }
  
  $is_cached = FALSE;

  $alias = drupal_get_path_alias($_GET['q']);
  $path = drupal_get_normal_path($_GET['q']); // Normalize path

  // Now check page caching settings, defined by the site admin
  $pagecaching = variable_get('authcache_pagecaching', array(array('option'=>0,'pages'=>AUTHCACHE_NOCACHE_DEFAULT,'roles'=>array(DRUPAL_ANONYMOUS_RID))));
  foreach($pagecaching as $page_rules) {

    // Do caching page roles apply to current user?
    $keys = array_keys($user->roles);
    
    // Match up authenticated roles correctly in case "authenticated user" is unchecked
    if(in_array(DRUPAL_AUTHENTICATED_RID, $keys) && !in_array(DRUPAL_AUTHENTICATED_RID, $page_rules['roles'])) {
      unset($keys[array_search(DRUPAL_AUTHENTICATED_RID, $keys)]);
    }

    $extra_roles = array_diff($keys, $page_rules['roles']);
    if(empty($extra_roles)) {
      switch($page_rules['option']) {
        case '0': // Cache every page except the listed pages.
        case '1': // Cache only the listed pages.
          $regexp = '/^('. preg_replace(array('/(\r\n?|\n)/', '/\\\\\*/', '/(^|\|)\\\\<front\\\\>($|\|)/'), array('|', '.*', '\1'. preg_quote(variable_get('site_frontpage', 'node'), '/') .'\2'), preg_quote($page_rules['pages'], '/')) .')$/';
          $is_cached = !($page_rules['option'] xor preg_match($regexp, $alias));
          break;
        case '2': // Cache pages for which the following PHP code returns TRUE
          $result = drupal_eval($page_rules['pages']);
          $is_cached = !empty($result);
          break;
        default:
          break;
      }
    }
  }
  
  return $is_cached;
}

/**
 * Should user account receive cached pages?
 */
function _authcache_is_account_cacheable($account = false) {
  if(!$account) {
    global $user;
    $account = $user;
  }

  // Check if caching is enabled for user's role
  $cache_roles = variable_get('authcache_roles', array());

  // Anonymous
  if(!$account->uid && !in_array(DRUPAL_ANONYMOUS_RID, $cache_roles)) {
    return FALSE;
  }
  // Logged-in
  else if($account->uid) {
    unset($cache_roles[DRUPAL_ANONYMOUS_RID]);
    $extra_roles = array_diff(array_keys($account->roles), $cache_roles);

    if(!empty($extra_roles)) {
      return FALSE;
    }
  }
  
  return TRUE;
}


/**
 * Save page to cache
 *
 * Called using PHP's register_shutdown_function().
 * This is better than an ob_start callback since global variables
 * are not deconstructed and the function is executed later.
 */
function _authcache_shutdown_save_page() {
  global $user, $base_root, $is_page_authcache;
  
  // Check if non-html page that should be cached
 
  //$is_html = !($path == 'rss.xml' || preg_match('!/feed$!', $path));
  
  $alias = drupal_get_path_alias($_GET['q']);
  $regexp = '/^('. preg_replace(array('/(\r\n?|\n)/', '/\\\\\*/', '/(^|\|)\\\\<front\\\\>($|\|)/'), array('|', '.*', '\1'. preg_quote(variable_get('site_frontpage', 'node'), '/') .'\2'), preg_quote(variable_get('authcache_nonhtml', AUTHCACHE_NONHTML_DEFAULT), '/')) .')$/';
  $is_cached_nonhtml = (preg_match($regexp, $alias));

  // Only cache HTML and 200 OK status (unless user specifies non-HTML)
  // Note that Druapl feeds don't overwrite content-type headers, so they will be cached
  if (!$is_cached_nonhtml && _authcache_get_content_type() != 'text/html' && _authcache_get_http_status() != 200) {
    return;
  }

  // Don't append to CLI scripts
  if (empty($_SERVER['REQUEST_METHOD'])) {
    return;
  }
  
  // Make sure "Location" redirect isn't used
  foreach(headers_list() as $header) {
    if(strpos($header, "Location:") !== FALSE) {
      return;
    }
  }

  // Final check, in case variable was modified
  if(!$is_page_authcache) {
    global $authcache_debug_info;
    
    if(!$authcache_debug_info) {
      $authcache_debug_info = '$is_page_authcache = false';
    }

    print '<script language="javascript">
    Authcache.info = ' . drupal_to_js(array('Reason' => $authcache_debug_info)) . ';
    </script>';
    return;
  }

  // Don't cache pages with PHP errors (Drupal can't catch fatal errors)
  if (function_exists('error_get_last') && $error = error_get_last()) {
    switch ($error['type']) {
      // Ignore these errors:
      case E_NOTICE: // run-time notices
      case E_USER_NOTICE: // user-generated notice message
      case E_DEPRECATED: // run-time notices
      case E_USER_DEPRECATED: // user-generated notice message
        break;
      default:
        // Let user know there is PHP error and return
        print '<script language="javascript">
        Authcache.info = ' . drupal_to_js(array_merge(array('Reason' => 'PHP Error'), error_get_last())) . ';
        </script>';
        return;
        break;
    }
  }

  // Cache key, constructed from user role and URL
  $key = _authcache_key($user) . $base_root . request_uri();

  // Authcache info JSON
  $authcache_info = array(
    'page_render'         => timer_read('page'),  // Benchmark
    'page_queries'        => '-1',                // Database benchmark, if enabled
    'cache_render'        => '-1',                // Filled by cookie via JS on cache request
    'cache_uid'           => $user->uid,          // Required by JS for HTML updates
    'cache_inc'           => variable_get('authcache_handler', 'unknown'),
    'cache_time'          => time(),              // Required by JS for HTML updates
    //'cache_key' => $key,
  );
  
  // Database benchmarks
  if(variable_get('dev_query',0)) {
    global $queries;

    $time_query = 0;
    foreach($queries as $q) {
      $time_query += $q[1];
    }
    $time_query = round($time_query * 1000, 2); // Convert seconds to milliseconds
    $percent_query = round(($time_query / $authcache_info['page_render']) * 100);
    
    $authcache_info['page_queries'] = count($queries) . " queries @ {$time_query} ms ({$percent_query}%)";
  }
  else {
    unset($authcache_info['page_queries']);
  }

  // JSON to send via Ajax
  // The "q" key is need during Ajax phase
  $authcache_ajax = array(
    'q' => $_GET['q'],
  );
  
  // Invoke hook_authcache_info() operation to allow modules to modify info array
  _authcache_invoke_hook('authcache_info', $authcache_info);

  // Invoke hook_authcache() operation to allow modules to modify ajax array
  _authcache_invoke_hook('authcache_ajax', $authcache_ajax);
  
  // Get buffered HTML
  $buffer = ob_get_contents();
  ob_end_clean();
  
  // Don't cache empty/dead pages
  if(!$buffer) { 
    return;
  }
  
  $path = drupal_get_normal_path($_GET['q']); // normalize path
  
  if(substr($buffer, 0, 5) == '<?xml') {
    $is_cached_nonhtml = TRUE; // don't append JS to XML pages
  }

  // Only place JSON info for HTML pages
  if(!$is_cached_nonhtml) {
    $authcache_footer['info'] = $authcache_info;
    $authcache_footer['ajax'] = $authcache_ajax;
    $authcache_json =
    "\n<!-- Authcache Footer JSON -->\n" .
    "<script language=\"JavaScript\">\nvar authcacheFooter = ".
    drupal_to_js($authcache_footer) .
    ";\n</script>\n";

    // Insert JSON before </body>, otherwise just append
    if(strripos($buffer,'</body>') !== FALSE) {
      $buffer = str_replace('</body>', $authcache_json.'</body>', $buffer);
    } else {
      $buffer .= $authcache_json;
    }

  }
  
  // Dump to browser, then max gzip & save to cache in background
  
  $output = $buffer;

  // Fast compression
  if (@strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== FALSE && variable_get('page_compression', TRUE) && function_exists('gzencode') && zlib_get_coding_type() == FALSE) {
    $output = gzencode($output, 1, FORCE_GZIP);
    header('Content-Encoding: gzip');
  }
  
  // Authcache debugging
  if(isset($_COOKIE['authcache_debug'])) {
    setcookie('cache_render', 'First_Page_Request');
  }

  header("Content-Length: " . strlen($output));
  print $output;
  flush();

  // Check for page compression
  if (variable_get('page_compression', TRUE) && function_exists('gzencode')) {
    // We do not store the data in case the zlib mode is deflate.
    // This should be rarely happening.
    if (zlib_get_coding_type() == 'deflate') {
      $cache = FALSE;
    }
    else if (zlib_get_coding_type() == FALSE) {
      $buffer = gzencode($buffer, 9, FORCE_GZIP);
    }
  }
  
  // Save to cache
  cache_set($key, $buffer, 'cache_page', CACHE_TEMPORARY, drupal_get_headers());
}

/**
 * Helper function: Invoke hook_$hook() in all modules; merge recursively.
 * 
 * Similar to module_invoke_all(), except $var is passed by reference.
 */
function _authcache_invoke_hook($hook, &$var) {
  foreach (module_implements($hook) as $name) {
    $function = "{$name}_{$hook}";
    $result = $function();
    if (isset($result) && is_array($result)) {
      $var = array_merge_recursive($var, $result);
    }
  }
}

/**
 * Returns caching key based on user's role.
 */
function _authcache_key($account) {
  if(!$account->uid) return '';

  $keys = implode('.',array_keys($account->roles));
  return substr(md5($keys . drupal_get_private_key()), 0, 6);
}

/**
 * Determines the MIME content type of the current page response based on
 * the currently set Content-Type HTTP header.
 *
 * This should normally return the string 'text/html' unless another module
 * has overridden the content type.
 */
function _authcache_get_content_type($default = NULL) {
  static $regex = '!^Content-Type:\s*([\w\d\/\-]+)!i';
  return _authcache_get_http_header($regex, $default);
}

/**
 * Determines the HTTP response code that the current page request will be
 * returning by examining the HTTP headers that have been output so far.
 */
function _authcache_get_http_status($default = 200) {
  static $regex = '!^HTTP/1.1\s+(\d+)!';
  return (int)_authcache_get_http_header($regex, $default);
}

function _authcache_get_http_header($regex, $default = NULL) {
  // The last header is the one that counts:
  $headers = preg_grep($regex, explode("\n", drupal_set_header()));
  if (!empty($headers) && preg_match($regex, array_pop($headers), $matches)) {
    return $matches[1]; // found it
  }
  return $default; // no such luck
}

