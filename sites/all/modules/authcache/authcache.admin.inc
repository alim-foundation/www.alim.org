<?php
// $Id: authcache.admin.inc,v 1.4 2009/09/12 16:41:00 jonahellison Exp $

/**
 * @file
 * Admin pages
 */

/**
 * Main Authcache configuration form
 */
function authcache_admin_config() {
  drupal_set_title(t('Authcache Configuration'));

  $form['roles'] = array(
    '#type' => 'fieldset',
    '#title' => t('Authcache Roles'),
    '#collapsible'   => TRUE,
  );
  $form['roles']['authcache_roles'] = array(
    '#title' => t('Enable caching for specified user roles'),
    '#description' => t('If no roles are selected, Authcache page caching will not be enabled.  Unchecked roles and the admin account (uid #1) will never be cached.'),
    '#type' => 'checkboxes',
    '#options' => _authcache_get_roles(TRUE),
    '#default_value' => variable_get('authcache_roles', array()),
  );
  
  $form['clear_sessions'] = array(
    '#title' => t('Invalidate all user sessions'),
    '#type'  => 'checkbox',
    '#description' => t('This is required when you first enable the Authcache module & anonymous caching, otherwise logged-in users may receive pages intended for anonymous visitors. All users will need to relogin after this.'),
  );
 
  $form['debug'] = array(
    '#type' => 'fieldset',
    '#title' => t('Authcache Debugging/Development'),
    '#description' => t('Debug mode will display the page\'s cache statistics, benchmarks, and Ajax calls.'),
    '#collapsible'   => TRUE,
    '#collapsed'     => TRUE,
  );
  $form['debug']['debug_all'] = array(
    '#title' => t('Enable debug mode for all roles.'),
    '#type' => 'checkbox',
    '#default_value' => variable_get('authcache_debug_all',0),
  );
  $form['debug']['debug_page'] = array(
    '#title' => t('Enable for session if %authcache_link is visited.', array('%authcache_link'=>url('authcache_debug',array('absolute'=>TRUE)))),
    '#type' => 'checkbox',
    '#default_value' => variable_get('authcache_debug_page',0),
  );
  $form['debug']['debug_users'] = array(
    '#title' => t('Enable for specified users'),
    '#type' => 'textfield',
    '#description' => t('Enter a comma-delimited list of usernames to enable debug mode for. Users will need to relogin to enable debug mode.'),
    '#autocomplete_path' => 'user/autocomplete',
    '#default_value' => implode(', ', variable_get('authcache_debug_users',array())),
  );
  $form['debug']['dev_query'] = array(
    '#title' => t('Benchmark database queries'),
    '#type' => 'checkbox',
    '#description' => t('This will display the number of queries used, query time, and the percentage related to the page\'s total render time.'),
    '#default_value' => variable_get('dev_query',0),
  );


  
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save & clear cached pages'),
  );

  //
  // Status messages
  //

  if(substr(variable_get('cache_inc',false), -13) != 'authcache.inc') {
    drupal_set_message(t('Your settings.php file must be modified to enable Authcache ($conf[\'cache_inc\']). See <a href="@url">README.txt</a>.', array('@url' => base_path().drupal_get_path('module', 'authcache').'/README.txt')), 'error');
  }
  
  if(!variable_get('page_compression', TRUE)) {
    drupal_set_message(t('Note: Page compression is not enabled!  It is strongly recommend that you <a href="./../performance">turn this setting on</a> through Drupal to lower your cache memory and allow for faster page response times.'),'warning');
  }
  
  return $form;
}


/**
 * Authcache config form submit
 */
function authcache_admin_config_validate($form, &$form_state) {

}

/**
 * Authcache config form submit
 */
function authcache_admin_config_submit($form, &$form_state) {
  global $user;

  $debug_user_ray = $cache_roles = array();

  // Roles
  $roles = $form_state['values']['authcache_roles'];
  foreach($roles as $rid => $is_checked) {
    if($is_checked) $cache_roles[$rid] = $rid;
  }
  
  // Debugging for users
  $debug_users = explode(',',$form_state['values']['debug_users']);
  foreach($debug_users as $username) {
    $debug_user_ray[] = trim($username);
  }
  
  // Define/update page caching settings if needed
  $pagecaching = variable_get('authcache_pagecaching', FALSE);

  // Not defined, first config submit
  if(!$pagecaching) {
    variable_set('authcache_pagecaching',array(array(
      'option' => 0,
      'pages' => AUTHCACHE_NOCACHE_DEFAULT,
      'roles' => $cache_roles)
      ));
  }
  // User may have added new role; apply new roles to first page ruleset, just to be safe
  else if($cache_roles != variable_get('authcache_roles', $cache_roles)) {
    $pagecaching[0]['roles'] = $cache_roles;
    variable_set('authcache_pagecaching', $pagecaching);
  }
  
  // Clear sessions, except current user
  if($form_state['values']['clear_sessions']) {
    db_query("DELETE FROM {sessions} WHERE sid != '%s'", session_id());
    // Set cookie for current user
    authcache_user('login', $edit = null, $user);
    drupal_set_message(t('!num user sessions have been invalidated.', array('!num' => db_affected_rows())));
  }

  // Forcibly disable Drupal's built-in SQL caching (no need to cache page twice for anonymous users!)
  if(in_array(DRUPAL_ANONYMOUS_RID, $cache_roles) && variable_get('cache', CACHE_DISABLED) != CACHE_DISABLED) {
    variable_set('cache', CACHE_DISABLED);
    drupal_set_message(t('Drupal\'s built-in page caching for anonymous users has been disabled to avoid redundant caching.'));
  }

  // Devel query logging
  variable_set('dev_query',$form_state['values']['dev_query']);
  
  variable_set('authcache_debug_all', $form_state['values']['debug_all']);
  variable_set('authcache_debug_page', $form_state['values']['debug_page']);
  variable_set('authcache_debug_users', $debug_user_ray);
  variable_set('authcache_roles', $cache_roles);

  drupal_set_message(t('Your Authcache settings have been saved.'));

  cache_clear_all('*', 'cache_page', TRUE);
  drupal_set_message(t('Cached pages cleared.'));
}


/**
 * Add new page caching rule to form (part of AHAH)
 */
function _authcache_pagecache_form($details) {
  $form['#tree'] = TRUE;
  $delta = $details['delta'];

  $roles = user_roles();
  $roles[DRUPAL_AUTHENTICATED_RID] .= t(' (without additional roles)');
  
  // Cacheability settings
  $options = array(t('Cache every page except the listed pages.'), t('Cache only the listed pages.'));
  $description = t("To delete this ruleset, leave the textbox empty.") . ' ' . t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are '%blog' for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>'));
  if (user_access('use PHP for block visibility')) {
    $options[] = t('Cache pages for which the following PHP code returns <code>TRUE</code> (PHP-mode, experts only).');
    $description .= t('If the PHP-mode is chosen, enter PHP code between %php. Note that executing incorrect PHP-code can severely break your Drupal site.', array('%php' => '<?php ?>'));
  }
  $form['fieldset'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Caching Ruleset') . '#' . ($delta + 1),
    '#collapsible'   => TRUE,
  );
  $form['fieldset']['option'] = array(
    '#type'          => 'radios',
    '#title'         => t('Cache specified pages'),
    '#options'       => $options,
    '#default_value' => $details['option'],
  );

  $form['fieldset']['pages'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Pages'),
    '#description'   => $description,
    '#default_value' => $details['pages'],
  );
  $form['fieldset']['roles'] = array(
    '#title' => 'Apply to these roles',
    '#type' => 'checkboxes',
    '#options' => _authcache_get_roles(),
    '#default_value' => (is_array($details['roles'])) ? $details['roles'] : array(),
  );

  return $form;

}

/**
 * Page caching rules form
 */
function authcache_admin_pagecaching($form_state, $ahah_form = array()) {
  drupal_set_title(t('Authcache Page Caching Settings'));
  drupal_add_css(drupal_get_path('module', 'authcache') .'/css/authcache.css', 'module');
  
  if(!count(variable_get('authcache_roles', array()))) {
    drupal_set_message(t('You must first select roles to cache before defining page caching setting.'), 'error');
    return $form;
  }
  
  $form['#cache'] = TRUE;
  
  // The contents of ahah_form will either come from the db or from $form_state
  if (isset($form_state['ahah_form'])) {
    $ahah_form = $form_state['ahah_form'] + (array)$ahah_form;
  }
  
  // Default values
  if(empty($ahah_form)) {
    $ahah_form['ahah_form'] = variable_get('authcache_pagecaching', array(array()));
  }

  $form['ahah_wrapper'] = array(
    '#tree' => FALSE,
    '#prefix' => '<div class="clear-block" id="ahah-wrapper">',
    '#suffix' => '</div>',
  );
  
  $form['ahah_wrapper']['ahah']['#tree'] = TRUE;

  
  foreach ($ahah_form['ahah_form'] as $delta => $details) {
    $details = (isset($details['fieldset'])) ? $details['fieldset'] : $details; // fieldset inserted from AHAH postback
    $details['delta'] = $delta;

    $form['ahah_wrapper']['ahah'][$delta] = _authcache_pagecache_form($details);
  }
  
  // AHAH-enabled "Add" button
  $form['authcache_add_cache'] = array(
    '#type' => 'submit',
    '#value' => t('Add new ruleset').'...',
    '#description' => t("If the above ruleset isn't, click here to add more choices."),
    '#submit' => array('authcache_ahah_add'),
    '#ahah' => array(
      'path' => 'authcache/ahah',
      'wrapper' => 'ahah-wrapper',
      'method' => 'replace',
      'effect' => 'fade',
    ),
    '#attributes' => array('class' => 'authcache-add'),
  );
  
  $form['nonhtmlfs'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#title' => t('Non-HTML Cached Pages'),
    '#description' => t('JavaScript is appended at the end of pages to support Ajax callbacks and page manipulation ("var authcacheFooter"). You may not want this for some content, such as dynamically generated JavaScript. Enter pages below that you wish to cache but do not want JavaScript appended to.'),
    '#prefix' => '<br><hr size="1"><br>', 
  );
  $form['nonhtmlfs']['nonhtml'] = array(
    '#type' => 'textarea',
    '#description' => t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are '%blog' for the blog page and %blog-wildcard for every personal blog. %front is the front page. Content that begins with <code>&lt;?xml</code> (i.e., XML feeds) will not be cached. ", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
    '#default_value' => variable_get('authcache_nonhtml', AUTHCACHE_NONHTML_DEFAULT),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save & clear cached pages'),
    '#prefix' => '<br><hr size="1"><br>',
  );

  return $form;
}

/**
 * Page caching rules form submit
 */
function authcache_admin_pagecaching_submit($form, &$form_state) {

  // Ignore AHAH events
  if ($form_state['clicked_button']['#id'] == 'edit-submit') {
    $pagecaching = array();
    foreach($form_state['values']['ahah'] as $key => $ray) {
      $values = $ray['fieldset'];
      if($values['pages']) {
        $pagecaching[$key] = $values;
      }
      
      if(!array_sum($values['roles'])) {
        drupal_set_message(t('Ruleset #!key is disabled since no roles are associated with it.', array('!key' => ($key + 1))), 'warning');
      }
      
    }
    if(!empty($pagecaching)) {
      variable_set('authcache_pagecaching', $pagecaching);
    } else {
      variable_set('authcache_pagecaching',array(array('option'=>0,'pages'=>AUTHCACHE_NOCACHE_DEFAULT,'roles'=>$cache_roles)));
    }
    
    drupal_set_message(t('Your page caching settings have been saved.'));
    cache_clear_all();
    drupal_set_message(t('Cached pages cleared.'));

  }


}

/**
 * Advanced Rulesets
 * @todo
 */
function authcache_admin_advanced() {
  drupal_set_title(t('Authcache Advanced Rulesets'));
  $form = array();
  
  if(!count(variable_get('authcache_roles', array()))) {
    drupal_set_message(t('You must first select roles to cache before setting up advanced caching.'), 'error');
    return $form;
  }
  
  $form['#prefix'] = 'test';
  return $form;
}

/**
 * @todo View all cached pages?
 */
function authcache_admin_lookup() {
  
}


/**
 * Generic AHAH menu callback (['#ahah']['path'])
 */
function authcache_ahah() {
  $form_state = array('storage' => NULL, 'submitted' => FALSE);
  $form_build_id = $_POST['form_build_id'];
  $form = form_get_cache($form_build_id, $form_state);
  $args = $form['#parameters'];
  $form_id = array_shift($args);
  $form['#post'] = $form_state['post'] = $_POST;
  $form['#redirect'] = $form['#programmed'] = FALSE;
  drupal_process_form($form_id, $form, $form_state);
  $form = drupal_rebuild_form($form_id, $form_state, $args, $form_build_id);
  $ahah_form = $form['ahah_wrapper']['ahah'];
  unset($ahah_form['#prefix'], $ahah_form['#suffix']); // Prevent duplicate wrappers.
  drupal_json(array(
    'status'   => TRUE,
    'data'     => theme('status_messages') . drupal_render($ahah_form),
  ));
}

/**
 * Generic AHAH add
 */
function authcache_ahah_add($form, &$form_state) {
  if(isset($form_state['values']['ahah'])) {
    $ahah_form['ahah_form'] = $form_state['values']['ahah'];
  }

  $ahah_form['ahah_form'][] = array();

  unset($form_state['submit_handlers']);
  form_execute_handlers('submit', $form, $form_state);
  $form_state['ahah_form'] = $ahah_form;
  $form_state['rebuild'] = TRUE;
}

/**
 * Helper function, get authcache user roles
 * @param $all_roles = return all user roles
 * @return array of user roles
 */
function _authcache_get_roles($all_roles = FALSE) {
  $roles = user_roles();
  $roles[DRUPAL_AUTHENTICATED_RID] .= t(' (without additional roles)');
  if($all_roles) {
    return $roles;
  }
  else {
    $authcache_roles = array();
    foreach(variable_get('authcache_roles', array()) as $key) {
      $authcache_roles[$key] = $roles[$key];
    }
    return $authcache_roles;
  }
}