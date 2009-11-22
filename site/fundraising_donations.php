<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

$flag = 'start';
$err = array();

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
			
		// check country
		if ( ($row['country'] == 'US') || ($row['country'] == 'CA') )
		{
			if (isset($row['email']))
				$flag = 'forbidden';
			else
				$flag = 'forbidden'; //forbidden_new
		}
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
		
		// checkbox for newsletter
		if ( ! isset($_POST['newsletter']))
			$_POST['newsletter'] = 0;
		
		// check to see if record already exists
		if (isset($_POST['email']))
		{
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
		}
		
		if (isset($row['email']))
		{
			// update
			mysql_query("	UPDATE $db_table_community SET

								title = '".$_POST['title']."',
								forename = '".$_POST['forename']."',
								surname = '".$_POST['surname']."',
								country = '".$_POST['country']."',
								newsletter = '".($_POST['newsletter'])."',
								regIP = '".$_SERVER['REMOTE_ADDR']."'

								WHERE email = '".$_POST['email']."'

						");
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
					$flag = 'forbidden';

		}
		else
		{
			// insert
			mysql_query("	INSERT INTO $db_table_community(dt, email, title, forename, surname, country, newsletter, regIP)

							VALUES(
							
								NOW(),
								'".$_POST['email']."',
								'".$_POST['title']."',
								'".$_POST['forename']."',
								'".$_POST['surname']."',
								'".$_POST['country']."',
								'".$_POST['newsletter']."',
								'".$_SERVER['REMOTE_ADDR']."'
							
						)");
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
				$flag = 'forbidden'; //forbidden_new

		}
	}
}

/////////////////////////////////////////////////////////////////////////
// check edit registration
/////////////////////////////////////////////////////////////////////////
if (isset($_POST['check_edit']) && $_POST['check_edit'] == 'Submit')
{
	$flag = 'edit';
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
		require_once('include/donations_03_donate.php');
		break;
}

require_once('include/html_tail.php');

?>