<?php
// $Id: hidden_comment.pages.inc,v 1.2 2010/05/29 18:40:00 jcisio Exp $

/** @file
 * Extra stuffs for privileged user
 * By jcisio
 */

/**
 * Menu callback; hide a comment.
 *
 * @param $cid
 *   The comment do be hidden.
 */
function hidden_comment_hide($cid = NULL) {
  $comment = db_fetch_object(db_query('SELECT * FROM {comments} WHERE cid = %d', $cid));
  $hc = db_fetch_object(db_query('SELECT * FROM {comments_hide} WHERE cid = %d', $cid));

  $output = '';

  if (is_object($hc)) {
    drupal_set_message(t('Comment already hidden.'));
  }
  else {
    $output = drupal_get_form('hidden_comment_confirm_hide', $comment);
  }

  return $output;
}

/**
 * Form builder; Builds the confirmation form for deleting a single comment.
 */
function hidden_comment_confirm_hide(&$form_state, $comment) {
  $form = array();

  $form['#comment'] = $comment;

  $form['reason'] = array(
    '#type' => 'textfield',
    '#title' => t('Reason'),
    '#default_value' => '',
    '#size' => 50,
    '#maxlength' => 255,
    '#description' => t('Give a reason for this action'),
  );

  return confirm_form(
    $form,
    t('Are you sure you want to hide the comment %title?', array('%title' => $comment->subject)),
    'node/'. $comment->nid,
    t('This action can be reverted by the unhide functionality. Not be scared!'),
    t('Hide'),
    t('Cancel'),
    'hidden_comment_confirm_hide');
}

/**
 * Process comment_confirm_hide form submissions.
 */
function hidden_comment_confirm_hide_submit($form, &$form_state) {
  global $user;
  $comment = $form['#comment'];

  db_query('INSERT INTO {comments_hide} VALUES (%d, %d, %d, %d, \'%s\')', $comment->cid, $comment->nid, time(), $user->uid, $form_state['values']['reason']);

  $form_state['redirect'] = "node/$comment->nid";
}

/**
 * Menu callback; hide a comment.
 *
 * @param $cid
 *   The comment do be unhidden.
 */
function hidden_comment_unhide($cid = NULL) {
  $comment = db_fetch_object(db_query('SELECT * FROM {comments} WHERE cid = %d', $cid));
  $hc = db_fetch_object(db_query('SELECT * FROM {comments_hide} WHERE cid = %d', $cid));

  $output = '';

  if (is_object($hc)) {
    $output = drupal_get_form('hidden_comment_confirm_unhide', $comment);
  }
  else {
    drupal_set_message(t('Comment is not hidden.'));
  }

  return $output;
}

/**
 * Form builder; Builds the confirmation form for unhideing a single comment.
 */
function hidden_comment_confirm_unhide(&$form_state, $comment) {
  $form = array();
  $form['#comment'] = $comment;
  return confirm_form(
    $form,
    t('Are you sure you want to unhide the comment %title?', array('%title' => $comment->subject)),
    'node/'. $comment->nid,
    t('Don\'t be scare!'),
    t('Unhide'),
    t('Cancel'),
    'hidden_comment_confirm_unhide');
}

/**
 * Process comment_confirm_unhide form submissions.
 */
function hidden_comment_confirm_unhide_submit($form, &$form_state) {
  $comment = $form['#comment'];

  db_query('DELETE FROM {comments_hide} WHERE cid=%d', $comment->cid);

  $form_state['redirect'] = "node/$comment->nid";
}
