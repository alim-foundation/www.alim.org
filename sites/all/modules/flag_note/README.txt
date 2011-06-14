$Id: README.txt,v 1.1.2.6 2009/11/18 00:27:59 gunzip Exp $

Description
===========
Flag Note extends Flag Module to allow users to enter a note when they flag
a piece of content.

This is useful for example when you want to flag user as a friend/fan writing a hint
or when you want to flag nodes/comments for abuse providing a descriptive reason.

Moreover there's the possibility to keep old notes (even when the content gets unflagged),
building a flag history.

Installation
============
The only required modules are flag and views, install these first:

  http://drupal.org/project/flag
  http://drupal.org/project/views

If you want to enter notes through popups then install popups api:

  http://drupal.org/project/popups

Documentation
=============
To use it:

  * create a new flag or edit an old one (admin/build/flags/edit/[flag name])
  * select link type = 'Flag note form'
  * eventually choose 'Disable flag history' if you want to get rid of older flag notes

In the same administration form you can opt to keep old notes (flag history)
or delete them when unflagging. Once this settings are saved, a form (or a popup)
with a textfield will appear when users flag content.

Notes and their history are listed through views (adding a "Flag Note" relationship).
To list content associated notes ** YOU MUST CREATE A NEW VIEW **
(there are no predefined ones) with a Flag Note relationship.

You don't need to (and in fact, you should not) mix plain "Flag" relationships
with "Flag Note" relationships in views.

Go to admin/user/permissions to assign 'delete / edit notes' permissions to users.
By default only the admin can delete / edit flag notes.

'View notes' rights are implied by views access rights.

There's a new [flag-note] token when using this module with
flag_action (or/and rules) and if the token module is active.

Todo
====
Someday, only if there'll be demand for these ones:

  * provide default views ?
  * decouple history and notes
  * store notes when unflagging

Credits
=======
gunzip @ http://drupal.org/user/25151 (current mantainer)
pahariwalla @ http://drupal.org/user/70811 (project founder)
