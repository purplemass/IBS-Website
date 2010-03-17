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
	$subject	= 'IBS Project - Donation Received';
	$body 		= <<<EOF
Dear {$name},
<br />
<br />
We have recieved your donation of £{$amount}.
<br />
<br />
Many thanks...
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
function send_email_auto_donor()
{
	$subject = 'IBS Project automated email - Donation Received';
	$body = <<<EOF
We have recieved a donation of £{$amount} from {$name}.
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
	$subject = 'Thank you for registering';
	$message = <<<EOF
Dear {$name},
<br />
<br />
Thank you for registering with the Iranian Business School Project website. Your details will be added to our database and you will receive all future information and updates.
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
http://www.ibsproject.org
<br />
EOF;

	return(send_mail($email, $subject, $message));
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
http://www.ibsproject.org
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
function send_newsletter_auto_email()
{
	$subject = 'IBS Project automated email - Newsletter Subscription';
	
	$body = <<<EOF
Please add the following email address to the database:
<br />
<br />
Email address: $emailAddress;
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
http://www.ibsproject.org
<br />
EOF;

	return(send_mail($email, $subject, $body));
}

//--------------------------------------------------------------

?>