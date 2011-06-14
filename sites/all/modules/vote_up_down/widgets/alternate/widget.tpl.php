<?php
// $Id: widget.tpl.php,v 1.1.2.13 2010/03/12 08:10:25 marvil07 Exp $
/**
 * @file
 * widget.tpl.php
 *
 * Alternate widget theme for Vote Up/Down
 */
?>
<div class="vud-widget vud-widget-alternate" id="<?php print $id; ?>">
<?php if ($class_up) : ?>
  <div class="alternate-votes-display"><?php print $unsigned_points.'.'; ?></div>
  <?php if ($readonly): ?>
    <div class="<?php print $class_up; ?>" title="<?php print t('Vote up!'); ?>">  </div>
  <?php else: ?>
    <a href="<?php print $link_up; ?>" class="<?php print $link_class_up; ?>">
      <div class="<?php print $class_up; ?>" title="<?php print t('Vote up!'); ?>">  </div>
    </a>
  <?php endif ?>
<?php endif; ?>
</div>
