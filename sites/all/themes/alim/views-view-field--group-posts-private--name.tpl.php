<?php
// group post owner name from rpx filed using username.
global $base_url;
global $theme_path;
print "Posted By : ";
$temp_user = user_load(array('name' => strip_tags($output)));
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  print "<a href='".$base_url."/userprofile/".strip_tags($output)."'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</a>";
}
else
{
  print "<a href='".$base_url."/userprofile/".strip_tags($output)."'>".strip_tags($output)."</a>";
}
?>