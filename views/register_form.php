<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
				<form id="main_form" class="form_register" action="" method="post">
					<input type="hidden" id="page_flag" name="page_flag" value="check_registration" />
					<input type="hidden" id="sys_flag" name="sys_flag" value="<?php echo_value('sys_flag', TRUE); ?>" />
					<input type="hidden" id="id" name="id" value="<?php echo_value('id', TRUE); ?>" />
					<fieldset>
<!-- 						<legend>Personal details</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<?php echo $instructions_text; ?>
							</li>
<?php foreach ($fields as $name => $options): ?>
							<!-- FIELD START-->
							<li class="no_list">
								<label for=<?php echo $name; ?>>
									<?php echo $options['label'] . ': ' . ($options['mandatory'] ? '<span class="mandatory">*</span>' : ''); ?>
								</label>
<?php if ( ($options['type'] == 'text') || ($options['type'] == 'password') ): ?>
								<input
									id="<?php echo $name; ?>"
									name="<?php echo $name; ?>"
									type="<?php echo $options['type']; ?>"
									size="<?php echo $options['width']; ?>"
									maxlength="<?php echo $options['length']; ?>" 
									value="<?php ($name == 'password_confirm') ? '' : echo_value($name, TRUE); ?>"
								/>
<?php elseif ($name == 'title'): ?>
								<select id="title" name="title">
<?php foreach ($title_codes as $title => $code): ?>
									<option	value="<?php echo $code; ?>"<?php echo (isset($_POST['title']) && $_POST['title'] == $code) ? ' selected': ''; ?>>
										<?php echo $title; ?>

									</option>
<?php endforeach; ?>
								</select>
<?php elseif ($name == 'country'): ?>
								<select id="country" name="country">
<?php foreach ($country_codes as $country => $code): ?>
									<option	value="<?php echo $code; ?>"<?php echo (isset($_POST['country']) && $_POST['country'] == $code) ? ' selected': ''; ?>>
										<?php echo $country; ?>

									</option>
<?php endforeach; ?>
								</select>
<?php elseif ($name == 'newsletter'): ?>
<?php
$newsletter = 'checked';
if (isset($_POST['newsletter']))
	$newsletter = ($_POST['newsletter'] == 1) ? 'checked' : '';
?>
								<input type="checkbox" name="newsletter" value="1" <?php echo $newsletter; ?>>
<?php endif; ?>
							<!-- FIELD END-->
							</li>
<?php endforeach; ?>
							<li class="no_list">
								<br />&nbsp;<span class="mandatory">*</span> denotes required field
							</li>
						</ol>
					</fieldset>
					<a id="cancel" href="#" class="buttons cancel_button">Cancel</a>
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
				</form>