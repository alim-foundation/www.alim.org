var str1=0
var str=0
var strs=0
var format=0;
var ready_copy=5;
var test=5;
var ready_copppy=1;
$(document).ready(function(){
$("#surah").change(function ()
	{
		$("#surah option:selected").each(function () 
		{
			str1 = $(this).val();
			if(str1!=0)
			strs=str1;
			//alert(strs);
		});
		$("#ayah_no option:selected").each(function () 
		{
			str1 = $(this).val();
			if(str1!=0)
			str=str1;
		 
		
			/*document.getElementById("text-to-copy").innerHTML = $.ajax({
					type: "POST",
					url: "clipboard/copys?val="str2+"_"+str3,
					global: false,
					dataType: "html",
					async:false,
					}).responseText;*/
			
		//	$.get( url , null);
		  //alert(str);
		//$("#text-to-copy").val('test');
		var xhr ;
		var t = '';
		$('.copy-from').val(str);
		$('.copy-to').val(str);
		ready_copy=0;
		//var format= $('input:radio[name=format]:checked').val();
	    format = getCookiesort('anonymformat');

		t = "clipboard/copys?surah="+str+"&ayah="+strs+'&js=1'+"&format="+format;
		$(".loading").show();
		ready_copy=0;
	    test=0;
		xhr = $.ajax({         
			url: t,
			dataType: 'json' ,
			success: function(data) {  	
			
			$('#text-to-copy').text(data.data);
			$('.surah_name').html(data.surah_name); 
			$(".loading").hide();
			ready_copy=1;
		 test=1;
			
 
			}       
		});
		
		});
	
	})
$("#ayah_no").change(function ()
	{
		
		$("#ayah_no option:selected").each(function () 
		{
			str1 = $(this).val();
			if(str1!=0)
			str=str1;
		 
		
			/*document.getElementById("text-to-copy").innerHTML = $.ajax({
					type: "POST",
					url: "clipboard/copys?val="str2+"_"+str3,
					global: false,
					dataType: "html",
					async:false,
					}).responseText;*/
			
		//	$.get( url , null);
		//  alert(str);
		//$("#text-to-copy").val()="test";
		var xhr ;
		var t = '';
		$('.copy-from').val(str);
		$('.copy-to').val(str);
		ready_copy=0;test=1;
       // var format= $('input:radio[name=format]:checked').val();
	format = getCookiesort('anonymformat');

		t = "clipboard/copys?surah="+str+"&ayah="+strs+'&js=1'+"&format="+format;		
		$(".loading").show();
		ready_copy=0;
test=0;
		xhr = $.ajax({         
			url: t,
			dataType: 'json' ,
			success: function(data) {  			
			$('#text-to-copy').text(data.data);
			$('.surah_name').html(data.surah_name); 
		    $(".loading").hide();
			ready_copy=1;
			test=1;
	 
 
			}       
		});
		
		});
	

	});


$('.copy_range .copy-to').keyup(function(e)  {
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
//var format= $('input:radio[name=format]:checked').val();

	format = getCookiesort('anonymformat');
  
	var ayahend=$('.copy-to').val();
    var ayahstart=$('.copy-from').val();
	
	Surahstart=strs;
	if((keycode!=46 && keycode!=8)&&(!ayahstart || (isNaN(ayahend)) ||(parseInt(ayah[Surahstart])<parseInt(ayahstart) || parseInt(ayahstart)<=0)))
	{ayahend=str;ayahstart=str;}
	$('.copy-from').val(ayahstart);
	$('.copy-to').val(ayahend);
     if(parseInt(ayahstart) >parseInt(ayahend))
	  setTimeout(function(){
						  
						  if(parseInt(ayahstart) > parseInt(ayahend)){
						  $('.copy-to').val(ayahstart);}}, 2000);
	
		// alert('test');

	// $('.copy-to').val(ayahstart);
	
	 ayahend=ayahstart;

	
	var ayahend=$('.copy-to').val();
    var ayahstart=$('.copy-from').val();
	
	Surahstart=strs;
	if((keycode!=46 && keycode!=8 ) && IsNumeric(ayahstart)==true || IsNumeric(ayahend)==true)
	{	
	
       var t = "clipboard/copys?surahstrt="+Surahstart+"&ayahstart="+ayahstart+"&ayahend="+ayahend+"&format="+format+"&js=1";
       $(".loading").show();
	   ready_copppy=0; test=0;
		xhr = $.ajax({         
			url: t,
			dataType: 'json' ,
			success: function(data) {  			
			$('#text-to-copy').text(data.data);
			$('.surah_name').html(data.surah_name); 
		    $(".loading").hide();
			ready_copppy=1;test=1;
	 
			 
			}       
		});
	}
	else
	ready_copppy=0;


});
$('.copy_range .copy-from').keyup(function(e)  {
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
//var format= $('input:radio[name=format]:checked').val();

	format = getCookiesort('anonymformat');
    
	var ayahend=$('.copy-to').val();
    var ayahstart=$('.copy-from').val();
	
	Surahstart=strs;
	if((keycode!=46 && keycode!=8)&&(!ayahstart || (isNaN(ayahstart)) ||(parseInt(ayah[Surahstart])<parseInt(ayahstart) || parseInt(ayahstart)<=0)))
	{ayahend=str;ayahstart=str;}
	$('.copy-from').val(ayahstart);
	$('.copy-to').val(ayahend);
     if(parseInt(ayahstart) >parseInt(ayahend))
	 $('.copy-to').val(ayahstart);
	 ayahend=ayahstart;

	
	var ayahend=$('.copy-to').val();
    var ayahstart=$('.copy-from').val();
	
	Surahstart=strs;
	if((keycode!=46 && keycode!=8 ) && IsNumeric(ayahstart)==true || IsNumeric(ayahend)==true)
	{	
	
       var t = "clipboard/copys?surahstrt="+Surahstart+"&ayahstart="+ayahstart+"&ayahend="+ayahend+"&format="+format+"&js=1";
       $(".loading").show();
	  ready_copppy=0;test=0;
		xhr = $.ajax({         
			url: t,
			dataType: 'json' ,
			success: function(data) {  			
			$('#text-to-copy').text(data.data);
			$('.surah_name').html(data.surah_name); 
		    $(".loading").hide();
			ready_copppy=1;test=1;
	 
			 
			}       
		});
	}
	else
	ready_copppy=0;

});

$('input[name=format]:radio').click(function()
{
    var formatz= $('input:radio[name=format]:checked').val();
	setCookiesort('anonymformat',formatz,''); 
	format = getCookiesort('anonymformat');
	var ayahend=$('.copy-to').val();
    var ayahstart=$('.copy-from').val();
	Surahstart=strs;


			var t = "clipboard/copys?surahstrt="+Surahstart+"&ayahstart="+ayahstart+"&ayahend="+ayahend+"&format="+format+"&js=1"+"&frmat=1";
			$(".loading").show();
			ready_copppy=0;test=0;
			xhr = $.ajax({         
				url: t,
				dataType: 'json' ,
				success: function(data) {  			
				$('#text-to-copy').text(data.data);
				$('.surah_name').html(data.surah_name); 
				$(".loading").hide();
				ready_copppy=1;test=1;
		 
				 
				}       
			});	
	});





 
});

function getCookiesort(c_name)
{
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1)
		{
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return "";
}

function setCookiesort(c_name,value,expiredays)
{
	//alert('ffff'+value)
	var exdate=new Date();
	//exdate.setDate(exdate.getDate()+expiredays);
	exdate.setTime(exdate.getTime()+(1000*60*60*1440));
	//document.cookie=c_name+ "=" +escape(value)+
	//((expiredays==null) ? "" : ";expires="+exdate.toGMTString())";path="/;*/
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : "; expires="+exdate.toGMTString()+" ;path=/");
}