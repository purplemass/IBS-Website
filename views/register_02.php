<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php

$instructions_text = 'enter';

if ($flag == 'edit')
{
	$instructions_text = 'edit';

	$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
	$_POST['email']			= $row['email'];
	$_POST['forename']		= $row['forename'];
	$_POST['surname']		= $row['surname'];
	$_POST['title']			= $row['title'];
	$_POST['country']		= $row['country'];
	$_POST['newsletter']	= $row['newsletter'];
}
?>

				<div id="subscribe">
<?php if ($err): ?>
				<div class="error_message"><?php echo implode('<br />', $err); ?></div>
<?php endif ?>
					<form id="main_form" class="form_register" action="" method="post">
					<fieldset>
<!-- 						<legend>Personal details</legend> -->
						<ol>
							<li class="no_list no_list_text">
								<span class="form_text">Please enter your details below:</span>
							</li>
<?php $s = ''; foreach ($fields as $name => $options): ?>
							<li class="no_list">
<?php $mandatory = ($options['mandatory'] ? '<span class="mandatory">*</span>' : ''); ?>
								<label for=<?php echo $name; ?>><?php echo $options['label'] . $mandatory; ?>: </label>
<?php if ( ($options['type'] == 'text') || ($options['type'] == 'password') ): ?>
								<input id="<?php echo $name; ?>" name="<?php echo $name; ?>" type="<?php echo $options['type']; ?>"
									 size="<?php echo $options['width']; ?>" maxlength="<?php echo $options['length']; ?>" 
									 value="<?php echo_value($name, TRUE); ?>" />
<?php elseif ($name == 'title'): ?>
								<select id="title" name="title">
<?php foreach ($title_codes as $title => $code): ?>
<?php $selected = (isset($_POST['title']) && $_POST['title'] == $code) ? ' selected': ''; ?>
									<option value="<?php echo $code; ?>"<?php echo $selected; ?>><?php echo $title; ?></option>
<?php endforeach; ?>
								</select>
<?php elseif ($name == 'country'): ?>
								<select id="country" name="country">
<?php foreach ($country_codes as $country => $code): ?>
<?php $selected = (isset($_POST['country']) && $_POST['country'] == $code) ? ' selected': ''; ?>
									<option value="<?php echo $code; ?>"<?php echo $selected; ?>><?php echo $country; ?></option>
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
							</li>
<?php endforeach; ?>
							<li class="no_list">
								<br />&nbsp;<span class="mandatory">*</span> denotes mandatory fields
							</li>
						</ol>
					</fieldset>
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
					<input type="hidden" name="email" value="<?php echo_value('email', TRUE); ?>" />
					<input type="hidden" name="page_flag" value="check_registration" />
<!--
					<input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif"
					 border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
-->
						</p>
					</form>
				</div>
			</div>		
		</div>
