-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2024 at 03:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `batubara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$4f7LTw5xakrvLXrFuKuMfutN/9nOv0tU8G8NtXngWjafWPElP/0L.');

-- --------------------------------------------------------

--
-- Table structure for table `kepadatan`
--

CREATE TABLE `kepadatan` (
  `provinsi` varchar(225) NOT NULL,
  `kabupaten` varchar(225) NOT NULL,
  `kodedagri` varchar(225) NOT NULL,
  `kecamatan` varchar(225) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepadatan`
--

INSERT INTO `kepadatan` (`provinsi`, `kabupaten`, `kodedagri`, `kecamatan`, `jumlah`) VALUES
('SUMATERA UTARA', 'BATU BARA', '1219010', 'SEIBALAI', 40000),
('SUMATERA UTARA', 'BATU BARA', '1219020', 'TANJUNGTIRAM', 68210),
('SUMATERA UTARA', 'BATU BARA', '1219030', 'TALAWI', 53000),
('SUMATERA UTARA', 'BATU BARA', '1219040', 'LIMAPULUH', 90667),
('SUMATERA UTARA', 'BATU BARA', '1219050', 'AIRPUTIH', 50317),
('SUMATERA UTARA', 'BATU BARA', '1219060', 'SEISUKA', 56078),
('SUMATERA UTARA', 'BATU BARA', '1219070', 'MEDANGDERAS', 53109);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `alamat`, `lat`, `lng`, `kategori`, `foto`) VALUES
(1, 'MASJID RAYA AR RAHMAN', 'Batu Bara', 3.20519135, 99.56808190, 'Masjid', NULL),
(2, 'Gereja HKBP Tanah Datar', 'Batu Bara', 3.16726549, 99.55895161, 'Gereja', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepadatan`
--
ALTER TABLE `kepadatan`
  ADD PRIMARY KEY (`kodedagri`),
  ADD KEY `idx_kodedagri` (`kodedagri`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
