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

	http://ibsproject.org/_dev/fundraising_paypal.php?transaction_subject=b.hatamian@ibsproject.org&mc_gross=12&custom=TAXPAYER_YES&address_name=bob
	http://localhost:8888/ibs/fundraising_paypal.php?transaction_subject=b.hatamian@ibsproject.org&mc_gross=12&custom=TAXPAYER_YES
	http://localhost:8888/ibs/fundraising_paypal.php?transaction_subject=bob_ak@hotmail.com&mc_gross=12&custom=TAXPAYER_YES

*/

//--------------------------------------------------------------

if (isset($_REQUEST['transaction_subject']) && isset($_REQUEST['mc_gross'])) {

	$email	= mysql_real_escape_string(safe('transaction_subject'));
	$amount	= mysql_real_escape_string(safe('mc_gross'));
	$gift_aid = mysql_real_escape_string(safe('custom')); // was item_number but it appears in PayPal customer page
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

						(dt, mdt, pid, " . $sql_top . ")

						VALUES(

							NOW(),
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
	
	send_email_auto_donor($name, $amount);
	send_email_donor($email, $name, $amount);
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