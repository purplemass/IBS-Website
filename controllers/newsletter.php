<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require '../models/config.php';
require '../models/db.php';
require '../models/functions.php';
require '../models/emails.php';

//--------------------------------------------------------------

#header("Access-Control-Allow-Origin: http://localhost");

//--------------------------------------------------------------

$folder_name = '../_subscriptions/';
$displayDate = strftime("%Y-%m-%d");
$displayTime = strftime("%H:%M:%S");

$filename = $folder_name . $displayDate . '.txt';

//--------------------------------------------------------------

$s = 'emailAddress';

#if (!isset($_REQUEST[$s])) { die(); } else { $email_to = $_REQUEST[$s]; }

if (isset($_REQUEST[$s]))
	$email = strip_tags(htmlentities($_REQUEST[$s]));
else
	exit("ERROR");

//--------------------------------------------------------------

$r = create_file($folder_name, $filename);

$s 	= $displayDate . ',' . $displayTime . ',';
$s .= '"' . $email . '"' . "\r\n";
$r	= write_file($filename, $s);

//--------------------------------------------------------------

$r = send_newsletter_email($email);
$r = send_newsletter_auto_email($email);

//--------------------------------------------------------------
// add to DB

$row = mysql_fetch_assoc(mysql_query("SELECT id, email, title, forename, surname FROM " . TABLE_COMMUNITY . " WHERE email='" . $email . "'"));
check_db_error();

// id exists
if ($row['email'])
{
	$pid = $row['id'];
}
// id doesn't exist
else
{
	$sql_cmd = ("	INSERT INTO " . TABLE_COMMUNITY . " (dt, mdt, email)
					VALUES(

						NOW(),
						NOW(),
						'" . $email . "'

					)");

	mysql_query($sql_cmd);
	check_db_error();
	
	$pid = mysql_insert_id();
}

insert_value('newsletter', '1', $pid);

//--------------------------------------------------------------

// check for Facebook
//
// if fromFacebook is set then we must redirect to
// another Newsletter Thank You page
// otherwise it's an AJAX call expecting an exit($r)
//
if (isset($_REQUEST['fromFacebook']))
{
	header('Location: http://ibsproject.org/facebook/newsletter_thankyou.php');
}
else
{
	exit($r);
}

//--------------------------------------------------------------

?>