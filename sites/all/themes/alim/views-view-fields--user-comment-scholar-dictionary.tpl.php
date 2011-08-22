<?php
global $user;
session_start();
/*$_SESSION['msg'] ='';*/
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
  global $theme_path;
  global $base_url; 
  $img_theme_path = $base_url."/".$theme_path."/images"; 

 
 
?>

<?php
/*----------------- Comment Filtering -------------------*/
global $user;
$user_id = $user->uid;

$role_book_author    = 1;
$role_community_user = 1;
$role_scholar    	 = 1;

$role = 0;
if($user_id)
{

//Select user preference values.
$user_utype = db_query("SELECT value as utype_sel,count(value) as utype_count FROM profile_values WHERE fid=23 AND uid=".$user_id);
$fetch_utype= db_fetch_object($user_utype);
($fetch_utype->utype_sel) ? $role = $fetch_utype->utype_sel : $role = 0;
if($fetch_utype->utype_count==0) 
  $role = 0;


$user_grp = db_query("SELECT value as grp_sel,count(value) as grp_count FROM profile_values WHERE fid=24 AND uid=".$user_id);
$fetch_grp = db_fetch_object($user_grp);
($fetch_grp->grp_sel) ? $sel_grpd = $fetch_grp->grp_sel : $sel_grpd = 0;
if($fetch_grp->grp_count==0) 
  $sel_grpd = 0;
  
}
else
{
	$role 		= $_SESSION['comm_utype'];
	$sel_grpd 	= $_SESSION['comm_grps'];
}

/*----------------- Comment Filtering end-------------------*/
?>


<?php foreach ($fields as $id => $field): ?>
 <?php //print $field->content;?> <?php //print $id;?>
 
 
 <?php if($id == 'name' ): ?>
  <?php $name = $field->content; ?>
  <?php endif; ?> 
 
 <?php if($id == 'comment' ): ?>
  <?php $comment = $field->content; ?>
  <?php endif; ?> 
  
   <?php if($id == 'timestamp' ): ?>
  
  <?php $created= $field->content; ?>
  <?php endif; ?>
 <?php if($id == 'cid' ): ?>
  
  <?php $cid= $field->content; ?>
  <?php endif; ?>
 <?php if($id == 'nid' ): ?>
  
  <?php $com_nodid= $field->content; ?>
  <?php endif; ?>
   <?php if($id == 'ops' ): ?>
  
  <?php $report= $field->content; ?>
  <?php endif; ?>
  
  
  
<?php endforeach; ?>


<?

/*----------------- Comment Filtering -------------------*/
// Group wise filtering
$detuser = user_load(array('name' => strip_tags($name)));
$arr_role=$detuser->roles;
if(is_array($arr_role)){

foreach($arr_role as $key => $ur){
	//echo $value;
	if($ur=="Community User")
   {
	$urole="Community User";
	
	}
	if($ur=="Scholar")
   {   
	$urole="Scholar";
	
	}
  if($ur=="Book Author")
   {
	$urole="Book Author";
	}
  }
}
$display = "null";
if($role==4 && $urole=="Community User")
{
	$display = "Community User"; // Set if Book Author Selected.
} 
else if($role==3  && $urole=="Book Author")
{
	$display = "Book Author";  // Set if Community User Selected.

} 
else if($role==7 && $urole=="Scholar")
{
	$display = "Scholar";  // Set if Book Scholar Selected
}
else if($role==0 && $role!=3 && $role!=4 && $role!=7)
{
  $display = "All";  // Set if Book Scholar Selected
}

if($display==$urole || $display == "All")
{

$sel_grpd_exp = explode("_",$sel_grpd);

$my_group = db_query("SELECT node.nid AS nid, node.title AS node_title, users.name AS users_name, users.uid AS users_uid, og_uid.uid AS og_uid_uid, og_uid.nid AS og_uid_nid FROM node node  LEFT JOIN og_uid og_uid ON node.nid = og_uid.nid INNER JOIN users users ON node.uid = users.uid WHERE (node.type IN ('creat_group')) AND (og_uid.uid = ".$detuser->uid.") AND (og_uid.is_active <> 0) ORDER BY node_title ASC");

$grp_flag = 0;

while($fetch_mygroups=db_fetch_object($my_group))
{
  if(in_array($fetch_mygroups->nid,$sel_grpd_exp))
   $grp_flag = 1;
}

if($sel_grpd==0)
 $grp_flag = 1;
 
if($grp_flag==1) 
{ 
/*----------------- Comment Filtering end-------------------*/


$temp_user = user_load(array('name' => $name));
$array=$temp_user->roles;

//echo $key."---key";
$key = array_search('Scholar', $array);
//print_r($temp_user);



if($key!=""){
 //print $name.'.........';  print  $comment;
 ?><?php //print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
 
// print $user->rpx_data['profile']['photo'];
 
?>
 <div style="padding-left:40px;color:#993300;"> <b><?php print $_SESSION['msg'];?> </b></div>
 <?php
 
/*if(arg(7)==111){
	$path=$_SESSION['views'];
	$pieces = explode("/", $path);
	$rr='/'.$pieces[8];
	$rtr=str_replace($rr, " ", $_SESSION['views']);
	$_SESSION['msg'] ="Enter Your Comment";
	drupal_goto($path = $base_url.$_SESSION['views']);
	}
	*/
 
 ?>
 
  <table width="100%" border="0" cellpadding="5" >
  <tr>
    <td width="22" valign="top"  ><?php if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } ?>
	<?php if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.jpg" /><?php } ?>
	
	</td>
    <td  valign="top" ><div style="width:600px;height:20px;color:#993300;background-color:#FCE8BD;padding-top:7px;padding-left:10px;font-size:12px;float:left;">

	<div style="width:450px;float:left;" ><b><?php print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
				
 	 ?></b>&nbsp;&nbsp;&nbsp; <?php print  $created." ago "; ?></div>
	 <div style="width:150px;float:left;">
	 
	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a style="float:right;" class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
	
				 <span><?php //print $body; ?>
				
				 <?php  // print_r($n); 
		 print  $comment;
		 
			/*  $node=node_view($n);
				$note1 =htmlentities($node);
				 $note2= strstr($note1,'content clear-block');
				$nn=html_entity_decode($note2);
				 $nooo= str_replace( 'content clear-block">',' ',$nn);
				print $nooo;*/
				 ?></span>
				 </td>
  </tr>
</table>

<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef22-'.$cid;?>
<div style="padding-left:510px;font-size:12px;font-weight:bold;padding-bottom:20px">

<?php	if ($user->uid){ ?>
<span clicktip="<?php print $idval; ?>" class="clicktip_target" style="text-decoration:none;font-size:11px;">Reply&nbsp;|&nbsp;</span> <span style="font-size:11px;"><?php print  $report; ?></span></div>
<div id="<?php print $idval; ?>" class="clicktip" style="display: block;">
  <?php 
$com= drupal_get_form('comment_form',
    array('nid' =>'161038'));
print $com;
?>
<a class="clicktip_close"><span>close</span></a>
<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Reply</a>&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Report Abuse</a>

<?php } ?>

</div>

<?php 
} 

?>
 
<?php
/*----------------- Comment Filtering -------------------*/
}
}
/*----------------- Comment Filtering end-------------------*/
?>