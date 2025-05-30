-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 12:21 AM
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

CREATE DATABASE IF NOT EXISTS apcafs;
USE apcafs;


CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('applicant', '10', 1746172245),
('company-admin', '8', 1746171129),
('hr', '9', 1746171676),
('super-admin', '7', 1746170440);

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
(6, 'APCAFS Co.', '0783743662', 'apcafs@example.com', 'cive', NULL, 2, 'ydaerla09Wkrx2Zsdesu', '2025-05-02 06:21:43', 2, '2025-05-02 07:19:00', '2025-05-02 07:21:43', NULL),
(7, 'Cook Foster Traders', '0783647737', 'pewylab@mailinator.com', 'Mckay and Sparks LLC', NULL, 4, 'ydaerlaRYMEea7vsdesu', '2025-05-02 06:38:21', 2, '2025-05-02 07:31:31', '2025-05-02 07:38:21', NULL);

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
(5, 7, 1, '2025-05-02', '2025-06-02', 5, '2025-05-02 07:31:31', 7, '2025-05-02 07:31:31', NULL, NULL, NULL);

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
('m000000_000000_base', 1745556632),
('m140506_102106_rbac_init', 1745556638),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1745556640),
('m180523_151638_rbac_updates_indexes_without_prefix', 1745556642),
('m200409_110543_rbac_update_mssql_trigger', 1745556642),
('m250321_125624_create_status_lookup_table', 1745556649),
('m250321_125642_create_company_table', 1745556653),
('m250321_125657_create_subscription_plan_table', 1745556658),
('m250321_125721_create_user_table', 1745556683),
('m250321_125731_create_company_subscription_table', 1745556705),
('m250321_125740_create_staff_profile_table', 1745556734),
('m250323_232719_create_region_table', 1745556759),
('m250323_232746_create_district_table', 1745556781),
('m250323_232925_create_profile_table', 1745556819),
('m250324_002309_create_phone_number_table', 1745556838),
('m250324_003712_create_work_experience_table', 1745556859),
('m250324_005206_create_education_table', 1745556881),
('m250324_010422_create_skill_table', 1745556903),
('m250324_010436_create_award_table', 1745556919),
('m250324_010455_create_language_table', 1745556938),
('m250324_010524_create_publication_table', 1745556956),
('m250324_010559_create_personality_assessment_table', 1745556977),
('m250324_123641_create_job_post_table', 1745556994),
('m250324_123801_create_job_test_table', 1745557020),
('m250324_123834_create_test_question_table', 1745559190),
('m250324_123918_create_job_application_table', 1745559216),
('m250324_123948_create_test_result_table', 1745559235),
('m250421_112931_create_test_question_choice_table', 1745559255);

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
(1, 'inactive', 'Inactive', NULL, '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL),
(2, 'active', 'Active', NULL, '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL),
(3, 'published', 'published', 'Published', '2025-04-25 04:54:55', '2025-04-25 06:08:32', NULL),
(4, 'unpublish', 'Unpublished', '', '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL),
(5, 'paid', 'Paid', '', '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL),
(6, 'not-paid', 'Not Paid', '', '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL),
(7, 'pending', 'Pending', '', '2025-04-25 04:54:55', '2025-04-25 04:54:55', NULL);

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
(1, 1, 'month', 2, '2025-04-25 05:37:22', 1, '2025-04-25 05:37:22', NULL, NULL, NULL),
(2, 2, 'months', 2, '2025-04-25 05:37:22', 1, '2025-04-25 05:37:22', NULL, NULL, NULL);

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
(7, 6, 'admin', 'hVR0U7QexzNT5hJHzXIBdqEL8f5z5Jie', '$2y$13$7yohowPrCUCGuPaNzlB4SOc9JEzZP/RLbciLAXDwM5FDM0VqEKTTe', NULL, 'admin@example.com', 'hMNDlWDN7pgZJVOr6YUJireAInpI-K51_1746170433', 2, 1746170433, NULL, 1746170503, NULL, NULL, NULL),
(8, 7, 'company admin', 'KTzW2iu7tSsj1bU-YYBHOi_mjfbYpCjT', '$2y$13$LJysbW4VDAJPpj6OrnD.KuVpAocklegysA/GZRtDF.HEBx5BwJA0i', NULL, 'company-admin@gmail.com', 'DEuNBw_FCTGNRNEj6kPuD5oI87Mgx4sk_1746171129', 2, 1746171129, 7, 1746171733, NULL, NULL, NULL),
(9, 7, 'human resource', 'oCp9eYJxgapwJlW94YlvizcCaatW56RK', '$2y$13$6TarWsUAuzI6hTVaq9tGbeYy70oHlo.ACTvJRYxP41FRDUN54NJAW', NULL, 'humanresource@example.com', '5z8g-N6TWL5p3reDprAYJIXRU1k4lqbe_1746171676', 2, 1746171676, 8, 1746171676, NULL, NULL, NULL),
(10, NULL, 'applicant', '9ezo9DRCnNEtCg2mmtU85guttAAuIoOp', '$2y$13$CLW6LMNWeiZ1vvgl.JDnxenQbX5xEURInNtY1xogT4S4TFBfdxJj2', NULL, 'applicant@example.com', 'bHYbfZmJurcCbzVvko78BEQamiAcCNDq_1746172245', 2, 1746172245, NULL, 1746172245, NULL, NULL, NULL);

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
  ADD UNIQUE KEY `idx-unique-question_company-test-question` (`question_company_id`,`question_test_id`,`question`(255)) USING HASH,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_subscription`
--
ALTER TABLE `company_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_test`
--
ALTER TABLE `job_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personality_assessment`
--
ALTER TABLE `personality_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_number`
--
ALTER TABLE `phone_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_profile`
--
ALTER TABLE `staff_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_lookup`
--
ALTER TABLE `status_lookup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_question`
--
ALTER TABLE `test_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_question_choice`
--
ALTER TABLE `test_question_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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