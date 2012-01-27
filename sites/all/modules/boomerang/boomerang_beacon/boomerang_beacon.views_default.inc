<?php

/**
 * @file
 */

/**
 * Implementation of hook_views_default_views().
 */
function boomerang_beacon_views_default_views() {
  $views = array();

  // Exported view begins below.

  $view = new view;
  $view->name = 'boomerangs';
  $view->description = 'boomerang';
  $view->tag = '';
  $view->view_php = '';
  $view->base_table = 'boomerang_beacon';
  $view->is_cacheable = FALSE;
  $view->api_version = 2;
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  $handler = $view->new_display('default', 'boomerangs', 'default');
  $handler->override_option('fields', array(
    'bid' => array(
      'label' => 'bid',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => FALSE,
      'precision' => 0,
      'decimal' => '.',
      'separator' => ',',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'bid',
      'table' => 'boomerang_beacon',
      'field' => 'bid',
      'relationship' => 'none',
      'override' => array(
        'button' => 'Override',
      ),
    ),
    't_done' => array(
      'id' => 't_done',
      'table' => 'boomerang_beacon',
      'field' => 't_done',
      'label' => 't_done',
      'exclude' => 0,
      'relationship' => 'none',
    ),
	't_resp' => array(
      'id' => 't_resp',
      'table' => 'boomerang_beacon',
      'field' => 't_resp',
      'label' => 't_resp',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    't_other' => array(
      'id' => 't_other',
      'table' => 'boomerang_beacon',
      'field' => 't_other',
      'label' => 't_other',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    't_page' => array(
      'id' => 't_page',
      'table' => 'boomerang_beacon',
      'field' => 't_page',
      'label' => 't_page',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'u' => array(
      'id' => 'u',
      'table' => 'boomerang_beacon',
      'field' => 'u',
      'label' => 'u',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'r' => array(
      'id' => 'r',
      'table' => 'boomerang_beacon',
      'field' => 'r',
      'label' => 'r',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'r2' => array(
      'id' => 'r2',
      'table' => 'boomerang_beacon',
      'field' => 'r2',
      'label' => 'r2',
      'exclude' => 0,
      'relationship' => 'none',
    ),
	'ipaddress' => array(
      'id' => 'ipaddress',
      'table' => 'boomerang_beacon',
      'field' => 'ipaddress',
      'label' => 'ipaddress',
      'exclude' => 0,
      'relationship' => 'none',
    ),
	'country' => array(
      'id' => 'country',
      'table' => 'boomerang_beacon',
      'field' => 'country',
      'label' => 'country',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'bw' => array(
      'label' => 'bw',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => FALSE,
      'precision' => 0,
      'decimal' => '.',
      'separator' => '',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'bw',
      'table' => 'boomerang_beacon',
      'field' => 'bw',
      'relationship' => 'none',
      'override' => array(
        'button' => 'Override',
      ),
    ),
    'bw_err' => array(
      'label' => 'bw_err',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => 1,
      'precision' => '2',
      'decimal' => '.',
      'separator' => '',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'bw_err',
      'table' => 'boomerang_beacon',
      'field' => 'bw_err',
      'relationship' => 'none',
      'override' => array(
        'button' => 'Override',
      ),
    ),
    'lat' => array(
      'id' => 'lat',
      'table' => 'boomerang_beacon',
      'field' => 'lat',
      'label' => 'lat',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'lat_err' => array(
      'label' => 'lat_err',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => 1,
      'precision' => '2',
      'decimal' => '.',
      'separator' => '',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'lat_err',
      'table' => 'boomerang_beacon',
      'field' => 'lat_err',
      'relationship' => 'none',
      'override' => array(
        'button' => 'Override',
      ),
    ),
    'bw_time' => array(
      'label' => 'bw_time',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => FALSE,
      'precision' => 0,
      'decimal' => '.',
      'separator' => '',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'bw_time',
      'table' => 'boomerang_beacon',
      'field' => 'bw_time',
      'relationship' => 'none',
      'override' => array(
        'button' => 'Override',
      ),
    ),
    'page_id' => array(
      'id' => 'page_id',
      'table' => 'boomerang_beacon',
      'field' => 'page_id',
      'label' => 'page_id',
      'exclude' => 0,
      'relationship' => 'none',
    ),
    'v' => array(
      'label' => 'v',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'link_class' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'set_precision' => FALSE,
      'precision' => 0,
      'decimal' => '.',
      'separator' => ',',
      'prefix' => '',
      'suffix' => '',
      'exclude' => 0,
      'id' => 'v',
      'table' => 'boomerang_beacon',
      'field' => 'v',
      'override' => array(
        'button' => 'Override',
      ),
      'relationship' => 'none',
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'perm',
    'perm' => 'access beacon data',
  ));
  $handler->override_option('cache', array(
    'type' => 'none',
  ));
  $handler->override_option('title', 'Boomerangs');
  $handler->override_option('header_format', '1');
  $handler->override_option('header_empty', 0);
  $handler->override_option('empty', 'There are no rows in this table.');
  $handler->override_option('empty_format', '1');
  $handler->override_option('items_per_page', 25);
  $handler->override_option('use_pager', '1');
  $handler->override_option('style_plugin', 'table');
  $handler->override_option('style_options', array(
    'grouping' => '',
    'override' => 1,
    'sticky' => 1,
    'order' => 'desc',
    'columns' => array(
      'bid' => 'bid',
      't_done' => 't_done',
      't_other' => 't_other',
      't_page' => 't_page',
      'u' => 'u',
      'r' => 'r',
      'r2' => 'r2',
      'bw' => 'bw',
      'bw_err' => 'bw_err',
      'lat' => 'lat',
      'lat_err' => 'lat_err',
      'bw_time' => 'bw_time',
      'page_id' => 'page_id',
      'v' => 'v',
    ),
    'info' => array(
      'bid' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      't_done' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      't_other' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      't_page' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'u' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'r' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'r2' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'bw' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'bw_err' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'lat' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'lat_err' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'bw_time' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'page_id' => array(
        'sortable' => 1,
        'separator' => '',
      ),
      'v' => array(
        'sortable' => 1,
        'separator' => '',
      ),
    ),
    'default' => 'bid',
  ));
  $handler = $view->new_display('page', 'Page', 'page_1');
  $handler->override_option('path', 'boomerangs');
  $handler->override_option('menu', array(
    'type' => 'none',
    'title' => '',
    'description' => '',
    'weight' => 0,
    'name' => 'navigation',
  ));
  $handler->override_option('tab_options', array(
    'type' => 'none',
    'title' => '',
    'description' => '',
    'weight' => 0,
    'name' => 'navigation',
  ));

  // Exported view ends above.

  $views[$view->name] = $view;
  return $views;

}

