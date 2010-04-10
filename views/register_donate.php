<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
				<div id="error_div"></div>
				<form id="main_form" class="form_register" action="" method="post" name="_xclick">
<!-- 				<form id="main_form" class="form_register" name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->
					<input type="hidden" id="page_flag" name="page_flag" value="donate_now">
					<input type="hidden" id="sys_flag" name="sys_flag" value="<?php echo_value('sys_flag', TRUE); ?>" />
					<input type="hidden" id="id" name="id" value="<?php echo_value('id', TRUE); ?>" />
					<fieldset>
<!-- 						<legend>Email address</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<?php echo $instructions_text; ?>
							</li>
							<li class="no_list">
<?php if ($_POST['country'] == 'US'): ?>
								<p>Thank you very much for registering with us.</p>
								<p>Unfortunately, we are unable to accept donations from the United States at present time.</p>
								<p>We'll contact you in the future ....</p>
								<p>If you'd like to edit your details, please <a id="edit_button" href="#">click here</a>.</p>
<?php else: ?>
								<p>Please enter the amount you'd like to donate and tell us if you are a UK taxpayer.
								Press the PayPal button below to go to our PayPal page for a secure transaction.</p>
							</li>
							<li class="no_list">
								<label for='amount'>Amount (&pound;):</label>
								<input id="amount" name="amount" type="text" size="3" value="" /> .00
							</li>
							<li class="no_list">
								<span id="taxpayer_yes_select">
									<input type="radio" class="radio" name="taxpayer" id="taxpayer_yes" value="YES">
									I am a UK taxpayer (we can reclaim <a href="http://www.hmrc.gov.uk/individuals/giving/gift-aid.htm">Gift Aid</a> on your donation)
								</span>
							</li>
							<li class="no_list">
								<span id="taxpayer_no_select">
									<input type="radio" class="radio" name="taxpayer" id="taxpayer_no" value="NO">
									I am not a UK taxpayer
								</span>
							</li>
							<li class="no_list">&nbsp;</li>
						</ol>
					</fieldset>

					<!-- store user's id in custom field - will be returned as transaction_subject and custom -->
					<!-- store taxpayer yes/no in item_number -->
					<input type="hidden" id="email" name="email" value="<?php echo_value('email', TRUE); ?>">
					<input type="hidden" id="tax_payer" name="tax_payer" value="">
					<input type="hidden" id="custom" name="custom" value="">

<!--
					 This appears on PayPal customer page!!
					 <input type="hidden" id="item_number" name="item_number" value="">
-->


					<input type="hidden" name="return" value="http://www.ibsproject.org">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="seller_1256763583_biz@hotmail.com">
					<input type="hidden" name="item_name" value="IBS Project Donation">
					<input type="hidden" name="currency_code" value="GBP">
<!-- 					<input class="submit_button" type="image" id="donate_button" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"> -->
					<input class="submit_button" type="image" id="donate_button" src="./assets/images/paypal.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<?php endif; ?>
				</form>
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
<!--
						<input type="hidden" id="id" name="id" value="<?php echo $row['id']; ?>">
						<input type="hidden" id="first_name" name="first_name" value="<?php echo $row['forename']; ?>">
						<input type="hidden" id="last_name" name="last_name" value="<?php echo $row['surname']; ?>">
						<input type="hidden" id="country" name="country" value="<?php echo $row['country']; ?>">
						<input type="hidden" id="custom" name="custom" value="<?php echo $row['email']; ?>">
						<input type="hidden" id="notify_url" name="notify_url" value="http://www.ibsproject.org/fundraising_thankyou.php">

						/fundraising_thankyou.php
-->
			</div>
		</div>