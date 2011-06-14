<?php
// $Id: user_relationships_pending_requests.tpl.php,v 1.1.2.9 2010/01/03 20:17:43 alexk Exp $
/**
 * @file
 * Page to manage sent and received relationship requests
 */

  $output = '';
  $pager_id = 0;
  $section_headings = array(
    'sent_requests'     => t('Sent Requests'),
    'received_requests' => t('Received Requests')
  );

  foreach ($sections as $column => $section) {
    if (!isset($$section)) { continue; }
    $rows = array();

    $rows[] = array(
      array('data' => $section_headings[$section], 'header' => TRUE, 'colspan' => 2)
    );

    foreach ($$section as $relationship) {
      $links = array();
      if ($section == 'sent_requests') {
        $links[] = theme('user_relationships_pending_request_cancel_link', $account->uid, $relationship->rid);
      }
      else {
        $links[] = theme('user_relationships_pending_request_approve_link',    $account->uid, $relationship->rid);
        $links[] = theme('user_relationships_pending_request_disapprove_link', $account->uid, $relationship->rid);
      }
      $links = implode(' | ', $links);

      if ($relationship->requester_id == $account->uid) {
	  
	  	$temp_user = user_load(array('name' => theme('username', $relationship->requestee)));
		if($temp_user->rpx_data['profile']['name']['givenName']!="")
		{
			 $requestee_name = $temp_user->rpx_data['profile']['name']['givenName']." ".$temp_user->rpx_data['profile']['name']['familyName'];
		}
		else
		{
			$requestee_name = theme('username', $relationship->requestee);
		}
	  
        $rows[]   = array(t('@rel_name to '.$requestee_name, array('@rel_name' => ur_tt("user_relationships:rtid:$relationship->rtid:name", $relationship->name))), $links);
      }
      else {
	  
	 	$temp_user1 = user_load(array('name' => theme('username', $relationship->requester)));
		if($temp_user1->rpx_data['profile']['name']['givenName']!="")
		{
			 $requester_name = $temp_user1->rpx_data['profile']['name']['givenName']." ".$temp_user1->rpx_data['profile']['name']['familyName'];
		}
		else
		{
			$requester_name = theme('username', $relationship->requester);
		}
		
        $rows[]   = array(t('@rel_name from '.$requester_name, array('@rel_name' => ur_tt("user_relationships:rtid:$relationship->rtid:name", $relationship->name))), $links);
      }
    }

    $output .=
      theme('table', array(), $rows, array('class' => 'user-relationships-pending-listing-table')).
      theme('pager', NULL, $relationships_per_page, $pager_id++);
  }

  if ($output == '') {
    $output = t('No pending relationships found');
  }

  print $output;
?>
