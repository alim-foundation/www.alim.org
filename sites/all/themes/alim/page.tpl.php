<?php
// $Id: page.tpl.php,v 1.18.2.1 2009/04/30 00:13:31 goba Exp $
global $base_url;
global $theme_path;
$_SESSION['qry']=1;
//$start_time = microtime(TRUE);
$start_time = $_SESSION['start_time'];

/**
 * Code used for setting the cookie variables for 
 * Arabic fonts, English fonts, Ayah Themes, Translators options 
 * in left menu block.
*/


	   if(eregi("chrome", $_SERVER['HTTP_USER_AGENT'])) // Checking the browser is chrome.
		   {
		       $select_arb1 = 2;
		   }
		  else
		  {
  			$select_arb1 = 2;
			
		  }
  $select_arb_size1 = 20;
  $select_eng1 = 1;
  $select_eng_size1 = 14;
  $select_res = "Alafasy_128kbps";
  $expire=time()+(60*60*24*365*5); // 5 year
  $cookie_enabled = 2;
  
        $cookie_sent = setcookie("tc","ok",0, "/");
        if($cookie_sent == false){ $cookie_enabled = 1; }
		
		
/*** Set Cookie expired on browser close.*/

					
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
									  $goodUrl = str_replace('index.php?q=','', $url);
									 // header('location:'.$goodUrl);
									 
							}
							else
							{
									  setcookie("rem_uid",$user->uid, time()+1209600, "/");
							}
							 setcookie("remember","a", 0, "/");
						 }
						 
		                 if(arg(8)=='eng_font')
							{
								setcookie("eng_font", arg(9),$expire, "/");
							}
							if(arg(8)=='arb_font')
							{
								setcookie("arb_font", arg(9), $expire, "/");	
							}
							if(arg(8)=='eng_font_size')
							{
		  						setcookie("eng_font_size", arg(9), $expire, "/");
							}
							if(arg(8)=='arb_font_size')
							{
								setcookie("arb_font_size",arg(9), $expire, "/");
							}


      if(!isset($_COOKIE['reciterval']) || $_COOKIE['reciterval']=="") { 
	     $select_res =  $select_res1;
		 setcookie("reciterval", $select_res1, $expire, "/");
	  }
	  else
	  {
	    $select_res = $_COOKIE['reciterval'];
	  }
  
     if(!isset($_COOKIE['eng_font']) || $_COOKIE['eng_font']=="") { 
	     $select_eng =  $select_eng1;
		 setcookie("eng_font", $select_eng1, $expire, "/");
		 
	  }
	  else
	  {
	    $select_eng = $_COOKIE['eng_font'];
	  }
	  if(!isset($_COOKIE['eng_font_size']) || $_COOKIE['eng_font_size']=="") { 
	    
		 $select_eng_size =  $select_eng_size1;
		 setcookie("eng_font_size", $select_eng_size1, $expire, "/");
	  }
	  else
	  {
	    $select_eng_size = $_COOKIE['eng_font_size']; 
	  }
	  
	 
	  
	  if(!isset($_COOKIE['arb_font']) || $_COOKIE['arb_font']=="") { 
	  	$select_arb = $select_arb1;
		setcookie("arb_font", $select_arb1, $expire, "/");
	  }
	  else
	  {
	    $select_arb = $_COOKIE['arb_font'];
	  }
	  
	  if(!isset($_COOKIE['arb_font_size']) || $_COOKIE['arb_font_size']=="") { 
	    
		 $select_arb_size = $select_arb_size1; 
		 setcookie("arb_font_size", $select_arb_size1, $expire, "/");

	  }
	  else
	  {
	    $select_arb_size = $_COOKIE['arb_font_size']; 
	  }


		
		
/**
 * Url Changes during
 * Arabic fonts, English fonts, Ayah Themes, Translators options 
 * changing.
*/	

	                        $path = $base_url.'/library/quran';
							$path1 = $base_url.'/library/quran';
							if(arg(2) && arg(2)!=1001)
							{
								$path .= '/'.arg(2);
								$path1 .= '/'.arg(2);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
							if(arg(3) && arg(3)!=1001)
							{
								$path .= '/'.arg(3);
								$path1 .= '/'.arg(3);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
							if(arg(4) && arg(4)!=1001)
							{
								$path .= '/'.arg(4);
								$path1 .= '/'.arg(4);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
							if(arg(5) && arg(5)!=1001)
							{
								$path .= '/'.arg(5);
								$path1 .= '/'.arg(5);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
							if(arg(6) && arg(6)!=1001)
							{
								$path .= '/'.arg(6);
								$path1 .= '/'.arg(6);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
							if(arg(7) && arg(7)!=1001)
							{
								$path .= '/'.arg(7);
								$path1 .= '/'.arg(7);
							}
							else
							{
								$path1 .= '/1001';
								$path .= '';
							}
						        if(arg(1)==132474)
								{
								  $path1 = $base_url.'/str';
							
								
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
									//print $result_ful->value;
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
							}
						 
						}
						
					
							/**
						 	 * Code for giving priority to user preference,
							 * if user is login in.
							*/
												 
						   if(!($_COOKIE['rememberlogin']) && $cookie_enabled==2 && $user->uid!=0)
						 {
					 
										$sel_res = db_query("SELECT value as res_sel FROM profile_values WHERE fid=5 AND uid=".$user->uid);
										$fetch_res = db_fetch_object($sel_res);
										($fetch_res->res_sel) ? $select_res1 = $fetch_res->res_sel : $select_res1 = "Alafasy_128kbps";
										setcookie("reciterval", $select_res1, $expire, "/");
										setcookie("select_res", $select_res1, $expire, "/");	

										$sel_arb = db_query("SELECT value as arb_sel FROM profile_values WHERE fid=2 AND uid=".$user->uid);
										$fetch_arb = db_fetch_object($sel_arb);
										($fetch_arb->arb_sel) ? $select_arb1 = $fetch_arb->arb_sel : $select_arb1 = 2;
										setcookie("arb_font", $select_arb1, $expire, "/");
		
										$sel_arb_size = db_query("SELECT value as arbsize_sel FROM profile_values WHERE fid=4 AND uid=".$user->uid);
										$fetch_arb_size = db_fetch_object($sel_arb_size);
										($fetch_arb_size->arbsize_sel) ? $select_arb_size1 = $fetch_arb_size->arbsize_sel : $select_arb_size1 = 20;
										setcookie("arb_font_size", $select_arb_size1, $expire, "/");
		
										$sel_eng = db_query("SELECT value as eng_sel FROM profile_values WHERE fid=1 AND uid=".$user->uid);
										$fetch_eng = db_fetch_object($sel_eng);
										($fetch_eng->eng_sel) ? $select_eng1 = $fetch_eng->eng_sel : $select_eng1 = 1;
										setcookie("eng_font", $select_eng1, $expire, "/");
													
										$sel_eng_size = db_query("SELECT value as engsize_sel FROM profile_values WHERE fid=3 AND uid=".$user->uid);
										$fetch_eng_size = db_fetch_object($sel_eng_size);
										($fetch_eng_size->engsize_sel) ? $select_eng_size1 = $fetch_eng_size->engsize_sel : $select_eng_size1 = 14;
										setcookie("eng_font_size", $select_eng_size1, $expire, "/");
									
										$sel_asd = db_query("SELECT value as asd_sel,count(value) as asd_count FROM profile_values WHERE fid=7 AND uid=".$user->uid);
										$fetch_asd = db_fetch_object($sel_asd);
										($fetch_asd->asd_sel) ? $chek_asd = $fetch_asd->asd_sel : $chek_asd = 2;
										if($fetch_asd->asd_count==0)
										{
										 $chek_asd = 1;
										}
										setcookie("chek_asd", $chek_asd, $expire, "/");
									
								
														
										$sel_mal = db_query("SELECT value as mal_sel,count(value) as mal_count FROM profile_values WHERE fid=8 AND uid=".$user->uid);
										$fetch_mal = db_fetch_object($sel_mal);
										($fetch_mal->mal_sel) ? $chek_mal = $fetch_mal->mal_sel : $chek_mal = 2;
										if($fetch_mal->mal_count==0)
										{
										 $chek_mal = 1;
										}
										setcookie("chek_mal", $chek_mal, $expire, "/");
									
									
														
										$sel_pic = db_query("SELECT value as pic_sel,count(value) as pic_count FROM profile_values WHERE fid=9 AND uid=".$user->uid);
										$fetch_pic = db_fetch_object($sel_pic);
										($fetch_pic->pic_sel) ? $chek_pic = $fetch_pic->pic_sel : $chek_pic =2;
										if($fetch_pic->pic_count==0)
										{
										 $chek_pic = 1;
										}
										setcookie("chek_pic", $chek_pic, $expire, "/");
								
														
										$sel_yuf = db_query("SELECT value as yuf_sel,count(value) as yuf_count FROM profile_values WHERE fid=10 AND uid=".$user->uid);
										$fetch_yuf = db_fetch_object($sel_yuf);
										($fetch_yuf->yuf_sel) ? $chek_yuf = $fetch_yuf->yuf_sel : $chek_yuf = 2;
										if($fetch_yuf->yuf_count==0)
										{
											$chek_yuf = 1;
										}
										setcookie("chek_yuf", $chek_yuf, $expire, "/");
									
									
										$sel_ayatheme = db_query("SELECT value as theme_sel,count(value) as thm_cnt FROM profile_values WHERE fid=6 AND uid=".$user->uid);
										$fetch_ayatheme = db_fetch_object($sel_ayatheme);
										($fetch_ayatheme->theme_sel) ? $select_ayah = $fetch_ayatheme->theme_sel : $select_ayah = 0;
										if($fetch_ayatheme->thm_cnt==0)
										{
											$select_ayah = 0;
										}
										 if($select_ayah==1)
										   $chek = 2;
										  else
										   $chek = 1;
										setcookie("chek", $chek , $expire, "/");
									
										setcookie("rememberlogin", "ok", 0, "/");
										/*-----------------------------------------------------------*/
								
										$domain = $_SERVER['HTTP_HOST'];
										#
										  // find out the path to the current file:
										#
										  $path = $_SERVER['SCRIPT_NAME'];
										#
										  // find out the QueryString:
										#
										  $queryString = $_SERVER['QUERY_STRING'];
										#
										  // put it all together:
										#
										  $url = "http://" . $domain . $path . "?" . $queryString;
										  //print  $url;
											
										/*-----------------------------------------------------------*/	
											 //drupal_goto($url);
										$goodUrl = str_replace('index.php?q=','', $url);
									  //  header('location:'.$goodUrl);
								
							}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
  <meta http-equiv="X-UA-Compatible" content="IE=8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php print $head ?>
	<title><?php print $head_title ?></title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
	<meta HTTP-EQUIV="accept-encoding" CONTENT="gzip,deflate">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/<?=$theme_path?>/jqlist/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/<?=$theme_path?>/jqlist/prettify.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  var jq = jQuery.noConflict();
 $(document).ready(function() {
    jQuery( "#datepicker1" ).datepicker();
	jQuery( "#datepicker2" ).datepicker();
  });
  </script>

	  <script type="text/javascript"> 
   var startTime = (new Date()).getTime();
   var plstart = new Date(); 
</script>
	<style type="text/css">
		.accordion-content{ display:none; }
		   .faq-answer
		{
		 display:none;
		}
	</style>
	<?php print $styles ?>
		<?php if(arg(1)!='biography') { ?> 	
	<style type="text/css">
	#con_div_middle
    {
	 overflow:auto;
	}
	</style>
	<?php
	}
	?>

<?php

/**
 * Code used for setting the cookie variables for 
 * Arabic fonts, English fonts, Ayah Themes, Translators options 
 * in left menu block.
 * Set Cookie expired on browser close.
*/

						 
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
							

/**
 * Change style according to
 * Arabic fonts, English fonts, Ayah Themes, Translators options 
 * changing in left menu block.
*/
 
	
	   $font =  $select_eng;
	   //print "English Font: ".$font;
		switch($font){
			case 1 :
			print "<style type='text/css'>
						 .font_ayah{ font-family:tahoma; }
						 .font_ayah a{ font-family:tahoma; }
						 .hovertip{ font-family:tahoma; }
						 </style>";
			break;
			case 2 :
			print "<style type='text/css'>
  				 .font_ayah{ font-family:Arial; }
				.font_ayah a{ font-family:Arial; }
				.hovertip{ font-family:Arial; }
				  </style>";
			break;
			case 3 :
			print "<style type='text/css'>
				.font_ayah{ font-family:Courier; }
				.font_ayah a{ font-family:Courier; }
				.hovertip{ font-family:Courier; }
				 </style>";
			break;
			case 4 :
			print "<style type='text/css'>
					.font_ayah{ font-family:Courier New; }
					.font_ayah a{ font-family:Courier New; }
					.hovertip{ font-family:Courier New; }
				 </style>";
			break;
			case 5 :
			print "<style type='text/css'>
					 .font_ayah{ font-family:Geneva; }
					 .font_ayah a{ font-family:Geneva; }
					 .hovertip{ font-family:Geneva; }
					</style>";
			break;
			case 6 :
		    print "<style type='text/css'>
					.font_ayah{ font-family:Georgia; }
				    .font_ayah a{ font-family:Georgia; }
			 	   .hovertip{ font-family:Georgia; }
				 </style>";
			break;
			case 7 :
		    print "<style type='text/css'>
					.font_ayah{ font-family:Helvetica; }
					.font_ayah a{ font-family:Helvetica; }
					.hovertip{ font-family:Helvetica; }
				  </style>";
			break;
			case 8 :
			print "<style type='text/css'>
					.font_ayah{ font-family:Verdana; }
					.font_ayah a{ font-family:Verdana; }
					.hovertip{ font-family:Verdana; }
				</style>";
			break;
			case 9 :
			print "<style type='text/css'>
				    .font_ayah{ font-family:sans-serif; }
					.font_ayah a{ font-family:sans-serif; }

					.hovertip{ font-family:sans-serif; }
				   </style>";
			break;
			case 10 :
			print "<style type='text/css'>
					.font_ayah{ font-family:Times New Roman; }
     				.font_ayah a{ font-family:Times New Roman; }
				   .hovertip{ font-family:Times New Roman; }
				</style>";
			break;
			default :
			 print "<style type='text/css'>
					  .font_ayah{ font-family:tahoma; }
					   .font_ayah a{ font-family:tahoma; }
					  .hovertip{ font-family:tahoma; }
					</style>";
			break;

		}

		 for($i=9;$i<=18;$i++)
			 {
			 if($select_eng_size==$i)
				{
						print "<style type='text/css'>
							.font_ayah{ font-size:".$i."px; }
							 .font_ayah a{ font-size:".$i."px; }
							.hovertip{ font-size:".$i."px; }
							.views-field views-field-body{ font-size:".$i."px; }
							</style>";
				}
			}

			$arbic_font = $select_arb;
			//print "Arabic Font: ".$arbic_font;
			switch($arbic_font)
			{
				case 1 : 
				print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:Traditional Arabic; }
					    #content_data .arabic_text_style{ font-family:Traditional Arabic; }
					    #content_data .view-arabic-ayah .odd{ font-family:Traditional Arabic; }
						#content_data .view-arabic-ayah .even{ font-family:Traditional Arabic; }
					   @font-face {
					     font-family: \"Traditional Arabic\";
							  src: url('".$base_url."/fonts/trado.ttf');}
						</style>";

				break;
				case 2 :
   		        print "<style type='text/css'>
				         #content_data .arabic_top{ font-family: \"me_quran\", serif; }
					    #content_data .arabic_text_style{ font-family: \"me_quran\", serif; }
					     #content_data .view-arabic-ayah .odd{ font-family: \"me_quran\", serif; }
						 #content_data .view-arabic-ayah .even{ font-family: \"me_quran\", serif; }
						  @font-face {
							  font-family: \"me_quran\";
							  src: url('".$base_url."/fonts/me_quran.eot');
							  src: url('".$base_url."/fonts/me_quran.eot') format('embedded-opentype'),
							  url('".$base_url."/fonts/me_quran.ttf') format('truetype');
							}
						 </style>";
			    break;
                case 3 :
         		print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:Scheherazade,Scheheraza; }
					    #content_data .arabic_text_style{ font-family:Scheherazade,Scheheraza; }
					     #content_data .view-arabic-ayah .odd{ font-family:Scheherazade,Scheheraza; }
						 #content_data .view-arabic-ayah .even{ font-family:Scheherazade,Scheheraza; }
						   @font-face {
							  font-family: \"Scheheraza\";
							  src: url('".$base_url."/fonts/Scheherazade.eot');
    						  src:local('Scheheraza'), url('".$base_url."/fonts/Scheherazade.ttf') format('truetype');
           				}
   					 </style>";
				break;
				case 4 :
				print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:Arial; }
					    #content_data .arabic_text_style{ font-family:Arial; }
					     #content_data .view-arabic-ayah .odd{ font-family:Arial; }
					 #content_data .view-arabic-ayah .even{ font-family:Arial; }
					</style>";
				break;
  				case 5 :
        		print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:Courier New; }
					    #content_data .arabic_text_style{ font-family:Courier New; }
					     #content_data .view-arabic-ayah .odd{ font-family:Courier New; }
						 #content_data .view-arabic-ayah .even{ font-family:Courier New; }
						</style>";
				break;
				case 6 :
				print "<style type='text/css'>
    				    #content_data .arabic_top{ font-family:Times New Roman; }
					    #content_data .arabic_text_style{ font-family:Times New Roman; }
					     #content_data .view-arabic-ayah .odd{ font-family:Times New Roman; }
						 #content_data .view-arabic-ayah .even{ font-family:Times New Roman; }
					</style>";
				break;
				case 7 :
				print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:'KFGQPC Uthman Taha Naskh Bold;' }
					    #content_data .arabic_text_style{ font-family:'KFGQPC Uthman Taha Naskh Bold'; }
					     #content_data .view-arabic-ayah .odd{ font-family:'KFGQPC Uthman Taha Naskh Bold'; }
						 #content_data .view-arabic-ayah .even{ font-family:'KFGQPC Uthman Taha Naskh Bold'; }
				@font-face{font-family: 'KFC_Naskh_Bold';font-weight:bold;src:url('".$base_url."/fonts/KFC_naskhb.eot') format('ignore');
				src:local('KFGQPC Uthman Taha Naskh Bold'), url('".$base_url."/fonts/org/KFC_naskhb.otf') format('opentype')};
				</style>";
				break;
			    default :
			    print "<style type='text/css'>
					    #content_data .arabic_top{ font-family:Traditional Arabic; }
					    #content_data .arabic_text_style{ font-family:Traditional Arabic; }
					    #content_data .view-arabic-ayah .odd{ font-family:Traditional Arabic; }
						 #content_data .view-arabic-ayah .even{ font-family:Traditional Arabic; }
						   @font-face {
							  font-family: \"Traditional Arabic\";
							  src: url('".$base_url."/fonts/trado.ttf');
							}
						</style>";
				break;
			}
			
		   for($i=15;$i<=30;$i++)
			 {
				 if($select_arb_size==$i)
				{
					print "<style type='text/css'>
					    #content_data .arabic_top{ font-size:".$i."pt; }
					    #content_data .arabic_text_style{ font-size:".$i."pt; }
					     #content_data .view-arabic-ayah .odd{ font-size:".$i."pt; }
						 #content_data .view-arabic-ayah .even{ font-size:".$i."pt;}
					</style>";
				}
			}
?>

    <!--[if lt IE 7]>
	<?php print phptemplate_get_ie_styles(); ?>
	<![endif]-->
		<script type="text/javascript" src="<?php print $base_url."/".$theme_path;?>/dhtml_menu/dhtml-menu.js"></script>

		<script language="javascript">
		function fixprogressbar()
		{
		top.garbageframe.document.write("");
		top.garbageframe.close();
		return
		}	
	</script>

	<?php
	
/**
 * Hide
 * 56 th surah of Malik translation
 *
*/	
if(!$_COOKIE["donate_pop"]){	
	//setcookie("donate_pop",true, time()+3600,'/');
	print "<style> #block-block-53 #donate { display:block; } </style>";		
}else{
	print "<style> #block-block-53 #donate { display:none;} </style>";		
}
if(arg(4)=='55' && arg(5)=='MAL')
{
?>
<style type="text/css">
	#clip-all-content, #block-block-23, #block-block-18, #block-quicktabs-12 { display:none;}
	</style>
<?php
}	
/**
 * Hide
 * Biography div until page load complete.
 * Waiting for jquery to load.
*/	
	if((arg(1)=='biography' || arg(2)=='narrators') && (arg(3)!='content')){ 
	?> 
	<style type="text/css">
	.view-biography-stories, .view-biography-history, .view-Hadith-narrators{ display:none;}
	</style>
<?php
/**
 * Shows
 * Biography div after page load complete.
*/	
?>
	<script language="javascript">
	$(document).ready(function () {
	 $('.view-biography-stories').show();
	  $('.view-biography-history').show();
	  $('.view-Hadith-narrators').show();
	});
	</script>
	<?php } ?>
  </head>
<?php
// flush the buffer
flush();
?>
<body onload="fixprogressbar()">
<div class="beta_tag" align="left"></div> 
   <div id="Layer1" style="background-color:#f9d350; font-family:Verdana, Arial, Helvetica, sans-serif; padding:5px ; margin:0px; border:1px solid #4b1d06; font-size:10px;position:relative;left:0;top:0;padding-left:50px;color:#a94c17;padding-right:50px;display:none;" align="left">This site is currently in active development and will, insha-Allah, be officially launched on <?=date('l dS \o\f F Y',strtotime("+1 week"))?>. <a href="<?=$base_url;?>/googlegroup" style="color:#115BBC;">Click here to register</a> for our newsletter mailing list to stay informed about our progress.While our site is being developed, please let us know what you think by clicking the <a href="#"  style="color:#115BBC;"  onClick='window.open("http://getsatisfaction.com/alim_foundation/feedback/topics/new?display=overlay&style=idea", "Feedback", "width=647,height=311,scrollbars=no")' >Feedback</a> button.</div>
<?php
// set english font cookie for quran structure page
if(arg(0)=='str' && arg(1)=='eng_font'){
	$_COOKIE['eng_font']=arg(2);
	header('location:'.$base_url.'/library/quran/structure');
}

// Set variable, $surah for getting 'next' and 'prev' arguments
if(arg(4)) {
	if(arg(4)==132474) 	{ 	   
	 $surah = 1;
	}	else	{
	  $surah = arg(4);
	}
}

if(!arg(2)){
 $surah = 1;
}  
else if(arg(2)!='quran'){
 $surah = 1;
}  
if(arg(3)=='subject' || arg(2)=='subject'){	
   $surah = 1;
}

// Set variable, $page_no  for getting 'next' and 'prev' arguments

$page_no = 0;
$viewPageName = 'pageno_from_surano';
$view2 = views_get_view($viewPageName);
$view2->set_display('default');
if(arg(3)=='compare') {
   $view2->set_arguments(array($surah,arg(5)));
}else{
  $view2->set_arguments(array($surah));
}
   $view2->execute();
   $page_no = $view2->result;
   $page_no = $page_no[0]->node_data_field_page_no_field_page_no_value;

?>

<div id="outer_div" align="center">
	<div id="main_div">		  
		<div id="head_div">				   
			<div id="top_menu" align="center">	
				<div id="top_menu_left"></div>
				<div id="top_menu_middle"><?php print $header; ?></div> 
				<div id="top_menu_middle_second" style="color:#990000;font-weight:bold;" align="right"> 
				  
					<?php 
					// RPX Login. if getting user id shows 'My Profile' Link on top grey menu bar.
					if($user->uid){?><?php print l("My Profile",'userprofile'); ?>&nbsp;&nbsp;
					<?php print l("Logout","logout"); ?><? } else {?>
					<?php print $rpx_login ; ?> <? }?>&nbsp;&nbsp;
					<a href="<?=$base_path?>" title="Home"><img src="<?php print $base_url."/".$theme_path;?>/images/alim-home.png"  border="0" align="absmiddle" title="Home" alt="Home" width="25" height="25" /></a>
				</div>	  
				<div id="top_menu_right"></div>
			</div>

			<div style="clear:both"></div>
			
			<div id="head_middle">
				<div id="logo">
					<div style="float:left;margin-right:40px;padding-top:2px;">
					<a  href="<?=$base_path?>" title="Home"><img src="<?php print $base_url."/".$theme_path;?>/images/alim-logo-top.png" border="0"  align="absmiddle" width="135" height="61"/></a>
					</div>
					<div style="float:left;"><h1> <?php print print_masterhead(); ?>  </h1></div>		
				</div>
				<div id="search" align="left"><div id="search_content"><?php if ($search_box): ?><div ><?php print $search_box ?></div><?php endif; // search box  ?></div></div>
			</div>
			<div style="clear:both"></div>
			
			<div id="second_menu">
				<?php print Submenu_all(); ?>
				<?php if ($menu_tab): print $menu_tab; endif; ?>
				<div style="clear:both"></div>
			</div>
		
			<div class="inner_donate">  
						<div> <a href="https://donatenow.networkforgood.org/alim?code=alim.org" target="_blank" ><div style="margin-top: -3px;margin-left: -5px;float: right;width: 200px; "> <img  src="/sites/all/themes/alim/images/donate-button.png"  width="200" /></div></a></div>
			</div>			
		
		 </div>
		<div style="clear:both"></div>
			<div id="con_div">
			 <div id="con_div_top" align="left"> 
				<div class="crumb_back" >
					<div id="breadcrumb"  > <?php if(arg(0)!='comment')
	 { ?><?php print $breadcrumb; // prints breadcrumb 
	 }?></div>	
					<div id="social-face" >		
						 <div class="like"  >	<?php // fecebook like and share this code  ?>				 
						 <iframe src="http://www.facebook.com/plugins/like.php?href=<?php print rawurlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&amp;layout=button_count&amp;width=80&amp;font=arial&amp;colorscheme=dark" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px;height:28px; " allowTransparency="true" height="28" width="80"></iframe>
						 </div>
					 <?php if(arg(0)!='manage'){ ?>
					    <div class="share"  >	
				<script type="text/javascript" src="http://w.sharethis.com/button/sharethis.js#publisher=f854b6ba-49af-4ac7-b234-2d0d04bc447c&amp;type=website&amp;style=horizontal&amp;post_services=email%2Cfacebook%2Ctwitter%2Cgbuzz%2Cmyspace%2Cdigg%2Csms%2Cwindows_live%2Cdelicious%2Cstumbleupon%2Creddit%2Cgoogle_bmarks%2Clinkedin%2Cbebo%2Cybuzz%2Cblogger%2Cyahoo_bmarks%2Cmixx%2Ctechnorati%2Cfriendfeed%2Cpropeller%2Cwordpress%2Cnewsvine"></script>					 					
						 </div><?php } ?>	 
					 </div>	
					 	
				</div>

				 <div style="clear:both"></div>
			 </div>
			 <div id="con_div_middle">			  
				 <div id="Content-new"  <?php if(arg(3)=="arabic"){ ?>onmousedown="whichElement(event);" onmouseover="whichElement(event);" <?php } ?> >			
				<?php if ($left): ?><div class="left-side-bar" ><?php print $left; ?></div><?php endif; ?>
				
				<?php if(!$left && $nav_menu){ ?><div id="navmenu-left" > <?php print $nav_menu; ?></div><?php } ?>
			   				
				
				<?php 

			/**
			 * Display separate layout for group and userprofile page 
			 * inside if condition : normal page content display
			 * inside else : group and userprofile page content display
			*/

				if ($left || $nav_menu ){ 
					$divid ="content" ;
				}else{ 
			   		if(arg(0)!='userprofile' && arg(0)!='groupdetails') {
						$divid="content1" ;
					}else{ 
						$divid="profile_content1"; 
					}
				}
				 ?>		
			    	   <div id="<?php print $divid; ?>" > 
			            <div style="clear:both"></div>
						
						<?php 
						// Go to profile block
						if ($goto): print '<div id="goto_link" class="clear-block">'.$goto.'</div>'; endif; 
						?>	   
						<?php if ($clips): if($clipcategory) {$newtitcls = ' midtitle'; } ?><div id="clipps" > <?php print $clips; ?></div> <?php endif; ?>
						
						<?php       
				if(arg(3)!='page' && arg(1)!='132474' && arg(1)!='132487' && arg(3)!='arabic' && arg(3)!='english' && arg(3)!='compare' && arg(2)!='khalifa' && arg(4)!='BIO' && arg(0)!='userprofile' && arg(0)!='groupdetails')  {
		      if ($title): print '<h2 id="thetitle" '. ($tabs ? ' class="with-tabs '.$newtitcls.'"' : '') .'>'. $title .'</h2>'; endif;
		 		 } 	 ?>
				 
				 		<?php if ($clipcategory): $newcls = ' alim-cntright'; ?><div id="clip-cat" > <?php print $clipcategory; ?></div><?php endif; ?>	
						
						<div class="alim-content<?php print $newcls; ?>" >
							<div class="tab-msg" >	
								<?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">'; endif; ?>	 	  
								<?php  if(arg(1)!='163607') {  ?>
								<?php if ($tabs): print '<ul class="tabs primary clear-block ">'. $tabs .'</ul>'; endif; ?>
								<?php  }   ?>
								<?php if ($tabs): print '</div>'; endif; ?>
								<?php if ($tabs2): print '<ul class="tabs secondary clear-block ">'. $tabs2 .'</ul>'; endif; ?>
								<?php if ($show_messages && $messages): print $messages; endif; ?>	
							</div>
							
							<div id="content_data">	
							
							<?php if(arg(3)=='english' || arg(3)=='compare' || arg(2)=='AlQuran-tafsir' || arg(2)=='duas') { ?> <div class="font_ayah" id="font_ayah">  <?php  } ?>
							
							<?php if(arg(0)=='userprofile' || arg(0)=='groupdetails') { ?>
								<div>
								<?php if(!($user->uid) && arg(1)=='')
								{
							        echo "<b>Login to view your profile details</b>";
									$breadcrumb = array();
									$breadcrumb[] =  l(t('Home'), '<front>') ;
									$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
									drupal_set_breadcrumb($breadcrumb);
								}
								else
								{
								
								?>

								<table width="940" border="0" cellpadding="0" cellspacing="0" class="profile_table">
	 							 <tr>
									<td width="645" style="padding-left:5px;" valign="top">
									<div class="profile-content" ><?php print $content ?>	</div>
									</td>
										<td background="<?php print $base_url."/".$theme_path;?>/images/bg_shadow.gif" width="20" valign="top">
											<div class="shadow_top">&nbsp;</div>	
										</td>
										<td width="250" style="padding:5px 0 0 10px;" valign="top">
								           <?php if ($user_profile): print '<div id="profile-content_right" class="profile-content-right" >'.$user_profile.'</div>'; endif; ?>				 					 	                                     </td>
										  </tr>
										  <tr>
											<td>&nbsp;</td>
									<td valign="top"><div style="background:url(<?php print $base_url."/".$theme_path;?>/images/shadow_bot.png) top left no-repeat; height:30px;"></div></td>
											<td>&nbsp;</td>
										  </tr>
										</table>
								
								</div>
								<?php } } else { ?>
								<?php if ($top_sub): ?> <div class="topcnt" ><?php print $top_sub; ?></div><?php endif; ?>
								<div><?php print $content ?></div>
								<?php } ?>
							
							<?php if($bottom_comment){ ?><div class="bottom-cnt" style="clear:both;" ><?php print $bottom_comment; ?></div><?php } ?>
							<?php if(arg(3)=='english' || arg(3)=='compare')  { ?></div> <?php  }  ?>
							
								
								<div style="clear:both"></div>	
								
							</div>	
						</div>	
			        </div>
			    
			  <div style="clear:both"></div>
			 </div>
	
			 </div>
	  	 </div>		 
					  
	
	   </div>
</div>
 	<div style="clear:both"></div>
	<div id="footer_div" align="center" >
	  <div id="footer_content" align="center">
		  <div id="footer_head" align="center"><a  href="<?=$base_path?>" title="Home"><img src="<?php print $base_url."/".$theme_path;?>/images/alim-logo1.png" border="0"  width="262" height="61" /></a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; All Rights 2010 Alim.org</div>
		  
		  <div id="footer_menu"><?php print $footer; ?></div>
	  </div>
	   <div style="clear:both"></div>
	</div>
	
<?php print $bookmark; // bookmark right side fixed menu  ?>
<?php print $scripts ?>
<?php
/**
 * Hide
 * 56 th surah of Malik translation
 *
*/	

if(arg(4)=='55' && arg(5)=='MAL')
{
?>
<script language="javascript">
$('#mal_div').css('display':'none');
document.getElementById('clip-all-content').style.display='block';
document.getElementById('clip-all-content').innerHTML='Content is not available.';
document.getElementById('block-block-23').style.display='none';
document.getElementById('block-block-18').style.display='none';
document.getElementById('block-quicktabs-12').style.display='none';
</script>
<?php

}
?>
<script>	 
$(document).ready(function() {

$('#demo').mouseover(function() {
  $('.tooltip').css('display','block');
});
$('#demo').mouseout(function() {
  $('.tooltip').css('display','none');
});
$('.tooltip').mouseover(function() {
  $('.tooltip').css('display','block');
});

   $('#block-views-follow_me-block_1 .view-header h2').mouseover(function() {
   
	$(".follow_me_profile_help").addClass("hasFocus");
	 setTimeout(function(){ 
        if ($(".follow_me_profile_help").hasClass("hasFocus")) {
            $(".follow_me_profile_help").slideDown('fast');
        }
      }, 500 );
	$('.follow_me_profile_help').css('position','absolute');
	$('.follow_me_profile_help').css(' font-size','24px');
	$('.follow_me_profile_help').css('width','350px');
	$('.follow_me_profile_help').css('color','#00000');
	
	
	});
	$('#block-views-follow_me-block_1 .view-header').mouseout(function() {
	  $(".follow_me_profile_help").removeClass("hasFocus");
	$('.follow_me_profile_help').css('display','none');
	$('.follow_me_profile_help').css('position','relative');
	});
	
	
	$('#block-views-follower_of-block_1 .view-header h2').mouseover(function() {
	 $(".follower_of_profile_help").addClass("hasFocus");
	 setTimeout(function(){ 
        if ($(".follower_of_profile_help").hasClass("hasFocus")) {
            $(".follower_of_profile_help").slideDown('fast');
        }
      }, 500 );
	$('.follower_of_profile_help').css('position','absolute');
	$('.follower_of_profile_help').css(' font-size','24px');
	$('.follower_of_profile_help').css('width','350px');
	$('.follower_of_profile_help').css('color','#00000');
	});
	$('#block-views-follower_of-block_1 .view-header ').mouseout(function() {
		$(".follower_of_profile_help").removeClass("hasFocus");
	$('.follower_of_profile_help').css('display','none');
	$('.follow_me_profile_help').css('position','relative');
	});
	
	$('.view-id-my_groups h2').mouseover(function() {
    $(".profile_help").addClass("hasFocus");
	 setTimeout(function(){ 
        if ($(".profile_help").hasClass("hasFocus")) {
            $(".profile_help").slideDown('fast');
        }
      }, 500 );

	$('.profile_help').css('position','absolute');
	$('.profile_help').css(' font-size','24px');
	$('.profile_help').css('width','350px');
	$('.profile_help').css('color','#00000');
	});	
	$('.view-id-my_groups').mouseout(function() {
		$(".profile_help").removeClass("hasFocus");

	$('.profile_help').css('display','none');
	$('.follow_me_profile_help').css('position','relative');
	});
	
	
	$('#block-block-34 h2').mouseover(function() {
		 $(".newroup_profile_help").addClass("hasFocus");
	 setTimeout(function(){ 
        if ($(".newroup_profile_help").hasClass("hasFocus")) {
            $(".newroup_profile_help").slideDown('fast');
        }
      }, 500 );
	$('.newroup_profile_help').css('position','absolute');
	$('.newroup_profile_help').css(' font-size','24px');
	$('.newroup_profile_help').css('width','350px');
	$('.newroup_profile_help').css('color','#00000');
	});		
    $('#block-block-34 ').mouseout(function() {
	$(".newroup_profile_help").removeClass("hasFocus");

	$('.newroup_profile_help').css('display','none');
	$('.follow_me_profile_help').css('position','relative');
	});
	
	

});

</script>	
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
<script type="text/javascript" src="http://s3.amazonaws.com/getsatisfaction.com/javascripts/feedback-v2.js"></script>

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


<?php if (arg(3)=="compare"){?>
<script type="text/javascript" charset="utf-8">
var ayah_num=<?=arg(5)?>;
var surah_num=<?=arg(4)?>;
var retval ;var fn ;
var a = ayah_num;
var b  = 'Surah-'+surah_num+'.Ayah-'+ayah_num;
window.onload=function() {
	fn = document.location.pathname;
	retval = _gaq.push('_trackEvent','Quran Ayah View',b,fn,a);
}

$('.right-audio ').click(function() {
	retval = _gaq.push('_trackEvent','Recitation', b ,fn );
});

var key = "";var retval;fn = document.location.pathname;
$(document).bind("popups_open_path_done", function() {
	$('#comment-form #edit-submit').click(function() {
		key = $("#comment-form .form-textarea").val(); 
		var key1 = key.substr(0,30);
		retval = _gaq.push('_trackEvent','Quran Ayah Comments',b,key1 , fn  );
	});
});
</script>
<?php }?>

<?php if (arg(3)=="english" && arg(2)=="surah" ){?>
<script type="text/javascript" charset="utf-8">
var garet;
var surah_num1=<?=arg(4)?>;
var surah_auth="<?=arg(5)?>";
var b13_clip  = "Clipping Surah-"+surah_auth+"-"+surah_num1;
var b13  = "Comment Surah-"+surah_auth+"-"+surah_num1;
var b1  = 'Surah-'+surah_auth+'-'+surah_num1;

</script>

<script type="text/javascript">
window.onload=function() {
	var fn = document.location.pathname;
	retval = _gaq.push('_trackEvent','Quran Surah View',b1,fn );
}
var key = "";var retval;fn = document.location.pathname;
$(document).bind("popups_open_path_done", function() {
	$('#comment-form #edit-submit').click(function() {
		key = $("#comment-form .form-textarea").val(); 
		var key1 = key.substr(0,30);
		retval = _gaq.push('_trackEvent','Quran Surah Comments',b1,key1,fn );
	});
});
</script>
<?php }?>

<?php if (arg(3)=="arabic"&&arg(2)=="surah"){?>
<script type="text/javascript">
var su_num=<?=arg(4)?>;
var b  = 'Surah-'+su_num;
var fn = document.location.pathname;
$('.right-audio ').click(function() {
	retval = _gaq.push('_trackEvent','Recitation', b ,fn);
});
</script>
<?php  }?>

<?php if (arg(1)=="hadith"){?>
<script type="text/javascript">
var key = "";var retval;fn = document.location.pathname;
$(document).bind("popups_open_path_done", function() {
	$('#comment-form #edit-submit').click(function() {
	  key = $("#comment-form .form-textarea").val(); 
	var key1 = key.substr(0,30);
	   retval = _gaq.push('_trackEvent','Quran Hadith Comments',key1 , fn);
	});
});
</script>
<?php  }?>

<script type="text/javascript">
$(document).bind("popups_open_path_done", function() {						
				$("#popups input[type='submit'].form-submit").click(function() { 				
							Drupal.wysiwyg.editor.detach.nicedit($(this)  );																											
				});							
});

$('.dummy-player').click(function(event) {

	var yid;
	var ayahno;
	var num1;
	var num2;
	var full;
	var surno = '<?=arg(4)?>';
	var html_pl;
	var rec_pt="Alafasy_128kbps";
	if(surno<10)
	num1="00"+surno;
   else if(surno>10 && surno<100)
	num1="0"+surno;
   else
	num1=surno;

	yid=$(this).attr("id");
	// alert(yid);
	var ayas=yid.split("_",2);
	var ayahno=ayas[1];
	if(ayahno<10)
			num2="00"+ayahno;
		   else if(ayahno>10 && ayahno<100)
			num2="0"+ayahno;
		   else
			num2=ayahno;
			full = num1+num2+".mp3";

  var html_pl = "<object type='application/x-shockwave-flash' data='<?=$base_url?>/sites/all/themes/alim/button_player/button/musicplayer.swf?&song_url=http://www.everyayah.com/data/"+rec_pt+"/"+full+"&b_bgcolor=FEE8AF&b_fgcolor=006600&autoplay=true' width='17' height='20' align='absmiddle'><param name='movie' value='<?=$base_url?>/sites/all/themes/alim/button_player/button/musicplayer.swf?&song_url=http://www.everyayah.com/data/"+rec_pt+"/"+full+"&b_bgcolor=FEE8AF&b_fgcolor=006600&autoplay=true' align='absmiddle' width='17' height='20' /><param name='wmode' value='transparent' /></object>";
	 
	  document.getElementById(yid).innerHTML = html_pl;

});
</script>
<?php
$ck_sh=0;
if(arg(1)=='quran' &&  (arg(2)=='ayah' || arg(2)=='surah' || arg(2)=='AlQuran-tafsir' || arg(2)=='duas') )
{
	$ck_sh =1;
}
else if(arg(1)=='hadith' &&  (arg(2)=='SAD' || arg(2)=='AMH' || arg(2)=='HDQ' || arg(2)=='fiq' || arg(2)=='SHM' || arg(2)=='TIR' || arg(2)=='prophet' || arg(2)=='SHB'))
{
  $ck_sh =1;
}
else if(arg(1)=='biography' &&  (arg(2)=='khalifa' || arg(2)=='stories' || arg(2)=='companion')  && arg(3)=='content')
{
	$ck_sh =1;
}
else if(arg(1)=='islam' &&  (arg(2)=='article' || (arg(2)=='world' && arg(3)=='content') || (arg(2)=='islamposters' && arg(3)=='content')) )
{
	$ck_sh =1;
}
else if(arg(0)=='news')
{
    $ck_sh =1;
}
if($ck_sh==1)
{
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/<?=$theme_path?>/jqlist/prettify.js"></script>
<script type="text/javascript" src="<?=$base_url?>/<?=$theme_path?>/jqlist/jquery.multiselect.js"></script>	
<script type="text/javascript">
if(document.getElementById("groups"))
{
	jQuery(function(){
			jQuery("#groups").multiselect({
				selectedList: 4,
				minWidth : 225,
				checkAllText : '',
				uncheckAllText : 'Remove Filters',
				selectedList:0,
				uncheckAll: function(){
				 document.frm_comm_filt.submit();
			  }
			});
	});
}
</script>
<?php
}
?> 
<script type="text/javascript">
$("#quicktabs-12 li.first a").click(function() {
$(".comment-filtering").show();
$('#block-quicktabs-12').css('marginTop',-35);
});
$("#quicktabs-12 li.last a").click(function() {
$(".comment-filtering").hide();
$('#block-quicktabs-12').css('marginTop',0);
});
$("#quicktabs-3 li.first a").click(function() {
$(".comment-filtering").show();
$('#block-quicktabs-3').css('marginTop',-35);
});
$("#quicktabs-3 li.last a").click(function() {
$(".comment-filtering").hide();
$('#block-quicktabs-3').css('marginTop',0);
});
/*$("#quicktabs-tab-22-0").click(function() {
window.location = '?quicktabs_22=0#quicktabs-22';
});*/
$("#quicktabs-tab-22-1").click(function() {
window.location= '?quicktabs_22=1#quicktabs-22';
});

</script>
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
  <?php if(arg(2)=="surah"){
  ?>
<script type="text/javascript">
 
    //avoid conflict with other script
    $j=jQuery.noConflict();
 
    $j(document).ready(function($) {
 
	//this is the floating content
	var $floatingbox = $('#audioblock');
 
	if($('#audioblock').length > 0){
 
	  var bodyY = parseInt($('#audioblock').offset().top) - 20;
	  var originalX = $floatingbox.css('margin-left');
 
	  $(window).scroll(function () { 
 
	   var scrollY = $(window).scrollTop();
	   var isfixed = $floatingbox.css('position') == 'fixed';
	   var result = $("#clip-all-content").height();
 	   /*  $('#curraya').html("srollY : " + scrollY + ", bodyY : " 
                                     + bodyY + ", isfixed : " + isfixed+'height'+result);*/
		var leftht=	$("#left_menu").height();				 
 
	   if($floatingbox.length > 0){
 
	      if ( scrollY > bodyY && !isfixed  ) {
		  /*$('#audioblock').addClass('span3');*/
			$floatingbox.stop().css({
			  position: 'fixed',
			  left: '50%',
			  top: 0,
			  marginLeft: -463,
			  /*background-color:'#445C8F',*/
			  /*border-radius:'4px'*/
			});
		}  
		if ( scrollY < bodyY && isfixed  || (result < leftht) ) {
		//$('#audioblock').removeClass('span3');
		 	  $floatingbox.css({
			  position: 'relative',
			  left: 0,
			  top: 0,
			  marginLeft: originalX
		});
	     }
		  if((scrollY >= (result+50)) &&(result > leftht))	
		 {
		 //$('#audioblock').removeClass('span3');
		  $floatingbox.css({
			  position: 'relative',
			  left: 0,
			  top: 300,
			  marginLeft: originalX
		});
		 }	
	   }
	   
       });
     }
  });
</script>
  <?php }
  ?>
<script src="/sites/all/themes/alim/jquery.cookie.js"></script>
<script language="javascript">
	jQuery(function(){
			jQuery('a#close-popup').click(function() {	

			if(jQuery('#reminder').attr('checked'))

			{

				jQuery.cookie('donate_pop',1,{ expires:30, path: '/'});	
					jQuery('#donate').hide(); 

			}

			else

			{
				jQuery.cookie('donate_pop',1,{ expires:1, path: '/'});
				jQuery('#donate').hide(); 

			}
		});

	}); 

</script>
<?php print $closure ?>	
</body>
</html>
