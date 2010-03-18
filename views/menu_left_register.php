
		<div id="menuleft">
<?php if ($loggedin): ?>
			<a class="navitem
			<?php
				echo ( ($flag <> 'edit') && ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : ''
			?>" href="#" id="register_start">Members area</a>
			<a class="navitem<?php echo ($flag == 'edit') ? ' active' : ''; ?>" href="#" id="edit_button">Edit details</a>
<?php else: ?>
			<a class="navitem
			<?php
				echo ( ($flag <> 'edit') && ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : ''
			?>" href="#" id="register_start">Log in or register</a>
			<a class="navitem<?php echo ( ($_POST['page_flag'] == 'password_sender') || ($_POST['page_flag'] == 'password_reminder') ) ? ' active' : '' ?>" href="#" id="password_reminder_menu">Get password reminder</a>
<?php endif; ?>
<?php if ($loggedin): ?>
			<a class="navitem" href="#" id="donate_start">Donate online</a>
			<a class="navitem" href="#" id="logout">Log out</a>
<?php endif; ?>
<!-- 			<a class="navitem" href="#" id="unsubscribe">Unsubscribe (coming soon)</a> -->
		</div>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
