<?php
// For adding theme to translation page.
 global $base_url;
 global $user;
 
 
 	$select_ayah = 1;
$expire=time()+(60*60*24*365*5); // 5 year
/*if($user->uid)
{
  if(isset($_COOKIE['rem_uid']))
  {
	  if($_COOKIE['rem_uid']==$user->uid)
	  {
	    $expire = time()+200000;
	  }
  }
}*/
	
	   // set cookie for show / hide theme
		if(arg(6)=='hide')
		{
     	 setcookie("chek", 1, $expire, "/");
							 
		}
		if(arg(6)=='show')
		{
			setcookie("chek", 0, $expire, "/");
		}
							
	 if($user->uid)
	{
		
		// ayah theme show / hide, user preference
		$sel_ayatheme = db_query("SELECT value as theme_sel FROM profile_values WHERE fid=6 AND uid=".$user->uid);
		$fetch_ayatheme = db_fetch_object($sel_ayatheme);
		($fetch_ayatheme->theme_sel) ? $select_ayah = $fetch_ayatheme->theme_sel : $select_ayah = 0;
	}
	if(!isset($_COOKIE['chek']))
	{
	 if($select_ayah==1)
		$chek = 0;
	 else
		$chek = 1;
	}
	else
	{
		$chek = $_COOKIE['chek'];
	}

?>
<div id="clip-all-content"  >
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <?php foreach ($header as $field => $label): ?>
        <th class="views-field views-field-<?php print $fields[$field]; ?>">
          <?php print $label; ?>
        </th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
   <tr>
    <?php if($chek!=1) { ?> 
    <td width="120">&nbsp;</td>
	<?php
	}?>
	 <td width="2">&nbsp;</td>
	 <td  align="left" width="70%">
 <?php
 
   // First ayah arabic text spliting
 
   $viewName = 'arabic_text';	  
   $view_11 = views_get_view($viewName);
   $view_11->set_display('default');
   $view_11->set_arguments(array(1,1,arg(5)));
   $view_11->execute();
   $result_11 = $view_11->result;
   if(arg(4)!=1 && arg(4)!=9)
{
   echo "<div class='arabic_top1' align='left'  >";

    $my_res = substr($result_11[0]->node_revisions_body,0,strpos($result_11[0]->node_revisions_body,'<span'));
	if($my_res!="")
	{
		print $my_res;
	}
	else
	{
		print $result_11[0]->node_revisions_body;
	}
   echo "</div>";
}
?>
</td>
</tr>
    <?php 
	
	
	$i=0;
	foreach ($rows as $count => $row): ?>
        <tr class="<?php print implode(' ', $row_classes[$count]); ?>" align="right" >
        <?php foreach ($row as $field => $content): 
		  $i++;
		  if($field=='field_ayah_no_value_1')
		  {
		  
			// Ayah theme display
			$theme_count = 0;
			$viewName = 'ayah_theme';
	
			$view2 = views_get_view( $viewName );
			$view2->set_display('default');
			$view2->set_arguments( array( arg(4),  $content) );
			$view2->execute();
			$theme_coutput = $view2->result;
		    $rawspan=($theme_coutput[0]->node_data_field_start_ayah_theme_field_end_ayah_number_value-$theme_coutput[0]->node_data_field_start_ayah_theme_field_start_ayah_theme_value)+1;
	        if(count($theme_coutput)>0 && $chek!=1)
			{
			  $_SESSION['theme_url'] = strtolower(str_replace(" ","-",$theme_coutput[0]->node_revisions_body));
			?>
	       <td class="views-field views-field-<?php print $fields[$field]; ?>" rowspan="<?=$rawspan?>"    >
		   <div class="ayah_theme" style="vertical-align:top">
			<?php
		
			print $theme_coutput[0]->node_revisions_body;
			?>
			
			</div>
			</td>
		  <?php
		   	}
		
		  }
		 else
		  {
		   if($i%2==0)
		   {
		    $color = "#000000";
		   }
		   else
		   {
		    $color = "#006600";
			}
			if($field=='field_ayah_no_value')
			{
			 if((arg(4)==2) && ($content=='134') && $chek!=1)
			{
		  ?>
		  <td class="views-field views-field-field-ayah-no-value-1" rowspan="1" >&nbsp;</td>
		  <?php
		  }
		  else if((arg(4)==5) && (($content=='121') || ($content=='122') || ($content=='123') ) && $chek!=1)
		  {
		  ?>
		  <td class="views-field views-field-field-ayah-no-value-1" rowspan="1" >&nbsp;</td>
		  <?php
		  }
		  else if((arg(4)==40) && ($content=='61') && $chek!=1)
		  {
		  ?>
		  <td class="views-field views-field-field-ayah-no-value-1" rowspan="1" >&nbsp;</td>
		  <?php
		  }
		  else if((arg(4)==54) && ($content>='45') && $chek!=1)
		  {
		  ?>
		  <td class="views-field views-field-field-ayah-no-value-1" rowspan="1" >&nbsp;</td>
		  <?php
		  }
		   else if((arg(4)==55) && ($content>='56') && $chek!=1)
		  {
		  ?>
		  <td class="views-field views-field-field-ayah-no-value-1" rowspan="1" >&nbsp;</td>
		  <?php
		  }
		  ?>
		     <td class=""   align="right" style="padding-right:5px;" width="2" >
	         <a href="<?=$base_url?>/library/quran/ayah/compare/<?=arg(4)?>/<?php print $content; ?>/<?=$_SESSION['theme_url']?>"><?php print $content; ?></a>
          
             </td>
		 
			   
		  <?php
		  }
		
		  		if($field=='body')
			{
		    
		  ?>
		 

		     <td class="views-field views-field-<?php print $fields[$field]; ?>" align="left"  >
		  
		 
     
			<?php print $content; ?>
		     
             </td>
		  
		  <?php
		  }
		
		  }
		  ?>
        <?php endforeach; ?>
	
		 	</tr>
    <?php endforeach; ?>
     
  </tbody>
</table>
	 
	   <?php
   
       if($field=='nid'){
		// print $content.'ii'; 
		  $output=$content;
		  }
		?> 
		<br />
		<br />
<?php

$dest= drupal_get_destination();
$dest= str_replace("destination=","/",$dest);
$dest= str_replace("%2F","/",$dest);
session_start();
$_SESSION['views']=$dest;

global $user;

 ?>
</div>