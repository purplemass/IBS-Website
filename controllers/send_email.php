<?php

//--------------------------------------------------------------

#header("Access-Control-Allow-Origin: http://localhost");

//--------------------------------------------------------------

require '../models/functions.php';
require '../models/config.php';

//--------------------------------------------------------------

$folder_name = '../_subscriptions/';
$displayDate = strftime("%d-%m-%Y");
$displayTime = strftime("%H:%M:%S");

$filename = $folder_name . $displayDate . '.txt';

//--------------------------------------------------------------

$s = 'emailAddress';

#if (!isset($_REQUEST[$s])) { die(); } else { $emailAddress = $_REQUEST[$s]; }

if (isset($_REQUEST[$s]))
	$emailAddress = strip_tags(htmlentities($_REQUEST[$s]));
else
	exit("ERROR");

//--------------------------------------------------------------

$r = create_file($folder_name, $filename);

$s 	= $displayDate . ',' . $displayTime . ',';
$s .= '"' . $emailAddress . '"' . "\r\n";
$r	= write_file($filename, $s);

#if ($r != 'OK')
#	exit $r;
	
//--------------------------------------------------------------

$subject = 'IBS Project automated email - Newsletter Subscription';

$body = <<<EOF
Please add the following email address to the database:
<br />
<br />
Email address: $emailAddress;
<br />
EOF;

$r = send_mail(EMAIL_AUTO, $subject, $body);

//--------------------------------------------------------------

$subject = 'Your subscription to the IBS Project Newsletter';

$body = <<<EOF
Dear Subscriber,
<br />
<br />
Thank you for your interest in the Iranian Business School Project.  Your details will be added to our database and you will receive all future information and updates.
<br />
<br />
Many thanks,
<br />
<br />
IBS Project Team
<br />
http://www.ibsproject.org
<br />
EOF;

$r = send_mail($emailAddress, $subject, $body);

//--------------------------------------------------------------

exit($r);

//--------------------------------------------------------------

?>