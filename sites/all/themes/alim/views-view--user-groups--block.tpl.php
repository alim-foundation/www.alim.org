<?php
$flag=0;
// Alter the group title in user profile page's group display.
$user_details1 = user_load(array('name' => arg(1)));
/*$query44 = "SELECT node.nid AS nid, users.name AS users_name, users.uid AS users_uid, og_uid.uid AS og_uid_uid, og_uid.nid AS og_uid_nid, node.title AS node_title FROM node node  LEFT JOIN og_uid og_uid ON node.nid = og_uid.nid INNER JOIN users users ON node.uid = users.uid WHERE (node.status <> 0) AND (node.type IN ('creat_group')) AND (og_uid.uid = ".$user_details1->uid.") ORDER BY node_title ASC";*/

$query55 = "SELECT node.nid AS nid, users.name AS users_name, users.uid AS users_uid, og_uid.uid AS og_uid_uid, og_uid.nid AS og_uid_nid, node.title AS node_title FROM node node  LEFT JOIN og og ON node.nid = og.nid INNER JOIN users users ON node.uid = users.uid LEFT JOIN og_uid og_uid ON node.nid = og_uid.nid WHERE (node.status <> 0) AND (node.type IN ('creat_group')) AND (og.og_directory <> 0)  AND (og_uid.uid = ".$user_details1->uid.") GROUP BY node.nid ORDER BY node_title ASC";

$num_per_page = 30;
$rs55 = pager_query($query55,$num_per_page);
//$exc44 = db_query($query44);
 while ($data = db_fetch_object($rs55)){
$flag=1;
 }
if($flag==1)
{
?>
<div class="view view-<?php print $css_name; ?> view-id-<?php print $name; ?> view-display-id-<?php print $display_id; ?> view-dom-id-<?php print $dom_id; ?>">
  <?php if ($admin_links): ?>
    <div class="views-admin-links views-hide">
      <?php print $admin_links; ?>
    </div>
  <?php endif; ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
	 
	    <?php if ($pager): ?>
         <div class="hline"></div>
         <?php endif; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div> <?php /* class view */ ?>
<?php
}
?>
