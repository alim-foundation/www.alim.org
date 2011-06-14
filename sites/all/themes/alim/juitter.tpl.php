<?php // $Id: juitter.tpl.php,v 1.1.2.1 2009/08/21 19:57:19 doublethink Exp $ ?>

<div class="clear-block" id="juitter-main-wrapper">
	<?php print $trends ?>
	<?php if ($search) print $search ?>
	<div id="<?php print $wrap_id ?>"></div>
	<div class="more"  ><a target="_blank" href="http://twitter.com/alimfoundation" >More</a></div>
</div>