<?php
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
 global $user;
 global $theme_path;
  global $base_url; 
  $img_theme_path = $base_url."/".$theme_path."/images"; 
?>
<?php foreach ($fields as $id => $field): ?>


<?php if($id == 'nid' ): ?>
  
  <?php $nid= $field->content; ?>
  <?php endif; ?>
  
  
  <?php if($id == 'body' ): ?>
  
  <?php $body= $field->content; ?>
  <?php endif; ?>
  
  



 
<?php endforeach; 

if(arg(5)=="ASD"){
$name_auth="Asad";
}
if(arg(5)=="MAL"){
$name_auth="Malik";
}
if(arg(5)=="PIK"){
$name_auth="Pickthall";
}
if(arg(5)=="YAT"){
$name_auth="Yusuf Ali";
}

?>


 <div style="padding-left:40px;">

<div style="width:615px;height:20px;color:#993300;background-color:#E5E5E5;padding-top:7px;padding-left:10px;font-size:12px;padding-bottom:3px;">
	<div style="width:430px;float:left;" ><b><?php //print $name_auth;
				
 	 ?></b>&nbsp;&nbsp;&nbsp;</div>
	 <div style="width:175px;float:left;">
	 <?php	if ($user->uid){ ?>
	 <div style="clear:both;">
	   <div style="">
	  <?php

 print vud_votes_proxy($nid, 'node', 'vote', 'plain', $readonly=NULL); 
 ?>
 </div>
 
 <div style="margin-left:118px;margin-top:-17px;">
 <?php
  print vud_widget_proxy($nid, 'node', 'vote', 'plain', $readonly=NULL); ?>
  </div></div>
	<?php }

else{?>
	 <span id="not_log"  ><?php //print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
print vud_votes_proxy($nid, 'node', 'vote', 'plain');

?>	<a class="rpxnow" style="text-decoration:none;color:#333333;font-size:11px;float:right;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php print $base_url; ?>/rpx/end_point">  <img style="padding-right:5px;" height="18px"  width="18px" src="<?php print $img_theme_path; ?>/likebut.png" /><img style="padding-right:5px;"  height="18px"  width="18px"   src="<?php print $img_theme_path; ?>/unlikebut.png" /></a>
</span>
<?php }

//print vud_widget_proxy($cid, 'comment', 'vote', 'plain', $readonly=NULL);
/*$n = node_load($com_nodid);
$com = _comment_load($cid);
print alim_comment_view($com,$n, $links = array(), $visible = TRUE);
*/
?></div></div>

</div>

<span style="padding-left:30px;">

<?

//print $nid.".........";
  
  print $body;

?>
<br /><br />
 </span>