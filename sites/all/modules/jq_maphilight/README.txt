jQuery Map Hilight Module


-------------------------
Description
-------------------------
jQuery Map Hilight is a javascript wrapper module for the jquery Map Hilight plugin. It enables the simple addition
of mouseover highlighting of hotspots to HTML image maps without requiring the editing of theme files or knowledge
of javascript/jquery.


-------------------------
Installation Instructions
-------------------------

PREREQUISITES: 

1. This module requires the jquery_plugin module (with the included metadata plugin) for D6. Be sure to download 
and install it first.

2. This module requires the jQuery Map Hilight plugin (v1.1.2 minimum) from http://plugins.jquery.com/project/maphilight.


INSTALLATION:

1. Download and install the jquery_plugin module from http://drupal.org/project/jquery_plugin.

2. Download the jquery Map Hilight plugin from http://plugins.jquery.com/project/maphilight.

3. Extract the jquery.maphilight.min.js file into the jq_maphilight directory (the module will also search
   'sites/all/libraries/jquery.maphilight' and jquery_plugin module directory as well). It will also check
   for and use the libraries module if enabled.

4. Navigate to admin/settings/jq_maphilight. If the plugin is properly installed you should see a message
   indicating the path where it has been found in the "jQuery Map Hilight Plugin Status" fieldset.

5. If desired, follow the instructions for the Test Page below to test the functionality of the module and plugin.


-------------------------
USAGE
-------------------------

1. Set sitewide options as desired in the jQuery Map Hilight Plugin Settings (admin/settings/jq_maphilight).

2. Select whether you want to highlight all image maps automatically (the default setting) use class="jq_maphilight" 
on the <img> tag of any image maps you wish to be highlighted.

3. Override any of the sitewide options specified on the admin page by including an additional class on the image
tag (along with the jq_maphilight class) with the following format: {option:value,option:value}

   Available Options:
     fill (Boolean, true/false) - Whether to fill the shape
     fillColor (String, HTML color notation without the # & with single quotes) - The color to fill the shape with
     fillOpacity (Number, 0 - 1) - The opacity of the fill (0 = fully transparent, 1 = fully opaque)
     stroke (Boolean, true/false) -  Whether to outline the shape
     strokeColor (String, HTML color notation without the # & with single quotes) - The color of the outline
     strokeOpacity (Number, 0 - 1) - The opacity of the outline (0 = fully transparent, 1 = fully opaque)
     strokeWidth (Number) - The thickness of the outline
     fade (Boolean, true/false) - Whether to fade in the shapes on mouseover
 
   Example: {fill:false,strokeColor:'FFFFFF'}
 
-------------------------
Compatibility Notes
-------------------------

For image module compatibility see http://drupal.org/node/495126#comment-1722882.


-------------------------
SUPPORT
-------------------------

For support, please submit requests via the project issues queue at: http://drupal.org/project/issues/jq_maphilight


-------------------------
Test Page
-------------------------

Copy the sample.png image from the jq_maphilight module directory to wherever you keep your images. Then copy the
following code into the body of a page (be sure to update the image href location & set the Input Format to
Full HTML or add the MAP and AREA tags to the allowed tags for filtered html). Hover the mouse over the boxes
to see the highlighting in action.
<-------------------------------------BEGIN---COPY---BELOW--------------------------------------------------->
<p><strong>This is a sample image map with jquery based javascript hilighting:</strong></p>
<p>&nbsp;</p>
<img class="{strokeColor:'000000',strokeWidth: 5}" src="/sites/default/files/images/sample.png" usemap="#imagemap" border="0" />
<map name="imagemap">
<area href="/" shape="RECT" coords="168,71,312,143" title="Box #1" />
<area href="/" shape="RECT" coords="72,167,168,216" title="Box #2" />
<area href="/" shape="RECT" coords="193,167,289,216" title="Box #3" />
<area href="/" shape="RECT" coords="313,169,409,217" title="Box #4" />
<area href="/" shape="RECT" coords="73,240,169,290" title="Box #5" />
<area href="/" shape="RECT" coords="193,240,288,288" title="Box #6" />
<area href="/" shape="RECT" coords="313,240,409,289" title="Box #7" />
</map>