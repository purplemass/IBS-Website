<?php
	$this_nav = 1;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem" href="project.php">The Project</a>
			<a class="navitem" href="project_principles.php">Governing Principles</a>
			<!-- <a class="navitem" href="project_operations.php">Operations</a> -->
			<a class="navitem" href="project_organisation.php">Organisation</a>
			<a class="navitem" href="project_the_team.php">The Team</a>
			<a class="navitem active" href="project_timeline.php">Project Timeline</a>
		</div>
		<div id="contentWide">
			<div id="title">
				<div class="text">Project Timeline</div>
			</div>
			<div id="body"><img src="assets/images/timeline.gif" width="700" height="455" alt="Project Timeline" /></div>
		</div>
<?php
	//require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>