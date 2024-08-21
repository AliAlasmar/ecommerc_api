-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21 أغسطس 2024 الساعة 13:48
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce-api`
--

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_20_173259_create_products_table', 2),
(6, '2024_08_20_173345_create_orders_table', 2),
(7, '2024_08_20_173752_create_order_products_table', 2),
(8, '2024_08_20_182141_create_tokens_table', 3),
(9, '2024_08_21_063100_add_user_id_to_order_products_table', 4),
(10, '2024_08_21_064115_add_order_id_to_order_products_table', 5),
(11, '2024_08_21_064236_add_product_id_to_order_products_table', 6),
(12, '2024_08_21_064337_add_quantity_to_order_products_table', 6),
(13, '2024_08_21_064919_add_order_id_to_order_products_table', 7);

-- --------------------------------------------------------

--
-- بنية الجدول `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 16, '2024-08-21 04:17:18', '2024-08-21 04:17:18'),
(8, 16, '2024-08-21 04:18:47', '2024-08-21 04:18:47'),
(9, 16, '2024-08-21 04:20:08', '2024-08-21 04:20:08'),
(10, 16, '2024-08-21 04:20:26', '2024-08-21 04:20:26'),
(11, 16, '2024-08-21 04:22:11', '2024-08-21 04:22:11'),
(12, 16, '2024-08-21 04:22:22', '2024-08-21 04:22:22'),
(13, 16, '2024-08-21 04:22:55', '2024-08-21 04:22:55'),
(14, 16, '2024-08-21 04:24:56', '2024-08-21 04:24:56'),
(15, 15, '2024-08-21 07:39:55', '2024-08-21 07:39:55');

-- --------------------------------------------------------

--
-- بنية الجدول `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `order_products`
--

INSERT INTO `order_products` (`id`, `created_at`, `updated_at`, `product_id`, `user_id`, `quantity`, `order_id`) VALUES
(29, '2024-08-21 04:15:08', '2024-08-21 04:15:08', NULL, 16, NULL, NULL),
(30, '2024-08-21 04:15:08', '2024-08-21 04:15:08', 1, 16, 1, 29),
(31, '2024-08-21 04:15:08', '2024-08-21 04:15:08', 2, 16, 1, 29),
(32, '2024-08-21 04:17:18', '2024-08-21 04:17:18', 1, 16, 1, 7),
(33, '2024-08-21 04:17:18', '2024-08-21 04:17:18', 2, 16, 1, 7),
(34, '2024-08-21 04:18:47', '2024-08-21 04:18:47', 1, 16, 1, 8),
(35, '2024-08-21 04:18:47', '2024-08-21 04:18:47', 2, 16, 1, 8),
(36, '2024-08-21 04:20:26', '2024-08-21 04:20:26', 3, 16, 1, 10),
(37, '2024-08-21 04:20:26', '2024-08-21 04:20:26', 4, 16, 1, 10),
(38, '2024-08-21 04:22:22', '2024-08-21 04:22:22', 1, 16, 1, 12),
(39, '2024-08-21 04:22:22', '2024-08-21 04:22:22', 2, 16, 1, 12),
(40, '2024-08-21 04:22:55', '2024-08-21 04:22:55', 1, 16, 1, 13),
(41, '2024-08-21 04:22:55', '2024-08-21 04:22:55', 2, 16, 1, 13),
(42, '2024-08-21 04:24:56', '2024-08-21 04:24:56', 1, 16, 1, 14),
(43, '2024-08-21 04:24:56', '2024-08-21 04:24:56', 2, 16, 1, 14),
(44, '2024-08-21 07:39:55', '2024-08-21 07:39:55', 1, 15, 2, 15);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Product1', 'Product Description', '99.99', 48, '2024-08-20 14:50:56', '2024-08-21 07:39:55'),
(2, 'product2', 'test description', '20.00', 7, '2024-08-20 16:05:02', '2024-08-21 04:24:56'),
(3, 'product3', 'test description', '20.00', 0, '2024-08-21 00:14:04', '2024-08-21 04:20:26'),
(4, 'product3', 'test description', '20.00', 0, '2024-08-21 00:21:59', '2024-08-21 04:20:26');

-- --------------------------------------------------------

--
-- بنية الجدول `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(11, 16, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzI0MjI1MTk1LCJleHAiOjE3MjQyMjg3OTUsIm5iZiI6MTcyNDIyNTE5NSwianRpIjoiQ3gwOGhQWVU4cllzZGNjdCIsInN1YiI6IjE2IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.lpIzXYyKnMQwXEtMQYtzxcA1s2cizvgat5DQ24IxgIY', '2024-08-21 04:26:35', '2024-08-21 04:26:35'),
(16, 17, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzI0MjM2OTMzLCJleHAiOjE3MjQyNDA1MzMsIm5iZiI6MTcyNDIzNjkzMywianRpIjoiVVFOVUJlZlNVTmFCOVZHdCIsInN1YiI6IjE3IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.DWXQdYPkL79Z-AqgpnR2iDdR4HcAjKOK6WYSN7eddY0', '2024-08-21 07:42:13', '2024-08-21 07:42:13'),
(17, 15, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzI0MjM4ODIxLCJleHAiOjE3MjQyNDI0MjEsIm5iZiI6MTcyNDIzODgyMSwianRpIjoiYndaVU5FT0RJM0JmMTJ6NCIsInN1YiI6IjE1IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.zo0nhQ0Jf83VvlKUlOWhHyWylMUBDHj5jPsF8gPIzG8', '2024-08-21 08:13:41', '2024-08-21 08:13:41'),
(20, 18, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzI0MjM5MTEzLCJleHAiOjE3MjQyNDI3MTMsIm5iZiI6MTcyNDIzOTExMywianRpIjoiVTk3V0VRT1ExQkNQcXRBSyIsInN1YiI6IjE4IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.7LNE9tdV_PJFpvZM7SDwwnPU39wZP3d-3CB51X-P3P0', '2024-08-21 08:18:33', '2024-08-21 08:18:33');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'ali', 'adin@admin.com', NULL, '$2y$12$iqDl3kXGpxBSVHjWynnld.AWmvtCV6GjgBylBhnOafD4s.SSYdSCq', NULL, NULL, NULL, '2024-08-20 11:43:53', '2024-08-20 11:43:53'),
(8, 'ali3', 'admin2@admin.com', NULL, '$2y$12$7fF2JowsrnpSdaNDvE7afuoighKo/WR72o0ezXY7tbjqmP9vjIvJi', NULL, NULL, NULL, '2024-08-20 11:48:05', '2024-08-20 11:48:05'),
(9, 'ali1', 'admin22@admin.com', NULL, '$2y$12$/iIFaRb9FtUF07x9aTIPnukew3CmNeFYe06a5vo8SoF4yEAYWiafy', NULL, NULL, NULL, '2024-08-20 12:03:57', '2024-08-20 12:03:57'),
(10, 'ali11', 'admin212@admin.com', NULL, '$2y$12$co1nVcsyI4T9bM7gWSPDH.pGoX1XSCNEXMt8lp.StNp9mERR2tWVO', NULL, NULL, NULL, '2024-08-20 12:04:20', '2024-08-20 12:04:20'),
(15, 'ali alasmar', 'ali@admin.com', NULL, '$2y$12$PkTBtyzw6jgBz2xfPufQ0.a7J4rGGx7ZAMEGRrGzsikh6KM0XzF7S', NULL, NULL, NULL, '2024-08-20 15:38:47', '2024-08-20 15:38:47'),
(16, 'ali alasmar', 'ali@gnail.com', NULL, '$2y$12$8LrPM2FeNPSXk1hQV0.sGehQM6AHHH6B6xMIDS9OHC/7XQD6XswdK', NULL, NULL, NULL, '2024-08-21 00:12:12', '2024-08-21 00:12:12'),
(18, 'John Doe', 'john.doe@example.com', NULL, '$2y$12$18n6y81r3gKSgFMG8xod2eKO1pkFRygOKO4YuyVJWyGRmmnNRNll.', NULL, NULL, NULL, '2024-08-21 08:16:23', '2024-08-21 08:16:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
