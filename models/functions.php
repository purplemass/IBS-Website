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
	global $loggedin, $admin;

	if ( ! headers_sent())
	{
		ob_start();
		setcookie($mycookie_name . '[id]' , $_POST['id'], time() + $mycookie_expiry); // '/', '.localhost', 0, 0)
		setcookie($mycookie_name . '[name]' , $_POST['forename'], time() + $mycookie_expiry); // '/', '.localhost', 0, 0)
		setcookie($mycookie_name . '[admin]' , $_POST['admin'], time() + $mycookie_expiry); // '/', '.localhost', 0, 0)
		ob_end_flush();

		$loggedin = TRUE;
		
		if ($_POST['admin'] == '1')
			$admin = TRUE;
		else
			$admin = FALSE;

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

	setcookie ($mycookie_name . '[id]', "", time() - 3600);
	setcookie ($mycookie_name . '[name]', "", time() - 3600);
	setcookie ($mycookie_name . '[admin]', "", time() - 3600);

	unset($_COOKIE[$mycookie_name . '[id]']);
	unset($_COOKIE[$mycookie_name . '[name]']);
	unset($_COOKIE[$mycookie_name . '[admin]']);
}

//--------------------------------------------------------------

/**
 * Get full name
 *
 * @access public
 * @return string		result
 */
function get_full_name($row='')
{
	if ($row == '')
	{
		$ret = ($_POST['title'] <> 'Other') ? $_POST['title'] . ' ' : '';
		$ret .= $_POST['forename'] . ' ' . $_POST['surname'];
	}
	else
	{
		$ret = ($row['title'] <> 'Other') ? $row['title'] . ' ' : '';
		$ret .= $row['forename'] . ' ' . $row['surname'];
	}
	
	return $ret;
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
/* 	$headers .= 'Content-type: text/html; charset=iso-8859-1' . $R; */
	$headers .= 'Content-type: text/html; charset=utf-8' . $R;
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

/**
 * List files in folder
 *
 * @access public
 * @param string	folder name
 * @return array	list of files
 */
function directory_listing($dir)
{
	$files = array();
	
	if ($handle = opendir($dir))
	{
		while (false !== ($file = readdir($handle)))
			array_push($files, $file);
		
		closedir($handle);
	}
	
	return $files;
}

//--------------------------------------------------------------

?>