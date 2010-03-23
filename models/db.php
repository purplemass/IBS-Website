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

define('TABLE_COMMUNITY', 'ibs_community');
define('TABLE_DONATIONS', 'ibs_donations');
define('TABLE_EVENTS', 'ibs_events');
define('TABLE_PAYPAL', 'ibs_paypal');
define('TABLE_DONOR_CATS', 'ibs_donor_categories');

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
	$sql_cmd = ("	UPDATE " . TABLE_COMMUNITY . "
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
	$sql_cmd = ("	INSERT INTO " . TABLE_DONATIONS . "(dt, pid, amount, gift_aid)
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
  `forename` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `surname` varchar(64) collate utf8_unicode_ci NOT NULL default '',
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
  `admin` tinyint(1) collate utf8_unicode_ci NOT NULL default 0,
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
-- Table structure for table `ibs_paypal`
--

CREATE TABLE `ibs_paypal` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `mdt` datetime NOT NULL default '0000-00-00 00:00:00',
  `pid` int(11) NOT NULL,
  `first_name` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `last_name` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `payer_email` varchar(127) collate utf8_unicode_ci NOT NULL default '',
  `address_name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `address_street` varchar(200) collate utf8_unicode_ci NOT NULL default '',
  `address_city` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `address_state` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `address_zip` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `address_country` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `address_country_code` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `residence_country` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `address_status` varchar(15) collate utf8_unicode_ci NOT NULL default '',
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

add new field:

ALTER TABLE ibs_community ADD admin tinyint(1) collate utf8_unicode_ci NOT NULL default 0 AFTER register

These do not exist in PayPal's IPN submission:

  `payer_business_name` varchar(127) collate utf8_unicode_ci NOT NULL default '',
  `contact_phone` varchar(20) collate utf8_unicode_ci NOT NULL default '',


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