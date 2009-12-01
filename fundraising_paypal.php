<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

if (isset($_REQUEST['transaction_subject']) && isset($_REQUEST['mc_gross'])) {

	$email	= mysql_real_escape_string($_REQUEST['transaction_subject']);
	$amount	= mysql_real_escape_string($_REQUEST['mc_gross']);
	
	$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='" . $email . "'"));
	
	// email exists
	if ($row['email'])
	{
		$pid = $row['id'];
		insert_amount($pid, $amount);
	}
	// email doesn't exist
	else
	{
		mysql_query("	INSERT INTO $db_table_community(dt, email, title, forename, surname, country, regIP)
						VALUES(
						
							NOW(),
							'" . $email . "',
							'',
							'',
							'',
							'',
							'" . $_SERVER['REMOTE_ADDR'] . "'
							
						)");
						
		$pid = mysql_insert_id();
		insert_amount($pid, $amount);
	}
	
	//send email
	
	if ($row['title'] && $row['forename'] && $row['surname'])
		$name = $row['title'] . ' ' . $row['forename'] . ' ' .$row['surname'];
	else
		$name = 'Subscriber';

	$from		= EMAIL_FROM;
	$to			= $email;
	$subject	= 'IBS Project - Donation Received';
	$body 		= <<<EOF
Dear $name,

We have recieved your donation of £{$amount}.

Many thanks,

IBS Project Team

EOF;

	send_mail($from,$to,$subject,$body);
}
else
{
	header( 'Location: ' . REDIRECT_PAGE ) ;
}

?>