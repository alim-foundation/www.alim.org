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
  
   global $base_url;
   global $theme_path;
   
   // Listing the hadith based on each subject
?>
<?php print "<h2>".$output."</h2>"; ?>
<?php

// Query the subtopics
$query2 = db_query("SELECT node.nid AS nid,
   node_data_field_hd_topic.field_hd_subtopic_value AS node_data_field_hd_topic_field_hd_subtopic_value,
   node.type AS node_type,
   node.vid AS node_vid
 FROM node node 
 LEFT JOIN content_field_hd_book_code node_data_field_hd_book_code ON node.vid = node_data_field_hd_book_code.vid
 LEFT JOIN content_type_hadith_subject node_data_field_hd_topic ON node.vid = node_data_field_hd_topic.vid
 WHERE (node.type in ('hadith_subject')) AND (node_data_field_hd_book_code.field_hd_book_code_value = 'FQS') AND (node_data_field_hd_topic.field_hd_topic_value = '".addslashes($output)."')");
 
 
 while($result442 = db_fetch_object($query2))
 {
 	

	if($result442->node_data_field_hd_topic_field_hd_subtopic_value!="")
	{
	
	// lists the subtopics 
	print "<div style='color:#810C05' >".$result442->node_data_field_hd_topic_field_hd_subtopic_value."</div><br />";
	
	// query the hadiths
	$query3 = db_query("SELECT node.nid AS nid,
   node.title AS node_title,
   node_data_field_hd_vol_number.field_hd_vol_number_value AS node_data_field_hd_vol_number_field_hd_vol_number_value,
   node.type AS node_type,
   node.vid AS node_vid,
   node_data_field_hd_number.field_hd_number_value AS node_data_field_hd_number_field_hd_number_value
 FROM node node 
 LEFT JOIN content_type_hadith_subject node_data_field_hd_subtopic ON node.vid = node_data_field_hd_subtopic.vid
 LEFT JOIN content_field_hd_vol_number node_data_field_hd_vol_number ON node.vid = node_data_field_hd_vol_number.vid
 LEFT JOIN content_field_hd_number node_data_field_hd_number ON node.vid = node_data_field_hd_number.vid
 WHERE (node.type in ('hadith_subject')) AND (node_data_field_hd_subtopic.field_hd_subtopic_value = '".addslashes($result442->node_data_field_hd_topic_field_hd_subtopic_value)."')");
 
     // lists the hadiths.
	  while($result44 = db_fetch_object($query3))
	 {
	  
	    print "<div id='' >&nbsp;&nbsp;&nbsp;";
		
								
					$url = $base_url."/library/hadith/fiq/FQS/".$result44->node_data_field_hd_vol_number_field_hd_vol_number_value."/".$result44->node_data_field_hd_number_field_hd_number_value; 
							
								
		  print "<a href='".$url."' style='text-decoration:underline' >".$result44->node_title."</a>";
		  
	
		print "</div>";
       }
	 print "<br />";
	 }
       
 }

?>