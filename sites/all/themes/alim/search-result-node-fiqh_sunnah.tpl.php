<?php
// $Id: search-result.tpl.php,v 1.1.2.1 2008/08/28 08:21:44 dries Exp $

/**
 * @file search-result.tpl.php
 * Default theme implementation for displaying a single search result.
 *
 * This template renders a single search result and is collected into
 * search-results.tpl.php. This and the parent template are
 * dependent to one another sharing the markup for definition lists.
 *
 * Available variables:
 * - $url: URL of the result.
 * - $title: Title of the result.
 * - $snippet: A small preview of the result. Does not apply to user searches.
 * - $info: String of all the meta information ready for print. Does not apply
 *   to user searches.
 * - $info_split: Contains same data as $info, split into a keyed array.
 * - $type: The type of search, e.g., "node" or "user".
 *
 * Default keys within $info_split:
 * - $info_split['type']: Node type.
 * - $info_split['user']: Author of the node linked to users profile. Depends
 *   on permission.
 * - $info_split['date']: Last update of the node. Short formatted.
 * - $info_split['comment']: Number of comments output as "% comments", %
 *   being the count. Depends on comment.module.
 * - $info_split['upload']: Number of attachments output as "% attachments", %
 *   being the count. Depends on upload.module.
 *
 * Since $info_split is keyed, a direct print of the item is possible.
 * This array does not apply to user searches so it is recommended to check
 * for their existance before printing. The default keys of 'type', 'user' and
 * 'date' always exist for node searches. Modules may provide other data.
 *
 *   <?php if (isset($info_split['comment'])) : ?>
 *     <span class="info-comment">
 *       <?php print $info_split['comment']; ?>
 *     </span>
 *   <?php endif; ?>
 *
 * To check for all available data within $info_split, use the code below.
 *
 *   <?php print '<pre>'. check_plain(print_r($info_split, 1)) .'</pre>'; ?>
 *
 * @see template_preprocess_search_result()
 * Altered the search-result.tpl.php to link the search result to a view page 
 * The link is created  dyanamicaly using each node parameters (fiqh bopok code , fiqh number num, section number , article book code etc )
 */
?>
<dt class="title">
<?php  
//creating the title of search reult and url of search result .
//the default node url is altered here and link the search result to the corresponding view of fiqh page .
$letter = $node_result->field_fq_vol[0]['value'];
if($letter)
	$urlto = 'library/hadith/fiq/'.$node_result->field_fk_bk_code[0]['value'].'/'.$letter.'/'.$node_result->field_fq_num[0]['value'] ;
else
	$urlto = 'library/hadith/fiq/'.$node_result->field_fk_bk_code[0]['value'].'/'.$node_result->field_fq_num[0]['value'] ;
$titletxt = $node_result->title;
print l($titletxt,$urlto,array());
?>
</dt>
<dd>
<?php if ($snippet) : ?>
<div class="search-snippet"><?php 
//Checkes the fiqh body count if > 2000 print default search snippet else prints fiqh text
if(  strlen(strip_tags($node_result->content['body']['#value']))  < 2000   ){
	print  $node_result->content['body']['#value'];
}else{
	print $snippet;
} ?>
</div>
<?php endif; 
print alim_search_tags_ctags($node_result->taxonomy);?>
</dd>
<?php //print_r($node_result); ?>
