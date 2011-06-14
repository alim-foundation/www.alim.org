<?php
// $Id: views-view-field.tpl.php,v 1.1 2008/05/16 22:22:32 merlinofchaos Exp $
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php  //print $output.'........'; ?>

<?php
$dest= drupal_get_destination();
$dest= str_replace("destination=","/",$dest);
$dest= str_replace("%2F","/",$dest);
session_start();
$_SESSION['views']=$dest;

?>

<?php

//global $user;

 ?>
<?php	
//$idd="ctdef12".$output;

//if ($user->uid){ ?>
<!--<span clicktip="<?php print $idd; ?>" class="clicktip_target" style="padding-bottom:20px;" ><b>Post Comment</b><br/></span>
<div id="<?php print $idd; ?>" class="clicktip" style="display: block;">-->
  <?php 
//$com= drupal_get_form('comment_form',
   // array('nid' => $output));
//print $com;
?>
<!--<a class="clicktip_close"><span>close</span></a></div>-->
<?php // }else {  ?>
<!--<a  class="rpxnow" style="text-decoration:none;color:#333333;font-size:12px;padding-bottom:20px;" onclick="return false;" href="https://alim-foundation.rpxnow.com/openid/v2/signin?token_url=<?php// print $base_url; ?>/rpx/end_point"><b>Post Comment</b></a> <br/>-->

<?php   //}  ?>



