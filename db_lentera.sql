-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2025 pada 19.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lentera`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_employee`
--

CREATE TABLE `tb_employee` (
  `id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL DEFAULT 0,
  `witel_id` int(11) NOT NULL DEFAULT 0,
  `mitra_id` int(11) NOT NULL DEFAULT 0,
  `level_id` int(11) NOT NULL DEFAULT 0,
  `nik` int(11) NOT NULL DEFAULT 0,
  `full_name` varchar(50) DEFAULT NULL,
  `chat_id` varchar(50) DEFAULT NULL,
  `number_phone` bigint(20) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `gender` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL COMMENT '0 : deactive, 1 : active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `regional_id`, `witel_id`, `mitra_id`, `level_id`, `nik`, `full_name`, `chat_id`, `number_phone`, `home_address`, `gender`, `date_of_birth`, `place_of_birth`, `remember_token`, `password`, `ip_address`, `login_at`, `is_active`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 6, 1, 3, 1, 16990591, 'Ahmad Hidayat', '611959936', NULL, NULL, 'Laki-Laki', NULL, NULL, 'ckeIZSXieNs1L7ktRHmAK4VIK6WDuhi95K77qom2q8Jnlvo7uUFu3gV1tVAS', '$2y$12$ggCLHdhCLBBv4HB3p/rRb.v33vK2QM57aHnXE0L5LPLg2AKh/deNa', '127.0.0.1', '2025-02-25 17:37:47', 1, NULL, NULL, NULL, '2025-02-25 17:37:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level`
--

CREATE TABLE `tb_level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_level`
--

INSERT INTO `tb_level` (`id`, `name`) VALUES
(1, 'Developer'),
(2, 'Direktur'),
(3, 'OSM'),
(4, 'General_Manager'),
(5, 'Manager'),
(6, 'Assistant_Manager'),
(7, 'Supervisor'),
(8, 'Team_Leader'),
(9, 'Staff_Admin'),
(10, 'Staff_Warehouse'),
(11, 'Helpdesk'),
(12, 'Technician');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `id` int(11) NOT NULL,
  `witel_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mitra`
--

INSERT INTO `tb_mitra` (`id`, `witel_id`, `name`) VALUES
(1, 1, 'PT Telkom Indonesia'),
(2, 1, 'PT Telkom Akses'),
(3, 1, 'PT Upaya Tehnik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_regional`
--

CREATE TABLE `tb_regional` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_regional`
--

INSERT INTO `tb_regional` (`id`, `name`, `alias`) VALUES
(1, 'Regional 1', NULL),
(2, 'Regional 2', NULL),
(3, 'Regional 3', NULL),
(4, 'Regional 4', NULL),
(5, 'Regional 5', NULL),
(6, 'Regional 6', 'Kalimantan'),
(7, 'Regional 7', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sector`
--

CREATE TABLE `tb_sector` (
  `id` int(11) NOT NULL,
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
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_team`
--

CREATE TABLE `tb_team` (
  `id` int(11) NOT NULL,
  `sector_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `technician1` int(11) DEFAULT 0,
  `technician2` int(11) DEFAULT 0,
  `is_active` int(11) DEFAULT 0 COMMENT '0 : deactive, 1 : active',
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_witel`
--

CREATE TABLE `tb_witel` (
  `id` int(11) NOT NULL,
  `regional_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_witel`
--

INSERT INTO `tb_witel` (`id`, `regional_id`, `name`, `alias`) VALUES
(1, 6, 'Banjarmasin', 'Kalsel'),
(2, 6, 'Balikpapan', NULL),
(3, 6, 'Palangkaraya', NULL),
(4, 6, 'Pontianak', NULL),
(5, 6, 'Samarinda', NULL),
(6, 6, 'Tarakan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `nik` (`nik`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `mitra_id` (`mitra_id`),
  ADD KEY `witel_id` (`witel_id`),
  ADD KEY `regional_id` (`regional_id`);

--
-- Indeks untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `witel_id` (`witel_id`);

--
-- Indeks untuk tabel `tb_regional`
--
ALTER TABLE `tb_regional`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_sector`
--
ALTER TABLE `tb_sector`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mitra_id` (`mitra_id`),
  ADD KEY `team_leader1` (`team_leader1`),
  ADD KEY `team_leader2` (`team_leader2`),
  ADD KEY `team_leader3` (`team_leader3`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `tb_team`
--
ALTER TABLE `tb_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sector_id` (`sector_id`),
  ADD KEY `technician1` (`technician1`),
  ADD KEY `technician2` (`technician2`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indeks untuk tabel `tb_witel`
--
ALTER TABLE `tb_witel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regional_id` (`regional_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_level`
--
ALTER TABLE `tb_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_regional`
--
ALTER TABLE `tb_regional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_sector`
--
ALTER TABLE `tb_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_team`
--
ALTER TABLE `tb_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_witel`
--
ALTER TABLE `tb_witel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
