// $Id$


Drupal.behaviors.dynamic_products = function (context) { 

   $("a#show-book-menu" , context ).click(function () { //alert('bm bm');
			 // var h1  = $("#dialog-bookmark #mymenu-show").height(); 	alert(h1);
	  if ($('a#show-book-menu').is('.mymenu-processed')) {
		//alert('bm if');
		} else { //alert('bm else');
					// This function will get exceuted after the ajax request is completed successfully
					 var showmymenu = function(data) {
					  // The data parameter is a JSON object. The products property is the list of products items that was returned from the server response to the ajax request.
					 $('div#bm-nice-menu').html(data.mybookmarkmenu);
					 $("a#show-book-menu").addClass('mymenu-processed');
					//alert('height == '+h);
					var p = $("#popup-bookmark  #dialog-mymenu");
					var offset = p.offset();
					//alert( "left: " + offset.left + ", top: " + offset.top +"  -----");
					 $("div#bm-nice-menu").css({ position: "absolute",    marginLeft: 0, marginTop: 0, top: offset.top+2, right: 268 });
										 
					}
					$.ajax({
					  type: 'POST',
					  url: '/boomarks/mybookamrks/mine', // Which url should be handle the ajax request. This is the url defined in the <a> html tag
					  success: showmymenu, // The js function that will be called upon success request
					  dataType: 'json' //define the type of data that is going to get back from the server
						 //Pass a key/value pair
					});
					
					
					return false;  // return false so the navigation stops here and not continue to the page in the link
		}

		});
	 
	 
	/*  var bm_hide = false; 
     $("a#dialog-mymenu , #bm-nice-menu").hover(function(){ 
         if (bm_hide) clearTimeout(bm_hide); 
		 var p = $("#popup-bookmark  #dialog-mymenu");
		var offset = p.offset();
		$("div#bm-nice-menu").css({ position: "absolute",    marginLeft: 0, marginTop: 0, top: offset.top+2, right: 268 });
         $("#bm-nice-menu").fadeIn(); 
     }, function() { 
         bm_hide = setTimeout(function() { 
             $("#bm-nice-menu").fadeOut("slow"); 
         }, 10); 
     });*/
	 
	 
	 $("a#dialog-mymenu").click(function(ev){ 
    	var p = $("#popup-bookmark  #dialog-mymenu");
		var offset = p.offset();
										  $("#bookmark-right-menu  a#dialog-mymenu").addClass("menu-open");
			$("div#bm-nice-menu").css({ position: "absolute",    marginLeft: 0, marginTop: 0, top: offset.top+2, right: 268 });
         $("#bm-nice-menu").fadeIn();
			ev.preventDefault();											  
	  });
	 
	 
	 
	   $("a#dialog-mymenu").click(function(ev){ 
			//$("a#dialog-mymenu").hover();
			ev.preventDefault();											  
	  });
	
	

	  //Ajax calling to set last bookmark page
	  $("a.bm-last" , context ).click(function () {

			 // var h1  = $("#dialog-bookmark #mymenu-show").height(); 	alert(h1);
			    if ($('a.bm-last').is('.bm-last-processed')) {
						
						return false;
				} else {
						 $('span#mark-lastpage').html('<em style="font-size:11px;" >Loading ...</em>');	
							// This function will get exceuted after the ajax request is completed successfully
							 var setlastpage = function(data) { 
							 //alert('two ...');
							 //alert(data.lastpagerespose);
							  // The data parameter is a JSON object. The products property is the list of products items that was returned from the server response to the ajax request.
							 $('span#mark-lastpage').html(data.lastpagerespose);	
							  $("a.bm-last").addClass('bm-last-processed');
							  $("a.bm-last").attr('href', '#');						  

							 
							}
							var params = {}; 
							$.ajax({
							  type: 'POST',
							  url: this.href, // Which url should be handle the ajax request. This is the url defined in the <a> html tag
							  success: setlastpage, // The js function that will be called upon success request
							  data: params,
							  dataType: 'json' //define the type of data that is going to get back from the server
								 //Pass a key/value pair
							});
							
							
							return false;  // return false so the navigation stops here and not continue to the page in the link
				}

	}); 
	  
	  
	  
	  
	  
	  
	  
	/***************BM*******/  
				//Bookmarks
			//$("#popup-bookmark").hide();
			
			
			$('#popups #popups-close a').click(function(e) { //alert("Hello ... ");
							$("a#dialog-mymenu").addClass('mymenu-processed');
			});		
			
			//MY BOOKMARK MENU DIALOGUE			
					jQuery("#dialog-bookmark").dialog({ 
						autoOpen: false , 
						disabled: true , 
						height : 'auto',
						position: 'center' ,
						zIndex: 2,
						width: 400
						
					});			
			
					$("#popup-bookmark #dialog-mymenu").click(function(e) { //alert("Hello ... ");
						e.preventDefault();
						$("#mymenu-show div").css('display' , 'block' );
						 jQuery("#dialog-bookmark").dialog("open") ;
						 return false;
					});		
			
			
		    $("#bookmark-right-menu  #show-book-menu ").click(function(e) {   // alert('one');      
				e.preventDefault();
                $("#popup-bookmark").fadeIn("slow" , function(){
																   //alert('two..');
																   } );
				$("#popup-bookmark").css('display' , 'block');
				$("#bookmark-right-menu  #show-book-menu").toggleClass("menu-open"); 
				var p = $("#bookmark-right-menu  #show-book-menu");
				var offset = p.offset();
				//alert( "left: " + offset.left + ", top: " + offset.top +"  -----");
				 $("#popup-bookmark").css({ position: "absolute", marginLeft: 0, marginTop: 0, top: offset.top+6, right: 40 });				
				
            });
			$("#bookmark-right-menu  #show-clip-menu").click(function(e) {          
				e.preventDefault();
                $("#popup-clip-menu").fadeIn("slow");
			   
				 $("#bookmark-right-menu  #show-clip-menu").toggleClass("menu-open"); 
				 
				var p = $("#bookmark-right-menu  #show-clip-menu");
				var offset = p.offset();
				//alert( "left: " + offset.left + ", top: " + offset.top +"  -----");
				 $("#popup-clip-menu").css({ position: "absolute",  marginLeft: 0, marginTop: 0, top: offset.top+6, right: 40 });	
				
            });
						
						
			 $("#popup-bookmark a:not(.bm-last , #dialog-mymenu )").click(function(e) {          
				$("#popup-bookmark").hide('slow');
            });
			
			$("#popup-bookmark , #popup-clip-menu").mouseup(function() {
				return false;
			});
  
}
