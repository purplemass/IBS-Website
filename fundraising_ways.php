<?php
	$this_nav = 6;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="fundraising.php">Giving To IBS</a>
			<a class="navitem active" href="fundraising_ways.php">Ways to Give</a>
			<a class="navitem" href="#" id="donate_start"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Donate online</a>
			<a class="navitem" href="fundraising_ways.php#gifts"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Cheque, Credit &amp; Cash Gifts</a>
			<a class="navitem" href="fundraising_ways.php#scheduled"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Scheduled Payments</a>
			<a class="navitem" href="fundraising_ways.php#pledges"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Pledges</a>
			<a class="navitem" href="fundraising_ways.php#memorial"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Memorial Gifts</a>
			<form id="main_form" class="form_register" action="register.php" method="post">
				<input type="hidden" id="page_flag" name="page_flag" value="">
				<input type="hidden" id="sys_flag" name="sys_flag" value="" />
			</form>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">Fundraising</div>
			</div>
			<div id="body">
				<p class="intitle">Ways to Give</p>
				<p>Contributions of all sizes and manners are welcome and we have devised a number of ways to make giving easy and tax efficient.</p>
				<p>In addition to the methods of giving named below, we can also work together to devise a giving plan that meets your personal giving objectives.</p>
				<p>The Project has also developed a number of ways to recognise gifts made to the School and we are happy to discuss these with all prospective donors wishing to find out more about how we <a href="contact_us.php">recognise contributions.</a></p>
				<a name="gifts"></a>
				<p class="intitle">Cheque, Credit Card and Cash Gifts</p>
				<p>Cheque, credit card and cash gifts are the most direct way to support IBS. There are a number of ways to make your gift:</p>
				<ul>
					<li>Phone or fax debit and credit card donations</li>
					<li>Mailing your donation</li>
				</ul>
				<a name="scheduled"></a>
				<p class="intitle">Scheduled Payments &amp; Standing Orders</p>
				<p>Donors that so wish, can make payments in instalments. If you choose to make your payments in scheduled instalments, the amount you donate will be divided according to the amount and payment frequency you select, and the resulting payments will automatically be charged to your credit or debit card at the selected intervals over a pre-determined period.  <a rel="new" href="./_downloads/IBS_Project_Donation_Form.pdf">The IBS Project Donation form</a> provides details on how you can set up a Standing Order.</p>
				<a name="pledges"></a>
				<p class="intitle">Pledges</p>
				<p>Pledges enable a donor to plan a personal giving programme that is both convenient and tax-efficient. A pledge may enable a donor to consider a more significant gift or a non-cash contribution. Terms for payment on pledges are flexible and tailored to the needs of the donor. Please <a href="contact_us.php">contact us</a> to discuss how to make a pledge.</p>
				<a name="memorial"></a>
				<p class="intitle">Memorial Gifts</p>
				<p>Memorial gifts can be made in honour of a designated individual or individuals. To have your gift recognised as a tribute, please <a href="contact_us.php">contact us</a> to discuss how to make a memorial gift.</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>