<?php
session_start();
$_SESSION['msg'] ='';
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
<?php foreach ($fields as $id => $field): ?><?php //print $id.'..'; ?>
  <?php if ($id == 'field_quran_bk_code_value'): ?>
    <?php $book = $field->content; ?>
  <?php endif; ?>
   <?php if ($id == 'field_ayah_no_value'): ?>
    <?php $aya = $field->content; ?>
  <?php endif; ?>
  <?php if ($id == 'field_surah_no_value'): ?>
    <?php $sura = $field->content; ?>
  <?php endif; ?>
<?php if ($id == 'field_note_id_value'): ?>
    <?php $note = $field->content; ?>
  <?php endif; ?>
  <?php if ($id == 'body'): ?>
    <?php $body = $field->content; ?>
  <?php endif; ?>
  <?php if ($id == 'nid'): ?>
    <?php $nid = $field->content; ?>
  <?php endif; ?>
 <?php endforeach; 
 
   $viewName = 'shortname_form_code';
				$view4 = views_get_view($viewName);
   $view4->set_display('default');
   $view4->set_arguments(array($book));
   $view4->execute();
   $result4 = $view4->result;
 $rr_name= $result4[0]->node_title;
 
 ?>
 <?php  $viewName = 'shortname_form_code';
				$view4 = views_get_view($viewName);
   $view4->set_display('default');
   $view4->set_arguments(array($book));
   $view4->execute();
   $result4 = $view4->result;
 // print $result4[0]->node_title;
				 ?> <?php //print $note; ?>
 
 <div id="<?php print "ayanote-".$note; ?>" style="padding-left:40px;color:#993300;"> <b><?php print $_SESSION['msg'];?> </b></div>
<div style="padding-left:40px;">

<div style="width:615px;height:20px;color:#993300;background-color:#E5E5E5;padding-top:7px;padding-left:10px;font-size:12px;padding-bottom:3px;">
	<div style="width:430px;float:left;" ><b><?php print $rr_name;
				
 	 ?></b>&nbsp;&nbsp;&nbsp;</div>
	 <div style="width:175px;float:left;">
	 
	 <?php	if ($user->uid){ ?>
	 <style>
	 #quicktabs_container_2 #vud_ap_vote, #quicktabs_container_2 #votes_text
	 {
	  display:none; 
	 }
	 #quicktabs_container_2 .vud-widget-plain
	 {
	   color:#FFFFFF;
	   padding-left:10px;

	 }
	 #quicktabs_container_2 .total-votes-plain
	 {
	  margin-right:3px;
	  
	 }
	 </style>
	  <div style="clear:both;">
	   <div style="padding-right:10px;">
	  <?php 

  print vud_votes_proxy($nid, 'node', 'vote', 'plain', $readonly=NULL); ?>

 </div>
 
 <div style="margin-top:-17px;">&nbsp;
 <?php
  print vud_widget_proxy($nid, 'node', 'vote', 'plain', $readonly=NULL); ?>
</div></div>
 	<?php }

else{?>
	 <span id="not_log"  ><?php
print vud_votes_proxy($nid, 'node', 'vote', 'plain');

?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:right;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;" height="18px"  width="18px" src="<?php print $img_theme_path; ?>/likebut.png" /><img style="padding-right:5px;"  height="18px"  width="18px"   src="<?php print $img_theme_path; ?>/unlikebut.png" /></a>
</span>
<?php }
//print vud_widget_proxy($nid, 'node', 'vote', 'plain', $readonly=NULL);
//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>

</div>



 <table width="100%" border="0" cellpadding="5" >

  <tr>
    <td width="22" ><img src="<?php print $img_theme_path; ?>/bookicon.png" /> <? //print arg(7).',,,'; 
	//if(arg(7)==111){
	//$path=$_SESSION['views'];
	//$pieces = explode("/", $path);
	// piece2
	//$rr='/'.$pieces[8];
	////$rtr=str_replace($rr, " ", $_SESSION['views']);
	//	$_SESSION['msg'] ="Enter Your Comment";
	//drupal_goto($path = $base_url.$_SESSION['views']);

	//}
	
	
	?></td>
    <td  valign="top" ><span class="authorname" ><?php  $viewName = 'shortname_form_code';
				$view4 = views_get_view($viewName);
   $view4->set_display('default');
   $view4->set_arguments(array($book));
   $view4->execute();
   $result4 = $view4->result;
  print $result4[0]->node_title;
				 ?> <?php print $note; ?></span>
				 <span><?php print $body; ?>
				
				 <?php  //$n = node_load($nid);// print_r($n); 
				// print node_view($n);
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
