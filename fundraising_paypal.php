<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require 'models/config.php';
require 'models/db.php';
require 'models/functions.php';

//--------------------------------------------------------------

// write to temp file
$dd			= ';';
$today		= date("Y-m-d") . $dd . date("H:i:s");
$file_name	= '_temp.txt';

$r1 = $today . $dd;
$r2 = $today . $dd;

if (isset($_REQUEST))
{
	ksort($_REQUEST);
	
	foreach ($_REQUEST as $key=>$value)
	{
		if ( ($key <> 'PHPSESSID') && ($key <> 'ci_session') )
		{
			$r1 .=  $key . $dd;
			$r2 .=  $value . $dd;
		}
	}
	
	$r1 .= "\r\n";
	$r2 .= "\r\n";
	
	#echo $r1;
	#echo '<br />';
	#echo $r2;
	
	write_file($file_name, $r1 . $r2);
}

//--------------------------------------------------------------

/* http://ibsproject.org/_dev/fundraising_paypal.php?transaction_subject=b.hatamian@ibsproject.org&mc_gross=12&item_number=TAXPAYER_YES */

//--------------------------------------------------------------

if (isset($_REQUEST['transaction_subject']) && isset($_REQUEST['mc_gross'])) {

	$email	= mysql_real_escape_string(echo_value('transaction_subject'));
	$amount	= mysql_real_escape_string(echo_value('mc_gross'));
	$gift_aid = mysql_real_escape_string(echo_value('item_number'));
	$gift_aid = ($gift_aid == 'TAXPAYER_YES') ? 1 : 0;

	//--------------------------------------------------------------
	
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

	//--------------------------------------------------------------
	
	$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='" . $email . "'"));
	check_db_error();
	
	// id exists
	if ($row['email'])
	{
		$pid = $row['id'];
		insert_amount($pid, $amount, $gift_aid);
	}
	// id doesn't exist
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
		insert_amount($pid, $amount, $gift_aid);

	}
	
	insert_value('donor', 1, $pid);

	//--------------------------------------------------------------
	
	//send email to donor
	
	if ($row['title'] && $row['forename'] && $row['surname'])
		$name = (($row['title'] <> 'other') ? $row['title'] : '') . ' ' . $row['forename'] . ' ' .$row['surname'];
	else
		$name = 'Subscriber';

	$subject	= 'IBS Project - Donation Received';
	$body 		= <<<EOF
Dear $name,
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

	$r = send_mail($email, $subject, $body);

	//--------------------------------------------------------------
	
	//send email to IBS
		
	$subject = 'IBS Project automated email - Donation Received';
	$body = <<<EOF
We have recieved a donation of £{$amount} from {$name}.
<br />
EOF;

	$r = send_mail(EMAIL_AUTO, $subject, $body);

}
else
{
	header( 'Location: ' . REDIRECT_PAGE ) ;
}

//--------------------------------------------------------------

?>