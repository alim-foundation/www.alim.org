<?php
// $Id: vud.theme.inc,v 1.1.2.26 2010/03/12 08:10:25 marvil07 Exp $

/**
 * @file
 * Theme functions
 */

/**
 * Implementation of hook_ctools_plugin_*.
 *
 * Give information to CTools about the widgets plugin.
 */
function vud_ctools_plugin_widgets() {
  return array(
    'cache' => FALSE,
    'defaults' => 'vud_width_plugin_defaults',
    // Themes can offer this plugin.
    'load themes' => TRUE,
  );
}

/**
 * Provide defaults for widgets.
 */
function vud_width_plugin_defaults($info, &$plugin) {
  $defaults = array(
    'render function' => 'theme_render_template',
    'extension' => '.tpl.php',
    'css' => $plugin['name'] . '.css',
  );

  $plugin += $defaults;
}

/**
 * Load metadata for a single widget without loading all widgets.
 */
function vud_widget_get($name) {
  ctools_include('plugins');
  return ctools_get_plugins('vud', 'widgets', $name);
}

/**
 * Load metadata for all widgets
 */
function vud_widget_get_all() {
  ctools_include('plugins');
  return ctools_get_plugins('vud', 'widgets');
}

/**
 * Load the names of all widgets for use in a select.
 *
 * This can be given directly to #options when choosing a widget.
 */
function vud_widget_get_names() {
  $names = array();
  foreach (vud_widget_get_all() as $name => $plugin) {
    $names[$name] = $plugin['title'];
  }

  asort($names);
  return $names;
}

/**
 * Proxy widget function that hook_theme() calls.
 */
function vud_widget_proxy($cid, $type, $tag, $widget_theme, $readonly=NULL) {
  $plugin = vud_widget_get($widget_theme);
  if (empty($plugin) || empty($plugin['widget template'])) {
    return;
  }

  $template_file = $plugin['path'] . '/' . $plugin['widget template'] . $plugin['extension'];
  $variables = array(
    'cid' => $cid,
    'type' => $type,
    'widget_theme' => $widget_theme,
    'plugin' => $plugin,
    'tag' => $tag ? $tag : variable_get('vud_tag', 'vote'),
    'id' => 'widget-' . $type . '-' . $cid,
    'link_class_up' => 'ctools-use-ajax vud-link-up',
    'link_class_down' => 'ctools-use-ajax vud-link-down',
  );

  global $user;
  $uid = votingapi_current_user_identifier();

  ctools_add_js('ajax-responder');
  drupal_add_js(drupal_get_path('module', 'vud') . '/vud.js');
  vud_add_files('css', $plugin);  // Search and add the CSS files.
  vud_add_files('js', $plugin);   // Search and add the JS files.

  $base_criteria = array(
    'content_type' => $type,
    'content_id' => $cid,
    'tag' => $variables['tag'],
  );
  $criteria = $base_criteria + $uid;
  $user_vote = votingapi_select_single_vote_value($criteria);

  if ($user_vote > 0) {
    $variables['class_up'] = 'up-active';
    $variables['class_down'] = 'down-inactive';
  }
  else if ($user_vote < 0) {
    $variables['class_up'] = 'up-inactive';
    $variables['class_down'] = 'down-active';
  }
  else {
    $variables['class_up'] = 'up-inactive';
    $variables['class_down'] = 'down-inactive';
  }

  $token_up = drupal_get_token("vote/$type/$cid/1/$tag/$widget_theme");
  $variables['link_up'] = url("vote/$type/$cid/1/$tag/$widget_theme/$token_up");

  $token_down = drupal_get_token("vote/$type/$cid/-1/$tag/$widget_theme");
  $variables['link_down'] = url("vote/$type/$cid/-1/$tag/$widget_theme/$token_down");

  $result_criteria = array(
    'content_type' => $type,
    'content_id' => $cid,
    'value_type' => 'points',
    'tag' => $tag,
    'function' => 'sum'
  );
  
  
  
  
  
  
  $vote_result = (int) votingapi_select_single_result_value($result_criteria);
  $variables['unsigned_points'] = $vote_result;
 $variables['tag'] = $tag;

  $criteria = array(
    'content_type' => $type,
    'content_id' => $cid,
    'value_type' => 'points',
    'tag' => $tag,
    'function' => 'sum'
  );
 $vote_sum = (int)votingapi_select_single_result_value($criteria);

  // Added - get the voute count.
  $criteria['function'] = 'count';
  $vote_count = (int)votingapi_select_single_result_value($criteria);

  // Added - calculate number of up and down votes.
  $variables['down_votes'] = ($vote_count - $vote_sum) / 2;
  $variables['up_votes'] = $vote_count - $variables['down_votes'];

  if ($vote_result > 0) {
    $variables['class'] = 'positive';
    $variables['points'] = '+'. $vote_result;
  }
  else {
    $variables['points'] = $vote_result;
    if ($vote_result < 0) {
      $variables['class'] = 'negative';
    }
    else {
      $variables['class'] = 'neutral';
    }
  }
  $variables['vote_label'] = format_plural($vote_result, 'vote', 'votes');
  $variables['readonly'] = $readonly;
  if ($readonly) {
    $variables['class_up'] .= ' denied';
    $variables['class_down'] .= ' denied';
  }

  $output = $plugin['render function']($template_file, $variables);
  return $output;
}

/**
 * Proxy votes display function, that hook_theme() calls.
 */
function vud_votes_proxy($cid, $type, $tag, $widget_theme) {
  $plugin = vud_widget_get($widget_theme);
  if (empty($plugin) || empty($plugin['votes template'])) {
    return;
  }

  $template_file = $plugin['path'] . '/' . $plugin['votes template'] . $plugin['extension'];
  $variables = array(
    'cid' => $cid,
    'type' => $type,
    'widget_theme' => $widget_theme,
    'plugin' => $plugin,
    'id' => 'votes-' . $type . '-' . $cid,
  );

  $variables['tag'] = $tag;

  $criteria = array(
    'content_type' => $type,
    'content_id' => $cid,
    'value_type' => 'points',
    'tag' => $tag,
    'function' => 'sum'
  );
 $vote_sum = (int)votingapi_select_single_result_value($criteria);

  // Added - get the voute count.
  $criteria['function'] = 'count';
  $vote_count = (int)votingapi_select_single_result_value($criteria);

  // Added - calculate number of up and down votes.
  $variables['down_votes'] = ($vote_count - $vote_sum) / 2;
  $variables['up_votes'] = $vote_count - $variables['down_votes'];

  if ($variables['type'] == 'node') {
    $node = node_load($variables['cid']);
    $variables['node_type'] = node_get_types('name', $node);
  }

  if ($vote_result > 0) {
    $variables['class'] = 'positive';
    $variables['points'] = '+'. $vote_result;
  }
  else {
    $variables['points'] = $vote_result;
    if ($vote_result < 0) {
      $variables['class'] = 'negative';
    }
    else {
      $variables['class'] = 'neutral';
    }
  }
  $variables['label'] = format_plural($vote_result, 'point', 'points');
  $variables['points_labelled'] = format_plural($vote_result, '1 point', '@count points');
  if (isset($variables['style'])) {
    $variables['template_files'][] = 'vote_up_down_points_'. $variables['style'];
  }

  vud_add_files('css', $plugin);  // Search and add the CSS files.
  vud_add_files('js', $plugin);   // Search and add the JS files.

  if (file_exists($template_file)) {
    return $plugin['render function']($template_file, $variables);
  }
}

/**
 * Read and load all CSS or JS files in the selected widget directory.
 */
function vud_add_files($type, $plugin) {
  $function = 'drupal_add_' . $type;
  if (empty($plugin[$type])) {
    return;
  }

  if (is_string($plugin[$type])) {
    $css = array($plugin[$type]);
  }

  if (is_array($plugin[$type])) {
    $css = $plugin[$type];
  }

  if (!empty($css)) {
    foreach ($css as $file) {
      $function($plugin['path'] . '/' . $file);
    }
  }
}

/**
 * Function for the main voting handler with Ajax support.
 */
function vud_vote($type, $cid, $value, $tag, $widget, $token) {
  if (is_numeric($value) && drupal_valid_token($token, "vote/$type/$cid/$value/$tag/$widget")) {
    $vote = array();
    // Sanity-check the incoming values.
    if ($value > 0) {
      $vote['value'] = 1;
    }
    else if ($value < 0) {
      $vote['value'] = -1;
    }
    else {
      $vote['value'] = 0;
    }

    $vote['value_type'] = 'points';
    $tag = $tag ? $tag : variable_get('vud_tag', 'vote');
    $vote['tag'] = $tag;

    $vote['content_id'] = $cid;
    $vote['content_type'] = $type;
    $vote['tag'] = $tag;
    $votes = array(0 => $vote);
    drupal_alter('vud_votes', $votes);
    votingapi_set_votes($votes);
  }
  else {
    watchdog("vud", "Could not vote on $type $cid, with value $value, tag $tag and token $token");
    drupal_set_message(t("Oops! There was an error in submitting your vote!"), 'warning');
  }

  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    ctools_include('ajax');
    $plugin = vud_widget_get($widget);

    if ($function = ctools_plugin_get_function($plugin, 'ajax render')) {
      $commands = $function($type, $cid, $value, $tag, $token, $widget);
    }
    else {
      $commands = array();
      if (!empty($plugin['widget template'])) {
        $commands[] = ctools_ajax_command_replace("#widget-$type-$cid", theme('vud_widget', $cid, $type, $tag, $widget));
      }

      if (!empty($plugin['votes template'])) {
        $commands[] = ctools_ajax_command_replace("#votes-$type-$cid", theme('vud_votes', $cid, $type, $tag, $widget));
      }
    }

    // This is the default set of commands. It can be overridden by an individual
    // widget if it wants to.
    ctools_ajax_render($commands);
  }
  else {
    drupal_goto($_SERVER['HTTP_REFERER']);
  }
}
