<?php

/**
 * Specialized implementation of hook_vud_widgets().
 */
function vud_alternate_vud_widgets() {
  return array(
    'title' => t('Alternate'),
    'widget template' => 'widget',
  );
}
