<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
//<div class="left"><div class="view" >View</div><div class="edit" >Edit</div></div>
//print_r($node);
//The tpl file for quran ayah content type inherited from node.tpl.php 
?>
<?php 
//To genrate the url to link this node to the corresponding view page of quran 
if(arg(0) == 'comment' && arg(1) == 'reply'  ){ $cls = ' comment-node'; } 
if ($page == 0){ // to show the tag/taxonomy page
 $code = $node->field_quran_bk_code[0]['value'];
 $aya = $node->field_ayah_no[0]['value'];
 $t = $node->title;
 if($code == 'ARB' ){ ///library/quran/ayah/compare/1/2/supplication-to-allah-for-guidance-taught-by-allah-himself
 	$urlto = 'library/quran/ayah/compare/'.$node->field_surah_no[0]['value'].'/'.$node->field_ayah_no[0]['value'] ;
	$title ="Compare Translations Surah ".$node->field_surah_no[0]['value']." Ayah ".$node->field_ayah_no[0]['value'] ;
 }
 //Check quran codes and generate the title and url
 if($code == 'ASD' || $code == 'PIK' || $code == 'MAL' || $code == 'YAT' || $code == 'TLT'  ){ ///library/quran/surah/english/2/ASD
 	$urlto = 'library/quran/surah/english/'.$node->field_surah_no[0]['value'].'/'.$code ;
	switch ($code) {
		case 'PIK':
			$title ="Pickthall Translation Surah ".$node->field_surah_no[0]['value'];
			break;
		case 'MAL':
			$title ="Malik Translation Surah ".$node->field_surah_no[0]['value'];
			break;
		case 'YAT':
			$title ="Yusuf Ali Translation Surah ".$node->field_surah_no[0]['value'];
			break;
		case 'ASD':
			$title ="Asad Translation Surah ".$node->field_surah_no[0]['value'];
			break;
		case 'TLT':
			$title ="Al-Qur'an (Arabic) Transliteration Surah ".$node->field_surah_no[0]['value'];
			break;
	}
	
 }
if( $code == 'TLT'  && $aya == 2  ){ ///library/quran/ayah/compare/1/2
 	$urlto = 'library/quran/ayah/compare/'.$node->field_surah_no[0]['value'].'/'.$node->field_ayah_no[0]['value'] ;
	$title ="Compare Translations Surah ".$node->field_surah_no[0]['value']." Ayah ".$node->field_ayah_no[0]['value'] ;
 }
if( $code == 'ARB'  && $aya == 2  ){ ///library/quran/surah/arabic/2/ARB
 	$urlto = 'library/quran/surah/arabic/'.$node->field_surah_no[0]['value'].'/'.$code ;
	$title = "Al-Qur'an (Arabic) Surah ".$node->field_surah_no[0]['value'];
 }

 ?>
<div id="node-<?php print $node->nid; ?>" class="node-teaser<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?><?php print $cls; ?>">
  <h2><?php print l($title ,$urlto,array()); ?></h2>
	<?php $cloud = community_tags_display('node', NULL, $node->nid);//print community tags 
	print $cloud; ?>
</div>
<div style="clear:both" ></div>
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
<?php //print_r($node); ?>


