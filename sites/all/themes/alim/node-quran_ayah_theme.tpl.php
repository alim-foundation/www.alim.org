<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//Ayah Themes /library/quran/ayah/theme/1
//The tpl file for ayah theme content type inherited from node.tpl.php 
//This node is  not showed  as individually , listed only with views
?>
<?php 
//default link to node page changed to the page of ayah themes view
$urlto = 'library/quran/ayah/theme/'.$node->field_surah_no[0]['value'] ;
$titletxt = $title; 
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; } 
if ($page == 0){ //ouput teaser section fot tag/taxonomy pages  ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
  <h2><?php print l($titletxt,$urlto,array()); ?></h2>
   <?php print $node->content['body']['#value']; 
    $cloud = community_tags_display('node', NULL, $node->nid);//print tags
	 print $cloud; ?>   
</div><div style="clear:both" ></div>
<?php }else{ // output node page ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
<h2><?php print l($titletxt,$urlto,array()); ?></h2>
<?php print $content; ?>
</div>
<?php } ?>


