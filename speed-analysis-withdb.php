<?php
$start_time = microtime(TRUE);
$con =  mysql_connect("localhost","blueserf_alim","76Ls.1Z73iSz");
$db  =  mysql_select_db("blueserf_alim",$con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Speed Analysis</title>
<script language="javascript" type="text/javascript" src="jquery.min.js"/></script>
<script type="text/javascript"> 
   var startTime = (new Date()).getTime(); 
</script>
</head>

<body>
<?php
print "Speed Analysis, With db connection. Listing 200 data from node, node_access, node_type using INNER JOIN.<br /><br /><b>Query : </b><em>'SELECT node.title, node.nid, node_access.realm, node_access.grant_view, node_type.name, node_type.description FROM node INNER JOIN node_type ON node.type = node_type.type INNER JOIN node_access ON node.nid = node_access.nid WHERE node_type.name='Quran Ayah' ORDER BY node.nid ASC limit 0,200 '</em><br /><br />";
?>
<?php

$sql = mysql_query("SELECT node.title, node.nid, node_access.realm, node_access.grant_view, node_type.name, node_type.description FROM node INNER JOIN node_type ON node.type = node_type.type INNER JOIN node_access ON node.nid = node_access.nid WHERE node_type.name='Quran Ayah' ORDER BY node.nid ASC limit 0,200 ") or die(mysql_error()); 


?>
<table width="100%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <th width="5%">Sl No</th>
    <th width="14%">Title(node)</th>
    <th width="5%">Nid(node)</th>
    <th width="13%">Name(node_type)</th>
    <th width="24%">Description(node_type)</th>
    <th width="17%">Realm(node_access)</th>
    <th width="22%">Grant View(node_access)</th>
  </tr>
  <?php
  $i=1;
  while($arr = mysql_fetch_array($sql))
  { 
  ?>
  <tr>
    <td><?=$i?></td>
    <td><?=$arr['title']?></td>
    <td><?=$arr['nid']?></td>
    <td><?=$arr['name']?></td>
    <td><?=substr(strip_tags($arr['description']),0,150)?></td>
    <td><?=$arr['realm']?></td>
    <td><?=$arr['grant_view']?></td>
  </tr>
  <?php
    $i++;
	}
  ?>
</table>

<?php
$end_time = microtime(TRUE);
$time_taken_sec = $end_time - $start_time;
$server_timemilli = $time_taken_sec*1000;
$time_taken = round($time_taken_sec,5);
?>
<div style="background:#F9D350;color:#A94C17" id="load_timediv"></div>
<script type="text/javascript"> 
  var server_time='';
  var browser_time=  '';
   $(window).load(function() 
   { 
       var endTime = (new Date()).getTime(); 
       var millisecondsLoading = endTime - startTime; 
       // Put millisecondsLoading in a hidden form field 
       // or AJAX it back to the server or whatever. 
	   var seconds = (millisecondsLoading/1000);
	   var htmlStr = 'Total load time in seconds : '+seconds+' :: in ms :' + millisecondsLoading;
		
  server_time=<?php print $server_timemilli; ?>; // for ajax insert
  browser_time=  millisecondsLoading; // for ajax insert
  
  var disptime = <?php print $time_taken; ?>;
  var totaltime_display =  seconds + disptime;
   
  document.getElementById('load_timediv').innerHTML = 'Total elapsed time: '+totaltime_display.toFixed(4)+' sec. ==> Server: '+disptime+' sec. | User (e.g. : browser,network,internet): '+seconds.toFixed(4) +' sec.';
   });

</script> 
</body>
</html>
