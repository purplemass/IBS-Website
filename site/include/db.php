<?php

if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

$is_live = TRUE;
if ($_SERVER['SERVER_NAME'] === 'localhost')
	$is_live = FALSE;


/* Database config */

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

$db_table = 'ibs_community';

/* End config */


$link = mysql_connect($db_host, $db_user, $db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database, $link);
mysql_query("SET names UTF8");

/*

--
-- Table structure for table `ibs_community`
--

CREATE TABLE `ibs_community` (
  `id` int(11) NOT NULL auto_increment,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `email` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(5) collate utf8_unicode_ci NOT NULL default '',
  `forename` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `surname` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `country` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `regIP` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/


?>