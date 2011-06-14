<?php
// Alter the layou of search user page listing

global $base_url;
$temp_user = user_load(array('name' => strip_tags($output)));
$uid = $temp_user->uid; 
$picture = $temp_user->picture; 
?>
<div class="profile_search" >
<div class="prof_img">
<?php
if($picture!="")
				{
			?>
			   <a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>">
				<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" />
				</a>
				<?php
				}
?>
<?php if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {?>
<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>">
<img  src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" align="absmiddle" height="32" width="32" />
</a>
<?php } ?>

<?php if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") {?>
<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>">
<img src='http://alim.org/sites/all/themes/alim/images/user32_d.png'  align="absmiddle" />
</a>
<?php } ?>

</div>
<div class="prof_name" > 
<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{ 
  print "<b><a href='".$base_url."/userprofile/".strip_tags($output)."' >".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</a></b>";
}
else
{
  print "<b><a href='".$base_url."/userprofile/".strip_tags($output)."' >".strip_tags($output)."</a></b>";
}

//print "<br /><span style='color:green;font-size:10px;'>(".strip_tags($output).")</span>";
?>

</div>
</div>
<div style="clear:both"></div>
