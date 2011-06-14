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
 * Altered the search-result.tpl.php to link the search result to a view page  of quran
 * The link is created  dyanamicaly using each node parameters (surah number , ayah number  number and bookcode)
 */
?>
<?php $tax = $node_result->taxonomy; ?>
<dt class="title"> 
<?php  
//Constructs the title and url 
$aya = $node_result->field_ayah_no[0]['value']; $frag = $aya;
$code = $node_result->field_quran_bk_code[0]['value']; // print $code;
if($code == 'ARB' ){
	//$urlto = 'library/quran/surah/arabic/'.$node_result->field_surah_no[0]['value'].'/'.$node_result->field_quran_bk_code[0]['value'] ;
	$urlto = 'library/quran/ayah/compare/'.$node_result->field_surah_no[0]['value'].'/'.$node_result->field_ayah_no[0]['value'] ;$frag = '';
}
else
	$urlto = 'library/quran/surah/english/'.$node_result->field_surah_no[0]['value'].'/'.$node_result->field_quran_bk_code[0]['value'] ;
if( $code == 'TLT'  && $aya == 2  ){ ///library/quran/ayah/compare/1/2
	$urlto = 'library/quran/ayah/compare/'.$node_result->field_surah_no[0]['value'].'/'.$node_result->field_ayah_no[0]['value'] ;
	$title = "Al-Qur'an (Arabic) Surah ".$node_result->field_surah_no[0]['value'];$frag = '';
}
if( $code == 'ARB'  && $aya == 2  ){ ///library/quran/surah/arabic/2/ARB
	$urlto = 'library/quran/surah/arabic/'.$node_result->field_surah_no[0]['value'].'/'.$node_result->field_quran_bk_code[0]['value'] ;
	$title = "Al-Qur'an (Arabic) Surah ".$node_result->field_surah_no[0]['value'];
}
$titletxt = $node_result->title;
$titletxt = $title;
print l($titletxt,$urlto,array('fragment' => $frag, 'html' => TRUE));
?>
</dt>
<dd>
  <?php if ($snippet) : ?>
    <p class="search-snippet"><?php print  $node_result->content['body']['#value'] ;	
	if( $code == 'ARB' ){
		print $snippet;
	}
	 ?></p>
  <?php endif; //prints the tags
  print alim_search_tags_ctags($node_result->taxonomy); ?>
</dd>
<?php // print_r($node_result); ?>
