<?php
// $Id: node.tpl.php,v 1.5 2007/10/11 09:51:29 goba Exp $
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?>">

<?php print $picture ?>

<?php if ($page == 0): ?>
 <h2> <div id="blogs_title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></div></h2>
<?php endif; ?>

    <?php  //echo "Posted By " ?>
<!--	<a href="<?php $base_url?>/userprofile/<?php print $user_load->name ?>">
<b>

    <span class="submitted"><?php print $name; ?></span><br />
</b>
</a>
	<span style=" float:right;margin-top: -16px;margin-right: 640px;">On :<span style=" font-weight:bold; color:#009966;">  <?php // print $submitted; 
	
	$str= stristr($submitted, ',');
	
	$x=explode("-", $str);
	
	
	
	$y=explode("/", $x[0]);
	//echo date("M-d-Y", mktime(0, 0, 0, 13, 1, 1997));
	$myDate=$y[0] . "/" . $y[1] . "/" .$y[2];
        $printDate = date("d F Y", strtotime ($myDate));
	print  $printDate;   //print date("d F Y",$submitted); ?> </span></span>
  <?php ?>
-->
  <div class="content clear-block">

   <div id="blogs_body"> 
   <?php
   if($node->field_author[0]['value']!="")
   {
      $username = $node->field_author[0]['value'];
	  
	  
	if (db_result(db_query("SELECT COUNT(*) FROM {users} WHERE name = '%s';", $username))) {
	    
		 $temp_user = user_load(array('name' =>  $username)); // take rpx user details
		if($temp_user->rpx_data['profile']['name']['givenName']!="")
		{
		   $rpx_name = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
		   
		   $author_link = "$rpx_name ( <a href='../../userprofile/".$username."' style='color:#CC6633;font-weight:bold;' >".$username."</a> )";
		}
		else
		{
	
         $author_link = "<a href='../../userprofile/".$username."' style='color:#CC6633;font-weight:bold;' >".$username."</a>";
		 
		}
    }
	else
	{
		$author_link = $username;
	}

   ?>
     <div id="comm-author" ><table class="blog_entry"><tr><td style="width:50px;"><b>Author</b></td><td><b>:</b>&nbsp;&nbsp;<?=$author_link?></td></tr></table></div>
     <div id="comm-url"><table class="blog_entry" ><tr><td style="width:50px;"><b>From</b></td><td><b>:</b>&nbsp;&nbsp;<?=$node->field_remote_url[0]['value']?></td></tr></table></div>
  <?php
  }
  ?>
   <?php print $content ?></div>
   
   <div id="spacing" style="padding-bottom: 10px;">&nbsp; </div>
  </div>

</div>
<script type="text/javascript">
  $(document).ready(function() {
		$('#thetitle').css({'color': '#cc6633',
										});
  });

</script>
