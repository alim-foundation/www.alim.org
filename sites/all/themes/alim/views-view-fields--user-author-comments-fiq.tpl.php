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
  
  
 
<?php endforeach; ?>


<?php
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
$temp_user = user_load(array('name' => $name));
$array=$temp_user->roles;

$key = array_search('Book Author', $array);
//print_r($temp_user);
if($com_nodid==$nodid){

if($key!=""){

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
	
 ?>
 
 
  <table width="100%" border="0" cellpadding="5" >
  <tr>
    <td width="22" valign="top" ><?php if($temp_user->rpx_data['profile']['photo']!="") {?><img height="38px"  width="48px" src="<?php print $temp_user->rpx_data['profile']['photo']; ?>" /><?php } ?>
	<?php if($temp_user->rpx_data['profile']['photo']=="") {?><img src="<?php print $img_theme_path; ?>/photobg.jpg" /><?php } ?>
	
	</td>
    <td  valign="top" ><div style="width:600px;height:20px;color:#993300;background-color:#FCE8BD;padding-top:7px;padding-left:10px;font-size:12px;">
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
		 if($comment == " "){
		 	 print  "No Comments";
		 
		 }
		 
			/*	 $node=node_view($n);
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
$rrtt="ctdef1".$cid;  $idval = 'ctdef1-'.$cid;?>
<div style="padding-left:510px;font-size:12px;font-weight:bold;padding-bottom:20px;">
<?php	if ($user->uid){ ?>

<span clicktip="<?php print $idval; ?>" class="clicktip_target" style="text-decoration:none;font-size:11px;">Reply&nbsp;|&nbsp;</span> <span style="font-size:11px;"><?php print  $report; ?></span>
<?php /* $viewName = 'report_link';
	 print views_embed_view($viewName , $display_id = 'default', $cid);*/ ?>
				 
				  </div>
<div id="<?php print $idval; ?>" class="clicktip" style="display: block;">
  <?php 
//$_SESSION['ap_node_id'] = $com_nodid;
  
//session_start(); $com_nodid=$_SESSION['ap_node_id'];
$com= drupal_get_form('comment_form',
    array('nid' =>$com_nodid));
	
print $com;


?>
<a class="clicktip_close"><span>close</span></a>

<?php } else {?>

<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Reply</a>&nbsp;|&nbsp;<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">Report Abuse</a>
<?php } ?>
</div>

<?php } 

} 
?>

