<?php
// $Id: views_slideshow_ddblock.views_slideshow.inc,v 1.2 2010/03/21 09:24:07 ppblaauw Exp $

/**
 *  @file
 *  The default options available with Views Slideshow: ddblock.
 */

/**
 *  Implements hook_views_slideshow_modes().
 */
function views_slideshow_ddblock_views_slideshow_modes() {
  // Expose the mode for ddblock slide shows.
  $options = array(
    'ddblock' => t('DDblock'),
  );
  return $options;
}

/**
 *  Implements hook_views_slideshow_option_definition().
 */
function views_slideshow_ddblock_views_slideshow_option_definition() {
  // Set our default options.
  $options = array(
    'ddblock' => array(
      'default' => array(
        'widget' => 'cycle',
        'debug_info' => 'none',
        'template' => 'upright10',
        'custom_template' => '',
        'imgcache_toggle' => 0,
        'imgcache' => array(
          'imgcache_slide' => '<none>',
          'imgcache_pager_item' => '<none>',
        ),
        'content_container' => array(
          'container' => 'div.slide',
          'overfow' => 0,
        ),
        'settings' => array(
          'fx' => 'fade',
          'speed' => 500,
          'timeout' => 5000,
          'order' => 'asc',
          'pause' => 1,
          'next' => 0,
          'pager_toggle' => 1,
          'pager_settings' => array(
            'pager' => 'number-pager',
            'pager_container' => '.custom-pager-item',
            'pager_position' => 'top',
            'pager_event' => 'click',
            'pager_fast' => 1,
            'pager_pause' => 1,
          ),
          'pager2' => 0,
          'pager2_settings' => array(
            'pager2_event' => 'click',
            'pager2_position' => array('slide' => 'slide',
                                       'pager' => 0),
            'pager2_pager' => array(
              'pager2_pager_prev' => t('prev'),
              'pager2_pager_next' => t('next'),
              'pager2_pager_hide' => 1,
            ),
            'pager2_slide' => array(
              'pager2_slide_prev' => '',
              'pager2_slide_next' => '',
              'pager2_slide_hide' => 1,
            ),
          ),
          'slide_text' => 1,
          'slide_text_settings' => array(
            'slide_text_container' => 'div.slide-text',
            'slide_text_position' => 'bottom',
            'slide_text_jquery' => 0,
            'slide_jquery' => array(
              'slide_text_before_effect' => 'hide',
              'slide_text_before_speed' => 500,
              'slide_text_after_effect' => 'show',
              'slide_text_after_speed' => 500,
            ),
          ),
          'custom' => array(
            'custom_jquery' => '',
          ),
        ),
      ),
    ),
  );
  return $options;
}

/**
 *  Implements hook_views_slideshow_options_form().
 */
function views_slideshow_ddblock_views_slideshow_options_form(&$form, &$form_state, &$view) {

  // add views_slideshow_ddblock.admin. js file
  drupal_add_js(drupal_get_path('module', 'views_slideshow_ddblock') . '/js/views_slideshow_ddblock.admin.js');

  // set pager variable for javascript
  $settings['ddblockCustomTemplate'] = array(
    'pager' => $view->options['ddblock']['settings']['pager_settings']['pager'],
    'pagerPosition' => $view->options['ddblock']['settings']['pager_settings']['pager_position'],
  );

  drupal_add_js($settings, 'setting');


  $form['type'] = NULL;

  // Create the form elements for our ddblock view options.
  $form['ddblock'] = array(
    '#type' => 'fieldset',
    '#title' => t('DDblock options'),
    '#collapsible' => TRUE,
    '#collapsed' => !($view->options['mode'] == 'ddblock'),
  );

  // widget setting: Enable the dynamic display block setting for this block.
  $options = array(
    'default' => t('Default'),
    'cycle' => t('Cycleblock'),
  );

  // select widget
  $form['ddblock']['widget'] = array(
    '#type' => 'radios',
    '#title' => t('Display Method'),
    '#default_value' => $view->options['ddblock']['widget'],
    '#options' => $options,
    '#required' => TRUE,
    '#description' => t("Choose a way to display content."),
    '#weight' => -10,
  );

  // debug settings: Show debug info.
  $options = array(
    'none' => t('None'),
    'drupal' => t('Using drupal_set_message'),
  );
  if (module_exists('devel')) {
    $options['devel'] = t('Using devel module');
  }

  // Select how to show debug info
  $form['ddblock']['debug_info'] = array(
    '#type' => 'select',
    '#title' => t('Show debug info'),
    '#default_value' => $view->options['ddblock']['debug_info'],
    '#options' => $options,
    '#required' => FALSE,
    '#description' => t("Show debug info to determine view name/display id, fieldnames, settings, number of items"),
    '#weight' => -9,
  );

  $options = array(
  //  'none'      => 'None',
    'vsd-upright10' => 'vsd-upright10',
    'vsd-upright20' => 'vsd-upright20',
    'vsd-upright30' => 'vsd-upright30',
    'vsd-upright40' => 'vsd-upright40',
    'vsd-upright50' => 'vsd-upright50',
    'vsd-upright60' => 'vsd-upright60',
    'custom' => 'Custom',
  );

  $form['ddblock']['template'] = array(
    '#type' => 'select',
    '#title' => t('Template'),
    '#default_value' => $view->options['ddblock']['template'],
    '#options' => $options,
    '#multiple' => FALSE,
    '#required' => FALSE,
    '#description' => t("Template for themable output. Template name will become:<br />views-slideshow-ddblock-cycle-block-content-[TEMPLATENAME].tpl.php"),
    '#weight' => -8,
  );

  // Custom template.
  $form['ddblock']['custom_template'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom template'),
    '#default_value' => $view->options['ddblock']['custom_template'],
    '#required' => FALSE,
    '#prefix' => '<div id="ddblock-custom-template-settings-wrapper">',
    '#suffix' => '</div>',
    '#description' => t("Custom template for themable output. Template name will become: <br />ddblock-cycle-block-content-[TEMPLATENAME].tpl.php"),
    '#weight' => -7,
  );

  if ($widget == 'default') {
    $collapsed = TRUE;
  }
  else {
    $collapsed = FALSE;
  }

  // if image cache module exist make it possible to use image cache presets
  if ((module_exists('imagecache')) and (imagecache_presets())) {
    $imgcache_options = array('<none>' => '<none>');
    // get imagecache presets using imagecache function
    foreach (imagecache_presets() as $preset) {
      $name = $preset['presetname'];
      $imgcache_options[$name] = $name;
    }
    $imgcache_slide_desc = t("Imagecache preset to use for slide image");
    $imgcache_pager_item_desc = t("Imagecache preset to use for pager-item image. Only for themes that use an image in the pager");

    // Image cache toggle
    $form['ddblock']['imgcache_toggle'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use imagecache presets'),
      '#default_value' => $view->options['ddblock']['imgcache_toggle'],
      '#required' => FALSE,
      '#description' => t("Use imagecache presets for images"),
      '#weight' => -5,
    );

    // Image cache settings.
    $form['ddblock']['imgcache'] = array(
      '#type' => 'fieldset',
      '#collapsible' => TRUE,
      '#title' => t('Image cache preset settings'),
      '#prefix' => '<div id="ddblock-imgcache-settings-wrapper"'. $extra .'>',
      '#suffix' => '</div>',
      '#weight' => -4,
    );

    // Select image cache slide image
    $form['ddblock']['imgcache']['imgcache_slide'] = array(
      '#type' => 'select',
      '#title' => t('Imagecache slide image'),
      '#default_value' => $view->options['ddblock']['imgcache']['imgcache_slide'],
      '#options' => $imgcache_options,
      '#multiple' => FALSE,
      '#required' => FALSE,
      '#description' => $imgcache_slide_desc,
      '#weight' => 1,
    );

    // Select image cache pager image
    $form['ddblock']['imgcache']['imgcache_pager_item'] = array(
      '#type' => 'select',
      '#title' => t('Imagecache pager-item image'),
      '#default_value' => $view->options['ddblock']['imgcache']['imgcache_pager_item'],
      '#options' => $imgcache_options,
      '#multiple' => FALSE,
      '#required' => FALSE,
      '#description' => $imgcache_pager_item_desc,
      '#weight' => 2,
    );
  }

  // content container settings.
  $form['ddblock']['content_container'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#title' => t('Content container settings'),
    '#weight' => -3,
  );

  $form['ddblock']['content_container']['container'] = array(
    '#type' => 'textfield',
    '#title' => t('Content container'),
    '#default_value' => $view->options['ddblock']['content_container']['container'],
    '#required' => FALSE,
    '#description' => t("Container of the content to slide, eg. CSS selector img, to show images.<br />This can be any CSS selector containing a slide. e.g div.slide"),
  );

  $form['ddblock']['content_container']['overflow'] = array(
    '#type' => 'checkbox',
    '#title' => t('Overflow hidden'),
    '#default_value' => $view->options['ddblock']['content_container']['overflow'],
    '#prefix' => '<div id="ddblock-advanced-content-container-overflow-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Hide the overflow of the container"),
  );
  // content settings: what to use as content for the dynamic display block.
  $form['ddblock']['settings'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => $collapsed,
    '#title' => t('Dynamic display block settings'),
    '#weight' => 1,
  );

  $options = _views_slideshow_ddblock_get_effects();
  $form['ddblock']['settings']['fx'] = array(
    '#type' => 'select',
    '#title' => t('Transition Effect'),
    '#default_value' => $view->options['ddblock']['settings']['fx'],
    '#options' => $options,
    '#multiple' => FALSE,
    '#required' => TRUE,
    '#description' => t("The transition effect between content. Multiple effects can be set in the Custom jQuery Cycle Plugin Settings."),
  );

  $options = drupal_map_assoc(array(0, 250, 500, 750, 1000, 1250, 1500, 1750, 2000, 2250, 2500, 2750, 3000, 4000, 5000));
  $form['ddblock']['settings']['speed'] = array(
    '#type' => 'select',
    '#title' => t('Speed'),
    '#default_value' => $view->options['ddblock']['settings']['speed'],
    '#options' => $options,
    '#required' => TRUE,
    '#description' => t("Speed of the transitions (1000 = 1 second, 0 = direct)."),
  );

  $options = drupal_map_assoc(array(0, 250, 500, 1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 20000, 30000));
  $form['ddblock']['settings']['timeout'] = array(
    '#type' => 'select',
    '#title' => t('Timeout'),
    '#default_value' => $view->options['ddblock']['settings']['timeout'],
    '#options' => $options,
    '#required' => TRUE,
    '#description' => t("The time (in milliseconds) between transitions (1000 = 1 second, 0 to disable auto advance)."),
  );

  $form['ddblock']['settings']['order'] = array(
    '#type' => 'select',
    '#title' => t('Sort Order'),
    '#default_value' => $view->options['ddblock']['settings']['order'],
    '#options' => array(
      'none' => t('None'),
      'asc' => t('Ascending'),
      'desc' => t('Descending'),
      'random' => t('Random'),
    ),
    '#multiple' => FALSE,
    '#required' => TRUE,
    '#description' => t("The display order of the content. None for using the original content order."),
  );

  $form['ddblock']['settings']['pause'] = array(
    '#type' => 'checkbox',
    '#title' => t('Pause'),
    '#default_value' => $view->options['ddblock']['settings']['pause'],
    '#description' => t("Enable users to pause the cycle by hovering on the content."),
  );

  $form['ddblock']['settings']['next'] = array(
    '#type' => 'checkbox',
    '#title' => t('Next'),
    '#default_value' => $view->options['ddblock']['settings']['next'],
    '#description' => t("Enable users to advanced to the next content by clicking on the content."),
  );

  // pager settings togg;e
  $form['ddblock']['settings']['pager_toggle'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager_toggle'],
    '#required' => FALSE,
    '#description' => t("Use a pager to select slides"),
  );

  // pager settings.
  //show fields when using pager
  //$extra = (empty($view->options['ddblock']['pager_toggle'])) ? ' style="display:none"' : '';
  $form['ddblock']['settings']['pager_settings'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#prefix' => '<div id="ddblock-pager-settings-wrapper">',//. $extra .'>',
    '#suffix' => '</div>',
    '#title' => t('Pager settings'),
  );

  $options = array(
    'none'            => t('None'),
    'number-pager'    => t('Number pager'),
    'prev-next-pager' => t('Prev next pager'),
    'custom-pager'    => t('Custom pager'),
    'scrollable-pager' => t('Scrollable pager'),
  );

  $form['ddblock']['settings']['pager_settings']['pager'] = array(
    '#type' => 'select',
    '#title' => t('Pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager'],
    '#options' => $options,
    '#required' => TRUE,
    '#description' => t("Type of pager to add."),
  );

  $form['ddblock']['settings']['pager_settings']['pager_container'] = array(
    '#type' => 'textfield',
    '#title' => t('Pager container'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager_container'],
    '#required' => FALSE,
    '#description' => t("Container of a pager-item, eg. CSS selector li.<br />This can be any CSS selector containing a pager-item.<br /> For a custom pager this needs to be .custom-pager-item<br />For a scrollable pager this needs to be .scrollable-pager-item"),
  );

  $options = array(
    'top' => t('Top'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
    'left' => t('Left'),
    'both' => t('Both'),
  );

  $form['ddblock']['settings']['pager_settings']['pager_position'] = array(
    '#type' => 'select',
    '#title' => t('Pager position'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager_position'],
    '#prefix' => '<div id="ddblock-pager-position-wrapper">',
    '#suffix' => '</div>',
    '#options' => $options,
    '#required' => FALSE,
    '#description' => t("Possible position for the pager.<br />The position must be supported by the template used to be effective."),
  );

  $options = array(
    'click' => t('Click'),
    'mouseover' => t('Mouseover'),
  );

  $form['ddblock']['settings']['pager_settings']['pager_event'] = array(
    '#type' => 'select',
    '#title' => t('Pager event'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager_event'],
    '#prefix' => '<div id="ddblock-pager-event-wrapper">',
    '#suffix' => '</div>',
    '#options' => $options,
    '#required' => FALSE,
    '#description' => t("The event on which the pager reacts."),
  );

  $form['ddblock']['settings']['pager_settings']['pager_fast'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fast Pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager_fast'],
    '#prefix' => '<div id="ddblock-pager-fast-wrapper">',
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Use fast pager event when clicked or hovered."),
  );

  $form['ddblock']['settings']['pager_settings']['pager_pause'] = array(
    '#type' => 'checkbox',
    '#title' => t('Pager pause'),
    '#default_value' => $view->options['ddblock']['settings']['pager_settings']['pager_pause'],
    '#prefix' => '<div id="ddblock-pager-pause-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Pause the slideshow when pager hovered."),
  );

  // pager2 settings toggle
  $form['ddblock']['settings']['pager2'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Prev/Next Pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager2'],
    '#required' => FALSE,
    '#description' => t("Use a Prev/Next Pager to select slides"),
  );

  // pager2 settings.
  //show fields when using pager
  $extra = (empty($view->options['ddblock']['settings']['pager2'])) ? ' style="display:none"' : '';
  $form['ddblock']['settings']['pager2_settings'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#prefix' => '<div id="ddblock-pager2-settings-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#title' => t('Prev/next pager settings'),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_event'] = array(
    '#type' => 'select',
    '#title' => t('Pager event'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_event'],
    '#prefix' => '<div id="ddblock-pager2-slide-event-wrapper">',
    '#suffix' => '</div>',
    '#options' => $options,
    '#required' => FALSE,
    '#description' => t("The event on which the prev/next pager reacts."),
  );

  $options = array(
    'pager' => t('Pager'),
    'slide' => t('Slide'),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_position'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Pager position'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_position'] ? $view->options['ddblock']['settings']['pager2_settings']['pager2_position'] : array(),
    '#prefix' => '<div id="ddblock-pager2-position-wrapper">',
    '#suffix' => '</div>',
    '#options' => $options,
    '#multiple' => TRUE,
    '#required' => FALSE,
    '#description' => t("Possible position for the prev/next pager.<br />The position must be supported by the template used to be effective."),
  );

  // pager2 settings pager.
  //show fields when using pager pager
  $extra = (empty($view->options['ddblock']['settings']['pager2'])) ? ' style="display:none"' : '';
  $form['ddblock']['settings']['pager2_settings']['pager2_pager'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#prefix' => '<div id="ddblock-pager2-pager-settings-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#title' => t('Pager Pager'),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_prev'] = array(
    '#type' => 'textfield',
    '#title' => t('Prev text in pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_prev'],
    '#prefix' => '<div id="ddblock-pager2-pager-prev-text-wrapper">',
    '#size' => 30,
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Caption for the prev pager in the pager.<br />Can also be empty if you use an image to go to the previous slide."),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_next'] = array(
    '#type' => 'textfield',
    '#title' => t('Next text in pager'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_next'],
    '#prefix' => '<div id="ddblock-pager2-pager-next-text-wrapper">',
    '#size' => 30,
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Caption for the next pager in the pager.<br />Can also be empty if you use an image to go to the next slide."),
  );

  // hide prev/next pager when no prev/next slide available
  $form['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_hide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Prev/Next Hide'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_pager']['pager2_pager_hide'],
    '#required' => FALSE,
    '#description' => t("Hide Prev/Next Pager when no slide available."),
  );

  // pager2 settings slide.
  //show fields when using slide pager
  $extra = (empty($view->options['ddblock']['settings']['pager2'])) ? ' style="display:none"' : '';
  $form['ddblock']['settings']['pager2_settings']['pager2_slide'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#prefix' => '<div id="ddblock-pager2-slide-settings-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#title' => t('Slide Pager'),
  );

  $options = array(
    'click' => t('Click'),
    'mouseover' => t('Mouseover'),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_prev'] = array(
    '#type' => 'textfield',
    '#title' => t('Prev text on slide'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_prev'],
    '#prefix' => '<div id="ddblock-pager2-slide-prev-text-wrapper">',
    '#size' => 30,
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Caption for the prev pager on the slide.<br />Can also be empty if you use an image to go to the previous slide."),
  );

  $form['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_next'] = array(
    '#type' => 'textfield',
    '#title' => t('Next text on slide'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_next'],
    '#prefix' => '<div id="ddblock-pager2-slide-next-text-wrapper">',
    '#size' => 30,
    '#suffix' => '</div>',
    '#required' => FALSE,
    '#description' => t("Caption for the next pager on the slide.<br />Can also be empty if you use an image to go to the next slide."),
  );

  // hide prev/next pager when no prev/next slide available
  $form['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_hide'] = array(
    '#type' => 'checkbox',
    '#title' => t('Prev/Next Hide'),
    '#default_value' => $view->options['ddblock']['settings']['pager2_settings']['pager2_slide']['pager2_slide_hide'],
    '#required' => FALSE,
    '#description' => t("Hide Prev/Next Pager when no slide available."),
  );

  $form['ddblock']['settings']['slide_text'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use slide text'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text'],
    '#required' => FALSE,
    '#description' => t("Show slide text when available in content."),
  );

  $form['ddblock']['settings']['slide_text_settings'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#title' => t('Slide text settings'),
    '#prefix' => '<div id="ddblock-slide-text-settings-wrapper">',
    '#suffix' => '</div>',
  );

  // slide text container field.
  $form['ddblock']['settings']['slide_text_settings']['slide_text_container'] = array(
    '#type' => 'textfield',
    '#title' => t('Slide text container'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_text_container'],
    '#required' => FALSE,
    '#description' => t("Container of the slide text."),
  );

  $options = array(
    'top' => t('Top'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
    'left' => t('Left'),
  );

  $form['ddblock']['settings']['slide_text_settings']['slide_text_position'] = array(
    '#type' => 'select',
    '#title' => t('Slide text position'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_text_position'],
    '#options' => $options,
    '#multiple' => FALSE,
    '#required' => FALSE,
    '#description' => t("Position of the slide text."),
  );

  $form['ddblock']['settings']['slide_text_settings']['slide_text_jquery'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use jQuery effects for text of a slide'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_text_jquery'],
    '#required' => FALSE,
    '#description' => t("The jQuery effects will be added to the text in the Slide text container"),
    '#weight' => 6,
  );

  //show fields when using jQuery effects for text of a slide
  $extra = (empty($view->options['ddblock']['settings']['slide_text_settings']['slide_text_jquery'])) ? ' style="display:none"' : '';
  // if the checkbox: jQuery effects for text of a slide is not checked, hide the advanced settings
  $form['ddblock']['settings']['slide_text_settings']['slide_jquery'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#prefix' => '<div id="ddblock-slide-jquery-settings-wrapper"'. $extra .'>',
    '#suffix' => '</div>',
    '#title' => t('Slide text jquery settings'),
    '#weight' => 7,
  );

  $before_effect_options = array(
    'hide' => t('Basics - Hide'),
    'fadeOut' => t('Fading - Fade Out'),
    'slideUp' => t('Sliding - Slide Up'),
  );

  $form['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_before_effect'] = array(
    '#type' => 'select',
    '#title' => t('Before effect'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_before_effect'],
    '#options' => $before_effect_options,
    '#multiple' => FALSE,
    '#required' => FALSE,
    '#description' => t("Before effect of the slide text"),
  );

  $speed_options = drupal_map_assoc(array(0, 250, 500, 1000, 2000, 3000, 4000, 5000));

  $form['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_before_speed'] = array(
    '#type' => 'select',
    '#title' => t('Speed before effect'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_before_speed'],
    '#options' => $speed_options,
    '#required' => FALSE,
    '#description' => t("Speed of the before effect (1000 = 1 second, 0 = direct)."),
  );

  $after_effect_options = array(
    'show' => t('Basics - Show'),
    'fadeIn' => t('Fading - Fade In'),
    'slideDown' => t('Sliding - Slide Down'),
  );

  $form['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_after_effect'] = array(
    '#type' => 'select',
    '#title' => t('After effect'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_after_effect'],
    '#options' => $after_effect_options,
    '#multiple' => FALSE,
    '#required' => FALSE,
    '#description' => t("After effect of the slide text"),
  );

  $form['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_after_speed'] = array(
    '#type' => 'select',
    '#title' => t('Speed after effect'),
    '#default_value' => $view->options['ddblock']['settings']['slide_text_settings']['slide_jquery']['slide_text_after_speed'],
    '#options' => $speed_options,
    '#required' => FALSE,
    '#description' => t("Speed of the before effect (1000 = 1 second, 0 = direct)."),
  );

  $form['ddblock']['settings']['custom'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => $collapsed,
    '#title' => t('Custom jQuery Cycle Plugin Settings'),
    '#description' => t('If you use custom jQuery options, they will override your other settings.'),
  );

  if ($view->options['ddblock']['settings']['custom']['custom_jquery']) {
    $collapsed = FALSE;
  }
  else {
    $collapsed = TRUE;
  }

  $form['ddblock']['settings']['custom']['custom_jquery'] = array(
    '#type' => 'textarea',
    '#title' => t('Custom Options'),
    '#default_value' => $view->options['ddblock']['settings']['custom']['custom_jquery'],
    '#cols' => 60,
    '#rows' => 10,
    '#required' => FALSE,
    '#description' => t('Use valid JSON syntax, with double quotes for key/and string value pairs.<br />The total script needs to be enclosed in curly brackets.<br />No comma allowed after the last statement like in an array.<br />e.g.<br />{"fx":"fade",<br />"startingSlide":2,<br />"autostop":1}'),
  );
}

/**
 * Return available effect for the views slideshow dynamic display block module.
 *
 * @return
 *   An associative array containing the available effect for the views slideshow dynamic display block module.
 */
function _views_slideshow_ddblock_get_effects() {
  // effects.
  $_fx = array(
    'all' => t('Random'),
    'blindX' => t('blindX'),
    'blindY' => t('blindY'),
    'blindZ' => t('blindZ'),
    'cover' => t('cover'),
    'curtainX' => t('curtainX'),
    'curtainY' => t('curtainY'),
    'fade' => t('fade'),
    'fadeZoom' => t('fadeZoom'),
    'growX' => t('growX'),
    'growY' => t('growY'),
    'scrollUp' => t('scrollUp'),
    'scrollDown' => t('scrollDown'),
    'scrollLeft' => t('scrollLeft'),
    'scrollRight' => t('scrollRight'),
    'scrollHorz' => t('scrollHorz'),
    'scrollVert' => t('scrollVert'),
    'shuffle' => t('shuffle'),
    'slideX' => t('slideX'),
    'slideY' => t('slideY'),
    'toss' => t('soss'),
    'turnUp' => t('turnUp'),
    'turnDown' => t('turnDown'),
    'turnLeft' => t('turnLeft'),
    'turnRight' => t('turnRight'),
    'uncover' => t('uncover'),
    'wipe' => t('wipe'),
    'zoom' => t('zoom'),
  );

  return $_fx;
}

