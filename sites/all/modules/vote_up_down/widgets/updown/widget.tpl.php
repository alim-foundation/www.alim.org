<?php
// $Id: widget.tpl.php,v 1.1.2.10 2010/03/12 08:10:25 marvil07 Exp $

/**
 * @file
 * widget.tpl.php
 *
 * UpDown widget theme for Vote Up/Down
 */
?>
<div class="vud-widget vud-widget-updown" id="<?php print $id; ?>">
  <div class="updown-score">
    <span class="updown-current-score"><?php print $unsigned_points; ?></span>
    <?php print $vote_label; ?>
  </div>
  <?php if ($readonly): ?>
    <span class="<?php print $link_class_up; ?>">
      <div class="<?php print $class_up; ?>" title="<?php print t('Vote up!'); ?>">+</div>
    </span>
    <span class="<?php print $link_class_down; ?>">
      <div class="<?php print $class_down; ?>" title="<?php print t('Vote down!'); ?>">-</div>
    </span>
  <?php else: ?>
    <a href="<?php print $link_up; ?>" class="<?php print $link_class_up; ?>">
      <div class="<?php print $class_up; ?>" title="<?php print t('Vote up!'); ?>">+</div>
    </a>
    <a href="<?php print $link_down; ?>" class="<?php print $link_class_down; ?>">
      <div class="<?php print $class_down; ?>" title="<?php print t('Vote down!'); ?>">-</div>
    </a>
  <?php endif ?>
</div>
