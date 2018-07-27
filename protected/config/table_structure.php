<?php
$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."admin (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."apps_countries (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `display` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
INSERT INTO ".$table_prefix."apps_countries (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'YU', 'Yugoslavia'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."auth (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."categories (
  `id` int(11) NOT NULL,
  `cat_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";


$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."deposits (
  `id` int(11) NOT NULL,
  `sum` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `paid` varchar(10) NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."freelancejobs (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `video` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `date_expire` date NOT NULL,
  `cost` int(10) NOT NULL,
  `promoted` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `success` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."hourlies (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `title` varchar(250)  NOT NULL,
  `description` text  NOT NULL,
  `category` varchar(250)  DEFAULT NULL,
  `subCat` varchar(250)  DEFAULT NULL,
  `video` varchar(150)  DEFAULT NULL,
  `images` text ,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `delivery_time` tinyint(10) NOT NULL DEFAULT '1',
  `cost` int(10) NOT NULL DEFAULT '0',
  `promoted` int(11) DEFAULT '0',
  `promoted_till` timestamp NULL DEFAULT NULL,
  `promoted_paypal_auth` varchar(250)  DEFAULT NULL,
  `promoted_term` int(11) DEFAULT NULL,
  `paid` int(11) DEFAULT '0',
  `success` int(11) DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `sales` int(100) DEFAULT '0',
  `country_code` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `hourlie_addons` text ,
  `needed` text ,
  `dissabled` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."hourliesreviews (
  `id` int(11) NOT NULL,
  `hourlie_id` int(11) NOT NULL DEFAULT '0',
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `rating` varchar(3)  NOT NULL DEFAULT '0',
  `review` text ,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `replies` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."hourliessales (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT '0',
  `buyer_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL,
  `item_name` varchar(250)  NOT NULL DEFAULT '',
  `cost` varchar(11)  DEFAULT NULL,
  `total_cost` varchar(10)  DEFAULT NULL,
  `amount_bought` int(11) DEFAULT NULL,
  `date_bought` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_status` varchar(120)  DEFAULT 'Pending',
  `buyer_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `seller_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `date_completed` datetime DEFAULT NULL,
  `isEscro` tinyint(1) NOT NULL DEFAULT '0',
  `released_escro` tinyint(1) NOT NULL DEFAULT '0',
  `buyer_transaction_code` varchar(250)  DEFAULT NULL,
  `payment_type` varchar(250)  DEFAULT NULL,
  `buyer_paypal` varchar(250)  DEFAULT NULL,
  `buyer_paypal_auth` varchar(250)  DEFAULT NULL,
  `seller_paypal` varchar(250)  DEFAULT NULL,
  `buyer_card_vault` varchar(250)  DEFAULT NULL,
  `complaint` tinyint(1) NOT NULL DEFAULT '0',
  `complaint_message` text ,
  `is_refunded` tinyint(1) NOT NULL DEFAULT '0',
  `seller_transaction_code` varchar(250)  DEFAULT NULL,
  `custom_trans_id` varchar(250)  DEFAULT NULL,
  `our_commission` varchar(22)  DEFAULT NULL,
  `totalaftercommission` varchar(22)  NOT NULL,
  `sellers_currency` varchar(4)  NOT NULL,
  `buyers_currency` varchar(4)  NOT NULL,
  `origional_currency_price` varchar(10)  NOT NULL,
  `freelancer_paid` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."hourlieworkflow (
  `id` int(11) NOT NULL,
  `workstream` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text  NOT NULL,
  `upload` varchar(250)  DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flagged` int(1) NOT NULL DEFAULT '0',
  `flagged_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."hourlieworkstream (
  `job_id` int(20) NOT NULL,
  `freelancer_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `is_finished` int(1) DEFAULT '0',
  `admin_flagged` int(1) DEFAULT '0',
  `freelancer_flagged` int(1) DEFAULT '0',
  `member_flagged` int(1) DEFAULT '0',
  `flagged_comment` text ,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."invite (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `frelancer` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `job_id` int(11) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."job (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `title` varchar(100)  NOT NULL,
  `description` text  NOT NULL,
  `category` varchar(250)  DEFAULT NULL,
  `subCat` varchar(250)  NOT NULL,
  `date_created` datetime NOT NULL,
  `date_expire` varchar(22)  DEFAULT NULL,
  `material` text ,
  `promoted` int(11) DEFAULT '0',
  `paid` int(11) NOT NULL DEFAULT '0',
  `success` int(11) NOT NULL DEFAULT '0',
  `isEscro` int(1) NOT NULL DEFAULT '0',
  `released_escro` int(1) NOT NULL DEFAULT '0',
  `freelancer` int(20) DEFAULT '0',
  `freelancer_paypal` varchar(120)  DEFAULT NULL,
  `freelancer_paid` int(11) NOT NULL DEFAULT '0',
  `buyer_cancelled` int(1) NOT NULL DEFAULT '0',
  `seller_cancelled` int(1) NOT NULL DEFAULT '0',
  `date_completed` int(11) DEFAULT NULL,
  `worktype` varchar(22)  DEFAULT NULL,
  `currency` varchar(22)  DEFAULT NULL,
  `budget` varchar(100)  DEFAULT NULL,
  `agreed_price` int(150) DEFAULT NULL,
  `experience_level` int(1) NOT NULL DEFAULT '0',
  `buyer_transaction_code` varchar(250)  DEFAULT NULL,
  `payment_type` varchar(50)  DEFAULT NULL,
  `buyer_paypal` varchar(150)  DEFAULT NULL,
  `buyer_paypal_auth` varchar(250)  DEFAULT NULL,
  `seller_paypal` varchar(150)  DEFAULT NULL,
  `buyer_card_vault` varchar(250)  DEFAULT NULL,
  `complaint` int(1) NOT NULL DEFAULT '0',
  `complaint_message` text ,
  `custom_trans_id` varchar(250)  DEFAULT NULL,
  `our_commission` varchar(150)  DEFAULT NULL,
  `totalaftercommission` varchar(150)  DEFAULT NULL,
  `sellers_currency` varchar(5)  DEFAULT NULL,
  `buyers_currency` varchar(2)  DEFAULT NULL,
  `origional_currency_price` int(150) DEFAULT NULL,
  `is_refunded` int(11) NOT NULL DEFAULT '0',
  `dissabled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."jobreviews (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `rating` varchar(3)  NOT NULL DEFAULT '0',
  `review` text ,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `replies` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."jobworkflow (
  `id` int(11) NOT NULL,
  `workstream` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text  NOT NULL,
  `upload` varchar(250)  DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flagged` int(1) NOT NULL DEFAULT '0',
  `flagged_comment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."jobworkstream (
  `job_id` int(20) NOT NULL,
  `freelancer_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `is_finished` int(1) DEFAULT '0',
  `admin_flagged` int(1) DEFAULT '0',
  `freelancer_flagged` int(1) DEFAULT '0',
  `member_flagged` int(1) DEFAULT '0',
  `flagged_comment` text ,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."job_category (
  `id` int(11) NOT NULL,
  `Category` varchar(250)  NOT NULL,
  `SubCategory` varchar(250)  NOT NULL,
  `glyphicon` varchar(220)  DEFAULT NULL,
  `description` tinytext ,
  `image` varchar(250)  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";


$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."job_proposals (
  `id` int(11) NOT NULL,
  `job_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `delivery_time` varchar(10)  NOT NULL,
  `comment` text  NOT NULL,
  `accepted` int(1) NOT NULL DEFAULT '0',
  `declined` int(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."job_questions (
  `id` int(11) NOT NULL,
  `job_proposal_id` int(11) NOT NULL,
  `job_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `answer_date` datetime DEFAULT NULL,
  `upload` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."migration (
  `version` varchar(180)  NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."payments (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sum` varchar(20) NOT NULL,
  `job_id` int(20) DEFAULT NULL,
  `hourlie_id` int(20) NOT NULL DEFAULT '0',
  `withdrawn` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."payment_requests (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sum` int(10) NOT NULL DEFAULT '0',
  `job_id` int(10) DEFAULT NULL,
  `hourlie_id` int(19) DEFAULT NULL,
  `withdraw_method` varchar(250) DEFAULT NULL,
  `payment_type` varchar(250) DEFAULT NULL,
  `paypal_email` varchar(250) DEFAULT NULL,
  `paid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."profile (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."session_frontend_user (
  `id` char(80) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(15) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."settings (
  `id` int(11) NOT NULL,
  `sitename` varchar(100) NOT NULL,
  `site_seo_title` varchar(120) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `google` varchar(250) NOT NULL,
  `commission` varchar(3) NOT NULL DEFAULT '0',
  `paypal_enabled` int(1) NOT NULL DEFAULT '0',
  `paypal_pro_enavled` int(1) NOT NULL DEFAULT '0',
  `stripe_enabled` int(1) NOT NULL DEFAULT '0',
  `PayPalAuth` varchar(250) DEFAULT NULL,
  `PayPalSecret` varchar(250) DEFAULT NULL,
  `PayPalEnvironment` varchar(10) DEFAULT NULL,
  `hourlie_feature_price` int(10) DEFAULT '0',
  `freelancer_feature_price` int(10) NOT NULL DEFAULT '0',
  `feature_hourlie_price` int(11) DEFAULT '0',
  `feature_job_price` int(11) DEFAULT '0',
  `analytics` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."skills (
  `skill` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."social_login (
  `id` int(11) NOT NULL,
  `social` varchar(150) NOT NULL,
  `app_id` varchar(250) NOT NULL,
  `app_secret` varchar(250) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."social_account (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."token (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";


$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."user (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `paypal_email` varchar(250) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `country` varchar(22) DEFAULT NULL,
  `country_code` varchar(20) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `introduction` text COLLATE utf8_unicode_ci,
  `hourlie_rate` int(5) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `skills` text COLLATE utf8_unicode_ci,
  `cover_photo` varchar(255) DEFAULT NULL,
  `portfolio` text COLLATE utf8_unicode_ci,
  `website_url` varchar(255) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `available_now` int(1) NOT NULL DEFAULT '1',
  `facebook` varchar(250) DEFAULT NULL,
  `linkedin` varchar(250) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `is_freelancer` int(1) DEFAULT '0',
  `storedfunds` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."userreviews (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `reviewr_id` int(20) NOT NULL,
  `review` text NOT NULL,
  `rating` varchar(10) NOT NULL DEFAULT '0',
  `hourlie` int(11) NOT NULL DEFAULT '0',
  `job` int(11) NOT NULL DEFAULT '0',
  `project_id` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

$tbl[]="
CREATE TABLE IF NOT EXISTS ".$table_prefix."withdrawals (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_requested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_sent` datetime DEFAULT NULL,
  `sum` varchar(22) NOT NULL DEFAULT '0',
  `paid_status` varchar(11) NOT NULL DEFAULT 'Pending',
  `job_id` int(11) DEFAULT NULL,
  `hourlie_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
";
/*end table*/

/*Start Alter*/
$tbl[]="
ALTER TABLE ".$table_prefix."admin
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`),
ADD UNIQUE KEY `email` (`email`),
ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."apps_countries
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."auth
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."categories
  ADD PRIMARY KEY (`id`);

";
$tbl[]="
ALTER TABLE ".$table_prefix."deposits
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."freelancejobs
  ADD PRIMARY KEY (`id`);

";
$tbl[]="
ALTER TABLE ".$table_prefix."hourlies
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourliesreviews
ADD PRIMARY KEY (`id`,`hourlie_id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `hourliesreviews_ibfk_2` (`freelancer_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourliessales
ADD PRIMARY KEY (`id`),
ADD KEY `hourliessales_ibfk_1` (`seller_id`),
ADD KEY `buyer_id` (`buyer_id`),
ADD KEY `item_id` (`item_id`),
ADD KEY `hourliessales_ibfk_4` (`buyer_paypal`),
ADD KEY `seller_paypal` (`seller_paypal`);
";
$tbl[]="
ALTER TABLE ".$table_prefix."hourlieworkflow
  ADD PRIMARY KEY (`id`),
  ADD KEY `workstream` (`workstream`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourlieworkstream
  ADD PRIMARY KEY (`job_id`);";

$tbl[]="
ALTER TABLE ".$table_prefix."invite
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."job
  ADD PRIMARY KEY (`id`,`user_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."jobreviews
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `hourliesreviews_ibfk_2` (`freelancer_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."jobworkflow
  ADD PRIMARY KEY (`id`),
  ADD KEY `workstream` (`workstream`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."jobworkstream
  ADD PRIMARY KEY (`job_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."job_category
  ADD PRIMARY KEY (`id`);
";
$tbl[]="
ALTER TABLE ".$table_prefix."job_proposals
ADD PRIMARY KEY (`id`),
ADD KEY `job_id` (`job_id`),
ADD KEY `user_id` (`user_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."job_questions
ADD PRIMARY KEY (`id`),
ADD KEY `job_id` (`job_id`),
ADD KEY `user_id` (`user_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."migration
  ADD PRIMARY KEY (`version`);
  ";

$tbl[]="
ALTER TABLE ".$table_prefix."profile
  ADD PRIMARY KEY (`user_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."payments
ADD PRIMARY KEY (`id`),
ADD KEY `user_id` (`user_id`),
ADD KEY `hourlie_id` (`hourlie_id`),
ADD KEY `job_id` (`job_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."payment_requests
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."session_frontend_user
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."settings
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."social_account
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);
";
$tbl[]="
ALTER TABLE ".$table_prefix."social_login
  ADD PRIMARY KEY (`id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."token
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."user
ADD PRIMARY KEY (`id`),
ADD KEY `username` (`username`),
ADD KEY `email` (`email`),
ADD KEY `paypal_email` (`paypal_email`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."userreviews
ADD PRIMARY KEY (`id`),
ADD KEY `userreviews_ibfk_1` (`user_id`),
ADD KEY `userreviews_ibfk_2` (`reviewr_id`);
";

$tbl[]="
ALTER TABLE ".$table_prefix."withdrawals
  ADD PRIMARY KEY (`id`);
";

//Auto increment
$tbl[]="
ALTER TABLE ".$table_prefix."admin
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."apps_countries
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."auth
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."categories
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."deposits
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."hourlies
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."hourliesreviews
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."hourliessales
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."hourlieworkflow
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."invite
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."job
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."jobreviews
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."jobworkflow
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."job_category
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."job_proposals
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."job_questions
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."payments
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."payment_requests
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."settings
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."social_account
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."social_login
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."user
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."userreviews
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";
$tbl[]="
ALTER TABLE ".$table_prefix."payment_requests
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";

$tbl[]="
ALTER TABLE ".$table_prefix."withdrawals
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


//Constraints
$tbl[]="
ALTER TABLE ".$table_prefix."hourlies
  ADD CONSTRAINT `".$table_prefix."hourlies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourliesreviews
  ADD CONSTRAINT `".$table_prefix."hourliesreviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."hourliesreviews_ibfk_2` FOREIGN KEY (`freelancer_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourliessales
  ADD CONSTRAINT `".$table_prefix."hourliessales_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."hourliessales_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."hourliessales_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `".$table_prefix."hourlies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."hourliessales_ibfk_4` FOREIGN KEY (`buyer_paypal`) REFERENCES `".$table_prefix."user` (`paypal_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."hourliessales_ibfk_5` FOREIGN KEY (`seller_paypal`) REFERENCES `".$table_prefix."user` (`paypal_email`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."hourlieworkflow
  ADD CONSTRAINT `".$table_prefix."hourlieworkflow_ibfk_1` FOREIGN KEY (`workstream`) REFERENCES `".$table_prefix."hourlieworkstream` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."jobworkflow
  ADD CONSTRAINT `".$table_prefix."workstreamcask` FOREIGN KEY (`workstream`) REFERENCES `".$table_prefix."jobworkstream` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."job_proposals
  ADD CONSTRAINT `".$table_prefix."job_proposals_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `".$table_prefix."job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."job_proposals_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."job_questions
  ADD CONSTRAINT `".$table_prefix."job_questions_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `".$table_prefix."job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."job_questions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."payments
  ADD CONSTRAINT `".$table_prefix."payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."payments_ibfk_2` FOREIGN KEY (`hourlie_id`) REFERENCES `".$table_prefix."hourlies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."payments_ibfk_3` FOREIGN KEY (`job_id`) REFERENCES `".$table_prefix."job` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."profile
  ADD CONSTRAINT `".$table_prefix."fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."social_account
  ADD CONSTRAINT `".$table_prefix."fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."token
  ADD CONSTRAINT `".$table_prefix."fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE;
";

$tbl[]="
ALTER TABLE ".$table_prefix."userreviews
  ADD CONSTRAINT `".$table_prefix."userreviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `".$table_prefix."userreviews_ibfk_2` FOREIGN KEY (`reviewr_id`) REFERENCES `".$table_prefix."user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";
