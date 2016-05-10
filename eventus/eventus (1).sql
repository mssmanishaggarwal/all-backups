-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2016 at 08:03 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eventus`
--

-- --------------------------------------------------------

--
-- Table structure for table `ev_accommodation`
--

CREATE TABLE IF NOT EXISTS `ev_accommodation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `ev_accommodation`
--

INSERT INTO `ev_accommodation` (`id`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(2, 0, 3, '2016-02-22 20:21:19', '2016-03-18 15:47:21'),
(10, 1, 4, '2016-02-29 16:45:45', '2016-04-04 20:38:13'),
(11, 1, 6, '2016-02-29 16:46:02', '2016-03-15 19:54:50'),
(12, 2, 8, '2016-02-29 16:46:24', '2016-03-03 22:34:45'),
(13, 1, 5, '2016-02-29 16:46:49', '2016-03-15 18:29:23'),
(14, 2, 7, '2016-02-29 16:47:09', '2016-03-03 22:35:24'),
(15, 2, 9, '2016-02-29 16:47:27', '2016-03-10 17:09:03'),
(19, 2, 10, '2016-03-03 21:55:19', '2016-03-10 22:50:44'),
(20, 2, 11, '2016-03-07 13:42:23', '2016-03-11 14:45:00'),
(21, 2, 13, '2016-03-07 13:45:25', '2016-03-10 21:07:31'),
(22, 2, 12, '2016-03-07 13:46:35', '2016-03-10 19:57:17'),
(23, 0, 14, '2016-03-07 13:55:21', '2016-04-04 20:38:43'),
(24, 2, 15, '2016-03-07 14:54:23', '2016-03-10 22:15:27'),
(25, 2, 16, '2016-03-07 15:02:01', '2016-03-10 13:58:59'),
(27, 2, 18, '2016-03-07 15:17:31', '2016-03-10 15:35:09'),
(28, 2, 18, '2016-03-07 15:24:10', '2016-03-09 20:54:49'),
(29, 2, 19, '2016-03-07 15:36:22', '2016-03-10 22:49:46'),
(32, 2, 19, '2016-03-10 14:38:37', '2016-03-10 15:01:00'),
(34, 2, 19, '2016-03-10 18:11:00', '2016-03-10 18:11:00'),
(35, 2, 20, '2016-03-10 19:34:26', '2016-03-11 14:07:44'),
(36, 2, 23, '2016-03-10 20:11:10', '2016-03-10 20:11:10'),
(37, 2, 21, '2016-03-10 20:14:15', '2016-03-10 20:15:07'),
(38, 2, 22, '2016-03-10 20:51:21', '2016-03-10 22:33:10'),
(39, 0, 24, '2016-03-11 14:12:48', '2016-04-04 20:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `ev_accommodation_translation`
--

CREATE TABLE IF NOT EXISTS `ev_accommodation_translation` (
  `accommodation_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accommodation_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `accommodation_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`accommodation_translation_id`),
  KEY `accommodation_translation_accommodation_id_foreign` (`accommodation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Dumping data for table `ev_accommodation_translation`
--

INSERT INTO `ev_accommodation_translation` (`accommodation_translation_id`, `accommodation_id`, `language_id`, `accommodation_name`) VALUES
(3, 2, 1, 'Ball Room'),
(19, 10, 1, 'Store Room'),
(20, 10, 2, 'Store Room Pt'),
(21, 11, 1, 'Canteen'),
(22, 11, 2, 'Canteen Pro'),
(23, 12, 1, 'Park'),
(24, 12, 2, 'Park Pr'),
(25, 13, 1, 'Dining Hall'),
(26, 13, 2, 'Dining Hall Pr'),
(27, 14, 1, 'Pool'),
(28, 14, 2, 'Pool Pr'),
(30, 15, 2, 'Event Hall Pr'),
(37, 19, 1, 'Chopa'),
(38, 19, 2, 'Chopa'),
(39, 20, 1, 'Air Condition System'),
(40, 20, 2, 'Air Condition System'),
(41, 21, 1, 'Attach Bath'),
(42, 21, 2, 'Attach Bath'),
(43, 22, 1, 'Sea Front'),
(44, 22, 2, 'Sea Front'),
(45, 23, 1, 'Bed'),
(46, 23, 2, 'Bed Pt'),
(47, 24, 1, 'Hot Woter'),
(48, 24, 2, 'Hot Woter'),
(49, 25, 1, 'Cold Water'),
(50, 25, 2, 'Cold Water'),
(53, 27, 1, 'Box'),
(54, 27, 2, 'Box'),
(55, 28, 1, 'Phone'),
(56, 28, 2, 'Phone'),
(57, 29, 1, 'Food'),
(58, 29, 2, 'Food'),
(63, 32, 1, 'New Room'),
(64, 32, 2, 'New Room'),
(67, 34, 1, 'Free Wifi'),
(68, 34, 2, 'Free Wifi'),
(69, 35, 1, 'Money Back Offer'),
(70, 35, 2, 'Money Back Offer'),
(71, 36, 1, 'Free Internet'),
(72, 36, 2, 'Free Internet'),
(73, 37, 1, 'Breakfirst'),
(74, 37, 2, 'Breakfirst'),
(75, 38, 1, 'HD Cable TV'),
(76, 38, 2, 'HD Cable TV'),
(77, 39, 1, 'water'),
(78, 39, 2, 'water');

-- --------------------------------------------------------

--
-- Table structure for table `ev_addon`
--

CREATE TABLE IF NOT EXISTS `ev_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ev_addon`
--

INSERT INTO `ev_addon` (`id`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2016-02-22 12:07:57', '2016-04-04 21:01:11'),
(2, 1, 2, '2016-02-22 20:08:41', '2016-03-15 21:26:59'),
(3, 1, 3, '2016-02-25 14:54:53', '2016-03-15 21:28:01'),
(4, 1, 4, '2016-02-25 14:55:19', '2016-03-15 21:28:04'),
(5, 1, 5, '2016-02-25 14:56:19', '2016-03-15 21:28:15'),
(6, 2, 6, '2016-02-25 19:02:54', '2016-02-25 19:02:54'),
(7, 2, 8, '2016-03-01 20:54:41', '2016-03-01 20:54:41'),
(8, 0, 7, '2016-04-04 21:01:30', '2016-04-04 21:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `ev_addon_translation`
--

CREATE TABLE IF NOT EXISTS `ev_addon_translation` (
  `addon_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addon_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `addon_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`addon_translation_id`),
  KEY `addon_translation_addon_id_foreign` (`addon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ev_addon_translation`
--

INSERT INTO `ev_addon_translation` (`addon_translation_id`, `addon_id`, `language_id`, `addon_name`) VALUES
(1, 1, 1, 'Flowring'),
(2, 1, 2, 'Flowring Pr'),
(3, 2, 1, 'Lighting'),
(4, 2, 2, 'Lighting Pr'),
(5, 3, 1, 'Music'),
(6, 3, 2, 'Music Pr'),
(7, 4, 1, 'Gardening'),
(8, 4, 2, 'Gardening  Pr'),
(9, 5, 1, 'Carpeting   '),
(10, 5, 2, 'Carpeting Pr'),
(11, 6, 1, 'Sweeper '),
(12, 6, 2, 'Sweeper  Pr'),
(13, 7, 1, 'test3'),
(14, 7, 2, 'test3'),
(15, 8, 1, 'test addons'),
(16, 8, 2, 'test addons Pt');

-- --------------------------------------------------------

--
-- Table structure for table `ev_admins`
--

CREATE TABLE IF NOT EXISTS `ev_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ev_admins`
--

INSERT INTO `ev_admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@mail.com', '$2y$10$QNODfriK6AJR.RBMzhwZ3u.VbWmFNd1MBIrDkZqK0wfZ3PsVNj8MO', NULL, '2016-02-24 14:53:53', '2016-02-24 14:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `ev_advertisement`
--

CREATE TABLE IF NOT EXISTS `ev_advertisement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `advertisement_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advertisement_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ev_advertisement`
--

INSERT INTO `ev_advertisement` (`id`, `advertisement_link`, `advertisement_image`, `position_id`, `is_active`, `order_id`, `start_date`, `end_date`, `updated_at`, `created_at`) VALUES
(14, 'http://abc.com', 'banner2.jpg', 1, 1, 1, '2016-04-12', '2016-06-12', '2016-04-12 14:35:45', '2016-04-12 11:35:40'),
(15, 'http://abcd.com', 'zoom-43217482-3.jpg', 2, 1, 2, '2016-04-12', '2016-05-12', '2016-04-12 14:35:43', '2016-04-12 11:37:16'),
(16, 'www.adv2.com', 'speaker.jpg', 1, 1, 3, '2016-04-12', '2016-05-12', '2016-04-12 14:35:41', '2016-04-12 11:38:11'),
(17, 'http://ashggh.in', '11539025_1600756026844266_4203745129685140207_o.jpg', 1, 1, 4, '2016-04-22', '2016-04-26', '2016-04-22 05:49:44', '2016-04-22 05:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `ev_advertisement_impression`
--

CREATE TABLE IF NOT EXISTS `ev_advertisement_impression` (
  `impression_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_id` int(11) NOT NULL,
  `date_of_action` date NOT NULL,
  `time_of_action` timestamp NOT NULL,
  PRIMARY KEY (`impression_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Dumping data for table `ev_advertisement_impression`
--

INSERT INTO `ev_advertisement_impression` (`impression_id`, `advertisement_id`, `date_of_action`, `time_of_action`) VALUES
(1, 15, '2016-04-12', '2016-04-12 19:53:02'),
(2, 16, '2016-04-12', '2016-04-12 19:58:11'),
(3, 14, '2016-04-12', '2016-04-12 19:59:00'),
(4, 15, '2016-04-12', '2016-04-12 20:00:33'),
(5, 16, '2016-04-12', '2016-04-12 20:01:09'),
(6, 14, '2016-04-12', '2016-04-12 20:02:06'),
(7, 16, '2016-04-12', '2016-04-12 20:03:18'),
(8, 15, '2016-04-12', '2016-04-12 20:03:31'),
(9, 14, '2016-04-12', '2016-04-12 20:04:10'),
(10, 15, '2016-04-12', '2016-04-12 20:04:19'),
(11, 16, '2016-04-12', '2016-04-12 20:04:57'),
(12, 14, '2016-04-12', '2016-04-12 20:10:05'),
(13, 16, '2016-04-12', '2016-04-12 20:10:05'),
(14, 15, '2016-04-12', '2016-04-12 20:10:14'),
(15, 14, '2016-04-12', '2016-04-12 20:10:34'),
(16, 15, '2016-04-12', '2016-04-12 20:10:40'),
(17, 16, '2016-04-12', '2016-04-12 20:11:32'),
(18, 14, '2016-04-12', '2016-04-12 20:12:48'),
(19, 16, '2016-04-12', '2016-04-12 20:13:13'),
(20, 15, '2016-04-12', '2016-04-12 20:13:15'),
(21, 14, '2016-04-12', '2016-04-12 20:14:07'),
(22, 15, '2016-04-12', '2016-04-12 20:15:21'),
(23, 16, '2016-04-12', '2016-04-12 20:15:35'),
(24, 14, '2016-04-12', '2016-04-12 20:16:04'),
(25, 16, '2016-04-12', '2016-04-12 20:16:14'),
(26, 15, '2016-04-12', '2016-04-12 20:16:20'),
(27, 14, '2016-04-12', '2016-04-12 20:16:35'),
(28, 15, '2016-04-12', '2016-04-12 20:17:16'),
(29, 16, '2016-04-12', '2016-04-12 20:20:22'),
(30, 14, '2016-04-12', '2016-04-12 20:21:00'),
(31, 15, '2016-04-12', '2016-04-12 20:23:15'),
(32, 16, '2016-04-12', '2016-04-12 20:23:15'),
(33, 14, '2016-04-12', '2016-04-12 20:23:16'),
(34, 15, '2016-04-12', '2016-04-12 20:23:27'),
(35, 16, '2016-04-12', '2016-04-12 20:24:13'),
(36, 14, '2016-04-12', '2016-04-12 20:24:13'),
(37, 16, '2016-04-12', '2016-04-12 20:24:13'),
(38, 15, '2016-04-12', '2016-04-12 20:24:14'),
(39, 14, '2016-04-12', '2016-04-12 20:24:14'),
(40, 16, '2016-04-12', '2016-04-12 20:24:14'),
(41, 15, '2016-04-12', '2016-04-12 20:24:15'),
(42, 14, '2016-04-12', '2016-04-12 20:24:15'),
(43, 15, '2016-04-12', '2016-04-12 20:24:16'),
(44, 16, '2016-04-12', '2016-04-12 20:24:16'),
(45, 14, '2016-04-12', '2016-04-12 20:24:46'),
(46, 15, '2016-04-12', '2016-04-12 20:24:46'),
(47, 16, '2016-04-12', '2016-04-12 20:24:46'),
(48, 14, '2016-04-12', '2016-04-12 20:24:46'),
(49, 15, '2016-04-12', '2016-04-12 20:24:47'),
(50, 16, '2016-04-12', '2016-04-12 20:24:57'),
(51, 14, '2016-04-12', '2016-04-12 20:25:09'),
(52, 15, '2016-04-12', '2016-04-12 20:25:19'),
(53, 16, '2016-04-12', '2016-04-12 20:25:37'),
(54, 14, '2016-04-12', '2016-04-12 20:26:06'),
(55, 16, '2016-04-12', '2016-04-12 20:26:21'),
(56, 15, '2016-04-12', '2016-04-12 20:26:32'),
(57, 14, '2016-04-12', '2016-04-12 20:26:32'),
(58, 15, '2016-04-12', '2016-04-12 20:26:32'),
(59, 16, '2016-04-12', '2016-04-12 20:26:32'),
(60, 14, '2016-04-12', '2016-04-12 20:27:09'),
(61, 16, '2016-04-12', '2016-04-12 20:27:21'),
(62, 15, '2016-04-12', '2016-04-12 20:27:37'),
(63, 14, '2016-04-12', '2016-04-12 20:27:37'),
(64, 15, '2016-04-12', '2016-04-12 20:27:37'),
(65, 16, '2016-04-12', '2016-04-12 20:27:37'),
(66, 14, '2016-04-12', '2016-04-12 20:27:37'),
(67, 15, '2016-04-12', '2016-04-12 20:27:57'),
(68, 16, '2016-04-12', '2016-04-12 20:28:06'),
(69, 14, '2016-04-12', '2016-04-12 20:28:18'),
(70, 15, '2016-04-12', '2016-04-12 20:28:18'),
(71, 14, '2016-04-12', '2016-04-12 20:28:18'),
(72, 16, '2016-04-12', '2016-04-12 20:28:18'),
(73, 14, '2016-04-12', '2016-04-12 20:28:18'),
(74, 15, '2016-04-12', '2016-04-12 20:28:18'),
(75, 16, '2016-04-12', '2016-04-12 20:28:18'),
(76, 15, '2016-04-12', '2016-04-12 20:28:24'),
(77, 14, '2016-04-12', '2016-04-12 20:28:24'),
(78, 16, '2016-04-12', '2016-04-12 20:28:32'),
(79, 14, '2016-04-12', '2016-04-12 20:28:37'),
(80, 15, '2016-04-12', '2016-04-12 20:35:15'),
(81, 16, '2016-04-12', '2016-04-12 20:35:20'),
(82, 15, '2016-04-12', '2016-04-12 20:38:43'),
(83, 14, '2016-04-12', '2016-04-12 20:38:49'),
(84, 16, '2016-04-12', '2016-04-12 20:41:15'),
(85, 14, '2016-04-12', '2016-04-12 20:41:22'),
(86, 15, '2016-04-12', '2016-04-12 20:41:52'),
(87, 16, '2016-04-12', '2016-04-12 20:41:57'),
(88, 15, '2016-04-12', '2016-04-12 20:50:52'),
(89, 14, '2016-04-12', '2016-04-12 20:52:52'),
(90, 16, '2016-04-12', '2016-04-12 20:53:58'),
(91, 14, '2016-04-12', '2016-04-12 20:54:06'),
(92, 15, '2016-04-12', '2016-04-12 20:56:31'),
(93, 16, '2016-04-12', '2016-04-12 20:56:35'),
(94, 15, '2016-04-12', '2016-04-12 20:56:50'),
(95, 14, '2016-04-12', '2016-04-12 20:57:26'),
(96, 16, '2016-04-12', '2016-04-12 20:57:33'),
(97, 14, '2016-04-12', '2016-04-12 20:58:14'),
(98, 15, '2016-04-12', '2016-04-12 21:00:34'),
(99, 16, '2016-04-12', '2016-04-12 21:15:11'),
(100, 15, '2016-04-12', '2016-04-12 21:15:11'),
(101, 16, '2016-04-12', '2016-04-12 21:15:12'),
(102, 14, '2016-04-12', '2016-04-12 21:15:12'),
(103, 15, '2016-04-12', '2016-04-12 21:15:13'),
(104, 16, '2016-04-12', '2016-04-12 21:15:13'),
(105, 14, '2016-04-12', '2016-04-12 21:15:13'),
(106, 15, '2016-04-12', '2016-04-12 21:15:13'),
(107, 16, '2016-04-12', '2016-04-12 21:15:14'),
(108, 14, '2016-04-12', '2016-04-12 21:15:15'),
(109, 15, '2016-04-12', '2016-04-12 21:15:15'),
(110, 16, '2016-04-12', '2016-04-12 21:15:15'),
(111, 14, '2016-04-12', '2016-04-12 21:15:16'),
(112, 15, '2016-04-12', '2016-04-12 21:15:16'),
(113, 16, '2016-04-12', '2016-04-12 21:15:17'),
(114, 14, '2016-04-12', '2016-04-12 21:15:17'),
(115, 15, '2016-04-12', '2016-04-12 21:15:17'),
(116, 16, '2016-04-12', '2016-04-12 21:15:29'),
(117, 14, '2016-04-12', '2016-04-12 21:16:44'),
(118, 15, '2016-04-12', '2016-04-12 21:17:17'),
(119, 16, '2016-04-12', '2016-04-12 21:17:52'),
(120, 14, '2016-04-12', '2016-04-12 21:18:49'),
(121, 15, '2016-04-12', '2016-04-12 21:18:49'),
(122, 16, '2016-04-12', '2016-04-12 21:19:17'),
(123, 14, '2016-04-12', '2016-04-12 21:19:44'),
(124, 15, '2016-04-12', '2016-04-12 21:19:44'),
(125, 16, '2016-04-12', '2016-04-12 21:30:18'),
(126, 14, '2016-04-12', '2016-04-12 21:36:18'),
(127, 15, '2016-04-12', '2016-04-12 21:58:37'),
(128, 16, '2016-04-12', '2016-04-12 21:58:49'),
(129, 14, '2016-04-12', '2016-04-12 21:59:01'),
(130, 15, '2016-04-12', '2016-04-12 22:00:40'),
(131, 16, '2016-04-12', '2016-04-12 22:00:47'),
(132, 14, '2016-04-12', '2016-04-12 22:00:50'),
(133, 15, '2016-04-12', '2016-04-12 22:00:54'),
(134, 16, '2016-04-12', '2016-04-12 22:01:00'),
(135, 14, '2016-04-12', '2016-04-12 22:01:05'),
(136, 15, '2016-04-12', '2016-04-12 22:01:10'),
(137, 16, '2016-04-12', '2016-04-12 22:01:14'),
(138, 14, '2016-04-12', '2016-04-12 22:01:32'),
(139, 15, '2016-04-12', '2016-04-12 22:01:39'),
(140, 16, '2016-04-12', '2016-04-12 22:01:43'),
(141, 14, '2016-04-12', '2016-04-12 22:01:47'),
(142, 16, '2016-04-13', '2016-04-13 12:38:35'),
(143, 14, '2016-04-13', '2016-04-13 12:38:48'),
(144, 15, '2016-04-13', '2016-04-13 12:38:56'),
(145, 14, '2016-04-13', '2016-04-13 12:39:03'),
(146, 15, '2016-04-13', '2016-04-13 12:39:09'),
(147, 16, '2016-04-13', '2016-04-13 12:39:10'),
(148, 14, '2016-04-13', '2016-04-13 12:39:49'),
(149, 15, '2016-04-13', '2016-04-13 12:39:59'),
(150, 16, '2016-04-13', '2016-04-13 14:32:08'),
(151, 14, '2016-04-13', '2016-04-13 16:03:27'),
(152, 16, '2016-04-13', '2016-04-13 16:03:40'),
(153, 15, '2016-04-13', '2016-04-13 16:18:39'),
(154, 14, '2016-04-13', '2016-04-13 16:18:50'),
(155, 16, '2016-04-13', '2016-04-13 16:30:57'),
(156, 15, '2016-04-13', '2016-04-13 16:31:37'),
(157, 16, '2016-04-13', '2016-04-13 16:31:41'),
(158, 14, '2016-04-13', '2016-04-13 16:31:41'),
(159, 17, '2016-05-10', '2016-05-10 12:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `ev_advertisement_impression_click`
--

CREATE TABLE IF NOT EXISTS `ev_advertisement_impression_click` (
  `click_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`click_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ev_advertisement_impression_click`
--

INSERT INTO `ev_advertisement_impression_click` (`click_id`, `advertisement_id`, `user_ip`, `date`) VALUES
(1, 15, '10.10.0.88', '2016-04-12'),
(2, 14, '10.10.0.88', '2016-04-12'),
(3, 16, '10.10.0.88', '2016-04-12'),
(4, 16, '10.10.0.88', '2016-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `ev_advertisement_translation`
--

CREATE TABLE IF NOT EXISTS `ev_advertisement_translation` (
  `advertisement_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `advertisement_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `advertisement_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`advertisement_translation_id`),
  KEY `advertisement_translation_advertisement_id_foreign` (`advertisement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ev_advertisement_translation`
--

INSERT INTO `ev_advertisement_translation` (`advertisement_translation_id`, `advertisement_id`, `language_id`, `advertisement_title`) VALUES
(1, 14, 1, 'Advertisement 1'),
(2, 14, 2, 'Advertisement 1'),
(3, 15, 1, 'Advertisement 2'),
(4, 15, 2, 'Advertisement 2'),
(5, 16, 1, 'Advertisement 3'),
(6, 16, 2, 'Advertisement 3'),
(7, 17, 1, 'test name'),
(8, 17, 2, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `ev_banner`
--

CREATE TABLE IF NOT EXISTS `ev_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `is_default` enum('1','0') NOT NULL DEFAULT '0',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ev_banner`
--

INSERT INTO `ev_banner` (`id`, `banner_image`, `order_id`, `publish_date`, `expiry_date`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'home_banner_3.jpg', 2, '2016-03-08', '2017-03-08', '0', '1', '2016-03-08 07:29:36', '2016-04-06 14:54:04'),
(4, 'home_banner_4.jpg', 3, '2016-03-08', '2017-03-08', '0', '1', '2016-03-08 07:29:36', '2016-04-07 17:15:55'),
(5, 'home_banner_1.jpg', 1, '2016-03-08', '2017-03-08', '0', '1', '2016-03-16 21:29:43', '2016-04-06 14:56:46'),
(6, 'party-top-fullsize12.jpg', 4, '2016-04-04', '2016-09-30', '0', '0', '2016-04-04 21:33:28', '2016-04-05 14:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `ev_banner_translation`
--

CREATE TABLE IF NOT EXISTS `ev_banner_translation` (
  `banner_translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  PRIMARY KEY (`banner_translation_id`),
  KEY `FK_P3_P4_Cascade` (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ev_banner_translation`
--

INSERT INTO `ev_banner_translation` (`banner_translation_id`, `banner_id`, `language_id`, `banner_title`) VALUES
(5, 3, 1, 'Banner 3'),
(6, 3, 2, 'Bandeira 3'),
(7, 4, 1, 'Banner 4'),
(8, 4, 2, 'Bandeira 4'),
(9, 5, 1, 'Banner 1'),
(10, 5, 2, 'Bandeira 1'),
(11, 6, 1, 'Test Banner'),
(12, 6, 2, 'Test Banner Pt');

-- --------------------------------------------------------

--
-- Table structure for table `ev_booking`
--

CREATE TABLE IF NOT EXISTS `ev_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_contact` varchar(100) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(100) NOT NULL,
  `hall_location_name` varchar(100) NOT NULL,
  `hall_province_name` varchar(100) NOT NULL,
  `booking_first_name` varchar(100) NOT NULL,
  `booking_last_name` varchar(100) NOT NULL,
  `booking_email` varchar(100) NOT NULL,
  `booking_contact_number` varchar(20) NOT NULL,
  `booking_address` varchar(255) NOT NULL,
  `booking_city` varchar(100) NOT NULL,
  `booking_postcode` varchar(20) NOT NULL,
  `special_comment` text NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `rental_amount` int(10) NOT NULL,
  `booking_amount` float(10,2) DEFAULT NULL,
  `booking_datetime` datetime NOT NULL,
  `booking_status` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0- Not confirmed, 1- confirmed, 2- Booked, 3- Payment pending, 4- Canceled',
  `order_id` int(13) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ev_book_addon`
--

CREATE TABLE IF NOT EXISTS `ev_book_addon` (
  `book_addon_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) NOT NULL,
  `addon_id` int(11) NOT NULL,
  `addon_name` varchar(100) NOT NULL,
  `addon_price` int(11) NOT NULL,
  PRIMARY KEY (`book_addon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ev_cms`
--

CREATE TABLE IF NOT EXISTS `ev_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `content_type` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ev_cms`
--

INSERT INTO `ev_cms` (`id`, `order_id`, `is_active`, `content_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2016-03-08', '2016-03-28'),
(2, 2, 1, 1, '2016-03-09', '2016-04-05'),
(3, 4, 1, 1, '2016-03-09', '2016-04-05'),
(4, 3, 1, 1, '2016-03-09', '2016-03-28'),
(6, 5, 1, 1, '2016-03-28', '2016-04-05'),
(7, 6, 1, 1, '2016-03-28', '2016-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `ev_cms_data`
--

CREATE TABLE IF NOT EXISTS `ev_cms_data` (
  `cms_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `cms_title` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `cms_content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cms_data_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ev_cms_data`
--

INSERT INTO `ev_cms_data` (`cms_data_id`, `cms_id`, `language_id`, `cms_title`, `cms_content`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(1, 1, 1, 'Home page', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium. Donec gravida viverra dolor et posuere. In suscipit scelerisque erat, lobortis molestie enim molestie id. Nullam dolor erat, tristique in velit eget, suscipit vestibulum massa. Quisque eget aliquet metus, molestie posuere leo. Ut ante lacus, commodo vitae pretium sit amet, egestas ac neque.</p>', 'Home page', 'Home page meta tag description', 'Eventus, Angola, Hall'),
(2, 1, 2, 'Casa página', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium. Donec gravida viverra dolor et posuere. In suscipit scelerisque erat, lobortis molestie enim molestie id. Nullam dolor erat, tristique in velit eget, suscipit vestibulum massa. Quisque eget aliquet metus, molestie posuere leo. Ut ante lacus, commodo vitae pretium sit amet, egestas ac neque.</p>', 'Casa página', 'A inscrição Casa página meta', 'Eventus, Angola, Hall'),
(3, 2, 1, 'Terms and Condition', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium. Donec gravida viverra dolor et posuere. In suscipit scelerisque erat, lobortis molestie enim molestie id. Nullam dolor erat, tristique in velit eget, suscipit vestibulum massa. Quisque eget aliquet metus, molestie posuere leo. Ut ante lacus, commodo vitae pretium sit amet, egestas ac neque.</p>', 'Terms and Condition', 'Terms and Condition', 'Terms and Condition'),
(4, 2, 2, 'Termos e Condições', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium. Donec gravida viverra dolor et posuere. In suscipit scelerisque erat, lobortis molestie enim molestie id. Nullam dolor erat, tristique in velit eget, suscipit vestibulum massa. Quisque eget aliquet metus, molestie posuere leo. Ut ante lacus, commodo vitae pretium sit amet, egestas ac neque.</p>\r\n<p>&nbsp;</p>', 'Terms and Condition', 'Terms and Condition', 'Terms and Condition'),
(5, 3, 1, 'About us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy.</p>', 'About us', 'About us', 'About us'),
(6, 3, 2, 'About us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy.</p>', 'About us', 'About us', 'About us'),
(7, 4, 1, 'Privacy policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Privacy policy', 'Privacy policy', 'Privacy policy'),
(8, 4, 2, 'Privacy policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Privacy policy', 'Privacy policy', 'Privacy policy'),
(11, 6, 1, 'Contact us', '<p>Sr. Joao Pembele</p>\r\n<p>Rua Frederik Engels 92-7 o</p>\r\n<p>LUANDA</p>\r\n<p>ANGOLA</p>\r\n<p>&nbsp;</p>', 'Contact us', 'Contact us', 'Contact us'),
(12, 6, 2, 'Contact us', '<p>Sr. Joao Pembele</p>\r\n<p>Rua Frederik Engels 92-7 o</p>\r\n<p>LUANDA</p>\r\n<p>ANGOLA</p>\r\n<p>&nbsp;</p>', 'Contact us', 'Contact us', 'Contact us'),
(13, 7, 1, 'News', '', 'News', 'News', 'News'),
(14, 7, 2, 'News', '', 'News', 'News', 'News');

-- --------------------------------------------------------

--
-- Table structure for table `ev_currency`
--

CREATE TABLE IF NOT EXISTS `ev_currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ev_currency`
--

INSERT INTO `ev_currency` (`id`, `currency_name`, `currency_code`) VALUES
(1, 'Kwanza', 'AOA'),
(2, 'Euro', 'EUR');

-- --------------------------------------------------------

--
-- Table structure for table `ev_email`
--

CREATE TABLE IF NOT EXISTS `ev_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `ev_email`
--

INSERT INTO `ev_email` (`id`, `email_title`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'Registration', 1, 1, '2016-03-22 08:26:36', '2016-04-07 13:47:36'),
(2, 'Booking payment success', 1, 2, '2016-03-25 08:26:20', '2016-04-05 21:33:20'),
(3, 'Enquiry to hall owner', 1, 3, '2016-03-25 08:27:29', '2016-03-25 21:54:10'),
(4, 'Hall added', 1, 4, '2016-03-25 10:49:30', '2016-03-25 17:58:52'),
(5, 'Subscription added', 1, 5, '2016-03-25 10:49:30', '2016-03-29 15:08:17'),
(6, 'Review mail to owner', 1, 6, '2016-03-25 14:48:30', '2016-03-25 21:59:35'),
(7, 'Reply to message', 1, 7, '2016-03-28 05:55:53', '2016-03-28 12:59:48'),
(8, 'Featured added', 1, 8, '2016-03-28 09:45:57', '2016-03-29 15:09:39'),
(9, 'Contact us mail', 1, 9, '2016-03-28 10:01:45', '2016-03-28 17:13:56'),
(10, 'Newsletter Email', 1, 10, '2016-04-05 15:59:20', '2016-04-05 23:06:42'),
(11, 'Subscription Renew mail before 30 days', 1, 11, '2016-04-06 11:02:32', '2016-04-06 18:09:22'),
(12, 'Subscription Renew mail on expiry day', 1, 12, '2016-04-06 12:01:05', '2016-04-06 19:21:05'),
(13, 'Subscription Renew mail after expiry day', 1, 13, '2016-04-06 12:40:26', '2016-04-06 19:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `ev_email_translation`
--

CREATE TABLE IF NOT EXISTS `ev_email_translation` (
  `email_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `email_subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`email_translation_id`),
  KEY `accommodation_translation_accommodation_id_foreign` (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `ev_email_translation`
--

INSERT INTO `ev_email_translation` (`email_translation_id`, `email_id`, `language_id`, `email_subject`, `email_body`) VALUES
(1, 1, 1, 'Eventus registration', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Please Complete your Registration by [CLICKHERE]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details below:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Name</td>\r\n<td style="padding-left: 5px;" align="left">[NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Email</td>\r\n<td style="padding-left: 5px;" align="left">[EMAIL]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Mobile no.</td>\r\n<td style="padding-left: 5px;" align="left">[MOBILE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Address</td>\r\n<td style="padding-left: 5px;" align="left">[ADDRESS]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(2, 1, 2, 'Eventus registration', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Please Complete your Registration by [CLICKHERE]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details below:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Name</td>\r\n<td style="padding-left: 5px;" align="left">[NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Email</td>\r\n<td style="padding-left: 5px;" align="left">[EMAIL]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Mobile no.</td>\r\n<td style="padding-left: 5px;" align="left">[MOBILE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Address</td>\r\n<td style="padding-left: 5px;" align="left">[ADDRESS]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(3, 2, 1, 'Payment success', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Thanks for the payment.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Location</td>\r\n<td style="padding-left: 5px;" align="left">[LOCATION]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Check In</td>\r\n<td style="padding-left: 5px;" align="left">[CHECKIN]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Check Out</td>\r\n<td style="padding-left: 5px;" align="left">[CHECKOUT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(4, 2, 2, 'Payment success', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Thanks for the payment.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Location</td>\r\n<td style="padding-left: 5px;" align="left">[LOCATION]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Check In</td>\r\n<td style="padding-left: 5px;" align="left">[CHECKIN]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Check Out</td>\r\n<td style="padding-left: 5px;" align="left">[CHECKOUT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(5, 3, 1, 'An enquiry has been posted.', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">An enquiry has been posted by [POSTEDBY] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Enquiry Message:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[ENQUIRYTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(6, 3, 2, 'An enquiry has been posted.', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">An enquiry has been posted by [POSTEDBY] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Enquiry Message:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[ENQUIRYTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(7, 4, 1, 'Hall added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Thanks for adding Hall.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Location</td>\r\n<td style="padding-left: 5px;" align="left">[LOCATION]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Province</td>\r\n<td style="padding-left: 5px;" align="left">[PROVINCE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Rental Amount</td>\r\n<td style="padding-left: 5px;" align="left">[RENTALAMOUNT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(8, 4, 2, 'Hall added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Thanks for adding Hall.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Location</td>\r\n<td style="padding-left: 5px;" align="left">[LOCATION]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Province</td>\r\n<td style="padding-left: 5px;" align="left">[PROVINCE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Rental Amount</td>\r\n<td style="padding-left: 5px;" align="left">[RENTALAMOUNT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(9, 5, 1, 'Subscription added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for the hall has been added successfully.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Payment number</td>\r\n<td style="padding-left: 5px;" align="left">[PAYMENT_NUMBER]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(10, 5, 2, 'Subscription added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for the hall has been added successfully.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Payment number</td>\r\n<td style="padding-left: 5px;" align="left">[PAYMENT_NUMBER]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(11, 6, 1, 'Review posted on your hall', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A review has been posted on your hall "[HALL_NAME]" by [POSTEDBY].</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Review text:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[REVIEWTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(12, 6, 2, 'Review posted on your hall', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A review has been posted on your hall "[HALL_NAME]" by [POSTEDBY].</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Review text:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[REVIEWTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(13, 7, 1, 'Reply for your message', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">An reply has been posted by [POSTEDBY] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Reply Message:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[REPLYTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(14, 7, 2, 'Reply for your message', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">An reply has been posted by [POSTEDBY] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Reply Message:</p>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">[REPLYTEXT]</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(15, 8, 1, 'Featured service added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Featured for the hall has been added successfully.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Payment number</td>\r\n<td style="padding-left: 5px;" align="left">[PAYMENT_NUMBER]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured name</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Featured price</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured month</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured date</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(16, 8, 2, 'Featured service added successfully', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Featured for the hall has been added successfully.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Payment number</td>\r\n<td style="padding-left: 5px;" align="left">[PAYMENT_NUMBER]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured name</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Featured price</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured month</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured date</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Featured expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[FEATURED_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(17, 9, 1, 'Event us Angola, contact us query', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear Admin,</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A query has been posted from contact us page.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">First Name</td>\r\n<td style="padding-left: 5px;" align="left">[FIRST_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Last Name</td>\r\n<td style="padding-left: 5px;" align="left">[LAST_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Email</td>\r\n<td style="padding-left: 5px;" align="left">[EMAIL]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subject</td>\r\n<td style="padding-left: 5px;" align="left">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Comment</td>\r\n<td style="padding-left: 5px;" align="left">[COMMENT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(18, 9, 2, 'Event us Angola, contact us query', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear Admin,</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A query has been posted from contact us page.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">First Name</td>\r\n<td style="padding-left: 5px;" align="left">[FIRST_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Last Name</td>\r\n<td style="padding-left: 5px;" align="left">[LAST_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Email</td>\r\n<td style="padding-left: 5px;" align="left">[EMAIL]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subject</td>\r\n<td style="padding-left: 5px;" align="left">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Comment</td>\r\n<td style="padding-left: 5px;" align="left">[COMMENT]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(19, 10, 1, 'Eventus Angola, Newsletter mail', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear Admin,</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A user has been subscribed to newletter. User Email Id: [NEWSLETTER_EMAIL] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(20, 10, 2, 'Eventus Angola, Newsletter mail', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear Admin,</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">A user has been subscribed to newletter. User Email Id is [NEWSLETTER_EMAIL] .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(21, 11, 1, 'Eventus Angola : Subscription Renew', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for the hall will be going to expire on [SUBSCRIPTION_EXPIRY], So please renew your subscription.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(22, 11, 2, 'Eventus Angola : Subscription Renew', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for the hall will be going to expire on [SUBSCRIPTION_EXPIRY], So please renew your subscription.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(23, 12, 1, 'Eventus Angola : Subscription expire today', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for your hall will expire today, So please renew your subscription.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(24, 12, 2, 'Eventus Angola : Subscription expire today', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for your hall will expire today, So please renew your subscription.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
(25, 13, 1, 'Eventus Angola : Subscription already expired', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for your hall already expired on [SUBSCRIPTION_EXPIRY], So please renew your subscription as soon as possible.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `ev_email_translation` (`email_translation_id`, `email_id`, `language_id`, `email_subject`, `email_body`) VALUES
(26, 13, 2, 'Eventus Angola : Subscription already expired', '<table border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong style="font-family: Helvetica, arial, sans-serif; font-size: 15px; font-weight: bold; color: #000000; line-height: 24px;">Dear [USERNAME],</strong></td>\r\n</tr>\r\n<tr>\r\n<td height="10">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px;">Subscription for your hall already expired on [SUBSCRIPTION_EXPIRY], So please renew your subscription as soon as possible.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 12px; color: #222; line-height: 24px; text-decoration: underline;">Here are the details:</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table class="devicewidth" style="border: solid 1px #f1f1f1; font-size: 12px; font-weight: normal;" border="0" width="100%" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">Hall name</td>\r\n<td style="padding-left: 5px;" align="left">[HALL_NAME]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription name</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_NAME]</td>\r\n</tr>\r\n<tr style="background: #f1f1f1;">\r\n<td style="padding-left: 5px;" align="left">subscription price</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_PRICE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription month</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_MONTH]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_DATE]</td>\r\n</tr>\r\n<tr>\r\n<td style="padding-left: 5px;" align="left">Subscription expiry date</td>\r\n<td style="padding-left: 5px;" align="left">[SUBSCRIPTION_EXPIRY]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td height="20">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p style="font-family: Helvetica, arial, sans-serif; font-size: 14px; font-weight: bold; color: #111; line-height: 24px;">Thanks</p>\r\n<strong style="font-family: Helvetica, arial, sans-serif; font-size: 13px; font-weight: bold; color: #333; line-height: 24px;"> Eventus Angola<br /></strong></td>\r\n</tr>\r\n</tbody>\r\n</table>');

-- --------------------------------------------------------

--
-- Table structure for table `ev_facilities`
--

CREATE TABLE IF NOT EXISTS `ev_facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `icon_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ev_facilities`
--

INSERT INTO `ev_facilities` (`id`, `is_active`, `order_id`, `icon_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'wifi.jpg', '2016-02-22 12:07:57', '2016-04-04 21:07:11'),
(2, 1, 2, 'secured.jpg', '2016-02-22 20:08:41', '2016-04-04 21:09:22'),
(3, 1, 3, 'bathtub.jpg', '2016-02-25 14:54:53', '2016-03-15 21:36:19'),
(4, 0, 4, 'water.jpg', '2016-02-25 14:55:19', '2016-04-04 16:25:12'),
(5, 1, 5, 'carpet.jpg', '2016-02-25 14:56:19', '2016-04-04 21:06:14'),
(8, 1, 7, '', '2016-03-15 14:20:08', '2016-03-15 14:20:32'),
(9, 1, 6, '', '2016-04-04 21:10:08', '2016-04-04 21:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `ev_facilities_translation`
--

CREATE TABLE IF NOT EXISTS `ev_facilities_translation` (
  `facilities_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facilities_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `facilities_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`facilities_translation_id`),
  KEY `addon_translation_addon_id_foreign` (`facilities_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ev_facilities_translation`
--

INSERT INTO `ev_facilities_translation` (`facilities_translation_id`, `facilities_id`, `language_id`, `facilities_name`) VALUES
(1, 1, 1, 'Wifi'),
(2, 1, 2, 'Wifi'),
(3, 2, 1, 'Security '),
(4, 2, 2, 'Security'),
(5, 3, 1, 'Bathtub'),
(6, 3, 2, 'Bathtub'),
(7, 4, 1, 'Water'),
(8, 4, 2, 'Water'),
(9, 5, 1, 'Carpeting   '),
(10, 5, 2, 'Carpeting'),
(15, 8, 1, 'Parking'),
(16, 8, 2, 'Parking'),
(17, 9, 1, 'Music System'),
(18, 9, 2, 'Music System Pt');

-- --------------------------------------------------------

--
-- Table structure for table `ev_faq`
--

CREATE TABLE IF NOT EXISTS `ev_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ev_faq`
--

INSERT INTO `ev_faq` (`id`, `order_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '2016-03-11 10:48:15', '2016-03-28 16:43:12'),
(2, 2, '1', '2016-03-11 22:22:44', '2016-03-28 16:43:14'),
(3, 3, '1', '2016-03-11 22:23:16', '2016-04-05 20:39:18'),
(4, 4, '1', '2016-03-11 22:26:50', '2016-03-28 16:43:16'),
(5, 5, '1', '2016-04-05 20:40:59', '2016-04-05 20:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `ev_faq_translation`
--

CREATE TABLE IF NOT EXISTS `ev_faq_translation` (
  `faq_translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `faq_title` tinytext NOT NULL,
  `faq_content` text NOT NULL,
  PRIMARY KEY (`faq_translation_id`),
  KEY `FK_P8_P10_Cascade` (`faq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ev_faq_translation`
--

INSERT INTO `ev_faq_translation` (`faq_translation_id`, `faq_id`, `language_id`, `faq_title`, `faq_content`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(2, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(3, 2, 1, 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(4, 2, 2, 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(15, 4, 1, 'Phasellus vestibulum nulla eu ipsum volutpat', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. </p>'),
(16, 4, 2, 'Phasellus vestibulum nulla eu ipsum volutpat', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna.</p>'),
(17, 3, 1, 'What is Eventus angola?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(18, 3, 2, 'What is Eventus angola?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec risus lectus, faucibus eu ligula ac, euismod euismod tortor. Phasellus vestibulum nulla eu ipsum volutpat, in mattis est feugiat. Integer condimentum odio nibh, eget ullamcorper mauris pulvinar nec. Fusce vitae auctor urna. Fusce convallis rutrum dui vitae posuere. Nullam sed orci ultricies, semper leo vitae, tincidunt elit. Nunc dictum non tortor et gravida. Vestibulum in neque blandit, ornare ex vitae, consectetur velit. Duis sit amet neque ac nulla facilisis eleifend ut sed diam. Vestibulum tempus tortor enim, ut tempus sem ultricies ut. Quisque pulvinar diam eu maximus pharetra. Phasellus nec ex ac arcu volutpat auctor. Morbi cursus pretium elit. Praesent fringilla pellentesque velit, ac gravida justo consectetur non. Sed ullamcorper lacus lectus, quis consequat nunc elementum eget. Mauris molestie mi vitae elit aliquam tincidunt</p>'),
(19, 5, 1, 'Test FAQ', '<p>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">English Content...&nbsp;</span></p>'),
(20, 5, 2, 'Test FAQ Pt', '<p>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span>Test FAQ in&nbsp;<span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Portuguese&nbsp;</span><span style="color: #333333; font-family: Lato; font-size: 14px; text-align: right;">Content...&nbsp;</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `ev_favorite`
--

CREATE TABLE IF NOT EXISTS `ev_favorite` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hall_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`favorite_id`),
  KEY `FK_K1_K2_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `ev_favorite`
--

INSERT INTO `ev_favorite` (`favorite_id`, `user_id`, `hall_id`, `created_at`) VALUES
(35, 27, 22, '2016-03-16 14:27:18'),
(36, 27, 34, '2016-03-16 15:16:17'),
(37, 7, 34, '2016-03-16 17:48:36'),
(38, 7, 35, '2016-03-16 17:48:45'),
(40, 27, 35, '2016-03-21 18:47:19'),
(42, 1, 24, '2016-03-25 14:10:33'),
(44, 38, 45, '2016-04-01 20:54:58'),
(45, 38, 47, '2016-04-01 20:57:03'),
(46, 36, 49, '2016-04-01 21:53:49'),
(47, 1, 43, '2016-04-04 18:19:12'),
(48, 36, 71, '2016-04-05 22:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall`
--

CREATE TABLE IF NOT EXISTS `ev_hall` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `location_id` int(10) NOT NULL,
  `contact_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hall_province` int(10) NOT NULL,
  `hall_postcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rental_amount` int(10) NOT NULL,
  `rental_amount_euro` double(8,2) NOT NULL,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lat` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `g_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `ev_hall`
--

INSERT INTO `ev_hall` (`id`, `user_id`, `location_id`, `contact_email`, `contact_mobile`, `hall_province`, `hall_postcode`, `rental_amount`, `rental_amount_euro`, `is_active`, `lat`, `lng`, `order_id`, `g_address`, `created_at`, `updated_at`) VALUES
(22, 1, 4, 'ranjit@mail.com', '9830012346', 1, '123456', 200, 1.10, '1', '-11.3283144', '16.44058719999998', 0, '', '2016-03-02 23:07:19', '2016-04-04 16:45:11'),
(23, 7, 5, 'kaushik@gmail.com', '9830012345', 2, '23450', 400, 2.20, '1', '', '', 0, '', '2016-03-02 23:10:41', '2016-03-28 18:38:58'),
(24, 1, 6, 'ranjit@mail.com', '9830012346', 4, '563210', 50, 0.28, '1', '-12.354343445773738', '14.772856722753886', 0, 'Unnamed Road, Balombo, Angola', '2016-03-02 23:22:17', '2016-03-22 17:49:56'),
(34, 27, 31, 'sam@hmail.com', '1234567890', 5, '123654', 500, 2.75, '1', '13.074024934703148', '80.16275024912102', 0, 'Adayalampattu Village Rd, S and P Garden, Nolambur, Ambattur Industrial Estate, Chennai, Tamil Nadu 600095, India', '2016-03-12 17:04:23', '2016-03-12 17:04:23'),
(35, 27, 7, 'sam@hmail.com', '1234567890', 6, '123456', 500, 2.75, '1', '22.547281905124603', '88.36423832275386', 0, '', '2016-03-12 17:50:04', '2016-04-04 15:22:08'),
(40, 1, 3, 'ranjit@mail.com', '9830012346', 1, '125478111', 1000, 5506.11, '1', '-7.863083999999999', '13.119256299999961', 0, '', '2016-03-17 19:37:29', '2016-04-08 18:00:56'),
(43, 7, 84, 'kaushik.citytech@gmail.com', '9830012345', 1, '12345', 90, 0.50, '1', '-8.898497600000017', '13.232865350292968', 0, 'R. 55, Luanda, Angola', '2016-03-25 18:33:36', '2016-03-28 18:40:04'),
(45, 36, 4, 'test.citytech@gmail.com', '1234567891', 2, '123789', 2200, 12.10, '1', '-11.3283144', '16.44058719999998', 0, '', '2016-04-01 18:41:21', '2016-04-05 16:33:45'),
(47, 36, 11, 'test.citytech@gmail.com', '1234567891', 4, '789456', 500, 2.75, '1', '-11.1768956', '20.21918329999994', 0, '', '2016-04-01 19:35:18', '2016-04-01 21:12:06'),
(48, 37, 13, 'citynow.test@gmail.com', '9876543219', 4, '456654', 400, 2.20, '1', '-8.351422999999999', '17.506139299999973', 0, '', '2016-04-01 19:52:34', '2016-04-04 16:37:27'),
(49, 37, 6, 'citynow.test@gmail.com', '9876543219', 3, '123456', 505, 2.78, '1', '-12.3536727', '14.77251339999998', 0, 'Unnamed Road, Balombo, Angola', '2016-04-01 20:02:43', '2016-04-06 20:50:24'),
(71, 36, 16, 'test.citytech@gmail.com', '1234567891', 15, '123456', 250, 0.00, '1', '-10.1413192', '19.268284900000026', 1, '', '2016-04-05 22:13:40', '2016-04-08 13:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hallimages`
--

CREATE TABLE IF NOT EXISTS `ev_hallimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `image_order` int(11) NOT NULL,
  `hall_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hall_image_caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_T7_T8_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=377 ;

--
-- Dumping data for table `ev_hallimages`
--

INSERT INTO `ev_hallimages` (`id`, `hall_id`, `image_order`, `hall_image`, `hall_image_caption`, `created_at`, `updated_at`) VALUES
(162, 34, 1, 'gallery1.1458554843.jpg', '', '2016-03-21 17:07:24', '2016-03-25 12:45:26'),
(163, 34, 4, 'gallery2.1458554844.jpg', '', '2016-03-21 17:07:24', '2016-03-25 12:45:26'),
(164, 34, 2, 'gallery3.1458554844.jpg', '', '2016-03-21 17:07:24', '2016-03-25 12:45:26'),
(165, 34, 3, 'gallery4.1458554844.jpg', '', '2016-03-21 17:07:25', '2016-03-25 12:45:26'),
(252, 24, 1, 'gallery1.1458635471.jpg', '', '2016-03-22 15:31:11', '2016-03-22 15:31:11'),
(253, 24, 2, 'gallery2.1458635471.jpg', '', '2016-03-22 15:31:11', '2016-03-22 15:31:11'),
(254, 24, 3, 'gallery3.1458635471.jpg', '', '2016-03-22 15:31:11', '2016-03-22 15:31:11'),
(255, 24, 4, 'gallery4.1458635472.jpg', '', '2016-03-22 15:31:12', '2016-03-22 15:31:12'),
(257, 22, 1, 'gallery2.1458635517.jpg', '6598', '2016-03-22 15:31:57', '2016-03-29 19:15:12'),
(263, 35, 1, 'gallery1.1458798997.jpg', '', '2016-03-24 12:56:37', '2016-03-24 12:56:37'),
(264, 35, 2, 'gallery2.1458798997.jpg', '', '2016-03-24 12:56:37', '2016-03-24 12:56:37'),
(265, 35, 3, 'gallery3.1458798997.jpg', '', '2016-03-24 12:56:38', '2016-03-24 12:56:38'),
(266, 35, 4, 'gallery4.1458798998.jpg', '', '2016-03-24 12:56:38', '2016-03-24 12:56:38'),
(267, 34, 5, 'gallery1.1458884775.jpg', '', '2016-03-25 12:46:15', '2016-03-25 12:46:15'),
(268, 34, 6, 'gallery2.1458884775.jpg', '', '2016-03-25 12:46:15', '2016-03-25 12:46:15'),
(269, 34, 7, 'gallery3.1458884775.jpg', '', '2016-03-25 12:46:16', '2016-03-25 12:46:16'),
(270, 34, 8, 'gallery4.1458884776.jpg', '', '2016-03-25 12:46:16', '2016-03-25 12:46:16'),
(271, 23, 1, 'gallery1.1458898243.jpg', '', '2016-03-25 16:30:43', '2016-03-25 22:07:50'),
(272, 23, 3, 'gallery2.1458898243.jpg', '', '2016-03-25 16:30:43', '2016-03-25 22:07:50'),
(273, 23, 4, 'gallery3.1458898243.jpg', 'The World is not', '2016-03-25 16:30:43', '2016-03-25 22:07:50'),
(274, 23, 2, 'gallery4.1458898244.jpg', '', '2016-03-25 16:30:44', '2016-03-25 22:07:50'),
(275, 43, 4, 'gallery1.1458907288.jpg', '', '2016-03-25 19:01:28', '2016-03-26 18:14:29'),
(276, 43, 3, 'gallery2.1458907288.jpg', 'Enter Caption111', '2016-03-25 19:01:28', '2016-03-26 18:14:28'),
(277, 43, 5, 'gallery3.1458907288.jpg', 'Enter Caption542', '2016-03-25 19:01:29', '2016-03-26 18:14:29'),
(278, 43, 1, 'gallery4.1458907289.jpg', 'Enter Caption321', '2016-03-25 19:01:29', '2016-03-26 18:14:28'),
(279, 43, 6, 'gallery1.1458990849.jpg', '', '2016-03-26 18:14:09', '2016-03-26 18:14:29'),
(280, 43, 7, 'gallery2.1458990849.jpg', '', '2016-03-26 18:14:10', '2016-03-26 18:14:29'),
(282, 43, 2, 'gallery4.1458990850.jpg', 'dmnfbjdsbfjh', '2016-03-26 18:14:10', '2016-03-26 18:14:28'),
(295, 22, 5, 'gallery3.1459251709.jpg', 'Panther', '2016-03-29 18:41:49', '2016-03-29 19:15:13'),
(298, 22, 3, 'gallery2.1459253028.jpg', '', '2016-03-29 19:03:48', '2016-03-29 19:15:12'),
(299, 22, 4, 'gallery3.1459253028.jpg', '', '2016-03-29 19:03:49', '2016-03-29 19:15:13'),
(302, 22, 6, 'gallery1.1459253691.jpg', '', '2016-03-29 19:14:51', '2016-03-29 19:15:13'),
(303, 22, 7, 'gallery2.1459253691.jpg', '', '2016-03-29 19:14:51', '2016-03-29 19:15:14'),
(304, 22, 8, 'gallery3.1459253691.jpg', '', '2016-03-29 19:14:52', '2016-03-29 19:15:14'),
(305, 22, 2, 'gallery4.1459253693.jpg', 'The Wall', '2016-03-29 19:14:53', '2016-03-29 19:15:18'),
(317, 45, 1, 'party3.jpg', 'Caption1', '2016-04-01 18:42:21', '2016-04-05 15:48:54'),
(318, 45, 2, 'party4.jpg', 'Caption2', '2016-04-01 18:42:23', '2016-04-05 15:37:03'),
(319, 45, 3, 'party5.jpg', '', '2016-04-01 18:42:23', '2016-04-01 18:42:23'),
(320, 45, 4, 'party6.jpg', '', '2016-04-01 18:42:24', '2016-04-01 18:42:24'),
(321, 45, 5, 'party7.jpg', '', '2016-04-01 18:42:25', '2016-04-01 18:42:25'),
(322, 45, 6, 'party8.jpg', '', '2016-04-01 18:42:26', '2016-04-01 18:42:26'),
(323, 45, 7, 'party9.jpg', '', '2016-04-01 18:42:26', '2016-04-01 18:42:26'),
(324, 45, 8, 'party10.jpg', '', '2016-04-01 18:42:27', '2016-04-01 18:42:27'),
(325, 45, 9, 'party11.jpg', '', '2016-04-01 18:42:28', '2016-04-01 18:42:28'),
(326, 45, 10, 'party13.jpg', '', '2016-04-01 18:42:28', '2016-04-01 18:42:28'),
(327, 45, 11, 'party14.jpg', '', '2016-04-01 18:42:29', '2016-04-01 18:42:29'),
(335, 47, 1, 'party.jpg', '', '2016-04-01 19:36:09', '2016-04-01 19:36:09'),
(336, 47, 2, 'party_Birthday.jpg', '', '2016-04-01 19:36:09', '2016-04-01 19:36:09'),
(337, 47, 3, 'party_Birthday1.jpg', '', '2016-04-01 19:36:10', '2016-04-01 19:36:10'),
(338, 47, 4, 'party_Dj17.jpg', '', '2016-04-01 19:36:11', '2016-04-01 19:36:11'),
(339, 47, 5, 'party_Dj18.jpg', '', '2016-04-01 19:36:11', '2016-04-01 19:36:11'),
(340, 47, 6, 'party_Dj19.jpg', '', '2016-04-01 19:36:13', '2016-04-01 19:36:13'),
(341, 47, 7, 'party_Dj20.jpg', '', '2016-04-01 19:36:14', '2016-04-01 19:36:14'),
(342, 48, 1, 'party8.1459515199.jpg', 'Sania test Hall img1', '2016-04-01 19:53:19', '2016-04-01 19:56:49'),
(343, 48, 2, 'party9.1459515200.jpg', 'Sania test Hall img2', '2016-04-01 19:53:20', '2016-04-01 19:55:06'),
(344, 48, 3, 'party10.1459515200.jpg', 'Sania test Hall img3', '2016-04-01 19:53:21', '2016-04-01 19:55:17'),
(345, 48, 4, 'party11.1459515202.jpg', '', '2016-04-01 19:53:22', '2016-04-01 19:53:22'),
(346, 48, 5, 'party13.1459515202.jpg', 'Sania test Hall img5', '2016-04-01 19:53:23', '2016-04-01 19:56:21'),
(347, 48, 6, 'party.1459515215.jpg', 'Sania test Hall img4', '2016-04-01 19:53:36', '2016-04-01 19:56:59'),
(348, 48, 7, 'party_Birthday.1459515217.jpg', 'Sania test Hall img6', '2016-04-01 19:53:39', '2016-04-01 19:57:04'),
(349, 48, 8, 'party_Birthday1.1459515222.jpg', 'Sania test Hall img7', '2016-04-01 19:53:43', '2016-04-01 19:57:08'),
(350, 48, 9, 'party_Dj17.1459515224.jpg', 'Sania test Hall img8', '2016-04-01 19:53:45', '2016-04-01 19:57:14'),
(351, 48, 10, 'party_Dj18.1459515228.jpg', 'Sania test Hall10', '2016-04-01 19:53:49', '2016-04-01 19:57:31'),
(352, 48, 11, 'party_Dj19.1459515230.jpg', '', '2016-04-01 19:53:52', '2016-04-01 19:53:52'),
(353, 48, 12, 'party_Dj20.1459515233.jpg', '', '2016-04-01 19:53:53', '2016-04-01 19:53:53'),
(354, 49, 1, 'party_Birthday1.1459515869.jpg', '', '2016-04-01 20:04:30', '2016-04-01 20:04:30'),
(355, 49, 2, 'party_Dj17.1459515871.jpg', '', '2016-04-01 20:04:31', '2016-04-01 20:04:31'),
(356, 49, 3, 'party_Dj18.1459515872.jpg', '', '2016-04-01 20:04:33', '2016-04-01 20:04:33'),
(357, 49, 4, 'party1.jpg', '', '2016-04-01 20:04:34', '2016-04-01 20:04:34'),
(358, 49, 5, 'party2.jpg', '', '2016-04-01 20:04:35', '2016-04-01 20:04:35'),
(359, 49, 6, 'party10.1459515876.jpg', '', '2016-04-01 20:04:36', '2016-04-01 20:04:36'),
(360, 49, 7, 'party11.1459515877.jpg', '', '2016-04-01 20:04:37', '2016-04-01 20:04:37'),
(361, 49, 8, 'party16.jpg', '', '2016-04-01 20:04:39', '2016-04-01 20:04:39'),
(362, 45, 12, 'party_Dj19.1459845336.jpg', '', '2016-04-05 15:35:38', '2016-04-05 15:35:38'),
(363, 71, 1, 'party_Dj19.1459869527.jpg', '', '2016-04-05 22:18:49', '2016-04-06 17:26:59'),
(364, 71, 3, 'party1.1459869529.jpg', 'eeeww', '2016-04-05 22:18:50', '2016-04-06 17:26:59'),
(365, 71, 2, 'party2.1459869530.jpg', '', '2016-04-05 22:18:50', '2016-04-06 17:26:59'),
(366, 71, 4, 'party6.1459869530.jpg', 'wwww', '2016-04-05 22:18:51', '2016-04-06 17:26:59'),
(367, 71, 5, 'party7.1459869531.jpg', '', '2016-04-05 22:18:52', '2016-04-06 17:26:59'),
(368, 71, 6, 'party9.1459869532.jpg', '', '2016-04-05 22:18:53', '2016-04-06 17:26:59'),
(369, 71, 7, 'party10.1459869533.jpg', '', '2016-04-05 22:18:54', '2016-04-06 17:26:59'),
(370, 71, 8, 'party13.1459869534.jpg', '', '2016-04-05 22:18:54', '2016-04-06 17:26:59'),
(371, 71, 9, 'party14.1459869534.jpg', '', '2016-04-05 22:18:55', '2016-04-06 17:26:59'),
(372, 71, 10, 'party15.jpg', '', '2016-04-05 22:18:57', '2016-04-06 17:26:59'),
(373, 40, 2, 'gallery1.1459957327.jpg', '', '2016-04-06 22:42:07', '2016-04-08 18:09:16'),
(374, 40, 3, 'gallery2.1459957327.jpg', 'Enter Caption', '2016-04-06 22:42:08', '2016-04-08 18:09:16'),
(375, 40, 1, 'gallery3.1459957328.jpg', '', '2016-04-06 22:42:08', '2016-04-08 18:09:16'),
(376, 40, 4, 'gallery4.1459957328.jpg', '', '2016-04-06 22:42:08', '2016-04-08 18:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_accommodation_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_accommodation_relation` (
  `hall_accommodation_relation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `accommodation_id` int(10) unsigned NOT NULL,
  `accommodation_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hall_accommodation_relation_id`),
  KEY `FK_T5_T6_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=151 ;

--
-- Dumping data for table `ev_hall_accommodation_relation`
--

INSERT INTO `ev_hall_accommodation_relation` (`hall_accommodation_relation_id`, `hall_id`, `accommodation_id`, `accommodation_number`) VALUES
(73, 22, 1, '70'),
(74, 22, 10, '60'),
(90, 34, 1, '2'),
(91, 34, 10, '2'),
(97, 23, 10, '1'),
(98, 23, 11, '3'),
(99, 23, 13, '6'),
(100, 43, 1, '5'),
(101, 43, 10, '1'),
(102, 43, 11, '1'),
(110, 24, 10, '1'),
(111, 24, 11, '2'),
(120, 47, 10, '3'),
(121, 47, 11, '2'),
(122, 47, 13, '2'),
(123, 48, 10, '3'),
(124, 48, 11, '2'),
(125, 48, 13, '2'),
(126, 49, 10, '3'),
(127, 49, 11, '2'),
(128, 49, 13, '1'),
(133, 35, 10, '6'),
(134, 35, 13, '3'),
(138, 45, 10, '3'),
(139, 45, 11, '4'),
(140, 45, 13, '2'),
(141, 71, 10, '3'),
(142, 71, 11, '2'),
(143, 71, 13, '3'),
(149, 40, 10, '5'),
(150, 40, 13, '2');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_addon_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_addon_relation` (
  `hall_addon_relation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `addon_id` int(10) unsigned NOT NULL,
  `addon_price` int(8) NOT NULL,
  PRIMARY KEY (`hall_addon_relation_id`),
  KEY `FK_T3_T4_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=367 ;

--
-- Dumping data for table `ev_hall_addon_relation`
--

INSERT INTO `ev_hall_addon_relation` (`hall_addon_relation_id`, `hall_id`, `addon_id`, `addon_price`) VALUES
(195, 34, 1, 50),
(196, 34, 4, 20),
(231, 22, 1, 40),
(232, 22, 5, 70),
(244, 23, 1, 60),
(245, 23, 2, 15),
(246, 23, 3, 27),
(249, 43, 2, 100),
(250, 43, 3, 60),
(261, 35, 1, 201),
(262, 35, 2, 0),
(263, 35, 5, 301),
(280, 48, 1, 100),
(281, 48, 2, 750),
(282, 48, 3, 400),
(283, 48, 4, 125),
(284, 48, 5, 200),
(312, 49, 1, 25),
(313, 49, 2, 25),
(314, 49, 3, 25),
(315, 49, 4, 50),
(316, 49, 5, 10),
(317, 47, 1, 60),
(318, 47, 2, 40),
(319, 47, 3, 10),
(320, 47, 4, 0),
(321, 45, 1, 85),
(322, 45, 2, 130),
(323, 45, 3, 125),
(324, 45, 4, 75),
(325, 45, 5, 100),
(335, 24, 2, 50),
(336, 24, 3, 19),
(349, 71, 1, 15),
(350, 71, 2, 50),
(351, 71, 3, 10),
(352, 71, 4, 15),
(353, 71, 5, 10),
(364, 40, 1, 15),
(365, 40, 2, 20),
(366, 40, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_block`
--

CREATE TABLE IF NOT EXISTS `ev_hall_block` (
  `hall_block_id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(11) unsigned NOT NULL,
  `block_type` enum('D','W','M') NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `week_day` int(11) DEFAULT NULL,
  `month_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`hall_block_id`),
  KEY `FK_T25_T26_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `ev_hall_block`
--

INSERT INTO `ev_hall_block` (`hall_block_id`, `hall_id`, `block_type`, `start_date`, `end_date`, `week_day`, `month_date`) VALUES
(3, 22, 'D', '2016-03-21', '2016-03-22', NULL, NULL),
(4, 23, 'W', NULL, NULL, 1, NULL),
(5, 24, 'D', '2016-04-01', '2016-04-10', NULL, NULL),
(6, 22, 'M', NULL, NULL, NULL, 15),
(33, 40, 'W', NULL, NULL, 7, 0),
(36, 34, 'W', NULL, NULL, 1, 0),
(45, 45, 'D', '2016-04-18', '2016-04-23', 0, 0),
(46, 45, 'W', NULL, NULL, 7, 0),
(47, 45, 'M', NULL, NULL, 0, 12),
(59, 47, 'D', '2016-04-17', '2016-04-23', 0, 0),
(60, 47, 'W', NULL, NULL, 3, 0),
(61, 47, 'M', NULL, NULL, 0, 25),
(62, 47, '', NULL, NULL, 0, 0),
(63, 47, 'W', NULL, NULL, 0, 0),
(64, 48, 'D', '2016-04-25', '2016-04-28', 0, 0),
(65, 48, 'W', NULL, NULL, 1, 0),
(66, 48, 'M', NULL, NULL, 0, 21),
(67, 49, 'W', NULL, NULL, 5, 0),
(68, 49, 'D', '2016-04-17', '2016-04-23', 0, 0),
(69, 49, 'M', NULL, NULL, 0, 30),
(70, 35, 'D', '2016-04-18', '2016-04-21', 0, 0),
(72, 35, 'M', NULL, NULL, 0, 1),
(73, 45, 'W', NULL, NULL, 1, 0),
(74, 45, 'M', NULL, NULL, 0, 14),
(75, 45, 'D', '2016-04-27', '2016-04-28', 0, 0),
(86, 71, 'D', '2016-04-14', '2016-04-18', 0, 0),
(87, 71, 'W', NULL, NULL, 4, 0),
(88, 71, 'M', NULL, NULL, 0, 22),
(98, 24, 'D', '2016-04-22', '2016-04-26', 0, 0),
(99, 24, 'W', NULL, NULL, 2, 0),
(100, 24, 'M', NULL, NULL, 0, 2),
(101, 24, 'M', NULL, NULL, 0, 2),
(103, 24, 'W', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_facilities_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_facilities_relation` (
  `hall_facilities_relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `facilities_id` int(11) NOT NULL,
  PRIMARY KEY (`hall_facilities_relation_id`),
  KEY `FK_C1_C2_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `ev_hall_facilities_relation`
--

INSERT INTO `ev_hall_facilities_relation` (`hall_facilities_relation_id`, `hall_id`, `facilities_id`) VALUES
(4, 23, 2),
(5, 23, 3),
(6, 23, 4),
(7, 35, 3),
(8, 35, 4),
(9, 22, 1),
(10, 22, 3),
(11, 22, 5),
(79, 45, 1),
(80, 45, 2),
(81, 45, 3),
(82, 45, 5),
(83, 45, 8),
(84, 45, 9),
(97, 71, 1),
(98, 71, 2),
(99, 71, 9),
(104, 40, 3),
(105, 40, 2),
(106, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_subscription_feature_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_subscription_feature_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(11) unsigned NOT NULL,
  `feature_id` int(11) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_price` double(8,2) NOT NULL,
  `feature_month` int(11) NOT NULL,
  `payment_status` enum('0','1') NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_T50_T51_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ev_hall_subscription_feature_relation`
--

INSERT INTO `ev_hall_subscription_feature_relation` (`id`, `hall_id`, `feature_id`, `feature_name`, `feature_price`, `feature_month`, `payment_status`, `payment_date`, `start_date`, `expiry_date`) VALUES
(11, 40, 1, '1 Month Featured listing', 150.00, 1, '1', '2016-04-08', '2016-04-08', '2016-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_subscription_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_subscription_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(11) unsigned NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `subscription_name` varchar(255) NOT NULL,
  `subscription_price` double(8,2) NOT NULL,
  `subscription_month` int(11) NOT NULL,
  `payment_status` enum('0','1') NOT NULL DEFAULT '0',
  `payment_date` timestamp NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_T110_T220_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `ev_hall_subscription_relation`
--

INSERT INTO `ev_hall_subscription_relation` (`id`, `hall_id`, `subscription_id`, `subscription_name`, `subscription_price`, `subscription_month`, `payment_status`, `payment_date`, `start_date`, `expiry_date`) VALUES
(15, 40, 1, '3 Months subscription', 100.00, 3, '1', '2016-04-08 16:55:06', '2016-04-08', '2016-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_translation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_translation` (
  `hall_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `official_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hall_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hall_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hall_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hall_translation_id`),
  KEY `hall_translation_hall_id_foreign` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=139 ;

--
-- Dumping data for table `ev_hall_translation`
--

INSERT INTO `ev_hall_translation` (`hall_translation_id`, `hall_id`, `language_id`, `official_name`, `contact_name`, `hall_name`, `hall_description`, `hall_address`) VALUES
(43, 22, 1, 'Rajesh Kumar', 'Rajesh Kumar', 'Del Angel Banquet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '15, Russel street'),
(44, 22, 2, 'Rajesh Kumar', 'Rajesh Kumar', 'Del Angel Banquet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '15, Russel street'),
(45, 23, 1, 'Kauhsik', 'Kaushik', 'Masonic Lodge', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '12, Luanda Street'),
(46, 23, 2, 'Kauhsik', 'Kaushik', 'Masonic Lodge', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '12, Luanda Street'),
(47, 24, 1, 'Ranjit kumar', 'Ranjit kumar', 'Potawatomi Inn', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '15 , Park Avenew'),
(48, 24, 2, 'Ranjit kumar', 'Ranjit kumar', 'Potawatomi Inn', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut. Maecenas ac sollicitudin est, ac hendrerit elit. In eu orci justo. Curabitur consequat nulla facilisis, luctus massa ac, euismod dui. Mauris eu laoreet risus, id vehicula nibh. Vestibulum aliquet augue sit amet ultrices semper. Integer ultrices aliquam eleifend. Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac. Fusce congue lacinia vestibulum. Nam tempus vitae dolor eget rhoncus.', '15 , Park Avenew'),
(63, 34, 1, 'Ramser Pavel', 'Ramser Pavel', 'Hotel Skylark', 'test', '15 street way'),
(64, 34, 2, 'Ramser Pavel', 'Ramser Pavel', 'Hotel Skylark', 'test', '15 street way'),
(65, 35, 1, 'Ramser Pavel', 'Ramser Pavel', 'Bataclan Theater ', 'fgdfg', '15 street way'),
(66, 35, 2, 'Ramser Pavel', 'Ramser Pavel', 'Bataclan Theater ', 'fgdfg', '15 street way'),
(75, 40, 1, 'Ranjitkumar', 'Ranjitkumar', 'Ambriz Banquet', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software.', '15 street way111'),
(76, 40, 2, 'Ranjitkumar', 'Ranjitkumar', 'Ambriz Banquet', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software.', '15 street way111'),
(81, 43, 1, 'Kaushik  Das', 'Kaushik  Das', 'Hotel Ramsar Inn', 'notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.', '15, Midland Park,'),
(82, 43, 2, 'Kaushik  Das', 'Kaushik  Das', 'Hotel Ramsar Inn', 'notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.notification lists within your custom built social networking website system.', '15, Midland Park,'),
(85, 45, 1, '        Anjan 123Das 456', '        Anjan 123Das 456', 'Anjan test hall', 'Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... ', 'Star Plaza, C/O- B.N.Das, 456N, Central Rd.'),
(86, 45, 2, '        Anjan 123Das 456', '        Anjan 123Das 456', 'Anjan test hall', 'Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... Anjan test hall description 010416... ', 'Star Plaza, C/O- B.N.Das, 456N, Central Rd.'),
(89, 47, 1, '        Anjan 123 Das 456', '        Anjan 123 Das 456', 'Test Hall', 'Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... ', 'Twen Plaza, C/O- S.M.Rana, 55D, Canal Rd.'),
(90, 47, 2, '        Anjan 123 Das 456', '        Anjan 123 Das 456', 'Test Hall', 'Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... Test Hall 010416... ', 'Twen Plaza, C/O- S.M.Rana, 55D, Canal Rd.'),
(91, 48, 1, 'Sania  Join', 'Sania  Join', 'Sania test Hall', 'Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... ', 'Sweet Home, C/O- R.K.Bose, 101K, Stand Rd.'),
(92, 48, 2, 'Sania  Join', 'Sania  Join', 'Sania test Hall', 'Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... ', 'Sweet Home, C/O- R.K.Bose, 101K, Stand Rd.'),
(93, 49, 1, 'Sania  Join', 'Sania  Join', 'Sania test Hall0104', 'Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... ', 'Sun City, C/O- B.N.Das, Flat No R2C6'),
(94, 49, 2, 'Sania  Join', 'Sania  Join', 'Sania test Hall0104', 'Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... Sania test Hall 010416... ', 'Sun City, C/O- B.N.Das, Flat No R2C6'),
(137, 71, 1, '        Anjan 123Das 456', '        Anjan 123Das 456', 'Test  Hall ', 'Test  Hall description... Test  Hall description... Test  Hall description... Test  Hall description... Test  Hall description... ', 'Heighland Park, C/O- Jon Smith, 42A,Bulstrode Avenue'),
(138, 71, 2, '        Anjan 123Das 456', '        Anjan 123Das 456', 'Test  Hall ', 'Test  Hall description... Test  Hall description... Test  Hall description... Test  Hall description... Test  Hall description... ', 'Heighland Park, C/O- Jon Smith, 42A,Bulstrode Avenue');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_type`
--

CREATE TABLE IF NOT EXISTS `ev_hall_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ev_hall_type`
--

INSERT INTO `ev_hall_type` (`id`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(2, 1, 3, '2016-02-22 21:24:26', '2016-04-06 14:38:32'),
(3, 1, 2, '2016-02-22 21:56:22', '2016-04-07 18:31:38'),
(4, 1, 6, '2016-02-22 22:59:00', '2016-03-15 21:38:09'),
(6, 0, 4, '2016-02-22 22:59:50', '2016-04-18 13:09:08'),
(7, 1, 5, '2016-02-22 23:02:28', '2016-03-15 20:27:27'),
(8, 1, 7, '2016-03-16 19:39:15', '2016-03-16 19:39:15'),
(11, 1, 8, '2016-04-04 19:50:59', '2016-04-04 19:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_type_relation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_type_relation` (
  `hall_type_relation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int(10) unsigned NOT NULL,
  `hall_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`hall_type_relation_id`),
  KEY `FK_T1_T2_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=475 ;

--
-- Dumping data for table `ev_hall_type_relation`
--

INSERT INTO `ev_hall_type_relation` (`hall_type_relation_id`, `hall_id`, `hall_type_id`) VALUES
(47, 34, 7),
(48, 34, 2),
(109, 24, 3),
(110, 24, 7),
(111, 24, 2),
(141, 23, 6),
(142, 23, 4),
(143, 43, 3),
(144, 43, 7),
(145, 43, 2),
(249, 47, 8),
(250, 47, 3),
(251, 47, 7),
(252, 47, 4),
(253, 47, 2),
(280, 35, 7),
(281, 48, 8),
(282, 48, 3),
(283, 48, 7),
(284, 48, 6),
(285, 48, 2),
(286, 22, 2),
(287, 22, 7),
(425, 45, 2),
(426, 45, 3),
(427, 45, 4),
(428, 45, 6),
(429, 45, 7),
(430, 45, 8),
(444, 71, 2),
(450, 49, 2),
(451, 49, 3),
(452, 49, 4),
(453, 49, 6),
(454, 49, 8),
(471, 40, 3),
(472, 40, 6),
(473, 40, 4),
(474, 40, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ev_hall_type_translation`
--

CREATE TABLE IF NOT EXISTS `ev_hall_type_translation` (
  `hall_type_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hall_type_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `hall_type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hall_type_translation_id`),
  KEY `hall_type_translation_hall_type_id_foreign` (`hall_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `ev_hall_type_translation`
--

INSERT INTO `ev_hall_type_translation` (`hall_type_translation_id`, `hall_type_id`, `language_id`, `hall_type_name`) VALUES
(3, 2, 1, 'Wedding hall'),
(4, 2, 2, 'Weddings halls'),
(6, 3, 2, 'Birthday hall'),
(7, 4, 1, 'Seminar Hall'),
(8, 4, 2, 'Seminar Hall'),
(11, 6, 1, 'Play hall'),
(12, 6, 2, 'play hall'),
(13, 7, 1, 'Ceremony hall'),
(14, 7, 2, 'Ceremony hall'),
(15, 3, 1, 'Birthday hall'),
(16, 8, 1, 'Ambiant Hall'),
(17, 8, 2, 'Ambiant Hall'),
(22, 11, 1, 'Meeting Hall'),
(23, 11, 2, 'Meeting Pg');

-- --------------------------------------------------------

--
-- Table structure for table `ev_inner_banner`
--

CREATE TABLE IF NOT EXISTS `ev_inner_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inner_banner_image` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cms_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `is_default` enum('1','0') NOT NULL DEFAULT '0',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ev_inner_banner`
--

INSERT INTO `ev_inner_banner` (`id`, `inner_banner_image`, `order_id`, `cms_id`, `province_id`, `location_id`, `publish_date`, `expiry_date`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Cool-Tiger-Wallpaper-1920x1080-HD.jpg', 2, 3, 2, 4, '2016-03-02', '2016-03-23', '0', '1', '2016-03-11 13:26:41', '2016-03-18 22:55:23'),
(2, 'pretty-nature-full-hd-wallpaper-nda.jpg', 1, 3, 1, 3, '2016-03-02', '2016-03-25', '0', '1', '2016-03-18 21:15:55', '2016-03-21 13:39:01'),
(3, '6803718-nature-wallpapers-hd.jpg', 5, 4, 13, 18, '2016-03-08', '2016-03-31', '0', '1', '2016-03-18 22:59:11', '2016-03-21 13:32:15'),
(4, 'pretty-nature-full-hd-wallpaper-nda.jpg', 3, 3, 5, 8, '2016-03-09', '2016-03-25', '0', '1', '2016-03-21 13:26:34', '2016-04-04 22:00:10'),
(5, 'download.jpg', 4, 7, 1, 3, '2016-04-04', '2016-04-30', '0', '1', '2016-04-04 22:04:08', '2016-04-04 22:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `ev_inner_banner_translation`
--

CREATE TABLE IF NOT EXISTS `ev_inner_banner_translation` (
  `inner_banner_translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `inner_banner_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `inner_banner_title` varchar(255) NOT NULL,
  PRIMARY KEY (`inner_banner_translation_id`),
  KEY `FK_P11_P12_Cascade` (`inner_banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ev_inner_banner_translation`
--

INSERT INTO `ev_inner_banner_translation` (`inner_banner_translation_id`, `inner_banner_id`, `language_id`, `inner_banner_title`) VALUES
(1, 1, 1, 'test1'),
(2, 1, 2, 'test2'),
(3, 2, 1, 'sdsds111'),
(4, 2, 2, 'dsdsd111'),
(5, 3, 1, 'dfdf'),
(6, 3, 2, 'fdfdf'),
(7, 4, 1, 'aaa'),
(8, 4, 2, 'aass'),
(9, 5, 1, 'Test inner page banner'),
(10, 5, 2, 'Test inner page banner Pt');

-- --------------------------------------------------------

--
-- Table structure for table `ev_language`
--

CREATE TABLE IF NOT EXISTS `ev_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang_short_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_lang_short_code_unique` (`lang_short_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ev_language`
--

INSERT INTO `ev_language` (`id`, `lang_name`, `lang_short_code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'EN', 'Y', '2016-03-04 06:52:11', '2016-03-04 06:52:11'),
(2, 'Portuguese', 'PT', 'N', '2016-02-22 19:54:02', '2016-02-22 19:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `ev_location`
--

CREATE TABLE IF NOT EXISTS `ev_location` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `location_lat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location_lng` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=127 ;

--
-- Dumping data for table `ev_location`
--

INSERT INTO `ev_location` (`location_id`, `is_active`, `order_id`, `location_lat`, `location_lng`, `created_at`, `updated_at`) VALUES
(3, '1', 0, '-7.863083999999999', '13.119256299999961', '2016-02-22 20:10:08', '2016-04-04 20:18:19'),
(4, '1', 0, '-11.932661192854786', '16.60102996826174', '2016-02-22 20:43:51', '2016-04-04 14:03:21'),
(5, '1', 0, '-8.817172698211152', '13.229526979443335', '2016-02-24 15:43:44', '2016-02-29 16:55:05'),
(6, '1', 0, '22.5577793', '88.3482093', '2016-02-29 16:55:22', '2016-02-29 16:55:22'),
(7, '1', 0, '-12.6101319', '13.194222399999944', '2016-02-29 16:55:33', '2016-04-04 14:02:41'),
(8, '1', 0, '-12.590180732958299', '13.414441063476602', '2016-02-29 16:55:43', '2016-04-04 14:04:03'),
(9, '1', 0, '-14.7605312', '13.355840899999976', '2016-02-29 16:55:57', '2016-04-04 14:04:53'),
(10, '1', 0, '-11.106595599999993', '14.221649054492218', '2016-02-29 16:56:09', '2016-04-04 14:05:35'),
(11, '1', 0, '', '', '2016-02-29 16:56:20', '2016-02-29 16:56:20'),
(12, '1', 0, '', '', '2016-02-29 16:56:30', '2016-02-29 16:56:30'),
(13, '1', 0, '', '', '2016-02-29 16:56:43', '2016-02-29 16:56:43'),
(14, '1', 0, '', '', '2016-02-29 16:56:54', '2016-02-29 16:56:54'),
(15, '1', 0, '', '', '2016-02-29 16:57:04', '2016-02-29 16:57:04'),
(16, '1', 0, '', '', '2016-02-29 16:57:14', '2016-02-29 16:57:14'),
(17, '1', 0, '', '', '2016-02-29 16:57:25', '2016-02-29 16:57:25'),
(18, '1', 0, '', '', '2016-02-29 16:57:36', '2016-02-29 16:57:36'),
(19, '1', 0, '', '', '2016-02-29 16:57:47', '2016-02-29 16:57:47'),
(20, '1', 0, '', '', '2016-02-29 16:57:57', '2016-02-29 16:57:57'),
(21, '1', 0, '', '', '2016-02-29 16:58:20', '2016-02-29 16:58:20'),
(22, '1', 0, '', '', '2016-02-29 16:58:30', '2016-02-29 16:58:30'),
(23, '1', 0, '', '', '2016-02-29 16:58:41', '2016-02-29 16:58:41'),
(24, '1', 0, '', '', '2016-02-29 16:58:52', '2016-02-29 16:58:52'),
(25, '1', 0, '', '', '2016-02-29 16:59:02', '2016-02-29 16:59:02'),
(26, '1', 0, '', '', '2016-02-29 16:59:12', '2016-02-29 16:59:12'),
(27, '1', 0, '', '', '2016-02-29 16:59:23', '2016-02-29 16:59:23'),
(28, '1', 0, '', '', '2016-02-29 16:59:34', '2016-02-29 16:59:34'),
(29, '1', 0, '', '', '2016-02-29 16:59:46', '2016-02-29 16:59:46'),
(30, '1', 0, '', '', '2016-02-29 16:59:57', '2016-02-29 16:59:57'),
(31, '1', 0, '', '', '2016-02-29 17:00:09', '2016-02-29 17:00:09'),
(32, '1', 0, '', '', '2016-02-29 17:00:20', '2016-02-29 17:00:20'),
(33, '1', 0, '', '', '2016-02-29 17:00:32', '2016-02-29 17:00:32'),
(34, '1', 0, '', '', '2016-02-29 17:00:42', '2016-02-29 17:00:42'),
(35, '1', 0, '', '', '2016-02-29 17:00:54', '2016-02-29 17:00:54'),
(36, '1', 0, '', '', '2016-02-29 17:01:04', '2016-02-29 17:01:04'),
(37, '1', 0, '', '', '2016-02-29 17:01:17', '2016-02-29 17:01:17'),
(38, '1', 0, '', '', '2016-02-29 17:01:29', '2016-02-29 17:01:29'),
(39, '1', 0, '', '', '2016-02-29 17:01:41', '2016-02-29 17:01:41'),
(40, '1', 0, '', '', '2016-02-29 17:01:53', '2016-02-29 17:01:53'),
(41, '1', 0, '', '', '2016-02-29 17:02:06', '2016-02-29 17:02:06'),
(42, '1', 0, '', '', '2016-02-29 17:02:16', '2016-02-29 17:02:16'),
(43, '1', 0, '', '', '2016-02-29 17:02:39', '2016-02-29 17:02:39'),
(44, '1', 0, '', '', '2016-02-29 17:02:50', '2016-02-29 17:02:50'),
(45, '1', 0, '', '', '2016-02-29 17:03:02', '2016-02-29 17:03:02'),
(46, '1', 0, '', '', '2016-02-29 17:03:15', '2016-02-29 17:03:15'),
(47, '1', 0, '', '', '2016-02-29 17:03:27', '2016-02-29 17:03:27'),
(48, '1', 0, '', '', '2016-02-29 17:03:38', '2016-02-29 17:03:38'),
(49, '1', 0, '', '', '2016-02-29 17:03:50', '2016-02-29 17:03:50'),
(50, '1', 0, '', '', '2016-02-29 17:04:07', '2016-02-29 17:04:07'),
(51, '1', 0, '', '', '2016-02-29 17:04:17', '2016-02-29 17:04:17'),
(52, '1', 0, '', '', '2016-02-29 17:04:27', '2016-02-29 17:04:27'),
(53, '1', 0, '', '', '2016-02-29 17:04:38', '2016-02-29 17:04:38'),
(54, '1', 0, '', '', '2016-02-29 17:04:50', '2016-02-29 17:04:50'),
(55, '1', 0, '', '', '2016-02-29 17:05:00', '2016-02-29 17:05:00'),
(56, '1', 0, '', '', '2016-02-29 17:05:11', '2016-02-29 17:05:11'),
(57, '1', 0, '', '', '2016-02-29 17:05:22', '2016-02-29 17:05:22'),
(58, '1', 0, '', '', '2016-02-29 17:05:33', '2016-02-29 17:05:33'),
(59, '1', 0, '', '', '2016-02-29 17:05:46', '2016-02-29 17:05:46'),
(60, '1', 0, '', '', '2016-02-29 17:06:49', '2016-02-29 17:06:49'),
(61, '1', 0, '', '', '2016-02-29 17:07:00', '2016-02-29 17:07:00'),
(62, '1', 0, '', '', '2016-02-29 17:07:10', '2016-02-29 17:07:10'),
(63, '1', 0, '', '', '2016-02-29 17:07:22', '2016-02-29 17:07:22'),
(64, '1', 0, '', '', '2016-02-29 17:07:52', '2016-02-29 17:07:52'),
(65, '1', 0, '', '', '2016-02-29 17:08:04', '2016-02-29 17:08:04'),
(66, '1', 0, '', '', '2016-02-29 17:08:14', '2016-02-29 17:08:14'),
(67, '1', 0, '', '', '2016-02-29 17:08:25', '2016-02-29 17:08:25'),
(68, '1', 0, '', '', '2016-02-29 17:08:36', '2016-02-29 17:08:36'),
(69, '1', 0, '', '', '2016-02-29 17:08:47', '2016-02-29 17:08:47'),
(70, '1', 0, '', '', '2016-02-29 17:08:59', '2016-02-29 17:08:59'),
(71, '1', 0, '', '', '2016-02-29 17:09:11', '2016-02-29 17:09:11'),
(72, '1', 0, '', '', '2016-02-29 17:09:22', '2016-02-29 17:09:22'),
(73, '1', 0, '', '', '2016-02-29 17:09:33', '2016-02-29 17:09:33'),
(74, '1', 0, '', '', '2016-02-29 17:09:46', '2016-02-29 17:09:46'),
(75, '1', 0, '', '', '2016-02-29 17:09:59', '2016-02-29 17:09:59'),
(76, '1', 0, '', '', '2016-02-29 17:10:11', '2016-02-29 17:10:11'),
(77, '1', 0, '', '', '2016-02-29 17:10:23', '2016-02-29 17:10:23'),
(78, '1', 0, '', '', '2016-02-29 17:10:34', '2016-02-29 17:10:34'),
(79, '1', 0, '', '', '2016-02-29 17:10:50', '2016-02-29 17:10:50'),
(80, '1', 0, '', '', '2016-02-29 17:11:01', '2016-02-29 17:11:01'),
(81, '1', 0, '', '', '2016-02-29 17:11:15', '2016-02-29 17:11:15'),
(82, '1', 0, '', '', '2016-02-29 17:11:26', '2016-02-29 17:11:26'),
(83, '1', 0, '', '', '2016-02-29 17:13:10', '2016-02-29 17:13:10'),
(84, '1', 0, '', '', '2016-02-29 17:13:48', '2016-02-29 17:13:48'),
(85, '1', 0, '', '', '2016-02-29 17:16:42', '2016-02-29 17:16:42'),
(86, '1', 0, '', '', '2016-02-29 17:16:53', '2016-02-29 17:16:53'),
(87, '1', 0, '', '', '2016-02-29 17:17:04', '2016-02-29 17:17:04'),
(88, '1', 0, '', '', '2016-02-29 17:17:17', '2016-02-29 17:17:17'),
(89, '1', 0, '', '', '2016-02-29 17:17:28', '2016-02-29 17:17:28'),
(90, '1', 0, '', '', '2016-02-29 17:17:40', '2016-02-29 17:17:40'),
(91, '1', 0, '', '', '2016-02-29 17:17:52', '2016-02-29 17:17:52'),
(92, '1', 0, '', '', '2016-02-29 17:18:04', '2016-02-29 17:18:04'),
(93, '1', 0, '', '', '2016-02-29 17:18:52', '2016-02-29 17:18:52'),
(94, '1', 0, '', '', '2016-02-29 17:19:03', '2016-02-29 17:19:03'),
(95, '1', 0, '', '', '2016-02-29 17:19:28', '2016-02-29 17:19:28'),
(96, '1', 0, '', '', '2016-02-29 17:19:39', '2016-02-29 17:19:39'),
(97, '1', 0, '', '', '2016-02-29 17:19:51', '2016-02-29 17:19:51'),
(98, '1', 0, '', '', '2016-02-29 17:20:04', '2016-02-29 17:20:04'),
(99, '1', 0, '', '', '2016-02-29 17:20:15', '2016-04-18 13:11:04'),
(100, '1', 0, '', '', '2016-02-29 17:20:28', '2016-02-29 17:20:28'),
(101, '1', 0, '', '', '2016-02-29 17:20:40', '2016-02-29 17:20:40'),
(102, '1', 0, '', '', '2016-02-29 17:20:58', '2016-02-29 17:20:58'),
(103, '1', 0, '', '', '2016-02-29 17:21:08', '2016-02-29 17:21:08'),
(104, '1', 0, '', '', '2016-02-29 17:21:19', '2016-02-29 17:21:19'),
(105, '1', 0, '', '', '2016-02-29 17:21:57', '2016-02-29 17:21:57'),
(106, '1', 0, '', '', '2016-02-29 17:22:07', '2016-02-29 17:22:07'),
(107, '1', 0, '', '', '2016-02-29 17:22:17', '2016-02-29 17:22:17'),
(108, '1', 0, '', '', '2016-02-29 17:22:29', '2016-02-29 17:22:29'),
(109, '1', 0, '', '', '2016-02-29 17:22:42', '2016-02-29 17:22:42'),
(110, '1', 0, '', '', '2016-02-29 17:22:53', '2016-02-29 17:22:53'),
(111, '1', 0, '', '', '2016-02-29 17:23:03', '2016-02-29 17:23:03'),
(112, '1', 0, '', '', '2016-02-29 17:23:54', '2016-02-29 17:23:54'),
(113, '1', 0, '', '', '2016-02-29 17:24:09', '2016-02-29 17:24:09'),
(114, '1', 0, '', '', '2016-02-29 17:24:20', '2016-02-29 17:24:20'),
(115, '1', 0, '', '', '2016-02-29 17:24:30', '2016-02-29 17:24:30'),
(116, '1', 0, '', '', '2016-02-29 17:24:43', '2016-02-29 17:24:43'),
(117, '1', 0, '', '', '2016-02-29 17:24:54', '2016-02-29 17:24:54'),
(118, '1', 0, '', '', '2016-02-29 17:25:05', '2016-02-29 17:25:05'),
(119, '1', 0, '', '', '2016-02-29 17:25:17', '2016-02-29 17:25:17'),
(120, '1', 0, '', '', '2016-02-29 17:25:36', '2016-02-29 17:25:36'),
(121, '1', 0, '', '', '2016-02-29 17:25:56', '2016-02-29 17:25:56'),
(122, '1', 0, '', '', '2016-02-29 17:26:06', '2016-02-29 17:26:06'),
(123, '1', 0, '', '', '2016-02-29 17:26:16', '2016-02-29 17:26:16'),
(124, '1', 0, '', '', '2016-02-29 17:26:28', '2016-02-29 17:26:28'),
(125, '1', 0, '', '', '2016-02-29 17:26:39', '2016-02-29 17:26:39'),
(126, '1', 0, '', '', '2016-02-29 17:26:52', '2016-02-29 17:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `ev_location_translation`
--

CREATE TABLE IF NOT EXISTS `ev_location_translation` (
  `location_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `location_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`location_translation_id`),
  KEY `location_translation_location_id_foreign` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=253 ;

--
-- Dumping data for table `ev_location_translation`
--

INSERT INTO `ev_location_translation` (`location_translation_id`, `location_id`, `language_id`, `location_name`) VALUES
(5, 3, 1, 'Ambriz'),
(6, 3, 2, 'Ambriz'),
(7, 4, 1, 'Andulo'),
(8, 4, 2, 'Andulo'),
(9, 5, 1, 'Bailundo'),
(10, 5, 2, 'Bailundo'),
(11, 6, 1, 'Balombo'),
(12, 6, 2, 'Balombo'),
(13, 7, 1, 'Baía Farta'),
(14, 7, 2, 'Baía Farta'),
(15, 8, 1, 'Benguela'),
(16, 8, 2, 'Benguela'),
(17, 9, 1, 'Bibala (Vila Arriaga)'),
(18, 9, 2, 'Bibala (Vila Arriaga)'),
(19, 10, 1, 'Bimbe'),
(20, 10, 2, 'Bimbe'),
(21, 11, 1, 'Biula'),
(22, 11, 2, 'Biula'),
(23, 12, 1, 'Bungo'),
(24, 12, 2, 'Bungo'),
(25, 13, 1, 'Cabamba'),
(26, 13, 2, 'Cabamba'),
(27, 14, 1, 'Cabinda (Kabinda)'),
(28, 14, 2, 'Cabinda (Kabinda)'),
(29, 15, 1, 'Caboledo'),
(30, 15, 2, 'Caboledo'),
(31, 16, 1, 'Cacolo'),
(32, 16, 2, 'Cacolo'),
(33, 17, 1, 'Caconda'),
(34, 17, 2, 'Caconda'),
(35, 18, 1, 'Caculama'),
(36, 18, 2, 'Caculama'),
(37, 19, 1, 'Cacuso'),
(38, 19, 2, 'Cacuso'),
(39, 20, 1, 'Cafunfo'),
(40, 20, 2, 'Cafunfo'),
(41, 21, 1, 'Cahama'),
(42, 21, 2, 'Cahama'),
(43, 22, 1, 'Caiengue'),
(44, 22, 2, 'Caiengue'),
(45, 23, 1, 'Caimbambo'),
(46, 23, 2, 'Caimbambo'),
(47, 24, 1, 'Calandala'),
(48, 24, 2, 'Calandala'),
(49, 25, 1, 'Calenga (Kalenga)'),
(50, 25, 2, 'Calenga (Kalenga)'),
(51, 26, 1, 'Calonda'),
(52, 26, 2, 'Calonda'),
(53, 27, 1, 'Calucinga'),
(54, 27, 2, 'Calucinga'),
(55, 28, 1, 'Calulo'),
(56, 28, 2, 'Calulo'),
(57, 29, 1, 'Caluquembe (Kalukembe)'),
(58, 29, 2, 'Caluquembe (Kalukembe)'),
(59, 30, 1, 'Camabatela'),
(60, 30, 2, 'Camabatela'),
(61, 31, 1, 'Camacupa (General Machado, Vila General Machado)'),
(62, 31, 2, 'Camacupa (General Machado, Vila General Machado)'),
(63, 32, 1, 'Camanongue (Buçaco, Kamenongue)'),
(64, 32, 2, 'Camanongue (Buçaco, Kamenongue)'),
(65, 33, 1, 'Camaxilo'),
(66, 33, 2, 'Camaxilo'),
(67, 34, 1, 'Cambambe'),
(68, 34, 2, 'Cambambe'),
(69, 35, 1, 'Cambongue'),
(70, 35, 2, 'Cambongue'),
(71, 36, 1, 'Cambundi (Nova Gaia, Catembo)'),
(72, 36, 2, 'Cambundi (Nova Gaia, Catembo)'),
(73, 37, 1, 'Camissombo (Veríssimo Sarmento)'),
(74, 37, 2, 'Camissombo (Veríssimo Sarmento)'),
(75, 38, 1, 'Candjimbe'),
(76, 38, 2, 'Candjimbe'),
(77, 39, 1, 'Cangamba (Vila de Aljustrel)'),
(78, 39, 2, 'Cangamba (Vila de Aljustrel)'),
(79, 40, 1, 'Cangandala'),
(80, 40, 2, 'Cangandala'),
(81, 41, 1, 'Cangumbe'),
(82, 41, 2, 'Cangumbe'),
(83, 42, 1, 'Capelongo (Cubango, Kuvango)'),
(84, 42, 2, 'Capelongo (Cubango, Kuvango)'),
(85, 43, 1, 'Capenda Camulemba'),
(86, 43, 2, 'Capenda Camulemba'),
(87, 44, 1, 'Capulo'),
(88, 44, 2, 'Capulo'),
(89, 45, 1, 'Cassanguide (Cassanguidi)'),
(90, 45, 2, 'Cassanguide (Cassanguidi)'),
(91, 46, 1, 'Cassongue'),
(92, 46, 2, 'Cassongue'),
(93, 47, 1, 'Catabola (Katabola, Chissamba, Nova Sintra)'),
(94, 47, 2, 'Catabola (Katabola, Chissamba, Nova Sintra)'),
(95, 48, 1, 'Catacanha'),
(96, 48, 2, 'Catacanha'),
(97, 49, 1, 'Catchiungo (Katchiungo, Katchungo, Cantchiungo)'),
(98, 49, 2, 'Catchiungo (Katchiungo, Katchungo, Cantchiungo)'),
(99, 50, 1, 'Catumbela'),
(100, 50, 2, 'Catumbela'),
(101, 51, 1, 'Caungula'),
(102, 51, 2, 'Caungula'),
(103, 52, 1, 'Caxita Cameia'),
(104, 52, 2, 'Caxita Cameia'),
(105, 53, 1, 'Caxito'),
(106, 53, 2, 'Caxito'),
(107, 54, 1, 'Cazaje (Cazage)'),
(108, 54, 2, 'Cazaje (Cazage)'),
(109, 55, 1, 'Cazombo'),
(110, 55, 2, 'Cazombo'),
(111, 56, 1, 'Caála (Kaala, Kahala, Robert Williams, Vila Robert Williams)'),
(112, 56, 2, 'Caála (Kaala, Kahala, Robert Williams, Vila Robert Williams)'),
(113, 57, 1, 'Cela'),
(114, 57, 2, 'Cela'),
(115, 58, 1, 'Chiange (Gambos)'),
(116, 58, 2, 'Chiange (Gambos)'),
(117, 59, 1, 'Chibanda'),
(118, 59, 2, 'Chibanda'),
(119, 60, 1, 'Chibemba'),
(120, 60, 2, 'Chibemba'),
(121, 61, 1, 'Chibia'),
(122, 61, 2, 'Chibia'),
(123, 62, 1, 'Chicala'),
(124, 62, 2, 'Chicala'),
(125, 63, 1, 'Chingufo'),
(126, 63, 2, 'Chingufo'),
(127, 64, 1, 'Chipindo'),
(128, 64, 2, 'Chipindo'),
(129, 65, 1, 'Chissamba'),
(130, 65, 2, 'Chissamba'),
(131, 66, 1, 'Chitado'),
(132, 66, 2, 'Chitado'),
(133, 67, 1, 'Chitembo'),
(134, 67, 2, 'Chitembo'),
(135, 68, 1, 'Coemba'),
(136, 68, 2, 'Coemba'),
(137, 69, 1, 'Colui (Candingo)'),
(138, 69, 2, 'Colui (Candingo)'),
(139, 70, 1, 'Conda'),
(140, 70, 2, 'Conda'),
(141, 71, 1, 'Cota'),
(142, 71, 2, 'Cota'),
(143, 72, 1, 'Coutada'),
(144, 72, 2, 'Coutada'),
(145, 73, 1, 'Cuangar'),
(146, 73, 2, 'Cuangar'),
(147, 74, 1, 'Cuango-Luzamba (Kwango, Luzamba, Cuango)'),
(148, 74, 2, 'Cuango-Luzamba (Kwango, Luzamba, Cuango)'),
(149, 75, 1, 'Cuasa'),
(150, 75, 2, 'Cuasa'),
(151, 76, 1, 'Cubal'),
(152, 76, 2, 'Cubal'),
(153, 77, 1, 'Cuchi'),
(154, 77, 2, 'Cuchi'),
(155, 78, 1, 'Cuilo'),
(156, 78, 2, 'Cuilo'),
(157, 79, 1, 'Cuima'),
(158, 79, 2, 'Cuima'),
(159, 80, 1, 'Cuimba'),
(160, 80, 2, 'Cuimba'),
(161, 81, 1, 'Cuito Cuanavale'),
(162, 81, 2, 'Cuito Cuanavale'),
(163, 82, 1, 'Cuvelai'),
(164, 82, 2, 'Cuvelai'),
(165, 83, 1, 'Luanda'),
(166, 83, 2, 'Luanda'),
(167, 84, 1, 'Songo'),
(168, 84, 2, 'Songo'),
(169, 85, 1, 'Dala'),
(170, 85, 2, 'Dala'),
(171, 86, 1, 'Damba'),
(172, 86, 2, 'Damba'),
(173, 87, 1, 'Didimbo'),
(174, 87, 2, 'Didimbo'),
(175, 88, 1, 'Dombe Grande'),
(176, 88, 2, 'Dombe Grande'),
(177, 89, 1, 'Dondo'),
(178, 89, 2, 'Dondo'),
(179, 90, 1, 'Dongo'),
(180, 90, 2, 'Dongo'),
(181, 91, 1, 'Dundo (Chitato)'),
(182, 91, 2, 'Dundo (Chitato)'),
(183, 92, 1, 'Ekunha (Vila Flor)'),
(184, 92, 2, 'Ekunha (Vila Flor)'),
(185, 93, 1, 'Folgares'),
(186, 93, 2, 'Folgares'),
(187, 94, 1, 'Funda'),
(188, 94, 2, 'Funda'),
(189, 95, 1, 'Gabela'),
(190, 95, 2, 'Gabela'),
(191, 96, 1, 'Galo'),
(192, 96, 2, 'Galo'),
(193, 97, 1, 'Ganda'),
(194, 97, 2, 'Ganda'),
(195, 98, 1, 'Golungo Alto'),
(196, 98, 2, 'Golungo Alto'),
(197, 99, 1, 'Guri'),
(198, 99, 2, 'Guri'),
(199, 100, 1, 'Huambo (Nova Lisboa)'),
(200, 100, 2, 'Huambo (Nova Lisboa)'),
(201, 101, 1, 'Humpata'),
(202, 101, 2, 'Humpata'),
(203, 102, 1, 'Jamba'),
(204, 102, 2, 'Jamba'),
(205, 103, 1, 'Jamba'),
(206, 103, 2, 'Jamba'),
(207, 104, 1, 'Kuito (Bié, Silva Porto)'),
(208, 104, 2, 'Kuito (Bié, Silva Porto)'),
(209, 105, 1, 'Leúa'),
(210, 105, 2, 'Leúa'),
(211, 106, 1, 'Lobito'),
(212, 106, 2, 'Lobito'),
(213, 107, 1, 'Lombe'),
(214, 107, 2, 'Lombe'),
(215, 108, 1, 'Longa'),
(216, 108, 2, 'Longa'),
(217, 109, 1, 'Longonjo'),
(218, 109, 2, 'Longonjo'),
(219, 110, 1, 'Luacano (Dilolo)'),
(220, 110, 2, 'Luacano (Dilolo)'),
(221, 111, 1, 'Luanda (Loanda, São Paulo de Loanda)'),
(222, 111, 2, 'Luanda (Loanda, São Paulo de Loanda)'),
(223, 112, 1, 'Luau'),
(224, 112, 2, 'Luau'),
(225, 113, 1, 'Luau (Vila Teixeira de Sousa)'),
(226, 113, 2, 'Luau (Vila Teixeira de Sousa)'),
(227, 114, 1, 'Lubango (Sá da Bandeira)'),
(228, 114, 2, 'Lubango (Sá da Bandeira)'),
(229, 115, 1, 'Lucala'),
(230, 115, 2, 'Lucala'),
(231, 116, 1, 'Lucapa (Lukapa)'),
(232, 116, 2, 'Lucapa (Lukapa)'),
(233, 117, 1, 'Lucusse'),
(234, 117, 2, 'Lucusse'),
(235, 118, 1, 'Luena (Lwena, Luso, Vila Luso)'),
(236, 118, 2, 'Luena (Lwena, Luso, Vila Luso)'),
(237, 119, 1, 'Luiana'),
(238, 119, 2, 'Luiana'),
(239, 120, 1, 'Luimbale (Londuimbali)'),
(240, 120, 2, 'Luimbale (Londuimbali)'),
(241, 121, 1, 'Luma Cassao'),
(242, 121, 2, 'Luma Cassao'),
(243, 122, 1, 'Lumbala (Lumbala N''guimbo)'),
(244, 122, 2, 'Lumbala (Lumbala N''guimbo)'),
(245, 123, 1, 'Lumeje'),
(246, 123, 2, 'Lumeje'),
(247, 124, 1, 'Luremo'),
(248, 124, 2, 'Luremo'),
(249, 125, 1, 'Luxilo'),
(250, 125, 2, 'Luxilo'),
(251, 126, 1, 'Lândana (Cacongo)'),
(252, 126, 2, 'Lândana (Cacongo)');

-- --------------------------------------------------------

--
-- Table structure for table `ev_messages`
--

CREATE TABLE IF NOT EXISTS `ev_messages` (
  `msg_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `msg_parent_id` bigint(22) NOT NULL DEFAULT '0',
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `hall_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `msg_datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `msgpost_datetime` datetime DEFAULT NULL,
  `msgreply_datetime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `msg_is_replied` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_viewed` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Dumping data for table `ev_messages`
--

INSERT INTO `ev_messages` (`msg_id`, `msg_parent_id`, `from_user_id`, `to_user_id`, `hall_id`, `message`, `msg_datetime`, `msgpost_datetime`, `msgreply_datetime`, `msg_is_replied`, `is_viewed`) VALUES
(34, 0, 27, 7, 43, 'Great hall', '2016-03-26 09:22:58', '2016-03-26 11:56:46', '', 'N', 'Y'),
(41, 34, 27, 7, 43, 'tell me', '2016-03-26 11:05:15', NULL, '2016-03-26 11:05:15', 'N', 'Y'),
(42, 34, 7, 27, 43, 'Ok boxx', '2016-03-26 11:05:56', NULL, '2016-03-26 11:05:56', 'N', 'Y'),
(43, 34, 27, 7, 43, 'oye', '2016-03-26 11:20:35', NULL, '2016-03-26 11:20:35', 'N', 'Y'),
(44, 34, 7, 27, 43, 'calipso', '2016-03-26 11:21:24', NULL, '2016-03-26 11:21:24', 'N', 'Y'),
(45, 34, 7, 27, 43, 'oppium', '2016-03-26 11:22:28', NULL, '2016-03-26 11:22:28', 'N', 'Y'),
(46, 0, 7, 27, 35, 'hello rasmous', '2016-03-26 11:54:06', '2016-03-28 07:51:12', '', 'N', 'Y'),
(47, 46, 27, 7, 35, 'tell me boss.', '2016-03-26 11:56:17', NULL, '2016-03-26 11:56:17', 'N', 'Y'),
(48, 34, 27, 7, 43, 'how are you.', '2016-03-26 11:56:46', NULL, '2016-03-26 11:56:46', 'N', 'N'),
(49, 46, 27, 7, 35, 'hello boss', '2016-03-28 06:23:22', NULL, '2016-03-28 06:23:22', 'N', 'N'),
(50, 46, 27, 7, 35, 'Hello sir, tell me.', '2016-03-28 06:49:30', NULL, '2016-03-28 06:49:30', 'N', 'N'),
(51, 46, 27, 7, 35, 'okays', '2016-03-28 07:51:12', NULL, '2016-03-28 07:51:12', 'N', 'N'),
(52, 0, 38, 36, 45, 'test message for Anjan test Hall 010416', '2016-04-01 13:50:04', '2016-04-01 13:52:23', '', 'N', 'Y'),
(53, 52, 36, 38, 45, 'Reply... test message for Anjan test Hall 010416', '2016-04-01 13:51:03', NULL, '2016-04-01 13:51:03', 'N', 'Y'),
(54, 52, 38, 36, 45, 'Reply1... test message for Anjan test Hall 010416', '2016-04-01 13:52:23', NULL, '2016-04-01 13:52:23', 'N', 'Y'),
(55, 0, 38, 37, 48, 'Test Enquiry from Bimal for Sania Test Hall 040416... Test Enquiry from Bimal for Sania Test Hall 040416... ', '2016-04-04 09:39:23', '2016-04-04 09:39:23', '', 'N', 'Y'),
(56, 0, 1, 36, 71, 'Hello I wnat to book this hall test test.......', '2016-04-07 08:42:26', '2016-04-07 08:42:26', '', 'N', 'N'),
(57, 0, 1, 36, 71, 'test the enquiry system.', '2016-04-07 08:47:06', '2016-04-07 08:47:06', '', 'N', 'N'),
(58, 0, 1, 36, 71, 'sdfrgdfeh fghjfg', '2016-04-07 08:49:13', '2016-04-07 08:49:13', '', 'N', 'N'),
(59, 0, 1, 36, 71, 'fdf dfghty nfhghfg', '2016-04-07 08:51:16', '2016-04-07 08:51:16', '', 'N', 'N'),
(60, 0, 1, 36, 71, 'tretre fgjnfghjfghj', '2016-04-07 08:52:26', '2016-04-07 08:52:26', '', 'N', 'N'),
(61, 0, 1, 36, 71, 'tretre fgjnfghjfghj', '2016-04-07 08:53:18', '2016-04-07 08:53:18', '', 'N', 'N'),
(62, 0, 1, 36, 71, 'tretre fgjnfghjfghj', '2016-04-07 08:53:39', '2016-04-07 08:53:39', '', 'N', 'N'),
(63, 0, 1, 36, 71, 'how to do?', '2016-04-07 08:56:37', '2016-04-08 12:01:27', '', 'N', 'N'),
(64, 63, 1, 36, 71, 'Book the hall...:)))))', '2016-04-08 11:55:06', NULL, '2016-04-08 11:55:06', 'N', 'N'),
(65, 63, 1, 36, 71, 'dsgdfg dfrgdfg', '2016-04-08 11:57:59', NULL, '2016-04-08 11:57:59', 'N', 'N'),
(66, 63, 1, 36, 71, 'dsfert fghfgj', '2016-04-08 12:00:30', NULL, '2016-04-08 12:00:30', 'N', 'N'),
(67, 63, 1, 36, 71, 'adsef dfsvgfsg', '2016-04-08 12:01:27', NULL, '2016-04-08 12:01:27', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `ev_migrations`
--

CREATE TABLE IF NOT EXISTS `ev_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ev_migrations`
--

INSERT INTO `ev_migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_11_125637_create_client_table', 1),
('2016_02_15_120359_create_hall_type_table', 1),
('2016_02_15_121211_create_hall_type_translation_table', 1),
('2016_02_16_061419_create_posts_table', 1),
('2016_02_16_064140_create_admins_table', 1),
('2016_02_18_120700_create_location_table', 1),
('2016_02_20_073623_create_accommodation_table', 1),
('2016_02_20_091122_create_addon_table', 1),
('2016_02_20_095513_create_hall_table', 1),
('2016_02_22_084346_create_price_table', 1),
('2016_02_24_063055_Province', 2),
('2016_02_24_063846_Subscription', 2),
('2016_02_24_100036_create_hallimages_table', 3),
('2016_02_25_061325_create_advertisement_table', 4),
('2016_02_25_074619_create_hall_addon_table', 5),
('2016_02_25_150203_create_hall_accommodation_relation_table', 6),
('2016_02_26_100253_create_hall_type_relation_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ev_news`
--

CREATE TABLE IF NOT EXISTS `ev_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_image` varchar(255) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `published_date` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ev_news`
--

INSERT INTO `ev_news` (`id`, `news_image`, `created_by`, `order_id`, `is_active`, `published_date`, `created_at`, `updated_at`) VALUES
(5, 'news_1.jpg', 'Albert', 1, '1', '2016-03-17', '2016-03-16 14:39:10', '2016-04-06 19:16:11'),
(6, '5003e6f69789c_music_4.gif', 'Admin', 2, '1', '2016-03-16', '2016-03-16 21:44:45', '2016-04-05 20:27:26'),
(7, 'citytech_mini.png', 'Thomas', 3, '1', '2016-03-17', '2016-03-17 15:05:30', '2016-03-17 15:05:30'),
(8, '3.jpg', 'Kanchan', 4, '1', '0000-00-00', '2016-03-18 15:08:42', '2016-03-18 16:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `ev_newsletter`
--

CREATE TABLE IF NOT EXISTS `ev_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ev_newsletter`
--

INSERT INTO `ev_newsletter` (`newsletter_id`, `newsletter_email`, `created_at`) VALUES
(1, 'abc@mail.com', '2016-04-05 23:16:52'),
(2, 'myabc@mail.com', '2016-04-06 13:49:18'),
(3, 'abc@mail.comn', '2016-04-06 15:00:00'),
(4, 'citytech.tester@gmail.com', '2016-04-06 20:55:33'),
(5, 'xyz@gmail.com', '2016-04-06 22:11:41'),
(6, 'asd@gmail.com', '2016-04-06 22:19:03'),
(7, 'mno@gmail.com', '2016-04-06 22:20:44'),
(8, 'klm@gmail.com', '2016-04-06 22:24:30'),
(9, 'qwe@gmail.com', '2016-04-06 22:30:10'),
(10, 'admin@ja.com', '2016-04-06 22:38:32'),
(11, 'abc235@mail.com', '2016-04-07 14:31:31'),
(12, 'admin123@ja.com', '2016-04-07 14:32:35'),
(13, 'abc125@mail.com', '2016-04-07 14:40:24'),
(14, 'abc589@mail.com', '2016-04-07 15:34:01'),
(15, 'abc12356@mail.com', '2016-04-07 16:26:58'),
(16, 'abc23566@mail.com', '2016-04-07 16:27:16'),
(17, 'sdffgdfg@fgh.kl', '2016-05-10 12:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `ev_news_translation`
--

CREATE TABLE IF NOT EXISTS `ev_news_translation` (
  `news_translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `news_title` tinytext NOT NULL,
  `news_content` text NOT NULL,
  PRIMARY KEY (`news_translation_id`),
  KEY `FK_P15_P16_Cascade` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ev_news_translation`
--

INSERT INTO `ev_news_translation` (`news_translation_id`, `news_id`, `language_id`, `news_title`, `news_content`) VALUES
(7, 5, 1, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'),
(8, 5, 2, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.'),
(9, 6, 1, 'Lorem Ipsum  2', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'),
(10, 6, 2, 'Lorem Ipsum  2', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>'),
(11, 7, 1, 'Test', '<p>Test</p>'),
(12, 7, 2, 'Test', '<p>Test</p>'),
(13, 8, 1, 'test', ''),
(14, 8, 2, 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `ev_password_resets`
--

CREATE TABLE IF NOT EXISTS `ev_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ev_password_resets`
--

INSERT INTO `ev_password_resets` (`email`, `token`, `created_at`) VALUES
('kais@gmail.com', '7bc3f0963e9b6f4de3b5e0df25f24b64055990036aac42681a082260e0e3fa32', '2016-03-09 18:18:33'),
('citynow.test@gmail.com', '54bb209a2f4accc9a2f03bd2fa2be3de71b32f5f6cea4813cd478cf3cd193b67', '2016-04-01 17:22:54'),
('ranjit.citytech@gmail.com', '930db4ec05bccb0d0c433010deb4ee51bc12ec6fa6e77e3f4c8876906bd04cfd', '2016-04-04 16:49:41'),
('asdf@asd.lk', '86ae6b1d13fa5362add0f34fe72be195cc832d835227e124aee5d81fa92255a2', '2016-05-10 12:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `ev_payments`
--

CREATE TABLE IF NOT EXISTS `ev_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_number` varchar(30) NOT NULL COMMENT 'Site Payment Number',
  `transaction_id` varchar(150) NOT NULL COMMENT 'Paypal Transaction ID / Other Transaction ID',
  `payment_date` datetime NOT NULL COMMENT 'Transaction Date',
  `payment_amount` double(8,2) NOT NULL,
  `payment_for` enum('S','B','F') NOT NULL COMMENT 'S-sunscription,B-booking,F-feature',
  `payment_for_id` int(11) NOT NULL COMMENT 'Subscription ID/ Booking ID/ Feature ID',
  `payment_status` enum('S','F','P') NOT NULL DEFAULT 'P' COMMENT 'S-Completed/F-Failed/P-(other)Pending',
  `payment_by_id` int(11) NOT NULL COMMENT 'Always User ID, If Admin payment for User ID ',
  `payment_method` enum('M','O') NOT NULL DEFAULT 'O' COMMENT 'O-online,M-manual payments',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `ev_payments`
--

INSERT INTO `ev_payments` (`payment_id`, `payment_number`, `transaction_id`, `payment_date`, `payment_amount`, `payment_for`, `payment_for_id`, `payment_status`, `payment_by_id`, `payment_method`) VALUES
(35, '57077fb2ad2ff', '0MU40779N63475437', '2016-04-08 09:53:54', 100.00, 'S', 15, 'P', 1, 'O'),
(36, '57077fb2ad2ff', '0MU40779N63475437', '2016-04-08 09:55:06', 150.00, 'F', 11, 'P', 1, 'O'),
(37, '570b3fa945fa1', '', '2016-04-11 06:09:45', 100.00, 'S', 16, 'P', 27, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `ev_position`
--

CREATE TABLE IF NOT EXISTS `ev_position` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ev_position`
--

INSERT INTO `ev_position` (`id`, `position_name`, `size`) VALUES
(1, 'Home Page Top', '50 x 50'),
(2, 'Home page bottom', '100 x 100');

-- --------------------------------------------------------

--
-- Table structure for table `ev_price_range`
--

CREATE TABLE IF NOT EXISTS `ev_price_range` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` int(11) NOT NULL,
  `lower_range` int(11) NOT NULL,
  `upper_range` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ev_price_range`
--

INSERT INTO `ev_price_range` (`id`, `currency_id`, `lower_range`, `upper_range`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(3, 1, 501, 1000, 1, 1, '2016-02-23 20:34:44', '2016-03-21 18:29:03'),
(4, 2, 0, 10, 1, 2, '2016-02-25 21:52:33', '2016-04-05 20:14:53'),
(5, 1, 1001, 2000, 1, 3, '2016-02-26 17:42:38', '2016-03-21 19:14:49'),
(6, 1, 2001, 2500, 0, 4, '2016-02-26 17:43:33', '2016-04-04 21:13:04'),
(7, 2, 11, 100, 1, 5, '2016-02-26 17:44:27', '2016-04-05 20:15:51'),
(8, 1, 2501, 2700, 1, 6, '2016-04-04 21:18:25', '2016-04-04 21:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `ev_price_range_translation`
--

CREATE TABLE IF NOT EXISTS `ev_price_range_translation` (
  `price_range_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price_range_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `price_range_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`price_range_translation_id`),
  KEY `price_range_translation_price_range_id_foreign` (`price_range_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ev_price_range_translation`
--

INSERT INTO `ev_price_range_translation` (`price_range_translation_id`, `price_range_id`, `language_id`, `price_range_title`) VALUES
(3, 3, 1, '501-1000 AOA'),
(4, 3, 2, '501-1000 AOA'),
(5, 4, 1, '0-10 EUR'),
(6, 4, 2, '0-10 EUR'),
(7, 5, 1, '1001-2000 AOA'),
(8, 5, 2, '1001-2000 AOA'),
(9, 6, 1, '2001-2500 AOA'),
(10, 6, 2, '2001-2500 AOA'),
(11, 7, 1, '11-100 EUR'),
(12, 7, 2, '11-100 EUR'),
(13, 8, 1, '2501 - 2700 AOA'),
(14, 8, 2, '2501 - 2700 EUR');

-- --------------------------------------------------------

--
-- Table structure for table `ev_province`
--

CREATE TABLE IF NOT EXISTS `ev_province` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ev_province`
--

INSERT INTO `ev_province` (`id`, `province_name`) VALUES
(1, 'Bengo'),
(2, 'Benguela'),
(3, 'Bié'),
(4, 'Cabinda'),
(5, 'Cuando Cubango'),
(6, 'Cuanza Norte'),
(7, 'Cuanza Sul'),
(8, 'Cunene'),
(9, 'Huambo'),
(10, 'Huíla'),
(11, 'Luanda'),
(12, 'Lunda Norte'),
(13, 'Lunda Sul'),
(14, 'Malanje'),
(15, 'Moxico'),
(16, 'Namibe'),
(17, 'Uíge'),
(18, 'Zaire');

-- --------------------------------------------------------

--
-- Table structure for table `ev_review`
--

CREATE TABLE IF NOT EXISTS `ev_review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `hall_id` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `review_rating` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`review_id`),
  KEY `FK_T19_T20_Cascade` (`hall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `ev_review`
--

INSERT INTO `ev_review` (`review_id`, `hall_id`, `user_id`, `order_id`, `review_text`, `review_rating`, `is_active`, `created_at`) VALUES
(2, 23, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum arcu non nisl facilisis rutrum. Cras tristique lacus in nisl vehicula, vel pretium sapien suscipit. Phasellus enim purus, posuere non tempor in, sodales cursus metus. Etiam venenatis, leo nec placerat dictum, diam metus posuere tellus, ac viverra massa risus quis ligula. Nullam aliquam lobortis tortor sit amet venenatis. Morbi malesuada odio at augue ornare, non malesuada purus commodo. Quisque iaculis vitae libero vitae pellentesque.', 3, '0', '2016-03-11 07:36:36'),
(3, 22, 27, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum arcu non nisl facilisis rutrum. Cras tristique lacus in nisl vehicula, vel pretium sapien suscipit. Phasellus enim purus, posuere non tempor in, sodales cursus metus. Etiam venenatis, leo nec placerat dictum, diam metus posuere tellus, ac viverra massa risus quis ligula. Nullam aliquam lobortis tortor sit amet venenatis. Morbi malesuada odio at augue ornare, non malesuada purus commodo. Quisque iaculis vitae libero vitae pellentesque.', 3, '0', '2016-03-14 10:22:30'),
(4, 24, 27, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum arcu non nisl facilisis rutrum. Cras tristique lacus in nisl vehicula, vel pretium sapien suscipit. Phasellus enim purus, posuere non tempor in, sodales cursus metus. Etiam venenatis, leo nec placerat dictum, diam metus posuere tellus, ac viverra massa risus quis ligula. Nullam aliquam lobortis tortor sit amet venenatis. Morbi malesuada odio at augue ornare, non malesuada purus commodo. Quisque iaculis vitae libero vitae pellentesque.', 3, '1', '2016-03-11 07:37:42'),
(5, 24, 27, 0, 'Very good hall.', 4, '1', '2016-03-16 13:15:20'),
(6, 24, 27, 0, 'Very good hall  hall  hall.', 5, '1', '2016-03-16 07:36:00'),
(7, 24, 27, 0, 'Very good hall  hall  hall hall.', 5, '1', '2016-03-16 07:38:12'),
(8, 34, 7, 0, 'Very Good Hall, I must strongly recommend this hall. ', 4, '1', '2016-03-16 18:04:04'),
(9, 35, 7, 0, 'Great  hall, Heavenly hospitality, awesome ambiance and last but not the list very helpful staff.', 5, '0', '2016-03-16 18:07:24'),
(11, 24, 1, 0, 'Really super hall.', 4, '1', '2016-03-25 15:02:02'),
(12, 23, 1, 0, '\nOVERVIEW\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sodales ullamcorper lectus, sit amet venenatis ante fermentum ut.', 4, '1', '2016-03-25 22:07:30'),
(13, 23, 1, 0, 'Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus. Etiam mollis sapien nisl, ut hendrerit velit pharetra ac', 5, '1', '2016-03-25 22:12:48'),
(14, 23, 1, 0, 'Aliquam finibus massa congue arcu finibus mattis. Nam pharetra tempus arcu ac luctus.', 3, '1', '2016-03-25 22:14:31'),
(15, 45, 38, 0, 'test review for Anjan test Hall 010416... test review for Anjan test Hall 010416... test review for Anjan test Hall 010416... test review for Anjan test Hall 010416... test review for Anjan test Hall 010416... ', 3, '1', '2016-04-01 21:20:06'),
(16, 49, 36, 0, 'test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... ', 4, '1', '2016-04-01 21:56:34'),
(17, 49, 36, 0, 'test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... ', 4, '1', '2016-04-01 21:56:37'),
(18, 49, 36, 0, 'test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... test review for Sania test Hall0104... ', 4, '0', '2016-04-01 21:56:39'),
(19, 71, 1, 0, 'Very nice hall and well managed.', 4, '1', '2016-04-07 15:37:16'),
(20, 71, 1, 0, 'Super hall and great facility.....:) ', 3, '1', '2016-04-07 15:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `ev_settings`
--

CREATE TABLE IF NOT EXISTS `ev_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `settings_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings_type` enum('T','D','C') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'T' COMMENT 'T=Textbox, D=Dropdown, C=Checkbox',
  `settings_options` text COLLATE utf8_unicode_ci NOT NULL,
  `is_numeric` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_required` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `max_length` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `settings_show_hide` int(11) NOT NULL COMMENT '1=Show , 0=Hide',
  `settings_status` int(11) NOT NULL COMMENT '1=Active, 0=De-active',
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ev_settings`
--

INSERT INTO `ev_settings` (`settings_id`, `settings_label`, `settings_value`, `settings_type`, `settings_options`, `is_numeric`, `is_required`, `max_length`, `settings_show_hide`, `settings_status`) VALUES
(1, 'Site Title', 'Eventus Angola', 'T', '', 'N', 'Y', '', 1, 1),
(2, 'From Email address', 'noreply@citytechcorp.com', 'T', '', 'N', 'Y', '', 1, 1),
(3, 'Front end Pagination Limit', '10', 'T', '', 'Y', 'Y', '4', 1, 1),
(4, 'Date Format', 'd/m/Y', 'D', 'd/m/Y,m/d/Y,Y/m/d', 'N', 'Y', '', 1, 0),
(5, 'Back end Pagination Limit 	', '20', 'T', '', 'Y', 'Y', '4', 0, 0),
(6, 'Back End Footer Text', 'All rights reserved 2016 © Eventus Angola.', 'T', '', 'N', 'Y', '', 1, 0),
(7, 'Front End Footer Text', 'All rights reserved 2016 © Eventus Angola.', 'T', '', 'N', 'Y', '', 1, 0),
(8, 'Js date format', 'dd/mm/yy', 'T', '', 'N', 'Y', '', 0, 0),
(19, 'Subscription expiry notification interval days', '7', 'T', '', 'Y', 'Y', '', 1, 1),
(14, 'Admin to Email address', 'citytech.tester@gmail.com', 'T', '', 'N', 'Y', '', 1, 1),
(16, '1 AOA in EUR', '0.0055', 'T', '', 'N', 'Y', '', 1, 1),
(18, 'Notification after subscription expiration upto days ', '45', 'T', '', 'Y', 'Y', '', 1, 1),
(17, 'Notification of subscription expiration before days ', '30', 'T', '', 'Y', 'Y', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ev_sitevariable`
--

CREATE TABLE IF NOT EXISTS `ev_sitevariable` (
  `sitevariable_id` int(11) NOT NULL AUTO_INCREMENT,
  `sitevariable_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sitevariable_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_edited` date NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`sitevariable_id`),
  UNIQUE KEY `sitevariable_key` (`sitevariable_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=188 ;

--
-- Dumping data for table `ev_sitevariable`
--

INSERT INTO `ev_sitevariable` (`sitevariable_id`, `sitevariable_name`, `sitevariable_key`, `date_edited`, `is_active`) VALUES
(1, 'First Name', 'eventus_1', '2016-03-03', 'Y'),
(2, 'Last name', 'eventus_2', '2016-03-03', 'Y'),
(3, 'Email Address', 'eventus_3', '2016-03-04', 'Y'),
(4, 'Mobile no', 'eventus_4', '2016-03-04', 'Y'),
(5, 'Password', 'eventus_5', '2016-03-04', 'Y'),
(6, 'Confirm Password ', 'eventus_6', '2016-03-04', 'Y'),
(7, 'Address', 'eventus_7', '2016-03-04', 'Y'),
(8, 'Location', 'eventus_8', '2016-03-04', 'Y'),
(9, 'Province', 'eventus_9', '2016-03-04', 'Y'),
(10, 'Postal code', 'eventus_10', '2016-03-04', 'Y'),
(11, 'Sign Up', 'eventus_11', '2016-03-04', 'Y'),
(12, 'I agree to Terms and Conditions.', 'eventus_12', '2016-03-04', 'Y'),
(13, 'Home', 'eventus_13', '2016-03-31', 'Y'),
(14, 'About us', 'eventus_14', '2016-04-05', 'Y'),
(15, 'Halls', 'eventus_15', '2016-03-04', 'Y'),
(16, 'News', 'eventus_16', '2016-03-04', 'Y'),
(17, 'Contact us', 'eventus_17', '2016-03-04', 'Y'),
(18, 'Check In', 'eventus_18', '2016-03-04', 'Y'),
(19, 'Check Out', 'eventus_19', '2016-03-04', 'Y'),
(20, 'Hall Type', 'eventus_20', '2016-03-04', 'Y'),
(21, 'Price Range', 'eventus_21', '2016-03-04', 'Y'),
(22, 'Search', 'eventus_22', '2016-03-04', 'Y'),
(23, 'Login', 'eventus_23', '2016-03-04', 'Y'),
(24, 'Register', 'eventus_24', '2016-03-04', 'Y'),
(25, 'Select', 'eventus_25', '2016-03-04', 'Y'),
(26, 'Book by search', 'eventus_26', '2016-03-04', 'Y'),
(27, 'Email or Mobile no. ', 'eventus_27', '2016-03-08', 'Y'),
(28, 'Sign In', 'eventus_28', '2016-03-08', 'Y'),
(29, 'Stay Signed In', 'eventus_29', '2016-03-04', 'Y'),
(30, 'New User ?', 'eventus_30', '2016-03-04', 'Y'),
(31, 'Forgot Your Password?', 'eventus_31', '2016-03-04', 'Y'),
(32, 'marked are the mandatory fields.', 'eventus_32', '2016-03-04', 'Y'),
(33, 'Update Profile', 'eventus_33', '2016-03-08', 'Y'),
(34, 'Add a hall', 'eventus_34', '2016-03-08', 'Y'),
(35, 'Join with us', 'eventus_35', '2016-03-08', 'Y'),
(36, 'Update Password', 'eventus_36', '2016-03-01', 'Y'),
(37, 'Old Password', 'eventus_37', '2016-03-08', 'Y'),
(38, 'New Password', 'eventus_38', '2016-03-08', 'Y'),
(39, 'Dashboard', 'eventus_39', '2016-04-01', 'Y'),
(40, 'Edit Profile', 'eventus_40', '2016-03-09', 'Y'),
(41, 'Change Password', 'eventus_41', '2016-03-09', 'Y'),
(42, 'My favourite', 'eventus_42', '2016-03-09', 'Y'),
(43, 'Bookings', 'eventus_43', '2016-03-09', 'Y'),
(44, 'Enquiries', 'eventus_44', '2016-03-09', 'Y'),
(45, 'Review & Ratings', 'eventus_45', '2016-03-09', 'Y'),
(46, 'Settings', 'eventus_46', '2016-03-09', 'Y'),
(47, 'Featured halls', 'eventus_47', '2016-03-31', 'Y'),
(48, 'Client testimonial', 'eventus_48', '2016-03-31', 'Y'),
(49, 'Subject', 'eventus_49', '2016-03-31', 'Y'),
(50, 'Comment', 'eventus_50', '2016-03-31', 'Y'),
(51, 'Put the sum of this numbers', 'eventus_51', '2016-03-31', 'Y'),
(52, 'Contact', 'eventus_52', '2016-03-31', 'Y'),
(54, 'required', 'eventus_54', '2016-03-31', 'Y'),
(55, 'sum field', 'eventus_55', '2016-03-31', 'Y'),
(56, 'reviews', 'eventus_56', '2016-03-31', 'Y'),
(57, 'Enquiry', 'eventus_57', '2016-03-31', 'Y'),
(58, 'Get Direction', 'eventus_58', '2016-03-31', 'Y'),
(59, 'View map', 'eventus_59', '2016-03-31', 'Y'),
(60, 'Map direction', 'eventus_60', '2016-03-31', 'Y'),
(61, 'Get Direction', 'eventus_61', '2016-03-31', 'Y'),
(62, 'Overview', 'eventus_62', '2016-03-31', 'Y'),
(63, 'Customer review', 'eventus_63', '2016-03-31', 'Y'),
(64, 'Write your review', 'eventus_64', '2016-03-31', 'Y'),
(65, 'Reviewed on', 'eventus_65', '2016-03-31', 'Y'),
(66, 'Accommodation', 'eventus_66', '2016-03-31', 'Y'),
(67, 'Add to favourite', 'eventus_67', '2016-03-31', 'Y'),
(68, 'Already favourite', 'eventus_68', '2016-03-31', 'Y'),
(69, 'Check availability', 'eventus_69', '2016-03-31', 'Y'),
(70, 'Check now', 'eventus_70', '2016-03-31', 'Y'),
(71, 'Add on services', 'eventus_71', '2016-03-31', 'Y'),
(72, 'You may also like', 'eventus_72', '2016-03-31', 'Y'),
(73, 'To use this feature login first', 'eventus_73', '2016-03-31', 'Y'),
(74, 'Review', 'eventus_74', '2016-03-31', 'Y'),
(75, 'Book Now', 'eventus_75', '2016-03-31', 'Y'),
(76, 'Sort by', 'eventus_76', '2016-03-31', 'Y'),
(77, 'Sort by rating', 'eventus_77', '2016-03-31', 'Y'),
(78, 'price high to low', 'eventus_78', '2016-03-31', 'Y'),
(79, 'price low to high', 'eventus_79', '2016-03-31', 'Y'),
(80, 'No search result found', 'eventus_80', '2016-03-31', 'Y'),
(81, 'Log Out', 'eventus_81', '2016-04-07', 'Y'),
(82, 'Menu', 'eventus_82', '2016-03-31', 'Y'),
(83, 'Owners subscriptions', 'eventus_83', '2016-03-31', 'Y'),
(84, 'FAQ', 'eventus_84', '2016-03-31', 'Y'),
(85, 'Connect', 'eventus_85', '2016-03-31', 'Y'),
(86, 'Newsletter', 'eventus_86', '2016-03-31', 'Y'),
(87, 'Terms & Conditions', 'eventus_87', '2016-03-31', 'Y'),
(88, 'Privacy Policy', 'eventus_88', '2016-03-31', 'Y'),
(89, 'All rights reserved', 'eventus_89', '2016-03-31', 'Y'),
(90, 'Ok', 'eventus_90', '2016-03-31', 'Y'),
(91, 'Booking Details', 'eventus_91', '2016-03-31', 'Y'),
(92, 'Rental Amount', 'eventus_92', '2016-03-31', 'Y'),
(93, 'Sub Total', 'eventus_93', '2016-03-31', 'Y'),
(94, 'Total', 'eventus_94', '2016-03-31', 'Y'),
(95, 'Total Amount', 'eventus_95', '2016-03-31', 'Y'),
(96, 'Billing Details', 'eventus_96', '2016-03-31', 'Y'),
(97, 'Special Comment', 'eventus_97', '2016-03-31', 'Y'),
(98, 'Pay now', 'eventus_98', '2016-03-31', 'Y'),
(99, 'Subscribe', 'eventus_99', '2016-03-31', 'Y'),
(100, 'Book Hall', 'eventus_100', '2016-03-31', 'Y'),
(101, 'Dash Board Content', 'eventus_101', '2016-04-01', 'Y'),
(102, 'Booking on My Hall', 'eventus_102', '2016-04-01', 'Y'),
(103, 'My booking', 'eventus_103', '2016-04-01', 'Y'),
(104, 'Hall Book Date', 'eventus_104', '2016-04-01', 'Y'),
(105, 'Amount', 'eventus_105', '2016-04-01', 'Y'),
(106, 'Booking Date', 'eventus_106', '2016-04-01', 'Y'),
(107, 'Booking Status', 'eventus_107', '2016-04-01', 'Y'),
(108, 'Addon selected', 'eventus_108', '2016-04-01', 'Y'),
(109, 'No Booking has been made by you', 'eventus_109', '2016-04-01', 'Y'),
(110, 'Booked By', 'eventus_110', '2016-04-01', 'Y'),
(111, 'No Booking yet on your hall', 'eventus_111', '2016-04-01', 'Y'),
(112, 'Post your reply', 'eventus_112', '2016-04-01', 'Y'),
(113, 'Post Reply', 'eventus_113', '2016-04-01', 'Y'),
(114, 'Sender', 'eventus_114', '2016-04-01', 'Y'),
(115, 'Message', 'eventus_115', '2016-04-01', 'Y'),
(116, 'Replies', 'eventus_116', '2016-04-01', 'Y'),
(117, 'View', 'eventus_117', '2016-04-01', 'Y'),
(118, 'Last Post', 'eventus_118', '2016-04-01', 'Y'),
(119, 'My Reviews', 'eventus_119', '2016-04-01', 'Y'),
(120, 'My Reviews Updated', 'eventus_120', '2016-04-01', 'Y'),
(121, 'Reviews on My Hall', 'eventus_121', '2016-04-01', 'Y'),
(122, 'Reviews on My Hall Updated', 'eventus_122', '2016-04-01', 'Y'),
(123, 'My Hall', 'eventus_123', '2016-04-01', 'Y'),
(124, 'Add My Hall', 'eventus_124', '2016-04-01', 'Y'),
(125, 'Hall Listing', 'eventus_125', '2016-04-01', 'Y'),
(126, 'Hall Name', 'eventus_126', '2016-04-01', 'Y'),
(127, 'Subscription', 'eventus_127', '2016-04-01', 'Y'),
(128, 'Type', 'eventus_128', '2016-04-01', 'Y'),
(129, 'Addon', 'eventus_129', '2016-04-01', 'Y'),
(130, 'Action', 'eventus_130', '2016-04-01', 'Y'),
(131, 'No subscription', 'eventus_131', '2016-04-01', 'Y'),
(132, 'Buy', 'eventus_132', '2016-04-01', 'Y'),
(133, 'My Hall Accommodation', 'eventus_133', '2016-04-01', 'Y'),
(134, 'Accommodation Updated', 'eventus_134', '2016-04-01', 'Y'),
(135, 'Hall Details', 'eventus_135', '2016-04-01', 'Y'),
(136, 'Upload Photo', 'eventus_136', '2016-04-01', 'Y'),
(137, 'Addon Services', 'eventus_137', '2016-04-01', 'Y'),
(138, 'Calender', 'eventus_138', '2016-04-01', 'Y'),
(139, 'Add', 'eventus_139', '2016-04-01', 'Y'),
(140, 'Description', 'eventus_140', '2016-04-01', 'Y'),
(141, 'Select Province', 'eventus_141', '2016-04-01', 'Y'),
(142, 'Select Location', 'eventus_142', '2016-04-01', 'Y'),
(143, 'Set Location', 'eventus_143', '2016-04-01', 'Y'),
(144, 'Click', 'eventus_144', '2016-04-01', 'Y'),
(145, 'Please click here to select exact location from Map, It will bring Latitude and Longitude autometically', 'eventus_145', '2016-04-01', 'Y'),
(146, 'Latitude', 'eventus_146', '2016-04-01', 'Y'),
(147, 'Longitude', 'eventus_147', '2016-04-01', 'Y'),
(148, 'Contact Email', 'eventus_148', '2016-04-01', 'Y'),
(149, 'Contact Mobile', 'eventus_149', '2016-04-01', 'Y'),
(150, 'Official Name', 'eventus_150', '2016-04-01', 'Y'),
(151, 'Contact Name', 'eventus_151', '2016-04-01', 'Y'),
(152, 'First Search your location from search bar, then drag the map marker to exact location', 'eventus_152', '2016-04-01', 'Y'),
(153, 'Update', 'eventus_153', '2016-04-01', 'Y'),
(154, 'My Hall Calender', 'eventus_154', '2016-04-01', 'Y'),
(155, 'Block Dates', 'eventus_155', '2016-04-01', 'Y'),
(156, 'Particular Date', 'eventus_156', '2016-04-01', 'Y'),
(157, 'Recurring Weekly', 'eventus_157', '2016-04-01', 'Y'),
(158, 'Recurring Monthly', 'eventus_158', '2016-04-01', 'Y'),
(159, 'Select Block Type', 'eventus_159', '2016-04-01', 'Y'),
(160, 'Select Block Type', 'eventus_160', '2016-04-01', 'Y'),
(161, 'Select Date', 'eventus_161', '2016-04-01', 'Y'),
(162, 'Select Week Day', 'eventus_162', '2016-04-01', 'Y'),
(163, 'Select Day', 'eventus_163', '2016-04-01', 'Y'),
(164, 'Select Monthly Day', 'eventus_164', '2016-04-01', 'Y'),
(165, 'My Hall Subscription', 'eventus_165', '2016-04-01', 'Y'),
(166, 'Your payment has been declined', 'eventus_166', '2016-04-01', 'Y'),
(167, 'My Hall Addons', 'eventus_167', '2016-04-01', 'Y'),
(168, 'Your payment has been received successfully', 'eventus_168', '2016-04-01', 'Y'),
(169, 'My Hall Location', 'eventus_169', '2016-04-01', 'Y'),
(170, 'Set Location', 'eventus_170', '2016-04-01', 'Y'),
(171, 'Your Subscription', 'eventus_171', '2016-04-01', 'Y'),
(172, 'Name', 'eventus_172', '2016-04-01', 'Y'),
(173, 'Duration', 'eventus_173', '2016-04-01', 'Y'),
(174, 'Payment date', 'eventus_174', '2016-04-01', 'Y'),
(175, 'Expiry date', 'eventus_175', '2016-04-01', 'Y'),
(176, 'Your Featured Service', 'eventus_176', '2016-04-01', 'Y'),
(177, 'Featured Service', 'eventus_177', '2016-04-01', 'Y'),
(178, 'Total Price', 'eventus_178', '2016-04-01', 'Y'),
(179, 'My Hall Images', 'eventus_179', '2016-04-01', 'Y'),
(180, 'Hall Images', 'eventus_180', '2016-04-01', 'Y'),
(181, 'Images are sorted in order correctly', 'eventus_181', '2016-04-01', 'Y'),
(182, 'You can select multiple image by pressing ctrl', 'eventus_182', '2016-04-01', 'Y'),
(183, 'Please upload Below 2MB image size and Resolution should be above 855px width & 408px height', 'eventus_183', '2016-04-01', 'Y'),
(184, 'Upload', 'eventus_184', '2016-04-01', 'Y'),
(185, 'Birthday Hall', 'eventus_185', '2016-04-01', 'Y'),
(186, 'Wedding Hall', 'eventus_186', '2016-04-01', 'Y'),
(187, 'Facilities', 'eventus_187', '2016-04-04', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `ev_sitevariable_value`
--

CREATE TABLE IF NOT EXISTS `ev_sitevariable_value` (
  `variable_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `sitevariable_id` int(11) NOT NULL,
  `variable_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`variable_value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=375 ;

--
-- Dumping data for table `ev_sitevariable_value`
--

INSERT INTO `ev_sitevariable_value` (`variable_value_id`, `language_id`, `sitevariable_id`, `variable_value`) VALUES
(1, 1, 1, 'First Name'),
(2, 2, 1, 'Primeiro nome'),
(3, 1, 2, 'Last Name'),
(4, 2, 2, 'Último nome'),
(5, 1, 3, 'Email Address'),
(6, 2, 3, 'Endereço de e-mail'),
(7, 1, 4, 'Mobile no.'),
(8, 2, 4, 'No. móvel'),
(9, 1, 5, 'Password'),
(10, 2, 5, 'Senha'),
(11, 1, 6, 'Confirm Password'),
(12, 2, 6, 'Confirme a Senha'),
(13, 1, 7, 'Address'),
(14, 2, 7, 'Endereço'),
(15, 1, 8, 'Location'),
(16, 2, 8, 'Localização'),
(17, 1, 9, 'Province'),
(18, 2, 9, 'Província'),
(19, 1, 10, 'Postal code'),
(20, 2, 10, 'Código postal'),
(21, 1, 11, 'Sign Up'),
(22, 2, 11, 'Inscrever-se'),
(23, 1, 12, 'I agree to Terms and Conditions.'),
(24, 2, 12, 'Eu concordo com os termos e condições.'),
(25, 1, 13, 'Home'),
(26, 2, 13, 'Casa'),
(27, 1, 14, 'About us'),
(28, 2, 14, 'Sobre nós'),
(29, 1, 15, 'Halls'),
(30, 2, 15, 'Salão do'),
(31, 1, 16, 'News'),
(32, 2, 16, 'Notícia'),
(33, 1, 17, 'Contact us'),
(34, 2, 17, 'Nos contate'),
(35, 1, 18, 'Check In'),
(36, 2, 18, 'Dar entrada'),
(37, 1, 19, 'Check out'),
(38, 2, 19, 'Sair de'),
(39, 1, 20, 'Hall Type'),
(40, 2, 20, 'Tipo de salão'),
(41, 1, 21, 'Price Range'),
(42, 2, 21, 'Faixa de preço'),
(43, 1, 22, 'Search'),
(44, 2, 22, 'Pesquisa'),
(45, 1, 23, 'Login'),
(46, 2, 23, 'Entrar'),
(47, 1, 24, 'Register'),
(48, 2, 24, 'Registrar'),
(49, 1, 25, 'Select'),
(50, 2, 25, 'Selecionar'),
(51, 1, 26, 'Book By Search'),
(52, 2, 26, 'Livro por Pesquisa'),
(53, 1, 27, 'Email or Mobile no. '),
(54, 2, 27, 'E-mail ou celular não.'),
(55, 1, 28, 'Sign In'),
(56, 2, 28, 'Assinar em'),
(57, 1, 29, 'Stay Signed In'),
(58, 2, 29, 'Ficar assinado em'),
(59, 1, 30, 'New User ?'),
(60, 2, 30, 'Novo usuário ?'),
(61, 1, 31, 'Forgot Your Password?'),
(62, 2, 31, 'Esqueceu sua senha?'),
(63, 1, 32, 'marked are the mandatory fields.'),
(64, 2, 32, 'acentuado são os campos obrigatórios.'),
(65, 1, 33, 'Update Profile'),
(66, 2, 33, 'Atualizar perfil'),
(67, 1, 34, 'Add Hall'),
(68, 2, 34, 'Adicionar Salão'),
(69, 1, 35, 'Join with us'),
(70, 2, 35, 'Junte-se a nós'),
(71, 1, 36, 'Update Password'),
(72, 2, 36, 'atualização de senha'),
(73, 1, 37, 'Old Password'),
(74, 2, 37, 'Senha Antiga'),
(75, 1, 38, 'New Password'),
(76, 2, 38, 'Nova senha'),
(77, 1, 39, 'Dashboard'),
(78, 2, 39, 'Paralama'),
(79, 1, 40, 'Edit Profile'),
(80, 2, 40, 'Editar Perfil'),
(81, 1, 41, 'Change Password'),
(82, 2, 41, 'Mudar senha'),
(83, 1, 42, 'My favourite'),
(84, 2, 42, 'Meu favorito'),
(85, 1, 43, 'Bookings'),
(86, 2, 43, 'reservas'),
(87, 1, 44, 'Enquiries'),
(88, 2, 44, 'inquéritos'),
(89, 1, 45, 'Review & Ratings'),
(90, 2, 45, 'Review & Pontuações'),
(91, 1, 46, 'Settings'),
(92, 2, 46, 'Configurações'),
(93, 1, 47, 'Featured halls'),
(94, 2, 47, 'salas selecionadas'),
(95, 1, 48, 'Client testimonial'),
(96, 2, 48, 'testemunho de cliente'),
(97, 1, 49, 'Subject'),
(98, 2, 49, 'Sujeito'),
(99, 1, 50, 'Comment'),
(100, 2, 50, 'Comente'),
(101, 1, 51, 'Put the sum of this numbers'),
(102, 2, 51, 'Coloque a soma desta números'),
(103, 1, 52, 'Contact'),
(104, 2, 52, 'Contato'),
(108, 2, 54, 'requeridos'),
(107, 1, 54, 'required'),
(109, 1, 55, 'Sum field'),
(110, 2, 55, 'campo sum'),
(111, 1, 56, 'reviews'),
(112, 2, 56, 'rever'),
(113, 1, 57, 'Enquiry'),
(114, 2, 57, 'Inquérito'),
(115, 1, 58, 'Get Direction'),
(116, 2, 58, 'obter Direção'),
(117, 1, 59, 'View map'),
(118, 2, 59, 'Ver mapa'),
(119, 1, 60, 'Map direction'),
(120, 2, 60, 'direção mapa'),
(121, 1, 61, 'Get Direction'),
(122, 2, 61, 'obter Direção'),
(123, 1, 62, 'Overview'),
(124, 2, 62, 'Visão geral'),
(125, 1, 63, 'Customer review'),
(126, 2, 63, 'Opiniões'),
(127, 1, 64, 'Write your review'),
(128, 2, 64, 'escreva sua revisão'),
(129, 1, 65, 'Reviewed on'),
(130, 2, 65, 'Avaliado em'),
(131, 1, 66, 'Accommodation'),
(132, 2, 66, 'Alojamento'),
(133, 1, 67, 'Add to favourite'),
(134, 2, 67, 'Adicionar aos favoritos'),
(135, 1, 68, 'Already favourite'),
(136, 2, 68, 'já favorito'),
(137, 1, 69, 'Check availability'),
(138, 2, 69, 'Verificar disponibilidade'),
(139, 1, 70, 'Check now'),
(140, 2, 70, 'Verifique agora'),
(141, 1, 71, 'Add on services'),
(142, 2, 71, 'Adicionar sobre serviços'),
(143, 1, 72, 'You may also like'),
(144, 2, 72, 'você pode gostar'),
(145, 1, 73, 'To use this feature login first'),
(146, 2, 73, 'Para usar este login recurso primeira'),
(147, 1, 74, 'Review'),
(148, 2, 74, 'revisão'),
(149, 1, 75, 'Book Now'),
(150, 2, 75, 'Livro agora'),
(151, 1, 76, 'Sort by'),
(152, 2, 76, 'Ordenar por'),
(153, 1, 77, 'Sort by rating'),
(154, 2, 77, 'Ordenar por avaliação'),
(155, 1, 79, 'price low to high'),
(156, 2, 79, 'preço baixo para alto'),
(157, 1, 78, 'price high to low'),
(158, 2, 78, 'preço alto para baixo'),
(159, 1, 80, 'No search result found'),
(160, 2, 80, 'Nenhum resultado de pesquisa encontrado'),
(161, 1, 81, 'Logout'),
(162, 2, 81, 'Sair'),
(163, 1, 82, 'Menu'),
(164, 2, 82, 'Cardápio'),
(165, 1, 83, 'Owners subscriptions'),
(166, 2, 83, 'proprietários assinaturas'),
(167, 1, 84, 'FAQ'),
(168, 2, 84, 'Perguntas frequentes'),
(169, 1, 85, 'Connect'),
(170, 2, 85, 'Conectar'),
(171, 1, 86, 'Newsletter'),
(172, 2, 86, 'Boletim de Notícias'),
(173, 1, 87, 'Terms & Conditions'),
(174, 2, 87, 'termos e Condições'),
(175, 1, 88, 'Privacy Policy'),
(176, 2, 88, 'Política de Privacidade'),
(177, 1, 89, 'All rights reserved'),
(178, 2, 89, 'Todos os direitos reservados'),
(179, 1, 90, 'Ok'),
(180, 2, 90, 'Está bem'),
(181, 1, 91, 'Booking Details'),
(182, 2, 91, 'Detalhes da reserva'),
(183, 1, 92, 'Rental Amount'),
(184, 2, 92, 'Aluguer Montante'),
(185, 1, 93, 'Sub Total'),
(186, 2, 93, 'Subtotal'),
(187, 1, 94, 'Total'),
(188, 2, 94, 'Total'),
(189, 1, 95, 'Total Amount'),
(190, 2, 95, 'Valor total'),
(191, 1, 96, 'Billing Details'),
(192, 2, 96, 'Detalhes de faturamento'),
(193, 1, 97, 'Special Comment'),
(194, 2, 97, 'Comentário especial'),
(195, 1, 98, 'Pay now'),
(196, 2, 98, 'Pague agora'),
(197, 1, 99, 'Subscribe'),
(198, 2, 99, 'Se inscrever'),
(199, 1, 100, 'Book Hall'),
(200, 2, 100, 'livro Salão'),
(201, 1, 101, 'Dash Board Content'),
(202, 2, 101, 'conteúdo painel'),
(203, 1, 102, 'Booking on My Hall'),
(204, 2, 102, 'Reserva na minha sala'),
(205, 1, 103, 'My booking'),
(206, 2, 103, 'A minha reserva'),
(207, 1, 104, 'Hall Book Date'),
(208, 2, 104, 'Salão do livro Data'),
(209, 1, 105, 'Amount'),
(210, 2, 105, 'Quantidade'),
(211, 1, 106, 'Booking Date'),
(212, 2, 106, 'Data de reserva'),
(213, 1, 107, 'Booking Status'),
(214, 2, 107, 'Estado de reserva'),
(215, 1, 108, 'Addon selected'),
(216, 2, 108, 'addon selecionadas'),
(217, 1, 109, 'No Booking has been made by you'),
(218, 2, 109, 'Nenhuma reserva foi feita por você'),
(219, 1, 110, 'Booked By'),
(220, 2, 110, 'reservado por'),
(221, 1, 111, 'No Booking yet on your hall'),
(222, 2, 111, 'Ainda não tem reserva no seu salão'),
(223, 1, 112, 'Post your reply'),
(224, 2, 112, 'Postar sua resposta'),
(225, 1, 113, 'Post Reply'),
(226, 2, 113, 'Resposta ao post'),
(227, 1, 114, 'Sender'),
(228, 2, 114, 'Remetente'),
(229, 1, 115, 'Message'),
(230, 2, 115, 'Mensagem'),
(231, 1, 116, 'Replies'),
(232, 2, 116, 'respostas'),
(233, 1, 117, 'View'),
(234, 2, 117, 'Visão'),
(235, 1, 118, 'Last Post'),
(236, 2, 118, 'Última postagem'),
(237, 1, 119, 'My Reviews'),
(238, 2, 119, 'meus comentários'),
(239, 1, 120, 'My Reviews Updated'),
(240, 2, 120, 'Os comentários Atualizado'),
(241, 1, 121, 'Reviews on My Hall'),
(242, 2, 121, 'Comentários sobre meu salão'),
(243, 1, 122, 'Reviews on My Hall Updated'),
(244, 2, 122, 'Comentários sobre My Salão Atualizado'),
(245, 1, 123, 'My Hall'),
(246, 2, 123, 'meu Salão'),
(247, 1, 124, 'Add My Hall'),
(248, 2, 124, 'Adicionar Minha Salão'),
(249, 1, 125, 'Hall Listing'),
(250, 2, 125, 'Lista de salão'),
(251, 1, 126, 'Hall Name'),
(252, 2, 126, 'Nome salão'),
(253, 1, 127, 'Subscription'),
(254, 2, 127, 'Inscrição'),
(255, 1, 128, 'Type'),
(256, 2, 128, 'Digitar'),
(257, 1, 129, 'Addon'),
(258, 2, 129, 'Adicionar'),
(259, 1, 130, 'Action'),
(260, 2, 130, 'Açao'),
(261, 1, 131, 'No subscription'),
(262, 2, 131, 'Sem assinatura'),
(263, 1, 132, 'Buy'),
(264, 2, 132, 'Comprar'),
(265, 1, 133, 'My Hall Accommodation'),
(266, 2, 133, 'Meu Salão Alojamento'),
(267, 1, 134, 'Accommodation Updated'),
(268, 2, 134, 'alojamento Atualizado'),
(269, 1, 135, 'Hall Details'),
(270, 2, 135, 'Detalhes salão'),
(271, 1, 136, 'Upload Photo'),
(272, 2, 136, 'Enviar Foto'),
(273, 1, 137, 'Addon Services'),
(274, 2, 137, 'Serviços addon'),
(275, 1, 138, 'Calender'),
(276, 2, 138, 'Calendário'),
(277, 1, 139, 'Add'),
(278, 2, 139, 'Adicionar'),
(279, 1, 140, 'Description'),
(280, 2, 140, 'Descrição'),
(281, 1, 141, 'Select Province'),
(282, 2, 141, 'Selecione Province'),
(283, 1, 142, 'Select Location'),
(284, 2, 142, 'Escolha o Destino'),
(285, 1, 143, 'Set Location'),
(286, 2, 143, 'Definir Local'),
(287, 1, 144, 'Click'),
(288, 2, 144, 'Clique'),
(289, 1, 145, 'Please click here to select exact location from Map, It will bring Latitude and Longitude autometically'),
(290, 2, 145, 'Por favor clique aqui para selecionar o local exato do mapa, ele vai trazer Latitude e Longitude automaticamente'),
(291, 1, 146, 'Latitude'),
(292, 2, 146, 'Latitude'),
(293, 1, 147, 'Longitude'),
(294, 2, 147, 'Longitude'),
(295, 1, 148, 'Contact Email'),
(296, 2, 148, 'email de contato'),
(297, 1, 149, 'Contact Mobile'),
(298, 2, 149, 'contato celular'),
(299, 1, 150, 'Official Name'),
(300, 2, 150, 'Nome oficial'),
(301, 1, 151, 'Contact Name'),
(302, 2, 151, 'Nome do Contacto'),
(303, 1, 152, 'First Search your location from search bar, then drag the map marker to exact location'),
(304, 2, 152, 'Primeira pesquisa a sua localização de barra de pesquisa, em seguida, arraste o marcador do mapa com a localização exata'),
(305, 1, 153, 'Update'),
(306, 2, 153, 'Atualizar'),
(307, 1, 154, 'My Hall Calender'),
(308, 2, 154, 'Meu Calendário Municipal'),
(309, 1, 155, 'Block Dates'),
(310, 2, 155, 'Datas de bloco'),
(311, 1, 156, 'Particular Date'),
(312, 2, 156, 'Particular Data'),
(313, 1, 157, 'Recurring Weekly'),
(314, 2, 157, 'recorrentes Weekly'),
(315, 1, 158, 'Recurring Monthly'),
(316, 2, 158, 'recorrente mensal'),
(317, 1, 159, 'Select Block Type'),
(318, 2, 159, 'Selecione Bloco Tipo'),
(319, 1, 160, 'Select Block Type'),
(320, 2, 160, 'Selecione Bloco Tipo'),
(321, 1, 161, 'Select Date'),
(322, 2, 161, 'Selecione Data'),
(323, 1, 162, 'Select Week Day'),
(324, 2, 162, 'Selecione Dia Semana'),
(325, 1, 163, 'Select Day'),
(326, 2, 163, 'Escolha um dia'),
(327, 1, 164, 'Select Monthly Day'),
(328, 2, 164, 'Selecione Dia Mensal'),
(329, 1, 165, 'My Hall Subscription'),
(330, 2, 165, 'Minha Assinatura Salão'),
(331, 1, 166, 'Your payment has been declined'),
(332, 2, 166, 'Seu pagamento foi recusado'),
(333, 1, 167, 'My Hall Addons'),
(334, 2, 167, 'Meus Complementos Salão'),
(335, 1, 168, 'Your payment has been received successfully'),
(336, 2, 168, 'O seu pagamento foi recebido com sucesso'),
(337, 1, 169, 'My Hall Location'),
(338, 2, 169, 'Meu Salão Localização'),
(339, 1, 170, 'Set Location'),
(340, 2, 170, 'Definir Local'),
(341, 1, 171, 'Your Subscription'),
(342, 2, 171, 'sua Assinatura'),
(343, 1, 172, 'Name'),
(344, 2, 172, 'Nome'),
(345, 1, 173, 'Duration'),
(346, 2, 173, 'Duração'),
(347, 1, 174, 'Payment date'),
(348, 2, 174, 'Data de pagamento'),
(349, 1, 175, 'Expiry date'),
(350, 2, 175, 'Data de validade'),
(351, 1, 176, 'Your Featured Service'),
(352, 2, 176, 'O seu Serviço de Destaque'),
(353, 1, 177, 'Featured Service'),
(354, 2, 177, 'Serviço em destaque'),
(355, 1, 178, 'Total Price'),
(356, 2, 178, 'Preço total'),
(357, 1, 179, 'My Hall Images'),
(358, 2, 179, 'Meu salão Images'),
(359, 1, 180, 'Hall Images'),
(360, 2, 180, 'salão Imagens'),
(361, 1, 181, 'Images are sorted in order correctly'),
(362, 2, 181, 'As imagens são classificadas em ordem corretamente'),
(363, 1, 182, 'You can select multiple image by pressing ctrl'),
(364, 2, 182, 'Você pode selecionar a imagem múltipla pressionando ctrl'),
(365, 1, 183, 'Please upload Below 2MB image size and Resolution should be above 855px width & 408px height'),
(366, 2, 183, 'Faça o upload Abaixo tamanho da imagem 2MB e resolução deve estar acima de 855 px de largura e 408 px de altura'),
(367, 1, 184, 'Upload'),
(368, 2, 184, 'Envio'),
(369, 1, 185, 'Birthday Hall'),
(370, 2, 185, 'aniversário Salão'),
(371, 1, 186, 'Wedding Hall'),
(372, 2, 186, 'Salão do Casamento'),
(373, 1, 187, 'Facilities'),
(374, 2, 187, 'Instalações');

-- --------------------------------------------------------

--
-- Table structure for table `ev_subscription`
--

CREATE TABLE IF NOT EXISTS `ev_subscription` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_month` int(10) NOT NULL,
  `subscription_price` double(8,2) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ev_subscription`
--

INSERT INTO `ev_subscription` (`id`, `subscription_month`, `subscription_price`, `is_active`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 3, 100.00, 1, 1, '2016-02-24 10:19:05', '2016-04-23 12:47:07'),
(2, 6, 200.00, 1, 2, '2016-02-24 10:19:16', '2016-04-05 18:25:20'),
(3, 6, 200.00, 0, 3, '2016-04-05 18:18:34', '2016-04-06 17:54:36'),
(4, 3, 50.00, 1, 4, '2016-04-19 15:27:21', '2016-04-19 15:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `ev_subscription_feature`
--

CREATE TABLE IF NOT EXISTS `ev_subscription_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `featured_name` varchar(255) NOT NULL,
  `featured_price` double(8,2) NOT NULL,
  `featured_month` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ev_subscription_feature`
--

INSERT INTO `ev_subscription_feature` (`id`, `featured_name`, `featured_price`, `featured_month`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1 Month Featured listing', 150.00, 1, 1, '2016-03-22 10:45:33', '2016-03-22 10:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `ev_subscription_translation`
--

CREATE TABLE IF NOT EXISTS `ev_subscription_translation` (
  `subscription_translation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` int(10) unsigned NOT NULL,
  `language_id` int(11) NOT NULL,
  `subscription_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`subscription_translation_id`),
  KEY `subscription_translation_subscription_id_foreign` (`subscription_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ev_subscription_translation`
--

INSERT INTO `ev_subscription_translation` (`subscription_translation_id`, `subscription_id`, `language_id`, `subscription_name`) VALUES
(1, 1, 1, '3 Months subscription'),
(2, 1, 2, '3 Months subscriptions'),
(3, 2, 1, 'Half yearly subscription'),
(4, 2, 2, 'Half yearly subscription Pt'),
(5, 3, 1, '1 Year Subscription'),
(6, 3, 2, '1 Year Subscription Pt'),
(7, 4, 1, 'dsf'),
(8, 4, 2, 'sfs');

-- --------------------------------------------------------

--
-- Table structure for table `ev_testimonial`
--

CREATE TABLE IF NOT EXISTS `ev_testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_image` varchar(255) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ev_testimonial`
--

INSERT INTO `ev_testimonial` (`id`, `testimonial_image`, `created_by`, `order_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'testimonial_3.jpg', 'James William', 1, '1', '2016-03-16 09:10:55', '2016-04-05 20:07:03'),
(2, 'testimonial_2.jpg', 'Dave', 2, '1', '2016-03-09 07:00:15', '2016-03-16 20:58:26'),
(3, 'testimonial_3.jpg', 'John', 3, '1', '2016-03-09 07:01:02', '2016-03-09 07:01:02'),
(4, 'testimonial_4.jpg', 'David', 4, '1', '2016-03-09 07:01:02', '2016-03-09 07:01:02'),
(5, 'testimonial_5.jpg', 'Vincent van Gogh', 5, '1', '2016-03-09 07:06:12', '2016-03-09 07:06:12'),
(6, 'testimonial_6.jpg', 'Adrien', 6, '1', '2016-03-09 07:06:12', '2016-03-09 07:06:12'),
(7, 'party15.jpg', 'Anjan Das', 7, '1', '2016-04-05 20:09:47', '2016-04-06 22:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `ev_testimonial_translation`
--

CREATE TABLE IF NOT EXISTS `ev_testimonial_translation` (
  `testimonial_translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `testimonial_name` tinytext NOT NULL,
  `testimonial_content` text NOT NULL,
  PRIMARY KEY (`testimonial_translation_id`),
  KEY `FK_P57_T2_Cascade` (`testimonial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ev_testimonial_translation`
--

INSERT INTO `ev_testimonial_translation` (`testimonial_translation_id`, `testimonial_id`, `language_id`, `testimonial_name`, `testimonial_content`) VALUES
(1, 1, 1, 'Testimonial1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium.'),
(2, 1, 2, 'Testimonial1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium.'),
(3, 2, 1, 'Testimonial2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum.'),
(4, 2, 2, 'Testimonial2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum.'),
(5, 3, 1, 'Testimonial3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus.'),
(6, 3, 2, 'Testimonial3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus.'),
(7, 4, 1, 'Testimonial4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate.'),
(8, 4, 2, 'Testimonia4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate.'),
(9, 5, 1, 'Testimonial5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium.'),
(10, 5, 2, 'Testimonial5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum. Donec vulputate, dui in feugiat congue, dolor mauris pulvinar risus, quis maximus odio mi eget eros. Nam bibendum maximus pretium.'),
(11, 6, 1, 'Testimonial6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum.'),
(12, 6, 2, 'Testimonial6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dapibus diam quis sapien dapibus rutrum.'),
(13, 7, 1, 'Test Testimonial', 'Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten... Test Testimonial conten...&nbsp;'),
(14, 7, 2, 'Test Testimonial Pt', 'Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt... Test Testimonial conten Pt...&nbsp;');

-- --------------------------------------------------------

--
-- Table structure for table `ev_users`
--

CREATE TABLE IF NOT EXISTS `ev_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(10) NOT NULL,
  `postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'AO',
  `is_active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email_auth` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` enum('U','O') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'U',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `ev_users`
--

INSERT INTO `ev_users` (`id`, `email`, `password`, `first_name`, `last_name`, `contact_number`, `address`, `city`, `state`, `postcode`, `country`, `is_active`, `email_auth`, `user_type`, `remember_token`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'ranjit.citytech@gmail.com', '$2y$10$7zfaupmE/.3m7VoTJLyI3eOiluyZDsTr4OYagcMSfMMAVUbrtc4bS', 'Ranjit', 'kumar', '9830012346', 'Test test', 5, 2, '12365478', 'India', '1', '', 'O', '15PYEMnhIVOg6hpqvN06abts1AxoNLKinRKqUKGBsuZ9I7PXBm1jUERIdOvd', 'green4.jpg', '2016-02-24 14:13:57', '2016-04-08 19:06:07'),
(7, 'kaushik.citytech@gmail.com', '$2y$10$4Sc.lestMbwSEw3YgWuAf.urxZD3HQuxNlkOfgOvI3jrs08stwtLu', 'Kaushik ', 'Das', '9830012345', 'The Smell Place', 8, 4, '90623', 'US', '1', '', 'O', 'k5mPShKDkTSXn7bxGMnd9ncUfPQvwSfA36Wi3TMq8BazzCGk4cVl5PQju00G', 'gallery4.jpg', '2016-02-24 14:18:15', '2016-04-07 22:31:36'),
(27, 'sam@hmail.com', '$2y$10$pAp7ohdyLfEQ9uCDvAtYBOiVNLBeiLQg25rtL6IrI1btGK7MYlVFS', 'Mark', 'Taylor', '1234567890', '15, ACB road, Melbourne, Australia-80025', 56, 14, '98745', 'AO', '1', '', 'U', '34Ap5Rs1VUaOAZGKUkDLB068w1oe0iSE7Bq0IXddgPUPkNDcnD08YXG9hlOL', 'images.png', '2016-03-07 17:08:08', '2016-04-06 22:22:13'),
(28, 'kais@gmail.com', '$2y$10$4Sc.lestMbwSEw3YgWuAf.urxZD3HQuxNlkOfgOvI3jrs08stwtLu', 'Pablos', 'Patronobish', '12365421547', '15, Park Avenew, Kolkata-700031.', 5, 3, '123654', 'AO', '1', '', 'U', 'r1FbR7SrYaC4zZprUFE5UfiARb0aWRsETRbQTIvHEZXlVIZuuVPSMhQ1qRI5', '', '2016-03-08 17:43:31', '2016-03-16 19:10:45'),
(32, 'sam123@hmail.com', '$2y$10$4Sc.lestMbwSEw3YgWuAf.urxZD3HQuxNlkOfgOvI3jrs08stwtLu', 'erwer', 'hghhgh', '1234567899', 'sdadsd dsfd', 4, 4, '125478', 'AO', '1', '1wYhVJkGOxnfAqxYMthd3yOsViE8jaRoNplmEa7l', 'U', 'iDtdWvTh8lKgqEpMngfWx2NdhjDjY9XVKswbY04dgS6DN1K5lbH3bBMbNkoF', '', '2016-03-10 23:10:47', '2016-03-18 20:00:46'),
(33, 'citytech.shib@gmail.com', '$2y$10$mHdVMNS.Wq1JxoUQCKhKZuWmfcrhLjutsSOKUVZTQtyDq/kpWSnOC', 'Suman', 'Nandy', '9876543210', 'Parkstreet, Kolkata', 4, 1, '700071', 'AO', '1', '', 'U', NULL, '', '2016-03-16 17:26:07', '2016-03-30 22:00:46'),
(34, 'citytech.testernew@gmail.com', '$2y$10$9LFx9X2a54.FyxTTB4vN8.lPkbw/5Jc75hAITT00fQuleaOCBT9uq', 'Cityetch', 'Tester', '1234567800', '15 Abc road', 10, 2, '235689', 'AO', '1', '', 'U', NULL, '', '2016-03-25 13:21:36', '2016-03-25 13:21:36'),
(35, 'aveeksaha.citytech@gmail.com', '$2y$10$aYBHd/7QlAPXN8g643mnp.QJEZAqEwMJ0.oAfAlB41LpIT2J6/EIC', 'Aveek', 'Saha', '9999900000', '15 ABC Road', 5, 13, '123456789', 'AO', '1', '', 'U', 'lc1UxjmM1YZmprh7R4ERr6PRgIFjBjIOyKJBQQ4gDuEVSLw4sVJQWs9WfF5O', '', '2016-03-30 20:21:40', '2016-04-07 17:17:01'),
(36, 'test.citytech@gmail.com', '$2y$10$Ap4Nwfk/f5oCbH9rbpv/WuOUUSj5MHlaOE9RCEoZNxgYCsRZJZrbW', '        Anjan 123', 'Das 456', '1234567891', 'Star Plaza, C/O- B.N.Das, 456N, Central Rd.', 4, 2, '123789', 'AO', '1', '', 'U', 'UOKSVnvY56fGO3zgRCSfLqCoiVMcxadmgHwAEmXp91BkEsRwZONBTlvEha1I', '', '2016-04-01 16:34:01', '2016-04-01 20:36:27'),
(37, 'citynow.test@gmail.com', '$2y$10$hVKTjSCGkwgpnTUmiRL0pO9UsYlFhNWOlJf85i64u3EnXui1lSkmO', 'Sania', 'Join', '9876543219', 'Twen Plaza, C/O- S.M.Rana, 55D, Canal Rd.,', 6, 1, '789456', 'AO', '1', '', 'U', 'Re9FEWoU9Gsdxf5OUwomdBLsfuMSvSjwkMhF31lmnmxyBq92XTT1huh6ySPO', '', '2016-04-01 17:17:26', '2016-04-05 14:51:41'),
(38, 'citytech.teamone@gmail.com', '$2y$10$fJLd/xEIfaH7JQefxC9lGeF.3H4LU1wGjdnmZwvLL6c2hp4nM2x3S', 'Bimal', 'Biswas', '1231231231', 'Star Plaza, C/O- Danial Thomson, 611 S, 36th St.', 8, 7, '456123', 'AO', '1', '', 'U', 'TBFEQVwPpw52W6KHOpeSL9VUyUmOMU6Xow7rxxlup7oVTiHXstxkTs2ViWys', '', '2016-04-01 20:16:22', '2016-04-04 20:57:04'),
(39, 'citytech.teamtwo@gmail.com', '$2y$10$sXdDROUnIgxcRdiWWTbevOyHkioJjgbGHZnjD1F5C6dt58YoHhydS', 'Sham', 'Kar', '1234512345', 'Twen Plaza, C/O- Jorge Lorenzo, 1300', 17, 1, '456987', 'AO', '1', '', 'U', 'sXEi8yPoy7NwHbEs7r0lPQVQMONhPHe5ymL3iRR9LvVDHGJ3TMDgQQqUYaME', '', '2016-04-01 20:31:40', '2016-04-06 22:06:04'),
(40, 'admin@mail.com', '$2y$10$2c4Cv3b5mtaAGFOd9A8.0OmbwZdtZs8AikxztJ6E7wJ8PLiSHltBq', 'dsds', 'dsds', '4427', 'dfdf fss', 3, 1, '741245', 'AO', '1', '', 'U', NULL, '', '2016-04-20 14:46:02', '2016-04-20 14:46:02'),
(41, 'sdds@mail.com', '$2y$10$SK3qGtqNnorsPukhHDqnEeIwbhB5h1vNe8gzPe8uw7anXcNTvKdjS', 'sdsd fdvgdf', 'fvddf', '147852036', 'ghjghb  vghg', 4, 18, '', 'AO', '1', '', 'U', NULL, '', '2016-04-20 16:06:18', '2016-04-20 16:06:18'),
(42, 'asdf@asd.lk', '$2y$10$58zjSYlNrmtTs8ITJhpT.OKG6ixdziATVx9EvykTIdFbTSDOlbIA.', 'zcxzxc', 'czczc', '7410258963', 'Rua Frederik Engels 92-7 o', 104, 1, '700025', 'AO', '0', 's2CNTELrrLzij1jHOwvHzo5lRtt9LCcDaogXmLOP', 'U', NULL, '', '2016-05-10 12:48:49', '2016-05-10 12:48:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ev_accommodation_translation`
--
ALTER TABLE `ev_accommodation_translation`
  ADD CONSTRAINT `accommodation_translation_accommodation_id_foreign` FOREIGN KEY (`accommodation_id`) REFERENCES `ev_accommodation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_addon_translation`
--
ALTER TABLE `ev_addon_translation`
  ADD CONSTRAINT `addon_translation_addon_id_foreign` FOREIGN KEY (`addon_id`) REFERENCES `ev_addon` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_advertisement_translation`
--
ALTER TABLE `ev_advertisement_translation`
  ADD CONSTRAINT `advertisement_translation_advertisement_id_foreign` FOREIGN KEY (`advertisement_id`) REFERENCES `ev_advertisement` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_banner_translation`
--
ALTER TABLE `ev_banner_translation`
  ADD CONSTRAINT `FK_P3_P4_Cascade` FOREIGN KEY (`banner_id`) REFERENCES `ev_banner` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_email_translation`
--
ALTER TABLE `ev_email_translation`
  ADD CONSTRAINT `FK_P5_P6_Cascade` FOREIGN KEY (`email_id`) REFERENCES `ev_email` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_facilities_translation`
--
ALTER TABLE `ev_facilities_translation`
  ADD CONSTRAINT `FK_P1_P2_Cascade` FOREIGN KEY (`facilities_id`) REFERENCES `ev_facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_faq_translation`
--
ALTER TABLE `ev_faq_translation`
  ADD CONSTRAINT `FK_P8_P10_Cascade` FOREIGN KEY (`faq_id`) REFERENCES `ev_faq` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_favorite`
--
ALTER TABLE `ev_favorite`
  ADD CONSTRAINT `FK_K1_K2_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hallimages`
--
ALTER TABLE `ev_hallimages`
  ADD CONSTRAINT `FK_T7_T8_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_accommodation_relation`
--
ALTER TABLE `ev_hall_accommodation_relation`
  ADD CONSTRAINT `FK_T5_T6_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_addon_relation`
--
ALTER TABLE `ev_hall_addon_relation`
  ADD CONSTRAINT `FK_T3_T4_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_block`
--
ALTER TABLE `ev_hall_block`
  ADD CONSTRAINT `FK_T25_T26_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_facilities_relation`
--
ALTER TABLE `ev_hall_facilities_relation`
  ADD CONSTRAINT `FK_C1_C2_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_subscription_feature_relation`
--
ALTER TABLE `ev_hall_subscription_feature_relation`
  ADD CONSTRAINT `FK_T50_T51_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_subscription_relation`
--
ALTER TABLE `ev_hall_subscription_relation`
  ADD CONSTRAINT `FK_T110_T220_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_translation`
--
ALTER TABLE `ev_hall_translation`
  ADD CONSTRAINT `hall_translation_hall_id_foreign` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_type_relation`
--
ALTER TABLE `ev_hall_type_relation`
  ADD CONSTRAINT `FK_T1_T2_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_hall_type_translation`
--
ALTER TABLE `ev_hall_type_translation`
  ADD CONSTRAINT `hall_type_translation_hall_type_id_foreign` FOREIGN KEY (`hall_type_id`) REFERENCES `ev_hall_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_inner_banner_translation`
--
ALTER TABLE `ev_inner_banner_translation`
  ADD CONSTRAINT `FK_P11_P12_Cascade` FOREIGN KEY (`inner_banner_id`) REFERENCES `ev_inner_banner` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_location_translation`
--
ALTER TABLE `ev_location_translation`
  ADD CONSTRAINT `location_translation_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `ev_location` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_news_translation`
--
ALTER TABLE `ev_news_translation`
  ADD CONSTRAINT `FK_P15_P16_Cascade` FOREIGN KEY (`news_id`) REFERENCES `ev_news` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_price_range_translation`
--
ALTER TABLE `ev_price_range_translation`
  ADD CONSTRAINT `price_range_translation_price_range_id_foreign` FOREIGN KEY (`price_range_id`) REFERENCES `ev_price_range` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_review`
--
ALTER TABLE `ev_review`
  ADD CONSTRAINT `FK_T19_T20_Cascade` FOREIGN KEY (`hall_id`) REFERENCES `ev_hall` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_subscription_translation`
--
ALTER TABLE `ev_subscription_translation`
  ADD CONSTRAINT `subscription_translation_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `ev_subscription` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ev_testimonial_translation`
--
ALTER TABLE `ev_testimonial_translation`
  ADD CONSTRAINT `FK_P57_T2_Cascade` FOREIGN KEY (`testimonial_id`) REFERENCES `ev_testimonial` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
