<?php
// $Id: votes.tpl.php,v 1.1.2.8 2010/03/12 08:06:45 marvil07 Exp $
/**
 * @file
 * votes.tpl.php
 *
 * Plain widget votes display for Vote Up/Down
 */
?>
<span id="<?php print $id; ?>" class="total-votes-plain"><span class="<?php print $class; ?> total"><?php print $up_votes; ?>&nbsp;votes&nbsp;<?php print $down_votes; ?>&nbsp;&nbsp;dislikes<?php //print $vote_label; ?></span></span>
