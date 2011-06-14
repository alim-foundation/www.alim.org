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

global $base_url;
global $theme_path;

$temp_user = user_load(array('name' => strip_tags($output)));


if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
 $imgtitle = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  $imgtitle =  strip_tags($output);
}

$picture = $temp_user->picture; 

?>

<div class="followme_div"  style="width:65px;text-align:center;vertical-align:top;background-color:#E5E5E5;padding:3px;padding-top:5px"  >

<a href="<?=$base_url?>/userprofile/<?=strip_tags($output)?>">
<div class="follower_pic">
<?php
				if($picture!="")
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
?>"  />
		
				
				<?php  } else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {?><img  src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" align="absmiddle" border="0"  title="<?=$imgtitle?>" width="48"  height="48" /><?php } ?><?php if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") {?><img src='<?=$base_url?>/<?=$theme_path?>/images/user48_b.png' align="absmiddle" border="0" title="<?=$imgtitle?>" /><?php } ?>

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
