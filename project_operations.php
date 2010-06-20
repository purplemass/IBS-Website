<?php
	$this_nav = 1;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="project.php">The Project</a>
			<a class="navitem" href="project_principles.php">Governing Principles</a>
			<a class="navitem active" href="project_operations.php">Operations</a>
			<a class="navitem" href="project_organisation.php">Organisation</a>
			<a class="navitem" href="project_the_team.php">The Team</a>
			<a class="navitem" href="project_timeline.php">Project Timeline</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">How We Operate</div>
			</div>
			<div id="body">
				<p>The Iranian Business School will operate as a wholly independent, not-for-profit educational establishment located in Tehran. The Iranian Business School Project operates as a fully independent, not-for-profit entity. The Project is administered by a <a href="project_the_team.php#steering_commitee">Coordinating Committee</a>, which is responsible for strategic planning, fundraising, curriculum development and all other activities involved in the process of setting up the School.</p>
				<p>The Iranian Business School itself will also operate as a wholly independent, not-for-profit establishment. Notwithstanding its private status, the School shall ultimately operate under the auspices of the Iranian Ministry of Science, Research and Technology whose involvement will ensure that the School conforms to the legal requirements of independent educational establishments in Iran. </p>
				<p>A permit for the creation of an educational establishment in Tehran has already been obtained and the School will become operational in September 2010, commencing with Executive Education Programmes aimed at CEO and board-level executives.</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>