-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 01:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawincu`
--

-- --------------------------------------------------------

--
-- Table structure for table `automations`
--

CREATE TABLE `automations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mailing_list_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipients` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `media_upload_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'image',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-archive',
  `category_for` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=product_category, 1=blog_category',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_products` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_employees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_establishment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_register_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_id`, `company_uid`, `logo`, `name`, `arabic_name`, `main_products`, `business_type`, `number_of_employees`, `year_of_establishment`, `average_lead_time`, `company_size`, `commercial_registration_number`, `tax_number`, `trade_license`, `nid`, `commercial_register_document`, `website`, `company_description`, `slug`, `is_verified`, `is_approved`, `is_active`, `rating`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Riadah Incubator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'riadah-incubator', 0, 1, 1, 0.00, NULL, '2023-06-06 01:12:04', '2023-06-06 01:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--

CREATE TABLE `company_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `subrole_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_user`
--

INSERT INTO `company_user` (`user_id`, `company_id`, `subrole_id`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Customer/User Contact',
  `contact_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Account, 1=Contact, 2=Delivery Address',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0=Male, 1=Female, 2=Others',
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_in_charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default_contact` tinyint(1) NOT NULL DEFAULT 0,
  `zone_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assign_to` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `company_id`, `contact_id`, `user_id`, `contact_type`, `title`, `name`, `gender`, `nationality`, `email`, `phone`, `mobile`, `fax`, `person_in_charge`, `address`, `address_2`, `country_id`, `state_id`, `city`, `zip_code`, `website`, `tags`, `job_position`, `tax_id`, `image`, `notes`, `contact_source`, `batch_id`, `is_default_contact`, `zone_id`, `assign_to`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 0, NULL, 'Riadah Incubator', NULL, NULL, 'info@riadahin.com', '+966551175959', NULL, NULL, NULL, 'Riadah Incubators corporate factory - Khaldiya Towers - 4th Tower - Faisal Bin Turki Road - Office No. 6 - Floor 13 - Riyadh', NULL, 1, 1, 'Riyadh', '1263', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2023-06-06 01:12:04', '2023-06-06 01:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact_mailing_list`
--

CREATE TABLE `contact_mailing_list` (
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `mailing_list_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `arabic_name`, `iso_code_2`, `iso_code_3`, `country_code`, `flag`, `slug`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', '', 'af', '', '', 'af.png', 'afghanistan', 0, NULL, NULL, NULL),
(2, 'Åland Islands', '', 'ax', '', '', 'ax.png', 'aland-islands', 0, NULL, NULL, NULL),
(3, 'Albania', '', 'al', '', '', 'al.png', 'albania', 0, NULL, NULL, NULL),
(4, 'Algeria', '', 'dz', '', '', 'dz.png', 'algeria', 0, NULL, NULL, NULL),
(5, 'American Samoa', '', 'as', '', '', 'as.png', 'american-samoa', 0, NULL, NULL, NULL),
(6, 'Andorra', '', 'ad', '', '', 'ad.png', 'andorra', 0, NULL, NULL, NULL),
(7, 'Angola', '', 'ao', '', '', 'ao.png', 'angola', 0, NULL, NULL, NULL),
(8, 'Anguilla', '', 'ai', '', '', 'ai.png', 'anguilla', 0, NULL, NULL, NULL),
(9, 'Antarctica', '', 'aq', '', '', 'aq.png', 'antarctica', 0, NULL, NULL, NULL),
(10, 'Antigua and Barbuda', '', 'ag', '', '', 'ag.png', 'antigua-and-barbuda', 0, NULL, NULL, NULL),
(11, 'Argentina', '', 'ar', '', '', 'ar.png', 'argentina', 0, NULL, NULL, NULL),
(12, 'Armenia', '', 'am', '', '', 'am.png', 'armenia', 0, NULL, NULL, NULL),
(13, 'Aruba', '', 'aw', '', '', 'aw.png', 'aruba', 0, NULL, NULL, NULL),
(14, 'Australia', '', 'au', '', '', 'au.png', 'australia', 0, NULL, NULL, NULL),
(15, 'Austria', '', 'at', '', '', 'at.png', 'austria', 0, NULL, NULL, NULL),
(16, 'Azerbaijan', '', 'az', '', '', 'az.png', 'azerbaijan', 0, NULL, NULL, NULL),
(17, 'Bahamas', '', 'bs', '', '', 'bs.png', 'bahamas', 0, NULL, NULL, NULL),
(18, 'Bahrain', '', 'bh', '', '', 'bh.png', 'bahrain', 0, NULL, NULL, NULL),
(19, 'Bangladesh', 'بنغلاديش', 'bd', 'ban', '+880', 'bd.png', 'bangladesh', 1, NULL, NULL, NULL),
(20, 'Barbados', '', 'bb', '', '', 'bb.png', 'barbados', 0, NULL, NULL, NULL),
(21, 'Belarus', '', 'by', '', '', 'by.png', 'belarus', 0, NULL, NULL, NULL),
(22, 'Belgium', '', 'be', '', '', 'be.png', 'belgium', 0, NULL, NULL, NULL),
(23, 'Belize', '', 'bz', '', '', 'bz.png', 'belize', 0, NULL, NULL, NULL),
(24, 'Benin', '', 'bj', '', '', 'bj.png', 'benin', 0, NULL, NULL, NULL),
(25, 'Bermuda', '', 'bm', '', '', 'bm.png', 'bermuda', 0, NULL, NULL, NULL),
(26, 'Bhutan', '', 'bt', '', '', 'bt.png', 'bhutan', 0, NULL, NULL, NULL),
(27, 'Bolivia', '', 'bo', '', '', 'bo.png', 'bolivia', 0, NULL, NULL, NULL),
(28, 'Bosnia and Herzegovina', '', 'ba', '', '', 'ba.png', 'bosnia-and-herzegovina', 0, NULL, NULL, NULL),
(29, 'Botswana', '', 'bw', '', '', 'bw.png', 'botswana', 0, NULL, NULL, NULL),
(30, 'Bouvet Island', '', 'bv', '', '', 'bv.png', 'bouvet-island', 0, NULL, NULL, NULL),
(31, 'Brazil', '', 'br', '', '', 'br.png', 'brazil', 0, NULL, NULL, NULL),
(32, 'British Indian Ocean Territory', '', 'io', '', '', 'io.png', 'british-indian-ocean-territory', 0, NULL, NULL, NULL),
(33, 'British Virgin Islands', '', 'vg', '', '', 'vg.png', 'british-virgin-islands', 0, NULL, NULL, NULL),
(34, 'Brunei', '', 'bn', '', '', 'bn.png', 'brunei', 0, NULL, NULL, NULL),
(35, 'Bulgaria', '', 'bg', '', '', 'bg.png', 'bulgaria', 0, NULL, NULL, NULL),
(36, 'Burkina Faso', '', 'bf', '', '', 'bf.png', 'burkina-faso', 0, NULL, NULL, NULL),
(37, 'Burundi', '', 'bi', '', '', 'bi.png', 'burundi', 0, NULL, NULL, NULL),
(38, 'Cambodia', '', 'kh', '', '', 'kh.png', 'cambodia', 0, NULL, NULL, NULL),
(39, 'Cameroon', '', 'cm', '', '', 'cm.png', 'cameroon', 0, NULL, NULL, NULL),
(40, 'Canada', '', 'ca', '', '', 'ca.png', 'canada', 0, NULL, NULL, NULL),
(41, 'Cape Verde', '', 'cv', '', '', 'cv.png', 'cape-verde', 0, NULL, NULL, NULL),
(42, 'Caribbean Netherlands', '', 'bq', '', '', 'bq.png', 'caribbean-netherlands', 0, NULL, NULL, NULL),
(43, 'Cayman Islands', '', 'ky', '', '', 'ky.png', 'cayman-islands', 0, NULL, NULL, NULL),
(44, 'Central African Republic', '', 'cf', '', '', 'cf.png', 'central-african-republic', 0, NULL, NULL, NULL),
(45, 'Chad', '', 'td', '', '', 'td.png', 'chad', 0, NULL, NULL, NULL),
(46, 'Chile', '', 'cl', '', '', 'cl.png', 'chile', 0, NULL, NULL, NULL),
(47, 'China', '', 'cn', '', '', 'cn.png', 'china', 0, NULL, NULL, NULL),
(48, 'Christmas Island', '', 'cx', '', '', 'cx.png', 'christmas-island', 0, NULL, NULL, NULL),
(49, 'Cocos Islands', '', 'cc', '', '', 'cc.png', 'cocos-islands', 0, NULL, NULL, NULL),
(50, 'Colombia', '', 'co', '', '', 'co.png', 'colombia', 0, NULL, NULL, NULL),
(51, 'Comoros', '', 'km', '', '', 'km.png', 'comoros', 0, NULL, NULL, NULL),
(52, 'Cook Islands', '', 'ck', '', '', 'ck.png', 'cook-islands', 0, NULL, NULL, NULL),
(53, 'Costa Rica', '', 'cr', '', '', 'cr.png', 'costa-rica', 0, NULL, NULL, NULL),
(54, 'Côte d\'Ivoire', '', 'ci', '', '', 'ci.png', 'cote-divoire', 0, NULL, NULL, NULL),
(55, 'Croatia', '', 'hr', '', '', 'hr.png', 'croatia', 0, NULL, NULL, NULL),
(56, 'Cuba', '', 'cu', '', '', 'cu.png', 'cuba', 0, NULL, NULL, NULL),
(57, 'Curaçao', '', 'cw', '', '', 'cw.png', 'curacao', 0, NULL, NULL, NULL),
(58, 'Cyprus', '', 'cy', '', '', 'cy.png', 'cyprus', 0, NULL, NULL, NULL),
(59, 'Czechia', '', 'cz', '', '', 'cz.png', 'czechia', 0, NULL, NULL, NULL),
(60, 'Denmark', '', 'dk', '', '', 'dk.png', 'denmark', 0, NULL, NULL, NULL),
(61, 'Djibouti', '', 'dj', '', '', 'dj.png', 'djibouti', 0, NULL, NULL, NULL),
(62, 'Dominica', '', 'dm', '', '', 'dm.png', 'dominica', 0, NULL, NULL, NULL),
(63, 'Dominican Republic', '', 'do', '', '', 'do.png', 'dominican-republic', 0, NULL, NULL, NULL),
(64, 'DR Congo', '', 'cd', '', '', 'cd.png', 'dr-congo', 0, NULL, NULL, NULL),
(65, 'Ecuador', '', 'ec', '', '', 'ec.png', 'ecuador', 0, NULL, NULL, NULL),
(66, 'Egypt', '', 'eg', '', '', 'eg.png', 'egypt', 0, NULL, NULL, NULL),
(67, 'El Salvador', '', 'sv', '', '', 'sv.png', 'el-salvador', 0, NULL, NULL, NULL),
(68, 'England', '', 'gb-eng', '', '', 'gb-eng.png', 'england', 0, NULL, NULL, NULL),
(69, 'Equatorial Guinea', '', 'gq', '', '', 'gq.png', 'equatorial-guinea', 0, NULL, NULL, NULL),
(70, 'Eritrea', '', 'er', '', '', 'er.png', 'eritrea', 0, NULL, NULL, NULL),
(71, 'Estonia', '', 'ee', '', '', 'ee.png', 'estonia', 0, NULL, NULL, NULL),
(72, 'Eswatini', '', 'sz', '', '', 'sz.png', 'eswatini', 0, NULL, NULL, NULL),
(73, 'Ethiopia', '', 'et', '', '', 'et.png', 'ethiopia', 0, NULL, NULL, NULL),
(74, 'Falkland Islands', '', 'fk', '', '', 'fk.png', 'falkland-islands', 0, NULL, NULL, NULL),
(75, 'Faroe Islands', '', 'fo', '', '', 'fo.png', 'faroe-islands', 0, NULL, NULL, NULL),
(76, 'Fiji', '', 'fj', '', '', 'fj.png', 'fiji', 0, NULL, NULL, NULL),
(77, 'Finland', '', 'fi', '', '', 'fi.png', 'finland', 0, NULL, NULL, NULL),
(78, 'France', '', 'fr', '', '', 'fr.png', 'france', 0, NULL, NULL, NULL),
(79, 'French Guiana', '', 'gf', '', '', 'gf.png', 'french-guiana', 0, NULL, NULL, NULL),
(80, 'French Polynesia', '', 'pf', '', '', 'pf.png', 'french-polynesia', 0, NULL, NULL, NULL),
(81, 'French Southern and Antarctic Lands', '', 'tf', '', '', 'tf.png', 'french-southern-and-antarctic-lands', 0, NULL, NULL, NULL),
(82, 'Gabon', '', 'ga', '', '', 'ga.png', 'gabon', 0, NULL, NULL, NULL),
(83, 'Gambia', '', 'gm', '', '', 'gm.png', 'gambia', 0, NULL, NULL, NULL),
(84, 'Georgia', '', 'ge', '', '', 'ge.png', 'georgia', 0, NULL, NULL, NULL),
(85, 'Germany', '', 'de', '', '', 'de.png', 'germany', 0, NULL, NULL, NULL),
(86, 'Ghana', '', 'gh', '', '', 'gh.png', 'ghana', 0, NULL, NULL, NULL),
(87, 'Gibraltar', '', 'gi', '', '', 'gi.png', 'gibraltar', 0, NULL, NULL, NULL),
(88, 'Greece', '', 'gr', '', '', 'gr.png', 'greece', 0, NULL, NULL, NULL),
(89, 'Greenland', '', 'gl', '', '', 'gl.png', 'greenland', 0, NULL, NULL, NULL),
(90, 'Grenada', '', 'gd', '', '', 'gd.png', 'grenada', 0, NULL, NULL, NULL),
(91, 'Guadeloupe', '', 'gp', '', '', 'gp.png', 'guadeloupe', 0, NULL, NULL, NULL),
(92, 'Guam', '', 'gu', '', '', 'gu.png', 'guam', 0, NULL, NULL, NULL),
(93, 'Guatemala', '', 'gt', '', '', 'gt.png', 'guatemala', 0, NULL, NULL, NULL),
(94, 'Guernsey', '', 'gg', '', '', 'gg.png', 'guernsey', 0, NULL, NULL, NULL),
(95, 'Guinea', '', 'gn', '', '', 'gn.png', 'guinea', 0, NULL, NULL, NULL),
(96, 'Guinea-Bissau', '', 'gw', '', '', 'gw.png', 'guinea-bissau', 0, NULL, NULL, NULL),
(97, 'Guyana', '', 'gy', '', '', 'gy.png', 'guyana', 0, NULL, NULL, NULL),
(98, 'Haiti', '', 'ht', '', '', 'ht.png', 'haiti', 0, NULL, NULL, NULL),
(99, 'Heard Island and McDonald Islands', '', 'hm', '', '', 'hm.png', 'heard-island-and-mcdonald-islands', 0, NULL, NULL, NULL),
(100, 'Honduras', '', 'hn', '', '', 'hn.png', 'honduras', 0, NULL, NULL, NULL),
(101, 'Hong Kong', '', 'hk', '', '', 'hk.png', 'hong-kong', 0, NULL, NULL, NULL),
(102, 'Hungary', '', 'hu', '', '', 'hu.png', 'hungary', 0, NULL, NULL, NULL),
(103, 'Iceland', '', 'is', '', '', 'is.png', 'iceland', 0, NULL, NULL, NULL),
(104, 'India', '', 'in', '', '', 'in.png', 'india', 0, NULL, NULL, NULL),
(105, 'Indonesia', '', 'id', '', '', 'id.png', 'indonesia', 0, NULL, NULL, NULL),
(106, 'Iran', '', 'ir', '', '', 'ir.png', 'iran', 0, NULL, NULL, NULL),
(107, 'Iraq', '', 'iq', '', '', 'iq.png', 'iraq', 0, NULL, NULL, NULL),
(108, 'Ireland', '', 'ie', '', '', 'ie.png', 'ireland', 0, NULL, NULL, NULL),
(109, 'Isle of Man', '', 'im', '', '', 'im.png', 'isle-of-man', 0, NULL, NULL, NULL),
(110, 'Israel', '', 'il', '', '', 'il.png', 'israel', 0, NULL, NULL, NULL),
(111, 'Italy', '', 'it', '', '', 'it.png', 'italy', 0, NULL, NULL, NULL),
(112, 'Jamaica', '', 'jm', '', '', 'jm.png', 'jamaica', 0, NULL, NULL, NULL),
(113, 'Japan', '', 'jp', '', '', 'jp.png', 'japan', 0, NULL, NULL, NULL),
(114, 'Jersey', '', 'je', '', '', 'je.png', 'jersey', 0, NULL, NULL, NULL),
(115, 'Jordan', '', 'jo', '', '', 'jo.png', 'jordan', 0, NULL, NULL, NULL),
(116, 'Kazakhstan', '', 'kz', '', '', 'kz.png', 'kazakhstan', 0, NULL, NULL, NULL),
(117, 'Kenya', '', 'ke', '', '', 'ke.png', 'kenya', 0, NULL, NULL, NULL),
(118, 'Kiribati', '', 'ki', '', '', 'ki.png', 'kiribati', 0, NULL, NULL, NULL),
(119, 'Kosovo', '', 'xk', '', '', 'xk.png', 'kosovo', 0, NULL, NULL, NULL),
(120, 'Kuwait', '', 'kw', '', '', 'kw.png', 'kuwait', 0, NULL, NULL, NULL),
(121, 'Kyrgyzstan', '', 'kg', '', '', 'kg.png', 'kyrgyzstan', 0, NULL, NULL, NULL),
(122, 'Laos', '', 'la', '', '', 'la.png', 'laos', 0, NULL, NULL, NULL),
(123, 'Latvia', '', 'lv', '', '', 'lv.png', 'latvia', 0, NULL, NULL, NULL),
(124, 'Lebanon', '', 'lb', '', '', 'lb.png', 'lebanon', 0, NULL, NULL, NULL),
(125, 'Lesotho', '', 'ls', '', '', 'ls.png', 'lesotho', 0, NULL, NULL, NULL),
(126, 'Liberia', '', 'lr', '', '', 'lr.png', 'liberia', 0, NULL, NULL, NULL),
(127, 'Libya', '', 'ly', '', '', 'ly.png', 'libya', 0, NULL, NULL, NULL),
(128, 'Liechtenstein', '', 'li', '', '', 'li.png', 'liechtenstein', 0, NULL, NULL, NULL),
(129, 'Lithuania', '', 'lt', '', '', 'lt.png', 'lithuania', 0, NULL, NULL, NULL),
(130, 'Luxembourg', '', 'lu', '', '', 'lu.png', 'luxembourg', 0, NULL, NULL, NULL),
(131, 'Macau', '', 'mo', '', '', 'mo.png', 'macau', 0, NULL, NULL, NULL),
(132, 'Madagascar', '', 'mg', '', '', 'mg.png', 'madagascar', 0, NULL, NULL, NULL),
(133, 'Malawi', '', 'mw', '', '', 'mw.png', 'malawi', 0, NULL, NULL, NULL),
(134, 'Malaysia', '', 'my', '', '', 'my.png', 'malaysia', 0, NULL, NULL, NULL),
(135, 'Maldives', '', 'mv', '', '', 'mv.png', 'maldives', 0, NULL, NULL, NULL),
(136, 'Mali', '', 'ml', '', '', 'ml.png', 'mali', 0, NULL, NULL, NULL),
(137, 'Malta', '', 'mt', '', '', 'mt.png', 'malta', 0, NULL, NULL, NULL),
(138, 'Marshall Islands', '', 'mh', '', '', 'mh.png', 'marshall-islands', 0, NULL, NULL, NULL),
(139, 'Martinique', '', 'mq', '', '', 'mq.png', 'martinique', 0, NULL, NULL, NULL),
(140, 'Mauritania', '', 'mr', '', '', 'mr.png', 'mauritania', 0, NULL, NULL, NULL),
(141, 'Mauritius', '', 'mu', '', '', 'mu.png', 'mauritius', 0, NULL, NULL, NULL),
(142, 'Mayotte', '', 'yt', '', '', 'yt.png', 'mayotte', 0, NULL, NULL, NULL),
(143, 'Mexico', '', 'mx', '', '', 'mx.png', 'mexico', 0, NULL, NULL, NULL),
(144, 'Micronesia', '', 'fm', '', '', 'fm.png', 'micronesia', 0, NULL, NULL, NULL),
(145, 'Moldova', '', 'md', '', '', 'md.png', 'moldova', 0, NULL, NULL, NULL),
(146, 'Monaco', '', 'mc', '', '', 'mc.png', 'monaco', 0, NULL, NULL, NULL),
(147, 'Mongolia', '', 'mn', '', '', 'mn.png', 'mongolia', 0, NULL, NULL, NULL),
(148, 'Montenegro', '', 'me', '', '', 'me.png', 'montenegro', 0, NULL, NULL, NULL),
(149, 'Montserrat', '', 'ms', '', '', 'ms.png', 'montserrat', 0, NULL, NULL, NULL),
(150, 'Morocco', '', 'ma', '', '', 'ma.png', 'morocco', 0, NULL, NULL, NULL),
(151, 'Mozambique', '', 'mz', '', '', 'mz.png', 'mozambique', 0, NULL, NULL, NULL),
(152, 'Myanmar', '', 'mm', '', '', 'mm.png', 'myanmar', 0, NULL, NULL, NULL),
(153, 'Namibia', '', 'na', '', '', 'na.png', 'namibia', 0, NULL, NULL, NULL),
(154, 'Nauru', '', 'nr', '', '', 'nr.png', 'nauru', 0, NULL, NULL, NULL),
(155, 'Nepal', '', 'np', '', '', 'np.png', 'nepal', 0, NULL, NULL, NULL),
(156, 'Netherlands', '', 'nl', '', '', 'nl.png', 'netherlands', 0, NULL, NULL, NULL),
(157, 'New Caledonia', '', 'nc', '', '', 'nc.png', 'new-caledonia', 0, NULL, NULL, NULL),
(158, 'New Zealand', '', 'nz', '', '', 'nz.png', 'new-zealand', 0, NULL, NULL, NULL),
(159, 'Nicaragua', '', 'ni', '', '', 'ni.png', 'nicaragua', 0, NULL, NULL, NULL),
(160, 'Niger', '', 'ne', '', '', 'ne.png', 'niger', 0, NULL, NULL, NULL),
(161, 'Nigeria', '', 'ng', '', '', 'ng.png', 'nigeria', 0, NULL, NULL, NULL),
(162, 'Niue', '', 'nu', '', '', 'nu.png', 'niue', 0, NULL, NULL, NULL),
(163, 'Norfolk Island', '', 'nf', '', '', 'nf.png', 'norfolk-island', 0, NULL, NULL, NULL),
(164, 'North Korea', '', 'kp', '', '', 'kp.png', 'north-korea', 0, NULL, NULL, NULL),
(165, 'North Macedonia', '', 'mk', '', '', 'mk.png', 'north-macedonia', 0, NULL, NULL, NULL),
(166, 'Northern Ireland', '', 'gb-nir', '', '', 'gb-nir.png', 'northern-ireland', 0, NULL, NULL, NULL),
(167, 'Northern Mariana Islands', '', 'mp', '', '', 'mp.png', 'northern-mariana-islands', 0, NULL, NULL, NULL),
(168, 'Norway', '', 'no', '', '', 'no.png', 'norway', 0, NULL, NULL, NULL),
(169, 'Oman', '', 'om', '', '', 'om.png', 'oman', 0, NULL, NULL, NULL),
(170, 'Pakistan', '', 'pk', '', '', 'pk.png', 'pakistan', 0, NULL, NULL, NULL),
(171, 'Palau', '', 'pw', '', '', 'pw.png', 'palau', 0, NULL, NULL, NULL),
(172, 'Palestine', '', 'ps', '', '', 'ps.png', 'palestine', 0, NULL, NULL, NULL),
(173, 'Panama', '', 'pa', '', '', 'pa.png', 'panama', 0, NULL, NULL, NULL),
(174, 'Papua New Guinea', '', 'pg', '', '', 'pg.png', 'papua-new-guinea', 0, NULL, NULL, NULL),
(175, 'Paraguay', '', 'py', '', '', 'py.png', 'paraguay', 0, NULL, NULL, NULL),
(176, 'Peru', '', 'pe', '', '', 'pe.png', 'peru', 0, NULL, NULL, NULL),
(177, 'Philippines', '', 'ph', '', '', 'ph.png', 'philippines', 0, NULL, NULL, NULL),
(178, 'Pitcairn Islands', '', 'pn', '', '', 'pn.png', 'pitcairn-islands', 0, NULL, NULL, NULL),
(179, 'Poland', '', 'pl', '', '', 'pl.png', 'poland', 0, NULL, NULL, NULL),
(180, 'Portugal', '', 'pt', '', '', 'pt.png', 'portugal', 0, NULL, NULL, NULL),
(181, 'Puerto Rico', '', 'pr', '', '', 'pr.png', 'puerto-rico', 0, NULL, NULL, NULL),
(182, 'Qatar', '', 'qa', '', '', 'qa.png', 'qatar', 0, NULL, NULL, NULL),
(183, 'Republic of the Congo', '', 'cg', '', '', 'cg.png', 'republic-of-the-congo', 0, NULL, NULL, NULL),
(184, 'Réunion', '', 're', '', '', 're.png', 'reunion', 0, NULL, NULL, NULL),
(185, 'Romania', '', 'ro', '', '', 'ro.png', 'romania', 0, NULL, NULL, NULL),
(186, 'Russia', '', 'ru', '', '', 'ru.png', 'russia', 0, NULL, NULL, NULL),
(187, 'Rwanda', '', 'rw', '', '', 'rw.png', 'rwanda', 0, NULL, NULL, NULL),
(188, 'Saint Barthélemy', '', 'bl', '', '', 'bl.png', 'saint-barthelemy', 0, NULL, NULL, NULL),
(189, 'Saint Helena, Ascension and Tristan da Cunha', '', 'sh', '', '', 'sh.png', 'saint-helena-ascension-and-tristan-da-cunha', 0, NULL, NULL, NULL),
(190, 'Saint Kitts and Nevis', '', 'kn', '', '', 'kn.png', 'saint-kitts-and-nevis', 0, NULL, NULL, NULL),
(191, 'Saint Lucia', '', 'lc', '', '', 'lc.png', 'saint-lucia', 0, NULL, NULL, NULL),
(192, 'Saint Martin', '', 'mf', '', '', 'mf.png', 'saint-martin', 0, NULL, NULL, NULL),
(193, 'Saint Pierre and Miquelon', '', 'pm', '', '', 'pm.png', 'saint-pierre-and-miquelon', 0, NULL, NULL, NULL),
(194, 'Saint Vincent and the Grenadines', '', 'vc', '', '', 'vc.png', 'saint-vincent-and-the-grenadines', 0, NULL, NULL, NULL),
(195, 'Samoa', '', 'ws', '', '', 'ws.png', 'samoa', 0, NULL, NULL, NULL),
(196, 'San Marino', '', 'sm', '', '', 'sm.png', 'san-marino', 0, NULL, NULL, NULL),
(197, 'São Tomé and Príncipe', '', 'st', '', '', 'st.png', 'sao-tome-and-principe', 0, NULL, NULL, NULL),
(198, 'Saudi Arabia', 'المملكة العربية السعودية', 'sa', 'sar', '+966', 'sa.png', 'saudi-arabia', 1, NULL, NULL, NULL),
(199, 'Scotland', '', 'gb-sct', '', '', 'gb-sct.png', 'scotland', 0, NULL, NULL, NULL),
(200, 'Senegal', '', 'sn', '', '', 'sn.png', 'senegal', 0, NULL, NULL, NULL),
(201, 'Serbia', '', 'rs', '', '', 'rs.png', 'serbia', 0, NULL, NULL, NULL),
(202, 'Seychelles', '', 'sc', '', '', 'sc.png', 'seychelles', 0, NULL, NULL, NULL),
(203, 'Sierra Leone', '', 'sl', '', '', 'sl.png', 'sierra-leone', 0, NULL, NULL, NULL),
(204, 'Singapore', '', 'sg', '', '', 'sg.png', 'singapore', 0, NULL, NULL, NULL),
(205, 'Sint Maarten', '', 'sx', '', '', 'sx.png', 'sint-maarten', 0, NULL, NULL, NULL),
(206, 'Slovakia', '', 'sk', '', '', 'sk.png', 'slovakia', 0, NULL, NULL, NULL),
(207, 'Slovenia', '', 'si', '', '', 'si.png', 'slovenia', 0, NULL, NULL, NULL),
(208, 'Solomon Islands', '', 'sb', '', '', 'sb.png', 'solomon-islands', 0, NULL, NULL, NULL),
(209, 'Somalia', '', 'so', '', '', 'so.png', 'somalia', 0, NULL, NULL, NULL),
(210, 'South Africa', '', 'za', '', '', 'za.png', 'south-africa', 0, NULL, NULL, NULL),
(211, 'South Georgia', '', 'gs', '', '', 'gs.png', 'south-georgia', 0, NULL, NULL, NULL),
(212, 'South Korea', '', 'kr', '', '', 'kr.png', 'south-korea', 0, NULL, NULL, NULL),
(213, 'South Sudan', '', 'ss', '', '', 'ss.png', 'south-sudan', 0, NULL, NULL, NULL),
(214, 'Spain', '', 'es', '', '', 'es.png', 'spain', 0, NULL, NULL, NULL),
(215, 'Sri Lanka', '', 'lk', '', '', 'lk.png', 'sri-lanka', 0, NULL, NULL, NULL),
(216, 'Sudan', '', 'sd', '', '', 'sd.png', 'sudan', 0, NULL, NULL, NULL),
(217, 'Suriname', '', 'sr', '', '', 'sr.png', 'suriname', 0, NULL, NULL, NULL),
(218, 'Svalbard and Jan Mayen', '', 'sj', '', '', 'sj.png', 'svalbard-and-jan-mayen', 0, NULL, NULL, NULL),
(219, 'Sweden', '', 'se', '', '', 'se.png', 'sweden', 0, NULL, NULL, NULL),
(220, 'Switzerland', '', 'ch', '', '', 'ch.png', 'switzerland', 0, NULL, NULL, NULL),
(221, 'Syria', '', 'sy', '', '', 'sy.png', 'syria', 0, NULL, NULL, NULL),
(222, 'Taiwan', '', 'tw', '', '', 'tw.png', 'taiwan', 0, NULL, NULL, NULL),
(223, 'Tajikistan', '', 'tj', '', '', 'tj.png', 'tajikistan', 0, NULL, NULL, NULL),
(224, 'Tanzania', '', 'tz', '', '', 'tz.png', 'tanzania', 0, NULL, NULL, NULL),
(225, 'Thailand', '', 'th', '', '', 'th.png', 'thailand', 0, NULL, NULL, NULL),
(226, 'Timor-Leste', '', 'tl', '', '', 'tl.png', 'timor-leste', 0, NULL, NULL, NULL),
(227, 'Togo', '', 'tg', '', '', 'tg.png', 'togo', 0, NULL, NULL, NULL),
(228, 'Tokelau', '', 'tk', '', '', 'tk.png', 'tokelau', 0, NULL, NULL, NULL),
(229, 'Tonga', '', 'to', '', '', 'to.png', 'tonga', 0, NULL, NULL, NULL),
(230, 'Trinidad and Tobago', '', 'tt', '', '', 'tt.png', 'trinidad-and-tobago', 0, NULL, NULL, NULL),
(231, 'Tunisia', '', 'tn', '', '', 'tn.png', 'tunisia', 0, NULL, NULL, NULL),
(232, 'Turkey', '', 'tr', '', '', 'tr.png', 'turkey', 0, NULL, NULL, NULL),
(233, 'Turkmenistan', '', 'tm', '', '', 'tm.png', 'turkmenistan', 0, NULL, NULL, NULL),
(234, 'Turks and Caicos Islands', '', 'tc', '', '', 'tc.png', 'turks-and-caicos-islands', 0, NULL, NULL, NULL),
(235, 'Tuvalu', '', 'tv', '', '', 'tv.png', 'tuvalu', 0, NULL, NULL, NULL),
(236, 'Uganda', '', 'ug', '', '', 'ug.png', 'uganda', 0, NULL, NULL, NULL),
(237, 'Ukraine', '', 'ua', '', '', 'ua.png', 'ukraine', 0, NULL, NULL, NULL),
(238, 'United Arab Emirates', '', 'ae', '', '', 'ae.png', 'united-arab-emirates', 0, NULL, NULL, NULL),
(239, 'United Kingdom', '', 'gb', '', '', 'gb.png', 'united-kingdom', 0, NULL, NULL, NULL),
(240, 'United States', 'الولايات المتحدة', 'us', 'usa', '+10', 'us.png', 'united-states', 1, NULL, NULL, NULL),
(241, 'United States Minor Outlying Islands', '', 'um', '', '', 'um.png', 'united-states-minor-outlying-islands', 0, NULL, NULL, NULL),
(242, 'United States Virgin Islands', '', 'vi', '', '', 'vi.png', 'united-states-virgin-islands', 0, NULL, NULL, NULL),
(243, 'Uruguay', '', 'uy', '', '', 'uy.png', 'uruguay', 0, NULL, NULL, NULL),
(244, 'Uzbekistan', '', 'uz', '', '', 'uz.png', 'uzbekistan', 0, NULL, NULL, NULL),
(245, 'Vanuatu', '', 'vu', '', '', 'vu.png', 'vanuatu', 0, NULL, NULL, NULL),
(246, 'Vatican City', '', 'va', '', '', 'va.png', 'vatican-city', 0, NULL, NULL, NULL),
(247, 'Venezuela', '', 've', '', '', 've.png', 'venezuela', 0, NULL, NULL, NULL),
(248, 'Vietnam', '', 'vn', '', '', 'vn.png', 'vietnam', 0, NULL, NULL, NULL),
(249, 'Wales', '', 'gb-wls', '', '', 'gb-wls.png', 'wales', 0, NULL, NULL, NULL),
(250, 'Wallis and Futuna', '', 'wf', '', '', 'wf.png', 'wallis-and-futuna', 0, NULL, NULL, NULL),
(251, 'Western Sahara', '', 'eh', '', '', 'eh.png', 'western-sahara', 0, NULL, NULL, NULL),
(252, 'Yemen', '', 'ye', '', '', 'ye.png', 'yemen', 0, NULL, NULL, NULL),
(253, 'Zambia', '', 'zm', '', '', 'zm.png', 'zambia', 0, NULL, NULL, NULL),
(254, 'Zimbabwe', '', 'zw', '', '', 'zw.png', 'zimbabwe', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(8,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `position`, `exchange_rate`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', '$', 'left', '1.00', 1, '2023-06-06 01:12:04', '2023-06-06 01:12:04'),
(2, 'Bangladeshi Taka', 'BDT', '৳', 'left', '85.67', 1, '2023-06-06 01:12:04', '2023-06-06 01:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_queries`
--

CREATE TABLE `customer_queries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `customer_query` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_query_replies`
--

CREATE TABLE `customer_query_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_query_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `finance_requests`
--

CREATE TABLE `finance_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `country_id`, `name`, `code`, `direction`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 240, 'English', 'en', 'ltr', 1, NULL, NULL),
(2, 198, 'Arabic', 'ar', 'rtl', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pipeline_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'sales person',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_value` decimal(12,2) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `lead_stage_id` bigint(20) UNSIGNED NOT NULL,
  `expected_closing_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_sources`
--

CREATE TABLE `lead_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_stages`
--

CREATE TABLE `lead_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pipeline_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_lists`
--

CREATE TABLE `mailing_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mailing_list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_uploads`
--

CREATE TABLE `media_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_uploads`
--

INSERT INTO `media_uploads` (`id`, `user_id`, `company_id`, `original_name`, `file_name`, `file_size`, `file_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'dummy-avatar', 'LzPlLuRh38jLNvnkJRHLhrAVCIBBbHOMMM03GZCp.png', 6071, 'image', NULL, '2023-06-06 02:23:25', '2023-06-06 02:23:25');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_01_000001_create_notifications_table', 1),
(6, '2022_01_01_000002_add_columns_to_users', 1),
(7, '2022_01_01_000002_create_notification_user_table', 1),
(8, '2022_01_01_000003_create_countries_table', 1),
(9, '2022_01_01_000003_create_translations_table', 1),
(10, '2022_01_01_000004_create_roles_table', 1),
(11, '2022_01_01_000006_create_languages_table', 1),
(12, '2022_01_01_000007_create_permissions_table', 1),
(13, '2022_01_01_000008_create_states_table', 1),
(14, '2022_01_01_000009_create_cities_table', 1),
(15, '2022_01_01_000010_create_companies_table', 1),
(16, '2022_01_01_000010_create_subroles_table', 1),
(17, '2022_01_01_000011_create_role_user_table', 1),
(18, '2022_01_01_000012_create_company_user_table', 1),
(19, '2022_01_01_000013_create_permission_role_table', 1),
(20, '2022_01_01_000014_create_permission_subrole_table', 1),
(21, '2022_01_01_000015_create_settings_table', 1),
(22, '2022_01_01_000016_create_company_settings_table', 1),
(23, '2022_01_01_000016_create_currencies_table', 1),
(24, '2022_01_01_000017_create_contacts_table', 1),
(25, '2022_01_01_000017_create_media_uploads_table', 1),
(26, '2022_01_01_000018_create_folders_table', 1),
(27, '2022_01_01_000019_create_senders_table', 1),
(28, '2022_01_01_000020_create_mailing_lists_table', 1),
(29, '2022_01_01_000021_create_contact_mailing_list_table', 1),
(30, '2022_01_01_000022_create_subscribers_table', 1),
(31, '2022_01_01_000023_create_templates_table', 1),
(32, '2022_01_01_000024_create_automations_table', 1),
(33, '2022_01_01_000025_create_campaigns_table', 1),
(34, '2022_01_01_000026_create_pipelines_table', 1),
(35, '2022_01_01_000027_create_lead_stages_table', 1),
(36, '2022_01_01_000028_create_lead_sources_table', 1),
(37, '2022_01_01_000029_create_leads_table', 1),
(38, '2022_01_01_000035_create_categories_table', 1),
(39, '2022_01_01_000049_create_zones_table', 1),
(40, '2022_01_01_000050_create_zone_locations_table', 1),
(41, '2022_01_01_000055_create_customer_queries_table', 1),
(42, '2022_01_01_000055_create_support_tickets_table', 1),
(43, '2022_01_01_000056_create_customer_query_replies_table', 1),
(44, '2022_01_01_000056_create_support_ticket_replies_table', 1),
(45, '2022_01_01_000057_create_contact_messages_table', 1),
(46, '2022_01_01_000061_create_pages_table', 1),
(47, '2022_01_01_000062_create_site_menus_table', 1),
(48, '2022_01_01_000063_create_page_rows_table', 1),
(49, '2022_01_01_000064_create_page_columns_table', 1),
(50, '2022_02_08_180716_create_posts_table', 1),
(51, '2022_02_08_180955_create_post_comments_table', 1),
(52, '2022_02_08_181124_create_category_post_table', 1),
(53, '2022_02_15_074709_create_tags_table', 1),
(54, '2022_02_15_074759_create_post_tag_table', 1),
(55, '2021_08_15_180001_create_property_types_table', 2),
(56, '2021_08_15_180011_create_properties_table', 2),
(57, '2023_06_25_073747_create_finance_requests_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=message,1=reminder',
  `send_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_sent` tinyint(1) NOT NULL DEFAULT 0,
  `notified_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=notification,1=email,2=both',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_user`
--

CREATE TABLE `notification_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `customization_route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `url`, `language_code`, `name`, `title`, `keywords`, `description`, `image`, `content`, `is_active`, `customization_route`, `created_at`, `updated_at`) VALUES
(1, NULL, 'en', 'Home', 'Asoug B2B Ecommerce', 'asoug,b2b,ecommerce', 'Asoug is a B2B Ecommerce Platform', NULL, '<!DOCTYPE html>\r\n            <html>\r\n            <head>\r\n            </head>\r\n            <body>\r\n            <h2 style=\"text-align: center;\">&nbsp;</h2>\r\n            <p>&nbsp;</p>\r\n            <h2 style=\"text-align: center;\">Welcome to our <strong>Homapage</strong></h2>\r\n            <p style=\"text-align: center;\">Thank you for visiting our site</p>\r\n            <p style=\"text-align: center;\">&nbsp;</p>\r\n            <p style=\"text-align: center;\">&nbsp;</p>\r\n            </body>\r\n            </html>', 1, 'welcome.customize', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_columns`
--

CREATE TABLE `page_columns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_row_id` bigint(20) UNSIGNED DEFAULT NULL,
  `column_index` tinyint(4) NOT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_data` tinyint(1) NOT NULL DEFAULT 0,
  `data_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_rows`
--

CREATE TABLE `page_rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `row_index` tinyint(4) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'access_permission', NULL, NULL, NULL),
(2, 'create_permission', NULL, NULL, NULL),
(3, 'edit_permission', NULL, NULL, NULL),
(4, 'delete_permission', NULL, NULL, NULL),
(5, 'access_role', NULL, NULL, NULL),
(6, 'create_role', NULL, NULL, NULL),
(7, 'edit_role', NULL, NULL, NULL),
(8, 'delete_role', NULL, NULL, NULL),
(9, 'access_subrole', NULL, NULL, NULL),
(10, 'create_subrole', NULL, NULL, NULL),
(11, 'edit_subrole', NULL, NULL, NULL),
(12, 'delete_subrole', NULL, NULL, NULL),
(13, 'access_user', NULL, NULL, NULL),
(14, 'create_user', NULL, NULL, NULL),
(15, 'edit_user', NULL, NULL, NULL),
(16, 'delete_user', NULL, NULL, NULL),
(17, 'access_company', NULL, NULL, NULL),
(18, 'create_company', NULL, NULL, NULL),
(19, 'edit_company', NULL, NULL, NULL),
(20, 'delete_company', NULL, NULL, NULL),
(21, 'access_contact', NULL, NULL, NULL),
(22, 'create_contact', NULL, NULL, NULL),
(23, 'edit_contact', NULL, NULL, NULL),
(24, 'delete_contact', NULL, NULL, NULL),
(25, 'access_account', NULL, NULL, NULL),
(26, 'create_account', NULL, NULL, NULL),
(27, 'edit_account', NULL, NULL, NULL),
(28, 'delete_account', NULL, NULL, NULL),
(29, 'access_lead', NULL, NULL, NULL),
(30, 'create_lead', NULL, NULL, NULL),
(31, 'edit_lead', NULL, NULL, NULL),
(32, 'delete_lead', NULL, NULL, NULL),
(33, 'access_lead_source', NULL, NULL, NULL),
(34, 'create_lead_source', NULL, NULL, NULL),
(35, 'edit_lead_source', NULL, NULL, NULL),
(36, 'delete_lead_source', NULL, NULL, NULL),
(37, 'access_lead_stage', NULL, NULL, NULL),
(38, 'create_lead_stage', NULL, NULL, NULL),
(39, 'edit_lead_stage', NULL, NULL, NULL),
(40, 'delete_lead_stage', NULL, NULL, NULL),
(41, 'access_pipeline', NULL, NULL, NULL),
(42, 'create_pipeline', NULL, NULL, NULL),
(43, 'edit_pipeline', NULL, NULL, NULL),
(44, 'delete_pipeline', NULL, NULL, NULL),
(45, 'access_sender', NULL, NULL, NULL),
(46, 'create_sender', NULL, NULL, NULL),
(47, 'edit_sender', NULL, NULL, NULL),
(48, 'delete_sender', NULL, NULL, NULL),
(49, 'access_mailing_list', NULL, NULL, NULL),
(50, 'create_mailing_list', NULL, NULL, NULL),
(51, 'edit_mailing_list', NULL, NULL, NULL),
(52, 'delete_mailing_list', NULL, NULL, NULL),
(53, 'access_subscriber', NULL, NULL, NULL),
(54, 'create_subscriber', NULL, NULL, NULL),
(55, 'edit_subscriber', NULL, NULL, NULL),
(56, 'delete_subscriber', NULL, NULL, NULL),
(57, 'access_template', NULL, NULL, NULL),
(58, 'create_template', NULL, NULL, NULL),
(59, 'edit_template', NULL, NULL, NULL),
(60, 'delete_template', NULL, NULL, NULL),
(61, 'access_campaign', NULL, NULL, NULL),
(62, 'create_campaign', NULL, NULL, NULL),
(63, 'edit_campaign', NULL, NULL, NULL),
(64, 'delete_campaign', NULL, NULL, NULL),
(65, 'access_event', NULL, NULL, NULL),
(66, 'create_event', NULL, NULL, NULL),
(67, 'edit_event', NULL, NULL, NULL),
(68, 'delete_event', NULL, NULL, NULL),
(69, 'access_activity', NULL, NULL, NULL),
(70, 'create_activity', NULL, NULL, NULL),
(71, 'edit_activity', NULL, NULL, NULL),
(72, 'delete_activity', NULL, NULL, NULL),
(73, 'access_order', NULL, NULL, NULL),
(74, 'create_order', NULL, NULL, NULL),
(75, 'edit_order', NULL, NULL, NULL),
(76, 'delete_order', NULL, NULL, NULL),
(77, 'access_coupon', NULL, NULL, NULL),
(78, 'create_coupon', NULL, NULL, NULL),
(79, 'edit_coupon', NULL, NULL, NULL),
(80, 'delete_coupon', NULL, NULL, NULL),
(81, 'access_brand', NULL, NULL, NULL),
(82, 'create_brand', NULL, NULL, NULL),
(83, 'edit_brand', NULL, NULL, NULL),
(84, 'delete_brand', NULL, NULL, NULL),
(85, 'access_category', NULL, NULL, NULL),
(86, 'create_category', NULL, NULL, NULL),
(87, 'edit_category', NULL, NULL, NULL),
(88, 'delete_category', NULL, NULL, NULL),
(89, 'access_unit', NULL, NULL, NULL),
(90, 'create_unit', NULL, NULL, NULL),
(91, 'edit_unit', NULL, NULL, NULL),
(92, 'delete_unit', NULL, NULL, NULL),
(93, 'access_product', NULL, NULL, NULL),
(94, 'create_product', NULL, NULL, NULL),
(95, 'edit_product', NULL, NULL, NULL),
(96, 'delete_product', NULL, NULL, NULL),
(97, 'access_wishlist', NULL, NULL, NULL),
(98, 'create_wishlist', NULL, NULL, NULL),
(99, 'edit_wishlist', NULL, NULL, NULL),
(100, 'delete_wishlist', NULL, NULL, NULL),
(101, 'access_support_ticket', NULL, NULL, NULL),
(102, 'create_support_ticket', NULL, NULL, NULL),
(103, 'delete_support_ticket', NULL, NULL, NULL),
(104, 'reply_support_ticket', NULL, NULL, NULL),
(105, 'access_contact_message', NULL, NULL, NULL),
(106, 'delete_contact_message', NULL, NULL, NULL),
(107, 'reply_contact_message', NULL, NULL, NULL),
(108, 'access_payment_method', NULL, NULL, NULL),
(109, 'edit_payment_method', NULL, NULL, NULL),
(110, 'access_zone', NULL, NULL, NULL),
(111, 'create_zone', NULL, NULL, NULL),
(112, 'edit_zone', NULL, NULL, NULL),
(113, 'delete_zone', NULL, NULL, NULL),
(114, 'access_shipping_method', NULL, NULL, NULL),
(115, 'create_shipping_method', NULL, NULL, NULL),
(116, 'edit_shipping_method', NULL, NULL, NULL),
(117, 'delete_shipping_method', NULL, NULL, NULL),
(118, 'access_shipping_class', NULL, NULL, NULL),
(119, 'create_shipping_class', NULL, NULL, NULL),
(120, 'edit_shipping_class', NULL, NULL, NULL),
(121, 'delete_shipping_class', NULL, NULL, NULL),
(122, 'access_menu', NULL, NULL, NULL),
(123, 'create_menu', NULL, NULL, NULL),
(124, 'edit_menu', NULL, NULL, NULL),
(125, 'delete_menu', NULL, NULL, NULL),
(126, 'access_page', NULL, NULL, NULL),
(127, 'create_page', NULL, NULL, NULL),
(128, 'edit_page', NULL, NULL, NULL),
(129, 'delete_page', NULL, NULL, NULL),
(130, 'access_blog_category', NULL, NULL, NULL),
(131, 'create_blog_category', NULL, NULL, NULL),
(132, 'edit_blog_category', NULL, NULL, NULL),
(133, 'delete_blog_category', NULL, NULL, NULL),
(134, 'access_blog_tag', NULL, NULL, NULL),
(135, 'create_blog_tag', NULL, NULL, NULL),
(136, 'edit_blog_tag', NULL, NULL, NULL),
(137, 'delete_blog_tag', NULL, NULL, NULL),
(138, 'access_blog_post', NULL, NULL, NULL),
(139, 'create_blog_post', NULL, NULL, NULL),
(140, 'edit_blog_post', NULL, NULL, NULL),
(141, 'delete_blog_post', NULL, NULL, NULL),
(142, 'access_flash_deal', NULL, NULL, NULL),
(143, 'create_flash_deal', NULL, NULL, NULL),
(144, 'edit_flash_deal', NULL, NULL, NULL),
(145, 'delete_flash_deal', NULL, NULL, NULL),
(146, 'access_customer_query', NULL, NULL, NULL),
(147, 'create_customer_query', NULL, NULL, NULL),
(148, 'reply_customer_query', NULL, NULL, NULL),
(149, 'access_menu', NULL, NULL, NULL),
(150, 'create_menu', NULL, NULL, NULL),
(151, 'edit_menu', NULL, NULL, NULL),
(152, 'delete_menu', NULL, NULL, NULL),
(153, 'access_page', NULL, NULL, NULL),
(154, 'create_page', NULL, NULL, NULL),
(155, 'edit_page', NULL, NULL, NULL),
(156, 'delete_page', NULL, NULL, NULL),
(157, 'access_address', NULL, NULL, NULL),
(158, 'create_address', NULL, NULL, NULL),
(159, 'edit_address', NULL, NULL, NULL),
(160, 'delete_address', NULL, NULL, NULL),
(161, 'access_attribute', NULL, NULL, NULL),
(162, 'create_attribute', NULL, NULL, NULL),
(163, 'edit_attribute', NULL, NULL, NULL),
(164, 'delete_attribute', NULL, NULL, NULL),
(165, 'manage_location', NULL, NULL, NULL),
(166, 'manage_setting', NULL, NULL, NULL),
(167, 'customize_welcome_page', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167);

-- --------------------------------------------------------

--
-- Table structure for table `permission_subrole`
--

CREATE TABLE `permission_subrole` (
  `subrole_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pipelines`
--

CREATE TABLE `pipelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_upload_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `post_comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_type_id` bigint(20) UNSIGNED NOT NULL,
  `country` bigint(20) UNSIGNED DEFAULT NULL,
  `state` bigint(20) UNSIGNED DEFAULT NULL,
  `city` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `construction_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` enum('For Sale','For Rent') COLLATE utf8mb4_unicode_ci DEFAULT 'For Sale',
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `electricity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `water` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bedrooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathrooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `livingroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guestroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landarea` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `builduparea` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sqrprice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenceno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixtures` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixtures_ar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streetwidth` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facing` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `property_type_id`, `country`, `state`, `city`, `title`, `title_ar`, `slug`, `construction_type`, `purpose`, `images`, `video`, `electricity`, `water`, `length`, `width`, `age`, `bedrooms`, `bathrooms`, `livingroom`, `guestroom`, `landarea`, `builduparea`, `description`, `description_ar`, `price`, `sqrprice`, `referenceno`, `map_code`, `features`, `features_ar`, `fixtures`, `fixtures_ar`, `street`, `streetwidth`, `facing`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', '3', NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, '1', '18 m', 'North Near from City town', 'Active', '2023-06-14 04:02:07', '2023-06-23 22:58:08'),
(6, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi-01', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', NULL, NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-14 04:02:07', '2023-06-14 04:02:07'),
(7, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi-3', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', NULL, NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-14 04:02:07', '2023-06-14 04:02:07'),
(8, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi-04', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', NULL, NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-14 04:02:07', '2023-06-14 04:02:07'),
(9, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi-5', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', NULL, NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-14 04:02:07', '2023-06-14 04:02:07'),
(10, 1, 3, 198, 1, NULL, 'Villa for Sale in Al Suwaidi', 'Villa for Sale in Al Suwaidi', 'villa-for-sale-in-al-suwaidi-06', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-6489901fcf997.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd20e0.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd2a34.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd31ce.jpg\",\"uploads\\/properties\\/images\\/properties-6489901fd374a.jpg\"]', NULL, 'Yes', 'Yes', '10', '10', '20', '4', '2', '2', '2', NULL, NULL, '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '<p>Villa for Sale in Al Suwaidi Dist. , Riyadh on a 20m street with an area of 305m&sup2; with 5 bedroom(s), 3 living room(s), and 5 bathrooms</p>', '165000', '1650', '23423', '!1m18!1m12!1m3!1d116565.6732926912!2d45.21130944084294!3d24.077666278256764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e28385415ebd55b%3A0x69568952a54287ca!2sAl%20Quwaiiyah%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1686736637198!5m2!1sen!2sbd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-14 04:02:07', '2023-06-14 04:02:07'),
(11, 1, 3, 198, 28, NULL, 'Four rooms, two bathrooms, a full kitchen, and monsters planted', 'اربع غرف ودورتين مياة ومطبخ راكب وحوش مزروع الطائف', 'four-rooms-two-bathrooms-a-full-kitchen-and-monsters-planted', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64990e3853e0b.webp\",\"uploads\\/properties\\/images\\/properties-64990e38686c2.webp\",\"uploads\\/properties\\/images\\/properties-64990e386a2d4.webp\",\"uploads\\/properties\\/images\\/properties-64990e386b437.webp\",\"uploads\\/properties\\/images\\/properties-64990e386c1ee.webp\",\"uploads\\/properties\\/images\\/properties-64990e386ce96.webp\"]', NULL, 'Yes', 'Yes', NULL, NULL, '10', '4', '1', '2', NULL, '1200', NULL, '<p><span style=\"color: #525762; font-family: sky, -apple-system, system-ui, \'Segoe UI\', \'Helvetica Neue\', sans-serif; font-size: 20px; white-space-collapse: preserve; background-color: #ffffff;\">4 Rooms Living Room Two Bathrooms Property Age 0 Years Street Residential Residence Families Yearly Rent Advertiser Type owner</span></p>', '<p><span style=\"color: #525762; font-family: sky, -apple-system, system-ui, \'Segoe UI\', \'Helvetica Neue\', sans-serif; font-size: 20px; white-space-collapse: preserve; background-color: #ffffff;\">4 غرف صالة دورتين مياة عمر العقار 0 سنة شارع سكني سكن عوائل إيجار سنوي صفة المعلن مالك</span></p>', '20000', '100', '23423', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-06-25 22:04:08', '2023-06-25 22:04:08'),
(12, 1, 4, 198, NULL, NULL, 'Al Harrah Neighborhood, Madina, Al Madinah Region', 'حي الحرة الشرقية، المدينة المنورة، منطقة المدينة', 'al-harrah-neighborhood-madina-al-madinah-region', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64a38d3842b8b.webp\",\"uploads\\/properties\\/images\\/properties-64a38d38465c3.webp\"]', NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>Plot Width: 100 meters</p>\r\n<p>Plot Length: 40 meters</p>\r\n<p>Street Width: 100 meters</p>\r\n<p>Property Facade: Eastern Facade&nbsp;</p>\r\n<p>Amenities: Freehold,&nbsp; Nearby Public Transport,&nbsp; Close to Metro Station,&nbsp; Close to Main Roads,&nbsp; Nearby Mosque,&nbsp; Valet Service</p>\r\n<p>Debts and obligations on the property that are not documented in property title deed? No</p>\r\n<p>Is there a mortgage or restriction that prevents or limits the disposal or use of the property? No</p>\r\n<p>Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? No</p>', '<p><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ارض سكنية تجارية للبيع مقاهي او مطاعم</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ثلاث واجهات ممكن اقامة مشروع سكني وفندقي ومطاعم على الارض موقع متميز جدا فرصة نادرة المساحة قرابة 4300 الف متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">حدود العقار (العرض بالمتر): 100 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> حدود العقار (الطول بالمتر): 40 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> عرض الشارع: 100 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">واجهة العقار : واجهة شرقية </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المزايا والخدمات: تملك حر، مواصلات نقل عامة قريبة، قريب من المترو، قريب من الطرق الرئيسية، مسجد قريب، خدمة اصطفاف السيارات</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أية حقوق او التزامات على العقار غير موثقة في سند الملكية أو وثيقة العقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل يوجد أي رهن او تمويل أو قيد من شأنه أن يمنع او يحد من التصرف او الانتفاع بالعقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟لا</span></p>', '13,782,400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:08:16', '2023-07-03 21:10:22'),
(13, 1, 4, 198, NULL, NULL, 'Al Aziziyah, Madina, Al Madinah Region', 'العزيزية، المدينة المنورة، منطقة المدينة', 'al-aziziyah-madina-al-madinah-region', 'Under Construction', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64a3900986f49.webp\",\"uploads\\/properties\\/images\\/properties-64a3900989bea.webp\",\"uploads\\/properties\\/images\\/properties-64a390098a5bd.webp\"]', NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p>&nbsp;Residential Commercial Land For Sale In Al Aziziyah, Madina</p>\r\n<p>&nbsp;</p>\r\n<p>Area: 481 SQM</p>\r\n<p>&nbsp;</p>\r\n<p>On King Khalid Road</p>\r\n<p>Width 100M</p>\r\n<p>On the facade, 3 streets</p>\r\n<p>&nbsp;</p>\r\n<p>Price: 1 Million And 250 Thousand SAR</p>\r\n<p>&nbsp;</p>\r\n<p>Plot Width: 0 meters</p>\r\n<p>Plot Length: 0 meters</p>\r\n<p>Street Width: 100 meters</p>\r\n<p>Property Facade: Northern Facade&nbsp;</p>\r\n<p>Property Age: 0 month(s)</p>\r\n<p>Amenities:&nbsp;</p>\r\n<p>Debts and obligations on the property that are not documented in property title deed? No</p>\r\n<p>Is there a mortgage or restriction that prevents or limits the disposal or use of the property? No</p>\r\n<p>Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? No</p>', '<p>أرض سكنية تجارية للبيع في العزيزية، المدينة المنورة</p>\r\n<p>&nbsp;</p>\r\n<p>المساحة: 481 متر مربع</p>\r\n<p>&nbsp;</p>\r\n<p>على طريق الملك خالد</p>\r\n<p>عرض 100م</p>\r\n<p>على الواجهة، 3 شوارع</p>\r\n<p>&nbsp;</p>\r\n<p>السعر: 1 مليون و250 ألف ريال</p>\r\n<p>&nbsp;</p>\r\n<p>حدود العقار (العرض بالمتر): 0 متر</p>\r\n<p>&nbsp;حدود العقار (الطول بالمتر): 0 متر</p>\r\n<p>&nbsp;عرض الشارع:&nbsp; 100 متر</p>\r\n<p>واجهة العقار : واجهة شمالية&nbsp;</p>\r\n<p>عمر العقار: 0شهور</p>\r\n<p>المزايا والخدمات:&nbsp;</p>\r\n<p>&nbsp;هل هناك أية حقوق او التزامات على العقار غير موثقة في سند الملكية أو وثيقة العقار؟لا</p>\r\n<p>&nbsp;هل يوجد أي رهن او تمويل أو قيد من شأنه أن يمنع او يحد من التصرف او الانتفاع بالعقار؟لا</p>\r\n<p>&nbsp;هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟لا</p>\r\n<p>&nbsp;</p>', '1,250,000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:20:41', '2023-07-03 21:21:49'),
(14, 1, 2, 198, NULL, NULL, 'Villa For Sale In Tuwaiq, West Riyadh', 'طويق، غرب الرياض، الرياض، منطقة الرياض', 'villa-for-sale-in-tuwaiq-west-riyadh', 'Ready', 'For Rent', '[\"uploads\\/properties\\/images\\/properties-64a3931a3d1de.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a3f093.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a3f8a4.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a3ffff.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a4084a.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a411d0.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a41b61.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a422b6.webp\",\"uploads\\/properties\\/images\\/properties-64a3931a42ae4.webp\"]', NULL, NULL, 'No', NULL, NULL, '2', '4', '4', NULL, NULL, '250', NULL, '<p><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Villa For Sale In Tuwaiq, West Riyadh</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Area: 250 SQM</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Ground floor: a car garage - two men\'s living rooms - a dining hall - a hall</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Women\'s living room - kitchen - warehouse - 3 bathrooms</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">First floor: 4 bedrooms - 4 bathrooms - hall</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Second floor: maid\'s room - laundry room - hall - rooftop</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">elevator</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Width: 10 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Length: 25 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Street Width: 15 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Facade: Western Facade </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Age: 2 month(s)</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Amenities: Service Elevators, Laundry Room, Maid Room, Storage Areas, Private garage</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Debts and obligations on the property that are not documented in property title deed? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Is there a mortgage or restriction that prevents or limits the disposal or use of the property? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? No</span></p>', '<p><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">فيلا للبيع بحي طويق، غرب الرياض</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المساحة : 250 متر مربع</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدور الأرضي: كراج سيارة - مجلسين رجال - صالة طعام - صالة</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">مجلس نساء - مطبخ - مستودع - 3 دورات مياه</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدور الأول: 4 غرف نوم - 4 دورات مياه - صالة </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدور الثاني: غرفة خادمة - غرفة غسيل - صالة - سطح</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">مصعد</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">حدود العقار (العرض بالمتر): 10 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> حدود العقار (الطول بالمتر): 25 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> عرض الشارع: 15 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">واجهة العقار : واجهة غربية </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عمر العقار: 2شهور</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المزايا والخدمات: مصاعد خدمات، غرفة غسيل، غرفة خادمة، غرفة تخزين، كراج خاص</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أية حقوق او التزامات على العقار غير موثقة في سند الملكية أو وثيقة العقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل يوجد أي رهن او تمويل أو قيد من شأنه أن يمنع او يحد من التصرف او الانتفاع بالعقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟لا</span></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:33:24', '2023-07-03 21:33:46'),
(15, 1, 6, 198, 24, NULL, 'Al Jarf, Madina, Al Madinah Region', 'الجرف، المدينة المنورة، منطقة المدينة', 'al-jarf-madina-al-madinah-region', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64a393f72de91.webp\",\"uploads\\/properties\\/images\\/properties-64a393f7304b2.webp\",\"uploads\\/properties\\/images\\/properties-64a393f73107a.webp\",\"uploads\\/properties\\/images\\/properties-64a393f731a8d.webp\"]', NULL, 'Yes', 'Yes', NULL, NULL, NULL, '3', '4', NULL, NULL, NULL, NULL, '<p><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Commercial building on Al Jarf Al Madina</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">University Road</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Consists of two floors</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">On two streets, University Road Street and Ten Street entrance to the neighborhood</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Area: 250 sqm</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Two apartments, each apartment consists of 3 rooms + hall + kitchen + two bathrooms</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Annual income: 130 thousand SAR</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">It has an ATM + fondant sweets + Al-Fawal bakery</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Width: 0 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Length: 0 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Street Width: 0 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Facade: Northern Facade </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Age: 0 month(s)</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Amenities: </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Debts and obligations on the property that are not documented in property title deed? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Is there a mortgage or restriction that prevents or limits the disposal or use of the property? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? No</span></p>', '<p><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عمارة تجارية بالجرف على المدينة </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">طريق الجامعات</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">مكونة من دورين</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">على شارعين شارع طريق الجامعات وشارع عشرة مدخل الحارة</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المساحة: 250 متر مربع</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">شقتين كل شقة تتكون من 3 غرف + صالة + مطبخ + دورتين مياه </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدخل السنوي: 130 ألف ريال</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">يوجد بها صراف ألي + حلويات فوندانت + مخبز الفوال</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">حدود العقار (العرض بالمتر): 0 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> حدود العقار (الطول بالمتر): 0 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> عرض الشارع: 0 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">واجهة العقار : واجهة شمالية </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عمر العقار: 0شهور</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المزايا والخدمات: </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أية حقوق او التزامات على العقار غير موثقة في سند الملكية أو وثيقة العقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل يوجد أي رهن او تمويل أو قيد من شأنه أن يمنع او يحد من التصرف او الانتفاع بالعقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟لا</span></p>', '2,000,000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:37:27', '2023-07-03 21:37:27');
INSERT INTO `properties` (`id`, `user_id`, `property_type_id`, `country`, `state`, `city`, `title`, `title_ar`, `slug`, `construction_type`, `purpose`, `images`, `video`, `electricity`, `water`, `length`, `width`, `age`, `bedrooms`, `bathrooms`, `livingroom`, `guestroom`, `landarea`, `builduparea`, `description`, `description_ar`, `price`, `sqrprice`, `referenceno`, `map_code`, `features`, `features_ar`, `fixtures`, `fixtures_ar`, `street`, `streetwidth`, `facing`, `status`, `created_at`, `updated_at`) VALUES
(16, 1, 3, NULL, NULL, NULL, 'Tuwaiq, West Riyadh, Riyadh, Riyadh Region', 'طويق، غرب الرياض، الرياض، منطقة الرياض', 'tuwaiq-west-riyadh-riyadh-riyadh-region', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64a3952066a64.webp\",\"uploads\\/properties\\/images\\/properties-64a39520de12f.webp\",\"uploads\\/properties\\/images\\/properties-64a39520dec54.webp\",\"uploads\\/properties\\/images\\/properties-64a39520df5e8.webp\"]', NULL, 'Yes', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Street Width: 20 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Facade: Southern Facade </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Age: 12 month(s)</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Amenities: </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? none</span></p>', '<p><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عرض الشارع: 20 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">واجهة العقار : واجهة جنوبية </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عمر العقار: 12شهور</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المزايا والخدمات: </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟none</span></p>', '1,080,000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:41:47', '2023-07-03 21:42:24'),
(17, 1, 2, NULL, NULL, NULL, 'Villa with staircase for sale in Tuwaiq District, West of Riyadh', 'فيلا درج صالة للبيع في حي طويق، غرب الرياض', 'villa-with-staircase-for-sale-in-tuwaiq-district-west-of-riyadh', 'Ready', 'For Sale', '[\"uploads\\/properties\\/images\\/properties-64a3971e830e2.webp\",\"uploads\\/properties\\/images\\/properties-64a3971e84fd6.webp\",\"uploads\\/properties\\/images\\/properties-64a3971e85e2f.webp\",\"uploads\\/properties\\/images\\/properties-64a3971e869df.webp\",\"uploads\\/properties\\/images\\/properties-64a3971e8731b.webp\",\"uploads\\/properties\\/images\\/properties-64a3971e87c77.webp\"]', NULL, 'Yes', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<p><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Villa with staircase for sale in Al Mousa scheme in Tuwaiq District, West of Riyadh. </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Area: 225 SQM</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Located on 15m Street opens to a facility</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Facade: northeastern 15/15</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Details:</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Construction completion certificate is ready</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Villa with staircase and apartment</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Distinctive engineering design that suits our valued customers</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">garage + men\'s living room + guest room + hall + kitchen + storage</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">First floor: 4 bedrooms + hall</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Second floor: room + seating area + roof</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Guarantees:</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">There are all guarantees on the villa, electricity, plumbing, insulators, and tanks</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">25-year electric warranty from Al-Fanar Company</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">15 year plumbing warranty from Green Pipe Company</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">10 year insulator warranty</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">10 year tank warranty</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Company Features:</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Clearing bank transactions as soon as possible</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Giving the highest financing with the lowest profit margin</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">We deal with all banks and finance companies</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">We pay off your debts at the lowest profit margin</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Financing solutions that suit all our valued customers</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">The price for the corner villa: 1 million and 300 thousand SAR</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Price for the villa on one street: 1 million and 250 thousand SAR</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Width: 11 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Plot Length: 20 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Street Width: 15 meters</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Facade: Eastern Facade </span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Property Age: 2 month(s)</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Amenities: Storage Areas</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Debts and obligations on the property that are not documented in property title deed? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Is there a mortgage or restriction that prevents or limits the disposal or use of the property? No</span><br style=\"box-sizing: inherit; color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: Lato, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">Any Information that may affect the property value (whether in reducing its value or affecting the user decision in making a transaction)? No</span></p>', '<p><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">فيلا درج صالة للبيع في مخطط الموسى في حي طويق، غرب الرياض. </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المساحة: 225 متر مربع </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">على شارع 15م يفتح على مرفق </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الواجهة: شمالية شرقية 15/15</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">التفاصيل:</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">إتمام البناء جاهز </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">فيلا درج صالة مع شقة</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">تصميم هندسي مميز يليق بعملائنا الكرام </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">مدخل سيارة + مشب + مجلس رجال + مقلط + صالة + مطبخ + مستودع </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدور الأول: 4 غرف نوم + صالة</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الدور الثاني: غرفة + جلسة + سطح</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">الضمانات:</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">يوجد جميع الضمانات على الفيلا كهرباء وسباكة وعوازل وخزانات وبايكة</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ضمان كهرباء 25 سنة شركة الفنار</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ضمان سباكة 15 سنة من شركة الأنابيب الخضراء</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ضمان عوازل 10 سنة </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ضمان بايكة 10 سنة </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">ضمان خزانات 10 سنة </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">مميزات الشركة:</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">تخليص معاملات البنك بأسرع وقت </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">إعطاء أعلى تمويل بأقل هامش ربح </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">نتعامل مع جميع البنوك وشركات التمويل</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">نسدد عنك المديونية بأقل هامش ربح</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">حلول تمويلية تناسب جميع عملائنا الكرام</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">السعر للفيلا الزاوية: 1 مليون و300 ألف ريال</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">السعر للفيلا على شارع واحد: 1 مليون و250 ألف ريال</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">حدود العقار (العرض بالمتر): 11 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> حدود العقار (الطول بالمتر): 20 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> عرض الشارع: 15 متر</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">واجهة العقار : واجهة شرقية </span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">عمر العقار: 2شهور</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\">المزايا والخدمات: غرفة تخزين</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أية حقوق او التزامات على العقار غير موثقة في سند الملكية أو وثيقة العقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل يوجد أي رهن او تمويل أو قيد من شأنه أن يمنع او يحد من التصرف او الانتفاع بالعقار؟لا</span><br style=\"box-sizing: inherit; color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: DroidArabicKufi, Helvetica, sans-serif; font-size: 15.96px; white-space-collapse: preserve; background-color: #ffffff;\"> هل هناك أي معلومات قد تؤثر على العقار سواء في خفض قيمته او التأثير على قرار المستخدم؟لا</span></p>', 'SAR 1,300,000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2023-07-03 21:50:36', '2023-07-03 21:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `name_ar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Industry and Mining Sector', 'قطاع الصناعة والتعدين ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(2, 'Accommodation Tourism Sector', 'القطاع السياحي الايواء   ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(3, 'Education Sector', 'القطاع التعليمي', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(4, 'Medicine and Care Sector', 'قطاع الطب والرعاية  ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(5, 'Hospitality restaurants', 'قطاع الضيافة المطاعم   ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(6, 'Wholesale and Retail Business Sector', 'جملة وتجزئة  قطاع التجارية  ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(7, 'Group Housing Sector', 'قطاع السكن الجماعي ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(8, 'Building and Construction Sector', 'قطاع البناء والتشييد  ', '1', '2023-05-13 04:47:33', '2023-05-13 04:47:33'),
(9, 'Logistics and Transportation Sector', 'قطاع اللوجستيك والنقل', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(10, 'Agricultural Sector', ' قطاع الزراعي', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(11, 'Petrol Station Sector', ' قطاع محطات البنزين', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(12, 'Buildings and Commercial Complexes Sector', 'قطاع المباني والمجمعات التجارية', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(13, 'Commercial and Residential land Sector', 'قطاع الأراضي التجارية والسكنية ', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(14, 'Sports Facilities Sector', 'قطاع المنشات الرياضية', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(15, 'Entertainment and Exhibition Sector', 'قطاع الترفيه والمعارض', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34'),
(16, 'Family Business Sector', 'قطاع الشركات العائلية  ', '1', '2023-05-13 04:47:34', '2023-05-13 04:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `senders`
--

CREATE TABLE `senders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `company_id`, `name`, `email`, `is_verified`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'MD. ABU TALEB', 'abutalebgmtt@gmail.com', 0, NULL, '2023-06-06 02:23:58', '2023-06-06 02:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', NULL, NULL, NULL),
(2, 'phone', '+966 551175959', NULL, NULL),
(3, 'email', 'info@asoug.com', NULL, NULL),
(4, 'address', 'Riadah Incubators Startup Studio And corporate factory - Khaldiya Towers - 4th Tower - Faisal Bin Turki Road - Office No. 6 - Floor 13 - Riyadh', NULL, NULL),
(5, 'title', 'Asoug.com', NULL, NULL),
(6, 'description', 'Asoug is a B2B Marketplace', NULL, NULL),
(7, 'facebook', 'http://www.facebook.com', NULL, NULL),
(8, 'twitter', 'http://www.twitter.com', NULL, NULL),
(9, 'linkedin', 'http://linkedin.com', NULL, NULL),
(10, 'pinterest', 'http://pinterest.com', NULL, NULL),
(11, 'android_app_url', 'http://google.com', NULL, NULL),
(12, 'ios_app_url', 'http://apple.com', NULL, NULL),
(13, 'language', 'en', NULL, NULL),
(14, 'currency', 'USD', NULL, NULL),
(15, 'theme', 'basic', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_menus`
--

CREATE TABLE `site_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_on_header` tinyint(1) NOT NULL DEFAULT 0,
  `show_on_footer` tinyint(1) NOT NULL DEFAULT 0,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_menus`
--

INSERT INTO `site_menus` (`id`, `site_menu_id`, `name`, `arabic_name`, `icon`, `show_on_header`, `show_on_footer`, `url`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Home', 'كيف', NULL, 0, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `arabic_name`, `country_id`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Abha', 'أبها', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(2, 'AlKhafji', 'الخفجي', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(3, 'Alahsa', 'الأحساء', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(4, 'Albaha', 'الباحة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(5, 'Alkharj', 'الخرج', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(6, 'Alqasim', 'القاسم', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(7, 'Alquryat', 'القريات', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(8, 'Altaif', 'الطائف', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(9, 'Arar', 'عرعر', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(10, 'Aseer', 'عسير', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(11, 'Buraidah', 'بريدة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(12, 'Dammam', 'الدمام', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(13, 'Dhahran Al Janoub', 'ظهران الجنوب', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(14, 'Hafr Albaten', 'حفر الباطن', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(15, 'Hail', 'حائل', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(16, 'Hofof', 'الهفوف', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(17, 'Jeddah', 'جدة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(18, 'Jizan', 'جيزان', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(19, 'Jouf', 'الجوف', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(20, 'Jubail', 'الجبيل', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(21, 'Khamis Mushait', 'خميس مشيط', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(22, 'Khobar', 'الخبر', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(23, 'Mecca', 'مكة المكرمة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(24, 'Medina', 'المدينة المنورة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(25, 'Najran', 'نجران', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(26, 'Onaizah', 'عنيزة', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(27, 'Qatif', 'القطيف', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(28, 'Riyadh', 'الرياض', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(29, 'Sakaka', 'سكاكا', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(30, 'Tabouk', 'تبوك', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29'),
(31, 'Yanbu', 'ينبع', 198, 1, NULL, '2023-06-23 23:05:29', '2023-06-23 23:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `subroles`
--

CREATE TABLE `subroles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `company_id`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'abutalebgmtt@gmail.com', '2023-06-06 02:24:18', '2023-06-06 02:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_replies`
--

CREATE TABLE `support_ticket_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_for` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `avatar`, `business_type`, `tax_number`, `commercial_registration_number`, `is_active`) VALUES
(1, 'Admin', 'admin@admin.com', '2023-06-06 01:12:04', '$2y$10$0nW4Q3kDJvfsRK7cJqxdoOt9xLNdmAFfA/JrWSvDUQ5PX2EojOq2u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_whole_world` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zone_locations`
--

CREATE TABLE `zone_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automations`
--
ALTER TABLE `automations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `automations_company_id_foreign` (`company_id`),
  ADD KEY `automations_mailing_list_id_foreign` (`mailing_list_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_company_id_foreign` (`company_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
  ADD KEY `category_post_post_id_foreign` (`post_id`),
  ADD KEY `category_post_category_id_foreign` (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_settings_key_unique` (`key`),
  ADD KEY `company_settings_company_id_foreign` (`company_id`);

--
-- Indexes for table `company_user`
--
ALTER TABLE `company_user`
  ADD KEY `company_user_user_id_foreign` (`user_id`),
  ADD KEY `company_user_company_id_foreign` (`company_id`),
  ADD KEY `company_user_subrole_id_foreign` (`subrole_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_company_id_foreign` (`company_id`),
  ADD KEY `contacts_assign_to_foreign` (`assign_to`);

--
-- Indexes for table `contact_mailing_list`
--
ALTER TABLE `contact_mailing_list`
  ADD KEY `contact_mailing_list_contact_id_foreign` (`contact_id`),
  ADD KEY `contact_mailing_list_mailing_list_id_foreign` (`mailing_list_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_company_id_foreign` (`company_id`),
  ADD KEY `contact_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currencies_code_index` (`code`);

--
-- Indexes for table `customer_queries`
--
ALTER TABLE `customer_queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_queries_user_id_foreign` (`user_id`),
  ADD KEY `customer_queries_company_id_foreign` (`company_id`);

--
-- Indexes for table `customer_query_replies`
--
ALTER TABLE `customer_query_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_query_replies_customer_query_id_foreign` (`customer_query_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `finance_requests`
--
ALTER TABLE `finance_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_company_id_foreign` (`company_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `languages_country_id_foreign` (`country_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leads_company_id_foreign` (`company_id`),
  ADD KEY `leads_contact_id_foreign` (`contact_id`),
  ADD KEY `leads_pipeline_id_foreign` (`pipeline_id`),
  ADD KEY `leads_lead_stage_id_foreign` (`lead_stage_id`);

--
-- Indexes for table `lead_sources`
--
ALTER TABLE `lead_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_sources_company_id_foreign` (`company_id`);

--
-- Indexes for table `lead_stages`
--
ALTER TABLE `lead_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_stages_company_id_foreign` (`company_id`),
  ADD KEY `lead_stages_pipeline_id_foreign` (`pipeline_id`);

--
-- Indexes for table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mailing_lists_company_id_foreign` (`company_id`),
  ADD KEY `mailing_lists_mailing_list_id_foreign` (`mailing_list_id`);

--
-- Indexes for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_uploads_user_id_foreign` (`user_id`),
  ADD KEY `media_uploads_company_id_foreign` (`company_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_user`
--
ALTER TABLE `notification_user`
  ADD KEY `notification_user_user_id_foreign` (`user_id`),
  ADD KEY `notification_user_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_columns`
--
ALTER TABLE `page_columns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_columns_page_row_id_foreign` (`page_row_id`);

--
-- Indexes for table `page_rows`
--
ALTER TABLE `page_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_rows_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_4349750` (`role_id`),
  ADD KEY `permission_id_fk_4349750` (`permission_id`);

--
-- Indexes for table `permission_subrole`
--
ALTER TABLE `permission_subrole`
  ADD KEY `permission_subrole_subrole_id_foreign` (`subrole_id`),
  ADD KEY `permission_subrole_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pipelines`
--
ALTER TABLE `pipelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pipelines_company_id_foreign` (`company_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senders_company_id_foreign` (`company_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `site_menus`
--
ALTER TABLE `site_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_menus_site_menu_id_foreign` (`site_menu_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `subroles`
--
ALTER TABLE `subroles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subroles_company_id_foreign` (`company_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribers_company_id_foreign` (`company_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_tickets_user_id_foreign` (`user_id`);

--
-- Indexes for table `support_ticket_replies`
--
ALTER TABLE `support_ticket_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_ticket_replies_support_ticket_id_foreign` (`support_ticket_id`),
  ADD KEY `support_ticket_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `templates_company_id_foreign` (`company_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zones_company_id_foreign` (`company_id`);

--
-- Indexes for table `zone_locations`
--
ALTER TABLE `zone_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zone_locations_zone_id_foreign` (`zone_id`),
  ADD KEY `zone_locations_country_id_foreign` (`country_id`),
  ADD KEY `zone_locations_state_id_foreign` (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automations`
--
ALTER TABLE `automations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_queries`
--
ALTER TABLE `customer_queries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_query_replies`
--
ALTER TABLE `customer_query_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finance_requests`
--
ALTER TABLE `finance_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_sources`
--
ALTER TABLE `lead_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_stages`
--
ALTER TABLE `lead_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_uploads`
--
ALTER TABLE `media_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_columns`
--
ALTER TABLE `page_columns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_rows`
--
ALTER TABLE `page_rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pipelines`
--
ALTER TABLE `pipelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `site_menus`
--
ALTER TABLE `site_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subroles`
--
ALTER TABLE `subroles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_ticket_replies`
--
ALTER TABLE `support_ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zone_locations`
--
ALTER TABLE `zone_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automations`
--
ALTER TABLE `automations`
  ADD CONSTRAINT `automations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `automations_mailing_list_id_foreign` FOREIGN KEY (`mailing_list_id`) REFERENCES `mailing_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_post`
--
ALTER TABLE `category_post`
  ADD CONSTRAINT `category_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_settings`
--
ALTER TABLE `company_settings`
  ADD CONSTRAINT `company_settings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_user`
--
ALTER TABLE `company_user`
  ADD CONSTRAINT `company_user_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_user_subrole_id_foreign` FOREIGN KEY (`subrole_id`) REFERENCES `subroles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_assign_to_foreign` FOREIGN KEY (`assign_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contacts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_mailing_list`
--
ALTER TABLE `contact_mailing_list`
  ADD CONSTRAINT `contact_mailing_list_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_mailing_list_mailing_list_id_foreign` FOREIGN KEY (`mailing_list_id`) REFERENCES `mailing_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_queries`
--
ALTER TABLE `customer_queries`
  ADD CONSTRAINT `customer_queries_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_queries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_query_replies`
--
ALTER TABLE `customer_query_replies`
  ADD CONSTRAINT `customer_query_replies_customer_query_id_foreign` FOREIGN KEY (`customer_query_id`) REFERENCES `customer_queries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_lead_stage_id_foreign` FOREIGN KEY (`lead_stage_id`) REFERENCES `lead_stages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_pipeline_id_foreign` FOREIGN KEY (`pipeline_id`) REFERENCES `pipelines` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_sources`
--
ALTER TABLE `lead_sources`
  ADD CONSTRAINT `lead_sources_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_stages`
--
ALTER TABLE `lead_stages`
  ADD CONSTRAINT `lead_stages_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lead_stages_pipeline_id_foreign` FOREIGN KEY (`pipeline_id`) REFERENCES `pipelines` (`id`);

--
-- Constraints for table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  ADD CONSTRAINT `mailing_lists_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mailing_lists_mailing_list_id_foreign` FOREIGN KEY (`mailing_list_id`) REFERENCES `mailing_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_uploads`
--
ALTER TABLE `media_uploads`
  ADD CONSTRAINT `media_uploads_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_user`
--
ALTER TABLE `notification_user`
  ADD CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_columns`
--
ALTER TABLE `page_columns`
  ADD CONSTRAINT `page_columns_page_row_id_foreign` FOREIGN KEY (`page_row_id`) REFERENCES `page_rows` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_rows`
--
ALTER TABLE `page_rows`
  ADD CONSTRAINT `page_rows_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_4349750` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_4349750` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_subrole`
--
ALTER TABLE `permission_subrole`
  ADD CONSTRAINT `permission_subrole_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_subrole_subrole_id_foreign` FOREIGN KEY (`subrole_id`) REFERENCES `subroles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pipelines`
--
ALTER TABLE `pipelines`
  ADD CONSTRAINT `pipelines_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `senders`
--
ALTER TABLE `senders`
  ADD CONSTRAINT `senders_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_menus`
--
ALTER TABLE `site_menus`
  ADD CONSTRAINT `site_menus_site_menu_id_foreign` FOREIGN KEY (`site_menu_id`) REFERENCES `site_menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subroles`
--
ALTER TABLE `subroles`
  ADD CONSTRAINT `subroles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscribers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_ticket_replies`
--
ALTER TABLE `support_ticket_replies`
  ADD CONSTRAINT `support_ticket_replies_support_ticket_id_foreign` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `support_ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zones`
--
ALTER TABLE `zones`
  ADD CONSTRAINT `zones_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zone_locations`
--
ALTER TABLE `zone_locations`
  ADD CONSTRAINT `zone_locations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zone_locations_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zone_locations_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
