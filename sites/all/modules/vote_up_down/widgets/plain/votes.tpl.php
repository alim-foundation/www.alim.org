<?php
// $Id: votes.tpl.php,v 1.1.2.8 2010/03/12 08:06:45 marvil07 Exp $
/**
 * @file
 * votes.tpl.php
 *
 * Plain widget votes display for Vote Up/Down
 */
?>
<span id="<?php print $id; ?>" class="total-votes-plain"><span class="<?php print $class; ?> total"><?php print $up_votes; ?>&nbsp;votes&nbsp;<?php print $down_votes; ?>&nbsp;&nbsp;dislikes<?php //print $vote_label; ?>
<span  ></span>&nbsp;<span  style="font-size:13px;font-family:tahoma;"></span>

  <a href="<?php print $link_up; ?>" class="<?php print $link_class_up; ?>">
      <span class="<?php print $class_up; ?>" title="<?php print t('Vote up!'); ?>"></span>
    </a>
    <a href="<?php print $link_down; ?>" class="<?php print $link_class_down; ?>">
      <span class="<?php print $class_down; ?>" title="<?php print t('Vote down!'); ?>">  </span>
    </a>
	<span  style="font-size:12px;font-family:tahoma;"></span>
	



</span></span>
