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

	if( empty($_REQUEST[$str]) || (! isset($_REQUEST[$str])) || (! $_REQUEST[$str]) )
		$ret = '';
	else
		$ret = (htmlentities($_REQUEST[$str], ENT_QUOTES, 'UTF-8')); #strip_tags
	
	if ($echo_it === TRUE)
		echo $ret;
	else
		return $ret;
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
	
	mysql_query("	INSERT INTO $db_table_donations(dt, pid, amount, regIP)
					VALUES(
					
						NOW(),
						'" . $pid . "',
						'" . $amount . "',
						'" . $_SERVER['REMOTE_ADDR'] . "'
						
					)");
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
 * Sens simple email
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
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}

?>