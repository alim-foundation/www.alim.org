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
?>
<?php if(arg(5)==1)
{
	$query_pub1 =  db_query("SELECT node.nid AS nid,
   term_data.name AS term_data_name,
   term_data.vid AS term_data_vid,
   term_data.tid AS term_data_tid
 FROM node node 
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 LEFT JOIN term_node term_node ON node.vid = term_node.vid
 LEFT JOIN term_data term_data ON term_node.tid = term_data.tid
 WHERE (node.type in ('quran_surah_overview')) AND (node_data_field_surah_no.field_surah_no_value = '".arg(4)."')");
 			$result = db_fetch_object($query_pub1);
			
			$Surah_Name=$result->term_data_name; 
?>
<br />
<div class="prev_intro" style=" float:right;color: #060;"><a href="<?=$base_url.'/library/quran/AlQuran-tafsir/TIK/'.arg(4).'/0'?>" ><b>View Introduction to <?= $Surah_Name ?></b></a></div>
<br />
<?php }?>
<?php print $output; ?>