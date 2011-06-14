<?php
// $Id: tw.views.inc,v 1.1.2.16 2009/06/17 15:19:51 mikeryan Exp $

/**
 * @file
 * Views hooks
 */

require_once drupal_get_path('module', 'tw') . '/tw_tablebuild.inc';

/**
 * Implementation of hook_views_data().
 *
 * Utilizes shared table building functions to generate the full views data
 * array.
 */
function tw_views_data() {
  $tables = _tw_generate_views_table_data();
  return _tw_generate_views_relationship_data($tables);
}
