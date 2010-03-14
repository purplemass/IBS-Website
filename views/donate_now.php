<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

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
<!-- 								<?php echo_value('title', TRUE); ?> <?php echo_value('forename', TRUE); ?> <?php echo_value('surname', TRUE); ?> -->
							</li>
							<li class="no_list">
<?php if ($_POST['country'] == 'US'): ?>
								<p>Unfortunately, we are unable to accept donations from the United States at present time.</p>
								<p>Thank you very much for registering with us. We'll contact you in the future.........</p>
								<p>If you'd like to edit your details further, please <a id="edit_button" href="#">click here</a>.</p>
								<p>If you'd like to log out, please <a id="logout" href="#">click here</a>.</p>
<?php else: ?>
								<p>Please enter the amount you'd like to donate and press the submit button:</p>
							</li>
							<li class="no_list">
								<label for='amount'>Amount:</label>
								<p>&pound; <input id="amount" name="amount" type="text" size="3" value="" /> .00</p>
							</li>
							<li class="no_list">&nbsp;</li>
<!-- 							<li class="no_list"><p>If you'd like to log out, please <a id="logout" href="#">click here</a>.</p></li> -->
						</ol>
					</fieldset>

					<input type="hidden" name="return" value="http://www.ibsproject.org">
					<input type="hidden" id="custom" name="custom" value="<?php echo $row['email']; ?>">

					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="seller_1256763583_biz@hotmail.com">
					<input type="hidden" name="item_name" value="IBS Project Donation">
					<input type="hidden" name="currency_code" value="GBP">
<!-- 					<input class="submit_button" type="image" id="donate_button" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!"> -->
					<input class="submit_button" type="image" id="donate_button" src="./assets/images/paypal.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<?php endif; ?>
<!-- 					<a id="submit" href="#" class="buttons submit_button">Submit</a> -->
				</form>