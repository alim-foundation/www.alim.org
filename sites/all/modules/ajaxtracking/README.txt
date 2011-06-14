AJAX USER TRACKING Module
-------------------------

Before Installation. Do the following. Make changes in page.tpl and other tpls. You must pass the 'server_time' & 'browser_time' JS variable to ajaxtracking module as mentioned here. You can change permission by admin/user/permissions. Normally didn't track the admin user & you can deny another roles by permission page.

//-------------------

1. Insert this JS script inside the <head> tag of drupal page.tpl( Initialize clienttime start)

<script type="text/javascript"> 
   var startTime = (new Date()).getTime(); 
</script> 

2. Insert this PHP script after the <body> tag start of drupal page.tpl ( Initialize servertime start)

<?php
 $start_time = microtime(TRUE);
?>

3.Insert this PHP & JS script before <?php print $closure ?> of drupal page.tpl ( Server Time & User Time calculation and display. )
  Here we passing the 'server_time' & 'browser_time' JS variable to ajaxtracking module.

<?php
$end_time = microtime(TRUE);
$time_taken_sec = $end_time - $start_time;

$server_timemilli = $time_taken_sec*1000;
$time_taken = round($time_taken_sec,5);




?>
<script type="text/javascript"> 
  var server_time='';
  var browser_time=  '';
   $(window).load(function() 
   { 
       var endTime = (new Date()).getTime(); 
       var millisecondsLoading = endTime - startTime; 
       // Put millisecondsLoading in a hidden form field 
       // or AJAX it back to the server or whatever. 
	   var seconds = (millisecondsLoading/1000)%60 ;
	   var htmlStr = 'Total load time in seconds : '+seconds+' :: in ms :' + millisecondsLoading;
		
  server_time=<?php print $server_timemilli; ?>;
  browser_time=  millisecondsLoading - server_time;
  
  var disptime = <?php print $time_taken; ?>;
  var browser_time_display =  seconds - disptime;
  
  
  document.getElementById('load_timediv').innerHTML = 'Total elapsed time: '+seconds+' sec. ==> Server: '+disptime +' sec. | User (e.g. : browser,network,internet): '+browser_time_display +' sec.';
   });

</script> 
<div style="background:#F9D350;color:#A94C17" id="load_timediv"></div>

//---------------------