<?php

/**
 * Specialized implementation of hook_vud_widgets().
 */
function vud_updown_vud_widgets() {
  return array(
    'title' => t('Default'),
    'widget template' => 'widget',
  );
}
