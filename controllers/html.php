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
	$loggedin = TRUE;
	$_POST['id'] = $_COOKIE[$mycookie_name];
	$_POST['name'] = $_COOKIE[$mycookie_name2];
}

//--------------------------------------------------------------
?>