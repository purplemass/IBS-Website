<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
			<div id="navitem0"><a class="navitem" href="index.html">Home</a></div>
			<div id="navitem1"><a class="navitem" href="project.html">The Project</a></div>
			<div id="navitem2"><a class="navitem" href="programmes.html">Programmes</a></div>
			<div id="navitem3"><a class="navitem" href="project_timeline.html">Project Timeline</a></div>
			<div id="navitem4"><a class="navitem active" href="news_events_upcoming.html">News &amp; Events</a></div>
			<div id="navitem5"><a class="navitem" href="get_involved.html">Get involved</a></div>
			<div id="navitem6"><a class="navitem" href="fundraising.html">Fundraising</a></div>
			<div id="navitem7"><a class="navitem" href="contact_us.html">Contact us</a></div>
		</div>
		<div id="top">
			<div id="logo"><a href="index.html"><img src="assets/images/IBS_logo.gif" width="170" height="140" alt="IBS Logo" /></a></div>
			<div id="image"><img src="assets/images/image_news_events.jpg" width="750" height="140" alt="Main Image" /></div>
		</div>	
		<div id="main">
			<div id="menuleft">
				<a class="navitem active" href="news_events_upcoming.html">Upcoming Events</a>
				<a class="navitem active" href="news_events_upcoming.html#purchasing"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Purchase Tickets</a>
				<a class="navitem" href="news_events.html">Launch of IBS</a>
			</div>
			<div id="content">
				<div id="title">
					<div class="text">Purchase Tickets On-line</div>
				</div>
				<div id="body">
					<?php
		
/*
		            $title =         $_POST['title'];
		            $first_name =    $_POST['first_name'];
		            $last_name =     $_POST['last_name'];
		            $address1 =      $_POST['address1'];
		            $address2 =      $_POST['address2'];
		            $address3 =      $_POST['address3'];
		            $city =          $_POST['city'];
		            $post_code =     $_POST['post_code'];
				
		            $full_name = $title.' '.$first_name.' '.$last_name;
		            $full_addr = $address1.','.$address2.','.$address3.','.$city.','.$post_code;
	
*/
					
					$email_address = $_POST['email_address'];
					
					$individuals_qty = $_POST['individuals_qty'];
					$tables_qty =      $_POST['tables_qty'];
					$raffles_qty =     $_POST['raffles_qty'];
					
					$guest_list =      str_replace(array("\r\n", "\n", "\r"), ";", $_POST['guest_list']);
					
					if ($guest_list == "") $guest_list = "(empty)";
					
					?>			
					<p>Thank you.</p>
					<p>Please check the details below and click <span class="standout">Buy Now</span> to continue to checkout.</p>

					<table>
					<tr><td width="130"><b>Email Address</b>          </td><td><?php echo $email_address ?></td></tr>
					<tr><td><b>Individual Tickets</b>     </td><td><?php echo $individuals_qty ?></td></tr>
					<tr><td><b>Tables of 10</b>           </td><td><?php echo $tables_qty ?></td></tr>
					<tr><td><b>Raffle Tickets</b>         </td><td><?php echo $raffles_qty ?></td></tr>
					<tr valign="top"><td><b>Guest List</b></td><td><?php echo str_replace(";", "<br>", $guest_list) ?></td></tr>
					</table>

					<p>&nbsp;</p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="hosted_button_id" value="10778616">
									
						<?php
						
						$i = 1;
						
						if ($individuals_qty!=0)
						{
						    echo "<input type=\"hidden\" name=\"item_name_$i\" value=\"Individual Tickets\">";
						    echo "<input type=\"hidden\" name=\"amount_$i\" value=\"180\">";
						    echo "<input type=\"hidden\" name=\"quantity_$i\" value=\"$individuals_qty\">";
						    $i++;
						}
						if ($tables_qty!=0)
						{
						    echo "<input type=\"hidden\" name=\"item_name_$i\" value=\"Table of 10\">";
						    echo "<input type=\"hidden\" name=\"amount_$i\" value=\"1600\">";
						    echo "<input type=\"hidden\" name=\"quantity_$i\" value=\"$tables_qty\">";
						    $i++;
						}
						if ($raffles_qty!=0)
						{
						    echo "<input type=\"hidden\" name=\"item_name_$i\" value=\"Raffle Tickets\">";
						    echo "<input type=\"hidden\" name=\"amount_$i\" value=\"20\">";
						    echo "<input type=\"hidden\" name=\"quantity_$i\" value=\"$raffles_qty\">";
						    $i++;
						}			
	
						?>
			
						<input type="hidden" name="on0_1" value="Email Address">
						<input type="hidden" name="os0_1" value="<?php echo $email_address ?>">
						<input type="hidden" name="on1_1" value="Guest List">
						<input type="hidden" name="os1_1" value="<?php echo $guest_list ?>">
						
						<input type="hidden" name="currency_code" value="GBP">
						
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="donations@ibsproject.org">
						
						<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
					</form>
			
				</div>
			</div>
			<div id="menuright">
				<div class="quicklinks">Quick Links</div>
				<a class="navitem" href="./news_events_upcoming.html">Upcoming Events</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_4_December_2009.pdf">Quarterly Newsletter, Issue 4, Dec. 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_3_August_2009.pdf">Quarterly Newsletter, Issue 3, August 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_2_April_2009.pdf">Quarterly Newsletter, Issue 2, April 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_1_January_2009.pdf">Quarterly Newsletter, Issue 1, January 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Brochure.pdf">IBS Project Brochure</a>
			</div>
		</div>
	</div>
	<div id="footer"><div class="text">Copyright &copy; 2009 Iranian Business School Project</div></div>
	<script type="text/javascript">Cufon.now();</script>
	<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1689775-7");
pageTracker._trackPageview();
} catch(err) {}</script>
	</body>
</html>
