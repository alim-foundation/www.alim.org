<?php
print "Recieved a request to upgrade the role. Please see the details."."\n\n";

print "Name\t\t\t\t:" .$form_values['submitted'][3]."\n";
print "E-mail\t\t\t:" .$form_values['submitted'][1]."\n";
print "Message\t\t\t\t:" .$form_values['submitted'][2]."\n";
print "Upgrade role to\t:" .$form_values['submitted'][4]."\n";

print "The results of this submission may be viewed at : \n  <a href='http://alim.org/node/163634/webform-results'>http://alim.org/node/163634/webform-results</a>";
?>