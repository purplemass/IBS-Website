<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
				<form id="main_form" class="form_register" action="" method="post">
					<input type="hidden" id="page_flag" name="page_flag" value="edit" />
					<input type="hidden" id="sys_flag" name="sys_flag" value="<?php echo_value('sys_flag', TRUE); ?>" />
					<input type="hidden" id="id" name="id" value="<?php echo_value('id', TRUE); ?>" />
					<fieldset>
<!-- 						<legend>Personal details</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<?php echo $instructions_text; ?>
							</li>
							<li class="no_list">
								<p>If you'd like to edit your details, please <a id="edit_button_inline" href="#">click here</a>.</p>
							</li>
						</ol>
					</fieldset>
				</form>
			</div>
		</div>