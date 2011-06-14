<?php
// Alter the recent comment page user image
global $base_url;
global $theme_path;

$temp_user = user_load(array('name' => strip_tags($output)));
$picture = $temp_user->picture; 
?>
<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>" class="gotouser">
<div id="user_image">
<?php if($picture!="") { ?>
<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
<?php 
} 
else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {?>

<img height="32px"  width="32px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" />

<?php }
else if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") {?>
<img src='<?=$base_url?>/<?=$theme_path?>/images/user32_b.png'  align="absmiddle" border="0" />
<?php } ?>
</div> 
<div  style="float:left;" > 
<strong>
<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  print strip_tags($output);
}
print "&nbsp;";
?>
</strong>
</div>
</a>
