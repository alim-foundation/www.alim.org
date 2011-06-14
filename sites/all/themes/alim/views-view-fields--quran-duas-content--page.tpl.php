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
  
    // Build Breadcrumbs
$breadcrumb = array();
$breadcrumb[] = l('Home', '<front>');
$breadcrumb[] = l('Qur\'an & Hadith', '<front>');
$breadcrumb[] = l('Qur\'an', '<front>');
$breadcrumb[] = l('Duas from the Al-Qur\'an', $base_url.'/library/quran/duas');
$breadcrumb[] = l(drupal_get_title(),  $base_url.'/library/quran/duas/content/'.arg(4)); // Link to current URL

// Set Breadcrumbs
drupal_set_breadcrumb($breadcrumb);
?>
<?php foreach ($fields as $id => $field): ?>
  <?php if($id == "field_quran_bk_code_value" ) $bk_code = $field->content; ?>
  <?php if($id == "field_surah_no_value" ) $sur_no = $field->content; ?>
  <?php if($id == "field_dua_start_aya_value" ) $str_aya = $field->content; ?>
  <?php if($id == "field_dua_end_aya_value" ) $end_aya = $field->content; ?>



<?php endforeach; ?>


<?php if($bk_code=='ARB')
{
	for($i=$str_aya;$i<=$end_aya;$i++)
	{
	  $viewName = 'arabic_text';
      $view_12 = views_get_view($viewName);
      $view_12->set_display('default');
      $view_12->set_arguments(array($sur_no, $i, 'ARB'));
      $view_12->execute();
      $result_12 = $view_12->result;
      $output1 = $result_12[0]->node_revisions_body;
	  
      $view_11 = views_get_view($viewName);
      $view_11->set_display('default');
      $view_11->set_arguments(array($sur_no, 1, 'ARB'));
      $view_11->execute();
      $result_11 = $view_11->result;
      if($sur_no!=1)
      {
   		$exp = explode($result_11[0]->node_revisions_body,$output1);
	 	if($exp[1]!="")
	 	{
	 					
			  if(eregi("chrome", $_SERVER['HTTP_USER_AGENT'])) 
			   {
					$text = wordwrap(strip_tags($exp[1]), 20, "\n", true);
			   }
				else
			   {
					$text = strip_tags($exp[1]);
			   }
	 	}
		 else
	 	{
	  	  	  if(eregi("chrome", $_SERVER['HTTP_USER_AGENT'])) 
			   {
					$text = wordwrap(strip_tags($output1), 20, "\n", true);
			   }
			   else
			   {
					$text = strip_tags($output1);
				}
		 
		 
	 	}
	  }
  	 else
     {
       	  if(eregi("chrome", $_SERVER['HTTP_USER_AGENT'])) 
			   {
					$text = wordwrap(strip_tags($output1), 20, "\n", true);
			   }
			   else
			   {
					$text = strip_tags($output1);
				}
     }
	  
	  print "<div class='arabic_text_style' align='right' style='float:left;width:550px'>".$text."</div><div style='float:left'>&nbsp;&nbsp;<a href='".$base_url."/library/quran/ayah/compare/".$sur_no."/".$i."' style='text-decoration:underline;font-size:12px;'>".$sur_no.".".$i."</a></div><div style='clear:both'></div><br>";
	  
	}
}
else
{

	for($i=$str_aya;$i<=$end_aya;$i++)
	{
	   $viewName = 'arabic_text';
      $view_12 = views_get_view($viewName);
      $view_12->set_display('default');
      $view_12->set_arguments(array($sur_no, $i, 'YAT'));
      $view_12->execute();
      $result_12 = $view_12->result;
      $output1 = $result_12[0]->node_revisions_body;
	  
      $view_11 = views_get_view($viewName);
      $view_11->set_display('default');
      $view_11->set_arguments(array($sur_no, 1, 'YAT'));
      $view_11->execute();
      $result_11 = $view_11->result;
      if($sur_no!=1)
      {
   		$exp = explode($result_11[0]->node_revisions_body,$output1);
	 	if($exp[1]!="")
	 	{
	 		$text = $exp[1];
	 	}
		 else
	 	{
	  	 $text = $output1;
	 	}
	  }
  	 else
     {
       $text = $output1;
     }
	  
	  print "<div style='float:left' align='left' ><a href='".$base_url."/library/quran/ayah/compare/".$sur_no."/".$i."' style='text-decoration:underline;font-size:12px;'>".$sur_no.".".$i."</a>&nbsp;&nbsp;</div><div style='width:550px;float:left' align='left' >".$text."</div><div style='clear:both'></div><br>";
	}
	echo "<div style='border-bottom:1px solid #DEDEDC;width:600px;'></div><br>";
}

?>