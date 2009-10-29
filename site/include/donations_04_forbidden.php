<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>

			<div id="menuleft">&nbsp;</div>
			<div id="content">
				<div id="title">
					<div class="text">Donations</div>
				</div>
				<div id="body">
<?php if ($flag=='reg_ok'): ?>
					<p>Your details have been saved in our database.</p>
<?php else:
$row = mysql_fetch_assoc(mysql_query("SELECT * FROM $db_table_community WHERE email='{$_POST['email']}'"));
?>
					<p>Welcome back <?php echo $row['title'] . ' ' . $row['forename'] . ' ' . $row['surname']; ?>!</p>
<?php endif; ?>
					<p>Unfortunately, we are unable to accept donations from the United States and Canada at present time.</p>
					<p>Thank you very much for registering with us. We'll contact you in the future.........</p>
				</div>
			</div>
