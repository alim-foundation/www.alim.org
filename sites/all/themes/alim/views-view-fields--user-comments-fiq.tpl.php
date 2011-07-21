<?php
session_start();
/*$_SESSION['msg'] ='';*/
//session_start();
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

 global $links;
 
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
  
   <?php if($id == 'pid' ): ?>
  
  <?php $pid= $field->content; ?>
  <?php endif; ?>
 
<?php endforeach; ?>


<?php

$commentarray = _comment_load($cid);
$userid=$commentarray->uid;
$uptime=$commentarray->timestamp;


 /* $viewName1 = 'arabic_text';
print views_embed_view($viewName1 , $display_id = 'default', arg(4), arg(5), 'ARB');*/
$viewName = 'Fiqh_Sunnah_comment';

  $view_12 = views_get_view($viewName);
   $view_12->set_display('default');
   $view_12->set_arguments(array(arg(4),arg(5)));
   $view_12->execute();
   $result_12 = $view_12->result;
  $output1 = $result_12[0]->node_revisions_body;
	 $output2 = $result_12[0]->nid;

  
  
    $nodid=$output2;
//print $nodid.$cid."lllllllllll";
// $com_nodid=find_comment_id($cid);



//print '---  '.$total.'---......';
//print_r($com_nodid);
 ?>

<?

$temp_user = user_load(array('name' => strip_tags($name)));
$arr=$temp_user->roles;
$array=$temp_user->roles;
$picture = $temp_user->picture; 
//$key = array_search('Community User', $array);
//echo $key."---key";
//$key1 = array_search('Scholar', $array);
//print_r($temp_user);
if($com_nodid==$nodid){
if($pid < 1){

/*if($key!=""){
if($key1==""){*/
 //print $name.'.........';  print  $comment;
 ?><?php //print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
 
// print $user->rpx_data['profile']['photo'];
if(is_array($arr)){
 		foreach( $arr as $key => $value){
	//echo $value;
	if($value=="Community User")
{
	$val="Community User";
	
	}
		if($value=="Scholar")
{
	$val="Scholar";
	
	}
			if($value=="Book Author")
{
	$val="Book Author";
	
	}
}
}
?> <span id="<?php print"comment-".$cid; ?>">
<?php  

 if($value=="Community User"||($value!="Community User" && $value!="Scholar" && $value!="Book Author" )) {?> <table width="100%" border="0" style="border-color:#CCCCCC;margin-bottom:20px;border:solid #A0A0A0 1px;border-collapse:separate;"  ><tr><td>
  <table width="100%" border="0" cellpadding="0" style="border-collapse:separate;" >
  <tr>
    <td width="22" class="cm_image" valign="top" style="padding-top:5px;"   ><!--<img title="Community User" src="<?php print $img_theme_path; ?>/userimage.png" />-->
	<img style="padding-left:15px;" title="Community User" src="<?php print $img_theme_path; ?>/userimage.png" />
	<div style="font-size:9px;color:#333333;font-weight:bold;padding-left:15px;">User</div>
	
	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:left;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;padding-left:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }?>
	</td>

    <td  valign="top" bgcolor="#F7F7F7" ><div style="width:600px;height:40px;color:#333333;padding-top:7px;padding-left:10px;font-size:12px;border-top:dotted 1px #cccccc;">
	<div style="width:450px;float:left;padding-bottom:10px;" ><span style="display:block;float:left;">
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
	}  else if($temp_user->rpx_data['profile']['photo']!=""&& $picture=="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
	 else if($temp_user->rpx_data['profile']['photo']==""&& $picture=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	</a>
	
	</span><b>
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($temp_user->rpx_data['profile']['name']['givenName']==""){
	print "&nbsp;&nbsp;".$name;
	}
	else {
	 print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
		}		
 	 ?>
	 </a></b>
	 
	  <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	  <?php $count = db_affected_rows($result); ?>
<?php if(($result->cid)!='') { ?><span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print  time_since($uptime)." ago "; ?><?php } else { ?>

	 
	 &nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; }  ?><span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_comm" style="width:150px;float:left;padding-top:13px;">
	  
	
<?
//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_comm" style="padding-left:45px;margin-left:<?php print $padd.'px' ?>;" >	
				 <?php  // print_r($n); 
		 print  $comment;
		// print_r($arr);

		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_comm" style="border-bottom:dotted 1px #cccccc;"  >
<?php	if ($user->uid){ ?>

<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/reply/<?php print $com_nodid; ?>/<?php print $cid; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a></span>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>



&nbsp;|&nbsp;<span style="font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;<?php print  $report; ?></span>
&nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/node/163673/<?php print $cid; ?>" class="popups-form-reload" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a></span>


<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" /><a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">&nbsp;Report Inappropriate</a>
&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a>



<?php } ?>
</div>

<?php } ?> 
		 
	</span>
				 </td>
  </tr>
</table>
<?php

}
if($value=="Scholar") {

?>
<table width="100%" border="0" style="border-color:#ECECEC;margin-bottom:20px;border:solid #A0A0A0 1px;border-collapse:separate;"  ><tr><td>
    <table width="100%" border="0" cellpadding="0" style="border-collapse:separate;" >
  <tr>
 <td width="69" valign="top" class="so_image" style="padding-top:5px;" ><img style="padding-left:15px;" title="Scholar" src="<?php print $img_theme_path; ?>/scollerimage.png" />
	<div style="font-size:9px;color:#333333;font-weight:bold;padding-left:8px;">Scholar</div>

	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:left;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;padding-left:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }?>
	</td>
    <td  valign="top" bgcolor="#fcf7ec" ><div style="width:<?php print $padd3.'px' ?>;height:40px;padding-top:7px;padding-left:10px;font-size:12px;margin-left:<?php print $padd.'px' ?>;border-top:dotted 1px #cccccc;">
	<div style="width:450px;float:left;padding-bottom:10px;" ><span style="display:block;float:left;">
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
		}  else if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
		 else if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	</a>
	</span><b>
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	
	<?php print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
				
 	 ?>
	 </a></b>
	 
	  <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	  <?php $count = db_affected_rows($result); ?>
<?php if(($result->cid)!='') { ?><span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print  time_since($uptime)." ago "; ?><?php } else { ?>
	 
	 &nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; } ?> <span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_scholar" style="float:right;padding-top:13px;padding-right:10px;">
	 
	<?

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_scholar" style="margin-left:<?php print $padd.'px' ?>;padding-left:45px;" >	
				 <?php  // print_r($n); 
		 print  $comment;
		// print_r($arr);

		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_scholar" style="margin-left:<?php print $padd.'px' ?>;padding-left:<?php print $padd1.'px' ?>;border-bottom:dotted 1px #cccccc;"  >
<?php	if ($user->uid){ ?>

<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/reply/<?php print $com_nodid; ?>/<?php print $cid; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle"  src="<?php print $img_theme_path; ?>/ico_reply.gif" />Reply</a></span>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<span style="font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;<?php print  $report; ?></span>
&nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/node/163673/<?php print $cid; ?>" class="popups-form-reload" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a></span>



<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />Reply</a>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" /><a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">&nbsp;Report Inappropriate</a>
&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a>



<?php } ?>
</div>


		 
	</span>
				 </td>
  </tr>
</table>	<?php }if($value=="Book Author") { ?> 
<table width="100%" border="0" style="border-color:#ECECEC;margin-bottom:20px;border:solid #A0A0A0 1px;border-collapse:separate;"  ><tr><td>
    <table width="100%" border="0" cellpadding="0" style="border-collapse:separate;" >
  <tr>
 <td width="69" valign="top" class="au_image" style="padding-top:5px;" ><img style="padding-left:15px;" title="Book Author" src="<?php print $img_theme_path; ?>/authorimage.png" />

	<div style="font-size:9px;color:#333333;font-weight:bold;padding-left:8px;">Author</div>

	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{ ?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:left;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;padding-left:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }?>
	</td>
    <td  valign="top" bgcolor="#F8F7E3" ><div style="width:<?php print $padd3.'px' ?>;height:40px;padding-top:7px;padding-left:10px;font-size:12px;margin-left:<?php print $padd.'px' ?>;border-top:dotted 1px #cccccc;background-color:#F8F7E3;">
	<div style="width:450px;float:left;padding-bottom:10px;" ><span style="display:block;float:left;">
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
		}  else if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
		else if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	</a>
	</span><b>
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
				
 	 ?>
	 </a></b>
	 
	  <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	   <?php $count = db_affected_rows($result); ?>
<?php if(($result->cid)!='') { ?><span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print  time_since($uptime)." ago "; ?><?php } else { ?>

	 
	 &nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; } ?> <span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_scholar" style="float:right;padding-top:13px;padding-right:10px;">
	 
	<?

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_scholar" style="margin-left:<?php print $padd.'px' ?>;padding-left:45px;" >	
				 <?php  // print_r($n); 
		 print  $comment;
		// print_r($arr);

		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_auth" style="margin-left:<?php print $padd.'px' ?>;padding-left:<?php print $padd1.'px' ?>;border-bottom:dotted 1px #cccccc;"  >
<?php	if ($user->uid){ ?>

<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/reply/<?php print $com_nodid; ?>/<?php print $cid; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />Reply</a></span>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>



&nbsp;|&nbsp;<span style="font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;<?php print  $report; ?></span>
&nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/node/163673/<?php print $cid; ?>" class="popups-form-reload" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a></span>



<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />Reply</a>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" /><a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">&nbsp;Report Inappropriate</a>
&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a>





<?php } ?>
</div>


		 
	</span>
				 </td>
  </tr>
</table>	
	
	
	
	
	
	
	
	

	
	<? }







$result1=db_query("SELECT * FROM {comments} where pid=%d  and cid=%d  ",0,$cid);
while ($row = db_fetch_array($result1)) {
 //print_r($row);
$node1=$row['cid']; 
		
		 
		 
	 		$result=db_query("SELECT * FROM {comments} where pid=%d",$node1);
while ($row = db_fetch_array($result)) {

$node=$row['cid']; 
		 
		
		 $viewName = 'user_scholar_comments';
		    //print "yyy";
					 print views_embed_view($viewName , $display_id = 'default',$node);
			 
			print printdata1($node); 
			}
			
			}
			 ?>
			
			 <?
		    // print "........".$node.$cid.$i++;   
/*		 
	 		$result2=db_query("SELECT * FROM {comments} where pid=%d",$node);
while ($row = db_fetch_array($result2)) {
 //print_r($row);
$node2=$row['cid']; 
		 
		
		 $viewName = 'user_node_comment_scholar';
		  print "second";
			 print views_embed_view($viewName , $display_id = 'default',$node2);
			 
			 
			 	 		$result3=db_query("SELECT * FROM {comments} where pid=%d",$node2);
while ($row = db_fetch_array($result3)) {
 //print_r($row);
$node3=$row['cid']; 
		 
		
		 $viewName = 'user_node_comment_scholar';
		      print "third";
			 print views_embed_view($viewName , $display_id = 'default',$node3);
		 
		 
		 			 	 		$result4=db_query("SELECT * FROM {comments} where pid=%d",$node3);
while ($row = db_fetch_array($result4)) {
 //print_r($row);
$node4=$row['cid']; 
		 
		
		 $viewName = 'user_node_comment_scholar';
		   print "fourth";
			 print views_embed_view($viewName , $display_id = 'default',$node4);
		 
		 }
		 
		 
		 
		 
		 
		 }
		 
		 
		 
		 }
		 
		 }
		 
		 	 
	}	 

*/		// print_r($arr);?>
		<span style="display:block;"><?
/*		 $com= drupal_get_form('comment_form',
  array('nid' =>$com_nodid,'pid'=>$cid));
	
print $com;
print $com_nodid.'---';
print $cid;*/


?>
</span>

<?
			/*	 $node=node_view($n);
				$note1 =htmlentities($node);
				 $note2= strstr($note1,'content clear-block');
				$nn=html_entity_decode($note2);
				 $nooo= str_replace( 'content clear-block">',' ',$nn);
				print $nooo;*/
				 ?>

<?
}?>

</td></tr></table><?
/*} } */?>
