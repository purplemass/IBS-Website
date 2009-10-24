<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK',true);

require 'admin/db.php';
require 'admin/functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined

$err = array();


/////////////////////////////////////////////////////////////////////////
// check emailAddress
/////////////////////////////////////////////////////////////////////////

if (isset($_POST['check_email']) && $_POST['check_email'] == 'Submit')
{
	
	if( ! $_POST['emailAddress'])
	{
		$err[] = 'Please enter your email address';
	}

	if( ! count($err) && ! checkEmail($_POST['emailAddress']))
	{
		$err[] = 'Your email is not valid';
	}
	
	if( ! count($err))
	{
		// check emailAddress
		$_POST['emailAddress'] = mysql_real_escape_string($_POST['emailAddress']);
		
		// Escaping all input data
		$row = mysql_fetch_assoc(mysql_query("SELECT email FROM ibs_community WHERE email='{$_POST['emailAddress']}'"));
		
		if($row['email'])
		{
			echo 'email found!';
		}
		else
		{

/////////////////////////////////////////////////////////////////////////
// check emailAddress
/////////////////////////////////////////////////////////////////////////
			echo 'email not found!';
		}
		
	}

}
else if (isset($_POST['submit']) && $_POST['submit'] == 'Register')
{

}

?>
<?php
require_once('html_head.php');
?>
			<div id="menuleft">&nbsp;</div>
			<div id="content">
				<div id="title">
					<div class="text">Donations</div>
				</div>
				<div id="body">
					<p>If you'd like to donate, please enter your email address and click submit:</p>
					<div id="subscribe">
<?php if ($err) echo '<div class="err">' . implode('<br />', $err) . '</div>'; ?>
						<form id="subscriptionform" class="clearfix" action="" method="post">
							<p><input id="emailAddress" name="emailAddress" type="text" size="27" value="<?php echoValue('emailAddress'); ?>" /></p>
							<p><input type="submit" name="check_email" value="Submit"></p>
						</form>
					</div>
				</div>
			</div>
<?php
require_once('html_tail.php');
?>