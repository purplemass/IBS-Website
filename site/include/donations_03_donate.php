<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
?>

				<a id="edit_form_button" class="buttons" href="#">edit your details</a></p>
				<form name="edit_form" id="edit_form" method="post">
					<input type="hidden" name="check_edit" value="Submit">
					<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
				</form>

<?php if ($flag=='reg_ok'): ?>
				<p><?php echo $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname']; ?>
				<p>Your details have been saved in our database.
<?php elseif ($flag=='email_ok'): ?>
				<p>Welcome back <?php echo $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname']; ?>!
<?php elseif ($flag=='forbidden'): ?>
				<p><?php echo $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname']; ?>
<?php endif; ?>

<?php if ($flag=='forbidden'): ?>
				<p>Your details have been saved in our database.</p>
				<p>Unfortunately, we are unable to accept donations from the United States and Canada at present time.</p>
				<p>Thank you very much for registering with us. We'll contact you in the future.........</p>
<?php else: ?>

				<p>Please enter the amount you'd like to donate and press the button below:</p>
				<div id="subscribe">
				<div id="error_div"></div>
<!--
					<p><img src="assets/images/button_google_checkout.gif" /></p>
					<p>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							BOB'S ACCOUNT
							<p>&pound; <input id="amount" name="amount" type="text" size="3" value="" /> .00</p>
							<input type="hidden" name="return" value="http://www.ibsproject.org">

							<input type="hidden" name="cmd" value="_donations">
							<input type="hidden" name="business" value="bob_ak@hotmail.com">
							<input type="hidden" name="lc" value="GB">
							<input type="hidden" name="item_name" value="IBS Project">
							<input type="hidden" name="currency_code" value="GBP">
							<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
							<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0"
									 name="submit" alt="PayPal - The safer, easier way to pay online.">
							<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
					</p>
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="1075419">
						<input type="image" src="https://www.sandbox.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
					</form>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="1076539">
						<input type="image" src="https://www.sandbox.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
					</form>
-->
					<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<!--
						<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
						<input type="hidden" id="first_name" name="first_name" value="<?php echo $row['forename']; ?>">
						<input type="hidden" id="last_name" name="last_name" value="<?php echo $row['surname']; ?>">
						<input type="hidden" id="country" name="country" value="<?php echo $row['country']; ?>">
						<input type="hidden" id="custom" name="custom" value="<?php echo $row['email']; ?>">
						<input type="hidden" id="notify_url" name="notify_url" value="http://www.ibsproject.org/fundraising_thankyou.php">
						
						/fundraising_thankyou.php
-->
						<p>&pound; <input id="amount" name="amount" type="text" size="3" value="" /> .00</p>
						<input type="hidden" name="return" value="http://www.ibsproject.org">
						<input type="hidden" id="custom" name="custom" value="<?php echo $row['email']; ?>">

						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="business" value="seller_1256763583_biz@hotmail.com">
						<input type="hidden" name="item_name" value="IBS Project Donation">
						<input type="hidden" name="currency_code" value="GBP">
						<input type="image" id="donate_button" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
					</form>
<?php endif; ?>
				</div>
			</div>
		</div>
