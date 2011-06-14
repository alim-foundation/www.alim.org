<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//print_r($node);
//The tpl file for islam article content type inherited from node.tpl.php 
//This node is  not showed  as induvidually , listed only with views
?>
<?php 
//To genrate the url to link this node to the corresponding view page of article 
$titletxt = $node->title;  
$code = $node->field_art_bk_code[0]['value'];
if($code == 'KAB' || $code == 'KUM' || $code == 'KUT'  || $code == 'KAL'   ){  //biography/khalifa/content/KAB/1/2 to biography page
	$titletxt =  $node->title . ' - ' .$node->field_art_sec_head[0]['value'] ;
	$urlto = 'library/biography/khalifa/content/'.$code.'/'.$node->field_art_no[0]['value'].'/'.$node->field_art_sec_no[0]['value'] ;
}
else if($code == 'SOP'  ){ //biography/stories/content/SOP/1/1/Adam/Purpose and History Stories of prophet
	$titletxt .= ' - '.$node->field_art_sec_head[0]['value'];
	$urlto = 'library/biography/stories/content/'.$code.'/' .$node->field_art_sec_no[0]['value'].'/'.
	$node->field_art_no[0]['value'].'/'.$node->title.'/'.$node->field_art_sec_head[0]['value'];
}
else if($code == 'BIO'  ){
	$urlto = 'library/biography/companion/content/'.$code.'/'.$node->field_art_no[0]['value'].'/'.$node->title ;
}
else if($code == 'GIT'){
	$titletxt .= ' - '.$node->field_art_sec_head[0]['value'];
	$urlto = 'library/islam/article/'.$code .'/'.$node->title.'/'.$node->field_art_sec_head[0]['value'];
}
else if($code == 'WOI'){ //library/islam/world/content/WOI/Islam A World Civilization/1
	$titletxt .= ' - '.$node->field_art_sec_head[0]['value'];
	$urlto = 'library/islam/world/content/'.$code .'/'.$node->title.'/'.$node->field_art_sec_no[0]['value'];
}
else if($code == 'DI'){ //library/islam/islamposters/content/DI/1/Discover Islam
	$urlto = 'library/islam/islamposters/content/'.$code .'/'.$node->field_art_no[0]['value'].'/'.$titletxt;
}
else {
	//print $code;
}
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; }  // only for comment reply page
//Tag page or taxonomy page for the section 
//prints a teaser and link to view page of article and lists the tag
if ($page == 0){  //ouput teaser section fot tag pages ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
  <h2><?php print l($titletxt,$urlto,array()); ?></h2>
  <?php print $node->content['body']['#value'];
	$cloud = community_tags_display('node', NULL, $node->nid);	
 	print $cloud; ?>
</div>
<div style="clear:both" ></div>
<?php }else{ // output node page  ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($titletxt,$urlto,array()); ?></h2>
	<?php print $content; ?>
</div>
<?php } ?>



