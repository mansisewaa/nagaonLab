-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2022 at 12:00 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nagaondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `coll-center`
--

CREATE TABLE `coll-center` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coll-center`
--

INSERT INTO `coll-center` (`id`, `code`, `name`, `address`, `city`, `state`, `zip`, `mobile`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '001', 'Demo Center', 'demo', 'demo', 'ASSAM', 55445, 88776543, 'AA@G.COM', '2022-01-11 18:06:52', '2022-01-11 18:06:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collection_agents`
--

CREATE TABLE `collection_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` int(11) NOT NULL,
  `agentname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investigation`
--

CREATE TABLE `investigation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `core` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `investname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investigation`
--

INSERT INTO `investigation` (`id`, `core`, `investname`, `code`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LAB', 'BloodTest', 'b1', 500, '2022-01-11 18:07:47', '2022-01-13 11:44:29', '2022-01-13 11:44:29'),
(2, 'LAB', 'Ultrasound', 'O1', 1000, '2022-01-11 18:08:26', '2022-01-13 11:50:21', NULL),
(3, 'LAB', 'Mri', 'M1', 1500, '2022-01-11 18:08:47', '2022-01-13 11:50:24', NULL);

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
(8, '2021_12_14_130739_create_patient_details_table', 5),
(29, '2021_12_24_134314_add_deleted_at_to_coll-center_table', 7),
(35, '2021_12_24_161924_create_tests_table', 11),
(37, '2021_12_24_134059_add_deleted_at_to_coll-center_table', 13),
(38, '2022_01_11_155450_create_test_transaction_table', 14),
(39, '2022_01_11_164909_create_test_transaction_table', 15),
(41, '2014_10_12_000000_create_users_table', 16),
(42, '2014_10_12_100000_create_password_resets_table', 16),
(43, '2019_08_19_000000_create_failed_jobs_table', 16),
(44, '2019_12_14_000001_create_personal_access_tokens_table', 16),
(45, '2021_12_13_102209_create_coll-center_tbl', 16),
(46, '2021_12_13_161411_create_investigation_tbl', 16),
(47, '2021_12_13_171354_create_referrer_tbl', 16),
(48, '2021_12_14_151348_create_collection_agents_table', 16),
(49, '2021_12_15_174208_create_patient_details_tbl', 16),
(50, '2021_12_24_135923_add_deleted_at_to_coll-center_table', 16),
(51, '2021_12_24_140225_add_deleted_at_to_investigation_table', 16),
(52, '2021_12_24_140432_add_deleted_at_to_collection_agents_table', 16),
(53, '2021_12_24_140818_add_deleted_at_to_referrer_table', 16),
(54, '2021_12_24_140922_add_deleted_at_to_patient_details_table', 16),
(59, '2021_12_24_173217_create_tests_table', 17),
(60, '2022_01_11_165418_create_test_transaction_table', 17);

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
-- Table structure for table `patient_details`
--

CREATE TABLE `patient_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receipt_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `months` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`id`, `receipt_no`, `title`, `fname`, `lname`, `years`, `months`, `days`, `mobile`, `email`, `address`, `city`, `state`, `gender`, `refer`, `center`, `agent`, `investigation`, `mode`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '7236', 'Mr', 'X', 'X', '12', '1', '1', '1122334', 'aa@g.com', 'Guwahati', 'Guwahati', 'Assam', 'M', 'Mr Demo', 'Demo Center', 'Self', NULL, 'CASH', NULL, '2022-01-12 11:58:07', '2022-01-12 11:58:07', NULL),
(3, '2259', 'Mr', 'X', 'X', '12', '1', '1', '1122334', 'aa@g.com', 'Guwahati', 'Guwahati', 'Assam', 'M', 'Mr Demo', 'Demo Center', 'Self', NULL, 'CASH', NULL, '2022-01-12 11:59:19', '2022-01-12 16:44:03', '2022-01-12 16:44:03'),
(5, '6522', 'Miss', 'A', 'A', '12', '0', '0', '112234', 'demo@g.com', 'guwahati', 'Guwahati', 'guwahati', 'F', 'Self', 'Demo Center', 'Self', NULL, 'CASH', NULL, '2022-01-12 12:26:01', '2022-01-12 12:26:01', NULL);

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrer`
--

CREATE TABLE `referrer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctorname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrer`
--

INSERT INTO `referrer` (`id`, `doctorname`, `specialin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mr Demo', 'Heart', '2022-01-11 18:09:07', '2022-01-13 11:44:54', '2022-01-13 11:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_details_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `advance` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `patient_details_id`, `price`, `discount`, `total`, `advance`, `balance`, `created_at`, `updated_at`) VALUES
(2, 5, '1500.00', '0.00', '1500.00', '0.00', '1500.00', '2022-01-12 12:26:01', '2022-01-12 12:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `test_transactions`
--

CREATE TABLE `test_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `invastigation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'test name',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_transactions`
--

INSERT INTO `test_transactions` (`id`, `test_id`, `invastigation_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'BloodTest-500', '2022-01-12 12:26:01', '2022-01-12 12:26:01'),
(2, 2, 'Ultrasound-1000', '2022-01-12 12:26:01', '2022-01-12 12:26:01');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'demoUser', 'demo@g.com', NULL, '$2y$10$oafu/Zy8ymFg35IzST8Aa.MDWT4kdNI8Q9XZjOCrKoGpsRfDvei.y', NULL, '2022-01-11 18:05:58', '2022-01-11 18:05:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coll-center`
--
ALTER TABLE `coll-center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection_agents`
--
ALTER TABLE `collection_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investigation`
--
ALTER TABLE `investigation`
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
-- Indexes for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `referrer`
--
ALTER TABLE `referrer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_patient_details_id_foreign` (`patient_details_id`);

--
-- Indexes for table `test_transactions`
--
ALTER TABLE `test_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_transactions_test_id_foreign` (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coll-center`
--
ALTER TABLE `coll-center`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collection_agents`
--
ALTER TABLE `collection_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigation`
--
ALTER TABLE `investigation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `patient_details`
--
ALTER TABLE `patient_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrer`
--
ALTER TABLE `referrer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_transactions`
--
ALTER TABLE `test_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_patient_details_id_foreign` FOREIGN KEY (`patient_details_id`) REFERENCES `patient_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_transactions`
--
ALTER TABLE `test_transactions`
  ADD CONSTRAINT `test_transactions_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
