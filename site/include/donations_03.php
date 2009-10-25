<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

			<div id="menuleft">&nbsp;</div>
			<div id="content">
				<div id="title">
					<div class="text">Donations</div>
				</div>
				<div id="body">
<?php if ($flag=='reg_ok'): ?>
					<p>Your details have been saved in our database.</p>
<?php else:
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM ibs_community WHERE email='{$_POST['email']}'"));
?>
					<p>Welcome back <?php echo $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname']; ?>!</p>
<?php endif; ?>
					<p>Please choose a method of payment below:</p>
					<div id="subscribe">
<!--
						<p>&pound; <input id="amount" name="amount" type="text" size="3" value="" /> .00</p>
						<p><img src="assets/images/button_google_checkout.gif" /></p>
-->
						<p>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
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
					</div>
				</div>
			</div>
