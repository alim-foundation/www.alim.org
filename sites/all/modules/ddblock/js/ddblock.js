// $Id: ddblock.js,v 1.3 2009/02/20 16:09:18 ppblaauw Exp $

/**
  * Set image settings
  * only used if no template is choosen for the dynamic display block
  */
Drupal.behaviors.ddblockImg = function (context) {
  for (var base in Drupal.settings.ddblockImages) {
    // get variables
    var ddblockSettings = Drupal.settings.ddblockImages[base];

    // if no template and CCS is used set the image dimensions here
    if (ddblockSettings.setDimensions == 'none') {
      if ((ddblockSettings.imageHeight > 0) && (ddblockSettings.imageWidth > 0 )) {
        $('#ddblock-'+ ddblockSettings.block +' .ddblock-container img:not(.ddblock-processed)', context)
        .css('height',ddblockSettings.imageHeight + 'px')
        .css('width',ddblockSettings.imageWidth + 'px')
        .css('padding', '2px')
        .css('border', '1px solid #ddd')
        .css('background-color', '#eee')
        .addClass('ddblock-processed');
      }
    }
  }
};

/**
  * Set content dimensions.
  * only used if no template is choosen for the dynamic display block
  */
Drupal.behaviors.ddblockImgContainer = function (context) {
  for (var base in Drupal.settings.ddblockImageContainer) {
    // get variables
    var ddblockSettings = Drupal.settings.ddblockImageContainer[base];

    // if no template and CCS is used set the content dimensions here
    if (ddblockSettings.setDimensions == 'none') {
      if ((ddblockSettings.imageContainerHeight > 12) && (ddblockSettings.imageContainerWidth > 12 )) {
        $('#ddblock-' + ddblockSettings.block  +' .ddblock-container:not(.ddblock-processed)', context)
        .css('height',ddblockSettings.imageContainerHeight + 'px')
        .css('width',ddblockSettings.imageContainerWidth + 'px')
        .css('overflow','hidden')
        .addClass('ddblock-processed');
      }
    }
  }
};

/**
  * Set the cycle plugin settings.
  *
  * Examples how and what to override for your own blocks
  *   Replace ddblockCycle with the ddblockCycle[BLOCKNUMBER]
  *   Change the onBefore and onAfter functions
  *
  */
Drupal.behaviors.ddblockCycle = function (context) {

  //helper function to clone the options object
  function CloneObject(inObj) {
    for (i in inObj)
    {
        this[i] = inObj[i];
    }
  }

  // cycle Plugin onBefore function to add functionality before the next slide shows up
  // can be used to add the following effects to slide-text
  // fadeOut - Fade out all matched elements by adjusting their opacity and firing an optional callback after completion.
  // slideUp - Hide all matched elements by adjusting their height and firing an optional callback after completion.
  // hide - Hide all matched elements using a graceful animation and firing an optional callback after completion.
  function onBefore(curr, next, opts, fwd) {
    if (opts.slideTextEffectBeforeSpeed == 0) {
      opts.slideTextEffectBeforeSpeed = 1;
    };
    switch (opts.slideTextEffectBefore) {
    case "fadeOut":
      $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-' + opts.slideTextPosition).fadeOut(opts.slideTextEffectBeforeSpeed);
    break;
    case "slideUp":
      $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-' + opts.slideTextPosition).slideUp(opts.slideTextEffectBeforeSpeed);
    break;
    default:
      $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-' + opts.slideTextPosition).hide(opts.slideTextEffectBeforeSpeed);
    }
  }

  // cycle Plugin onAfter function to add functionality after the next slide shows up
  // can be used to add the following effects to slide-text
  // fadein - Fade in all matched elements by adjusting their opacity and firing an optional callback after completion.
  // slideDown - Reveal all matched elements by adjusting their height and firing an optional callback after completion.
  // show - Show all matched elements using a graceful animation and firing an optional callback after completion.
  function onAfter(curr, next, opts, fwd) {
    if (opts.slideTextEffectAfterSpeed == 0) {
      opts.slideTextEffectAfterSpeed = 1;
    };
    switch (opts.slideTextEffectAfter) {
    case "fadeIn":
     $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-'  + opts.slideTextPosition).fadeIn(opts.slideTextEffectAfterSpeed);
    break;
    case 'slideDown':
     $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-' + opts.slideTextPosition).slideDown(opts.slideTextEffectAfterSpeed);
    break;
    default:
     $("#ddblock-"+ opts.ddblocknr + ' ' + opts.slideTextContainer + '-' + opts.slideTextPosition).show(opts.slideTextEffectAfterSpeed);
    }

    // show pager count (0 of x)
    $("#ddblock-"+ opts.ddblocknr + ' ' + '#count2').html((opts.currSlide + 1) + " of " + opts.slideCount);

    // Only show prev if previous slide exist - Only show next if next slide exist
    var index = $(this).parent().children().index(this);
    $("#ddblock-"+ opts.ddblocknr + ' ' + '#prev2')[index == 0 ? 'hide' : 'show']();
    $("#ddblock-"+ opts.ddblocknr + ' ' + '#next2')[index == opts.slideCount - 1 ? 'hide' : 'show']();
  }

  i=0;
  for (var base in Drupal.settings.ddblockContent) {
    // new options var for every block
    var options = new CloneObject($.fn.cycle.defaults);

    // simplify variable name
    var ddblockSettings = Drupal.settings.ddblockContent[base];
    var block = ddblockSettings.block;
    var custom = ddblockSettings.custom;
    var pager = ddblockSettings.pager;
    var pagerEvent = ddblockSettings.pagerEvent;
    var contentContainer = ddblockSettings.contentContainer;
    var pagerContainer = ddblockSettings.pagerContainer;

    // if not processed
    if (!$('#ddblock-' + block + '.ddblock-processed', context).size()) {

      // set transition option
      options.fx = ddblockSettings.fx;

      //set delay option for the blocks at different values so they less interfere with eachother
      options.delay = i * -1000;

      // set pager. You can have only one pager per block this way
      if (pager == 'image-pager' || pager == 'number-pager' || pager == 'custom-pager') {
        // number pager, image pager and custom pager
        options.pager = "#ddblock-" + pager + "-" + block;
        if (pager == 'image-pager') {
          options.pagerAnchorBuilder = function(idx, slide) {
            // return selector string for existing anchor
            return "#ddblock-" + pager + "-" + block + " li:eq(" + idx + ") a";
          }
        }
        if (pager == 'custom-pager') {
          options.pagerAnchorBuilder = function(idx, slide) {
            // return selector string for existing anchor
            return "#ddblock-" + pager + "-" + block + " " + pagerContainer + ":eq(" + idx + ") a.pager-link";
          }
        }
      }
      if (pager == 'prev-next-pager') {
        options.prev = "#ddblock-"+ block + " #prev2";
        options.next = "#ddblock-"+ block + " #next2";
      } else {
         //set next
        if (ddblockSettings.next) {
          options.next = "#ddblock-"+ block + ' ' + contentContainer;
        }
      }

      //set event which drives the pager navigation
      options.pagerEvent = pagerEvent;
      if (pagerEvent == 'mouseover' || pagerEvent == 'click') {
        options.fastOnEvent = true;
        options.pauseOnPagerHover = true;
      }

      //set expression for selecting slides (if something other than all children is required)
      options.slideExpr = contentContainer;

      //set speed of the transition (any valid fx speed value)
      options.speed = ddblockSettings.speed;
      if (options.speed == 0) {
        options.speed = 1;
      };

      //set timeout in milliseconds between slide transitions (0 to disable auto advance)
      options.timeout = ddblockSettings.timeOut;

      //set pause, true to enable "pause on hover"
      if (ddblockSettings.pause) {
        options.pause = ddblockSettings.pause;
      }

      //set custom options
      if (custom) {
        // get the \r\n from the string
        var custom1 = custom.replace(/\r\n/gi,"");

        // parse into JSON object
        var custom2 = JSON.parse(custom1);

        // merge custom2 with options object
        jQuery.extend(true, options, custom2);
      }

      // simple block
      if (ddblockSettings.setDimensions == 'none') {
        if ((ddblockSettings.height > 0) && (ddblockSettings.width > 0 )) {
          $('#ddblock-'+ block)
          .cycle(options)
          .css('height',ddblockSettings.height + 'px')
          .css('width',ddblockSettings.width + 'px')
          .css('overflow', ddblockSettings.overflow)
          .css('visibility', 'visible')
          .addClass('ddblock-processed');
        }
        else {
          $('#ddblock-'+ block)
          .cycle(options)
          .css('overflow', ddblockSettings.overflow)
          .css('visibility', 'visible')
          .addClass('ddblock-processed');
        }
      }
      // advanced block
      else {
        if (ddblockSettings.slideTextPosition) {
          //set slidetext options
          options.slideTextContainer = ddblockSettings.slideTextContainer;
          options.slideTextPosition = ddblockSettings.slideTextPosition;
          options.slideTextEffectBefore = ddblockSettings.slideTextEffectBefore;
          options.slideTextEffectBeforeSpeed = ddblockSettings.slideTextEffectBeforeSpeed;
          options.slideTextEffectAfter = ddblockSettings.slideTextEffectAfter;
          options.slideTextEffectAfterSpeed = ddblockSettings.slideTextEffectAfterSpeed;
          options.ddblocknr = block;
          options.before = onBefore;
          options.after = onAfter;
        }

        options.pagerContainer = ddblockSettings.pagerContainer;

        // redefine Cycle's updateActivePagerLink function
        $.fn.cycle.updateActivePagerLink = function(pager, currSlide) {
          if (pager.match("custom-pager") == "custom-pager") {
            $(pager)
            .find('a.pager-link')
            .removeClass('activeSlide')
            .filter('a.pager-link:eq('+currSlide+')')
            .addClass('activeSlide');
          }
          else {
            $(pager)
            .find('a')
            .removeClass('activeSlide')
            .filter('a:eq('+currSlide+')')
            .addClass('activeSlide');
          }
          $(pager)
          .find('.custom-pager-item')
          .removeClass('active-pager-item')
          .filter('.custom-pager-item:eq('+currSlide+')')
          .addClass('active-pager-item');
        };

        //Use the parent of the slides as the parent container so the children function can be used for the second pager
        var $container = $('#ddblock-' + block + ' ' + contentContainer).parent()
        .cycle(options)
        .css('visibility', 'visible')
        .addClass('ddblock-processed');
      }
    }
    i++;
  }
};

