<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
				<form id="main_form" class="form_register" action="" method="post">
					<fieldset>
<!-- 						<legend>Email address</legend> -->
						<ol>
							<li class="no_list no_list_text">
								Please enter your email address below.
							</li>
							<li class="no_list">
								<p>You'll receive an email notification with your password after you submit.</p>
							</li>
							<li class="no_list">
								<label for='email'>Email address:</label>
								<input id="email" name="email" type="text" size="27" value="<?php echo_value('email', TRUE); ?>" />
							</li>
							<li class="no_list">&nbsp;</li>
						</ol>
					</fieldset>
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
					<input type="hidden" name="page_flag" value="password_sender">
				</form>
			</div>
		</div>
