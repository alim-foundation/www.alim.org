<?php

/**
 * Specialized implementation of hook_vud_widgets().
 */
function vud_plain_vud_widgets() {
  return array(
    'title' => t('Plain'),
    'widget template' => 'widget',
    'votes template' => 'votes',
  );
}
