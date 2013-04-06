
<?php
	if ($loggedin)
		require_once('views/loggedin.php');
	else
		require_once('views/loggedout.php');
?>
		<div id="menuright">
<!-- REMOVED executive_programme
			<div id="executive_programme">
				<p class="heading">
					<a href="programmes_form.php">Executive Leadership Programme
					<br /><span class="text">Click here for more information</span></a>
				</p>
			</div>
			<div id="executive_programme_white"></div>
-->
			<div class="quicklinks">Quick Links</div>
<!-- THIS WAS DONE A LONG TIME AGO
-->
			<a class="navitem" href="./news_events_upcoming.php">Upcoming Events</a>
<!-- REMOVED newsletters
			<a class="navitem" rel="new" href="./_downloads	/IBS_Project_Newsletter_Issue_9_April_2011.pdf">Newsletter, Issue 9, April 2011</a>
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_7_and_8_Jan_2011.pdf">Newsletter, Issues 7/8, January 2011</a>
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_6_June_2010.pdf">Newsletter, Issue 6, June 2010</a>
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_5_March_2010.pdf">Newsletter, Issue 5, March 2010</a>
			<a class="navitem archived_newsletters_button" href="#">2009 Newsletters&nbsp;<img id="bullet_right" src="assets/images/bullet_right.gif" width="10" height="13" alt="bullet" /></a>
			<div id="archived_newsletters">
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_4_December_2009.pdf">Newsletter, Issue 4, December 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_3_August_2009.pdf">Newsletter, Issue 3, August 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_2_April_2009.pdf">Newsletter, Issue 2, April 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_1_January_2009.pdf">Newsletter, Issue 1, January 2009</a>
			</div>
-->
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Brochure.pdf">IBS Project Brochure</a>
			<div class="quicklinks">Subscribe to Newsletter</div>
			<div id="subscribe">
				<form id="newsletter_form" action="">
					<p><input type="text" name="emailAddress" id="emailAddress" value="Enter email address" size="27" />
					&nbsp;<a href="#" id="newsletter_submit" class="button"><img src="assets/images/go.gif" alt="GO" /></a>
					</p>
				</form>
				<div id="error"></div>
				<div id="success">Your email address is now registered.<br /><br />You will start receiving our newsletters shortly.</div>
			</div>
			<!--<a class="navitem" href="#">Unsubsribe</a>-->
		</div>
