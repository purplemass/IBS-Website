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
								<span class="form_text">Please enter your email below:</span>
							</li>
							<li class="no_list">
								<label for='email'>Email address<span class="mandatory">*</span>:</label>
								<input id="email" name="email" type="text" size="27" value="<?php echo_value('email', TRUE); ?>" />
							</li>
							<li class="no_list">
								&nbsp;<span class="mandatory">*</span> denotes mandatory fields
							</li>
						</ol>
					</fieldset>
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
					<input type="hidden" name="page_flag" value="password_reminder">
					</form>
				</div>
			</div>
		</div>
