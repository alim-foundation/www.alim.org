$Id: README.txt,v 1.1.2.9 2009/05/10 16:51:54 mikeryan Exp $

OVERVIEW

The Table Wizard facilitates dealing with database tables:

* It allows surfacing any table in the Drupal default database through Views 2.
* Relationships between the tables it manages can be defined, so views 
  combining data in the tables can be constructed.
* It performs analysis of the tables it manages, reporting on empty fields, 
  data ranges, ranges of string lengths, etc.
* It provides an API for other modules to views-enable their tables.
* It provides an API for importing data into tables in the Drupal default 
  database (automatically doing the views integration above).
* It is bundled with an implementation of this API, for importing comma- and 
  tab-delimited files.

Applications of Table Wizard include:

* Module developers can use Table Wizard to views-enable their data tables 
  without writing their own Views hook.
* Developers and administrators can use Table Wizard to create views of all 
  tables in the database, whether or not their creators provided Views integration.
* Users could upload spreadsheets and apply Views to them.

INSTALLATION

Table Wizard requires the Schema and Views modules. In addition, you may need to 
install the following patches to support external tables (check to see if
these patches are in the Schema and Views versions you have installed):

Schema 1.3 or earlier: http://drupal.org/node/411538
Views 2.3 or earlier:  http://drupal.org/node/380560

For versions of Views up through at least 2.5, you need the patch at this location
to be able to create custom views for tables with more than 32 characters in their
name:

http://drupal.org/node/437070

USAGE

Please see the detailed documentation at http://drupal.org/node/452374

CREDITS

Table Wizard was developed by Cyrve (http://cyrve.com/).

Much of the initial development was sponsored by GenomeWeb (http://www.genomeweb.com/)
and The Economist (http://www.economist.com/).

The basis of the tw_import_delimited module was Node Import 
(http://drupal.org/project/node_import).
