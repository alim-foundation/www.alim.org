<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
 
 // For stylizing the dictionary page
 
 ?>
<?php foreach ($fields as $id => $field): ?>
<?php
if($id=='title')
{
    $title = $field->content;

}
if($id=='body')
{
  $meaning = $field->content;
}

?>

<?php endforeach; ?>

<?php

  $sub_title = substr($title,0,1);
  if(arg(3)==strtolower($sub_title))
  {
  	print "<div style='width:600px;padding:10px;'>";
    print "<div style='color:#810C05;font-weight:bold;padding-bottom:10px;'>".$title."</div>";
	print "<div style='padding-left:20px;'>".$meaning."</div>";
	print "</div>";
  }

 ?>