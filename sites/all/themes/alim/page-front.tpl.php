<?php
global $base_url;
global $theme_path;
//$start_time = microtime(TRUE);
$start_time = $_SESSION['start_time'];
		
                  //Cookie setting for login remeber for 14 days..   
				 if(!($_COOKIE['remember']))
				 {
					 if(($_COOKIE['rem_uid'])!=$user->uid||$user->uid==0)
					 {
							  watchdog('user', 'Session closed for %name.', array('%name' => $user->name));
							  session_destroy();
							  $null = NULL;
							  user_module_invoke('logout', $null, $user);
							  $user = drupal_anonymous_user();							
							  $domain = $_SERVER['HTTP_HOST'];
							  $path = $_SERVER['SCRIPT_NAME'];	
							  $queryString = $_SERVER['QUERY_STRING'];
							  $url = "http://" . $domain . $path . "?" . $queryString;
							  $goodUrl = str_replace('index.php?','', $url);
							 // header('location:'.$goodUrl);
							  
					}
					else
							{
									  setcookie("rem_uid",$user->uid, time()+1209600, "/");
							}
					setcookie("remember","a", 0, "/");
				 }

/**
 * Set Cookie expired on browser close.
*/

                       $expire = 0;
						if($user->uid)
						{
			  
							  if(isset($_COOKIE['rem_uid']))
							  {
								  if($_COOKIE['rem_uid']==$user->uid)
								  {
									$expire = time()+200000;
								  }
							  }
			
						 }

			
				 if(!($_COOKIE['rem_prof']))
					  {
				         if($user->uid!=0)
							{
									if(!$user->user_relationships_ui_auto_approve)
								   {
									  $apv = array();
									  $apv[1] = 1;
									  $extra_data = array('user_relationships_ui_auto_approve' => $apv);
									   user_save($user, $extra_data); 
									}
									
									$chk_ful    = db_query("SELECT count(*) as ful_cnt,value FROM profile_values WHERE fid=18 AND uid=".$user->uid);
									$result_ful = db_fetch_object($chk_ful);
									// For setting full name as profile field
									if(($result_ful->ful_cnt)==0)
									{
										$temp_user = user_load(array('name' => strip_tags($user->name)));
										if($temp_user->rpx_data['profile']['name']['givenName']!="")
										{
										 $res_ful = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
										}
										else
										{
										 $res_ful = $user->name;
										}
										db_query("INSERT INTO {profile_values} (fid,uid,value) VALUES (18,".$user->uid.",'".$res_ful."')");
									}
									else
									{
										$temp_user = user_load(array('name' => strip_tags($user->name)));
										if($temp_user->rpx_data['profile']['name']['givenName']!="")
										{
										 $res_ful = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
										}
										else
										{
										 $res_ful = $user->name;
										}
										if($result_ful->value!=$res_ful)
										{
										 db_query("UPDATE {profile_values} SET value = '%s' WHERE uid = %d AND fid = %d",$res_ful , $user->uid, 18);
										}
									}
									
									
									// Relationship Privacy
									$select_in_following  = 1;
									$select_in_follower   = 1; 
								
								
								
								//Show me on " Following " List.
								$chk_in_following  = db_result(db_query("SELECT count(*) FROM {profile_values} WHERE fid=%d AND uid=%d", 13, $user->uid));
								if($chk_in_following==0)
								{
									db_query("INSERT INTO {profile_values} (fid,uid,value) VALUES (%d,%d,'%s')", 13, $user->uid, $select_in_following);
								}
																
								
								//Show me on " Follower " List.
								$chk_in_follower  = db_result(db_query("SELECT count(*) FROM {profile_values} WHERE fid=%d AND uid=%d", 14, $user->uid));
								if($chk_in_follower==0)
								{
									db_query("INSERT INTO {profile_values} (fid,uid,value) VALUES (%d,%d,'%s')", 14, $user->uid, $select_in_follower);
								}
								
								
							
								setcookie("rem_prof","a", 0, "/");
								//header("location:".$base_url."/userprofile");
							}
						}
				
				?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <script type="text/javascript"> 
   var startTime = (new Date()).getTime(); 
</script>
    <?php print $head ?>
	
    <title>Alim - The World's Most Useful Islamic Software</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
	<meta HTTP-EQUIV="accept-encoding" CONTENT="gzip,deflate">

	<?php print $styles ?>
	    <!--[if lt IE 7]>
      <?php print phptemplate_get_ie_styles(); ?>
    <![endif]-->
	
		     
    <?php print $scripts ?>
	<script type="text/javascript" src="http://s3.amazonaws.com/getsatisfaction.com/javascripts/feedback-v2.js"></script>	
<script language="javascript" type="text/javascript"  src="<?php print $base_url."/".$theme_path;?>/galleryview/jquery.galleryview-2.1.1.js"/></script>
	<script language="javascript">
		function fixprogressbar()
		{
		top.garbageframe.document.write("");
		top.garbageframe.close();
		return
		}	
	</script>

</head>
<?php
// flush the buffer
flush();
?>
<body onload="fixprogressbar()">
<script type="text/javascript">
$(document).ready(function(){
  $('#gallery').show();
   $('#gallery_ini').hide();
	$('#gallery').galleryView({
	 gallery_width: 920,
	 gallery_height: 290,
     panel_width: 920,
	 panel_height: 237,
	 frame_width: 135,
	 frame_height: 34,
	 frame_scale: 'nocrop',
	 frame_opacity: 1.0,
	 frame_gap: 10,
	 frame_caption_size:5,
	 pointer_size:8,
	 filmstrip_margin:3,
	 show_captions:true});
	
 });

</script>
<div class="beta_tag1"></div>
<div id="outer_div" align="center"><!--- outer_div --->

	<div id="main_div"><!--- main_div --->
	
	   <div id="top_menu" align="center">
		   		    	
			   <div id="top_menu_left"></div>
			   <div id="top_menu_middle">
			   
			 
			    <?php print $header; ?> </div> <div id="top_menu_middle_second" style="color:#990000;font-weight:bold;" align="right">
					
			    
				<?php 
				// RPX Login. if getting user id shows 'My Profile' Link on top grey menu bar.
				if($user->uid){
				?>
				<?php print l("My Profile",'userprofile'); ?>
&nbsp;&nbsp;
				<?php print l("Logout","logout"); ?>
				<? } else {?>
				
				
				<?php print $rpx_login ; ?> <?
				
				}?>&nbsp;&nbsp;
				
				<a  href="<?=$base_path?>" title="Home"><img src="<?php print $base_url."/".$theme_path;?>/images/alim-home.png" alt="Home" width="25" height="25"  border="0" align="absmiddle" title="Home" /></a>
				</div>
						  
			   <div id="top_menu_right"></div>
		
	  </div>
			<div style="clear:both"></div>
			
						
		    <div id="head_div">
			
		
			
			   <div id="top_menu2" align="center">
                   
			   
			 	<div id="logo1" align="left"><a  href="<?=$base_path?>" title="Home" ><img src="<?php print $base_url."/".$theme_path;?>/images/alim-logo1.png" width="262" height="61" border="0" /></a></div>
				<div id="top_menu_middle2"><a href="<?php print $base_url?>/library/quran/surah/arabic/1/ARB"  ><img src="<?php print $base_url."/".$theme_path;?>/images/startbut.png" width="234" height="62" border="0" /></a></div>
				<div class="front_donate">
			<a href="<?=$base_url?>/donate/pp/cancel">
					<img src="<?=$base_url?>/<?=$theme_path?>/images/paypal.gif" alt="" width="92" height="26" border="0" >				</a>				</div>
              </div><div style="clear:both"></div>
			    
	        </div>
			<div style="clear:both"></div>
	<div class="test_top">
			<!--<div class="test_topinner" >
				<div id="splash_search">
			<div  class="splash_searchinner" align="center" >
			  <div class="splash_search_box"><?php if ($search_box): ?><div id="search-home" ><?php print $search_box ?></div><?php endif; ?></div>
			  </div>
			 </div>
			 </div>-->
		</div>

	<div class="test_middle" align="center">
				<div style="clear:both"></div>
			<?php print $splash_top; ?>
			<div style="clear:both;"></div>
			<div id="head_content">
			      
				   <div id="top_heading">
				   <?php print $splash_header; ?>
					</div>

			</div>
			
			
			
			<div class="divder"></div>
			
			<div class="recent_activity">

		 			<div class="heading_div"><h2>Recent Activity</h2></div>
                     <div style="float:left;width:453px;">
					 <?php
					 print $splash_recent;
					 ?>
					 </div>
					 <div style="float:left;width:453px;">
					 <?php
                     print $splash_recent_right;
					 ?>
					 </div>
					 <div style="clear:both"></div>

					  <?php

				  print $splash_rss;

				  ?>

				

			 </div>

           <div class="divder"></div>
		   
				<div id="div_about_us">
				
				   <div id="about1">
				   <?php print $splash_about; ?>
				   	  
					</div>
					
					<div id="non_profit">
					<?php print $splash_nonprofit; ?>
				   	   
					</div>
					
				</div>
				
			<div class="divder"></div>
            <div id="div_middle_second">
			   <div id="second_left">
			     <div id="testimony">
			
				 	<div id="library">
					
					<?php print $splash_library; ?>
					  
					</div>
					
					 <div id="application">
					   <?php print $splash_applications; ?>
					</div>
					
					<div class="divder"></div> 
					
					<div id="testimonials">
					
						   <div class="heading_div"><h2>Testimonials</h2></div>
								   <?php print $splash_testimonialst; ?>
								   		
						
					</div>
					<div class="read_more" align="right" style="padding-right:40px;padding-top:8px;"><a href='<?=$base_url?>/testimonials' class="hand-icon">Read Testimonials</a></div>
			
				 
				 </div>
				 <div id="partners">
				    
						<div id="partner_list">
						   <div class="heading_div"><h2>Related Islamic Resources</h2></div>
							   <div class="marquee" id="mycrawler2">
					
							  <?php print $splash_partners; ?>
					

                                </div>




<script type="text/javascript">
marqueeInit({
	uniqueid: 'mycrawler2',
	style: {
		'padding': '2px',
		'width': '556px',
		'height': '65px',
		'padding-bottom': '4px'
	},
	inc: 1, //speed - pixel increment for each iteration of this marquee's movement
	mouse: 'pause', //mouseover behavior ('pause' 'cursor driven' or false)
	moveatleast: 2,
	neutral: 150,
	savedirection: true
});
</script>
					
						</div>
					
				 
				 </div>
			   </div>
			   <div id="second_right">
			      <div class="newsblog">
				      
					 <div id="news">
					 
					   <div class="heading_div"><h2>News</h2></div>
					   <?php print $splash_news; ?>
					
					</div>
				  
				  </div>
				  <div class="newsblog">
				  
				     <div id="blogs">
					   <div class="heading_div"><h2>Top Blogs</h2></div>
					   <?php print $splash_topblogs; ?>
					
					 
					</div>
					
				  
				  </div>
				  <div class="newsblog">
				  
				    <div id="twitter">
					   <div class="heading_div"><h2>Twitter </h2></div>
					   <div class="spl_text">
					   	<?php print $splash_twitter; ?>					   
					   </span>
					   </div>
					</div>
				  
				  
				  </div>
				  
				  
			   </div>
			   
			   <div style="clear:both"></div>
			   
			   
			</div>	
	
	<div style="clear:both"></div>
	

	 

		
	</div>
	

	
<div class="test_bottom"></div>
					
	
	
	</div><!--- main_div --->
</div><!--- outer_div --->
<!---------------- Footer Start -------------------->

<div style="clear:both"></div>
	<!---------------- Footer Start -------------------->
	<div id="footer_div" align="center" >
	  <div id="footer_content" align="center">
		  <div id="footer_head" align="center"><br /><br />&nbsp;&nbsp;&nbsp; &copy; All Rights 2010 Alim.org</div>
		  <div id="footer_menu">
		   <?php print $footer; ?>
		     
		  </div>
	  </div>
	   <div style="clear:both"></div>
	</div>
	<!---------------- Footer End -------------------->
<div style="background:#F9D350;color:#A94C17" id="load_timediv"></div>
<?php
$end_time = microtime(TRUE);
$time_taken_sec = $end_time - $start_time;
$server_timemilli = $time_taken_sec*1000;
$time_taken = round($time_taken_sec,5);
?>
<script type="text/javascript"> 
  var server_time='';
  var browser_time=  '';
  var search_key_value;
   $(window).load(function() 
   { 
       var endTime = (new Date()).getTime(); 
       var millisecondsLoading = endTime - startTime; 
       // Put millisecondsLoading in a hidden form field 
       // or AJAX it back to the server or whatever. 
	   var seconds = (millisecondsLoading/1000);
	   var htmlStr = 'Total load time in seconds : '+seconds+' :: in ms :' + millisecondsLoading;
		
  server_time=<?php print $server_timemilli; ?>; // for ajax insert
  browser_time=  millisecondsLoading; // for ajax insert
  
  var disptime = <?php print $time_taken; ?>;
  var totaltime_display =  seconds + disptime;
   
  document.getElementById('load_timediv').innerHTML = 'Total elapsed time: '+totaltime_display.toFixed(4)+' sec. ==> Server: '+disptime+' sec. | User (e.g. : browser,network,internet): '+seconds.toFixed(4) +' sec.';
   });

</script> 
	 <?php print $closure ?>
<iframe name="garbageframe" id="garbageframe" style="display:none;" ></iframe>
<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";  
  feedback_widget_options.company = "alim_foundation";
  feedback_widget_options.placement = "left";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "idea";

 var feedback_widget = new GSFN.feedback_widget(feedback_widget_options); 
</script>
</body>
</html>
