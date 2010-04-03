
<?php
	if ($loggedin)
		require_once('views/loggedin.php');
	else
		require_once('views/loggedout.php');
?>
		<div id="menuright">
			<div class="quicklinks">Quick Links</div>
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Brochure.pdf">IBS Project Brochure</a>
			<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_5_March_2010.pdf">Quarterly Newsletter, Issue 5, March 2010</a>
			<a class="navitem archived_newsletters_button" href="#">2009 Quarterly Newsletters</a>
			<div id="archived_newsletters">
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_4_December_2009.pdf">Issue 4, December 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_3_August_2009.pdf">Issue 3, August 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_2_April_2009.pdf">Issue 2, April 2009</a>
				<a class="navitem" rel="new" href="./_downloads/IBS_Project_Newsletter_Issue_1_January_2009.pdf">Issue 1, January 2009</a>
			</div>
		</div>
