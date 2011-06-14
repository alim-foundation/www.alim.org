<?php
// $Id: views-slideshow-ddblock.tpl.php,v 1.2 2010/03/21 09:24:07 ppblaauw Exp $

/*
 * @file
 * Views Slideshow Dynamic display block module template
 *
 */
?>
<!-- dynamic display block slideshow -->
<p>This preview does just show the node titles of the nodes which will be shown in the slideshow</p>
<?php foreach ($view->result as $row): ?>
  <?php print $row->node_title; ?>
  <br />
<?php endforeach; ?>
