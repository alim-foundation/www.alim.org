<?php
// Alter the tpl for group private posts in user home page

global $base_url;
global $theme_path;
global $user;

// query the group private post details.

$query_owner =  db_query("SELECT node.nid AS nid, og.og_description AS og_og_description, og.og_selective AS og_og_selective, node_revisions.body AS node_revisions_body, node_revisions.format AS node_revisions_format, users.name AS users_name, (SELECT COUNT(n.nid) FROM node n INNER JOIN og_ancestry oga ON n.nid = oga.nid WHERE n.status = 1 AND oga.group_nid = og.nid) AS post_count, (SELECT COUNT(*) FROM og_uid ou INNER JOIN users u ON ou.uid = u.uid WHERE ou.nid = og.nid AND u.status > 0 AND ou.is_active >= 1 AND ou.is_admin >= 0 ) AS member_count, node.created AS node_created, node.title AS node_title FROM node node  LEFT JOIN og og ON node.nid = og.nid LEFT JOIN node_revisions node_revisions ON node.vid = node_revisions.vid INNER JOIN users users ON node.uid = users.uid WHERE (node.status <> 0) AND (node.nid = ".arg(1).") ORDER BY node_created DESC");

$result_owner = db_fetch_object($query_owner);
$owner = $result_owner->users_name;

// query the group members's details and give permission to post reply
$flag = 2;
$query =  db_query("SELECT users.uid AS uid, users.name AS users_name, og_uid.created AS og_uid_created FROM users users  LEFT JOIN og_uid og_uid ON users.uid = og_uid.uid WHERE (users.status <> 0) AND (og_uid.is_active <> 0) AND (og_uid.nid = ".arg(1).") ORDER BY og_uid_created ASC, users_name ASC");
$arr_meb  = array();
while($result = db_fetch_object($query))
{
$arr_meb[]  = $result->uid;
}

if(in_array($user->uid,$arr_meb)) // if user id matches in group member's id, set flag 1
{
  $flag = 1;
}
$opt = "";

// query the replies of the corresponding posts

$result1=db_query("SELECT node.nid AS nid, comments.name AS comments_name, comments.uid AS comments_uid, comments.homepage AS comments_homepage, comments.comment AS comments_comment, comments.format AS comments_format, comments.timestamp AS comments_timestamp, comments.cid AS comments_cid, comments.nid AS comments_nid FROM node node  LEFT JOIN comments comments ON node.nid = comments.nid WHERE (node.status <> 0) AND (node.type in ('group_post')) AND (node.nid = ".$output.") ORDER BY comments_timestamp DESC");
$i=0;
while ($row = db_fetch_array($result1)) {

$temp_user = user_load(array('name' => $row['comments_name'])); // take rpx user details
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  $comm_auth = "<a href='".$base_url."/userprofile/".$row['comments_name']."'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</a>";
}
else
{
  $comm_auth = "<a href='".$base_url."/userprofile/".$row['comments_name']."'>".$row['comments_name']."</a>";
}
	if($row['comments_comment']!="")
	{
		$i++;
		$opt .= "<a name='reply_".$row['comments_cid']."'></a><div class='gr_comm'><div class='gr_comm_body'>".$row['comments_comment']."</div><div class='gr_comm_auth'>";
		
		if($row['comments_name']==$user->name || $owner==$user->name)
		{		
		$opt .= "<a href='".$base_url."/comment/delete/".$row['comments_cid']."?destination=groupdetails/".arg(1)."' class='popups-form-reload' style='text-decoration: underline; font-size: 13px; color:#660000; padding-left:5px;' >Delete</a> &nbsp;&nbsp;";
		}
		
		
		$opt .= date("F j, Y, g:i a",$row['comments_timestamp'])." ".$comm_auth."</div></div>";
	}
}
if($i>0)
print "<div class='group_display'><b>Replies</b><br />";
print $opt;
if($i>0)
print "</div>";
if($flag==1) // if current user is the member of the group
{
?>
<br />

<div  align="right" style="float:right;" >
<div style="text-align:left;" >
<a href="<?=$base_url?>/comment/reply/<?=$output?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;" ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_reply.png" alt="reply" align="absmiddle" /></a>
</div>
</div>
<?php
// check whether current user is the owner
$result3 = db_query("SELECT node.nid AS nid, node.title AS node_title, node.language AS node_language, users.name AS users_name, users.uid AS users_uid FROM node node  INNER JOIN users users ON node.uid = users.uid WHERE (node.type in ('group_post')) AND (node.nid = ".$output.")");

$row3 = db_fetch_array($result3);

if($row3['users_name']==$user->name || $owner==$user->name) // if the current user is the owner of group/group post giving permission to delete.
{
?>

<div  align="right" style="float:right;margin-right:10px;" >
<div  style="text-align:left;padding-left:5px;" >
<a href="<?=$base_url?>/node/<?=$output?>/delete?destination=groupdetails/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;"  ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_delete.png" alt="delete" align="absmiddle" /></a>
</div>
</div>

<?php
}
?>

<?php
}

?>
<div style="clear:both"></div>
<br />
