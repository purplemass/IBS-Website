<?php

$this_nav = 2;
require_once('controllers/html.php');
require_once('views/head.php');

//--------------------------------------------------------------

$err = array();
$email = '';
$R = "\n" . '<br />';
$RR = $R . $R;

$body_tail = '';
$body_tail .= 'Many thanks,' . $RR;
$body_tail .= 'IBS Project Team' . $R;
$body_tail .= '<a href="http://www.ibsproject.org">www.ibsproject.org</a>' . $R;

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
		$email = email_thankyou() . $RR;
		$email .= email_zahed();
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

function email_thankyou() {

	global $R, $RR, $body_tail;

	$email = echo_value('email');

	$subject = 'IBS Project - Executive Leadership Programme';

	$body = '';
	
	$body .= 'Dear ' . echo_value('forename') . ',' . $RR;
	$body .= 'We have received your request for our Executive Leadership Programme.' . $RR;
	$body .= 'We will be dealing with your request shortly.' . $RR;
	$body .= $body_tail;
	
	send_mail($email, $subject, $body);

	return $body;
}

//--------------------------------------------------------------

function email_zahed() {

	global $R, $RR, $body_tail;
	global $programme_fields;
	global $programme_docs;
	
	$email = 'zahed.sheikh@gmail.com, b.hatamian@ibsproject.org';
	
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
	$body .= $body_tail;
	
	send_mail($email, $subject, $body);

	return $body;
}

?>