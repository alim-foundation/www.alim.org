jQuery(document).ready(function() {     	
					jQuery("body").find("#node-form .clip-format").hide();
					});
					;
					
					
$(document).bind("popups_open_path_done", function() {  	
					jQuery("#popups").find("#node-form .clip-format").hide();
					});
					;
					
					
					
jQuery(document).ready(function() {
			
					jQuery("#dialog").dialog({ 
						autoOpen: false , 
						disabled: true , 
						position: [50,400] ,
						zIndex: 2,
						width: 325,
						height: 220
					});
			
					jQuery("a#clip-btn-sel").click(function() { //alert("Hello ... ");
						 jQuery("#dialog").dialog("open") ;
						  var clips = jQuery("div#clip-sel-content").html(); //alert(sel);
						  jQuery("div#clip-sel-content").html(clips+"<p>"+userselected+"</p>");
						 
						 return false;
					});
			
					jQuery("#btn-clip-clear").click(function() {
						jQuery("div#clip-sel-content").html("") ;
						jQuery("div#ori-clips").html("") ;
						return false;
					});
					jQuery("a#clip-btn-all").click(function() {
						 var t11 = jQuery("div#clip-all-content").html(); 
						jQuery("div#ori-clips").html(t11);
						//return false;
					});
					jQuery("#dialog a#btn-clip-save").click(function() {
						var temp = jQuery("div#clip-sel-content").html(); 
						 jQuery("div#ori-clips").html(temp);
					});					
					
					var sel = "";
					var userselected = "";
					jQuery("#con_div_middle").mouseup(function(e) {
						sel = getSelectedText();	
						userselected = sel;
						if(sel != " "  ){
							//alert("..."+sel+"..."); 
							if(!jQuery("#dialog").dialog( "isOpen" ) ){
								//jQuery("#dialog").dialog("open") ;
							}else{
							var position = jQuery( "#dialog" ).dialog( "option", "position" );
							//alert("alresdy open"+position);
							//jQuery( "#dialog" ).dialog( "option", "position", [50,450] );
							}
							
						}
					});
			
					jQuery("#dialog #btn-clip-add-sel").click(function(evt) {
						 var clips = jQuery("div#clip-sel-content").html(); //alert(sel);
						 jQuery("div#clip-sel-content").html(clips+"<p>"+sel+"</p>");
						 evt.preventDefault(); 
					});			
			
			
					window.onbeforeunload = goodbye;			
			
			});
			
			
function getSelectedText() { //alert('in fun ');
						if (window.getSelection) { 
							return window.getSelection()+' '; 
						} 
						else if (document.selection) { 
							return document.selection.createRange().text+' '; 
						} 
						return ' '; 
					}
					
					
					


			
			
			
			function goodbye(e) {
			if(!e) e = window.event;
			//e.cancelBubble is supported by IE - this will kill the bubbling process.
			
			var c = jQuery("div#clip-sel-content").html();
			if(c != "" ){
				e.cancelBubble = true;
				e.returnValue = "You have added some clips from this page .\n if you leave this page your clips will lose.\n Click on cancel and save the clips to notebook. "; 
				//This is displayed on the dialog
			
			
				//e.stopPropagation works in Firefox.
				if (e.stopPropagation) {
					e.stopPropagation();
					e.preventDefault();
					
					if(!jQuery("#dialog").dialog( "isOpen" ) ){ //alert("Now open .. .. .. .. .. .. .. .. .. .. ");
						jQuery("#dialog").dialog("open") ;
					}else{
						var position = jQuery( "#dialog" ).dialog( "option", "position" );
						//alert("alresdy open"+position);
						jQuery( "#dialog" ).dialog( "option", "position", [50,400] );
					}	
				}
			}			
			}																		