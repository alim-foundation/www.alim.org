<?php
/**
Note : We didn't include $style & $script variables in this page because it affecting the page load. 
You need to include each js files and css files of modules, themes etc in this page.
**/
global $base_url;
global $theme_path;

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
global $user;
$set_ok = 0;
$arr_roles = $user->roles;
//print_r($arr_roles);
foreach($arr_roles as $key => $ur){
if($ur=="Developer")
$set_ok = 1;
if($key==9)
$set_ok = 1;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $language->language ?>" lang="<?php echo $language->language ?>" dir="<?php echo $language->dir ?>">
<head>
<?php echo $head; ?>
	<title>Alim - The World's Most Useful Islamic Software</title>
	<link type="text/css" rel="stylesheet" media="all" href="/sites/all/themes/alim/home.css" />
	<!--[if gte IE 9]>
	<style>
	.nav-prev {padding-top:1px;}
	.nav-next {padding-top:1px;}
	</style>
	<![endif]-->
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/sites/all/themes/alim/jquery.zclip.js"></script>
<script language="javascript" type="text/javascript"  src="/sites/all/themes/alim/clipboard-hand.js"></script>
<script type="text/javascript">
var plstart = new Date();
</script>
	<script type="text/javascript"> 
  	 var startTime = (new Date()).getTime(); 
	</script>

</head>
<body>
<div class="beta_tag1"></div>
<div id="outer_div" align="center">
	<div id="main_div">
	
		<div id="top_menu" align="center">
		   	<div id="top_menu_left"></div>
			<div id="top_menu_middle">
			  <?php echo $header; ?> 
			</div> 
			<div id="top_menu_middle_second" style="color:#990000;font-weight:bold;" align="right">
				<?php 
					// RPX Login. if getting user id shows 'My Profile' Link on top grey menu bar.
					if($user->uid){
					?>
					<?php echo l("My Profile",'userprofile'); ?>&nbsp;&nbsp;
					<?php echo l("Logout","logout"); ?>
					<? } else {?>
					<?php echo $rpx_login ; ?> <?
					}?>&nbsp;&nbsp;
					<a  href="<?=$base_path?>" title="Home"><img src="<?php echo $base_url."/".$theme_path;?>/images/alim-home.png" alt="Home" width="25" height="25"  border="0" align="absmiddle" title="Home" /></a>
			</div>
			<div id="top_menu_right"></div>
	     </div>
		<div style="clear:both"></div>
		
		<div id="head_div">
				<div id="top_menu2" align="center">
			 		<div id="logo1" align="left">
						<a  href="<?=$base_path?>" title="Home" >
							<img src="<?php echo $base_url."/".$theme_path;?>/images/alim-logo1.png" width="262" height="61" border="0" />
						</a>
					</div>
					<div id="top_menu_middle2">
						<a href="<?php echo $base_url?>/library/quran/surah/arabic/1/ARB"  >
							<img src="<?php echo $base_url."/".$theme_path;?>/images/startbut.png" width="234" height="62" border="0" />
						</a>
					</div>
					<div class="front_donate">
						<a href="<?=$base_url?>/donate/pp/cancel">
							<img src="<?=$base_url?>/<?=$theme_path?>/images/paypal.gif" alt="" width="92" height="26" border="0" >
						</a>	
				 	</div>
               </div>
	   </div>
	  <div style="clear:both"></div>
	  <div id="top_content"></div>
	  <div id="middle_content">
	   <textarea id="text-to-copy" onfocus="if(this.value=='Type your text here.')this.value='';" onblur="if(this.value=='')this.value='Type your text here.';"  style="display:none;" >No Ayah selected</textarea>

			<div style="clear:both"></div>
		<div style="float:left;position:relative;width:970px;height:auto; ">  <div class="xyz"><a href="#" class="z-test"  style=" color:#f5eed4;background:none; border:none; height:36px; width:37px; position:absolute; top: 42px;  right: 37px;
 z-index:100; text-align:justify;"></a>  </div><div class="loading"><img src="sites/all/themes/alim/images/ayah-loading-icon.gif" alt="" />&nbsp;</div>

<?php echo $splash_top; ?>	
<div class="copy_range" style="display:block;" >
<div class="copy_range_top" style="display:none;"  ></div>
<div class="copy_range_mid" style="display:none;">	
<a href="javascript:void(0);" id="copy-close" style="position: absolute; margin-top: -12px;
margin-left: 23px;">
<img src="sites/all/themes/alim/images/Close-button.png" alt="close" width="29" height="29" /></a>
 <div class="copied" style="display:none; margin-left:85px;padding-top: 10px;width: 460px;"> Copied the Ayah.  Click to add more:  <div class="copied_plus" onclick="enable_range_edit();"></div> </div>
 <div class="noayah" style="display:none; margin-left:35px;padding-top: 10px;"> Please select an ayah using the inputs on the left. <div  onclick="enable_range_edit();">&nbsp </div> </div>
 <div class="range_copied" style="display:none; margin-left:35px;width:360px;padding-top: 10px;"> Copied the Ayaat to your clipboard.  You can now paste them into a document. <div >&nbsp </div> </div>

<div class="range-edit" style="display:none;">
  <fieldset  class="field_set_copy">
    <legend style=" font-weight:bold; color:#650A09;">Specify a range</legend>

 <table width="330" border="0" cellspacing="0" cellpadding="0" class="tbl_copy" align="center" style="margin-left:5px;margin-top:8px;">
 <tr><td  height="28"  colspan="5" valign="middle" align="left" class="lbl" width="240" style="font-size:13px; ">Please select a range below to add more Ayah and then click copy button to update the clipbord.<br /></td></tr> 
 <tr><td  height="28"  colspan="5" valign="middle" align="left" class="lbl" width="240">------------------------------------------------------------------</td></tr>
 <tr>
 <td  height="28" valign="middle" align="left" class="lbl" width="140">Selected Surah </td>
  <td  height="28" valign="middle" align="left" class="surah_name" width="200"> Copy</td>
 </tr>
 <tr>
    <td valign="middle" align="left" class="lbl" width="270" style="white-space:nowrap;">Copy Ayah From </td><td width="40" valign="top" align="left" class="form"><div class="from_text"><input width="62" type="text" border="0" height="30" name="from" id="copy-from" class="copy-from" align="middle"></div></td>
    <td valign="middle" align="left" class="label" width="40">To </td><td valign="top" align="left" class="form" width="40"><div class="to_text"><input width="62" type="text" border="0" height="30" name="to" id="copy-to" class="copy-to"></div></td> 
	<td valign="middle" align="left" class="form" width="200">&nbsp;</td>   

  </tr>
   <tr height="10">
   <td>
   </td></tr>
    <tr>
  	<td  height="28" align="left" valign="top" class="label"> Select format </td>
    <td  height="28" align="left" valign="top" class="label"  colspan="3"><input type="radio"  name="format" value="1" class="format"   />Text&nbsp;&nbsp; &nbsp;<input type="radio" checked="checked" name="format"  class="format" value="2" />HTML</td>
  </tr>

</table>  
</fieldset>
&nbsp;
 </div> 
 </div>
 <div class="copy_range_bottom" style="display:none;" ></div>
<div class="update-copy"></div>
 </div>
 <?php 
if($user->uid)
{
$sel_res = db_query("SELECT value as res_sel FROM profile_values WHERE fid=27 AND uid=".$user->uid);
$fetch_res = db_fetch_object($sel_res);	
$format=$fetch_res->res_sel-1;
?>
<script>
$('input[name=format]:radio').each(function(){
   $('input[name=format]:radio:eq(<?=$format?>)').attr('checked', true);  
  });
</script>
<?php 
}
else
{
?>
<script>
cookieval = getCookiesort('anonymformat')-1;
if(cookieval);
{
$('input[name=format]:radio').each(function(){
   $('input[name=format]:radio:eq('+cookieval+')').attr('checked', true);  
  });
}
</script>
<?php }?>
<script>
function enable_range_edit()
{

$('.update-copy').html('<img class="copy-img" src="<?php echo $base_url."/".$theme_path;?>/images/goto-copy-icon.png" width:"37" height="37" border="0" />');
$('.update-copy').hide();
$('.update-copy').hide();
$('.range-edit').show();
}
$('#copy-close').click(function() {
$('.range-edit').hide();
$('.copy_range').hide();
$('.noayah').hide();
$('.update-copy').html('');
$('.range_copied').hide();
});
$(".copy_range").mouseup(function() {
                return false;
            });
if($.browser.mozilla)
{
$(".zclip").mouseup(function() {
                return false;
            });
}
$(document).mouseup(function(e) {
if($(e.target).parent("a.z-test").length==0) {
$('.range-edit').hide();
$('.copy_range').hide();
$('.noayah').hide();
$('.range_copied').hide();
$('.update-copy').html('');

}
});

$('a.z-test').click(function() {
if(test==1)
{
$('.copy_range').show();
$('.copy_range_top').show();
$('.copy_range_mid').show();
$('.copy_range_bottom').show();
}
});

$('.update-copy').click(function() {
$('.update-copy').html('');
$('.range-edit').hide();
$('.copied').hide();
$('.range_copied').show();

});
</script>
 </div>

			<div style="clear:both"></div>

			
			<div style="clear:both;"></div>
	  		<div class="banner">
        		<div class="banner_left">
					 <?php echo $splash_header; ?>
				</div>
				<div class="banner_right">
					<div class="banner-right-head"> <h2> Recent Activity </h2> </div>
					<div class="menu">
						<ul>
							<li id="re-tab1"> <a href="javascript:void(0)" class="selected">Comments </a></li>
							<li id="re-tab2"><a href="javascript:void(0)">Tags</a> </li>
							<li id="re-tab3"><a href="javascript:void(0)">Group Posts </a> </li>
							<li id="re-tab4"><a href="javascript:void(0)">Groups </a> </li>
						</ul>
                    </div>
					<div class="banner-right-cont" id="recent-tab1"><?php echo $splash_recent_comments;?></div>
					<div class="banner-right-cont" id="recent-tab2"><?php echo $splash_recent_tags;?></div>
					<div class="banner-right-cont" id="recent-tab3"><?php echo $splash_recent_groupost;?></div>
					<div class="banner-right-cont" id="recent-tab4"><?php echo $splash_recent_groups;?></div>
				</div>
				<div style="clear:both;"></div>
			</div>
			
			        <div class="clear"></div>
      <div class="cont-area">
          <div class="cont-area-top"></div>
          <div class="main-cont">
		  	<div class="main-cont-left">
                <div class="main-cont-lft-box event-div">
         	    <div class="main-cont-lft-box-top"> <h3> Noteworthy Events </h3> </div>
 				  <div class="event-div-new" id="event-div-new">
                   	 <?php
					 print $splash_recent;
					 ?>
					 </div>
					<div class="main-cont-lft-upcomingbox-btm">
                  		<div class="events-mnu" id="nav2"></div>
                    </div>
                   </div>

					<div class="main-cont-lft-box">
                   	  <div class="main-cont-lft-box-top"> <h3> <a href='<?=$base_url?>/testimonials'>Testimonials</a> </h3> </div>
                        <div class="main-cont-lft-box-dts">
                          <?php print $splash_testimonialst; ?>
						  <div class="read_more" align="right" style="padding-right:40px;padding-top:8px;clear:both"><a href='<?=$base_url?>/testimonials'><img src="<?=$base_url?>/<?=$theme_path?>/images/hand.png" alt="hand-icon" border="0" align="absmiddle" />&nbsp;&nbsp;Read Testimonials</a></div>
               		  </div>
           			<div class="main-cont-lft-box-btm"></div>
                    </div>
					
					<div class="main-cont-lft-box">
                   	  <div class="main-cont-lft-box-top"> <h3> <a href='<?=$base_url?>/aboutus'>About Us</a></h3> </div>
                        <div class="main-cont-lft-box-dts">
                          <?php print $splash_about; ?>
						  <div class="read_more" align="right" style="padding-right:40px;padding-top:8px;clear:both"><a href='<?=$base_url?>/aboutus'><img src="<?=$base_url?>/<?=$theme_path?>/images/hand.png" alt="hand-icon" border="0" align="absmiddle" />&nbsp;&nbsp;Read More</a></div>
               		  </div>
           			<div class="main-cont-lft-box-btm"></div>
                    </div>
					
					<div class="main-cont-lft-box">
                   	  <div class="main-cont-lft-box-top"> <h3>Related Islamic Resources </h3> </div>
                        <div class="main-cont-lft-box-dts">
							<div class="marquee" id="mycrawler2">
                          		<?php print $splash_partners; ?>
							</div>
						 </div>
           			<div class="main-cont-lft-box-btm"></div>
                    </div>
					
				 </div>
				
				     <div class="main-cont-right">
					 
                	<div class="main-cont-rgt-box">
                    	<div class="main-cont-rgt-box-top"><h3> <a href='<?=$base_url?>/news'>News &amp; Views</a> </h3></div>
                        <div class="main-cont-rgt-box-dts">
                        	<?php print $splash_news; ?>
                        </div>
                        <div class="main-cont-rgt-box-btm"></div>
                    </div>
					
					<div class="main-cont-rgt-box">
                    	<div class="main-cont-rgt-box-top"><h3> <a href='<?=$base_url?>/blogs'>Top Blogs</a>  </h3></div>
                        <div class="main-cont-rgt-box-dts">
                        	<?php print $splash_topblogs; ?>
                        </div>
                        <div class="main-cont-rgt-box-btm"></div>
                    </div>
					
					<div class="main-cont-rgt-box">
                    	<div class="main-cont-rgt-box-top"><h3>  <a href="http://www.facebook.com/pages/Alimorg/297595908861" target="_blank">Find us on Facebook</a> </h3></div>
                        <div class="main-cont-rgt-box-dts-facebook">
                        	<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FAlimorg%2F297595908861&amp;width=292&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=false&amp;height=258" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe>
                        </div>
                        <div class="main-cont-rgt-box-btm"></div>
                    </div>
					
					 <div class="main-cont-rgt-box">
                    	<div class="main-cont-rgt-box-top"><h3> <a href="http://twitter.com/#!/alimfoundation" target="_blank">Twitter Stream</a>  </h3></div>
                        <div class="main-cont-rgt-box-dts">
                        	<?php print $splash_twitter; ?>
                        </div>
                        <div class="main-cont-rgt-box-btm"></div>
                    </div>
					
					
				   </div>
				
		  </div>
		  <div class="cont-area-btm"></div>
	  </div>
		
	  </div>
	  <div id="bottom_content"></div>
	</div>
	<div style="clear:both"></div>	
	
	<div id="footer_div" align="center" >
	  <div id="footer_content" align="center">
		  <div id="footer_head" align="center"><br /><br />&nbsp;&nbsp;&nbsp; &copy; All Rights 2010 Alim.org</div>
		  <div id="footer_menu">
		   <?php echo $footer; ?>
		  </div>
	  </div>
	   <div style="clear:both"></div>
	</div>

<div style="background:#F9D350;color:#A94C17" id="load_timediv"></div>
</div>
<script type="text/javascript" src="/misc/jquery.js?D"></script>
<script type="text/javascript" src="/misc/drupal.js?T"></script>
<?php
if($set_ok==1)
{
?>
<script type="text/javascript" src="/sites/all/libraries/boomerang/boomerang.js?g"></script>
<script type="text/javascript" src="/sites/all/modules/boomerang/boomerang.drupal.js?g"></script>
<?php
}
?>
<script type="text/javascript" src="http://s3.amazonaws.com/getsatisfaction.com/javascripts/feedback-v2.js"></script>
<script language="javascript" type="text/javascript"  src="/sites/all/themes/alim/galleryview/jquery.galleryview-2.1.1.js"/></script>
<script language="javascript" type="text/javascript"  src="/sites/all/themes/alim/galleryview/jquery.timers-1.2.js"/></script>
<script language="javascript" type="text/javascript"  src="/sites/all/themes/alim/galleryview/jquery.easing.1.3.js"/></script>	
<script type="text/javascript" src="/sites/all/themes/alim/jquery.cycle.all.js"></script>
<script type="text/javascript" src="/sites/all/themes/alim/crawler.js?k"></script>
<!--<script type="text/javascript" src="/sites/all/modules/google_analytics/googleanalytics.js?l"></script>-->
<script type="text/javascript">
marqueeInit({
			   uniqueid: 'mycrawler2',
							style: {
								'padding': '2px',
								'width': '556px',
								'height': '65px',
								'padding-bottom': '5px'
							},
							inc: 1, //speed - pixel increment for each iteration of this marquee's movement
							mouse: 'pause', //mouseover behavior ('pause' 'cursor driven' or false)
							moveatleast: 2,
							neutral: 150,
							savedirection: true
						});

$(document).ready(function() {
    $('#views_slideshow_singleframe_teaser_section_1').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
	
});

$(document).ready(function() {
    $('#views_slideshow_singleframe_teaser_section_2').cycle({
		fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		pager:  '#nav2',
	});
	
});

   
$(document).ready(function(){
  $('#gallery').show();
   $('#gallery_ini').hide();
	$('#gallery').galleryView({
	 gallery_width: 440,
	 gallery_height: 370,
     panel_width: 440,
	 panel_height: 323,
	 frame_width: 110,
	 frame_height: 16,
	 frame_scale: 'nocrop',
	 frame_opacity: 1.0,
	 frame_gap: 10,
	 frame_caption_size:5,
	 pointer_size:8,
	 filmstrip_margin:3,
	 show_captions:true,
	 transition_speed: 1200,  //INT - duration of panel/frame transition (in milliseconds)
     transition_interval: 4000
	 
	 });
	
 });
 
 
$("#div-close").click(function() {
$("#tell-friend").hide();
});

$("#email-show").click(function() {
$("#tell-friend").show();
});

 
$("#re-tab1").click(function() {
$("#recent-tab1").show();
$("#re-tab2 a").removeClass("selected");
$("#re-tab3 a").removeClass("selected");
$("#re-tab4 a").removeClass("selected");
$("#re-tab1 a").addClass("selected");
$("#recent-tab2").hide();
$("#recent-tab3").hide();
$("#recent-tab4").hide();
});

$("#re-tab2").click(function() {
$("#recent-tab2").show();
$("#re-tab1 a").removeClass("selected");
$("#re-tab3 a").removeClass("selected");
$("#re-tab4 a").removeClass("selected");
$("#re-tab2 a").addClass("selected");
$("#recent-tab1").hide();
$("#recent-tab3").hide();
$("#recent-tab4").hide();
});

$("#re-tab3").click(function() {
$("#recent-tab3").show();
$("#re-tab1 a").removeClass("selected");
$("#re-tab2 a").removeClass("selected");
$("#re-tab4 a").removeClass("selected");
$("#re-tab3 a").addClass("selected");
$("#recent-tab1").hide();
$("#recent-tab2").hide();
$("#recent-tab4").hide();
});

$("#re-tab4").click(function() {
$("#recent-tab4").show();
$("#re-tab1 a").removeClass("selected");
$("#re-tab2 a").removeClass("selected");
$("#re-tab3 a").removeClass("selected");
$("#re-tab4 a").addClass("selected");
$("#recent-tab1").hide();
$("#recent-tab2").hide();
$("#recent-tab3").hide();
});
</script>
<script type="text/javascript" src="/sites/all/modules/nice_menus/nice_menus.js?D"></script>
    <script type="text/javascript" src="https://rpxnow.com/openid/v2/widget"></script>
    <script type="text/javascript">
      <!-- Begin RPX Sign In from JanRain. Visit http://www.rpxnow.com/ -->
      RPXNOW.token_url = <?php $base_url?>+"/rpx/end_point?destination=node%2F163643";
      RPXNOW.realm = "alim-foundation.rpxnow.com";
      RPXNOW.overlay = true;
      RPXNOW.language_preference = "en";
      RPXNOW.flags = "delay_domain_check";
      RPXNOW.ssl = true;
	  
      <!-- End RPX Sign In -->
  </script>
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
		
  server_time=<?php echo $server_timemilli; ?>; // for ajax insert
  browser_time=  millisecondsLoading; // for ajax insert
  
  var disptime = <?php echo $time_taken; ?>;
  var totaltime_display =  seconds + disptime;
   
  document.getElementById('load_timediv').innerHTML = 'Total elapsed time: '+totaltime_display.toFixed(4)+' sec. ==> Server: '+disptime+' sec. | User (e.g. : browser,network,internet): '+seconds.toFixed(4) +' sec.';
   });

</script>
<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";  
  feedback_widget_options.company = "alim_foundation";
  feedback_widget_options.placement = "left";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "idea";

 var feedback_widget = new GSFN.feedback_widget(feedback_widget_options); 
</script>
<script type="text/javascript"> 
 $(document).ready(function() {

  $(window).load(function() 
   { 

        var cururl = "<?=$base_url?>";
		$.ajax({
   			type: "GET",
			url: "<?=$base_url?>/ajaxtracking/list",
   			data: "cururl=" + encodeURI(cururl) + "&gtime=" + encodeURI(server_time) + "&rtime="+ encodeURI(browser_time),
   			success: function(msg){
				//eval(msg);
   			}
 		});
		

	
  });

});
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['pageTracker._setAccount', 'UA-15658414-1']);
  _gaq.push(['pageTracker._trackPageview']);
  _gaq.push(["_trackPageLoadTime"]);
 (function() {
    var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript">
window.onload=function() {
var plend = new Date();
var plload = plend.getTime() - plstart.getTime();
if(plload<1000)
lc = "Very Fast";
else if (plload<2000)
lc = "Fast";
else if (plload<3000)
lc = "Medium";
else if (plload<5000)
lc = "Sluggish";
else if (plload<10000)
lc = "Slow";
else
lc="Very Slow";
var fn = document.location.pathname;
if( document.location.search)
fn += document.location.search;
try {
_gaq.push(['loadTracker._setAccount', 'UA-15658414-1']);
_gaq.push(['loadTracker._trackEvent','Page Load (ms)',lc + ' Loading Pages',fn,plload]);
_gaq.push(['loadTracker._trackPageview']);
} catch(err){}
}
</script>
<?php
if($set_ok==1)
{
?>
 <script type="text/javascript">
<!--//--><![CDATA[//><!--
BOOMR.init({"user_ip":"59.162.126.17","site_domain":".<?=$base_url?>","BW":{"base_url":"http:\/\/<?=$base_url?>\/sites\/all\/libraries\/boomerang\/images\/"},"beacon_url":"http:\/\/<?=$base_url?>\/beacon","RT":{"cookie":"BOOMR-RT","cookie_exp":120}});
    BOOMR.addVar('page_id', '<?=ip_address()?>');
    BOOMR.addVar('uid', '<?=$user->uid?>');
    BOOMR.addVar('uname', '<?=$user->name?>');
    
//--><!]]>
</script>
<div id="boomerang-results"></div>
<?php
drupal_set_message('test');
}
?>
</body>
</html>
 