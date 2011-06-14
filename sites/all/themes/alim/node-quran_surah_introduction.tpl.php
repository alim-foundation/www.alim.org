<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//The tpl file for surah introduction content type inherited from node.tpl.php 
//This node is not showed  as individually , listed only with views
?>
<?php 
//The default link & title of node page changed to page of surah introduction view
$urlto = 'library/quran/surah/introduction/'.$node->field_surah_no[0]['value'].'/'.$node->field_quran_bk_code[0]['value'] ;
$titletxt = 'Surah - '.$node->field_surah_no[0]['value']; 
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; } 
 
if ($page == 0){ ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($titletxt,$urlto,array()); ?></h2>
	<?php print $node->content['body']['#value']; 
	$cloud = community_tags_display('node', NULL, $node->nid);
	print $cloud; ?>   
</div><div style="clear:both" ></div>
<?php }else{ //outputs node content ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($titletxt,$urlto,array()); ?></h2>
	<?php print $content; ?>
</div>
<?php } ?>



