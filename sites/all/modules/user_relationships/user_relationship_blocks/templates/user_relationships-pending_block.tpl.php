<?php
// $Id: user_relationships-pending_block.tpl.php,v 1.1.2.12 2010/01/03 19:19:11 alexk Exp $
/**
 * @file
 * Template for relationships requests block
 * List all pending requests and provide links to the actions that can be taken on those requests
 */

global $base_url;
global $theme_path;
 
if ($relationships) {
  $list = array();
  foreach ($relationships as $rtid => $relationship) {
    $tt_rel_name = ur_tt("user_relationships:rtid:$rtid:name", $relationship->name);
    $tt_rel_plural_name = ur_tt("user_relationships:rtid:$rtid:plural_name", $relationship->plural_name);
    if ($user->uid == $relationship->requester_id) {
	   $relation_to =& $relationship->requestee;
	      $name = "";
		  
	    $temp_user = user_load(array('name' => theme('username', $relation_to)));
		$picture = $temp_user->picture; 
		
		$name = "<div class='req_div'><a href='userprofile/".theme('username', $relation_to)."' />";
	   if($picture!="")
				{
				 $name .= "<div class='req_photo'><img  src=\"".$base_url."/".$picture."\" align=\"top\" height=\"32\" width=\"32\" border=\"0\"  /></div>";
				}
	  else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {

	   $name .= "<div class='req_photo'><img  src=\"".$temp_user->rpx_data['profile']['photo']."\" align=\"top\" height=\"32\" width=\"32\" border=\"0\"  /></div>";
	   }
	   else if($temp_user->rpx_data['profile']['photo']=="" && $picture=="")
	   {
	      $name .= "<div class='req_photo'><img  src=\"http://www.virtualliveworks.com/Alim.org/sites/all/themes/alim/images/user32_d.png\" align=\"top\"  border=\"0\"  /></div>";
	   }
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
   $name .= "<div class='req_user'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</div>";
}
else
{
  $name .= "<div class='req_user'>".theme('username', $relation_to)."</div>";
}
 $name .= '</a>';
		

      $controls = theme('user_relationships_pending_request_cancel_link', $user->uid, $relationship->rid);
      $line = t($name."<div class='req_div_col'>!controls</div></div><div style='clear:both'></div>", array('@rel_name' => $tt_rel_name, '!username' => theme('username', $relation_to), '!controls' => $controls));
	  
	 /*  $line = t($name.' (!controls)', array('@rel_name' => $tt_rel_name, '!username' => theme('username', $relation_to), '!controls' => $controls));*/
	   
      $key = t('Sent requests');
    }
    else {
	$name ="";
      $relation_to = $relationship->requester;
	  
	    $temp_user = user_load(array('name' =>  theme('username', $relation_to) ));
		$picture = $temp_user->picture; 
		  $name = "<div class='req_div'><a href='userprofile/".theme('username', $relation_to)."' />";
	      if($picture!="")
				{
				 $name .= "<div class='req_photo'><img  src=\"".$base_url."/".$picture."\" align=\"top\" height=\"32\" width=\"32\" border=\"0\"  /></div>";
				}
	  else if($temp_user->rpx_data['profile']['photo']!="" && $picture=="") {
	   
	   $name .= "<div class='req_photo'><img  src=\"".$temp_user->rpx_data['profile']['photo']."\" align=\"top\" height=\"32\" width=\"32\" border=\"0\"  /></div>";
	   }
	   else if($temp_user->rpx_data['profile']['photo']=="" && $picture=="") 
	   {
	      $name .= "<div class='req_photo'><img  src=\"http://www.virtualliveworks.com/Alim.org/sites/all/themes/alim/images/user32_d.png\" align=\"top\"  border=\"0\"  /></div>";
	   }
if($temp_user->rpx_data['profile']['name']['givenName']!="")
{
   $name .= "<div class='req_user'>".$temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName']."</div>";
}
else
{
  $name .= "<div class='req_user'>".theme('username', $relation_to)."</div>";
}
 $name .= '</a>';
		
		
	 
          $controls =
        theme('user_relationships_pending_request_approve_link', $user->uid, $relationship->rid).'|'.
        theme('user_relationships_pending_request_disapprove_link', $user->uid, $relationship->rid);
   /*   $line = t("@rel_name from <a href=\'userprofile/!username\' />!username</a> (!controls)", array('@rel_name' => $tt_rel_name, '!username' => theme('username', $relation_to), '!controls' => $controls));*/
	  
	     $line = t($name."<div class='req_div_col'>!controls</div></div><div style='clear:both'></div>", array('@rel_name' => $tt_rel_name, '!username' => theme('username', $relation_to), '!controls' => $controls));
	  
	/*  $line = t($name.' (!controls)', array('@rel_name' => $tt_rel_name, '!username' => theme('username', $relation_to), '!controls' => $controls));*/
	  
      $key = t('Received requests');
    }
    $list[$key][] = $line;
  }

  $output = array();
  foreach ($list as $title => $users) {
    $output[] = theme('item_list', $users, $title);
  }
}

if($user->user_relationships_ui_auto_approve[1]==0)
{
	print isset($output) ? implode('', $output) : t('No Pending Requests');
}
else
{
	if(isset($output))
	 print implode('', $output);
}
//print isset($output) ? implode('', $output) : t('No Pending Requests');

?>
