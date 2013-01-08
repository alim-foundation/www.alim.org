<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

	
 			 $contents = "Commented Users \n\n\nSIno               \tFull Name             \tNumber of Comments            \tEmail\n" ;
		

				

			 	
			//Execute the query to return the data
$i=1;
$result =  db_query("SELECT DIstinct(comments.name) AS comments_name , comments.uid as user_id ,
(select count(*) from comments cm where cm.name = comments.name) as total

 FROM comments ORDER BY total DESC
");
       
           // We run through the submissions and match them to the choices from the webform textarea values
while ($record = db_fetch_object($result)) {
  // Perform operations on $record->title, etc. here.
  //$record = db_fetch_object($result);
  $results = db_query("SELECT value from  profile_values where fid=18 AND uid=%d",$record->user_id);
  $records = db_fetch_object($results);
  $resultss = db_query("SELECT mail as user_mail from  users where uid=%d",$record->user_id);
  $recordss = db_fetch_object($resultss);
		    $contents .= $i."\t".$records->value."\t".$record->total."\t".$recordss->user_mail;
  		    $contents .= "\n";
			  $i++;
			
		  }
             
		
		
				
			

        $filename ="commented_users.xls";
		
		header('Content-type: application/x-msexcel');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Pragma: public');
		header('Cache-Control: max-age=0');
		echo $contents;
		
		//print_r($store);

	    //drupal_set_message('<pre>' . print_r($store, TRUE) .'</pre>' ,$type = 'status', $repeat = TRUE );

?>