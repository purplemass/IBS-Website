<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
		<div id="menuleft">
			<a class="navitem" href="programmes.php">About IBS Programmes</a>
			<a class="navitem" href="programmes_curriculum.php">Curriculum Development</a>
			<a class="navitem" href="programmes_curriculum.php#first"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />First Stage Programmes</a>
			<a class="navitem" href="programmes_curriculum.php#further"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Further Stage Programmes</a>
			<a class="navitem active navitemlarge" href="programmes_form.php">Executive Leadership Programme</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Executive Leadership Programme</div>
			</div>
			<div id="body">
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
							<li class="no_list"><strong>Thank you for your interest in the Executive Leadership Program.</strong></li>
							<li class="no_list">Please fill out the form below in order to receive the desired information:<br /></li>
							<!-- FIELD START-->
<?php foreach ($programme_fields as $name => $options): ?>
							<li class="no_list">
								<label for=<?php echo $name; ?>>
									<?php echo $options['label'] . ': ' . ($options['mandatory'] ? '<span class="mandatory">*</span>' : ''); ?>

								</label>
<?php if ($options['type'] == 'text'): ?>
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
<?php endif; ?>
							</li>
<?php endforeach; ?>
							<!-- FIELD END-->
							<li class="no_list"><br />Please send me the following documents:</li>
<?php foreach ($programme_docs as $name => $label):
$my_checked = '';
if (isset($_POST[$name]))
	$my_checked = ' checked';
?>
							<li class="no_list">
								<label for=<?php echo $name; ?>>
									<?php echo $label?>

								</label>
								<input type="checkbox" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $name; ?>" <?php echo $my_checked; ?>>
							</li>
<?php endforeach; ?>
							<li class="no_list"><br />&nbsp;<span class="mandatory">*</span> denotes required field</li>
						</ol>
					</fieldset>
<!-- 					<a id="cancel" href="#" class="buttons cancel_button">Cancel</a> -->
					<a id="submit" href="#" class="buttons submit_button">Submit</a>
				</form>
			</div>
		</div>
