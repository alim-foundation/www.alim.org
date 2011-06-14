<?php
// Alter the group title in user profile page's group display.
$user_details1 = user_load(array('name' => arg(1)));
/*$query44 = "SELECT node.nid AS nid, users.name AS users_name, users.uid AS users_uid, og_uid.uid AS og_uid_uid, og_uid.nid AS og_uid_nid, node.title AS node_title FROM node node  LEFT JOIN og_uid og_uid ON node.nid = og_uid.nid INNER JOIN users users ON node.uid = users.uid WHERE (node.status <> 0) AND (node.type IN ('creat_group')) AND (og_uid.uid = ".$user_details1->uid.") ORDER BY node_title ASC";*/

$query44 = "SELECT node.nid AS nid, users.name AS users_name, users.uid AS users_uid, og_uid.uid AS og_uid_uid, og_uid.nid AS og_uid_nid, node.title AS node_title FROM node node  LEFT JOIN og og ON node.nid = og.nid INNER JOIN users users ON node.uid = users.uid LEFT JOIN og_uid og_uid ON node.nid = og_uid.nid WHERE (node.status <> 0) AND (node.type IN ('creat_group')) AND (og.og_directory <> 0)  AND (og_uid.uid = ".$user_details1->uid.") GROUP BY node.nid ORDER BY node_title ASC";

$num_per_page = 30;
$rs = pager_query($query44,$num_per_page);
//$exc44 = db_query($query44);
 while ($data = db_fetch_object($rs)){
 print "<div class='user_grp'><a href='../groupdetails/".$data->nid."'>".$data->node_title."</a></div>";
 }
?>