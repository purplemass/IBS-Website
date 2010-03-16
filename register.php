<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require_once('models/config.php');
require_once('models/db.php');
require_once('models/functions.php');

//--------------------------------------------------------------

$flag = 'start';
$err = array();

$loggedin = FALSE;

//--------------------------------------------------------------

// check sys_flag:
//		'donate' will be set
//		'register' will not be set
if ( ! isset($_POST['sys_flag']) )
	$_POST['sys_flag'] = 'register';

// check page_flag:
//		'donate' will be set to ''
//		'register' will not be set
if ( ( ! isset($_POST['page_flag']) ) || ($_POST['page_flag'] == '') )
{
	$_POST['page_flag'] = '';
	
	// are we logged in?
	if (isset($_COOKIE[$mycookie_name]))
	{
		$loggedin = TRUE;
		$_POST['id'] = $_COOKIE[$mycookie_name];
		$flag = 'reg_updated';
	}
}

//--------------------------------------------------------------

// decide what to do
// these are all the possible commands
switch($_POST['page_flag'])
{
	case 'start':
		break;
		
	case 'check_email':
		check_email();
		if ( ($flag == 'edit') && ($_POST['sys_flag'] == 'donate') )
			$flag = 'donate_now';
		break;

	case 'check_registration':
		check_registration();
		break;

	case 'edit':
		$flag = 'edit';
		break;

	case 'password_reminder':
		$flag = 'password_reminder';
		break;
	
	case 'password_sender':
		check_password_reminder();
		break;

	case 'logout':
		delete_cookie();
		$flag = 'start';
		break;
}

//--------------------------------------------------------------

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
	global $debug;
	global $flag, $err, $loggedin;
	global $nav_items, $fields, $title_codes, $country_codes;
	global $mycookie_name;

	if (is_donate())
	{
		$this_nav = 6;
		$mymenuleft = 'menu_left_donate.php';
		$mymenuright = 'menu_right_donate.php';
		$page_title = 'Donate Online';		
	}
	else
	{
		$this_nav = 8;
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$page_title = 'Log in or register';
	}
	
	switch($flag)
	{
		case 'start':
			$instructions_text = 'Please enter your email below:';
			$mypage = 'register_email.php';
			break;
			
		case 'email_new':
			$instructions_text = 'Please enter your details below';
			$instructions_text .= (is_donate()) ? ' (for your receipt):' : ':';
			$mypage = 'register_form.php';
			break;

		case 'edit':
			set_user_info();
			set_cookie();
			$page_title = 'Your details';
			$instructions_text = 'Please edit your details below:';
			$mypage = 'register_form.php';
			break;
			
		case 'reg_new':
			set_cookie();
			$page_title = 'Your details';
			$instructions_text = 'Thank you for registering with us ' . get_full_name();
			$mypage = (is_donate()) ? 'donate_now.php' : 'register_thankyou.php';
			break;
			
		case 'reg_updated':
			set_user_info();
			set_cookie();
			$page_title = (is_donate()) ? 'Online Donations' : 'Log in or register';
			$instructions_text = ($loggedin) ? 'Your are logged in as ' : 'Thank you for updating your profile ';
			$instructions_text .= get_full_name();
			$mypage = (is_donate()) ? 'donate_now.php' : 'register_thankyou.php';
			break;

		// donate
		
		case 'donate_now':
			set_user_info();
			set_cookie();
			$instructions_text = 'Welcome back ' . get_full_name();
			$mypage = 'donate_now.php';
			break;
			
		// get password
		
		case 'password_reminder':
			$page_title = 'Get password reminder';
			$instructions_text = 'Please enter your email address below.';
			$mypage = 'register_password_reminder.php';
			break;

		case 'password_sender':
			$page_title = 'Get password reminder';
			$instructions_text = 'Please enter your email address below.';
			$mypage = 'register_password_reminder.php';
			break;
	}
	
	require_once('views/head.php');
	require_once('views/' . $mymenuleft);
	if ($debug)
	{
/* 		echo 'flag=' . $flag . ' --- sys=' . $_POST['sys_flag'] . ' --- page=' . $_POST['page_flag'] . ' --- loggedin' . $loggedin .'<br />'; */
/* 		var_dump($_COOKIE); */
/* 		var_dump($_REQUEST); */
	}
	require_once('views/' . $mypage);
	require_once('views/' . $mymenuright);
	require_once('views/tail.php');
}

//--------------------------------------------------------------

/**
 * Set user info in edit form
 *
 * @access public
 * @return void
 */
function set_user_info()
{
	global $fields;
	global $db_table_community;

	if ( ! isset($_POST['id']))
		$row = db_fetch("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'");
	else
		$row = db_fetch("SELECT * FROM $db_table_community WHERE id='{$_POST['id']}'");

	foreach ($fields as $name => $options)
	{
		if ($name <> 'password_confirm')
		{
			if ( isset($_POST[$name]) )
				$_POST[$name] = mysql_real_escape_string($_POST[$name]);
			else
				$_POST[$name] = $row[$name];
		}
	}
	
	$_POST['id'] = $row['id'];
}

//--------------------------------------------------------------

/**
 * Check user's email
 *
 * @access public
 * @return void
 */
function check_email()
{
	global $debug;
	global $flag, $err;
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
	
	if ( count($err) > 0 )
		return;

	// look up email in DB	
	$_POST['email'] = mysql_real_escape_string(echo_value('email'));
	
	// Escaping all input data
	$row = mysql_fetch_assoc(mysql_query("SELECT email, country, password FROM $db_table_community WHERE email='{$_POST['email']}'"));
	check_db_error();			

	// does email exist?
	if ( ! $row['email'])
	{
		if ($_POST['has_account'] == "YES")
			$err[] = 'Incorrect username or password entered'; //'This email is not registered with us'
		else
			$flag = 'email_new';
	
		return;
	}

	// check password	
	if ( ($row['password'] <> null) && ($_POST['password'] <> $row['password']) )
	{
		if ($_POST['has_account'] == "YES")
			$err[] = 'Incorrect username or password entered';
		else
			$err[] = 'This email is registered. Please enter a password';
	}
	else
	{
		if ($_POST['has_account'] == "NO")
			$err[] = 'Email address is already registered, please log in';
		else
			$flag = 'edit';
	}
}

//--------------------------------------------------------------

/**
 * Check to see if user has registered
 *
 * @access public
 * @return void
 */
function check_registration()
{
	global $debug;
	global $flag, $err;
	global $db_table_community;
	global $fields;

	if ( ! $_POST['id'] )
		$flag = 'email_new';
	else
		$flag = 'edit';

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

	if ( count($err) > 0 )
		return;
	
	// clean all POST vars
	foreach ($fields as $name => $options)
	{
		if (isset($_POST[$name]))
			$_POST[$name] = mysql_real_escape_string(echo_value($name));
	}

	// checkbox for newsletter
	if ( ! isset($_POST['newsletter']))
		$_POST['newsletter'] = 0;
	
	// check to see if record already exists: by id if already in DB
	if (intval($_POST['id']) > 0)
		$row = db_fetch("SELECT * FROM $db_table_community WHERE id='{$_POST['id']}'");

	// update record
	if (isset($row['id']))
	{
		$_POST['id'] = $row['id'];

		// check to see if email already exists
		$row_email = db_fetch("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'");

		if ( isset($row_email['email']) && ($_POST['email'] <> $row['email']) )
		{
			$err[] = 'Email address is already registered. Please choose another email.';
		}
		else
		{
			$flag = 'reg_updated';

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
							
							WHERE id = '".$_POST['id']."'

					");
		
			mysql_query($sql_cmd);
			check_db_error($sql_cmd);
		}
	}
	// insert records
	else
	{
		$flag = 'reg_new';

		$sql_cmd = '';
		$sql_top = '';
		foreach ($fields as $name => $options)
		{
			if ($name <> 'password_confirm')
			{
				$sql_top .= $name . ',';
				$sql_cmd .= '\'' . $_POST[$name] . '\',';
			}
		}

		// remove last ,
		$sql_cmd = substr_replace($sql_cmd ,"",-1);
		$sql_top = substr_replace($sql_top ,"",-1);

		$sql_cmd = ("	INSERT INTO $db_table_community

						(dt, mdt, register, " . $sql_top . ")

						VALUES(

							NOW(),
							NOW(),
							1,
							" . $sql_cmd . "
					)");
		
		mysql_query($sql_cmd);
		check_db_error();
		
		$_POST['id'] = mysql_insert_id();
				
		// send email
		send_registration_email();
	}
}

//--------------------------------------------------------------

/**
 * Check user's email & send password
 *
 * @access public
 * @return void
 */
function check_password_reminder()
{
	global $flag, $err, $debug;
	global $db_table_community;
	
	$flag = 'password_sender';

	if ( ! $_POST['email'] )
		$err[] = 'Please enter your email address';
	else
		$_POST['email'] = echo_value('email');

	if ( ! count($err) && ! validate_email($_POST['email']) )
		$err[] = 'Please enter a valid email address';

	// look up email in DB	
	if ( ! count($err) )
	{
		// check email
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		
		// Escaping all input data
		$row = db_fetch("SELECT email, password, title, forename, surname FROM $db_table_community WHERE email='{$_POST['email']}'");

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

//--------------------------------------------------------------

/**
 * Is this a donation page?
 *
 * @access public
 * @return bool		result
 */
function is_donate()
{
	return ($_POST['sys_flag'] === 'donate') ? TRUE : FALSE;
}

//--------------------------------------------------------------

/**
 * Get full name
 *
 * @access public
 * @return string		result
 */
function get_full_name()
{
	$ret = ($_POST['title'] <> 'Other') ? $_POST['title'] . ' ' : '';
	$ret .= $_POST['forename'] . ' ' . $_POST['surname'] . '.';
	
	return $ret;
}

//--------------------------------------------------------------

/**
 * Send registration email
 *
 * @access public
 * @return void
 */
function send_password_email($name, $password)
{
	$emailto = $_POST['email'];
	$subject = 'Password reminder for IBS Project website';
	$message = <<<EOF
Dear {$name},
<br />
<br />
Here is a reminder of your password for the Iranian Business School website:
<br />
<br />
Password: {$password}
<br />
<br />
Kind regards,
<br />
<br />
IBS Project Team
<br />
http://www.ibsproject.org
<br />
EOF;

	send_mail($emailto, $subject, $message);
}

//--------------------------------------------------------------


/**
 * Send registration email
 *
 * @access public
 * @return void
 */
function send_registration_email()
{
	$emailto = $_POST['email'];
	$subject = 'Thank you for registering';
	$message = <<<EOF
Dear {$_POST['title']} {$_POST['forename']} {$_POST['surname']},
<br />
<br />
Thank you for registering with the Iranian Business School Project website. Your details will be added to our database and you will receive all future information and updates.
<br />
<br />
Email address: {$_POST['email']}
<br />
Password: {$_POST['password']}
<br />
<br />
Kind regards,
<br />
<br />
IBS Project Team
<br />
http://www.ibsproject.org
<br />
EOF;

	send_mail($emailto, $subject, $message);
}

/*

SESSIONS - IGNORE FOR NOW!

ob_start();
session_start();
session_name('tzLogin');

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1);
$_SESSION['logged_in'] = 0;
setcookie($mycookie_name, "", time() - 60, $mycookie_path, $mycookie_domain);
session_destroy();

*/


?>