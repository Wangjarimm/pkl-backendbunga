-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 05:44 AM
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
-- Database: `va_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2025_04_20_073526_create_siswas_table', 2),
(5, '2025_04_21_044917_create_payments_table', 3),
(6, '2025_04_21_134806_add_username_and_role_to_users_table', 4),
(7, '2025_04_22_051605_add_kelas_and_jurusan_to_payments_table', 5),
(8, '2025_04_22_052231_add_nama_kelas_jurusan_to_payments_table', 6),
(9, '2025_04_23_073005_add_status_and_snap_token_to_payments_table', 7),
(10, '2025_04_23_075515_add_order_id_to_payments_table', 8),
(11, '2025_04_23_082832_create_transaksi_table', 9),
(12, '2025_04_23_084535_add_snap_url_to_transaksis_table', 10);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `va_number` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `tanggal_setor` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `siswa_id`, `nama`, `kelas`, `jurusan`, `va_number`, `note`, `amount`, `tanggal_setor`, `created_at`, `updated_at`, `status`, `snap_token`, `order_id`) VALUES
(2, 5, NULL, NULL, NULL, '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-21 22:13:08', '2025-04-21 22:13:08', 'pending', NULL, NULL),
(4, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-22', '2025-04-21 22:46:06', '2025-04-21 22:46:06', 'pending', NULL, NULL),
(5, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-30', '2025-04-21 22:56:40', '2025-04-21 22:56:40', 'pending', NULL, NULL),
(6, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-22', '2025-04-21 22:59:50', '2025-04-21 22:59:50', 'pending', NULL, NULL),
(7, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-21', '2025-04-21 23:35:39', '2025-04-21 23:35:39', 'pending', NULL, NULL),
(8, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-22', '2025-04-21 23:49:37', '2025-04-21 23:49:37', 'pending', NULL, NULL),
(9, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-22', '2025-04-22 00:03:25', '2025-04-22 00:03:25', 'pending', NULL, NULL),
(10, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', '2025-04-22 23:53:50', '2025-04-22 23:53:50', 'pending', NULL, NULL),
(11, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', '2025-04-22 23:54:00', '2025-04-22 23:54:00', 'pending', NULL, NULL),
(12, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 01:02:16', '2025-04-23 01:02:16', 'pending', NULL, NULL),
(13, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 01:14:49', '2025-04-23 01:14:49', 'pending', NULL, NULL),
(14, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 01:15:02', '2025-04-23 01:15:02', 'pending', NULL, NULL),
(15, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 01:17:07', '2025-04-23 01:17:07', 'pending', NULL, NULL),
(16, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 02:27:56', '2025-04-23 02:27:57', 'pending', 'aeb12f0d-aac2-42de-9f7f-9696ea4a9682', 'ORDER-16-1745400477'),
(17, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 02:29:22', '2025-04-23 02:29:23', 'pending', '7f9921f2-eda8-4efb-b3c0-80336b163502', 'ORDER-17-1745400563'),
(18, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 02:32:39', '2025-04-23 02:32:40', 'pending', 'ac519c7f-3ebf-421a-bbad-113a269de4b5', 'ORDER-18-1745400760'),
(19, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 02:32:58', '2025-04-23 02:32:59', 'pending', '49c445f1-254f-45b9-ac8f-816caeab6021', 'ORDER-19-1745400779'),
(20, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', '2025-04-23 02:50:03', '2025-04-23 02:50:03', 'pending', NULL, NULL),
(21, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', '2025-04-23 04:03:51', '2025-04-23 04:03:51', 'pending', NULL, NULL),
(22, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', '2025-04-23 04:19:33', '2025-04-23 04:19:33', 'pending', NULL, NULL),
(23, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-23', '2025-04-23 04:36:23', '2025-04-23 04:36:23', 'pending', NULL, NULL),
(24, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', '2025-04-23 19:23:25', '2025-04-23 19:23:25', 'pending', NULL, NULL),
(25, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', '2025-04-23 19:23:25', '2025-04-23 19:23:25', 'pending', NULL, NULL),
(26, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', '2025-04-23 19:38:44', '2025-04-23 19:38:44', 'pending', NULL, NULL);

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
('1Uji1PCT90srE3eKdDigg7CBGpxeiUCrBZwnRxkr', NULL, '127.0.0.1', 'PostmanRuntime/7.43.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVpXYXFXYnhWbWpYS3M4SElwNXFoVGxQYnBPUFpBRk5KVHJFenp4bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745243855),
('2taYOebjadaXk3L9syLGPSUgWoLZgigl2rnGuOwK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN29MckJDaWg5a1FQb05HRW81Z3JYMExXY2lMa0dQYUVZVnhPbWpyUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745211941),
('6lHK1X0zoKQGPighHT5ufx5rSg7Idn79371tjodn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3VQWlB2MVBONlpYNncyeDZCZnVYamhtSnNXdDJRa1o0SzdDTlJDNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745298753),
('9jNavtF85q6AbsQ47jYJekqeWK8omAXdSGqG0kqL', NULL, '127.0.0.1', 'PostmanRuntime/7.43.3', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiTURKR0g1MUNkdUNKTXhMM0xoSXVWWGdsWXIwVlE3NExINDlyZHJRTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1744482330),
('j08DTfBMjlFtflYP0dCa2x89Y8oH02GsTlPYzgSK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkNxclM3M3NCMGQ2T3luREJYaDllMWtaZ25qb1hFSTdUeE9XZFpEOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744482810),
('S6PivKeXHwI8MbVJoJoly92ymAvftDPSYiGTgc5K', NULL, '127.0.0.1', 'PostmanRuntime/7.43.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1ZVQ3N2S0dHZ3N0QlU4bUVEM0doV1ZvZ2VLaU82Z2pHNnRZN0hKZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1745298730);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `status_pembayaran` enum('lunas','belum lunas') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `nis`, `nama`, `kelas`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(5, '613220003', 'Bunga Rizka Fadillah', 'X IPA 1', 'lunas', '2025-04-20 22:14:09', '2025-04-21 00:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `va_number` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `tanggal_setor` date NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) DEFAULT NULL,
  `snap_url` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `siswa_id`, `nama`, `kelas`, `jurusan`, `va_number`, `note`, `amount`, `tanggal_setor`, `status`, `snap_token`, `snap_url`, `order_id`, `created_at`, `updated_at`) VALUES
(4, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', 'pending', '28842ead-4372-448a-b914-d2cc97d7688e', 'https://app.sandbox.midtrans.com/snap/snap-token/28842ead-4372-448a-b914-d2cc97d7688e28842ead-4372-448a-b914-d2cc97d7688e', 'ORDER-4-1745399323', '2025-04-23 02:08:42', '2025-04-23 02:08:43'),
(5, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', 'pending', '1f5248e5-5b68-4e50-a2f9-0f032b982a3f', 'https://app.sandbox.midtrans.com/snap/snap-token/1f5248e5-5b68-4e50-a2f9-0f032b982a3f', 'ORDER-5-1745399625', '2025-04-23 02:13:45', '2025-04-23 02:13:46'),
(6, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', 'pending', 'e5df498d-d2b0-49ef-a0ad-b0bc45d8712b', 'https://app.sandbox.midtrans.com/snap/snap-token/e5df498d-d2b0-49ef-a0ad-b0bc45d8712b', 'ORDER-6-1745399939', '2025-04-23 02:18:59', '2025-04-23 02:19:00'),
(7, 5, 'Bunga', 'XII IPS 2', 'IPS', '39010895331942686', 'Pembayaran SPP April', 250000, '2025-04-21', 'pending', '52b1c46e-4787-4bd2-9322-41602f2d3ffd', NULL, 'ORDER-7-1745400804', '2025-04-23 02:33:24', '2025-04-23 02:33:25'),
(8, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', 'pending', 'c4f5e7b0-ca9e-493b-aaf9-d04350570ae7', NULL, 'ORDER-8-1745406614', '2025-04-23 04:10:14', '2025-04-23 04:10:15'),
(9, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', 'pending', '69bc90f9-9c3e-41b2-8077-afb8347b684b', NULL, 'ORDER-9-1745407209', '2025-04-23 04:20:09', '2025-04-23 04:20:10'),
(10, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', 'pending', '2ef9873c-4445-4e5b-b75b-64c0bb6af639', NULL, 'ORDER-10-1745407213', '2025-04-23 04:20:13', '2025-04-23 04:20:14'),
(11, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', 'pending', 'f006c794-5be9-4c9e-bf8e-6f1ba2dc4eac', NULL, 'ORDER-11-1745407280', '2025-04-23 04:21:20', '2025-04-23 04:21:21'),
(12, 5, 'Bunga', 'XII', 'IPA', '39010895331942686', 'SPP Pembayaran April 2025', 500000, '2025-04-23', 'pending', '9aee74c6-38c2-4a26-b16b-306d65a24a54', NULL, 'ORDER-12-1745407469', '2025-04-23 04:24:29', '2025-04-23 04:24:30'),
(13, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-23', 'pending', '6e635c2d-39e1-4099-8ea5-029a2d5aa394', NULL, 'ORDER-13-1745408228', '2025-04-23 04:37:08', '2025-04-23 04:37:09'),
(14, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', 'pending', '3c2ffaa2-db0a-4e1a-9249-61f606780968', NULL, 'ORDER-14-1745461605', '2025-04-23 19:26:45', '2025-04-23 19:26:46'),
(15, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', 'pending', 'd31d793e-1f2d-470e-b9b5-8fd0726ce381', NULL, 'ORDER-15-1745462081', '2025-04-23 19:34:41', '2025-04-23 19:34:42'),
(16, 5, 'Bunga', 'XII IPA 3', 'IPA', '39010895331942686', 'Pembayaran Seragam April 2025', 300000, '2025-04-24', 'pending', 'c8a466f5-b389-4249-93fd-ea8e9e05cf35', NULL, 'ORDER-16-1745462337', '2025-04-23 19:38:57', '2025-04-23 19:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `va` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `va`, `username`, `role`, `password`, `created_at`, `updated_at`) VALUES
(2, '3901089533192687', NULL, 'user', '$2y$12$4TpQTyXxMlERfhddC1kso.yazR1uzpi6.Iqt/xGL/Ql3Iuic8P7SO', '2025-04-20 05:17:33', '2025-04-20 05:17:33'),
(3, '3901089533192685', NULL, 'user', '$2y$12$cOdZ9E2/FCpNWoez5UgsweyZmNtCF.ATp6RkvN8Vt0O/N97oUF7DG', '2025-04-21 00:11:18', '2025-04-21 00:11:18'),
(4, '3901089533192688', NULL, 'user', '$2y$12$gxOt4b7VZirNar8jtNz5oOSizbwf.8yM0nQ/GP4e5tBj1Piz77mpG', '2025-04-21 00:12:55', '2025-04-21 00:12:55'),
(5, NULL, 'john123', 'user', '$2y$12$k/kbtmQbVWv78uKfLH3h0.8Rw9m3rPpIeaVV13OPPJJhlgxSKHgnq', '2025-04-21 06:56:06', '2025-04-21 06:56:06'),
(6, '39010895331926878', NULL, 'user', '$2y$12$fS9Vd9XohS1xH0w5p9IWUuUCgW52O0b1Rzexc6U/9QfCZEkPQ.zre', '2025-04-21 07:04:28', '2025-04-21 07:04:28'),
(7, NULL, 'bunga', 'staff', '$2y$12$JIMlsj9aTqO0US6mv5msge78hpUPXRtA38FhzdZyBXKF0qJR0X7Pu', '2025-04-21 07:23:15', '2025-04-21 07:23:15'),
(9, '39010895331942686', NULL, 'user', '$2y$12$bEYd/pJdnQubiKpS3wIYO.9ih1p2syk0kr06Mal9dxHQx1.iRTDR2', '2025-04-21 07:33:13', '2025-04-21 07:33:13');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_va_unique` (`va`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
