
		<table border="0"  width="400">
		<tr><td colspan="2" ><b>Personal Information</b></td></tr>	
		<tr><td>Name:</td><td><?php print "".$form_values['submitted'][3]. "&nbsp;".$form_values['submitted'][4]."&nbsp;".$form_values['submitted'][5]; ?></td></tr>
		<tr><td>Post:</td><td><?php  print "".$form_values['submitted'][23]; ?></td></tr>
		<tr><td>Gender:</td><td><?php  print "".$form_values['submitted'][8]; ?></td></tr>
		<tr><td>Email:</td><td><?php  print "".$form_values['submitted'][10]; ?></td></tr>
		<tr><td>Phone:</td><td><?php  print "".$form_values['submitted'][6]; ?></td></tr>
		<tr><td>Mobile:</td><td><?php  print "".$form_values['submitted'][7]; ?></td></tr>
		<tr><td>Street Address:</td><td><?php  print "".$form_values['submitted'][11]; ?></td></tr>
		<tr><td>City:</td><td><?php  print $form_values['submitted'][12]; ?></td></tr>
		<tr><td>Zip:</td><td><?php  print "".$form_values['submitted'][13]; ?></td></tr>	
		<tr><td colspan="2" ><b>Additional Information</b></td></tr>	
		<tr><td>Work Authorization:</td><td><?php  print "".$form_values['submitted'][16]; ?></td></tr>	
		<tr><td>Highest Education level:</td><td><?php  print "".$form_values['submitted'][17]; ?></td></tr>			
		<tr><td>Cover Letter:</td><td><?php  print "".$form_values['submitted'][21]; ?></td></tr>	
		<?php  $file_details = unserialize($form_values['submitted'][20]);?>
		<tr><td colspan="4"><a href="node/221/submission/<?=$form_values['details']['sid']?>"><b>Click here to view the submission. </b></a></td></tr>
		</table>
 

