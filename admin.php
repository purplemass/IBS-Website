<?php

#error_reporting(E_ERROR);

define('INCLUDE_CHECK', true);

require 'include/db.php';
require 'include/functions.php';

$ret = '';

#$result = mysql_query("SELECT * FROM $db_table_community");
$result = mysql_query("SELECT $db_table_community.*, $db_table_donations.* FROM $db_table_community, $db_table_donations WHERE $db_table_community.id=$db_table_donations.pid ORDER BY $db_table_donations.dt DESC");

$ret .= '<table id="db_result">';
$count = 1;
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

	#printf("ID: %s  Name: %s <br />", $row["id"], $row["forename"]);

	$ret .= '<tr>';
/* 	$ret .= '<td>' . $row['id'] . '</td>'; */
 	$ret .= '<td>' . $count . '</td>';
 	$ret .= '<td>' . $row['dt'] . '</td>';
	$ret .= '<td>' . $row['email'] . '</td>';
	$ret .= '<td>' . $row['forename'] . '</td>';
	$ret .= '<td>' . $row['surname'] . '</td>';
	$ret .= '<td>' . $row['country'] . '</td>';
	$ret .= '<td>' . $row['amount'] . '</td>';
	$ret .= '</tr>';
	
	$count++;
}

$ret .= '</table>';

mysql_free_result($result);

$this_nav = 6;
require_once('include/html_head.php');
echo 'Existing donations so far:';
echo $ret;
require_once('include/html_tail.php');
?>