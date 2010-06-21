<?php
	$this_nav = 0;
	require_once('controllers/html.php');
	require_once('views/head.php');
	require_once('views/menu_left_index.php');
?>
		<div id="content">
			<div id="title">
				<div class="text">Welcome Message</div>
			</div>
			<div id="body">
				<!-- VIDEO: start -->
				<script type="text/javascript" src="assets/flowplayer/flowplayer-3.1.4.min.js"></script>
				<!-- this A tag is where your Flowplayer will be placed. it can be anywhere -->
				<a
					href="assets/videos/IBS_promo_video.flv"
					style="display:block;width:430px;height:275px"
					id="flplayer">
				</a>					
				<!-- this will install flowplayer inside previous A- tag. -->
				<script>
				flowplayer("flplayer", "assets/flowplayer/flowplayer.swf",
				{
					clip:
					{
						autoPlay: false,
						autoBuffering: false
					},
					
					plugins:
					{
						controls:
						{
						 	url: 'assets/flowplayer/flowplayer.controls.swf'
						}
					}

				});
				</script>
				<!-- VIDEO: end -->
				<p class="caption">Listen to the founders and supporters of the Iranian Business School Project provide insight into the vision and drive behind the School and the enormous contribution it stands to make to Iran and its next generation of business leaders.</p>
				<p>The Iranian Business School (IBS) Project is a not-for-profit venture spearheaded by a group of philanthropists from the business community of the Iranian Diaspora and supported by leading private sector figures within Iran. Together, these individuals have been inspired to engage in a movement to bring opportunity to Iran, a nation brimming with unrealised potential. Educated, ambitious and enterprising, the young citizens of this ancient country possess the same qualities that have placed thousands of their peers abroad amongst a recognised category of the international business elite.  What differentiates them is access to the facilities that can nurture their talents, fortify their knowledge and provide the necessary proficiencies to participate in the global economy.</p>
				<p>The Iranian Business School intends to address this longstanding void through the creation of a world-class business school that will operate on a principle of excellence in one of the most undervalued emerging markets in the world.  The School aims to develop conscientious leaders and entrepreneurs whose unwavering commitment to professionalism will complement their acquired knowledge of the very best in theoretical and applied modern business practices.  As well as determining the future prospects of the individual graduates, the successful achievement of this goal will create value for the organisations that employ them, and ultimately benefit the broader society.  Global organisations can view Iran as a more attractive prospect for commerce and the potential presented by the country's natural and human wealth will be realised.</p>
				<p>The Founders and Executive Committee Members of the Iranian Business School Project invite you to join us in the endeavour to proactively improve and facilitate the competitiveness of the Iranian economy of tomorrow.</p>
				<!-- <a href="project_the_team.php#committee"></a> -->
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>