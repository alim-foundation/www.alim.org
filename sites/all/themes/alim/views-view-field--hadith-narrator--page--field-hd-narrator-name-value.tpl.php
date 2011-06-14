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
  
  // Lists the narrators, when click on the Narrtor link of each hadith apge.
  
?>
<h2>
<?php print $output; //Narrator Name ?>
</h2>

<?php
// Query the hadiths of corresponding narrator
$query3 = db_query("SELECT node.nid AS nid,
   node_data_field_hd_vol_number.field_hd_vol_number_value AS node_data_field_hd_vol_number_field_hd_vol_number_value,
   node.type AS node_type,
   node.vid AS node_vid,
   node_data_field_hd_book_code.field_hd_book_code_value AS node_data_field_hd_book_code_field_hd_book_code_value,
   node_data_field_hd_number.field_hd_number_value AS node_data_field_hd_number_field_hd_number_value
 FROM node node 
 LEFT JOIN content_type_hadith_content node_data_field_hd_narrator_name ON node.vid = node_data_field_hd_narrator_name.vid
 LEFT JOIN content_field_hd_vol_number node_data_field_hd_vol_number ON node.vid = node_data_field_hd_vol_number.vid
 LEFT JOIN content_field_hd_book_code node_data_field_hd_book_code ON node.vid = node_data_field_hd_book_code.vid
 LEFT JOIN content_field_hd_number node_data_field_hd_number ON node.vid = node_data_field_hd_number.vid
 WHERE (node.type in ('hadith_content')) AND (node_data_field_hd_narrator_name.field_hd_narrator_name_value = '".addslashes($output)."')");

  
  // Lists the hadiths.
 
  while($result44 = db_fetch_object($query3))
  {
 	  print "<div id='' >&nbsp;&nbsp;&nbsp;";
	  
	 		
			                $view_url1= views_get_view('Hadith_Title');
							$view_url1->set_display('default');
							if($result44->node_data_field_hd_vol_number_field_hd_vol_number_value!="")
							{
							$view_url1->set_arguments(array($result44->node_data_field_hd_book_code_field_hd_book_code_value,$result44->node_data_field_hd_number_field_hd_number_value,$result44->node_data_field_hd_vol_number_field_hd_vol_number_value));
							}
							else
							{
								$view_url1->set_arguments(array($result44->node_data_field_hd_book_code_field_hd_book_code_value,$result44->node_data_field_hd_number_field_hd_number_value));
							}
							$view_url1->execute();
							$viewresult1 = $view_url1->result;
								
							$url = $base_url."/library/hadith/".$viewresult1[0]->node_data_field_hd_book_code_field_hd_book_code_value."/".$viewresult1[0]->node_data_field_hd_number_field_hd_number_value; 
							if($viewresult1[0]->node_data_field_hd_vol_number_field_hd_vol_number_value!="")
							{
								$url .= "/".$viewresult1[0]->node_data_field_hd_vol_number_field_hd_vol_number_value;
							}
								
		  print "<a href='".$url."' style='text-decoration:underline' >".$viewresult1[0]->node_title."</a>";

		print "</div>";
 }

?>