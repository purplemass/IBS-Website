<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="news_events_upcoming.php">2011 Fundraising Event</a>
			<a class="navitem" href="news_events.php">2010 Fundraising Event</a>
			<a class="navitem" href="news_events_launch.php">2009 Launch Event</a>
			<a class="navitem active" href="news_events_sponsor.php">Become a sponsor</a>
			<a class="navitem" href="news_events_video.php">IBS Project Video</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Become a sponsor</div>
			</div>
			<div id="body">
				<p>As a philanthropically-motivated project, IBS relies upon the co-operation of like-minded organisations and this event promises to provide an ideal forum for those wishing to join together and forge relationships with top Iranian business leaders.</p>
				<p>For more details on how to become a <span class="standout">Corporate or Individual Sponsor</span> and the benefits we can offer please download a copy of our <a href="_downloads/2011_Annual_IBS_Fundraising_Event_Sponsorship_Package.pdf">Event Sponsorship Programme</a>. Alternatively, please contact us on <a href="mailto:events@ibsproject.org">events@ibsproject.org</a> for further information.</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>