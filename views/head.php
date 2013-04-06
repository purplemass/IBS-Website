<?php if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly'); ?>
<?php
if ($loggedin === TRUE)
	$nav_items['register.php'] = 'Members area';

// find corrcet image
$this_page = $_SERVER['SCRIPT_NAME'];

foreach ($image_list as $key => $value)
{
	if (strpos($this_page, $key) > -1)
	{
		$image = $value;
		break;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Iranian Business School Project</title>

	<link rev="start" href="./" title="Home Page" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="alternate" type="application/atom+xml" href="http://www.w3.org/QA/Tools/validator-whatsnew.atom" />

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<meta name="keywords" content="Iranian Business School Project IBS" />
	<meta name="description" content="The Iranian Business School (IBS) is a philanthropically motivated project aimed at creating a world-class business school in Iran. The School will offer a broad range of international standard management training programmes and courses to include EMBAs, MBAs and others." />

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
			.announcement a { zoom: 1; }
			#div#loggedin { float: none !important; margin-top: -5px !important; border: none !important;}
		</style>
	<![endif]-->

	<script type="text/javascript" src="assets/jquery.js"></script>
	<script type="text/javascript" src="assets/cufon-yui.js"></script>
	<script type="text/javascript" src="assets/Helvetica_Neue_400.font.js"></script>
	<script type="text/javascript" src="assets/Helvetica_Neue_500.font.js"></script>
	<script type="text/javascript" src="assets/scripts.js"></script>
	<script type="text/javascript" src="assets/formvalidation.js"></script>

</head>
<body>
<div id="container">
	<div id="cover"><img src="assets/images/spacer.gif" width="10" height="5" alt="*" /></div>
	<div id="margin">&nbsp;</div>
	<div id="nav">
<?php $count = 0; foreach ($nav_items as $key => $value): ?>
<?php $active_class = ($this_nav == $count) ? ' active' : ''; ?>
		<div id="navitem<?php echo $count; ?>"><a class="navitem<?php echo $active_class; ?>" href="<?php echo $key; ?>"><?php echo $value ?></a></div>
<?php $count++; endforeach; ?>
	</div>
	<div id="top">
		<div id="logo"><a href="index.php"><img src="assets/images/IBS_logo.png" width="170" height="140" alt="IBS Logo" /></a></div>
		<div id="image"><img id="main_image" src="assets/images/<?php echo $image; ?>" width="750" height="140" alt="Main Image" /></div>
	</div>
	<div id="main">