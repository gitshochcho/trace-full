-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2026 at 10:21 AM
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
-- Database: `trace_full`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `mobile_verified_at`, `otp`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '01740303508', 1, '2024-12-31 20:16:04', '2024-12-31 20:16:04', '522189', '$2y$12$iMnM1aMcTHHaKFdCjjXJGuPQeBBYEq1NKAAOm7a8F1D4OZCru6gZ2', NULL, NULL, '2025-01-09 16:22:57');

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
('content_block_about-trace', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:49;s:4:\"slug\";s:11:\"about_trace\";s:7:\"section\";s:11:\"ABOUT TRACE\";s:7:\"heading\";s:54:\"A firm built on insight, strategy, and lasting impact.\";s:11:\"sub_heading\";N;s:11:\"description\";s:61:\"<p>A firm built on insight, strategy, and lasting impact.</p>\";s:11:\"design_word\";s:18:\"insight, strategy,\";s:4:\"type\";s:13:\"About Section\";s:10:\"created_at\";s:19:\"2026-04-26 12:53:44\";s:10:\"updated_at\";s:19:\"2026-04-26 12:53:44\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:49;s:4:\"slug\";s:11:\"about_trace\";s:7:\"section\";s:11:\"ABOUT TRACE\";s:7:\"heading\";s:54:\"A firm built on insight, strategy, and lasting impact.\";s:11:\"sub_heading\";N;s:11:\"description\";s:61:\"<p>A firm built on insight, strategy, and lasting impact.</p>\";s:11:\"design_word\";s:18:\"insight, strategy,\";s:4:\"type\";s:13:\"About Section\";s:10:\"created_at\";s:19:\"2026-04-26 12:53:44\";s:10:\"updated_at\";s:19:\"2026-04-26 12:53:44\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:1:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:161;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:49;s:4:\"uuid\";s:36:\"00dc707c-88c9-429e-be25-b6056eeffd3b\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:70:\"Export Performance Management_ A Framework for South Asian Governments\";s:9:\"file_name\";s:74:\"Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:113282;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-26 12:54:31\";s:10:\"updated_at\";s:19:\"2026-04-26 12:54:31\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:161;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:49;s:4:\"uuid\";s:36:\"00dc707c-88c9-429e-be25-b6056eeffd3b\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:70:\"Export Performance Management_ A Framework for South Asian Governments\";s:9:\"file_name\";s:74:\"Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:113282;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-26 12:54:31\";s:10:\"updated_at\";s:19:\"2026-04-26 12:54:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-end-to-end-integrated-solutions', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:39;s:4:\"slug\";s:40:\"about_us_end_to_end_integrated_solutions\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:31:\"End-to-End Integrated Solutions\";s:11:\"sub_heading\";N;s:11:\"description\";s:169:\"<p>TRACE provides fully integrated support from strategic design through implementation and evaluation, ensuring every solution works as a connected, coherent whole.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:18:06\";s:10:\"updated_at\";s:19:\"2026-04-23 07:18:06\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:39;s:4:\"slug\";s:40:\"about_us_end_to_end_integrated_solutions\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:31:\"End-to-End Integrated Solutions\";s:11:\"sub_heading\";N;s:11:\"description\";s:169:\"<p>TRACE provides fully integrated support from strategic design through implementation and evaluation, ensuring every solution works as a connected, coherent whole.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:18:06\";s:10:\"updated_at\";s:19:\"2026-04-23 07:18:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272648),
('content_block_about-us-header', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:40;s:4:\"slug\";s:15:\"about_us_header\";s:7:\"section\";s:8:\"ABOUT US\";s:7:\"heading\";s:47:\"Empowering Change through Insightful Consulting\";s:11:\"sub_heading\";N;s:11:\"description\";s:147:\"<p>We deliver evidence-based policy recommendations and advocacy that help governments design actionable, impactful reforms from the ground up.</p>\";s:11:\"design_word\";s:10:\"Insightful\";s:4:\"type\";s:12:\"Hero Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:40;s:4:\"slug\";s:15:\"about_us_header\";s:7:\"section\";s:8:\"ABOUT US\";s:7:\"heading\";s:47:\"Empowering Change through Insightful Consulting\";s:11:\"sub_heading\";N;s:11:\"description\";s:147:\"<p>We deliver evidence-based policy recommendations and advocacy that help governments design actionable, impactful reforms from the ground up.</p>\";s:11:\"design_word\";s:10:\"Insightful\";s:4:\"type\";s:12:\"Hero Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:2:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:122;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:40;s:4:\"uuid\";s:36:\"5e3f681f-cd8c-4d92-b3e0-11b641dafaac\";s:15:\"collection_name\";s:4:\"icon\";s:4:\"name\";s:17:\"Trade and Customs\";s:9:\"file_name\";s:21:\"Trade-and-Customs.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:148908;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:122;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:40;s:4:\"uuid\";s:36:\"5e3f681f-cd8c-4d92-b3e0-11b641dafaac\";s:15:\"collection_name\";s:4:\"icon\";s:4:\"name\";s:17:\"Trade and Customs\";s:9:\"file_name\";s:21:\"Trade-and-Customs.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:148908;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}i:1;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:123;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:40;s:4:\"uuid\";s:36:\"a0fd73e2-295a-4148-ad2e-5298a2932e86\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:17:\"Trade and Customs\";s:9:\"file_name\";s:21:\"Trade-and-Customs.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:148908;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:2;s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:123;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:40;s:4:\"uuid\";s:36:\"a0fd73e2-295a-4148-ad2e-5298a2932e86\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:17:\"Trade and Customs\";s:9:\"file_name\";s:21:\"Trade-and-Customs.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:148908;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:2;s:10:\"created_at\";s:19:\"2026-04-23 07:26:05\";s:10:\"updated_at\";s:19:\"2026-04-23 07:26:05\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-how-we-work', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:41;s:4:\"slug\";s:20:\"about_us_how_we_work\";s:7:\"section\";s:13:\"OUR FRAMEWORK\";s:7:\"heading\";s:11:\"How We Work\";s:11:\"sub_heading\";N;s:11:\"description\";s:142:\"<p>Our proven three-stage framework turns complex trade and policy challenges into measurable, lasting outcomes for every client we serve.</p>\";s:11:\"design_word\";s:4:\"Work\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:27:59\";s:10:\"updated_at\";s:19:\"2026-04-26 15:58:31\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:41;s:4:\"slug\";s:20:\"about_us_how_we_work\";s:7:\"section\";s:13:\"OUR FRAMEWORK\";s:7:\"heading\";s:11:\"How We Work\";s:11:\"sub_heading\";N;s:11:\"description\";s:142:\"<p>Our proven three-stage framework turns complex trade and policy challenges into measurable, lasting outcomes for every client we serve.</p>\";s:11:\"design_word\";s:4:\"Work\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:27:59\";s:10:\"updated_at\";s:19:\"2026-04-26 15:58:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-impact', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:32;s:4:\"slug\";s:15:\"about_us_impact\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:6:\"Impact\";s:11:\"sub_heading\";N;s:11:\"description\";s:184:\"<p>We deliver measurable and lasting results by reducing barriers, enhancing competitiveness, driving reforms, and embedding the tools clients need to sustain change independently.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:34:29\";s:10:\"updated_at\";s:19:\"2026-04-23 07:12:38\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:32;s:4:\"slug\";s:15:\"about_us_impact\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:6:\"Impact\";s:11:\"sub_heading\";N;s:11:\"description\";s:184:\"<p>We deliver measurable and lasting results by reducing barriers, enhancing competitiveness, driving reforms, and embedding the tools clients need to sustain change independently.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:34:29\";s:10:\"updated_at\";s:19:\"2026-04-23 07:12:38\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-industry-wide-network', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:36;s:4:\"slug\";s:30:\"about_us_industry_wide_network\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:21:\"Industry-wide Network\";s:11:\"sub_heading\";N;s:11:\"description\";s:201:\"<p>With proven networks across government agencies and private sector stakeholders, TRACE consistently bridges policy leadership and business realities, enabling reforms prioritising client\'s need.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:30\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:30\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:36;s:4:\"slug\";s:30:\"about_us_industry_wide_network\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:21:\"Industry-wide Network\";s:11:\"sub_heading\";N;s:11:\"description\";s:201:\"<p>With proven networks across government agencies and private sector stakeholders, TRACE consistently bridges policy leadership and business realities, enabling reforms prioritising client\'s need.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:30\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:30\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-insight', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:33;s:4:\"slug\";s:16:\"about_us_insight\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:7:\"Insight\";s:11:\"sub_heading\";N;s:11:\"description\";s:201:\"<p>We turn complex trade and policy issues into clear insights — using<br>research, data, and deep expertise to transform challenges and risks<br>into well-defined opportunities ready for action.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:38:35\";s:10:\"updated_at\";s:19:\"2026-04-22 12:43:36\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:33;s:4:\"slug\";s:16:\"about_us_insight\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:7:\"Insight\";s:11:\"sub_heading\";N;s:11:\"description\";s:201:\"<p>We turn complex trade and policy issues into clear insights — using<br>research, data, and deep expertise to transform challenges and risks<br>into well-defined opportunities ready for action.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:38:35\";s:10:\"updated_at\";s:19:\"2026-04-22 12:43:36\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:1:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:66;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:33;s:4:\"uuid\";s:36:\"d5bce7ba-b4e7-473d-9547-05369d97543e\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:7:\"Insight\";s:9:\"file_name\";s:11:\"Insight.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:184634;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-22 12:39:46\";s:10:\"updated_at\";s:19:\"2026-04-22 12:39:46\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:66;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:33;s:4:\"uuid\";s:36:\"d5bce7ba-b4e7-473d-9547-05369d97543e\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:7:\"Insight\";s:9:\"file_name\";s:11:\"Insight.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:184634;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-22 12:39:46\";s:10:\"updated_at\";s:19:\"2026-04-22 12:39:46\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-our-mission', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:50;s:4:\"slug\";s:20:\"about_us_our_mission\";s:7:\"section\";s:16:\"ABOUT US DETAILS\";s:7:\"heading\";s:11:\"Our Mission\";s:11:\"sub_heading\";N;s:11:\"description\";s:270:\"<p>Our Mission<br>To deliver smart, sustainable, and inclusive solutions that drive economic growth, strengthen institutions, and improve lives. We aim to bridge the gap between policy and practice by combining rigorous research with hands-on implementation support.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:11:\"Detail Item\";s:10:\"created_at\";s:19:\"2026-04-26 12:55:19\";s:10:\"updated_at\";s:19:\"2026-04-26 12:55:50\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:50;s:4:\"slug\";s:20:\"about_us_our_mission\";s:7:\"section\";s:16:\"ABOUT US DETAILS\";s:7:\"heading\";s:11:\"Our Mission\";s:11:\"sub_heading\";N;s:11:\"description\";s:270:\"<p>Our Mission<br>To deliver smart, sustainable, and inclusive solutions that drive economic growth, strengthen institutions, and improve lives. We aim to bridge the gap between policy and practice by combining rigorous research with hands-on implementation support.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:11:\"Detail Item\";s:10:\"created_at\";s:19:\"2026-04-26 12:55:19\";s:10:\"updated_at\";s:19:\"2026-04-26 12:55:50\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-section-3', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:31;s:4:\"slug\";s:18:\"about_us_section_3\";s:7:\"section\";s:14:\"OUR COMMITMENT\";s:7:\"heading\";s:14:\"OUR COMMITMENT\";s:11:\"sub_heading\";s:19:\"We are committed to\";s:11:\"description\";s:240:\"<ul><li>Integrity and transparency in every engagement</li><li>Delivering measurable outcomes, not just recommendations</li><li>Building local capacity and ownership</li><li>Promoting innovation and sustainability in every project</li></ul>\";s:11:\"design_word\";s:84:\"At Trace Consulting, we do not just advise, we collaborate to create lasting change.\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-22 12:33:01\";s:10:\"updated_at\";s:19:\"2026-04-22 12:33:01\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:31;s:4:\"slug\";s:18:\"about_us_section_3\";s:7:\"section\";s:14:\"OUR COMMITMENT\";s:7:\"heading\";s:14:\"OUR COMMITMENT\";s:11:\"sub_heading\";s:19:\"We are committed to\";s:11:\"description\";s:240:\"<ul><li>Integrity and transparency in every engagement</li><li>Delivering measurable outcomes, not just recommendations</li><li>Building local capacity and ownership</li><li>Promoting innovation and sustainability in every project</li></ul>\";s:11:\"design_word\";s:84:\"At Trace Consulting, we do not just advise, we collaborate to create lasting change.\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-22 12:33:01\";s:10:\"updated_at\";s:19:\"2026-04-22 12:33:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:1:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:65;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:31;s:4:\"uuid\";s:36:\"3d2d6abb-e170-451b-af53-e72964af0bcd\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:14:\"Background (3)\";s:9:\"file_name\";s:18:\"Background-(3).png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:485887;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-22 12:33:01\";s:10:\"updated_at\";s:19:\"2026-04-22 12:33:01\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:65;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:31;s:4:\"uuid\";s:36:\"3d2d6abb-e170-451b-af53-e72964af0bcd\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:14:\"Background (3)\";s:9:\"file_name\";s:18:\"Background-(3).png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:485887;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-22 12:33:01\";s:10:\"updated_at\";s:19:\"2026-04-22 12:33:01\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-strategy', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:34;s:4:\"slug\";s:17:\"about_us_strategy\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:8:\"Strategy\";s:11:\"sub_heading\";N;s:11:\"description\";s:189:\"<p>We formulate insights into strategies, devising evidence and technology-driven solutions that meet global standards, align with institutional realities, and drive sustainable growth.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:13:42\";s:10:\"updated_at\";s:19:\"2026-04-23 07:13:42\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:34;s:4:\"slug\";s:17:\"about_us_strategy\";s:7:\"section\";s:20:\"ABOUT FRAMEWORK ITEM\";s:7:\"heading\";s:8:\"Strategy\";s:11:\"sub_heading\";N;s:11:\"description\";s:189:\"<p>We formulate insights into strategies, devising evidence and technology-driven solutions that meet global standards, align with institutional realities, and drive sustainable growth.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:14:\"Framework Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:13:42\";s:10:\"updated_at\";s:19:\"2026-04-23 07:13:42\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-sustainable-approach', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:37;s:4:\"slug\";s:29:\"about_us_sustainable_approach\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:20:\"Sustainable Approach\";s:11:\"sub_heading\";N;s:11:\"description\";s:181:\"<p>TRACE works with partners to build sustainable solutions, embedding facilitation tools into legislation, training mechanisms, and digital systems that outlast the engagement.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:48\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:48\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:37;s:4:\"slug\";s:29:\"about_us_sustainable_approach\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:20:\"Sustainable Approach\";s:11:\"sub_heading\";N;s:11:\"description\";s:181:\"<p>TRACE works with partners to build sustainable solutions, embedding facilitation tools into legislation, training mechanisms, and digital systems that outlast the engagement.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:48\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_about-us-tailored-innovation', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:38;s:4:\"slug\";s:28:\"about_us_tailored_innovation\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:19:\"Tailored Innovation\";s:11:\"sub_heading\";N;s:11:\"description\";s:188:\"<p>From tech-driven trade systems, lab-accreditation roadmaps, or temperature-controlled logistics, TRACE designs solutions customised to sectoral realities and institutional capacity.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:59\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:59\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:38;s:4:\"slug\";s:28:\"about_us_tailored_innovation\";s:7:\"section\";s:25:\"ABOUT UNIQUE FEATURE ITEM\";s:7:\"heading\";s:19:\"Tailored Innovation\";s:11:\"sub_heading\";N;s:11:\"description\";s:188:\"<p>From tech-driven trade systems, lab-accreditation roadmaps, or temperature-controlled logistics, TRACE designs solutions customised to sectoral realities and institutional capacity.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:12:\"Feature Item\";s:10:\"created_at\";s:19:\"2026-04-23 07:17:59\";s:10:\"updated_at\";s:19:\"2026-04-23 07:17:59\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272648),
('content_block_about-us-we-make-trace-different', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:35;s:4:\"slug\";s:32:\"about_us_we_make_trace_different\";s:7:\"section\";s:19:\"OUR UNIQUE FEATURES\";s:7:\"heading\";s:27:\"What Makes TRACE Differents\";s:11:\"sub_heading\";N;s:11:\"description\";s:164:\"<p>TRACE delivers connected, sustainable, and tailored solutions from policy to practice that streamline processes, strengthen institutions, and empower growth.</p>\";s:11:\"design_word\";s:10:\"Differents\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:14:44\";s:10:\"updated_at\";s:19:\"2026-04-23 07:16:53\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:35;s:4:\"slug\";s:32:\"about_us_we_make_trace_different\";s:7:\"section\";s:19:\"OUR UNIQUE FEATURES\";s:7:\"heading\";s:27:\"What Makes TRACE Differents\";s:11:\"sub_heading\";N;s:11:\"description\";s:164:\"<p>TRACE delivers connected, sustainable, and tailored solutions from policy to practice that streamline processes, strengthen institutions, and empower growth.</p>\";s:11:\"design_word\";s:10:\"Differents\";s:4:\"type\";s:7:\"Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:14:44\";s:10:\"updated_at\";s:19:\"2026-04-23 07:16:53\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('content_block_about-us-who-we-are', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:30;s:4:\"slug\";s:19:\"about_us_who_we_are\";s:7:\"section\";s:16:\"ABOUT US DETAILS\";s:7:\"heading\";s:10:\"Who We Are\";s:11:\"sub_heading\";N;s:11:\"description\";s:227:\"<p>Who We Are&nbsp;<br>We work at the intersection of research, innovation, and implementation—empowering institutions with data-driven insights, technology solutions, and technical expertise to achieve measurable impact.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:11:\"Detail Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:32:33\";s:10:\"updated_at\";s:19:\"2026-04-22 12:32:33\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:30;s:4:\"slug\";s:19:\"about_us_who_we_are\";s:7:\"section\";s:16:\"ABOUT US DETAILS\";s:7:\"heading\";s:10:\"Who We Are\";s:11:\"sub_heading\";N;s:11:\"description\";s:227:\"<p>Who We Are&nbsp;<br>We work at the intersection of research, innovation, and implementation—empowering institutions with data-driven insights, technology solutions, and technical expertise to achieve measurable impact.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:11:\"Detail Item\";s:10:\"created_at\";s:19:\"2026-04-22 12:32:33\";s:10:\"updated_at\";s:19:\"2026-04-22 12:32:33\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272647),
('content_block_contact-page', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:48;s:4:\"slug\";s:12:\"contact-page\";s:7:\"section\";s:9:\"Reach Out\";s:7:\"heading\";s:27:\"Let\'s start a conversation.\";s:11:\"sub_heading\";s:9:\"Reach Out\";s:11:\"description\";s:196:\"<p>Whether you\'re a government agency, development partner, or<br>private company — TRACE is ready to listen, advise, and<br>collaborate. Reach out and we\'ll respond within one business day.</p>\";s:11:\"design_word\";s:13:\"conversation.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-26 11:47:27\";s:10:\"updated_at\";s:19:\"2026-04-27 12:23:11\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:48;s:4:\"slug\";s:12:\"contact-page\";s:7:\"section\";s:9:\"Reach Out\";s:7:\"heading\";s:27:\"Let\'s start a conversation.\";s:11:\"sub_heading\";s:9:\"Reach Out\";s:11:\"description\";s:196:\"<p>Whether you\'re a government agency, development partner, or<br>private company — TRACE is ready to listen, advise, and<br>collaborate. Reach out and we\'ll respond within one business day.</p>\";s:11:\"design_word\";s:13:\"conversation.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-26 11:47:27\";s:10:\"updated_at\";s:19:\"2026-04-27 12:23:11\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777275220),
('content_block_home-about-trace', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:42;s:4:\"slug\";s:16:\"home_about_trace\";s:7:\"section\";s:16:\"HOME ABOUT TRACE\";s:7:\"heading\";s:42:\"Transforming Challenges into Opportunities\";s:11:\"sub_heading\";N;s:11:\"description\";s:172:\"<p>TRACE focuses on international trade, policy reform, and development, working with governments, business groups, and the private sector to strengthen market systems.</p>\";s:11:\"design_word\";s:13:\"Opportunities\";s:4:\"type\";s:13:\"About Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:59:00\";s:10:\"updated_at\";s:19:\"2026-04-26 12:46:09\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:42;s:4:\"slug\";s:16:\"home_about_trace\";s:7:\"section\";s:16:\"HOME ABOUT TRACE\";s:7:\"heading\";s:42:\"Transforming Challenges into Opportunities\";s:11:\"sub_heading\";N;s:11:\"description\";s:172:\"<p>TRACE focuses on international trade, policy reform, and development, working with governments, business groups, and the private sector to strengthen market systems.</p>\";s:11:\"design_word\";s:13:\"Opportunities\";s:4:\"type\";s:13:\"About Section\";s:10:\"created_at\";s:19:\"2026-04-23 07:59:00\";s:10:\"updated_at\";s:19:\"2026-04-26 12:46:09\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:1:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:154;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:42;s:4:\"uuid\";s:36:\"c99cf097-cbe3-454d-9878-899b13c64c33\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:2:\"bg\";s:9:\"file_name\";s:6:\"bg.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:451850;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-26 10:17:08\";s:10:\"updated_at\";s:19:\"2026-04-26 10:17:08\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:154;s:10:\"model_type\";s:18:\"App\\Models\\Content\";s:8:\"model_id\";i:42;s:4:\"uuid\";s:36:\"c99cf097-cbe3-454d-9878-899b13c64c33\";s:15:\"collection_name\";s:5:\"image\";s:4:\"name\";s:2:\"bg\";s:9:\"file_name\";s:6:\"bg.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:451850;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-26 10:17:08\";s:10:\"updated_at\";s:19:\"2026-04-26 10:17:08\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272553),
('content_block_home-about-trace-one', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:43;s:4:\"slug\";s:20:\"home_about_trace_one\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:37:\"Multi-Sector Expertise & Global Reach\";s:11:\"sub_heading\";N;s:11:\"description\";s:106:\"<p>Deep knowledge across industries, backed by an objective perspective and access to global networks.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:01:48\";s:10:\"updated_at\";s:19:\"2026-04-23 08:01:48\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:43;s:4:\"slug\";s:20:\"home_about_trace_one\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:37:\"Multi-Sector Expertise & Global Reach\";s:11:\"sub_heading\";N;s:11:\"description\";s:106:\"<p>Deep knowledge across industries, backed by an objective perspective and access to global networks.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:01:48\";s:10:\"updated_at\";s:19:\"2026-04-23 08:01:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272553),
('content_block_home-about-trace-three', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:45;s:4:\"slug\";s:22:\"home_about_trace_three\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:39:\"Change Management & Creative Innovation\";s:11:\"sub_heading\";N;s:11:\"description\";s:88:\"<p>Combining structured change management with innovative, context-driven solutions.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:02:02\";s:10:\"updated_at\";s:19:\"2026-04-23 08:02:02\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:45;s:4:\"slug\";s:22:\"home_about_trace_three\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:39:\"Change Management & Creative Innovation\";s:11:\"sub_heading\";N;s:11:\"description\";s:88:\"<p>Combining structured change management with innovative, context-driven solutions.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:02:02\";s:10:\"updated_at\";s:19:\"2026-04-23 08:02:02\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272553),
('content_block_home-about-trace-two', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:44;s:4:\"slug\";s:20:\"home_about_trace_two\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:40:\"Proven Methodologies, Policy to Practice\";s:11:\"sub_heading\";N;s:11:\"description\";s:88:\"<p>Rigorous, scalable approaches that translate evidence into implementable reforms.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:01:56\";s:10:\"updated_at\";s:19:\"2026-04-23 08:01:56\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:44;s:4:\"slug\";s:20:\"home_about_trace_two\";s:7:\"section\";s:15:\"HOME ABOUT ITEM\";s:7:\"heading\";s:40:\"Proven Methodologies, Policy to Practice\";s:11:\"sub_heading\";N;s:11:\"description\";s:88:\"<p>Rigorous, scalable approaches that translate evidence into implementable reforms.</p>\";s:11:\"design_word\";N;s:4:\"type\";s:9:\"List Item\";s:10:\"created_at\";s:19:\"2026-04-23 08:01:56\";s:10:\"updated_at\";s:19:\"2026-04-23 08:01:56\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777272553),
('content_block_projects-page', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:13;s:4:\"slug\";s:13:\"projects-page\";s:7:\"section\";s:12:\"OUR PROJECTS\";s:7:\"heading\";s:9:\"Work that\";s:11:\"sub_heading\";N;s:11:\"description\";s:206:\"<p>TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.</p>\";s:11:\"design_word\";s:16:\"changes systems.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-21 14:37:36\";s:10:\"updated_at\";s:19:\"2026-04-26 11:11:48\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:13;s:4:\"slug\";s:13:\"projects-page\";s:7:\"section\";s:12:\"OUR PROJECTS\";s:7:\"heading\";s:9:\"Work that\";s:11:\"sub_heading\";N;s:11:\"description\";s:206:\"<p>TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.</p>\";s:11:\"design_word\";s:16:\"changes systems.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-21 14:37:36\";s:10:\"updated_at\";s:19:\"2026-04-26 11:11:48\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777273749),
('content_block_team-page', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:14;s:4:\"slug\";s:9:\"team page\";s:7:\"section\";s:26:\"The People Behind the Work\";s:7:\"heading\";s:11:\"Experts who\";s:11:\"sub_heading\";s:187:\"TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.\";s:11:\"description\";s:194:\"<p>TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.</p>\";s:11:\"design_word\";s:13:\"drive change.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-21 14:49:18\";s:10:\"updated_at\";s:19:\"2026-04-27 10:52:04\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:14;s:4:\"slug\";s:9:\"team page\";s:7:\"section\";s:26:\"The People Behind the Work\";s:7:\"heading\";s:11:\"Experts who\";s:11:\"sub_heading\";s:187:\"TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.\";s:11:\"description\";s:194:\"<p>TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.</p>\";s:11:\"design_word\";s:13:\"drive change.\";s:4:\"type\";s:4:\"Hero\";s:10:\"created_at\";s:19:\"2026-04-21 14:49:18\";s:10:\"updated_at\";s:19:\"2026-04-27 10:52:04\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777277681),
('content_block_work-with-us', 'O:18:\"App\\Models\\Content\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"contents\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:52;s:4:\"slug\";s:12:\"work-with-us\";s:7:\"section\";s:12:\"WORK WITH US\";s:7:\"heading\";s:57:\"Have a project in mind? Let\'s build something that lasts.\";s:11:\"sub_heading\";s:12:\"Get in Touch\";s:11:\"description\";s:150:\"<p>Whether reforming a regulatory system, building technical<br>capacity, or modernising digital infrastructure — we\'d like to<br>hear from you.</p>\";s:11:\"design_word\";s:10:\"that lasts\";s:4:\"type\";s:3:\"CTA\";s:10:\"created_at\";s:19:\"2026-04-27 10:35:57\";s:10:\"updated_at\";s:19:\"2026-04-27 11:33:08\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:52;s:4:\"slug\";s:12:\"work-with-us\";s:7:\"section\";s:12:\"WORK WITH US\";s:7:\"heading\";s:57:\"Have a project in mind? Let\'s build something that lasts.\";s:11:\"sub_heading\";s:12:\"Get in Touch\";s:11:\"description\";s:150:\"<p>Whether reforming a regulatory system, building technical<br>capacity, or modernising digital infrastructure — we\'d like to<br>hear from you.</p>\";s:11:\"design_word\";s:10:\"that lasts\";s:4:\"type\";s:3:\"CTA\";s:10:\"created_at\";s:19:\"2026-04-27 10:35:57\";s:10:\"updated_at\";s:19:\"2026-04-27 11:33:08\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:4:\"slug\";i:1;s:7:\"section\";i:2;s:7:\"heading\";i:3;s:11:\"sub_heading\";i:4;s:11:\"description\";i:5;s:11:\"design_word\";i:6;s:4:\"type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777280148),
('site_settings', 'O:18:\"App\\Models\\Setting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:10:{s:2:\"id\";i:1;s:9:\"logo_text\";s:5:\"TRACE\";s:12:\"logo_tagline\";s:25:\"Insight. Strategy. Impact\";s:12:\"social_links\";s:279:\"[{\"title\":\"Facebook\",\"link\":\"https:\\/\\/www.facebook.com\\/TRACEConsultingbd\\/\",\"media_key\":\"216edf82-1a70-4acf-aa7d-41d890d4b5e8\"},{\"title\":\"Twitter\",\"link\":\"https:\\/\\/www.linkedin.com\\/company\\/trace-consulting-limited-firm\\/\",\"media_key\":\"85ac2c92-0fdd-4bfc-843a-6104b894689b\"}]\";s:21:\"footer_contact_mobile\";s:16:\"+880 1715-056952\";s:20:\"footer_contact_email\";s:30:\"contact@traceconsultingltd.com\";s:23:\"footer_contact_location\";s:59:\"Level 2, Plot 285, Road 19/C, New DOHS, Dhaka , Bangladesh.\";s:18:\"footer_description\";s:164:\"Trace Consulting Limited provides strategic\r\nadvisory, technical assistance, and digital\r\nsolutions to governments and development\r\norganisations across South Asia.\";s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-27 11:46:43\";}s:11:\"\0*\0original\";a:10:{s:2:\"id\";i:1;s:9:\"logo_text\";s:5:\"TRACE\";s:12:\"logo_tagline\";s:25:\"Insight. Strategy. Impact\";s:12:\"social_links\";s:279:\"[{\"title\":\"Facebook\",\"link\":\"https:\\/\\/www.facebook.com\\/TRACEConsultingbd\\/\",\"media_key\":\"216edf82-1a70-4acf-aa7d-41d890d4b5e8\"},{\"title\":\"Twitter\",\"link\":\"https:\\/\\/www.linkedin.com\\/company\\/trace-consulting-limited-firm\\/\",\"media_key\":\"85ac2c92-0fdd-4bfc-843a-6104b894689b\"}]\";s:21:\"footer_contact_mobile\";s:16:\"+880 1715-056952\";s:20:\"footer_contact_email\";s:30:\"contact@traceconsultingltd.com\";s:23:\"footer_contact_location\";s:59:\"Level 2, Plot 285, Road 19/C, New DOHS, Dhaka , Bangladesh.\";s:18:\"footer_description\";s:164:\"Trace Consulting Limited provides strategic\r\nadvisory, technical assistance, and digital\r\nsolutions to governments and development\r\norganisations across South Asia.\";s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-27 11:46:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:12:\"social_links\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"media\";O:71:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Collections\\MediaCollection\":4:{s:8:\"\0*\0items\";a:3:{i:0;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:1;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"2aa56fc3-3526-4aca-b91a-b19213d8fc2e\";s:15:\"collection_name\";s:48:\"social_icon_216edf82-1a70-4acf-aa7d-41d890d4b5e8\";s:4:\"name\";s:19:\"facebook-app-symbol\";s:9:\"file_name\";s:23:\"facebook-app-symbol.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:346;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:1;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"2aa56fc3-3526-4aca-b91a-b19213d8fc2e\";s:15:\"collection_name\";s:48:\"social_icon_216edf82-1a70-4acf-aa7d-41d890d4b5e8\";s:4:\"name\";s:19:\"facebook-app-symbol\";s:9:\"file_name\";s:23:\"facebook-app-symbol.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:346;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:1;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}i:1;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:2;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"626c6b68-cca1-4209-ac5d-1e3549531ae3\";s:15:\"collection_name\";s:48:\"social_icon_85ac2c92-0fdd-4bfc-843a-6104b894689b\";s:4:\"name\";s:7:\"twitter\";s:9:\"file_name\";s:11:\"twitter.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:439;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:2;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:2;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"626c6b68-cca1-4209-ac5d-1e3549531ae3\";s:15:\"collection_name\";s:48:\"social_icon_85ac2c92-0fdd-4bfc-843a-6104b894689b\";s:4:\"name\";s:7:\"twitter\";s:9:\"file_name\";s:11:\"twitter.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:439;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:2;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}i:2;O:49:\"Spatie\\MediaLibrary\\MediaCollections\\Models\\Media\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"media\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:5;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"bb5ce96b-3d47-41fb-97d0-76b277294c10\";s:15:\"collection_name\";s:10:\"logo_image\";s:4:\"name\";s:8:\"image 12\";s:9:\"file_name\";s:12:\"image-12.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:4249;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:5;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:5;s:10:\"model_type\";s:18:\"App\\Models\\Setting\";s:8:\"model_id\";i:1;s:4:\"uuid\";s:36:\"bb5ce96b-3d47-41fb-97d0-76b277294c10\";s:15:\"collection_name\";s:10:\"logo_image\";s:4:\"name\";s:8:\"image 12\";s:9:\"file_name\";s:12:\"image-12.png\";s:9:\"mime_type\";s:9:\"image/png\";s:4:\"disk\";s:6:\"public\";s:16:\"conversions_disk\";s:6:\"public\";s:4:\"size\";i:4249;s:13:\"manipulations\";s:2:\"[]\";s:17:\"custom_properties\";s:2:\"[]\";s:21:\"generated_conversions\";s:2:\"[]\";s:17:\"responsive_images\";s:2:\"[]\";s:12:\"order_column\";i:5;s:10:\"created_at\";s:19:\"2026-04-21 09:22:47\";s:10:\"updated_at\";s:19:\"2026-04-21 09:22:47\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:13:\"manipulations\";s:5:\"array\";s:17:\"custom_properties\";s:5:\"array\";s:21:\"generated_conversions\";s:5:\"array\";s:17:\"responsive_images\";s:5:\"array\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:2:{i:0;s:12:\"original_url\";i:1;s:11:\"preview_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:18:\"\0*\0streamChunkSize\";i:1048576;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:14:\"collectionName\";N;s:13:\"formFieldName\";N;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:7:{i:0;s:9:\"logo_text\";i:1;s:12:\"logo_tagline\";i:2;s:12:\"social_links\";i:3;s:21:\"footer_contact_mobile\";i:4;s:20:\"footer_contact_email\";i:5;s:23:\"footer_contact_location\";i:6;s:18:\"footer_description\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1777280148);

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
-- Table structure for table `contact_infos`
--

CREATE TABLE `contact_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('phone','email','address') NOT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `primary_text` varchar(255) NOT NULL,
  `secondary_text` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `map_location` varchar(255) DEFAULT NULL,
  `office_hours` varchar(255) DEFAULT NULL,
  `link_value` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_infos`
--

INSERT INTO `contact_infos` (`id`, `type`, `icon_class`, `title`, `primary_text`, `secondary_text`, `name`, `address`, `map_location`, `office_hours`, `link_value`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'phone', NULL, 'Head Office-Dhaka', '+880 1715-056952', NULL, NULL, NULL, NULL, NULL, 'tel:880 1715-056952', 1, 1, '2026-04-21 22:56:45', '2026-04-22 00:20:04'),
(2, 'address', NULL, 'Head Office', 'Trace Consulting Limited', NULL, 'Trace Consulting Limited', 'House 12, Road 4, Block B\r\nBashundhara R/A, Dhaka 1229\r\nBangladesh', 'View on Google Maps →', 'Sunday – Thursday, 9:00 AM – 6:00 PM BST', NULL, 1, 1, '2026-04-21 22:58:11', '2026-04-22 00:42:23'),
(3, 'phone', NULL, 'Mobile — MD & CEO', '+880 1961 435 277', NULL, NULL, NULL, NULL, NULL, 'tel:880 1961 435 277', 2, 1, '2026-04-22 00:18:17', '2026-04-22 00:20:18'),
(4, 'email', NULL, 'General Enquiries', 'contact@traceconsultingltd.com', NULL, NULL, NULL, NULL, NULL, 'contact@traceconsultingltd.com', 1, 1, '2026-04-22 00:19:41', '2026-04-22 00:19:41'),
(5, 'email', NULL, 'Job Applications & HR', 'hr@traceconsultingltd.com', NULL, NULL, NULL, NULL, NULL, 'hr@traceconsultingltd.com', 2, 1, '2026-04-22 00:21:26', '2026-04-22 00:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `mobile_number`, `organization`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Md Rakib Hasan', 'Purno', 'rakibpurno96@gmail.com', '01624327910', 'Orbd', 'Trade Facilitation', 'sdfghjk', '2026-04-21 22:59:12', '2026-04-21 22:59:12'),
(2, 'Md Rakib Hasan', 'Purno', 'rakibpurno96@gmail.com', '01624327910', 'adsds', 'sadasdasda', 'asdasdas', '2026-04-21 23:07:30', '2026-04-21 23:07:30'),
(3, 'Nahid', 'Hassan', 'nahid@gmail.com', '01765532849', 'Orangebd', 'Support', 'test', '2026-04-23 04:01:22', '2026-04-23 04:01:22'),
(4, 'Md Rakib Hasan', 'Purno', 'rakibpurno96@gmail.com', '01624327910', 'Orbd', 'Trade Facilitation', 'etwrtet', '2026-04-24 18:17:02', '2026-04-24 18:17:02'),
(5, 'Fuad M Khalid', 'Hossen', 'fuad@gmail.com', '016243279525', 'trace', 'Digital Solutions', 'sfsget', '2026-04-26 05:50:08', '2026-04-26 05:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sub_heading` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `design_word` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `slug`, `section`, `heading`, `sub_heading`, `description`, `design_word`, `type`, `created_at`, `updated_at`) VALUES
(2, 'service 1', NULL, 'Strengthening Cross-Border Trade & Customs Systems', NULL, '<p>Supporting governments and trade bodies to<br>modernise, simplify, and automate cross-<br>border trade procedures in line with WTO<br>Trade Facilitation Agreement commitments.</p>', NULL, NULL, '2026-04-21 03:58:41', '2026-04-26 05:04:44'),
(3, 'service 2', NULL, 'Evidence-Based Policy Reform & Advocacy', 'Policy Advocacy', '<p>Delivering evidence-based policy advocacy<br>and recommendations to help governments<br>design actionable, impactful reforms that<br>translate complex realities into clear policy<br>direction.</p>', NULL, NULL, '2026-04-21 04:03:05', '2026-04-23 01:50:40'),
(4, 'service 3', NULL, 'In-Depth Trade, Economic & Development Research', 'Research & Assessments', '<p>Conducting rigorous research, assessments,<br>and evaluations on trade, economics, and<br>development issues to drive informed<br>decision-making for governments and<br>development agencies.</p>', NULL, NULL, '2026-04-21 04:05:13', '2026-04-23 01:51:34'),
(6, 'service 4', NULL, 'Need-Based Training for Public & Private Sector', 'Capacity Building', '<p>Building the capacity of public and private<br>sector stakeholders through targeted, need-<br>based training on trade, markets, IT systems,<br>and laboratory practices.</p>', NULL, NULL, '2026-04-21 04:10:50', '2026-04-23 01:52:25'),
(7, 'service 5', NULL, 'End-to-End Project Design, Management & Implementation', 'Project Management', '<p>Designing, managing, and implementing<br>tailor-made projects that address trade,<br>economic, and market access challenges —<br>delivering measurable results across the full<br>lifecycle.</p>', NULL, NULL, '2026-04-21 04:12:06', '2026-04-23 01:52:57'),
(8, 'service 6', NULL, 'Technology-Driven Trade Systems & Digital Platforms', 'Technology Solutions', '<p>Designing and deploying technology-driven<br>trade systems — LIMS, certification<br>platforms, single windows, and custom<br>digital tools — that make trade procedures<br>faster and cost-effective.</p>', NULL, NULL, '2026-04-21 04:12:52', '2026-04-23 01:53:31'),
(9, 'service 7', NULL, 'Lab Accreditation, QMS & Testing Capacity Development', 'Laboratory Services', '<p>Supporting public and private laboratories to<br>establish quality management systems,<br>obtain ISO/IEC 17025 accreditation, and<br>enhance testing capacity to meet<br>international standards.</p>', NULL, NULL, '2026-04-21 04:13:45', '2026-04-23 01:54:08'),
(10, 'service 8', NULL, 'Online Portals, Databases & Transparency Platforms', 'Trade Information Systems', '<p>Enhancing transparency in export–import by<br>developing online portals, trade information<br>databases, notification systems, and digital<br>platforms for accurate, timely, and reliable<br>data.</p>', NULL, NULL, '2026-04-21 04:14:39', '2026-04-23 01:55:29'),
(11, 'service 9', NULL, 'Temperature-Controlled Logistics & Supply Chain Systems', 'Cold Chain & Logistics', '<p>Designing and strengthening cold chain and<br>logistics systems to help agricultural,<br>pharmaceutical, and perishable goods<br>sectors meet quality and compliance<br>standards.</p>', NULL, NULL, '2026-04-21 04:16:11', '2026-04-23 01:56:46'),
(12, 'service details', NULL, 'Trade Facilitation', 'TRACE supports governments, trade bodies, and private stakeholders to modernize, simplify, and automate cross-border trade procedures in line with global best practices and WTO TFA commitments.', '<p>TRACE supports governments, trade bodies, and private stakeholders to modernize,<br>simplify, and automate cross-border trade procedures in line with global best practices<br>and WTO Trade Facilitation Agreement (TFA) commitments. Our approach integrates<br>policy reform, digital transformation, and institutional strengthening.&nbsp;</p><p>By combining strategic policy insight with cutting-edge technical innovation, TRACE<br>bridges the gap between reform design and implementation, turning commitments into<br>real-world improvements at ports, borders, and trade agencies.</p>', NULL, NULL, '2026-04-21 04:21:45', '2026-04-21 04:21:45'),
(13, 'projects-page', 'OUR PROJECTS', 'Work that', NULL, '<p>TRACE has delivered trade facilitation reform, laboratory accreditation, digital systems, and policy advisory projects across South Asia — for governments, development banks, and regulatory bodies.</p>', 'changes systems.', 'Hero', '2026-04-21 08:37:36', '2026-04-26 05:11:48'),
(14, 'team page', 'The People Behind the Work', 'Experts who', 'TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.', '<p>TRACE brings together a permanent core team of trade specialists, researchers, and technologists — supported by a network of domain experts engaged on specific projects and engagements.</p>', 'drive change.', 'Hero', '2026-04-21 08:49:18', '2026-04-27 04:52:04'),
(15, 'Leadership', 'Team Leadership', 'Managing', 'Leading TRACE\'s vision of practical, high-impact consulting for governments and development partners.', NULL, 'Director', NULL, '2026-04-21 08:51:38', '2026-04-21 08:51:38'),
(30, 'about_us_who_we_are', 'ABOUT US DETAILS', 'Who We Are', NULL, '<p>Who We Are&nbsp;<br>We work at the intersection of research, innovation, and implementation—empowering institutions with data-driven insights, technology solutions, and technical expertise to achieve measurable impact.</p>', NULL, 'Detail Item', '2026-04-22 06:32:33', '2026-04-22 06:32:33'),
(31, 'about_us_section_3', 'OUR COMMITMENT', 'OUR COMMITMENT', 'We are committed to', '<ul><li>Integrity and transparency in every engagement</li><li>Delivering measurable outcomes, not just recommendations</li><li>Building local capacity and ownership</li><li>Promoting innovation and sustainability in every project</li></ul>', 'At Trace Consulting, we do not just advise, we collaborate to create lasting change.', 'Section', '2026-04-22 06:33:01', '2026-04-22 06:33:01'),
(32, 'about_us_impact', 'ABOUT FRAMEWORK ITEM', 'Impact', NULL, '<p>We deliver measurable and lasting results by reducing barriers, enhancing competitiveness, driving reforms, and embedding the tools clients need to sustain change independently.</p>', NULL, 'Framework Item', '2026-04-22 06:34:29', '2026-04-23 01:12:38'),
(33, 'about_us_insight', 'ABOUT FRAMEWORK ITEM', 'Insight', NULL, '<p>We turn complex trade and policy issues into clear insights — using<br>research, data, and deep expertise to transform challenges and risks<br>into well-defined opportunities ready for action.</p>', NULL, 'Framework Item', '2026-04-22 06:38:35', '2026-04-22 06:43:36'),
(34, 'about_us_strategy', 'ABOUT FRAMEWORK ITEM', 'Strategy', NULL, '<p>We formulate insights into strategies, devising evidence and technology-driven solutions that meet global standards, align with institutional realities, and drive sustainable growth.</p>', NULL, 'Framework Item', '2026-04-23 01:13:42', '2026-04-23 01:13:42'),
(35, 'about_us_we_make_trace_different', 'OUR UNIQUE FEATURES', 'What Makes TRACE Differents', NULL, '<p>TRACE delivers connected, sustainable, and tailored solutions from policy to practice that streamline processes, strengthen institutions, and empower growth.</p>', 'Differents', 'Section', '2026-04-23 01:14:44', '2026-04-23 01:16:53'),
(36, 'about_us_industry_wide_network', 'ABOUT UNIQUE FEATURE ITEM', 'Industry-wide Network', NULL, '<p>With proven networks across government agencies and private sector stakeholders, TRACE consistently bridges policy leadership and business realities, enabling reforms prioritising client\'s need.</p>', NULL, 'Feature Item', '2026-04-23 01:17:30', '2026-04-23 01:17:30'),
(37, 'about_us_sustainable_approach', 'ABOUT UNIQUE FEATURE ITEM', 'Sustainable Approach', NULL, '<p>TRACE works with partners to build sustainable solutions, embedding facilitation tools into legislation, training mechanisms, and digital systems that outlast the engagement.</p>', NULL, 'Feature Item', '2026-04-23 01:17:48', '2026-04-23 01:17:48'),
(38, 'about_us_tailored_innovation', 'ABOUT UNIQUE FEATURE ITEM', 'Tailored Innovation', NULL, '<p>From tech-driven trade systems, lab-accreditation roadmaps, or temperature-controlled logistics, TRACE designs solutions customised to sectoral realities and institutional capacity.</p>', NULL, 'Feature Item', '2026-04-23 01:17:59', '2026-04-23 01:17:59'),
(39, 'about_us_end_to_end_integrated_solutions', 'ABOUT UNIQUE FEATURE ITEM', 'End-to-End Integrated Solutions', NULL, '<p>TRACE provides fully integrated support from strategic design through implementation and evaluation, ensuring every solution works as a connected, coherent whole.</p>', NULL, 'Feature Item', '2026-04-23 01:18:06', '2026-04-23 01:18:06'),
(40, 'about_us_header', 'ABOUT US', 'Empowering Change through Insightful Consulting', NULL, '<p>We deliver evidence-based policy recommendations and advocacy that help governments design actionable, impactful reforms from the ground up.</p>', 'Insightful', 'Hero Section', '2026-04-23 01:26:05', '2026-04-23 01:26:05'),
(41, 'about_us_how_we_work', 'OUR FRAMEWORK', 'How We Work', NULL, '<p>Our proven three-stage framework turns complex trade and policy challenges into measurable, lasting outcomes for every client we serve.</p>', 'Work', 'Section', '2026-04-23 01:27:59', '2026-04-26 09:58:31'),
(42, 'home_about_trace', 'HOME ABOUT TRACE', 'Transforming Challenges into Opportunities', NULL, '<p>TRACE focuses on international trade, policy reform, and development, working with governments, business groups, and the private sector to strengthen market systems.</p>', 'Opportunities', 'About Section', '2026-04-23 01:59:00', '2026-04-26 06:46:09'),
(43, 'home_about_trace_one', 'HOME ABOUT ITEM', 'Multi-Sector Expertise & Global Reach', NULL, '<p>Deep knowledge across industries, backed by an objective perspective and access to global networks.</p>', NULL, 'List Item', '2026-04-23 02:01:48', '2026-04-23 02:01:48'),
(44, 'home_about_trace_two', 'HOME ABOUT ITEM', 'Proven Methodologies, Policy to Practice', NULL, '<p>Rigorous, scalable approaches that translate evidence into implementable reforms.</p>', NULL, 'List Item', '2026-04-23 02:01:56', '2026-04-23 02:01:56'),
(45, 'home_about_trace_three', 'HOME ABOUT ITEM', 'Change Management & Creative Innovation', NULL, '<p>Combining structured change management with innovative, context-driven solutions.</p>', NULL, 'List Item', '2026-04-23 02:02:02', '2026-04-23 02:02:02'),
(47, 'Service Hero', 'Hero', 'Our Services', 'What We Do', '<p>TRACE provides consultancy, research, and advocacy services that help government agencies and businesses reform policies, advance trade facilitation, expand market access, and strengthen laboratory<br>and cold chain systems.</p>', 'Services', NULL, '2026-04-26 04:45:48', '2026-04-26 04:45:48'),
(48, 'contact-page', 'Reach Out', 'Let\'s start a conversation.', 'Reach Out', '<p>Whether you\'re a government agency, development partner, or<br>private company — TRACE is ready to listen, advise, and<br>collaborate. Reach out and we\'ll respond within one business day.</p>', 'conversation.', 'Hero', '2026-04-26 05:47:27', '2026-04-27 06:23:11'),
(49, 'about_trace', 'ABOUT TRACE', 'A firm built on insight, strategy, and lasting impact.', NULL, '<p>A firm built on insight, strategy, and lasting impact.</p>', 'insight, strategy,', 'About Section', '2026-04-26 06:53:44', '2026-04-26 06:53:44'),
(50, 'about_us_our_mission', 'ABOUT US DETAILS', 'Our Mission', NULL, '<p>Our Mission<br>To deliver smart, sustainable, and inclusive solutions that drive economic growth, strengthen institutions, and improve lives. We aim to bridge the gap between policy and practice by combining rigorous research with hands-on implementation support.</p>', NULL, 'Detail Item', '2026-04-26 06:55:19', '2026-04-26 06:55:50'),
(52, 'work-with-us', 'WORK WITH US', 'Have a project in mind? Let\'s build something that lasts.', 'Get in Touch', '<p>Whether reforming a regulatory system, building technical<br>capacity, or modernising digital infrastructure — we\'d like to<br>hear from you.</p>', 'that lasts', 'CTA', '2026-04-27 04:35:57', '2026-04-27 05:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iso` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `nicename` varchar(191) DEFAULT NULL,
  `iso3` varchar(191) DEFAULT NULL,
  `numcode` varchar(191) DEFAULT NULL,
  `phonecode` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', '4', '93'),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', '8', '355'),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', '12', '213'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', '16', '1684'),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', '20', '376'),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', '24', '244'),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', '660', '1264'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, '0'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', '28', '1268'),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', '32', '54'),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', '51', '374'),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', '533', '297'),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', '36', '61'),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', '40', '43'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', '31', '994'),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', '44', '1242'),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', '48', '973'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', '50', '880'),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', '52', '1246'),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', '112', '375'),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', '56', '32'),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', '84', '501'),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', '204', '229'),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', '60', '1441'),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', '64', '975'),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', '68', '591'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', '70', '387'),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', '72', '267'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, '0'),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', '76', '55'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, '246'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', '96', '673'),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', '100', '359'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', '854', '226'),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', '108', '257'),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', '116', '855'),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', '120', '237'),
(38, 'CA', 'CANADA', 'Canada', 'CAN', '124', '1'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', '132', '238'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', '136', '1345'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', '140', '236'),
(42, 'TD', 'CHAD', 'Chad', 'TCD', '148', '235'),
(43, 'CL', 'CHILE', 'Chile', 'CHL', '152', '56'),
(44, 'CN', 'CHINA', 'China', 'CHN', '156', '86'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, '61'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, '672'),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', '170', '57'),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', '174', '269'),
(49, 'CG', 'CONGO', 'Congo', 'COG', '178', '242'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', '180', '242'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', '184', '682'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', '188', '506'),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', '384', '225'),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', '191', '385'),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', '192', '53'),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', '196', '357'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', '203', '420'),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', '208', '45'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', '262', '253'),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', '212', '1767'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', '214', '1809'),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', '218', '593'),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', '818', '20'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', '222', '503'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', '226', '240'),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', '232', '291'),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', '233', '372'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', '231', '251'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', '238', '500'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', '234', '298'),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', '242', '679'),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', '246', '358'),
(73, 'FR', 'FRANCE', 'France', 'FRA', '250', '33'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', '254', '594'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', '258', '689'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, '0'),
(77, 'GA', 'GABON', 'Gabon', 'GAB', '266', '241'),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', '270', '220'),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', '268', '995'),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', '276', '49'),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', '288', '233'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', '292', '350'),
(83, 'GR', 'GREECE', 'Greece', 'GRC', '300', '30'),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', '304', '299'),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', '308', '1473'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', '312', '590'),
(87, 'GU', 'GUAM', 'Guam', 'GUM', '316', '1671'),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', '320', '502'),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', '324', '224'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', '624', '245'),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', '328', '592'),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', '332', '509'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, '0'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', '336', '39'),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', '340', '504'),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', '344', '852'),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', '348', '36'),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', '352', '354'),
(99, 'IN', 'INDIA', 'India', 'IND', '356', '91'),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', '360', '62'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', '364', '98'),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', '368', '964'),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', '372', '353'),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', '376', '972'),
(105, 'IT', 'ITALY', 'Italy', 'ITA', '380', '39'),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', '388', '1876'),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', '392', '81'),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', '400', '962'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', '398', '7'),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', '404', '254'),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', '296', '686'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', '408', '850'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', '410', '82'),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', '414', '965'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', '417', '996'),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', '418', '856'),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', '428', '371'),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', '422', '961'),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', '426', '266'),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', '430', '231'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', '434', '218'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', '438', '423'),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', '440', '370'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', '442', '352'),
(125, 'MO', 'MACAO', 'Macao', 'MAC', '446', '853'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', '389'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', '450', '261'),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', '454', '265'),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', '458', '60'),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', '462', '960'),
(131, 'ML', 'MALI', 'Mali', 'MLI', '466', '223'),
(132, 'MT', 'MALTA', 'Malta', 'MLT', '470', '356'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', '584', '692'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', '474', '596'),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', '478', '222'),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', '480', '230'),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, '269'),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', '484', '52'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', '583', '691'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', '498', '373'),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', '492', '377'),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', '496', '976'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', '500', '1664'),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', '504', '212'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', '508', '258'),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', '104', '95'),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', '516', '264'),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', '520', '674'),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', '524', '977'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', '528', '31'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', '530', '599'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', '540', '687'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', '554', '64'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', '558', '505'),
(155, 'NE', 'NIGER', 'Niger', 'NER', '562', '227'),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', '566', '234'),
(157, 'NU', 'NIUE', 'Niue', 'NIU', '570', '683'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', '574', '672'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', '580', '1670'),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', '578', '47'),
(161, 'OM', 'OMAN', 'Oman', 'OMN', '512', '968'),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', '586', '92'),
(163, 'PW', 'PALAU', 'Palau', 'PLW', '585', '680'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, '970'),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', '591', '507'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', '598', '675'),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', '600', '595'),
(168, 'PE', 'PERU', 'Peru', 'PER', '604', '51'),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', '608', '63'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', '612', '0'),
(171, 'PL', 'POLAND', 'Poland', 'POL', '616', '48'),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', '620', '351'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', '630', '1787'),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', '634', '974'),
(175, 'RE', 'REUNION', 'Reunion', 'REU', '638', '262'),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', '642', '40'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', '643', '70'),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', '646', '250'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', '654', '290'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', '659', '1869'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', '662', '1758'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', '666', '508'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', '670', '1784'),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', '882', '684'),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', '674', '378'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', '678', '239'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', '682', '966'),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', '686', '221'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, '381'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', '690', '248'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', '694', '232'),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', '702', '65'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', '703', '421'),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', '705', '386'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', '90', '677'),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', '706', '252'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', '710', '27'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, '0'),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', '724', '34'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', '144', '94'),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', '736', '249'),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', '740', '597'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', '744', '47'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', '748', '268'),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', '752', '46'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', '756', '41'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', '760', '963'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', '158', '886'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', '762', '992'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', '834', '191'),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', '764', '66'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, '670'),
(213, 'TG', 'TOGO', 'Togo', 'TGO', '768', '228'),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', '772', '690'),
(215, 'TO', 'TONGA', 'Tonga', 'TON', '776', '676'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', '780', '1868'),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', '788', '216'),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', '792', '90'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', '795', '7370'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', '796', '1649'),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', '798', '688'),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', '800', '256'),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', '804', '380'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', '784', '971'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', '826', '44'),
(226, 'US', 'UNITED STATES', 'United States', 'USA', '840', '1'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, '1'),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', '858', '598'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', '860', '998'),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', '548', '678'),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', '862', '58'),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', '704', '84'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', '92', '1284'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', '850', '1340'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', '876', '681'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', '732', '212'),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', '887', '967'),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', '894', '260'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', '716', '263');

-- --------------------------------------------------------

--
-- Table structure for table `education_types`
--

CREATE TABLE `education_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

CREATE TABLE `insights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` bigint(20) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `sub_heading` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insight_articles`
--

CREATE TABLE `insight_articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `insight_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `introduction_title` varchar(255) DEFAULT NULL,
  `introduction` longtext DEFAULT NULL,
  `key_findings_title` varchar(255) DEFAULT NULL,
  `key_findings` longtext DEFAULT NULL,
  `country_assessment_title` varchar(255) DEFAULT NULL,
  `country_assessment` longtext DEFAULT NULL,
  `conclusion_title` varchar(255) DEFAULT NULL,
  `conclusion` longtext DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `read_minutes` smallint(5) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insight_articles`
--

INSERT INTO `insight_articles` (`id`, `insight_id`, `author_team_id`, `type`, `title`, `description`, `introduction_title`, `introduction`, `key_findings_title`, `key_findings`, `country_assessment_title`, `country_assessment`, `conclusion_title`, `conclusion`, `sort_order`, `read_minutes`, `active`, `published_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 'LIMS in Action: Digital Lab Management Transforming Testing in Bangladesh', 'TRACE\'s technology team on the rollout of Laboratory Information Management Systems across public sector testing facilities in…', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 18, 1, '2025-04-15 11:38:00', '2026-04-22 03:39:01', '2026-04-22 03:39:01'),
(2, NULL, NULL, 1, 'Export Performance Management: A Framework for South Asian Governments', 'Lorem ipsum dolor sit amet consectetur. Feugiat lorem enim lectus sit. Volutpat neque feugiat est pharetra elementum sit ipsum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 13, 1, '2025-01-20 12:45:00', '2026-04-22 03:43:04', '2026-04-22 03:47:16'),
(3, NULL, NULL, 1, '', 'Lorem ipsum dolor sit amet consectetur. Feugiat lorem enim lectus sit. Volutpat neque feugiat est pharetra elementum sit ipsum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, '2026-04-22 03:49:24', '2026-04-22 03:49:24'),
(4, NULL, NULL, 1, 'TRACE Trade Facilitation Services — 2025 Capability Overview', 'A comprehensive overview of TRACE\'s trade facilitation and customs modernisation service offering, with key projects and client…', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, '2026-04-22 09:58:00', '2026-04-22 03:59:03', '2026-04-22 03:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `insight_types`
--

CREATE TABLE `insight_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insight_types`
--

INSERT INTO `insight_types` (`id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Articals', 1, '2026-04-22 21:41:14', '2026-04-22 21:41:14');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(6, 'default', '{\"uuid\":\"b5db9182-419c-4d0a-a080-32665feabc92\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 893688\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736276839, 1736276839),
(7, 'default', '{\"uuid\":\"b53d656b-268a-46ad-9db6-8611f732e6e3\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 269351\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736284109, 1736284109),
(8, 'default', '{\"uuid\":\"768062db-e8d0-465e-9201-427f3cab9120\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 487907\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736284302, 1736284302),
(9, 'default', '{\"uuid\":\"1e5b3a8e-3441-485c-8823-bbf0f98154ab\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 963242\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736284315, 1736284315),
(10, 'default', '{\"uuid\":\"b8018137-df7b-42ee-9dd2-23df99f2255b\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 856387\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736284834, 1736284834),
(11, 'default', '{\"uuid\":\"fd453491-75e3-41a7-8fe3-ae9abed18f9e\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 970127\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736285977, 1736285977),
(12, 'default', '{\"uuid\":\"e14750b4-e956-4f48-8d80-d6cf94b9f50d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 391991\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736286064, 1736286064),
(13, 'default', '{\"uuid\":\"eabc6fd1-aeaf-457b-99cf-2f801cb33c5f\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 829942\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736286211, 1736286211),
(14, 'default', '{\"uuid\":\"c5d5a7cf-70aa-48ff-8e75-c3d79fe59d6d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 304780\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736286823, 1736286823),
(15, 'default', '{\"uuid\":\"83775ac0-fb34-40be-896b-09ef7e9df690\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 478080\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736368148, 1736368148),
(16, 'default', '{\"uuid\":\"7492ee14-324e-420c-88e8-2f67e942094d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 316833\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736368254, 1736368254),
(17, 'default', '{\"uuid\":\"f8ab8574-5130-4c25-a7c5-9d7461311500\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 472919\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736368701, 1736368701),
(18, 'default', '{\"uuid\":\"c6b08896-574a-4f79-9f6e-3cfa77615314\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 306061\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736368723, 1736368723),
(19, 'default', '{\"uuid\":\"2ee9adcc-0904-4f40-991a-5793b9755f94\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 137706\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736368939, 1736368939),
(20, 'default', '{\"uuid\":\"442ce65d-0186-4bd3-a1df-205d19aee036\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 337475\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736369019, 1736369019),
(21, 'default', '{\"uuid\":\"6e024abd-3c12-4992-bc7a-c0295e17270f\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 772862\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736369391, 1736369391),
(22, 'default', '{\"uuid\":\"0e3ef519-178f-4cd9-b2fb-907ed52d4933\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 923376\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736370379, 1736370379),
(23, 'default', '{\"uuid\":\"a8075bbc-88ed-4a0d-8871-d09c81a06d0d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 580271\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736370696, 1736370696),
(24, 'default', '{\"uuid\":\"b14464d0-dfee-4a17-b313-2a294d0fbc9a\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Super Admin\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 522189\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:15:\\\"admin@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736461379, 1736461379),
(25, 'default', '{\"uuid\":\"c8c6b938-9910-421a-b68d-afa4a7719322\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 759106\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736462979, 1736462979),
(26, 'default', '{\"uuid\":\"3846975c-54cd-4676-ab3d-5af071481409\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 886475\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736462992, 1736462992),
(27, 'default', '{\"uuid\":\"5bf6c510-c020-44a4-9348-ea4c39a2186e\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 105458\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736463330, 1736463330),
(28, 'default', '{\"uuid\":\"b3b2dc30-77da-471c-a0e8-b43d5e31c667\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 357201\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736463422, 1736463422),
(29, 'default', '{\"uuid\":\"e213b461-4318-4f67-9656-464494d8d3b7\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 895221\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736463712, 1736463712),
(30, 'default', '{\"uuid\":\"08509fbf-629f-4f21-a706-510c376747b2\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 481611\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464067, 1736464067),
(31, 'default', '{\"uuid\":\"6bfa87ea-ce96-4fd6-98fb-1ad0d3a210b3\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 756618\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464067, 1736464067),
(32, 'default', '{\"uuid\":\"428ec7cd-9eb0-4208-b466-5b021232aa93\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 747516\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464067, 1736464067),
(33, 'default', '{\"uuid\":\"90600c51-8eba-4f93-b084-f79176ecf6a6\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 799272\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464067, 1736464067),
(34, 'default', '{\"uuid\":\"b9370717-ba64-4eef-96b7-c3997b6bebba\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 578174\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464067, 1736464067),
(35, 'default', '{\"uuid\":\"f4ccf202-6e87-4270-a1d7-fc54088df65e\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 485095\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464068, 1736464068),
(36, 'default', '{\"uuid\":\"5022c55b-7f11-4508-ac03-53f833df3d79\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 558763\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464068, 1736464068),
(37, 'default', '{\"uuid\":\"930e1773-2cce-4ffc-a0ae-ee24f6da6917\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 665837\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464068, 1736464068),
(38, 'default', '{\"uuid\":\"6e176779-7c54-4689-8a86-cacbf2092d6e\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 599529\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464068, 1736464068),
(39, 'default', '{\"uuid\":\"5171edc3-e334-4fd4-bbe7-28390e7d5eb9\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 756722\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464068, 1736464068),
(40, 'default', '{\"uuid\":\"0b25afda-910a-43f9-a187-985c30616d5d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 323934\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464069, 1736464069),
(41, 'default', '{\"uuid\":\"acd67a98-020e-4c0e-ba03-c83b967e6553\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 447297\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464069, 1736464069),
(42, 'default', '{\"uuid\":\"7a35e6d5-4e7a-4c23-a320-bb8e7a669c61\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 544118\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464069, 1736464069),
(43, 'default', '{\"uuid\":\"a0f00910-2124-46d1-b2ad-41f85159c779\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 991269\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464069, 1736464069),
(44, 'default', '{\"uuid\":\"e1d9bf0b-a100-404f-b371-be4abb98c411\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 864580\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464070, 1736464070),
(45, 'default', '{\"uuid\":\"a748ca59-7497-4bc5-b904-fe439ffda424\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 980910\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464070, 1736464070),
(46, 'default', '{\"uuid\":\"903ca426-6044-4ca2-bb21-b35c67df4e79\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 535316\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464070, 1736464070),
(47, 'default', '{\"uuid\":\"a03d4838-9c4b-4bea-97a0-cb7a677de477\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 267625\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464070, 1736464070);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(48, 'default', '{\"uuid\":\"3211e472-a80e-42bc-8278-68ea7fcf3d08\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 509674\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464071, 1736464071),
(49, 'default', '{\"uuid\":\"de505656-e478-4604-9b8c-adf8de56deb6\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 967088\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464072, 1736464072),
(50, 'default', '{\"uuid\":\"306c13cd-021e-4dcd-be44-5cca4d77a6ce\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 155305\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464072, 1736464072),
(51, 'default', '{\"uuid\":\"fc683702-aa83-48e1-96e4-c12ee6608f28\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 772725\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464072, 1736464072),
(52, 'default', '{\"uuid\":\"ed55da84-9def-4448-bddc-6ef5249a3b1a\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 450783\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464073, 1736464073),
(53, 'default', '{\"uuid\":\"caa00019-10a5-4ee4-9a92-fe0a67363d1b\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 465521\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464073, 1736464073),
(54, 'default', '{\"uuid\":\"ac3414c8-f28f-4249-a1e9-98867bd7c92a\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 231211\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464073, 1736464073),
(55, 'default', '{\"uuid\":\"496da36e-a004-4536-bcc0-33be7e2cfb55\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 389313\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464074, 1736464074),
(56, 'default', '{\"uuid\":\"5d9d6cd5-6f36-45b8-ae8f-f52ee61387a1\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 996485\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464074, 1736464074),
(57, 'default', '{\"uuid\":\"0394e5af-5290-46cd-9112-4e81236c28ef\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 875091\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464074, 1736464074),
(58, 'default', '{\"uuid\":\"e90103e9-2123-4b6d-9b7b-b263a80fb9ac\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 636134\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464074, 1736464074),
(59, 'default', '{\"uuid\":\"2d46e57c-0133-49f6-970d-6e9daf28a65d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 366267\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464075, 1736464075),
(60, 'default', '{\"uuid\":\"37dce213-7d38-4112-baf6-28dea7e6b8ca\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 269990\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464075, 1736464075),
(61, 'default', '{\"uuid\":\"6aba6d63-cc18-476a-8412-fe77b3989570\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 633960\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464075, 1736464075),
(62, 'default', '{\"uuid\":\"fa5c11bb-c428-4c65-ad11-6237be443ee7\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 127572\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464075, 1736464075),
(63, 'default', '{\"uuid\":\"e0bff2fd-c000-49ee-b45e-90ec491ee5fc\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 588799\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464076, 1736464076),
(64, 'default', '{\"uuid\":\"b8fcfeb8-807a-4c95-bfa3-53f23365e72b\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 141197\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464076, 1736464076),
(65, 'default', '{\"uuid\":\"9a9bfd3d-0dcd-42a9-a90b-3ea020ddc176\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 559248\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464076, 1736464076),
(66, 'default', '{\"uuid\":\"42302eb8-ae5a-41b8-bedc-0aa87fc2a5b3\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 440294\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464076, 1736464076),
(67, 'default', '{\"uuid\":\"09fa67dd-2d2e-477f-975a-d263f8e3c4d5\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 684309\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464076, 1736464076),
(68, 'default', '{\"uuid\":\"1a13e087-392b-44f8-a046-811b0c1c9c7d\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 806864\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464077, 1736464077),
(69, 'default', '{\"uuid\":\"d4d14080-1771-4af6-863c-beb47f1f3f28\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 911758\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464082, 1736464082),
(70, 'default', '{\"uuid\":\"a51caf24-8d3e-4225-ac37-c06e66eca3e3\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 550235\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464082, 1736464082),
(71, 'default', '{\"uuid\":\"04d76b5e-2566-4414-9a93-0eeebf03934c\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 435910\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464083, 1736464083),
(72, 'default', '{\"uuid\":\"a5f33ba5-6195-4c44-bf84-8c427754a96f\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 929233\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464162, 1736464162),
(73, 'default', '{\"uuid\":\"ea8567b7-d88d-4f32-84f0-f7c8cca82983\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 888196\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464179, 1736464179),
(74, 'default', '{\"uuid\":\"48668990-49d4-4673-81f2-977641bf28bc\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 120656\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464199, 1736464199),
(75, 'default', '{\"uuid\":\"d5a8325c-6ed2-47c4-bf3b-992bc70f389b\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 193805\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464771, 1736464771),
(76, 'default', '{\"uuid\":\"70534837-a541-4efd-9947-378af5e5a00f\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 108264\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464779, 1736464779),
(77, 'default', '{\"uuid\":\"46d5f6eb-d6e6-4432-83c6-21fd6326cbce\",\"displayName\":\"App\\\\Mail\\\\ForgetPassMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:23:\\\"App\\\\Mail\\\\ForgetPassMail\\\":4:{s:4:\\\"name\\\";s:11:\\\"Laurel Noel\\\";s:14:\\\"messageContent\\\";s:27:\\\"Your Reset Code is : 647794\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:21:\\\"sidype@mailinator.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1736464819, 1736464819);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_posting_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `is_reviewed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_posting_id`, `name`, `email`, `phone`, `cv_path`, `is_reviewed`, `created_at`, `updated_at`) VALUES
(1, 2, 'Md Rakib Hasan Purno', 'rakibpurno96@gmail.com', '01624327910', 'cvs/Hc20k8AqMkC3CAPJ3HKYP3Ig7HUNFIOe9AFMfRje.pdf', 0, '2026-04-21 22:54:38', '2026-04-21 22:54:38'),
(2, 5, 'Md Rakib Hasan Purno', 'rakibpurno96@gmail.com', '01624327910', 'cvs/hSG8wigiJdWvSJy0b6aFmQvTb1hUfGTLcl45shCB.pdf', 0, '2026-04-22 01:19:13', '2026-04-22 01:19:13'),
(3, 2, 'SANZIDUL ISLAM', 'sanzidulislam16@gmail.com', '01765532849', 'cvs/6A9vXrJgDo8LFdX4tb4NHjB6uJWXTa0AdAs7namU.pdf', 0, '2026-04-23 03:46:25', '2026-04-23 03:46:25'),
(4, 1, 'Md Rakib Hasan Purno', 'rakibpurno96@gmail.com', '01624327910', 'cvs/IcqeOJXXiepb3B750pT2P4x7FIDF4t2ABByJHVdB.pdf', 1, '2026-04-23 13:48:15', '2026-04-23 14:03:19'),
(5, 1, 'rak', 'rakibpurno6@gmail.com', '0162432791', 'cvs/GNdQCg1qCYbmj4IuwIsHH0qUHziQPROVKNG76PE2.pdf', 0, '2026-04-23 13:54:39', '2026-04-23 13:54:39'),
(6, 1, 'asd', 'rakibpurno16@gmail.com', '016243279111', 'cvs/cReUcUQCbN7O0JHe9dCUczrNkstdZ5pbPSteuAJG.pdf', 0, '2026-04-23 14:02:47', '2026-04-23 14:02:47'),
(7, 1, 'adfr', 'abc@gmail.com', '016243279111223', 'cvs/27zyaOmXbaB2lcMdyfbrk08bq4iDmqF3Jp26PIIM.pdf', 0, '2026-04-24 08:25:15', '2026-04-24 08:25:15'),
(8, 5, 'Hasan Purno', 'hasanpurno96@gmail.com', '01624327913', 'cvs/h1JUa0UvHt6tesbn3jol26ODgske73ilQbMubvdi.pdf', 0, '2026-04-27 06:40:30', '2026-04-27 06:40:30');

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
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `department` varchar(255) NOT NULL,
  `employment_type` varchar(255) NOT NULL DEFAULT 'Full-Time',
  `location` varchar(255) NOT NULL,
  `experience_level` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `posted_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `responsibilities` longtext DEFAULT NULL,
  `requirements` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `title`, `description`, `department`, `employment_type`, `location`, `experience_level`, `is_active`, `posted_date`, `end_date`, `created_at`, `updated_at`, `responsibilities`, `requirements`) VALUES
(1, 'Trade Facilitation Consultant', 'We are looking for an experienced trade facilitation consultant to support our growing portfolio of WTO TFA\r\nimplementation, customs modernisation, and border management reform projects across South Asia.', 'Trade & Policy Division', 'Full-Time', 'Dhaka', '3–5 years experience', 1, '2026-04-22', '2026-06-11', '2026-04-21 22:27:00', '2026-04-27 07:08:44', 'Task management\r\nTeam coordination\r\nReporting\r\nCustomer/client handling\r\nMeeting deadlines', 'Education\r\nExperience\r\nCommunication skills\r\nProblem-solving ability\r\nTechnical knowledge'),
(2, 'Full-Stack Developer — Trade Systems', 'Seeking a full-stack developer with experience in government systems, LIMS, or trade platform\r\ndevelopment. You\'ll design and build digital trade infrastructure for government clients.', 'Technology Solutions', 'Contract', 'Dhaka / Remote', '4+ years experience', 1, '2026-03-11', '2026-07-22', '2026-04-21 22:35:33', '2026-04-27 07:09:45', 'Task management\r\nTeam coordination\r\nReporting\r\nCustomer/client handling\r\nMeeting deadlines', 'Education\r\nExperience\r\nCommunication skills\r\nProblem-solving ability\r\nTechnical knowledge'),
(3, 'Research & Assessments Analyst', 'A rigorous analyst to support trade facilitation needs assessments, economic impact studies, and value\r\nchain analyses for government and donor clients. Strong quantitative and qualitative research skills required.', 'Research & Evaluation', 'Full-Time', 'Dhaka, Bangladesh', '2–4 years experience', 1, '2026-03-11', '2026-04-28', '2026-04-22 00:46:44', '2026-04-27 07:10:21', 'Task management\r\nTeam coordination\r\nReporting\r\nCustomer/client handling\r\nMeeting deadlines', 'Education\r\nExperience\r\nCommunication skills\r\nProblem-solving ability\r\nTechnical knowledge'),
(4, 'Laboratory Quality & Accreditation Specialist', 'Experienced ISO/IEC 17025 specialist to support our laboratory accreditation advisory projects. You\'ll guide\r\npublic and private lab clients through QMS development, gap analysis, and assessment preparation.', 'Laboratory Services', 'Contract', 'Dhaka, Bangladesh', '5+ years experience', 1, '2026-02-11', '2026-04-22', '2026-04-22 00:48:29', '2026-04-27 07:11:58', 'Task management\r\nTeam coordination\r\nReporting\r\nCustomer/client handling\r\nMeeting deadlines', 'Education\r\nExperience\r\nCommunication skills\r\nProblem-solving ability\r\nTechnical knowledge'),
(5, 'Junior Project Coordinator', 'An organised, proactive junior coordinator to support our project management team across multiple\r\nsimultaneous engagements. Ideal for someone early in their development consulting career.', 'Project Management Office', 'Full-Time', 'Dhaka, Bangladesh', '0-2 years experience', 1, '2026-03-09', '2026-06-20', '2026-04-22 00:49:49', '2026-04-27 07:08:11', 'Policy & Regulatory Analysis\r\nProcess Improvement\r\nStakeholder Coordination\r\nCapacity Building & Training\r\nProject Management\r\nDesign and implement trade facilitation projects', 'Business Administration or related fields\r\nExperience\r\nTypically 3+ years in trade, customs, logistics, or economic development\r\nExperience with organizations like:\r\n\r\nKnowledge of trade agreements and customs procedures');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Setting', 1, '2aa56fc3-3526-4aca-b91a-b19213d8fc2e', 'social_icon_216edf82-1a70-4acf-aa7d-41d890d4b5e8', 'facebook-app-symbol', 'facebook-app-symbol.png', 'image/png', 'public', 'public', 346, '[]', '[]', '[]', '[]', 1, '2026-04-21 03:22:47', '2026-04-21 03:22:47'),
(2, 'App\\Models\\Setting', 1, '626c6b68-cca1-4209-ac5d-1e3549531ae3', 'social_icon_85ac2c92-0fdd-4bfc-843a-6104b894689b', 'twitter', 'twitter.png', 'image/png', 'public', 'public', 439, '[]', '[]', '[]', '[]', 2, '2026-04-21 03:22:47', '2026-04-21 03:22:47'),
(5, 'App\\Models\\Setting', 1, 'bb5ce96b-3d47-41fb-97d0-76b277294c10', 'logo_image', 'image 12', 'image-12.png', 'image/png', 'public', 'public', 4249, '[]', '[]', '[]', '[]', 5, '2026-04-21 03:22:47', '2026-04-21 03:22:47'),
(6, 'App\\Models\\Slider', 1, '23fc6974-a511-4790-af80-1b91b607c1d4', 'slider_images', 'image 11', 'image-11.png', 'image/png', 'public', 'public', 1881197, '[]', '[]', '[]', '[]', 1, '2026-04-21 03:31:17', '2026-04-21 03:31:17'),
(7, 'App\\Models\\Slider', 1, '3bcf201c-d2a3-40ff-85ae-c66390d94861', 'slider_images', 'ship', 'ship.jpeg', 'image/jpeg', 'public', 'public', 545069, '[]', '[]', '[]', '[]', 2, '2026-04-21 03:31:17', '2026-04-21 03:31:17'),
(8, 'App\\Models\\Slider', 1, 'c503d195-9eb6-44b1-8689-4002058677f3', 'slider_images', 'hero4', 'hero4.jpeg', 'image/jpeg', 'public', 'public', 838230, '[]', '[]', '[]', '[]', 3, '2026-04-21 03:31:17', '2026-04-21 03:31:17'),
(10, 'App\\Models\\Content', 2, '13fcd7b0-a625-493c-bcc7-34d7f89ef301', 'image', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-21 03:58:41', '2026-04-21 03:58:41'),
(12, 'App\\Models\\Content', 3, '6cecda30-c2b7-44b2-8c09-b4a31b770b8e', 'icon', 'Lab Accreditation', 'Lab-Accreditation.png', 'image/png', 'public', 'public', 118464, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:03:05', '2026-04-21 04:03:05'),
(13, 'App\\Models\\Content', 4, '7096714e-5ddb-4bf9-bbc9-41e7df7f645e', 'image', 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment', 'Digital-Trade-Infrastructure-in-Bangladesh_-A-Readiness-Assessment.png', 'image/png', 'public', 'public', 104940, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:05:13', '2026-04-21 04:05:13'),
(14, 'App\\Models\\Content', 6, 'b8666055-52d9-4e00-b3ff-5da6ed9979cc', 'image', 'Capacity Building (2)', 'Capacity-Building-(2).png', 'image/png', 'public', 'public', 112877, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:10:51', '2026-04-21 04:10:51'),
(15, 'App\\Models\\Content', 7, 'f0edb58a-1599-4664-9ff1-1fa1a0c27b54', 'image', 'Infrastructure Project', 'Infrastructure-Project.png', 'image/png', 'public', 'public', 183090, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:12:06', '2026-04-21 04:12:06'),
(16, 'App\\Models\\Content', 8, '379cef09-5d9f-4e21-8938-00d98ef68961', 'image', 'AEO Programmes_ Unlocking Competitive Advantage for South Asian Exporters', 'AEO-Programmes_-Unlocking-Competitive-Advantage-for-South-Asian-Exporters.png', 'image/png', 'public', 'public', 97881, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:12:52', '2026-04-21 04:12:52'),
(17, 'App\\Models\\Content', 9, '1fb2e176-23a1-46ab-8d9b-3942f9876477', 'image', 'Governance (2)', 'Governance-(2).png', 'image/png', 'public', 'public', 88307, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:13:45', '2026-04-21 04:13:45'),
(18, 'App\\Models\\Content', 10, 'b3e9268a-169a-42a3-a77e-c8aa3a4ee666', 'image', 'Infrastructure Design (1)', 'Infrastructure-Design-(1).png', 'image/png', 'public', 'public', 111664, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:14:39', '2026-04-21 04:14:39'),
(19, 'App\\Models\\Content', 11, '0e1c6487-01d2-4ce4-9333-04df094c6855', 'image', 'Cold Chain', 'Cold-Chain.png', 'image/png', 'public', 'public', 192104, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:16:11', '2026-04-21 04:16:11'),
(20, 'App\\Models\\Content', 12, '17ef1000-401b-416a-b492-0cd789df96b5', 'image', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:21:45', '2026-04-21 04:21:45'),
(25, 'App\\Models\\Service', 5, 'b3537546-64a6-4492-a66f-0c910b65d82d', 'image', 'Lab Accreditation', 'Lab-Accreditation.png', 'image/png', 'public', 'public', 118464, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:45:36', '2026-04-21 04:45:36'),
(26, 'App\\Models\\Service', 6, '18298f2f-0614-4dec-a41b-9e22d38f0a92', 'image', 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment', 'Digital-Trade-Infrastructure-in-Bangladesh_-A-Readiness-Assessment.png', 'image/png', 'public', 'public', 104940, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:49:22', '2026-04-21 04:49:22'),
(27, 'App\\Models\\Service', 7, '189a583d-0d80-4f50-9972-fb34e76f40c5', 'image', 'Capacity Building (2)', 'Capacity-Building-(2).png', 'image/png', 'public', 'public', 112877, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:51:32', '2026-04-21 04:51:32'),
(28, 'App\\Models\\Service', 8, 'fd59769b-307a-4490-9759-2bc20110e784', 'image', 'Infrastructure Project', 'Infrastructure-Project.png', 'image/png', 'public', 'public', 183090, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:52:42', '2026-04-21 04:52:42'),
(29, 'App\\Models\\Service', 9, '6adfb34b-80ce-4198-9a12-f28b09a1cac9', 'image', 'AEO Programmes_ Unlocking Competitive Advantage for South Asian Exporters', 'AEO-Programmes_-Unlocking-Competitive-Advantage-for-South-Asian-Exporters.png', 'image/png', 'public', 'public', 97881, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:53:18', '2026-04-21 04:53:18'),
(30, 'App\\Models\\Service', 10, '14b634ec-a60f-444c-97ff-3cee2fd44584', 'image', 'Governance (2)', 'Governance-(2).png', 'image/png', 'public', 'public', 88307, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:54:24', '2026-04-21 04:54:24'),
(31, 'App\\Models\\Service', 11, 'ae69abc1-2a40-479c-9cd3-a3c52c4ac392', 'image', 'Infrastructure Design (1)', 'Infrastructure-Design-(1).png', 'image/png', 'public', 'public', 111664, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:55:29', '2026-04-21 04:55:29'),
(32, 'App\\Models\\Service', 12, 'e6c5b251-c5ea-4796-bd7e-951b088024bb', 'image', 'Cold Chain', 'Cold-Chain.png', 'image/png', 'public', 'public', 192104, '[]', '[]', '[]', '[]', 1, '2026-04-21 04:56:26', '2026-04-21 04:56:26'),
(34, 'App\\Models\\Project', 2, 'c8212bbb-120c-4830-af1a-6a1c4c6af135', 'images', 'Op-Ed', 'Op-Ed.png', 'image/png', 'public', 'public', 302568, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:06:21', '2026-04-21 05:06:21'),
(35, 'App\\Models\\Project', 3, '2b824078-2fca-4dd6-9dac-59f25f6a1bc2', 'images', 'Export Performance Management_ A Framework for South Asian Governments', 'Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png', 'image/png', 'public', 'public', 113282, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:27:43', '2026-04-21 05:27:43'),
(36, 'App\\Models\\Project', 4, '0b87c5fe-c82d-45dd-94d7-dad72238b5ca', 'images', 'AEO Programmes_ Unlocking Competitive Advantage for South Asian Exporters', 'AEO-Programmes_-Unlocking-Competitive-Advantage-for-South-Asian-Exporters.png', 'image/png', 'public', 'public', 97881, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:39:10', '2026-04-21 05:39:10'),
(37, 'App\\Models\\Project', 5, '83bf978e-e07a-453f-b162-a409883d3f73', 'images', 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment', 'Digital-Trade-Infrastructure-in-Bangladesh_-A-Readiness-Assessment.png', 'image/png', 'public', 'public', 104940, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:40:27', '2026-04-21 05:40:27'),
(38, 'App\\Models\\Project', 6, '78f9737d-024b-48bd-a590-4e9780523a09', 'images', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:42:10', '2026-04-21 05:42:10'),
(39, 'App\\Models\\Project', 7, '9d8c4aba-8ba2-41b3-a64b-63e85f00bfbe', 'images', 'Governance', 'Governance.png', 'image/png', 'public', 'public', 126205, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:45:17', '2026-04-21 05:45:17'),
(40, 'App\\Models\\Project', 8, 'df7316ae-8ee4-4368-83f3-10df817c38cf', 'images', 'Lab Project', 'Lab-Project.png', 'image/png', 'public', 'public', 167491, '[]', '[]', '[]', '[]', 1, '2026-04-21 05:46:55', '2026-04-21 05:46:55'),
(41, 'App\\Models\\Content', 3, 'e13bd0e4-79ee-4010-b39d-07e7c4c04e23', 'image', 'Lab Accreditation', 'Lab-Accreditation.png', 'image/png', 'public', 'public', 118464, '[]', '[]', '[]', '[]', 2, '2026-04-21 08:44:49', '2026-04-21 08:44:49'),
(42, 'App\\Models\\Project', 8, '693afb79-5855-40a9-9108-73f60272b8ad', 'images', 'Reforming Bangladesh\'s Export Licensing Framework_ Policy Brief 2024', 'Reforming-Bangladesh\'s-Export-Licensing-Framework_-Policy-Brief-2024.png', 'image/png', 'public', 'public', 128741, '[]', '[]', '[]', '[]', 2, '2026-04-21 23:40:50', '2026-04-21 23:40:50'),
(43, 'App\\Models\\Project', 8, 'f780a3d3-6a2b-4090-96c0-756f7024973c', 'images', 'Lab training', 'Lab-training.png', 'image/png', 'public', 'public', 73094, '[]', '[]', '[]', '[]', 3, '2026-04-21 23:40:50', '2026-04-21 23:40:50'),
(44, 'App\\Models\\Project', 4, 'e840b8c8-c46a-490e-a9c5-11758b8cac12', 'images', 'hero3', 'hero3.jpeg', 'image/jpeg', 'public', 'public', 150431, '[]', '[]', '[]', '[]', 2, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(45, 'App\\Models\\Project', 4, '9c1536ee-f5eb-4bf6-a551-6f0da12a33cc', 'images', 'Export Performance Management_ A Framework for South Asian Governments', 'Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png', 'image/png', 'public', 'public', 113282, '[]', '[]', '[]', '[]', 3, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(48, 'App\\Models\\Project', 3, '6bf921ed-b0e5-4c84-8277-bb2d65e8b6bd', 'images', 'Digital Trade Infrastructure in Bangladesh_ A Readiness Assessment', 'Digital-Trade-Infrastructure-in-Bangladesh_-A-Readiness-Assessment.png', 'image/png', 'public', 'public', 104940, '[]', '[]', '[]', '[]', 2, '2026-04-21 23:56:57', '2026-04-21 23:56:57'),
(49, 'App\\Models\\Project', 3, '79b70a51-91ee-4a41-b46d-abf378a5504f', 'images', 'Cold Chain', 'Cold-Chain.png', 'image/png', 'public', 'public', 192104, '[]', '[]', '[]', '[]', 3, '2026-04-21 23:56:57', '2026-04-21 23:56:57'),
(50, 'App\\Models\\Project', 5, '9b89e823-302b-482f-8cec-3a21015dac06', 'images', 'Lab training', 'Lab-training.png', 'image/png', 'public', 'public', 73094, '[]', '[]', '[]', '[]', 2, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(51, 'App\\Models\\Project', 5, '5e1383c2-48f1-4635-82b3-f90e7d408e12', 'images', 'image 55', 'image-55.png', 'image/png', 'public', 'public', 401320, '[]', '[]', '[]', '[]', 3, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(52, 'App\\Models\\Project', 6, '08c657cb-e00a-4227-9cee-256a98600144', 'images', 'AEO Programmes_ Unlocking Competitive Advantage for South Asian Exporters', 'AEO-Programmes_-Unlocking-Competitive-Advantage-for-South-Asian-Exporters.png', 'image/png', 'public', 'public', 97881, '[]', '[]', '[]', '[]', 2, '2026-04-22 00:09:12', '2026-04-22 00:09:12'),
(53, 'App\\Models\\Project', 6, '4a5dc738-2165-424d-b95f-c062c486cc25', 'images', 'Infrastructure Design', 'Infrastructure-Design.png', 'image/png', 'public', 'public', 116236, '[]', '[]', '[]', '[]', 3, '2026-04-22 00:09:12', '2026-04-22 00:09:12'),
(54, 'App\\Models\\Project', 7, '6f194132-829d-4032-91a5-b3633e182173', 'images', 'TRACE Laboratory Accreditation Services — Brochure 2024', 'TRACE-Laboratory-Accreditation-Services-—-Brochure-2024.png', 'image/png', 'public', 'public', 136024, '[]', '[]', '[]', '[]', 2, '2026-04-22 00:10:56', '2026-04-22 00:10:56'),
(55, 'App\\Models\\Project', 7, 'e25607d0-756e-4dae-90c9-dcafa1feb2e1', 'images', 'ship', 'ship.jpeg', 'image/jpeg', 'public', 'public', 545069, '[]', '[]', '[]', '[]', 3, '2026-04-22 00:10:56', '2026-04-22 00:10:56'),
(58, 'App\\Models\\Insight', 1, '1c3b816b-120b-493d-ab41-c6e5a7b2428f', 'image', 'AEO Programmes_ Unlocking Competitive Advantage for South Asian Exporters', 'AEO-Programmes_-Unlocking-Competitive-Advantage-for-South-Asian-Exporters.png', 'image/png', 'public', 'public', 97881, '[]', '[]', '[]', '[]', 1, '2026-04-22 03:39:01', '2026-04-22 03:39:01'),
(59, 'App\\Models\\Insight', 2, '4d0d2ea3-e6cb-4d87-a967-67f917bfd2b4', 'image', 'Export Performance Management_ A Framework for South Asian Governments', 'Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png', 'image/png', 'public', 'public', 113282, '[]', '[]', '[]', '[]', 1, '2026-04-22 03:43:04', '2026-04-22 03:43:04'),
(60, 'App\\Models\\Insight', 3, '6c3ed97c-cfe9-445f-a5d4-a72e7cad328a', 'image', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-22 03:59:03', '2026-04-22 03:59:03'),
(61, 'App\\Models\\Project', 2, '5b271067-baa3-4f70-be65-da03d538a8f9', 'images', 'Export Performance Management_ A Framework for South Asian Governments', 'Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png', 'image/png', 'public', 'public', 113282, '[]', '[]', '[]', '[]', 2, '2026-04-22 05:22:53', '2026-04-22 05:22:53'),
(62, 'App\\Models\\Project', 2, 'f52e1584-e808-4bbb-9826-bd125ad848bc', 'images', 'image 55', 'image-55.png', 'image/png', 'public', 'public', 401320, '[]', '[]', '[]', '[]', 3, '2026-04-22 05:22:53', '2026-04-22 05:22:53'),
(65, 'App\\Models\\Content', 31, '3d2d6abb-e170-451b-af53-e72964af0bcd', 'image', 'Background (3)', 'Background-(3).png', 'image/png', 'public', 'public', 485887, '[]', '[]', '[]', '[]', 1, '2026-04-22 06:33:01', '2026-04-22 06:33:01'),
(66, 'App\\Models\\Content', 33, 'd5bce7ba-b4e7-473d-9547-05369d97543e', 'image', 'Insight', 'Insight.png', 'image/png', 'public', 'public', 184634, '[]', '[]', '[]', '[]', 1, '2026-04-22 06:39:46', '2026-04-22 06:39:46'),
(69, 'App\\Models\\Team', 2, 'e66c20d2-e1dd-4b5e-a505-320939091b49', 'image', 'fuad', 'fuad.png', 'image/png', 'public', 'public', 92110, '[]', '[]', '[]', '[]', 1, '2026-04-22 23:01:44', '2026-04-22 23:01:44'),
(72, 'App\\Models\\Team', 3, 'fe914b1d-22ae-49c8-9c7e-1792313a75a6', 'image', 'saifullah', 'saifullah.png', 'image/png', 'public', 'public', 215656, '[]', '[]', '[]', '[]', 1, '2026-04-22 23:07:04', '2026-04-22 23:07:04'),
(78, 'App\\Models\\Team', 5, 'bf324bf8-0ccc-4092-adea-8f9990b9e2c0', 'image', 'Shiva', 'Shiva.png', 'image/png', 'public', 'public', 112145, '[]', '[]', '[]', '[]', 1, '2026-04-22 23:44:29', '2026-04-22 23:44:29'),
(81, 'App\\Models\\Team', 6, '4eacd885-85ed-4243-b53c-0e080d474698', 'image', 'nabeel', 'nabeel.png', 'image/png', 'public', 'public', 142860, '[]', '[]', '[]', '[]', 1, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(85, 'App\\Models\\Team', 9, 'a1662646-6255-4efc-b9e1-3df015d6bca1', 'image', 'mahbub', 'mahbub.png', 'image/png', 'public', 'public', 131053, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(88, 'App\\Models\\Team', 10, '0951338b-f1de-4294-a435-fa68b6eaecc7', 'image', 'tanvir', 'tanvir.png', 'image/png', 'public', 'public', 99861, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(91, 'App\\Models\\Team', 11, 'a97e39d6-dc65-4601-ba09-4bd0dce978bc', 'image', 'mobarak', 'mobarak.png', 'image/png', 'public', 'public', 184623, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(94, 'App\\Models\\Team', 12, '46546690-e735-46a3-ba28-8529e90d1381', 'image', 'mahmud', 'mahmud.png', 'image/png', 'public', 'public', 74487, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(97, 'App\\Models\\Team', 13, 'e5e0d6bf-4336-4074-9f0d-29ee1f77051a', 'image', 'mimma', 'mimma.png', 'image/png', 'public', 'public', 136046, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(100, 'App\\Models\\Team', 14, '82c8358f-eac6-4ec9-ae5e-53d776b4b9c3', 'image', 'michael', 'michael.png', 'image/png', 'public', 'public', 11890, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:28:56', '2026-04-23 00:28:56'),
(103, 'App\\Models\\Team', 15, '76dc2a6d-dd17-4c17-9284-bc0f6b3cb8cf', 'image', 'nittya', 'nittya.png', 'image/png', 'public', 'public', 11331, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:31:54', '2026-04-23 00:31:54'),
(108, 'App\\Models\\Team', 17, '3d88aeb9-1eb0-4f33-aced-06ca18558238', 'image', 'tahmina', 'tahmina.png', 'image/png', 'public', 'public', 9843, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:36:44', '2026-04-23 00:36:44'),
(111, 'App\\Models\\Team', 16, 'a66f2bf0-5e7e-4ba2-9057-a0b4e4ed3ca3', 'image', 'Syed', 'Syed.png', 'image/png', 'public', 'public', 11785, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:37:19', '2026-04-23 00:37:19'),
(112, 'App\\Models\\Team', 18, '1016639d-47dd-4fa7-8264-3846f73768d2', 'image', 'kazi', 'kazi.png', 'image/png', 'public', 'public', 9599, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:39:30', '2026-04-23 00:39:30'),
(115, 'App\\Models\\Team', 19, '5fba3fad-02de-4397-8e32-78c79b009020', 'image', 'imran', 'imran.png', 'image/png', 'public', 'public', 9301, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:41:39', '2026-04-23 00:41:39'),
(116, 'App\\Models\\TeamSocialMedia', 34, 'cd4a8e47-9c97-49f7-b256-f1a96c393e32', 'social_icon', 'linkedin (1)', 'linkedin-(1).png', 'image/png', 'public', 'public', 5823, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:41:40', '2026-04-23 00:41:40'),
(117, 'App\\Models\\TeamSocialMedia', 35, '017b17d8-ce4f-4dce-8c26-dd25f3d9c52e', 'social_icon', 'email', 'email.png', 'image/png', 'public', 'public', 7832, '[]', '[]', '[]', '[]', 1, '2026-04-23 00:41:40', '2026-04-23 00:41:40'),
(122, 'App\\Models\\Content', 40, '5e3f681f-cd8c-4d92-b3e0-11b641dafaac', 'icon', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-23 01:26:05', '2026-04-23 01:26:05'),
(123, 'App\\Models\\Content', 40, 'a0fd73e2-295a-4148-ad2e-5298a2932e86', 'image', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 2, '2026-04-23 01:26:05', '2026-04-23 01:26:05'),
(124, 'App\\Models\\Partner', 1, 'c58abb3f-5630-47be-ba5a-a8691b4a071b', 'partner_image', 'bafisa', 'bafisa.png', 'image/png', 'public', 'public', 4739, '[]', '[]', '[]', '[]', 1, '2026-04-23 01:37:24', '2026-04-23 01:37:24'),
(125, 'App\\Models\\Partner', 2, '5bafbc13-f2d9-46a5-9a7d-23d0a759a523', 'partner_image', 'lir 2', 'lir-2.png', 'image/png', 'public', 'public', 4814, '[]', '[]', '[]', '[]', 1, '2026-04-23 01:38:07', '2026-04-23 01:38:07'),
(126, 'App\\Models\\Partner', 3, 'b2e84650-4d9e-421b-812f-a5426459a55c', 'partner_image', 'bijem', 'bijem.png', 'image/png', 'public', 'public', 5150, '[]', '[]', '[]', '[]', 1, '2026-04-23 01:38:29', '2026-04-23 01:38:29'),
(146, 'App\\Models\\TeamSocialMedia', 44, '3141ebe8-3822-4dc4-b15d-a2edbec33b40', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-24 19:17:56', '2026-04-24 19:17:56'),
(148, 'App\\Models\\TeamSocialMedia', 45, 'a52e50d3-0074-4933-aaba-5c8bff86bde0', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-24 19:27:30', '2026-04-24 19:27:30'),
(149, 'App\\Models\\TeamSocialMedia', 8, '0e86ac12-e2d0-405a-ba80-17fc563ce035', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-24 19:31:54', '2026-04-24 19:31:54'),
(150, 'App\\Models\\TeamSocialMedia', 41, 'a797e629-b064-4c10-b474-430df48543d3', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-24 19:31:54', '2026-04-24 19:31:54'),
(151, 'App\\Models\\Slider', 1, '06e7ad98-b42d-4dcd-a87b-7298762d3057', 'slider_images', 'Image 04 → Project Image', 'Image-04-→-Project-Image.png', 'image/png', 'public', 'public', 97967, '[]', '[]', '[]', '[]', 4, '2026-04-26 04:12:44', '2026-04-26 04:12:44'),
(154, 'App\\Models\\Content', 42, 'c99cf097-cbe3-454d-9878-899b13c64c33', 'image', 'bg', 'bg.png', 'image/png', 'public', 'public', 451850, '[]', '[]', '[]', '[]', 1, '2026-04-26 04:17:08', '2026-04-26 04:17:08'),
(156, 'App\\Models\\Service', 4, 'd8e2040a-07c5-4fd6-a23c-58dd0d77ce53', 'image', 'Trade and Customs', 'Trade-and-Customs.png', 'image/png', 'public', 'public', 148908, '[]', '[]', '[]', '[]', 1, '2026-04-26 05:05:43', '2026-04-26 05:05:43'),
(157, 'App\\Models\\Project', 1, 'b0641e40-927e-4745-9535-285697b30d6e', 'images', 'Infrastructure Design (1)', 'Infrastructure-Design-(1).png', 'image/png', 'public', 'public', 111664, '[]', '[]', '[]', '[]', 1, '2026-04-26 05:13:46', '2026-04-26 05:13:46'),
(158, 'App\\Models\\Project', 1, '5929d7e5-a9e6-44c2-9364-63202f6682d8', 'images', 'Capacity Building', 'Capacity-Building.png', 'image/png', 'public', 'public', 96725, '[]', '[]', '[]', '[]', 2, '2026-04-26 05:13:46', '2026-04-26 05:13:46'),
(159, 'App\\Models\\Project', 1, 'ba64e2cd-be61-4e0c-b6c0-60ab67dd1cfb', 'images', 'Image 04 → Project Image', 'Image-04-→-Project-Image.png', 'image/png', 'public', 'public', 97967, '[]', '[]', '[]', '[]', 3, '2026-04-26 05:13:46', '2026-04-26 05:13:46'),
(161, 'App\\Models\\Content', 49, '00dc707c-88c9-429e-be25-b6056eeffd3b', 'image', 'Export Performance Management_ A Framework for South Asian Governments', 'Export-Performance-Management_-A-Framework-for-South-Asian-Governments.png', 'image/png', 'public', 'public', 113282, '[]', '[]', '[]', '[]', 1, '2026-04-26 06:54:31', '2026-04-26 06:54:31'),
(162, 'App\\Models\\Partner', 7, '23095e67-e98a-44df-bb28-d6b56366754f', 'partner_image', 'b-advancy', 'b-advancy.png', 'image/png', 'public', 'public', 11399, '[]', '[]', '[]', '[]', 1, '2026-04-26 07:16:14', '2026-04-26 07:16:14'),
(163, 'App\\Models\\Partner', 8, '73a148c6-55b4-4a0e-a691-4bd8c81c501c', 'partner_image', 'build', 'build.png', 'image/png', 'public', 'public', 6196, '[]', '[]', '[]', '[]', 1, '2026-04-26 07:16:38', '2026-04-26 07:16:38'),
(164, 'App\\Models\\Partner', 9, '59cfd8a7-5e2a-40b1-b9ea-3f202eae4f77', 'partner_image', 'sanem 2', 'sanem-2.png', 'image/png', 'public', 'public', 3741, '[]', '[]', '[]', '[]', 1, '2026-04-26 07:17:45', '2026-04-26 07:17:45'),
(165, 'App\\Models\\TeamSocialMedia', 1, 'cefd7c8b-ca2c-42bf-9c46-b24f9d23dc3d', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:53:02', '2026-04-27 04:53:02'),
(166, 'App\\Models\\TeamSocialMedia', 2, 'a6cd6296-ba2e-40b0-80f2-e240139d899c', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:53:02', '2026-04-27 04:53:02'),
(167, 'App\\Models\\TeamSocialMedia', 3, '6672f39c-c2c2-4ce2-9866-c6d737d05310', 'social_icon', 'twitter (2)', 'twitter-(2).png', 'image/png', 'public', 'public', 17454, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:54:31', '2026-04-27 04:54:31'),
(168, 'App\\Models\\TeamSocialMedia', 10, '513a6cec-1435-43ff-be7c-404c85dfd791', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:55:14', '2026-04-27 04:55:14'),
(169, 'App\\Models\\TeamSocialMedia', 11, 'a611221d-8252-4844-8add-d23f8ef9bfc0', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:55:14', '2026-04-27 04:55:14'),
(170, 'App\\Models\\TeamSocialMedia', 14, 'f30314f5-5def-41dd-b6cd-d1a22355df0a', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:55:36', '2026-04-27 04:55:36'),
(171, 'App\\Models\\TeamSocialMedia', 15, '57c4d71b-c39d-4c50-b647-22907d70bbbd', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 04:55:36', '2026-04-27 04:55:36'),
(172, 'App\\Models\\TeamSocialMedia', 22, 'b5e30633-2d7c-4807-9a4d-5dec805aa5da', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:15:50', '2026-04-27 07:15:50'),
(173, 'App\\Models\\TeamSocialMedia', 23, 'aeadf5da-278d-43d2-aa1d-e3c1e9c03772', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:15:50', '2026-04-27 07:15:50'),
(174, 'App\\Models\\TeamSocialMedia', 20, 'd8f48f46-ef17-49c5-abed-5def840d2083', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:15', '2026-04-27 07:16:15'),
(175, 'App\\Models\\TeamSocialMedia', 21, '7b30ff1a-6254-4c64-90aa-a923bf342d18', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:15', '2026-04-27 07:16:15'),
(176, 'App\\Models\\TeamSocialMedia', 18, 'fdfb9989-2cac-4d08-9461-4ddacb4bbd14', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:33', '2026-04-27 07:16:33'),
(177, 'App\\Models\\TeamSocialMedia', 19, 'd4a36ea9-a39c-42b6-9195-7207ed5a66d4', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:33', '2026-04-27 07:16:33'),
(178, 'App\\Models\\TeamSocialMedia', 16, '3058b63c-6b37-4f0c-b63b-a337b69e5407', 'social_icon', 'linkedin (3)', 'linkedin-(3).png', 'image/png', 'public', 'public', 8794, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:57', '2026-04-27 07:16:57'),
(179, 'App\\Models\\TeamSocialMedia', 17, 'c19172ee-e6a3-4f87-a946-487063e272f4', 'social_icon', 'email (2)', 'email-(2).png', 'image/png', 'public', 'public', 10763, '[]', '[]', '[]', '[]', 1, '2026-04-27 07:16:57', '2026-04-27 07:16:57');

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
(4, '2024_08_25_062138_create_countries_table', 1),
(5, '2024_08_25_065003_create_personal_access_tokens_table', 1),
(6, '2024_08_25_082908_create_professions_table', 1),
(7, '2024_08_25_083055_create_education_types_table', 1),
(8, '2024_08_25_083117_create_genders_table', 1),
(9, '2024_08_25_083340_create_user_details_table', 1),
(10, '2024_08_25_093802_create_religions_table', 1),
(11, '2024_08_27_054752_create_admins_table', 1),
(12, '2024_08_31_163847_create_permission_tables', 2),
(13, '2024_08_31_164000_create_media_table', 2),
(14, '2025_01_15_155437_create_oauth_auth_codes_table', 3),
(15, '2025_01_15_155438_create_oauth_access_tokens_table', 3),
(16, '2025_01_15_155439_create_oauth_refresh_tokens_table', 3),
(17, '2025_01_15_155440_create_oauth_clients_table', 3),
(18, '2025_01_15_155441_create_oauth_personal_access_clients_table', 3),
(19, '2026_04_20_000000_create_settings_table', 4),
(20, '2026_04_20_010000_create_sliders_table', 4),
(21, '2026_04_20_020000_create_contents_table', 4),
(22, '2026_04_20_021000_create_services_table', 4),
(23, '2026_04_20_022000_create_service_details_table', 4),
(24, '2026_04_20_023000_create_service_product_solutions_table', 4),
(25, '2026_04_20_024000_add_overview_to_services_table', 4),
(26, '2026_04_21_000001_create_projects_table', 4),
(27, '2026_04_21_000002_create_project_services_table', 4),
(28, '2026_04_21_000003_create_project_locations_table', 4),
(29, '2026_04_21_000004_create_project_phase_details_table', 4),
(30, '2026_04_21_000005_create_project_outcomes_table', 4),
(31, '2026_04_21_091951_create_contact_messages_table', 5),
(32, '2026_04_21_100924_create_contact_infos_table', 5),
(33, '2026_04_22_030458_create_job_postings_table', 5),
(34, '2026_04_22_030512_create_job_applications_table', 5),
(35, '2026_04_22_044923_add_responsibilities_and_requirements_to_job_postings_table', 6),
(36, '2026_04_21_000006_create_teams_table', 7),
(37, '2026_04_21_000007_create_team_expertises_table', 7),
(38, '2026_04_21_000008_create_team_social_media_table', 7),
(39, '2026_04_21_000009_create_team_project_table', 7),
(40, '2026_04_21_000010_create_insights_table', 7),
(41, '2026_04_21_000011_create_insight_articles_table', 7),
(42, '2026_04_22_080530_create_partners_table', 8),
(43, '2026_04_22_100330_add_new_column_to_teams', 9),
(44, '2026_04_22_112840_create_insight_types_table', 9),
(45, '2026_04_22_122208_change_a_column_to_insights', 10),
(46, '2026_04_22_144708_change_type_field_insight_articles_table', 10),
(47, '2026_04_22_151032_add_new_columns_insight_articles_table', 10),
(48, '2026_04_23_063615_change_a_column_to_teams', 11),
(49, '2026_04_26_120000_add_short_description_to_teams', 12),
(50, '2026_04_26_130000_add_end_date_to_job_postings', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `description`, `link`, `sort_order`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Bafisa', NULL, NULL, 0, 1, '2026-04-23 01:37:24', '2026-04-23 01:37:24'),
(2, 'LIR', NULL, NULL, 0, 1, '2026-04-23 01:38:07', '2026-04-23 01:38:07'),
(3, 'bijem', NULL, NULL, 0, 1, '2026-04-23 01:38:29', '2026-04-23 01:38:29'),
(7, 'B-ad', NULL, NULL, 0, 1, '2026-04-26 07:16:13', '2026-04-26 07:16:13'),
(8, 'build', NULL, NULL, 0, 1, '2026-04-26 07:16:38', '2026-04-26 07:16:38'),
(9, 'sanem', NULL, NULL, 0, 1, '2026-04-26 07:17:45', '2026-04-26 07:17:45');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `client` varchar(255) DEFAULT NULL,
  `project_standard` varchar(255) DEFAULT NULL,
  `overview` longtext DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `project_status` varchar(255) NOT NULL DEFAULT 'Completed',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `client`, `project_standard`, `overview`, `start_date`, `end_date`, `project_status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Accreditation Support to PRTC, CVASU', 'PRTC, CVASU', 'ISO/IEC 17025:2017', 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc. Etiam finibus tincidunt fringilla. Maecenas consectetur turpis ac sollicitudin fringilla. Morbi viverra lectus quis ipsum facilisis pellentesque.', '2023-01-21', '2024-08-21', 'Completed', 1, '2026-04-21 05:00:57', '2026-04-26 05:13:46'),
(2, 'Seven-Story Advanced Customs Laboratory — Schematic Design', 'Chattogram Customs Authority', 'ISO/IEC 17025:2017', 'Mauris vel vulputate lectus, quis aliquam lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc. Etiam finibus augue est, finibus ut consequat ac, suscipit at nu', '2023-01-21', '2024-05-21', 'Completed', 2, '2026-04-21 05:06:21', '2026-04-26 05:26:26'),
(3, 'HS Code Import Database & BAFISA Website Upgrade', 'Freight Forwarding & Shipping Association, Bangladesh', 'ISO/IEC 17025:2017', 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc. Etiam finibus tincidunt fringilla. Maecenas consectetur turpis ac sollicitudin fringilla. Morbi viverra lectus quis ipsum facilisis pellentesque.', '2022-09-21', '2023-01-01', 'Completed', 3, '2026-04-21 05:27:43', '2026-04-26 05:26:36'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'National Board of Revenue', 'ISO/IEC 17025:2017', 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc.', '2022-09-21', '2023-01-02', 'Completed', 6, '2026-04-21 05:39:10', '2026-04-26 05:28:54'),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'World Bank / IFC', 'ISO/IEC 17025:2017', NULL, '2022-09-21', '2022-10-14', 'Completed', 4, '2026-04-21 05:40:27', '2026-04-26 05:28:09'),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'DCCI / Private Sector', 'ISO/IEC 17025:2017', 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc.', '2022-09-21', '2023-02-03', 'Completed', 5, '2026-04-21 05:41:34', '2026-04-26 05:28:38'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'BGMEA / Donor-Funded', NULL, 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc.', NULL, '2024-02-23', 'Completed', 7, '2026-04-21 05:45:17', '2026-04-22 00:10:56'),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'World Bank / IFC', NULL, 'Mauris vel vulputate lectus, quis aliquam velit. Mauris dictum nulla sed tortor pharetra lacinia. Morbi augue est, finibus ut consequat ac, suscipit at nunc.', NULL, '2022-02-03', 'Completed', 8, '2026-04-21 05:46:55', '2026-04-27 04:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `project_locations`
--

CREATE TABLE `project_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `location` longtext DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_locations`
--

INSERT INTO `project_locations` (`id`, `project_id`, `location`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Chattogram, Bangladesh', 0, '2026-04-21 05:23:21', '2026-04-21 05:23:21'),
(2, 7, 'Chattogram, Bangladesh', 0, '2026-04-21 05:51:22', '2026-04-21 05:51:22'),
(3, 8, 'Chattogram, Bangladesh', 0, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(4, 4, 'Chattogram, Bangladesh', 0, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(5, 1, 'Dhaka Bangladesh', 0, '2026-04-21 23:49:14', '2026-04-21 23:49:14'),
(6, 3, 'Dhaka', 0, '2026-04-21 23:56:18', '2026-04-21 23:56:18'),
(7, 5, 'Sylhet', 0, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(8, 6, 'Dhaka', 0, '2026-04-22 00:09:12', '2026-04-22 00:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `project_outcomes`
--

CREATE TABLE `project_outcomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_outcomes`
--

INSERT INTO `project_outcomes` (`id`, `project_id`, `icon`, `text`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra. Nullam ornare volutpat diam vitae feugiat.', 0, '2026-04-21 05:22:02', '2026-04-26 05:25:33'),
(2, 2, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra. Nullam ornare volutpat diam vitae feugiat.', 0, '2026-04-21 05:23:21', '2026-04-26 05:26:26'),
(6, 7, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 0, '2026-04-21 05:54:11', '2026-04-26 05:29:25'),
(7, 7, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 05:54:11', '2026-04-26 05:29:25'),
(8, 7, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 2, '2026-04-21 05:54:11', '2026-04-26 05:29:25'),
(9, 8, '', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra. Nullam ornare volutpat diam vitae feugiat.', 0, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(10, 8, '', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(11, 8, '', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(12, 8, '', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(13, 8, '', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risu.', 4, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(14, 8, '', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-21 23:35:48', '2026-04-21 23:35:48'),
(15, 4, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra. Nullam ornare volutpat diam vitae feugiat.', 0, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(16, 4, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(17, 4, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(18, 4, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(19, 4, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risu.', 4, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(20, 4, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-21 23:44:36', '2026-04-26 05:28:54'),
(21, 1, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 23:49:14', '2026-04-26 05:26:11'),
(22, 1, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-21 23:49:14', '2026-04-26 05:26:11'),
(23, 1, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-21 23:49:14', '2026-04-26 05:26:11'),
(24, 1, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risu.', 4, '2026-04-21 23:49:14', '2026-04-26 05:26:11'),
(25, 1, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-21 23:49:14', '2026-04-26 05:26:11'),
(26, 2, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 23:53:38', '2026-04-26 05:26:26'),
(27, 2, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-21 23:53:38', '2026-04-26 05:26:26'),
(28, 2, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-21 23:53:38', '2026-04-26 05:26:26'),
(29, 2, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risu.', 4, '2026-04-21 23:53:38', '2026-04-26 05:26:26'),
(30, 2, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-21 23:53:38', '2026-04-26 05:26:26'),
(31, 3, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc non diam pellentesque pharetra. Nullam ornare volutpat diam vitae feugiat.', 0, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(32, 3, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(33, 3, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(34, 3, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(35, 3, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risu.', 4, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(36, 3, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-21 23:56:18', '2026-04-26 05:26:36'),
(37, 5, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 0, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(38, 5, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(39, 5, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(40, 5, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(41, 5, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 4, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(42, 5, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-22 00:07:24', '2026-04-26 05:28:09'),
(43, 6, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 0, '2026-04-22 00:09:12', '2026-04-26 05:28:38'),
(44, 6, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 1, '2026-04-22 00:09:12', '2026-04-26 05:28:38'),
(45, 6, 'fa fa-check-circle', 'Nulla eros nisl, blandit sollicitudin eleifend nec, facilisis quis metus. Suspendisse volutpat nunc justo, sit amet consectetur nunc tincidunt ac.', 2, '2026-04-22 00:09:12', '2026-04-26 05:28:38'),
(46, 6, 'fa fa-check-circle', 'Nam a ultricies neque. Integer id mi et arcu consectetur sagittis. Vivamus placerat nunc .', 3, '2026-04-22 00:09:12', '2026-04-26 05:28:38'),
(47, 6, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 4, '2026-04-22 00:09:12', '2026-04-26 05:28:38'),
(48, 6, 'fa fa-check-circle', 'Phasellus tempus id mauris ac consequat. Ut placerat, massa eget convallis varius, dolor quam lacinia risus, in euismod nunc dolor eget ligula.', 5, '2026-04-22 00:09:12', '2026-04-26 05:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `project_phase_details`
--

CREATE TABLE `project_phase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `phase_description` longtext DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_phase_details`
--

INSERT INTO `project_phase_details` (`id`, `project_id`, `phase_description`, `attachment`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Deliverable Phases', NULL, 0, '2026-04-21 05:22:02', '2026-04-21 23:49:14'),
(2, 2, 'Deliverable Phases', NULL, 0, '2026-04-21 05:23:21', '2026-04-21 23:53:38'),
(3, 7, '5 Deliverable Phases', NULL, 0, '2026-04-21 05:51:22', '2026-04-21 05:51:22'),
(4, 8, 'Deliverable Phases', NULL, 0, '2026-04-21 23:35:48', '2026-04-21 23:40:50'),
(5, 8, 'Phases', NULL, 1, '2026-04-21 23:40:50', '2026-04-21 23:40:50'),
(6, 8, 'Phases', NULL, 2, '2026-04-21 23:40:50', '2026-04-21 23:40:50'),
(7, 4, 'phase 1', NULL, 0, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(8, 4, 'phase 2', NULL, 1, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(9, 4, 'phase 3', NULL, 2, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(10, 4, 'phase 4', NULL, 3, '2026-04-21 23:44:36', '2026-04-21 23:44:36'),
(11, 1, 'Phases', NULL, 1, '2026-04-21 23:49:14', '2026-04-21 23:49:14'),
(12, 1, 'Phases', NULL, 2, '2026-04-21 23:49:14', '2026-04-21 23:49:14'),
(13, 2, 'Phases', NULL, 1, '2026-04-21 23:53:38', '2026-04-21 23:53:38'),
(14, 2, 'Phases', NULL, 2, '2026-04-21 23:53:38', '2026-04-21 23:53:38'),
(15, 3, '1', NULL, 0, '2026-04-21 23:56:18', '2026-04-21 23:56:18'),
(16, 3, '3', NULL, 1, '2026-04-21 23:56:18', '2026-04-21 23:56:18'),
(17, 3, '5', NULL, 2, '2026-04-21 23:56:18', '2026-04-21 23:56:18'),
(18, 5, 'Phase', NULL, 0, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(19, 5, 'Phase', NULL, 1, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(20, 5, 'Phase', NULL, 2, '2026-04-22 00:07:24', '2026-04-22 00:07:24'),
(21, 6, 'Phase', NULL, 0, '2026-04-22 00:09:12', '2026-04-22 00:09:12'),
(22, 6, 'Phase', NULL, 1, '2026-04-22 00:09:12', '2026-04-22 00:09:12'),
(23, 6, 'Phase', NULL, 2, '2026-04-22 00:09:12', '2026-04-22 00:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `project_services`
--

CREATE TABLE `project_services` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_services`
--

INSERT INTO `project_services` (`project_id`, `service_id`) VALUES
(1, 6),
(1, 8),
(1, 9),
(2, 5),
(2, 8),
(2, 10),
(3, 5),
(3, 6),
(3, 8),
(3, 10),
(4, 5),
(4, 6),
(4, 10),
(5, 4),
(5, 9),
(5, 11),
(6, 6),
(6, 8),
(6, 10),
(7, 8),
(7, 9),
(7, 10),
(8, 6),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `overview` longtext DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `content_id`, `slug`, `service_name`, `sort_order`, `overview`, `active`, `created_at`, `updated_at`) VALUES
(4, 2, 'service 1', 'Trade Facilitation & Customs', 1, 'TRACE supports governments, trade bodies, and private stakeholders to modernize, simplify, and automate cross-border trade procedures in line with global best practices and WTO Trade Facilitation Agreement (TFA) commitments. Our approach integrates policy reform, digital transformation, and institutional strengthening. By combining strategic policy insight with cutting-edge technical innovation, TRACE bridges the gap between reform design and implementation, turning commitments into real-world improvements at ports, borders, and trade agencies.', 1, '2026-04-21 04:42:31', '2026-04-26 05:05:43'),
(5, 3, 'service 2', 'Policy Advocacy', 2, 'TRACE supports governments, trade bodies, and private stakeholders to modernize, simplify, and automate cross-border trade procedures in line with global best practices and WTO Trade Facilitation Agreement (TFA) commitments. Our approach integrates policy reform, digital transformation, and institutional strengthening. By combining strategic policy insight with cutting-edge technical innovation, TRACE bridges the gap between reform design and implementation, turning commitments into real-world improvements at ports, borders, and trade agencies.', 1, '2026-04-21 04:45:36', '2026-04-21 22:18:28'),
(6, 4, 'service 3', 'Research & Assessments', 3, NULL, 1, '2026-04-21 04:49:22', '2026-04-21 04:49:22'),
(7, 6, 'service 4', 'Capacity Building', 4, NULL, 1, '2026-04-21 04:51:32', '2026-04-21 04:51:32'),
(8, 7, 'service 5', 'Project Management', 5, NULL, 1, '2026-04-21 04:52:42', '2026-04-21 04:52:42'),
(9, 8, 'service 6', 'Technology Solutions', 6, NULL, 1, '2026-04-21 04:53:18', '2026-04-21 04:53:18'),
(10, 9, 'service 7', 'Laboratory Services', 7, NULL, 1, '2026-04-21 04:54:24', '2026-04-21 04:54:24'),
(11, 10, 'service 8', 'Trade Information Systems', 8, NULL, 1, '2026-04-21 04:55:29', '2026-04-21 04:55:29'),
(12, 11, 'service 9', 'Cold Chain & Logistics', 9, 'TRACE supports governments, trade bodies, and private stakeholders to modernize, simplify, and automate cross-border trade procedures in line with global best practices and WTO Trade Facilitation Agreement (TFA) commitments. Our approach integrates policy reform, digital transformation, and institutional strengthening.', 1, '2026-04-21 04:56:26', '2026-04-21 06:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `text` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `service_id`, `text`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 4, 'Mapping and streamlining border processes', 0, '2026-04-21 04:43:39', '2026-04-21 04:43:39'),
(4, 5, 'Introducing digital solutions for licensing and clearance', 0, '2026-04-21 04:46:57', '2026-04-21 04:46:57'),
(5, 6, 'Devising solutions for promoting exports following international requirements', 0, '2026-04-21 04:50:13', '2026-04-21 04:50:13'),
(6, 12, 'Mapping and streamlining border processes', 0, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(7, 12, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(8, 12, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(9, 12, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(10, 4, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(11, 4, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(12, 4, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(13, 4, 'Supporting the private sector to avail trade facilitation services offered by the Government', 4, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(14, 4, 'Facilitating stakeholder consultations and coordination platforms', 5, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(15, 4, 'Advising business chambers and associations on trade procedures and advocacy', 6, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(16, 11, 'Mapping and streamlining border processes', 0, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(17, 11, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(18, 11, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(19, 11, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(20, 5, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 22:18:28', '2026-04-21 22:18:28'),
(21, 5, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 22:18:28', '2026-04-21 22:18:28'),
(22, 5, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 22:18:28', '2026-04-21 22:18:28'),
(23, 5, 'Supporting the private sector to avail trade facilitation services offered by the Government', 4, '2026-04-21 22:18:28', '2026-04-21 22:18:28'),
(24, 7, 'Mapping and streamlining border processes', 0, '2026-04-21 22:20:10', '2026-04-21 22:20:10'),
(25, 7, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(26, 7, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(27, 7, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(28, 7, 'Supporting the private sector to avail trade facilitation services offered by the Government', 4, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(29, 7, 'Facilitating stakeholder consultations and coordination platforms', 5, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(30, 8, 'Mapping and streamlining border processes', 0, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(31, 8, 'Introducing digital solutions for licensing and clearance', 1, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(32, 8, 'Devising solutions for promoting exports following international requirements', 2, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(33, 8, 'Review legislative framework to identify trade bottlenecks and suggest alignment measures', 3, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(34, 8, 'Supporting the private sector to avail trade facilitation services offered by the Government', 4, '2026-04-21 22:21:12', '2026-04-21 22:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `service_product_solutions`
--

CREATE TABLE `service_product_solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) NOT NULL,
  `sub_heading` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_product_solutions`
--

INSERT INTO `service_product_solutions` (`id`, `service_id`, `heading`, `sub_heading`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 4, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 04:43:39', '2026-04-21 04:43:39'),
(4, 5, 'Automated Risk Management System', 'Technology', 0, '2026-04-21 04:46:57', '2026-04-21 04:46:57'),
(5, 6, 'Authorized Economic Operator Facilities', 'Certification', 0, '2026-04-21 04:50:13', '2026-04-21 04:50:13'),
(6, 12, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 06:07:45', '2026-04-21 06:07:45'),
(7, 12, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(8, 12, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(9, 12, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 06:09:42', '2026-04-21 06:09:42'),
(10, 4, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(11, 4, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(12, 4, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(13, 4, 'Developing Trade Transparency Portal', 'Digital Platform', 4, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(14, 4, 'Online Export Performance Management System', 'Technology', 5, '2026-04-21 21:44:13', '2026-04-21 21:44:13'),
(15, 11, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(16, 11, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(17, 11, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:16:06', '2026-04-21 22:16:06'),
(18, 5, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:18:29', '2026-04-21 22:18:29'),
(19, 5, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:18:29', '2026-04-21 22:18:29'),
(20, 5, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 22:18:29', '2026-04-21 22:18:29'),
(21, 7, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(22, 7, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(23, 7, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(24, 7, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(25, 7, 'Developing Trade Transparency Portal', 'Digital Platform', 4, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(26, 7, 'Online Export Performance Management System', 'Technology', 5, '2026-04-21 22:20:11', '2026-04-21 22:20:11'),
(27, 8, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(28, 8, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(29, 8, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(30, 8, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(31, 8, 'Developing Trade Transparency Portal', 'Digital Platform', 4, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(32, 8, 'Online Export Performance Management System', 'Technology', 5, '2026-04-21 22:21:12', '2026-04-21 22:21:12'),
(33, 9, 'Online Pre-Arrival Processing System', 'Digital Platform', 0, '2026-04-21 22:21:48', '2026-04-21 22:21:48'),
(34, 9, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:21:48', '2026-04-21 22:21:48'),
(35, 9, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:21:48', '2026-04-21 22:21:48'),
(36, 9, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 22:21:48', '2026-04-21 22:21:48'),
(37, 9, 'Developing Trade Transparency Portal', 'Digital Platform', 4, '2026-04-21 22:21:48', '2026-04-21 22:21:48'),
(38, 10, 'Automated Risk Management System', 'Technology', 0, '2026-04-21 22:22:20', '2026-04-21 22:22:20'),
(39, 10, 'Automated Risk Management System', 'Technology', 1, '2026-04-21 22:22:20', '2026-04-21 22:22:20'),
(40, 10, 'Authorized Economic Operator Facilities', 'Certification', 2, '2026-04-21 22:22:20', '2026-04-21 22:22:20'),
(41, 10, 'Conducting Time Release Study (TRS)', 'Assessment', 3, '2026-04-21 22:22:20', '2026-04-21 22:22:20');

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
('YuvpJNnXVIhteQA2VG8S7Qxp9o7w3SK3AYw0fTOK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNG5WTUlSQ2VYUGpMdVZNUEc3YWxkZ0pIRnYyUmE1ZVFOa0htRVdaeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFtIjtzOjU6InJvdXRlIjtzOjQ6InRlYW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcGFydG5lcnMiO31zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1777276668);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_text` varchar(255) DEFAULT NULL,
  `logo_tagline` varchar(255) DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `footer_contact_mobile` varchar(255) DEFAULT NULL,
  `footer_contact_email` varchar(255) DEFAULT NULL,
  `footer_contact_location` text DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo_text`, `logo_tagline`, `social_links`, `footer_contact_mobile`, `footer_contact_email`, `footer_contact_location`, `footer_description`, `created_at`, `updated_at`) VALUES
(1, 'TRACE', 'Insight. Strategy. Impact', '[{\"title\":\"Facebook\",\"link\":\"https:\\/\\/www.facebook.com\\/TRACEConsultingbd\\/\",\"media_key\":\"216edf82-1a70-4acf-aa7d-41d890d4b5e8\"},{\"title\":\"Twitter\",\"link\":\"https:\\/\\/www.linkedin.com\\/company\\/trace-consulting-limited-firm\\/\",\"media_key\":\"85ac2c92-0fdd-4bfc-843a-6104b894689b\"}]', '+880 1715-056952', 'contact@traceconsultingltd.com', 'Level 2, Plot 285, Road 19/C, New DOHS, Dhaka , Bangladesh.', 'Trace Consulting Limited provides strategic\r\nadvisory, technical assistance, and digital\r\nsolutions to governments and development\r\norganisations across South Asia.', '2026-04-21 03:22:47', '2026-04-27 05:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `design_word` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `tagline`, `title`, `description`, `design_word`, `created_at`, `updated_at`) VALUES
(1, 'International Development Consulting', 'Empowering Change through Insightful Consulting', '<p>Trace Consulting partners with governments, regulatory agencies, and development organizations to reform systems, build capacity, and deliver technology that lasts.</p>', 'Insightful', '2026-04-21 03:31:17', '2026-04-27 05:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `headtitle` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `first_name`, `last_name`, `designation`, `short_description`, `description`, `type`, `headtitle`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Fuad M Khalid', 'Hossen', 'Managing Director & Chief Executive Officer', 'Fuad brings over 15 years of hands-on experience in trade facilitation, customs\r\nmodernisation, and development consulting across South and Southeast Asia. He\r\nholds an official MoU with B-ADVANCY Certification Ltd, UK, and has personally led\r\nWTO TFA implementation advisory, ISO/IEC 17025 laboratory accreditation\r\nprogrammes, and digital trade infrastructure projects across the region.', 'Fuad M Khalid Hossen, currently serving as Managing Director and CEO of TRACE Consulting, is widely recognized as Bangladesh’s leading expert in digital trade facilitation and trade policy reform, with over 12 years of experience in system modernization, export-led growth, and regulatory reform. He has demonstrated strong technical leadership in advancing WTO Trade Facilitation Agreement (TFA) measures, trade service automation, and institutional capacity building across public and private sectors. Most recently, Fuad led the $32.4 million USDA-funded Bangladesh Trade Facilitation Project as Deputy Chief of Party and Technical Lead, driving national reforms to modernize cross-border trade with a focus on food and agriculture. He collaborated directly with over 50 public and private entities, including the Ministry of Commerce, National Board of Revenue, BSTI, DLS, DoF, DAE, trade-related laboratories, and other SPS and standards agencies, as well as FBCCI and several sectoral chambers. Under his leadership, the project delivered more than 30 policy and regulatory reforms spanning Export and Import Policies, SPS and quarantine regulations, Customs rules, the TCL framework, and the Veterinary Drug Act. It also deployed 14 automated trade-service IT systems, enabling the digital issuance of over one million certificates, licenses, and permits (CLPs) annually. Fuad also supported the government in establishing seven specialized trade units and risk management systems, which are expected to replace blanket inspections with risk-based clearance across key border agencies. He helped upgrade 12 laboratories, including the establishment of the National Halal Laboratory at BSTI, and introduced over 10 export compliance protocols, covering contract farming automation, traceability, good production practices, national residue control plans, and e-health certification, to strengthen SPS compliance and export readiness. His leadership enabled government agencies to submit formal notifications to the WTO, enhancing transparency and reinforcing Bangladesh’s credibility within the multilateral trading system. Earlier, as a Trade Facilitation Consultant with the IFC–World Bank Group, Fuad contributed to large-scale trade reform initiatives, including the Online Licensing Module (OLM) for CCI&E, the Bangladesh National Single Window, tariff reforms, and Customs modernization, initiatives that strengthened WTO TFA compliance and improved Bangladesh’s ease-of-doing-business ranking. He also played technical and leadership roles in multiple FCDO-funded programs, focusing on automation, export diversification, and regulatory simplification. Fuad holds a Bachelor’s degree in Public Administration and a Master’s degree in Public Administration, specializing in Public Policy, from Jahangirnagar University. He is passionate about leveraging technology and policy innovation to enhance Bangladesh’s export competitiveness and strengthen the country’s integration into the global trading system.', '1', NULL, 1, '2026-04-22 22:58:59', '2026-04-27 05:04:23'),
(3, 'ASM', 'Saifullah', 'Senior Trade Policy Specialist', NULL, '10+ years advising governments and development agencies on WTO compliance, trade policy…', '1', NULL, 2, '2026-04-22 23:07:04', '2026-04-22 23:07:04'),
(5, 'Tahsina', 'Shiva', 'Technology Solutions Lead', 'Full-stack developer and systems\r\narchitect specialising in LIMS,\r\ntrade single window platforms,…\r\nand customs automation for\r\ngovernment agencies.', 'A full-stack developer and systems architect specializing in Laboratory Information Management Systems (LIMS), trade single window platforms, and customs automation plays a critical role in modernizing government operations and enabling efficient cross-border trade. With expertise spanning both frontend and backend development, this professional designs, develops, and deploys scalable digital solutions tailored to complex regulatory environments.\r\nTheir work often involves building integrated platforms that connect multiple government agencies, allowing seamless data exchange and real-time processing of trade-related documents such as certificates, licenses, and permits. In LIMS, they develop systems that streamline laboratory workflows, ensure data accuracy, and support compliance with international standards. These systems are essential for maintaining quality assurance, traceability, and transparency in sectors like food safety, agriculture, and public health.\r\nIn the domain of trade single window platforms, they architect centralized systems that enable traders to submit documentation through a single interface, significantly reducing processing time and administrative burden. By integrating customs, port authorities, standards bodies, and other regulatory agencies, they help create a unified digital ecosystem that improves efficiency and transparency.\r\nTheir expertise in customs automation includes designing risk management systems, electronic clearance processes, and automated inspection protocols. These innovations replace manual, time-consuming procedures with intelligent, data-driven workflows that enhance compliance while facilitating faster trade.\r\nTechnically, they are proficient in modern programming languages, cloud infrastructure, API integration, database management, and cybersecurity practices. Beyond technical skills, they possess a deep understanding of policy frameworks, regulatory requirements, and international trade agreements, enabling them to align technology solutions with national development goals.\r\nOverall, their work contributes significantly to digital transformation, institutional capacity building, and the creation of a more competitive and globally integrated trade environment.', '1', NULL, 3, '2026-04-22 23:44:29', '2026-04-27 06:11:26'),
(6, 'Nabeel', 'Khan', 'Laboratory Quality Specialist', NULL, 'ISO/IEC 17025 accreditation expert guiding public and private laboratories through QMS… development and assessment preparation.', '1', NULL, 4, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(9, 'Md. Mahbubul', 'Alam', 'Research & Assessments Lead', NULL, 'Economist and trade researcher with expertise in trade facilitation assessments, value chain… analysis, and M&E framework development.', '1', NULL, 5, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(10, 'Tanvir', 'Kabir', 'Capacity Building Coordinator', NULL, 'Training design and facilitation specialist delivering programmes for customs officials, lab technicians, and private sector', '1', NULL, 6, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(11, 'Mobarak Uddin', 'Ahmed', 'Cold Chain & Logistics Specialist', NULL, 'Temperature-controlled logistics expert advising exporters and pharmaceutical companies on… cold chain infrastructure and', '1', NULL, 7, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(12, 'Md. Mahmudur', 'Rahman', 'Project Manager', NULL, 'PMP-certified project manager overseeing multi-donor trade reform engagements with a… consistent track record of on- time, on-budget delivery.', '1', NULL, 8, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(13, 'Mimma', 'Afrin', 'Technical Lead, Laboratory Operations', NULL, 'Data analyst and portal developer specialising in HS code databases, trade transparency…', '1', NULL, 9, '2026-04-23 00:22:36', '2026-04-23 00:23:25'),
(14, 'Michael J Parr', NULL, 'Trade Economics & WTO Law Specialist', NULL, 'Former WTO dispute settlement consultant with 20+ years of expertise in trade law, multilateral negotiations,...', '2', NULL, 1, '2026-04-23 00:28:55', '2026-04-23 01:02:29'),
(15, 'Nittya Ranjan Biswas', NULL, 'Aquaculture and Sanitary Compliance Systems', NULL, 'ISO/IEC 17025 lead assessor with 18 years of QMS implementation and food safety testing expertise. Supports TR...\r\n\r\n\r\nFuad M Khalid Hossen, currently serving as Managing Director and CEO of TRACE Consulting, is widely recognized as Bangladesh’s leading expert in digital trade facilitation and trade policy reform, with over 12 years of experience in system modernization, export-led growth, and regulatory reform. He has demonstrated strong technical leadership in advancing WTO Trade Facilitation Agreement (TFA) measures, trade service automation, and institutional capacity building across public and private sectors.\r\n\r\nMost recently, Fuad led the $32.4 million USDA-funded Bangladesh Trade Facilitation Project as Deputy Chief of Party and Technical Lead, driving national reforms to modernize cross-border trade with a focus on food and agriculture. He collaborated directly with over 50 public and private entities, including the Ministry of Commerce, National Board of Revenue, BSTI, DLS, DoF, DAE, trade-related laboratories, and other SPS and standards agencies, as well as FBCCI and several sectoral chambers.\r\n\r\nUnder his leadership, the project delivered more than 30 policy and regulatory reforms spanning Export and Import Policies, SPS and quarantine regulations, Customs rules, the TCL framework, and the Veterinary Drug Act. It also deployed 14 automated trade-service IT systems, enabling the digital issuance of over one million certificates, licenses, and permits (CLPs) annually. Fuad also supported the government in establishing seven specialized trade units and risk management systems, which are expected to replace blanket inspections with risk-based clearance across key border agencies. He helped upgrade 12 laboratories, including the establishment of the National Halal Laboratory at BSTI, and introduced over 10 export compliance protocols, covering contract farming automation, traceability, good production practices, national residue control plans, and e-health certification, to strengthen SPS compliance and export readiness. His leadership enabled government agencies to submit formal notifications to the WTO, enhancing transparency and reinforcing Bangladesh’s credibility within the multilateral trading system.\r\n\r\nEarlier, as a Trade Facilitation Consultant with the IFC–World Bank Group, Fuad contributed to large-scale trade reform initiatives, including the Online Licensing Module (OLM) for CCI&E, the Bangladesh National Single Window, tariff reforms, and Customs modernization, initiatives that strengthened WTO TFA compliance and improved Bangladesh’s ease-of-doing-business ranking. He also played technical and leadership roles in multiple FCDO-funded programs, focusing on automation, export diversification, and regulatory simplification.\r\n\r\nFuad holds a Bachelor’s degree in Public Administration and a Master’s degree in Public Administration, specializing in Public Policy, from Jahangirnagar University. He is passionate about leveraging technology and policy innovation to enhance Bangladesh’s export competitiveness and strengthen the country’s integration into the global trading system.', '2', NULL, 2, '2026-04-23 00:31:54', '2026-04-24 09:33:35'),
(16, 'Syed Rezaul Karim', NULL, 'Customs Reform & Modernisation Specialist', NULL, 'Retired senior customs official with 25 years of operational experience at the National Board of Revenue. Advi...', '2', NULL, 3, '2026-04-23 00:33:24', '2026-04-23 01:05:26'),
(17, 'Dr. Tahmina Akter', NULL, 'Development Economics & M&E Specialist', NULL, 'Specialises in results-based evaluation of trade and development programmes. Leads TRACE\'s monitoring, evaluat...', '2', NULL, 4, '2026-04-23 00:36:44', '2026-04-23 01:06:32'),
(18, 'Kazi Mahbubur Rahman', NULL, 'Cold Chain Infrastructure & Logistics Specialist', NULL, '30 years of private sector experience in agricultural supply chains and refrigerated logistics. Advises TRACE...', '2', NULL, 5, '2026-04-23 00:39:30', '2026-04-23 01:07:10'),
(19, 'Dr. Imran Chowdhury', NULL, 'Digital Trade & e-Government Systems Expert', NULL, 'Expert in e-government system architecture and digital trade platform design. Advises TRACE on technical speci...', '2', NULL, 6, '2026-04-23 00:41:39', '2026-04-23 01:07:36');

-- --------------------------------------------------------

--
-- Table structure for table `team_expertises`
--

CREATE TABLE `team_expertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_expertises`
--

INSERT INTO `team_expertises` (`id`, `team_id`, `heading`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Trade Facilitation & Customs', 'WTO TFA implementation, customs automation, risk management, AEO programmes, time release studies.', 0, '2026-04-22 22:58:59', '2026-04-22 23:03:01'),
(2, 2, 'Policy Reform & Advocacy', 'Legislative review, policy gap analysis, stakeholder consultation, trade bottleneck identification.', 1, '2026-04-22 22:58:59', '2026-04-22 22:58:59'),
(3, 2, 'Digital Trade Systems', 'Single window development, LIMS, trade transparency portals, customs automation, HS code databases.', 2, '2026-04-22 22:58:59', '2026-04-22 22:58:59'),
(4, 3, 'WTO TFA', 'WTO TFA implementation, customs automation, risk management, AEO programmes, time release studies.', 0, '2026-04-22 23:07:04', '2026-04-22 23:07:04'),
(5, 3, 'Policy Reform', 'Legislative review, policy gap analysis, stakeholder consultation, trade bottleneck identification.', 1, '2026-04-22 23:07:04', '2026-04-22 23:07:04'),
(6, 3, 'Advocacy', 'als, customs automation, HS code databases.', 2, '2026-04-22 23:07:04', '2026-04-22 23:07:04'),
(10, 5, 'LIMS', '', 0, '2026-04-22 23:44:29', '2026-04-22 23:44:29'),
(11, 5, 'Single Window', '', 1, '2026-04-22 23:44:29', '2026-04-22 23:44:29'),
(12, 5, 'Systems', '', 2, '2026-04-22 23:44:29', '2026-04-22 23:44:29'),
(13, 6, 'ISO 17025', '', 0, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(14, 6, 'QMS', '', 1, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(15, 6, 'Accreditation', '', 2, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(18, 9, 'Research', '', 0, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(19, 9, 'M&E', '', 1, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(20, 9, 'Economics', '', 2, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(21, 10, 'Training', '', 0, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(22, 10, 'Facilitation', '', 1, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(23, 10, 'Curriculum', '', 2, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(24, 11, 'Cold Chain', '', 0, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(25, 11, 'Logistics', '', 1, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(26, 11, 'Compliance', '', 2, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(27, 12, 'PMP', '', 0, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(28, 12, 'Donor Reporting', '', 1, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(29, 12, 'RBM', '', 2, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(30, 13, 'Data Systems', '', 0, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(31, 13, 'HS Codes', '', 1, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(32, 13, 'Portal Dev', '', 2, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(33, 14, 'WTO Law', '', 0, '2026-04-23 00:28:56', '2026-04-23 00:28:56'),
(34, 14, 'Trade Economics', '', 1, '2026-04-23 00:28:56', '2026-04-23 00:28:56'),
(35, 14, 'LDC Policy', '', 2, '2026-04-23 00:28:56', '2026-04-23 00:28:56'),
(36, 15, 'ISO 17025', '', 0, '2026-04-23 00:31:54', '2026-04-23 00:31:54'),
(37, 15, 'Food Safety', '', 1, '2026-04-23 00:31:54', '2026-04-23 00:31:54'),
(38, 15, 'QMS', '', 2, '2026-04-23 00:31:54', '2026-04-23 00:31:54'),
(39, 16, 'Customs', '', 0, '2026-04-23 00:33:24', '2026-04-23 00:33:24'),
(40, 16, 'NBR Systems', '', 1, '2026-04-23 00:33:24', '2026-04-23 00:33:24'),
(41, 16, 'Risk Mgmt', '', 2, '2026-04-23 00:33:24', '2026-04-23 00:33:24'),
(42, 17, 'Development Economics', '', 0, '2026-04-23 00:36:44', '2026-04-23 00:36:44'),
(43, 17, 'M&E', '', 1, '2026-04-23 00:36:44', '2026-04-23 00:36:44'),
(44, 17, 'Impact Evaluation', '', 2, '2026-04-23 00:36:44', '2026-04-23 00:36:44'),
(45, 18, 'Cold Chain', '', 0, '2026-04-23 00:39:30', '2026-04-23 00:39:30'),
(46, 18, 'Agro-ExportSupply Chain', '', 1, '2026-04-23 00:39:30', '2026-04-23 00:39:30'),
(47, 19, 'e-Government', '', 0, '2026-04-23 00:41:39', '2026-04-23 00:41:39'),
(48, 19, 'Single Window', '', 1, '2026-04-23 00:41:39', '2026-04-23 00:41:39'),
(49, 19, 'System Design', '', 2, '2026-04-23 00:41:39', '2026-04-23 00:41:39'),
(50, 5, 'Scrum', 'Scrum Master', 3, '2026-04-23 03:56:19', '2026-04-23 03:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `team_project_table`
--

CREATE TABLE `team_project_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_project_table`
--

INSERT INTO `team_project_table` (`id`, `project_id`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 3, 5, NULL, NULL),
(3, 1, 6, NULL, NULL),
(4, 7, 9, NULL, NULL),
(5, 5, 10, NULL, NULL),
(6, 4, 11, NULL, NULL),
(7, 5, 11, NULL, NULL),
(8, 4, 12, NULL, NULL),
(9, 5, 12, NULL, NULL),
(10, 6, 12, NULL, NULL),
(11, 3, 13, NULL, NULL),
(12, 5, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_social_media`
--

CREATE TABLE `team_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `social_link` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_social_media`
--

INSERT INTO `team_social_media` (`id`, `team_id`, `title`, `social_link`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 'Linkdin', '', 0, '2026-04-22 22:58:59', '2026-04-22 22:58:59'),
(2, 2, 'Email', '', 1, '2026-04-22 23:01:44', '2026-04-22 23:01:44'),
(3, 2, 'Twiter', '', 2, '2026-04-22 23:01:44', '2026-04-22 23:01:44'),
(8, 5, 'Linkdin', '', 0, '2026-04-22 23:44:29', '2026-04-22 23:44:29'),
(10, 6, 'Linkdin', '', 0, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(11, 6, 'Email', '', 1, '2026-04-22 23:49:47', '2026-04-22 23:49:47'),
(14, 9, 'Linkdin', '', 0, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(15, 9, 'Email', '', 1, '2026-04-23 00:15:05', '2026-04-23 00:15:05'),
(16, 10, 'Linkdin', '', 0, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(17, 10, 'Email', '', 1, '2026-04-23 00:16:49', '2026-04-23 00:16:49'),
(18, 11, 'Linkdin', '', 0, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(19, 11, 'Email', '', 1, '2026-04-23 00:18:50', '2026-04-23 00:18:50'),
(20, 12, 'Linkdin', '', 0, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(21, 12, 'Email', '', 1, '2026-04-23 00:20:49', '2026-04-23 00:20:49'),
(22, 13, 'Linkdin', '', 0, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(23, 13, 'Email', '', 1, '2026-04-23 00:22:36', '2026-04-23 00:22:36'),
(34, 19, 'Linkdin', '', 0, '2026-04-23 00:41:40', '2026-04-23 00:41:40'),
(35, 19, 'Email', '', 1, '2026-04-23 00:41:40', '2026-04-23 00:41:40'),
(41, 5, 'Email', '', 1, '2026-04-24 09:58:45', '2026-04-24 09:58:45'),
(44, 3, 'Linkdin', '', 0, '2026-04-24 19:17:56', '2026-04-24 19:18:43'),
(45, 3, 'Email', '', 1, '2026-04-24 19:18:44', '2026-04-24 19:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `status`, `email_verified_at`, `mobile_verified_at`, `otp`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Laurel Noel', 'sidype@mailinator.com', '01568359528', 1, NULL, NULL, '647794', '$2y$12$cuQGZRraEoxS6WLa7XuReeyKoU1mNI/DmrjPxtmXbR9P1Kag87Mxq', NULL, '2025-01-09 16:16:06', '2025-01-09 17:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `upazila_id` bigint(20) UNSIGNED DEFAULT NULL,
  `union_id` bigint(20) UNSIGNED DEFAULT NULL,
  `education_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profession_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `full_address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `is_autism` tinyint(1) DEFAULT 1 COMMENT '1:normal,0:disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `division_id`, `district_id`, `upazila_id`, `union_id`, `education_type_id`, `profession_id`, `gender_id`, `country_id`, `religion_id`, `nid`, `passport`, `birth_certificate`, `full_address`, `dob`, `is_autism`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-01-09 16:16:06', '2025-01-09 16:16:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contact_infos`
--
ALTER TABLE `contact_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contents_slug_unique` (`slug`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_types`
--
ALTER TABLE `education_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insights`
--
ALTER TABLE `insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insights_active_sort_order_index` (`active`,`sort_order`),
  ADD KEY `insights_type_index` (`type`);

--
-- Indexes for table `insight_articles`
--
ALTER TABLE `insight_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insight_articles_insight_id_sort_order_index` (`insight_id`,`sort_order`),
  ADD KEY `insight_articles_author_team_id_sort_order_index` (`author_team_id`,`sort_order`),
  ADD KEY `insight_articles_type_index` (`type`);

--
-- Indexes for table `insight_types`
--
ALTER TABLE `insight_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_posting_id_foreign` (`job_posting_id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_sort_order_index` (`sort_order`),
  ADD KEY `projects_project_status_index` (`project_status`);

--
-- Indexes for table `project_locations`
--
ALTER TABLE `project_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_locations_project_id_sort_order_index` (`project_id`,`sort_order`);

--
-- Indexes for table `project_outcomes`
--
ALTER TABLE `project_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_outcomes_project_id_sort_order_index` (`project_id`,`sort_order`);

--
-- Indexes for table `project_phase_details`
--
ALTER TABLE `project_phase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_phase_details_project_id_sort_order_index` (`project_id`,`sort_order`);

--
-- Indexes for table `project_services`
--
ALTER TABLE `project_services`
  ADD PRIMARY KEY (`project_id`,`service_id`),
  ADD KEY `project_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`),
  ADD KEY `services_content_id_foreign` (`content_id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_details_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_product_solutions`
--
ALTER TABLE `service_product_solutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_product_solutions_service_id_foreign` (`service_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_sort_order_index` (`sort_order`);

--
-- Indexes for table `team_expertises`
--
ALTER TABLE `team_expertises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_experties_team_id_sort_order_index` (`team_id`,`sort_order`);

--
-- Indexes for table `team_project_table`
--
ALTER TABLE `team_project_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_project_table_project_id_team_id_unique` (`project_id`,`team_id`),
  ADD KEY `team_project_table_team_id_foreign` (`team_id`);

--
-- Indexes for table `team_social_media`
--
ALTER TABLE `team_social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_social_media_team_id_sort_order_index` (`team_id`,`sort_order`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_details_nid_unique` (`nid`),
  ADD UNIQUE KEY `user_details_passport_unique` (`passport`),
  ADD UNIQUE KEY `user_details_birth_certificate_unique` (`birth_certificate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_infos`
--
ALTER TABLE `contact_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `education_types`
--
ALTER TABLE `education_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insights`
--
ALTER TABLE `insights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `insight_articles`
--
ALTER TABLE `insight_articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insight_types`
--
ALTER TABLE `insight_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_locations`
--
ALTER TABLE `project_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_outcomes`
--
ALTER TABLE `project_outcomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `project_phase_details`
--
ALTER TABLE `project_phase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `service_product_solutions`
--
ALTER TABLE `service_product_solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `team_expertises`
--
ALTER TABLE `team_expertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `team_project_table`
--
ALTER TABLE `team_project_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `team_social_media`
--
ALTER TABLE `team_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `insight_articles`
--
ALTER TABLE `insight_articles`
  ADD CONSTRAINT `insight_articles_author_team_id_foreign` FOREIGN KEY (`author_team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `insight_articles_insight_id_foreign` FOREIGN KEY (`insight_id`) REFERENCES `insights` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_posting_id_foreign` FOREIGN KEY (`job_posting_id`) REFERENCES `job_postings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_locations`
--
ALTER TABLE `project_locations`
  ADD CONSTRAINT `project_locations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_outcomes`
--
ALTER TABLE `project_outcomes`
  ADD CONSTRAINT `project_outcomes_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_phase_details`
--
ALTER TABLE `project_phase_details`
  ADD CONSTRAINT `project_phase_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_services`
--
ALTER TABLE `project_services`
  ADD CONSTRAINT `project_services_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_details`
--
ALTER TABLE `service_details`
  ADD CONSTRAINT `service_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_product_solutions`
--
ALTER TABLE `service_product_solutions`
  ADD CONSTRAINT `service_product_solutions_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_expertises`
--
ALTER TABLE `team_expertises`
  ADD CONSTRAINT `team_experties_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_project_table`
--
ALTER TABLE `team_project_table`
  ADD CONSTRAINT `team_project_table_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_project_table_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_social_media`
--
ALTER TABLE `team_social_media`
  ADD CONSTRAINT `team_social_media_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
