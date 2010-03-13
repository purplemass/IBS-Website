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

if (isset($_REQUEST[$s])) {
	$emailAddress = strip_tags(htmlentities($_REQUEST[$s]));
} else {
	exit("ERROR");
}

//--------------------------------------------------------------

$r = CreateFile($folder_name, $filename);

$s 	= $displayDate . ',' . $displayTime . ',';
$s .= '"' . $emailAddress . '"' . "\r\n";
$r	= WriteFile($filename, $s);

#if ($r != 'OK')
#	exit $r;
	
//--------------------------------------------------------------

$subject = 'IBS Project automated email - Newsletter Subscription';

$message = 'Please add the following email address to the database:'
				. "\r\n" . "\r\n" . $emailAddress;

$r = send_mail_ibs($autoEmailTo, $emailFrom, $subject, $message, $emailFromServer);

//--------------------------------------------------------------

$subject 		= 'Your subscription to the IBS Project Newsletter';

$message 		= <<<EOF
Dear Subscriber,

Thank you for your interest in the Iranian Business School Project.  Your details will be added to our database and you will receive all future information and updates.

Many thanks,

IBS Project Team

EOF;

$r = send_mail_ibs($emailAddress, $emailFrom, $subject, $message, $emailFromServer);

//--------------------------------------------------------------

exit($r);

//--------------------------------------------------------------

?>