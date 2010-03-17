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

#if (!isset($_REQUEST[$s])) { die(); } else { $email_to = $_REQUEST[$s]; }

if (isset($_REQUEST[$s]))
	$email_to = strip_tags(htmlentities($_REQUEST[$s]));
else
	exit("ERROR");

//--------------------------------------------------------------

$r = create_file($folder_name, $filename);

$s 	= $displayDate . ',' . $displayTime . ',';
$s .= '"' . $email_to . '"' . "\r\n";
$r	= write_file($filename, $s);

#if ($r != 'OK')
#	exit $r;
	
//--------------------------------------------------------------

$r = send_newsletter_email($email_to);
$r = send_newsletter_auto_email();

//--------------------------------------------------------------

exit($r);

//--------------------------------------------------------------

?>