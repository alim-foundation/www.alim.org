
	<?php
	// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
	?>
	<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">
	
	<?php print $picture ?>
	
	<?php if ($page == 0): ?>
	 <h2> <div id="blogs_title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></div></h2>
	<?php endif; ?>
	   <div id="news_body"> 
	  <p>testing testing testing </p>
	   <?php print $content ?></div>
	  
	   
	   <div id="spacing" style="padding-bottom: 10px;">&nbsp; </div>
</div>
	<script type="text/javascript">
	  $(document).ready(function() {
			$('#thetitle').css({'color': '#693',
											});
	  });
	
	</script>
	<div id="block-news-tag" >
<?php
global $user;
global $base_url; 

$i = $node->nid;  // the nodeid where to add tags 
//print $i;
if($i != "" ){

if($user->uid){

	global $base_url;
global $theme_path;
$file_path = $base_url."/".$theme_path."/";
 drupal_add_js(drupal_get_path('theme', 'alim') . '/jquery.tools.min.js');
            $x= 'jQuery.noConflict();';
  			$script = '$("#demo img[title]").tooltip({ 
			offset: [35, 170],
			events: {
		    def:"click,blur"
  	                }
        });';
 		 drupal_add_js($script, 'inline', 'header');
		 drupal_add_js($x, 'inline', 'header');
		  //Jquery code and text to show the help text for tags as a popup
	?>
	<div>
	<div class="head" >Tags&nbsp <div id="demo" style="float:right;"><img src="<?=$base_url.'/'.$theme_path?>/images/help-brownish.gif"   title="<div class='tooltop1'></div><div class='toolmiddle1'>Any content page on the site can be “tagged” by clicking on the “Add Tag” button. A tag is any word or group of words which best describes the subject of the page it belongs to. So for example, let’s say you want to search for ayaat pertaining to the subject of tawhid (i.e. Islamic monotheism). Searching for the word tawhid itself won’t yield many results. What you really need is a way to find ayaat whose subject is tawhid but the word tawhid doesn’t necessarily appear in them. Tagging solves this problem. If you were to be reading, for example, Surah Ash-Shura ayah 11 it might come to your mind that the subject of the ayah includes the topic of tawhid. So you can now tag that page with the word “tawhid”. Thereafter, whenever someone searches for the word “tawhid”, Surah Ash-Shura ayah 11 would appear in the search results.
</div><div class='toolbottom1'></div>" />
</div></div>
	<div class="add-tag" ><a href="#" class="hideadd-tags"  >Add Tags</a><?php //Add tags and search tag button  
print l('Search Tags', 'tags/alltags' );
?></div>
	</div>
<?php
}
$output=community_tags_node_view($i, TRUE);//print the tags and form function in community tag module 
print $output; 
//jquery to show hide the add tag form on click of add button
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	$('#block-news-tag').find("#edit-tags-wrapper").hide();
	$('#block-news-tag .hideadd-tags').click(function() {
		$('#block-news-tag').find("#edit-tags-wrapper").toggleClass("active").toggle('slow');
		$(this).toggleClass("activectag");
		return false;
	});
	
});
</script>
<?php }

//The new tag a user added is copied to this hiddden field to add the tag name to ggoogle analytics
//this hidden field is used because community tag module make the original text field for new tag to null value before submitting
?>
<div id="hidden-tag" style="display:none:" ><input type="hidden" value="" name="hidden-tag-text" class="tag-hidden" /></div>

<div style="float:right; clear:both;"><span class="news-rtn"></span><a  class="news-return" href="/news" >Return to News and Views home</a></div>


</div>
