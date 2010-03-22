<?php

//--------------------------------------------------------------

$this_nav = 8;
require_once('controllers/html.php');
require_once('views/head.php');

//--------------------------------------------------------------

$err = '';

// are we logged in?
if (isset($_COOKIE[$mycookie_name]))
{
	$cookie = $_COOKIE[$mycookie_name];

	// are we admin?
	if ($cookie['admin'] <> '1')
		$err = 'You must be an administrator too see this page.';
}
else
{
	$err = 'You must be logged in to see this page.';
}

//--------------------------------------------------------------

if ($err == '')
{
	$show_these = array(
					'dt',
					'forename',
					'surname',
					'amount',
					'gift_aid',
				);

	$sql = "SELECT $db_table_community.*, $db_table_donations.*
			FROM $db_table_community, $db_table_donations
			WHERE $db_table_community.id=$db_table_donations.pid
			ORDER BY $db_table_donations.dt DESC";

	$donations = get_result($sql, $show_these);

	$show_these = array(
					'title',
					'forename',
					'surname',
					'email',
					'address1',
					'address2',
					'city',
					'postcode',
					'country',
					'newsletter',
					'donor',
					'register',
					'admin',
				);

	$sql = "SELECT * FROM $db_table_community";

	$members = get_result($sql, $show_these);

	echo <<<EOF

<span class="admin_title">Donations so far:</span>
<span class="small">$donations</span>
<span class="admin_title">Members so far:</span>
<span class="small">$members</span>

EOF;

}
else
{
	echo $err;
}

require_once('views/tail.php');

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

?>