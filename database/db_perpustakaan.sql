-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_perpustakaan
CREATE DATABASE IF NOT EXISTS `db_perpustakaan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_perpustakaan`;

-- Dumping structure for table db_perpustakaan.bukus
CREATE TABLE IF NOT EXISTS `bukus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` year NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukus_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `bukus_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.bukus: ~5 rows (approximately)
INSERT INTO `bukus` (`id`, `judul`, `penulis`, `tahun_terbit`, `kategori_id`, `stok`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Harry Potter', 'J.K. Rowling', '1997', 1, 10, 'bukus/FDktN4RNV9n7sB8tJ4xedfmmCjlECpUvIccQXQzD.jpg', NULL, '2026-04-23 11:13:43', '2026-05-07 16:10:26'),
	(2, 'The Lord of the Rings', 'J.R.R. Tolkien', '1954', 1, 3, 'bukus/N1v29GcvG1NfVlm6ooOQERzvoDKHyjG1h8W0O8NQ.webp', NULL, '2026-04-23 11:13:43', '2026-05-07 16:18:11'),
	(3, 'Sapiens', 'Yuval Noah Harari', '2011', 2, 7, NULL, NULL, '2026-04-23 11:13:43', '2026-04-26 16:52:29'),
	(4, 'Kamus Bahasa Indonesia', 'Tim Penyusun', '2020', 3, 16, NULL, NULL, '2026-04-23 11:13:43', '2026-04-29 15:58:51'),
	(5, 'Atomic Habits', 'James Clear', '2018', 2, 10, NULL, NULL, '2026-04-23 11:13:43', '2026-04-29 16:09:30');

-- Dumping structure for table db_perpustakaan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.jobs: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.kategoris
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.kategoris: ~4 rows (approximately)
INSERT INTO `kategoris` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, 'Fiksi', 'Buku fiksi dan cerita', '2026-04-23 11:13:43', '2026-04-23 11:13:43'),
	(2, 'Non-Fiksi', 'Buku non-fiksi dan pendidikan', '2026-04-23 11:13:43', '2026-04-23 11:13:43'),
	(3, 'Referensi', 'Buku referensi dan kamus', '2026-04-23 11:13:43', '2026-04-23 11:13:43');

-- Dumping structure for table db_perpustakaan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.migrations: ~8 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_02_04_234737_create_siswas_table', 1),
	(5, '2026_02_04_234845_create_kategoris_table', 1),
	(6, '2026_02_04_234856_create_bukus_table', 1),
	(7, '2026_02_04_234903_create_peminjamans_table', 1),
	(8, '2026_04_23_122403_add_denda_to_peminjaman_table', 1),
	(9, '2026_04_23_122421_add_denda_to_peminjaman_table', 1),
	(10, '2026_04_27_000001_add_tanggal_pengembalian_to_peminjaman', 2),
	(11, '2026_04_27_000002_add_gambar_deskripsi_to_bukus', 2);

-- Dumping structure for table db_perpustakaan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_perpustakaan.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `buku_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `denda` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peminjaman_siswa_id_foreign` (`siswa_id`),
  KEY `peminjaman_buku_id_foreign` (`buku_id`),
  KEY `peminjaman_user_id_foreign` (`user_id`),
  CONSTRAINT `peminjaman_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`),
  CONSTRAINT `peminjaman_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`),
  CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.peminjaman: ~9 rows (approximately)
INSERT INTO `peminjaman` (`id`, `siswa_id`, `buku_id`, `user_id`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_pengembalian`, `status`, `denda`, `created_at`, `updated_at`) VALUES
	(2, 2, 2, 2, '2026-02-02', '2026-05-02', NULL, 'dipinjam', 0, '2026-04-23 11:13:43', '2026-04-26 16:51:51'),
	(3, 3, 3, 1, '2026-02-03', '2026-05-12', NULL, 'dipinjam', 0, '2026-04-23 11:13:43', '2026-04-26 16:52:45'),
	(5, 5, 5, 1, '2026-02-05', '2026-05-27', NULL, 'dipinjam', 0, '2026-04-23 11:13:43', '2026-04-26 16:53:26'),
	(7, 3, 2, 1, '2026-04-23', '2026-04-27', NULL, 'dipinjam', 0, '2026-04-23 11:15:41', '2026-04-26 16:52:21'),
	(8, 2, 3, 1, '2026-04-23', '2026-04-30', '2026-04-26', 'dikembalikan', 0, '2026-04-23 11:17:30', '2026-04-26 16:47:16'),
	(9, 4, 5, 1, '2026-04-23', '2026-04-25', NULL, 'dipinjam', 0, '2026-04-23 11:18:02', '2026-04-29 15:44:56'),
	(10, 7, 2, 1, '2026-04-27', '2026-04-28', NULL, 'dipinjam', 0, '2026-04-26 16:54:41', '2026-04-26 16:57:06'),
	(11, 8, 4, 1, '2026-04-20', '2026-04-30', '2026-04-29', 'dikembalikan', 0, '2026-04-29 15:45:35', '2026-04-29 15:58:51'),
	(12, 10, 5, 1, '2026-04-23', '2026-04-28', '2026-04-30', 'dikembalikan', 10000, '2026-04-29 16:09:00', '2026-04-29 16:09:30');

-- Dumping structure for table db_perpustakaan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.sessions: ~8 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('1QpQYjSXbY3uAWXdp03Z45m0lB4AeESUm0QgH1ce', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUmR1VngzZURSOTk3MVNwOVlFTjQ4enpIYkpRTVhLcXNhQmMzR2tIMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778197233),
	('6Urou9hVX7g1uRLsQ1U5ZMmv4AL0wHzLEeHmRp9X', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS3dvb1lGYVRTcGpWU0N1QmlVMEhtdW1kOXpPZlZaNEY1WXpIWm1oUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778199068),
	('AzAsJMjPzP0lQ9p419RKaWH9JaqMMZ0ei44IvoyX', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNGR4WWRRSlhOYTRWSVkwUlNYTHFDTzQ2Mmd2ZUxVcWpOOEFHOTZmVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778197233),
	('IIRhX0AL5XKDzu81HkuJfhUngUjtM7AMldLNmHaj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib05sZkRzUkNsZlJoVDNhNFFFbXR6OHVDZ0xuZUtibzRadzdtdWNwYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1778197370),
	('J2o4jpzVZemUimINjRFkP37ljESebfJhLkrvNMVG', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1gzalQ2U0pma0FvcXp4RFNLQU1hSGtiWmcwdkZvUWdibnFIZVZUcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778197233),
	('KPyxorrC97KkKYnnnev7nayWqoqINM6SI9mW9PlM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWNocnpWZk1uOFNFVmdYSVRlaGtNNzl0NzZwdHh0WGNDcnZYalFuQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9idWt1cyI7czo1OiJyb3V0ZSI7czoxMToiYnVrdXMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1778199739),
	('TDs8V0fVh43ipTKIGrIi63W8DccjiKvPIRnVSKys', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWRLTFZ1UTZyRWFtVlZRSWNSYnh4QlVSaWZJTUN5U2NMTmFuYmd0NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778197233),
	('uaKmKNsKNNDJxD7pHgkYXjOX2rGNVEWZ98EteLZB', NULL, '127.0.0.1', 'Go-http-client/1.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1A3U1ZiQXNNTjdWdEFEY3NCbTVQM21HU010bDdxTFNibWlhY1YwMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778199068);

-- Dumping structure for table db_perpustakaan.siswas
CREATE TABLE IF NOT EXISTS `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswas_nis_unique` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.siswas: ~9 rows (approximately)
INSERT INTO `siswas` (`id`, `nama`, `nis`, `kelas`, `jurusan`, `created_at`, `updated_at`) VALUES
	(2, 'Egi', '12346', 'X', 'BD 1', '2026-04-23 11:13:43', '2026-04-26 15:44:36'),
	(3, 'Sandya', '12347', 'XII', 'PPLG 2', '2026-04-23 11:13:43', '2026-04-26 15:45:07'),
	(4, 'RIdwan', '12348', 'X', 'DKV 2', '2026-04-23 11:13:43', '2026-04-26 15:45:41'),
	(5, 'Vuguh', '12349', 'XI', 'IPA', '2026-04-23 11:13:43', '2026-04-26 15:46:17'),
	(7, 'Yoga', '5562', 'XI', 'PPLG 2', '2026-04-26 15:49:17', '2026-04-26 15:49:17'),
	(8, 'sandi', '2214', 'XI', 'DKV 2', '2026-04-29 15:44:14', '2026-04-29 15:44:14'),
	(9, 'Argha', '2455', 'XI', 'PPLG 2', '2026-04-29 15:55:18', '2026-04-29 15:55:18'),
	(10, 'Danan Darma', '2335', 'XI', 'BD 2', '2026-04-29 16:07:10', '2026-04-29 16:07:10');

-- Dumping structure for table db_perpustakaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_perpustakaan.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'Admin User', 'admin@example.com', '$2y$12$I/K5Nc8p80NJK9x.pJ194ucOOzU4fa8WRi4KPzwYkyd9IluS48sNW', 'admin', '2026-04-23 11:13:43', '2026-04-23 11:13:43'),
	(2, 'Petugas User', 'petugas@example.com', '$2y$12$UiHrHeVU9Tb4WX1h7cHFYuyJbWXNq5Y.mQZ53vVQGppJRSbE5xxba', 'petugas', '2026-04-23 11:13:43', '2026-04-23 11:13:43');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
