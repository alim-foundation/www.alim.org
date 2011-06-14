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

$commentarray = _comment_load($cid);
$userid=$commentarray->uid;
$uptime=$commentarray->timestamp;

$temp_user = user_load(array('name' => strip_tags($name)));
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
    <td width="22" valign="top"  >
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	<?php if($picture!="") { ?>

	
	<img  src="<?=$base_url?>/<?=$picture?>"  height="32" width="32" align="absmiddle" alt="image" />
	<?php 
		}  else if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } 
		else if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.jpg" /><?php } ?>
	</a>
	</td>
    <td  valign="top" ><div style="width:600px;height:20px;color:#993300;background-color:#FCE8BD;padding-top:7px;padding-left:10px;font-size:12px;float:left;">

	<div style="width:450px;float:left;" ><b>
	
	<a href="<?=$base_url?>/userprofile/<?=strip_tags($name)?>" class="gotouser">
	
	<?php print $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
				
 	 ?>
	 
	 </a></b>
	 
	  <?php $result = db_fetch_object(db_query("SELECT * FROM {alim_commentedurl} WHERE  cid = %d", $cid)); ?>
	   <?php $count = db_affected_rows($result); ?>
<?php if(($result->cid)!='') { ?><span style="color:#339933;"><br />&nbsp;&nbsp;Edited<?php print " (".$count.")"; ?></span>&nbsp;&nbsp;<?php print time_since($uptime)." ago "; ?><?php } else { ?>
	 
	 &nbsp;&nbsp;&nbsp; <?php print  $created." ago "; } ?></div>
	 <div style="width:150px;float:left;">
	 
	 <?php	if ($user->uid){ ?>
	 
	  <?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:right;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;" src="<?php print $img_theme_path; ?>/likebut.jpg" /><img style="padding-right:5px;"  src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a>
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
<span clicktip="<?php print $idval; ?>" class="clicktip_target" style="text-decoration:none;font-size:11px;">Reply

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;</span> <span style="font-size:11px;"><?php print  $report; ?></span></div>
<div id="<?php print $idval; ?>" class="clicktip" style="display: block;">
  <?php 
$com= drupal_get_form('comment_form',
    array('nid' =>'163607'));
print $com;
?>
<a class="clicktip_close"><span>close</span></a>



<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Reply</a>

<?php if(($userid)==($user->uid)){ ?> &nbsp;|&nbsp;<span style="font-size:11px;"><a href="<?php print $base_url ?>/comment/edit/<?php print $cid; ?>/comid" class="popups" on-popups-options="{reloadWhenDone: true}"  style="text-decoration:none;font-size:11px;"><img align="absmiddle" src="<?php print $img_theme_path; ?>/icon_edit_comment.png" />&nbsp;Edit</a></span><?php } ?>


&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Report Abuse</a>



<?php } ?>

</div>

<?php 
} 

?>
 
