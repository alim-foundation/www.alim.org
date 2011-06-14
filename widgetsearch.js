function go_ok()
{
  var search_box = document.getElementById('alim_serachbox').value;
  window.location = "http://alim.org/alimsearch/node/"+search_box;
}

function onEnter(){

document.onkeyup = KeyCheck;  
}

function KeyCheck(e){
 var KeyID = (window.event) ? event.keyCode : e.keyCode;
 
if (KeyID == 13)
go_ok();
}



document.write("<style type=\"text/css\">#alim_widget{background:url('http://alim.org/widgets/alimsearch.png') top left no-repeat #FFFFFF; width:300px;height:250px;}#alim_serachboxdiv{padding-top:74px;padding-left:58px;}#alim_serachbuttondiv{padding-top:10px;padding-left:110px;}#alim_serachbox{background:#C06D00;border:0px;outline:0px;width:183px;height:25px;}#alim_button{height:25px;width:81px;border:0px;outline:0px;background:none;cursor:pointer;text-indent:-99999px;line-height:0px;}</style><div id=\"alim_widget\"><div id=\"alim_serachboxdiv\"><input name=\"alim_serachbox\" type=\"text\" id=\"alim_serachbox\" onKeyDown=\"onEnter()\"></div><div id=\"alim_serachbuttondiv\"> <input name=\"alim_button\" id=\"alim_button\" type=\"button\" onClick=\"go_ok()\" value=\"Search\"></div></div>");