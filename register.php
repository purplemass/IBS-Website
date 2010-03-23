<?php

//--------------------------------------------------------------

require_once('controllers/html.php');

//--------------------------------------------------------------

$task = 'start';
$err = array();
$show_vars = TRUE;

//--------------------------------------------------------------

// check sys_flag:
//	when 'donate' sys_flag is already set to 'donate'
//	when 'register' sys_flag will not be set so set it here

if ( ! isset($_POST['sys_flag']) )
	$_POST['sys_flag'] = 'register';

//--------------------------------------------------------------

// check page_flag:
//	when 'donate' page_flag will be set to ''
//	when 'register' page_flag will not be set

if ( ( ! isset($_POST['page_flag']) ) || ($_POST['page_flag'] == '') )
	$_POST['page_flag'] = '';

//--------------------------------------------------------------

// when logged in, our task is 'reg_updated'
//	page_flag overides this

if (isset($_COOKIE[$mycookie_name]))
	$task = 'reg_updated';
	
//--------------------------------------------------------------

// decide what to do
//	listed below are all of the possible commands

switch($_POST['page_flag'])
{
	case 'start':
		// normal operation
		break;
		
	case 'check_email':
		check_email();
		if ( ($task == 'edit') && ($_POST['sys_flag'] == 'donate') )
			$task = 'donate_now';
		break;

	case 'check_registration':
		check_registration();
		break;

	case 'edit':
		$task = 'edit';
		break;

	case 'password_reminder':
		$task = 'password_reminder';
		break;
	
	case 'password_sender':
		check_password_reminder();
		break;

	case 'logout':
		delete_cookie();
		$loggedin = FALSE;
		$admin = FALSE;
		// you will never go past this point as it's done through Ajax!!!!
		die('logged out');
		//$task = 'start';
		//$err[] = 'You have successfully been logged out';
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
	global $debug, $show_vars;
	global $task, $err, $loggedin, $admin;
	global $nav_items, $image_list, $fields, $title_codes, $country_codes;
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
	
	switch($task)
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

			if ( ( ! is_donate() ) && ($task = 'edit') )
				$mymenuright = "menu_right_blank.php";

			break;
			
		case 'reg_new':
			set_cookie();
			$page_title = 'Your details';
			$instructions_text = 'Thank you for registering with us ' . get_full_name() . '.';
			$mypage = (is_donate()) ? 'register_donate.php' : 'register_thankyou.php';
			break;
			
		case 'reg_updated':
			set_user_info();
			set_cookie();
			$page_title = (is_donate()) ? 'Donation online' : 'Members area';

			if ($_POST['page_flag'] == 'check_registration')
				$instructions_text = 'Thank you for updating your profile.';
			else
				$instructions_text = 'Welcome back ' . get_full_name() . '.';

			$mypage = (is_donate()) ? 'register_donate.php' : 'register_thankyou.php';

			if ( ! is_donate())
				$mymenuright = "menu_right_links.php";
	
			break;

		// donate
		
		case 'donate_now':
			set_user_info();
			set_cookie();
			$instructions_text = 'Welcome back ' . get_full_name() . '.';
			$mypage = 'register_donate.php';
			break;
			
		// get password
		
		case 'password_reminder':
			set_user_info();
			$page_title = 'Get password reminder';
			$instructions_text = 'Please enter your email address below.';
			$mypage = 'register_password_reminder.php';
			break;

		case 'password_sender':
			set_user_info();
			$page_title = 'Get password reminder';
			$instructions_text = 'Please enter your email address below.';
			$mypage = 'register_password_reminder.php';
			break;
	}
	
	//--------------------------------------------------------------

	require_once('views/head.php');
	require_once('views/' . $mymenuleft);
	require_once('views/' . $mypage);
	require_once('views/' . $mymenuright);
	require_once('views/tail.php');

	if ($debug && $show_vars)
	{
		echo '		<div id="debug_info">';
		echo 'sys=' . $_POST['sys_flag'];
		echo '<br />page=' . $_POST['page_flag'];
		echo '<br />task=' . $task;
		echo '<br />loggedin=' . $loggedin;
		echo '<br />admin=' . $admin;
		echo '<br />[id]=' . ( (isset($_POST['id'])) ? $_POST['id'] : '' );
		echo '<br />[name]=' . ( (isset($_POST['name'])) ? $_POST['name'] : '' );
		echo '<br />[admin]=' . ( (isset($_POST['admin'])) ? $_POST['admin'] : '' );
		echo '<br />';
		echo '<br />';
		var_dump($_COOKIE);
		echo '<br />';
		echo '<br />';
/* 		var_dump($_REQUEST); */
		echo '</div>';
		echo "\n";
	}
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

	if (isset($_POST['id']))
		$row = db_fetch("SELECT * FROM " . TABLE_COMMUNITY . " WHERE id='{$_POST['id']}'");
	else if (isset($_POST['email']))
		$row = db_fetch("SELECT * FROM " . TABLE_COMMUNITY . " WHERE email='{$_POST['email']}'");
	else
		return;

	foreach ($fields as $name => $options)
	{
		if ($name <> 'password_confirm')
		{
			if ( isset($_POST[$name]) )
				$_POST[$name] = mysql_real_escape_string(echo_value($name));
			else
				$_POST[$name] = $row[$name];
		}
	}
	
	$_POST['id'] = $row['id'];
	$_POST['name'] = $row['forename'];
	$_POST['admin'] = $row['admin'];
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
	global $task, $err;

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
	$row = mysql_fetch_assoc(mysql_query("SELECT email, country, password, register FROM " . TABLE_COMMUNITY . " WHERE email='{$_POST['email']}'"));
	check_db_error();			

	// does email exist?
	if ( ! $row['email'])
	{
		if ($_POST['has_account'] == "YES")
			$err[] = 'Incorrect username or password entered'; //'This email is not registered with us'
		else
			$task = 'email_new';
	
		return;
	}

	// is registered?
	if ($row['register'] == '0')
	{
		if ($_POST['has_account'] == "YES")
			$err[] = 'You have not registered with us before';
		else
			$task = 'email_new';

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
			$task = 'reg_updated';
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
	global $task, $err;
	global $fields;

	if ( ! $_POST['id'] )
		$task = 'email_new';
	else
		$task = 'edit';

	//--------------------------------------------------------------
	// check for errors
	
	foreach ($fields as $name => $options)
	{
		if ( isset($_POST[$name]) && ! $_POST[$name] && $options['mandatory'])
			$err[] = $options['error'];
	}

	//--------------------------------------------------------------
	// check passwords
	
	if (strlen(trim($_POST['password'])) < 5)
		$err[] = 'Your password must be at least 5 characters long';
	
	if ( (trim($_POST['password_confirm']) <> '') && ( trim($_POST['password']) <> trim($_POST['password_confirm']) ) )
		$err[] = 'Your passwords do not match';
	
	//--------------------------------------------------------------
	// check email in case there's nothing set
	if ( ! $_POST['email'] )
	{
		$err = array();
		$err[] = 'There was a problem. Please re-enter your email address';
		$task = 'start';
	}

	//--------------------------------------------------------------
	
	if ( count($err) > 0 )
		return;

	//--------------------------------------------------------------
	// clean all POST vars
	
	foreach ($fields as $name => $options)
	{
		if (isset($_POST[$name]))
			$_POST[$name] = mysql_real_escape_string(trim(echo_value($name)));
	}

	//--------------------------------------------------------------
	// checkbox for newsletter

	if ( ! isset($_POST['newsletter']))
		$_POST['newsletter'] = 0;
	
	//--------------------------------------------------------------
	// check to see if record already exists: by id if already in DB

	if (intval($_POST['id']) > 0)
		$row = db_fetch("SELECT id, email, forename, admin FROM " . TABLE_COMMUNITY . " WHERE id='{$_POST['id']}'");

	//--------------------------------------------------------------
	// check to see if email already exists

	$row_email = db_fetch("SELECT id, email, forename, admin FROM " . TABLE_COMMUNITY . " WHERE email='{$_POST['email']}'");
	
	//--------------------------------------------------------------
	// update existing record

	if (isset($row['id']))
	{
		// avoid duplicate emails
		if ( isset($row_email['email']) && ($_POST['email'] <> $row['email']) )
		{
			$err[] = 'Email address is already registered. Please choose another email.';
			return;
		}
		
		$task = update_record($fields, $row, 'id');
	}

	//--------------------------------------------------------------
	// insert new record or update an existing newsletter subscription

	else
	{
		if ( isset($row_email['email']) )
			$task = update_record($fields, $row_email, 'email');
		else
			$task = insert_record($fields);

		// used for emailing
		$email = $_POST['email'];
		$name = get_full_name();
		$password = $_POST['password'];
				
		// send email to registered user
		send_registration_email($email, $name, $password);
	}

	//--------------------------------------------------------------

}

//--------------------------------------------------------------

/**
 * Insert a new user record
 *
 * @access public
 * @return void
 */
function insert_record($fields)
{
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

	$sql_cmd = ("	INSERT INTO " . TABLE_COMMUNITY . "

					(dt, mdt, register, " . $sql_top . ")

					VALUES(

						NOW(),
						NOW(),
						1,
						" . $sql_cmd . "
				)");
	
	mysql_query($sql_cmd);
	check_db_error();
	
	// used for cookies
	$_POST['id'] = mysql_insert_id();
	$_POST['name'] = $_POST['forename'];
	$_POST['admin'] = '0';
	
	return('reg_updated');
}

//--------------------------------------------------------------

/**
 * Update user record
 *
 * @access public
 * @return void
 */
function update_record($fields, $row, $insert_by)
{
	$sql_cmd = '';
	foreach ($fields as $name => $options)
	{
		if ($name <> 'password_confirm')
			$sql_cmd .= $name . ' = \'' .$_POST[$name] . '\',';
	}

	// remove last ,
	$sql_cmd = substr_replace($sql_cmd ,"",-1);

	$sql_cmd = ("	UPDATE " . TABLE_COMMUNITY . " SET

					mdt = NOW(),
					
					" . $sql_cmd . "
					
					WHERE " . $insert_by . " = '".$_POST[$insert_by]."'

			");

	mysql_query($sql_cmd);
	check_db_error($sql_cmd);

	// must set register for newsletter subscribers (insert_by email)
	if ($insert_by == 'email')
		insert_value('register', '1', $row['id']);
	
	// used for cookies
	$_POST['id'] = $row['id'];
	$_POST['name'] = $row['forename'];
	$_POST['admin'] = $row['admin'];

	return('reg_updated');
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
	global $task, $err, $debug;
	
	$task = 'password_sender';

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
		$row = db_fetch("SELECT email, password, title, forename, surname FROM " . TABLE_COMMUNITY . " WHERE email='{$_POST['email']}'");

		// if email exists, check password
		if ($row['email'])
		{
			$name = $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname'];
			send_password_email($row['email'], $name, $row['password']);
			$err[] = 'A password reminder has been sent to your registered email address';
			$task = 'start';
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

?>