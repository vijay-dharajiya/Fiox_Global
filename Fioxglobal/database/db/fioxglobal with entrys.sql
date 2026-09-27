-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2026 at 06:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fioxglobal`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `position` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `status`, `position`, `created_at`, `updated_at`) VALUES
(2, 'Gfrp Rebar Applications', 'active', 2, '2026-09-22 01:49:57', '2026-09-23 23:56:37'),
(3, 'APPLICATION OF GFRP PRODUCT', 'active', 1, '2026-09-23 00:23:03', '2026-09-23 23:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `application_images`
--

CREATE TABLE `application_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_images`
--

INSERT INTO `application_images` (`id`, `application_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(3, 2, 'Drainage Structure', '<ol><li>GRFP (Glass Reinforced Fiber Polymer) is a lightweight, strong, and corrosion-resistant material used in drainage structures. </li><li>It offers excellent durability and resistance to moisture, chemicals, and harsh conditions. </li><li>GRFP drainage products are easy to transport, install, and maintain, making them suitable for drainage channels, covers, gratings, pipes, and inspection chambers. </li><li>Its long service life and low maintenance make it ideal for modern infrastructure projects.</li></ol>', '1790061597_0.jpeg', '2026-09-22 01:49:57', '2026-09-22 23:57:17'),
(4, 2, 'Concrete Pavements', '<ul><li>Concrete pavement is a durable and reliable road surface designed to withstand heavy traffic, weather conditions, and long-term wear. </li><li>It provides excellent load-bearing capacity, strength, and stability with low maintenance requirements. </li><li>Concrete pavements are suitable for highways, industrial areas, parking spaces, residential roads, and infrastructure projects, offering a long service life.</li></ul>', '1790062792_0.webp', '2026-09-22 02:09:52', '2026-09-22 23:57:17'),
(5, 2, 'Rcc floorings', '<ul><li>RCC flooring is a strong and durable flooring system made.</li><li>using reinforced cement concrete. It provides excellent load-bearing capacity.</li><li>stability, and resistance to wear, moisture, and environmental conditions.</li><li>RCC floors are suitable for residential, commercial, industrial, and infrastructure projects. They offer a long service life, low maintenance, and a reliable surface for areas.</li></ul>', '1790062825_0.jpeg', '2026-09-22 02:10:25', '2026-09-22 23:57:17'),
(6, 3, 'STRONG STRUCTURE', '<ul><li>Just to make sure I build the right thing — do you want to keep the drag-and-drop reordering from before.</li><li>this \"first entry first, last entry last\" is just the <em>default</em> order until an admin drags something.</li><li>you want to drop the drag feature entirely and just show products in plain database insertion order (first added always on top, no manual reordering)</li></ul>', '1790142783_0.jpg', '2026-09-23 00:23:03', '2026-09-23 00:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `brochures`
--

CREATE TABLE `brochures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brochures`
--

INSERT INTO `brochures` (`id`, `title`, `file_name`, `file_path`, `file_size`, `created_at`, `updated_at`) VALUES
(2, 'Brochure', 'Fiox Global Composites Brochure.pdf', 'brochures/1790146558_Fiox-Global-Composites-Brochure.pdf', 8455322, '2026-09-23 01:25:58', '2026-09-23 01:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1790272214),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1790272214;', 1790272214);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `company_name`, `phone`, `email`, `product_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Vijay Dharajiya', 'pharmawell', '1234567890', 'vijaydharajiya0305@gmail.com', 1, 'jay bharat sathe janavanu k amare aa product joy che.', '2026-09-20 10:24:08', '2026-09-20 10:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `ctableimages`
--

CREATE TABLE `ctableimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ctableimages`
--

INSERT INTO `ctableimages` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(12, 1, 'cmp_1790146375_0vv6Cka0.png', '2026-09-23 01:22:55', '2026-09-23 01:22:55'),
(13, 1, 'cmp_1790146416_NBH3h2Gn.png', '2026-09-23 01:23:36', '2026-09-23 01:23:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_15_050020_create_products_table', 1),
(5, '2026_09_15_050423_create_product__images_table', 1),
(6, '2026_09_16_053402_create_applications_table', 1),
(7, '2026_09_16_053422_create_application_images_table', 1),
(8, '2026_09_17_055816_create_contacts_table', 1),
(9, '2026_09_18_085356_create_brochures_table', 1),
(10, '2026_09_19_043925_create_ctableimages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `advantages` longtext DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `image`, `advantages`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 'GFRP Rebar', 'gfrp-product-1789794468', '<p><strong style=\"background-color: transparent;\">High-Performance Reinforcement for Modern Construction</strong></p><p><span style=\"background-color: transparent;\">FIOX GFRP Rebar is a lightweight, corrosion-resistant reinforcement solution designed for concrete structures exposed to moisture, chemicals and demanding environments.</span></p><p><span style=\"background-color: transparent;\">Made from high-strength glass fibres and polymer resin, GFRP rebar provides excellent tensile performance while remaining non-corrosive, non-conductive and significantly lighter than conventional steel reinforcement.</span></p><h3><strong style=\"background-color: transparent;\">Key Features</strong></h3><ul><li><span style=\"background-color: transparent;\">Corrosion &amp; rust resistant</span></li><li><span style=\"background-color: transparent;\">High tensile strength</span></li><li><span style=\"background-color: transparent;\">Lightweight &amp; easy to handle</span></li><li><span style=\"background-color: transparent;\">Electrically non-conductive</span></li><li><span style=\"background-color: transparent;\">Non-magnetic</span></li><li><span style=\"background-color: transparent;\">Low maintenance &amp; long service life</span></li></ul><p><strong style=\"background-color: transparent;\">Available in multiple diameters for different structural and infrastructure requirements.</strong></p>', '1790060854_hJ3K70T4.jpg', '<ul><li><strong style=\"background-color: transparent;\">Corrosion Resistant: </strong><span style=\"background-color: transparent;\">Will not rust or corrode, making it suitable for moisture and chemically aggressive environments.</span></li><li><strong style=\"background-color: transparent;\">Lightweight: </strong><span style=\"background-color: transparent;\">Significantly lighter than steel, helping simplify transportation, handling and installation.</span></li><li><strong style=\"background-color: transparent;\">High Tensile Strength: </strong><span style=\"background-color: transparent;\">Provides high tensile performance with an excellent strength-to-weight ratio.</span></li><li><strong style=\"background-color: transparent;\">Non-Conductive: </strong><span style=\"background-color: transparent;\">Does not conduct electricity, making it suitable for applications where electrical isolation is important.</span></li><li><strong style=\"background-color: transparent;\">Non-Magnetic: </strong><span style=\"background-color: transparent;\">Suitable for projects where magnetic interference needs to be minimized.</span></li><li><strong style=\"background-color: transparent;\">Chemical Resistant: </strong><span style=\"background-color: transparent;\">Provides resistance to many chemicals and aggressive environmental conditions.</span></li><li><strong style=\"background-color: transparent;\">Low Maintenance: </strong><span style=\"background-color: transparent;\">Eliminates the need for corrosion protection associated with conventional steel reinforcement.</span></li><li><strong style=\"background-color: transparent;\">Long Service Life: </strong><span style=\"background-color: transparent;\">Designed for durable performance in corrosion-prone and demanding applications.</span></li></ul><p><br></p>', 'active', 1, '2026-09-18 23:37:48', '2026-09-23 08:22:40'),
(3, 'Frp Grating', 'frp-grating-1790063304', '<h3> FRP gratings</h3><p>FRP gratings are lightweight, strong, and corrosion-resistant flooring solutions designed for industrial and infrastructure applications. They offer excellent resistance to moisture, chemicals, and harsh environments while requiring minimal maintenance. Easy to handle and install, FRP gratings are ideal for walkways, platforms, drainage areas, factories, water treatment plants, and other demanding environments.</p>', '1790063304_w4HjAm25.jpg', '<h3><br></h3><ul><li><strong>Corrosion Resistant</strong> – Does not rust or corrode.</li><li><strong>Lightweight</strong> – Easy to transport, handle, and install.</li><li><strong>High Strength</strong> – Provides excellent load-bearing capacity.</li><li><strong>Low Maintenance</strong> – Requires minimal maintenance over its service life.</li><li><strong>Chemical Resistant</strong> – Suitable for chemically exposed environments.</li><li><strong>Non-Conductive</strong> – Provides electrical insulation.</li><li><strong>Slip Resistant</strong> – Improves safety in wet and industrial areas.</li><li><strong>Long Service Life</strong> – Performs well in harsh environmental conditions.</li><li><strong>Easy Installation</strong> – Can be easily cut and fitted as required.</li><li><strong>Cost Effective</strong> – Reduced maintenance and replacement requirements.</li></ul><p><br></p>', 'active', 2, '2026-09-22 02:18:24', '2026-09-23 08:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 1, '1790060854_DcAtwjc6.jpg', 0, '2026-09-22 01:37:34', '2026-09-22 01:37:34'),
(7, 1, '1790060854_04SJVeKF.jpg', 0, '2026-09-22 01:37:34', '2026-09-22 01:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('46zuWHZ00QbtpogmIqWiugRGHkRtKSHnasrLRYfQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzVXVjZ1bkNnUDZTdTJ6Q2pKREd1cUFXeTRucThlTm1GU1N3c2hWeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJpbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1790312008),
('8pIc3O0vX5HsFngvPndlnFyCFlEBWci3avE0ULOR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFByTXkwYm1YSkV4NGNvV3U5Z2VqUHpQbUJFdTFKMEg2YkpHNXQycCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo1OiJpbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImNvbnRhY3RfY2FwdGNoYSI7czo1OiJZU3FKNSI7fQ==', 1790272287);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `usertype`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vijay Dharajiya', 'admin', 'vijay123@gmail.com', NULL, '$2y$12$HqVtlp.hc9YH2i0/qIdU6eUnlGdpvDdi1uwcbgYK9xPYDjVQDghvS', NULL, '2026-09-18 23:18:35', '2026-09-18 23:18:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_images`
--
ALTER TABLE `application_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_images_application_id_foreign` (`application_id`);

--
-- Indexes for table `brochures`
--
ALTER TABLE `brochures`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_product_id_foreign` (`product_id`);

--
-- Indexes for table `ctableimages`
--
ALTER TABLE `ctableimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ctableimages_product_id_foreign` (`product_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `application_images`
--
ALTER TABLE `application_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `brochures`
--
ALTER TABLE `brochures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctableimages`
--
ALTER TABLE `ctableimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_images`
--
ALTER TABLE `application_images`
  ADD CONSTRAINT `application_images_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ctableimages`
--
ALTER TABLE `ctableimages`
  ADD CONSTRAINT `ctableimages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
