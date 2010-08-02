<?php
	$this_nav = -1;
	require_once('controllers/html.php');
	require_once('views/head.php');
	require_once('views/menu_left_blank.php');
?>
<?php
	
	$err = '';
	$done = FALSE;
	
	// needs to be a GET so this hack had to be!
	if ( ! isset($_POST['email']) && isset($_GET['email']))
		$_POST['email'] = $_GET['email'];
		
	// check to see if the page has been submitted	
	if (echo_value('page_flag', FALSE) == 'unsubscribe')
	{
		$email = echo_value('email', FALSE);
		
		$row = db_fetch("SELECT id FROM " . TABLE_COMMUNITY . " WHERE email='{$email}'");
		
		if ($row['id'] == null)
		{
			$err = array('This email does not exist in our database!');
		}
		else
		{
			insert_value('newsletter', '0', $row['id']);
			$r = send_newsletter_auto_email($email, true);
			$done = TRUE;
		}
	}
?>
		<div id="content">
			<div id="title">
				<div class="text">Unsubscribe Newsletter Service</div>
			</div>
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>

			<div id="body">
				<form id="main_form" class="form_register" action="" method="post">
					<input type="hidden" id="page_flag" name="page_flag" value="unsubscribe">
					<input type="hidden" id="sys_flag" name="sys_flag" value="newsletter" />
					<fieldset>
						<ol>
<?php if ($done): ?>
							<li class="no_list no_list_text spaced">You have been unsubscribed from our Newsletter and will no longer receive updates from us.</li>
							<li class="no_list no_list_text spaced">Thank you for using this service.</li>
						</ol>
				</form>
<?php else: ?>

							<li class="no_list no_list_text spaced">If you do not wish to receive any further issues of our Newsletter, please fill in your e-mail address underneath and click on submit.</li>
							<li class="no_list">
								<label for='email'>Email address:</label>
								<input id="email" name="email" type="text" size="30" value="<?php echo_value('email', TRUE); ?>" />
							</li>
						</ol>
				</form>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<a id="submit" href="#" class="buttons submit_button">Submit</a>				
<?php endif ?>
			</div>
		</div>
<?php
	require_once('views/menu_right_blank.php');
	require_once('views/tail.php');
?>