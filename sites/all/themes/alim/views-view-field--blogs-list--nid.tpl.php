<?php
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
<?php
 global $theme_path;
  global $base_url; 


		 	$qry = "SELECT count(*) FROM {comments} where nid=$output";
	$num = db_result(db_query(db_rewrite_sql($qry)));



?>


<?php // print $output; ?>
<span id="total_comments" style=" margin-bottom: 5px; float:left;">
<span id="bracket" style="color: rgb(204, 204, 204);">{ </span>
<span style=" font-size:16px;font-weight: bold">
<?php 
print $num ;
?>
</span>
Comments  
<span id="bracket" style="color:#cccccc">} </span>  
<?php /*?>Since<span style="color:#009966; font-weight:bold"> <?php print date("F  d , Y");?></span>
<?php */?></span>
<br/>
