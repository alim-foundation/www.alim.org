<?php
// $Id: views-view-unformatted.tpl.php,v 1.6 2008/10/01 20:52:11 merlinofchaos Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
<?php 
if($field_surah_no_value!='55' && $field_quran_bk_code_value!='MAL')
{
?>
  <div class="<?php print $classes[$id]; ?>">
    <?php print $row; ?>
  </div>
 <?php } ?>
<?php endforeach; ?>