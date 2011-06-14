<?php
// $Id: bookmarks.admin.inc,v 1.5.2.13 2010/04/18 21:32:34 darthclue Exp $

/**
 * @file
 * Administrative page callbaks for bookmarks module.
 */

/**
 * Menu callback which shows an overview page of all the custom menus and their descriptions.
 */
function bookmarks_overview_page() {
  $content[] = array(
    'title' => t('Default Bookmarks'),
    'href' => 'admin/build/bookmarks-customize/bookmarks-defaults',
    'localized_options' => array(),
    'description' => t('The default bookmarks for all users. This list will be used to pre-populate bookmarks for new users.'),
    'menu_name' => 'bookmarks-default',
  );
  $content[] = array(
    'title' => t('Preset Bookmarks'),
    'href' => 'admin/build/bookmarks-customize/bookmarks-presets',
    'localized_options' => array(),
    'description' => t('The preset bookmarks for all users. This list will be used to provide a list or presets for all users.'),
    'menu_name' => 'bookmarks-presets',
  );

  return theme('admin_block_content', $content);
}

/**
 * Form for editing an entire menu tree at once.
 *
 * Shows for one menu the menu items accessible to the current user and
 * relevant operations.
 */
function bookmarks_overview_form(&$form_state, $menu) {
  global $_menu_admin;
  global $user;
  $sql = "
    SELECT m.load_functions, m.to_arg_functions, m.access_callback, m.access_arguments, m.page_callback, m.page_arguments, m.title, m.title_callback, m.title_arguments, m.type, m.description, ml.*
    FROM {menu_links} ml LEFT JOIN {menu_router} m ON m.path = ml.router_path
    WHERE ml.menu_name = '%s'
    ORDER BY p1 ASC, p2 ASC, p3 ASC, p4 ASC, p5 ASC, p6 ASC, p7 ASC, p8 ASC, p9 ASC";
  if ($menu['menu_name']=='enumresuym') {
    $menu['menu_name']='bookmarks-' . $user->uid;
  }
  $result = db_query($sql, $menu['menu_name']);
  $tree = menu_tree_data($result);
  $node_links = array();
  menu_tree_collect_node_links($tree, $node_links);
  // We indicate that a menu administrator is running the menu access check.
  $_menu_admin = TRUE;
  menu_tree_check_access($tree, $node_links);
  $_menu_admin = FALSE;

  $form = _bookmarks_overview_tree_form($tree, $menu);
  $form['#menu'] =  $menu;

  if (element_children($form) && $_GET['q'] != BOOKMARKS_PRESETS_URL) {
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Save configuration'),
    );
  }
  elseif (!element_children($form)) {
    $form['empty_menu'] = array('#value' => t('There are no bookmarks yet.'));
  }
  return $form;
}

/**
 * Recursive helper function for menu_overview_form().
 */
function _bookmarks_overview_tree_form($tree, $menu) {
  global $user;
  static $form = array('#tree' => TRUE);
  $actionpaths = 'admin/build/bookmarks-customize/';
  if (user_access('administer own bookmarks') && $menu['menu_name']=='bookmarks-' . $user->uid) {
    $actionpaths = 'bookmarks/';
  }
  foreach ($tree as $data) {
    $title = '';
    $item = $data['link'];
    // Don't show callbacks; these have $item['hidden'] < 0.
    if ($item && $item['hidden'] >= 0) {
      $mlid = 'mlid:' . $item['mlid'];
      $form[$mlid]['#item'] = $item;
      $form[$mlid]['#attributes'] = $item['hidden'] ? array('class' => 'menu-disabled') : array('class' => 'menu-enabled');
      if ($item['href']=='folder') {
        $form[$mlid]['title']['#value'] = $item['title'] . ($item['hidden'] ? ' (' . t('disabled') . ')' : '');
      }
      else {
        $form[$mlid]['title']['#value'] = l($item['title'], $item['href'], $item['localized_options']) . ($item['hidden'] ? ' (' . t('disabled') . ')' : '');
      }
      $form[$mlid]['mlid'] = array(
        '#type' => 'hidden',
        '#value' => $item['mlid'],
      );
      $form[$mlid]['plid'] = array(
        '#type' => 'textfield',
        '#default_value' => isset($form_state[$mlid]['plid']) ? $form_state[$mlid]['plid'] : $item['plid'],
        '#size' => 6,
      );
      $form[$mlid]['hidden'] = array(
        '#type' => 'checkbox',
        '#default_value' => !$item['hidden'],
      );
      if ($_GET['q']!=BOOKMARKS_PRESETS_URL) {
        $form[$mlid]['expanded'] = array(
          '#type' => 'checkbox',
          '#default_value' => $item['expanded'],
        );
        if (module_exists('bookmarks_public')) {
          $form[$mlid]['public'] = array(
            '#type' => 'checkbox',
            '#default_value' => $item['options']['attributes']['public'],
          );
        }
        $form[$mlid]['weight'] = array(
          '#type' => 'weight',
          '#delta' => 50,
          '#default_value' => isset($form_state[$mlid]['weight']) ? $form_state[$mlid]['weight'] : $item['weight'],
        );
        // Build a list of operations.
        $operations = array();
        $operations['edit'] = l(t('edit'), $actionpaths . 'item/edit/' . $item['mlid']);
        // Only items created by the bookmarks module can be deleted.
        if ($item['module'] == 'bookmarks' || $item['updated'] == 1) {
          $operations['delete'] = l(t('delete'), $actionpaths . 'item/delete/' . $item['mlid']);
        }
        if ($menu['menu_name'] == 'bookmarks-defaults' || $menu['menu_name'] == 'bookmarks-presets') {
          $operations['distribute'] = l(t('distribute'), 'admin/build/bookmarks/distribute/' . $item['mlid']);
        }

        $form[$mlid]['operations'] = array();
        foreach ($operations as $op => $value) {
          $form[$mlid]['operations'][$op] = array('#value' => $value);
        }
      }
      else {
        // Build a list of operations.
        $operations = array();
        if ($item['href']=='folder') {
          $operations['add'] = l(t('Add Folder'), BOOKMARKS_PRESETS_URL . '/add/' . $item['mlid']);
        }
        else {
          $operations['add'] = l(t('Add'), BOOKMARKS_PRESETS_URL . '/add/' . $item['mlid']);
        }

        $form[$mlid]['operations'] = array();
        foreach ($operations as $op => $value) {
          $form[$mlid]['operations'][$op] = array('#value' => $value);
        }
      }
    }

    if ($data['below']) {
      _bookmarks_overview_tree_form($data['below'], $menu);
    }
  }
  return $form;
}

/**
 * Submit handler for the menu overview form.
 *
 * This function takes great care in saving parent items first, then items
 * underneath them. Saving items in the incorrect order can break the menu tree.
 *
 * @see bookmarks_overview_form()
 */
function bookmarks_overview_form_submit($form, &$form_state) {
  // When dealing with saving menu items, the order in which these items are
  // saved is critical. If a changed child item is saved before its parent,
  // the child item could be saved with an invalid path past its immediate
  // parent. To prevent this, save items in the form in the same order they
  // are sent by $_POST, ensuring parents are saved first, then their children.
  // See http://drupal.org/node/181126#comment-632270
  $order = array_flip(array_keys($form['#post'])); // Get the $_POST order.
  $form = array_merge($order, $form); // Update our original form with the new order.

  $updated_items = array();
  $fields = array('expanded', 'weight', 'plid');
  foreach (element_children($form) as $mlid) {
    if (isset($form[$mlid]['#item'])) {
      $element = $form[$mlid];
      // Update any fields that have changed in this menu item.
      foreach ($fields as $field) {
        if ($element[$field]['#value'] != $element[$field]['#default_value']) {
          $element['#item'][$field] = $element[$field]['#value'];
          $updated_items[$mlid] = $element['#item'];
        }
      }
      if (module_exists('bookmarks_public')) {
        // Public is a special case, the value needs to be inserted into the attributes array
        if ($element['public']['#value'] != $element['public']['#default_value']) {
          $element['#item']['options']['attributes']['public'] = $element['public']['#value'];
          $updated_items[$mlid] = $element['#item'];
        }
      }
      // Hidden is a special case, the value needs to be reversed.
      if ($element['hidden']['#value'] != $element['hidden']['#default_value']) {
        $element['#item']['hidden'] = !$element['hidden']['#value'];
        $updated_items[$mlid] = $element['#item'];
      }
    }
  }

  // Save all our changed items to the database.
  foreach ($updated_items as $item) {
    $item['customized'] = 1;
    menu_link_save($item);
  }
}

/**
 * Theme the menu overview form into a table.
 *
 * @ingroup themeable
 */
function theme_bookmarks_overview_form($form) {
  $output = '';
  if ($_GET['q'] == BOOKMARKS_PRESETS_URL) {
    $header = array(
      t('Menu item'),
      array('data' => t('Operations'), 'colspan' => '3'),
    );
  }
  else {
    drupal_add_tabledrag('bookmarks-overview', 'match', 'parent', 'menu-plid', 'menu-plid', 'menu-mlid', TRUE, MENU_MAX_DEPTH - 1);
    drupal_add_tabledrag('bookmarks-overview', 'order', 'sibling', 'menu-weight');

    if (module_exists('bookmarks_public')) {
      $header = array(
        t('Menu item'),
        array('data' => t('Enabled'), 'class' => 'checkbox'),
        array('data' => t('Expanded'), 'class' => 'checkbox'),
        array('data' => t('Public'), 'class' => 'checkbox'),
        t('Weight'),
        array('data' => t('Operations'), 'colspan' => '3'),
      );
    }
    else {
      $header = array(
        t('Menu item'),
        array('data' => t('Enabled'), 'class' => 'checkbox'),
        array('data' => t('Expanded'), 'class' => 'checkbox'),
        t('Weight'),
        array('data' => t('Operations'), 'colspan' => '3'),
      );
    }
  }

  $rows = array();
  foreach (element_children($form) as $mlid) {
    if (isset($form[$mlid]['hidden'])) {
      $element = &$form[$mlid];
      // Build a list of operations.
      $operations = array();
      foreach (element_children($element['operations']) as $op) {
        $operations[] = drupal_render($element['operations'][$op]);
      }
      while (count($operations) < 2) {
        $operations[] = '';
      }

      // Add special classes to be used for tabledrag.js.
      $element['plid']['#attributes']['class'] = 'menu-plid';
      $element['mlid']['#attributes']['class'] = 'menu-mlid';
      $element['weight']['#attributes']['class'] = 'menu-weight';

      // Change the parent field to a hidden. This allows any value but hides the field.
      $element['plid']['#type'] = 'hidden';
      if ($_GET['q'] == BOOKMARKS_PRESETS_URL) {
        $element['hidden']['#type'] = 'hidden';
      }

      $row = array();
      $row[] = theme('indentation', $element['#item']['depth'] - 1) . drupal_render($element['title']);
      if ($_GET['q'] != BOOKMARKS_PRESETS_URL) {
        $row[] = array('data' => drupal_render($element['hidden']), 'class' => 'checkbox');
        $row[] = array('data' => drupal_render($element['expanded']), 'class' => 'checkbox');
        if (module_exists('bookmarks_public')) {
          $row[] = array('data' => drupal_render($element['public']), 'class' => 'checkbox');
        }
      }
      $row[] = drupal_render($element['weight']) . drupal_render($element['plid']) . drupal_render($element['mlid']);
      $row = array_merge($row, $operations);

      $row = array_merge(array('data' => $row), $element['#attributes']);
      $row['class'] = !empty($row['class']) ? $row['class'] . ' draggable' : 'draggable';
      $rows[] = $row;
    }
  }
  if ($rows) {
    $output .= theme('table', $header, $rows, array('id' => 'bookmarks-overview'));
  }
  $output .= drupal_render($form);

  return $output;
}

/**
 * Menu callback; Build the menu link editing form.
 */
function bookmarks_edit_item(&$form_state, $type, $item, $menu) {
  global $user;

  if ($menu['menu_name'] == 'enumresuym') {
    $menu['menu_name']='bookmarks-' . $user->uid;
  }
  // The item must belong to the current user or the current user must be editting one of the system menus and have the proper rights.
  if (($menu['menu_name'] != $item['menu_name']) && $type == 'edit') {
    if (!((($item['menu_name'] == 'bookmarks-presets') || ($item['menu_name'] == 'bookmarks-defaults')) && user_access('administer bookmarks'))) {
      drupal_set_message(t('You do not have permission to edit that item.'), 'error');
      drupal_goto('bookmarks/mine');
      return;
    }
  }
  $form['bookmarks'] = array(
    '#type' => 'fieldset',
    '#title' => t('Menu settings'),
    '#collapsible' => FALSE,
    '#tree' => TRUE,
    '#weight' => -2,
    '#attributes' => array('class' => 'menu-item-form'),
    '#item' => $item,
  );
  if ($type == 'add' || empty($item)) {
    // This is an add form, initialize the menu link.
    $item = array('link_title' => '', 'mlid' => 0, 'plid' => 0, 'menu_name' => $menu['menu_name'], 'weight' => 0, 'link_path' => '', 'options' => array(), 'module' => 'bookmarks', 'expanded' => 0, 'hidden' => 0, 'has_children' => 0, 'newwindow' => 0);
  }
  if ($type == 'addpage') {
    // This is an add this page form, initialize the menu link.
    $item = array('link_title' => '', 'mlid' => 0, 'plid' => 0, 'menu_name' => $menu['menu_name'], 'weight' => 0, 'link_path' => '', 'options' => array(), 'module' => 'bookmarks', 'expanded' => 0, 'hidden' => 0, 'has_children' => 0, 'newwindow' => 0);
    $item['link_path']=base64_decode(drupal_get_normal_path(drupal_get_path_alias(str_replace('bookmarks/item/addpage/', '', $_GET['q']))));
    $menu_item = menu_get_item($item['link_path']);
    $item['link_title'] = $menu_item['title'];
  }
  foreach (array('link_path', 'mlid', 'module', 'has_children', 'options') as $key) {
    $form['bookmarks'][$key] = array('#type' => 'value', '#value' => $item[$key]);
  }
  // Any item created or edited via this interface is considered "customized".
  $form['bookmarks']['customized'] = array('#type' => 'value', '#value' => 1);
  $form['bookmarks']['original_item'] = array('#type' => 'value', '#value' => $item);

  $path = $item['link_path'];
  if (isset($item['options']['query'])) {
    $path .= '?' . $item['options']['query'];
  }
  if (isset($item['options']['fragment'])) {
    $path .= '#' . $item['options']['fragment'];
  }
  if ($item['module'] == 'bookmarks') {
    $form['bookmarks']['link_path'] = array(
      '#type' => (($_GET['q']!='bookmarks/mine/add' && strpos($_GET['q'], 'bookmarks/item/edit') === FALSE && strpos($_GET['q'], 'admin/build/bookmarks-customize/item/edit') === FALSE && strpos($_GET['q'], 'admin/build/bookmarks-customize/bookmarks-') === FALSE) ? 'hidden' : 'textfield'),
      '#title' => t('Path'),
      '#default_value' => $path,
      '#description' => t('The path this bookmark links to. This can be an internal Drupal path such as %add-node or an external URL such as %drupal. Enter %front to link to the front page. Enter %folder to make this item a folder.', array('%front' => '<front>', '%add-node' => 'node/add', '%drupal' => 'http://drupal.org', '%folder' => '<folder>')),
      '#required' => TRUE,
    );
  }
  else {
    $form['bookmarks']['_path'] = array(
      '#type' => 'item',
      '#title' => t('Path'),
      '#description' => l($item['link_title'], $item['href'], $item['options']),
    );
  }
  $form['bookmarks']['link_title'] = array('#type' => 'textfield',
    '#title' => t('Menu link title'),
    '#default_value' => $item['link_title'],
    '#description' => t('The link text corresponding to this item that should appear in the menu.'),
    '#required' => TRUE,
  );
  $form['bookmarks']['description'] = array(
    '#type' => 'textarea',
    '#title' => t('Description'),
    '#default_value' => isset($item['options']['attributes']['title']) ? $item['options']['attributes']['title'] : '',
    '#rows' => 1,
    '#description' => t('The description displayed when hovering over a bookmark.'),
  );
  $form['bookmarks']['enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enabled'),
    '#default_value' => !$item['hidden'],
    '#description' => t('Bookmarks that are not enabled will not be listed anywhere.'),
  );
  $form['bookmarks']['expanded'] = array(
    '#type' => 'checkbox',
    '#title' => t('Expanded'),
    '#default_value' => $item['expanded'],
    '#description' => t('If selected and this bookmark has children, the bookmark will always appear expanded.'),
  );
  if (module_exists('bookmarks_public')) {
    $form['bookmarks']['public'] = array(
      '#type' => 'checkbox',
      '#title' => t('Public'),
      '#default_value' => isset($item['options']['attributes']['public']) ? $item['options']['attributes']['public'] : FALSE,
      '#description' => t('Bookmarks that are public will be shown as part of the user profile.'),
    );
  }

  // Generate a list of possible parents (not including this item or descendants).
  $options = menu_parent_options(bookmarks_get_menus(FALSE, $menu['menu_name']), $item);
  //drupal_set_message('<pre>'.print_r($options, TRUE).'</pre>');
 // drupal_set_message($menu['menu_name']);
  $default = $item['menu_name'] . ':' . $item['plid'];
  $menu_userid = (str_replace('bookmarks-', '', $item['menu_name']));
  switch ($item['menu_name']) {
    case $user->uid:
      $options[$item['menu_name'] . ':0'] = '<' . $user->name . '>';
      break;
    case 'bookmarks-defaults':
      $options[$item['menu_name'] . ':0'] = '<' . t('Defaults') . '>';
      break;
    case 'bookmarks-presets':
      $options[$item['menu_name'] . ':0'] = '<' . t('Presets') . '>';
      break;
    default:
      $menu_user = user_load($menu_userid);
      $options[$item['menu_name'] . ':0'] = '<' . $menu_user->name . '>';
      break;
  }
  $form['bookmarks']['parent'] = array(
    '#type' => 'select',
    '#title' => t('Parent item'),
    '#default_value' => $default,
    '#options' => $options,
    '#description' => t('The maximum depth for an item and all its children is fixed at !maxdepth. Some bookmarks may not be available as parents if selecting them would exceed this limit.', array('!maxdepth' => MENU_MAX_DEPTH)),
    '#attributes' => array('class' => 'menu-title-select'),
  );
  $form['bookmarks']['weight'] = array(
    '#type' => 'weight',
    '#title' => t('Weight'),
    '#delta' => 50,
    '#default_value' => $item['weight'],
    '#description' => t('Optional. In the list, the heavier items will sink and the lighter items will be positioned nearer the top.'),
  );
  $form['submit'] = array('#type' => 'submit', '#value' => t('Save'));

  return $form;
}

/**
 * Validate form values for a menu link being added or edited.
 */
function bookmarks_edit_item_validate($form, &$form_state) {
  $item = &$form_state['values']['bookmarks'];
  if ($item['link_path']=='<folder>') {
    $item['link_path']='folder';
  }
  else {
    $normal_path = drupal_get_normal_path($item['link_path']);
    if ($item['link_path'] != $normal_path) {
      drupal_set_message(t('The menu system stores system paths only, but will use the URL alias for display. %link_path has been stored as %normal_path', array('%link_path' => $item['link_path'], '%normal_path' => $normal_path)));
      $item['link_path'] = $normal_path;
    }
    if (!menu_path_is_external($item['link_path'])) {
      $parsed_link = parse_url($item['link_path']);
      if (isset($parsed_link['query'])) {
        $item['options']['query'] = $parsed_link['query'];
      }
      if (isset($parsed_link['fragment'])) {
        $item['options']['fragment'] = $parsed_link['fragment'];
      }
      if ($item['link_path'] != $parsed_link['path']) {
        $item['link_path'] = $parsed_link['path'];
      }
    }
    if (!trim($item['link_path']) || !menu_valid_path($item)) {
      form_set_error('link_path', t("The path '@link_path' is either invalid or you do not have access to it.", array('@link_path' => $item['link_path'])));
    }
  }
}

/**
 * Process menu and menu item add/edit form submissions.
 */
function bookmarks_edit_item_submit($form, &$form_state) {
  global $user;
  $item = $form_state['values']['bookmarks'];

  // The value of "hidden" is the opposite of the value
  // supplied by the "enabled" checkbox.
  $item['hidden'] = (int) !$item['enabled'];
  unset($item['enabled']);

  $item['options']['attributes']['title'] = $item['description'];
  if (module_exists('bookmarks_public')) {
    $item['options']['attributes']['public'] = (int) $item['public'];
  }
  list($item['menu_name'], $item['plid']) = explode(':', $item['parent']);
  if (!menu_link_save($item)) {
    drupal_set_message(t('There was an error saving the menu link.'), 'error');
  }
  //If they are editing their menu, they should be doing so with the My Menu link.
  if (user_access('administer own bookmarks') && $item['menu_name']=='bookmarks-' . $user->uid) {
    $form_state['redirect'] = 'bookmarks/mine';
  }
  else {
    $form_state['redirect'] = 'admin/build/bookmarks-customize/' . $item['menu_name'];
  }
}

/**
 * Menu callback; Build the form that handles the adding/editing of a custom menu.
 */
function bookmarks_edit_menu(&$form_state, $type, $menu = array()) {
  if ($type == 'edit') {
    $form['menu_name'] = array('#type' => 'value', '#value' => $menu['menu_name']);
    $form['#insert'] = FALSE;
    $form['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#access' => !in_array($menu['menu_name'], menu_list_system_menus()),
      '#submit' => array('bookmarks_users_delete_submit'),
      '#weight' => 10,
    );
  }
  else {
    $menu = array('menu_name' => '', 'title' => '', 'description' => '');
    $form['menu_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Menu name'),
      '#maxsize' => BOOKMARKS_MENU_MAX_MENU_NAME_LENGTH_UI,
      '#description' => t('The machine-readable name of this menu. This text will be used for constructing the URL of the <em>menu overview</em> page for this menu. This name must contain only lowercase letters, numbers, and hyphens, and must be unique.'),
      '#required' => TRUE,
    );
    $form['#insert'] = TRUE;
  }
  $form['#title'] = $menu['title'];
  $form['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#default_value' => $menu['title'],
    '#required' => TRUE,
  );
  $form['description'] = array(
    '#type' => 'textarea',
    '#title' => t('Description'),
    '#default_value' => $menu['description'],
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  return $form;
}

/**
 * Submit function for the 'Delete' button on the menu editing form.
 */
function bookmarks_users_delete_submit($form, &$form_state) {
  $form_state['redirect'] = 'admin/build/bookmarks-customize/' . $form_state['values']['menu_name'] . '/delete';
}

/**
 * Menu callback; check access and get a confirm form for deletion of a custom menu.
 */
function bookmarks_delete_menu_page($menu) {
  // System-defined menus may not be deleted.
  if (in_array($menu['menu_name'], menu_list_system_menus())) {
    drupal_access_denied();
    return;
  }
  return drupal_get_form('bookmarks_delete_menu_confirm', $menu);
}

/**
 * Build a confirm form for deletion of a custom menu.
 */
function bookmarks_delete_menu_confirm(&$form_state, $menu) {
  $form['#menu'] = $menu;
  $caption = '';
  $num_links = db_result(db_query("SELECT COUNT(*) FROM {menu_links} WHERE menu_name = '%s'", $menu['menu_name']));
  if ($num_links) {
    $caption .= '<p>' . format_plural($num_links, '<strong>Warning:</strong> There is currently 1 bookmark in %title. It will be deleted (system-defined items will be reset).', '<strong>Warning:</strong> There are currently @count bookmarks in %title. They will be deleted (system-defined items will be reset).', array('%title' => $menu['title'])) . '</p>';
  }
  $caption .= '<p>' . t('This action cannot be undone.') . '</p>';
  return confirm_form($form, t('Are you sure you want to delete the custom menu %title?', array('%title' => $menu['title'])), 'admin/build/bookmarks-customize/' . $menu['menu_name'], $caption, t('Delete'));
}

/**
 * Delete a custom menu and all items in it.
 */
function bookmarks_delete_menu_confirm_submit($form, &$form_state) {
  $menu = $form['#menu'];
  $form_state['redirect'] = 'admin/build/bookmarks';
  // System-defined menus may not be deleted - only menus defined by this module.
  if (in_array($menu['menu_name'], menu_list_system_menus())  || !db_result(db_query("SELECT COUNT(*) FROM {menu_bookmarks} WHERE menu_name = '%s'", $menu['menu_name']))) {
    return;
  }
  // Reset all the menu links defined by the system via hook_menu.
  $result = db_query("SELECT * FROM {menu_links} ml INNER JOIN {menu_router} m ON ml.router_path = m.path WHERE ml.menu_name = '%s' AND ml.module = 'system' ORDER BY m.number_parts ASC", $menu['menu_name']);
  while ($item = db_fetch_array($result)) {
    menu_reset_item($item);
  }
  // Delete all links to the overview page for this menu.
  $result = db_query("SELECT mlid FROM {menu_links} ml WHERE ml.link_path = '%s'", 'admin/build/bookmarks-customize/' . $menu['menu_name']);
  while ($m = db_fetch_array($result)) {
    menu_link_delete($m['mlid']);
  }
  // Delete all the links in the menu and the menu from the list of custom menus.
  db_query("DELETE FROM {menu_links} WHERE menu_name = '%s'", $menu['menu_name']);
  db_query("DELETE FROM {menu_bookmarks} WHERE menu_name = '%s'", $menu['menu_name']);
  // Delete all the blocks for this menu.
  db_query("DELETE FROM {blocks} WHERE module = 'bookmarks' AND delta = '%s'", $menu['menu_name']);
  db_query("DELETE FROM {blocks_roles} WHERE module = 'bookmarks' AND delta = '%s'", $menu['menu_name']);
  menu_cache_clear_all();
  cache_clear_all();
  $t_args = array('%title' => $menu['menu_name']);
  drupal_set_message(t('The bookmark list %title has been deleted.', $t_args));
  watchdog('menu', 'Deleted bookmark list %title and all its bookmarks.', $t_args, WATCHDOG_NOTICE);
}

/**
 * Validates the human and machine-readable names when adding or editing a menu.
 */
function bookmarks_edit_menu_validate($form, &$form_state) {
  $item = $form_state['values'];
  if (preg_match('/[^a-z0-9-]/', $item['menu_name'])) {
    form_set_error('menu_name', t('The menu name may only consist of lowercase letters, numbers, and hyphens.'));
  }
  if (drupal_strlen($item['menu_name']) > BOOKMARKS_MENU_MAX_MENU_NAME_LENGTH_UI) {
    form_set_error('menu_name', format_plural(BOOKMARKS_MENU_MAX_MENU_NAME_LENGTH_UI, "The menu name can't be longer than 1 character.", "The menu name can't be longer than @count characters."));
  }
  if ($form['#insert']) {
    // We will add 'bookmarks-' to the menu name to help avoid name-space conflicts.
    $item['menu_name'] = 'bookmarks-' . $item['menu_name'];
    if (db_result(db_query("SELECT menu_name FROM {menu_bookmarks} WHERE menu_name = '%s'", $item['menu_name'])) ||
      db_result(db_query_range("SELECT menu_name FROM {menu_links} WHERE menu_name = '%s'", $item['menu_name'], 0, 1))) {
      form_set_error('menu_name', t('The menu already exists.'));
    }
  }
}

/**
 * Submit function for adding or editing a custom menu.
 */
function bookmarks_edit_menu_submit($form, &$form_state) {
  $menu = $form_state['values'];
  $path = 'admin/build/bookmarks-customize/';
  if ($form['#insert']) {
    // Add 'bookmarks-' to the menu name to help avoid name-space conflicts.
    $menu['menu_name'] = 'bookmarks-' . $menu['menu_name'];
    $link['link_title'] = $menu['title'];
    $link['link_path'] = $path . $menu['menu_name'];
    $link['router_path'] = $path . '%';
    $link['module'] = 'bookmarks';
    $link['plid'] = db_result(db_query("SELECT mlid FROM {menu_links} WHERE link_path = '%s' AND module = '%s'", 'admin/build/bookmarks', 'system'));
    menu_link_save($link);
    db_query("INSERT INTO {menu_bookmarks} (menu_name, title, description) VALUES ('%s', '%s', '%s')", $menu['menu_name'], $menu['title'], $menu['description']);
  }
  else {
    db_query("UPDATE {menu_bookmarks} SET title = '%s', description = '%s' WHERE menu_name = '%s'", $menu['title'], $menu['description'], $menu['menu_name']);
    $result = db_query("SELECT mlid FROM {menu_links} WHERE link_path = '%s'", $path . $menu['menu_name']);
    while ($m = db_fetch_array($result)) {
      $link = menu_link_load($m['mlid']);
      $link['link_title'] = $menu['title'];
      menu_link_save($link);
    }
  }
  $form_state['redirect'] = $path . $menu['menu_name'];
}

/**
 * Menu callback; Check access and present a confirm form for deleting a menu link.
 */
function bookmarks_item_delete_page($item) {
  // Links defined via hook_menu may not be deleted. Updated items are an
  // exception, as they can be broken.
  if ($item['module'] == 'system' && !$item['updated']) {
    drupal_access_denied();
    return;
  }
  return drupal_get_form('bookmarks_item_delete_form', $item);
}

/**
 * Build a confirm form for deletion of a single menu link.
 */
function bookmarks_item_delete_form(&$form_state, $item) {
  global $user;
  $form['#item'] = $item;
  if (($item['menu_name']=='bookmarks-' . $user->uid) && user_access('administer own bookmarks')) {
    return confirm_form($form, t('Are you sure you want to delete the bookmark %item?', array('%item' => $item['link_title'])), 'bookmarks/mine/');
  }
  else {
    return confirm_form($form, t('Are you sure you want to delete the bookmark %item?', array('%item' => $item['link_title'])), 'admin/build/bookmarks-customize/' . $item['menu_name']);
  }
}

/**
 * Process menu delete form submissions.
 */
function bookmarks_item_delete_form_submit($form, &$form_state) {
  global $user;
  $item = $form['#item'];
  menu_link_delete($item['mlid']);
  $t_args = array('%title' => $item['link_title']);
  drupal_set_message(t('The bookmark %title has been deleted.', $t_args));
  watchdog('menu', 'Deleted bookmark %title.', $t_args, WATCHDOG_NOTICE);
  if (($item['menu_name']=='bookmarks-' . $user->uid) && user_access('administer own bookmarks')) {
    $form_state['redirect'] = 'bookmarks/mine/';
  }
  else {
    $form_state['redirect'] = 'admin/build/bookmarks-customize/' . $item['menu_name'];
  }
}

/**
 * Menu callback for distributing defaults and presets to users.
 */
function bookmarks_distribute($item, $plid = array('p1' => 0, 'p2' => 0, 'p3' => 0, 'p4' => 0, 'p5' => 0, 'p6' => 0, 'p7' => 0, 'p8' => 0, 'p9' => 0), $depth = 1) {
  $output = '';
  //Loop thru all users and add the specified menu item to each user menu.
  $result = db_query("SELECT * FROM {menu_bookmarks} WHERE menu_name <> 'bookmarks-defaults' AND menu_name <> 'bookmarks-presets'");
  while ($menu = db_fetch_object($result)) {
    $user = user_load(str_replace('bookmarks-', '', $menu->menu_name));
    _bookmarks_add_preset($item, $plid, $depth, $user);
    menu_cache_clear('bookmarks-' . $user->uid );
  }

  drupal_set_message(t('The bookmark has been distributed to all users.'));
  drupal_goto('admin/build/bookmarks');
  return '';
}

/**
 * Add presets to the current users bookmarks
 */
function bookmarks_add_preset($item, $plid = array('p1' => 0, 'p2' => 0, 'p3' => 0, 'p4' => 0, 'p5' => 0, 'p6' => 0, 'p7' => 0, 'p8' => 0, 'p9' => 0), $depth = 1) {
  global $user;
  _bookmarks_add_preset($item, $plid, $depth, $user);

  menu_cache_clear('bookmarks-' . $user->uid );
  drupal_set_message(t('The preset has been added to your bookmarks.'));
  drupal_goto('bookmarks/mine');
  return '';
}

/**
 * Helper function to add presets to the current users bookmarks.
 */
function _bookmarks_add_preset($item, $plid, $depth, $user) {
  $item = menu_link_load($item['mlid']);

  db_query("INSERT INTO {menu_links} (menu_name, plid, link_path, router_path, link_title, options, module, hidden, external, has_children, expanded, weight, depth, customized, p1, p2, p3, p4, p5, p6, p7, p8, p9, updated) SELECT 'bookmarks-%d', %d, link_path, router_path, link_title, options, 'bookmarks', hidden, external, has_children, expanded, 0, %d, customized, %d, %d, %d, %d, %d, %d, %d, %d, %d, updated FROM {menu_links} WHERE mlid=%d", $user->uid, $plid['p1'], $depth, $plid['p1'], $plid['p2'], $plid['p3'], $plid['p4'], $plid['p5'], $plid['p6'], $plid['p7'], $plid['p8'], $plid['p9'], $item['mlid']);


//There's got to be a better way to do this.

  $plid['p9']=$plid['p8'];
  $plid['p8']=$plid['p7'];
  $plid['p7']=$plid['p6'];
  $plid['p6']=$plid['p5'];
  $plid['p5']=$plid['p4'];
  $plid['p4']=$plid['p3'];
  $plid['p3']=$plid['p2'];
  $plid['p2']=$plid['p1'];
  $plid['p1']=db_last_insert_id('menu_links', 'mlid');

  $pl_tmp = $plid;
  $pl_cnt = 1;

  for ($i=1;$i<10;$i++) {
    if ($plid['p' . $i]==0) {
      $pl_cnt = $i;
      $i = 10;
    }
  }

  $pl_keys = array('p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9');

  $plid = array_combine($pl_keys, array_merge(array_reverse(array_slice($plid, 0, $pl_cnt-1)), array_slice($plid, $pl_cnt-1)));

  db_query("UPDATE {menu_links} SET p1=%d, p2=%d, p3=%d, p4=%d, p5=%d, p6=%d, p7=%d, p8=%d, p9=%d WHERE mlid = %d", $plid['p1'], $plid['p2'], $plid['p3'], $plid['p4'], $plid['p5'], $plid['p6'], $plid['p7'], $plid['p8'], $plid['p9'], $pl_tmp['p1']);

  if ($item['has_children']) {
    $depth++;

    $result = db_query("SELECT mlid FROM {menu_links} WHERE plid=%d", $item['mlid']);
    while ($mnu = db_fetch_object($result)) {
      _bookmarks_add_preset(array('mlid' => $mnu->mlid), $plid, $depth);
    }
  }
  return $plid;
}
