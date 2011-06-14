<?php
/**
* Display the data in scholar Detail page. Altering the layout.
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
 if($id=="field_sch_address_value")  { $field_sch_address_value = $field->content; }
 if($id=="field_sch_responsibilities_value")  { $field_sch_responsibilities_value = $field->content; }
 if($id=="field_sch_authority_value")  { $field_sch_authority_value = $field->content; }
 if($id=="field_sch_articles_value")  { $field_sch_articles_value = $field->content; }
 if($id=="field_sch_books_value")  { $field_sch_books_value = $field->content; }
 if($id=="field_sch_phone_value")  { $field_sch_phone_value = $field->content; }
 
 if($id=="field_sch_org_publish_value") { $field_sch_org_publish_value = strip_tags($field->content); }
 if($id=="field_sch_role_publish_value") { $field_sch_role_publish_value = strip_tags($field->content); }
 if($id=="field_sch_add_publish_value") { $field_sch_add_publish_value = strip_tags($field->content); }
 if($id=="field_sch_phone_publish_value") { $field_sch_phone_publish_value = strip_tags($field->content); }
 if($id=="field_sch_book_publish_value") { $field_sch_book_publish_value = strip_tags($field->content); }
 if($id=="field_sch_art_public_value") { $field_sch_art_public_value = strip_tags($field->content); }
 if($id=="field_sch_res_public_value") { $field_sch_res_public_value = strip_tags($field->content); }
 if($id=="field_sch_pub_auth_value") { $field_sch_pub_auth_value = strip_tags($field->content); }
 if($id=="field_sch_photo_publish_value") { $field_sch_photo_publish_value = strip_tags($field->content); }
  // Dispaly the values in formatted table.
?>
<?php endforeach; ?>

<table width="100%" border="0" cellspacing="8" cellpadding="8" class="scholar_table">
  <tr>
    <td colspan="2" align="left" valign="top" class="sholar_title"><?=$title?></td>
  </tr>
  <tr>
    <td width="15%" rowspan="2" align="center" valign="top">
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
	
	</td>
	
    <td width="85%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php
	if($field_sch_orgz_value!="" && $field_sch_org_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td width="13%" align="left" valign="top"><b>Organization</b></td>
        <td width="1%" align="left" valign="top">:</td>
        <td width="86%" align="left" valign="top"><?=$field_sch_orgz_value?></td>
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
	if($field_sch_address_value!="" && $field_sch_add_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Address</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_address_value?></td>
      </tr>
	  
	   <?php
	 }
	 ?>
	 <?php
	if($field_sch_phone_value!="" && $field_sch_phone_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Phone</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_phone_value?></td>
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
	 	 	 <?php
	if($field_sch_books_value!="" && $field_sch_book_publish_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Books</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_books_value?></td>
      </tr>
	  	    <?php
	 }
	 ?>
	 	 	 	 <?php
	if($field_sch_articles_value!="" && $field_sch_art_public_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Articles</b></td>
        <td align="left" valign="top">:</td>
			<td align="left" valign="top"><?=$field_sch_articles_value?></td>
      </tr>
	    	    <?php
	 }
	 ?>
	  	 	 	 <?php
	if($field_sch_responsibilities_value!="" && $field_sch_res_public_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Responsibilities</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_responsibilities_value?></td>
      </tr>
	    	    <?php
	 }
	 ?>
	   	 	 	 <?php
	if($field_sch_authority_value!="" && $field_sch_pub_auth_value!="Unpublish")
	{
	?>
      <tr>
        <td align="left" valign="top"><b>Authority or Job description</b></td>
        <td align="left" valign="top">:</td>
        <td align="left" valign="top"><?=$field_sch_authority_value?></td>
      </tr>
	    	    <?php
	 }
	 ?>
    </table></td>
  </tr>

</table>
