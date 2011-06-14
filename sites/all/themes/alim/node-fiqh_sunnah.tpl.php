<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//<div class="left"><div class="view" >View</div><div class="edit" >Edit</div></div>
//print_r($node);
//The tpl file for Fiqh content type inherited from node.tpl.php 
//This node is  not showed  as individually , listed only with views
?>
<?php  
$letter = $node->field_fq_vol[0]['value'];
// changed the default node link to view page
if($letter) ///library/hadith/fiq/FQS/1/1
	$urlto = 'library/hadith/fiq/'.$node->field_fk_bk_code[0]['value'].'/'.$letter.'/'.$node->field_fq_num[0]['value'] ;
else
	$urlto = 'library/hadith/fiq/'.$node->field_fk_bk_code[0]['value'].'/'.$node->field_fq_num[0]['value'] ;
$titletxt = $node->title;
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; } 

if ($page == 0){  // To show tags in taxonomy/tag pages  ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
  <h2><?php print l($titletxt,$urlto,array('attributes' => array( 'class' => 'meroon' ))); ?></h2>
<?php print $node->content['body']['#value'];
	$cloud = community_tags_display('node', NULL, $node->nid);//Print tags
	print $cloud; ?>
</div><div style="clear:both" ></div>
<?php }else{ ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($titletxt,$urlto,array()); ?></h2>
	<?php print $content; ?>
</div>
<?php } ?>

