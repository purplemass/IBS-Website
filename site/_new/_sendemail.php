<?php

$emailAddress	= $_REQUEST['emailAddress'];

#$mailTo 		= 'bob_ak@hotmail.com';
#$mailTo 		= 'bhat@imagination.com,bob_ak@hotmail.com,bob.hatamian@imagination.com,babak.hatamian@imagination.com';

$mailTo 		= 'bhat@imagination.com';

$mailFrom 		= 'noreply@ibsproject.com';

$mailFromEnd	= 'bhat@imagination.com';

$subject 		= 'IBS - Automated Newsletter Subscription';

$message 		= 'Please add the following email address to the database:'
					. "\r\n" . "\r\n" . $emailAddress;

$headers		= 	"From: IBS <$mailFrom>" . "\r\n" .
					"Reply-To: IBS <$mailFrom>" . "\r\n" .
					"X-Mailer: PHP/" . phpversion();

$r				= mail($mailTo, $subject, $message, $headers, '-f' . $mailFromEnd);


exit("Return value=$r");


?>