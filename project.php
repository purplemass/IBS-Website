<?php
	$this_nav = 1;
	require_once('controllers/html.php');
	require_once('views/head.php');
?>
		<div id="menuleft">
			<a class="navitem active" href="project.php">The Project</a>
			<a class="navitem" href="project_principles.php">Governing Principles</a>
			<a class="navitem" href="project_operations.php">Operations</a>
			<a class="navitem" href="project_organisation.php">Organisation</a>
			<a class="navitem" href="project_the_team.php">The Team</a>
			<a class="navitem" href="project_timeline.php">Project Timeline</a>
		</div>
		<div id="content">
			<div id="title">
				<div class="text">The Project</div>
			</div>
			<div id="body">
				<p>The Iranian Business School is a philanthropically-motivated project aimed at creating a world-class business school in Iran, which will educate and prepare Iranian men and women to become business leaders capable of transforming the country's economic landscape.</p>
				<p>There is a profound strategic need for greater management know-how and expertise in Iran to meet the challenges of a rapidly developing nation located in the heart of one of the most exciting and fast growing regions of the world. Our aim is to create a centre of excellence for learning, sharing knowledge, engaging in research and offering entrepreneurial solutions to the most pressing management needs of the business community in Iran.</p>
				<p>The value of postgraduate business training as a catalyst for progress has long been recognised the world over.  The Iranian Business School, once operational as a postgraduate management institution, intends to play a leading role in the transition of the Iranian economy by providing the education and skills training required for the success of its future business leaders. It aims to become a leading centre of management excellence in the region, and a world-class educational institution.</p>
			</div>
		</div>
<?php
	require_once('views/menu_right_links.php');
	require_once('views/tail.php');
?>