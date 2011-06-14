<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//<div class="left"><div class="view" >View</div><div class="edit" >Edit</div></div>
//print_r($node);
//The tpl file for Hadith content type inherited from node.tpl.php 
//This node is  not showed  as induvidually , listed only with views
?>
<?php 
$vol = $node->field_hd_vol_number[0]['value'];
$code = $node->field_hd_book_code[0]['value'];
//override default node page to view page of hadith , eg : library/hadith/AMH/1/1
if($vol) //if hadith have volume
	$urlto = 'library/hadith/'.$code.'/'.$node->field_hd_number[0]['value'].'/'.$vol ;
else
	$urlto = 'library/hadith/'.$code.'/'.$node->field_hd_number[0]['value'] ;
$titletxt = $node->title;   
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; }

if ($page == 0){ ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php  if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
  <h2 class="title" ><?php print l($titletxt,$urlto,array('attributes' => array( 'class' => 'meroon' ))); ?></h2>
	<?php print $node->content['body']['#value'];
	$cloud = community_tags_display('node', NULL, $node->nid); //Print community tags
	print $cloud;  ?>
</div>
<?php }else{ ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($titletxt,$urlto,array()); ?></h2>
	<?php print $content; ?>
</div>
<?php } ?>


