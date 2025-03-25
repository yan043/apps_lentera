-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
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
CREATE DATABASE IF NOT EXISTS `db_lentera` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_lentera`;

-- Dumping structure for table db_lentera.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.cache: ~0 rows (approximately)
DELETE FROM `cache`;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_captcha_767a4b91ee70258f038cf0803a2611f1', 'a:6:{i:0;s:1:"u";i:1;s:1:"8";i:2;s:1:"c";i:3;s:1:"q";i:4;s:1:"f";i:5;s:1:"u";}', 1742922805);

-- Dumping structure for table db_lentera.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table db_lentera.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table db_lentera.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table db_lentera.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table db_lentera.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;

-- Dumping structure for table db_lentera.tb_api_insera
DROP TABLE IF EXISTS `tb_api_insera`;
CREATE TABLE IF NOT EXISTS `tb_api_insera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incident_number` bigint(20) NOT NULL DEFAULT 0,
  `incident` varchar(50) DEFAULT NULL,
  `ttr_customer` time DEFAULT NULL,
  `summary` varchar(50) DEFAULT NULL,
  `reported_date` datetime DEFAULT NULL,
  `date_reported` date DEFAULT NULL,
  `time_reported` time DEFAULT NULL,
  `owner_group` varchar(50) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `customer_segment` varchar(50) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `witel` varchar(10) DEFAULT NULL,
  `workzone` varchar(3) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `ticket_id_gamas` varchar(50) DEFAULT NULL,
  `reported_by` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `contact_email` varchar(50) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  `description_assigment` varchar(50) DEFAULT NULL,
  `reported_priority` varchar(50) DEFAULT NULL,
  `source_ticket` varchar(50) DEFAULT NULL,
  `subsidiary` varchar(50) DEFAULT NULL,
  `external_ticket_id` varchar(50) DEFAULT NULL,
  `channel` varchar(50) DEFAULT NULL,
  `customer_type` varchar(50) DEFAULT NULL,
  `closed_by` varchar(50) DEFAULT NULL,
  `closed_reopen_by` varchar(50) DEFAULT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `service_id` varchar(50) DEFAULT NULL,
  `service_no` bigint(20) DEFAULT NULL,
  `slg` varchar(50) DEFAULT NULL,
  `technology` varchar(50) DEFAULT NULL,
  `lapul` varchar(50) DEFAULT NULL,
  `gaul` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incident_number` (`incident_number`),
  KEY `workzone` (`workzone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_api_insera: ~0 rows (approximately)
DELETE FROM `tb_api_insera`;

-- Dumping structure for table db_lentera.tb_employee
DROP TABLE IF EXISTS `tb_employee`;
CREATE TABLE IF NOT EXISTS `tb_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regional_id` int(11) NOT NULL DEFAULT 0,
  `witel_id` int(11) NOT NULL DEFAULT 0,
  `mitra_id` int(11) NOT NULL DEFAULT 0,
  `sub_unit_id` int(11) NOT NULL DEFAULT 0,
  `sub_group_id` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 0,
  `nik` int(11) NOT NULL DEFAULT 0,
  `full_name` varchar(50) DEFAULT NULL,
  `chat_id` varchar(50) DEFAULT NULL,
  `number_phone` bigint(20) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `gender` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `google2fa_secret` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL COMMENT '0 : deactive, 1 : active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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

-- Dumping data for table db_lentera.tb_employee: ~2 rows (approximately)
DELETE FROM `tb_employee`;
INSERT INTO `tb_employee` (`id`, `regional_id`, `witel_id`, `mitra_id`, `sub_unit_id`, `sub_group_id`, `role_id`, `nik`, `full_name`, `chat_id`, `number_phone`, `home_address`, `gender`, `date_of_birth`, `place_of_birth`, `remember_token`, `google2fa_secret`, `password`, `ip_address`, `login_at`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(1, 4, 1, 3, 0, 0, 1, 16990591, 'Ahmad Hidayat', '611959936', NULL, NULL, 'Laki-Laki', NULL, NULL, 'hnlrlMuu5XVDnDNJHmXtmrBssz4a06IEFTcndbub6sHf0uBkHEgoj80tjyrk', NULL, '$2y$12$aU/DMYnrf2tA2wmQieCnfegrzjz1aAcB7FBZ.VtP1jrwp56v.OxDW', '127.0.0.1', '2025-02-27 20:22:13', 1, NULL, NULL, NULL, '2025-03-18 23:25:21'),
	(2, 4, 1, 2, 0, 0, 1, 981020, 'Mahdian', '401791818', NULL, NULL, 'Laki-Laki', '1998-10-26', NULL, 'cUkms30UUR3WCWH17mgo7XW7J62qc9lSYfCK3dvWoJd7G2sN5APbZrNzm5Tw', NULL, '$2y$12$aU/DMYnrf2tA2wmQieCnfegrzjz1aAcB7FBZ.VtP1jrwp56v.OxDW', '127.0.0.1', '2025-03-25 16:29:57', 1, NULL, NULL, NULL, '2025-03-25 16:29:57');

-- Dumping structure for table db_lentera.tb_inventory_reports
DROP TABLE IF EXISTS `tb_inventory_reports`;
CREATE TABLE IF NOT EXISTS `tb_inventory_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_reports_Id` int(11) NOT NULL DEFAULT 0,
  `order_type` varchar(50) DEFAULT NULL,
  `order_code` int(11) NOT NULL DEFAULT 0,
  `inventory_material_id` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `witel_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_segment_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_segment_id` (`order_segment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_action: ~1 rows (approximately)
DELETE FROM `tb_order_action`;

-- Dumping structure for table db_lentera.tb_order_segment
DROP TABLE IF EXISTS `tb_order_segment`;
CREATE TABLE IF NOT EXISTS `tb_order_segment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_segment: ~3 rows (approximately)
DELETE FROM `tb_order_segment`;
INSERT INTO `tb_order_segment` (`id`, `name`) VALUES
	(1, 'CPE'),
	(2, 'ONT');

-- Dumping structure for table db_lentera.tb_order_status
DROP TABLE IF EXISTS `tb_order_status`;
CREATE TABLE IF NOT EXISTS `tb_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_id` int(11) DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_status_id` (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_order_sub_status: ~3 rows (approximately)
DELETE FROM `tb_order_sub_status`;
INSERT INTO `tb_order_sub_status` (`id`, `order_status_id`, `name`) VALUES
	(1, 1, 'NEED-PROGRESS'),
	(2, 2, 'BERANGKAT');

-- Dumping structure for table db_lentera.tb_regional
DROP TABLE IF EXISTS `tb_regional`;
CREATE TABLE IF NOT EXISTS `tb_regional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_regional: ~5 rows (approximately)
DELETE FROM `tb_regional`;
INSERT INTO `tb_regional` (`id`, `name`, `alias`) VALUES
	(1, 'Regional 1', NULL),
	(2, 'Regional 2', NULL),
	(3, 'Regional 3', NULL),
	(4, 'Regional 4', 'Kalimantan'),
	(5, 'Regional 5', 'null');

-- Dumping structure for table db_lentera.tb_roles_permissions
DROP TABLE IF EXISTS `tb_roles_permissions`;
CREATE TABLE IF NOT EXISTS `tb_roles_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mitra_id` int(11) NOT NULL DEFAULT 0,
  `chat_id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `team_leader1` int(11) DEFAULT 0,
  `team_leader2` int(11) DEFAULT 0,
  `team_leader3` int(11) DEFAULT 0,
  `is_active` int(11) DEFAULT 0 COMMENT '0 : deactive, 1 : active',
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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

-- Dumping structure for table db_lentera.tb_sub_group
DROP TABLE IF EXISTS `tb_sub_group`;
CREATE TABLE IF NOT EXISTS `tb_sub_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regional_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `technician1` int(11) DEFAULT 0,
  `technician2` int(11) DEFAULT 0,
  `is_active` int(11) DEFAULT 0 COMMENT '0 : deactive, 1 : active',
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sector_id` (`sector_id`),
  KEY `technician1` (`technician1`),
  KEY `technician2` (`technician2`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_team: ~0 rows (approximately)
DELETE FROM `tb_team`;

-- Dumping structure for table db_lentera.tb_transaction_orders
DROP TABLE IF EXISTS `tb_transaction_orders`;
CREATE TABLE IF NOT EXISTS `tb_transaction_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_type` varchar(50) DEFAULT NULL,
  `order_code` bigint(20) NOT NULL DEFAULT 0,
  `team_id` int(11) DEFAULT 0,
  `team_name` varchar(50) DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `assign_labels` varchar(50) DEFAULT NULL,
  `assign_notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `team_id` (`team_id`),
  KEY `order_code` (`order_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_transaction_orders: ~0 rows (approximately)
DELETE FROM `tb_transaction_orders`;

-- Dumping structure for table db_lentera.tb_transaction_reports
DROP TABLE IF EXISTS `tb_transaction_reports`;
CREATE TABLE IF NOT EXISTS `tb_transaction_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_orders_id` int(11) NOT NULL DEFAULT 0,
  `order_substatus_id` int(11) NOT NULL DEFAULT 0,
  `team_id` int(11) NOT NULL DEFAULT 0,
  `team_name` varchar(50) DEFAULT NULL,
  `report_notes` varchar(50) DEFAULT NULL,
  `odp_name` varchar(50) DEFAULT NULL,
  `odp_coordinates` varchar(50) DEFAULT NULL,
  `customer_phone_number` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `transaction_orders_id` (`transaction_orders_id`),
  KEY `order_substatus_id` (`order_substatus_id`),
  KEY `team_id` (`team_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_transaction_reports: ~0 rows (approximately)
DELETE FROM `tb_transaction_reports`;

-- Dumping structure for table db_lentera.tb_witel
DROP TABLE IF EXISTS `tb_witel`;
CREATE TABLE IF NOT EXISTS `tb_witel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regional_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regional_id` (`regional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_lentera.tb_witel: ~7 rows (approximately)
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
