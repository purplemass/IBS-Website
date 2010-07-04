<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require_once('../models/functions.php');

$list = directory_listing('.');

echo "<p>List of files:</p>";

foreach ($list as $file)
{
	if (strrpos($file, '.txt') > -1)
		echo '<a href="' . $file . '">' . $file . "</a><br />\n";
}

?>