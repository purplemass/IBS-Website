<?php
	$this_nav = 7;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem"><strong>Click on the links below:</strong></a>
			<a class="navitem" href="JavaScript:CI('01')">01 Fundraising (selected)</a>
			<a class="navitem" href="JavaScript:CI('02')">02 Fundraising (lighter)</a>
			<a class="navitem" href="JavaScript:CI('03')">03 News &amp; Events (expensive)</a>
			<a class="navitem" href="JavaScript:CI('04')">04 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('05')">05 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('06')">06 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('07')">07 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('08')">08 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('09')">09 News &amp; Events</a>
			<a class="navitem" href="JavaScript:CI('10')">10 Random (free)</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Test Images</div>
			</div>
			<div id="body">
				<p class="intitle">New images for News &amp; Events / Fundraising pages</p>
				<p>Click the links on the left hand side to see the test images.</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_blank.php');
	require_once('views/tail.php');
?>