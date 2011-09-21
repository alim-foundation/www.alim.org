<?php
// $Id: views-view-row-rss.tpl.php,v 1.1 2008/12/02 22:17:42 merlinofchaos Exp $
/**
 * @file views-view-row-rss.tpl.php
 * Default view template to display a item in an RSS feed.
 *
 * @ingroup views_templates
 */
 
 // Edit the rss comment tpl
 
global $base_url;

//$check = addslashes(strip_tags($title)); // assign comment title to the variable

//$check = strip_tags($title); // assign comment title to the variable

$check = $title;

$arr_exp = explode('comment',$item_elements);
$arrexp2 = explode(' at',$arr_exp[1]);

// Query the comment details using title.

$query = db_query("SELECT node.nid AS nid, comments.name AS comments_name, comments.uid AS comments_uid, comments.homepage AS comments_homepage, comments.comment AS comments_comment, comments.format AS comments_format, node_data_field_comment_url.field_comment_url_value AS node_data_field_comment_url_field_comment_url_value, node.type AS node_type, node.vid AS node_vid, comments.cid AS comments_cid, comments.timestamp AS comments_timestamp FROM node node  LEFT JOIN comments comments ON node.nid = comments.nid LEFT JOIN content_field_comment_url node_data_field_comment_url ON node.vid = node_data_field_comment_url.vid WHERE comments.cid = '".$arrexp2[0]."' ORDER BY comments_timestamp DESC");

$result = db_fetch_object($query);
$link_val = $result->node_data_field_comment_url_field_comment_url_value; // fetch the comment page url.


 /*  $view2 = views_get_view("recent_comments_embed");
   $view2->set_display('default');
   $view2->set_arguments(array($check));
   $view2->execute();
   $res = $view2->result;
  
	   //$link_val1 = $res[0]->node_data_field_comment_url_field_comment_url_value;
	  // $comm_title = $res[0]->comments_subject;*/


  
// Re-write the XML fields.
if($result->node_type=="group_post")
{
	$node = node_load($result->node_vid);
	foreach($node->og_groups as $key=>$values)
	{
	
	$link_val = "groupdetails/".$values."#post_".$result->node_vid;
	}
}
?>
  <item title_url="<?=$base_url."/".$link_val?>">
     <title title_url="<?=$base_url."/".$link_val?>"><?php print $title; ?></title>
	 <link><?=$base_url."/".$link_val?></link>
    <description><?php print $description; print $item_elements->guid; ?></description>
    <?php print $item_elements; ?>
  </item>
