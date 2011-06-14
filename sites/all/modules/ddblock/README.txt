// $Id: README.txt,v 1.4 2009/02/20 16:09:18 ppblaauw Exp $

Note: This is version RC5 of the module. Please test and review the module and post
your issues on the project page http://drupal.org/project/ddblock to help improve
the module.


SUMMARY
-------
The Dynamic display block module enables you to create blocks to present content
in a dynamic way. For creating slideshow effects it uses the jQuery Cycle plug-in.

There are four ways to specify content for the Dynamic display block module:

* A folder containing image files
* A node from a content type with multiple input
* CCK and Views
* An instance of any created block

The headerimage module or CCK and Views makes retrieving and displaying content with
the Dynamic display block module very flexible.

Several effects and other setting can be set in the configuration settings of the
Dynamic display block module.


MORE INFORMATION
----------------
You can find more information in the handbook pages on Drupal.org
http://drupal.org/node/293714

Other tutorials can be found on http://ddblock.myalbums.biz
Basic tutorial: http://ddblock.myalbums.biz/tutorial
Advanced slideshow tutorial: http://ddblock.myalbums.biz/node/747

Frequenly asked questions on http://ddblock.myalbums.biz/faq

You can see a demo of the module at http://ddblock.myalbums.biz/


REQUIREMENTS
------------
jQuery-update module.

Note: Drupal 6.3 already has the jQuery 1.2.6., but still we prefer to install
      jQuery update module for future versions of jQuery. (soon 1.3.x)

See INSTALL.txt


INSTALLATION
------------
See INSTALL.txt


COLLABORATION WITH OTHER MODULES
--------------------------------
The dynamic display block module can work together with all modules that provide
blocks. The content of the block can be displayed dynamically (one by one width
transition effects) if the content consist of e.g. Images, A list of listitems,
A table with tablerows, etc.

Example modules and blocks you can use

Module       - blocks
---------------------
Headerimage  - blocks with images
Comments     - Recent comments
Forum        - Active forum topics
Forum        - New forum topics
CCK          - Content types
Views        - blocks with images, lists, tables
Worldclock   - World clock
etc.

* Set the blocks you want to use with the dynamic display block module in
  Administer >> Site configuration >> Dynamic display block - Settings tab.

* Make an instance of the block you want to use in Administer >> Site
  configuration >> Dynamic display block - Instance tab.

* Configure the block in Administer >> Site configuration >> Dynamic display
  block - List tab.

  Dont forget to set the Container value to the tag you want to show

* Add the block to a region in in Administer >> Site Building >> Blocks.

CONFIGURATION
-------------
* Configure user permissions in Administer >> User management >> Permissions
  >> ddblock module:

  - administer dynamic display blocks:

  - view dynamic display blocks:

* Customize module settings in Administer >> Site configuration >> Dynamic
  display block.

  - Create a dynamic display block and configure the block (leave all default settings).

  - Place some pictures in the /files/images/ddblock folder (.jpg, .gif or .png) files.

  - Navigate to Administer > Site building > Blocks

  - Place the block in one of the regions of your Site.

* Settings:

Input type: Which content to use with the dynamic display block

Image folder settings:

 - Image Folder: The folder containing image files to be used as the content of
   dynamic display block. Use a relative path. The default is files/images/ddblock

 - Number of images: The number of images to show in the block.

Content type settings:

 - Content Type: The nodes of the content type to be used as content of dynamic display
   block.

 - Node: The node to show in the Dynamic display block.

Content container settings:

 - Content container: Container of the content to show, eg. img, to show images.

 - Height: Height of the content to show.

 - Width: Width of the content to show.

Image settings:

 - Height: Height of the image to show.

 - Width: Width of the image to show.

Settings:

 - Transition Effect: The transition effect between content.

 - Speed: Speed of the transitions (1000 = 1 second).

 - Timeout: The time (in Milliseconds) between transitions (1000 = 1 second, 0 to
   disable auto advance).

 - Sort Order: The display order of the content.

 - Pause: Enable users to pause the cycle by hovering on the content.

 - Next: Enable users to advanced to the next content by clicking on the content.

 - Pager: Add a number pager or an image pager to a dynamic display block.
          You can only add a image pager if your use images from an image folder.

 - Pager_height: Height of the pager.

 - Pager_width: Width of the pager.

Custom Settings:

 - Custom Options: Add or override custom options for the cycle plug-in.
                   The settings transition effect, container and pager from
                   the settings are used, but can be overriden.

ADVANCED SLIDESHOWS
-------------------
See the Advanced slideshow tutorial on http://ddblock.myalbums.biz/node/747 for a
tutorial how to make advanced slideshows.

TROUBLESHOOTING
---------------
* If a dynamic display block is not displayed, check the following steps:

  - Is the 'view dynamic display blocks' permission enabled?
  - Did you put the block in one of the regions?

  Also have a look in the FAQ


FAQ
---
For Frequently Asked Questions - http://ddblock.myalbums.biz/faq


CONTACT
-------
Original idea cycle module by roopletheme - http://drupal.org/user/164625

Major rewrite by current Maintainers:
* Philip Blaauw (ppblaauw) - http://drupal.org/user/155138
* Iren T. Biasong (iren_cruz) - http://drupal.org/user/305000

We also offer installation, development, theming, customization.
You can contact us via the contact form on http://ddblock.myalbums.biz.
or via email to ppblaauw (at) gmail.com