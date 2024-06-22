-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table tugasakhir_si.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `areaName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `areaFacilities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.areas: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.costs
CREATE TABLE IF NOT EXISTS `costs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rentalCost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `areaId` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `costs_areaid_foreign` (`areaId`),
  CONSTRAINT `costs_areaid_foreign` FOREIGN KEY (`areaId`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.costs: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.failed_jobs
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

-- Dumping data for table tugasakhir_si.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_06_20_091001_user_details', 1),
	(6, '2024_06_21_033255_areas', 1),
	(7, '2024_06_21_034118_stalls', 1),
	(8, '2024_06_21_035149_cost', 1),
	(9, '2024_06_21_035534_rents', 1),
	(10, '2024_06_21_040010_payments', 1);

-- Dumping structure for table tugasakhir_si.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `paymentDate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentMethod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentProof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rentId` bigint unsigned NOT NULL,
  `status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_rentid_foreign` (`rentId`),
  CONSTRAINT `payments_rentid_foreign` FOREIGN KEY (`rentId`) REFERENCES `rents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.payments: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.rents
CREATE TABLE IF NOT EXISTS `rents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rentDate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `returnDate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stallId` bigint unsigned NOT NULL,
  `userId` bigint unsigned NOT NULL,
  `costId` bigint unsigned NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rents_stallid_foreign` (`stallId`),
  KEY `rents_userid_foreign` (`userId`),
  KEY `rents_costid_foreign` (`costId`),
  CONSTRAINT `rents_costid_foreign` FOREIGN KEY (`costId`) REFERENCES `costs` (`id`),
  CONSTRAINT `rents_stallid_foreign` FOREIGN KEY (`stallId`) REFERENCES `stalls` (`id`),
  CONSTRAINT `rents_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.rents: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.stalls
CREATE TABLE IF NOT EXISTS `stalls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL,
  `areaId` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stalls_areaid_foreign` (`areaId`),
  CONSTRAINT `stalls_areaid_foreign` FOREIGN KEY (`areaId`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.stalls: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.userdetails
CREATE TABLE IF NOT EXISTS `userdetails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `businessName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerFullName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerPhoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `businessPhoto` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.userdetails: ~0 rows (approximately)

-- Dumping structure for table tugasakhir_si.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tugasakhir_si.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
