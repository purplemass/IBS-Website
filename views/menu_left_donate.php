
		<div id="menuleft">
			<a class="navitem<?php echo ( ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : '' ?>" href="#" id="donate_start">Donate Online</a>
			<a class="navitem<?php echo ( ($_POST['page_flag'] == 'password_sender') || ($_POST['page_flag'] == 'password_reminder') ) ? ' active' : '' ?>" href="#" id="password_reminder_menu">Get password reminder</a>
<?php if (isset($_COOKIE[$mycookie_name])): ?>
			<a class="navitem" href="#" id="logout_menu">Log out</a>
<?php endif; ?>
		</div>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
