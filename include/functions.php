<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

/**
 * Return/echos REQUEST variables
 *
 * @access public
 * @param string	name of variable
 * @param bool		echo or not
 * @return string
 */
function echo_value($str, $echo_it=FALSE)
{
	if ( empty($_POST[$str]) || (! isset($_POST[$str])) || (! $_POST[$str]) )
		$ret = '';
	else
		$ret = (htmlentities($_POST[$str], ENT_QUOTES, 'UTF-8')); #strip_tags

	if ($echo_it === TRUE)
		echo $ret;
	else
		return $ret;
}

/**
 * Insert any value into community table
 *
 * @access public
 * @param string	field name
 * @param float		field value
 * @return void
 */
function insert_value($field, $value)
{
	global $db_table_community;

	$sql_cmd = ("	INSERT INTO $db_table_community(mdt, $field)
					VALUES(

						NOW(),
						'" . $value . "',

					)");
	
	mysql_query($sql_cmd);
	check_db_error();
}

/**
 * Insert amount into DB
 *
 * @access public
 * @param int		person's id
 * @param float		amount
 * @return void
 */
function insert_amount($pid, $amount)
{
	global $db_table_donations;

	$sql_cmd = ("	INSERT INTO $db_table_donations(dt, pid, amount)
					VALUES(

						NOW(),
						'" . $pid . "',
						'" . $amount . "'

					)");
	
	mysql_query($sql_cmd);
	check_db_error();
}


/**
 * Checks email address for illegal chars & format
 *
 * @access public
 * @param string
 * @return bool
 */
function check_email($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

/**
 * Sends simple email
 *
 * @access public
 * @param string
 * @param string
 * @param string
 * @param string
 */
function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}

/**
 * Checks for DB errors - debugging only
 *
 * @access public
 * @return void
 */
function check_db_error()
{
	global $debug, $link;
	
	if ( ($debug === true) && (mysql_errno($link) <> 0) )
		echo mysql_errno($link) . ": " . mysql_error($link). "\n";
}

?>