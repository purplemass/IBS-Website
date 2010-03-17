<?php

//--------------------------------------------------------------

define('INCLUDE_CHECK', true);

//--------------------------------------------------------------

require 'models/config.php';
require 'models/db.php';
require 'models/functions.php';

//--------------------------------------------------------------

if ( ! (isset($_REQUEST['password']) && ($_REQUEST['password'] == 'ibs') ) )
	die('Nothing to see here!');

//--------------------------------------------------------------

$show_these = array('dt', 'forename', 'surname', 'amount', 'gift_aid');
$sql = "SELECT $db_table_community.*, $db_table_donations.*
			FROM $db_table_community, $db_table_donations
			WHERE $db_table_community.id=$db_table_donations.pid
			ORDER BY $db_table_donations.dt DESC";

$donations = get_result($sql, $show_these);

//--------------------------------------------------------------

$show_these = array('title', 'forename', 'surname', 'email', 'address1', 'address2', 'city', 'postcode', 'country', 'newsletter', 'donor', 'register');
$sql = "SELECT * FROM $db_table_community";

$members = get_result($sql, $show_these);

//--------------------------------------------------------------

function get_result($sql, $show_these)
{
	$ret = '';

	$result = mysql_query($sql);
	check_db_error();

	$ret .= '<table id="db_result">';
	$count = 1;

	$ret .= '<tr>';
	$ret .= '<td class="standout">#</td>';
	foreach ($show_these as $field)
		$ret .= '<td class="standout">' . $field . '</td>';
	$ret .= '</tr>';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		#printf("ID: %s  Name: %s <br />", $row["id"], $row["forename"]);
		$ret .= '<tr>';
		$ret .= '<td>' . $count . '</td>';
		foreach ($show_these as $field)
			$ret .= '<td>' . $row[$field] . '</td>';
		$ret .= '</tr>';

		$count++;
	}

	$ret .= '</table>';

	mysql_free_result($result);

	return $ret;
}

//--------------------------------------------------------------

$this_nav = -1;

require_once('views/head.php');

echo <<<EOF

<span class="admin_title">Donations so far:</span>
<span class="small">$donations</span>
<span class="admin_title">Members so far:</span>
<span class="small">$members</span>

EOF;

require_once('views/tail.php');

//--------------------------------------------------------------

?>