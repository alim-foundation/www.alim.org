<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//<div class="left"><div class="view" >View</div><div class="edit" >Edit</div></div>
//print_r($node);
//The tpl file for islam history content type inherited from node.tpl.php 
//This node is  not showed  as individually , listed only with views
?>
<?php 
//Default node link is changed to view page 
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; } 
if ($page == 0){ // to display teaser section in tags/taxonomy page  ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
	<h2><?php print l($node->title,'library/references/history/'.$node->title,array()); ?></h2>
	<?php print $node->content['body']['#value'];
	$cloud = community_tags_display('node', NULL, $node->nid);//prints tags
	print $cloud; ?>
</div><div style="clear:both" ></div>
<?php }else{ ?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
<div class="node-<?php print $node->type; ?>"  >
<?php print $picture ?>

<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <?php if ($submitted): ?>
    <span class="submitted"><?php print $submitted; ?></span>
  <?php endif; ?>

  <div class="content clear-block">
    <?php print $content ?>
  </div>

  <div class="clear-block">
    <div class="meta">
    <?php if ($taxonomy): ?>
      <div class="terms"><?php print $terms ?></div>
    <?php endif;?>
    </div>

    <?php if ($links): ?>
      <div class="links"><?php print $links; ?></div>
    <?php endif; ?>
  </div>

</div>
</div>
<?php } ?>



