-- SQL Dump Lengkap untuk Modul Ruang & Fasilitas Sidang (Auth + CRUD)
-- Database: db_ruang_sidang

CREATE DATABASE IF NOT EXISTS `db_ruang_sidang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_ruang_sidang`;

-- 1. Tabel Users (Autentikasi Pengguna)
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Akun Administrator Default (email: admin@sidang.ac.id | password: password123)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`)
VALUES (1, 'Administrator Sidang', 'admin@sidang.ac.id', '$2y$10$O43vpQ0Gxo6ysK5VXv39UuAoYVOhzRses0AKwVGOJyP13gxUG7G8O', NOW(), NOW())
ON DUPLICATE KEY UPDATE `email` = VALUES(`email`);

-- 2. Tabel Ruang Sidang (Master CRUD Ruang & Fasilitas)
CREATE TABLE IF NOT EXISTS `ruang_sidangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_ruang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gedung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(10) unsigned NOT NULL,
  `fasilitas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel Sessions (Session Driver Database)
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
