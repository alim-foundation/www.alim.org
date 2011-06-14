<?php 
/**
Drupal search formis altered in this module to make search in individual books and display results in 


**/

/**
 * Implementation of hook_menu().
 */
function alimsearch_menu() {
  $items['alimsearch'] = array(
    'title' =>  t('Search'),
    'page callback' => 'alimsearch_view',
    'access arguments' => array('search content'),
    'type' => MENU_SUGGESTED_ITEM,
  );
  return $items;
}

//global $facet_block ;



function alimsearch_form_alter(&$form, &$form_state, $form_id) {
		$default = $_GET['q'];
		
		$cat = alimsearch_categories();
		$types = array();
		foreach($cat as $k => $v){
			$types = array_merge( $types ,alimsearch_getbooknames($k) ); 
		}
		
		if ($form_id == 'search_theme_form') {
			//drupal_add_js(path_to_theme() .'/js/jquery.alerts.js', 'alim');
			//drupal_add_css(path_to_theme() .'/js/jquery.alerts.css', 'alim');
			//jquery_ui_add(array('ui.draggable'));
			$form['#submit'] = array('alimsearch_form_submit');
			$form['basic']['inline']['submit'] = array('#type' => 'submit', '#value' => t('Search'));
			$form['basic']['inline']['currpage'] = array('#type' => 'hidden', '#default_value' => $default );		
			
			
			$form['categories'] = array(
				'#prefix' => '<div id="adv-searchfrm">',
				'#suffix' => '</div>',
			);
			
			$i= 1;
			foreach($cat  as $k => $v ){  $two = 'books-'.$k;
				$form['categories'][$k] = array(
  					'#type' => 'checkbox',
  					'#title' => $v,
					'#default_value' => 1
				);
				$form['categories'][$two] = array(
					'#prefix' => "<div class='$two'  >",
					'#suffix' => '</div>',
				);
				
				$types1 = alimsearch_getbooknames($k) ; $k = 'book-'.$k;
				if(count($types1) > 0){
					$form['categories'][$two][$k] = array(
						'#type' => 'checkboxes',
						'#title' => t(''),
						'#prefix' => '<div class="criterion">',
						'#suffix' => '</div>',
						'#options' => $types1,
						'#default_value' => array_keys($types1)
					);	
				}
				$i++;
				
			}
			
			
			$form['categories']['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Search'),
			'#prefix' => '<div class="action">',
			'#suffix' => '</div>',
			);
			
			
			unset($form['submit']);
		}
		
		if ($form_id == 'search_form' && arg(1) !='luceneapi_node' ) {
			
			//drupal_add_js(path_to_theme() .'/js/jquery.alerts.js', 'alim');
			//drupal_add_css(path_to_theme() .'/js/jquery.alerts.css', 'alim');
			//jquery_ui_add(array('ui.draggable'));
			$form['categories'] = array(
				'#prefix' => '<span clicktip="adv-books-frm" class="clicktip_target" >Advanced Search</span>&nbsp;&nbsp; <div id="adv-books-frm" class="clicktip" >',
				'#suffix' => '</div>',
			);
			
			$i= 1;
			foreach($cat  as $k => $v ){  $two = 'books-'.$k;
				$form['categories'][$k] = array(
  					'#type' => 'checkbox',
  					'#title' => $v,
				);
				$form['categories'][$two] = array(
					'#prefix' => "<div class='$two'  >",
					'#suffix' => '</div>',
				);
				
				$types1 = alimsearch_getbooknames($k) ; $k = 'book-'.$k;
				if(count($types1) > 0){
				$form['categories'][$two][$k] = array(
					'#type' => 'checkboxes',
					'#title' => t(''),
					'#prefix' => '<div class="criterion">',
					'#suffix' => '</div>',
					'#options' => $types1,
				);	
				}
				$i++;
				
			}
			
			
			$form['categories']['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Search'),
			'#prefix' => '<div class="action">',
			'#suffix' => '</div>',
			);
			
			
			$form['#submit'] = array('alimsearch_form_submit');
			$form['basic']['inline']['submit'] = array('#type' => 'submit', '#value' => t('Search'));
			$form['basic']['inline']['currpage'] = array('#type' => 'hidden', '#default_value' => $default );
			unset($form['submit']);
			
		}
		
}




function alimsearch_form_submit($form, &$form_state) {
		$form_id = $form['form_id']['#value'];  
		if($form_id == 'search_theme_form' ){
				$type = $form['module']['#value'];
				
				////////////////////////////////////////////
				$subject = trim($form_state['values'][$form_id]);
				$search_comingurl = $form_state['values']['currpage'];
				$url_array = explode('/',$search_comingurl);
				$patternq = '/^[0-9]+(\.|:)[0-9]+$/'; // Expresions of the form 11.23 , 0.1 etc for quran 
				$tq = preg_match($patternq, $subject, $matches);
				
				$patterns = '/^[0-9]+$/'; // Expresions of the form 11.23 , 0.1 etc for number only
				$ts = preg_match($patterns, $subject, $matches);
				//print "$ts ==  ts value ";
				//$patternh = '/^h.[0-9]+(\.[0-9]+)*$/';  // Expresions of the form 11.23 , 0.1 etc for hadith only
				$patternh = '/^h.[0-9]+((\.|:)[0-9]+)*$/'; 
				
				$th = preg_match($patternh, $subject, $matches);
				//print "$th ==  th value ";
				
				if($tq == 1 ){ // pattern matches  for quran 
					if(  ( $pos = strpos($subject, ':') ) !== false ){
						$values = explode(':' , $subject );
					}else{
						$values = explode('.' , $subject );
					}
					
					$firstnum = $values[0];
					$secondnum = $values[1];
					if($firstnum <= 0 ){ $firstnum = 1; }
					if($secondnum <= 0 ){ $secondnum = 1; }									
					if(  ( $pos = strpos($search_comingurl, 'library/quran/surah/arabic') ) !== false ){
						$path1 = 'library/quran/surah/arabic/'.$firstnum.'/ARB';
						drupal_goto($path1,'',$secondnum);		
					}	
					else if( ( $pos = strpos($search_comingurl, 'library/quran/surah/english') ) !== false  ){
						$path1 = 'library/quran/surah/english/'.$firstnum.'/'.$url_array[5];
						drupal_goto($path1,'',$secondnum);
					}
					else{
						$path1 = 'library/quran/ayah/compare/'.$firstnum.'/'.$secondnum;
						drupal_goto($path1);
					}		
					
				}	
				if($ts == 1 ){
					$firstnum = $subject;
					if($firstnum <= 0 ){ $firstnum = 1; }
					 if( ( $pos = strpos($search_comingurl, 'library/quran/surah/english') ) !== false  ){
						$path1 = 'library/quran/surah/english/'.$firstnum.'/'.$url_array[5];
						drupal_goto($path1);
					}
					else if( ( $pos = strpos($search_comingurl, 'library/quran/ayah/compare') ) !== false ){
							$path1 = 'library/quran/ayah/compare/'.$firstnum.'/1';
							drupal_goto($path1);
					}
					else {
						$path1 = 'library/quran/surah/arabic/'.$firstnum.'/ARB';
						drupal_goto($path1,'',$secondnum);		
					}	
				
				}				
				if($th == 1 ){
									
					if(  ( $pos = strpos($subject, ':') ) !== false ){
						$values = explode(':' , $subject );
					}else{
						$values = explode('.' , $subject );
					}
					
					$firstnum = $values[1];
					$secondnum = $values[2];
					if($firstnum <= 0 ){ $firstnum = 1; }
					if($secondnum <= 0 ){ $secondnum = 1; }								
					if(  ( $pos = strpos($search_comingurl, 'library/hadith') ) !== false ){
					
						if($secondnum  && ( $url_array[2] == 'SHB' || $url_array[2] == 'AMH' || $url_array[2] == 'FQS'  ) ){	
								if($url_array[2] == 'FQS' || ( $pos = strpos($search_comingurl, 'library/hadith/fiqh') ) !== false  )
									$path1 = 'library/hadith/fiqh'.$url_array[2].'/'.$firstnum.'/'.$secondnum;
								else
									$path1 = 'library/hadith/'.$url_array[2].'/'.$secondnum.'/'.$firstnum;
							drupal_goto($path1);	
						}
						else{
						
							$path1 = 'library/hadith/'.$url_array[2].'/'.$firstnum;
							drupal_goto($path1);		
						}
					}	
					else{
					
						$path1 = 'library/hadith/SAD/'.$firstnum;
						drupal_goto($path1);
					}
				
				}
				////////////////////
				
				
				
				
				////////////////////
				$cat = alimsearch_categories();
				//	catarr = array();
				$categories = '';$a ='';
				foreach($cat as $k => $v){
					$result = $form_state['values'][$k];
					if( $result == 1 && $k != 'all'){
						
							$categories .=$k ;$categories.=' ';
					}	$b = 'book-'.$k;
					$books = $form_state['values'][$b];
					if(count($books)  > 0){
							foreach($books as $kk => $vv){
								if($vv != '' ){
									$a.=$vv;$a.=' ';
								}
							}
					}
				}
				
				
				$cat = str_replace(' ','-',rtrim($categories)); 
				
				$aa = str_replace(' ','-',rtrim($a));
				$append  = '';
				if($cat != '' ){
					$append = 'cat='.$cat;
				}
				if($aa != ''){
					$append .= '&book='.$aa;
				}
				
				
				$search_comingurl = $form_state['values']['currpage'];
				if($append != '')	{
					$form_state['redirect'] = array('alimsearch/node/'. trim($form_state['values'][$form_id]) , $append ) ;return;
				}
				else	
				{

					$form_state['redirect'] = 'alimsearch/node/'. trim($form_state['values'][$form_id]);return;
				}
		
		}
		else{
				$keys = $form_state['values']['processed_keys'];  
				$search_comingurl = $form_state['values']['currpage'];  
				/////////
				$cat = alimsearch_categories();
				$categories = '';$a ='';
				foreach($cat as $k => $v){
					$result = $form_state['values'][$k];
					if( $result == 1 && $k != 'all'){
						
							$categories .=$k ;$categories.=' ';
					}	$b = 'book-'.$k;
					$books = $form_state['values'][$b];
					
					if(count($books) > 0 ){
							foreach($books as $kk => $vv){
								if($vv != '' ){
									$a.=$vv;$a.=' ';
								}
							}
					}
				}
				
				
				$cat = str_replace(' ','-',rtrim($categories)); 
				$aa = str_replace(' ','-',rtrim($a));
				$append  = '';
				if($categories != '' ){
					$append = 'cat='.$cat;
				}
				if($aa != ''){
					$append .= '&book='.$aa;
				}
				
				if ($keys == '') {
				form_set_error('keys', t('Please enter some keywords.'));
				// Fall through to the drupal_goto() call.
				}
				$type = $form_state['values']['module'] ? $form_state['values']['module'] : 'node';
				if($append != '')	{
					//$form_state['redirect'] = array('alimsearch/node/'. trim($form_state['values'][$form_id]) , $append ) ;return;
					$form_state['redirect'] = array('alimsearch/'. $type .'/'. $keys , $append) ;return;
				}
				else	
				{
					$form_state['redirect'] = 'alimsearch/'. $type .'/'. $keys;return;
				}						
				$form_state['redirect'] = 'alimsearch/'. $type .'/'. $keys;
				return;
				
		
		}
		
}

function alimsearch_view(){
	
	global $facet_block ;
	$form_block = '';
	$facet_block .= "<div class='facet-block' >";
	drupal_set_title('Search Result');
	
	$output = "";
	
	$keys = search_get_keys();
	$highlight_keys = explode(' ' , $keys );
	$high_js = '';
	foreach($highlight_keys as $ks){
		$ks = strtolower($ks);
		if($ks != '' &&   $ks != 'or' &&  $ks != 'and' && $ks != 'nor' )
			$high_js.='$(".search-snippet ,.search-snippet p , .search-snippet div").highlight("'.$ks.'");';
	}
	
	if (!isset($_POST['form_id']) && $keys != '' ) 
	{
		 drupal_add_js(drupal_get_path('module', 'alimsearch') .'/jquery.highlight-3.js', 'module');
		$script = $high_js;
		
		$sc = '<script type="text/javascript">'.
'$(document).bind("popups_open_path_done", function() {
  '.$high_js.'
});'.
'</script>';


		 drupal_add_js($script, 'inline', 'footer');
		$output = "<div >";	
		
		$form_block = drupal_get_form('search_form', NULL, $keys, $type);
		$output .= '<div style="clear:both" >';
		// Only perform search if there is non-whitespace search term:
		$results = '';$outputresult = "";$newtypes = array();
		$keys1 = trim($keys);
		$category = $_REQUEST['cat'];
		$catarr = explode('-' , $_REQUEST['cat']);
		$bookarr = array();
		if(isset($_REQUEST['book'])){
			$bookstr = $_REQUEST['book'];
			$bookarr = explode('-' , $bookstr );
		
		}
		$addedkey = '';   $types=array();
		
		if(isset($_REQUEST['cat']) && isset($_REQUEST['book']) ){
			
			if(!isset($_REQUEST['cat'])){
			// get book category of selected books ..
			
			}
			
			
			foreach($catarr as $scat ){
				
				switch ($scat) {
					case "quran":
						$qbooks = alimsearch_getbooknames('quran');								
							foreach($bookarr as $sbook){
								if(array_key_exists($sbook , $qbooks )){
								
								$types = array_merge($types , array($sbook => $qbooks[$sbook] ));
								if($sbook == 'AY'){
									$nn = $keys.' type:quran_ayah_theme';	
								}
								else if($sbook == 'QSI'){
									$nn = $keys.' type:quran_surah_introduction';	
								}
								else if($sbook == 'QCC'){
									$nn = $keys.' type:quran_ayah_elaboration';	
								}
								else if($sbook == 'QS'){
									$nn = $keys.' type:quran_subject';	
								}
								else{
									$nn = $keys.' '.$sbook .' type:quran_ayah';								
								}
								
								$output.=alimsearch_getsingleresult($nn , $qbooks[$sbook] );
								}
							}						
						break;
					case "hadith":
						$qbooks = alimsearch_getbooknames('hadith');
							foreach($bookarr as $sbook){
								if(array_key_exists($sbook , $qbooks )){									
									$types = array_merge($types , array($sbook => $qbooks[$sbook] ));
									$nn = $keys.' '.$sbook .' type:hadith_content,hadith_subject';	
									$output.=alimsearch_getsingleresult($nn , $qbooks[$sbook] );
								}
							}
						
						break;
					case "fiqh":
						//$qbooks = alimsearch_getbooknames('biographies');
						$nn = $keys.' type:fiqh_sunnah,hadith_subject';
						$output.=alimsearch_getsingleresult($nn , 'Fiqh' );
						break;
					case "islam":
						//$qbooks = alimsearch_getbooknames('article');
						$nn = $keys.' type:article_content';
						$output.=alimsearch_getsingleresult($nn , 'Islam Articles' );
						break;
					case "biographies":
						$qbooks = alimsearch_getbooknames('biographies');
						foreach($bookarr as $sbook){
								if(array_key_exists($sbook , $qbooks )){									
									$types = array_merge($types , array($sbook => $qbooks[$sbook] ));
									$nn = $keys.' '.$sbook .' type:article_content';	
									$output.=alimsearch_getsingleresult($nn , $qbooks[$sbook] );
								}
							}
						break;
					/*case "index":
						$qbooks = alimsearch_getbooknames('index');
						foreach($bookarr as $sbook){
								if(array_key_exists($sbook , $qbooks )){									
									$types = array_merge($types , array($sbook => $qbooks[$sbook] ));
									if($sbook == 'QS' )
										$nn = $keys.' type:quran_subject';	
									else
										$nn = $keys.' type:hadith_subject';
									//print $nn;
									$output.=alimsearch_getsingleresult($nn , $qbooks[$sbook] );
								}
							}
						break;*/
					
					default:
						/*$types = Array ( 
						'quran_ayah' => 'Qur\'an Ayah Translations' ,
						'quran_subject' => 'Qur\'an Subjects' ,
						'quran_ayah_elaboration' => 'Qur\'an Commentary' ,
						'quran_ayah_theme' => 'Qur\'an Ayat Themes' ,
						'quran_surah_introduction' => 'Qur\'an Surah Introductions' ,
						'hadith_content' => 'Ahadith' ,
						'hadith_subject' => 'Hadith Subjects',
						'Fiqh-us-Sunnah' => 'Fiqh',
						'Article_Content' => 'Articles/Biographies'
						) ;*/
				}
			}			
			
		}
		else if( isset($_REQUEST['cat']) && !isset($_REQUEST['book']) ){
			foreach($catarr as $scat ){                
                switch ($scat) {
                    case "quran":
					
						//if( $module == 'quran_ayah' ){
							$qbooks = alimsearch_getbooknames('quran'); //	print_r($qbooks);	
							foreach($qbooks as $sbook => $sname){								
								if($sbook == 'AY' || $sbook == 'QSI' || $sbook == 'QCC' ){									
								}
								else{
									$nn = $keys.' '.$sbook .' type:quran_ayah';	
									$output.=alimsearch_getsingleresult($nn , $sname );							
								}
							}				
							//}
                        $s = Array ( 
                               // 'quran_ayah' => 'Qur\'an Ayah Translations' ,
                                //'quran_subject' => 'Qur\'an Subject Index' ,
                                'quran_ayah_elaboration' => 'Qur\'an Commentary' ,
                                'quran_ayah_theme' => 'Qur\'an Ayah Themes' ,
                                'quran_surah_introduction' => 'Qur\'an Surah Introductions'  ,
								'quran_ayah_elaboration' => 'Qur\'an Commentary' ,  
								'quran_subject' => 'Qur\'an Subject Index'                              
                                ) ;
                            $newtypes = array_merge($newtypes , $s );
							
							
                    break;
                    case "hadith":
                        $s = Array ( 
                                'hadith_content,hadith_subject' => 'Ahadith' ,
                                /*'hadith_subject' => 'Hadith Subjects',*/
                                ) ;
                                $newtypes = array_merge($newtypes , $s );
                    break;
					case "fiqh":
                        $s = Array ( 
                                'fiqh_sunnah,hadith_subject' => 'Fiqh',
                                ) ;
                                $newtypes = array_merge($newtypes , $s );
                    break;
                    case "islam":
                        $s = Array ( 
                                    'article_content' => 'Islam articles'
                                ) ;
                                $newtypes = array_merge($newtypes , $s );
                    break;                    
					case "biographies":
                      $s = Array ( 
                                    'article_content' => 'Biographies',									
                                ) ;
                                $newtypes = array_merge($newtypes , $s );
                    break;
					/*case "index":
                        $s = Array ( 
									'quran_subject' => 'Qur\'an Subjects' ,
                                   'hadith_subject' => 'Hadith Subjects'								   
                                ) ;
                         $newtypes = array_merge($newtypes , $s );
                    break;*/
                    default:
                        
                }        
            }      
		}
		else
		{
			$newtypes = Array ( 
			'quran_ayah' => 'Qur\'an Ayah Translations' ,
			'quran_subject' => 'Qur\'an Subject Index' ,
			'quran_ayah_elaboration' => 'Qur\'an Commentary' ,
			'quran_ayah_theme' => 'Qur\'an Ayah Themes' ,
			'quran_surah_introduction' => 'Qur\'an Surah Introductions' ,
			'hadith_content,hadith_subject' => 'Ahadith' ,
			/*'hadith_subject' => 'Hadith Subjects',*/
			'fiqh_sunnah,hadith_subject' => 'Fiqh',
			'article_content' => 'Articles/Biographies'
			) ;
			
		}	
		 if(count($newtypes) > 0 ){
            foreach ($newtypes as $module => $type) {
                
				if( $module == 'quran_ayah' ){
							$qbooks = alimsearch_getbooknames('quran'); //	print_r($qbooks);	
							foreach($qbooks as $sbook => $sname){								
								if($sbook == 'AY' || $sbook == 'QSI' || $sbook == 'QCC' || $sbook == 'QS' ){									
								}
								else{
									$nn = $keys.' '.$sbook .' type:quran_ayah';	
									$output.=alimsearch_getsingleresult($nn , $sname );							
								}
							}				
				}
				else{
				
				
                $keys = $keys1.' type:'.$module;             
                $output.=alimsearch_getsingleresult($keys , $type );
				
				}
                $i++;
            }        
        }
		$i=1;
		$output.='</div></div>';	
		$facet_block .= "</div>";
		$out = "<div class='search-results' >";
		$out .= '<table border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td  valign="top" >'.$facet_block.'</td>
			<td><div class="result" >'.$form_block.$output.'</div></td>
		  </tr>
		</table>';
				
		$out .= "</div>";
		return $out.$sc;
		
	}
	
	$output .= drupal_get_form('search_form', NULL, empty($keys) ? '' : $keys, 'node');
	return $output;
	
}



function alimsearch_getsingleresult($keys ,$filedsetname){

			global $facet_block;
			global $pager_total;
			global $pager_total_items;
			$output ="";$outputresult ="";
			$res = node_search('search' , $keys);											
			
			if (count($res) > 0) {
		
		
				$seachpath = 'search/node/'.$keys;
				if($pager_total_items[0] > 10){
					$outputresult.= '<div class="result-desc" >';
					$t ="Showing 10 of ".$pager_total_items[0]." results. ";
					$outputresult.=$t;
					$outputresult.=l('View all results',$seachpath ,array('attributes' => array('class' => 'popups' , 'on-popups-options' => '{width: "800px"}' ) ) );
					$outputresult.='</div>';
					
				}
				$txt = $filedsetname.'('.$pager_total_items[0].')';
				$facet_block.=l($txt,$seachpath ,array('attributes' => array('class' => 'popups' , 'on-popups-options' => '{width: "800px"}' ) ) );$facet_block.='<br />';
				foreach ($res as $ressingle ){
					$outputresult.=theme('search_result', $ressingle, 'node');
					
				}	
				
			
							
			}
			else {
				$outputresult.= '<div class="noresults" >'.t('Your search yielded no results for the '.$filedsetname).'</div>';
				//$facet_block.="$filedsetname(0)";$facet_block.='<br />';
			}
			if (count($res) > 0) {
				$output.= theme('fieldset',
				array(
				'#title' => $filedsetname,
				'#collapsible' => TRUE,
				'#collapsed' => FALSE,
				'#value' => $outputresult,
				)
				);
				
			}else{
				$output.=$outputresult;
			}
			
			$outputresult = "";
			return $output;
			
}

function alimsearch_getbooknames($type){
	$books = array(
		'quran' => array(
			'ASD' => 'Asad Translation',
			'MAL' => 'Malik Translation',
			'PIK' => 'Pickthall Translation',
			'YAT' => 'Yusuf Ali Translation',
			'QSI' =>  'Surah Introduction',
			'AY' => 'Ayah Themes',
			'QCC' => 'Qur\'an Commentary',
			'QS' => 'Qur\'an Subject Index',
		
		),
		'hadith' => array(
			'AMH' => 'Al-Muwatta Hadith',
			'HDQ' => 'Al-Qudsi Hadith',
			'TIR' => 'Al-Tirmidhi Hadith',
			'SHB' => 'Sahih Al-Bukhari Hadith' ,
			'SAD' => 'Sunan of Abu-Dawood',			
			'SHM' => 'Sahih Muslim Hadith',
			
		),
		'fiqh' => array(),
		'islam' => array(),
		'biographies' => array(
			'KAB' => 'Khalifa Abu Bakr',
			'KUM' => 'Khalifa Umar bin al-Khattab',
			'KUT' => 'Khalifa Uthman bin Ghani',
			'KAL' => 'Khalifa Ali bin Talib',
			'SOP' => 'Stories of the Prophets',
			'BIO' => 'Biographies of Companions'
		) ,
		/*'index' => array(
			'QS' => 'Qur\'an Subject Index',
			'HS' => 'Hadith Subject Index'
		)*/
		
		
	
	);
	if($type == 'full' )
		return  $books;
	else if($type == 'all' )
		return   array();
	else if($type != '' ){
		return  $books[$type];
	}
	else
		return array();

}
function alimsearch_categories(){
	//return array( 'all' => 'All' , 'hadith' => 'Hadith' ,'quran' => 'Quran' ,'article' => 'Articles' , 'biographies' => 'Biographies' );
	return array( 'all' => 'All' , 
	'quran' => 'Quran' ,
	'hadith' => 'Hadith',
	'fiqh' => 'Fiqh' ,
	'islam' => 'Islam Articles' ,  
	'biographies' => 'Biography'  ,	
	 /*'index' => 'Subject Indexes'*/
	 
	  );

}


function alimsearch_db_rewrite_sql($query, $primary_table, $primary_field, $args) {
	if ($query == '' && $primary_table == 'n' && $primary_field = 'nid' && empty($args)) {
		$excluded_types = array(
		'book_head','qurans_left' ,
		'quran_arabic_page','quran_qrabic_page_info',
		'quran_rukuhs','quran_sajda_tilawa','quran_structure_general','quran_structure_juzz','quran_subject_location',
		'quran_surah_overview',
		'media_library_videolibrary' , 'article_book' , 'dictionary' , 'hadith_book' , 'islamic_history' , 'quran_duas'
		); //variable_get('your_module_types', array());
		if (!empty($excluded_types)) {
			 $where = " n.type NOT IN ('". join("','", $excluded_types) ."') ";
			 return array('where' => $where);
		}
	}
}