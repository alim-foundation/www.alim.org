<?php
// $Id: search-results.tpl.php,v 1.1 2007/10/31 18:06:38 dries Exp $

/**
 * @file search-results.tpl.php
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependant to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $type: The type of search, e.g., "node" or "user".
 *
 * @see template_preprocess_search_results()
 * Render the search results page 
 */
?>
<?php 
// Prints the left counter block only if advanced search , for simplesearch no counter block
if(arg(1) == 'alimsearch' ){ ?>
<a name="top"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:separate;" >
	<tr valign="top" >
		<td width="200" valign="top" style="padding-top:20px;" ><div class="search-lists" ><?php print $counter_left; ?></div></td>
		<td valign="top" >
			<dl class="search-results <?php print $type; ?>-results">
				<?php print $search_results; ?>
			</dl>
			<?php //print $pager; ?>
		</td>
	</tr>
</table>
<?php }else{  
// prints searchresults for simple search ?>
<dl class="search-results <?php print $type; ?>-results">
<?php if(arg(1) != 'alimsearch' ){   // print the page count of search results ?>
	<div style="text-align:right;font-weight:bold;font-size:12px;color:#660000" ><?php print search_count_show(); ?></div> 
<?php } ?>
	<?php print $search_results; ?>
</dl>
<?php print $pager;  ?>
<?php } ?>
