<?php

function boomerang_admin_settings(&$form_state) {
  $form['boomerang_tracking_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Boomerang tracking.'),
    '#description' => t('If enabled, the Boomerang script will be added to pages on the site.'),
    '#default_value' => variable_get('boomerang_tracking_enabled', TRUE),
  );
  if (!module_exists('boomerang_beacon')) {
    $form['boomerang_external_beacon'] = array(
      '#type' => 'textfield',
      '#title' => t('External beacon URL'),
      '#default_value' => variable_get('boomerang_external_beacon', ''),
      '#description' => t('If you are running the beacon elsewhere, enter the URL of the beacon. To run the beacon on this site, enable the <em>Boomerang Beacon</em> module.'),
    );
  }
  $form['boomerang_ignore'] = array(
    '#type' => 'textarea',
    '#title' => t('Ignore pages'),
    '#default_value' => variable_get('boomerang_ignore', "node/add*\nnode/*/edit\nadmin*"),
    '#cols' => 40,
    '#rows' => 5,
    '#description' => t("The pages listed here will not have beaconing enabled. Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are '<em>blog</em>' for the blog page and '<em>blog/*</em>' for every personal blog. '<em>&lt;front&gt;</em>' is the front page."),
  );
  return system_settings_form($form);  
}

