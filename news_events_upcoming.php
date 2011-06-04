<?php
	$this_nav = 4;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="news_events_2011_project.php">2011 Project Launch in Dubai</a>
			<a class="navitem" href="news_events_2011_fundraising.php">2011 Fundraising Event</a>
			<a class="navitem" href="news_events_2010_fundraising.php">2010 Fundraising Event</a>
			<a class="navitem " href="news_events_2009_launch.php">2009 Launch Event</a>
<!-- 			<a class="navitem" href="news_events_sponsor.php">Become a sponsor</a> -->
			<a class="navitem" href="news_events_video.php">IBS Project Video</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">2011 Fundraising Event</div>
			</div>
			<div id="body">
				<p class="bold_text">4th February 2011<br />Annual Fundraising Event &amp; Art Auction<br />The Dorchester Hotel, London</p>
				<p>The Iranian Business School Project will host its Annual Fundraising Event &amp; Art Auction on February 4, 2011 at The Dorchester Hotel in London.</p>
				<p>The evening's highlights will include a keynote speech from <span class="bold_text">Dr. Hossein Eslambolchi</span>, Chairman &amp; CEO of 2020 Venture Partners, and a globally recognised thought-leader and visionary in 21st Century high-tech science.</p>
				<p>The event will also feature a live musical performance by legendary Iranian composer and pianist, <span class="bold_text">Anoushirvan Rohani</span>, as well as an exclusive auction of a number of significant works from world-renowned Iranian artists. The auction will again be presided over by a member of Sotheby's auction team.</p>

				<p class="intitle intitle_larger">Sponsorship opportunities</p>
				<p>Please contact us at: <a href="mailto:info@ibsproject.org">info@ibsproject.org</a>. You can also download a copy of our <a href="_downloads/2011_Annual_IBS_Fundraising_Event_Sponsorship_Package.pdf">Event Sponsorship Programme</a></p>

				<p class="intitle intitle_larger">General Enquiries and to purchase tickets</p>
				<p>Please contact us at: <a href="mailto:events@ibsproject.org">events@ibsproject.org</a> or call: +44 (0)20 7493 0413</p>
				
<!-- 				<p>For general queries and information on sponsorship opportunities, please contact us at <a href="mailto:info@ibsproject.org">info@ibsproject.org</a></p> -->
				
				<a name="purchasing"></a>
				<p class="intitle intitle_larger">Ticket &amp; Raffle Information</p>
				<span class="ticketstype">Individual</span>&pound;<?php print $ticket_single; ?><br />
				<span class="ticketstype">Table of <?php print $per_table; ?></span>&pound;<?php print $ticket_table; ?> (&pound;<?php print $ticket_table/$per_table; ?> per ticket)<br />
				<span class="ticketstype">Raffle Tickets</span>&pound;<?php print $ticket_raffle; ?><br />
				
				<p class="intitle intitle_larger">Purchase Tickets</p>
				<ul>
					<!--<li><span class="standout">on-line</span><br />purchase your tickets <a href="tickets_register.php">on-line</a></li>-->
					<li><span class="standout">by phone or email</span><br />contact us on +44 (0)20 7493 0413 or <a href="mailto:events@ibsproject.org">events@ibsproject.org</a></li>
					<li><span class="standout">by cheque</span><br />please complete the <a href="_downloads/Ticket_and_Raffle_Registration_Form_2011_Event.pdf">Registration Form</a> and send it with your payment to the address provided in the document</li>
				</ul>
				
				<p class="intitle intitle_larger">Raffle Prizes</p>
				<script type="text/javascript" src="./assets/jquery.pikachoose.js"></script>
				<script type="text/javascript" src="./assets/jquery.jcarousel.min.js"></script>

				<ul id="slide_raffle" class="jcarousel-skin-pika">
					<li><a href="Javascript:"><img src="./assets/images_raffle/01.jpg" /><span><strong>A rugby ball signed by Danny Cipriani, the renowned English Rugby Union player.</strong> He plays fly-half, centre and fullback and has played for London Wasps and England.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/02.jpg" /><span><strong>Dinner for up to 10 people at Fakhreldine,</strong> one of London&apos;s finest Lebanese restaurants offering a contemporary and lively Middle Eastern atmosphere, an elegant dining room and uninterrupted views of Green Park.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/03.jpg" /><span><strong>An elegant Mont Blanc Pen, Cufflink and Business Card Holder set,</strong>  all featuring the Mont Blanc emblem, which has become synonymous with high-quality and sophistication in the creation of precision writing instruments and accessories. This prize includes a black precious resin ballpoint pen, platinum-plated cufflinks and black leather business card holder.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/04.jpg" /><span><strong>Spa Weekend for up to 8 people at The Cloudesley, St. Leonards-on-Sea.</strong> Two nights (including breakfast) at this holistic health centre and hotel set in a tranquil garden overlooking the sea. The hotel offers delicious organic foods and excellent spa facilities for relaxation.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/05.jpg" /><span><strong>Authentic Turkmen tunic.</strong>This beautiful traditional garment is hand embroidered and features rich colours and the distinctive patterns for which Turkmen design is best recognised.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/06.jpg" /><span><strong>Dentistry Package for Two from Couture Smile.</strong> Receive complimentary routine dental treatments for one year, including one session per person of the latest in-surgery laser whitening treatment.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_raffle/07.jpg" /><span><strong>Mallorca Villa Holiday for Four</strong> at a lovely seaside villa in the picturesque town of Portals Nous for five nights. Available for use during April, May and June 2011. Flights excluded.</span></a></li>
				</ul>
				
				<p class="intitle intitle_larger">Silent Auction Prizes</p>
				<ul id="slide_auction" class="jcarousel-skin-pika">
					<li><a href="Javascript:"><img src="./assets/images_auction/01.jpg" /><span><strong>An afternoon of Lunch and Guided Trading Floor Tour with Mr. Cyrus Ardalan, Vice Chairman of Barclays Capital.</strong> This prize presents a unique opportunity to spend time with Mr. Cyrus Ardalan, a globally known and well respected veteran of the financial industry. The winner will also be treated to a tour of the BarCap trading floor.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_auction/02.jpg" /><span><strong>Behind the scenes day for two at a music video shoot with Jacuzzi Films.</strong> The winning bidder will spend a day 'behind-the scenes' of a music video shoot at Jacuzzi Films; London studio in 2011.  A choice of dates and artists available and all transport and meals will be included.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_auction/03.jpg" /><span><strong>A 2010 framed Arsenal home shirt signed by the entire Arsenal Team.</strong> This autographed jersey is signed by the current squad of the famous Premier League team. The 2010 Arsenal roster includes some of the sport's greatest players including Cesc Fabergas, Robin van Persie, Samir Nasri and Andrei Arshavin.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_auction/04.jpg" /><span><strong>Three highly coveted masterpieces signed by their author Iraj Pezeshkzad.</strong> - including the novels 'Daei Jan Napoleon', 'Adabe Mard Beh Ze Dolate Oost' and 'Mashallah Khan Dar Bargaheh Haroon-al-Rashid'.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_auction/05.jpg" /><span><strong>Three prime tickets for Chelsea vs. Manchester City.</strong> Tickets are for the match on March 19, 2011. This package includes a pre-match lunch at Marco restaurant, located within the Chelsea Football Club Complex at Stamford Bridge.</span></a></li>
					<li><a href="Javascript:"><img src="./assets/images_auction/06.jpg" /><span><strong>A highly coveted 2010 Arsenal home shirt signed by world-class Arsenal Forward and Russian National Team Captain Andrei Arshavin.</strong> </span></a></li>
					
<!--
					<li><a href="Javascript:"><img src="./assets/images_auction/04.jpg" /><span><strong>Lunch and a tour of the Barclays Capital trading floor with Mr Cyrus Ardalan - Vice Chairman of Barclays Capital.</strong></span></a></li>
-->
				</ul>
				
<!--
				<script type="text/javascript" src="assets/popSlides.js"></script>
				
				<ul class="slide_raffle slide_show">
					<li><img src="assets/images/raffle_slide/01.jpg" /><span>This is the caption for image 01</span></li>
					<li><img src="assets/images/raffle_slide/02.jpg" /><span>This is the caption for image 02</span></li>
					<li><img src="assets/images/raffle_slide/03.jpg" /><span>This is the caption for image 03</span></li>
					<li><img src="assets/images/raffle_slide/04.jpg" /><span>This is the caption for image 04</span></li>
					<li><img src="assets/images/raffle_slide/06.jpg" /><span>This is the caption for image 06</span></li>
					<li><img src="assets/images/raffle_slide/05.jpg" /><span>This is the caption for image 05</span></li>
					<li><img src="assets/images/raffle_slide/07.jpg" /><span>This is the caption for image 07</span></li>
					<li><img src="assets/images/raffle_slide/08.jpg" /><span>This is the caption for image 08</span></li>
					<li><img src="assets/images/raffle_slide/09.jpg" /><span>This is the caption for image 09</span></li>
				</ul>
				<script type="text/javascript">$('.slide_raffle').popSlides();</script>
				<div class="clear"></div>
				
				<p class="intitle">Silent Auction Prizes</p>
				<ul class="slide_auction slide_show">
					<li><img src="assets/images/raffle_slide/01.jpg" /><span>This is the caption for image 01</span></li>
					<li><img src="assets/images/raffle_slide/02.jpg" /><span>This is the caption for image 02</span></li>
					<li><img src="assets/images/raffle_slide/03.jpg" /><span>This is the caption for image 03</span></li>
					<li><img src="assets/images/raffle_slide/04.jpg" /><span>This is the caption for image 04</span></li>
					<li><img src="assets/images/raffle_slide/06.jpg" /><span>This is the caption for image 06</span></li>
					<li><img src="assets/images/raffle_slide/05.jpg" /><span>This is the caption for image 05</span></li>
					<li><img src="assets/images/raffle_slide/07.jpg" /><span>This is the caption for image 07</span></li>
					<li><img src="assets/images/raffle_slide/08.jpg" /><span>This is the caption for image 08</span></li>
					<li><img src="assets/images/raffle_slide/09.jpg" /><span>This is the caption for image 09</span></li>
				</ul>
				<script type="text/javascript">$('.slide_auction').popSlides();</script>
				<div class="clear"></div>
-->
				
<!--
				<p>The Iranian Business School Project hosted its <span class="standout">Annual Fundraising Event on February 5, 2010</span> at the Ballroom of The Dorchester Hotel in London.</p>
				<p>The evening's highlights included a <span class="standout">keynote speech from global business leader, Mr. Omid Kordestani</span>, Senior Advisor to the Office of the CEO and Founders at Google and <span class="standout">remarks from Dr. Ali Mashaheykhi</span>, The President of the Board of Governors of the School.</p>
				<p>The event also featured an <span class="standout">exclusive auction of a number of significant works from world-renowned Iranian artists</span> including Mr. Parviz Tanavoli. The auction will be presided over by a member of Sotheby's auction team for the second year.</p>
				<a name="sponsor"></a>
-->
<!--
				<p class="intitle">Raffle Prizes</p>
				<p><span class="standout">Seven Nights at Ciragan Palace Kempinski, Istanbul</span>, one of the Leading Hotels of the World. Enjoy a double occupancy room (breakfast included) with breathtaking views over the Bosphorus in this glamorous hotel, which was once the home of Ottoman sultans and the only palace in Istanbul to have become a five-star hotel. Valid for use until May 5, 2010.</p>
				<p><span class="standout">Spa Weekend for Two at The Cloudesley, St. Leonards-on-Sea</span>. Two nights (including breakfast) at this holistic health centre and hotel set in a tranquil garden overlooking the sea. The hotel offers delicious organic foods and excellent spa facilities.</p>
				<p><span class="standout">Mallorca Holiday for Four</span> at a lovely seaside villa in the picturesque town of Portals Nous for five nights. Available for use during April and May 2010.</p>
				<p><span class="standout">Dentistry Package for Two from Couture Smiles</span>. Receive complimentary routine dental treatments for one year, including one session per person of the latest in-surgery laser whitening treatment.</p>
				<p><span class="standout">Dinner for 10 at Fakhreldine</span>, one of London's finest Lebanese restaurants offering a lively Middle Eastern atmosphere, an elegant dining room and uninterrupted views of Green Park.</p>
				<p><span class="standout">Antique Kilim (Mafrash)</span> handmade in Azerbaijan. This beautiful work is over 80 years old and has a traditional tribal pattern and colour motif. Comes with a certificate.</p>
				<a name="purchasing"></a>

				<p>Further event and ticket information will soon be made available.</p>

-->
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>
