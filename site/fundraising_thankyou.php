<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

$ret = date('d-m-y H:i');
$ret .= "\n";

if (isset($_REQUEST)) {

	foreach ($_REQUEST as $key=>$value)
	{
		$ret .= $key . ' = ' . $value . "\n";

		if ($key == 'custom')
		{
			$row = mysql_fetch_assoc(mysql_query("SELECT * FROM ibs_community WHERE email='" . $value . "'"));

			if ($row['email'])
			{			
				$ret .= 'BUYERS DETAILS:' . "\n";
				$ret .= $row['title'] . "\n";
				$ret .= $row['forename'] . "\n";
				$ret .= $row['surname'] . "\n";
				$ret .= $row['country'] . "\n";
				$ret .= $row['email'] . " $value \n";
				$ret .= "\n";
			}
		}
	}
}

$myFile = "_paypal_result.txt";
$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, $ret);
fclose($fh);

?>