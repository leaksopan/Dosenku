-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 02:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dosenku`
--

-- --------------------------------------------------------

--
-- Table structure for table `bab`
--

CREATE TABLE `bab` (
  `id` int(11) NOT NULL,
  `matakuliah_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bab`
--

INSERT INTO `bab` (`id`, `matakuliah_id`, `judul`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pengenalan Algoritma', 'Dasar-dasar algoritma dan pemecahan masalah', 1, '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(2, 1, 'Array dan String', 'Manipulasi array dan string dalam pemrograman', 2, '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(3, 1, 'Linked List', 'Struktur data linked list dan implementasinya', 3, '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(4, 1, 'Stack dan Queue', 'Implementasi struktur data stack dan queue', 4, '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(5, 1, 'Tree dan Graph', 'Struktur data hierarkis dan graph', 5, '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(7, 13, 'AS', 'AS', 0, '2025-03-11 00:37:28', '2025-03-11 00:37:28'),
(8, 12, 'test', 'test', 0, '2025-03-11 00:52:42', '2025-03-11 00:52:42'),
(10, 12, 'PErhitungan Dasar', 'PErhitungan Dasar', 0, '2025-03-11 05:21:11', '2025-03-11 05:21:11'),
(11, 12, 'batuan Rumah', 'batuan Rumah', 0, '2025-03-11 05:21:21', '2025-03-11 05:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `judul`, `konten`, `gambar`, `created_at`, `updated_at`) VALUES
(3, '123', '<p>123</p>\r\n', 'retail_lvling_thumbnail_2.png', '2025-03-11 02:57:09', '2025-03-11 02:57:09'),
(4, '2342342342', '<p>4234234234234234<br />\r\n<br />\r\nbiiuhhahid<br />\r\n<br />\r\nALOwdaWd<br />\r\n<br />\r\ndA{PWDK<br />\r\n<br />\r\na[pwkd<br />\r\n<br />\r\nA<br />\r\nWD{K</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>AWD</td>\r\n			<td>AW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>AWD</td>\r\n			<td>AWD</td>\r\n		</tr>\r\n		<tr>\r\n			<td>AWD</td>\r\n			<td>AWD</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'linkedin_banner_(2).png', '2025-03-11 04:14:03', '2025-03-11 04:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Sipil', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(2, 'Informatika', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(3, 'Teknik Elektro', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(4, 'Teknik Mesin', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(5, 'Arsitektur', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(6, 'Gaming', '2025-03-09 21:28:33', '2025-03-10 01:03:55'),
(7, 'test', '2025-03-10 17:30:11', '2025-03-10 17:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'fa-book',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id`, `nama`, `jurusan_id`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Algoritma dan Struktur Data', 2, 'fa-code', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(2, 'Pemrograman Dasar', 2, 'fa-laptop-code', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(3, 'Basis Data', 2, 'fa-database', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(4, 'Sistem Operasi', 2, 'fa-microchip', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(5, 'Jaringan Komputer', 2, 'fa-network-wired', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(6, 'Rekayasa Perangkat Lunak', 2, 'fa-cogs', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(7, 'Analisis dan Perancangan Sistem', 2, 'fa-project-diagram', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(8, 'Teori Bahasa dan Otomata', 2, 'fa-language', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(9, 'Keamanan Informasi', 2, 'fa-shield-alt', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(10, 'Pengembangan Web', 2, 'fa-globe', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(11, 'Kecerdasan Buatan', 2, 'fa-brain', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(12, 'Mekanika Tanah', 1, 'fa-mountain', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(13, 'Struktur Beton', 1, 'fa-building', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(16, 'Rangkaian Listrik', 3, 'fa-bolt', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(17, 'Elektronika Digital', 3, 'fa-microchip', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(18, 'Sistem Kontrol', 3, 'fa-sliders-h', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(19, 'Teknik Tegangan Tinggi', 3, 'fa-plug', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(20, 'Termodinamika', 4, 'fa-temperature-high', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(21, 'Mekanika Fluida', 4, 'fa-wind', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(26, 'Sejarah Arsitektur', 5, 'fa-monument', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(27, 'Studio Perancangan', 5, 'fa-pencil-ruler', '2025-03-10 03:49:18', '2025-03-10 03:49:18'),
(28, 'Wow', 6, 'fa-code', '2025-03-10 04:28:50', '2025-03-10 08:02:07'),
(30, 'Dota', 6, 'fa-book', '2025-03-10 01:03:43', '2025-03-10 01:03:43'),
(31, 'test matkul', 7, 'fa-language', '2025-03-10 17:30:30', '2025-03-10 17:30:30'),
(32, 'HOK', 1, 'fa-laptop-code', '2025-03-10 19:26:34', '2025-03-10 19:26:34'),
(33, 'AI teknik ', 1, 'fa-brain', '2025-03-10 19:39:25', '2025-03-10 19:39:25'),
(34, 'asddawd', 1, 'fa-laptop-code', '2025-03-10 19:40:00', '2025-03-10 19:40:00'),
(35, 'apa kaden', 1, 'fa-code', '2025-03-10 19:44:26', '2025-03-10 19:44:26'),
(36, 'awd13123', 1, 'fa-microchip', '2025-03-10 19:51:19', '2025-03-10 19:51:19'),
(37, 'tresna bodoh', 1, 'fa-database', '2025-03-10 20:01:36', '2025-03-10 20:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `sub_bab_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text DEFAULT NULL,
  `file_lampiran` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `sub_bab_id`, `judul`, `konten`, `file_lampiran`, `urutan`, `created_at`, `updated_at`) VALUES
(2, 3, 'PErkalian Biasa', 'asdadwasdwadwadasdwa', NULL, 0, '2025-03-11 05:21:49', '2025-03-11 05:21:55'),
(3, 3, 'PErkaliuan Kuadrat', 'asdadwd', NULL, 0, '2025-03-11 05:22:05', '2025-03-11 05:22:19'),
(4, 3, 'Perkalian Aljabar', '', NULL, 0, '2025-03-11 05:22:12', '2025-03-11 05:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `subbab`
--

CREATE TABLE `subbab` (
  `id` int(11) NOT NULL,
  `bab_id` int(11) NOT NULL,
  `nama_sub_bab` varchar(255) NOT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subbab`
--

INSERT INTO `subbab` (`id`, `bab_id`, `nama_sub_bab`, `urutan`, `created_at`, `updated_at`) VALUES
(2, 8, 'asd', 0, '2025-03-11 01:04:03', '2025-03-11 01:04:03'),
(3, 10, 'Perkalian', 0, '2025-03-11 05:21:31', '2025-03-11 05:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `is_active`, `last_login`, `created_at`) VALUES
(10, 'diva', 'asdasd', 'asd@gmail.com', 'admin', 1, NULL, '2025-03-10 04:14:12'),
(11, 'admin', '$2y$10$L1WKgYv5TRtRVpqEXWsYs.bBU0PJrBY6cWzMNhLenU4DHQFwaDlY6', 'admin@dosenku.com', 'admin', 1, '2025-03-11 08:48:40', '2025-03-10 04:21:27'),
(12, 'dosen', '$2y$10$kx4qWTegiKFq.V7ZGIcLv.n5.qH4dyuQGK3MBDZDDyE66M7WwWmg2', 'dosen@dosenku.com', 'dosen', 1, NULL, '2025-03-10 04:21:27'),
(13, 'mahasiswa', '$2y$10$z66nHBjBOdSzrLBccMJKI.NH5k9DRv/fBlLj9fecpekoTAy9I9Gye', 'mhs@dosenku.com', 'mahasiswa', 1, NULL, '2025-03-10 04:21:27'),
(14, 'leaksopan', '$2y$10$uTLukDNVpsqDpoXLix6SQ.PCWZtIinAdb.xNwddAiN8fjYFsfBKsW', 'cipta5772@gmail.com', 'dosen', 1, NULL, '2025-03-11 05:19:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bab`
--
ALTER TABLE `bab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matakuliah_id` (`matakuliah_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_bab_id` (`sub_bab_id`);

--
-- Indexes for table `subbab`
--
ALTER TABLE `subbab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bab_id` (`bab_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bab`
--
ALTER TABLE `bab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subbab`
--
ALTER TABLE `subbab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bab`
--
ALTER TABLE `bab`
  ADD CONSTRAINT `bab_ibfk_1` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_subbab_fk` FOREIGN KEY (`sub_bab_id`) REFERENCES `subbab` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subbab`
--
ALTER TABLE `subbab`
  ADD CONSTRAINT `subbab_ibfk_1` FOREIGN KEY (`bab_id`) REFERENCES `bab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
