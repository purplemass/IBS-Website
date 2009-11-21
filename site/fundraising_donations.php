<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

$flag = 'start';
$err = array();

// check for edit (it's an exception!)
if (isset($_GET['flag'])) $flag = $_GET['flag'];

/////////////////////////////////////////////////////////////////////////
// check email
/////////////////////////////////////////////////////////////////////////
if (isset($_POST['check_email']) && $_POST['check_email'] == 'Submit')
{	
	if ( ! $_POST['email'] )
		$err[] = 'Please enter your email address';

	if ( ! count($err) && ! check_email($_POST['email']) )
		$err[] = 'Your email is not valid';
	
	if ( ! count($err) )
	{
		// check email
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		
		// Escaping all input data
		$row = mysql_fetch_assoc(mysql_query("SELECT email, country FROM $db_table_community WHERE email='{$_POST['email']}'"));

		if ($row['email'])
			$flag = 'email_ok';
		else
			$flag = 'email_new';
		
		if ( $row['country'] == 'US' || ($row['country'] == 'CA') )
			$flag = 'forbidden';
		
	}

}

/////////////////////////////////////////////////////////////////////////
// check registration
/////////////////////////////////////////////////////////////////////////
if (isset($_POST['check_registration']) && $_POST['check_registration'] == 'Submit')
{
	$flag = 'email_new';

	if ( ! $_POST['title'] )
		$err[] = 'Please enter your title';
	
	if ( ! $_POST['forename'] )
		$err[] = 'Please enter your forename';

	if ( ! $_POST['surname'] )
		$err[] = 'Please enter your surname';

	if ( ! $_POST['country'] )
		$err[] = 'Please enter your country';

	if ( ! $_POST['email'] )
	{
		$err = array();
		$err[] = 'There was a problem. Please re-enter your email address';
		$flag = 'start';
	}

	if ( ! count($err) )
	{
		$flag = 'reg_ok';
		
		$_POST['title'] = mysql_real_escape_string($_POST['title']);
		$_POST['forename'] = mysql_real_escape_string($_POST['forename']);
		$_POST['surname'] = mysql_real_escape_string($_POST['surname']);
		$_POST['country'] = mysql_real_escape_string($_POST['country']);
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
				
		mysql_query("	INSERT INTO $db_table_community(dt, email, title, forename, surname, country, regIP)
						VALUES(
						
							NOW(),
							'".$_POST['email']."',
							'".$_POST['title']."',
							'".$_POST['forename']."',
							'".$_POST['surname']."',
							'".$_POST['country']."',
							'".$_SERVER['REMOTE_ADDR']."'
							
						)");

		if ( $_POST['country'] == 'US' || ($_POST['country'] == 'CA') )
			$flag = 'forbidden_new';

	}
}

?>
<?php
$this_nav = 6;
require_once('include/html_head.php');

switch($flag)
{
	case 'start':
		require_once('include/donations_01_email.php');
		break;
	case 'email_new':
		require_once('include/donations_02_reg.php');
		break;
	case 'edit':
		require_once('include/donations_02_reg.php');
		break;
	case 'email_ok':
		require_once('include/donations_03_donate.php');
		break;
	case 'reg_ok':
		require_once('include/donations_03_donate.php');
		break;
	case 'forbidden':
		require_once('include/donations_04_forbidden.php');
		break;
	case 'forbidden_new':
		require_once('include/donations_04_forbidden.php');
		break;
}
require_once('include/html_tail.php');
?>