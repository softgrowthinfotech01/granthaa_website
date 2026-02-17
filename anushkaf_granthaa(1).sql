-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2026 at 11:33 AM
-- Server version: 10.11.15-MariaDB-cll-lve
-- PHP Version: 8.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anushkaf_granthaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `email` varchar(11) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Adarsh More', 'moreyadarsh', '0902 234 7211'),
(3, '1', '1@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Adarsh Morey', 'moreyadarsh0@gmail.com', '0902 234 7211'),
(5, '1', '1@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_master`
--

CREATE TABLE `location_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_location` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_master`
--

INSERT INTO `location_master` (`id`, `site_location`, `created_at`, `updated_at`) VALUES
(1, 'nagpur', '2026-02-07 05:20:38', '2026-02-07 14:05:10'),
(2, 'Chandrapur - MH34', '2026-02-07 14:09:51', '2026-02-07 14:09:51'),
(3, 'Et distinctio Sit', '2026-02-09 07:20:56', '2026-02-09 07:20:56'),
(4, 'nagpur', '2026-02-14 02:59:55', '2026-02-14 02:59:55'),
(5, 'mumbai', '2026-02-14 03:13:49', '2026-02-14 03:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_07_083814_create_personal_access_tokens_table', 2),
(5, '2026_02_07_090854_add_role_createdby_to_users', 3),
(6, '2026_02_07_102356_add_profile_fields_to_users_table', 4),
(7, '2026_02_07_104554_create_location_master_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'api-token', 'c9069beb35579f83e552b2ff7d5b9f23f0ace2cbb7e33764819fad22b988c61e', '[\"*\"]', '2026-02-07 05:20:38', NULL, '2026-02-07 04:47:11', '2026-02-07 05:20:38'),
(3, 'App\\Models\\User', 1, 'api-token', '88753c086edd4f1e416328b437228de000ffa8863382910fdc860c42e84c2bd2', '[\"*\"]', NULL, NULL, '2026-02-07 05:39:11', '2026-02-07 05:39:11'),
(4, 'App\\Models\\User', 1, 'api-token', 'da2990d4471ed1042cf7d33dc37838d6dfc056423101077abaadf19773734f4d', '[\"*\"]', NULL, NULL, '2026-02-07 13:09:13', '2026-02-07 13:09:13'),
(5, 'App\\Models\\User', 3, 'api-token', '1002976c65655eeb59179acbf03229eb719ce2752630cbb04a0f26f184966de5', '[\"*\"]', NULL, NULL, '2026-02-07 13:16:48', '2026-02-07 13:16:48'),
(6, 'App\\Models\\User', 1, 'api-token', '5656867c41d58b9eb11f5da5807d3d90dd3886c53a9db400c399eca13645bf7f', '[\"*\"]', NULL, NULL, '2026-02-07 13:33:03', '2026-02-07 13:33:03'),
(7, 'App\\Models\\User', 1, 'api-token', '89c9ced3791381e19ed63c22e26aac1e6dcb76d6f9dd8d5a1b839ec8d895591b', '[\"*\"]', NULL, NULL, '2026-02-07 13:42:59', '2026-02-07 13:42:59'),
(8, 'App\\Models\\User', 1, 'api-token', '0618060ec4d67727122eae612b3d3299bb04aac9297f08daf3841317c2f7cc6b', '[\"*\"]', '2026-02-07 14:09:51', NULL, '2026-02-07 13:44:28', '2026-02-07 14:09:51'),
(9, 'App\\Models\\User', 1, 'api-token', 'ed68e37609778c9db5e9f9a33957d19c7c0fd2917c3435fca741598be22b2010', '[\"*\"]', NULL, NULL, '2026-02-09 07:15:09', '2026-02-09 07:15:09'),
(10, 'App\\Models\\User', 1, 'api-token', '8ae40da487cb2fccbeb7a71a78164bb95689ffc8a9e2ca0619426d455ec3980c', '[\"*\"]', '2026-02-09 07:20:55', NULL, '2026-02-09 07:19:25', '2026-02-09 07:20:55'),
(11, 'App\\Models\\User', 3, 'api-token', '5f1c746c99a49bd9dc57c1fc938d28389916a9e0cd57d88b1cdbe29f677aafb8', '[\"*\"]', NULL, NULL, '2026-02-09 07:22:53', '2026-02-09 07:22:53'),
(12, 'App\\Models\\User', 1, 'api-token', '9670eeea109f7272f2cd9c7e7cde30bf9ae31441a1e843dcc041c7ef5a3865bb', '[\"*\"]', '2026-02-14 02:59:55', NULL, '2026-02-14 02:59:37', '2026-02-14 02:59:55'),
(13, 'App\\Models\\User', 3, 'api-token', '40242d1595d69d67c5b5ef5221d7ed767024af92f6865260a8ceaa3ed156dde0', '[\"*\"]', NULL, NULL, '2026-02-14 03:01:42', '2026-02-14 03:01:42'),
(14, 'App\\Models\\User', 1, 'api-token', '9a06c57f857d3bf1e9061b259955b232358e36ee9089c9d4c756524d4b7ec091', '[\"*\"]', '2026-02-14 03:13:49', NULL, '2026-02-14 03:09:05', '2026-02-14 03:13:49'),
(15, 'App\\Models\\User', 1, 'api-token', 'e18c4d22ae80c65b69d9c9003f1f570e79e770496ca5243794242ea05efa3cca', '[\"*\"]', NULL, NULL, '2026-02-16 00:13:30', '2026-02-16 00:13:30'),
(16, 'App\\Models\\User', 1, 'api-token', 'ae5610bad8851f78479fd3bf5e870629e061096bab583fb0b65695b73ed92e0c', '[\"*\"]', NULL, NULL, '2026-02-16 00:19:54', '2026-02-16 00:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_location` varchar(100) NOT NULL,
  `project_status` varchar(100) NOT NULL,
  `project_image1` varchar(100) NOT NULL,
  `project_image2` varchar(255) DEFAULT NULL,
  `project_image3` varchar(255) DEFAULT NULL,
  `project_details1` varchar(1000) NOT NULL,
  `project_details2` varchar(1000) NOT NULL,
  `project_details3` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `project_location`, `project_status`, `project_image1`, `project_image2`, `project_image3`, `project_details1`, `project_details2`, `project_details3`) VALUES
(17, 'INFINITY PARK', '', 'Current', '1770974098_1_infinity park.jpeg', '1770974098_2_infinity park layout.jpeg', '', 'Infinity Park – Grantha\r\nInfinity Park is a beautifully designed green space that enhances the overall lifestyle experience within the project.\r\n\r\nFeaturing landscaped gardens, walking paths, and open seating areas, the park encourages healthy outdoor activities and social interaction.\r\n\r\nSurrounded by landscaped greenery, walking trails, and leisure seating, the park promotes active lifestyles while creating a welcoming social environment.', 'Infinity Park – Your Gateway to Peaceful Living\r\nInfinity Park is a thoughtfully planned residential plotting project located in Chandrapur, offering a perfect blend of nature and modern infrastructure. Designed for comfortable living and smart investment, the project provides well-developed plots with essential amenities including internal roads, drainage, electricity, and water facilities.\r\n\r\nWith quality development, clear access routes, and future growth potential, Infinity Park is an ideal destination to build your dream home or grow your property investment.', ''),
(18, 'SHOBHAA RESIDENCY', '', 'Current', '1770975345_1_Shobha residency plan.jpeg', '', '', 'Elevated Living at Shobhaa Residency\r\nShobhaa Residency is a premium residential plot development created for those who value location, quality planning, and smart investment opportunities. Strategically located with excellent road access, the project offers NA-approved plots with bank finance availability and easy EMI options. Surrounded by open green spaces and supported by modern infrastructure, Shobhaa Residency promises peaceful living with strong appreciation potential—making it the perfect choice for building your dream home or securing a high-growth property investment.', '', ''),
(19, 'D.S.K', '', 'Current', '1770975493_1_facilities.png', '1770975493_2_specialities img.png', '1770975493_3_layout 1.jpeg', 'Well-Planned Facilities for Better Living\r\nD.S.K. RadhaKrishna Nagari offers thoughtfully planned amenities designed to give you comfort, convenience, and long-term value. The project features well-developed WPM internal roads, proper drainage systems, bright street lighting, and open green spaces that create a peaceful living environment.\r\n\r\nResidents enjoy landscaped open areas for relaxation, safe internal roads for smooth connectivity, and modern infrastructure that supports everyday needs. Every plot is carefully developed to ensure easy access, cleanliness, and future-ready living — making it an ideal choice for families and smart investors alike.', 'Premium Plots with Trusted Development\r\nD.S.K. RadhaKrishna Nagari brings you premium residential plots at an affordable price in a rapidly developing location. With NATP-sanctioned plots and clear legal documentation, this project offers complete peace of mind for buyers.\r\n\r\nEnjoy flexible payment options with up to 12 months easy installments, making ownership simpler than ever. Located near the city’s upcoming growth zone, the project provides excellent investment potential along with plots suitable for immediate home construction.', 'Well-Planned Facilities for Better Living\r\nD.S.K. RadhaKrishna Nagari offers thoughtfully planned amenities designed to give you comfort, convenience, and long-term value. The project features well-developed WPM internal roads, proper drainage systems, bright street lighting, and open green spaces that create a peaceful living environment.\r\n\r\nResidents enjoy landscaped open areas for relaxation, safe internal roads for smooth connectivity, and modern infrastructure that supports everyday needs. Every plot is carefully developed to ensure easy access, cleanliness, and future-ready living — making it an ideal choice for families and smart investors alike.');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EVO2zynpQproAWNAbg0ejNEKobrumgwa88RCnjF3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjhzZFlRS2dVRG5Hb1RieW5oRmk1TmRhdDFjZDQ4Q1RBMTJKWG40VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1770457037);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'customer',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `created_by`, `first_name`, `last_name`, `age`, `gender`, `profile_image`, `contact_no`, `city`, `state`, `address`, `pin_code`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$LM.ZSvfyr9xr.tBPq1JEYeqGA0UdSYqb3ECWwMbD8vZ7fB9GXDU9.', NULL, '2026-02-07 04:25:03', '2026-02-07 04:25:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Leader One', 'leader1@example.com', NULL, '$2y$12$71C.05UVZ9TmR56LQfZWte4vDGAbLbMjLzhJSTl23H3gpioq0PlpC', NULL, '2026-02-07 04:48:30', '2026-02-07 04:48:30', 'leader', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Aniket Parkhi', 'anni@gmail.com', NULL, '$2y$12$gDOKTUnlLN6ujAJ4PVJYSOlUuWAl..03GSFuGYhOq6fUo.KFueWeq', NULL, '2026-02-07 05:04:26', '2026-02-07 05:04:26', 'leader', 1, 'Aniket', 'Parkhi', 21, 'male', 'leaders/O4zCUJVPpnooNPgBGLbUCDBpMyTB1ysqwjlnqHUP.jpg', '8551882092', 'cpur', 'MH', 'cpur', '442402'),
(4, 'admin@2026', '', NULL, 'Admin@26', NULL, NULL, NULL, 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_master`
--
ALTER TABLE `location_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_master`
--
ALTER TABLE `location_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
