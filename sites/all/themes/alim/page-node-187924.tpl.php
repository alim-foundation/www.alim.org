<?php
ini_set('max_execution_time', 3000);
header('Pragma: public');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header("Pragma: no-cache");
header("Expires: 0");
header('Content-Transfer-Encoding: none');
header('Content-Type: application/vnd.ms-excel;');
header("Content-type: application/x-msexcel");
header('Content-Disposition: attachment; filename=Alim Users.xls');
$a=$_GET['a'];
$b=$_GET['b'];
$a = date("Y-m-d", strtotime($a));
$b = date("Y-m-d", strtotime($b));

if($a=="1969-12-31" && $b=="1969-12-31")
$qry_string="FROM_UNIXTIME(created) >=DATE_SUB(CURDATE(), INTERVAL 4 MONTH)";
else
$qry_string="DATE(FROM_UNIXTIME(created)) BETWEEN CONCAT('".$a ."',' ','00:00:00') AND CONCAT('".$b ."',' ','23:59:59')  ";

echo "<table><tr style='border:2px solid #666666'><th align='left'>USER NAME</th><th align='left'>FULL NAME</th><th align='left'>EMAIL</th></tr>";  
$query1=db_query('SELECT  users.uid, `name`  ,mail as email ,CAST(profile_values.value AS CHAR) AS fname FROM `users`,profile_values WHERE  '.$qry_string.' AND profile_values.uid = users.uid  GROUP BY uid DESC');
while ($row1 = db_fetch_object($query1)) 
{
	print '<tr style="border-bottom:1px solid #CCCCCC;">
	<td align="left" style="border-right:1px solid #CCCCCC; ">'. $row1->name.'</td>
	<td align="left" style="border-right:1px solid #CCCCCC; ">123'. $row1->fname.'</td>
	<td align="left" style="border-right:1px solid #CCCCCC; ">'. $row1->email.'</td>
	';
    print $inner.'</tr>';
  
}
print '</table>';
?>

