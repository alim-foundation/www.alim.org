<?php
// $Id: views-view-table.tpl.php,v 1.8 2009/01/28 00:43:43 merlinofchaos Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 */
 
 // For creating image map for calligraphy page.
   global $base_url;
    $_SESSION['prev_x']=36;
	 $_SESSION['prev_bottom'] = 4;
	   	$_SESSION['top']=0;
	 $_SESSION['bottom']=46;
	$prev_x=40;
  
?>
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php //print $title; ?></caption>
  <?php endif; ?>
  <thead>
    <tr>
      <?php foreach ($header as $field => $label): ?>
        <th class="views-field views-field-<?php print $fields[$field]; ?>">
          <?php //print $label; ?>
        </th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <?php foreach ($row as $field => $content): ?>
          <td class="views-field views-field-<?php print $fields[$field]; ?>">
		  <script language="javascript">
		  function go_tourl(url)
		  {
		    window.location=url;
		  }
		  var linearray = new Array();
		  var zx ="";
		  var  Surah_end;
		  var  Ayah_end;

		  </script>
		
		  <?php
		  
		  if(!arg(5)) // if page no not present
		  {
		  

		   $val_exp = explode("-",arg(4));
		   $surh_no = $val_exp[0];
		   $pag_no = $val_exp[1];
		   
		    // Generate the page number form the surah no & page no.
		      $query12 = db_query("SELECT node.nid AS nid,
   node.title AS node_title,
   node_data_field_page_no.field_page_no_value AS node_data_field_page_no_field_page_no_value,
   node.type AS node_type,
   node.vid AS node_vid,
   node_data_field_surah_no.field_surah_no_value AS node_data_field_surah_no_field_surah_no_value,
   node_data_field_ayah_no.field_ayah_no_value AS node_data_field_ayah_no_field_ayah_no_value
 FROM node node 
 LEFT JOIN content_type_quran_arabic_page node_data_field_page_no ON node.vid = node_data_field_page_no.vid
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 LEFT JOIN content_field_ayah_no node_data_field_ayah_no ON node.vid = node_data_field_ayah_no.vid
 WHERE (node.type in ('quran_arabic_page')) AND (node_data_field_page_no.field_page_no_value = ".$pag_no.") AND (node_data_field_surah_no.field_surah_no_value = ".$surh_no.") ORDER BY node_data_field_surah_no.field_surah_no_value ASC, node_data_field_ayah_no_field_ayah_no_value ASC, node_data_field_page_no_field_page_no_value ASC LIMIT 1");
 
              $result12 = db_fetch_object($query12);
			  
			  if($result12->node_data_field_page_no_field_page_no_value!="")
			  {
			    header("location:".$base_url."/library/quran/page/arabic/".$surh_no."/".$pag_no."/".$result12->node_data_field_ayah_no_field_ayah_no_value); // if page no present assign to variable.
			  }
			  else
			  {
   
		   	  // Generate the page number form the surah no.
		   $query11 = db_query("SELECT node.nid AS nid,
   node_data_field_page_no.field_page_no_value AS node_data_field_page_no_field_page_no_value,
   node.type AS node_type,
   node.vid AS node_vid
 FROM node node 
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 LEFT JOIN content_type_quran_arabic_page node_data_field_page_no ON node.vid = node_data_field_page_no.vid
 WHERE (node.type in ('quran_arabic_page')) AND (node_data_field_surah_no.field_surah_no_value = ".$surh_no.")
   ORDER BY node_data_field_page_no_field_page_no_value ASC");
   
          	$result11= db_fetch_object($query11);
			header("location:".$base_url."/library/quran/page/arabic/".$surh_no."/".$result11->node_data_field_page_no_field_page_no_value); // if page no present assign to variable.
			
			}
		  
		
			
		  }
		  else
		  {
		    $qupage = arg(5); // if page no present assign to variable.
		  }
	

// Function used for calculating the co-ordinates for image maps.
function get_Coordinates1($x,$y)
{
	$image_width 	 = 456;
	$sura_name_box_height = 115;
	$line_height	 = 45;
	$min_line_height = 25;
		
       if ($y > 0)
	   {
              $top = $y - 7;
              $bottom = $y + 37;
	   }
	   else
	   {
              $top = 0;
              $bottom = 0;
	    }
			 
		if ($x < $image_width)
	    {
	 
        $left = $x +17;
        $right = $x + 17;
		if($_SESSION['prev_x']<40)
		{
			 $right =451;
		}
	
		else if($_SESSION['prev_x']>40 && $_SESSION['lines']>0.9)
		{
		$right =451;
		}
		else if($left>440)
		{
		$left=10;
		$right=$_SESSION['prev_x']+2;
		$top= $_SESSION['top'];
		 $bottom= $_SESSION['bottom'];
		}
		else
		{   
			
			$right=$_SESSION['prev_x']+2;
		}
	  }
      else
	  {
         $left = $image_width ;
         $right = $image_width ;
	   }

		$coordinate = array();
		$coordinate['left']		=	$left;
		$coordinate['top']		=	$top;
		$coordinate['right']	=	$right;
		$coordinate['bottom']	=	$bottom;
		
		return $coordinate;
         
}
function map_data1($ayah,$x_start,$x_end,$y_start,$y_end)
{
			$image_width 	 = 456;
			$line_height	 = 45;
			$min_line_height = 25;
			$sura_name_box_height = 115;
			$endRect = get_Coordinates1($x_end, $y_end);
			$rec = array();
			$rec['left']	=	$endRect['left'];
			$rec['top']		=	$endRect['top'];
			$rec['right']	=	$endRect['right'];
			$rec['bottom']	=	$endRect['bottom'];
			

			return $rec;
}
function get_Coordinates($x,$y)
{
	$image_width 	 = 456;
	$sura_name_box_height = 115;
	$line_height	 = 45;
	$min_line_height = 25;
	 if ($x < $image_width)
	 {
	 
        $left = $x - 17;
        $right = $x + 17;
	  }
      else
	  {
         $left = $image_width ;
         $right = $image_width ;
	   }
       if ($y > 0)
	   {
              $top = $y - 7;
              $bottom = $y + 37;
	   }
	   else
	   {
              $top = 0;
              $bottom = 0;
	    }
		$coordinate = array();
		$coordinate['left']		=	$left;
		$coordinate['top']		=	$top;
		$coordinate['right']	=	$right;
		$coordinate['bottom']	=	$bottom;
		$_SESSION['prev_x'] = $left;
	     $_SESSION['top'] = $top;
		
		$_SESSION['bottom']=	$bottom;
		
		return $coordinate;
        
}

function map_data($ayah,$x_start,$x_end,$y_start,$y_end)
{
			$image_width 	 = 456;
			$line_height	 = 45;
			$min_line_height = 25;
			$sura_name_box_height = 115;
			$endRect = get_Coordinates($x_end, $y_end);
			$rec = array();
			$rec['left']	=	$endRect['left'];
			$rec['top']		=	$endRect['top'];
			$rec['right']	=	$endRect['right'];
			$rec['bottom']	=	$endRect['bottom'];
			return $rec;
}


$arrline = array();

print "<map name='ayahs' id='ayahs'>";
$xx="ayahid";
$id_no=0; 
$query15 = db_query("SELECT node.nid AS nid,
   node_data_field_ayah_no.field_ayah_no_value AS node_data_field_ayah_no_field_ayah_no_value,
   node.type AS node_type,
   node.vid AS node_vid,
   node_data_field_page_no.field_xpos_start_value AS node_data_field_page_no_field_xpos_start_value,
   node_data_field_page_no.field_xpos_end_value AS node_data_field_page_no_field_xpos_end_value,
   node_data_field_page_no.field_ypos_start_value AS node_data_field_page_no_field_ypos_start_value,
   node_data_field_page_no.field_ypos_end_value AS node_data_field_page_no_field_ypos_end_value,
   node_data_field_surah_no.field_surah_no_value AS node_data_field_surah_no_field_surah_no_value
 FROM node node 
 LEFT JOIN content_type_quran_arabic_page node_data_field_page_no ON node.vid = node_data_field_page_no.vid
 LEFT JOIN content_field_ayah_no node_data_field_ayah_no ON node.vid = node_data_field_ayah_no.vid
 LEFT JOIN content_field_surah_no node_data_field_surah_no ON node.vid = node_data_field_surah_no.vid
 WHERE (node.type in ('quran_arabic_page')) AND (node_data_field_page_no.field_page_no_value = ".$qupage.")
 ORDER BY node_data_field_surah_no.field_surah_no_value ASC,node_data_field_ayah_no_field_ayah_no_value ASC");
   $surano=0;
   $item=0;
  while( $result15= db_fetch_object($query15))
  {
	   $ayah_no = $result15->node_data_field_ayah_no_field_ayah_no_value;
	   $surah_no = $result15->node_data_field_surah_no_field_surah_no_value;
	   $x_start = $result15->node_data_field_page_no_field_xpos_start_value;
	   $x_end   = $result15->node_data_field_page_no_field_xpos_end_value;
	   $y_start = $result15->node_data_field_page_no_field_ypos_start_value;
	   $y_end   = $result15->node_data_field_page_no_field_ypos_end_value;
 		
		
		if($ayah_no==1 && $surah_no!=1 && $surah_no!=9)
			$item=$item+1;
	 
	   if($surah_no<10)
	   	$sur="00".$surah_no;
		else if($surah_no>=10 && $surah_no<100)
		$sur="0".$surah_no;
		else
		$sur=$surah_no;
		
		  ?>
	   <script>
	     Surah_end ="<?= $surah_no ?>";
	     Ayah_end ="<?= $ayah_no ?>";
	     var zx ="<?= $sur ?>"+"_"+"<?= $ayah_no ?>";
		 var m=zx;
		 var n=0;
	   </script>
	   <?php
	    if(($surano!=0 && $surano!=$surah_no))
	     $_SESSION['prev_bottom']+=90;
	   else  if(($surah_no==1 || $surah_no==2) && ($ayah_no==1))
	   	$_SESSION['prev_bottom']=190;
	   else if($surano==0 && $ayah_no==1)
	   { 	if($surah_no==4 ||$surah_no==22 ||$surah_no==24 ||$surah_no==33 ||$surah_no==60 ||$surah_no==64 ||$surah_no==65 )
	   		{
	   			$_SESSION['prev_bottom']=50;
				$_SESSION['top']=49;
			    $_SESSION['bottom']=92;

			}
			else
			{
			$_SESSION['prev_bottom']=100;
			$_SESSION['top']=96;
			$_SESSION['bottom']=140;
			}

			
		}
			
	  	$prev_y=$_SESSION['prev_bottom'];
	    $_SESSION['prev_bottom'] =$y_end ;
	   if($x_start==NULL)
	   {
		 $x_start = 0;
	   }
	   
		if($y_start==NULL)
	   {
		 $y_start = 0;
	   }
	  
	   $prev_x=$_SESSION['prev_x'];
	   $lines=($_SESSION['prev_bottom']-$prev_y)/44;
       $_SESSION['lines']=$lines;
	   $arrVal1 = map_data1($ayah_no,$x_start,$x_end,$y_start,$y_end);
	   $left1 = $arrVal1['left'];
	   $top1  = $arrVal1['top'];
	   $right1 = $arrVal1['right'];
	   $bottom1 = $arrVal1['bottom'];
	   $number=1; 
	   $tp=$top1;
	   $bt=$bottom1;
	   if($lines>0.9)
	   {
	   		   if(($prev_x>20))
			   {
			   $left11 = 4;
			  
			   if($prev_x==36 && $surano==0 )
			   {
			     $top11  = $_SESSION['top']+10;
			   	 $right11=451;
				 $bottom11 =$_SESSION['bottom']+10;
				 }
			   else
			   {
			   $right11 =$prev_x+2 ;
			   $bottom11 =$_SESSION['bottom']; 
			   $top11  = $_SESSION['top'];
			   }
			   print '<area shape="rect" id="'.$sur.'_'.$ayah_no.'_'.$item.'_'.$number.'"  coords="'.$left11.','.$top11.','.$right11.','.$bottom11.'" />';
			   $number++;
			   $arrline[$surah_no."-".$ayah_no]=1;
			   ?>
			   <script>
			   n=1;
			   linearray[m]=n;
			   
			   
			   </script>
			   <?php

			   }
			
				for($j=2;$j<$lines;$j++)
				{
					$left11=4;
					$right11=451;
					if($qupage!=1 && $qupage!=2)
					{
					$top11=$tp-45;
					$bottom11=$bt-45;
					}
					else{	
				    $top11=$tp-72;
					$bottom11=$bt-72;
					}
					$tp=$top11-3;
					$bt=$bottom11-3;
					if($qupage==6 && $ayah_no==32)
	   				{
					}
					else	
					print '<area shape="rect" id="'.$sur.'_'.$ayah_no.'_'.$item.'_'.$number.'"  coords="'.$left11.','.$top11.','.$right11.','.$bottom11.'" />';
					$arrline[$surah_no."-".$ayah_no]=$arrline[$surah_no."-".$ayah_no]+1;
					 ?>
				   <script>
				   n=n+1; 
				   linearray[m]=n;
				   
				   </script>
				   <?php
					$number++;
				}
			

				  
						
	     }
	   $arrVal = map_data($ayah_no,$x_start,$x_end,$y_start,$y_end);
	   
	   $left = $arrVal['left'];
	   $top  = $arrVal['top'];
	   $right = $arrVal['right'];
	   $bottom = $arrVal['bottom'];

	   
	   
	   $url_theme_count = 0;

		/*for($i=$ayah_no;$i>=1;$i--)
		{
		
			$view_url= views_get_view('ayah_theme');
			$view_url->set_display('default');
			$view_url->set_arguments( array($surah_no, $i) );
			$view_url->execute();
			$url_theme_count = $view_url->result;
			if(count($url_theme_count)>0)
			{
				$_SESSION['theme_url'] =  strtolower(str_replace(" ","-",$url_theme_count[0]->node_revisions_body));
				break;
			}
		}*/

	   
	   $url =  $base_url.'/library/quran/ayah/compare/'.$surah_no.'/'.$ayah_no.'/'.$_SESSION['theme_url'] ;
	   $top1=$top1+2;
	   $bottom1=$bottom1+2;
	   if($qupage==6 && $ayah_no==32)
	   	{	
	   
	   $left1=4;$top1=247;$right1=451;$bottom1=290;
	   }
	   print '<area shape="rect" id="'.$sur.'_'.$ayah_no.'_'.$item.'_'.$number.'"   class="'.$surah_no.'_'.$ayah_no.'"  coords="'.$left1.','.$top1.','.$right1.','.$bottom1.'" />';
	   $arrline[$surah_no."-".$ayah_no]=$arrline[$surah_no."-".$ayah_no]+1;
	   if($left1<435)
	   {
	   	 ?>
			   <script>
			   n=n+1; 
			    linearray[m]=n;
			   
			   </script>
			   <?php
		}
	   $number++;
	   $item=$item+1;
	  // print the <area> tag with generated co-ordinates.. 
	   print '<area shape="rect" coords="'.$left.','.$top.','.$right.','.$bottom.'" href="'.$base_url.'/library/quran/ayah/compare/'.$surah_no.'/'.$ayah_no.'/'.$_SESSION['theme_url'].'" />';
	   	   $surano= $surah_no;

 }
print "</map>";
?>


		  <?php
		  if($field=='title')
		  {
		  ?>
		  <img  class="jq_maphilight"  src="<?=$base_url?>/sites/default/files/quranpages/<?php print strtoupper($content); ?>"  usemap="#ayahs" >
		  <?php
		  }
		  ?>
            
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script>
/*function bow()
{
var d=id.split("_",4);
if(d.length==4)
{
	$(function() {
 
        $('.jq_maphilight').maphilight();
		var itemclick=id.split("_",2);
		itemclick=itemclick[0]+"_"+itemclick[1];
		//alert(itemclick);
		var str=id.split("_",3);
		var str1="#"+str[0]+"_"+str[1]+"_"+str[2];
		//alert(itemclick);
		for(i=1;i<=linearray[itemclick];i++)
		{
	      
		    str=str1+"_"+i;  
			if(str == "#001_7_6_3" ||str == "#001_6_5_1" || str == "#001_5_4_1" ||str == "#001_2_1_1" ||str == "#002_4_4_1"||str == "#002_4_4_3" ||str == "#002_282_1_15"||str == "#111_1_12_1"||str == "#114_1_12_1"||str == "#114_6_17_1"||str == "#107_2_7_1")
			continue;
			$(str).trigger('mouseclick');
			str="";
		}
	 
		
    });
}

}
*/

function bow()
{


var t=id.indexOf("_")
//if(t==3)
//{
	$(function() {

        $('.jq_maphilight').maphilight();

		var itemclick=id.split("_",2);
		itemclick=itemclick[0]+"_"+itemclick[1];
		cook  = getCookiesort('itemclicks');
		cook1=getCookiesort('itemclicks1');
		

			var itemclick=id.split("_",2);
			itemclick=itemclick[0]+"_"+itemclick[1];
			var str=id.split("_",3);
			var str1="#"+str[0]+"_"+str[1]+"_"+str[2];
			var nj=linearray[cook]
			if(cook!=itemclick)
		    {
			for(i=1;i<=linearray[itemclick];i++)
			{
			  
				str=str1+"_"+i;  
				if(str == "#001_7_6_3" ||str == "#001_6_5_1" || str == "#001_5_4_1" ||str == "#001_2_1_1" ||str == "#002_4_4_1"||str == "#002_4_4_3" ||str == "#002_282_1_15"||str == "#111_1_12_1"||str == "#114_1_12_1"||str == "#114_6_17_1"||str == "#107_2_7_1")
				continue;
				$(str).trigger('mouseclick');
				str="";
				
			}
			}
			for(i=1;i<=linearray[cook];i++)
				{
					var sel="#"+cook+"_"+cook1+"_"+i;
					//alert(sel);
					if(sel == "#001_7_6_3" ||sel == "#001_6_5_1" || sel == "#001_5_4_1" ||sel == "#001_2_1_1" ||sel == "#002_4_4_1"||sel == "#002_4_4_3" ||sel == "#002_282_1_15"||sel == "#111_1_12_1"||sel == "#114_1_12_1"||sel == "#114_6_17_1"||sel == "#107_2_7_1")
					continue;
					$(sel).trigger('mouseclick'); 
				}
	 
		
    });

}
$(document).ready(function() {

$('#Content-new').mouseover(function() {

if(id!= "001_7_6_3"  && id!=  "001_6_5_1" && id != "001_5_4_1" && id != "001_2_1_1" && id != "002_4_4_1"&& id != "002_4_4_3" && id != "002_282_1_15"&& id != "111_1_12_1"&& id != "114_1_12_1"&& id != "114_6_17_1" && id != "107_2_7_1")
bow();

});
});
</script>

