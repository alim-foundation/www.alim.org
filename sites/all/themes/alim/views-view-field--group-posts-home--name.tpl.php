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

// Home page recent group post block. Shows the user picture and full name from rpx data. User image and name linked to user profile page.
global $base_url;
global $theme_path;

$temp_user = user_load(array('name' => strip_tags($output))); // loading rpx data using username
$picture = $temp_user->picture; 
?>
<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>" class="gotouser">
<div id="user_image">

<?php if($picture!="") { ?>
<img  src="<?=$base_url?>/<?=$picture?>"  height="24" width="24" align="absmiddle" alt="image" />
<?php 
} 
 else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") { // user picture ?> 
<img height="24px"  width="24px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" align="absmiddle" />
<?php 
} 
 else if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") {?><img src='http://alim.org/sites/all/themes/alim/images/photobg.png' height="24px"  width="24px" align="absmiddle" />
<?php } ?>
</div>
<div  style="float:left;padding-top:7px;padding-bottom:7px;width:85px;color:#660000" > 
<strong>
<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  // user full name
  $str1 = strlen($temp_user->rpx_data['profile']['name']['givenName']);
   $str2 = strlen($temp_user->rpx_data['profile']['name']['familyName']);
   if(($str1+$str2)>10)
   {
     $second = $temp_user->rpx_data['profile']['name']['familyName'];
	 $res = substr($temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'],0,7)."...";
   }
   else
   {
    $res = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
   }
   
   
   
  print $res;
}
else
{
  // if user full name not present username
  print substr(strip_tags($output),0,10);
}
?>
</strong>
</div>
<div  style="float:left;padding-top:7px;padding-bottom:7px;" > 
<?php
print "&nbsp;:&nbsp;";
?>
</div>
</a>