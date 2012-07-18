<?php

global $base_url;
global $theme_path;


// $Id: block.tpl.php,v 1.3 2007/08/07 08:39:36 goba Exp $
?>
<!--<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="clear-block block block-<?php print $block->module ?>">
-->
<?php if (!empty($block->subject)): ?>
  <h2><?php print $block->subject ?></h2>
<?php endif;?>

 <?php //print $block->content
  
   $r= strip_tags($block->content, '<a>');
 $tt= stristr($r,'href=');
 $t3= stristr($tt,'Google');
$url= str_replace($t3," ",$tt);
  
   
  
   ?><span >  <?php print '<a '.$url ;?>  Login <span id="login_home_rpx" style="padding-top:10px;"></span></a></span>
<!--</div>-->
