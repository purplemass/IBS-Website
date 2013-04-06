<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require_once('models/config.php');
require_once('models/db.php');
require_once('models/functions.php');
require_once('models/emails.php');

//--------------------------------------------------------------

// are we logged in?
if (isset($_COOKIE[$mycookie_name]))
{
	$cookie = $_COOKIE[$mycookie_name];

	$_POST['id'] = $cookie['id'];
	$_POST['name'] = $cookie['name'];
	$_POST['admin'] = $cookie['admin'];

	$loggedin = TRUE;

	if ($_POST['admin'] == '1')
		$admin = TRUE;
	else
		$admin = FALSE;
}

//--------------------------------------------------------------
?>