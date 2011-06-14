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
 
 // Alter the structure of Fiq Sunnah
 
?>
<?php foreach ($fields as $id => $field): ?>
 <?php if($id == "field_fq_vol_value" ) $vol = $field->content; ?>
 <?php if($id == "field_fq_num_value" ) $num = $field->content; ?>
 <?php if($id == "field_fq_subnum_value" ) $subnum = $field->content; ?>
  <?php if($id == "field_fq_sec_head_value" ) $sechead = $field->content; ?>
   <?php if($id == "body" ) $content = $field->content; ?>
 
<?php endforeach; ?>
<?php
$head = $vol.".".$num;
if($subnum!=1)
 $head .= $subnum;
?>

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><b><?=$head?></b></td>
  </tr>
  <tr>
    <td class="views-field-field-fq-sec-head-value" align="left" width="100" valign="top"><?=$sechead?></td>
    <td align="left" valign="top"><?=$content?></td>
  </tr>
</table>

