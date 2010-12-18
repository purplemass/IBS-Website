<?php if ( ! defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

//--------------------------------------------------------------

ini_set('display_errors', 0);
error_reporting(E_ERROR);

//--------------------------------------------------------------

define('EMAIL_FROM',	'noreply@ibsproject.org');
// rest of the mails are below

//--------------------------------------------------------------

define('REDIRECT_PAGE', 'index.php');
define('REGISTER_PAGE',	'register.php');

//--------------------------------------------------------------

$is_live = TRUE;
$debug = FALSE;
$loggedin = FALSE;
$admin = FALSE;

$mycookie_name = 'ibs_register';
$mycookie_expiry = 60 * 60;

$CR = "\n";

//--------------------------------------------------------------
// tiket prices

$ticket_single = 200;
$ticket_table = 1700;
$ticket_raffle = 20;
$per_table = 10;

//--------------------------------------------------------------

// Is this live?

if ( ($_SERVER['SERVER_NAME'] === 'localhost') || ($_SERVER['SERVER_NAME'] === '192.168.1.111') )
{
	$is_live = FALSE;
	$debug = TRUE;	
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}

if ($is_live)
{
	define('EMAIL_AUTO',	'info@ibsproject.org');
	define('EMAIL_SERVER',	'info@ibsproject.org');
}
else
{
	define('EMAIL_AUTO',	'b.hatamian@ibsproject.org');
	define('EMAIL_SERVER',	'b.hatamian@ibsproject.org');
}

//--------------------------------------------------------------

// navigation menu items
$nav_items = array(
					'index.php'					=>	'Home',
					'project.php'				=>	'The Project',
					'programmes.php'			=>	'Programmes',
					'project_timeline.php'		=>	'Project Timeline',
					'news_events_upcoming.php'	=>	'News &amp; Events',
					'get_involved.php'			=>	'Get involved',
					'fundraising.php'			=>	'Fundraising',
					'contact_us.php'			=>	'Contact us',
					'register.php'				=>	'Log in or register',
					);

//--------------------------------------------------------------

// images
$image_list = array(
					'index.php'					=>	'image_home.jpg',

					'project.php'				=>	'image_the_project.jpg',
					'project_operations.php'	=>	'image_the_project.jpg',
					'project_organisation.php'	=>	'image_the_project.jpg',
					'project_principles.php'	=>	'image_the_project.jpg',
					'project_the_team.php'		=>	'image_the_project.jpg',
					'project_timeline.php'		=>	'image_project_countdown.jpg',

					'programmes.php'			=>	'image_programmes.jpg',
					'programmes_curriculum.php'	=>	'image_programmes.jpg',
					'programmes_form.php'		=>	'image_programmes.jpg',

					'news_events.php'			=>	'image_news_events.jpg',
					'news_events_launch.php'	=>	'image_news_events.jpg',
					'news_events_upcoming.php'	=>	'image_news_events.jpg',
					'news_events_sponsor.php'	=>	'image_news_events.jpg',
					'news_events_video.php'		=>	'image_news_events.jpg',

					'get_involved.php'			=>	'image_get_involved.jpg',

					'fundraising.php'			=>	'image_fundraising.jpg',
					'fundraising_ways.php'		=>	'image_fundraising.jpg',

					'contact_us.php'			=>	'image_contact_us.jpg',

					'tickets_buy.php'			=>	'image_news_events.jpg',
					'tickets_register.php'		=>	'image_news_events.jpg',
					'tickets_return.php'		=>	'image_news_events.jpg',

					'register.php'				=>	'image_fundraising.jpg',
					'admin.php'					=>	'image_fundraising.jpg',

					'unsubscribe.php'			=>	'image_news_events.jpg',

					'test_images.php'			=>	'image_news_events.jpg',
					);

//--------------------------------------------------------------

// registration fields
$fields = array(
				'email' => array(
						'type'		=> 'text',
						'label'		=> 'Email address',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your email',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'title' => array(
						'type'		=> 'dropbox',
						'label'		=> 'Title',
						'length'	=> '5',
						'width'		=> '5',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your title',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'forename' => array(
						'type'		=> 'text',
						'label'		=> 'First Name',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your first name',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'surname' => array(
						'type'		=> 'text',
						'label'		=> 'Last Name',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your last name',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'address1' => array(
						'type'		=> 'text',
						'label'		=> 'Address Line 1',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'address2' => array(
						'type'		=> 'text',
						'label'		=> 'Address Line 2',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),
/*

				'address3' => array(
						'type'		=> 'text',
						'label'		=> 'Address Line 3',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'address4' => array(
						'type'		=> 'text',
						'label'		=> 'Address Line 4',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),
*/

				'city' => array(
						'type'		=> 'text',
						'label'		=> 'Town/City',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'postcode' => array(
						'type'		=> 'text',
						'label'		=> 'Post Code',
						'length'	=> '8',
						'width'		=> '8',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'country' => array(
						'type'		=> 'dropbox',
						'label'		=> 'Country of residence',
						'length'	=> '',
						'width'		=> '',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your country',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'newsletter' => array(
						'type'		=> 'dropbox',
						'label'		=> 'Subscribe to Newsletter',
						'length'	=> '',
						'width'		=> '',
						'mandatory'	=> FALSE,
						'error'		=> '',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'password' => array(
						'type'		=> 'password',
						'label'		=> 'Password',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your password',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'password_confirm' => array(
						'type'		=> 'password',
						'label'		=> 'Confirm Password',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please confirm your password',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				);

//--------------------------------------------------------------

// registration fields
$programme_fields = array(
				'title' => array(
						'type'		=> 'dropbox',
						'label'		=> 'Title',
						'length'	=> '5',
						'width'		=> '5',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your title',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'forename' => array(
						'type'		=> 'text',
						'label'		=> 'First Name',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your first name',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'surname' => array(
						'type'		=> 'text',
						'label'		=> 'Last Name',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your last name',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),

				'organisation' => array(
						'type'		=> 'text',
						'label'		=> 'Organisation',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter the name of your organisation',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'organisation_number' => array(
						'type'		=> 'dropbox',
						'label'		=> 'No. of people employed',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter the number of people employed in your organisation',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'phone' => array(
						'type'		=> 'text',
						'label'		=> 'Phone',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your phone number',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),
				'email' => array(
						'type'		=> 'text',
						'label'		=> 'Email address',
						'length'	=> '50',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your email',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),
				'city' => array(
						'type'		=> 'text',
						'label'		=> 'Town/City',
						'length'	=> '32',
						'width'		=> '27',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your city/town',
						'register'	=> TRUE,
						'donation'	=> FALSE,
						),

				'country' => array(
						'type'		=> 'dropbox',
						'label'		=> 'Country of residence',
						'length'	=> '',
						'width'		=> '',
						'mandatory'	=> TRUE,
						'error'		=> 'Please enter your country',
						'register'	=> TRUE,
						'donation'	=> TRUE,
						),
				);

//--------------------------------------------------------------

// possible titles
$programme_docs = array(
				'ibs_brochure' => 'IBS Brochure',
				'program_brochure' => 'Program Brochure',
				'faculty_information' => 'Faculty Information',
				'application_form' => 'Application Form',
				);
//--------------------------------------------------------------

// possible titles
$title_codes = array(
						'Select a title' =>'',
						'Mr'	=>'Mr',
						'Mrs'	=>'Mrs',
						'Miss'	=>'Miss',
						'Ms'	=>'Ms',
						'Dr'	=>'Dr',
						'Other'	=>'Other',
					);

//--------------------------------------------------------------

// possible no. of employees in organistaion
$organisation_numbers = array(
						'Select'				=>'',
						'< 50'					=>'less_than_50',
						'Between 50 and 500'	=>'50_500',
						'> 500'					=>'more_than_50',
					);

//--------------------------------------------------------------

// country codes
$country_codes = array(
						'Select a country'=>'',
/*
						'United Kingdom'=>'UK',
						'United States of America'=>'US',
						'Iran'=>'IR',
*/
						'Afghanistan'=>'AF',
						'Albania'=>'AL',
						'Algeria'=>'DZ',
						'American Samoa'=>'AS',
						'Andorra'=>'AD',
						'Angola'=>'AO',
						'Anguilla'=>'AI',
						'Antarctica'=>'AQ',
						'Antigua and Barbuda'=>'AG',
						'Argentina'=>'AR',
						'Armenia'=>'AM',
						'Aruba'=>'AW',
						'Australia'=>'AU',
						'Austria'=>'AT',
						'Azerbaijan'=>'AZ',
						'Bahamas'=>'BS',
						'Bahrain'=>'BH',
						'Bangladesh'=>'BD',
						'Barbados'=>'BB',
						'Belarus'=>'BY',
						'Belgium'=>'BE',
						'Belize'=>'BZ',
						'Benin'=>'BJ',
						'Bermuda'=>'BM',
						'Bhutan'=>'BT',
						'Bolivia'=>'BO',
						'Bosnia and Herzegovina'=>'BA',
						'Botswana'=>'BW',
						'Bouvet Island'=>'BV',
						'Brazil'=>'BR',
						'British Indian Ocean Territory'=>'IO',
						'British Virgin Islands'=>'VG',
						'Brunei'=>'BN',
						'Bulgaria'=>'BG',
						'Burkina Faso'=>'BF',
						'Burma'=>'MM',
						'Burundi'=>'BI',
						'Cambodia'=>'KH',
						'Cameroon'=>'CM',
						'Canada'=>'CA',
						'Cape Verde'=>'CV',
						'Cayman Islands'=>'KY',
						'Central African Republic'=>'CF',
						'Chad'=>'TD',
						'Chile'=>'CL',
						'China'=>'CN',
						'Christmas Island'=>'CX',
						'Cocos (Keeling) Islands'=>'CC',
						'Colombia'=>'CO',
						'Comoros'=>'KM',
						'Congo Democratic Republic'=>'CD',
						'Congo Republic (Middle Congo)'=>'CG',
						'Cook Islands'=>'CK',
						'Costa Rica'=>'CR',
						'Croatia'=>'HR',
						'Cuba'=>'CU',
						'Cyprus'=>'CY',
						'Czech Republic'=>'CZ',
						'Denmark'=>'DK',
						'Djibouti'=>'DJ',
						'Dominica'=>'DM',
						'Dominican Republic'=>'DO',
						'East Timor'=>'TP',
						'Ecuador'=>'EC',
						'Egypt'=>'EG',
						'El Salvador'=>'SV',
						'Equitorial Guinea'=>'GQ',
						'Eritrea'=>'ER',
						'Estonia'=>'EE',
						'Ethiopia'=>'ET',
						'Falkland Islands'=>'FK',
						'Faroe Islands'=>'FO',
						'Fiji'=>'FJ',
						'Finland'=>'FI',
						'France'=>'FR',
						'French Guiana'=>'GF',
						'French Polinesia'=>'PF',
/* 						'French Southern and Antarctic Territories'=>'TF', */
						'Gabon'=>'GA',
						'Gambia'=>'GM',
						'Georgia'=>'GE',
						'Germany'=>'DE',
						'Ghana'=>'GH',
						'Gibraltar'=>'GI',
/* 						'Great Britain'=>'UK', */
						'Greece'=>'GR',
						'Greenland'=>'GL',
						'Grenada'=>'GD',
						'Guadeloupe'=>'GP',
						'Guam'=>'GU',
						'Guatemala'=>'GT',
						'Guernsey'=>'GG',
						'Guinea'=>'GN',
						'Guinea Bissau'=>'GW',
						'Guyana'=>'GY',
						'Haiti'=>'HT',
						'Heard Island and McDonald Islands'=>'HM',
						'Honduras'=>'HN',
						'Hong Kong'=>'HK',
						'Hungary'=>'HU',
						'Iceland'=>'IS',
						'India'=>'IN',
						'Indonesia'=>'ID',
						'Iran'=>'IR',
						'Iraq'=>'IQ',
						'Ireland'=>'IE',
						'Isle of Man'=>'IM',
						'Israel'=>'IL',
						'Italy'=>'IT',
						'Ivory Coast'=>'CI',
						'Jamaica'=>'JM',
						'Japan'=>'JP',
						'Jersey'=>'JE',
						'Jordan'=>'JO',
						'Kazakhstan'=>'KZ',
						'Kenya'=>'KE',
						'Kiribati'=>'KI',
						'Korea, North'=>'KP',
						'Korea, South'=>'KR',
						'Kuwait'=>'KW',
						'Kyrgystan'=>'KG',
						'Laos'=>'LA',
						'Latvia'=>'LV',
						'Lebanon'=>'LB',
						'Lesotho'=>'LS',
						'Liberia'=>'LR',
						'Libya'=>'LY',
						'Liechtenstein'=>'LI',
						'Lithuania'=>'LT',
						'Luxembourg'=>'LU',
						'Macau'=>'MO',
						'Macedonia'=>'MK',
						'Madagascar'=>'MG',
						'Malawi'=>'MW',
						'Malaysia'=>'MY',
						'Maldives'=>'MV',
						'Mali'=>'ML',
						'Malta'=>'MT',
						'Marshall Islands'=>'MH',
						'Martinique'=>'MQ',
						'Mauritania'=>'MR',
						'Mauritius'=>'MU',
						'Mayotte'=>'YT',
						'Mexico'=>'MX',
						'Micronesia Federal States'=>'FM',
						'Moldova'=>'MD',
						'Monaco'=>'MC',
						'Mongolia'=>'MN',
						'Montserrat'=>'MS',
						'Morocco'=>'MO',
						'Mozambique'=>'MZ',
						'Myanmar'=>'MM',
						'Namibia'=>'NA',
						'Nauru'=>'NR',
						'Nepal'=>'NP',
						'Netherlands'=>'NL',
						'Netherlands Antilles'=>'AN',
						'New Caledonia'=>'NC',
						'New Zeland'=>'NZ',
						'Nicaragua'=>'NI',
						'Niger'=>'NE',
						'Nigeria'=>'NG',
						'Niue'=>'NU',
						'Norfolk Island'=>'NF',
						'Northern Mariana Islands'=>'MP',
						'North Korea'=>'KP',
						'Norway'=>'NO',
						'Oman'=>'OM',
						'Pakistan'=>'PK',
						'Palau'=>'PW',
						'Palestine'=>'PS',
						'Panama'=>'PA',
						'Papua New Guinea'=>'PG',
						'Paraguay'=>'PY',
						'Peru'=>'PE',
						'Philippines'=>'PH',
						'Pitcairn Island'=>'PN',
						'Poland'=>'PL',
						'Portugal'=>'PT',
						'Puerto Rico'=>'PR',
						'Qatar'=>'QA',
						'Reunion'=>'RE',
						'Romania'=>'RO',
						'Russia'=>'RU',
						'Rwanda'=>'RW',
						'Saint Helena'=>'SH',
						'Saint Kitts & Nevis'=>'KN',
						'Saint Lucia'=>'LC',
						'Saint Pierre and Miquelon'=>'PM',
						'Saint Vincent and The Grenadines'=>'VC',
						'Samoa'=>'WS',
						'San Marino'=>'SM',
						'Sao Tome and Principe'=>'ST',
						'Saudi Arabia'=>'SA',
						'Senegal'=>'SN',
						'Serbia and Montenegro (Yugoslavia)'=>'YU',
						'Seychelles'=>'SC',
						'Sierra Leone'=>'SL',
						'Singapore'=>'SG',
						'Slovakia'=>'SK',
						'Slovenia'=>'SI',
						'Solomon Islands'=>'SB',
						'Somalia'=>'SO',
						'South Africa'=>'ZA',
						'South Korea'=>'KR',
/* 						'South Georgia and the South Sandwich Islands'=>'GS', */
						'Spain'=>'ES',
						'Sri Lanka'=>'LK',
						'Sudan'=>'SD',
						'Suriname'=>'SR',
/* 						'Svalbard (Spitzbergen) and Jan Mayen Islands'=>'SJ', */
						'Swaziland'=>'SZ',
						'Sweden'=>'SE',
						'Switzerland'=>'CH',
						'Syria'=>'SY',
						'Taiwan'=>'TW',
						'Tajikistan'=>'TJ',
						'Tanzania'=>'TZ',
						'Thailand'=>'TH',
						'Togo'=>'TG',
						'Tokelau'=>'TK',
						'Tonga'=>'TO',
						'Trinidad & Tobago'=>'TT',
						'Tromelin Island'=>'TE',
						'Tunisia'=>'TN',
						'Turkey'=>'TR',
						'Turkmenistan'=>'TM',
						'Turks and Caicos Islands'=>'TC',
						'Tuvalu'=>'TV',
						'Uganda'=>'UG',
						'Ukraine'=>'UA',
						'United Arab Emirates'=>'AE',
						'United Kingdom (Great Britain)'=>'UK',
						'United States of America (USA)'=>'US',
						'United States Minor Outlying Islands'=>'UM',
						'Uruguay'=>'UY',
						'Uzbekistan'=>'UZ',
						'Vanuatu'=>'VU',
						'Vatican City'=>'VA',
						'Venezuela'=>'VE',
						'Vietnam'=>'VN',
						'Virgin Islands (British)'=>'VI',
						'Virgin Islands (United States)'=>'VQ',
						'Wallis and Futuna Islands'=>'WF',
						'Western Sahara'=>'EH',
						'Yemen'=>'YE',
						'Zambia'=>'ZM',
						'Zimbabwe'=>'ZW'
					);

?>