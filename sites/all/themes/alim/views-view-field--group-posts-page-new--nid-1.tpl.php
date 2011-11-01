<?php
global $base_url;
global $theme_path;
global $user;

$node2  = node_load(arg(1));
?>
<div align="left" style="margin-bottom:10px;margin-top:-25px;">
<b>Group - </b><a href="<?=$base_url?>/groupdetails/<?=arg(1)?>" style="color:#660000"><?=$node2->title?></a>
</div>
<?php

// Alter the tpl for group public posts in user home page

$query_owner =  db_query("SELECT node.nid AS nid, og.og_description AS og_og_description, og.og_selective AS og_og_selective, node_revisions.body AS node_revisions_body, node_revisions.format AS node_revisions_format, users.name AS users_name, (SELECT COUNT(n.nid) FROM node n INNER JOIN og_ancestry oga ON n.nid = oga.nid WHERE n.status = 1 AND oga.group_nid = og.nid) AS post_count, (SELECT COUNT(*) FROM og_uid ou INNER JOIN users u ON ou.uid = u.uid WHERE ou.nid = og.nid AND u.status > 0 AND ou.is_active >= 1 AND ou.is_admin >= 0 ) AS member_count, node.created AS node_created, node.title AS node_title FROM node node  LEFT JOIN og og ON node.nid = og.nid LEFT JOIN node_revisions node_revisions ON node.vid = node_revisions.vid INNER JOIN users users ON node.uid = users.uid WHERE (node.status <> 0) AND (node.nid = ".arg(1).") ORDER BY node_created ASC");

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


if($flag==1)
{

$result4 = db_query("SELECT node.nid AS nid,node.created AS created,node.changed AS changed,node.vid AS vid,node.title AS node_title, node.language AS node_language, users.name AS users_name, users.uid AS users_uid FROM node node  INNER JOIN users users ON node.uid = users.uid WHERE (node.type in ('group_post')) AND (node.nid = ".$output.")");

$row4 = db_fetch_array($result4);

$node  = node_load($output);
$rev_count  =  $node->field_rev_count[0]['value'];
if($node->field_rev_count[0]['value']!=0)
{
print "<div align='right' style='float:right;'><span style=color:#339933;>Edited (".$rev_count.") </span>  ".time_since($row4['changed'])." ago </div>";
}	
else
{
	print "<div align='right' style='float:right;'>".time_since($row4['created'])." ago </div>";

}
}

print "<br /><br />";
// query the replies of the corresponding posts

$result1=db_query("SELECT node.nid AS nid, comments.name AS comments_name, comments.uid AS comments_uid, comments.homepage AS comments_homepage, comments.comment AS comments_comment, comments.format AS comments_format, comments.timestamp AS comments_timestamp, comments.cid AS comments_cid, comments.nid AS comments_nid FROM node node  LEFT JOIN comments comments ON node.nid = comments.nid WHERE (node.status <> 0) AND (node.type in ('group_post')) AND (node.nid = ".$output.") ORDER BY comments_timestamp ASC");
$i=0;
while ($row = db_fetch_array($result1)) {

$temp_user = user_load(array('name' => $row['comments_name'])); // take rpx user details

if($temp_user->profile_group_privacy==1 || !isset($temp_user->profile_group_privacy))
{

if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  $comm_auth = "<a href='".$base_url."/userprofile/".$row['comments_name']."'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</a>";
}
else
{
  $comm_auth = "<a href='".$base_url."/userprofile/".$row['comments_name']."'>".$row['comments_name']."</a>";
}
}
else
{
 $comm_auth = "( <i>Hidden User</i> )";
}
	if($row['comments_comment']!="")
	{
		$i++;
		$opt .= "<a name='reply_".$row['comments_cid']."'></a><div class='gr_comm'><div class='gr_comm_body'>".$row['comments_comment']."</div><div class='gr_comm_auth'>";
		if($row['comments_name']==$user->name || $owner==$user->name)
		{	
				$opt .= "<a href='".$base_url."/comment/delete/".$row['comments_cid']."?destination=group-post/".arg(1)."/".arg(2)."' class='popups-form-reload' style='text-decoration: underline; font-size: 13px; color:#660000; padding-left:5px;' >Delete</a> &nbsp;&nbsp;";
				
				$opt .= "<a href='".$base_url."/comment/edit/".$row['comments_cid']."/".arg(1)."' class='popups-form-reload' style='text-decoration: underline; font-size: 13px; color:#660000; padding-left:5px;' >Edit</a> &nbsp;&nbsp;";
				
		}
		
		
        $resultcid = db_fetch_object(db_query("SELECT cid  FROM {alim_commentedurl} WHERE  cid = %d", $row['comments_cid'])); 
		$count = db_affected_rows($resultcid); 
		if(($resultcid->cid)!='') { 
		
	     $opt .="<span style=color:#339933;>Edited (".$count.") </span>    ". time_since($row['comments_timestamp'])."  ago  ".$comm_auth."</div></div>";
		 }
		 else
		 {
		 	$opt .=time_since($row['comments_timestamp'])."  ago  ".$comm_auth."</div></div>";
			}

				
	    
	}
}
if($i>0)
print "<div class='group_display'><span class='grp_reply'>Replies</span><br />";
print $opt;
if($i>0)
print "</div>";
?>

<br />




<?php
if($flag==1)
{
?>
<div  align="right" style="float:right;" >
<div style="text-align:left;" >
<a href="<?=$base_url?>/comment/reply/<?=$output?>" class="popups-form" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;" id="reply_link" ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_reply.png" alt="reply" align="absmiddle" /></a>
</div>
</div>
<?php
}
else
{
if($user->uid)
{
?>
<div  align="right" style="float:right;" >
<div style="text-align:left;" >
<a href="<?=$base_url?>/og/subscribe/<?=arg(1)?>" class="popups-form" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;" id="reply_link" ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_reply.png" alt="reply" align="absmiddle" /></a>
</div>
</div>
<?php
}
else
{
?>

<?php
						// Rpx Login if user not logged in
					$block = module_invoke('rpx', 'block', 'view', 0);
					//print $block['content'];
					
					 $r  = strip_tags($block['content'], '<a>');
					 $tt = stristr($r,'href=');
					 $t3 = stristr($tt,'AOL/AIM');
					 $url = str_replace($t3," ",$tt);
					  
					   ?>
					<div  align="right" style="float:right;" >
						<div style="text-align:left;" >
 						<?php print '<a '.$url ;?>  <img src="<?=$base_url?>/<?=$theme_path?>/images/btn_reply.png" alt="reply" align="absmiddle" /> </a>
						</div>
					</div>



<?php
}
}
?>

<?php
if($flag==1) // if current user is the member of the group
{

// check whether current user is the owner
$result3 = db_query("SELECT node.nid AS nid, node.title AS node_title, node.language AS node_language, users.name AS users_name, users.uid AS users_uid FROM node node  INNER JOIN users users ON node.uid = users.uid WHERE (node.type in ('group_post')) AND (node.nid = ".$output.")");

$row3 = db_fetch_array($result3);

if($row3['users_name']==$user->name || $owner==$user->name)  // if the current user is the owner of group/group post giving permission to delete.
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
if($row3['users_name']==$user->name)
{
?>
<div  align="right" style="float:right;margin-right:10px;" >
<div  style="text-align:left;padding-left:0px;" >
<a href="<?=$base_url?>/node/<?=$output?>/edit/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;"  ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_edit.png" alt="edit" align="absmiddle" /></a>
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
<?php
$node1  = node_load(arg(1));
$grop_title = substr($node1->title,0,30);
if(strlen($node1->title)>30)
$grop_title .= ' ...';
$node3  = node_load(arg(2));
$post_title = substr($node3->title,0,30);
if(strlen($node2->title)>30)
$post_title .= ' ...';


unset($breadcrumb);
$breadcrumb = array();
$breadcrumb[] =  l(t('Home'), '<front>') ;
$breadcrumb[] =  l(t($grop_title), 'groupdetails/'.arg(1)) ;
$breadcrumb[] =  l(t($post_title), 'group-post/'.arg(1).'/'.arg(2)) ;
drupal_set_breadcrumb($breadcrumb);
?>

<?php 
$args=$_GET['reply'];
if($args =="reply")
{

if($user->uid)
{

?>

<script type="text/javascript">
 $(window).load( function() {
	//$(document).one('mousemove',function(e){
	$('#reply_link').trigger('click');	
//});
});
</script>
<?php
}
else
{
?>
<script type="text/javascript">
 $(window).load( function() {
	$(document).one('mousemove',function(e){
	$('.rpxnow').trigger('click'); 
});
});
</script>
<?php
}
?>
<?php } ?>
