<?php
// Alter the unjoin link as popup
global $user;
?>
<a href='../og/unsubscribe/<?php print strip_tags($output); ?>/<?=$user->uid?>' class='popups-form-reload' >Unjoin</a>