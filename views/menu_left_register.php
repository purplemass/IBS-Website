
		<div id="menuleft">
<?php if ($loggedin): ?>
			<a class="navitem
			<?php
				echo ( ($task <> 'edit') && ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : ''
			?>" href="#" id="register_start">Members area</a>
			<a class="navitem<?php echo ($task == 'edit') ? ' active' : ''; ?>" href="#" id="edit_button">Edit details</a>
<?php else: ?>
			<a class="navitem
			<?php
				echo ( ($task <> 'edit') && ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : ''
			?>" href="#" id="register_start">Log in or register</a>
			<a class="navitem<?php echo ( ($_POST['page_flag'] == 'password_sender') || ($_POST['page_flag'] == 'password_reminder') ) ? ' active' : '' ?>" href="#" id="password_reminder_menu">Get password reminder</a>
<?php endif; ?>
<?php if ($loggedin): ?>
			<a class="navitem" href="#" id="donate_start">Donate online</a>
<?php if ($admin): ?>
			<a class="navitem" href="admin.php">Admin</a>
<?php endif; ?>
			<a class="navitem" href="#" id="logout">Log out</a>
<?php endif; ?>
<!-- 			<a class="navitem" href="#" id="unsubscribe">Unsubscribe (coming soon)</a> -->
		</div>
