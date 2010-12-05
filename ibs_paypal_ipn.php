<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require 'models/config.php';
require 'models/db.php';
require 'models/functions.php';
require 'models/emails.php';

//--------------------------------------------------------------

$temp_file_name	= '_subscriptions/_paypal.txt';

//--------------------------------------------------------------

/* test with these:

	// tickets
	http://localhost:8888/ibs/ibs_paypal_ipn.php?txn_type=cart

	// donations
	http://localhost:8888/ibs/ibs_paypal_ipn.php?custom=b.hatamian@ibsproject.org|TAXPAYER_YES&mc_gross=12
	http://localhost:8888/ibs/ibs_paypal_ipn.php?custom=bob_ak@hotmail.com|TAXPAYER_NO&mc_gross=12
	http://ibsproject.org/_dev/ibs_paypal_ipn.php?custom=b.hatamian@ibsproject.org|TAXPAYER_YES&mc_gross=12&address_name=bob

*/

//--------------------------------------------------------------
// test to see if it's for donations/tickets
// we'll redirect otherwise
//--------------------------------------------------------------

//--------------------------------------------------------------
//  this is for tickets
//--------------------------------------------------------------
if ( isset($_REQUEST['txn_type']) AND ($_REQUEST['txn_type'] == 'cart'))
{
	$_REQUEST['IPN_TYPE'] = 'TICKETS';
	do_tickets();
}
//--------------------------------------------------------------
//  this is for donations
//--------------------------------------------------------------
//else if (isset($_REQUEST['custom']) && isset($_REQUEST['mc_gross'])) // or 'transaction_subject'
else if ( isset($_REQUEST['txn_type']) AND ($_REQUEST['txn_type'] == 'web_accept'))
{
	$_REQUEST['IPN_TYPE'] = 'DONATIONS';
	do_donations();
}
else
{
	$_REQUEST['IPN_TYPE'] = 'REDIRECT';
	header( 'Location: ' . REDIRECT_PAGE );
}

// write temp file for our records
write_temp_file($temp_file_name);
exit(1);

//--------------------------------------------------------------

function do_tickets()
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
	
	$body  = "<html><body>";
	
	$body .= "<p>Thank you for purchasing tickets for the IBS event. Below are the details of your purchase.</p>";
	
	$body .= "<table>";
	$body .= "<tr><td><b>Name</b></td><td>$buyer_name</td></tr>";
	$body .= "<tr><td><b>Email Address</b></td><td>$email_addr</td></tr>";
	$body .= "<tr valign=\"top\"><td><b>Shipping Address</b></td><td>$shipping_address</td></tr>";
	$body .= "<tr><td><b>Items in cart</b></td><td>$count</td></tr>";
	for ($i=1; $i<=$count; $i++)
	{
	    $item     = $_REQUEST['item_name'.$i];
	    $quantity = $_REQUEST['quantity'.$i];
	    $amount   = $_REQUEST['mc_gross_'.$i] . " " . $_REQUEST['mc_currency'];
	    
	    $body .= "<tr bgcolor=\"#6699CC\"><td><b>Item</b></td><td>$i</td></tr>";
	    $body .= "<tr><td><b>Item</b></td><td>$item</td></tr>";
	    $body .= "<tr><td><b>Quantity</b></td><td>$quantity</td></tr>";
	    $body .= "<tr><td><b>Amount</b></td><td>$amount</td></tr>";
	}
	$body .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	$body .= "<tr><td><b>Total Amount</b></td><td>$total_amt</td></tr>";
	$body .= "<tr><td><b>Payment Status</b></td><td>$payment_status</td></tr>";
	$body .= "<tr><td><b>Payment Date</b></td><td>$payment_date</td></tr>";
	$body .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	$body .= "<tr><td><b>Guest List</b></td><td>$guest_list</td></tr>";
	$body .= "</table>";
	
	
	/*
	$body .= "<table>";
	foreach ($_REQUEST as $key => $value)
	{
	    $body .= "<tr><td>$key</td><td>$value</td></tr>";
	}
	$body .= "</table>";
	*/
	
	
	$body .= "</body></html>";
	
	// send email to admin
	
	$to			= "p.paykari@ibsproject.org,katypalizban@yahoo.co.uk,b.hatamian@ibsproject.org,mankassarian@aol.com,rezzzza@yahoo.com";
	//$to			= "p.paykari@ibsproject.org,katypalizban@yahoo.co.uk,b.hatamian@ibsproject.org";
	//$to			= "b.hatamian@ibsproject.org";
	$subject	= "IBS Project - Tickets Purchased";
	$body 		= $body;
	
	send_mail($to, $subject, $body);
	
	// send email to buyer
	
	$to			= $email_addr;
	$subject	= "IBS Project - Tickets Purchased - Thank You";
	
	send_mail($to, $subject, $body);
	
}

//--------------------------------------------------------------

function do_donations()
{
	$amount	= mysql_real_escape_string(safe('mc_gross'));
	$custom = mysql_real_escape_string(safe('custom')); // or 'transaction_subject'
	$custom = explode('|', $custom);

	$email	= $custom[0];
	$gift_aid = $custom[1]; // was item_number but it appears in PayPal customer page
	$gift_aid = ($gift_aid == 'TAXPAYER_YES') ? 1 : 0;

	//--------------------------------------------------------------
	
	$row = mysql_fetch_assoc(mysql_query("SELECT id, email, title, forename, surname FROM " . TABLE_COMMUNITY . " WHERE email='" . $email . "'"));
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
		$sql_cmd = ("	INSERT INTO " . TABLE_COMMUNITY . " (dt, mdt, email)
						VALUES(
						
							NOW(),
							NOW(),
							'" . $email . "',
							
						)");

		mysql_query($sql_cmd);
		check_db_error();
		
		$pid = mysql_insert_id();
		insert_amount($pid, $amount, $gift_aid);

	}
	
	insert_value('donor', 1, $pid);

	//--------------------------------------------------------------
	// paypal address fields

	if (isset($_REQUEST['address_name']))
	{
		$fields = array(
					'first_name',
					'last_name',
					'payer_email',
					'address_name',
					'address_street',
					'address_city',
					'address_state',
					'address_zip',
					'address_country',
					'address_country_code',
					'residence_country',
					'address_status'
				);

		$sql_cmd = '';
		$sql_top = '';
		foreach ($fields as $name)
		{
			$sql_top .= $name . ',';
			if (isset($_REQUEST[$name]))
				$sql_cmd .= '\'' . mysql_real_escape_string(safe($name)) . '\',';
			else
				$sql_cmd .= '\'\',';
		}

		// remove last ,
		$sql_cmd = substr_replace($sql_cmd ,"",-1);
		$sql_top = substr_replace($sql_top ,"",-1);

		$sql_cmd = ("	INSERT INTO " . TABLE_PAYPAL . "

						(dt, pid, " . $sql_top . ")

						VALUES(

							NOW(),
							" . $pid . ",
							" . $sql_cmd . "
					)");

/*
		$sql_cmd = '';
		foreach ($update_these as $name)
			$sql_cmd .= $name . ' = \'' .$_REQUEST[$name] . '\',';

		// remove last ,
		$sql_cmd = substr_replace($sql_cmd ,"",-1);

		$sql_cmd = ("	UPDATE " . TABLE_PAYPAL . " SET

						mdt = NOW(),

						" . $sql_cmd . "

						WHERE id = '". $pid ."'

				");
*/

		mysql_query($sql_cmd);
		check_db_error($sql_cmd);

	}

	//--------------------------------------------------------------
	
	//send emails (to donor & IBS)

	if ($row['title'] && $row['forename'] && $row['surname'])
		$name = get_full_name($row);
	else
		$name = 'Subscriber';
	
	//send_email_auto_donor($name, $amount);
	//send_email_donor($email, $name, $amount);
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

?>