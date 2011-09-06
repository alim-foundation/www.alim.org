<?php
// For showing the group details on group page.
  global $theme_path;
  global $base_url; 
  global $user;
  
  // Taking each fields of group to variables.
?>
<?php foreach ($fields as $id => $field): ?>

<?php if($id=="description") : $description = $field->content; endif; ?>
<?php if($id=="subscribe") :   $subscribe   = $field->content; endif; ?> 
<?php if($id=="body") : $body = $field->content; endif; ?> 
<?php if($id=="name") : $name = $field->content; endif; ?> 
<?php if($id=="post_count") : $post_count = $field->content; endif; ?> 
<?php if($id=="member_count") : $member_count = $field->content; endif; ?>  
<?php if($id=="created") : $created = $field->content; endif; ?> 
<?php if($id=="title") : $title = $field->content; endif; ?>  

<?php endforeach; ?>

<?php

// Group Manger Details from rpx data.
$temp_user = user_load(array('name' => $name));
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
  $manager = "<a href='".$base_url."/userprofile/".$name."'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</a>";
}
else
{
  $manager =  "<a href='".$base_url."/userprofile/".$name."'>".$name."</a>";
}
?>

<?php


		$urlexp1 = explode("/",arg(1));
		if(strpos($urlexp1[1],'?'))
		{
		  $urlexp1_exp = explode("?",$urlexp1[1]);
		  $urlexp = $urlexp1_exp[0];
		}
		else
		{
		 $urlexp = $urlexp1[1];
		}
		
// Query and check that current user is the member of the group. if true, set flag=1 for give permission to create new post to group.
$flag = 2;

$query =  db_query("SELECT users.uid AS uid, users.name AS users_name, og_uid.created AS og_uid_created FROM users users  LEFT JOIN og_uid og_uid ON users.uid = og_uid.uid WHERE (users.status <> 0) AND (og_uid.is_active <> 0) AND (og_uid.nid = '".$urlexp."') ORDER BY og_uid_created ASC, users_name ASC");
$arr_meb  = array();
while($result = db_fetch_object($query))
{
$arr_meb[]  = $result->uid;
}

if(in_array($user->uid,$arr_meb))
{
  $flag = 1;
}
$width = 70;
if(strip_tags($subscribe)=="Join")
{
  $width = 60;
}
if(strip_tags($subscribe)=="Request membership")
{
  $width = 180;
}
$show_link=0;
?>
<script>
$(document).ready(function(){
<?php $show_link=1; ?>
}
</script>
<div class="GroupBlock">
				<h2><?=$title?></h2>
			    <div class="GroupBody">
<div align="right"><?php //if($user->uid) { ?> 
<div id="join_group" style="width:<?=$width?>px;" align="center">
<?php
if(strip_tags($subscribe)!="Closed" && $subscribe!="")
{
?>



<!-- <a href="<?=$base_url?>/og-join-confirm" class="popups-form-reload" >Join</a>-->
<?php
	  if($user->uid)
	  {
	   if($show_link==1)
	   {
	  ?>
<span>
<span>
<span>
<a href="<?=$base_url?>/og/subscribe/<?=arg(1)?>&a=1" class="popups-form-reload" rel="nofollow"  title="">Join</a>
</span>
</span>
</span>
	  <?php
        }
	   
	  }
	  else
	  {
	  ?>
	  <!--  <span>
<span>
<span>
<?=$subscribe?>
</span>
</span>
</span>-->
	<?php
	// Rpx Login if user not logged in
$block = module_invoke('rpx', 'block', 'view', 0);
//print $block['content'];

 $r  = strip_tags($block['content'], '<a>');
 $tt = stristr($r,'href=');
 $t3 = stristr($tt,'AOL/AIM');
 $url = str_replace($t3," ",$tt);
  
    if($show_link==1)
	   {
   ?>
 <span><span><span>  <?php print '<a '.$url ;?>  Join </a></span></span></span>

<?php
       }
	  }

}
else
{
    
	    print $subscribe;
	
}
?>
<?php //} ?>
</div>
</div><br />					<div><?=$description?></div>
					<div class="clear">&nbsp;</div>
					<table width="100%" border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;" bordercolor="#f5e082" bgcolor="#fffff8">
                      
                      <tr>
                        <td><strong>Manager:</strong> <?=$manager?> </td>
                        <td><strong>Created: </strong><?=$created?> </td>
                      </tr>
                      <tr>
                        <td><strong>Posts:</strong> <?=$post_count?> </td>
                        <td><strong>Members:</strong> <?=$member_count?> </td>
                      </tr>
                    
                    </table><br />
					<?=$body?>	<br /><br />
					<?php
					if($flag==1)
					{
					    if($show_link==1)
	  					 {
					?>	    	
					<div align="right">
                <div  style="text-align:right;" >
				<a href="../node/add/group-post/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color: rgb(51, 51, 51); padding-left:5px;"><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/></a>
				</div>
					</div>
					<?php
					    }
					}
					else
					{
						if($user->uid)
						{
						
						    if($show_link==1)
	   							{
						?>
						<div align="right">
                <div  style="text-align:right;" >
						<a href="<?=$base_url?>/og/subscribe/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;" ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/></a>
						</div>
						</div>
						<?php
								}
						}
						else
						{
						?>
						<?php
						// Rpx Login if user not logged in
					$block = module_invoke('rpx', 'block', 'view', 0);
					//print $block['content'];
					
					 $r  = strip_tags($block['content'], '<a>');
					 $tt = stristr($r,'href=');
					 $t3 = stristr($tt,'AOL/AIM');
					 $url = str_replace($t3," ",$tt);
					    if($show_link==1)
	   						{
					   ?>
						<div align="right">
                <div  style="text-align:right;" >  <?php print '<a '.$url ;?>  <img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/> </a></div></div>

						<?php
						  }
						}
					}
					?>
					
						    	</div>
			</div>