<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php
require_once('include/lists.php');
?>

			<div id="content">
				<div id="title">
					<div class="text">Donations</div>
				</div>
				<div id="body">
					<p>Please enter/edit your details and click the submit button below:</p>
					<div id="subscribe">
<?php if ($err) echo '					<div class="error_message">' . implode('<br />', $err) . '</div>'; ?>

						<form id="form" action="" method="post">
							<p>
								<select id="title" name="title">
<?php
foreach ($title_codes as $title => $code)
{
	$selected = '';

	if (isset($_POST['title']) && $_POST['title'] == $code)
		$selected = ' selected';
	
	echo '									<option value="' . $code . '"' . $selected . '>' . $title . '</option>' . "\n";
}
?>
								</select>
							</p>
							<p>
								<label for="forename">Forename:</label><br />
								<input id="forename" name="forename" type="text" size="27" value="<?php echo_value('forename', TRUE); ?>" />
							</p>
							<p>
								<label for="surname">Surname:</label>:<br />
								<input id="surname" name="surname" type="text" size="27" value="<?php echo_value('surname', TRUE); ?>" />
							</p>
							<p>
								<select id="country" name="country">
<?php
foreach ($country_codes as $country => $code)
{
	$selected = '';

	if (isset($_POST['country']) && $_POST['country'] == $code)
		$selected = ' selected';
	
	echo '									<option value="' . $code . '"' . $selected . '>' . $country . '</option>' . "\n";
}
?>
								</select>
							</p>
							<p>
								<input type="hidden" name="email" value="<?php echo_value('email', TRUE); ?>" />
								<input type="hidden" name="check_registration" value="Submit" />
								<input type="submit" name="submit" value="Submit" />
<!--
								<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
-->
							</p>
						</form>
					</div>
				</div>		
			</div>
