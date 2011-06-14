<?php
// $Id: term_lock.admin.inc,v 1.1.2.3.2.1 2010/04/08 15:22:58 pounard Exp $

/**
 * @file
 * Taxonomy term lock administration pages alterations
 */

/**
 * Override theme('taxonomy_overview_terms'). This is quite ugly, but we had no
 * other choice.
 * 
 * @see taxonomy_overview_terms()
 * @see term_lock_form_alter()
 */
function theme_term_lock_overview_terms($form) {
  $page_increment  = $form['#page_increment'];
  $page_entries    = $form['#page_entries'];
  $back_peddle     = $form['#back_peddle'];
  $forward_peddle  = $form['#forward_peddle'];

  // Add drag and drop if parent fields are present in the form.
  if ($form['#parent_fields']) {
    drupal_add_tabledrag('taxonomy', 'match', 'parent', 'term-parent', 'term-parent', 'term-id', FALSE);
    drupal_add_tabledrag('taxonomy', 'depth', 'group', 'term-depth', NULL, NULL, FALSE);
    drupal_add_js(drupal_get_path('module', 'taxonomy') .'/taxonomy.js');
    drupal_add_js(array('taxonomy' => array('backPeddle' => $back_peddle, 'forwardPeddle' => $forward_peddle)), 'setting');
    drupal_add_css(drupal_get_path('module', 'taxonomy') .'/taxonomy.css');
    drupal_add_css(drupal_get_path('module', 'term_lock') .'/term_lock.css');
  }

  $errors = form_get_errors() != FALSE ? form_get_errors() : array();
  $rows = array();
  foreach (element_children($form) as $key) {
    if (isset($form[$key]['#term'])) {
      $term = &$form[$key];

      $row = array();
      $row[] = (isset($term['#term']['depth']) && $term['#term']['depth'] > 0 ? theme('indentation', $term['#term']['depth']) : '') . drupal_render($term['view']);
      if ($form['#parent_fields']) {
        $term['tid']['#attributes']['class'] = 'term-id';
        $term['parent']['#attributes']['class'] = 'term-parent';
        $term['depth']['#attributes']['class'] = 'term-depth';
        $row[0] .= drupal_render($term['parent']) . drupal_render($term['tid']) . drupal_render($term['depth']);
      }
      $row[] = drupal_render($term['edit']);

      $row = array('data' => $row);
      $rows[$key] = $row;
    }
  }

  global $user;
  $access = user_access('administer taxonomy');

  // Add necessary classes to rows.
  $row_position = 0;
  foreach ($rows as $key => &$row) {

    $_key = explode(':', $key);
    $_tid = $_key[1];

    $_flags = array();

    $classes = array();
    if (isset($form['#parent_fields'])) {
      if (term_lock_is_locked($_tid)) {
        if ($access) {
          $classes[] = 'draggable';
        }
        else {
          // Add indentation block to our row to simulate the handle decal
          $row['data'][0] = '<div class="false-indentation"> </div>' . $row['data'][0];
        }
        $_flags[] = theme('term_lock_locked');
      }
      else {
        $classes[] = 'draggable';
      }
      if (term_lock_is_childlocked($_tid)) {
        if (! $access) {
          $classes[] = 'tabledrag-leaf';
        }
        $_flags[] = theme('term_lock_childlocked');
      }
      if (term_lock_is_nodelocked($_tid)) {
        $_flags[] = theme('term_lock_nodelocked');
      }
    }

    // Add our metatada and checkboxes
    $rows[$key]['data'][0] .= '<b>' . implode(' ', $_flags) . '</b>';
    if ($access) {
      $drag_cell = array_shift($rows[$key]['data']);
      array_unshift($rows[$key]['data'], drupal_render($form['term_lock_checkboxes'][$_tid]));
      array_unshift($rows[$key]['data'], $drag_cell);
    }

    // Add classes that mark which terms belong to previous and next pages.
    if ($row_position < $back_peddle || $row_position >= $page_entries - $forward_peddle) {
      $classes[] = 'taxonomy-term-preview';
    }

    if ($row_position !== 0 && $row_position !== count($rows) - 1) {
      if ($row_position == $back_peddle - 1 || $row_position == $page_entries - $forward_peddle - 1) {
        $classes[] = 'taxonomy-term-divider-top';
      }
      elseif ($row_position == $back_peddle || $row_position == $page_entries - $forward_peddle) {
        $classes[] = 'taxonomy-term-divider-bottom';
      }
    }

    // Add an error class if this row contains a form error.
    foreach ($errors as $error_key => $error) {
      if (strpos($error_key, $key) === 0) {
        $classes[] = 'error';
      }
    }
    $rows[$key]['class'] = implode(' ', $classes);
    $row_position++;
  }

  if (empty($rows)) {
    $rows[] = array(array('data' => $form['#empty_text'], 'colspan' => '2'));
  }

  if ($access) {
    $header = array(t('Name'), t('Lock'), t('Operations'));
  }
  else {
    $header = array(t('Name'), t('Operations'));
  }
  $output = '<div class="container-inline">' . drupal_render($form['term_lock']) . '</div>';
  $output .= theme('table', $header, $rows, array('id' => 'taxonomy'));
  $output .= drupal_render($form);
  $output .= theme('pager', NULL, $page_increment);

  return $output;
}