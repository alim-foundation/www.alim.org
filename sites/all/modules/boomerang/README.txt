Drupal Boomerang module:
-----------------------
Author - Matt Vance (mvance at pobox dot com)
Requires - Drupal 6


Overview:
--------
This module integrates a Javascript program called Boomerang with Drupal.
According to the documentation (http://yahoo.github.com/boomerang/doc/),
Boomerang "measures the performance of your website from your end user's point
of view."

 * Boomerang on github: http://github.com/yahoo/boomerang/ 

This module requires that the Libraries API module
(http://drupal.org/project/libraries) be installed. The Views module is also
supported, though not required.

Installation:
------------
1) Download the Libraries module and Boomerange module files into your 'modules'
directory (usually /sites/all/modules)

2) Download the Boomerang project files into your 'libraries' directory (usually
/sites/all/libraries). Visit the github page above for download links and be
sure to rename the resulting directory to "boomerang". Alternatively, Drush
users can use the command "drush boomerang-plugin".

3) On the Administer > Site building > Modules page, enable the Boomerang
module.

Configuration:
-------------
Currently, no configuration options are available. 

Contributions:
-------------
* This module would not be possible without the Boomerang script itself. Thanks
to Philip Tellis for making it available.
* Integration with the Libraries API module is largely based on code in the
following blog post:
http://engineeredweb.com/blog/10/5/3-tips-using-external-libraries-drupal

Last updated:
------------
