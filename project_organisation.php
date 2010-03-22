<?php
	$this_nav = 1;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
			<div id="menuleft">
				<a class="navitem" href="project.php">The Project</a>
				<a class="navitem" href="project_principles.php">Governing Principles</a>
				<a class="navitem" href="project_operations.php">Operations</a>
				<a class="navitem active" href="project_organisation.php">Organisation</a>
				<a class="navitem" href="project_the_team.php">The Team</a>
				<a class="navitem" href="project_timeline.php">Project Timeline</a>
			</div>
			<div id="contentWide">
				<div id="title">
					<div class="text">Organisational Structure</div>
				</div>
				<div id="body">
					<p>Until the Iranian Business School becomes formally operational in 2010, the Steering Committee will have full responsibility for planning and guiding all aspects of the Project.  Project Directors, external advisers and various committees operate under the Steering Committee. Experts from inside and outside the country are members of the various committees, and cooperate on the Project.</p>
					<p>The Project's organisational structure is as follows:</p>
					<p><img src="assets/images/project_organisation.gif" width="700" height="540" alt="Project Organisation" /></p>
				</div>
			</div>
<?php
	//require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>