<?php
$start_time = microtime(TRUE);
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
print "Speed Analysis, without any data and database connection";
?>
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
