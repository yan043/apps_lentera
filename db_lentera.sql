-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_lentera
CREATE DATABASE IF NOT EXISTS `db_lentera` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_lentera`;

-- membuang struktur untuk table db_lentera.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.cache: ~12 rows (lebih kurang)
DELETE FROM `cache`;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_captcha_15f9967d84f60a3d45d2de6c54bd8ac0', 'a:6:{i:0;s:1:"a";i:1;s:1:"u";i:2;s:1:"a";i:3;s:1:"p";i:4;s:1:"h";i:5;s:1:"j";}', 1757122792),
	('laravel_cache_captcha_252bfde2cc4b89b4965c36d9577e0d85', 'a:6:{i:0;s:1:"y";i:1;s:1:"q";i:2;s:1:"r";i:3;s:1:"q";i:4;s:1:"g";i:5;s:1:"p";}', 1757419708),
	('laravel_cache_captcha_28fc987a51f95047dc5cfd0648c9f7aa', 'a:6:{i:0;s:1:"c";i:1;s:1:"4";i:2;s:1:"r";i:3;s:1:"t";i:4;s:1:"x";i:5;s:1:"u";}', 1757591225),
	('laravel_cache_captcha_2da11a232b7058b49e17ce8a3afcbd31', 'a:6:{i:0;s:1:"7";i:1;s:1:"x";i:2;s:1:"u";i:3;s:1:"4";i:4;s:1:"c";i:5;s:1:"t";}', 1757244861),
	('laravel_cache_captcha_39f6b13cd9db883c244aa559531f4ea2', 'a:6:{i:0;s:1:"8";i:1;s:1:"a";i:2;s:1:"a";i:3;s:1:"2";i:4;s:1:"c";i:5;s:1:"n";}', 1757074071),
	('laravel_cache_captcha_43926a82b58c7e2eec8fd8a7727223b7', 'a:6:{i:0;s:1:"t";i:1;s:1:"r";i:2;s:1:"c";i:3;s:1:"c";i:4;s:1:"e";i:5;s:1:"y";}', 1757210690),
	('laravel_cache_captcha_6fc2d74a6ef7aa54d5d28813f1dee6c9', 'a:6:{i:0;s:1:"e";i:1;s:1:"q";i:2;s:1:"h";i:3;s:1:"a";i:4;s:1:"n";i:5;s:1:"g";}', 1757419957),
	('laravel_cache_captcha_8882bdf20bd6bcf36b1bc47e6ab7f46c', 'a:6:{i:0;s:1:"c";i:1;s:1:"a";i:2;s:1:"2";i:3;s:1:"r";i:4;s:1:"q";i:5;s:1:"x";}', 1756977846),
	('laravel_cache_captcha_929fefa0bd3ae32237996005b1ac6422', 'a:6:{i:0;s:1:"g";i:1;s:1:"c";i:2;s:1:"h";i:3;s:1:"x";i:4;s:1:"f";i:5;s:1:"h";}', 1757418895),
	('laravel_cache_captcha_ae2586db5177dced600779ef561ff777', 'a:6:{i:0;s:1:"e";i:1;s:1:"a";i:2;s:1:"e";i:3;s:1:"a";i:4;s:1:"a";i:5;s:1:"8";}', 1757418809),
	('laravel_cache_captcha_dc4899cbb0dbc452707fe2378f065134', 'a:6:{i:0;s:1:"n";i:1;s:1:"b";i:2;s:1:"h";i:3;s:1:"m";i:4;s:1:"y";i:5;s:1:"b";}', 1757607149),
	('laravel_cache_captcha_f4295561a559e9debeeaa4f5ed3ab8e7', 'a:6:{i:0;s:1:"n";i:1;s:1:"8";i:2;s:1:"p";i:3;s:1:"a";i:4;s:1:"y";i:5;s:1:"x";}', 1757122799);

-- membuang struktur untuk table db_lentera.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.cache_locks: ~0 rows (lebih kurang)
DELETE FROM `cache_locks`;

-- membuang struktur untuk table db_lentera.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.failed_jobs: ~0 rows (lebih kurang)
DELETE FROM `failed_jobs`;

-- membuang struktur untuk table db_lentera.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.jobs: ~0 rows (lebih kurang)
DELETE FROM `jobs`;

-- membuang struktur untuk table db_lentera.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.job_batches: ~0 rows (lebih kurang)
DELETE FROM `job_batches`;

-- membuang struktur untuk table db_lentera.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.migrations: ~0 rows (lebih kurang)
DELETE FROM `migrations`;

-- membuang struktur untuk table db_lentera.tb_alpro_open_reports
CREATE TABLE IF NOT EXISTS `tb_alpro_open_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `odp_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odp_coordinates` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` mediumtext COLLATE utf8mb4_general_ci,
  `photo_odp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `street` text COLLATE utf8mb4_general_ci,
  `city` text COLLATE utf8mb4_general_ci,
  `province` text COLLATE utf8mb4_general_ci,
  `created_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'chat id telegram',
  `created_by_username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_time` time DEFAULT NULL,
  `repair_notes` mediumtext COLLATE utf8mb4_general_ci,
  `repair_coordinates` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `repair_photo_odp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `repair_date` date DEFAULT NULL,
  `repair_time` time DEFAULT NULL,
  `repair_street` text COLLATE utf8mb4_general_ci,
  `repair_city` text COLLATE utf8mb4_general_ci,
  `repair_province` text COLLATE utf8mb4_general_ci,
  `updated_ by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'chat id telegram',
  `updated_by_username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_by_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_ by` (`updated_ by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_alpro_open_reports: ~0 rows (lebih kurang)
DELETE FROM `tb_alpro_open_reports`;

-- membuang struktur untuk table db_lentera.tb_assign_orders
CREATE TABLE IF NOT EXISTS `tb_assign_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sourcedata` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_id` bigint NOT NULL DEFAULT '0',
  `team_id` int DEFAULT '0',
  `team_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `assign_labels` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `onu_rx_pwr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `team_id` (`team_id`),
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_assign_orders: ~0 rows (lebih kurang)
DELETE FROM `tb_assign_orders`;

-- membuang struktur untuk table db_lentera.tb_assign_orders_log
CREATE TABLE IF NOT EXISTS `tb_assign_orders_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sourcedata` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_id` bigint NOT NULL DEFAULT '0',
  `team_id` int DEFAULT '0',
  `team_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `assign_labels` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `onu_rx_pwr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `created_by` (`created_by`) USING BTREE,
  KEY `team_id` (`team_id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_lentera.tb_assign_orders_log: ~0 rows (lebih kurang)
DELETE FROM `tb_assign_orders_log`;

-- membuang struktur untuk table db_lentera.tb_assign_order_reports
CREATE TABLE IF NOT EXISTS `tb_assign_order_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assign_order_id` int unsigned DEFAULT '0',
  `order_substatus_id` int unsigned DEFAULT '0',
  `order_segment_id` int unsigned DEFAULT '0',
  `order_action_id` int unsigned DEFAULT '0',
  `report_notes` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_coordinates_location` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_odp_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_odp_coordinates` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_valins_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_refferal_order_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_rx_pwr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_by` int NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_substatus_id` (`order_substatus_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `assign_order_id` (`assign_order_id`) USING BTREE,
  KEY `order_segment_id` (`order_segment_id`),
  KEY `order_action_id` (`order_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_assign_order_reports: ~0 rows (lebih kurang)
DELETE FROM `tb_assign_order_reports`;

-- membuang struktur untuk table db_lentera.tb_assign_order_reports_log
CREATE TABLE IF NOT EXISTS `tb_assign_order_reports_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assign_order_id` int unsigned DEFAULT '0',
  `order_substatus_id` int unsigned DEFAULT '0',
  `order_segment_id` int unsigned DEFAULT '0',
  `order_action_id` int unsigned DEFAULT '0',
  `report_notes` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_coordinates_location` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_odp_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_odp_coordinates` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_valins_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_refferal_order_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_rx_pwr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onu_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `order_substatus_id` (`order_substatus_id`) USING BTREE,
  KEY `created_by` (`created_by`) USING BTREE,
  KEY `assign_order_id` (`assign_order_id`) USING BTREE,
  KEY `order_segment_id` (`order_segment_id`) USING BTREE,
  KEY `order_action_id` (`order_action_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_lentera.tb_assign_order_reports_log: ~0 rows (lebih kurang)
DELETE FROM `tb_assign_order_reports_log`;

-- membuang struktur untuk table db_lentera.tb_auth_storage
CREATE TABLE IF NOT EXISTS `tb_auth_storage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cookies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_auth_storage: ~1 rows (lebih kurang)
DELETE FROM `tb_auth_storage`;
INSERT INTO `tb_auth_storage` (`id`, `apps`, `username`, `password`, `cookies`, `last_updated_at`) VALUES
	(1, 'insera', '20981020', '403#!1nsErA', 'JSESSIONID=EOWch9266CRC69jjHF6s_U8dRNTo33CD36tG2Fkz.cident-8485984bc9-p2j8k; a10e07c589b0b6a4b246720bbb392af5=42fe54582c9368202fb0b34446350753;', '2025-09-01 20:11:37');

-- membuang struktur untuk table db_lentera.tb_employee
CREATE TABLE IF NOT EXISTS `tb_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int NOT NULL DEFAULT '0',
  `witel_id` int NOT NULL DEFAULT '0',
  `mitra_id` int NOT NULL DEFAULT '0',
  `sub_unit_id` int NOT NULL DEFAULT '0',
  `sub_group_id` int NOT NULL DEFAULT '0',
  `role_id` int NOT NULL DEFAULT '0',
  `nik` int NOT NULL DEFAULT '0',
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chat_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `number_phone` bigint DEFAULT NULL,
  `home_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '''Laki-Laki'',''Perempuan''',
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google2fa_secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'default : 12345678',
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `is_active` int DEFAULT '0' COMMENT '0 : deactive, 1 : active',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `updated_by` (`updated_by`),
  KEY `created_by` (`created_by`),
  KEY `nik` (`nik`),
  KEY `mitra_id` (`mitra_id`),
  KEY `witel_id` (`witel_id`),
  KEY `regional_id` (`regional_id`),
  KEY `sub_unit_id` (`sub_unit_id`),
  KEY `level_id` (`role_id`) USING BTREE,
  KEY `unit_id` (`sub_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_employee: ~3 rows (lebih kurang)
DELETE FROM `tb_employee`;
INSERT INTO `tb_employee` (`id`, `regional_id`, `witel_id`, `mitra_id`, `sub_unit_id`, `sub_group_id`, `role_id`, `nik`, `full_name`, `chat_id`, `number_phone`, `home_address`, `gender`, `date_of_birth`, `place_of_birth`, `remember_token`, `google2fa_secret`, `password`, `ip_address`, `login_at`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(1, 4, 1, 2, 1, 2, 1, 981020, 'Mahdian', '401791818', 85156717117, NULL, 'Laki-Laki', '1998-10-26', 'Sebangau', 'RvDLqs7ebSlLl1fv7tKO2FHlAk6RnbarVotR95pkhedmtpnpmmIlA4N8O03v', NULL, '$2y$12$M9AmlyDhrtqnBpzlJxh9W.sHxIavCkAlXvVvufnWnc8.A/ZlMaRGO', '127.0.0.1', '2025-09-13 11:22:48', 1, NULL, NULL, NULL, '2025-09-13 11:22:48'),
	(3, 4, 1, 2, 9, 2, 16, 20981020, 'Mahdian', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, 'IBzQRcdPfWWIdwjAMYHIxUx1wDcUOBkPFXmMdnQ4II3Lwpbj6y7eL67Y4v5E', NULL, '$2y$12$vNoyymoRIsBGICJ4kngSB.JrQScqkDEIImPugnF2zAKvcLbGcMTBq', '127.0.0.1', '2025-09-04 16:11:25', 1, NULL, NULL, NULL, '2025-09-04 17:23:32'),
	(4, 4, 1, 2, 9, 30, 16, 209810200, 'Mahdian', NULL, NULL, NULL, 'Laki-Laki', NULL, NULL, 'qhPBK2ig9Qa0eEfH2Kblu26e7M5EmvHOH6IhmsuudEqrY3E4oEVrZARYLzto', NULL, '$2y$12$475/yQ4EtFWvs5UOAe8/ROEwCc3/uco3EGcAVK3.51fd7ME1NCd7G', '127.0.0.1', '2025-09-11 23:12:57', 1, NULL, NULL, NULL, '2025-09-11 23:12:57');

-- membuang struktur untuk table db_lentera.tb_inventory_material
CREATE TABLE IF NOT EXISTS `tb_inventory_material` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designator_desc` mediumtext COLLATE utf8mb4_general_ci,
  `unit` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_inventory_material: ~38 rows (lebih kurang)
DELETE FROM `tb_inventory_material`;
INSERT INTO `tb_inventory_material` (`id`, `name`, `designator_desc`, `unit`) VALUES
	(1, 'AC-OF-SM-1B', 'Drop Cable FO atas tanah / aerial 1 Core Single mode G.657', 'Meter'),
	(2, 'AC-OF-SM-1B (BEKAS)', '(BEKAS) Drop Cable FO atas tanah / aerial 1 Core Single mode G.657', 'Meter'),
	(3, 'SOC-ILS', 'Splice on Connector Ilsintech', 'Pcs'),
	(4, 'SOC-SUM', 'Splice on Connector Sumitomo', 'Pcs'),
	(5, 'SOC-FUJ', 'Connector of fiber instrument (Fujikura)', 'Pcs'),
	(6, 'OTP-FTTH-1', 'OTP FTTH 1 Port With Adaptor', 'Pcs'),
	(7, 'CONNECTOR/ADAPTOR-SC-SC', 'Connector/ Adaptor SC-SC', 'Pcs'),
	(8, 'PREKSO-INTRA-15-RS', 'Precon KSO Indoor Trans 15 mtr dgn Roset', 'Pcs'),
	(9, 'PREKSO-INTRA-20-RS', 'Precon KSO Indoor Trans 20 mtr dgn Roset', 'Pcs'),
	(10, 'BREKET-A', 'Breket A', 'Pcs'),
	(11, 'CLAMP-HOOK', 'Clamp-Hook', 'Pcs'),
	(12, 'S-CLAMP-SPRINER', 'S-Clamp-Springer', 'Pcs'),
	(13, 'TC-2-160', 'Tray Cable TC-2, Lebar 160 mm', 'Pcs'),
	(14, 'PC-SC-SC-10', 'Patchcord SC-SC 10 Meter', 'Pcs'),
	(15, 'PC-SC-SC-15', 'Patchcord SC-SC 15 Meter', 'Pcs'),
	(16, 'UTP-C5', 'Kabel UTP Cat 5 (Kec kurang dari 20 Mbps)', 'Meter'),
	(17, 'RJ45-5', 'RJ 45 Cat 5', 'Pcs'),
	(18, 'UTP-C6', 'Kabel UTP Cat 6 (Kec sampai dengan 100 Mbps)', 'Meter'),
	(19, 'RJ45-6', 'RJ 45 Cat 6', 'Pcs'),
	(20, 'PU-S7.0-140', 'Tiang Besi 7 Mtr', 'Batang'),
	(21, 'PU-S9.0-140', 'Tiang Besi 9 Mtr', 'Batang'),
	(22, 'PROT-SLEEVE-TIPE3', 'Protection Sleeve Tipe 3', 'Pcs'),
	(23, 'PC-SC-SC-5', 'Patchcord SC-SC 5 Meter', 'Pcs'),
	(24, 'PC-SC-SC-20', 'Patchcord SC-SC 20 Meter', 'Pcs'),
	(25, 'AC-OF-SM-1-3SL', '(3 Sling) Drop Cable FO atas tanah / aerial 1 Core Single mode G.657', 'Meter'),
	(26, 'THERMOFIT HEAT-SHRINKABLE', NULL, 'Pcs'),
	(27, 'PRECON-1C-1-NOAC', NULL, 'Meter'),
	(28, 'PRECON-1C-2-NOAC', NULL, 'Meter'),
	(29, 'PRECON-1C-3-NOAC', NULL, 'Meter'),
	(30, 'Cable-UTP', 'Kabel UTP / LAN', 'Meter'),
	(31, 'Passive Splitter 1:2', 'Pan-Out, for ODP Building, Box Kecil', 'Pcs'),
	(32, 'Passive Splitter 1:4', 'Pan-Out, for ODC 288, Box Besar', 'Pcs'),
	(33, 'Passive Splitter 1:8', 'Pan-Out, for ODP Pole Building/Pedestal, Box Kecil', 'Pcs'),
	(34, 'Passive Splitter 1:16', 'Pan-Out, for ODP Building, Box Besar', 'Pcs'),
	(35, 'M-PC-APC/UPC-657-A1', NULL, 'Pcs'),
	(36, 'M-PS-1-8-ODP', NULL, 'Pcs'),
	(37, 'M-PS-1-4-ODC', NULL, 'Pcs'),
	(38, 'M-PIGTAIL', NULL, 'Pcs');

-- membuang struktur untuk table db_lentera.tb_inventory_material_reports
CREATE TABLE IF NOT EXISTS `tb_inventory_material_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assign_order_reports_id` int NOT NULL DEFAULT '0',
  `inventory_material_id` int NOT NULL DEFAULT '0',
  `qty` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `inventory_material_id` (`inventory_material_id`),
  KEY `created_by` (`created_by`),
  KEY `transaction_reports_Id` (`assign_order_reports_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_inventory_material_reports: ~0 rows (lebih kurang)
DELETE FROM `tb_inventory_material_reports`;

-- membuang struktur untuk table db_lentera.tb_inventory_nte
CREATE TABLE IF NOT EXISTS `tb_inventory_nte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nte_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_inventory_nte: ~17 rows (lebih kurang)
DELETE FROM `tb_inventory_nte`;
INSERT INTO `tb_inventory_nte` (`id`, `brand`, `name`, `nte_type`) VALUES
	(1, 'HUAWEI', 'HG8245H', 'ONT'),
	(2, 'HUAWEI', 'HG8245H5', 'ONT'),
	(3, 'HUAWEI', 'HG8145V5', 'ONT'),
	(4, 'HUAWEI', 'HG8245A', 'ONT'),
	(5, 'ZTE', 'F609', 'ONT'),
	(6, 'ZTE', 'F670', 'ONT'),
	(7, 'FIBERHOME', 'AN5506-04-FA', 'ONT'),
	(8, 'FIBERHOME', 'AN5506-02-FG', 'ONT'),
	(9, 'FIBERHOME', 'AN5506-04-FG', 'ONT'),
	(10, 'FIBERHOME', 'AN5506-04-FS', 'ONT'),
	(11, 'NOKIA', 'G-240W-F', 'ONT'),
	(12, 'ALCATEL', 'I-240G-T', 'ONT'),
	(13, 'ZTE', 'ZTE B860H', 'STB'),
	(14, 'ZTE', 'ZXV10 B860H (STB ZTE 4K)', 'STB'),
	(15, 'HUAWEI', 'EC6108V9', 'STB'),
	(16, 'HYBRID BOX', 'Hybrid Box UseeTV (OTT + IPTV)', 'STB'),
	(17, 'HYBRID BOX TAMBAHAN', 'STB + PLC Adapter (Power Line Communication)', 'STB');

-- membuang struktur untuk table db_lentera.tb_inventory_nte_reports
CREATE TABLE IF NOT EXISTS `tb_inventory_nte_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assign_order_reports_id` int DEFAULT '0',
  `inventory_nte_id_ont` int DEFAULT '0',
  `serial_number_ont` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inventory_nte_id_stb` int DEFAULT '0',
  `serial_number_stb` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT '0',
  `created_at` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assign_order_reports_id` (`assign_order_reports_id`),
  KEY `created_by` (`created_by`),
  KEY `inventory_nte_id_ont` (`inventory_nte_id_ont`) USING BTREE,
  KEY `inventory_nte_id_stb` (`inventory_nte_id_stb`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_inventory_nte_reports: ~0 rows (lebih kurang)
DELETE FROM `tb_inventory_nte_reports`;

-- membuang struktur untuk table db_lentera.tb_mitra
CREATE TABLE IF NOT EXISTS `tb_mitra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `witel_id` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `witel_id` (`witel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_mitra: ~3 rows (lebih kurang)
DELETE FROM `tb_mitra`;
INSERT INTO `tb_mitra` (`id`, `witel_id`, `name`, `alias`) VALUES
	(1, 1, 'PT Telkom Indonesia', 'TI'),
	(2, 1, 'PT Telkom Akses', 'TA'),
	(3, 1, 'PT Upaya Tehnik', 'UPATEK');

-- membuang struktur untuk table db_lentera.tb_order_action
CREATE TABLE IF NOT EXISTS `tb_order_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_segment_id` int DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_segment_id` (`order_segment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_order_action: ~0 rows (lebih kurang)
DELETE FROM `tb_order_action`;

-- membuang struktur untuk table db_lentera.tb_order_labels
CREATE TABLE IF NOT EXISTS `tb_order_labels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_order_labels: ~3 rows (lebih kurang)
DELETE FROM `tb_order_labels`;
INSERT INTO `tb_order_labels` (`id`, `name`) VALUES
	(1, 'INSERA'),
	(2, 'MANUALS'),
	(3, 'BIMA');

-- membuang struktur untuk table db_lentera.tb_order_segment
CREATE TABLE IF NOT EXISTS `tb_order_segment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_list` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_order_segment: ~6 rows (lebih kurang)
DELETE FROM `tb_order_segment`;
INSERT INTO `tb_order_segment` (`id`, `name`, `photo_list`) VALUES
	(1, 'ODP', '["Lokasi_Rumah","Titik_Penyebab_Gangguan","Penempatan_ONT_STB_Pelanggan","Instalasi_Kabel_Pelanggan_IKR","Tarikan_Dropcore","Kondisi_Dalam_ODP","Kondisi_Luar_ODP","OTP","Prekso","Tampak_Jauh_Setelah_Pemasangan"]'),
	(2, 'DROPCORE', '["Lokasi_Rumah","Titik_Penyebab_Gangguan","Penempatan_ONT_STB_Pelanggan","Instalasi_Kabel_Pelanggan_IKR","Tarikan_Dropcore","Kondisi_Luar_ODP","OTP","Prekso","Tampak_Jauh_Setelah_Pemasangan"]'),
	(3, 'CPE', '["Lokasi_Rumah","Titik_Penyebab_Gangguan","Penempatan_ONT_STB_Pelanggan","Instalasi_Kabel_Pelanggan_IKR","Tarikan_Dropcore","OTP","Prekso","Tampak_Jauh_Setelah_Pemasangan"]'),
	(5, 'ONT', '["Lokasi_Rumah","Penempatan_ONT_STB_Pelanggan","Instalasi_Kabel_Pelanggan_IKR","Capture_Hasil_Speedtest","OTP","Prekso","Tampak_Jauh_Setelah_Pemasangan"]'),
	(6, 'STB', '["Lokasi_Rumah","Penempatan_ONT_STB_Pelanggan","Akses_Channel_UseeTV","Akses_Youtube","OTP","Prekso","Tampak_Jauh_Setelah_Pemasangan"]'),
	(7, 'ODC', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Kondisi_Dalam_ODC"]');

-- membuang struktur untuk table db_lentera.tb_order_status
CREATE TABLE IF NOT EXISTS `tb_order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `step` int DEFAULT '0',
  `after_step` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_order_status: ~7 rows (lebih kurang)
DELETE FROM `tb_order_status`;
INSERT INTO `tb_order_status` (`id`, `name`, `step`, `after_step`) VALUES
	(1, 'READY', 1, 2),
	(2, 'ON-PROGRESS', 2, 3),
	(3, 'CUST-ISSUE', 3, 4),
	(4, 'TECH-ISSUE', 3, 4),
	(5, 'EXTERNAL-ISSUE', 3, 4),
	(6, 'SYSTEM-ISSUE', 3, 4),
	(7, 'DONE', 4, 3);

-- membuang struktur untuk table db_lentera.tb_order_sub_status
CREATE TABLE IF NOT EXISTS `tb_order_sub_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_status_id` int DEFAULT '0',
  `previous_step` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `next_step` varchar(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_list` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `order_status_id` (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_order_sub_status: ~41 rows (lebih kurang)
DELETE FROM `tb_order_sub_status`;
INSERT INTO `tb_order_sub_status` (`id`, `order_status_id`, `previous_step`, `next_step`, `name`, `photo_list`) VALUES
	(1, 1, '1.1', '2.1', 'BELUM DIKERJAKAN', NULL),
	(2, 2, '2.1', '2.2', 'BERANGKAT', NULL),
	(4, 2, '2.1', '2.3', 'TIBA', NULL),
	(5, 2, '2.3', '2.4', 'SEDANG DIKERJAKAN', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(6, 3, '3.0', '3.0', 'ATK', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(7, 3, '3.0', '3.0', 'BATAL', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(8, 3, '3.0', '3.0', 'CP RNA', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(9, 3, '3.0', '3.0', 'DOUBLE INPUT', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(10, 3, '3.0', '3.0', 'GANTI PAKET', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(11, 3, '3.0', '3.0', 'KENDALA IZIN', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(12, 3, '3.0', '3.0', 'KENDALA MATERIAL/NTE', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(13, 3, '3.0', '3.0', 'PENDING', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(14, 3, '3.0', '3.0', 'PP', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(15, 3, '3.0', '3.0', 'RNA', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(16, 3, '3.0', '3.0', 'SALAH TAGGING', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(17, 4, '3.0', '3.0', 'ALPRO FULL', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(18, 4, '3.0', '3.0', 'BATAL', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(19, 4, '3.0', '3.0', 'CROSS JALAN', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(20, 4, '3.0', '3.0', 'DOUBLE INPUT', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(21, 4, '3.0', '3.0', 'INSERT TIANG', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(22, 4, '3.0', '3.0', 'KENDALA IKR/IKG', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(23, 4, '3.0', '3.0', 'KENDALA JALUR', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(24, 4, '3.0', '3.0', 'KENDALA JALUR/RUTE TARIKAN', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(25, 4, '3.0', '3.0', 'KENDALA ODP JAUH', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(26, 4, '3.0', '3.0', 'NO ODP', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(27, 4, '3.0', '3.0', 'ODP BELUM GO LIVE', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(28, 4, '3.0', '3.0', 'ODP FULL', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(29, 4, '3.0', '3.0', 'ODP JAUH', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(30, 4, '3.0', '3.0', 'ODP LOSS', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(31, 4, '3.0', '3.0', 'ODP RETI', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(32, 4, '3.0', '3.0', 'ODP RUSAK', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(33, 4, '3.0', '3.0', 'PP', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(34, 4, '3.0', '3.0', 'SALAH TAGGING', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(35, 4, '3.0', '3.0', 'TIANG', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(36, 4, '3.0', '3.0', 'TIDAK ADA ODP', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(37, 4, '3.0', '3.0', 'TKJ_KENDALA JALUR', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(38, 5, '3.0', '3.0', 'CUACA/HUJAN', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(39, 5, '3.0', '3.0', 'KENDALA MATERIAL/NTE', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(40, 5, '3.0', '3.0', 'LAINNYA', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(41, 6, '3.0', '3.0', 'KENDALA SISTEM', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]'),
	(42, 7, '3.0', '4.0', 'SELESAI', '["Lokasi_Rumah","Kondisi_Dalam_ODC","Hasil_Ukur_Power_IN","Hasil_Ukur_Power_OUT"]');

-- membuang struktur untuk table db_lentera.tb_regional
CREATE TABLE IF NOT EXISTS `tb_regional` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_regional: ~5 rows (lebih kurang)
DELETE FROM `tb_regional`;
INSERT INTO `tb_regional` (`id`, `name`, `alias`) VALUES
	(1, 'Regional 1', NULL),
	(2, 'Regional 2', NULL),
	(3, 'Regional 3', NULL),
	(4, 'Regional 4', 'Kalimantan'),
	(5, 'Regional 5', NULL);

-- membuang struktur untuk table db_lentera.tb_roles_permissions
CREATE TABLE IF NOT EXISTS `tb_roles_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_roles_permissions: ~17 rows (lebih kurang)
DELETE FROM `tb_roles_permissions`;
INSERT INTO `tb_roles_permissions` (`id`, `name`) VALUES
	(1, 'Developer'),
	(2, 'Direktur'),
	(3, 'OSM'),
	(4, 'GM_VP_PM'),
	(5, 'Manager'),
	(6, 'Officer_1'),
	(7, 'Assistant_Manager'),
	(8, 'Officer_2'),
	(9, 'Head_of_Service_Area'),
	(10, 'Officer_3'),
	(11, 'Team_Leader'),
	(12, 'Kordinator_Lapangan'),
	(13, 'Staff'),
	(14, 'Drafter'),
	(15, 'Helpdesk'),
	(16, 'Technician'),
	(17, 'Sales_Force');

-- membuang struktur untuk table db_lentera.tb_service_area
CREATE TABLE IF NOT EXISTS `tb_service_area` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int DEFAULT NULL,
  `witel_id` int DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `chat_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `head_service_area` int NOT NULL DEFAULT '0',
  `officer_service_area` int NOT NULL DEFAULT '0',
  `kordinator_lapangan1` int NOT NULL DEFAULT '0',
  `kordinator_lapangan2` int NOT NULL DEFAULT '0',
  `is_active` int NOT NULL DEFAULT (0),
  `sort_id` int NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `head_service_area` (`head_service_area`),
  KEY `officer_service_area` (`officer_service_area`),
  KEY `kordinator_lapangan1` (`kordinator_lapangan1`),
  KEY `kordinator_lapangan2` (`kordinator_lapangan2`),
  KEY `regional_id` (`regional_id`),
  KEY `witel_id` (`witel_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_service_area: ~6 rows (lebih kurang)
DELETE FROM `tb_service_area`;
INSERT INTO `tb_service_area` (`id`, `regional_id`, `witel_id`, `name`, `chat_id`, `head_service_area`, `officer_service_area`, `kordinator_lapangan1`, `kordinator_lapangan2`, `is_active`, `sort_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(1, 4, 1, 'BANJARBARU', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:11'),
	(2, 4, 1, 'BANJARMASIN', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:12'),
	(3, 4, 1, 'BATULICIN', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:12'),
	(4, 4, 1, 'PLEIHARI', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:12'),
	(5, 4, 1, 'TANJUNG TABALONG', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:12'),
	(6, 4, 1, 'ULIN', '0', 0, 0, 0, 0, 1, 0, 981020, NULL, NULL, '2025-07-31 15:02:12');

-- membuang struktur untuk table db_lentera.tb_source_bima
CREATE TABLE IF NOT EXISTS `tb_source_bima` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_datecreated` datetime DEFAULT NULL,
  `c_datemodified` datetime DEFAULT NULL,
  `c_wonum_id` bigint DEFAULT '0',
  `c_wonum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_scorderno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_jmscorrelationid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_servicenum` bigint DEFAULT NULL,
  `c_description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_crmordertype` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_ownergroup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_productname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_serviceaddress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_tk_subregion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_workzone` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_siteid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_statusdate` datetime DEFAULT NULL,
  `c_schedstart` datetime DEFAULT NULL,
  `c_contact_telephone_number` bigint NOT NULL DEFAULT (0),
  `c_measurement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_measurementdate` datetime DEFAULT NULL,
  `c_measurementresult` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_woclass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_chief_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_producttype` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_bookingdate` datetime DEFAULT NULL,
  `c_tk_workorder_04` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `c_wonum_id` (`c_wonum_id`),
  KEY `c_workzone` (`c_workzone`),
  KEY `c_wonum` (`c_wonum`),
  KEY `c_servicenum` (`c_servicenum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_source_bima: ~0 rows (lebih kurang)
DELETE FROM `tb_source_bima`;

-- membuang struktur untuk table db_lentera.tb_source_insera
CREATE TABLE IF NOT EXISTS `tb_source_insera` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `incident_id` bigint NOT NULL DEFAULT '0',
  `incident` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ttr_customer` time DEFAULT NULL,
  `summary` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `reported_date` datetime DEFAULT NULL,
  `date_reported` date DEFAULT NULL,
  `time_reported` time DEFAULT NULL,
  `owner_group` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_segment` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `witel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `workzone` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `ticket_id_gamas` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reported_by` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_phone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `description_assigment` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reported_priority` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `source_ticket` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subsidiary` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `external_ticket_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `channel` int NOT NULL DEFAULT '0',
  `customer_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `closed_by` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `closed_reopen_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_no2` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_no` bigint NOT NULL DEFAULT '0',
  `slg` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technology` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lapul` int NOT NULL DEFAULT '0',
  `gaul` int NOT NULL DEFAULT '0',
  `onu_rx` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pending_reason` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `incident_domain` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `symptom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `hierarchy_path` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `solution` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_actual_solution` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kode_produk` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `perangkat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odp_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technician` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `device_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `worklog_summary` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_update_worklog` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `classification_flag` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `realm` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `related_to_gamas` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tsc_result` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `scc_result` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ttr_agent` time DEFAULT NULL,
  `ttr_mitra` time DEFAULT NULL,
  `ttr_nasional` time DEFAULT NULL,
  `ttr_pending` time DEFAULT NULL,
  `ttr_region` time DEFAULT NULL,
  `ttr_witel` time DEFAULT NULL,
  `ttr_end_to_end` time DEFAULT NULL,
  `note` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `guarante_status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resolve_date` datetime DEFAULT NULL,
  `sn_ont` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_ont` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manufacture_ont` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `impacted_site` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `cause` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resolution` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `notes_eskalasi` mediumtext COLLATE utf8mb4_general_ci,
  `rk_information` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `external_ticket_tier_3` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_category` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classification_path` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teritory_near_end` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teritory_far_end` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urgency` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urgency_description` mediumtext COLLATE utf8mb4_general_ci,
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `incident_id` (`incident_id`),
  KEY `incident` (`incident`),
  KEY `service_no` (`service_no`),
  KEY `workzone` (`workzone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_source_insera: ~0 rows (lebih kurang)
DELETE FROM `tb_source_insera`;

-- membuang struktur untuk table db_lentera.tb_source_manuals
CREATE TABLE IF NOT EXISTS `tb_source_manuals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `incident_id` bigint NOT NULL DEFAULT '0',
  `incident` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ttr_customer` time DEFAULT NULL,
  `summary` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `reported_date` datetime DEFAULT NULL,
  `date_reported` date DEFAULT NULL,
  `time_reported` time DEFAULT NULL,
  `owner_group` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_segment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `witel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `workzone` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `ticket_id_gamas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reported_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `description_assigment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reported_priority` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `source_ticket` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subsidiary` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `external_ticket_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `channel` int NOT NULL DEFAULT '0',
  `customer_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `closed_by` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `closed_reopen_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_no2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_no` bigint NOT NULL DEFAULT '0',
  `slg` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technology` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lapul` int NOT NULL DEFAULT '0',
  `gaul` int NOT NULL DEFAULT '0',
  `onu_rx` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pending_reason` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `incident_domain` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `symptom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hierarchy_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `solution` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description_actual_solution` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kode_produk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `perangkat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odp_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technician` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `device_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `worklog_summary` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_update_worklog` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `classification_flag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `realm` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `related_to_gamas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tsc_result` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `scc_result` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ttr_agent` time DEFAULT NULL,
  `ttr_mitra` time DEFAULT NULL,
  `ttr_nasional` time DEFAULT NULL,
  `ttr_pending` time DEFAULT NULL,
  `ttr_region` time DEFAULT NULL,
  `ttr_witel` time DEFAULT NULL,
  `ttr_end_to_end` time DEFAULT NULL,
  `note` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `guarante_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resolve_date` datetime DEFAULT NULL,
  `sn_ont` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_ont` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manufacture_ont` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `impacted_site` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `cause` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `resolution` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `notes_eskalasi` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `rk_information` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `external_ticket_tier_3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classification_path` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teritory_near_end` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teritory_far_end` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urgency` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urgency_description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_updated_at` datetime NOT NULL DEFAULT (now()) ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `incident_id` (`incident_id`) USING BTREE,
  KEY `incident` (`incident`) USING BTREE,
  KEY `service_no` (`service_no`) USING BTREE,
  KEY `workzone` (`workzone`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_lentera.tb_source_manuals: ~0 rows (lebih kurang)
DELETE FROM `tb_source_manuals`;

-- membuang struktur untuk table db_lentera.tb_sub_group
CREATE TABLE IF NOT EXISTS `tb_sub_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_sub_group: ~40 rows (lebih kurang)
DELETE FROM `tb_sub_group`;
INSERT INTO `tb_sub_group` (`id`, `name`) VALUES
	(2, 'ASSURANCE & MAINTENANCE'),
	(3, 'B2C'),
	(4, 'BGES'),
	(5, 'BGES SERVICES'),
	(6, 'BUSINESS SUPPORT'),
	(7, 'COMMERCE'),
	(8, 'COMMERCIAL & SUPPLY CHAIN'),
	(9, 'CONSTRUCTION'),
	(10, 'CORRECTIVE MAINTENANCE & QE'),
	(11, 'DATA MANAGEMENT'),
	(12, 'FA & HSE'),
	(13, 'FIBER ACADEMY'),
	(14, 'FIBER EXPERT & MARSHAL AREA'),
	(15, 'FINANCE & BILCO'),
	(16, 'FTM'),
	(17, 'HCM & CULTURE'),
	(18, 'INVENTORY & ASSET MANAGEMENT AREA'),
	(19, 'IOAN'),
	(20, 'LINTAS ARTA'),
	(21, 'LOGIC ON DESK'),
	(22, 'MO SPBU'),
	(23, 'MS MITRATEL'),
	(24, 'NE'),
	(25, 'OLO'),
	(26, 'OPERATION'),
	(27, 'PATROLI ASET'),
	(28, 'PROCUREMENT & PARTNERSHIP'),
	(29, 'PROVISIONING & MIGRASI'),
	(30, 'PROVISIONING & MIGRATION'),
	(31, 'PROVISIONING BGES'),
	(32, 'PROVISIONING WIBS'),
	(33, 'SDI'),
	(34, 'SERVICE DELIVERY'),
	(35, 'SHARED SERVICE'),
	(36, 'TECHNICIAN ON SITE'),
	(37, 'TSEL'),
	(38, 'WAREHOUSE SO'),
	(39, 'WASPANG'),
	(40, 'WIFI'),
	(41, 'WILSUS');

-- membuang struktur untuk table db_lentera.tb_sub_unit
CREATE TABLE IF NOT EXISTS `tb_sub_unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_sub_unit: ~9 rows (lebih kurang)
DELETE FROM `tb_sub_unit`;
INSERT INTO `tb_sub_unit` (`id`, `regional_id`, `name`) VALUES
	(1, 4, 'Operation Regional IV'),
	(2, 4, 'Business Support Regional IV'),
	(3, 4, 'Construction Regional IV'),
	(4, 4, 'Wilayah Samarinda'),
	(5, 4, 'Shared Service Samarinda'),
	(6, 4, 'TA Area Samarinda'),
	(7, 4, 'Wilayah Balikpapan'),
	(8, 4, 'Shared Service Balikpapan'),
	(9, 4, 'TA Area Balikpapan');

-- membuang struktur untuk table db_lentera.tb_team
CREATE TABLE IF NOT EXISTS `tb_team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_area_id` int DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technician1` int DEFAULT '0',
  `technician2` int DEFAULT '0',
  `is_active` int DEFAULT NULL COMMENT '0 : deactive, 1 : active',
  `created_by` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `technician1` (`technician1`),
  KEY `technician2` (`technician2`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `sector_id` (`service_area_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_team: ~2 rows (lebih kurang)
DELETE FROM `tb_team`;
INSERT INTO `tb_team` (`id`, `service_area_id`, `name`, `technician1`, `technician2`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(2, 1, 'TIM MAHDIAN (ASR)', 20981020, NULL, 1, 0, NULL, 0, '2025-09-04 11:39:31'),
	(3, 1, 'TIM MAHDIAN (PROVI)', 209810200, NULL, 1, 0, NULL, 0, '2025-09-04 11:39:40');

-- membuang struktur untuk table db_lentera.tb_witel
CREATE TABLE IF NOT EXISTS `tb_witel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_witel: ~6 rows (lebih kurang)
DELETE FROM `tb_witel`;
INSERT INTO `tb_witel` (`id`, `regional_id`, `name`, `alias`) VALUES
	(1, 4, 'Banjarmasin', 'Kalsel'),
	(2, 4, 'Balikpapan', NULL),
	(3, 4, 'Palangkaraya', NULL),
	(4, 4, 'Pontianak', NULL),
	(5, 4, 'Samarinda', NULL),
	(6, 4, 'Tarakan', NULL);

-- membuang struktur untuk table db_lentera.tb_work_zone
CREATE TABLE IF NOT EXISTS `tb_work_zone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_area_id` int DEFAULT '0',
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_area_id` (`service_area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel db_lentera.tb_work_zone: ~123 rows (lebih kurang)
DELETE FROM `tb_work_zone`;
INSERT INTO `tb_work_zone` (`id`, `service_area_id`, `name`) VALUES
	(1, 0, 'AGN'),
	(2, 0, 'AMT'),
	(3, 0, 'ANJ'),
	(4, 0, 'BAM'),
	(5, 1, 'BBR'),
	(6, 0, 'BDO'),
	(7, 0, 'BIG'),
	(8, 0, 'BJB'),
	(9, 0, 'BJM'),
	(10, 0, 'BKY'),
	(11, 0, 'BLC'),
	(12, 0, 'BLN'),
	(13, 0, 'BNT'),
	(14, 0, 'BOT'),
	(15, 0, 'BRI'),
	(16, 0, 'BRU'),
	(17, 0, 'BTB'),
	(18, 0, 'BTK'),
	(19, 0, 'GMB'),
	(20, 0, 'GSA'),
	(21, 0, 'HNU'),
	(22, 0, 'JAW'),
	(23, 0, 'JWT'),
	(24, 0, 'KBG'),
	(25, 0, 'KDG'),
	(26, 0, 'KJN'),
	(27, 0, 'KKN'),
	(28, 0, 'KKP'),
	(29, 0, 'KKU'),
	(30, 0, 'KKY'),
	(31, 0, 'KMI'),
	(32, 0, 'KOB'),
	(33, 0, 'KPB'),
	(34, 0, 'KPL'),
	(35, 0, 'KRI'),
	(36, 0, 'KRO'),
	(37, 0, 'KSO'),
	(38, 0, 'KTB'),
	(39, 0, 'KTP'),
	(40, 0, 'KWN'),
	(41, 0, 'KYG'),
	(42, 0, 'LAB'),
	(43, 0, 'LIK'),
	(44, 0, 'LKT'),
	(45, 0, 'LMD'),
	(46, 0, 'LMP'),
	(47, 0, 'LNN'),
	(48, 0, 'LOB'),
	(49, 1, 'LUL'),
	(50, 0, 'MBD'),
	(51, 0, 'MGG'),
	(52, 0, 'MJW'),
	(53, 0, 'MKM'),
	(54, 0, 'MLA'),
	(55, 0, 'MLN'),
	(56, 0, 'MPW'),
	(57, 1, 'MRB'),
	(58, 1, 'MTP'),
	(59, 0, 'MTW'),
	(60, 0, 'NEG'),
	(61, 0, 'NGG'),
	(62, 0, 'NNK'),
	(63, 0, 'NPN'),
	(64, 0, 'PAA'),
	(65, 0, 'PBU'),
	(66, 0, 'PEA'),
	(67, 0, 'PGN'),
	(68, 0, 'PGT'),
	(69, 0, 'PLE'),
	(70, 0, 'PLK'),
	(71, 0, 'PLL'),
	(72, 0, 'PMK'),
	(73, 0, 'PNJ'),
	(74, 0, 'PPS'),
	(75, 0, 'PRC'),
	(76, 0, 'PTG'),
	(77, 0, 'PTK'),
	(78, 0, 'PUT'),
	(79, 0, 'PYM'),
	(80, 0, 'RBA'),
	(81, 0, 'RTA'),
	(82, 0, 'SAD'),
	(83, 0, 'SAI'),
	(84, 0, 'SAN'),
	(85, 0, 'SAO'),
	(86, 0, 'SBR'),
	(87, 0, 'SDR'),
	(88, 0, 'SED'),
	(89, 0, 'SEI'),
	(90, 0, 'SEM'),
	(91, 0, 'SEP'),
	(92, 0, 'SER'),
	(93, 0, 'SGK'),
	(94, 0, 'SGU'),
	(95, 0, 'SKU'),
	(96, 0, 'SMB'),
	(97, 0, 'SMR'),
	(98, 0, 'SNW'),
	(99, 0, 'SNY'),
	(100, 0, 'SPY'),
	(101, 0, 'SRD'),
	(102, 0, 'SRY'),
	(103, 0, 'STA'),
	(104, 0, 'STG'),
	(105, 0, 'STI'),
	(106, 0, 'STT'),
	(107, 0, 'SUA'),
	(108, 0, 'TAJ'),
	(109, 0, 'TBA'),
	(110, 0, 'TBY'),
	(111, 0, 'TGG'),
	(112, 0, 'TJL'),
	(113, 0, 'TKI'),
	(114, 0, 'TLA'),
	(115, 0, 'TMD'),
	(116, 0, 'TML'),
	(117, 0, 'TNG'),
	(118, 0, 'TPE'),
	(119, 0, 'TRD'),
	(120, 0, 'TRK'),
	(121, 0, 'TSL'),
	(122, 0, 'TSN'),
	(123, 0, 'ULI');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
