/*--------------------- Common  ----------------------*/
function SpecGetXmlHttpObject()
            {
                var request =false;
                // looking for native XML HttpRequest object
                if (window.XMLHttpRequest)
                {
                	try
                    {
                        //alert('mozilla');
                		request = new XMLHttpRequest();
                	}
                	catch(e)
                    {
                        request = false;
                    }
                }
                // looking for IE/Windows ActiveX
                else if (window.ActiveXObject)
                {
                    try
                    {
                        //alert('ie one');
                    	request = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch(e)
                    {
                    	try
                        {
                          //  alert('ie two');
                    		request =new ActiveXObject("Microsoft.XMLHTTP")
                        }
                        catch(e)
                        {
                            request = false;
                        }
                    }
                }
                return request;
            }
/*--------------------- End Common  ----------------------------*/
/*--------------------- Functions 1 	--------------------------------*/
function get_Select1(url)
{

     xmlHttp = SpecGetXmlHttpObject();
                if (xmlHttp==null){
                     alert ("Browser does not support HTTP Request");
                     return;
                }
	  var id = document.getElementById('surano').value;
	  var url=url+"?m=1&id="+id+"&sid="+Math.random();
	   // alert(url);
	   xmlHttp.onreadystatechange=stateChanged1;
	   xmlHttp.open("GET",url,true) ;
	   xmlHttp.send(null);
}

function stateChanged1()
{                    
 
   	
/*----------------------- Loder Image 	------------------------*/

	  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	   {     
			//alert(xmlHttp.responseText);
			if(xmlHttp.status==200)
			{
				  //document.getElementById("ajax_div1").innerHTML=xmlHttp.responseText;
				  document.getElementById("txt_page").value=xmlHttp.responseText;
				  
			}
			
	   }
	   else {
			   //alert(xmlHttp.status);
	   }
 
  
}
