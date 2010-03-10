<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require_once('include/db.php');
require_once('include/functions.php');
require_once('include/lists.php');

$flag = 'start';
$err = array();
$debug = true;

/////////////////////////////////////////////////////////////////////////
// check email

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_email')
{
	// check email
	if ( ! $_POST['email'] )
		$err[] = 'Please enter your email address';

	if ( ! count($err) && ! check_email($_POST['email']) )
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

		// if email exists, check password
		if ($row['email'])
		{
/* 			$row['email'] */
			$flag = 'email_ok';
		}
		else
		{
			$flag = 'email_new';
		}
			
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

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_registration')
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
		
		foreach ($fields as $name => $options)
			$_POST[$name] = mysql_real_escape_string($_POST[$name]);
/*
			$_POST['forename'] = mysql_real_escape_string($_POST['forename']);
			$_POST['surname'] = mysql_real_escape_string($_POST['surname']);
			$_POST['country'] = mysql_real_escape_string($_POST['country']);
			$_POST['email'] = mysql_real_escape_string($_POST['email']);
*/

		// checkbox for newsletter
		if ( ! isset($_POST['newsletter']))
			$_POST['newsletter'] = 0;
		
		// check to see if record already exists
		if (isset($_POST['email']))
		{
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
			check_db_error();
		}

		$sql_cmd = '';
		foreach ($fields as $name => $options)
			$sql_cmd .= $name . ' = ' .$_POST[$name] . ',';

		// update		
		if (isset($row['email']))
		{
				
/*
			$sql_cmd = ("	UPDATE $db_table_community SET

								mdt = NOW(),
								title = '".$_POST['title']."',
								forename = '".$_POST['forename']."',
								surname = '".$_POST['surname']."',
								country = '".$_POST['country']."',
								newsletter = '".($_POST['newsletter'])."'

								WHERE email = '".$_POST['email']."'

						");
*/
			
			$sql_cmd = ("	UPDATE $db_table_community SET

								mdt = NOW(),
								
								" . $sql_cmd . "
								
								WHERE email = '".$_POST['email']."'

						");
			
			mysql_query($sql_cmd);
			check_db_error();
						
			// removed this: regIP = '".$_SERVER['REMOTE_ADDR']."'

			
			// check country
			if ( ($_POST['country'] == 'US') || ($_POST['country'] == 'CA') )
					$flag = 'forbidden';

		}
		// insert
		else
		{
/*
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
*/
			
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

		}
	}
}

/////////////////////////////////////////////////////////////////////////
// check edit registration

if (isset($_POST['page_flag']) && $_POST['page_flag'] == 'check_edit')
{
	$flag = 'edit';
}

/////////////////////////////////////////////////////////////////////////
// show relevant page content

$page_title = 'Log in or register';
$this_nav = 8;

echo $flag;

switch($flag)
{
	case 'start':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_01.php';
		break;
		
	case 'email_new':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_02.php';
		break;
		
	case 'edit':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_02.php';
		break;
		
	case 'email_ok':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_03.php';
		break;
		
	case 'reg_ok':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_03.php';
		break;
		
	case 'forbidden':
		$mymenuleft = 'menu_left_register.php';
		$mymenuright = 'menu_right_register.php';
		$mypage = 'register_03.php';
		break;
}

require_once('html/head.php');
require_once('html/' . $mymenuleft);
require_once('html/' . $mypage);
require_once('html/' . $mymenuright);
require_once('html/tail.php');

?>