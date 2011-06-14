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
global $base_url;
global $theme_path;
?>
<div style="width:50px;">
<div style="float:left">
<a href="<?=$base_url?>/library/quran/ayah/compare/<?=arg(4)?>/<?php print $output; ?>"><?php print $output; ?></a>&nbsp;&nbsp;
</div>
<div style="float:left">
<?php
global $base_url;
$surno = arg(4);
$ayahno = strip_tags($output);
 
   if($surno<10)
	$num1="00".$surno;
   else if($surno>10 && $surno<100)
	$num1="0".$surno;
   else
	$num1=$surno;
		
   if($ayahno<10)
	$num2="00".$ayahno;
   else if($ayahno>=10 && $ayahno<100)
    $num2="0".$ayahno;
   else
	$num2=$ayahno;
	$full = $num1.$num2.".mp3";
?>
<span id="ayahaudio_<?=$ayahno?>" class="right-audio"></span>
</div>
<div style="clear:both"></div>

</div>