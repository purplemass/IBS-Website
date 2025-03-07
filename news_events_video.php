<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="news_events_upcoming.php">Upcoming Events</a>
			<a class="navitem" href="news_events_2011_project.php">2011 Project Launch in Dubai</a>
			<a class="navitem" href="news_events_2011_fundraising.php">2011 Fundraising Event</a>
			<a class="navitem" href="news_events_2010_fundraising.php">2010 Fundraising Event</a>
			<a class="navitem " href="news_events_2009_launch.php">2009 Launch Event</a>
<!-- 			<a class="navitem" href="news_events_sponsor.php">Become a sponsor</a> -->
			<a class="navitem active" href="news_events_video.php">IBS Project Video</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Promo Video</div>
			</div>
			<div id="body">
				<!-- VIDEO: start -->
				<p>Listen to the founders and supporters of the Iranian Business School Project provide insight into the vision and drive behind the School and the enormous contribution it stands to make to Iran and its next generation of business leaders.</p>
				<script type="text/javascript" src="assets/flowplayer/flowplayer-3.1.4.min.js"></script>
				<!-- this A tag is where your Flowplayer will be placed. it can be anywhere -->
				<a
					href="assets/videos/IBS_promo_video.flv"
					style="display:block;width:430px;height:275px"
					id="flplayer">
				</a>					
				<!-- this will install flowplayer inside previous A- tag. -->
				<script>
				flowplayer("flplayer", "assets/flowplayer/flowplayer.swf",
				{
					clip:
					{
						autoPlay: true,
						autoBuffering: true,
					},
					
					plugins:
					{
						controls:
						{
						 	url: 'assets/flowplayer/flowplayer.controls.swf'
						}
					}

				});
				</script>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<!-- VIDEO: end -->
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>