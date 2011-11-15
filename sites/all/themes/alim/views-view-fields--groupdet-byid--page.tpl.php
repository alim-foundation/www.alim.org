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
  $email_name = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
}
else
{
  $manager =  "<a href='".$base_url."/userprofile/".$name."'>".$name."</a>";
  $email_name = $name;
}
?>
<?php
   $custom_message = "$email_name would like you to join the group $title on Alim.org";
   $em_flag = "";
   $group_id = "";
   $btn_flag = 0;
 
   $qry_invt = db_query("SELECT * FROM invite_to_group");
   while($res_invit = db_fetch_object($qry_invt))
   {
	 if($res_invit->email==$user->mail)
	 {
		$em_flag = $res_invit->email;
		$group_id = $res_invit->group_id;
		//print $res_invit->email;
	 }
   }
   if($em_flag!="" && $group_id!="")
   {
	   $check_meb_ext = db_query("SELECT count(*) as row_cnt FROM og_uid WHERE uid='$user->uid' AND nid='".arg(1)."'");
	   $res_chk = db_fetch_object($check_meb_ext);
	   
	   if($res_chk->row_cnt==0)
	   {
		   db_query("DELETE FROM og_uid WHERE uid='$user->uid' AND nid='".arg(1)."'");
		   db_query("INSERT INTO og_uid (nid,is_active,is_admin,uid,created,changed) VALUES ('$group_id',1,0,'$user->uid','".time()."','".time()."')");
		   db_query("DELETE FROM invite_to_group WHERE email='".$em_flag."'");
		   drupal_set_message('You have successfully joined '.$title);
		   $btn_flag = 1;
	   }
	   else
	   {
	      db_query("DELETE FROM invite_to_group WHERE email='".$em_flag."'");
	   }
   }

  if(isset($_POST['Send']))
  {
	 $to = explode(",",trim($_POST['recipients']));
	 if(strpos(trim($_POST['recipients']),","))
	 {
		 foreach($to as $val)
		 {
			
			db_query("INSERT INTO invite_to_group (email,group_id) VALUES ('".$val."','".arg(1)."')");
			$subject = $_POST['subject'];
			$message = nl2br($_POST['message']);
			$message .= "<br />Login Id : ".$val."<br /><br /><a href='".$base_url."/groupdetails/".arg(1)."/mg'>Click here</a> to join the group<br /><br /> - $email_name";
			
			$from  	 = 'GroupsAdmin@alim.org';
			//$from  	 = 'sumesh@citrusinformatics.com';
					
		    $headers["MIME-Version"] = '1.0';
		    $headers["Content-Type"] = "text/html; charset=iso-8859-1";
		    $headers["From"] = "Alim.org <$from>";
			
			// Mail it

/*			$body = array(
			'to' => $val,
			'subject' => t($subject),
			'body' => t($message),
			'headers' => $headers
			);
			*/
			
			$body = array(
			'to' => $val,
			'subject' => t($subject),
			'message' => t($message),
			'headers' => $headers
			);
			
			//drupal_mail_send($body); // calling drupal mail function
			  $message = drupal_mail('tellafriend_node', 'taf', $val, language_default(), $body,  $from, $send = TRUE);
			
		 }
	}
	else
	{
	    	$val     = trim($_POST['recipients']);
			$subject = trim($_POST['subject']);
			$message = trim(nl2br($_POST['message']));
			$message .= "<br />Login Id : ".$val."<br /><br /><a href='".$base_url."/groupdetails/".arg(1)."/mg'>Click here</a> to join the group<br /><br /> - $email_name";
			$from  	 = 'GroupsAdmin@alim.org';
			//$from  	 = 'sumesh@citrusinformatics.com';
			
			db_query("INSERT INTO invite_to_group (email,group_id) VALUES ('".$val."','".arg(1)."')");
					
		    $headers["MIME-Version"] = '1.0';
		    $headers["Content-Type"] = "text/html; charset=iso-8859-1";
		    $headers["From"] = "Alim.org <$from>";
		
			// Mail it
			/*if ($email_sent == 'false') {
			  mail($val, $subject, $message, $headers);
			  $email_sent = 'true';
			}*/
			
	/*		$body = array(
			'to' => $val,
			'subject' => t($subject),
			'body' => t($message),
			'headers' => $headers
			);*/
			
			$body = array(
			'to' => $val,
			'subject' => t($subject),
			'message' => t($message),
			'headers' => $headers
			);
		 
			 //drupal_mail_send($body); // calling drupal mail function
			   $message = drupal_mail('tellafriend_node', 'taf', $val, language_default(), $body,  $from, $send = TRUE);
		
	}
	drupal_set_message('Invitation sent successfully.');

  }
  



		$urlexp1 = arg(1);
		if(strpos($urlexp1,'?'))
		{
		  $urlexp1_exp = explode("?",$urlexp1);
		  $urlexp = $urlexp1_exp[0];
		}
		else
		{
		 $urlexp = $urlexp1;
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

if(arg(2)=='mg')
{
 $btn_flag = 1;
}

?>
<div class="GroupBlock">
				<h2><?=$title?></h2>
			    <div class="GroupBody">
<div align="right">
<div align="right">
<?php
if($name==$user->name)
{
?>
<a href="javascript:void(0);" id="invite">
<img src="<?=$base_url?>/<?=$theme_path?>/images/btn_send_invitation.png" width="184" height="30" />
</a>
 <div class="tell-friend" id="tell-friend">
							<div id="box-top"></div>
								<div id="box-mid">
									<div class="inside_invite">
									<div align="right" style="margin-right:10px;"><a href="javascript:void(0);" id="div-close"><img src="<?=$base_url?>/sites/all/themes/alim/images/Close-button.png" alt="close" width="29" height="29" /></a></div>
									<h2>Invite to this Group</h2> 
									<form action="" method="post" id="frm_send" name="frm_send">
										<table width="406" border="0" cellspacing="0" cellpadding="0">
											  <tr>
											<td width="93"  align="left" valign="top">Recipients</td>
											<td width="262" align="left" valign="top"><textarea name="recipients"></textarea><br /><div class="description">Enter email addresses separated by comma.</div></td>
										  </tr>
										  <tr>
											<td align="left" valign="top">Subject</td>
											<td align="left" valign="top"><input type="text" name="subject" value="Alim.org : Invite to join the group <?=$title?>"></td>
										  </tr>
										  <tr>
											<td align="left" valign="top">Message</td>
											<td align="left" valign="top"><textarea name="message"><?=$custom_message?></textarea></td>
										  </tr>
										  <tr>
											<td align="left" valign="top">&nbsp;</td>
											<td height="40" align="left" valign="top"><input name="Send" type="submit" value="Send" id="edit-submit"></td>
										  </tr>
									  </table>
									</form>
								</div>
								</div>
							<div id="box-bottom"></div>
						</div>
						<script language="javascript">
						$("#div-close").click(function() {
						$("#tell-friend").hide();
						});
						
						$("#invite").click(function() {
						$("#tell-friend").show();
						});

						</script>
<?php
}
?>
</div>

<div id="join_group" style="width:<?=$width?>px;" align="center">
<?php
if(strip_tags($subscribe)!="Closed" && $subscribe!="")
{
?>



<!-- <a href="<?=$base_url?>/og-join-confirm" class="popups-form-reload" >Join</a>-->
<?php
	  if($user->uid && $btn_flag==0)
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
	  else
	  {
	   if($btn_flag==0)
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
  
 
   ?>
 <span><span><span>  <?php print '<a '.$url ;?>  Join </a></span></span></span>

<?php
        }
	  }

}
else
{    
     if($btn_flag==0)
	  { 
	    print $subscribe;
	   }
	
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
                      </tr>		<?php
					if($name==$user->name)
					{
					?>
                      <tr>
                        <td>&nbsp;</td>
                        <td>		
				
					<div><a href="../groups/manage">Manage Group</a></div>
					</td>
                      </tr><?php
					}
					?>
                    </table>
					<br />
					<?=$body?>	<br /><br />
					<?php
					if($flag==1)
					{
					?>	    	
					<div align="right">
                <div  style="text-align:right;" >
				<a href="../node/add/group-post/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color: rgb(51, 51, 51); padding-left:5px;"><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/></a>
				</div>
					</div>
					<?php
					}
					else
					{
						if($user->uid)
						{
						
						  
						?>
						<div align="right">
                <div  style="text-align:right;" >
						<a href="<?=$base_url?>/og/subscribe/<?=arg(1)?>" class="popups-form-reload" style="text-decoration: none; font-size: 13px; color:#000000; padding-left:5px;" ><img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/></a>
						</div>
						</div>
						<?php
								
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
					   
					   ?>
						<div align="right">
                <div  style="text-align:right;" >  <?php print '<a '.$url ;?>  <img src="<?=$base_url?>/<?=$theme_path?>/images/btn_create-new-post.png"  align="absmiddle"   alt="New Post"/> </a></div></div>

						<?php
						 
						}
					}
					?>
			
  </div>
			</div>
<?php
if(arg(2)=='mg')
{
?>
<script>
$(window).load( function() {
	$(document).one('mousemove',function(e){
	$('#head_div a.rpxnow').trigger('click'); 	
});
});
</script>
<?php
}
?>
