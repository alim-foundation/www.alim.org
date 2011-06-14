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
 global $base_url;
 global $theme_path;
 
    // For altering the layout of home page header Block.
?>
<?php foreach ($fields as $id => $field): ?>
<?php
if($id=="title")  $title = $field->content;
if($id=="body")  $body = $field->content;
if($id=="field_splash_header_image_fid")  $image = $field->content;
if($id="field_read_more_value") $field_read_more_value = $field->content;
?>
 
<?php endforeach; ?>
<table width="870" border="0" cellspacing="0" cellpadding="0" class="head_table">
  <tr>
    <td valign="top" width="430" >
	 <?=$image?>
	  	</td>
    <td valign="top"  style="padding-top:10px;" align="left">   
	 	<h1><?=$title?></h1>
					   <div class="spl_text_head">
	<?=$body?><div class="read_more" align="right"><img src='<?php print $base_url."/".$theme_path;?>/images/hand.png'  />&nbsp;&nbsp;<a href='<?=$base_url?>/<?=$field_read_more_value?>'>Start using The Alim</a></div>
	</div>
					   </div></td>
  </tr>
</table>


					  
