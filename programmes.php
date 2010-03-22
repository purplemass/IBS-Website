<?php
	$this_nav = 2;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
			<div id="menuleft">
				<a class="navitem active" href="programmes.php">About IBS Programmes</a>
				<a class="navitem" href="programmes_curriculum.php">Curriculum Development</a>
				<a class="navitem" href="programmes_curriculum.php#first"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />First Stage Programmes</a>
				<a class="navitem" href="programmes_curriculum.php#further"><img src="assets/images/bullet.gif" width="10" height="13" alt="bullet" />Further Stage Programmes</a>
			</div>
			<div id="content">
				<div id="title">
					<div class="text">About IBS Programmes</div>
				</div>
				<div id="body">
					<p>IBS intends to deliver management training programmes and courses to transfer knowledge and the experiences of leading international and local academics and practitioners to Iranian business managers.</p>
					<p>This will be achieved through a teaching process that balances the latest international theories and research with context-specific material relevant to the Iranian marketplace and in line with the short to medium-term outlook for the country's business environment and economy.</p>
					<p>IBS' students will benefit from a blend of focused lectures, seminars, case studies and interactive simulations supported by an advanced IT system. Local case studies and simulations will be developed to highlight the challenges of managing businesses in Iran and to encourage students to share their own experiences.</p>
					<p>International experts primarily leading Iranian-origin academics, will work closely with the local faculty to achieve effective knowledge transfer and assimilation of the best of both worlds for the benefit of the students and the country at large.</p>
					<p>IBS will be a bilingual Persian and English speaking institution.</p>
					<p>&nbsp;</p>
				</div>
			</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>