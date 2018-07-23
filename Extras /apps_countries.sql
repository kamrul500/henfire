-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2018 at 11:15 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `henfire`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_countries`
--

CREATE TABLE IF NOT EXISTS `apps_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `display` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apps_countries`
--

INSERT INTO `apps_countries` (`id`, `country_code`, `country_name`, `display`) VALUES
(1, 'AF', 'Afghanistan', 0),
(2, 'AL', 'Albania', 0),
(3, 'DZ', 'Algeria', 0),
(4, 'DS', 'American Samoa', 0),
(5, 'AD', 'Andorra', 0),
(6, 'AO', 'Angola', 0),
(7, 'AI', 'Anguilla', 0),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua and Barbuda', 0),
(10, 'AR', 'Argentina', 0),
(11, 'AM', 'Armenia', 0),
(12, 'AW', 'Aruba', 0),
(13, 'AU', 'Australia', 0),
(14, 'AT', 'Austria', 0),
(15, 'AZ', 'Azerbaijan', 0),
(16, 'BS', 'Bahamas', 0),
(17, 'BH', 'Bahrain', 0),
(18, 'BD', 'Bangladesh', 0),
(19, 'BB', 'Barbados', 0),
(20, 'BY', 'Belarus', 0),
(21, 'BE', 'Belgium', 0),
(22, 'BZ', 'Belize', 0),
(23, 'BJ', 'Benin', 0),
(24, 'BM', 'Bermuda', 0),
(25, 'BT', 'Bhutan', 0),
(26, 'BO', 'Bolivia', 0),
(27, 'BA', 'Bosnia and Herzegovina', 0),
(28, 'BW', 'Botswana', 0),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 1),
(31, 'IO', 'British Indian Ocean Territory', 0),
(32, 'BN', 'Brunei Darussalam', 0),
(33, 'BG', 'Bulgaria', 0),
(34, 'BF', 'Burkina Faso', 0),
(35, 'BI', 'Burundi', 0),
(36, 'KH', 'Cambodia', 0),
(37, 'CM', 'Cameroon', 0),
(38, 'CA', 'Canada', 0),
(39, 'CV', 'Cape Verde', 0),
(40, 'KY', 'Cayman Islands', 0),
(41, 'CF', 'Central African Republic', 0),
(42, 'TD', 'Chad', 0),
(43, 'CL', 'Chile', 0),
(44, 'CN', 'China', 0),
(45, 'CX', 'Christmas Island', 0),
(46, 'CC', 'Cocos (Keeling) Islands', 0),
(47, 'CO', 'Colombia', 0),
(48, 'KM', 'Comoros', 0),
(49, 'CG', 'Congo', 0),
(50, 'CK', 'Cook Islands', 0),
(51, 'CR', 'Costa Rica', 0),
(52, 'HR', 'Croatia (Hrvatska)', 0),
(53, 'CU', 'Cuba', 0),
(54, 'CY', 'Cyprus', 0),
(55, 'CZ', 'Czech Republic', 0),
(56, 'DK', 'Denmark', 0),
(57, 'DJ', 'Djibouti', 0),
(58, 'DM', 'Dominica', 0),
(59, 'DO', 'Dominican Republic', 0),
(60, 'TP', 'East Timor', 0),
(61, 'EC', 'Ecuador', 0),
(62, 'EG', 'Egypt', 0),
(63, 'SV', 'El Salvador', 0),
(64, 'GQ', 'Equatorial Guinea', 0),
(65, 'ER', 'Eritrea', 0),
(66, 'EE', 'Estonia', 0),
(67, 'ET', 'Ethiopia', 0),
(68, 'FK', 'Falkland Islands (Malvinas)', 0),
(69, 'FO', 'Faroe Islands', 0),
(70, 'FJ', 'Fiji', 0),
(71, 'FI', 'Finland', 0),
(72, 'FR', 'France', 1),
(74, 'GF', 'French Guiana', 0),
(75, 'PF', 'French Polynesia', 0),
(76, 'TF', 'French Southern Territories', 0),
(77, 'GA', 'Gabon', 0),
(78, 'GM', 'Gambia', 0),
(79, 'GE', 'Georgia', 0),
(80, 'DE', 'Germany', 1),
(81, 'GH', 'Ghana', 0),
(82, 'GI', 'Gibraltar', 0),
(83, 'GK', 'Guernsey', 0),
(84, 'GR', 'Greece', 0),
(85, 'GL', 'Greenland', 0),
(86, 'GD', 'Grenada', 0),
(87, 'GP', 'Guadeloupe', 0),
(88, 'GU', 'Guam', 0),
(89, 'GT', 'Guatemala', 0),
(90, 'GN', 'Guinea', 0),
(91, 'GW', 'Guinea-Bissau', 0),
(92, 'GY', 'Guyana', 0),
(93, 'HT', 'Haiti', 0),
(94, 'HM', 'Heard and Mc Donald Islands', 0),
(95, 'HN', 'Honduras', 0),
(96, 'HK', 'Hong Kong', 0),
(97, 'HU', 'Hungary', 0),
(98, 'IS', 'Iceland', 0),
(99, 'IN', 'India', 0),
(100, 'IM', 'Isle of Man', 0),
(101, 'ID', 'Indonesia', 0),
(102, 'IR', 'Iran (Islamic Republic of)', 0),
(103, 'IQ', 'Iraq', 0),
(104, 'IE', 'Ireland', 0),
(105, 'IL', 'Israel', 0),
(106, 'IT', 'Italy', 1),
(107, 'CI', 'Ivory Coast', 0),
(108, 'JE', 'Jersey', 0),
(109, 'JM', 'Jamaica', 0),
(110, 'JP', 'Japan', 0),
(111, 'JO', 'Jordan', 0),
(112, 'KZ', 'Kazakhstan', 0),
(113, 'KE', 'Kenya', 0),
(114, 'KI', 'Kiribati', 0),
(115, 'KP', 'Korea, Democratic People''s Republic of', 0),
(116, 'KR', 'Korea, Republic of', 0),
(117, 'XK', 'Kosovo', 0),
(118, 'KW', 'Kuwait', 0),
(119, 'KG', 'Kyrgyzstan', 0),
(120, 'LA', 'Lao People''s Democratic Republic', 0),
(121, 'LV', 'Latvia', 0),
(122, 'LB', 'Lebanon', 0),
(123, 'LS', 'Lesotho', 0),
(124, 'LR', 'Liberia', 0),
(125, 'LY', 'Libyan Arab Jamahiriya', 0),
(126, 'LI', 'Liechtenstein', 0),
(127, 'LT', 'Lithuania', 0),
(128, 'LU', 'Luxembourg', 0),
(129, 'MO', 'Macau', 0),
(130, 'MK', 'Macedonia', 0),
(131, 'MG', 'Madagascar', 0),
(132, 'MW', 'Malawi', 0),
(133, 'MY', 'Malaysia', 0),
(134, 'MV', 'Maldives', 0),
(135, 'ML', 'Mali', 0),
(136, 'MT', 'Malta', 0),
(137, 'MH', 'Marshall Islands', 0),
(138, 'MQ', 'Martinique', 0),
(139, 'MR', 'Mauritania', 0),
(140, 'MU', 'Mauritius', 0),
(141, 'TY', 'Mayotte', 0),
(142, 'MX', 'Mexico', 0),
(143, 'FM', 'Micronesia, Federated States of', 0),
(144, 'MD', 'Moldova, Republic of', 0),
(145, 'MC', 'Monaco', 0),
(146, 'MN', 'Mongolia', 0),
(147, 'ME', 'Montenegro', 0),
(148, 'MS', 'Montserrat', 0),
(149, 'MA', 'Morocco', 0),
(150, 'MZ', 'Mozambique', 0),
(151, 'MM', 'Myanmar', 0),
(152, 'NA', 'Namibia', 0),
(153, 'NR', 'Nauru', 0),
(154, 'NP', 'Nepal', 0),
(155, 'NL', 'Netherlands', 0),
(156, 'AN', 'Netherlands Antilles', 0),
(157, 'NC', 'New Caledonia', 0),
(158, 'NZ', 'New Zealand', 0),
(159, 'NI', 'Nicaragua', 0),
(160, 'NE', 'Niger', 0),
(161, 'NG', 'Nigeria', 0),
(162, 'NU', 'Niue', 0),
(163, 'NF', 'Norfolk Island', 0),
(164, 'MP', 'Northern Mariana Islands', 0),
(165, 'NO', 'Norway', 0),
(166, 'OM', 'Oman', 0),
(167, 'PK', 'Pakistan', 0),
(168, 'PW', 'Palau', 0),
(169, 'PS', 'Palestine', 0),
(170, 'PA', 'Panama', 0),
(171, 'PG', 'Papua New Guinea', 0),
(172, 'PY', 'Paraguay', 0),
(173, 'PE', 'Peru', 0),
(174, 'PH', 'Philippines', 0),
(175, 'PN', 'Pitcairn', 0),
(176, 'PL', 'Poland', 0),
(177, 'PT', 'Portugal', 1),
(178, 'PR', 'Puerto Rico', 0),
(179, 'QA', 'Qatar', 0),
(180, 'RE', 'Reunion', 0),
(181, 'RO', 'Romania', 0),
(182, 'RU', 'Russian Federation', 0),
(183, 'RW', 'Rwanda', 0),
(184, 'KN', 'Saint Kitts and Nevis', 0),
(185, 'LC', 'Saint Lucia', 0),
(186, 'VC', 'Saint Vincent and the Grenadines', 0),
(187, 'WS', 'Samoa', 0),
(188, 'SM', 'San Marino', 0),
(189, 'ST', 'Sao Tome and Principe', 0),
(190, 'SA', 'Saudi Arabia', 0),
(191, 'SN', 'Senegal', 0),
(192, 'RS', 'Serbia', 1),
(193, 'SC', 'Seychelles', 0),
(194, 'SL', 'Sierra Leone', 0),
(195, 'SG', 'Singapore', 0),
(196, 'SK', 'Slovakia', 0),
(197, 'SI', 'Slovenia', 0),
(198, 'SB', 'Solomon Islands', 0),
(199, 'SO', 'Somalia', 0),
(200, 'ZA', 'South Africa', 0),
(201, 'GS', 'South Georgia South Sandwich Islands', 0),
(202, 'ES', 'Spain', 1),
(203, 'LK', 'Sri Lanka', 0),
(204, 'SH', 'St. Helena', 0),
(205, 'PM', 'St. Pierre and Miquelon', 0),
(206, 'SD', 'Sudan', 0),
(207, 'SR', 'Suriname', 0),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 0),
(209, 'SZ', 'Swaziland', 0),
(210, 'SE', 'Sweden', 0),
(211, 'CH', 'Switzerland', 0),
(212, 'SY', 'Syrian Arab Republic', 0),
(213, 'TW', 'Taiwan', 0),
(214, 'TJ', 'Tajikistan', 0),
(215, 'TZ', 'Tanzania, United Republic of', 0),
(216, 'TH', 'Thailand', 0),
(217, 'TG', 'Togo', 0),
(218, 'TK', 'Tokelau', 0),
(219, 'TO', 'Tonga', 0),
(220, 'TT', 'Trinidad and Tobago', 0),
(221, 'TN', 'Tunisia', 0),
(222, 'TR', 'Turkey', 0),
(223, 'TM', 'Turkmenistan', 0),
(224, 'TC', 'Turks and Caicos Islands', 0),
(225, 'TV', 'Tuvalu', 0),
(226, 'UG', 'Uganda', 0),
(227, 'UA', 'Ukraine', 0),
(228, 'AE', 'United Arab Emirates', 0),
(229, 'GB', 'United Kingdom', 1),
(230, 'US', 'United States', 1),
(231, 'UM', 'United States minor outlying islands', 0),
(232, 'UY', 'Uruguay', 0),
(233, 'UZ', 'Uzbekistan', 0),
(234, 'VU', 'Vanuatu', 0),
(235, 'VA', 'Vatican City State', 0),
(236, 'VE', 'Venezuela', 0),
(237, 'VN', 'Vietnam', 0),
(238, 'VG', 'Virgin Islands (British)', 0),
(239, 'VI', 'Virgin Islands (U.S.)', 0),
(240, 'WF', 'Wallis and Futuna Islands', 0),
(241, 'EH', 'Western Sahara', 0),
(242, 'YE', 'Yemen', 0),
(243, 'YU', 'Yugoslavia', 0),
(244, 'ZR', 'Zaire', 0),
(245, 'ZM', 'Zambia', 0),
(246, 'ZW', 'Zimbabwe', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_countries`
--
ALTER TABLE `apps_countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_countries`
--
ALTER TABLE `apps_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=247;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
