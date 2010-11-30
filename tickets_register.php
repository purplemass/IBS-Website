<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
	
	$ticket_single = 200;
	$ticket_table = 1700;
	$ticket_raffle = 20;
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
<!-- 					<p class="intitle">Buying Tickets</p> -->
					<form action="tickets_buy.php" method="post" onsubmit="return validate_form(this);">
					<table>
						<tr>
							<td colspan="3"><p>Please fill in the details below (fields marked with * are required):</p></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
<!--
						<tr><td>*</td><td>Title</td><td><input type="text" name="title" maxlength="60"></td></tr>
						<tr><td>*</td><td>First Name</td><td><input type="text" name="first_name" maxlength="60"></td></tr>
						<tr><td>*</td><td>Last Name</td><td><input type="text" name="last_name" maxlength="60"></td></tr>
						<tr><td>*</td><td>Address 1</td><td><input type="text" name="address1" maxlength="60"></td></tr>
						<tr><td> </td><td>Address 2</td><td><input type="text" name="address2" maxlength="60"></td></tr>
						<tr><td> </td><td>Address 3</td><td><input type="text" name="address3" maxlength="60"></td></tr>
						<tr><td>*</td><td>City</td><td><input type="text" name="city" maxlength="60"></td></tr>
						<tr><td>*</td><td>Post Code</td><td><input type="text" name="post_code" maxlength="60"></td></tr>
-->
						<tr>
							<td>*</td>
							<td width="200"><span class="standout">Email Address</span></td>
							<td><input type="text" name="email_address" id="email_address" maxlength="60" width="40"></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">Please tell us the number of tickets you wish to purchase:</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td>*</td>
							<td><span class="standout">Individual Tickets</span></td>
							<td><input type="text" id="individuals_qty" name="individuals_qty" value="0" maxlength="2" size="1">&nbsp; &pound;<?php print $ticket_single; ?> each</td>
						</tr>
						<tr>
							<td>*</td>
							<td><span class="standout">Table of 10</span></td>
							<td><input type="text" id="tables_qty" name="tables_qty" value="0" maxlength="2" size="1">&nbsp; &pound;<?php print $ticket_table; ?> each</td>
						</tr>
						<tr>
							<td>*</td>
							<td><span class="standout">Raffle Tickets - book of 5</span></td>
							<td><input type="text" id="raffles_qty" name="raffles_qty" value="0" maxlength="2" size="1">&nbsp; &pound;<?php print $ticket_raffle; ?> each</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">If you know the names of your guests, please provide them below:</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr valign="top">
							<td>&nbsp;</td>
							<td><span class="standout">Guest List</span><br />Please enter one name per line<br />and do not leave any blank lines</td>
							<td><textarea name="guest_list" id="guest_list" maxlength="60" rows="10"></textarea></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit" value="Continue"></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>