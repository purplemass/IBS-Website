<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php

$instructions_text = 'enter';

if ($flag == 'edit')
{
	$instructions_text = 'edit';

	$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
	$_POST['email']			= $row['email'];
	$_POST['forename']		= $row['forename'];
	$_POST['surname']		= $row['surname'];
	$_POST['title']			= $row['title'];
	$_POST['country']		= $row['country'];
	$_POST['newsletter']	= $row['newsletter'];
}
?>
<?php
require_once('include/lists.php');
?>

				<p>Please <?php echo $instructions_text; ?> your details and click the submit button below:</p>
				<div id="subscribe">
<?php if ($err) echo '				<div class="error_message">' . implode('<br />', $err) . '</div>'; ?>

					<form id="registration_form" action="" method="post">
						<p>
							<select id="title" name="title">
<?php
foreach ($title_codes as $title => $code)
{
	$selected = '';

	if (isset($_POST['title']) && $_POST['title'] == $code)
		$selected = ' selected';
	
	echo '								<option value="' . $code . '"' . $selected . '>' . $title . '</option>' . "\n";
}
?>
							</select>
						</p>
						<p>
							<label for="forename">Forename:</label><br />
							<input id="forename" name="forename" type="text" size="27" value="<?php echo_value('forename', TRUE); ?>" />
						</p>
						<p>
							<label for="surname">Surname:</label><br />
							<input id="surname" name="surname" type="text" size="27" value="<?php echo_value('surname', TRUE); ?>" />
						</p>
						<p>
							<label for="country">Country of residence:</label><br />
							<select id="country" name="country">
<?php
foreach ($country_codes as $country => $code)
{
	$selected = '';

	if (isset($_POST['country']) && $_POST['country'] == $code)
		$selected = ' selected';
	
	echo '								<option value="' . $code . '"' . $selected . '>' . $country . '</option>' . "\n";
}
?>
							</select>
						</p>
<?php
$newsletter = 'checked';
if (isset($_POST['newsletter']))
	$newsletter = ($_POST['newsletter'] == 1) ? 'checked' : '';
?>
						<p>
							Subscribe to IBS Newsletter <input type="checkbox" name="newsletter" value="1" <?php echo $newsletter; ?>>
						</p>
						<p>
							<input type="hidden" name="email" value="<?php echo_value('email', TRUE); ?>" />
							<input type="hidden" name="check_registration" value="Submit" />
							<a id="registration_form_button" href="#" class="buttons">Submit</a>
<!--
							<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
-->
						</p>
					</form>
				</div>
			</div>		
		</div>
