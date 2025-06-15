-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 01:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apcafs`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('applicant', '5', 1748634745),
('applicant', '6', 1748987074),
('applicant', '7', 1749107915),
('applicant', '8', 1749127278),
('applicant', '9', 1749661107),
('company-admin', '2', 1748634192),
('hr', '4', 1748634474),
('manager', '3', 1748634422),
('super-admin', '1', 1748633642);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('applicant', 1, NULL, NULL, NULL, NULL, NULL),
('company-admin', 1, NULL, NULL, NULL, NULL, NULL),
('hr', 1, NULL, NULL, NULL, NULL, NULL),
('manager', 1, NULL, NULL, NULL, NULL, NULL),
('super-admin', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `id` int(11) NOT NULL,
  `award_profile_id` int(11) NOT NULL,
  `award_title` varchar(255) NOT NULL,
  `award_organization_name` varchar(200) NOT NULL,
  `award_issue_number` varchar(50) NOT NULL,
  `award_date_of_issue` date NOT NULL,
  `award_status_id` int(11) NOT NULL,
  `award_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `award_created_by` int(11) DEFAULT NULL,
  `award_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `award_updated_by` int(11) DEFAULT NULL,
  `award_deleted_at` timestamp NULL DEFAULT NULL,
  `award_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`id`, `award_profile_id`, `award_title`, `award_organization_name`, `award_issue_number`, `award_date_of_issue`, `award_status_id`, `award_created_at`, `award_created_by`, `award_updated_at`, `award_updated_by`, `award_deleted_at`, `award_deleted_by`) VALUES
(1, 1, 'Eiusmod eveniet adipisci officiis qui ut est suscipit', 'Walsh Talley LLC', '672', '2001-01-01', 2, '2025-05-30 23:02:31', 5, '2025-05-30 23:02:31', NULL, NULL, NULL),
(2, 9, 'Occaecat non aut mag', 'Sparks and Whitney Traders', '687', '2025-06-04', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(3, 10, 'Dolorem excepturi bl', 'Kemp and Contreras Associates', '724', '2025-06-05', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(4, 10, 'Nisi aspernatur sed ', 'Mccarthy Barry Associates', '71', '2025-06-05', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_phone_number` varchar(10) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_website_url` varchar(255) DEFAULT NULL,
  `company_user_size` int(11) NOT NULL DEFAULT 2,
  `company_activation_code` varchar(50) NOT NULL,
  `company_activation_code_date` timestamp NULL DEFAULT NULL,
  `company_status_id` int(11) NOT NULL,
  `company_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `company_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_phone_number`, `company_email`, `company_address`, `company_website_url`, `company_user_size`, `company_activation_code`, `company_activation_code_date`, `company_status_id`, `company_created_at`, `company_updated_at`, `company_deleted_at`) VALUES
(1, 'APCAFS CV SCREENING SOLUTIONS', '0759979706', 'apcafscvsolutions@gmail.com', 'cive', NULL, 2, 'ydaerlaXMPzlwHPsdesu', '2025-05-30 18:35:21', 2, '2025-05-30 19:32:28', '2025-05-30 19:35:21', NULL),
(2, 'AIRTEL TANZANIA LTD', '0786767888', 'airteltanzanialtd@info.co.tz', 'morocco, Kinondoni Dar-es-salaam HQ', 'www.airtel__tanzania@co.tz', 4, 'ydaerlakAy4oiQBsdesu', '2025-05-30 18:45:14', 2, '2025-05-30 19:41:44', '2025-05-30 19:45:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_subscription`
--

CREATE TABLE `company_subscription` (
  `id` int(11) NOT NULL,
  `subscription_company_id` int(11) NOT NULL,
  `subscription_plan_id` int(11) NOT NULL,
  `subscription_start_date` date NOT NULL,
  `subscription_end_date` date NOT NULL,
  `subscription_status_id` int(11) NOT NULL,
  `subscription_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subscription_created_by` int(11) DEFAULT NULL,
  `subscription_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subscription_updated_by` int(11) DEFAULT NULL,
  `subscription_deleted_at` timestamp NULL DEFAULT NULL,
  `subscription_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_subscription`
--

INSERT INTO `company_subscription` (`id`, `subscription_company_id`, `subscription_plan_id`, `subscription_start_date`, `subscription_end_date`, `subscription_status_id`, `subscription_created_at`, `subscription_created_by`, `subscription_updated_at`, `subscription_updated_by`, `subscription_deleted_at`, `subscription_deleted_by`) VALUES
(1, 2, 2, '2025-05-30', '2025-08-30', 5, '2025-05-30 19:41:44', 1, '2025-05-30 19:41:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `district_region_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `district_status_id` int(11) NOT NULL,
  `district_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `district_created_by` int(11) DEFAULT NULL,
  `district_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `district_updated_by` int(11) DEFAULT NULL,
  `district_deleted_at` timestamp NULL DEFAULT NULL,
  `district_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_region_id`, `district_name`, `district_status_id`, `district_created_at`, `district_created_by`, `district_updated_at`, `district_updated_by`, `district_deleted_at`, `district_deleted_by`) VALUES
(1, 1, 'Arusha City', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(2, 1, 'Arumeru', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(3, 1, 'Karatu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(4, 1, 'Longido', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(5, 1, 'Monduli', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(6, 1, 'Ngorongoro', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(7, 2, 'Ilala', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(8, 2, 'Kinondoni', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(9, 2, 'Temeke', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(10, 2, 'Kigamboni', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(11, 2, 'Ubungo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(12, 3, 'Bahi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(13, 3, 'Chamwino', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(14, 3, 'Chemba', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(15, 3, 'Dodoma Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(16, 3, 'Kondoa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(17, 3, 'Kongwa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(18, 3, 'Mpwapwa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(19, 4, 'Bukombe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(20, 4, 'Chato', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(21, 4, 'Geita', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(22, 4, 'Mbogwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(23, 4, 'Nyang\'wale', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:42:08', NULL, NULL, NULL),
(24, 5, 'Iringa Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(25, 5, 'Iringa Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(26, 5, 'Kilolo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(27, 5, 'Mafinga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(28, 6, 'Biharamulo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(29, 6, 'Bukoba Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(30, 6, 'Bukoba Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(31, 6, 'Karagwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(32, 6, 'Kyerwa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(33, 6, 'Missenyi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(34, 6, 'Ngara', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(35, 7, 'Mlele', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(36, 7, 'Mpanda', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(37, 7, 'Mpimbwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(38, 8, 'Buhigwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(39, 8, 'Kakonko', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(40, 8, 'Kasulu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(41, 8, 'Kibondo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(42, 8, 'Kigoma Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(43, 8, 'Kigoma Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(44, 8, 'Uvinza', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(45, 9, 'Hai', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(46, 9, 'Moshi Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(47, 9, 'Moshi Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(48, 9, 'Mwanga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(49, 9, 'Rombo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(50, 9, 'Same', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(51, 9, 'Siha', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(52, 10, 'Kilwa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(53, 10, 'Lindi Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(54, 10, 'Lindi Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(55, 10, 'Liwale', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(56, 10, 'Nachingwea', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(57, 10, 'Ruangwa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(58, 11, 'Babati Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(59, 11, 'Babati Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(60, 11, 'Hanang', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(61, 11, 'Kiteto', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(62, 11, 'Mbulu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(63, 11, 'Simanjiro', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(64, 12, 'Bunda', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(65, 12, 'Butiama', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(66, 12, 'Musoma Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(67, 12, 'Musoma Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(68, 12, 'Rorya', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(69, 12, 'Serengeti', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(70, 12, 'Tarime', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(71, 13, 'Busokelo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(72, 13, 'Chunya', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(73, 13, 'Kyela', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(74, 13, 'Mbeya Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(75, 13, 'Mbeya Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(76, 13, 'Mbarali', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(77, 13, 'Rungwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(78, 14, 'Gairo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(79, 14, 'Kilombero', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(80, 14, 'Kilosa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(81, 14, 'Malinyi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(82, 14, 'Morogoro Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(83, 14, 'Morogoro Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(84, 14, 'Mvomero', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(85, 14, 'Ulanga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(86, 15, 'Masasi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(87, 15, 'Mtwara Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(88, 15, 'Mtwara Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(89, 15, 'Nanyumbu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(90, 15, 'Newala', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(91, 15, 'Tandahimba', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(92, 16, 'Ilemela', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(93, 16, 'Kwimba', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(94, 16, 'Magu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(95, 16, 'Misungwi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(96, 16, 'Nyamagana', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(97, 16, 'Sengerema', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(98, 16, 'Ukerewe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(99, 17, 'Ludewa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(100, 17, 'Makambako', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(101, 17, 'Makete', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(102, 17, 'Njombe Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(103, 17, 'Njombe Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(104, 17, 'Wanging\'ombe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:40:56', NULL, NULL, NULL),
(105, 18, 'Micheweni', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(106, 18, 'Wete', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(107, 19, 'Chake Chake', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(108, 19, 'Mkoani', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(109, 20, 'Bagamoyo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(110, 20, 'Kibaha Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(111, 20, 'Kibaha Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(112, 20, 'Kisarawe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(113, 20, 'Mafia', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(114, 20, 'Mkuranga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(115, 20, 'Rufiji', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(116, 21, 'Kalambo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(117, 21, 'Nkasi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(118, 21, 'Sumbawanga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(119, 22, 'Mbinga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(120, 22, 'Namtumbo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(121, 22, 'Nyasa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(122, 22, 'Songea Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(123, 22, 'Songea Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(124, 22, 'Tunduru', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(125, 23, 'Kahama', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(126, 23, 'Kishapu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(127, 23, 'Shinyanga Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(128, 23, 'Shinyanga Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(129, 24, 'Bariadi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(130, 24, 'Busega', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(131, 24, 'Itilima', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(132, 24, 'Maswa', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(133, 24, 'Meatu', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(134, 25, 'Ikungi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(135, 25, 'Iramba', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(136, 25, 'Manyoni', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(137, 25, 'Mkalama', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(138, 25, 'Singida Rural', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(139, 25, 'Singida Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(140, 26, 'Ileje', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(141, 26, 'Mbozi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(142, 26, 'Songwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(143, 26, 'Tunduma', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(144, 27, 'Igunga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(145, 27, 'Kaliua', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(146, 27, 'Nzega', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(147, 27, 'Sikonge', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(148, 27, 'Tabora Urban', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(149, 27, 'Urambo', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(150, 28, 'Handeni', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(151, 28, 'Kilindi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(152, 28, 'Korogwe', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(153, 28, 'Lushoto', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(154, 28, 'Muheza', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(155, 28, 'Pangani', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(156, 28, 'Tanga', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(157, 29, 'Kati', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(158, 29, 'Kusini', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(159, 30, 'Kaskazini A', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(160, 30, 'Kaskazini B', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(161, 31, 'Magharibi', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL),
(162, 31, 'Mjini', 2, '2025-05-30 22:38:21', 1, '2025-05-30 22:38:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `education_profile_id` int(11) NOT NULL,
  `education_degree_name` varchar(100) NOT NULL,
  `education_programme_name` varchar(200) NOT NULL,
  `education_university_name` varchar(255) NOT NULL,
  `education_graduation_date` date NOT NULL,
  `education_status_id` int(11) NOT NULL,
  `education_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `education_created_by` int(11) DEFAULT NULL,
  `education_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `education_updated_by` int(11) DEFAULT NULL,
  `education_deleted_at` timestamp NULL DEFAULT NULL,
  `education_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `education_profile_id`, `education_degree_name`, `education_programme_name`, `education_university_name`, `education_graduation_date`, `education_status_id`, `education_created_at`, `education_created_by`, `education_updated_at`, `education_updated_by`, `education_deleted_at`, `education_deleted_by`) VALUES
(1, 1, 'Zephr Torres', 'Deborah Mclean', 'Lana Steele', '1979-01-01', 2, '2025-05-30 23:02:30', 5, '2025-05-30 23:02:30', NULL, NULL, NULL),
(3, 9, 'Sacha Nichols', 'Shoshana Wells', 'Kiayada Lowery', '2025-06-04', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(4, 10, 'Nomlanga Forbes', 'Fulton Mueller', 'Brett Ingram', '2025-06-05', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(5, 10, 'Emery Odom', 'Aphrodite Frost', 'Reece Mendez', '2025-06-05', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(6, 11, 'Diploma', 'ICT', 'CBE', '1980-08-28', 2, '2025-06-11 17:41:07', 9, '2025-06-11 17:41:07', NULL, NULL, NULL),
(7, 11, 'Bachelor', 'Software Engineering', 'UDOM', '1985-07-24', 2, '2025-06-11 17:41:07', 9, '2025-06-11 17:41:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `id` int(11) NOT NULL,
  `applicant_company_id` int(11) NOT NULL,
  `applicant_job_post_id` int(11) NOT NULL,
  `applicant_user_id` int(11) NOT NULL,
  `applicant_score` decimal(3,2) DEFAULT NULL,
  `applicant_status_id` int(11) NOT NULL,
  `applicant_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `applicant_created_by` int(11) DEFAULT NULL,
  `applicant_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `applicant_updated_by` int(11) DEFAULT NULL,
  `applicant_deleted_at` timestamp NULL DEFAULT NULL,
  `applicant_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`id`, `applicant_company_id`, `applicant_job_post_id`, `applicant_user_id`, `applicant_score`, `applicant_status_id`, `applicant_created_at`, `applicant_created_by`, `applicant_updated_at`, `applicant_updated_by`, `applicant_deleted_at`, `applicant_deleted_by`) VALUES
(1, 2, 1, 8, NULL, 8, '2025-06-05 15:51:08', 8, '2025-06-05 15:51:08', NULL, NULL, NULL),
(2, 2, 1, 8, NULL, 8, '2025-06-05 15:51:50', 8, '2025-06-05 15:51:50', NULL, NULL, NULL),
(3, 2, 2, 8, NULL, 8, '2025-06-11 10:22:04', 8, '2025-06-11 10:22:04', NULL, NULL, NULL),
(4, 2, 1, 5, NULL, 8, '2025-06-11 16:10:51', 5, '2025-06-11 16:10:51', NULL, NULL, NULL),
(5, 2, 3, 9, NULL, 8, '2025-06-11 17:43:21', 9, '2025-06-11 17:43:21', NULL, NULL, NULL),
(6, 2, 2, 9, NULL, 8, '2025-06-11 17:43:45', 9, '2025-06-11 17:43:45', NULL, NULL, NULL),
(7, 2, 1, 9, NULL, 8, '2025-06-11 17:44:07', 9, '2025-06-11 17:44:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `id` int(11) NOT NULL,
  `post_company_id` int(11) NOT NULL,
  `post_user_id` int(11) DEFAULT NULL,
  `post_job_title` varchar(100) NOT NULL,
  `post_job_type` varchar(30) NOT NULL,
  `post_job_description` text NOT NULL,
  `post_publication_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_deadline` date NOT NULL,
  `post_profession` varchar(255) NOT NULL,
  `post_location` varchar(255) NOT NULL,
  `post_is_remote` tinyint(3) DEFAULT 0,
  `post_salary_range_min` decimal(10,2) DEFAULT 0.00,
  `post_salary_range_max` decimal(10,2) DEFAULT 0.00,
  `post_status_id` int(11) NOT NULL,
  `post_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_created_by` int(11) DEFAULT NULL,
  `post_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_updated_by` int(11) DEFAULT NULL,
  `post_deleted_at` timestamp NULL DEFAULT NULL,
  `post_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`id`, `post_company_id`, `post_user_id`, `post_job_title`, `post_job_type`, `post_job_description`, `post_publication_date`, `post_deadline`, `post_profession`, `post_location`, `post_is_remote`, `post_salary_range_min`, `post_salary_range_max`, `post_status_id`, `post_created_at`, `post_created_by`, `post_updated_at`, `post_updated_by`, `post_deleted_at`, `post_deleted_by`) VALUES
(1, 2, 4, 'Dolore nisi illum possimus ut ut et voluptas voluptates expedita molestiae assumenda quae debitis', 'Contract', 'Qui illum magna inc', '2025-06-11 15:16:29', '2025-09-10', 'In maxime dicta inventore consequuntur sed anim adipisicing reiciendis consectetur vitae', 'Ea consequat Quae labore velit id quam sequi aliquam dignissimos quis sed autem autem minim', 1, NULL, '0.00', 3, '2025-06-05 14:17:42', 4, '2025-06-11 15:16:29', NULL, NULL, NULL),
(2, 2, 4, 'Quis consequatur Nostrud sint consectetur', 'Volunteer', 'Id est perferendis u', '2025-06-11 10:21:11', '2025-09-10', 'Reprehenderit voluptas ad ex do ut dolores voluptates voluptate omnis minus commodo et', 'Minus quia non blanditiis consequatur', 0, NULL, '0.00', 3, '2025-06-11 10:21:11', 4, '2025-06-11 10:21:11', NULL, NULL, NULL),
(3, 2, 4, 'Labore ipsum voluptate nostrum dolore necessitatibus nostrum id', 'Part-Time', 'Et quo eum lorem ab', '2025-06-11 15:16:34', '2025-09-11', 'Assumenda cupiditate adipisicing libero facere cumque irure est blanditiis anim assumenda error qui incididunt iusto est culpa eum', 'Consequatur enim quibusdam impedit velit sit', 1, NULL, '0.00', 3, '2025-06-11 10:45:05', 4, '2025-06-11 15:16:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_test`
--

CREATE TABLE `job_test` (
  `id` int(11) NOT NULL,
  `test_company_id` int(11) NOT NULL,
  `test_job_post_id` int(11) NOT NULL,
  `test_user_id` int(11) DEFAULT NULL,
  `test_identification` varchar(30) NOT NULL,
  `test_duration` int(11) NOT NULL,
  `test_status_id` int(11) NOT NULL,
  `test_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `test_created_by` int(11) DEFAULT NULL,
  `test_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `test_updated_by` int(11) DEFAULT NULL,
  `test_deleted_at` timestamp NULL DEFAULT NULL,
  `test_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_test`
--

INSERT INTO `job_test` (`id`, `test_company_id`, `test_job_post_id`, `test_user_id`, `test_identification`, `test_duration`, `test_status_id`, `test_created_at`, `test_created_by`, `test_updated_at`, `test_updated_by`, `test_deleted_at`, `test_deleted_by`) VALUES
(1, 2, 1, 4, 'Dolore', 10, 2, '2025-06-11 18:09:40', 4, '2025-06-11 18:09:40', NULL, NULL, NULL),
(2, 2, 3, 4, 'Labore', 15, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(3, 2, 2, 4, 'Quis', 20, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `language_profile_id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `language_status_id` int(11) NOT NULL,
  `language_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `language_created_by` int(11) DEFAULT NULL,
  `language_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `language_updated_by` int(11) DEFAULT NULL,
  `language_deleted_at` timestamp NULL DEFAULT NULL,
  `language_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language_profile_id`, `language_name`, `language_status_id`, `language_created_at`, `language_created_by`, `language_updated_at`, `language_updated_by`, `language_deleted_at`, `language_deleted_by`) VALUES
(1, 1, 'Maggie Mccullough', 2, '2025-05-30 23:02:31', 5, '2025-05-30 23:02:31', NULL, NULL, NULL),
(2, 9, 'Quintessa Robertson', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(3, 10, 'Linus Bishop', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(4, 10, 'Dustin Buchanan', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(5, 11, 'English', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL),
(6, 11, 'Swahili', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL),
(7, 11, 'Arabic', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL),
(8, 11, 'Spanish', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1748472319),
('m140506_102106_rbac_init', 1748472324),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1748472324),
('m180523_151638_rbac_updates_indexes_without_prefix', 1748472326),
('m200409_110543_rbac_update_mssql_trigger', 1748472326),
('m250321_125624_create_status_lookup_table', 1748472342),
('m250321_125642_create_company_table', 1748472348),
('m250321_125657_create_subscription_plan_table', 1748472353),
('m250321_125721_create_user_table', 1748472371),
('m250321_125731_create_company_subscription_table', 1748472397),
('m250321_125740_create_staff_profile_table', 1748472415),
('m250323_232719_create_region_table', 1748472424),
('m250323_232746_create_district_table', 1748472436),
('m250323_232925_create_profile_table', 1748472452),
('m250324_002309_create_phone_number_table', 1748472465),
('m250324_003712_create_work_experience_table', 1748472477),
('m250324_005206_create_education_table', 1748472489),
('m250324_010422_create_skill_table', 1748472499),
('m250324_010436_create_award_table', 1748472508),
('m250324_010455_create_language_table', 1748472518),
('m250324_010524_create_publication_table', 1748472528),
('m250324_010559_create_personality_assessment_table', 1748472539),
('m250324_123641_create_job_post_table', 1748472555),
('m250324_123801_create_job_test_table', 1748472573),
('m250324_123834_create_test_question_table', 1748472615),
('m250324_123918_create_job_application_table', 1748472641),
('m250324_123948_create_test_result_table', 1748472662),
('m250421_112931_create_test_question_choice_table', 1748472682);

-- --------------------------------------------------------

--
-- Table structure for table `personality_assessment`
--

CREATE TABLE `personality_assessment` (
  `id` int(11) NOT NULL,
  `personality_profile_id` int(11) NOT NULL,
  `personality_IE_score` int(11) NOT NULL,
  `personality_NS_score` int(11) NOT NULL,
  `personality_TF_score` int(11) NOT NULL,
  `personality_JB_score` int(11) NOT NULL,
  `personality_last_analysis_date` date NOT NULL,
  `personality_status_id` int(11) NOT NULL,
  `personality_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `personality_created_by` int(11) DEFAULT NULL,
  `personality_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `personality_updated_by` int(11) DEFAULT NULL,
  `personality_deleted_at` timestamp NULL DEFAULT NULL,
  `personality_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_number`
--

CREATE TABLE `phone_number` (
  `id` int(11) NOT NULL,
  `phone_profile_id` int(11) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `phone_status_id` int(11) NOT NULL,
  `phone_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_created_by` int(11) DEFAULT NULL,
  `phone_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone_updated_by` int(11) DEFAULT NULL,
  `phone_deleted_at` timestamp NULL DEFAULT NULL,
  `phone_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_number`
--

INSERT INTO `phone_number` (`id`, `phone_profile_id`, `phone_number`, `phone_status_id`, `phone_created_at`, `phone_created_by`, `phone_updated_at`, `phone_updated_by`, `phone_deleted_at`, `phone_deleted_by`) VALUES
(1, 1, '0785744938', 2, '2025-05-30 23:02:30', 5, '2025-05-30 23:02:30', NULL, NULL, NULL),
(5, 9, '0717453549', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(6, 10, '0748555444', 2, '2025-06-05 12:43:12', 8, '2025-06-05 12:43:12', NULL, NULL, NULL),
(7, 10, '0784676328', 2, '2025-06-05 12:43:12', 8, '2025-06-05 12:43:12', NULL, NULL, NULL),
(8, 11, '0717453553', 2, '2025-06-11 17:41:06', 9, '2025-06-11 17:41:06', NULL, NULL, NULL),
(9, 11, '0755553553', 2, '2025-06-11 17:41:06', 9, '2025-06-11 17:41:06', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `profile_user_id` int(11) NOT NULL,
  `profile_first_name` varchar(100) NOT NULL,
  `profile_middle_name` varchar(100) DEFAULT NULL,
  `profile_last_name` varchar(100) NOT NULL,
  `profile_social_media_username` varchar(255) NOT NULL,
  `profile_date_of_birth` date NOT NULL,
  `profile_bios` text DEFAULT NULL,
  `profile_region_id` int(11) NOT NULL,
  `profile_district_id` int(11) NOT NULL,
  `profile_local_address` varchar(255) DEFAULT NULL,
  `profile_status_id` int(11) NOT NULL,
  `profile_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_created_by` int(11) DEFAULT NULL,
  `profile_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_updated_by` int(11) DEFAULT NULL,
  `profile_deleted_at` timestamp NULL DEFAULT NULL,
  `profile_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `profile_user_id`, `profile_first_name`, `profile_middle_name`, `profile_last_name`, `profile_social_media_username`, `profile_date_of_birth`, `profile_bios`, `profile_region_id`, `profile_district_id`, `profile_local_address`, `profile_status_id`, `profile_created_at`, `profile_created_by`, `profile_updated_at`, `profile_updated_by`, `profile_deleted_at`, `profile_deleted_by`) VALUES
(1, 5, 'Chadwick', 'Gavin Poole', 'George', 'zyxululev', '2014-01-01', 'Amet perspiciatis ', 10, 135, 'Velit ullam qui laborum cupiditate sit id aute molestiae sed incididunt amet quia dolores reprehenderit', 2, '2025-05-30 23:02:30', 5, '2025-05-30 23:02:30', NULL, NULL, NULL),
(9, 7, 'Harlan', 'Tanek Mcpherson', 'Dennis', 'vicodawo', '2025-06-04', 'Illo nulla reiciendi', 2, 8, 'Earum inventore id est recusandae Non voluptatem nulla minim similique minus accusantium eum nihil dolorum quidem', 2, '2025-06-05 12:40:22', 7, '2025-06-05 12:40:22', NULL, NULL, NULL),
(10, 8, 'Kirby', 'Dale Gaines', 'Burris', 'muserim', '2007-06-15', 'Accusamus officia qu', 24, 131, 'Sit placeat dolor eius aliqua Libero ab aute velit est tempore molestiae nulla aut omnis consectetur in', 2, '2025-06-05 12:43:11', 8, '2025-06-05 12:43:11', NULL, NULL, NULL),
(11, 9, 'John', 'Vallas', 'McTies', '@johnmcties', '1951-01-05', 'My name is [Full Name], a dedicated Software Engineer and Cybersecurity Analyst with a strong passion for building secure, efficient, and scalable digital solutions. I specialize in designing robust software systems while ensuring the protection of data and digital infrastructure against modern cyber threats.\r\n\r\nWith over 40 of hands-on experience, I have worked across various projects involving software development, vulnerability assessments, network security, and threat analysis. My technical skillset includes programming languages such as Python, JavaScript, and PHP, alongside security tools like Kali Linux, Wireshark, Metasploit, and Splunk.\r\n\r\nI am well-versed in cybersecurity frameworks and standards including NIST, ISO/IEC 27001, and OWASP Top 10, and I continuously stay updated on the evolving threat landscape to provide proactive defense strategies.\r\n\r\nI’m driven by a mission to help businesses and institutions build secure digital ecosystems, protect sensitive data, and promote a culture of cyber awareness. My goal is to bridge the gap between innovation and security in today’s fast-paced tech environment.', 2, 8, 'Bunju Baharia', 2, '2025-06-11 17:41:05', 9, '2025-06-11 17:41:05', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `publication_profile_id` int(11) NOT NULL,
  `publication_title` varchar(255) NOT NULL,
  `publication_publisher_name` varchar(255) NOT NULL,
  `publication_date_of_publication` date NOT NULL,
  `publication_status_id` int(11) NOT NULL,
  `publication_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `publication_created_by` int(11) DEFAULT NULL,
  `publication_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `publication_updated_by` int(11) DEFAULT NULL,
  `publication_deleted_at` timestamp NULL DEFAULT NULL,
  `publication_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id`, `publication_profile_id`, `publication_title`, `publication_publisher_name`, `publication_date_of_publication`, `publication_status_id`, `publication_created_at`, `publication_created_by`, `publication_updated_at`, `publication_updated_by`, `publication_deleted_at`, `publication_deleted_by`) VALUES
(1, 1, 'Explicabo Consequuntur nihil distinctio Sit quasi natus nostrum in sed consequuntur velit', 'Graham Blair', '1975-01-01', 2, '2025-05-30 23:02:31', 5, '2025-05-30 23:02:31', NULL, NULL, NULL),
(2, 9, 'Nulla in harum reici', 'Yuri Espinoza', '2025-06-04', 2, '2025-06-05 12:40:24', 7, '2025-06-05 12:40:24', NULL, NULL, NULL),
(3, 10, 'Doloribus Nam fuga ', 'Amal Guerra', '2025-06-05', 2, '2025-06-05 12:43:14', 8, '2025-06-05 12:43:14', NULL, NULL, NULL),
(4, 10, 'Non enim qui excepte', 'Genevieve Ware', '2025-06-05', 2, '2025-06-05 12:43:14', 8, '2025-06-05 12:43:14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `region_status_id` int(11) NOT NULL,
  `region_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `region_created_by` int(11) DEFAULT NULL,
  `region_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `region_updated_by` int(11) DEFAULT NULL,
  `region_deleted_at` timestamp NULL DEFAULT NULL,
  `region_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region_name`, `region_status_id`, `region_created_at`, `region_created_by`, `region_updated_at`, `region_updated_by`, `region_deleted_at`, `region_deleted_by`) VALUES
(1, 'Arusha', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(2, 'Dar es Salaam', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(3, 'Dodoma', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(4, 'Geita', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(5, 'Iringa', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(6, 'Kagera', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(7, 'Katavi', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(8, 'Kigoma', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(9, 'Kilimanjaro', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(10, 'Lindi', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(11, 'Manyara', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(12, 'Mara', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(13, 'Mbeya', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(14, 'Morogoro', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(15, 'Mtwara', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(16, 'Mwanza', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(17, 'Njombe', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(18, 'Pemba North', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(19, 'Pemba South', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(20, 'Pwani', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(21, 'Rukwa', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(22, 'Ruvuma', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(23, 'Shinyanga', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(24, 'Simiyu', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(25, 'Singida', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(26, 'Songwe', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(27, 'Tabora', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(28, 'Tanga', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(29, 'Zanzibar Central/South', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(30, 'Zanzibar North', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL),
(31, 'Zanzibar Urban/West', 2, '2025-05-30 22:31:41', 1, '2025-05-30 22:31:41', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `skill_profile_id` int(11) NOT NULL,
  `skill_type` varchar(100) NOT NULL,
  `skill_name` varchar(200) NOT NULL,
  `skill_status_id` int(11) NOT NULL,
  `skill_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `skill_created_by` int(11) DEFAULT NULL,
  `skill_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `skill_updated_by` int(11) DEFAULT NULL,
  `skill_deleted_at` timestamp NULL DEFAULT NULL,
  `skill_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `skill_profile_id`, `skill_type`, `skill_name`, `skill_status_id`, `skill_created_at`, `skill_created_by`, `skill_updated_at`, `skill_updated_by`, `skill_deleted_at`, `skill_deleted_by`) VALUES
(1, 1, 'Sapiente sed irure deserunt similique nisi', 'Guy Mckee', 2, '2025-05-30 23:02:31', 5, '2025-05-30 23:02:31', NULL, NULL, NULL),
(2, 9, 'Dolor magnam volupta', 'Giselle Boyer', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(3, 10, 'Tempora totam quisqu', 'Melodie Cortez', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(4, 10, 'Minima amet incidid', 'Sylvia Mcgowan', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(5, 11, 'Technical', 'Computer Maintanance', 2, '2025-06-11 17:41:07', 9, '2025-06-11 17:41:07', NULL, NULL, NULL),
(6, 11, 'Soft', 'Data Analyst', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL),
(7, 11, 'Technical', 'Plumbing', 2, '2025-06-11 17:41:08', 9, '2025-06-11 17:41:08', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_profile`
--

CREATE TABLE `staff_profile` (
  `id` int(11) NOT NULL,
  `staff_company_id` int(11) NOT NULL,
  `staff_user_id` int(11) NOT NULL,
  `staff_first_name` varchar(100) NOT NULL,
  `staff_middle_name` varchar(100) DEFAULT NULL,
  `staff_last_name` varchar(100) NOT NULL,
  `staff_phone_number` varchar(10) NOT NULL,
  `staff_status_id` int(11) NOT NULL,
  `staff_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `staff_created_by` int(11) DEFAULT NULL,
  `staff_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `staff_updated_by` int(11) DEFAULT NULL,
  `staff_deleted_at` timestamp NULL DEFAULT NULL,
  `staff_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_lookup`
--

CREATE TABLE `status_lookup` (
  `id` int(11) NOT NULL,
  `status_code` varchar(10) NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `status_description` text DEFAULT NULL,
  `status_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_lookup`
--

INSERT INTO `status_lookup` (`id`, `status_code`, `status_name`, `status_description`, `status_created_at`, `status_updated_at`, `status_deleted_at`) VALUES
(1, 'inactive', 'Inactive', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(2, 'active', 'Active', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(3, 'published', 'Published', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(4, 'unpublish', 'Unpublished', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(5, 'paid', 'Paid', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(6, 'not-paid', 'Not Paid', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(7, 'pending', 'Pending', NULL, '2025-05-30 19:25:41', '2025-05-30 19:25:41', NULL),
(8, 'apply', 'Apply', NULL, '2025-06-05 15:41:38', '2025-06-05 15:41:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `id` int(11) NOT NULL,
  `subscription_plan_duration` int(11) NOT NULL DEFAULT 1,
  `subscription_plan_duration_type` varchar(10) NOT NULL DEFAULT 'months',
  `subscription_plan_status_id` int(11) NOT NULL,
  `subscription_plan_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subscription_plan_created_by` int(11) DEFAULT NULL,
  `subscription_plan_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subscription_plan_updated_by` int(11) DEFAULT NULL,
  `subscription_plan_deleted_at` timestamp NULL DEFAULT NULL,
  `subscription_plan_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `subscription_plan_duration`, `subscription_plan_duration_type`, `subscription_plan_status_id`, `subscription_plan_created_at`, `subscription_plan_created_by`, `subscription_plan_updated_at`, `subscription_plan_updated_by`, `subscription_plan_deleted_at`, `subscription_plan_deleted_by`) VALUES
(1, 1, 'month', 2, '2025-05-30 19:40:07', 1, '2025-05-30 19:40:07', NULL, NULL, NULL),
(2, 3, 'months', 2, '2025-05-30 19:40:07', 1, '2025-05-30 19:40:07', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

CREATE TABLE `test_question` (
  `id` int(11) NOT NULL,
  `question_company_id` int(11) NOT NULL,
  `question_test_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `question_status_id` int(11) NOT NULL,
  `question_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `question_created_by` int(11) DEFAULT NULL,
  `question_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `question_updated_by` int(11) DEFAULT NULL,
  `question_deleted_at` timestamp NULL DEFAULT NULL,
  `question_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`id`, `question_company_id`, `question_test_id`, `question`, `question_status_id`, `question_created_at`, `question_created_by`, `question_updated_at`, `question_updated_by`, `question_deleted_at`, `question_deleted_by`) VALUES
(1, 2, 1, 'Libero quam irure ve', 2, '2025-06-11 18:09:40', 4, '2025-06-11 18:09:40', NULL, NULL, NULL),
(2, 2, 1, 'Corporis cum enim hi', 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(3, 2, 1, 'Qui praesentium cumq', 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(4, 2, 1, 'Voluptate ipsa dolo', 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(5, 2, 1, 'Eligendi possimus f', 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(6, 2, 2, 'Rerum numquam eius v', 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(7, 2, 2, 'Magni eius ut rerum ', 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(8, 2, 2, 'Iusto iure ad numqua', 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(9, 2, 2, 'Corporis quia Nam er', 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(10, 2, 2, 'Aliquam Nam totam il', 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(11, 2, 3, 'Repellendus Consequ', 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(12, 2, 3, 'Qui ut harum nobis t', 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(13, 2, 3, 'Tempor ea odio quisq', 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(14, 2, 3, 'Totam alias corporis', 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(15, 2, 3, 'Quia recusandae Qua', 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(16, 2, 3, 'Quaerat sit dolor i', 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_question_choice`
--

CREATE TABLE `test_question_choice` (
  `id` int(11) NOT NULL,
  `choice_company_id` int(11) NOT NULL,
  `choice_question_id` int(11) NOT NULL,
  `choice_label` varchar(1) NOT NULL,
  `choice_text` text NOT NULL,
  `choice_is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `choice_status_id` int(11) NOT NULL,
  `choice_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `choice_created_by` int(11) DEFAULT NULL,
  `choice_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `choice_updated_by` int(11) DEFAULT NULL,
  `choice_deleted_at` timestamp NULL DEFAULT NULL,
  `choice_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_question_choice`
--

INSERT INTO `test_question_choice` (`id`, `choice_company_id`, `choice_question_id`, `choice_label`, `choice_text`, `choice_is_correct`, `choice_status_id`, `choice_created_at`, `choice_created_by`, `choice_updated_at`, `choice_updated_by`, `choice_deleted_at`, `choice_deleted_by`) VALUES
(1, 2, 1, 'A', 'Esse aut distinctio', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(2, 2, 1, 'B', 'Architecto vel exerc', 1, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(3, 2, 1, 'C', 'Iusto labore ipsum ', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(4, 2, 1, 'D', 'Impedit consequatur', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(5, 2, 2, 'A', 'Libero voluptatem E', 1, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(6, 2, 2, 'B', 'Consequat Voluptas ', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(7, 2, 2, 'C', 'Qui eveniet molesti', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(8, 2, 2, 'D', 'Veniam ea eveniet ', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(9, 2, 3, 'A', 'Rerum qui natus expe', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(10, 2, 3, 'B', 'Iure nulla maiores a', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(11, 2, 3, 'C', 'Dolorem cillum offic', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(12, 2, 3, 'D', 'Cillum quam et nostr', 1, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(13, 2, 4, 'A', 'Non qui minima alias', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(14, 2, 4, 'B', 'Quos iusto qui commo', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(15, 2, 4, 'C', 'Fuga Qui officia pa', 1, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(16, 2, 4, 'D', 'Dolores eiusmod labo', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(17, 2, 5, 'A', 'Velit quasi fuga A', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(18, 2, 5, 'B', 'Qui duis vitae repel', 1, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(19, 2, 5, 'C', 'Dolor in est nostrud', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(20, 2, 5, 'D', 'Est ea aut laborum ', 0, 2, '2025-06-11 18:09:41', 4, '2025-06-11 18:09:41', NULL, NULL, NULL),
(21, 2, 6, 'A', 'Placeat qui anim ex', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(22, 2, 6, 'B', 'Voluptates atque per', 1, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(23, 2, 6, 'C', 'Saepe illo temporibu', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(24, 2, 6, 'D', 'Iusto ipsam qui dese', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(25, 2, 7, 'A', 'Vel tempore eaque u', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(26, 2, 7, 'B', 'Sunt itaque aperiam ', 1, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(27, 2, 7, 'C', 'Ut est quia fuga Qu', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(28, 2, 7, 'D', 'Ducimus laboriosam', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(29, 2, 8, 'A', 'Mollitia qui placeat', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(30, 2, 8, 'B', 'Dignissimos sint mol', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(31, 2, 8, 'C', 'Eum ab ab quia ipsum', 1, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(32, 2, 8, 'D', 'Sit unde voluptatem', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(33, 2, 9, 'A', 'Qui odio vel ad veli', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(34, 2, 9, 'B', 'Laudantium eligendi', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(35, 2, 9, 'C', 'Quisquam est qui aut', 1, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(36, 2, 9, 'D', 'Voluptatem adipisci', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(37, 2, 10, 'A', 'Nostrud dolor in mag', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(38, 2, 10, 'B', 'Sequi quis fugit vo', 1, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(39, 2, 10, 'C', 'Et blanditiis earum ', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(40, 2, 10, 'D', 'Iure labore eiusmod ', 0, 2, '2025-06-11 18:10:36', 4, '2025-06-11 18:10:36', NULL, NULL, NULL),
(41, 2, 11, 'A', 'Magnam exercitatione', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(42, 2, 11, 'B', 'Veniam maiores qui ', 1, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(43, 2, 11, 'C', 'Excepturi tenetur in', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(44, 2, 11, 'D', 'Velit ut occaecat e', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(45, 2, 12, 'A', 'Assumenda incididunt', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(46, 2, 12, 'B', 'Proident adipisicin', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(47, 2, 12, 'C', 'Consequatur Exercit', 1, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(48, 2, 12, 'D', 'Quibusdam consectetu', 0, 2, '2025-06-11 18:11:35', 4, '2025-06-11 18:11:35', NULL, NULL, NULL),
(49, 2, 13, 'A', 'Similique ea invento', 1, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(50, 2, 13, 'B', 'Ut commodo magni non', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(51, 2, 13, 'C', 'Aute est quia est do', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(52, 2, 13, 'D', 'Et vero optio place', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(53, 2, 14, 'A', 'Earum quia ut sint a', 1, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(54, 2, 14, 'B', 'Qui sapiente veniam', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(55, 2, 14, 'C', 'Reprehenderit paria', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(56, 2, 14, 'D', 'Harum commodo ad omn', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(57, 2, 15, 'A', 'Ut voluptatem conse', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(58, 2, 15, 'B', 'Voluptates corporis ', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(59, 2, 15, 'C', 'Quia neque hic moles', 1, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(60, 2, 15, 'D', 'Id aliquid sapiente ', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(61, 2, 16, 'A', 'Quos quod est fuga', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(62, 2, 16, 'B', 'Dolore qui voluptas ', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(63, 2, 16, 'C', 'Sit et aut in ducimu', 1, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL),
(64, 2, 16, 'D', 'Voluptas et consecte', 0, 2, '2025-06-11 18:11:36', 4, '2025-06-11 18:11:36', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `id` int(11) NOT NULL,
  `result_company_id` int(11) NOT NULL,
  `result_test_id` int(11) NOT NULL,
  `result_user_id` int(11) NOT NULL,
  `result_score` decimal(3,2) NOT NULL,
  `result_status_id` int(11) NOT NULL,
  `result_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `result_created_by` int(11) DEFAULT NULL,
  `result_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `result_updated_by` int(11) DEFAULT NULL,
  `result_deleted_at` timestamp NULL DEFAULT NULL,
  `result_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `user_status_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `user_created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `user_updated_by` int(11) DEFAULT NULL,
  `user_deleted_at` timestamp NULL DEFAULT NULL,
  `user_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `company_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `verification_token`, `user_status_id`, `created_at`, `user_created_by`, `updated_at`, `user_updated_by`, `user_deleted_at`, `user_deleted_by`) VALUES
(1, 1, 'admin', 'kh94nizKz9PpadKPuBwQYwsk8_Sh8xrL', '$2y$13$Ar307fiRBTVPn.U2.mRdoeiKB3NYSWowZxxbb4tJQPSZi7UutLYi2', NULL, 'drfeelfinesolutions@gmail.com', '8rovvIE1Dnuk4TIo880CMe-z_2yMjrTV_1748633617', 2, 1748633617, NULL, 1748633721, NULL, NULL, NULL),
(2, 2, 'airtel admin', 'R8fikiYnbE2_nEtWHx5D2vCEzSQ6xMRZ', '$2y$13$cO8HLX4/N8725vKC6cUvwuKaD24iKP1b3r11JJLUQ.dcwv3dH2s4S', NULL, 'mrairteladmin@airtel.co.tz', '9VXQywx4sRtt8a-L8EnBJvSc4SP52Trx_1748634192', 2, 1748634192, 1, 1748634586, NULL, NULL, NULL),
(3, 2, 'airtel manager', 'QtGTIBF1sjSA6cX62iitfrEkgTaCdh3r', '$2y$13$oeCCOz1rH1/s7z1gd3oj/.zXKK85AG5AtcfuIjtYU1UZWbdEyxP06', NULL, 'msairtelmanager@airtel.co.tz', 'QtXO7lJcIURZaUDzM8KmCALtIuxjbD4x_1748634422', 2, 1748634422, 2, 1748634618, NULL, NULL, NULL),
(4, 2, 'airtel hr', '2nrPhpKat7RmLqbAjMyvIZRkqCCdymH5', '$2y$13$AoA.v2ZDAWySiJqkDloBtOezN1eVv3HJqdRlcWvMGDM6dEpiVIF6i', NULL, 'msairtelhr@airtel.co.tz', '7UtwxHn0ozIDzeQwhNucZAXzycNctrP9_1748634473', 2, 1748634473, 2, 1748986980, NULL, NULL, NULL),
(5, NULL, 'applicant', 'X_56P2Q4g72bpkZ7-2_XqtZF_EFY1tRx', '$2y$13$KpGLEkIQLn4631z8.1Vk6eTQMJW9Hx3Kl.UxqyXyIK24m1zz5hceS', NULL, 'applicant@example.com', 'x-ekQHF6131cDdWBQfxDyd84Aur65k9A_1748634745', 2, 1748634745, NULL, 1748634745, NULL, NULL, NULL),
(6, NULL, 'rachel', 'mqX1MaxqLcrBkQSjTedh5TqqiTm2Vy2_', '$2y$13$aGH1QHlnDHuuHAr1pWyS6OgIdFDClDBZ6DK.8RBN0Fm0pfPAEmx.i', NULL, 'rachel@example.udom', 't6tdr9QYbLSrw0_pZfHf8U_tXtDI8E2w_1748987073', 2, 1748987073, NULL, 1748987073, NULL, NULL, NULL),
(7, NULL, 'applicant2', '_WmQXJRbFljU0PVnUtX4h0BTfUH87Su_', '$2y$13$X9q9hLV9roWTlvqCOty.WuoIzrieIlMokZvlJWgN4is9WPV3.QbXC', NULL, 'applicant2@example.com', '25r29pZmOEoK5opfhzhMcjwTJaNqo10W_1749107915', 2, 1749107915, NULL, 1749107915, NULL, NULL, NULL),
(8, NULL, 'applicant3', 'GPUPZZduMe79-VP-MTEeCjCLhgZ6MyWo', '$2y$13$P8dq8q6RoKsNhxjbTK9ip.k7NK94IfpJ.BPD1H1Mjg4JHyYCXoRSm', NULL, 'applicant3@example.com', 'Yv2nTzAheTf7LPX2or_leWX45IOWENQF_1749127278', 2, 1749127278, NULL, 1749127278, NULL, NULL, NULL),
(9, NULL, 'applicant4', 'uduiDjqpbEXyUtezhEoH8LqDDJRVpibh', '$2y$13$lRlrmfNtkmlWUOtDhjCvh.mvxOMgxR4XwxwOKTLszECVy/jLqqI2q', NULL, 'applicant4@example.com', '0Bi4jQXdVodInBGwCZfBzkWz9LKTsSoj_1749661107', 2, 1749661107, NULL, 1749661107, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `id` int(11) NOT NULL,
  `experience_profile_id` int(11) NOT NULL,
  `experience_job_title` varchar(100) DEFAULT NULL,
  `experience_company_name` varchar(150) NOT NULL,
  `experience_from` date NOT NULL,
  `experience_to` date DEFAULT NULL,
  `experience_status_id` int(11) NOT NULL,
  `experience_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `experience_created_by` int(11) DEFAULT NULL,
  `experience_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `experience_updated_by` int(11) DEFAULT NULL,
  `experience_deleted_at` timestamp NULL DEFAULT NULL,
  `experience_deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `experience_profile_id`, `experience_job_title`, `experience_company_name`, `experience_from`, `experience_to`, `experience_status_id`, `experience_created_at`, `experience_created_by`, `experience_updated_at`, `experience_updated_by`, `experience_deleted_at`, `experience_deleted_by`) VALUES
(1, 1, 'Deserunt omnis natus fuga Expedita est debitis aliquam ratione fuga Veniam', 'Gonzalez and Prince Trading', '2021-02-23', '2025-05-14', 2, '2025-05-30 23:02:30', 5, '2025-05-30 23:02:30', NULL, NULL, NULL),
(4, 9, 'Cupidatat molestiae ', 'Buck Foster Traders', '2025-06-01', '2025-06-05', 2, '2025-06-05 12:40:23', 7, '2025-06-05 12:40:23', NULL, NULL, NULL),
(5, 10, 'Non quas corporis do', 'Gardner Snow LLC', '2025-06-01', '2025-06-05', 2, '2025-06-05 12:43:12', 8, '2025-06-05 12:43:12', NULL, NULL, NULL),
(6, 10, 'Recusandae Eos et q', 'Forbes and Obrien Co', '2025-06-01', '2025-06-05', 2, '2025-06-05 12:43:13', 8, '2025-06-05 12:43:13', NULL, NULL, NULL),
(7, 11, 'Software Engineer', 'Softnet LTD', '2010-03-11', '2015-06-17', 2, '2025-06-11 17:41:06', 9, '2025-06-11 17:41:06', NULL, NULL, NULL),
(8, 11, 'Data analyst', 'Duxte LTD', '2015-06-24', '2025-06-10', 2, '2025-06-11 17:41:07', 9, '2025-06-11 17:41:07', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-award_profile_id-award_title-award_organization_name` (`award_profile_id`,`award_title`,`award_organization_name`,`award_issue_number`),
  ADD KEY `idx-award-award_profile_id` (`award_profile_id`),
  ADD KEY `idx-award-award_status_id` (`award_status_id`),
  ADD KEY `idx-award-award_created_by` (`award_created_by`),
  ADD KEY `idx-award-award_updated_by` (`award_updated_by`),
  ADD KEY `idx-award-award_deleted_by` (`award_deleted_by`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD UNIQUE KEY `company_email` (`company_email`),
  ADD KEY `idx-company-company_status_id` (`company_status_id`);

--
-- Indexes for table `company_subscription`
--
ALTER TABLE `company_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-company_subscription-subscription_company_id` (`subscription_company_id`),
  ADD KEY `idx-company_subscription-subscription_plan_id` (`subscription_plan_id`),
  ADD KEY `idx-company_subscription-subscription_status_id` (`subscription_status_id`),
  ADD KEY `idx-company_subscription-subscription_created_by` (`subscription_created_by`),
  ADD KEY `idx-company_subscription-subscription_updated_by` (`subscription_updated_by`),
  ADD KEY `idx-company_subscription-subscription_deleted_by` (`subscription_deleted_by`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-district_region_id-district_name` (`district_region_id`,`district_name`),
  ADD KEY `idx-district-district_region_id` (`district_region_id`),
  ADD KEY `idx-district-district_status_id` (`district_status_id`),
  ADD KEY `idx-district-district_created_by` (`district_created_by`),
  ADD KEY `idx-district-district_updated_by` (`district_updated_by`),
  ADD KEY `idx-district-district_deleted_by` (`district_deleted_by`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-education_profile-degree-programme-university` (`education_profile_id`,`education_degree_name`,`education_programme_name`,`education_university_name`),
  ADD KEY `idx-education-education_profile_id` (`education_profile_id`),
  ADD KEY `idx-education-education_status_id` (`education_status_id`),
  ADD KEY `idx-education-education_created_by` (`education_created_by`),
  ADD KEY `idx-education-education_updated_by` (`education_updated_by`),
  ADD KEY `idx-education-education_deleted_by` (`education_deleted_by`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-job_application-applicant_company_id` (`applicant_company_id`),
  ADD KEY `idx-job_application-applicant_job_post_id` (`applicant_job_post_id`),
  ADD KEY `idx-job_application-applicant_user_id` (`applicant_user_id`),
  ADD KEY `idx-job_application-applicant_status_id` (`applicant_status_id`),
  ADD KEY `idx-job_application-applicant_created_by` (`applicant_created_by`),
  ADD KEY `idx-job_application-applicant_updated_by` (`applicant_updated_by`),
  ADD KEY `idx-job_application-applicant_deleted_by` (`applicant_deleted_by`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-post_company-user-title-type-profession` (`post_company_id`,`post_user_id`,`post_job_title`,`post_job_type`,`post_profession`,`post_publication_date`,`post_deadline`),
  ADD KEY `idx-job_post-post_company_id` (`post_company_id`),
  ADD KEY `idx-job_post-post_user_id` (`post_user_id`),
  ADD KEY `idx-job_post-post_status_id` (`post_status_id`),
  ADD KEY `idx-job_post-post_created_by` (`post_created_by`),
  ADD KEY `idx-job_post-post_updated_by` (`post_updated_by`),
  ADD KEY `idx-job_post-post_deleted_by` (`post_deleted_by`);

--
-- Indexes for table `job_test`
--
ALTER TABLE `job_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-test_company-job_post-user-identification` (`test_company_id`,`test_job_post_id`,`test_user_id`,`test_identification`),
  ADD KEY `idx-job_test-test_company_id` (`test_company_id`),
  ADD KEY `idx-job_test-test_job_post_id` (`test_job_post_id`),
  ADD KEY `idx-job_test-test_user_id` (`test_user_id`),
  ADD KEY `idx-job_test-test_status_id` (`test_status_id`),
  ADD KEY `idx-job_test-test_created_by` (`test_created_by`),
  ADD KEY `idx-job_test-test_updated_by` (`test_updated_by`),
  ADD KEY `idx-job_test-test_deleted_by` (`test_deleted_by`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-language_profile_id-language_name` (`language_profile_id`,`language_name`),
  ADD KEY `idx-language-language_profile_id` (`language_profile_id`),
  ADD KEY `idx-language-language_status_id` (`language_status_id`),
  ADD KEY `idx-language-language_created_by` (`language_created_by`),
  ADD KEY `idx-language-language_updated_by` (`language_updated_by`),
  ADD KEY `idx-language-language_deleted_by` (`language_deleted_by`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `personality_assessment`
--
ALTER TABLE `personality_assessment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-personality_profile-IE-NS-TF-JB` (`personality_profile_id`,`personality_IE_score`,`personality_NS_score`,`personality_TF_score`,`personality_JB_score`),
  ADD KEY `idx-personality_assessment-personality_profile_id` (`personality_profile_id`),
  ADD KEY `idx-personality_assessment-personality_status_id` (`personality_status_id`),
  ADD KEY `idx-personality_assessment-personality_created_by` (`personality_created_by`),
  ADD KEY `idx-personality_assessment-personality_updated_by` (`personality_updated_by`),
  ADD KEY `idx-personality_assessment-personality_deleted_by` (`personality_deleted_by`);

--
-- Indexes for table `phone_number`
--
ALTER TABLE `phone_number`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-phone_profile_id-phone_number` (`phone_profile_id`,`phone_number`),
  ADD KEY `idx-phone_number-phone_profile_id` (`phone_profile_id`),
  ADD KEY `idx-phone_number-phone_status_id` (`phone_status_id`),
  ADD KEY `idx-phone_number-phone_created_by` (`phone_created_by`),
  ADD KEY `idx-phone_number-phone_updated_by` (`phone_updated_by`),
  ADD KEY `idx-phone_number-phone_deleted_by` (`phone_deleted_by`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-profile-profile_user_id` (`profile_user_id`),
  ADD KEY `idx-profile-profile_region_id` (`profile_region_id`),
  ADD KEY `idx-profile-profile_district_id` (`profile_district_id`),
  ADD KEY `idx-profile-profile_status_id` (`profile_status_id`),
  ADD KEY `idx-profile-profile_created_by` (`profile_created_by`),
  ADD KEY `idx-profile-profile_updated_by` (`profile_updated_by`),
  ADD KEY `idx-profile-profile_deleted_by` (`profile_deleted_by`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-publication_profile_id-title-name-date_of_publication` (`publication_profile_id`,`publication_title`,`publication_publisher_name`,`publication_date_of_publication`),
  ADD KEY `idx-publication-publication_profile_id` (`publication_profile_id`),
  ADD KEY `idx-publication-publication_status_id` (`publication_status_id`),
  ADD KEY `idx-publication-publication_created_by` (`publication_created_by`),
  ADD KEY `idx-publication-publication_updated_by` (`publication_updated_by`),
  ADD KEY `idx-publication-publication_deleted_by` (`publication_deleted_by`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `region_name` (`region_name`),
  ADD KEY `idx-region-region_status_id` (`region_status_id`),
  ADD KEY `idx-region-region_created_by` (`region_created_by`),
  ADD KEY `idx-region-region_updated_by` (`region_updated_by`),
  ADD KEY `idx-region-region_deleted_by` (`region_deleted_by`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-skill_profile_id-skill_type-skill_name` (`skill_profile_id`,`skill_type`,`skill_name`),
  ADD KEY `idx-skill-skill_profile_id` (`skill_profile_id`),
  ADD KEY `idx-skill-skill_status_id` (`skill_status_id`),
  ADD KEY `idx-skill-skill_created_by` (`skill_created_by`),
  ADD KEY `idx-skill-skill_updated_by` (`skill_updated_by`),
  ADD KEY `idx-skill-skill_deleted_by` (`skill_deleted_by`);

--
-- Indexes for table `staff_profile`
--
ALTER TABLE `staff_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-staff_company-user-first_name-last_name-phone_number` (`staff_company_id`,`staff_user_id`,`staff_first_name`,`staff_last_name`,`staff_phone_number`),
  ADD KEY `idx-staff_profile-staff_company_id` (`staff_company_id`),
  ADD KEY `idx-staff_profile-staff_user_id` (`staff_user_id`),
  ADD KEY `idx-staff_profile-staff_status_id` (`staff_status_id`),
  ADD KEY `idx-staff_profile-staff_created_by` (`staff_created_by`),
  ADD KEY `idx-staff_profile-staff_updated_by` (`staff_updated_by`),
  ADD KEY `idx-staff_profile-staff_deleted_by` (`staff_deleted_by`);

--
-- Indexes for table `status_lookup`
--
ALTER TABLE `status_lookup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_code` (`status_code`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-subscription_plan-subscription_plan_status_id` (`subscription_plan_status_id`);

--
-- Indexes for table `test_question`
--
ALTER TABLE `test_question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-question_company-test-question` (`question_company_id`,`question_test_id`,`question`) USING HASH,
  ADD KEY `idx-test_question-question_company_id` (`question_company_id`),
  ADD KEY `idx-test_question-question_test_id` (`question_test_id`),
  ADD KEY `idx-test_question-question_status_id` (`question_status_id`),
  ADD KEY `idx-test_question-question_created_by` (`question_created_by`),
  ADD KEY `idx-test_question-question_updated_by` (`question_updated_by`),
  ADD KEY `idx-test_question-question_deleted_by` (`question_deleted_by`);

--
-- Indexes for table `test_question_choice`
--
ALTER TABLE `test_question_choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-test_question_choice-choice_company_id` (`choice_company_id`),
  ADD KEY `idx-test_question_choice-choice_question_id` (`choice_question_id`),
  ADD KEY `idx-test_question_choice-choice_status_id` (`choice_status_id`),
  ADD KEY `idx-test_question_choice-choice_created_by` (`choice_created_by`),
  ADD KEY `idx-test_question_choice-choice_updated_by` (`choice_updated_by`),
  ADD KEY `idx-test_question_choice-choice_deleted_by` (`choice_deleted_by`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-test_result-result_company_id` (`result_company_id`),
  ADD KEY `idx-test_result-result_test_id` (`result_test_id`),
  ADD KEY `idx-test_result-result_user_id` (`result_user_id`),
  ADD KEY `idx-test_result-result_status_id` (`result_status_id`),
  ADD KEY `idx-test_result-result_created_by` (`result_created_by`),
  ADD KEY `idx-test_result-result_updated_by` (`result_updated_by`),
  ADD KEY `idx-test_result-result_deleted_by` (`result_deleted_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `idx-user-company_id` (`company_id`),
  ADD KEY `idx-user-user_status_id` (`user_status_id`),
  ADD KEY `idx-user-user_deleted_by` (`user_deleted_by`),
  ADD KEY `idx-user-user_created_by` (`user_created_by`),
  ADD KEY `idx-user-user_updated_by` (`user_updated_by`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-experience_profile-job_title-company_name-from-to` (`experience_profile_id`,`experience_job_title`,`experience_company_name`,`experience_from`,`experience_to`),
  ADD KEY `idx-work_experience-experience_profile_id` (`experience_profile_id`),
  ADD KEY `idx-work_experience-experience_status_id` (`experience_status_id`),
  ADD KEY `idx-work_experience-experience_created_by` (`experience_created_by`),
  ADD KEY `idx-work_experience-experience_updated_by` (`experience_updated_by`),
  ADD KEY `idx-work_experience-experience_deleted_by` (`experience_deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_subscription`
--
ALTER TABLE `company_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_test`
--
ALTER TABLE `job_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personality_assessment`
--
ALTER TABLE `personality_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_number`
--
ALTER TABLE `phone_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff_profile`
--
ALTER TABLE `staff_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_lookup`
--
ALTER TABLE `status_lookup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `test_question_choice`
--
ALTER TABLE `test_question_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `award`
--
ALTER TABLE `award`
  ADD CONSTRAINT `fk-award-award_created_by` FOREIGN KEY (`award_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-award-award_deleted_by` FOREIGN KEY (`award_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-award-award_profile_id` FOREIGN KEY (`award_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-award-award_status_id` FOREIGN KEY (`award_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-award-award_updated_by` FOREIGN KEY (`award_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk-company-company_status_id` FOREIGN KEY (`company_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_subscription`
--
ALTER TABLE `company_subscription`
  ADD CONSTRAINT `fk-company_subscription-subscription_company_id` FOREIGN KEY (`subscription_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-company_subscription-subscription_created_by` FOREIGN KEY (`subscription_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-company_subscription-subscription_deleted_by` FOREIGN KEY (`subscription_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-company_subscription-subscription_plan_id` FOREIGN KEY (`subscription_plan_id`) REFERENCES `subscription_plan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-company_subscription-subscription_status_id` FOREIGN KEY (`subscription_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-company_subscription-subscription_updated_by` FOREIGN KEY (`subscription_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk-district-district_created_by` FOREIGN KEY (`district_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-district-district_deleted_by` FOREIGN KEY (`district_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-district-district_region_id` FOREIGN KEY (`district_region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-district-district_status_id` FOREIGN KEY (`district_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-district-district_updated_by` FOREIGN KEY (`district_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `fk-education-education_created_by` FOREIGN KEY (`education_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-education-education_deleted_by` FOREIGN KEY (`education_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-education-education_profile_id` FOREIGN KEY (`education_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-education-education_status_id` FOREIGN KEY (`education_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-education-education_updated_by` FOREIGN KEY (`education_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `fk-job_application-applicant_company_id` FOREIGN KEY (`applicant_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_application-applicant_created_by` FOREIGN KEY (`applicant_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_application-applicant_deleted_by` FOREIGN KEY (`applicant_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_application-applicant_job_post_id` FOREIGN KEY (`applicant_job_post_id`) REFERENCES `job_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_application-applicant_status_id` FOREIGN KEY (`applicant_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_application-applicant_updated_by` FOREIGN KEY (`applicant_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_application-applicant_user_id` FOREIGN KEY (`applicant_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_post`
--
ALTER TABLE `job_post`
  ADD CONSTRAINT `fk-job_post-post_company_id` FOREIGN KEY (`post_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_post-post_created_by` FOREIGN KEY (`post_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_post-post_deleted_by` FOREIGN KEY (`post_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_post-post_status_id` FOREIGN KEY (`post_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_post-post_updated_by` FOREIGN KEY (`post_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_post-post_user_id` FOREIGN KEY (`post_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_test`
--
ALTER TABLE `job_test`
  ADD CONSTRAINT `fk-job_test-test_company_id` FOREIGN KEY (`test_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_test-test_created_by` FOREIGN KEY (`test_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_test-test_deleted_by` FOREIGN KEY (`test_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_test-test_job_post_id` FOREIGN KEY (`test_job_post_id`) REFERENCES `job_post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_test-test_status_id` FOREIGN KEY (`test_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-job_test-test_updated_by` FOREIGN KEY (`test_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-job_test-test_user_id` FOREIGN KEY (`test_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `fk-language-language_created_by` FOREIGN KEY (`language_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-language-language_deleted_by` FOREIGN KEY (`language_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-language-language_profile_id` FOREIGN KEY (`language_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-language-language_status_id` FOREIGN KEY (`language_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-language-language_updated_by` FOREIGN KEY (`language_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `personality_assessment`
--
ALTER TABLE `personality_assessment`
  ADD CONSTRAINT `fk-personality_assessment-personality_created_by` FOREIGN KEY (`personality_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-personality_assessment-personality_deleted_by` FOREIGN KEY (`personality_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-personality_assessment-personality_profile_id` FOREIGN KEY (`personality_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-personality_assessment-personality_status_id` FOREIGN KEY (`personality_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-personality_assessment-personality_updated_by` FOREIGN KEY (`personality_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `phone_number`
--
ALTER TABLE `phone_number`
  ADD CONSTRAINT `fk-phone_number-phone_created_by` FOREIGN KEY (`phone_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-phone_number-phone_deleted_by` FOREIGN KEY (`phone_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-phone_number-phone_profile_id` FOREIGN KEY (`phone_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-phone_number-phone_status_id` FOREIGN KEY (`phone_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-phone_number-phone_updated_by` FOREIGN KEY (`phone_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk-profile-profile_created_by` FOREIGN KEY (`profile_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-profile-profile_deleted_by` FOREIGN KEY (`profile_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-profile-profile_district_id` FOREIGN KEY (`profile_district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-profile-profile_region_id` FOREIGN KEY (`profile_region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-profile-profile_status_id` FOREIGN KEY (`profile_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-profile-profile_updated_by` FOREIGN KEY (`profile_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-profile-profile_user_id` FOREIGN KEY (`profile_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk-publication-publication_created_by` FOREIGN KEY (`publication_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-publication-publication_deleted_by` FOREIGN KEY (`publication_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-publication-publication_profile_id` FOREIGN KEY (`publication_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-publication-publication_status_id` FOREIGN KEY (`publication_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-publication-publication_updated_by` FOREIGN KEY (`publication_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `fk-region-region_created_by` FOREIGN KEY (`region_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-region-region_deleted_by` FOREIGN KEY (`region_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-region-region_status_id` FOREIGN KEY (`region_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-region-region_updated_by` FOREIGN KEY (`region_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `fk-skill-skill_created_by` FOREIGN KEY (`skill_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-skill-skill_deleted_by` FOREIGN KEY (`skill_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-skill-skill_profile_id` FOREIGN KEY (`skill_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-skill-skill_status_id` FOREIGN KEY (`skill_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-skill-skill_updated_by` FOREIGN KEY (`skill_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `staff_profile`
--
ALTER TABLE `staff_profile`
  ADD CONSTRAINT `fk-staff_profile-staff_company_id` FOREIGN KEY (`staff_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-staff_profile-staff_created_by` FOREIGN KEY (`staff_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-staff_profile-staff_deleted_by` FOREIGN KEY (`staff_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-staff_profile-staff_status_id` FOREIGN KEY (`staff_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-staff_profile-staff_updated_by` FOREIGN KEY (`staff_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-staff_profile-staff_user_id` FOREIGN KEY (`staff_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD CONSTRAINT `fk-subscription_plan-subscription_plan_status_id` FOREIGN KEY (`subscription_plan_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_question`
--
ALTER TABLE `test_question`
  ADD CONSTRAINT `fk-test_question-question_company_id` FOREIGN KEY (`question_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question-question_created_by` FOREIGN KEY (`question_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_question-question_deleted_by` FOREIGN KEY (`question_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_question-question_status_id` FOREIGN KEY (`question_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question-question_test_id` FOREIGN KEY (`question_test_id`) REFERENCES `job_test` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question-question_updated_by` FOREIGN KEY (`question_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `test_question_choice`
--
ALTER TABLE `test_question_choice`
  ADD CONSTRAINT `fk-test_question_choice-choice_company_id` FOREIGN KEY (`choice_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question_choice-choice_created_by` FOREIGN KEY (`choice_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_question_choice-choice_deleted_by` FOREIGN KEY (`choice_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_question_choice-choice_question_id` FOREIGN KEY (`choice_question_id`) REFERENCES `test_question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question_choice-choice_status_id` FOREIGN KEY (`choice_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_question_choice-choice_updated_by` FOREIGN KEY (`choice_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `fk-test_result-result_company_id` FOREIGN KEY (`result_company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_result-result_created_by` FOREIGN KEY (`result_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_result-result_deleted_by` FOREIGN KEY (`result_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_result-result_status_id` FOREIGN KEY (`result_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_result-result_test_id` FOREIGN KEY (`result_test_id`) REFERENCES `job_test` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-test_result-result_updated_by` FOREIGN KEY (`result_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-test_result-result_user_id` FOREIGN KEY (`result_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-user-company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-user-user_created_by` FOREIGN KEY (`user_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-user-user_deleted_by` FOREIGN KEY (`user_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-user-user_status_id` FOREIGN KEY (`user_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user-user_updated_by` FOREIGN KEY (`user_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD CONSTRAINT `fk-work_experience-experience_created_by` FOREIGN KEY (`experience_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-work_experience-experience_deleted_by` FOREIGN KEY (`experience_deleted_by`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk-work_experience-experience_profile_id` FOREIGN KEY (`experience_profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-work_experience-experience_status_id` FOREIGN KEY (`experience_status_id`) REFERENCES `status_lookup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-work_experience-experience_updated_by` FOREIGN KEY (`experience_updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
