-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 03:33 AM
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
-- Database: `perpustakaanmhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idbuku` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `judul` varchar(500) NOT NULL,
  `pengarang` varchar(200) NOT NULL,
  `idkategori` bigint(20) UNSIGNED NOT NULL,
  `status_buku` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idbuku`, `kode`, `judul`, `pengarang`, `idkategori`, `status_buku`, `created_at`, `updated_at`) VALUES
(4, 'NV-01', 'Home Sweet Loan', 'Almira Bastari', 1, '1', NULL, '2024-09-30 23:45:10'),
(5, 'BO-01', 'Mohammad Hatta, Untuk Negeriku', 'Taufik Abdullah', 2, '1', NULL, '2024-09-30 23:54:41'),
(6, 'NV-02', 'Keajaiban Toko Kelontong Namiya', 'Keigo Higashino', 1, '1', NULL, '2024-09-18 00:22:52');

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
-- Table structure for table `jenis_user`
--

CREATE TABLE `jenis_user` (
  `id_jenis_user` varchar(30) NOT NULL,
  `jenis_user` varchar(60) NOT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `delete_mark` char(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_user`
--

INSERT INTO `jenis_user` (`id_jenis_user`, `jenis_user`, `create_by`, `update_by`, `delete_mark`, `create_date`, `update_date`) VALUES
('1', 'admin', NULL, NULL, '0', '2024-09-16 03:22:14', NULL),
('2', 'penjaga_perpus', NULL, NULL, '0', '2024-09-16 03:22:14', NULL),
('3', 'mahasiswa', NULL, NULL, '0', '2024-09-16 03:22:14', NULL);

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Novel', NULL, NULL),
(2, 'Biografi', NULL, NULL),
(3, 'Komik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` varchar(30) NOT NULL,
  `id_level` varchar(30) DEFAULT NULL,
  `menu_name` varchar(300) NOT NULL,
  `menu_link` varchar(300) NOT NULL,
  `menu_icon` varchar(300) DEFAULT NULL,
  `parent_id` varchar(30) DEFAULT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `delete_mark` char(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `id_level`, `menu_name`, `menu_link`, `menu_icon`, `parent_id`, `create_by`, `update_by`, `delete_mark`, `create_date`, `update_date`) VALUES
('1', '1', 'Manage Users', 'users.index', 'icon-head', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('10', NULL, 'Setting Relasi', 'settingmenu.index', 'mdi mdi-access-point-network', NULL, 'admin', NULL, '0', '2024-09-25 03:25:01', NULL),
('11', NULL, 'Dashboard', 'dashboardadm', 'icon-grid', NULL, 'admin', NULL, '0', '2024-09-25 12:52:37', NULL),
('12', NULL, 'Dashboard', 'dashboardpjg', 'icon-grid', NULL, 'admin', NULL, '0', '2024-09-25 12:54:29', NULL),
('13', NULL, 'Dashboard', 'dashboardmhs', 'icon-grid', NULL, 'admin', NULL, '0', '2024-09-25 12:55:02', NULL),
('14', NULL, 'Email', 'inbox', 'mdi mdi-account-box-outline', NULL, 'admin', NULL, '0', '2024-09-29 08:37:16', NULL),
('3', '2', 'Manage Buku', 'buku.index', 'mdi mdi-book-plus', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('4', '2', 'Manage Kategori', 'kategori.index', 'mdi mdi-apps', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('5', '2', 'Peminjaman', 'peminjaman.index', 'mdi mdi-account-box-outline', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('6', '3', 'Buku', 'mahasiswa.buku.index', 'mdi mdi-book-plus', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('7', '3', 'Riwayat Peminjaman', 'mahasiswa.peminjaman.index', 'icon-paper', NULL, NULL, 'admin', '0', '2024-09-16 04:22:32', NULL),
('8', NULL, 'Manage Menu', 'managemenu.index', 'mdi mdi-apps', NULL, 'admin', 'admin', '0', '2024-09-25 02:44:31', NULL),
('9', NULL, 'Manage Role', 'jenisuser.index', 'mdi mdi-account-convert', NULL, 'admin', 'admin', '0', '2024-09-25 03:24:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_level`
--

CREATE TABLE `menu_level` (
  `id_level` varchar(30) NOT NULL,
  `level` varchar(60) NOT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `delete_mark` char(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_level`
--

INSERT INTO `menu_level` (`id_level`, `level`, `create_by`, `update_by`, `delete_mark`, `create_date`, `update_date`) VALUES
('1', 'Admin', NULL, NULL, '0', '2024-09-16 04:22:32', NULL),
('2', 'Penjaga Perpus', NULL, NULL, '0', '2024-09-16 04:22:32', NULL),
('3', 'Mahasiswa', NULL, NULL, '0', '2024-09-16 04:22:32', NULL);

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
(4, '2024_09_16_030404_create_jenis_user', 2),
(5, '2024_09_16_025130_create_user_table', 3),
(6, '2024_09_16_025826_create_menu_level', 4),
(7, '2024_09_16_025719_create_menu', 5),
(8, '2024_09_16_025538_create_setting_menu_user', 6),
(9, '2024_09_16_032611_create_kategori', 7),
(10, '2024_09_16_032624_create_buku', 7),
(11, '2024_09_16_032633_peminjaman', 7),
(13, '2024_09_16_084849_edit_user', 8),
(14, '2024_09_18_004811_update_buku_and_peminjaman_tables', 8),
(15, '2024_09_18_015112_add_verification_to_peminjaman_table', 9),
(16, '2024_09_18_023053_edit_peminjamannn', 10),
(17, '2024_09_18_032733_update_status_enum_in_peminjaman_table', 11),
(18, '2024_09_18_064455_editrelasi', 12),
(19, '2024_09_19_000508_create_personal_access_tokens_table', 13),
(20, '2024_09_29_075854_message', 14),
(21, '2024_09_29_085440_massageee', 15),
(22, '2024_09_29_090146_messageto', 16),
(23, '2024_09_30_031243_msagetoo', 17);

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
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idpeminjaman` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `idbuku` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan','menunggu_verifikasi') NOT NULL DEFAULT 'menunggu_verifikasi',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idpeminjaman`, `id_user`, `idbuku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `is_verified`, `created_at`, `updated_at`) VALUES
(5, 1, 4, '2024-09-18', '2024-09-18', 'dikembalikan', 1, NULL, NULL),
(7, 1, 6, '2024-09-18', '2024-09-18', 'dikembalikan', 1, NULL, NULL),
(9, 1, 4, '2024-09-27', '2024-09-25', 'dikembalikan', 1, NULL, NULL),
(10, 1, 4, '2024-09-29', '2024-09-29', 'dikembalikan', 1, NULL, NULL),
(11, 1, 4, '2024-10-01', '2024-10-01', 'dikembalikan', 1, NULL, NULL),
(12, 1, 5, '2024-10-01', '2024-10-01', 'dikembalikan', 1, NULL, NULL);

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
('NXx5zoa4nf2UJd7JgsYNO9udkF4rptIeK3xpNhoc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZE1xdTBRbkZnbUh3ZGNONjB2N0VkUlpOUnY3Zkhmb1l6SjJQWEIyQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWFkLW1lc3NhZ2UvMTkiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1727746391);

-- --------------------------------------------------------

--
-- Table structure for table `setting_menu_user`
--

CREATE TABLE `setting_menu_user` (
  `no_setting` varchar(30) NOT NULL,
  `id_jenis_user` varchar(30) NOT NULL,
  `menu_id` varchar(30) NOT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `delete_mark` char(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_menu_user`
--

INSERT INTO `setting_menu_user` (`no_setting`, `id_jenis_user`, `menu_id`, `create_by`, `update_by`, `delete_mark`, `create_date`, `update_date`) VALUES
('adm-1', '1', '11', 'admin', 'admin', '0', '2024-09-25 12:55:39', NULL),
('adm-2', '1', '1', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('adm-3', '1', '9', 'admin', 'admin', '0', '2024-09-25 03:36:27', NULL),
('adm-4', '1', '8', 'admin', 'admin', '0', '2024-09-25 02:45:27', NULL),
('adm-5', '1', '10', 'admin', 'admin', '0', '2024-09-25 03:36:41', NULL),
('adm-6', '1', '14', 'admin', NULL, '0', '2024-09-29 08:37:43', NULL),
('mhs-1', '3', '13', 'admin', NULL, '0', '2024-09-25 12:58:11', NULL),
('mhs-2', '3', '6', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('mhs-3', '3', '7', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('mhs-4', '3', '14', 'admin', NULL, '0', '2024-09-30 11:44:46', NULL),
('pjg-1', '2', '12', 'admin', 'admin', '0', '2024-09-25 12:57:10', NULL),
('pjg-2', '2', '3', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('pjg-3', '2', '4', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('pjg-4', '2', '5', NULL, 'admin', '0', '2024-09-16 04:25:01', NULL),
('pjg-5', '2', '14', 'admin', NULL, '0', '2024-09-29 09:11:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_user` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `wa` varchar(30) DEFAULT NULL,
  `pin` varchar(30) DEFAULT NULL,
  `id_jenis_user` varchar(30) NOT NULL,
  `status_user` varchar(30) NOT NULL,
  `create_by` varchar(30) DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `delete_mark` char(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `no_hp`, `wa`, `pin`, `id_jenis_user`, `status_user`, `create_by`, `update_by`, `delete_mark`, `create_date`, `update_date`) VALUES
(1, 'Maulana', 'Maulana', '$2y$12$5S9mKpitdyeWl791rjKcDeE46/aY2wr1WzNC1K2QPAnVGdKMB4jAu', 'syahren@gmail.com', NULL, NULL, NULL, '3', 'active', NULL, NULL, '0', '2024-09-16 08:57:16', NULL),
(2, 'admin', 'admin', '$2y$12$aRZkEDwN1H/1mv/bfMygeehHHmdn53pdED7JpSqtSPVHkir2PWhqW', 'admin@gmail.com', NULL, NULL, NULL, '1', 'active', NULL, NULL, '0', '2024-09-17 05:22:02', NULL),
(3, 'pjgperpus', 'pjgperpus', '$2y$12$IS9b3OeykrJQOxTAKeN2LeTja3WcGR7cwcynKQfrtv04prZEH2hUG', 'pjgperpus@gmail.com', NULL, NULL, NULL, '2', 'active', NULL, NULL, '0', '2024-09-17 05:22:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-09-15 21:21:25', '$2y$12$/BOzN9Pkb7KfAOAO7th.weZEzPMdZx4gAaoc4QsB.uP.7u0sAqTfC', 'GjfvnDSm0X', '2024-09-15 21:21:25', '2024-09-15 21:21:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idbuku`),
  ADD KEY `buku_idkategori_foreign` (`idkategori`);

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
-- Indexes for table `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`id_jenis_user`);

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_id_level_foreign` (`id_level`);

--
-- Indexes for table `menu_level`
--
ALTER TABLE `menu_level`
  ADD PRIMARY KEY (`id_level`);

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
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idpeminjaman`),
  ADD KEY `peminjaman_idbuku_foreign` (`idbuku`),
  ADD KEY `peminjaman_id_user_foreign` (`id_user`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting_menu_user`
--
ALTER TABLE `setting_menu_user`
  ADD PRIMARY KEY (`no_setting`),
  ADD KEY `setting_menu_user_id_jenis_user_foreign` (`id_jenis_user`),
  ADD KEY `setting_menu_user_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD KEY `user_id_jenis_user_foreign` (`id_jenis_user`);

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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idbuku` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idpeminjaman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_idkategori_foreign` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_id_level_foreign` FOREIGN KEY (`id_level`) REFERENCES `menu_level` (`id_level`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_idbuku_foreign` FOREIGN KEY (`idbuku`) REFERENCES `buku` (`idbuku`) ON DELETE CASCADE;

--
-- Constraints for table `setting_menu_user`
--
ALTER TABLE `setting_menu_user`
  ADD CONSTRAINT `setting_menu_user_id_jenis_user_foreign` FOREIGN KEY (`id_jenis_user`) REFERENCES `jenis_user` (`id_jenis_user`),
  ADD CONSTRAINT `setting_menu_user_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_id_jenis_user_foreign` FOREIGN KEY (`id_jenis_user`) REFERENCES `jenis_user` (`id_jenis_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
