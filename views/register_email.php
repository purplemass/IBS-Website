<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

				<div id="subscribe">
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
					<form id="main_form" class="form_register" action="" method="post">
					<fieldset>
<!-- 						<legend>Email address</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<?php echo $instructions_text; ?>
							</li>
							<li class="no_list">
								<label for='email'>Email address:</label>
								<input id="email" name="email" type="text" size="30" value="<?php echo_value('email', TRUE); ?>" />
							</li>
							<li class="no_list no_list_text">
								<br />Do you have an account with IBS?
							</li>
							<li class="no_list">
								<input type="radio" class="radio" name="has_account" value="NO"<?php echo (echo_value('has_account', FALSE) == 'NO' ? ' checked' : ''); ?>>
								No, I don't have an account
							</li>
							<li class="no_list">
								<span class="label"><input type="radio" class="radio" name="has_account" value="YES"<?php echo (echo_value('has_account', FALSE) == 'YES' ? ' checked' : ''); ?>>
								Yes, my password is:</span><input id="password" name="password" type="password" size="30" value="" />
							</li>
							<li class="no_list">
								<a id="password_reminder" href="#"><br />Forgotten your password?</a>
							</li>
						</ol>
					</fieldset>
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
					<input type="hidden" id="page_flag" name="page_flag" value="check_email">
					<input type="hidden" id="sys_flag" name="sys_flag" value="register" />
					</form>
				</div>
			</div>
		</div>
