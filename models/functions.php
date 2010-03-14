<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

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
		setcookie($mycookie_name, $_POST['id'], time() + $mycookie_expiry); // '/', '.localhost', 0, 0)
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
function validate_email($str)
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
 * Sends email
 *
 * @access public
 * @param string	email to
 * @param string	email from
 * @param string	subject
 * @param string	message
 * @param string	email from (server)
 * @return string	OK or ERROR
 */
function send_mail_ibs($emailTo, $emailFrom, $subject, $message, $emailFromServer='')
{
	$headers	= 	"From: IBS Project <$emailFrom>" . "\r\n" .
					"Reply-To: IBS Project <$emailFrom>" . "\r\n" .
					"X-Mailer: PHP/" . phpversion();

	#$r = mail($emailTo, $subject, $message, $headers, '-f' . $emailFromServer);
	$r = mail($emailTo, $subject, $message, $headers);
	
	if ($r == 1)
		return 'OK';
	else
		return 'ERROR';
}

/**
 * Writes to file
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function WriteFile($filename, $content)
{
	if (!@$handle = fopen($filename, 'a+')) {
		return("ERROR - Cannot open file($filename)");
	}
	if (fwrite($handle, $content) === FALSE) {
		return("ERROR - Cannot write to file($filename)");
	}
	
	return 'OK';
}

/**
 * Writes to file
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function WriteFileID($filename, $content) {
	
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

/**
 * Creats to file
 *
 * @access public
 * @param string	file name
 * @param string	file content
 * @return void
 */
function CreateFile($fd, $file)
{
	if (!is_dir($fd)) {
		mkdir($fd, 0777)
			or exit("ERROR - Cannot create directory '" . $fd . "'");
	}
	
	if (!file_exists($file)) {
		$r = WriteFile($file, '');
		chmod($file, 0755);
		return $r;
	}
	
	return 'ERROR';
}

?>