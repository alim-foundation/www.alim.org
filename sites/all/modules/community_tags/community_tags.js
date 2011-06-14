// $Id: community_tags.js,v 1.4.2.5 2009/09/15 04:04:11 entrigan Exp $

Drupal.communityTags = {};

Drupal.communityTags.checkPlain = function (text) {
  text = Drupal.checkPlain(text);
  return text.replace(/^\s+/g, '')
             .replace(/\s+$/g, '')
             .replace('\n', '<br />');
}

Drupal.serialize = function (data, prefix) {
  prefix = prefix || '';
  var out = '';
  for (i in data) {
    var name = prefix.length ? (prefix +'[' + i +']') : i;
    if (out.length) out += '&';
    if (typeof data[i] == 'object') {
      out += Drupal.serialize(data[i], name);
    }
    else {
      out += name +'=';
      out += Drupal.encodeURIComponent(data[i]);
    }
  }
  return out;
}

Drupal.behaviors.communityTags = function(context) {
  // Note: all tag fields are autocompleted, and have already been initialized at this point.
  $('input.form-tags', context).each(function () {
      // Hide submit buttons.
      $('input[type=submit]', this.form).hide();

      // Fetch settings.
      var nid = $('input[name=nid]', this.form).val();
      var o = Drupal.settings.communityTags['n_' + nid];

      var sequence = 0;

      // Show the textfield and empty its value.
      var textfield = $(this).val('').css('display', 'inline');

      // Prepare the add Ajax handler and add the button.
      var addHandler = function () {
		  $('#community-tags-form').hide();
		  // Added this line to original file To reload page
		$('#community-tags-form').parent().append('<div style="background:#E9E9E9;width:200px;height:10px;float:left;padding:20px;margin:10px;" ><b>Loading .. Please wait</b></div>');
		$('#hidden-tag input[type=hidden]').val(textfield[0].value); // Added this line to original file Set a hidden field value to tag value to add the value to tags .
        // Send existing tags and new tag string.
        $.post(o.url, Drupal.serialize({ sequence: ++sequence, tags: o.tags, add: textfield[0].value }), function (data) {
          data = Drupal.parseJson(data);
          if (data.status && sequence == data.sequence) {
            o.tags = data.tags;
            updateList();
			location.reload();// Added this line to original file To reload page after adding tag using ajax widget
          }
        });

        // Add tag to local list
        o.tags.push(textfield[0].value);
        o.tags.sort(function (a,b) { a = a.toLowerCase(); b = b.toLowerCase(); return (a>b) ? 1 : (a<b) ? -1 : 0; });
        updateList();
        
        // Clear field and focus it.
        textfield.val('').focus();
      };
      var button = $('<input type="button" class="form-button" value="'+ Drupal.communityTags.checkPlain(o.add) +'" />').click(addHandler);
      $(this.form).submit(function () { addHandler(); return false; });

      // Prepare the delete Ajax handler.
      var deleteHandler = function () {
        // Remove tag from local list.
		// Added this line to original file To reload page after adding tag using ajax widget
		$('#community-tags-form').hide();
				$('#community-tags-form').parent().append('<div style="background:#E9E9E9;width:200px;height:10px;float:left;padding:20px;margin:10px;" ><b>Loading .. Please wait</b></div>');
        var i = $(this).attr('key');
        o.tags.splice(i, 1);
        updateList();

        // Send new tag list.
        $.post(o.url, Drupal.serialize({ sequence: ++sequence, tags: o.tags, add: '' }), function (data) {
          data = Drupal.parseJson(data);
          if (data.status && sequence == data.sequence) {
            o.tags = data.tags;
            updateList();
			location.reload();// Added this line to original file To reload page after adding tag using ajax widget
          }
        });

        // Clear textfield and focus it.
        textfield.val('').focus();
      };

      // Callback to update the tag list.
      function updateList() {
        list.empty();
        for (i in o.tags) {
          list.append('<li key="'+ Drupal.communityTags.checkPlain(i) +'">'+ Drupal.communityTags.checkPlain(o.tags[i]) +'</li>');
        }
        $('li', list).click(deleteHandler);
      }

      // Create widget markup.
      // @todo theme this.
      var widget = $('<div class="tag-widget"><ul class="inline-tags clear-block"></ul></div>');
      textfield.before(widget);
      widget.append(textfield).append(button);
      var list = $('ul', widget);

      updateList();
  });
}