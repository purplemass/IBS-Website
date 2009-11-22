<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

				<p>If you'd like to donate, please enter your email address and click submit:</p>
				<div id="subscribe">
<?php if ($err) echo '				<div class="error_message">' . implode('<br />', $err) . '</div>'; ?>
					<form id="check_email_form" action="" method="post">
						<p><input id="email" name="email" type="text" size="27" value="<?php echo_value('email', TRUE); ?>" /></p>
						<p><input type="hidden" name="check_email" value="Submit"></p>
						<a id="check_email_button" href="#" class="buttons">Submit</a>
					</form>
				</div>
			</div>
		</div>
