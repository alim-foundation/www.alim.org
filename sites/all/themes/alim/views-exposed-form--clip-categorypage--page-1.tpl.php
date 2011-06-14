<?php
/*********************************
The View exposed form tpl is override for this theme
This view prints the exposed form for searching in clipping category.
This form is shown on the page of My profile >> my notebook
/********************************/
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
 // display sort links sort by title and sort by created for clipping (my note book )
 // added some class to provide css styles
 */
 global $base_url;
?>
<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>

<div class="views-exposed-form">
<div class="my_notebook_actions">
		<div class="my_notebook_sort"> <?php //Prints sorting options for asc by data and title   ?>
		<?php if(arg(0)== 'user' && arg(1) == 'clippings' ){ ?>
		<b>Sort By:</b> <span style="margin:4px 8px;"><?php 
	if($_REQUEST['order'] == 'title_1' ){
		if($_REQUEST['sort'] == 'asc' ){
			print l('Topic' , 'user/clippings' ,array('query' => 'order='.$_REQUEST['order'].'&sort=desc' ));?>
			<img height="13" width="13" title="sort descending" alt="sort icon" src="<?php print $base_url; ?>/misc/arrow-desc.png">
			<?php
		}else{
			print l('Topic' , 'user/clippings' ,array('query' => 'order='.$_REQUEST['order'].'&sort=asc' ));
			?><img height="13" width="13" title="sort ascending" alt="sort icon" src="<?php print $base_url; ?>/misc/arrow-asc.png">
			<?php
		}
	}else{
		print l('Topic' , 'user/clippings' ,array('query' => 'order=title_1&sort=asc' ));
	}?></span> 
	<span><?php
	if($_REQUEST['order'] == 'created' ){
		if($_REQUEST['sort'] == 'asc'){
			print l('Date' , 'user/clippings' ,array('query' => 'order='.$_REQUEST['order'].'&sort=desc' ));?>
			<img height="13" width="13" title="sort descending" alt="sort icon" src="<?php print $base_url; ?>/misc/arrow-desc.png"><?php
		}else{
			print l('Date' , 'user/clippings' ,array('query' => 'order='.$_REQUEST['order'].'&sort=asc' )); ?>
			<img height="13" width="13" title="sort ascending" alt="sort icon" src="<?php print $base_url; ?>/misc/arrow-asc.png">
			<?php
		}
	}else{
		print l('Date' , 'user/clippings' ,array('query' => 'order=created&sort=asc' ));
	}
	
	 ?> 
	 </span> <?php } ?></div>
		<div class="my_notebook_search">
			<div class="search_box_label">Search Notes:</div>
			<div class="search_box_bkg">
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
		</div>
	</div>
</div>
</div>



  