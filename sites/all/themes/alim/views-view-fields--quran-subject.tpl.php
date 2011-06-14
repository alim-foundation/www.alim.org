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
?>
<?php foreach ($fields as $id => $field): ?>
  <?php if (!empty($field->separator)): ?>
    <?php print $field->separator; ?>
  <?php endif; ?>

  <<?php print $field->inline_html;?> class="views-field-<?php print $field->class; ?>">
    <?php if ($field->label): ?>
      <label class="views-label-<?php print $field->class; ?>">
        <?php print $field->label; ?>:
      </label>
    <?php endif; ?>
      <?php
      // $field->element_type is either SPAN or DIV depending upon whether or not
      // the field is a 'block' element type or 'inline' element type.
      ?>
      <<?php print $field->element_type; ?> class="field-content">
	    <?php
			  if($id =='field_sub_number_value') {

/* $query = db_query("SELECT count(node_data_field_surah_no.field_surah_no_value) AS surah_count,
   FROM {node node} 
 LEFT JOIN content_field_sub_number node_data_field_sub_number ON node.vid = node_data_field_sub_number.vid
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 WHERE (node.type in ('quran_subject_location')) AND (node_data_field_sub_number.field_sub_number_value = 29)
   ORDER BY node_data_field_sub_number_field_sub_number_value ASC");
  $result = db_fetch_object($query);

     print_r($result);*/
	 
	  //embed quran subject text.
	  $viewName = 'quran_sub_subject';
	  print views_embed_view($viewName , $display_id = 'default', $field->content);
				 
/*  	print "(".$result->surah_count.")";*/
}
else
{
 print $field->content; 
 }
?>
	
	  
	  
	  </<?php print $field->element_type; ?>>
  </<?php print $field->inline_html;?>>
<?php endforeach; ?>
