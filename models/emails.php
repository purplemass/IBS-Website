<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

//--------------------------------------------------------------

/**
 * Send registration email
 *
 * @access public
 * @param string	name
 * @param string	amount
 * @return void
 */
function send_email_donor($email, $name, $amount)
{
	$subject	= 'IBS Project - Donation received';
	$body 		= <<<EOF
Dear {$name},
<br />
<br />
We have received your donation of &pound;{$amount} and are extremely grateful for your contribution to this not-for-profit venture.
<br />
<br />
Many thanks,
<br />
<br />
IBS Project Team
<br />
<a href="http://www.ibsproject.org">www.ibsproject.org</a>
<br />
EOF;

	return(send_mail($email, $subject, $body));

}

//--------------------------------------------------------------

/**
 * Send donation auto email
 *
 * @access public
 * @return void
 */
function send_email_auto_donor($name, $amount)
{
	$subject = 'IBS Project automated email - Donation received';
	$body = <<<EOF
We have recieved a donation of &pound;{$amount} from {$name}.
<br />
EOF;
	
	return(send_mail(EMAIL_AUTO, $subject, $body));
}	

//--------------------------------------------------------------

/**
 * Send registration email
 *
 * @access public
 * @return void
 */
function send_registration_email($email, $name, $password)
{
	$subject = 'IBS Project - User registration';
	$message = <<<EOF
Dear {$name},
<br />
<br />
Thank you for registering on the Iranian Business School Project website. Your details will be added to our database and you will receive all future information and updates.
<br />
<br />
Email address: {$email}
<br />
Password: {$password}
<br />
<br />
Kind regards,
<br />
<br />
IBS Project Team
<br />
<a href="http://www.ibsproject.org">www.ibsproject.org</a>
<br />
EOF;

	return(send_mail($email, $subject, $message));
}

//--------------------------------------------------------------

/**
 * Send registration auto email
 *
 * @access public
 * @return void
 */
function send_registration_auto_email($fields, $is_new)
{
	$msg = 'updated their details';
	if ($is_new)
		$msg = 'registered';

	$subject = 'IBS Project automated email - Registeration';
	$body = <<<EOF
The following user has {$msg} on our website:
<br />
<br />
EOF;
	foreach ($fields as $name => $options)
	{
		if (isset($_POST[$name]) && strpos($name, 'password') === FALSE)
			$body .= $name . ': ' . echo_value($name) . '<br />';
	}

	return(send_mail(EMAIL_AUTO, $subject, $body));
}

//--------------------------------------------------------------

/**
 * Send password email
 *
 * @access public
 * @param string	name
 * @param string	password
 * @return void
 */
function send_password_email($email, $name, $password)
{
	$subject = 'Password reminder for IBS Project website';
	$message = <<<EOF
Dear {$name},
<br />
<br />
Here is a reminder of your password for the Iranian Business School website:
<br />
<br />
Password: {$password}
<br />
<br />
Kind regards,
<br />
<br />
IBS Project Team
<br />
<a href="http://www.ibsproject.org">www.ibsproject.org</a>
<br />
EOF;

	return(send_mail($email, $subject, $message));
}

//--------------------------------------------------------------

/**
 * Send newsletter auto email
 *
 * @access public
 * @return void
 */
function send_newsletter_auto_email($email, $unsubscribe = false)
{
	$subject = 'IBS Project automated email - Newsletter ';
	$add_remove = 'add';
	$to_from = 'to';

	if ($unsubscribe)
	{
		$subject .= 'Cancellation';
		$add_remove = 'remove';
		$to_from = 'from';
	}
	else
	{
		$subject .= 'Subscription';
	}
	
	$body = <<<EOF
Please {$add_remove} the following email address {$to_from} the database:
<br />
<br />
Email address: {$email}
<br />
EOF;
	
	return(send_mail(EMAIL_AUTO, $subject, $body));
}	

//--------------------------------------------------------------

/**
 * Send newsletter email
 *
 * @access public
 * @param string	email address
 * @return void
 */
function send_newsletter_email($email)
{
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
<a href="http://www.ibsproject.org">www.ibsproject.org</a>
<br />
EOF;

	return(send_mail($email, $subject, $body));
}

//--------------------------------------------------------------

?>