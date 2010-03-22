<?php
	// home page
	$this_nav = 7;
	require_once('controllers/html.php');
	require_once('views/head.php');
	require_once('views/menu_left_blank.php');
?>
			<div id="content">
				<div id="title">
					<div class="text">Contact us</div>
				</div>
				<div id="body">
					<p>For general or fundraising enquiries, please email us at: <a href="mailto:info@ibsproject.org ">info@ibsproject.org</a></p>
					<p class="intitle">Iranian Business School Project</p>
					<div class="address">
						<p><strong>London Office:</strong></p>
						<p>5th Floor,<br />143 New Bond Street<br />London W1S 2TP<br />United Kingdom</p>
						<p><strong>T</strong>: +44 (0)20 7493 0412<br /><strong>F</strong>: +44 (0)20 7493 0436</p>
					</div>
					<div class="address">
						<p><strong>Tehran Office:</strong></p>
						<p>58 East Gord Alley,<br />Bidar St.,<br />Fayyazi (Fereshteh) Ave.<br />Tehran, Iran</p>
						<p><strong>T</strong>: +98 (0)21 220 35 830<br /><strong>F</strong>: +98 (0)21 220 49 260</p>
					</div>
				</div>
			</div>
<?php
	require_once('views/menu_right_index.php');
	require_once('views/tail.php');
?>