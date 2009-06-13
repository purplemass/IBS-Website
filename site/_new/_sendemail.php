<?php

#header("Access-Control-Allow-Origin: http://localhost");

#--------------------------------------------------------------

ini_set("display_errors", 1);
error_reporting(E_ALL);

#--------------------------------------------------------------

$autoEmailTo 		= 'info@ibsproject.com,bhat@imagination.com';
$autoEmailTo 		= 'bhat@imagination.com';

$emailFrom 			= 'noreply@ibsproject.com';
$emailFromServer	= 'bhat@imagination.com';

#--------------------------------------------------------------

$folder_name		= '_subscriptions/';
$displayDate		= strftime("%d-%m-%Y");
$displayTime		= strftime("%H:%M:%S");

$filename			= $folder_name . $displayDate . '.txt';

#--------------------------------------------------------------

$s = 'emailAddress';

#if (!isset($_REQUEST[$s])) { die(); } else { $emailAddress = $_REQUEST[$s]; }

if (isset($_REQUEST[$s])) {
	$emailAddress = strip_tags(htmlentities($_REQUEST[$s]));
} else {
	exit("ERROR");
}

#--------------------------------------------------------------

$r = CreateFile($folder_name, $filename);

$s 	= $displayDate . ',' . $displayTime . ',';
$s .= '"' . $emailAddress . '"' . "\r\n";
$r	= WriteFile($filename, $s);

#if ($r != 'OK')
#	exit $r;
	
#--------------------------------------------------------------

$subject = 'IBS Project automated email - Newsletter Subscription';

$message = 'Please add the following email address to the database:'
			. "\r\n" . "\r\n" . $emailAddress;

$r = SendEmail($autoEmailTo, $emailFrom, $subject, $message, $emailFromServer);

#--------------------------------------------------------------

$subject 		= 'Your subscription to the IBS Project Newsletter';

$message 		= <<<EOF
Dear Subsciber,

Thank you for your interest in the Iranian Business School Project.  Your details will be added to our database and you will receive all future information and updates.

Many thanks,

IBS Project Team

EOF;

$r = SendEmail($emailAddress, $emailFrom, $subject, $message, $emailFromServer);

#--------------------------------------------------------------

exit($r);

#--------------------------------------------------------------

function SendEmail($emailTo, $emailFrom, $subject, $message, $emailFromServer)
{
	$headers	= 	"From: IBS Project <$emailFrom>" . "\r\n" .
					"Reply-To: IBS Project <$emailFrom>" . "\r\n" .
					"X-Mailer: PHP/" . phpversion();

	$r = mail($emailTo, $subject, $message, $headers, '-f' . $emailFromServer);
	
	if ($r == 1)
		return 'OK';
	else
		return 'ERROR';
}

#--------------------------------------------------------------

function WriteFile($filename, $content)
{
	if (!@$handle = fopen($filename, 'a+')) {
		return("ERROR - Cannot open file($filename)");
	}
	if (fwrite($handle, $content) === FALSE) {
		return("ERROR - Cannot write to file($filename)");
	}
	
	return 'OK';
}

#--------------------------------------------------------------

function CreateFile($fd, $file)
{
	if (!is_dir($fd)) {
		mkdir($fd, 0777)
			or exit("ERROR - Cannot create directory '" . $fd . "'");
	}
	
	if (!file_exists($file)) {
		$r = WriteFile($file, '');
		chmod($file, 0755);
		return $r;
	}
	
	return 'ERROR';
}

?>