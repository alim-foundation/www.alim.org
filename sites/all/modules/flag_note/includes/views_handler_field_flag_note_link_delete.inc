<?php
// $Id: views_handler_field_flag_note_link_delete.inc,v 1.1.2.3 2009/11/16 23:19:57 gunzip Exp $
/**
 * @file
 *
 * Field handler to present a link to delete a note.
 */
class views_handler_field_flag_note_link_delete extends views_handler_field {
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
    $options['text'] = array('default' => '', 'translatable' => TRUE);
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
    if (flag_note_has_access('delete', $fnid, $uid)) {
      $text = (!empty($this->options['text']) ? $this->options['text'] : t('remove note'));
      return l($text, "flagnote/$fnid/delete", array('query' => drupal_get_destination(),
          'attributes' => array('class' => 'flag-note-delete')));
    }
  }
}
