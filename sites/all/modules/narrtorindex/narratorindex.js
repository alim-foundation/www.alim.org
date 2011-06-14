// $Id$
Drupal.behaviors.narratorindex = function (context) {
  $('a.NarrtorName:not(.Hadith-index)', context).click(function () {
     window.location="#anch";

	$("#divNarrtors").empty().html('<div align=\'center\' style=\'padding-top:40px;\'><img src="http://www.virtualliveworks.com/Alim.org/sites/all/themes/alim/images/ajax-loader.gif" /></div>');
    // This function will get exceuted after the ajax request is completed successfully
    var updateHadiths = function(data) {
      // The data parameter is a JSON object. The “products” property is the list of products items that was returned from the server response to the ajax request.
      $('#divNarrtors').html(data.hadiths);
    }
    $.ajax({
      type: 'POST',
      url: this.href, // Which url should be handle the ajax request. This is the url defined in the <a> html tag
      success: updateHadiths, // The js function that will be called upon success request
      dataType: 'json', //define the type of data that is going to get back from the server
      data: 'js=1'//Pass a key/value pair
    });
    return false;  // return false so the navigation stops here and not continue to the page in the link
}).addClass('Hadith-index');

  
}
