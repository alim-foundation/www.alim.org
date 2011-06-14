<?php
 global $theme_path;
  global $base_url; 


// $Id: views-view-field.tpl.php,v 1.1 2008/05/16 22:22:32 merlinofchaos Exp $
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  * 
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php   $output; 
//print find_show_hide($output);
$val=find_show_hide($output);
if($val=="hide"){?>


<a href="<?php print $base_url ?>/comment/hide/<?php print $output; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><?php print $val; ?></a>
<?
}
else{ ?>

<a href="<?php print $base_url ?>/comment/unhide/<?php print $output; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><?php print "show"; ?></a>


<?
}

?>
