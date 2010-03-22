<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem active" href="news_events_upcoming.php">Upcoming Events</a>
			<a class="navitem active" href="news_events_upcoming.php#purchasing"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Purchase Tickets</a>
			<a class="navitem" href="news_events.php">Launch of IBS</a>
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
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>