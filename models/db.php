<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

//--------------------------------------------------------------

// Database config

if ($is_live)
{
	$db_host		= 'ibsproject.org.mysql';
	$db_database	= 'ibsproject_org';
	$db_user		= 'ibsproject_org';
	$db_pass		= 'Fm6RK6kf';
}
else
{
	$db_host		= 'localhost';
	$db_database	= 'ibs';
	$db_user		= 'root';
	$db_pass		= 'root';
}

$db_table_community 		= 'ibs_community';
$db_table_donations			= 'ibs_donations';
$db_table_events			= 'ibs_events';
$db_table_donor_categories	= 'ibs_donor_categories';

// End config

//--------------------------------------------------------------

$link = mysql_connect($db_host, $db_user, $db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database, $link);
mysql_query("SET names UTF8");

//--------------------------------------------------------------

/**
 * Fetch row from DB
 *
 * @access public
 * @param string	sql command
 * @return array	result
 */
function db_fetch($sql)
{
	$row = mysql_fetch_assoc(mysql_query($sql));
	check_db_error();

	return $row;
}

//--------------------------------------------------------------

/**
 * Insert any value into community table
 *
 * @access public
 * @param string	field name
 * @param float		field value
 * @return void
 */
function insert_value($field, $value, $pid)
{
	global $db_table_community;

	$sql_cmd = ("	UPDATE $db_table_community
					SET mdt = NOW(), " . $field . " = '" . $value . "'
					
						WHERE id=" . $pid . "

					");
	
	mysql_query($sql_cmd);
	check_db_error();
}

//--------------------------------------------------------------

/**
 * Insert amount/gift_aid into DB
 *
 * @access public
 * @param int		person's id
 * @param float		amount
 * @return void
 */
function insert_amount($pid, $amount, $gift_aid)
{
	global $db_table_donations;

	$sql_cmd = ("	INSERT INTO $db_table_donations(dt, pid, amount, gift_aid)
					VALUES(

						NOW(),
						'" . $pid . "',
						'" . $amount . "',
						'" . $gift_aid . "'

					)");
	
	mysql_query($sql_cmd);
	check_db_error();
}

//--------------------------------------------------------------

/**
 * Checks for DB errors - debugging only
 *
 * @access public
 * @return void
 */
function check_db_error($sql_cmd='')
{
	global $debug, $link;

	if ( ($debug === true) && (mysql_errno($link) <> 0) )
		echo mysql_errno($link) . ": " . mysql_error($link). "<br />" . $sql_cmd . "<br />";
}

//--------------------------------------------------------------

// Database Schema

/*

--
-- Table structure for table `ibs_community`
--

CREATE TABLE `ibs_community` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `mdt` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(5) collate utf8_unicode_ci NOT NULL default '',
  `forename` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `surname` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `password` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `address1` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `address2` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `address3` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `address4` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `city` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `postcode` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `country` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `donor` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  `donor_category` int(2) NOT NULL,
  `newsletter` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  `register` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  `deleted` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `ibs_donations`
--

CREATE TABLE `ibs_donations` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `pid` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL default 0.00,
  `gift_aid` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `ibs_events`
--

CREATE TABLE `ibs_events` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `pid` int(11) NOT NULL,
  `date_attended` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `ibs_donor_categories`
--

CREATE TABLE `ibs_donor_categories` (
  `id` int(2) NOT NULL auto_increment,
  `category` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




//--------------------------------------------------------------

// OLD Database Schema

CREATE TABLE `ibs_community` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `email` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(5) collate utf8_unicode_ci NOT NULL default '',
  `forename` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `surname` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `country` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `newsletter` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
  `regIP` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `ibs_donations` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `pid` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL default 0.00,
  `regIP` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


// removed this: regIP = '".$_SERVER['REMOTE_ADDR']."'

*/


?>