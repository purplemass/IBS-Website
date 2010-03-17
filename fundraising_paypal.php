<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require 'models/config.php';
require 'models/db.php';
require 'models/functions.php';
require 'models/emails.php';

//--------------------------------------------------------------

$file_name	= '_subscriptions/_paypal.txt';

write_temp_file($file_name);

//--------------------------------------------------------------

/* test with these:

	http://ibsproject.org/_dev/fundraising_paypal.php?transaction_subject=b.hatamian@ibsproject.org&mc_gross=12&item_number=TAXPAYER_YES
	http://localhost:8888/ibs/fundraising_paypal.php?transaction_subject=b.hatamian@ibsproject.org&mc_gross=12&item_number=TAXPAYER_YES

*/

//--------------------------------------------------------------

if (isset($_REQUEST['transaction_subject']) && isset($_REQUEST['mc_gross'])) {

	$email	= mysql_real_escape_string(safe('transaction_subject'));
	$amount	= mysql_real_escape_string(safe('mc_gross'));
	$gift_aid = mysql_real_escape_string(safe('item_number'));
	$gift_aid = ($gift_aid == 'TAXPAYER_YES') ? 1 : 0;

	//--------------------------------------------------------------
	
	if (isset($_REQUEST['address_name']))
	{
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
	}
	
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
	
	//send emails (to donor & IBS)

	if ($row['title'] && $row['forename'] && $row['surname'])
		$name = get_full_name($row);
	else
		$name = 'Subscriber';
	
	send_email_auto_donor($name, $amount);
	
	if ((send_email_donor($email, $name, $amount)) == 'OK')
		write_file($file_name, 'EMAIL SENT ' . $email);
}
else
{
	header( 'Location: ' . REDIRECT_PAGE );
}

//--------------------------------------------------------------

function safe($str)
{
	if (isset($_REQUEST[$str]))
		return htmlentities($_REQUEST[$str], ENT_QUOTES, 'UTF-8');
	else
		return '';
}

//--------------------------------------------------------------

function write_temp_file($file_name)
{
	// write to temp file
	$dd			= ';';
	$today		= date("Y-m-d") . $dd . date("H:i:s");
	
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
}

//--------------------------------------------------------------

?>