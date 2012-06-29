//Search tab order 
/*ul = $('.tabs ul'); // your parent element
$('.tab-msg ul li').each(function() {
      					// allVals.push($(this).val());
						//alert( 'hhhh'+ $(this).val());
						if ($(".tab-msg ul li a").attr("href").toLowerCase().indexOf("search") >= 0)
						alert($(".tab-msg ul li a").attr("href"));
						ul.prepend(li)
     				});*/

ul = $('.tabs ul'); // your parent element
ul.children().each(function(i,li){if ($(".tab-msg ul li a").attr("href").toLowerCase().indexOf("search") >= 0) ul.prepend(li)})

//ul.children().each(function(i,li){})

// to add mouseover popup for ayah notes 
$(document).ready(function() {
    	var one1 = $(".view-ayah-translation .view-content span.fn");
		var nn = one1.length;				
		for( var i = 0, n = one1.length;  i < n ;  ++i ) {
			var element = one1[i];
			var j= i+1;
			var spancnt = one1[i].innerHTML ;
			var newid = 'hoverid-'+spancnt;
			var newurl = 'ayanote-'+spancnt;
			var pp = '<a href="#'+newurl+'" id="'+newid+'" class="note-a"  >&nbsp;<sup>';			
			var newnt = pp+spancnt+'</sup>&nbsp;</a>';
			//alert(spancnt);
			$(one1[i]).html(newnt);	

		
		}
    });
	
	
	
	$(document).ready(function() {
    	var one1 = $(".view-compare-translation .view-content span.fn");
		var nn = one1.length;
		for( var i = 0, n = one1.length;  i < n ;  ++i ) {
			var element = one1[i];			
			var j= i+1;
			var spancnt = one1[i].innerHTML ;
			var newid = 'hoverid-'+spancnt;
			var newurl = 'ayanote-'+spancnt;
			var pp = '<a href="#'+newurl+'" id="'+newid+'" class="note-a"  >&nbsp;<sup>';			
			var newnt = pp+spancnt+'</sup>&nbsp;</a>';
			//alert(spancnt);
			$(one1[i]).html(newnt);	
	
		}
    });	
	
/////////For mouseover popup in search///////////	 
	
        $(document).ready(function() {
/*            $(".search-adv").click(function(e) {          
				e.preventDefault();
                $("div#adv-searchfrm").toggle();
            });
			
			$("div#adv-searchfrm").mouseup(function() {
				return false
			});*/
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.search-adv").length==0) {
					$("div#adv-searchfrm").hide();
				}
				if($(e.target).parent("#popup-bookmark").length==0) {
					$("#bookmark-right-menu  #show-book-menu").removeClass("menu-open");
					$("#popup-bookmark").fadeOut('slow');
				}
				
				if($(e.target).parent("#popup-clip-menu").length==0) {
					$("#bookmark-right-menu  #show-clip-menu").removeClass("menu-open");
					$("#popup-clip-menu").fadeOut('slow');
				}
				if($(e.target).parent("div#bm-nice-menu").length==0) {
					$("#bookmark-right-menu  a#dialog-mymenu").removeClass("menu-open");
					$("div#bm-nice-menu").fadeOut('slow');
				}
				
			});				
			
			
			/*$("div#search_content div#site-search :input[type='text'].form-text:first").mouseup(function() {
				$("div#adv-searchfrm").toggle();
			});*/
			
			/*$("div#search_content div#site-search :input[type='text'].form-text:first").focus(function() {													
				$("div#adv-searchfrm").toggle();

			});*/
			/*$("div#search_content div#site-search :input[type='text'].form-text:first").click(function() {																	
				$("div#adv-searchfrm").toggle();

			});	*/		
			// advanced search jquery to select the check boxes etc. 
			
			$("div#search-home  div#site-search :input[type='text'].form-text:first").val('Search Al-Qur\'an, Hadith, Fiqh, Biographies, References and other books');
			
$("div#search-home  div#site-search :input[type='text'].form-text:first , div#search_content #search-block-form :input[type='text'].form-text:first , #search-form .form-text ").mouseup(function() {
				//$("div#adv-searchfrm").toggle();
				if ($(this).val() == 'Search Al-Qur\'an, Hadith, Fiqh, Biographies, References and other books'){
            			$(this).val("");
        		}	
				if ($(this).val() == 'Enter Search Keyword here') { $(this).val("");  	}
				
			});
			$("#search-block-form :input[type='text'].form-text:first , #search-form :input[type='text'].form-text:first ").keypress(function () {											
					 if ($(this).val() == 'Enter Search Keyword here'){
												$(this).val("");
												//$(this).css("color","#893D00");
						}
			 });	
			$('#search-block-form .form-submit').click(function(ev) {
			   key = $("#search-block-form .form-text").val();
			   if(key == '' || key == 'Search Al-Qur\'an, Hadith, Fiqh, Biographies, References and other books' || key == 'Enter Search Keyword here'  ){				   
						$("#search-block-form :input[type='text'].form-text:first").val('Enter Search Keyword here') ;
						//$("#search-theme-form :input[type='text'].form-text:first").css("color","#AB392E");
						$("#search-block-form .form-text").focus();
						//$("div#adv-searchfrm").toggle();
						$("div#adv-searchfrm").hide();
						ev.preventDefault();
			   }
			});
			$("#search-form .form-submit").click(function(evt) {
				key = $("#search-form .form-text").val(); 
				 if(key == '' || key == 'Search Al-Qur\'an, Hadith, Fiqh, Biographies, References and other books' || key == 'Enter Search Keyword here'  ){
					    $("#search-form :input[type='text'].form-text:first").val('Enter Search Keyword here') ;
						//$("#search-form :input[type='text'].form-text:first").css("color","#AB392E");
						$("#search-form .form-text").focus();
						//$("div#adv-searchfrm").toggle();
						$("div#adv-searchfrm").hide();				
						evt.preventDefault();
			   }
			});
			
			/*$("div#search-home div#site-search :input[type='text'].form-text:first").focus(function() {																
				$("div#adv-searchfrm").toggle();

			});
			$("div#search-home div#site-search :input[type='text'].form-text:first").click(function() {																
				$("div#adv-searchfrm").toggle();

			});*/
			
				$("div#search-home  div#site-search :input[type='text'].form-text:first").blur(function() {
					if ($(this).val() == "")
					{
						$(this).addClass("defaultTextActive");
						$(this).val('Search Al-Qur\'an, Hadith, Fiqh, Biographies, References and other books');
					}
				});
				$("div#search-home  div#site-search :input[type='text'].form-text:first").blur(); 
			
        });
		
		$(document).ready(function() {
								   
								   
												   
			/**uncheck all if any one of the book/vcategory is not clicked uncheck thae all checkbox */
			$("#search-form").submit(function(evt){
				if ($("#search-form #edit-all").is(":checked")){			
						//alert('ok ...');
						//$("#search-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', false );

					//temp =  $("search-form #edit-hadith").find(':checkbox');
					$('#search-form .books-hadith :checkbox:not(:checked)').each(function() {
      					// allVals.push($(this).val());
						//alert( 'hhhh'+ $(this).val());
						$("#search-form #edit-all").attr('checked', false );
     				});
					$('#search-form .books-biographies :checkbox:not(:checked)').each(function() {
      					// allVals.push($(this).val());
						//alert( 'hhhh'+ $(this).val());
						$("#search-form #edit-all").attr('checked', false );
     				});
					$('#search-form .books-quran :checkbox:not(:checked)').each(function() {
      					// allVals.push($(this).val());
						//alert( 'hhhh'+ $(this).val());
						$("#search-form #edit-all").attr('checked', false );
     				});
					if ($("#search-form #edit-fiqh ,  #search-form #edit-islam").is(":not(:checked)")){
						//alert( 'hhhh'+ $(this).val());
						$("#search-form #edit-all").attr('checked', false );
					}
					//evt.preventDefault();
				}
								
					   
			});	
		
				$("#search-form #edit-fiqh").click(function(){
  					//alert('ok..');
					if ($("#search-form #edit-fiqh").is(":checked")){
						$("#search-form .books-fiqh .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}
					 else{   
						 //otherwise, hide it
						$("#search-form .books-fiqh .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});	
				
				$("#search-form #edit-islam").click(function(){
  					//alert('ok..');
					if ($("#search-form #edit-islam").is(":checked")){
						$("#search-form .books-islam .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}
					 else{   
						 //otherwise, hide it
						$("#search-form .books-islam .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				//Hadith check boxes in search form
				$("#search-form #edit-hadith").click(function(){
					if ($("#search-form #edit-hadith").is(":checked")){
						$("#search-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});	
				
				$("#search-theme-form #edit-hadith").click(function(){
					if ($("#search-theme-form #edit-hadith").is(":checked")){
						$("#search-theme-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					} else{   
						 //otherwise, hide it
						$("#search-theme-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 $("#search-theme-form #edit-hadith-1").click(function(){
					if ($("#search-theme-form #edit-hadith-1").is(":checked")){
						$("#search-theme-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-theme-form .books-hadith .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				//Quran  check boxes 				
				$("#search-form #edit-quran").click(function(){
					if ($("#search-form #edit-quran").is(":checked")){
						$("#search-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					} else{   
						 //otherwise, hide it
						$("#search-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});	
				
				$("#search-theme-form #edit-quran").click(function(){
					if ($("#search-theme-form #edit-quran").is(":checked")){
						$("#search-theme-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					} else{   
						 //otherwise, hide it
						$("#search-theme-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 $("#search-theme-form #edit-quran-1").click(function(){
					if ($("#search-theme-form #edit-quran-1").is(":checked")){
						$("#search-theme-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-theme-form .books-quran .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 //For all biographies 				 
				 $("#search-form #edit-biographies").click(function(){
					if ($("#search-form #edit-biographies").is(":checked")){
						$("#search-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});	
				
				$("#search-theme-form #edit-biographies").click(function(){
					if ($("#search-theme-form #edit-biographies").is(":checked")){
						$("#search-theme-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					} else{   
						 //otherwise, hide it
						$("#search-theme-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 $("#search-theme-form #edit-biographies-1").click(function(){
					if ($("#search-theme-form #edit-biographies-1").is(":checked")){
						$("#search-theme-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-theme-form .books-biographies .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 //For all indexes
				 $("#search-form #edit-index").click(function(){
					if ($("#search-form #edit-index").is(":checked")){
						$("#search-form .books-index .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-form .books-index .form-checkboxes").find(':checkbox').attr('checked', false );
					}				
				});	
				
				$("#search-theme-form #edit-index").click(function(){
					if ($("#search-theme-form #edit-index").is(":checked")){
						$("#search-theme-form .books-index .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					}else{   
						 //otherwise, hide it
						$("#search-theme-form .books-index .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				 $("#search-theme-form #edit-index-1").click(function(){
					if ($("#search-theme-form #edit-index-1").is(":checked")){
						$("#search-theme-form .books-index .form-checkboxes").find(':checkbox').attr('checked', 'checked');
					} else{   
						 //otherwise, hide it
						$("#search-theme-form .books-index .form-checkboxes").find(':checkbox').attr('checked', false );
					}					
				});
				 
				
				// For all check box				
				$("#search-form #edit-all").click(function(){
  					
					if ($("#search-form #edit-all").is(":checked")){
						$("#search-form #edit-hadith").attr('checked', 'checked' );
						$("#search-form #edit-quran").attr('checked', 'checked' );
						$("#search-form #edit-article").attr('checked', 'checked' );
						$("#search-form #edit-fiqh").attr('checked', 'checked' );
						$("#search-form #edit-biographies").attr('checked', 'checked' );	
						$("#search-form #edit-islam").attr('checked', 'checked' );
						$("#search-form #edit-index").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-TLT").attr('checked', 'checked' );
						
						$("#search-form #edit-book-quran-ASD").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-MAL").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-PIK").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-YAT").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-QSI").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-AY").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-QS").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-QCC").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-AMH").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-HDQ").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-TIR").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-SHB").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-SAD").attr('checked', 'checked' );
						$("#search-form #edit-book-hadith-SHM").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-KAB").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-KUM").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-KUT").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-SOP").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-KAL").attr('checked', 'checked' );
						$("#search-form #edit-book-biographies-BIO").attr('checked', 'checked' );
						$("#search-form #edit-book-index-HS").attr('checked', 'checked' );
						$("#search-form #edit-book-fiqh-FIQ").attr('checked', 'checked' );
						$("#search-form #edit-book-islam-ART").attr('checked', 'checked' );
						

					}else{   
						 //otherwise, hide it
						$("#search-form #edit-hadith").attr('checked', false );
						$("#search-form #edit-quran").attr('checked', false );
						$("#search-form #edit-article").attr('checked', false );
						$("#search-form #edit-fiqh").attr('checked', false );
						$("#search-form #edit-biographies").attr('checked', false );
						$("#search-form #edit-islam").attr('checked', false );
						$("#search-form #edit-index").attr('checked', false );
						
						$("#search-form #edit-book-quran-TLT").attr('checked', false);
						$("#search-form #edit-book-quran-ASD").attr('checked', false );
						$("#search-form #edit-book-quran-MAL").attr('checked', false );
						$("#search-form #edit-book-quran-PIK").attr('checked', false );
						$("#search-form #edit-book-quran-YAT").attr('checked', false );
						$("#search-form #edit-book-quran-QSI").attr('checked', false );
						$("#search-form #edit-book-quran-AY").attr('checked', false );
						$("#search-form #edit-book-quran-QCC").attr('checked', false );
						$("#search-form #edit-book-hadith-AMH").attr('checked', false );
						$("#search-form #edit-book-hadith-HDQ").attr('checked', false );
						$("#search-form #edit-book-hadith-TIR").attr('checked', false );
						$("#search-form #edit-book-hadith-SHB").attr('checked', false );
						$("#search-form #edit-book-hadith-SAD").attr('checked', false );
						$("#search-form #edit-book-hadith-SHM").attr('checked', false );
						$("#search-form #edit-book-biographies-KAB").attr('checked', false );
						$("#search-form #edit-book-biographies-KUM").attr('checked', false );
						$("#search-form #edit-book-biographies-KUT").attr('checked', false );
						$("#search-form #edit-book-biographies-SOP").attr('checked', false );
						$("#search-form #edit-book-biographies-KAL").attr('checked', false );
						$("#search-form #edit-book-biographies-BIO").attr('checked', false );
						$("#search-form #edit-book-index-HS").attr('checked', false );
						$("#search-form #edit-book-quran-QS").attr('checked', false );
						$("#search-form #edit-book-fiqh-FIQ").attr('checked', false );
						$("#search-form #edit-book-islam-ART").attr('checked', false );
						
					}					
				});	
				
				$("#search-theme-form #edit-all").click(function(){
  					
					if ($("#search-theme-form #edit-all").is(":checked")){
						$("#search-theme-form #edit-hadith").attr('checked', 'checked' );
						$("#search-theme-form #edit-quran").attr('checked', 'checked' );
						$("#search-theme-form #edit-article").attr('checked', 'checked' );
						$("#search-theme-form #edit-fiqh").attr('checked', 'checked' );
						$("#search-theme-form #edit-biographies").attr('checked', 'checked' );	
						$("#search-theme-form #edit-islam").attr('checked', 'checked' );
						$("#search-theme-form #edit-index").attr('checked', 'checked' );
						$("#search-form #edit-book-quran-TLT").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-ASD").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-MAL").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-PIK").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-YAT").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QSI").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-AY").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QCC").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-AMH").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-HDQ").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-TIR").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SHB").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SAD").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SHM").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KAB").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KUM").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KUT").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-SOP").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KAL").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-BIO").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-index-HS").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QS").attr('checked', 'checked' );
						
					}else{   
						 //otherwise, hide it
						$("#search-theme-form #edit-hadith").attr('checked', false );
						$("#search-theme-form #edit-quran").attr('checked', false );
						$("#search-theme-form #edit-article").attr('checked', false );
						$("#search-theme-form #edit-fiqh").attr('checked', false );
						$("#search-theme-form #edit-biographies").attr('checked', false );
						$("#search-theme-form #edit-islam").attr('checked', false );
						$("#search-theme-form #edit-index").attr('checked', false );
						
						
							$("#search-form #edit-book-quran-TLT").attr('checked', false);
						$("#search-theme-form #edit-book-quran-ASD").attr('checked', false );
						$("#search-theme-form #edit-book-quran-MAL").attr('checked', false );
						$("#search-theme-form #edit-book-quran-PIK").attr('checked', false );
						$("#search-theme-form #edit-book-quran-YAT").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QSI").attr('checked', false );
						$("#search-theme-form #edit-book-quran-AY").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QCC").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-AMH").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-HDQ").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-TIR").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SHB").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SAD").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SHM").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KAB").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KUM").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KUT").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-SOP").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KAL").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-BIO").attr('checked', false );
						$("#search-theme-form #edit-book-index-HS").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QS").attr('checked', false );
						
					}					
				});	
				
				$("#search-theme-form #edit-all-1").click(function(){
  					
					if ($("#search-theme-form #edit-all-1").is(":checked")){
						$("#search-theme-form #edit-hadith-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-quran-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-article-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-fiqh-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-biographies-1").attr('checked', 'checked' );	
						$("#search-theme-form #edit-islam-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-index-1").attr('checked', 'checked' );
						
								$("#search-form #edit-book-quran-TLT").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-ASD-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-MAL-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-PIK-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-YAT-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QSI-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-AY-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QCC-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-AMH-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-HDQ-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-TIR-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SHB-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SAD-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-hadith-SHM-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KAB-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KUM-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KUT-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-SOP-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-KAL-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-biographies-BIO-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-index-HS-1").attr('checked', 'checked' );
						$("#search-theme-form #edit-book-quran-QS-1").attr('checked', 'checked' );

					} else{   
						 //otherwise, hide it
						$("#search-theme-form #edit-hadith-1").attr('checked', false );
						$("#search-theme-form #edit-quran-1").attr('checked', false );
						$("#search-theme-form #edit-article-1").attr('checked', false );
						$("#search-theme-form #edit-fiqh-1").attr('checked', false );
						$("#search-theme-form #edit-biographies-1").attr('checked', false );
						$("#search-theme-form #edit-islam-1").attr('checked', false );
						$("#search-theme-form #bedit-index-1").attr('checked', false );
		$("#search-theme-form #edit-book-quran-QS").attr('checked', false );
						$("#search-theme-form #edit-book-quran-ASD-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-MAL-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-PIK-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-YAT-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QSI-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-AY-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QCC-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-AMH-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-HDQ-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-TIR-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SHB-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SAD-1").attr('checked', false );
						$("#search-theme-form #edit-book-hadith-SHM-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KAB-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KUM-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KUT-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-SOP-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-KAL-1").attr('checked', false );
						$("#search-theme-form #edit-book-biographies-BIO-1").attr('checked', false );
						$("#search-theme-form #edit-book-index-HS-1").attr('checked', false );
						$("#search-theme-form #edit-book-quran-QS-1").attr('checked', false );						
					}
				});	
				
				$("#search-theme-form #edit-book-hadith-TIR,#search-theme-form #edit-book-hadith-SHB,#search-theme-form #edit-book-hadith-SAD,#search-theme-form #edit-book-hadith-HDQ,			#search-theme-form #edit-book-hadith-SHM,#search-theme-form #edit-book-hadith-AMH").click(function(){
						
					if ($("#search-theme-form #edit-book-hadith-TIR,#search-theme-form #edit-book-hadith-SHB,#search-theme-form #edit-book-hadith-SAD,#search-theme-form #edit-book-hadith-HDQ,#search-theme-form #edit-book-hadith-SHM,#search-theme-form #edit-book-hadith-AMH").is(":checked")){
						$("#search-theme-form #edit-hadith").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-hadith").attr('checked', false );
					}
				});	
				
				$("#search-theme-form #edit-book-quran-ASD,#search-theme-form #edit-book-quran-MAL,#search-theme-form #edit-book-quran-PIK,#search-theme-form #edit-book-quran-YAT,#search-theme-form #edit-book-quran-QSI,#search-theme-form #edit-book-quran-AY,#search-theme-form #edit-book-quran-QCC").click(function(){
						
					if ($("#search-theme-form #edit-book-quran-ASD,#search-theme-form #edit-book-quran-MAL,#search-theme-form #edit-book-quran-PIK,#search-theme-form #edit-book-quran-YAT,#search-theme-form #edit-book-quran-QSI,#search-theme-form #edit-book-quran-AY,#search-theme-form #edit-book-quran-QCC").is(":checked")){
						$("#search-theme-form #edit-quran").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-quran").attr('checked', false );
					}
				});
				
				
				
				$("#search-form #edit-book-hadith-TIR,#search-form #edit-book-hadith-SHB,#search-form #edit-book-hadith-SAD,#search-form #edit-book-hadith-HDQ,#search-form #edit-book-hadith-SHM,#search-form #edit-book-hadith-AMH").click(function(){
						
					if ($("#search-form #edit-book-hadith-TIR,#search-form #edit-book-hadith-SHB,#search-form #edit-book-hadith-SAD,#search-form #edit-book-hadith-HDQ,#search-form #edit-book-hadith-SHM,#search-form #edit-book-hadith-AMH").is(":checked")){
						$("#search-form #edit-hadith").attr('checked', 'checked' );
					}else{
						$("#search-form #edit-hadith").attr('checked', false );
					}
				});	
				
				$("#search-form #edit-book-quran-ASD,#search-form #edit-book-quran-TLT,#search-form #edit-book-quran-MAL,#search-form #edit-book-quran-PIK,#search-form #edit-book-quran-YAT,#search-form #edit-book-quran-QSI,#search-form #edit-book-quran-AY,#search-form #edit-book-quran-QCC,#search-form #edit-book-quran-QS").click(function(){
						
					if ($("#search-form #edit-book-quran-ASD,#search-form #edit-book-quran-TLT,#search-form #edit-book-quran-MAL,#search-form #edit-book-quran-PIK,#search-form #edit-book-quran-YAT,#search-form #edit-book-quran-QSI,#search-form #edit-book-quran-AY,#search-form #edit-book-quran-QCC,#search-form #edit-book-quran-QS").is(":checked")){
						$("#search-form #edit-quran").attr('checked', 'checked' );
					}else{
						$("#search-form #edit-quran").attr('checked', false );
					}
				});
				
				
				$("#search-theme-form #edit-book-hadith-TIR-1,#search-theme-form #edit-book-hadith-SHB-1,#search-theme-form #edit-book-hadith-SAD-1,#search-theme-form #edit-book-hadith-HDQ-1,#search-theme-form #edit-book-hadith-SHM-1,#search-theme-form #edit-book-hadith-AMH-1").click(function(){
						
					if ($("#search-theme-form #edit-book-hadith-TIR-1,#search-theme-form #edit-book-hadith-SHB-1,#search-theme-form #edit-book-hadith-SAD-1,#search-theme-form #edit-book-hadith-HDQ-1,#search-theme-form #edit-book-hadith-SHM-1,#search-theme-form #edit-book-hadith-AMH-1").is(":checked")){
						$("#search-theme-form #edit-hadith-1").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-hadith-1").attr('checked', false );
					}
				});	
				
				$("#search-theme-form #edit-book-quran-ASD-1,#search-theme-form #edit-book-quran-MAL-1,#search-theme-form #edit-book-quran-PIK-1,#search-theme-form #edit-book-quran-YAT-1,#search-theme-form #edit-book-quran-QSI-1,#search-theme-form #edit-book-quran-AY-1,#search-theme-form #edit-book-quran-QCC-1,#search-theme-form #edit-book-quran-QS-1").click(function(){
						
					if ($("#search-theme-form #edit-book-quran-ASD-1,#search-theme-form #edit-book-quran-MAL-1,#search-theme-form #edit-book-quran-PIK-1,#search-theme-form #edit-book-quran-YAT-1,#search-theme-form #edit-book-quran-QSI-1,#search-theme-form #edit-book-quran-AY-1,#search-theme-form #edit-book-quran-QCC-1,#search-theme-form #edit-book-quran-QS-1").is(":checked")){
						$("#search-theme-form #edit-quran-1").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-quran-1").attr('checked', false );
					}
				});
				
				
				$("#search-theme-form #edit-book-quran-QS,#search-theme-form #edit-book-quran-HS").click(function(){
						
					if ($("#search-theme-form #edit-book-quran-QS,#search-theme-form #edit-book-quran-HS").is(":checked")){
						$("#search-theme-form #edit-index").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-index").attr('checked', false );
					}
				});
				$("#search-theme-form #edit-book-quran-QS-1,#search-theme-form #edit-book-index-HS-1").click(function(){
						
					if ($("#search-theme-form #edit-book-quran-QS-1,#search-theme-form #edit-book-index-HS-1").is(":checked")){
						$("#search-theme-form #edit-index-1").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-index-1").attr('checked', false );
					}
				});
				$("#search-form #edit-book-quran-QS,#search-form #edit-book-index-HS").click(function(){
						
					if ($("#search-form #edit-book-quran-QS,#search-form #edit-book-index-HS").is(":checked")){
						$("#search-form #edit-index").attr('checked', 'checked' );
					}else{
						$("#search-form #edit-index").attr('checked', false );
					}
				});
				
				//////////////Biographies
				$("#search-theme-form #edit-book-biographies-KAB,#search-theme-form #edit-book-biographies-KUM,#search-theme-form #edit-book-biographies-KUT,#search-theme-form #edit-book-biographies-KAL,#search-theme-form #edit-book-biographies-SOP,#search-theme-form #edit-book-biographies-BIO").click(function(){
						
					if ($("#search-theme-form #edit-book-biographies-KAB,#search-theme-form #edit-book-biographies-KUM,#search-theme-form #edit-book-biographies-KUT,#search-theme-form #edit-book-biographies-KAL,#search-theme-form #edit-book-biographies-SOP,#search-theme-form #edit-book-biographies-BIO").is(":checked")){
						$("#search-theme-form #edit-biographies").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-biographies").attr('checked', false );
					}
				});
				$("#search-theme-form #edit-book-biographies-KAB-1,#search-theme-form #edit-book-biographies-KUM-1,#search-theme-form #edit-book-biographies-KUT-1,#search-theme-form #edit-book-biographies-KAL-1,#search-theme-form #edit-book-biographies-SOP-1,#search-theme-form #edit-book-biographies-BIO-1").click(function(){
						
					if ($("#search-theme-form #edit-book-biographies-KAB-1,#search-theme-form #edit-book-biographies-KUM-1,#search-theme-form #edit-book-biographies-KUT-1,#search-theme-form #edit-book-biographies-KAL-1,#search-theme-form #edit-book-biographies-SOP-1,#search-theme-form #edit-book-biographies-BIO-1").is(":checked")){
						$("#search-theme-form #edit-biographies-1").attr('checked', 'checked' );
					}else{
						$("#search-theme-form #edit-biographies-1").attr('checked', false );
					}
				});
				$("#search-form #edit-book-biographies-KAB,#search-form #edit-book-biographies-KUM,#search-form  #edit-book-biographies-KUT,#search-form #edit-book-biographies-KAL,#search-form  #edit-book-biographies-SOP,#search-form  #edit-book-biographies-BIO").click(function(){
						
					if ($("#search-form #edit-book-biographies-KAB,#search-form #edit-book-biographies-KUM,#search-form  #edit-book-biographies-KUT,#search-form  #edit-book-biographies-KAL,#search-form  #edit-book-biographies-SOP,#search-form  #edit-book-biographies-BIO").is(":checked")){
						$("#search-form #edit-biographies").attr('checked', 'checked' );
					}else{
						$("#search-form #edit-biographies").attr('checked', false );
					}
				});
		
		 });
		
			
////////////////Shorten bread crumb

function shortenBreadcrumb(options){
    /*
        Shortens the breadcrumb to a specified width by removing the text from one list item
        at a time and replacing it with "..." - accepts an options object as an optional
        parameter with two options:
            shortenBreadcrumb({
                breadcrumb : $('div#breadcrumb > ul'),
                maxWidth : 725
            });

        The first is the selector for the breadcrumb ul, the second is the maximum width you
        want it to be.
    */

    var breadcrumb = $('div#breadcrumb > ul');
    var maxWidth = $('div#breadcrumb').innerWidth();

    if (options != undefined){
        if (options.breadcrumb != null) { breadcrumb = options.breadcrumb; }
        if (options.maxWidth != null) { maxWidth = options.maxWidth; }
    }

    var levelCount = breadcrumb.find('li').size();
    var shortEnough = false;
    var totalWidth;
    while (shortEnough == false) {
        totalWidth = 0;
        breadcrumb.children('li').each (function(){
            totalWidth += $(this).outerWidth(true);
        });
        if (totalWidth > maxWidth){
            var li = breadcrumb.children('li').not('.short').eq(1);
            li.addClass('short');
            li.children('a').attr('title', li.children('a').html());
            li.children('a').html('...');
        }
        else {
            shortEnough = true;
        }
    }
}



$(document).ready(function(){
    shortenBreadcrumb({
        breadcrumb : $('#breadcrumb ul'),
        maxWidth : 625
    });
});
