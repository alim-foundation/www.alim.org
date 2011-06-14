<script>
function colorchange(id)
{
	cookievalue = getCookiesort('selidtext');
	//alert(cookievalue);
	if(cookievalue!=id)
	{
	document.getElementById(id).style.backgroundColor='#D2DFD1';
	document.getElementById(id).style.cursor='pointer';
	}
}
function nocolor(id)
{
	cookievalue = getCookiesort('selidtext');
	//alert(cookievalue);
	if(cookievalue!=id)
	{
	document.getElementById(id).style.backgroundColor='#FFFFFF';
	document.getElementById(id).style.cursor='';
	}
}
</script>
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
 */
  $i=0;
?><div id="clip-all-content"  >
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <?php foreach ($header as $field => $label): ?>
        <th class="views-field views-field-<?php print $fields[$field]; ?>">
          <?php print $label; ?>
        </th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
	<?php
	$i++;
	?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <?php foreach ($row as $field => $content): ?>
          <td class="views-field views-field-<?php print $fields[$field]; ?> selectaudio"  <?php
		  if($fields[$field]=='body') { ?> id="select_<?=$i?>" onMouseOver="colorchange(this.id);" 
onMouseOut="nocolor(this.id);" <?php } ?>  >
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>