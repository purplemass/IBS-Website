<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

//--------------------------------------------------------------

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

//--------------------------------------------------------------

/**
 * Set registration cookie
 *
 * @access public
 * @return void
 */
function set_cookie()
{
	global $debug;
	global $mycookie_name, $mycookie_expiry;
	global $loggedin;

	if ( ! headers_sent())
	{
		ob_start();
		setcookie($mycookie_name, $_POST['id'], $mycookie_expiry); // '/', '.localhost', 0, 0)
		$loggedin = TRUE;
		ob_end_flush();		
	}
	else
	{
		if ($debug)
		{
			var_dump(headers_list());
			exit('header already sent!!');	
		}
	}
}

//--------------------------------------------------------------

/**
 * Delete registration cookie
 *
 * @access public
 * @return void
 */
function delete_cookie()
{
	global $mycookie_name, $mycookie_expiry;

	setcookie ($mycookie_name, "", time() - 3600);
	unset($_COOKIE[$mycookie_name]);
}

//--------------------------------------------------------------

/**
 * Insert any value into community table
 *
 * @access public
 * @param string	field name
 * @param float		field value
 * @return void
 */
function insert_value($field, $value, $pid)
{
	global $db_table_community;

	$sql_cmd = ("	UPDATE $db_table_community
					SET mdt = NOW(), " . $field . " = '" . $value . "'
					
						WHERE id=" . $pid . "

					");
	
	mysql_query($sql_cmd);
	check_db_error();
}

//--------------------------------------------------------------

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

//--------------------------------------------------------------

/**
 * Checks email address for illegal chars & format
 *
 * @access public
 * @param string
 * @return bool
 */
function validate_email($str)
{
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

//--------------------------------------------------------------

/**
 * Send email
 *
 * @access public
 * @param string	email to
 * @param string	subject
 * @param string	message
 * @return string	OK or ERROR
 */
function send_mail($emailTo, $subject, $message)
{
	$R = "\r\n";
	$headers = '';
	$headers .= 'From: IBS Project <' . EMAIL_FROM . '>' . $R;
	$headers .= 'Reply-To: IBS Project <' . EMAIL_FROM . '>' . $R;
	$headers .= 'Return-Path: IBS Project <' . EMAIL_FROM . '>' . $R;
	$headers .= 'Message-ID: <' . md5(uniqid(time())) . '@' . $_SERVER['SERVER_NAME'] . '>' . $R;
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . $R;
	$headers .= 'MIME-Version: 1.0' + $R;
	$headers .= 'Date: ' . date('r', time()) . $R;
	$headers .= 'X-Mailer: PHP/' . phpversion() . $R;

	#$r = mail($emailTo, $subject, $message, $headers, '-f' . EMAIL_SERVER);
	$r = mail($emailTo, $subject, $message, $headers);
	
	if ($r == 1)
		return 'OK';
	else
		return 'ERROR';
}

//--------------------------------------------------------------

/**
 * Write to file
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function write_file($filename, $content)
{
	if (!@$handle = fopen($filename, 'a+')) {
		return("ERROR - Cannot open file($filename)");
	}
	if (fwrite($handle, $content) === FALSE) {
		return("ERROR - Cannot write to file($filename)");
	}
	
	return 'OK';
}

//--------------------------------------------------------------

/**
 * Write to file and log (not used)
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function write_file_id($filename, $content) {
	
	global $syslog_id;
	
	if (!$handle = fopen($filename, 'a'))
	{
		Logit($syslog_id, "Cannot open file($filename)", 3); # Cannot write to disk (disk full?)
	}
	if (fwrite($handle, $content) === FALSE)
	{
		Logit($syslog_id, "Cannot write to file($filename)", 3); # Cannot write to disk (disk full?)
	}
}

//--------------------------------------------------------------

/**
 * Create a file
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function create_file($fd, $file)
{
	if (!is_dir($fd)) {
		mkdir($fd, 0777)
			or exit("ERROR - Cannot create directory '" . $fd . "'");
	}
	
	if (!file_exists($file)) {
		$r = write_file($file, '');
		chmod($file, 0755);
		return $r;
	}
	
	return 'ERROR';
}

//--------------------------------------------------------------

?>