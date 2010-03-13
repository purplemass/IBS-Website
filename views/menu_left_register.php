
		<div id="menuleft">
			<a class="navitem<?php echo ( ($_POST['page_flag'] <> 'password_sender') && ($_POST['page_flag'] <> 'password_reminder') ) ? ' active' : '' ?>" href="register.php">Log in or register</a>
			<a class="navitem<?php echo ( ($_POST['page_flag'] == 'password_sender') || ($_POST['page_flag'] == 'password_reminder') ) ? ' active' : '' ?>" href="#" id="password_reminder">Get password reminder</a>
			<a class="navitem" href="#" id="unsubscribe">Unsubscribe (coming soon)</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text"><?php echo $page_title; ?></div>
			</div>
			<div id="body">
