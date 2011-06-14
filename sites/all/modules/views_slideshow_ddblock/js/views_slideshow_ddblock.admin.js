// $Id: views_slideshow_ddblock.admin.js,v 1.2 2010/03/21 09:24:07 ppblaauw Exp $

/**
 *  @file
 *  Views Slideshow DDblock admin page functionality 
 */
/**
 * Show/hide imagacache settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideImgCacheOptions = function(context) {
  // Show/hide image cache options depending on the checkbox.
  $('#edit-style-options-ddblock-imgcache-toggle:not(.ddblock-show-hide-imgcache-options-processed)', context)
  .addClass('ddblock-show-hide-imgcache-options-processed')
  .bind("click change", function() {
    if (this.checked) {
      $("#ddblock-imgcache-settings-wrapper").show();
    }
    else {
      $("#ddblock-imgcache-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide pager settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHidePagerOptions = function(context) {
  // Show/hide pager options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-pager-toggle:not(.ddblock-show-hide-pager-options-processed)', context)
  .addClass('ddblock-show-hide-pager-options-processed')
  .bind("click change", function() {
    if (this.checked){
      $("#ddblock-pager-settings-wrapper").show();
    }
    else {
      $("#ddblock-pager-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide prev/next pager settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHidePager2Options = function(context) {
  // Show/hide pev/next pager options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-pager2:not(.ddblock-show-hide-pager2-options-processed)', context)
  .addClass('ddblock-show-hide-pager2-options-processed')
  .bind("click change", function() {
    if (this.checked){
      $("#ddblock-pager2-settings-wrapper").show();
    }
    else {
      $("#ddblock-pager2-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide prev/next pager settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHidePager2PagerOptions = function(context) {
  // Show/hide pager options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-pager2-settings-pager2-position-pager:not(.ddblock-show-hide-pager2-pager-options-processed)', context)
  .addClass('ddblock-show-hide-pager2-pager-options-processed')
  .bind("click change", function() {
    if (this.checked){
      $("#ddblock-pager2-pager-settings-wrapper").show();
    }
    else {
      $("#ddblock-pager2-pager-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide prev/next pager settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHidePager2SlideOptions = function(context) {
  // Show/hide pager options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-pager2-settings-pager2-position-slide:not(.ddblock-show-hide-pager2-slide-options-processed)', context)
  .addClass('ddblock-show-hide-pager2-slide-options-processed')
  .bind("click change", function() {
    if (this.checked){
      $("#ddblock-pager2-slide-settings-wrapper").show();
    }
    else {
      $("#ddblock-pager2-slide-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide slide text settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideSlideTextOptions = function(context) {
  // Show/hide slide text options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-slide-text:not(.ddblock-show-hide-text-options-processed)', context)
  .addClass('ddblock-show-hide-text-options-processed')
  .bind("click change", function() {
    if (this.checked) {
      $("#ddblock-slide-text-settings-wrapper").show();
    }
    else {
      $("#ddblock-slide-text-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide jquery slide text settings sections on the views_slideshow_ddblock configuration page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideSlideJqueryTextOptions = function(context) {
  // Show/hide slide text options depending on the checkbox.
  $('#edit-style-options-ddblock-settings-slide-text-settings-slide-text-jquery:not(.ddblock-show-hide-text-jquery-options-processed)', context)
  .addClass('ddblock-show-hide-text-jquery-options-processed')
  .bind("click change", function() {
    if (this.checked) {
      $("#ddblock-slide-jquery-settings-wrapper").show();
    }
    else {
      $("#ddblock-slide-jquery-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Change pager container depending on the pager.
 */
Drupal.behaviors.ddblockChangePagerContainerOptions = function(context) {

  // Change pager container option depending on select.
  $('#edit-style-options-ddblock-settings-pager-settings-pager:not(.ddblock-change-pager-container-options-processed)', context)
  .addClass('ddblock-change-pager-container-options-processed')
  .bind("change", function() {
    val = $('#edit-style-options-ddblock-settings-pager-settings-pager').val();
    switch (val) {
      case "number-pager" :
      case "prev-next-pager" :
      case "custom-pager" :
        $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.custom-pager-item');
      break;
      case "scrollable-pager" :
        $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.scrollable-pager-item');
      break;
    }
    return false;
  }).trigger('change').trigger('change')
};



/**
 * Show/hide custom template settings sections on the views_slideshow_ddblock configuration page.
 */
Drupal.behaviors.ddblockShowHideCustomTemplateOptions = function(context) {

  // get variables
  var ddblockSettings = Drupal.settings.ddblockCustomTemplate;

  // Show/hide imagefolder/contenttype options depending on the select.
  $('#edit-style-options-ddblock-template:not(.ddblock-show-hide-custom-template-options-processed)', context)
  .addClass('ddblock-show-hide-custom-template-options-processed')
  .bind("change", function() {
    val = $('#edit-style-options-ddblock-template').val();
    switch (val) {
    case "custom" :
      $('#ddblock-custom-template-settings-wrapper').show();
    break;  
    case "vsd-upright10" :
      $('#edit-style-options-ddblock-settings-pager-settings-pager').val('number-pager');
      $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.custom-pager-item');
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="number-pager"]').show();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="custom-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="scrollable-pager"]').hide();
    break;
    case "vsd-upright20" :
      $('#edit-style-options-ddblock-settings-pager-settings-pager').val('prev-next-pager');
      $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.custom-pager-item');
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="number-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="custom-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="scrollable-pager"]').hide();
    break;
    case "vsd-upright30" :
    case "vsd-upright40" :
    case "vsd-upright50" :
      $('#edit-style-options-ddblock-settings-pager-settings-pager').val('custom-pager');
      $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.custom-pager-item');
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="number-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="prev-next-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="custom-pager"]').show();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="scrollable-pager"]').hide();
    break;
    case "vsd-upright60" :
      $('#edit-style-options-ddblock-settings-pager-settings-pager').val('scrollable-pager');
      $('#edit-style-options-ddblock-settings-pager-settings-pager-container').val('.scrollable-pager-item');
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="number-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="prev-next-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="custom-pager"]').hide();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="scrollable-pager"]').show();
    break;
    }
    if (val.match("upright") == "upright") {
      if (!$.browser.mozilla) {
        var uprightPagerPositionOptions = {
          "top" : "Top",
	        "bottom" : "Bottom"
        }
//        $("#edit-style-options-ddblock-settings-pager-settings-pager-position").removeOption(/./);
//        $("#edit-style-options-ddblock-settings-pager-settings-pager-position").addOption(uprightPagerPositionOptions, false); // use true if you want to select the added options 
      }
      else {
        $("#edit-style-options-ddblock-settings-pager-settings-pager-position option[@value='top']").show();
        $("#edit-style-options-ddblock-settings-pager-settings-pager-position option[@value='right']").hide();
        $("#edit-style-options-ddblock-settings-pager-settings-pager-position option[@value='bottom']").show();
        $("#edit-style-options-ddblock-settings-pager-settings-pager-position option[@value='left']").hide();
        $("#edit-style-options-ddblock-settings-pager-settings-pager-position option[@value='both']").hide();
      }
      $("#ddblock-custom-template-settings-wrapper").hide();
 //     $('#edit-style-options-ddblock-settings-pager-settings-pager-position').val(ddblockSettings.pagerPosition);
    }
    else { /* custom themes */
      if (!$.browser.mozilla) {
        var customPagerPositionOptions = {
          "top" : "Top",
	        "right" : "Right",
	        "bottom" : "Bottom",
          "left" : "Left",
          "both" : "Both"
        }
//        $("#edit-style-options-ddblock-settings-pager-settings-pager-position").removeOption(/./);
//        $("#edit-style-options-ddblock-settings-pager-settings-pager-position").addOption(customPagerPositionOptions, false); // use true if you want to select the added options 
      }
      else {
        $('#edit-style-options-ddblock-settings-pager-settings-pager-position option[value="right"]').show();
        $('#edit-style-options-ddblock-settings-pager-settings-pager-position option[value="left"]').show();
        $('#edit-style-options-ddblock-settings-pager-settings-pager-position option[value="both"]').show();
      }
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="number-pager"]').show();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="prev-next-pager"]').show();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="custom-pager"]').show();
      $('#edit-style-options-ddblock-settings-pager-settings-pager option[value="scrollable-pager"]').show();
//      $('#edit-style-options-ddblock-settings-pager-settings-pager').val(ddblockSettings.pager);
//      $('#edit-style-options-ddblock-settings-pager-settings-pager-position').val(ddblockSettings.pagerPosition);
      $("#edit-style-options-ddblock-settings-pager-settings-pager-position-wrapper").show();
    }
    return false;
  }).trigger('change').trigger('change')
};
