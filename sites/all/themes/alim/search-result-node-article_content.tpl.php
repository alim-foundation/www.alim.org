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
  
Article content example view  path are 
biography/khalifa/KAB
/library/biography/khalifa/content/KUM/Al-Faruq/Conversion to Isalm
library/biography/stories/content/SOP/1/Adam/Purpose and History 
/library/biography/companion/content/BIO/Abu Ubaydah ibn al-Jarrah
/islam/article/GIT/Introduction to Islam
/library/islam/world/WOI/Islam A World Civilization

Altered the search-result.tpl.php to link the search result to a view page 
//The link is created  dyanamicaly using each node parameters (article num, section number , article book code etc )
 */
?>

<dt class="title">
<?php   
//creating the title of search reult and url of search result .
//the default node url is altered here and link the search result to the corresponding view of article .
//Checks bookcode and construct the link 
$tax = $node_result->taxonomy;
foreach ($tax as $singletax){
	if($singletax->vid == 6){ $bio = $singletax->name; }
}
$titletxt = $node_result->title;
$code = $node_result->field_art_bk_code[0]['value'];
if($code == 'KAB' || $code == 'KUM' || $code == 'KUT'  || $code == 'KAL'   ){  //biography/khalifa/content/KAB/1/2
	$titletxt =  $node_result->title . ' - ' .$node_result->field_art_sec_head[0]['value'] ;
 	$urlto = 'library/biography/khalifa/content/'.$code.'/'.$node_result->field_art_no[0]['value'].'/'.$node_result->field_art_sec_no[0]['value'] ;
}
else if($code == 'SOP'  ){ //biography/stories/content/SOP/1/1/Adam/Purpose and History 
  	$titletxt .= ' - '.$node_result->field_art_sec_head[0]['value'];
  	$urlto = 'library/biography/stories/content/'.$code.'/' .$node_result->field_art_sec_no[0]['value'].'/'.$node_result->field_art_no[0]['value'].'/'.
	$node_result->title.'/'.$node_result->field_art_sec_head[0]['value'];
}
else if($code == 'BIO'  ){
  		$urlto = 'library/biography/companion/content/'.$code.'/'.$node_result->field_art_no[0]['value'].'/'.$node_result->title ;
}
else if($code == 'GIT'){
		$titletxt .= ' - '.$node_result->field_art_sec_head[0]['value'];
		$urlto = 'library/islam/article/'.$code .'/'.$node_result->title.'/'.$node_result->field_art_sec_head[0]['value'];
}
else if($code == 'WOI'){ //library/islam/world/content/WOI/Islam A World Civilization/1
		$titletxt .= ' - '.$node_result->field_art_sec_head[0]['value'];
		$urlto = 'library/islam/world/content/'.$code .'/'.$node_result->title.'/'.$node_result->field_art_sec_no[0]['value'];
}
else if($code == 'DI'){ //library/islam/islamposters/content/DI/1/Discover Islam
		//$titletxt .= ' - '.$node_result->field_art_sec_head[0]['value'];
		$urlto = 'library/islam/islamposters/content/'.$code .'/'.$node_result->field_art_no[0]['value'].'/'.$titletxt;
}
else {
		//print $code;
}
$titletxt = $bio.' - '.$titletxt;
print l($titletxt,$urlto,array('attributes' => array('target' => '_blank' , 'html' => TRUE)));
?>
</dt>
<dd>
  <?php if ($snippet) : ?>
   <p class="search-snippet"><?php print $snippet; ?></p>
  <?php endif; 
  //print s the taxonomy term if tags
   print alim_search_tags_ctags($node_result->taxonomy);?>
</dd>
<?php // print_r($node_result); ?>
