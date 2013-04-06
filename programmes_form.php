<?php

$this_nav = 2;
require_once('controllers/html.php');
require_once('views/head.php');

//--------------------------------------------------------------

$err = array();
$email = '';
$R = "\n" . '<br />';
$RR = $R . $R;

//--------------------------------------------------------------
// is this a submmitted form?
if ($_POST)
{
	// check for errors
	foreach ($programme_fields as $name => $options)
	{
		if ( isset($_POST[$name]) && ! $_POST[$name] && $options['mandatory'])
			$err[] = $options['error'];
	}

	// check for valid email
	if ( ! count($err) && ! validate_email($_POST['email']) )
		$err[] = 'Please enter a valid email address';

	// if errors, display form - otherwise thank 'em
	if ( count($err) > 0 )
	{
		require_once('views/programme_form_view.php');
	}
	else
	{

		$body = '';
		$body .= '<p>Dear ' . echo_value('title') . ' ' . echo_value('forename') . ' ' . echo_value('surname') . ',</p>';
		$body .= '<p><b>Thank you for your interest in the Executive Leadership Program.</b></p>';
		$body .= '<p>We will respond to your request within 24 hours. Meanwhile, please feel free to call us at 8352 3280.</p>';
		$body .= '<p>Zahed Sheikholeslami, Ph.D.<br />Executive Dean<br />IBS<p>';

		email_thankyou();
		email_zahed();
		write_csv();

		require_once('views/programme_form_thankyou.php');
	}
}
else
{
	// if no POST then display form
	require_once('views/programme_form_view.php');
}

//--------------------------------------------------------------

require_once('views/menu_right_links.php');
require_once('views/tail.php');

//--------------------------------------------------------------

function write_csv() {

	global $programme_fields;
	global $programme_docs;

	$folder_name = '_executive_programme/';
	$displayDate = strftime("%Y-%m-%d");
	$displayTime = strftime("%H:%M:%S");
	$filename = $folder_name . $displayDate . '.txt';

	$data = '';

	foreach ($programme_fields as $name => $options)
		$data .= '"' . echo_value($name) . '",';

	foreach ($programme_docs as $name => $label)
	{
		if (isset($_POST[$name]))
			$data .= '"' . $label . '"' . ',';
		else
			$data .= ',';
	}

	$r = create_file($folder_name, $filename);

	$s 	= $displayDate . ',' . $displayTime . ',';
	$s .= $data . "\r\n";

	$r	= write_file($filename, $s);
}

//--------------------------------------------------------------

function email_thankyou() {

	global $R, $RR, $body;

	$email = echo_value('email');

	$subject = 'IBS Project - Executive Leadership Programme';

	send_mail($email, $subject, $body);

	return $body;
}

//--------------------------------------------------------------

function email_zahed() {

	global $R, $RR;
	global $programme_fields;
	global $programme_docs;

	$email = 'b.hatamian@ibsproject.org';
	$email .= ',zahed.sheikh@gmail.com';
	$email .= ',azadeh_azimi@yahoo.com';

	$subject = 'IBS Project automated email - Executive Leadership Programme';

	$body = '';

	$body .= 'Dear Zahed' . ',' . $RR;
	$body .= 'The following person has sent you a request on ibsproject.org:' . $RR;

	foreach ($programme_fields as $name => $options)
		$body .= $options['label'] . ' <b>' . echo_value($name) . '</b>' . $R;

	$body .= $R;
	$body .= 'The following documents were requested:' . $R;

	foreach ($programme_docs as $name => $label)
	{
		if (isset($_POST[$name]))
			$body .= '<b>' . $label . '</b>' . $R;
	}

	$body .= $R;
	$body .= 'Many thanks,' . $RR;
	$body .= 'IBS Project Team' . $R;
	$body .= '<a href="http://www.ibsproject.org">www.ibsproject.org</a>' . $R;

	send_mail($email, $subject, $body);

	return $body;
}

?>