<?php
// $Id: views-view-table.tpl.php,v 1.8 2009/01/28 00:43:43 merlinofchaos Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 * tpl file for the view clip_userclips - clippings - view to add padding to show the hiearchy in taxonomy .
 */
?>
<div class="user-clips" >
<?php if (!empty($title)) : ?>
<?php $arr = explode('--',$title);
$revarr = array_reverse($arr); //print_r($arr);print_r($revarr);
$d=$revarr[0];
$tid  = $revarr[1];
$path = 'user/myclippings/'.$tid.'/'.$revarr[2];
if($d == 0 ) $d=1; else $d++;
 ?>
  <h3 style="padding-left:<?php print $d*30; ?>px" ><span class="plus">-</span>&nbsp;&nbsp;&nbsp;<span class="book" >
	 <?php  //print '-'.$revarr[2].'-.'.$title.'.';
	 if($revarr[2] == '') 
	 	print 'Others'; 
	 else 
	 	print l($revarr[2] ,$path );  ?>
	 </span></h3>

<?php endif; ?>
<div style="padding-left:<?php print $d*30+50; ?>px" >
<div class="tree-div" >
<table class="<?php print $class; ?>" width="100%" >
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <?php foreach ($row as $field => $content): ?>
          <td   class="views-field views-field-<?php print $fields[$field]; ?>">
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
</div>
</div>
