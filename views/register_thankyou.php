<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

				<div id="subscribe">
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
					<form id="main_form" class="form_register" action="" method="post">
					<fieldset>
<!-- 						<legend>Personal details</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<?php echo $instructions_text; ?>
							</li>
							<li class="no_list">
								<p>If you'd like to edit your details further, please <a id="submit" href="#">click here</a>.</p>
							</li>
						</ol>
					</fieldset>
					<input type="hidden" id="page_flag" name="page_flag" value="edit" />
					<input type="hidden" id="sys_flag" name="sys_flag" value="register" />
					<input type="hidden" id="id" name="id" value="<?php echo_value('id', TRUE); ?>" />
					</form>
				</div>
			</div>		
		</div>
