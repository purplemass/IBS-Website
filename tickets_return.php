<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
	
	if (isset($_REQUEST['msg']) && ($_REQUEST['msg'] == 'success') )
		$msg = 'Thank you for purchasing tickets.';
	else
		$msg = 'Purchasing tickets was cancelled.';
?>
		<div id="menuleft">
			<a class="navitem active" href="news_events_upcoming.php">Upcoming Events</a>
			<a class="navitem active" href="news_events_upcoming.php#purchasing"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Purchase Tickets</a>
			<a class="navitem" href="news_events.php">2010 Fundraising Event</a>
			<a class="navitem" href="news_events_launch.php">2009 Launch Event</a>
			<a class="navitem" href="news_events_video.php">IBS Project Video</a>
<!-- 			<a class="navitem" href="news_events_sponsor.php">Become a sponsor</a> -->
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Purchase Tickets On-line</div>
			</div>
			<div id="body">
				<p><?php print $msg ?></p>
				<!-- <p><a href="http://www.ibsproject.org">Click here</a> to go back to IBS Project home page.</p> -->
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>