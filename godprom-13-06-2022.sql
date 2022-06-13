-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 juin 2022 à 12:26
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `godprom`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role` enum('superadmin','admin','manager','support','default') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Djeck AMENYAGLO', 'djeckamenyaglo@gmail.com', '2022-03-21 14:39:41', '$2y$10$eyF611e9nQfNgeVlKLXfBu5kweWdiIg7DajnlHPeFpcpwB9Upzftm', 'active', 'superadmin', NULL, '2022-03-21 14:39:42', '2022-03-21 14:39:42', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, '2022-03-21 14:39:41', '2022-03-21 14:39:41', NULL),
(2, 2, NULL, '2022-03-21 14:43:58', '2022-03-21 14:43:58', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pickup_country` tinyint(1) NOT NULL DEFAULT 0,
  `is_delivery_country` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `is_pickup_country`, `is_delivery_country`, `deleted_at`) VALUES
(1, 'United States', 'US', 0, 0, NULL),
(2, 'Canada', 'CA', 0, 0, NULL),
(3, 'Afghanistan', 'AF', 0, 0, NULL),
(4, 'Albania', 'AL', 0, 0, NULL),
(5, 'Algeria', 'DZ', 0, 0, NULL),
(6, 'American Samoa', 'AS', 0, 0, NULL),
(7, 'Andorra', 'AD', 0, 0, NULL),
(8, 'Angola', 'AO', 0, 0, NULL),
(9, 'Anguilla', 'AI', 0, 0, NULL),
(10, 'Antarctica', 'AQ', 0, 0, NULL),
(11, 'Antigua and/or Barbuda', 'AG', 0, 0, NULL),
(12, 'Argentina', 'AR', 0, 0, NULL),
(13, 'Armenia', 'AM', 0, 0, NULL),
(14, 'Aruba', 'AW', 0, 0, NULL),
(15, 'Australia', 'AU', 0, 0, NULL),
(16, 'Austria', 'AT', 0, 0, NULL),
(17, 'Azerbaijan', 'AZ', 0, 0, NULL),
(18, 'Bahamas', 'BS', 0, 0, NULL),
(19, 'Bahrain', 'BH', 0, 0, NULL),
(20, 'Bangladesh', 'BD', 0, 0, NULL),
(21, 'Barbados', 'BB', 0, 0, NULL),
(22, 'Belarus', 'BY', 0, 0, NULL),
(23, 'Belgium', 'BE', 0, 0, NULL),
(24, 'Belize', 'BZ', 0, 0, NULL),
(25, 'Benin', 'BJ', 0, 1, NULL),
(26, 'Bermuda', 'BM', 0, 0, NULL),
(27, 'Bhutan', 'BT', 0, 0, NULL),
(28, 'Bolivia', 'BO', 0, 0, NULL),
(29, 'Bosnia and Herzegovina', 'BA', 0, 0, NULL),
(30, 'Botswana', 'BW', 0, 0, NULL),
(31, 'Bouvet Island', 'BV', 0, 0, NULL),
(32, 'Brazil', 'BR', 0, 0, NULL),
(33, 'British lndian Ocean Territory', 'IO', 0, 0, NULL),
(34, 'Brunei Darussalam', 'BN', 0, 0, NULL),
(35, 'Bulgaria', 'BG', 0, 0, NULL),
(36, 'Burkina Faso', 'BF', 0, 0, NULL),
(37, 'Burundi', 'BI', 0, 0, NULL),
(38, 'Cambodia', 'KH', 0, 0, NULL),
(39, 'Cameroon', 'CM', 0, 0, NULL),
(40, 'Cape Verde', 'CV', 0, 0, NULL),
(41, 'Cayman Islands', 'KY', 0, 0, NULL),
(42, 'Central African Republic', 'CF', 0, 0, NULL),
(43, 'Chad', 'TD', 0, 0, NULL),
(44, 'Chile', 'CL', 0, 0, NULL),
(45, 'China', 'CN', 0, 0, NULL),
(46, 'Christmas Island', 'CX', 0, 0, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', 0, 0, NULL),
(48, 'Colombia', 'CO', 0, 0, NULL),
(49, 'Comoros', 'KM', 0, 0, NULL),
(50, 'Congo', 'CG', 0, 0, NULL),
(51, 'Cook Islands', 'CK', 0, 0, NULL),
(52, 'Costa Rica', 'CR', 0, 0, NULL),
(53, 'Croatia (Hrvatska)', 'HR', 0, 0, NULL),
(54, 'Cuba', 'CU', 0, 0, NULL),
(55, 'Cyprus', 'CY', 0, 0, NULL),
(56, 'Czech Republic', 'CZ', 0, 0, NULL),
(57, 'Democratic Republic of Congo', 'CD', 0, 0, NULL),
(58, 'Denmark', 'DK', 0, 0, NULL),
(59, 'Djibouti', 'DJ', 0, 0, NULL),
(60, 'Dominica', 'DM', 0, 0, NULL),
(61, 'Dominican Republic', 'DO', 0, 0, NULL),
(62, 'East Timor', 'TP', 0, 0, NULL),
(63, 'Ecudaor', 'EC', 0, 0, NULL),
(64, 'Egypt', 'EG', 0, 0, NULL),
(65, 'El Salvador', 'SV', 0, 0, NULL),
(66, 'Equatorial Guinea', 'GQ', 0, 0, NULL),
(67, 'Eritrea', 'ER', 0, 0, NULL),
(68, 'Estonia', 'EE', 0, 0, NULL),
(69, 'Ethiopia', 'ET', 0, 0, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', 0, 0, NULL),
(71, 'Faroe Islands', 'FO', 0, 0, NULL),
(72, 'Fiji', 'FJ', 0, 0, NULL),
(73, 'Finland', 'FI', 0, 0, NULL),
(74, 'France', 'FR', 1, 1, NULL),
(75, 'France, Metropolitan', 'FX', 1, 1, NULL),
(76, 'French Guiana', 'GF', 0, 0, NULL),
(77, 'French Polynesia', 'PF', 0, 0, NULL),
(78, 'French Southern Territories', 'TF', 0, 0, NULL),
(79, 'Gabon', 'GA', 0, 0, NULL),
(80, 'Gambia', 'GM', 0, 0, NULL),
(81, 'Georgia', 'GE', 0, 0, NULL),
(82, 'Germany', 'DE', 0, 0, NULL),
(83, 'Ghana', 'GH', 0, 1, NULL),
(84, 'Gibraltar', 'GI', 0, 0, NULL),
(85, 'Greece', 'GR', 0, 0, NULL),
(86, 'Greenland', 'GL', 0, 0, NULL),
(87, 'Grenada', 'GD', 0, 0, NULL),
(88, 'Guadeloupe', 'GP', 0, 0, NULL),
(89, 'Guam', 'GU', 0, 0, NULL),
(90, 'Guatemala', 'GT', 0, 0, NULL),
(91, 'Guinea', 'GN', 0, 0, NULL),
(92, 'Guinea-Bissau', 'GW', 0, 0, NULL),
(93, 'Guyana', 'GY', 0, 0, NULL),
(94, 'Haiti', 'HT', 0, 0, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', 0, 0, NULL),
(96, 'Honduras', 'HN', 0, 0, NULL),
(97, 'Hong Kong', 'HK', 0, 0, NULL),
(98, 'Hungary', 'HU', 0, 0, NULL),
(99, 'Iceland', 'IS', 0, 0, NULL),
(100, 'India', 'IN', 0, 0, NULL),
(101, 'Indonesia', 'ID', 0, 0, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', 0, 0, NULL),
(103, 'Iraq', 'IQ', 0, 0, NULL),
(104, 'Ireland', 'IE', 0, 0, NULL),
(105, 'Israel', 'IL', 0, 0, NULL),
(106, 'Italy', 'IT', 0, 0, NULL),
(107, 'Ivory Coast', 'CI', 0, 0, NULL),
(108, 'Jamaica', 'JM', 0, 0, NULL),
(109, 'Japan', 'JP', 0, 0, NULL),
(110, 'Jordan', 'JO', 0, 0, NULL),
(111, 'Kazakhstan', 'KZ', 0, 0, NULL),
(112, 'Kenya', 'KE', 0, 0, NULL),
(113, 'Kiribati', 'KI', 0, 0, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', 0, 0, NULL),
(115, 'Korea, Republic of', 'KR', 0, 0, NULL),
(116, 'Kuwait', 'KW', 0, 0, NULL),
(117, 'Kyrgyzstan', 'KG', 0, 0, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', 0, 0, NULL),
(119, 'Latvia', 'LV', 0, 0, NULL),
(120, 'Lebanon', 'LB', 0, 0, NULL),
(121, 'Lesotho', 'LS', 0, 0, NULL),
(122, 'Liberia', 'LR', 0, 0, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', 0, 0, NULL),
(124, 'Liechtenstein', 'LI', 0, 0, NULL),
(125, 'Lithuania', 'LT', 0, 0, NULL),
(126, 'Luxembourg', 'LU', 0, 0, NULL),
(127, 'Macau', 'MO', 0, 0, NULL),
(128, 'Macedonia', 'MK', 0, 0, NULL),
(129, 'Madagascar', 'MG', 0, 0, NULL),
(130, 'Malawi', 'MW', 0, 0, NULL),
(131, 'Malaysia', 'MY', 0, 0, NULL),
(132, 'Maldives', 'MV', 0, 0, NULL),
(133, 'Mali', 'ML', 0, 0, NULL),
(134, 'Malta', 'MT', 0, 0, NULL),
(135, 'Marshall Islands', 'MH', 0, 0, NULL),
(136, 'Martinique', 'MQ', 0, 0, NULL),
(137, 'Mauritania', 'MR', 0, 0, NULL),
(138, 'Mauritius', 'MU', 0, 0, NULL),
(139, 'Mayotte', 'TY', 0, 0, NULL),
(140, 'Mexico', 'MX', 0, 0, NULL),
(141, 'Micronesia, Federated States of', 'FM', 0, 0, NULL),
(142, 'Moldova, Republic of', 'MD', 0, 0, NULL),
(143, 'Monaco', 'MC', 0, 0, NULL),
(144, 'Mongolia', 'MN', 0, 0, NULL),
(145, 'Montserrat', 'MS', 0, 0, NULL),
(146, 'Morocco', 'MA', 0, 0, NULL),
(147, 'Mozambique', 'MZ', 0, 0, NULL),
(148, 'Myanmar', 'MM', 0, 0, NULL),
(149, 'Namibia', 'NA', 0, 0, NULL),
(150, 'Nauru', 'NR', 0, 0, NULL),
(151, 'Nepal', 'NP', 0, 0, NULL),
(152, 'Netherlands', 'NL', 0, 0, NULL),
(153, 'Netherlands Antilles', 'AN', 0, 0, NULL),
(154, 'New Caledonia', 'NC', 0, 0, NULL),
(155, 'New Zealand', 'NZ', 0, 0, NULL),
(156, 'Nicaragua', 'NI', 0, 0, NULL),
(157, 'Niger', 'NE', 0, 0, NULL),
(158, 'Nigeria', 'NG', 0, 0, NULL),
(159, 'Niue', 'NU', 0, 0, NULL),
(160, 'Norfork Island', 'NF', 0, 0, NULL),
(161, 'Northern Mariana Islands', 'MP', 0, 0, NULL),
(162, 'Norway', 'NO', 0, 0, NULL),
(163, 'Oman', 'OM', 0, 0, NULL),
(164, 'Pakistan', 'PK', 0, 0, NULL),
(165, 'Palau', 'PW', 0, 0, NULL),
(166, 'Panama', 'PA', 0, 0, NULL),
(167, 'Papua New Guinea', 'PG', 0, 0, NULL),
(168, 'Paraguay', 'PY', 0, 0, NULL),
(169, 'Peru', 'PE', 0, 0, NULL),
(170, 'Philippines', 'PH', 0, 0, NULL),
(171, 'Pitcairn', 'PN', 0, 0, NULL),
(172, 'Poland', 'PL', 0, 0, NULL),
(173, 'Portugal', 'PT', 0, 0, NULL),
(174, 'Puerto Rico', 'PR', 0, 0, NULL),
(175, 'Qatar', 'QA', 0, 0, NULL),
(176, 'Republic of South Sudan', 'SS', 0, 0, NULL),
(177, 'Reunion', 'RE', 0, 0, NULL),
(178, 'Romania', 'RO', 0, 0, NULL),
(179, 'Russian Federation', 'RU', 0, 0, NULL),
(180, 'Rwanda', 'RW', 0, 0, NULL),
(181, 'Saint Kitts and Nevis', 'KN', 0, 0, NULL),
(182, 'Saint Lucia', 'LC', 0, 0, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', 0, 0, NULL),
(184, 'Samoa', 'WS', 0, 0, NULL),
(185, 'San Marino', 'SM', 0, 0, NULL),
(186, 'Sao Tome and Principe', 'ST', 0, 0, NULL),
(187, 'Saudi Arabia', 'SA', 0, 0, NULL),
(188, 'Senegal', 'SN', 0, 1, NULL),
(189, 'Serbia', 'RS', 0, 0, NULL),
(190, 'Seychelles', 'SC', 0, 0, NULL),
(191, 'Sierra Leone', 'SL', 0, 0, NULL),
(192, 'Singapore', 'SG', 0, 0, NULL),
(193, 'Slovakia', 'SK', 0, 0, NULL),
(194, 'Slovenia', 'SI', 0, 0, NULL),
(195, 'Solomon Islands', 'SB', 0, 0, NULL),
(196, 'Somalia', 'SO', 0, 0, NULL),
(197, 'South Africa', 'ZA', 0, 0, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', 0, 0, NULL),
(199, 'Spain', 'ES', 0, 0, NULL),
(200, 'Sri Lanka', 'LK', 0, 0, NULL),
(201, 'St. Helena', 'SH', 0, 0, NULL),
(202, 'St. Pierre and Miquelon', 'PM', 0, 0, NULL),
(203, 'Sudan', 'SD', 0, 0, NULL),
(204, 'Suriname', 'SR', 0, 0, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', 0, 0, NULL),
(206, 'Swaziland', 'SZ', 0, 0, NULL),
(207, 'Sweden', 'SE', 0, 0, NULL),
(208, 'Switzerland', 'CH', 0, 0, NULL),
(209, 'Syrian Arab Republic', 'SY', 0, 0, NULL),
(210, 'Taiwan', 'TW', 0, 0, NULL),
(211, 'Tajikistan', 'TJ', 0, 0, NULL),
(212, 'Tanzania, United Republic of', 'TZ', 0, 0, NULL),
(213, 'Thailand', 'TH', 0, 0, NULL),
(214, 'Togo', 'TG', 1, 1, NULL),
(215, 'Tokelau', 'TK', 0, 0, NULL),
(216, 'Tonga', 'TO', 0, 0, NULL),
(217, 'Trinidad and Tobago', 'TT', 0, 0, NULL),
(218, 'Tunisia', 'TN', 0, 0, NULL),
(219, 'Turkey', 'TR', 0, 0, NULL),
(220, 'Turkmenistan', 'TM', 0, 0, NULL),
(221, 'Turks and Caicos Islands', 'TC', 0, 0, NULL),
(222, 'Tuvalu', 'TV', 0, 0, NULL),
(223, 'Uganda', 'UG', 0, 0, NULL),
(224, 'Ukraine', 'UA', 0, 0, NULL),
(225, 'United Arab Emirates', 'AE', 0, 0, NULL),
(226, 'United Kingdom', 'GB', 0, 0, NULL),
(227, 'United States minor outlying islands', 'UM', 0, 0, NULL),
(228, 'Uruguay', 'UY', 0, 0, NULL),
(229, 'Uzbekistan', 'UZ', 0, 0, NULL),
(230, 'Vanuatu', 'VU', 0, 0, NULL),
(231, 'Vatican City State', 'VA', 0, 0, NULL),
(232, 'Venezuela', 'VE', 0, 0, NULL),
(233, 'Vietnam', 'VN', 0, 0, NULL),
(234, 'Virgin Islands (British)', 'VG', 0, 0, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', 0, 0, NULL),
(236, 'Wallis and Futuna Islands', 'WF', 0, 0, NULL),
(237, 'Western Sahara', 'EH', 0, 0, NULL),
(238, 'Yemen', 'YE', 0, 0, NULL),
(239, 'Yugoslavia', 'YU', 0, 0, NULL),
(240, 'Zaire', 'ZR', 0, 0, NULL),
(241, 'Zambia', 'ZM', 0, 0, NULL),
(242, 'Zimbabwe', 'ZW', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_09_132759_create_media_table', 1),
(6, '2021_10_09_132906_create_permission_tables', 1),
(7, '2021_10_09_140052_create_clients_table', 1),
(8, '2021_10_09_140238_create_transporters_table', 1),
(9, '2021_10_16_131715_create_jobs_table', 1),
(10, '2021_12_01_073221_create_admins_table', 1),
(11, '2021_12_21_214538_create_orders_table', 1),
(12, '2021_12_21_220112_create_countries_table', 1),
(13, '2021_12_21_225250_create_packages_table', 1),
(14, '2021_12_28_005702_create_prices_table', 1),
(15, '2022_03_14_111024_create_order_items_table', 1),
(16, '2022_03_17_152159_create_settings_table', 1),
(17, '2022_03_19_114017_create_order_infos_table', 1),
(18, '2022_03_19_115140_create_order_events_table', 1),
(19, '2022_03_19_123922_create_user_settings_metadata_table', 1),
(20, '2022_03_19_123922_create_user_settings_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `price` int(11) NOT NULL DEFAULT 0,
  `insurance` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `reference`, `pickup_country`, `pickup_city`, `pickup_address`, `delivery_country`, `delivery_city`, `delivery_address`, `delivery_phone`, `notes`, `status`, `price`, `insurance`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'HEGODIIN', '74', 'Marseille', 'Rue postillon rouge , avenue 18 maison 09', '214', 'Lomé', 'Jean Paul 2 blvd 13 janvier', '+228 99 99 12 45', 'le destinataire se nomme TOSSY Dominique', 'Pending', 280, 0, 280, '2022-03-22 11:22:58', '2022-03-22 11:22:58', NULL),
(2, 2, 'CCZL0LU8', '74', 'Toulouse', 'sdfssgg', '214', 'lomé', 'Agoe', '+228 70707070', 'destinataire : GOGBALO Jacques', 'pending', 80, 5, 85, '2022-03-22 11:34:31', '2022-03-22 11:34:31', NULL),
(3, 2, 'QUNSCMOE', '74', 'marseille', 'rue 9 roublard', '214', 'Lomé', 'blvd jean paul 2', '+228 90123520', 'destinaire : mr Komlan jacques', 'pending', 320, 10, 330, '2022-03-24 12:58:08', '2022-03-24 12:58:08', NULL),
(4, 2, 'XPQA8QDE', '74', 'Nice', 'blv macron 16', '214', 'Lomé', 'blvd jean paul 2', '+228 90 2010 30', 'neant', 'pending', 280, 5, 285, '2022-03-24 20:25:14', '2022-03-24 20:25:14', NULL),
(5, 2, 'DRDR9BSD', '74', 'illzach', '5 Rue Des Jonquilles 68110 illzach', '214', 'illzach', '5 Rue Des Jonquilles 68110 illzach', '0699928598', 'xsc', 'pending', 120, 0, 120, '2022-06-10 13:09:29', '2022-06-10 13:09:29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_events`
--

CREATE TABLE `order_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `event_initiator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_initiator_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_events`
--

INSERT INTO `order_events` (`id`, `order_id`, `event`, `event_type`, `event_code`, `event_message`, `event_status`, `event_date`, `event_initiator`, `event_initiator_id`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Order HEGODIIN was created!', 'info', 'ORDER_CREATED', NULL, NULL, '2022-03-22 11:22:59', 'Client', '2', NULL, '2022-03-22 11:22:59', '2022-03-22 11:22:59', NULL),
(2, 2, 'Order CCZL0LU8 was created!', 'info', 'ORDER_CREATED', NULL, NULL, '2022-03-22 11:34:32', 'Client', '2', NULL, '2022-03-22 11:34:32', '2022-03-22 11:34:32', NULL),
(3, 3, 'Order QUNSCMOE was created!', 'info', 'ORDER_CREATED', NULL, NULL, '2022-03-24 12:58:12', 'Client', '2', NULL, '2022-03-24 12:58:12', '2022-03-24 12:58:12', NULL),
(4, 4, 'Order XPQA8QDE was created!', 'info', 'ORDER_CREATED', NULL, NULL, '2022-03-24 20:25:19', 'Client', '2', NULL, '2022-03-24 20:25:19', '2022-03-24 20:25:19', NULL),
(5, 5, 'Order DRDR9BSD was created!', 'info', 'ORDER_CREATED', NULL, NULL, '2022-06-10 13:09:31', 'Client', '2', NULL, '2022-06-10 13:09:31', '2022-06-10 13:09:31', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_infos`
--

CREATE TABLE `order_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `transporter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `appointment_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reception_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_infos`
--

INSERT INTO `order_infos` (`id`, `order_id`, `transporter_id`, `appointment_date`, `appointment_code`, `receiver_name`, `receiver_address`, `receiver_phone`, `receiver_email`, `receiver_comments`, `reception_code`, `order_rate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 11:22:59', '2022-03-22 11:22:59', NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-22 11:34:32', '2022-03-22 11:34:32', NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-24 12:58:13', '2022-03-24 12:58:13', NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-24 20:25:19', '2022-03-24 20:25:19', NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-10 13:09:31', '2022-06-10 13:09:31', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `has_insurance` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `package_id`, `price`, `quantity`, `has_insurance`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 120, 1, 0, 'parfum ', '2022-03-22 11:22:58', '2022-03-22 11:22:58', NULL),
(2, 1, 2, 80, 2, 0, 'Savon cosmétiques', '2022-03-22 11:22:58', '2022-03-22 11:22:58', NULL),
(3, 2, 2, 80, 1, 1, 'smart phone', '2022-03-22 11:34:31', '2022-03-22 11:34:31', NULL),
(4, 3, 1, 120, 2, 1, 'photocopieur', '2022-03-24 12:58:08', '2022-03-24 12:58:08', NULL),
(5, 3, 2, 80, 1, 1, 'cartouche', '2022-03-24 12:58:08', '2022-03-24 12:58:08', NULL),
(6, 4, 1, 120, 1, 1, 'ordinateur', '2022-03-24 20:25:15', '2022-03-24 20:25:15', NULL),
(7, 4, 2, 80, 2, 0, 'chargeur', '2022-03-24 20:25:15', '2022-03-24 20:25:15', NULL),
(8, 5, 1, 120, 1, 0, 'ordi', '2022-06-10 13:09:29', '2022-06-10 13:09:29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Standard', 'hauteur: 65cm longueur:70cm largeur: 60cm ', NULL, 1, '2022-03-22 11:12:55', '2022-03-22 11:12:55', NULL),
(2, 'Moyen-Standard', 'hauteur: 65 cm Longueur: 60 cm largeur: 30cm', NULL, 1, '2022-03-22 11:14:07', '2022-03-22 11:14:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_country_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_country_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`id`, `package_id`, `pickup_country_id`, `delivery_country_id`, `price`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 74, 214, 120, 'devise : Euro', '2022-03-22 11:15:49', '2022-03-22 11:15:49', NULL),
(2, 2, 74, 214, 80, 'Devise : Euro', '2022-03-22 11:16:32', '2022-03-22 11:16:32', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transporters`
--

CREATE TABLE `transporters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('client','transporter') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `type`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Client', 'Client', 'user@mail.me', 'client', '2022-03-21 14:39:41', '$2y$10$avSANHSKkyyD4Uguq2W.D.9oxWaIKf7PtRIWf.aa6ScIe7C4JnDLS', 1, NULL, '2022-03-21 14:39:41', '2022-03-21 14:39:41', NULL),
(2, 'sika', 'PANOU', 'sikapanou@gmail.com', 'client', '2022-03-21 14:45:12', '$2y$10$YaEsXOAdoSEIlfTFY.Hei.Oisyp5viJgc/DYirPoZ5FW7yGplIMp2', 1, 'XT5Ewfasnu9dq8e7bhmUIJ4R4tm3tiP5mj1qxJCwQCoCcTybhQm3kdxoGSEQ', '2022-03-21 14:43:58', '2022-03-21 14:45:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `metadata_id` bigint(20) UNSIGNED NOT NULL,
  `settable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settable_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_settings_metadata`
--

CREATE TABLE `user_settings_metadata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `bag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'users',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_reference_unique` (`reference`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Index pour la table `order_events`
--
ALTER TABLE `order_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_events_order_id_foreign` (`order_id`);

--
-- Index pour la table `order_infos`
--
ALTER TABLE `order_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_infos_order_id_foreign` (`order_id`),
  ADD KEY `order_infos_transporter_id_foreign` (`transporter_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_package_id_foreign` (`package_id`);

--
-- Index pour la table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prices_package_id_foreign` (`package_id`),
  ADD KEY `prices_pickup_country_id_foreign` (`pickup_country_id`),
  ADD KEY `prices_delivery_country_id_foreign` (`delivery_country_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_group_index` (`group`);

--
-- Index pour la table `transporters`
--
ALTER TABLE `transporters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transporters_user_id_foreign` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_settings_settable_type_settable_id_index` (`settable_type`,`settable_id`);

--
-- Index pour la table `user_settings_metadata`
--
ALTER TABLE `user_settings_metadata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_settings_metadata_name_unique` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `order_events`
--
ALTER TABLE `order_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `order_infos`
--
ALTER TABLE `order_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transporters`
--
ALTER TABLE `transporters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_settings_metadata`
--
ALTER TABLE `user_settings_metadata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_events`
--
ALTER TABLE `order_events`
  ADD CONSTRAINT `order_events_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_infos`
--
ALTER TABLE `order_infos`
  ADD CONSTRAINT `order_infos_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_infos_transporter_id_foreign` FOREIGN KEY (`transporter_id`) REFERENCES `transporters` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_delivery_country_id_foreign` FOREIGN KEY (`delivery_country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `prices_pickup_country_id_foreign` FOREIGN KEY (`pickup_country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transporters`
--
ALTER TABLE `transporters`
  ADD CONSTRAINT `transporters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
