<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require_once('models/db.php');
require_once('models/functions.php');
require_once('models/lists.php');

//--------------------------------------------------------------

$flag = 'start';
$err = array();

//--------------------------------------------------------------

// check email

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_email')
	check_email();

//--------------------------------------------------------------

// check registration

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_registration')
	check_registration();

//--------------------------------------------------------------

// send password

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'password_reminder')
	check_password_reminder();

//--------------------------------------------------------------

// check edit registration

/*
if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_edit')
	$flag = 'edit';
*/

//--------------------------------------------------------------

#echo $flag;
show_html();

//--------------------------------------------------------------

/**
 * Show html
 *
 * @access public
 * @return void
 */
function show_html()
{
	global $flag, $err, $debug;
	global $db_table_community;
	global $fields, $nav_items;
	
	global $page_title;
	
	$this_nav = 8;
	
	$instructions_text = 'Please enter your details below:';
	$mymenuleft = 'menu_left_register.php';
	$mymenuright = 'menu_right_register.php';
	$mypage = 'register_02.php';
	
	switch($flag)
	{
		case 'start':
			$page_title = 'Log in or register';
			$mymenuleft = 'menu_left_register.php';
			$mymenuright = 'menu_right_register.php';
			$mypage = 'register_01.php';
			break;
			
		case 'email_new':
			$page_title = 'Log in or register';
			break;
			
		case 'edit':
		
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
			foreach ($fields as $name => $options)
			{
				if ($options['type'] <> 'password')
				{
					if ( isset($_POST[$name]) )
						$_POST[$name] = mysql_real_escape_string($_POST[$name]);
					else
						$_POST[$name] = $row[$name];
				}
			}
			
			$instructions_text = 'Please edit your details below:';
			$page_title = 'Your details';
			break;
			
		case 'email_ok':
			$page_title = 'Your details';
			break;
			
		case 'reg_ok':
			$instructions_text = 'Thank you for updating your profile.';
			$page_title = 'Your details';
			break;
			
		case 'forbidden':
			$mypage = 'register_what.php';
			break;

		case 'password_reminder':
			$page_title = 'Get password reminder';
			$mypage = 'register_password_reminder.php';
			break;
	}
	
	require_once('views/head.php');
	require_once('views/' . $mymenuleft);
	require_once('views/' . $mypage);
	require_once('views/' . $mymenuright);
	require_once('views/tail.php');
}

/**
 * Check user's email
 *
 * @access public
 * @return void
 */
function check_email()
{
	global $flag, $err, $debug;
	global $db_table_community;
	
	if ( ! $_POST['email'] )
		$err[] = 'Please enter your email address';

	if ( ! count($err) && ! validate_email($_POST['email']) )
		$err[] = 'Please enter a valid email address';

	// check has_account
	if ( ! isset($_POST['has_account']) )
	{
		$err[] = 'Please select whether you have an account with us';
	}
	else
	{
		if ( ( $_POST['has_account'] == "YES" ) && ( ! $_POST['password'] ) )
			$err[] = 'Please enter your password';
	}
	
	// look up email in DB	
	if ( ! count($err) )
	{
		// check email
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		
		// Escaping all input data
		$row = mysql_fetch_assoc(mysql_query("SELECT email, country, password FROM $db_table_community WHERE email='{$_POST['email']}'"));
		check_db_error();			

		// check country first
		if ( ($row['country'] == 'US') || ($row['country'] == 'CA') )
		{
			if (isset($row['email']))
				$flag = 'forbidden';
			else
				$flag = 'forbidden'; //forbidden_new
		}

		// if email exists, check password
		if ($row['email'])
		{
			if ( ($row['password'] <> null) && ($_POST['password'] <> $row['password']) )
			{
				$err[] = 'Incorrect username or password entered';
			}
			else
			{
				if ($_POST['has_account'] == "NO")
					$err[] = 'Email address is already registered, please log in';
				else
					$flag = 'edit';
			}
		}
		else
		{
			if ($_POST['has_account'] == "YES")
				$err[] = 'Incorrect username or password entered';
			else
				$flag = 'email_new';
		}
	}
}

	
/**
 * Check to see if user has registered
 *
 * @access public
 * @return void
 */
function check_registration()
{
	global $flag, $err, $debug;
	global $db_table_community;
	global $fields;

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
		
		foreach ($fields as $name => $options)
		{
			if (isset($_POST[$name]))
				$_POST[$name] = mysql_real_escape_string($_POST[$name]);
		}

		// checkbox for newsletter
		if ( ! isset($_POST['newsletter']))
			$_POST['newsletter'] = 0;
		
		// check to see if record already exists
		if (isset($_POST['email']))
		{
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
			check_db_error();
		}
		
		// update record
		if (isset($row['email']))
		{	
			$sql_cmd = '';
			foreach ($fields as $name => $options)
			{
				if ($name <> 'password_confirm')
					$sql_cmd .= $name . ' = \'' .$_POST[$name] . '\',';
			}
	
			// remove last ,
			$sql_cmd = substr_replace($sql_cmd ,"",-1);

			$sql_cmd = ("	UPDATE $db_table_community SET

								mdt = NOW(),
								
								" . $sql_cmd . "
								
								WHERE email = '".$_POST['email']."'

						");
			
			mysql_query($sql_cmd);
			check_db_error($sql_cmd);
						
			// removed this: regIP = '".$_SERVER['REMOTE_ADDR']."'
			
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
					$flag = 'forbidden';
		}
		// insert records
		else
		{
			$sql_cmd = ("	INSERT INTO $db_table_community
			
							(dt, mdt, title, forename, surname, email, password, address1, address2, city, postcode, country, newsletter)

							VALUES(
							
								NOW(),
								NOW(),
								'".$_POST['title']."',
								'".$_POST['forename']."',
								'".$_POST['surname']."',
								'".$_POST['email']."',
								'".$_POST['password']."',
								'".$_POST['address1']."',
								'".$_POST['address2']."',
								'".$_POST['city']."',
								'".$_POST['postcode']."',
								'".$_POST['country']."',
								'".$_POST['newsletter']."'							
						)");
			
			mysql_query($sql_cmd);
			check_db_error();
			
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
				$flag = 'forbidden'; //forbidden_new
			
			// send email
			send_registration_email();
		}
	}
}


/**
 * Show html
 *
 * @access public
 * @return void
 */
function check_password_reminder()
{
	global $flag, $err, $debug;
	global $db_table_community;
	
	$flag = 'password_reminder';

	if ( ! $_POST['email'] )
		$err[] = 'Please enter your email address';

	if ( ! count($err) && ! validate_email($_POST['email']) )
		$err[] = 'Please enter a valid email address';

	// look up email in DB	
	if ( ! count($err) )
	{
		// check email
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		
		// Escaping all input data
		$row = mysql_fetch_assoc(mysql_query("SELECT email, password, title, forename, surname FROM $db_table_community WHERE email='{$_POST['email']}'"));
		check_db_error();			
		// if email exists, check password
		if ($row['email'])
		{
			$name = $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname'];
			send_password_email($name, $row['password']);
			$err[] = 'A password reminder has been sent to your registered email address';
			$flag = 'start';
		}
		else
		{
			$err[] = 'Not a registered email address';
		}
	}
	
}

/**
 * Send registration email
 *
 * @access public
 * @return void
 */
function send_password_email($name, $password)
{
	global $emailFrom;
	
	$emailto = $_POST['email'];
	$subject = 'Password reminder for IBS Project website';
	$message = <<<EOF
Dear {$name},

Here is a reminder of your password for the Iranian Business School website:

Password: {$password}

Kind regards,

IBS Project Team
http://www.ibsproject.org

EOF;

	SendEmail($emailto, $emailFrom, $subject, $message);
}

/**
 * Send registration email
 *
 * @access public
 * @return void
 */
function send_registration_email()
{
	global $emailFrom;
	
	$emailto = $_POST['email'];
	$subject = 'Thank you for registering';
	$message = <<<EOF
Dear {$_POST['title']} {$_POST['forename']} {$_POST['surname']},

Thank you for registering with the Iranian Business School Project website. Your details will be added to our database and you will receive all future information and updates.

Email address: {$_POST['email']}
Password: {$_POST['password']}

Kind regards,

IBS Project Team
http://www.ibsproject.org

EOF;

	SendEmail($emailto, $emailFrom, $subject, $message);
}
?>