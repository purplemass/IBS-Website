<?php
	$this_nav = 6;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem active" href="fundraising.php">Giving To IBS</a>
			<a class="navitem" href="fundraising_ways.php">Ways to Give</a>
			<a class="navitem" href="fundraising_ways.php#gifts"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Cheque, Credit &amp; Cash Gifts</a>
			<a class="navitem" href="fundraising_ways.php#scheduled"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Scheduled Payments</a>
			<a class="navitem" href="fundraising_ways.php#pledges"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Pledges</a>
			<a class="navitem" href="fundraising_ways.php#memorial"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Memorial Gifts</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Fundraising</div>
			</div>
			<div id="body">
				<p class="intitle">Giving to the IBS Project</p>
				<p>ISM Management is a <a href="http://www.charitycommission.gov.uk" rel="new">UK registered charity</a> (Charity Number: 1125584) established for the sole purpose of undertaking global fundraising and providing the financial support required to launch the Iranian Business School.</p>
				<p>With your support, we can realise the goal of establishing this world-class institution in Iran that will produce future business leaders and help the country reach its economic and human potential.</p>
				<p>The project has rapidly advanced since inception due to the generosity of numerous individuals and organisations from both within Iran and outside it. Your gift will be an invaluable investment in the development of future generations in the country and a meaningful way to support the emergence of a stronger Iran on the global business and economic stage.</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>