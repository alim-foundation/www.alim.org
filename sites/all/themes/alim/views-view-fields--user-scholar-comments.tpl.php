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
  
  
  <?php if($id == 'title' ): ?>
  
  <?php $art_bk= $field->content; ?>
  <?php endif; ?>
  
   <?php if($id == 'pid' ): ?>
  
  <?php $pid= $field->content; ?>
  <?php endif; ?>
    <?php if($id == 'thread' ): ?>
  
  <?php $thread = $field->content; ?>
  <?php endif; ?>
  
  
  
<?php endforeach; ?>


<?php

$commentarray = _comment_load($cid);
$userid=$commentarray->uid;
$uptime=$commentarray->timestamp;


$padd=$thread*15;
$padd1=200-$padd;
$padd3=600-$padd;
 /* $viewName1 = 'arabic_text'; 
print views_embed_view($viewName1 , $display_id = 'default', arg(4), arg(5), 'ARB');*/


//print $nodid.$cid."lllllllllll";
// $com_nodid=find_comment_id($cid);



//print '---  '.$total.'---......';
//print_r($com_nodid);
 ?>

<?
$val_show_hide=find_show_hide($cid);

$dis=1;
if($comment=="This comment has been deleted."||$val_show_hide!="hide"){
$dis=0;
}
else{
$dis=1;
}



$temp_user = user_load(array('name' => strip_tags($name)));
 $arr=$temp_user->roles;
$array=$temp_user->roles;

$picture = $temp_user->picture; 

 //print $name.'.........';  print  $comment;
 ?><?php //print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
 
// print $user->rpx_data['profile']['photo'];
 
?>
 <div style="padding-left:40px;color:#993300;"> <b><?php print $_SESSION['msg'];?> </b></div>
 
 
 <?php
 
/* if(arg(7)==111){
	$path=$_SESSION['views'];
	$pieces = explode("/", $path);

	$rr='/'.$pieces[8];
	$rtr=str_replace($rr, " ", $_SESSION['views']);
		$_SESSION['msg'] ="Enter Your Comment";
	drupal_goto($path = $base_url.$_SESSION['views']);

	}*/
	
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
?>

 <span id="<?php print"comment-".$cid; ?>">
<?php  if($value=="Community User"||($value!="Community User" && $value!="Scholar" && $value!="Book Author" )) {?>  

	
	   <table width="100%" border="0" cellpadding="0" style="border-collapse:separate;" >
  <tr>
 <td width="69" valign="top" class="cm_image" style="padding-top:5px;" ><img style="padding-left:15px;" title="Community User" src="<?php print $img_theme_path; ?>/userimage.png" />

	<div style="font-size:9px;color:#333333;font-weight:bold;padding-left:16px;">User</div>
	 <?php	if ($user->uid&&$dis==1){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{

if($dis==1){

?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-left:5px;padding-right:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>


<?php
}


 }?>
	</td>
    <td  valign="top"  ><div style="height:40px;padding-top:7px;padding-left:10px;font-size:12px;margin-left:15px;border-top:dotted 1px #cccccc;background-color:#F7F7F7;">
	<div style="width:390px;float:left;padding-bottom:-2px;" ><span style="display:block;float:left;">
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
	}  else if($temp_user->rpx_data['profile']['photo']!=""&&$dis==1&& $picture=="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php }  else if($temp_user->rpx_data['profile']['photo']==""&&$dis==1&& $picture=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	
	</a>
	<?php if($dis==0) {?><img src="<?php print $img_theme_path; ?>/reported-as-inappropriate.png" /> <?php } ?></span><b>
	
		<?php if($dis==1){ ?>
		
		<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($temp_user->rpx_data['profile']['name']['givenName']==""){
	print "&nbsp;&nbsp;".$name."&nbsp;&nbsp;";
	}
	else {
	print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
	
	}	?></a></b>
	<?	
				
 	 }?>
	 
	   <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	   <?php $count = db_affected_rows($result); ?>
<?php if((($result->cid)!='') && ($dis==1)) { ?>in reply to <?php print printparent($pid);?>&nbsp;<span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print time_since($uptime)." ago "; ?><?php } else { ?>
	 
	 <?php if($dis==1){ ?>in reply to <?php print printparent($pid);?>&nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; ?><?php } } ?> <span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_scholar" style="float:right;padding-top:13px;padding-right:10px; ">
	 
	<?

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_scholar" style="margin-left:15px;padding-left:45px; background-color:#F7F7F7;" >	
				 <?php  // print_r($n); 
		
			if($val_show_hide=="hide"){
			
			 print  $comment;
			 }
			 else{?> <br /><?
			  print  $val_show_hide;
			 }
		// print_r($arr);

		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_comm" style="margin-left:15px;margin-left:15px;background-color:#F7F7F7;border-bottom:dotted 1px #cccccc;"  >
<?php	if ($user->uid&&$dis==1){ ?>

<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/reply/<?php print $com_nodid; ?>/<?php print $cid; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a></span>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<span style="font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;<?php print  $report; ?></span>
&nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/node/163673/<?php print $cid; ?>" class="popups-form-reload" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a></span>



<?php } else {


if($dis==1){
?>

<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a>


<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" /><a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">&nbsp;Report Inappropriate</a>
&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a>




<?php }

else 
{
?>
<!--<span style="font-size:11px;">
<img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />Reply&nbsp;|&nbsp;<img src="<?php print $img_theme_path; ?>/ico_flag.gif" />Report Inappropriate
&nbsp;|&nbsp;<img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</span>-->
<?
}


 } ?>
</div>


		 
	</span>
				 </td>
  </tr>
</table>	
	
<?php

}
if($value=="Scholar") {

?>

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
?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-left:5px;padding-right:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }?>
	</td>
    <td  valign="top"  ><div style="height:40px;padding-top:7px;padding-left:10px;font-size:12px;margin-left:15px;border-top:dotted 1px #cccccc;background-color:#fcf7ec;">
	<div style="width:390px;float:left;padding-bottom:-2px;" ><span style="display:block;float:left;">
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
		}  else if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
		 else if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	</a>
	</span><b>
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	
	<?php if($temp_user->rpx_data['profile']['name']['givenName']==""){
	print "&nbsp;&nbsp;".$name."&nbsp;&nbsp;";
	}
	else {
	print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
	
	}		
 	 ?>
	 
	 </a> </b>
	 
	   <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	    <?php $count = db_affected_rows($result); ?>
       <?php if(($result->cid)!='') { ?>in reply to <?php print printparent($pid);?>&nbsp;<span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print  time_since($uptime)." ago "; ?><?php } else { ?>

	 
	in reply to <?php print printparent($pid);?>&nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; } ?><span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_scholar" style="float:right;padding-top:13px;padding-right:10px;">
	 
	<?

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_scholar" style="margin-left:15px;background-color:#fcf7ec;padding-left:45px;" >	
				 <?php  // print_r($n); 
		 
			if($val_show_hide=="hide"){
			
			 print  $comment;
			 }
			 else{
			  print  $val_show_hide;
			 }
		// print_r($arr);

		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_scholar" style="margin-left:15px;margin-left:15px;background-color:#fcf7ec;border-bottom:dotted 1px #cccccc;"  >
<?php	if ($user->uid){ ?>

<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/reply/<?php print $com_nodid; ?>/<?php print $cid; ?>" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a></span>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>



&nbsp;|&nbsp;<span style="font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;<?php print  $report; ?></span>
&nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/node/163673/<?php print $cid; ?>" class="popups-form-reload" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a></span>


<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img  align="absmiddle"src="<?php print $img_theme_path; ?>/ico_reply.gif" />&nbsp;Reply</a>


<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absmiddle" src="<?php print $img_theme_path; ?>/ico_flag.gif" />&nbsp;Report Inappropriate</a>
&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point"><img align="absbottom" src="<?php print $img_theme_path; ?>/ico_email.gif" />Email this</a>


<?php } ?>
</div>


		 
	</span>
				 </td>
  </tr>
</table>
	
	
	
	
	<?php }if($value=="Book Author") { ?> 
	
		
	
	   <table width="100%" border="0" cellpadding="0" style="border-collapse:separate;" >
  <tr>
 <td width="69" valign="top" class="au_image" style="padding-top:5px;" ><img style="padding-left:15px;" title="Book Author" src="<?php print $img_theme_path; ?>/authorimage.png" />

	<div style="font-size:9px;color:#333333;font-weight:bold;padding-left:8px;">Author</div>

	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-left:5px;padding-right:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
</span>
<?php }?>
	</td>
    <td  valign="top"  ><div style="height:40px;padding-top:7px;padding-left:10px;font-size:12px;margin-left:15px;border-top:dotted 1px #cccccc;background-color:#F8F7E3;">
	<div style="width:390px;float:left;padding-bottom:-2px;" ><span style="display:block;float:left;">
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
		}  else if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
		 else if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.png" /><?php } ?>
	</a>
	</span><b>
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	
	<?php 
			if($temp_user->rpx_data['profile']['name']['givenName']==""){
	print "&nbsp;&nbsp;".$name."&nbsp;&nbsp;";
	}
	else {
	print "&nbsp;&nbsp;".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."&nbsp;&nbsp;";
	
	}		
 	 ?>
	 
	 </a></b>
	 
	   <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	    <?php $count = db_affected_rows($result); ?>
		<?php if(($result->cid)!='') { ?>in reply to <?php print printparent($pid);?>&nbsp;<span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print time_since($uptime)." ago "; ?>
<?php } else { ?>

	 
	 in reply to <?php print printparent($pid);?>&nbsp;<br />&nbsp;&nbsp;<?php print  $created." ago "; } ?><span style="display:block;float:left;padding-top:10px;"></span></div>
	 <div id="comment_vote_scholar" style="float:right;padding-top:13px;padding-right:10px;">
	 
	<?

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>
				 <span ><?php //print $body; ?>
			<div id="comment_body_auth" style="margin-left:15px;background-color:#F8F7E3;padding-left:45px;" >	
				 <?php  // print_r($n); 
		
			if($val_show_hide=="hide"){
			
			 print  $comment;
			 }
			 else{
			  print  $val_show_hide;
			 }
		// print_r($arr);
		 
		 ?></div>
		<?php 
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div id="comment_reply_auth" style="margin-left:15px;margin-left:15px;background-color:#F8F7E3;border-bottom:dotted 1px #cccccc;"  >
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


		 
	</span>
				 </td>
  </tr>
</table>	
	

	
	
	
	
	
	
	
	
	
	<? }

?>
</div>
