<?php
// $Id: views-exposed-form.tpl.php,v 1.4.4.1 2009/11/18 20:37:58 merlinofchaos Exp $
/**
 * @file views-exposed-form.tpl.php
 *
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>
<?php foreach($widgets as $id => $widget): ?>
<?php 
 if($id == "filter-value"): $pname = $widget->widget; $pnamelabel = $widget->label; endif; 
// if($id == "filter-mail"):  $mail = $widget->widget; $maillabel = $widget->label; endif; 
 if($id == "filter-rid"):   $role = $widget->widget; $rolelabel = $widget->label; endif;
 //if($id == "filter-uid"):   $username = $widget->widget; $usernamelabel = $widget->label; endif;
?>
<?php endforeach; ?>
<div class="views-exposed-form">
  <div class="views-exposed-widgets clear-block">
<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="350" align="left" valign="top"><b><?php print $pnamelabel; ?></b><?php print $pname; ?></td>
    <td width="50" align="center" valign="top" ><b><?php print $rolelabel; ?></b>  <?php print $role; ?></td>
    <td width="250" align="left"  valign="top"><div class="views-exposed-widget" style="padding-top:60px;"> <?php print $button; ?> </div> </td>
  </tr>
</table>
</div>
</div>
<!--<div class="views-exposed-form">
  <div class="views-exposed-widgets clear-block">
    <?php foreach($widgets as $id => $widget): ?>
      <div class="views-exposed-widget">
        <?php if (!empty($widget->label)): ?>
          <label for="<?php print $widget->id; ?>">
            <?php print $widget->label; ?>
          </label>
        <?php endif; ?>
        <?php if (!empty($widget->operator)): ?>
          <div class="views-operator">
            <?php print $widget->operator; ?>
          </div>
        <?php endif; ?>
        <div class="views-widget">
          <?php print $widget->widget; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="views-exposed-widget">
      <?php print $button ?>
    </div>
  </div>
</div>-->