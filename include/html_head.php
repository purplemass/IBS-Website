<?php if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Iranian Business School Project</title>
	
	<link rev="start" href="./" title="Home Page" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="alternate" type="application/atom+xml" href="http://www.w3.org/QA/Tools/validator-whatsnew.atom" />

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<meta name="keywords" content="Iranian Business School Project" />
	<meta name="description" content="The Iranian Business School is a philanthropically motivated project aimed at creating a world-class business school in Iran. The School will offer a broad range of international standard management training programmes and courses to include EMBAs, MBAs and others." />
	
	<!--
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="cache-control" content="no-cache" />
	-->

	<meta name="revised" content="BH 2009-05-15" />

	<style type="text/css" media="all">
			@import "./assets/styles.css";
	</style>
	
	<!--[if gt IE 5]>
		<style>
			.buttons { zoom: 1; }
		</style>
	<![endif]-->

	<script type="text/javascript" src="assets/jquery.js"></script>
	<script type="text/javascript" src="assets/cufon-yui.js"></script>
	<script type="text/javascript" src="assets/Helvetica_Neue_400.font.js"></script>
	<script type="text/javascript" src="assets/Helvetica_Neue_500.font.js"></script>
	<script type="text/javascript" src="assets/scripts.js"></script>
	
</head>
<body>
<div id="container">
	<div id="cover"><img src="assets/images/spacer.gif" width="10" height="5" alt="*" /></div>
	<div id="margin">&nbsp;</div>
	<div id="nav">
<?php
$nav_items = array(
					'index.html'				=>	'Home',
					'project.html'				=>	'The Project',
					'programmes.html'			=>	'Programmes',
					'project_timeline.html'		=>	'Project Timeline',
					'news_events.html'			=>	'News &amp; Events',
					'get_involved.html'			=>	'Get involved',
					'fundraising.html'			=>	'Fundraising',
					'contact_us.html'			=>	'Contact us',
					);

$count = 0;
foreach ($nav_items as $key => $value)
{
	$active_class = '';
	if ($this_nav == $count)
		$active_class = ' active';
	
	echo '		<div id="navitem' . $count . '"><a class="navitem' . $active_class . '" href="' . $key . '">' . $value . '</a></div>' . "\n";
	$count++;
}

?>
	</div>
	<div id="top">
		<div id="logo"><a href="index.html"><img src="assets/images/IBS_logo.gif" width="170" height="140" alt="IBS Logo" /></a></div>
		<div id="image"><img src="assets/images/image_fundraising.jpg" width="750" height="140" alt="Main Image" /></div>
	</div>	
	<div id="main">
		<div id="menuleft">
			<a class="navitem" href="fundraising.html">Giving To IBS</a>
			<a class="navitem" href="fundraising_ways.html">Ways to Give</a>
			<a class="navitem active" href="fundraising_donations.php"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Online</a>
			<a class="navitem" href="fundraising_ways.html#gifts"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Cheque, Credit &amp; Cash Gifts</a>
			<a class="navitem" href="fundraising_ways.html#scheduled"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Scheduled Payments</a>
			<a class="navitem" href="fundraising_ways.html#pledges"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Pledges</a>
			<a class="navitem" href="fundraising_ways.html#memorial"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Memorial Gifts</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Online Donations</div>
			</div>
			<div id="body">