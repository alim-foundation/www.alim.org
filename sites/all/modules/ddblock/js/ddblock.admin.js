// $Id: ddblock.admin.js,v 1.4 2009/02/26 14:18:30 ppblaauw Exp $

/**
 * Show/hide advanced settings sections on the ddblock instance settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideAdvancedOptions = function(context) {
  // Show/hide slide advanced options depending on the checkbox.
  $('#ddblock-instance-settings #edit-advanced:not(.ddblock-show-hide-advanced-options-processed)', context)
  .addClass('ddblock-show-hide-advanced-options-processed')
  .bind("click change", function() {
    if (this.checked) {
      $("#ddblock-advanced-settings-wrapper").show();
      $("#ddblock-pager-position-wrapper").show();
      $("#ddblock-pager-event-wrapper").show();
      $("#edit-pager-height-wrapper").hide();
      $("#edit-pager-width-wrapper").hide();
      $("#ddblock-advanced-content-container-overflow-wrapper").hide();
      $("#ddblock-advanced-content-container-height-wrapper").hide();
      $("#ddblock-advanced-content-container-width-wrapper").hide();
      $("#ddblock-image-settings-wrapper").hide();
      $("#pager-dimensions-wrapper").hide();
      $("#edit-template-wrapper").show();
      $("#edit-imgcache-toggle-wrapper").show();
      $("#ddblock-imgcache-settings-wrapper").show();
      $("#edit-image-height-wrapper").hide();
      $("#edit-image-width-wrapper").hide();
      $("#edit-custom-template-wrapper").show();
      $('#edit-pager-wrapper option[value="custom-pager"]').show();
      $('#edit-output-wrapper option[value="view_fields"]').show();
      $('#edit-output-wrapper option[value="view_content"]').hide();
    }
    else {
      $("#ddblock-advanced-settings-wrapper").hide();
      $("#ddblock-pager-position-wrapper").hide();
      $("#ddblock-pager-event-wrapper").hide();
      $("#edit-pager-height-wrapper").show();
      $("#edit-pager-width-wrapper").show();
      $("#ddblock-advanced-content-container-overflow-wrapper").show();
      $("#ddblock-advanced-content-container-height-wrapper").show();
      $("#ddblock-advanced-content-container-width-wrapper").show();
      $("#ddblock-image-settings-wrapper").show();
      $("#pager-dimensions-wrapper").show();
      $("#edit-template-wrapper").hide();
      $("#edit-imgcache-toggle-wrapper").hide();
      $("#ddblock-imgcache-settings-wrapper").hide();
      $("#edit-image-height-wrapper").show();
      $("#edit-image-width-wrapper").show();
      $("#edit-custom-template-wrapper").hide();
      $('#edit-pager-wrapper option[value="custom-pager"]').hide();
      $('#edit-pager-wrapper #edit-pager').val('number-pager');
      $('#edit-output-wrapper option[value="view_fields"]').hide();
      $('#edit-output-wrapper option[value="view_content"]').show();
    }
    return true;
  }).trigger('change').trigger('change')
};
/**
 * Show/hide slide text settings sections on the ddblock instance settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideSlideTextOptions = function(context) {
  // Show/hide slide text options depending on the checkbox.
  $('#ddblock-instance-settings #edit-slide-text:not(.ddblock-show-hide-text-options-processed)', context)
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
 * Show/hide imagacache settings sections on the ddblock instance settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideImgCacheOptions = function(context) {
  // Show/hide image cache options depending on the checkbox.
  $('#ddblock-instance-settings #edit-imgcache-toggle:not(.ddblock-show-hide-imgcache-options-processed)', context)
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
  // Show/hide image cache options depending on the checkbox.
  $('#ddblock-block-settings #edit-imgcache-toggle:not(.ddblock-show-hide-imgcache-options-processed)', context)
  .addClass('ddblock-show-hide-imgcache-options-processed')
  // click for IE
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
 * Show/hide pager settings sections on the ddblock instance settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHidePagerOptions = function(context) {
  // Show/hide pager options depending on the checkbox.
  $('#ddblock-instance-settings #edit-pager-toggle:not(.ddblock-show-hide-pager-options-processed)', context)
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
  // Show/hide pager options depending on the checkbox.
  $('#ddblock-block-settings #edit-pager-toggle:not(.ddblock-show-hide-pager-options-processed)', context)
  .addClass('ddblock-show-hide-pager-options-processed')
  .bind("click change", function(){
    if (this.checked) {
      $("#ddblock-pager-settings-wrapper").show();
    }
    else {
      $("#ddblock-pager-settings-wrapper").hide();
    }
    return true;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide custom template settings sections on the ddblock instance settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideCustomTemplateOptions = function(context) {

  // get variables
  var ddblockSettings = Drupal.settings.ddblockCustomTemplate;

  // Show/hide imagefolder/contenttype options depending on the select.
  $('#ddblock-instance-settings #edit-template:not(.ddblock-show-hide-custom-template-options-processed)', context)
  .addClass('ddblock-show-hide-custom-template-options-processed')
  .bind("change", function() {
    val = $('#ddblock-instance-settings #edit-template').val();
    //alert(val);
    switch (val) {
    case "custom" :
      $("#ddblock-custom-template-settings-wrapper").show();
    case "upright10" :
      $('#edit-pager-wrapper #edit-pager').val('number-pager');
      $('#edit-pager-wrapper option[value="number-pager"]').show();
      $('#edit-pager-wrapper option[value="prev-next-pager"]').hide();
      $('#edit-pager-wrapper option[value="custom-pager"]').hide();
    break;
    case "upright20" :
      $('#edit-pager-wrapper #edit-pager').val('prev-next-pager');
      $('#edit-pager-wrapper option[value="number-pager"]').hide();
      $('#edit-pager-wrapper option[value="prev-next-pager"]').show();
      $('#edit-pager-wrapper option[value="custom-pager"]').hide();
    break;
    case "upright30" :
    case "upright40" :
    case "upright50" :
      $('#edit-pager-wrapper #edit-pager').val('custom-pager');
      $('#edit-pager-wrapper option[value="number-pager"]').hide();
      $('#edit-pager-wrapper option[value="prev-next-pager"]').hide();
      $('#edit-pager-wrapper option[value="custom-pager"]').show();
    break;
    }
    if (val.match("upright") == "upright") {
      if (!$.browser.mozilla) {
        var uprightPagerPositionOptions = {
          "top" : "Top",
	        "bottom" : "Bottom"
        }
        $("#edit-pager-position-wrapper #edit-pager-position").removeOption(/./);
        $("#edit-pager-position-wrapper #edit-pager-position").addOption(uprightPagerPositionOptions, false); // use true if you want to select the added options 
      }
      else {
        $("#edit-pager-position option[@value='top']").show();
        $("#edit-pager-position option[@value='right']").hide();
        $("#edit-pager-position option[@value='bottom']").show();
        $("#edit-pager-position option[@value='left']").hide();
        $("#edit-pager-position option[@value='both']").hide();
      }
      $("#ddblock-custom-template-settings-wrapper").hide();
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
        $("#edit-pager-position-wrapper #edit-pager-position").removeOption(/./);
        $("#edit-pager-position-wrapper #edit-pager-position").addOption(customPagerPositionOptions, false); // use true if you want to select the added options 
      }
      else {
        $('#edit-pager-position option[value="right"]').show();
        $('#edit-pager-position option[value="left"]').show();
        $('#edit-pager-position option[value="both"]').show();
      }
      $('#edit-pager-wrapper option[value="number-pager"]').show();
      $('#edit-pager-wrapper option[value="prev-next-pager"]').show();
      $('#edit-pager-wrapper option[value="custom-pager"]').show();
      $('#edit-pager-wrapper #edit-pager').val(ddblockSettings.pager);
      $('#edit-pager-position-wrapper #edit-pager-position').val(ddblockSettings.pagerPosition);
      $("#ddblock-pager-position-wrapper").show();
    }
    return false;
  }).trigger('change').trigger('change')
};

/**
 * Show/hide imagefolder/contenttype settings sections on the ddblock settings page.
 * don't change
 */
Drupal.behaviors.ddblockShowHideContentOptions = function(context) {
  // Show/hide imagefolder/contenttype options depending on the select.
  $('#ddblock-content-settings #edit-input-type:not(.ddblock-show-hide-content-options-processed)', context)
  .addClass('ddblock-show-hide-content-options-processed')
  .bind("change", function() {
    if ($('#ddblock-content-settings #edit-input-type').val() == 'images') {
      $("#ddblock-image-folder-settings-wrapper").show();
      $("#ddblock-content-types-settings-wrapper").hide();
      $('#edit-pager-wrapper option[value="image-pager"]').show();
      $('#edit-imgcache-toggle-wrapper').show();
      $("#ddblock-imgcache-settings-wrapper").show();
    }
    else {
      $("#ddblock-image-folder-settings-wrapper").hide();
      $("#ddblock-content-types-settings-wrapper").show();
      $('#edit-pager-wrapper option[value="image-pager"]').hide();
      // set pager to number-pager if not an image folder selected
      $('#edit-pager-wrapper #edit-pager').val('number-pager');
      $('#edit-imgcache-toggle-wrapper').hide();
      $("#ddblock-imgcache-settings-wrapper").hide();
    }
    return false;
  }).trigger('change').trigger('change')
};
