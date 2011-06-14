<?php
/**
* Display the data in scholar page. Altering the layout.
* 
*/
 global $base_url;
 global $theme_path;
  // Assigning each value to variable.
?>
<?php foreach ($fields as $id => $field): ?>
<?php
 if($id=="title") { $title = strip_tags($field->content); }
 if($id=="body")  { $body = strip_tags($field->content); }
 if($id=="field_sch_photo_fid")  { $field_sch_photo_fid = $field->content; }
 if($id=="field_sch_orgz_value")  { $field_sch_orgz_value = strip_tags($field->content); }
 if($id=="field_sch_role_value")  { $field_sch_role_value = strip_tags($field->content); }
 if($id=="nid") { $nid = strip_tags($field->content); }
 if($id=="field_sch_org_publish_value") { $field_sch_org_publish_value = strip_tags($field->content); }
 if($id=="field_sch_role_publish_value") { $field_sch_role_publish_value = strip_tags($field->content); }
 if($id=="field_sch_photo_publish_value") { $field_sch_photo_publish_value = strip_tags($field->content); }
 if($id=="field_listusers_uid") { $field_listusers_uid = strip_tags($field->content); }
   // Dispaly the values in formatted table.
 
?>
<?php endforeach; ?>

<table width="100%" border="0" cellspacing="4" cellpadding="4" class="scholar_table">
  <tr>
    <td colspan="2" align="left" valign="top" class="sholar_title">
	<?php
	if($field_listusers_uid!="")
	{
	  if($field_listusers_uid=="Shaykh Mikaeel ...")
	  {
	  	$field_listusers_uid = "Shaykh Mikaeel Abdur Rahman";
	  }
	?>
	<a href="../userprofile/<?php print $field_listusers_uid; ?>" style="color:#006600"><?=$title?></a>
	<?php
	}
	else
	{
	  print $title;
	}
	?>
	
	
	</td>
  </tr>
  <tr>
    <td width="15%" rowspan="2" align="center" valign="top">
   <?php
	if($field_listusers_uid!="")
	{
	?>
	<a href="../userprofile/<?php print $field_listusers_uid; ?>" >
   <?php
     }
	 ?>
	<?php
	if($field_sch_photo_publish_value!="Unpublish")
	{
	?>
	<?=$field_sch_photo_fid?>
	<?php
	
	  if($field_sch_photo_fid=="")
	  {
	  ?>
	  
	   <img src="<?=$base_url?>/<?=$theme_path?>/images/user48_b.png"  />
	   <?php
	  }
	}
	else
	{
	?>
	<img src="<?=$base_url?>/<?=$theme_path?>/images/user48_b.png"  />
	<?php
	}
	?>
	  <?php
	if($field_listusers_uid!="")
	{
	?>
	</a>
	<?php
	}
	?>
	</td>
    <td width="85%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php
	if($field_sch_orgz_value!="" && $field_sch_org_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td width="7%" align="left" valign="top"><b>Organization</b></td>
        <td width="1%" align="left" valign="top">:</td>
        <td width="92%" align="left" valign="top"><?=$field_sch_orgz_value?></td>
      </tr>
      <?php
	  }
	  ?>
	<?php
	if($field_sch_role_value!="" && $field_sch_role_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Role</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_role_value?></td>
      </tr>
	 <?php
	  }
	  ?>
	  <?php
	if($body!="")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Biography</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$body?></td>
      </tr>
	 <?php
	  }
	  ?>
    </table></td>
  </tr>
  <tr>
    <td align="right" valign="top"><a href="../alim/scholarpage/<?=$nid?>">Read more</a></td>
  </tr>
</table>
<div class="scholar_sep"></div>