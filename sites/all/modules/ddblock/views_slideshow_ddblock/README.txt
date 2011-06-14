// $Id: README.txt,v 1.2 2010/03/21 09:24:07 ppblaauw Exp $

Views Slideshow: ddblock
-------

SUMMARY
-------
The Views Slideshow Dynamic display block module enables you to present content in a 
dynamic way. For creating slideshow effects it uses the jQuery Cycle plug-in.

Several effects and other setting can be set in the configuration settings of the Views
Slideshow Dynamic display block module.

REQUIREMENTS
------------
The views_slideshow and views modules are required to run the module
CCK, Imagefield, ImageAPI, Filefield, Imagacache are recommended to use the functionality.
Also emfield or video can be used to show videos in a views_slideshow_ddblock slideshow

* jQuery easing plug-in (optional) <http://plugins.jquery.com/files/jquery.easing.1.1.1.js>
  This jQuery plug-in is not included in the Drupal distribution because it is not licensed
  under GPL which is required by Drupal.

INSTALLATION
------------
1. Please install required module first.
2. Extract the contents of the project into your modules directory, probably at
   /sites/all/modules/views_slideshow_ddblock.
3. Create a new View with images, slidetext, pagertext, using 'Slideshow' for the
   'Style', and 'ddblock' for the 'Slideshow mode' when configuring the style.

JQUERY EASING PLUG-IN INSTALLATION
----------------------------------
1. Download version 1.1.1 at http://plugins.jquery.com/project/Easing.
2. Copy jquery.easing.1.1.1.js to sites/all/modules/views_slideshow_ddblock.
3. Uncomment line 300 in the views_slideshow_ddblock.module file like below
      //add easing plugin
      drupal_add_js($path .'/js/jquery.easing.1.1.1.js', 'module');

STEPS TO CREATE A FIRST SLIDESHOW AFTER INSTALLATION OF THE MODULES
-------------------------------------------------------------------
1. Install the vsd-upright10-60 views_slideshow_ddblock themes
2. Import the news item content type
3. Import the news items view
4. Create at least two nodes
5. Add preprocess functions to your template.php file
6. Change the [**THEME_NAME***] in the preprocess functions to the theme you use
7. Change viewname and fieldnames if needed
      
VIEWS SLIDESHOW DYNAMIC DISPLAY BLOCK THEMES
--------------------------------------------
The views_slideshow_ddblock module comes with several free themes, other commercial themes
will also be available in the future. (have a look at themes.myalbums.biz for examples of
commercial themes for the ddblock module which will also become available for
the views_slideshow_ddblock module).

You can download the free themes from http://ddblock.myalbums.biz/download

* Download the theme package (vsd-upright10-60.zip) from http://ddblock.myalbums.biz/download
  Make sure you use the theme package for views_slideshow_ddblock version 1.0

* Extract the zip file to a temporary directory

* Copy the custom directory with all subdirectories to the theme directory of the
  theme you use. (which is probably at sites/all/themes/[YOUR_THEME_NAME])

EXPORT PACKAGE
--------------
* Download the export package (vsd_export_files.zip) from http://ddblock.myalbums.biz/download

DDBLOCK EXAMPLE CONTENT TYPE AND VIEW
-------------------------------------
You can use the News item content type export, to import the News item content type
into your Drupal installation.

Note:

You need to have CCK, imageapi, filefield and imagefield installed and enabled on
your Drupal installation, otherwise the import will not be successful.

You can use the News items views export, to import the News items views block
into your Drupal installation.

VIEWS_SLIDESHOW_DDBLOCK PREPROCESS FUNCTIONS INSTALLATION
-----------------------------------------
* The preprocess functions are included in the export package

* Copy the preprocess functions to your template.php file in your theme

* Rename [THEME_NAME] to the name of your theme for both preprocess functions

* Change the view_name in both preprocess functions if your view has another name
  then: news_items

* Change the fields to convert if you have other fieldnames in your view

Note: You can see the view_name and the available view_fields when you choose one of the
debug options in the views_slideshow_ddblock configuration page.

DOCUMENTATION
-------------
Documentation made for the views slideshow dynamic display block module can be found at:
http://ddblock.myalbums.biz/node/970

SUPPORT
-------
Support for the dynamic display block slideshow module is given on a daily basis. 
The issue queue of the module is the preferred place to post: support requests, 
feature request and bugs. Please give detailed descriptions of your issues, 
so we can help you better. 
Searching the issue queue (search on all issue) and the FAQ can give you direct answers.

CONTACT
-------
* Philip Blaauw (ppblaauw) - http://drupal.org/user/155138

We also offer installation, development, theming, customization.
You can contact us via the contact form on http://ddblock.myalbums.biz.
or via email to ppblaauw (at) gmail.com
