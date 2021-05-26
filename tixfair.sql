-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2021 at 03:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tixfair`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `genre_id` int(11) NOT NULL DEFAULT 0,
  `artist_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `artist_bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `popularity_sequence` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `artist_name`, `slug`, `genre_id`, `artist_image`, `artist_bio`, `artist_genre`, `status`, `popularity_sequence`, `created_at`, `updated_at`) VALUES
(1, 'artist a', 'artist-a', 2, 'artist/1614688741_user-9.jpg', 'artist a', '', 1, 0, '2021-03-02 07:09:01', '2021-03-02 07:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tour', 'tour', 'category/1614688597_travel-icon.svg', 1, '2021-03-02 07:06:37', '2021-03-02 07:06:37'),
(2, 'food', 'food', 'category/1614688607_food-drink-icon.svg', 1, '2021-03-02 07:06:47', '2021-03-02 07:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mob_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'About Us', NULL, NULL),
(2, 'Privacy Policy', 'Privacy Policy', NULL, NULL),
(3, 'T&C', 'T&C', NULL, NULL),
(4, 'Introduction', 'Introduction', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sortname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phonecode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', '+93', NULL, NULL),
(2, 'AL', 'Albania', '+355', NULL, NULL),
(3, 'DZ', 'Algeria', '+213', NULL, NULL),
(4, 'AS', 'American Samoa', '+1684', NULL, NULL),
(5, 'AD', 'Andorra', '+376', NULL, NULL),
(6, 'AO', 'Angola', '+244', NULL, NULL),
(7, 'AI', 'Anguilla', '+1264', NULL, NULL),
(8, 'AQ', 'Antarctica', '+0', NULL, NULL),
(9, 'AG', 'Antigua And Barbuda', '+1268', NULL, NULL),
(10, 'AR', 'Argentina', '+54', NULL, NULL),
(11, 'AM', 'Armenia', '+374', NULL, NULL),
(12, 'AW', 'Aruba', '+297', NULL, NULL),
(13, 'AU', 'Australia', '+61', NULL, NULL),
(14, 'AT', 'Austria', '+43', NULL, NULL),
(15, 'AZ', 'Azerbaijan', '+994', NULL, NULL),
(16, 'BS', 'Bahamas The', '+1242', NULL, NULL),
(17, 'BH', 'Bahrain', '+973', NULL, NULL),
(18, 'BD', 'Bangladesh', '+880', NULL, NULL),
(19, 'BB', 'Barbados', '+1246', NULL, NULL),
(20, 'BY', 'Belarus', '+375', NULL, NULL),
(21, 'BE', 'Belgium', '+32', NULL, NULL),
(22, 'BZ', 'Belize', '+501', NULL, NULL),
(23, 'BJ', 'Benin', '+229', NULL, NULL),
(24, 'BM', 'Bermuda', '+1441', NULL, NULL),
(25, 'BT', 'Bhutan', '+975', NULL, NULL),
(26, 'BO', 'Bolivia', '+591', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', '+387', NULL, NULL),
(28, 'BW', 'Botswana', '+267', NULL, NULL),
(29, 'BV', 'Bouvet Island', '+0', NULL, NULL),
(30, 'BR', 'Brazil', '+55', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', '+246', NULL, NULL),
(32, 'BN', 'Brunei', '+673', NULL, NULL),
(33, 'BG', 'Bulgaria', '+359', NULL, NULL),
(34, 'BF', 'Burkina Faso', '+226', NULL, NULL),
(35, 'BI', 'Burundi', '+257', NULL, NULL),
(36, 'KH', 'Cambodia', '+855', NULL, NULL),
(37, 'CM', 'Cameroon', '+237', NULL, NULL),
(38, 'CA', 'Canada', '+1', NULL, NULL),
(39, 'CV', 'Cape Verde', '+238', NULL, NULL),
(40, 'KY', 'Cayman Islands', '+1345', NULL, NULL),
(41, 'CF', 'Central African Republic', '+236', NULL, NULL),
(42, 'TD', 'Chad', '+235', NULL, NULL),
(43, 'CL', 'Chile', '+56', NULL, NULL),
(44, 'CN', 'China', '+86', NULL, NULL),
(45, 'CX', 'Christmas Island', '+61', NULL, NULL),
(46, 'CC', 'Cocos [Keeling) Islands', '+672', NULL, NULL),
(47, 'CO', 'Colombia', '+57', NULL, NULL),
(48, 'KM', 'Comoros', '+269', NULL, NULL),
(49, 'CG', 'Republic Of The Congo', '+242', NULL, NULL),
(50, 'CD', 'Democratic Republic Of The Congo', '+242', NULL, NULL),
(51, 'CK', 'Cook Islands', '+682', NULL, NULL),
(52, 'CR', 'Costa Rica', '+506', NULL, NULL),
(53, 'CI', 'Cote D\'\'Ivoire (Ivory Coast)', '+225', NULL, NULL),
(54, 'HR', 'Croatia (Hrvatska)', '+385', NULL, NULL),
(55, 'CU', 'Cuba', '+53', NULL, NULL),
(56, 'CY', 'Cyprus', '+357', NULL, NULL),
(57, 'CZ', 'Czech Republic', '+420', NULL, NULL),
(58, 'DK', 'Denmark', '+45', NULL, NULL),
(59, 'DJ', 'Djibouti', '+253', NULL, NULL),
(60, 'DM', 'Dominica', '+1767', NULL, NULL),
(61, 'DO', 'Dominican Republic', '+1809', NULL, NULL),
(62, 'TP', 'East Timor', '+670', NULL, NULL),
(63, 'EC', 'Ecuador', '+593', NULL, NULL),
(64, 'EG', 'Egypt', '+20', NULL, NULL),
(65, 'SV', 'El Salvador', '+503', NULL, NULL),
(66, 'GQ', 'Equatorial Guinea', '+240', NULL, NULL),
(67, 'ER', 'Eritrea', '+291', NULL, NULL),
(68, 'EE', 'Estonia', '+372', NULL, NULL),
(69, 'ET', 'Ethiopia', '+251', NULL, NULL),
(70, 'XA', 'External Territories of Australia', '+61', NULL, NULL),
(71, 'FK', 'Falkland Islands', '+500', NULL, NULL),
(72, 'FO', 'Faroe Islands', '+298', NULL, NULL),
(73, 'FJ', 'Fiji Islands', '+679', NULL, NULL),
(74, 'FI', 'Finland', '+358', NULL, NULL),
(75, 'FR', 'France', '+33', NULL, NULL),
(76, 'GF', 'French Guiana', '+594', NULL, NULL),
(77, 'PF', 'French Polynesia', '+689', NULL, NULL),
(78, 'TF', 'French Southern Territories', '+0', NULL, NULL),
(79, 'GA', 'Gabon', '+241', NULL, NULL),
(80, 'GM', 'Gambia The', '+220', NULL, NULL),
(81, 'GE', 'Georgia', '+995', NULL, NULL),
(82, 'DE', 'Germany', '+49', NULL, NULL),
(83, 'GH', 'Ghana', '+233', NULL, NULL),
(84, 'GI', 'Gibraltar', '+350', NULL, NULL),
(85, 'GR', 'Greece', '+30', NULL, NULL),
(86, 'GL', 'Greenland', '+299', NULL, NULL),
(87, 'GD', 'Grenada', '+1473', NULL, NULL),
(88, 'GP', 'Guadeloupe', '+590', NULL, NULL),
(89, 'GU', 'Guam', '+1671', NULL, NULL),
(90, 'GT', 'Guatemala', '+502', NULL, NULL),
(91, 'XU', 'Guernsey and Alderney', '+44', NULL, NULL),
(92, 'GN', 'Guinea', '+224', NULL, NULL),
(93, 'GW', 'Guinea-Bissau', '+245', NULL, NULL),
(94, 'GY', 'Guyana', '+592', NULL, NULL),
(95, 'HT', 'Haiti', '+509', NULL, NULL),
(96, 'HM', 'Heard and McDonald Islands', '+0', NULL, NULL),
(97, 'HN', 'Honduras', '+504', NULL, NULL),
(98, 'HK', 'Hong Kong S.A.R.', '+852', NULL, NULL),
(99, 'HU', 'Hungary', '+36', NULL, NULL),
(100, 'IS', 'Iceland', '+354', NULL, NULL),
(101, 'IN', 'India', '+91', NULL, NULL),
(102, 'ID', 'Indonesia', '+62', NULL, NULL),
(103, 'IR', 'Iran', '+98', NULL, NULL),
(104, 'IQ', 'Iraq', '+964', NULL, NULL),
(105, 'IE', 'Ireland', '+353', NULL, NULL),
(106, 'IL', 'Israel', '+972', NULL, NULL),
(107, 'IT', 'Italy', '+39', NULL, NULL),
(108, 'JM', 'Jamaica', '+1876', NULL, NULL),
(109, 'JP', 'Japan', '+81', NULL, NULL),
(110, 'XJ', 'Jersey', '+44', NULL, NULL),
(111, 'JO', 'Jordan', '+962', NULL, NULL),
(112, 'KZ', 'Kazakhstan', '+7', NULL, NULL),
(113, 'KE', 'Kenya', '+254', NULL, NULL),
(114, 'KI', 'Kiribati', '+686', NULL, NULL),
(115, 'KP', 'Korea North', '+850', NULL, NULL),
(116, 'KR', 'Korea South', '+82', NULL, NULL),
(117, 'KW', 'Kuwait', '+965', NULL, NULL),
(118, 'KG', 'Kyrgyzstan', '+996', NULL, NULL),
(119, 'LA', 'Laos', '+856', NULL, NULL),
(120, 'LV', 'Latvia', '+371', NULL, NULL),
(121, 'LB', 'Lebanon', '+961', NULL, NULL),
(122, 'LS', 'Lesotho', '+266', NULL, NULL),
(123, 'LR', 'Liberia', '+231', NULL, NULL),
(124, 'LY', 'Libya', '+218', NULL, NULL),
(125, 'LI', 'Liechtenstein', '+423', NULL, NULL),
(126, 'LT', 'Lithuania', '+370', NULL, NULL),
(127, 'LU', 'Luxembourg', '+352', NULL, NULL),
(128, 'MO', 'Macau S.A.R.', '+853', NULL, NULL),
(129, 'MK', 'Macedonia', '+389', NULL, NULL),
(130, 'MG', 'Madagascar', '+261', NULL, NULL),
(131, 'MW', 'Malawi', '+265', NULL, NULL),
(132, 'MY', 'Malaysia', '+60', NULL, NULL),
(133, 'MV', 'Maldives', '+960', NULL, NULL),
(134, 'ML', 'Mali', '+223', NULL, NULL),
(135, 'MT', 'Malta', '+356', NULL, NULL),
(136, 'XM', 'Man [Isle of)', '+44', NULL, NULL),
(137, 'MH', 'Marshall Islands', '+692', NULL, NULL),
(138, 'MQ', 'Martinique', '+596', NULL, NULL),
(139, 'MR', 'Mauritania', '+222', NULL, NULL),
(140, 'MU', 'Mauritius', '+230', NULL, NULL),
(141, 'YT', 'Mayotte', '+269', NULL, NULL),
(142, 'MX', 'Mexico', '+52', NULL, NULL),
(143, 'FM', 'Micronesia', '+691', NULL, NULL),
(144, 'MD', 'Moldova', '+373', NULL, NULL),
(145, 'MC', 'Monaco', '+377', NULL, NULL),
(146, 'MN', 'Mongolia', '+976', NULL, NULL),
(147, 'MS', 'Montserrat', '+1664', NULL, NULL),
(148, 'MA', 'Morocco', '+212', NULL, NULL),
(149, 'MZ', 'Mozambique', '+258', NULL, NULL),
(150, 'MM', 'Myanmar', '+95', NULL, NULL),
(151, 'NA', 'Namibia', '+264', NULL, NULL),
(152, 'NR', 'Nauru', '+674', NULL, NULL),
(153, 'NP', 'Nepal', '+977', NULL, NULL),
(154, 'AN', 'Netherlands Antilles', '+599', NULL, NULL),
(155, 'NL', 'Netherlands The', '+31', NULL, NULL),
(156, 'NC', 'New Caledonia', '+687', NULL, NULL),
(157, 'NZ', 'New Zealand', '+64', NULL, NULL),
(158, 'NI', 'Nicaragua', '+505', NULL, NULL),
(159, 'NE', 'Niger', '+227', NULL, NULL),
(160, 'NG', 'Nigeria', '+234', NULL, NULL),
(161, 'NU', 'Niue', '+683', NULL, NULL),
(162, 'NF', 'Norfolk Island', '+672', NULL, NULL),
(163, 'MP', 'Northern Mariana Islands', '+1670', NULL, NULL),
(164, 'NO', 'Norway', '+47', NULL, NULL),
(165, 'OM', 'Oman', '+968', NULL, NULL),
(166, 'PK', 'Pakistan', '+92', NULL, NULL),
(167, 'PW', 'Palau', '+680', NULL, NULL),
(168, 'PS', 'Palestinian Territory Occupied', '+970', NULL, NULL),
(169, 'PA', 'Panama', '+507', NULL, NULL),
(170, 'PG', 'Papua new Guinea', '+675', NULL, NULL),
(171, 'PY', 'Paraguay', '+595', NULL, NULL),
(172, 'PE', 'Peru', '+51', NULL, NULL),
(173, 'PH', 'Philippines', '+63', NULL, NULL),
(174, 'PN', 'Pitcairn Island', '+0', NULL, NULL),
(175, 'PL', 'Poland', '+48', NULL, NULL),
(176, 'PT', 'Portugal', '+351', NULL, NULL),
(177, 'PR', 'Puerto Rico', '+1787', NULL, NULL),
(178, 'QA', 'Qatar', '+974', NULL, NULL),
(179, 'RE', 'Reunion', '+262', NULL, NULL),
(180, 'RO', 'Romania', '+40', NULL, NULL),
(181, 'RU', 'Russia', '+70', NULL, NULL),
(182, 'RW', 'Rwanda', '+250', NULL, NULL),
(183, 'SH', 'Saint Helena', '+290', NULL, NULL),
(184, 'KN', 'Saint Kitts And Nevis', '+1869', NULL, NULL),
(185, 'LC', 'Saint Lucia', '+1758', NULL, NULL),
(186, 'PM', 'Saint Pierre and Miquelon', '+508', NULL, NULL),
(187, 'VC', 'Saint Vincent And The Grenadines', '+1784', NULL, NULL),
(188, 'WS', 'Samoa', '+684', NULL, NULL),
(189, 'SM', 'San Marino', '+378', NULL, NULL),
(190, 'ST', 'Sao Tome and Principe', '+239', NULL, NULL),
(191, 'SA', 'Saudi Arabia', '+966', NULL, NULL),
(192, 'SN', 'Senegal', '+221', NULL, NULL),
(193, 'RS', 'Serbia', '+381', NULL, NULL),
(194, 'SC', 'Seychelles', '+248', NULL, NULL),
(195, 'SL', 'Sierra Leone', '+232', NULL, NULL),
(196, 'SG', 'Singapore', '+65', NULL, NULL),
(197, 'SK', 'Slovakia', '+421', NULL, NULL),
(198, 'SI', 'Slovenia', '+386', NULL, NULL),
(199, 'XG', 'Smaller Territories of the UK', '+44', NULL, NULL),
(200, 'SB', 'Solomon Islands', '+677', NULL, NULL),
(201, 'SO', 'Somalia', '+252', NULL, NULL),
(202, 'ZA', 'South Africa', '+27', NULL, NULL),
(203, 'GS', 'South Georgia', '+0', NULL, NULL),
(204, 'SS', 'South Sudan', '+211', NULL, NULL),
(205, 'ES', 'Spain', '+34', NULL, NULL),
(206, 'LK', 'Sri Lanka', '+94', NULL, NULL),
(207, 'SD', 'Sudan', '+249', NULL, NULL),
(208, 'SR', 'Suriname', '+597', NULL, NULL),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', '+47', NULL, NULL),
(210, 'SZ', 'Swaziland', '+268', NULL, NULL),
(211, 'SE', 'Sweden', '+46', NULL, NULL),
(212, 'CH', 'Switzerland', '+41', NULL, NULL),
(213, 'SY', 'Syria', '+963', NULL, NULL),
(214, 'TW', 'Taiwan', '+886', NULL, NULL),
(215, 'TJ', 'Tajikistan', '+992', NULL, NULL),
(216, 'TZ', 'Tanzania', '+255', NULL, NULL),
(217, 'TH', 'Thailand', '+66', NULL, NULL),
(218, 'TG', 'Togo', '+228', NULL, NULL),
(219, 'TK', 'Tokelau', '+690', NULL, NULL),
(220, 'TO', 'Tonga', '+676', NULL, NULL),
(221, 'TT', 'Trinidad And Tobago', '+1868', NULL, NULL),
(222, 'TN', 'Tunisia', '+216', NULL, NULL),
(223, 'TR', 'Turkey', '+90', NULL, NULL),
(224, 'TM', 'Turkmenistan', '+7370', NULL, NULL),
(225, 'TC', 'Turks And Caicos Islands', '+1649', NULL, NULL),
(226, 'TV', 'Tuvalu', '+688', NULL, NULL),
(227, 'UG', 'Uganda', '+256', NULL, NULL),
(228, 'UA', 'Ukraine', '+380', NULL, NULL),
(229, 'AE', 'United Arab Emirates', '+971', NULL, NULL),
(230, 'GB', 'United Kingdom', '+44', NULL, NULL),
(231, 'US', 'United States', '+1', NULL, NULL),
(232, 'UM', 'United States Minor Outlying Islands', '+1', NULL, NULL),
(233, 'UY', 'Uruguay', '+598', NULL, NULL),
(234, 'UZ', 'Uzbekistan', '+998', NULL, NULL),
(235, 'VU', 'Vanuatu', '+678', NULL, NULL),
(236, 'VA', 'Vatican City State (Holy See)', '+39', NULL, NULL),
(237, 'VE', 'Venezuela', '+58', NULL, NULL),
(238, 'VN', 'Vietnam', '+84', NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', '+1284', NULL, NULL),
(240, 'VI', 'Virgin Islands (US)', '+1340', NULL, NULL),
(241, 'WF', 'Wallis And Futuna Islands', '+681', NULL, NULL),
(242, 'EH', 'Western Sahara', '+212', NULL, NULL),
(243, 'YE', 'Yemen', '+967', NULL, NULL),
(244, 'YU', 'Yugoslavia', '+38', NULL, NULL),
(245, 'ZM', 'Zambia', '+260', NULL, NULL),
(246, 'ZW', 'Zimbabwe', '+263', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tot_guests` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `venue_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `event_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `event_header_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `event_date` date NOT NULL,
  `event_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `slug`, `venue_id`, `category_id`, `description`, `is_featured`, `event_logo`, `event_header_image`, `organizer`, `status`, `event_date`, `event_time`, `created_at`, `updated_at`) VALUES
(1, 'event a', 'event-a', 1, 2, 'artist a', 0, 'event_logo/1614688766_event-logo-1.jpg', 'event_header_image/1614688766_event-1.jpg', 'artist a', '1', '2021-03-12', '21:09', '2021-03-02 07:09:26', '2021-03-02 07:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_artists`
--

CREATE TABLE `event_artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `artist_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_artists`
--

INSERT INTO `event_artists` (`id`, `event_id`, `artist_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-02 07:09:26', '2021-03-02 07:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `event_likes`
--

CREATE TABLE `event_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_details`
--

CREATE TABLE `event_ticket_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_category_id` int(11) NOT NULL,
  `total_tickets` int(11) NOT NULL DEFAULT 0,
  `max_ticket_per_user` int(11) NOT NULL DEFAULT 0,
  `admin_comm` decimal(6,2) NOT NULL DEFAULT 0.00,
  `per_ticket_price` decimal(6,2) NOT NULL DEFAULT 0.00,
  `available_tickets` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_ticket_details`
--

INSERT INTO `event_ticket_details` (`id`, `event_id`, `ticket_category_id`, `total_tickets`, `max_ticket_per_user`, `admin_comm`, `per_ticket_price`, `available_tickets`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 12, 1, '1.00', '1.00', '11', '2021-03-02 07:09:37', '2021-03-02 07:10:59'),
(2, 1, 1, 2, 1, '6.00', '5.00', '1', '2021-03-02 07:09:50', '2021-03-02 07:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genre_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`, `created_at`, `updated_at`) VALUES
(1, 'Indie', NULL, NULL),
(2, 'Pop', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invitation_logs`
--

CREATE TABLE `invitation_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_booking_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_18_153559_create_roles_table', 1),
(5, '2021_01_19_070228_create_categories_table', 1),
(6, '2021_01_19_072906_create_contents_table', 1),
(7, '2021_01_25_085548_create_venues_table', 1),
(8, '2021_01_25_100749_create_artists_table', 1),
(9, '2021_01_25_131336_create_events_table', 1),
(10, '2021_01_27_092523_create_event_artists_table', 1),
(11, '2021_01_27_111816_create_venue_medias_table', 1),
(12, '2021_01_29_110453_create_countries_table', 1),
(13, '2021_01_30_084856_create_contact_us_table', 1),
(14, '2021_02_01_095551_create_enquiries_table', 1),
(15, '2021_02_04_101501_create_event_likes_table', 1),
(16, '2021_02_04_122620_create_venue_likes_table', 1),
(17, '2021_02_08_033522_create_ticket_bookings_table', 1),
(18, '2021_02_08_075904_create_payments_table', 1),
(19, '2021_02_08_083939_create_ticket_booking_cart_table', 1),
(20, '2021_02_15_051014_create_genres_table', 1),
(21, '2021_02_15_111318_create_ticket_categories_table', 1),
(22, '2021_02_16_072747_create_invitation_logs_table', 1),
(23, '2021_02_19_064533_create_subscriptions_table', 1),
(24, '2021_02_19_090652_create_event_ticket_details_table', 1),
(25, '2021_03_02_104958_create_scanned_ticket_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `transaction_id`, `transaction_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1', 'pi_1IQXWpAdenQFM9zHvV0so7SP', '1614688843', 0, '2021-03-02 07:10:59', '2021-03-02 07:10:59'),
(2, 2, '5', 'pi_1IQXZIAdenQFM9zHtlbjlmuu', '1614688996', 0, '2021-03-02 07:13:34', '2021-03-02 07:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-03-02 07:05:35', '2021-03-02 07:05:35'),
(2, 'front', '2021-03-02 07:05:35', '2021-03-02 07:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `scanned_ticket_details`
--

CREATE TABLE `scanned_ticket_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `booking_id` int(11) NOT NULL DEFAULT 0,
  `ticket_category_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_bookings`
--

CREATE TABLE `ticket_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_ticket_id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `no_of_tickets` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `per_ticket_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tot_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `admin_comm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `admin_comm_val` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `qrcode_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_bookings`
--

INSERT INTO `ticket_bookings` (`id`, `user_id`, `event_ticket_id`, `event_id`, `payment_id`, `no_of_tickets`, `per_ticket_price`, `tot_amount`, `admin_comm`, `admin_comm_val`, `qrcode_link`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '1', '1', '1.00', '1', '1.00', '0.01', 'qrcode_1.svg', '2021-03-02 07:10:59', '2021-03-02 07:10:59'),
(2, 2, 2, 1, '2', '1', '5.00', '5', '6.00', '0.3', 'qrcode_2.svg', '2021-03-02 07:13:34', '2021-03-02 07:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_booking_cart`
--

CREATE TABLE `ticket_booking_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_ticket_id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `no_of_tickets` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `ticket_category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'silver', 'silver', 1, '2021-03-02 07:06:54', '2021-03-02 07:06:54'),
(2, 'platinum', 'platinum', 1, '2021-03-02 07:07:01', '2021-03-02 07:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mob_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `t_c` int(11) NOT NULL DEFAULT 1,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_email_verified` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `slug`, `email`, `role_id`, `country_code`, `mob_no`, `dob`, `gender`, `status`, `t_c`, `otp`, `is_email_verified`, `token`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'TixFair', '', 'tixfair@yopmail.com', 1, '', '', '', '', 1, 1, '', '', '', NULL, '$2y$10$wQ05LtUemdfuzVCSL.gyvuWkJH.o6MK7Az19DkrQPCmw0D4JPm8k.', NULL, NULL, NULL),
(2, 'tixtwo', 'tixtwo', 'tixtwo@yopmail.com', 2, '+971', '1234567890', '2021-03-01', 'female', 1, 1, '', '1', '', '2021-03-02 07:06:23', '$2y$10$uo4DQ3wjTe5r88mp/OzGIulQ46/lypi9aECKGtO5DRWj.JCBn0rsm', NULL, '2021-03-02 07:06:23', '2021-03-02 07:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `venue_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `digital_venue_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `venue_header_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `venue_name`, `slug`, `venue_address`, `digital_venue_address`, `venue_logo`, `venue_header_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'venue one', 'venue-one', 'Albert Hall Museum, Museum Road, Ram Niwas Garden, Kailash Puri, Adarsh Nagar, Jaipur, Rajasthan, India', 'venue one', 'venue_logo/1614688653_event-logo-1.jpg', 'venue_header_image/1614688653_event-2.jpg', 1, '2021-03-02 07:07:33', '2021-03-02 07:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `venue_likes`
--

CREATE TABLE `venue_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venue_medias`
--

CREATE TABLE `venue_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_id` int(11) NOT NULL DEFAULT 0,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `video_embed_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image_media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_artists`
--
ALTER TABLE `event_artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_likes`
--
ALTER TABLE `event_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_ticket_details`
--
ALTER TABLE `event_ticket_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_genre_name_unique` (`genre_name`);

--
-- Indexes for table `invitation_logs`
--
ALTER TABLE `invitation_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scanned_ticket_details`
--
ALTER TABLE `scanned_ticket_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_email_unique` (`email`);

--
-- Indexes for table `ticket_bookings`
--
ALTER TABLE `ticket_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_booking_cart`
--
ALTER TABLE `ticket_booking_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_categories_ticket_category_name_unique` (`ticket_category_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue_likes`
--
ALTER TABLE `venue_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue_medias`
--
ALTER TABLE `venue_medias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_artists`
--
ALTER TABLE `event_artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_likes`
--
ALTER TABLE `event_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_ticket_details`
--
ALTER TABLE `event_ticket_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invitation_logs`
--
ALTER TABLE `invitation_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scanned_ticket_details`
--
ALTER TABLE `scanned_ticket_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_bookings`
--
ALTER TABLE `ticket_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_booking_cart`
--
ALTER TABLE `ticket_booking_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venue_likes`
--
ALTER TABLE `venue_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venue_medias`
--
ALTER TABLE `venue_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
