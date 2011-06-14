<?php
// $Id: flag_note.views.inc,v 1.1.2.5 2009/11/19 00:10:35 gunzip Exp $

/**
 * @file
 *
 * Provides Flag note data to Views.
 */

/**
 * Implementation of hook_views_handlers().
 */
 
function flag_note_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'flag_note') .'/includes',
    ),
    'handlers' => array(
      'views_handler_field_flag_note_link_delete' => array(
        'parent' => 'views_handler_field',
      ),
      'views_handler_field_flag_note_link_edit' => array(
        'parent' => 'views_handler_field',
      ),
    )
  );
}

/**
 * Implementation of hook_views_data().
 */
function flag_note_views_data() {
  $data = array();
  $groupname = t('Flag note');
  $data['flag_note']['table']['group'] = $groupname;

// DO NOT UNCOMMENT - FLAG NOTES __MUST__ BE PROVIDED THROUGH RELATIONSHIPS ONLY !!!
//
//  $data['flag_note']['table']['base'] = array(
//    'field' => 'fnid',
//    'title' => t('Flag note'),
//    'help' => t("Notes associated with flags."),
//  );
//  $data['flag_note']['table']['join'] = array(
//    'flag_content' => array(
//      'left_field' => 'fcid',
//      'field' => 'fcid',
//    ),
//    'node' => array(
//      'left_field' => 'nid',
//      'field' => 'content_id',
//    ),
//    'users' => array(
//      'left_field' => 'uid',
//      'field' => 'content_id',
//    ),
//    'comments' => array(
//      'left_field' => 'cid',
//      'field' => 'content_id',
//    ),
//  );

  // field (text)
  $data['flag_note']['note'] = array(
    'title' => t('Note text'),
    'help' => t('Display the text of the flag note.'),
    'field' => array(
      'handler' => 'views_handler_field',
      'click sortable' => TRUE,
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
  );

  // field (delete note)
  $data['flag_note']['delete_note'] = array(
    'field' => array(
      'title' => t('Delete flag note'),
      'help' => t('Provide a link to delete the note.'),
      'handler' => 'views_handler_field_flag_note_link_delete',
    ),
  );

  // field (edit note)
  $data['flag_note']['edit_note'] = array(
    'field' => array(
      'title' => t('Edit flag note'),
      'help' => t('Provide a link to edit the note.'),
      'handler' => 'views_handler_field_flag_note_link_edit',
    ),
  );

  // field (timestamp)
  $data['flag_note']['timestamp'] = array(
    'title' => t('Note created time'),
    'help' => t('Display the time the note was written.'),
    'field' => array(
      'handler' => 'views_handler_field_date',
      'click sortable' => TRUE,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort_date',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_date',
    ),
  );

  // relationship (flag_content)
  $data['flag_note']['flag_note_content_rel'] = array(
    'group' => $groupname,
    'title' => t('Hide flag note history.'),
    'help' => t('Filter out old notes if content has been unflagged (check: require this relationship).'),
    'relationship' => array(
      'label' => t('flag_note_conent'),
      'base' => 'flag_content',
      'base field' => 'fcid',
      'relationship field' => 'fcid',
    ),
  );

  // relationship (author)
  $data['flag_note']['flag_note_author_rel'] = array(
    'group' => $groupname,
    'title' => t('Note author'),
    'help' => t('Relate a note to its author.'),
    'relationship' => array(
      'label' => t('flag_note_author'),
      'base' => 'users',
      'base field' => 'uid',
      'relationship field' => 'uid',
    ),
  );

  // relationship (notes on nodes)
  $data['node']['flag_note_node_rel'] = array(
    'group' => $groupname,
    'title' => t('Notes on node'),
    'help' => t('All notes associated with a flagged node.'),
    'relationship' => array(
      'label' => t('Flag note on node'),
      'base' => 'flag_note',
      'base field' => 'content_id',
      'relationship field' => 'nid',
      'handler' => 'flag_handler_relationship_content',
      'flag_type' => 'node',
    ),
  );

  // relationship (notes on users)
  $data['users']['flag_note_user_rel'] = array(
    'group' => $groupname,
    'title' => t('Notes on user'),
    'help' => t('All notes associated with a flagged user.'),
    'relationship' => array(
      'label' => t('Flag note on user'),
      'base' => 'flag_note',
      'base field' => 'content_id',
      'relationship field' => 'uid',
      'handler' => 'flag_handler_relationship_content',
      'flag_type' => 'user',
    ),
  );

  // relationship (notes on comments)
  $data['comments']['flag_note_comments_rel'] = array(
    'group' => $groupname,
    'title' => t('Notes on comment'),
    'help' => t('All notes associated with a flagged comment.'),
    'relationship' => array(
      'label' => t('Flag note on comment'),
      'base' => 'flag_note',
      'base field' => 'content_id',
      'relationship field' => 'cid',
      'handler' => 'flag_handler_relationship_content',
      'flag_type' => 'comment',
    ),
  );

  return $data;
}
