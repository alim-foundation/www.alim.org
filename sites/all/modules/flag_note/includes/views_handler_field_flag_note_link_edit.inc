<?php
// $Id: views_handler_field_flag_note_link_edit.inc,v 1.1.2.3 2009/11/18 00:28:00 gunzip Exp $
/**
 * @file
 *
 * Field handler to present a link to modify a note.
 */
class views_handler_field_flag_note_link_edit extends views_handler_field {
  function construct() {
    parent::construct();
    $this->additional_fields['fnid'] = 'fnid';
    $this->additional_fields['uid'] = 'uid';
  }
  function query() {
    $this->ensure_my_table();
    $this->add_additional_fields();
  }
  function option_definition() {
    $options = parent::option_definition();
    $options['text'] = array('default' => 'edit', 'translatable' => TRUE);
    return $options;
  }
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['text'] = array(
      '#type' => 'textfield',
      '#title' => t('Text to display'),
      '#default_value' => $this->options['text'],
    );
  }
  function render($values) {
    $fnid = $values->{$this->aliases['fnid']};
    $uid  = $values->{$this->aliases['uid']};
    if (flag_note_has_access('edit', $fnid, $uid)) {
      return l($this->options['text'], "flagnote/$fnid/edit", array('query' => drupal_get_destination(),
          'attributes' => array('class' => 'flag-note-edit')));
    }
  }
}
