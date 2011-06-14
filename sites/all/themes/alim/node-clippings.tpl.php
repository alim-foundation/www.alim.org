<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//<div class="left"><div class="view" >View</div><div class="edit" >Edit</div></div>
//print_r($node);//print_r($node->taxonomy); 
//The tpl file for Clippings content type inherited from node.tpl.php 
//Show a page that user clipped and it's teaser
?>
<?php  if ($page == 0){ ?>
<div id="node-clips-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php print 'node-'.$node->type; ?>">
<div class="subclipping">
	<div class="subclipping_actions">		
		<div class="right"></div>
	</div>
	<div class="subclipping_background">
		<div class="subclipping_content">
			<h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
			<div class="clipping_date">saved on <?php print $submitted; ?> </div>
			<div class="content clear-block"> <?php print $content ?> </div>
			<br /><?php print l('View The original page clipped' , $node->field_comment_url[0]['value'] , array('attributes' => array('class' => 'morepage' , 'target' =>'_blank' ) )); ?>
		</div>
	</div>
</div>
</div>
<?php }else{
foreach ($node->taxonomy as $k => $v){
	$tid = $v->tid;
	$tname = $v->name;
}
?>
<div id="node-clips-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php print 'node-'.$node->type; ?>">
<div class="subclipping">
	<div class="subclipping_actions">		
		<div class="right"></div>
	</div>
	<div class="subclipping_background">
		<div class="subclipping_content">
			<h2><?php print $title ?></h2>
			<div><span class="book"><?php print l($tname,'user/myclippings/'.$tid.'/'.$tname); ?></span></div>
			<div class="clipping_date">saved on <?php print $submitted; ?> </div>
			<div class="content clear-block"> <?php print $content ?> </div>
			<br /><?php print l('View The original page clipped' , $node->field_comment_url[0]['value'] , array('attributes' => array('class' => 'morepage' , 'target' => '_blank' ) )); ?>
		</div>
	</div>
</div>
</div>
<?php } ?>
