<?php
  global $base_url;
    global  $user;
   global $theme_path;
  $img_theme_path = $base_url."/".$theme_path."/images"; 
// $Id: widget.tpl.php,v 1.1.2.12 2010/03/12 08:10:25 marvil07 Exp $
/**
 * @file
 * widget.tpl.php
 *
 * Plain widget theme for Vote Up/Down
 */
?>
<div class="vud-widget vud-widget-plain" id="<?php print $id; ?>">
<?php if ($class_up): ?>
  <?php if ($readonly): ?>
  
  
    
  <?php else: ?><span id="vud_ap_vote" ><?php print '<h3 style="padding-left:20px;">'.$up_votes.'</h3>'; ?>&nbsp;</span>&nbsp;<span id="votes_text" style="font-size:13px;font-family:tahoma;">&nbsp;votes</span>
  
  <a href="<?php print $link_up; ?>" class="<?php print $class_up.'test'; ?>">
      <span class="<?php print $class_up.'tt' ; ?>" title="<?php print t('Vote up this comment!'); ?>" style="float:left;"><?php if ( $user->uid ) { ?> <img src="<?php print $img_theme_path; ?>/likebut.jpg" /><?php } ?></span>
    </a>
    
      <span title="<?php print t('Dislike this comment!'); ?>"  class="<?php print $class_down; ?>"> <?php	if ($user->uid){ ?> <a class="popups" on-popups-options="{reloadWhenDone: true}" href="<?php print $base_url;?>/dislikereason/result/<?php print $cid;?>/vote"><img src="<?php print $img_theme_path; ?>/unlikebut.jpg" /></a> <? } ?></span>

	&nbsp;&nbsp;&nbsp;&nbsp;<span style="padding-right:12px;font-weight:bold;">&nbsp;<?php print downvotes($cid); ?></span><div id="votes_text" style="font-size:12px;font-family:tahoma;">&nbsp;&nbsp;dislikes</div>

  <?php endif ?>
<?php endif; ?>

</div>
