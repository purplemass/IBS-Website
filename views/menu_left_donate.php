
		<div id="menuleft">
			<a class="navitem
			<?php
				echo ( ($flag <> 'edit') && ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : ''
			?>" href="#" id="donate_start">Donate Online</a>
<?php if ($loggedin): ?>
			<a class="navitem<?php echo ($flag == 'edit') ? ' active' : ''; ?>" href="#" id="edit_button">Edit details</a>
<?php endif; ?>
			<a class="navitem<?php echo ( ($_POST['page_flag'] == 'password_sender') || ($_POST['page_flag'] == 'password_reminder') ) ? ' active' : '' ?>" href="#" id="password_reminder_menu">Get password reminder</a>
<?php if ($loggedin): ?>
			<a class="navitem" href="#" id="logout_menu">Log out</a>
<?php endif; ?>
<!-- 			<a class="navitem" href="#" id="unsubscribe">Unsubscribe (coming soon)</a> -->
		</div>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
