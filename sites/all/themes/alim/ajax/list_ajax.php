<?php
require_once('../../../../default/settings.php');
if($_GET['m']==1)
{
  
  $surano = $_GET['id'];

  
 			$query5 = db_query("SELECT node.nid AS nid,
   node_data_field_page_no.field_page_no_value AS node_data_field_page_no_field_page_no_value,
   node.type AS node_type,
   node.vid AS node_vid
 FROM node node 
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 LEFT JOIN content_type_quran_arabic_page node_data_field_page_no ON node.vid = node_data_field_page_no.vid
 WHERE (node.type in ('quran_arabic_page')) AND (node_data_field_surah_no.field_surah_no_value = ".$surano.")
   ORDER BY node_data_field_page_no_field_page_no_value ASC");
						   
			$result5= db_fetch_object($query5);
			echo $curr_page = $result5->node_data_field_page_no_field_page_no_value;
						   
		
						   
						   
  exit;
}

?>