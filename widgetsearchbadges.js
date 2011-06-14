function go_ok()
{
  var search_box = document.getElementById('alim_serachbox2').value;
  window.location = "http://alim.org/search/node/"+search_box;
}

function onEnter(){

document.onkeyup = KeyCheck;  
}

function KeyCheck(e){
 var KeyID = (window.event) ? event.keyCode : e.keyCode;
 
if (KeyID == 13)
go_ok();
}



document.write("<style type=\"text/css\">#alim_widget1{background:url('http://alim.org/widgets/badge.png') top left no-repeat #FFFFFF; width:300px;height:250px;}#alim_serachboxdiv{padding-top:74px;padding-left:58px;}#alim_serachbuttondiv{padding-top:10px;padding-left:110px;}#alim_serachbox2{background:#C06D00;border:0px;outline:0px;width:183px;height:25px;}#alim_button2{height:25px;width:81px;border:0px;outline:0px;background:none;cursor:pointer;text-indent:-99999px;line-height:0px;}</style><div id=\"alim_widget1\"><div id=\"alim_serachboxdiv\"><input name=\"alim_serachbox2\" type=\"text\" id=\"alim_serachbox2\" onKeyDown=\"onEnter()\"></div><div id=\"alim_serachbuttondiv\"> <input name=\"alim_button2\" id=\"alim_button2\" type=\"button\" onClick=\"go_ok()\" value=\"Search\"></div></div>");