<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require_once('models/db.php');
require_once('models/functions.php');
require_once('models/lists.php');

$flag = 'start';
$err = array();
$debug = true;

/////////////////////////////////////////////////////////////////////////
// check email

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
		check_db_error();			

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

if (isset($_POST['check_registration']) && $_POST['check_registration'] == 'Submit')
{
	$flag = 'email_new';

	foreach ($fields as $name => $options)
	{
		if ( isset($_POST[$name]) && ! $_POST[$name] && $options['mandatory'])
			$err[] = $options['error'];
	}

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
			check_db_error();			

		}
		
		if (isset($row['email']))
		{
			// update
			$sql_cmd = ("	UPDATE $db_table_community SET

								mdt = NOW(),
								title = '".$_POST['title']."',
								forename = '".$_POST['forename']."',
								surname = '".$_POST['surname']."',
								country = '".$_POST['country']."',
								newsletter = '".($_POST['newsletter'])."'

								WHERE email = '".$_POST['email']."'

						");
			
			mysql_query($sql_cmd);
			check_db_error();
						
			// removed this: regIP = '".$_SERVER['REMOTE_ADDR']."'

			
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
					$flag = 'forbidden';

		}
		else
		{
			// insert
			$sql_cmd = ("	INSERT INTO $db_table_community
			
							(dt, mdt, title, forename, surname, email, country, newsletter)

							VALUES(
							
								NOW(),
								NOW(),
								'".$_POST['title']."',
								'".$_POST['forename']."',
								'".$_POST['surname']."',
								'".$_POST['email']."',
								'".$_POST['country']."',
								'".$_POST['newsletter']."'							
						)");
			
			mysql_query($sql_cmd);
			
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
				$flag = 'forbidden'; //forbidden_new

		}
	}
}

/////////////////////////////////////////////////////////////////////////
// check edit registration

if (isset($_POST['check_edit']) && $_POST['check_edit'] == 'Submit')
{
	$flag = 'edit';
}

?>
<?php

// show relevant page content

$this_nav = 6;
require_once('models/html_head.php');

switch($flag)
{
	case 'start':
		require_once('models/donations_01_email.php');
		break;
	case 'email_new':
		require_once('models/donations_02_reg.php');
		break;
	case 'edit':
		require_once('models/donations_02_reg.php');
		break;
	case 'email_ok':
		require_once('models/donations_03_donate.php');
		break;
	case 'reg_ok':
		require_once('models/donations_03_donate.php');
		break;
	case 'forbidden':
		require_once('models/donations_03_donate.php');
		break;
}

require_once('models/html_tail.php');

?>