<?php

/**
 * Implementation of hook_views_data().
 */
function lineage_views_data() {
  $tables['term_lineage'] = array(
    'table' => array(
      'group' => 'Taxonomy',
      'join' => array(
        'node' => array(
          'left_table' => 'term_node',
          'left_field' => 'tid',
          'field' => 'tid'
        )
      )
    ),
    'lineage' => array(
      'title' => t("Hierarchy"),
      'field' => array(
        'handler' => 'lineage_handler_field',
        'click sortable' => TRUE,
      ),
      'sort' => array(
        'handler' => 'views_handler_sort'
      )
    ),
    'depth' => array(
      'title' => t("Depth"),
      'field' => array('handler' => 'views_handler_field')
    ),
  );

  return $tables;
}

/**
 * Implementation of hook_views_handlers().
 */
function lineage_views_handlers() {
  return array(
    'handlers' => array(
      'lineage_handler_field' => array(
        'parent' => 'views_handler_field'
      )
    )
  );
}

