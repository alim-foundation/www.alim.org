http://drupal.org/node/386240
http://drupal.org/files/issues/popup-ajax-pager.diff

Index: popups.js
===================================================================
RCS file: /cvsroot/proj-www/modules/popups/popups.js,v
retrieving revision 1.1
diff -u -r1.1 popups.js
--- popups.js	18 Feb 2009 18:47:20 -0000	1.1
+++ popups.js	2 Mar 2009 17:04:32 -0000
@@ -74,10 +74,10 @@
       var element = this;
 
       // If element is inside of a #popup div, show alert and bail out. 
-      if ($(element).parents('#popups').length) { 
-        alert("Sorry, popup chaining is not supported (yet).");
-        return false;
-      }
+//      if ($(element).parents('#popups').length) { 
+//        alert("Sorry, popup chaining is not supported (yet).");
+//        return false;
+//      }
 
       // If the element contains a on-popups-options attribute, use it instead of options param.
       if ($(element).attr('on-popups-options')) {
@@ -110,13 +110,25 @@
  */
 Drupal.popups.open = function(title, body, buttons, width) {
   Drupal.popups.addOverlay(); // TODO - nonModal option.
-  var $popups = $(Drupal.theme('popupDialog', title, body, buttons));
-  // Start with dialog off the side. Making it invisible causes flash in FF2.
-  $popups.css('left', '-9999px');
-  if (width) {
-    $popups.css('width', width);
+
+  // if there's a popup on the page, replace the contents
+  if ($('#popups').length) {
+	  $('#popups-body').html(body);
+	   this.refocus(); // TODO: capture the focus when it leaves the dialog.
+	   Drupal.popups.removeLoading(); // Remove the loading img.
+	   $('#popups-close').click( Drupal.popups.close );
+	   $('a.popups-close').click( Drupal.popups.close );	   
+	   return false;
+  }
+  else { 
+	  var $popups = $(Drupal.theme('popupDialog', title, body, buttons));
+	  // Start with dialog off the side. Making it invisible causes flash in FF2.
+	  $popups.css('left', '-9999px');
+	  if (width) {
+	    $popups.css('width', width);
+	  }	  
+	  $('body').append( $popups ); // Add the popups to the DOM.
   }
-  $('body').append( $popups ); // Add the popups to the DOM.
 
   // Adding button functions
   if (buttons) {
   
   
   
   
   
   
   
   
   
   
   
   
   
   /////////////////////////////
   http://drupal.org/node/528342
   
   
   --- popups.js	2009-03-20 17:57:15.000000000 -0700
+++ popups-new.js	2009-07-23 11:47:54.000000000 -0700
@@ -512,6 +512,10 @@ Popups.resizeAndCenter = function(popup)
  *  Create and show a simple popup dialog that functions like the browser's alert box.
  */
 Popups.message = function(title, message) {
+  if (!message) {
+    message = title;
+    title = '';    
+  }  
   message = message || '';
   var popup = new Popups.Popup();
   var buttons = {
