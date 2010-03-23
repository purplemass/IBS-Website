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
					'id',
					'dt',
					'forename',
					'surname',
					'amount',
					'gift_aid',
				);

	$sql = "SELECT " . TABLE_COMMUNITY . ".*, " . TABLE_DONATIONS . ".*
			FROM " . TABLE_COMMUNITY. ", " . TABLE_DONATIONS . "
			WHERE " . TABLE_COMMUNITY. ".id=" . TABLE_DONATIONS .".pid
			ORDER BY " . TABLE_DONATIONS . ".dt DESC";

	$donations = get_result($sql, $show_these);

	$show_these = array(
					'id',
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

	$sql = "SELECT * FROM " . TABLE_COMMUNITY . " ORDER BY dt DESC";

	$members = get_result($sql, $show_these);

	$show_these = array(
					'id',
					'first_name',
					'last_name',
					'payer_email',
					'address_name',
					'address_street',
					'address_city',
					'address_state',
					'address_zip',
					'address_country',
					'address_country_code',
					'residence_country',
					'address_status'
				);

	$sql = "SELECT * FROM " . TABLE_PAYPAL . " ORDER BY dt DESC";

	$paypal = get_result($sql, $show_these);

/*
		<div id="menuleft">&nbsp;</div>
			<div id="title">
				<div class="text">Admin</div>
			</div>
*/

	echo <<<EOF
		<div id="content">
			<div id="body" class="small">
				<span class="admin_title">Members so far:</span>
				<div class="scroll">$members</div>
				<span class="admin_title">Donations so far:</span>
				<div class="scroll">$donations</div>
				<span class="admin_title">PayPal details so far:</span>
				<div class="scroll">$paypal</div>
			</div>
		</div>
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