<?php
print "Recieved a request to upgrade the role. Please see the details:"."\n\n";
$link="http://alim.org/node/163634/webform-results";
print "Name				:" .$form_values['submitted'][3]."\n";
print "E-mail			:" .$form_values['submitted'][1]."\n";
print "Message			:" .$form_values['submitted'][2]."\n";
print "Upgrade role to	:" .$form_values['submitted'][4]."\n\n\n";

print "The results of this submission may be viewed at:\n";
print  $link;

print "Alim.org";
?>
