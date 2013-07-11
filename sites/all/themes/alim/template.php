<?php
// $Id: template.php,v 1.16.2.2 2009/08/10 11:32:54 goba Exp $

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
/**Default function in garland template.php */
global $user;
function phptemplate_body_class($left, $right) {
  if ($left != '' && $right != '') {
    $class = 'sidebars';
  } 
  else {
    if ($left != '') {
      $class = 'sidebar-left';
    }
    if ($right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}


function phptemplate_stylesheet_import($stylesheet, $media = 'all') {
if (strpos($stylesheet, 'misc/drupal.css') == 0) {
return theme_stylesheet_import($stylesheet, $media);
}
}


/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 * alters breadcrumb 
 */
function phptemplate_breadcrumb($breadcrumb) { 
	global $base_url;
	global $theme_path;
	 
	$links = array();
	$path = '';
	// Get URL arguments
	$arguments = explode('/', request_uri());
	
	// Remove empty values
	foreach ($arguments as $key => $value) {
		if (empty($value)) {
			unset($arguments[$key]);
		}
	}
	$q = $_GET['q'];
	$scount = substr_count($q, 'library/quran/surah/english');
	$scount2 =  substr_count($q, 'library/quran/surah/introduction');
	$scount3 =  substr_count($q, 'library/hadith');
	$scount4 =  substr_count($q, 'library/quran/duas');
	
	$arguments = array_values($arguments);
	$acount = count($arguments);
	
	$breadcrumb = drupal_get_breadcrumb(); // Get current breadcrumb
	
	$new = 0;
	if($scount > 0  ){
				
		switch ($arguments[$acount-1]) {
			case "ASD":
			$t = 'Asad Translation';
			$new = 2;
			break;
			case "MAL":
			$t = 'Malik Translation';$new = 2;
			break;
			case "PIK":
			$t = 'Pickthall Translation';$new = 2;		
			break;
			case "YAT":
			$t = 'Yusuf Ali Translation';$new = 2;		
			break;
			case "TLT":
			$t = 'Transliteration';$new = 3;		
			break;
		}
		if($new ==  1) {
			$count = count($breadcrumb);
			unset($breadcrumb[$count-1]);
			//$path =  $_GET['q'];
			
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
		
			if($new ==  2) {
			$count = count($breadcrumb);
			//unset($breadcrumb[$count-1]);
			//$path =  $_GET['q'];
			$links[] = l("Al-Qur'an Translations", $q);
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
		
			if($new ==  3) {
			$count = count($breadcrumb);
			//unset($breadcrumb[$count-1]);
			//$path =  $_GET['q'];
			$links[] = l("Al-Qur'an (Arabic)", $q);
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
	}
	if($scount2 > 0  ){				
		switch ($arguments[$acount-1]) {
			case "MAL":
			$t = 'Malik Surah Introductions';$new = 1;
			break;
			case "QSI":
			$t = 'Maududi Surah Introductions';$new = 1;		
			break;			
		}
		if($new ==  1) {
			$count = count($breadcrumb);
			//unset($breadcrumb[$count-1]);
			//$path =  $_GET['q'];
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
	}
	
$val = arg(2);
	
	if($scount3 > 0  ){
	
	   switch ($val) {
			case "SAD":
			$t = 'Abu-Dawood';$new = 1;
	    	break;
			case "SHB":
			$t = 'Sahih Al-Bukhari';$new = 1;
	    	break;
			case "AMH":
			$t = 'Al-Muwatta';$new = 1;
	    	break;
			case "HDQ":
			$t = 'Al-Qudsi';$new = 1;
	    	break;
			case "TIR":
			$t = 'Al-Tirmidhi';$new = 1;
	    	break;
			case "SHM":
			$t = 'Sahih Muslim';$new = 1;
	    	break;
			case "narrator":
			$t = 'Narrator';$new = 2;
	    	break;
			case "narrators":
			$t = 'Hadith Narrator Index';$new = 1;
	    	break;
			/*case "classification":
			$t = 'Classification';$new = 2;
	    	break;*/
			case "classifications":
			$t = 'Hadith Subject Index';$new = 2;
	    	break;
			case "subject":
			$t = 'Hadith Subject Index';$new = 3;
	    	break;
			case "fiq":
			$t = 'Fiqh-us-Sunnah';$new = 2;
	    	break;
			
		}
			
			if($new ==  1) {
			$count = count($breadcrumb);
			unset($breadcrumb[$count-1]);
			//$path =  $_GET['q'];
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
		
				if($new ==  3) {
			$count = count($breadcrumb);
			unset($breadcrumb[$count-1]);
			unset($breadcrumb[$count-2]);
			//$path =  $_GET['q'];
			//$links[] = l(drupal_ucfirst($t), $q);
			//$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
		
			if($new ==  2) {
			$count = count($breadcrumb);
			unset($breadcrumb[$count]);
			unset($breadcrumb[$count-1]);
			unset($breadcrumb[$count-2]);
		
			//$path =  $_GET['q'];
			$links[] = l(drupal_ucfirst($t), $q);
			$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
		}
		
		
		
			
	}

	if($scount4 > 0  ){
	
	
				
				switch ($val) {
					case "duas":
					$t = 'Duas from the Al-Qur\'an';$new = 2;
					break;
					}
			
					
							if($new ==  2) {
					$count = count($breadcrumb);
					unset($breadcrumb[$count]);
					unset($breadcrumb[$count-1]);
								
					//$path =  $_GET['q'];
					$links[] = l(drupal_ucfirst($t), $q);
					$breadcrumb[$count] = l(drupal_ucfirst($t), $q);
				}
				
						
					
			}
	
	
	
	$count1 = count($breadcrumb);
	//print_r($breadcrumb);
	
	 
	if (drupal_get_title()) {
		$page_title = html_entity_decode(drupal_get_title());
		if($new ==  1){
			$lastcrumb = $breadcrumb[$count1];
		}
		else
			$lastcrumb = $breadcrumb[$count1-1];
		//print_r($lastcrumb);
		$lasttit = html_entity_decode(strip_tags($lastcrumb));
		//print $count1.'mmmmmm'.$lasttit;
		if(drupal_get_title() != $lasttit ){
		//print 'mmmmmmmmm'.drupal_get_title();
			//$path1 =  $_GET['q'];
			$t = html_entity_decode(strip_tags(drupal_get_title()));
			//print $t;
			//$currcrumb = l(drupal_ucfirst($t), $q);
			//$currcrumb = "<a href='".$q."'>".drupal_ucfirst($t)."</a>";
			$currcrumb =  l(drupal_ucfirst($t),$q); //"<a href='".$q."'>".drupal_ucfirst($t)."</a>";
			//print $currcrumb;
			if($new ==  1)
				$breadcrumb[$count1+1] = $currcrumb;
			else
				$breadcrumb[$count1] = $currcrumb;
			
		}
	}
	//print_r($breadcrumb);
	
	 if(drupal_is_front_page()){
	 		unset($breadcrumb);
		 $breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Qur\'an & Hadith'), '<front>') ;
		$breadcrumb[] =  l(t('Qur\'an'), '<front>') ;
		$breadcrumb[] =  l(t('Arabic Qur\'an verse by verse'), $q) ;
		$breadcrumb[] =  $currcrumb ;

	 }
	 
	 if(arg(1)=='scholarpage')
	 {
	 	   unset($breadcrumb);
		  $breadcrumb[] =  l(t('Home'), '<front>') ;
		  $breadcrumb[] =  l(t('Our Advisers and Scholars'), 'alim/scholars') ;
		  $breadcrumb[] =  l(t('Advisers and Scholars Details'), $q) ;
	
	 }
	 	
	 if(arg(2)=='our-advisers-and-scholars') 
	 {
	 	  unset($breadcrumb);
		  $breadcrumb[] =  l(t('Home'), '<front>') ;
		  $breadcrumb[] =  l(t('Our Advisers and Scholars'), 'alim/scholars') ;
		  $breadcrumb[] =  l(t('Submit Advisers and Scholars'), $q) ;
	 }
	 
	 // User Profile , Checking the argument and set breadcrumb array directly
	 
	   if(arg(2)=='creat-group')
	 {
	    unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Create Group'), 'node/add/creat-group') ;
     			
	 }
	 if(arg(0)=='node' && arg(2)=='edit')
	 {
	    unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Edit Group'), $q) ;
     			
	 }
	  if(arg(0)=='node' && arg(2)=='delete')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Delete Group'), $q) ;
	 }
	 
	  if(arg(2)=='group-post')
	 {
	    unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Create Group Post'), 'node/add/group-post') ;
     			
	 }
	 
	 if(arg(0)=='groupdetails')
	 {
	 
	    unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Group'), 'groupdetails/'.arg(1)) ;
	 }
	 
	 
	  if(arg(1)=='163738')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Manage Groups'), 'groups/manage') ;
	 }
	 
	  if(arg(0)=='groups' && arg(1)=='users')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Manage Groups'), 'groups/manage') ;
		$breadcrumb[] =  l(t('Group Members'), 'groups/users/'.arg(2)) ;
	 }
	 
	 if(arg(0)=='searchusers')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Search Users'), 'searchusers') ;
	 }
	 
	 if(arg(0)=='searchgroups')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Search Groups'), 'searchgroups') ;
	 }
	 
	 if(arg(0)=='relationships')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('My Relationships'), 'relationships/requests') ;
	 }
	 
	 if(arg(1)=='create_admin')
	 {
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		$breadcrumb[] =  l(t('Manage Groups'), 'groups/manage') ;
		$breadcrumb[] =  l(t('Group Members'), 'groups/users/'.arg(2)) ;
		$breadcrumb[] =  l(t('Confirm Admin'),$q) ;
	 }
	 if(arg(1)=='subscribe')
	 {
	  unset($breadcrumb);
	  $breadcrumb[] =  l(t('Home'), '<front>') ;
	  $breadcrumb[] =  l(t('Profile'), 'userprofile') ;
	  $breadcrumb[] =  l(t('Join Group'),$q) ;
	 }
	 if(arg(1)=='unsubscribe')
	 {
	    unset($breadcrumb);
	  $breadcrumb[] =  l(t('Home'), '<front>') ;
	  $breadcrumb[] =  l(t('Profile'), 'userprofile') ;
	  $breadcrumb[] =  l(t('Leave Group'),$q) ;
	 }
	  if(arg(1)=='delete_admin')
	 {
	 	   unset($breadcrumb);
		  $breadcrumb[] =  l(t('Home'), '<front>') ;
		  $breadcrumb[] =  l(t('Profile'), 'userprofile') ;
		  $breadcrumb[] =  l(t('Remove Admin'),$q) ;
	 }
	 
	 if(arg(0)=='users')
	 {
	 	   unset($breadcrumb);
		  $breadcrumb[] =  l(t('Home'), '<front>') ;
		  $breadcrumb[] =  l(t('Profile'), $q) ;
	
	 }
	 
	 if(arg(0)=='user' && arg(2)=='edit')
	 {
	 	   unset($breadcrumb);
		  $breadcrumb[] =  l(t('Home'), '<front>') ;
		  $breadcrumb[] =  l(t('Edit Profile'), 'user/'.arg(1).'/edit') ;
	
	 }
    if(arg(2)=='dictionary')
	{
		unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Qur\'an & Hadith'), 'library/quran/surah/arabic/1/ARB') ;
		$breadcrumb[] =  l(t('References'), 'library/references/dictionary/a') ;
		$breadcrumb[] =  l(t('Islamic Terms Dictionary'), $q) ;
	
	}
	if(arg(1)=='163997')
	{
		unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Qur\'an & Hadith'), 'library/quran/surah/arabic/1/ARB') ;
		$breadcrumb[] =  l(t('References'), 'library/references/dictionary/a') ;
		$breadcrumb[] =  l(t('Alim Content Sources'), $q) ;
	
	}
	
   if(arg(2)=='AlQuran-tafsir')
	{
		unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Qur\'an & Hadith'), 'library/quran/surah/arabic/1/ARB') ;
		$breadcrumb[] =  l(t('AlQuran-tafsir'),'library/quran/AlQuran-tafsir/ASB/14/1') ;
		$breadcrumb[] =  l(t('Surah '.arg(4) . ' , Ayah '.arg(5)), $q) ;

	}
	if(arg(1)=='clippings')
	{
	unset($breadcrumb);
	global $user;
	$breadcrumb[] =  l(t('Home'), '<front>') ;
	$breadcrumb[] =  l(t($user->name), 'user/clippings') ;
	$breadcrumb[] =  l(t('Notebook'), 'user/clippings') ;
	}
    
	$preAlias = $_SERVER['REQUEST_URI'];
    $alias = explode("/",$preAlias);
	
	if($alias[1]=='blog')
	{
	 	unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
	    $breadcrumb[] =  l(t('Blogs'), 'blogs') ;
	    $breadcrumb[] =  l(t(drupal_get_title()), 'blog/'.$alias[2]) ;
	}

	
	if(arg(0)=='recent-group-posts')
	{
		unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
		$breadcrumb[] =  l(t('Recent Group Posts'), 'recent-group-posts') ;
	}
		if(arg(0) == 'bookmarks') {
		
		unset($breadcrumb);
		$breadcrumb[] =  l(t('Home'), '<front>') ;
	    $breadcrumb[] =  l(t('Bookmarks'), 'bookmarks/mine') ;
		
		}
	
   	 if(arg(0)=='relationships')
	{
	alim_removetab('All',  $vars);
	}
	
	// Alter the breadcrumb values.
	
	if (!empty($breadcrumb)) {
		$c = count($breadcrumb);$i=0;
		$imageurl = "<span class='seperator'>&nbsp;</span>";
		$b = '<div class="breadcrumb"><ul>';
		foreach($breadcrumb as $single){
			if($i == 0)
				$b.="<li class='first' >".html_entity_decode($single)."</li>";
			else
				$b.="<li>".$imageurl.html_entity_decode($single)."</li>";
			$i++;
		}
		$b.='</ul></div>';
		return $b;
		//return '<div class="breadcrumb">'. implode( $imageurl , $breadcrumb) .'</div>';
	}
}
global $base_url;
global $theme_path;

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function phptemplate_preprocess_page(&$vars) {
  $vars['tabs2'] = menu_secondary_local_tasks();

  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }

   // Construct page title
  if (drupal_get_title()) {
    $head_title = array(strip_tags(drupal_get_title()), variable_get('site_name', 'Drupal'));
  }
  else {
    $head_title = array(variable_get('site_name', 'Drupal'));
    if (variable_get('site_slogan', '')) {
      $head_title[] = variable_get('site_slogan', '');
    }
  }
   $crumb = drupal_get_breadcrumb();
    $c = count($crumb);	


   if(strip_tags($crumb[3])=="Hadith")  {    unset($crumb[3]);   }
   
   if(strip_tags($crumb[2])=="Hadith")   {
     
	 $val = arg(2);
	 switch ($val) {
		case "SAD" :
		$a[$c-1] = "Abu-Dawood";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "AMH" :
		$a[$c-1] = "Al-Muwatta";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "HDQ" :
		$a[$c-1] = "Al-Qudsi";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "TIR" :
		$a[$c-1] = "Al-Tirmidhi";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "fiq" :
		$a[$c-1] = "Fiqh-us-Sunnah";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "SHB" :
		$a[$c-1] = "Sahih Al-Bukhari";
		$crumb=array_merge($crumb,$a);
		break;
		
		case "SHM" :
		$a[$c-1] = "Sahih Muslim";
		$crumb=array_merge($crumb,$a);
		break;		
		
		}

   }
   
   if(arg(3)=='english')   {
     
	 $val = arg(5);
	 switch ($val) {
	  case "TLT" : 
	  $a[$c-1] = "Transliteration";
	  $crumb=array_merge($crumb,$a);
	  break;
		
	 }
	  switch ($val) {
	  case "ASD" : 
	  $a[$c-1] = "Asad Translation";
	  $crumb=array_merge($crumb,$a);
	  break;
		
	 }	 
	 	  switch ($val) {
	  case "MAL" : 
	  $a[$c-1] = "Malik Translation";
	  $crumb=array_merge($crumb,$a);
	  break;
		
	 }	 
	  switch ($val) {
	  case "PIK" : 
	  $a[$c-1] = "Pickthall Translation";
	  $crumb=array_merge($crumb,$a);
	  break;
		
	 }	 
	 	  switch ($val) {
	  case "YAT" : 
	  $a[$c-1] = "Yusuf Ali Translation";
	  $crumb=array_merge($crumb,$a);
	  break;		
	 }
	 
	}	
	   
   if(arg(3)=='introduction')   {
     
	 $val = arg(5);
	 switch ($val) {
	  case "MAL" : 
	  $a[$c-1] = "Malik Surah Introductions";
	  $crumb=array_merge($crumb,$a);
	  break;
		
     }
	 
	 switch ($val) {
	  case "QSI" : 
	  $a[$c-1] = "Maududi Surah Introductions";
	  $crumb=array_merge($crumb,$a);
	  break;
		
     }
	 
	}
   
   if(strip_tags($crumb[$c-1])=="Hadith Narrator Index")   {     unset($crumb[$c-1]);   }   
   if(arg(2)=='subject' && arg(3)!='ayah')   {     unset($crumb[$c-1]);   }
    if(arg(2)=='duas' && arg(3)=='content')   {     unset($crumb[$c-1]);   }   
    if(strip_tags($crumb[$c-1])=="Fiqh-us-Sunnah")   {     unset($crumb[$c-1]);   }   
   if(arg(2)=='islamposters' && arg(3)=='content')   {    // unset($crumb[$c-1]);
      }   
   if(arg(2)=='narrator')   {      unset($crumb[$c-1]);   }   
    if(arg(2)=='narrators')   {      unset($crumb[$c-1]);   }   
   if(arg(2)=='khalifa' && arg(3)=='content')   {     unset($crumb[$c-1]);   }   
   if(arg(2)=='companion' && arg(3)=='content')   {     unset($crumb[$c-1]);   }  
    if(arg(1)=='163607')   {     unset($crumb[$c-1]);   }
    if($c > 1 ){  	 unset($crumb[0]);	 }
	 $crumblast = strip_tags($crumb[$c-1]);
	 if($crumblast != '' ){
		 if(@substr_count($head_title,$crumblast) > 0   ){
	 		unset($crumb[$c-1]);
	 	}
	}
	
    $crumb = array_reverse($crumb);   
   
 if (drupal_get_title()) {
 	//unset($crumb[$c-1]);
 	$newhead_tit = strip_tags(implode(' | ', $crumb ));
	if(count($head_title)>1)	{
 	$vars['head_title']        = $head_title[0].' | '.$head_title[1];
	}	else	{
	 $vars['head_title']        = $newhead_tit.' | '.$head_title[0];
	}
 }
 else{
 		$newhead_tit = strip_tags(implode(' | ', $crumb ));	
		if(count($head_title)>1)		{
		$vars['head_title']        = $head_title[0].' | '.$newhead_tit.' | '.$head_title[1];
		}		else		{
		 $vars['head_title']        = $newhead_tit.' | '.$head_title[0];
		}
	} 
      if(arg(1)=='163647')	   {		 $vars['head_title'] = 'Widgets | Alim.org';    }	   
	if(arg(0)=='recentcomments')   {  $vars['head_title'] = 'Recent Comments | Alim.org';    }   
     if(arg(1)=='163664')   {     $vars['head_title'] = 'Donate| Alim.org';   }
     if(arg(1)=='163663')   {    $vars['head_title'] = 'Donate | Alim.org';    }   
   	 if(arg(1)=='scholarpage')	 {
	 			  $vars['head_title'] = 'Advisers and Scholars Details | Our Advisers and Scholars | Alim.org';	
	 }	 
   	 if(arg(2)=='our-advisers-and-scholars') 	 {	 	  
		  $vars['head_title'] = 'Submit Advisers and Scholars | Our Advisers and Scholars | Alim.org';
	 }
	 if(arg(2)=='our-advisers-and-scholars') 	 { 
	   unset($vars['title']);
	   //drupal_set_title('Submit Advisers and Scholars')
	   $vars['title'] = 'Submit Advisers and Scholars';
	 }
   # User Profile, alter the title directly by cheking each page URl
   
	 if(arg(0)=='userprofile')	 {		$vars['head_title'] = 'Profile | Alim.org';  }	 
	 if(arg(0)=='node' && arg(2)=='edit')	 {	    unset($breadcrumb);		$vars['head_title'] = 'Edit Group | Profile | Alim.org'; 	 }	 
	 if(arg(0)=='node' && arg(2)=='delete')	 {
	    unset($breadcrumb);
		$vars['head_title'] = 'Delete Group | Profile | Alim.org'; 
	 }	    
    if(arg(0)=='searchusers')	 {	 	 $vars['head_title'] = 'Search Users | Profile | Alim.org';	 }	
	if(arg(0)=='searchgroups'){	 	 $vars['head_title'] = 'Search Groups | Profile | Alim.org';	 }	 
	if(arg(0)=='relationships'){	 	 $vars['head_title'] = 'My Relationships | Profile | Alim.org';	 }	 
	if(arg(1)=='create_admin')	 {	 	$vars['head_title'] = 'Confirm Admin | Group Members | Manage Groups | Profile | Alim.org';	 }   
    if(arg(1)=='subscribe')	 {	   $vars['head_title'] = 'Join Group | Profile | Alim.org';	 }	
	if(arg(1)=='unsubscribe')	 {	 	$vars['head_title'] = 'Leave Group | Profile | Alim.org';	 }
	if(arg(1)=='delete_admin')	 {	  $vars['head_title'] = 'Remove Admin | Profile | Alim.org';	 }	 
	if(arg(1)=='scholarpage')	 {	  $vars['head_title'] = 'Advisers and Scholars Details | Our Advisers and Scholars | Alim.org';	 }   
    if(arg(2)=='dictionary')	{		$vars['head_title'] = 'Islamic Terms Dictionary | References | Qur\'an & Hadith | Alim.org';	} 
	if(arg(0)=='recent-group-posts'){ $vars['head_title'] = 'Recent Group Posts | Alim.org'; } 
	if(arg(1)=='all-recent-tags') { $vars['head_title'] = 'Recent Tags | Alim.org'; }
	if(arg(1)=='clippings')	 {	 	 $vars['head_title'] = 'Home | My Notebook | Alim.org';	 }	
	if(arg(0) == 'bookmarks') {  $vars['head_title'] = 'Home | Bookmarks | Alim.org';	 }	
  
   if(arg(0)=='relationships')	{	alim_removetab('All',  $vars);}	
	 if(arg(0)=='user' && arg(2)=='edit')
	 {
	 	$vars['head_title'] = 'Edit Profile | Alim.org';
		alim_removetab('View',  $vars);
	    alim_removetab('Edit',  $vars);
		 alim_removetab('Notifications',  $vars);
		alim_removetab('3rd party identities',  $vars);
	
	 }
	global $user;
	$arr_role =  $user->roles;				
	if(in_array("Developer", $arr_role)==FALSE && in_array("System Administrator", $arr_role)==FALSE)	{
	 if(arg(0)=='node' && arg(2)=='edit')
	 {
	 	//alim_removetab('View',  $vars);
	    //alim_removetab('Edit',  $vars);
	    alim_removetab('Broadcast',  $vars);
	 }
    }
	 	
	 if(arg(2)=='our-advisers-and-scholars') 	 {	 	  
		  $vars['head_title'] = 'Submit Advisers and Scholars | Our Advisers and Scholars | Alim.org';
	 }
	 if(arg(1)==163997)
	 {
	 
	$vars['head_title'] = 'Alim Content Sources | References| Qur\'an & Hadith|Alim.org';

	 }
	 
if(arg(2)=='AlQuran-tafsir')
	 {
	 
	$vars['head_title'] = 'AlQuran-tafsir | Qur\'an & Hadith | Alim.org';

	 }
	 
	 // Remove the tabs from pages.
	 	
	alim_removetab('Your votes',  $vars);
	alim_removetab('Twitter',  $vars);
	alim_removetab('Bookmarks', $vars);	
	alim_removetab('Preset Bookmarks', $vars);	
   		    jquery_ui_add(array('ui.draggable', 'ui.dialog'));
			jquery_ui_add(array('ui.draggable'));
			drupal_add_js(drupal_get_path('module', 'alim_searchtags') .'/mybookmarkmenu.js');
			  if(arg(1)=='biography') {
				drupal_add_js(drupal_get_path('theme', 'alim') . '/scroll_menu/c_config.js');
				drupal_add_js(drupal_get_path('theme', 'alim') . '/scroll_menu/c_smartmenus.js');
				drupal_add_js(drupal_get_path('theme', 'alim') . '/scroll_menu/c_addon_scrolling.js');
			}
			
		 	drupal_add_js(drupal_get_path('theme', 'alim') . '/crawler.js');
			drupal_add_js(drupal_get_path('theme', 'alim') . '/galleryview/jquery.timers-1.2.js');		
			drupal_add_js(drupal_get_path('theme', 'alim') . '/galleryview/jquery.easing.1.3.js');
			drupal_add_js(drupal_get_path('theme', 'alim') . '/dhtml_menu/animatedcollapse.js');
			drupal_add_js(drupal_get_path('theme', 'alim') . '/hoverjq.js');
			$vars['scripts'] = drupal_get_js();	
			drupal_add_css(drupal_get_path('theme', 'alim') . '/galleryview/galleryview.css');
			drupal_add_css(drupal_get_path('theme', 'alim') . '/splash.css');
		
			$vars['styles'] = drupal_get_css();			
			
	alim_removetab('Voting details', $vars);
	if (arg(0) == 'bookmarks') {
      $vars['tabs'] = str_replace('Add item</span></a>', 'Add folder</span></a>', $vars['tabs']);   
	  $vars['tabs'] = str_replace('List items</span></a>', 'Manage Bookmarks</span></a>', $vars['tabs']);  
    }
	//alim_removetab('Voting details', $vars);
	//alim_removetab('Search Lucene', $vars);
		//if(arg(0) == 'search' )
			//alim_removetab('Content', $vars);			
			$vars['bookmark'] = bookmark();
	
}

/**
 * Add a "Comments" heading above comments except on forum pages.
 */
function garland_preprocess_comment_wrapper(&$vars) {
  if ($vars['content'] && $vars['node']->type != 'forum') {
    $vars['content'] = '<h2 class="comments">'. t('Comments') .'</h2>'.  $vars['content'];
  }
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}

function phptemplate_comment_submitted($comment) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

function phptemplate_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
 * Generates IE CSS links for LTR and RTL languages.
 * default garland template.php function prints some ie fixes 
 */
function phptemplate_get_ie_styles() {
  global $language;

  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="'. base_path() . path_to_theme() .'/fix-ie.css" />';
  if ($language->direction == LANGUAGE_RTL) {
    $iecss .= '<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/fix-ie-rtl.css";</style>';
  }

  return $iecss;
}
/**theme_links  function altered in alim_links */
function alim_links($links, $attributes = array('class' => 'links') ) {

  global $base_url;
  global $theme_path;
  global $language;
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language->language)) {
        $class .= ' active';
      }
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
		if($attributes['class'] == 'left-menu' ){
		  $output .= '<img src="'.$base_url.'/'.$theme_path.'/images/menupointer.jpg" alt="arrow"  align="absmiddle" class="arrow" /> '.l($link['title'], $link['href'], $link);
		  }
		else
		{
        $output .= l($link['title'], $link['href'], $link);
		}
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}
/**
 * Alter the menu tab.
 */
function Submenu() {

$menu_theme = menu_navigation_links("primary-links",1);
#print_r($menu_theme);

$menu .= "<ul>";
$i=1;
$flag =0;
foreach ($menu_theme as $value) {
$class = "";
 if (isset($value['title']) && ($value['href'] == $_GET['q'] || ($value['href'] == '<front>' && drupal_is_front_page()) )   ) {
        $class .= ' active';
		$flag = 1;
      }
	  if($i == 1  )
	  {
	 
		 if((arg(1) == 'quran' && arg(2) != 'subject') || arg(1) == 132474 )
		 {
		 	$class = ' activefirst';
		 }
	  } $i++;
  $menu .= "<li class='".$class."' >";
  $menu .= l($value['title'],$value['href']);
  $menu .= "</li>";
 
}

$menu .= "</ul>";
return $menu;
}

/**
 * Alter the menu tab. Adding the attribute "id" to each menu tab items for getting javascript drop down menu.
 * Primary link (Primary Menu) is alterd in such a way that url of sub-menu changes by "Previous" and "Next" button clicks on eachs ections.
 */
function Submenu_all() {

$menu_theme = submenu_other("primary-links",1);
#print_r($menu_theme);

$menu .= "<div class='sample1'><div class='horz_menu'><ul>";
$i=1;
$flag =0;
foreach ($menu_theme as $value) {
$new_title = str_replace("'","",$value['title']);
$class = str_replace(" ","-",$new_title)." ";
$rel = "";
$arr_attr = array();
if($value['title']=='Qur\'an')
{
  	//$rel = 'anylinkmenu1';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	$arr_attr = array('attributes'=>array('id'=>'menu_quran'));
}
else if($value['title']=='Hadith')
{
  	//$rel = 'anylinkmenu2';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	
	$arr_attr = array('attributes'=>array('id'=>'menu_hadith'));
}
else if($value['title']=='Community')
{
  	//$rel = 'anylinkmenu3';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	
	$arr_attr = array('attributes'=>array('id'=>'menu_indexes'));
}
else if($value['title']=='History')
{
  	//$rel = 'anylinkmenu4';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	
	$arr_attr = array('attributes'=>array('id'=>'menu_biography'));
}
else if($value['title']=='About Islam')
{
  	//$rel = 'anylinkmenu5';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	
	
	$arr_attr = array('attributes'=>array('id'=>'menu_islam'));
}
else if($value['title']=='References')
{
  	//$rel = 'anylinkmenu6';
	//$arr_attr = array('attributes'=>array('class' => 'menuanchorclass','rel' => $rel));
	
	$arr_attr = array('attributes'=>array('id'=>'menu_references'));
}

 if (isset($value['title']) && ($value['href'] == $_GET['q'] || ($value['href'] == '<front>' && drupal_is_front_page()) ) ) {
	   if(arg(2) != 'subject')
	   {
        $class .= ' active';
		$flag = 1;
	   }
      }
	  if($i == 1  )
	  {
	 
		 if(arg(1) == 'quran'  || arg(1) == 132474 )
		 {
		 	$class .= ' activefirst';
		
		 }
	  } 
	  
	  if($value['title']=='Hadith' && arg(1)=='hadith')
	  {
	  	  $class .= ' active';
	  }
	  
	    if(($value['title']=='History' && arg(1)=='biography') || ($value['title']=='History' && arg(1)=='history'))
	  {
	  	  $class .= ' active';
	  }
	  
	   if($value['title']=='About Islam' && arg(1)=='islam')
	  {
	  	  $class .= ' active';
	  }
	  
	   if(($value['title']=='References' && arg(1)=='references') || ($value['title']=='References' && arg(1)=='163997'))
	  {
	  	  $class .= ' active';
	  }
	   
	  if(($value['title']=='Community' && arg(0)=='searchgroups') || ($value['title']=='Community' && arg(0)=='searchusers'))
	  {
	  	$class .= ' active';
	  }
	  
   $i++;
  $menu .= "<li class='".$class."' >";
  $menu .= l($value['title'],$value['href'],$arr_attr);
  $menu .= "</li>";
 
}

$menu .= "</ul></div></div>";
return $menu;
}

function submenu_other($menu_name, $level = 0) {
  // Don't even bother querying the menu table if no menu is specified.
  if (empty($menu_name)) {
    return array();
  }

  // Get the menu hierarchy for the current page.
  //$tree = menu_tree_page_data($menu_name);
  
   $tree = menu_tree_all_data($menu_name);
 

  // Go down the active trail until the right level is reached.
  while ($level-- > 0 && $tree) {
    // Loop through the current level's items until we find one that is in trail.
    while ($item = array_shift($tree)) {
     // if ($item['link']['in_active_trail']) {
        // If the item is in the active trail, we continue in the subtree.
        $tree = empty($item['below']) ? array() : $item['below'];
        break;
      //}
    }
  }

  // Create a single level of links.
  $links = array();
  foreach ($tree as $item) {
    if (!$item['link']['hidden']) {
      $class = '';
      $l = $item['link']['localized_options'];
      $l['href'] = $item['link']['href'];
      $l['title'] = $item['link']['title'];
      if ($item['link']['in_active_trail']) {
        $class = ' active-trail';
      }
      // Keyed with the unique mlid to generate classes in theme_links().
      $links['menu-'. $item['link']['mlid'] . $class] = $l;
    }
  }
  return $links;
}


function getMy_Title($menu_name, $level = 0) {
  // Don't even bother querying the menu table if no menu is specified.
  if (empty($menu_name)) {
    return array();
  }

  // Get the menu hierarchy for the current page.
  //$tree = menu_tree_page_data($menu_name);
  
   $tree = menu_tree_all_data($menu_name);
 

  // Go down the active trail until the right level is reached.
  while ($level-- > 0 && $tree) {
    // Loop through the current level's items until we find one that is in trail.
    while ($item = array_shift($tree)) {
      if ($item['link']['in_active_trail']) {
        // If the item is in the active trail, we continue in the subtree.
        $tree = empty($item['below']) ? array() : $item['below'];
        break;
      }
    }
  }

  // Create a single level of links.
  $links = array();
  $my_arr = array();
  foreach ($tree as $item) {
    if (!$item['link']['hidden']) {
      $class = '';
      $l = $item['link']['localized_options'];
      $l['href'] = $item['link']['href'];
      $l['title'] = $item['link']['title'];
      if ($item['link']['in_active_trail']) {
        $class = ' active-trail';
      }
      // Keyed with the unique mlid to generate classes in theme_links().
      //$links['menu-'. $item['link']['mlid'] . $class] = $l;
	  //$links['title'] = $l;
	    $my_arr[] =  $l['title'];
	
    }
  }
  return $my_arr;
}

/**
 * Adding pointer image to left menu items.
 */
function Submenu_left() {

  global $base_url;
  global $theme_path;

$menu_theme = menu_navigation_links("primary-links",2);
$menu .= "<ul>";

foreach ($menu_theme as $value) {
  $menu .= "<li>";
  $menu .= '<img src="'.$base_url.'/'.$theme_path.'/images/menupointer.jpg" alt="arrow"  align="absmiddle" class="arrow" /> '.l($value['title'],$value['href']);
   $menu .= "</li>";
}

$menu .= "</ul>";
return $menu;
}
//theme_quicktabs_tabs function altered in this function to add span in tabs for css styling
function alim_quicktabs_tabs($quicktabs, $active_tab = 'none') {
  $output = '';
  $tabs_count = count($quicktabs['tabs']);
  if ($tabs_count <= 0) {
    return $output;
  }

  $index = 1;
  $output .= '<ul class="quicktabs_tabs quicktabs-style-'. drupal_strtolower($quicktabs['style']) .'">';
  foreach ($quicktabs['tabs'] as $tabkey => $tab) {
    $class = 'qtab-'. $tabkey;
    // Add first, last and active classes to the list of tabs to help out themers.
    $class .= ($tabkey == $active_tab ? ' active' : '');
    $class .= ($index == 1 ? ' first' : '');
    $class .= ($index == $tabs_count ? ' last': '');
    $attributes_li = drupal_attributes(array('class' => $class));
    $options = _quicktabs_construct_link_options($quicktabs, $tabkey);
    // Support for translatable tab titles with i18nstrings.module.
    if (module_exists('i18nstrings')) {
      $tab['title'] = tt("quicktabs:tab:$quicktabs[qtid]--$tabkey:title", $tab['title']);
    }
    $output .= '<li'. $attributes_li .'><span ><span ><span >'. l($tab['title'], $_GET['q'], $options) .'</span></span></span></li>';
    $index++;
  }
  $output .= '</ul>';
  return $output;
}

function find_comment_id($cidnum){
$nodeid_com="";
/*$res=db_query('SELECT nid FROM {comments} WHERE cid =%d', $cid);
$res = db_rewrite_sql(db_query("SELECT nid FROM {comments} WHERE cid = '%d'", $cid));
*/
//$res  =  db_query(db_rewrite_sql("SELECT c.cid,c.nid FROM {comments} c WHERE cid = %d", 'c','cid'), $cidnum);
/*
$res  =  db_query("SELECT cid,nid,timestamp FROM comments  WHERE cid = $cidnum");


$row = db_fetch_array($res);
$nodeid_com=$row['nid'];*/

$result=db_query("SELECT nid FROM {comments} where cid=%d",$cidnum);
while ($row = db_fetch_array($result)) {

$total=$row['nid'];

}


return $cidnum;
}

/***************SEARCH ***************/
/**
 * Process variables for search-results.tpl.php.
 *
 * The $variables array contains the following arguments:
 * - $results
 * - $type
 *
 * @see search-results.tpl.php
 * default preprocess search function  is altered for adding  drupal collapsible fieldset to advanced search 
 */
function alim_preprocess_search_results(&$variables) {
$keys = search_get_keys();
 $tot_res_cnt = 0;
	if($variables['type'] == 'alimsearch' ){ // only for advanced search groups the search results in to fieldsets 	
		$variables['search_results'] = '';
		$crumb = drupal_get_breadcrumb();   
		$c = count($crumb);
		unset($crumb[$c-1]);
		drupal_set_breadcrumb($crumb);
		drupal_set_title('Search Results');
		foreach($variables['results'] as $key => $val ){
		     
				$value = "";$ct ='';
				$value .= $val['pagerval'];
				if($val['empty'])
				$value .= $val['empty'];
				foreach ($val['results'] as $result) {
					$value .= theme('search_result', $result, $variables['type']);
				}
				  $tot_res_cnt += $val['tot_res_cnt'];
				$ct .= '<div><a href="#search-'.$key.'" >'.$val['search_ind'].' </a></div>';
				$variables['search_results'] .= theme('fieldset', // collpasible group of results in advanced search 
													array(
													'#title' => $val['fullname'],
													'#collapsible' => TRUE,
													'#collapsed' => FALSE,
													'#value' => $value,
													'#attributes' => array('id' => 'search-'.$key)
													)
													);
				$variables['counter_left'] .= 	 $ct ;
		
		}
		// Provide alternate search results template.
		$variables['template_files'][] = 'search-results-'. $variables['type'];	// adding template sugessions
	
	}else{ // for simple search 
		$variables['search_results'] = '';
		$crumb = drupal_get_breadcrumb();   
		$c = count($crumb);
		unset($crumb[$c-1]);
		drupal_set_breadcrumb($crumb);
		drupal_set_title('Search Results');
		// $variables['search_results'] = '';
		foreach ($variables['results'] as $result) {
			$variables['search_results'] .= theme('search_result', $result, $variables['type']);
		}
		if(arg(0) == 'alimsearch' ){
			$variables['pager'] = theme('pager', NULL, 10, 0);
		}
		else{
			$variables['pager'] = theme('pager', NULL, 100, 0);
		}
		// Provide alternate search results template.
		$variables['template_files'][] = 'search-results-'. $variables['type']; // adding template sugessions
		global $pager_total_items;
        $tot_res_cnt = $pager_total_items[0]; 
	} 
	
   $script = "var search_key_value = '".$keys." => result count - ".substr($tot_res_cnt,0,30)."'";
   drupal_add_js($script, 'inline', 'footer');
 
}


function find_show_hide($cid){
 
  $result = db_query("SELECT reason,nid FROM {comments_hide} where cid=%d ",$cid);
 while($row = db_fetch_array($result)){
		$reason1=$row['reason']; 
      
}
if($reason1!=""){
  return $reason1;
}
else
return "hide";

 }


/**
 * Process variables for search-result.tpl.php.
 *
 * The $variables array contains the following arguments:
 * - $result
 * - $type
 *
 * @see search-result.tpl.php
 * added search-results-node-nodetype.tpl.php to alter the search result links in each content types 
 * 
 */
function alim_preprocess_search_result(&$variables) {
  $result = $variables['result'];
  $variables['url'] = check_url($result['link']);
  $variables['title'] = check_plain($result['title']);

  $info = array();
  if (!empty($result['type'])) {
    $info['type'] = check_plain($result['type']);
  }
  if (!empty($result['user'])) {
    $info['user'] = $result['user'];
  }
  if (!empty($result['date'])) {
    $info['date'] = format_date($result['date'], 'small');
  }
  if (isset($result['extra']) && is_array($result['extra'])) {
    $info = array_merge($info, $result['extra']);
  }
  /***********************************************/
  if(isset($result['node'])){
      $vnode = $result['node'];
	  $node_type = $vnode->type;
	  if($node_type != "" ){
	  	$node_type = '-'.$node_type;
	  }
	  $variables['node_result'] = $vnode;
	}
  /*******************************************************/
  // Check for existence. User search does not include snippets.
  $variables['snippet'] = isset($result['snippet']) ? $result['snippet'] : '';
  // Provide separated and grouped meta information..
  $variables['info_split'] = $info;
  $variables['info'] = implode(' - ', $info);
  // Provide alternate search result template.
  if($variables['type'] == 'alimsearch' ){
  	$variables['template_files'][] = 'search-result-'.'node' .$node_type;
  }else{
  	$variables['template_files'][] = 'search-result-'.$variables['type'] .$node_type;// adding new template sugessions
  }
  //print_r($variables['template_files']);
}

function alim_comment_view($comment, $node, $links = array(), $visible = TRUE) {
  static $first_new = TRUE;

  $output = '';
  $comment->new = node_mark($comment->nid, $comment->timestamp);
  if ($first_new && $comment->new != MARK_READ) {
    // Assign the anchor only for the first new comment. This avoids duplicate
    // id attributes on a page.
    $first_new = FALSE;
    $output .= "<a id=\"new\"></a>\n";
  }

  $output .= "<a id=\"comment-$comment->cid\"></a>\n";

  // Switch to folded/unfolded view of the comment
  if ($visible) {
    $comment->comment = check_markup($comment->comment, $comment->format, FALSE);

    // Comment API hook
    comment_invoke_comment($comment, 'view');

    $output .= theme('comment', $comment, $node, $links);
  }
  else {
    $output .= theme('comment_folded', $comment);
  }

  return $output;
}

/**theme_pager_link altered for pager **/
function alim_pager_link($text, $page_new, $element, $parameters = array(), $attributes = array()) {
	//if(arg(0) == 'alimsearch' || arg(0) == 'search' ) changed
	//if(arg(0) == 'alimsearch' || (arg(0) == 'search' && arg(1) == 'node'  && arg(2) != ''  ))
		  if(arg(0) == 'single' && arg(1) == 'view' )
				$attributes['class'] = 'popups';
  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query[] = drupal_query_string_encode($parameters, array());
  }
  $querystring = pager_get_querystring();
  if ($querystring != '') {
    $query[] = $querystring;
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« first') => t('Go to first page'),
        t('‹ previous') => t('Go to previous page'),
        t('next ›') => t('Go to next page'),
        t('last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    else if (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  return l($text, $_GET['q'], array('attributes' => $attributes, 'query' => count($query) ? implode('&', $query) : NULL));
}
/***Function to remove view , edit etc like tabs generated by modules in drupal**/
function alim_removetab($label, &$vars) {
  $tabs = explode("\n", $vars['tabs']);
  $vars['tabs'] = '';

  foreach ($tabs as $tab) {
    if (strpos($tab, '>' . $label . '<') === FALSE) {
      $vars['tabs'] .= $tab . "\n";
    }
  }
}

/**
* Get the count of search results from global pager variable
*/
function search_count_show() {
  global $pager_page_array, $pager_total_items, $pager_total;
  
// if(arg(0) ==  'search')
  	$items_per_page = 10;
  //else
  	//$items_per_page = 100;
	//print_r($pager_total);
if ($pager_total[0] == 1) {
  	$res =  'Showing <b>'.$pager_total_items[0].'</b> results';
    
} else {
  $start = 1 + ($pager_page_array[0] * $items_per_page);
  $end = (1 + $pager_page_array[0]) * $items_per_page;
  if ($end > $pager_total_items[0]) $end = $pager_total_items[0];
  $res = 'Showing '.$start.'-'.$end.' of <b>'.$pager_total_items[0].'</b> results';
   
}



   /////////////////////
  
  	/*$keys = search_get_keys();
	$highlight_keys = explode(' ' , $keys );
	$high_js = '';
	foreach($highlight_keys as $ks){
		if($ks !='' )
			$high_js.='$(".search-snippet ,.search-snippet p , .search-snippet div").highlight("'.$ks.'");';
	}*/
	
	 	//drupal_add_js(drupal_get_path('module', 'alimsearch') .'/jquery.highlight-3.js', 'module');
		//drupal_add_js($high_js, 'inline', 'footer');
  
  

  
  
  //return 'Showing '.$pager_total_items.' of '.$pager_total_items[0].' results';
  return $res;
}

/*
function printdata($node1){	
	
	$qry = "SELECT count(*) FROM {comments} where pid=$node1";
	$num = db_result(db_query(db_rewrite_sql($qry)));
	//print $node1.'--'.$num.'--';
	
	
	$result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node=$row['cid']; $nodepid=$row['pid'];
		
		
		 $result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node22=$row['cid']; $nodepid=$row['pid'];
		 $viewName = 'user_node_comment_scholar';
		  print views_embed_view($viewName , $display_id = 'default',$node22);
		$subitem11 = db_query("SELECT * FROM {comments} where pid=%d",$node22);
		while($row = db_fetch_array($subitem11)){
		
		 $node1122=$row['cid'];
		  if($node1122!=" "){
			printdata($node22);
		}
		  
		  
		  }
		  }
		//  print "-----------".$nodepid."-----------";
		$subitem = db_query("SELECT * FROM {comments} where pid=%d",$node);
		while($row = db_fetch_array($subitem)){
		
		 $node11=$row['cid']; //printdata($node11);
		//print $node11."ooooooooooooooooo";
		}
		if($node11!=" "){
			printdata($node);
		}
		
	}
 }
 function printdata1($node1){	
	
	$qry = "SELECT count(*) FROM {comments} where pid=$node1";
	$num = db_result(db_query(db_rewrite_sql($qry)));
	//print $node1.'--'.$num.'--';
	
	
	$result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node=$row['cid']; $nodepid=$row['pid'];
		
		
		 $result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node22=$row['cid']; $nodepid=$row['pid'];
		 $viewName = 'user_scholar_comments';
		//print $node22.'**--';
		$qry = "SELECT count(*) FROM {comments} where pid=$node22";
	$num = db_result(db_query(db_rewrite_sql($qry)));
//print '-------------------------------------------------**'.$num.'--------------->>';
print views_embed_view($viewName , $display_id = 'default',$node22);
		 		  
		$subitem11 = db_query("SELECT * FROM {comments} where pid=%d",$node22);
		//print_r(db_fetch_array($subitem11));
		while($row = db_fetch_array($subitem11)){
		
		 $node1122=$row['cid'];
		// print $node1122;
		 
		  //print views_embed_view($viewName , $display_id = 'default', $node1122);
		  if($node1122!=" "){
			//printdata($node22);
		}
		  
		  
		  }
		  }
		//  print "-----------".$nodepid."-----------";
		$subitem = db_query("SELECT * FROM {comments} where pid=%d",$node);
		while($row = db_fetch_array($subitem)){
		
		 $node11=$row['cid']; //printdata($node11);
		//print $node11."ooooooooooooooooo";
		}
		if($node11!=" "){
			printdata1($node);
		}
		
	}
 }
*/ 
 
 /**********************Tafsir***********************************************/
 
 
 
 function printdata_tafsir($node1){	
	
	$qry = "SELECT count(*) FROM {comments} where pid=$node1";
	$num = db_result(db_query(db_rewrite_sql($qry)));
	//print $node1.'--'.$num.'--';
	
	
	$result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node=$row['cid']; $nodepid=$row['pid'];
		
		
		 $result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node22=$row['cid']; $nodepid=$row['pid'];
		 $viewName = 'user_scholar_comments';
		//print $node22.'**--';
		$qry = "SELECT count(*) FROM {comments} where pid=$node22";
	$num = db_result(db_query(db_rewrite_sql($qry)));
//print '-------------------------------------------------**'.$num.'--------------->>';

		
		
		 print views_embed_view($viewName , $display_id = 'default',$node22);
		  
		  
		$subitem11 = db_query("SELECT * FROM {comments} where pid=%d",$node22);
		while($row = db_fetch_array($subitem11)){
		
		 $node1122=$row['cid'];
		 
		  print views_embed_view($viewName , $display_id = 'default', $node1122);
		  if($node1122!=" "){
			printdata_tafsir($node22);
		}
		  
		  
		  }
		  }
		//  print "-----------".$nodepid."-----------";
		$subitem = db_query("SELECT * FROM {comments} where pid=%d",$node);
		while($row = db_fetch_array($subitem)){
		
		 $node11=$row['cid']; //printdata($node11);
	print $node11."ooooooooooooooooo";
		}
		if($node11!=" "){
			printdata_tafsir($node);
		}
		
	}
 }
 
 
 
 
 
 
 
 
 
  /*********************************************************************/
 
 
 function printparent($pid){
 
  $result = db_query("SELECT * FROM {comments} where cid=%d",$pid);
 while($row = db_fetch_array($result)){
		$nid=$row['uid']; 
}

$temp_user = user_load(array('uid' => $nid));
$name = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
print $name;
 }
 
 
 
 function downvotes($pid){
 $count=0;
  $result=db_query("SELECT * FROM {votingapi_vote} where content_id=%d and value=%d  ",$pid,-1);
 while($row = db_fetch_array($result)){
		$count=$count+1;
}

print $count;
 }
 
 


function printreason($uid,$cid){
 
  $result = db_query("SELECT * FROM {dislikereason} where comment_id=%d and user_id=%d and reason!='' and reason_description!='' ",$cid,$uid);
 while($row = db_fetch_array($result)){
		$reason1=$row['reason']; 
        $reason2=$row['reason_description']; 

}
$reason=$reason1;
print $reason;
 }
 

function printreason1($uid,$cid){
 
  $result = db_query("SELECT * FROM {dislikereason} where comment_id=%d and user_id=%d and reason!='' and reason_description!='' ",$cid,$uid);
 while($row = db_fetch_array($result)){
		$reason1=$row['reason']; 
        $reason2=$row['reason_description']; 

}
$reason=$reason2;
print $reason;
 }



function printtest($cid){
 
 $reason="testing testing".$cid;
print $reason;
 }
 
 // Styles Tabs
 function alim_menu_local_task($link, $active = FALSE) {
  return '<li '. ($active ? 'class="active" ' : '') .'>'. $link ."</li>\n";
}
function alim_menu_item_link($link) {
  if (empty($link['options'])) {
    $link['options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">' . check_plain($link['title']) . '</span>';
    $link['options']['html'] = TRUE;
  }

  if (empty($link['type'])) {
    $true = TRUE;
  }

  return l($link['title'], $link['href'], $link['options']);
}
//Prints the master head main title in each pages;
function print_masterhead(){

	if(menu_get_active_menu_name()=='secondary-links')
	{		
		$menu_theme = menu_navigation_links("secondary-links",0);
		foreach ($menu_theme as $value) {
			if (isset($value['title']) && ($value['href'] == $_GET['q']) ||($value['href'] == '<front>' && drupal_is_front_page()))
			{
				$masthead = $value['title'];		
			}		
		}
	}
	else
	{
		$menu_theme = menu_navigation_links("primary-links",0);
		$menu_theme2 = menu_navigation_links("primary-links",1);	
		foreach ($menu_theme as $value) {
			if (isset($value['title']) && ($value['href'] == $_GET['q']) ||($value['href'] == '<front>' && drupal_is_front_page()))
			{
				$masthead = l($value['title'],$value['href']);			
			}
		}
	}
	
	if($masthead=="")
	{
		$arr_bread = menu_get_active_breadcrumb();
		$masthead = $arr_bread[1];
	}
	if(arg(0)=='node' && is_numeric(arg(1)) )	{	$masthead = "";	}
	if(arg(0)=='alimsearch') { 	$masthead = "Search"; 	}
	if(arg(1)=='158036' || arg(1)=='158915') { $masthead = "Qur'an & Hadith"; }
	if(arg(0)=='news') 	{ 	$masthead = "News & Views"; 	}
	if(arg(0)=='testimonials') 	{ 	$masthead = "Testimonials"; 	}
	if(arg(1)=='164550') 	{	$masthead = "Widgets";	}
	if(arg(0)=='alimrecentcomments') 	{	$masthead = "Recent Comments";	}
	if(arg(1)=='163664')	{	$masthead = "Donate";	}
	if(arg(1)=='163663')	{	$masthead = "Donate";	}
	if(arg(1)=='scholarpage') { $masthead = 'Advisers and Scholars'; }
     if(arg(1)=='scholars') { $masthead = 'Advisers and Scholars'; }
	if(arg(2)=='our-advisers-and-scholars') { $masthead = 'Advisers and Scholars'; }
	if(arg(1)=='132481') 	{	$masthead = "Nonprofit Services";	}
	if(arg(1)=='132482') 	{	$masthead = " Books";	}
	if(arg(1)=='163674') 	{	$masthead = " Toolbar";	}
	if(arg(1)=='163647') 	{	$masthead = " Get Widgets";	}
	if(arg(1)=='163827')    {	$masthead = " Recent Comments Feed";	}
	if(arg(0)=='recent-group-posts'){ $masthead = 'Recent Group Posts'; }
	if(arg(1)=='all-recent-tags') { $masthead = 'Recent Tags'; }
	if(arg(1)=='biography' || arg(1)=='history') { $masthead = 'History'; }
	if(arg(1)=='references' ) { $masthead = 'References'; }  
	if(arg(2)=='article' ) { $masthead = 'About Islam'; }  
	# User Profile
	
	if(arg(0)=='userprofile') { $masthead = "Profile"; }
	if(arg(2)=='creat-group') { $masthead = 'Creat Group';  }
	if(arg(2)=='group-post') { $masthead = 'Creat Group Post';  }
	if(arg(0)=='groups' && arg(1)=='users') { $masthead = 'Group Members';  }
	if(arg(1)=='163738') { $masthead = 'Manage Groups'; }
	if(arg(0)=='searchusers') { $masthead = 'Search Users'; }
	if(arg(0)=='searchgroups') { $masthead = 'Search Groups'; }
	if(arg(0)=='groupdetails') { $masthead = "Group"; }
	if(arg(0)=='user' && arg(2)=='edit') { $masthead = 'Edit Profile'; }
	if(arg(0)=='relationships') { $masthead = 'My Relationships'; }
    if(arg(2)=='dictionary'){ $masthead = "Qur'an & Hadith";}
	if(arg(0) == 'bookmarks') { $masthead = "Bookmarks";}
	
	$preAlias = $_SERVER['REQUEST_URI'];
    $alias = explode("/",$preAlias);
	
	if(arg(0)=='blogs' || $alias[1]=='blog'){ $masthead = "Blogs";}
	if(arg(0)=='news' || $alias[1]=='news'){ $masthead = "News & Views";}
	
	
	return $masthead;
}
 
/**
* Modified Theme Function theme_status_message
*  render messages 
**/ 
function alim_status_messages($display = NULL) {
	$output = '';
	$allmsgs = drupal_get_messages($display);
	foreach ( $allmsgs as $type => $messages) {	
		if (count($allmsgs) > 1) {
			$output .= "<div class=\"messages $type new\">\n";
			$output .= " <ul>\n";
			foreach ($messages as $message) {
				modify_message($message);
				$output .= '  <li>'. $message ."</li>\n";
			}
			$output .= " </ul>\n";
			$output .= "</div>\n";
		}
		else {
			$output .= "<div class=\"messages $type new\">\n";
			modify_message($messages[0]);
			$output .= $messages[0];
			$output .= "</div>\n";
			if($messages[0] == '' )
				return '';
		
		}	
	}
	return $output;
}

/**
* Modify/hide a message from user:
*  * @param string $message
*/
function modify_message(&$message) {
	//Add here whatever you need to recognize and modify this message:
	//print '....'.$$message;
	$pattern = '/^Clippings(.*)has been created\.$/';
	preg_match($pattern, $message, $matches); // checked message using regular expression
	//print_r($matches);
	if ($matches[0]) 
		$message = 'Clipping'.$matches[1].'has been created'.'. Visit My <b>'.l('Note Book' , 'user/clippings' ).'</b>.';
	
	$pattern = '/^The content access permissions need to be rebuilt(.*)$/';
	preg_match($pattern, $message, $matches);
	if ($matches[0]) 
		$message = '';
 
} 
/**
* Modifyied Theme Function theme_node_form
*  render Node form  
**/ 
function alim_node_form($form) {
global $is_admin;
global $user;
$set1 =0;
$arr_role = $user->roles;

foreach($arr_role as $val)
{

  if((trim($val) == 'Content Administrator') || ($val == 'System Administrator'))
  {
    $set1 = 1;
  }

}



$type = $form['type']['#value'];
if($is_admin)
	$cls = "admin-$type";
else
	$cls = "user-form-$type";
	
if($type == 'our_advisers_and_scholars')
{
 if($set1!=1)
 {
   $script = "$('.form-checkboxes').parent().hide()";
   drupal_add_js($script, 'inline', 'footer');
 }
}
else if($type == 'clippings' ){
	//print 'ok...';
	$script = "$(document).bind('popups_open_path_done', function() {
					  $('.form-item[id^='taxonomy-other-'] label').remove();
					  $('.form-item[id^='edit-taxonomy-'] :input').change(function(){
						var id = '#taxonomy-other-' + $(this).attr('id').substr('edit-taxonomy-'.length) + '-wrapper';
						if ($(this).val() == 'taxonomy_other') {
						  $(id).show();
						  $(id + ' :input').focus();
						} else {
						  $(id + ' :input').val('');
						  $(id).hide();
						}
					  }).trigger('change');
					  
			
			});";
			drupal_add_js($scr1, 'inline', 'footer');
}
  $output = "\n<div class=\"node-form $cls\">\n";

  // Admin form fields and submit buttons must be rendered first, because
  // they need to go to the bottom of the form, and so should not be part of
  // the catch-all call to drupal_render().
  $admin = '';
  if (isset($form['author'])) {
    $admin .= "    <div class=\"authored\">\n";
    $admin .= drupal_render($form['author']);
    $admin .= "    </div>\n";
  }
  if (isset($form['options'])) {
    $admin .= "    <div class=\"options\">\n";
    $admin .= drupal_render($form['options']);
    $admin .= "    </div>\n";
  }
  $buttons = drupal_render($form['buttons']);

  // Everything else gets rendered here, and is displayed before the admin form
  // field and the submit buttons.
  $output .= "  <div class=\"standard\">\n";
  $output .= drupal_render($form);
  $output .= "  </div>\n";

  if (!empty($admin)) {
    $output .= "  <div class=\"admin\">\n";
    $output .= $admin;
    $output .= "  </div>\n";
  }
  $output .= $buttons;
  $output .= "</div>\n";

  return $output;
}
/**
* Modifyied Theme Function theme_community_tags_form
*  render Tagging form  
**/ 
function alim_community_tags_form($form) {
global $base_url;
global $theme_path;
 $imghtnl = $base_url.'/'.$theme_path.'/images/help-brownish.gif';
	global $user;
	$output ="";
  if(!$user->uid){
   drupal_add_js(drupal_get_path('theme', 'alim') . '/jquery.tools.min.js');
            $x= 'jQuery.noConflict();';
  			$script = '$("#demo img[title]").tooltip({ 
			offset: [35, 170],
			delay:0,
			events: {
		    def:"mouseover,blur"
  	                }
        });';
 		 drupal_add_js($script, 'inline', 'header');
		 drupal_add_js($x, 'inline', 'header');
		   $val="<div class='tooltop1'></div><div class='toolmiddle1'>Any content page on the site can be “tagged” by clicking on the “Add Tag” button. A tag is any word or group of words which best describes the subject of the page it belongs to. So for example, let’s say you want to search for ayaat pertaining to the subject of tawhid (i.e. Islamic monotheism). Searching for the word tawhid itself won’t yield many results. What you really need is a way to find ayaat whose subject is tawhid but the word tawhid doesn’t necessarily appear in them. Tagging solves this problem. If you were to be reading, for example, Surah Ash-Shura ayah 11 it might come to your mind that the subject of the ayah includes the topic of tawhid. So you can now tag that page with the word “tawhid”. Thereafter, whenever someone searches for the word “tawhid”, Surah Ash-Shura ayah 11 would appear in the search results.
</div><div class='toolbottom1'></div>";
		  $temp = '<div id="demo"><img src="'.$imghtnl.'" title="'.$val.'" />
</div>';
  	$output .= '<div><div style=\'float:left\' class=\'tag-title\'>Tags&nbsp;</div><div class="head" >'.$temp.'</div><div class="tag-login" >'. t(' <div class="a1"> <a  class="rpxnow" style="text-decoration:none;" onclick="return false;" href="https://alim.rpxnow.com/openid/v2/signin?token_url='.$base_url.'/rpx/end_point">Add Tags</a></div>') .' &nbsp; <div class="a2">'.l('Search Tags','tags/alltags').'</div></div></div>';
  }
  $output .= '<div class="pagecloud" >';
  
  $output .= theme('form_element', array('#title' => t('All tags')), drupal_render($form['cloud']));
  $output .= '</div>';
  $output .= drupal_render($form);

  // We add the JS file this late, to ensure it comes after autocomplete.js.
  drupal_add_css(drupal_get_path('module', 'community_tags') .'/community_tags.css', 'module');
  drupal_add_js(drupal_get_path('module', 'community_tags') .'/community_tags.js');

  return $output;
}
/**
* Modifyied Theme Function theme_community_tags
*  render tags 
**/ 
function alim_community_tags($tags) {
 // return '<div class="cloud"><div>'. (count($tags) ? theme('tagadelic_weighted', $tags) : t('No tags assigned yet.')) .'</div></div>';
  //'<div class="tagcloud" ><b>Tags</b>'.$cloud.'</div><div style="clear:both" ></div>'; 
  if( arg(0) == 'taxonomy' && arg(1) == 'term'){
  		$temp = theme('tagadelic_weighted', $tags);
		if($temp != '')
		  	 return '<div class="tagcloud" ><b>Other Tags</b><div class="cloud"><div>'. (count($tags) ? $temp : t('No tags assigned yet.')) .'</div></div></div><div style="clear:both" ></div>';
		else 
		return '';
	}
  else
  	 return '<div class="cloud"><div>'. (count($tags) ? theme('tagadelic_weighted', $tags) : t('No tags assigned yet.')) .'</div></div></div><div style="clear:both" >';
   
   
}
/**
* Modifyied Theme Function theme_tagadelic_weighted
*  render tags 
**/ 
function alim_tagadelic_weighted($terms) {
  $output = '';
  foreach ($terms as $term) { 	//print '..'.arg(2);
  		if( arg(0) == 'taxonomy' && arg(1) == 'term' &&  arg(2) == $term->tid ){
			$output .= ''; //print '**';
			
		}
		else{
	    	$output .= l($term->name, taxonomy_term_path($term), array('attributes' => array('class' => "tagadelic level$term->weight", 'rel' => 'tag'))) ." \n"; //print '@@';
			}
  }	
  return $output;
}
/**
* Modifyied Theme Function theme_taxonomy_term_page
*  render tags 
**/ 
function alim_taxonomy_term_page($tids, $result) {
  drupal_add_css(drupal_get_path('module', 'taxonomy') .'/taxonomy.css');

  $output = '';
	$new = '';
  // Only display the description if we have a single term, to avoid clutter and confusion.
  if (count($tids) == 1) {
    $term = taxonomy_get_term($tids[0]);
    $description = $term->description;
	 /*if($term->vid == 9 ){ // check this is a community tag
			
	  
	  	 $count = taxonomy_term_count_nodes($term->tid);
			$new = "<h4>Tag : $term->name ( $count )</h4>";
	  }*/
    // Check that a description is set.
    if (!empty($description)) {
      $output .= '<div class="taxonomy-term-description">';
      $output .= filter_xss_admin($description);
      $output .= '</div>';
	 
    }
  }
	//$output .= $new ;
  $output .= taxonomy_render_nodes($result);

  return $output;
}

/**
* Modifyied Theme Function theme_box
*  ti hide title in search 
**/ 
function alim_box($title, $content, $region = 'main') {
	if(arg(0) == 'search' )
	  $output = '<div>'. $content .'</div>';
	else
		 $output = '<h2 class="title">'. $title .'</h2><div>'. $content .'</div>';
  return $output;
}

/**Functin to to output bookmark and clip links in rightside **/
function bookmark(){   //<span class="bookmarks" > print $bookmark; </span>
	global $user;
	global $base_url;	
	//if( ($user->uid == 1) || ( is_array($user->roles)  && in_array("Developer", $user->roles)  )    ){	
	$themepath = base_path() . path_to_theme().'/images';
	//$top = "<img src='$themepath/bkg_hook_top.png' alt='' title='' />";	
	$bookmark = "<img src='$themepath/icon_bookmark.png' alt='Bookmark' title='Bookmark' valign='bottom' width='24' height='23' />";
	$clipi = "<img src='$themepath/icon_clip_page.png' alt='Clip page' title='Clip page' valign='bottom' width='22' height='19'  />";
	$sep = "<div class='sep' ></div>";
	if(!$user->uid){ 	
		if( arg(0) == 'library' &&  (arg(1) == 'hadith' ||  arg(1) == 'quran' )  ){
			if (  arg(2) != 'prophet' && arg(2) != 'subject' && arg(2) != 'narratorindex' && arg(2) != 'narrator' && arg(2) != 'page' && arg(2) != 'structure' && arg(2) != 'duas'
			&& arg(3) != 'theme'   ){
			
			$clip = $sep.'<span class="clip" ><a  class="rpxnow"  onclick="return false;" href="https://alim.rpxnow.com/openid/v2/signin?token_url='.$base_url.'/rpx/end_point" title="Clip" >'.$clipi.'</a></span>';
			}
		}
		
		$log = '<div id="bookmark-right-menu" ><div class="top" ></div><div class="middle" >'.$sep.'<span class="bookmarks" ><a  class="rpxnow"   onclick="return false;" href="https://alim.rpxnow.com/openid/v2/signin?token_url='.$base_url.'/rpx/end_point" title="Bookmark" >'.$bookmark.'</a></span>'.$clip.$sep.'</div><div class="bottom" ></div></div>'; 
		return $log; 
	}
	$path = drupal_urlencode(drupal_get_normal_path(drupal_get_path_alias($_GET['q'])));
	$query_variables = $_GET;
	unset($query_variables['q']);
	$query_string = '';
	foreach ($query_variables as $key => $value) {
		$query_string .= '&' . $key . '=' . $value;
	}
	
	if (!empty($path)) {
		if (!empty($query_string)) {
			$path .= '?' . $query_string;
		}
		
		
		$out = '<div id="bookmark-right-menu" ><div class="top" ></div><div class="middle" >'.$sep;
		$out .=  '<span class="bookmarks" ><a id="show-book-menu" href="#" title="Bookmark" >'.$bookmark.'</a></span>';
		if( arg(0) == 'library' &&  (arg(1) == 'hadith' ||  arg(1) == 'quran' )  ){
			if (  arg(2) != 'prophet' && arg(2) != 'subject' && arg(2) != 'narratorindex' && arg(2) != 'narrator' && arg(2) != 'page' && arg(2) != 'structure' && arg(2) != 'duas'
			&& arg(3) != 'theme'   ){
			$out .=  $sep.'<span class="clip" ><a id="show-clip-menu" href="#" title="clip" >'.$clipi.'</a></span>';
			}
		}
		$out .=   $sep.'</div><div class="bottom" ></div></div>';
		$out .= '<div id="popup-bookmark" style="display:none;" ><div class="mybookmark-inner" >';//print_r($query_variables);
		$out .= '<a href="#" class="mymenu" id="dialog-mymenu" title="View the list of bookmarked pages"  >My Bookmarks</a>';
		$out .= l('<nobr>Bookmark this page</nobr>', 'bookmarks/item/addpage/' . base64_encode($path), array('attributes' => array('id' => 'bookmarks_add' , 'class' => 'popups' , 'title' => 'Bookmark the current page / Add this page to My Bookmarks '  ) , 'html' => TRUE  ));
        $out .= l(t('Organize Bookmarks'), 'bookmarks/mine',array('attributes' => array(  'class' => 'org-bm' , 'id' => 'bm-org-bm' , 
		'title' => 'Organise book mark' ) )  );

		$out .=  l( t('Set Last'), 'bookmarks/lastpage/'.base64_encode($path) ,array('attributes' => array(  'class' => 'bm-last' , 'id' => 'bm-lastpage' , 
		'title' => 'Set this page as the last page you were reading so that you can return to it easily on your next visit to alim.org' ) )  );
		//$out .= '<em style="font-size:8px;"> </em>';
		//if(  isset($user->profile_last_read ) && $user->profile_last_read != ''  ) 
		$menuid1 = db_result(db_query("SELECT value as lpage FROM {profile_values} WHERE fid='%d' AND uid= '%d'", 12 , $user->uid ));
		if(  isset($menuid1) && $menuid1 != ''  ) 
		$out .=  '<span id="mark-lastpage" >'.l( t('Go to Last'), $menuid1 ,array('attributes' => array(  'class' => 'bm-golast' ,
		'title' => 'Go to the last place you were reading.'  ) )  ).'</span>';
		else
		$out .=  '<span id="mark-lastpage" >'.l( t('Al-Qur\'an'), 'library/quran/surah/arabic/1/ARB' ,array('attributes' => array(  'class' => 'bm-golast' , 
		'title' => 'Go to the last place you were reading'  ) )  ).'</span>';			
		$out .=  '</div></div>';
		
		if( arg(0) == 'library' &&  (arg(1) == 'hadith' ||  arg(1) == 'quran' )   ){		
			if (  arg(2) != 'prophet' && arg(2) != 'subject' && arg(2) != 'narratorindex' && arg(2) != 'narrator' && arg(2) != 'page' && arg(2) != 'structure' && arg(2) != 'duas'
			&& arg(3) != 'theme'   ){			
				$out .= '<div id="popup-clip-menu" style="display:none;" ><div class="mybookmark-inner" >';		
				$out .= l('Clip this Page' , 'node/add/clippings' , array( 'attributes' => array('class' => 'popups pop-clip-one' , 'id' => 'clip-btn-all' ,
				'title' => 'Clip the whole page and save to your notebook') , 'html' => TRUE ) ); 		
				$out .= '<a class="pop-clip-two" href="#" title="Clip the selected text from this page" id="clip-btn-sel" >Clip the selected text</a>';
				$out .= '<a class="pop-clip-three"  href="/user/clippings" title="Go to my notebook"  >My NoteBook</a>';
				$out .= '</div></div>';
			}
		
		}
		$out .= '<div style="display:none" id="bm-nice-menu" >Loading....</div>';
		return $out;
	}
	
	return '';
	
	//}
	//return '';
	
}

function nl2brr($text)
{
    return "&nbsp;&nbsp;&nbsp;&nbsp;".preg_replace("/\r\n|\n|\r/", '<p>&nbsp;&nbsp;&nbsp;&nbsp;', $text);
}


/**
 * Theme the menu overview form into a table.
 *  Modified theme_bookmarks_overview_form
 * in Bookmark module
 * hide the  default enabled , public checkboxes in mange bookmarks section 
 */
function alim_bookmarks_overview_form($form) {
  $output = ''; global $user;
  if ($_GET['q'] == BOOKMARKS_PRESETS_URL) {
    $header = array(
      t('Menu item'),
      array('data' => t('Operations'), 'colspan' => '3'),
    );
  }
  else {
    drupal_add_tabledrag('bookmarks-overview', 'match', 'parent', 'menu-plid', 'menu-plid', 'menu-mlid', TRUE, MENU_MAX_DEPTH - 1);
    drupal_add_tabledrag('bookmarks-overview', 'order', 'sibling', 'menu-weight');

    if (module_exists('bookmarks_public')) {
      $header = array(
        t('Menu item'),
        array('data' => t(''), 'class' => 'checkbox'), //Enabled
        array('data' => t(' '), 'class' => 'checkbox'),//Expanded
        array('data' => t(' '), 'class' => 'checkbox'),//Public removed
        t('Weight'),
        array('data' => t('Operations'), 'colspan' => '3'),
      );
    }
    else {
      $header = array(
        t('Menu item'),
        array('data' => t(''), 'class' => 'checkbox'),//Enabled
        array('data' => t(''), 'class' => 'checkbox'),//Expanded
        t('Weight'),
        array('data' => t('Operations'), 'colspan' => '3'),
      );
    }
  }

  $rows = array();
  foreach (element_children($form) as $mlid) {
    if (isset($form[$mlid]['hidden'])) {
      $element = &$form[$mlid];
      // Build a list of operations.
      $operations = array();
      foreach (element_children($element['operations']) as $op) {
        $operations[] = drupal_render($element['operations'][$op]);
      }
      while (count($operations) < 2) {
        $operations[] = '';
      }

      // Add special classes to be used for tabledrag.js.
      $element['plid']['#attributes']['class'] = 'menu-plid';
      $element['mlid']['#attributes']['class'] = 'menu-mlid';
      $element['weight']['#attributes']['class'] = 'menu-weight';

      // Change the parent field to a hidden. This allows any value but hides the field.
      $element['plid']['#type'] = 'hidden';
      if ($_GET['q'] == BOOKMARKS_PRESETS_URL) {
        $element['hidden']['#type'] = 'hidden';
      }

      $row = array();
      $row[] = theme('indentation', $element['#item']['depth'] - 1) . drupal_render($element['title']);
      if ($_GET['q'] != BOOKMARKS_PRESETS_URL) {
        $row[] = array('data' => drupal_render($element['hidden']), 'class' => 'checkbox');
        $row[] = array('data' => drupal_render($element['expanded']), 'class' => 'checkbox');
        if (module_exists('bookmarks_public')) {
          $row[] = array('data' => drupal_render($element['public']), 'class' => 'checkbox');
        }
      }
      $row[] = drupal_render($element['weight']) . drupal_render($element['plid']) . drupal_render($element['mlid']);
      $row = array_merge($row, $operations);

      $row = array_merge(array('data' => $row), $element['#attributes']);
      $row['class'] = !empty($row['class']) ? $row['class'] . ' draggable' : 'draggable';
      $rows[] = $row;
    }
  }
  if ($rows) {
    $output .= theme('table', $header, $rows, array('id' => 'bookmarks-overview'));
  }
  				$menuid1 = db_result(db_query("SELECT value as lpage FROM {profile_values} WHERE fid='%d' AND uid= '%d'", 12 , $user->uid ));
  				if(  isset($menuid1) && $menuid1 != ''  ) 
					$out =  l( t('Go to Last page'), $menuid1 ,array('attributes' => array(  
				'title' => 'Go to the last place you were reading.'  ) )  );
				else
					$out =  l( t('Go to Last page'), 'library/quran/surah/arabic/1/ARB' ,array('attributes' => array(  
				'title' => 'Go to the last place you were reading'  ) )  );
				 $output .= '<div style="padding:10px 0 10px 20px;" >'.$out.'</div>';
				
  $output .= drupal_render($form);

  return $output;
}
function time_since($original) {
    // array of time period chunks
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
		array(1 , 'second'),
    );
    
    $today = time(); /* Current unix time  */
    $since = $today - $original;
    
    // $j saves performing the count function each time around the loop
    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        
        // finding the biggest chunk (if the chunk fits, break)
        if (($count = floor($since / $seconds)) != 0) {
            // DEBUG print "<!-- It's $name -->\n";
            break;
        }
    }
    
    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    
    if ($i + 1 < $j) {
        // now getting the second item
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
        
        // add second item if it's greater than 0
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
            $print .= ($count2 == 1) ? ' 1 '.$name2 : " $count2 {$name2}s";
        }
    }
    return $print;
}  



 function printdata1($node1){	
	
	$qry = "SELECT count(*) FROM {comments} where pid=$node1";
	$num = db_result(db_query(db_rewrite_sql($qry)));
	//print $node1.'--'.$num.'--';
	
	
	$result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node=$row['cid']; $nodepid=$row['pid'];
		
		
		 $result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node22=$row['cid']; $nodepid=$row['pid'];
		 $viewName = 'user_scholar_comments';
		//print $node22.'**--';
		$qry = "SELECT count(*) FROM {comments} where pid=$node22";
	$num = db_result(db_query(db_rewrite_sql($qry)));
//print '-------------------------------------------------**'.$num.'--------------->>';

		
		
		 print views_embed_view($viewName , $display_id = 'default',$node22);
		  
		  
		$subitem11 = db_query("SELECT * FROM {comments} where pid=%d",$node22);
		while($row = db_fetch_array($subitem11)){
		
		 $node1122=$row['cid'];
		 
		 print views_embed_view($viewName , $display_id = 'default', $node1122);
		  if($node1122!=" "){
			printdata1($node1122);
		}
		  
		  
		  }
		  }
		//  print "-----------".$nodepid."-----------";
		$subitem = db_query("SELECT * FROM {comments} where pid=%d",$node);
		while($row = db_fetch_array($subitem)){
		
		 $node11=$row['cid']; //printdata($node11);
	//print $node11."ooooooooooooooooo";
		}
		if($node11!=" "){
		//	printdata_cmt($node);
		}
		
	}
 }
 
 
  function printdata($node1){	
	
	$qry = "SELECT count(*) FROM {comments} where pid=$node1";
	$num = db_result(db_query(db_rewrite_sql($qry)));
	//print $node1.'--'.$num.'--';
	
	
	$result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node=$row['cid']; $nodepid=$row['pid'];
		
		
		 $result = db_query("SELECT * FROM {comments} where pid=%d",$node1);
	while($row = db_fetch_array($result)){
		$node22=$row['cid']; $nodepid=$row['pid'];
		 $viewName = 'user_scholar_comments';
		//print $node22.'**--';
		$qry = "SELECT count(*) FROM {comments} where pid=$node22";
	$num = db_result(db_query(db_rewrite_sql($qry)));
//print '-------------------------------------------------**'.$num.'--------------->>';

		
		
		 print views_embed_view($viewName , $display_id = 'default',$node22);
		  
		  
		$subitem11 = db_query("SELECT * FROM {comments} where pid=%d",$node22);
		while($row = db_fetch_array($subitem11)){
		
		 $node1122=$row['cid'];
		 
		 print views_embed_view($viewName , $display_id = 'default', $node1122);
		  if($node1122!=" "){
			printdata($node1122);
		}
		  
		  
		  }
		  }
		//  print "-----------".$nodepid."-----------";
		$subitem = db_query("SELECT * FROM {comments} where pid=%d",$node);
		while($row = db_fetch_array($subitem)){
		
		 $node11=$row['cid']; //printdata($node11);
	//print $node11."ooooooooooooooooo";
		}
		if($node11!=" "){
		//	printdata_cmt($node);
		}
		
	}
 }