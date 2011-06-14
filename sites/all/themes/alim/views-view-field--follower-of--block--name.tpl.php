<?php
// Changes the follower block name listing
global $base_url;
global $theme_path;

$temp_user = user_load(array('name' => strip_tags($output)));
$picture = $temp_user->picture; 
?>

<div class="follower_div"  style="width:65px;text-align:center;vertical-align:top;background-color:#E5E5E5;padding:3px;padding-top:5px"  >

<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>">
<div class="follower_pic">
<?php if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {?><img  src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" align="absmiddle" height="48" width="48" border="0"  title="<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  print strip_tags($output);
}
?>" /><?php } if($picture!="")
				{
				?>
					<img  src="<?=$base_url?>/<?=$picture?>"  height="48" width="48" align="absmiddle" title="<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  print strip_tags($output);
}
?>" />
		
				
				<?php  } else if($temp_user->rpx_data['profile']['photo']==""  && $picture=="") {?><img src='<?=$base_url?>/<?=$theme_path?>/images/user48_b.png'  align="absmiddle" border="0" title="<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  print strip_tags($output);
}
?>" /><?php } ?>
<div style="text-align:center;font-size:10px;color:#660000">
<?php
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print substr($temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'],0,8);
}
else
{
  print substr(strip_tags($output),0,8);
}
?>
</div>

</div>

</a>

</div>
