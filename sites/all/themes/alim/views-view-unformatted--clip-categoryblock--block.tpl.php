<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 * templte file of clip_category block view 
 * add padding for the clip categories - to categories in a hiearchy 
 */
?>
<div class="group" >
<?php if (!empty($title)): ?>
<?php $arr = explode('--',$title);
$revarr = array_reverse($arr); //print_r($arr);print_r($revarr);
$d=$revarr[0];
$tid  = $revarr[1];
$path = 'user/myclippings/'.$tid.'/'.$revarr[2];
if($d == 0 ) $d=1; else $d++;
 ?>
 <h3 style="padding-left:<?php print $d*5; ?>px" ><span class="plus">-</span>&nbsp;<span class="book" >
	 <?php  //print '-'.$revarr[2].'-.'.$title.'.';
	 if($revarr[2] == '') 
	 	print 'Others'; 
	 else 
	 	print l($revarr[2] ,$path );  ?>
	 </span></h3>
<?php endif; ?>
<div  style="padding-left:<?php print $d*10+15; ?>px" class="group-cnt" >
<?php foreach ($rows as $id => $row): ?>
  <div class="<?php print $classes[$id]; ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>
</div>
