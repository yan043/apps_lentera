-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_lentera
DROP DATABASE IF EXISTS `db_lentera`;
CREATE DATABASE IF NOT EXISTS `db_lentera` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_lentera`;

-- Dumping structure for table db_lentera.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.cache: ~4 rows (approximately)
DELETE FROM `cache`;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_captcha_3a376d508c586cf0756ba76e290860dc', 'a:6:{i:0;s:1:"8";i:1;s:1:"z";i:2;s:1:"7";i:3;s:1:"x";i:4;s:1:"e";i:5;s:1:"n";}', 1743729622),
	('laravel_cache_captcha_716bffebc867da9107aef722c404af5b', 'a:6:{i:0;s:1:"q";i:1;s:1:"e";i:2;s:1:"e";i:3;s:1:"a";i:4;s:1:"z";i:5;s:1:"j";}', 1747539093),
	('laravel_cache_captcha_7ea001c410820f98259205c4dcfeef13', 'a:6:{i:0;s:1:"u";i:1;s:1:"d";i:2;s:1:"t";i:3;s:1:"c";i:4;s:1:"e";i:5;s:1:"r";}', 1747538929),
	('laravel_cache_captcha_f540b09008ac910e4da06b44f16f960d', 'a:6:{i:0;s:1:"7";i:1;s:1:"y";i:2;s:1:"u";i:3;s:1:"u";i:4;s:1:"9";i:5;s:1:"h";}', 1747539032);

-- Dumping structure for table db_lentera.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table db_lentera.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
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

-- Dumping data for table db_lentera.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table db_lentera.jobs
DROP TABLE IF EXISTS `jobs`;
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

-- Dumping data for table db_lentera.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table db_lentera.job_batches
DROP TABLE IF EXISTS `job_batches`;
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

-- Dumping data for table db_lentera.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table db_lentera.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;

-- Dumping structure for table db_lentera.tb_assign_orders
DROP TABLE IF EXISTS `tb_assign_orders`;
CREATE TABLE IF NOT EXISTS `tb_assign_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_id` bigint NOT NULL DEFAULT '0',
  `team_id` int DEFAULT '0',
  `team_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `assign_labels` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assign_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `team_id` (`team_id`),
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `order_code` (`order_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_assign_orders: ~0 rows (approximately)
DELETE FROM `tb_assign_orders`;

-- Dumping structure for table db_lentera.tb_assign_order_reports
DROP TABLE IF EXISTS `tb_assign_order_reports`;
CREATE TABLE IF NOT EXISTS `tb_assign_order_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assign_order_id` int NOT NULL DEFAULT '0',
  `order_substatus_id` int NOT NULL DEFAULT '0',
  `team_id` int NOT NULL DEFAULT '0',
  `team_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_notes` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odp_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `odp_coordinates` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_home_latitude` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_home_longitude` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_substatus_id` (`order_substatus_id`),
  KEY `team_id` (`team_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `assign_order_id` (`assign_order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_assign_order_reports: ~0 rows (approximately)
DELETE FROM `tb_assign_order_reports`;

-- Dumping structure for table db_lentera.tb_auth_storage
DROP TABLE IF EXISTS `tb_auth_storage`;
CREATE TABLE IF NOT EXISTS `tb_auth_storage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `apps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cookies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_auth_storage: ~0 rows (approximately)
DELETE FROM `tb_auth_storage`;
INSERT INTO `tb_auth_storage` (`id`, `apps`, `username`, `password`, `cookies`, `last_updated_at`) VALUES
	(1, 'insera', '20981020', '403!@#InSeRa', 'JSESSIONID=prDPxae0IDnkByeUoZd70hXb7JLPO1cAZ5ncV-mv.cident-7784cbc4f9-zpvds; a10e07c589b0b6a4b246720bbb392af5=f63a3db26f22bc65aee5e7485fc12d69;', '2025-04-03 19:54:37');

-- Dumping structure for table db_lentera.tb_employee
DROP TABLE IF EXISTS `tb_employee`;
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
  `gender` enum('Laki-Laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google2fa_secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'default : 12345678',
  `ip_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `is_active` int DEFAULT NULL COMMENT '0 : deactive, 1 : active',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_employee: ~1 rows (approximately)
DELETE FROM `tb_employee`;
INSERT INTO `tb_employee` (`id`, `regional_id`, `witel_id`, `mitra_id`, `sub_unit_id`, `sub_group_id`, `role_id`, `nik`, `full_name`, `chat_id`, `number_phone`, `home_address`, `gender`, `date_of_birth`, `place_of_birth`, `remember_token`, `google2fa_secret`, `password`, `ip_address`, `login_at`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(1, 4, 1, 2, 1, 2, 1, 981020, 'Mahdian', '401791818', NULL, NULL, 'Laki-Laki', NULL, NULL, NULL, NULL, '$2y$12$ZAGm4XKSOQNhm9j4fK/fBeA.i5sxrsZwyi2sjj0mmueGTGDurKmBm', '127.0.0.1', '2025-05-18 03:35:22', 1, NULL, NULL, NULL, '2025-05-19 10:45:06');

-- Dumping structure for table db_lentera.tb_inventory_reports
DROP TABLE IF EXISTS `tb_inventory_reports`;
CREATE TABLE IF NOT EXISTS `tb_inventory_reports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_reports_Id` int NOT NULL DEFAULT '0',
  `order_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_code` int NOT NULL DEFAULT '0',
  `inventory_material_id` int NOT NULL DEFAULT '0',
  `qty` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `transaction_reports_Id` (`transaction_reports_Id`),
  KEY `order_code` (`order_code`),
  KEY `inventory_material_id` (`inventory_material_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_inventory_reports: ~0 rows (approximately)
DELETE FROM `tb_inventory_reports`;

-- Dumping structure for table db_lentera.tb_mitra
DROP TABLE IF EXISTS `tb_mitra`;
CREATE TABLE IF NOT EXISTS `tb_mitra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `witel_id` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `witel_id` (`witel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_mitra: ~3 rows (approximately)
DELETE FROM `tb_mitra`;
INSERT INTO `tb_mitra` (`id`, `witel_id`, `name`, `alias`) VALUES
	(1, 1, 'PT Telkom Indonesia', 'TI'),
	(2, 1, 'PT Telkom Akses', 'TA'),
	(3, 1, 'PT Upaya Tehnik', 'UPATEK');

-- Dumping structure for table db_lentera.tb_order_action
DROP TABLE IF EXISTS `tb_order_action`;
CREATE TABLE IF NOT EXISTS `tb_order_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_segment_id` int DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_segment_id` (`order_segment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_action: ~0 rows (approximately)
DELETE FROM `tb_order_action`;

-- Dumping structure for table db_lentera.tb_order_segment
DROP TABLE IF EXISTS `tb_order_segment`;
CREATE TABLE IF NOT EXISTS `tb_order_segment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_segment: ~2 rows (approximately)
DELETE FROM `tb_order_segment`;
INSERT INTO `tb_order_segment` (`id`, `name`) VALUES
	(1, 'CPE'),
	(2, 'ONT');

-- Dumping structure for table db_lentera.tb_order_status
DROP TABLE IF EXISTS `tb_order_status`;
CREATE TABLE IF NOT EXISTS `tb_order_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_status: ~6 rows (approximately)
DELETE FROM `tb_order_status`;
INSERT INTO `tb_order_status` (`id`, `name`) VALUES
	(1, 'READY'),
	(2, 'ON-PROGRESS'),
	(3, 'DONE'),
	(4, 'CUST-ISSUE'),
	(5, 'TECH-ISSUE'),
	(6, 'EXTERNAL-ISSUE');

-- Dumping structure for table db_lentera.tb_order_sub_status
DROP TABLE IF EXISTS `tb_order_sub_status`;
CREATE TABLE IF NOT EXISTS `tb_order_sub_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_status_id` int DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_status_id` (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_sub_status: ~2 rows (approximately)
DELETE FROM `tb_order_sub_status`;
INSERT INTO `tb_order_sub_status` (`id`, `order_status_id`, `name`) VALUES
	(1, 1, 'NEED-PROGRESS'),
	(2, 2, 'BERANGKAT');

-- Dumping structure for table db_lentera.tb_regional
DROP TABLE IF EXISTS `tb_regional`;
CREATE TABLE IF NOT EXISTS `tb_regional` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_regional: ~5 rows (approximately)
DELETE FROM `tb_regional`;
INSERT INTO `tb_regional` (`id`, `name`, `alias`) VALUES
	(1, 'Regional 1', NULL),
	(2, 'Regional 2', NULL),
	(3, 'Regional 3', NULL),
	(4, 'Regional 4', 'Kalimantan'),
	(5, 'Regional 5', NULL);

-- Dumping structure for table db_lentera.tb_roles_permissions
DROP TABLE IF EXISTS `tb_roles_permissions`;
CREATE TABLE IF NOT EXISTS `tb_roles_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_roles_permissions: ~16 rows (approximately)
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
	(16, 'Technician');

-- Dumping structure for table db_lentera.tb_sector
DROP TABLE IF EXISTS `tb_sector`;
CREATE TABLE IF NOT EXISTS `tb_sector` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mitra_id` int NOT NULL DEFAULT '0',
  `chat_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `team_leader1` int DEFAULT '0',
  `team_leader2` int DEFAULT '0',
  `team_leader3` int DEFAULT '0',
  `is_active` int DEFAULT '0' COMMENT '0 : deactive, 1 : active',
  `created_by` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mitra_id` (`mitra_id`),
  KEY `team_leader1` (`team_leader1`),
  KEY `team_leader2` (`team_leader2`),
  KEY `team_leader3` (`team_leader3`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_sector: ~0 rows (approximately)
DELETE FROM `tb_sector`;

-- Dumping structure for table db_lentera.tb_source_bima
DROP TABLE IF EXISTS `tb_source_bima`;
CREATE TABLE IF NOT EXISTS `tb_source_bima` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_datecreated` datetime DEFAULT NULL,
  `c_datemodified` datetime DEFAULT NULL,
  `c_wonum_id` bigint DEFAULT '0',
  `c_wonum` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_scorderno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_jmscorrelationid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_servicenum` bigint NOT NULL DEFAULT 0,
  `c_description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_crmordertype` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_ownergroup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_productname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_serviceaddress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `c_tk_subregion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_workzone` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_siteid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c_statusdate` datetime DEFAULT NULL,
  `c_schedstart` datetime DEFAULT NULL,
  `c_contact_telephone_number` bigint NOT NULL DEFAULT 0,
  `c_measurement` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  KEY `c_wonum` (`c_wonum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_source_bima: ~0 rows (approximately)
DELETE FROM `tb_source_bima`;

-- Dumping structure for table db_lentera.tb_source_insera
DROP TABLE IF EXISTS `tb_source_insera`;
CREATE TABLE IF NOT EXISTS `tb_source_insera` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(50) DEFAULT NULL,
  `incident_id` bigint NOT NULL DEFAULT '0',
  `incident` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ttr_customer` time DEFAULT NULL,
  `summary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `reported_date` datetime DEFAULT NULL,
  `date_reported` date DEFAULT NULL,
  `time_reported` time DEFAULT NULL,
  `owner_group` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `customer_segment` varchar(100) DEFAULT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `witel` varchar(100) DEFAULT NULL,
  `workzone` varchar(3) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `ticket_id_gamas` varchar(100) DEFAULT NULL,
  `reported_by` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(100) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `description_assigment` varchar(100) DEFAULT NULL,
  `reported_priority` varchar(100) DEFAULT NULL,
  `source_ticket` varchar(100) DEFAULT NULL,
  `subsidiary` varchar(100) DEFAULT NULL,
  `external_ticket_id` varchar(100) DEFAULT NULL,
  `channel` int NOT NULL DEFAULT '0',
  `customer_type` varchar(100) DEFAULT NULL,
  `closed_by` varchar(50) DEFAULT NULL,
  `closed_reopen_by` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `service_id` varchar(100) DEFAULT NULL,
  `service_no2` varchar(50) DEFAULT NULL,
  `service_no` bigint NOT NULL DEFAULT '0',
  `slg` varchar(100) DEFAULT NULL,
  `technology` varchar(100) DEFAULT NULL,
  `lapul` int NOT NULL DEFAULT 0,
  `gaul` int NOT NULL DEFAULT 0,
  `onu_rx` varchar(100) DEFAULT NULL,
  `pending_reason` varchar(100) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `incident_domain` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `symptom` varchar(100) DEFAULT NULL,
  `hierarchy_path` varchar(100) DEFAULT NULL,
  `solution` varchar(100) DEFAULT NULL,
  `description_actual_solution` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `kode_produk` varchar(100) DEFAULT NULL,
  `perangkat` varchar(100) DEFAULT NULL,
  `odp_name` varchar(100) DEFAULT NULL,
  `technician` varchar(100) DEFAULT NULL,
  `device_name` varchar(100) DEFAULT NULL,
  `worklog_summary` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `last_update_worklog` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `classification_flag` varchar(100) DEFAULT NULL,
  `realm` varchar(100) DEFAULT NULL,
  `related_to_gamas` varchar(100) DEFAULT NULL,
  `tsc_result` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `scc_result` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `ttr_agent` time DEFAULT NULL,
  `ttr_mitra` time DEFAULT NULL,
  `ttr_nasional` time DEFAULT NULL,
  `ttr_pending` time DEFAULT NULL,
  `ttr_region` time DEFAULT NULL,
  `ttr_witel` time DEFAULT NULL,
  `ttr_end_to_end` time DEFAULT NULL,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `guarante_status` varchar(100) DEFAULT NULL,
  `resolve_date` datetime DEFAULT NULL,
  `sn_ont` varchar(100) DEFAULT NULL,
  `tipe_ont` varchar(100) DEFAULT NULL,
  `manufacture_ont` varchar(100) DEFAULT NULL,
  `impacted_site` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `cause` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `resolution` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `notes_eskalasi` text,
  `rk_information` varchar(50) DEFAULT NULL,
  `external_ticket_tier_3` varchar(50) DEFAULT NULL,
  `customer_category` varchar(50) DEFAULT NULL,
  `classification_path` varchar(50) DEFAULT NULL,
  `teritory_near_end` varchar(50) DEFAULT NULL,
  `teritory_far_end` varchar(50) DEFAULT NULL,
  `urgency` varchar(50) DEFAULT NULL,
  `urgency_description` text,
  `last_updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `incident_id` (`incident_id`),
  KEY `incident` (`incident`),
  KEY `service_no` (`service_no`),
  KEY `workzone` (`workzone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_lentera.tb_source_insera: ~0 rows (approximately)
DELETE FROM `tb_source_insera`;

-- Dumping structure for table db_lentera.tb_sub_group
DROP TABLE IF EXISTS `tb_sub_group`;
CREATE TABLE IF NOT EXISTS `tb_sub_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_sub_group: ~40 rows (approximately)
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

-- Dumping structure for table db_lentera.tb_sub_unit
DROP TABLE IF EXISTS `tb_sub_unit`;
CREATE TABLE IF NOT EXISTS `tb_sub_unit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int NOT NULL DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_sub_unit: ~9 rows (approximately)
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

-- Dumping structure for table db_lentera.tb_team
DROP TABLE IF EXISTS `tb_team`;
CREATE TABLE IF NOT EXISTS `tb_team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sector_id` int DEFAULT '0',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `technician1` int DEFAULT '0',
  `technician2` int DEFAULT '0',
  `is_active` int DEFAULT '0' COMMENT '0 : deactive, 1 : active',
  `created_by` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT '0',
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sector_id` (`sector_id`),
  KEY `technician1` (`technician1`),
  KEY `technician2` (`technician2`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_team: ~0 rows (approximately)
DELETE FROM `tb_team`;

-- Dumping structure for table db_lentera.tb_witel
DROP TABLE IF EXISTS `tb_witel`;
CREATE TABLE IF NOT EXISTS `tb_witel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regional_id` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alias` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_witel: ~6 rows (approximately)
DELETE FROM `tb_witel`;
INSERT INTO `tb_witel` (`id`, `regional_id`, `name`, `alias`) VALUES
	(1, 4, 'Banjarmasin', 'Kalsel'),
	(2, 4, 'Balikpapan', NULL),
	(3, 4, 'Palangkaraya', NULL),
	(4, 4, 'Pontianak', NULL),
	(5, 4, 'Samarinda', NULL),
	(6, 4, 'Tarakan', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
