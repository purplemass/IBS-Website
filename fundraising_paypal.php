<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

$count = $_REQUEST['num_cart_items'];
$total_amt = $_REQUEST['mc_gross'] . " " . $_REQUEST['mc_currency'];
$payment_status = $_REQUEST['payment_status'];
$payment_date = $_REQUEST['payment_date'];
$buyer_name = $_REQUEST['first_name'].' '.$_REQUEST['last_name'];
$email_addr = $_REQUEST['option_selection1_1'];
$guest_list = $_REQUEST['option_selection2_1'];
$shipping_address = $_REQUEST['address_name'].'<br>'.
                    $_REQUEST['address_street'].'<br>'.
                    $_REQUEST['address_city'].'<br>'.
                    $_REQUEST['address_state'].'<br>'.
                    $_REQUEST['address_zip'].'<br>'.
                    $_REQUEST['address_country'];

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
		$sql_cmd = ("	INSERT INTO $db_table_community(dt, mdt, email)
						VALUES(
						
							NOW(),
							NOW(),
							'" . $email . "',
							
						)");

		mysql_query($sql_cmd);
		
		$pid = mysql_insert_id();
		insert_amount($pid, $amount);

	}
	
	insert_value('donor', 1);
	
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