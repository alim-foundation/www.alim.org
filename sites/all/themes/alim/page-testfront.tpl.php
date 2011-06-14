<?php
global $base_url;
global $theme_path;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <?php print $head ?>
	
    <title><?php print $head_title ?></title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
    <?php print $styles ?>
	
	    <!--[if lt IE 7]>
      <?php print phptemplate_get_ie_styles(); ?>
    <![endif]-->
			     <!--[if lte IE 6]>
	    <style type='text/css'>
		.beta_tag
		{
		 background:url(<?php print $base_url."/".$theme_path;?>/images/beta.png) top left no-repeat;
		 height:61px;
		 width:62px;
		 position:absolute;
		 left:0px;
		 top:0px;
		 z-index:10;
		 text-align:left;
		}
		.beta_tag1
		{
		 background:url(<?php print $base_url."/".$theme_path;?>/images/beta.png) top left no-repeat;
		 height:61px;
		 width:62px;
		 position:absolute;
		 left:0px;
		 top:0px;
		  z-index:10;
		}
		
		</style>
	   <![endif]-->
		
    <?php print $scripts ?>
	<script type="text/javascript" src="<?php print $base_url."/".$theme_path;?>/hoverjq.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php print $base_url."/".$theme_path;?>/splash.css" />
<script type="text/javascript" src="<?php print $base_url."/".$theme_path;?>/crawler.js"></script>
</head>

<body>
<div class="beta_tag1"></div>
<div id="outer_div" align="center"><!--- outer_div --->

	<div id="main_div"><!--- main_div --->
	

						
		    <div id="head_div">
			
			  <div id="top_menu2" align="center">
                  <div id="top_menu_left"></div>
			      <div id="top_menu_middle2"><span class="read_more" ><a href="<?php print $base_url?>/library/quran/surah/arabic/1/ARB"  >Enter the Site &raquo;</a></span></div>
			      <div id="top_menu_right"></div>
	           </div>
			   
				<div id="logo" align="left"><img src="<?php print $base_url."/".$theme_path;?>/images/alim-logo1.png" /></div>
		<!--		<div id="search" align="left"></div>
			    <div style="clear:both"></div>-->
	        </div>
			
		<div class="test_top"></div>
	<div class="test_middle" align="center">
	
			<div id="head_content">
			
			
			     
				   <div id="top_heading">
				   <?php print $splash_header; ?>
				 
					</div>
					
			
			</div>
			<div id="splash_search">
			<div style="padding:18px;" align="center">
			  <div class="splash_search_box"><?php if ($search_box): ?><div id="search-home" ><?php print $search_box ?></div><?php endif; ?></div>
			  </div>
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
				 
				 </div>
				 <div id="partners">
				    
						<div id="partner_list">
						   <div class="heading_div"><h2>Partners</h2></div>
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
					   <div class="heading_div"><h2>Twitter</h2></div>
					   <div class="spl_text">
					   	<?php print $splash_twitter; ?>					   
					   </span>
					   </div>
					</div>
				  
				  
				  </div>
			   </div>
			   <div style="clear:both"></div>
			</div>	
	
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
	 <?php print $closure ?>

</body>
</html>
