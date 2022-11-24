-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2022 at 01:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `Dosen`
--

CREATE TABLE `Dosen` (
  `NIP` int(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Dosen`
--

INSERT INTO `Dosen` (`NIP`, `nama`, `is_delete`) VALUES
(7, 'Gatra', b'0'),
(12, 'Chris John', b'0'),
(23, 'adli rafif', b'0'),
(34, 'afafaaf', b'0'),
(45, 'Adli', b'0'),
(50, 'halo', b'0'),
(60, 'Hal', b'0'),
(75, 'John Mayer', b'0'),
(78, 'halo', b'0'),
(80, 'John Mayer', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `Jadwal Mengajar`
--

CREATE TABLE `Jadwal Mengajar` (
  `kd_jadwal` int(4) NOT NULL,
  `nip_dosen` int(6) DEFAULT NULL,
  `kd_mk` char(6) DEFAULT NULL,
  `hari` varchar(10) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Jadwal Mengajar`
--

INSERT INTO `Jadwal Mengajar` (`kd_jadwal`, `nip_dosen`, `kd_mk`, `hari`, `is_delete`) VALUES
(4, 7, '10', 'Selasa', b'0'),
(5, 23, '23', 'Kamis', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `Mata Kuliah`
--

CREATE TABLE `Mata Kuliah` (
  `kd_mk` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Mata Kuliah`
--

INSERT INTO `Mata Kuliah` (`kd_mk`, `nama`, `is_delete`) VALUES
('10', 'Fisika Dasar I', b'0'),
('2', 'Algoritma & Pemrograman', b'0'),
('23', 'Sistem Basis Data I', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Dosen`
--
ALTER TABLE `Dosen`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `Jadwal Mengajar`
--
ALTER TABLE `Jadwal Mengajar`
  ADD PRIMARY KEY (`kd_jadwal`),
  ADD KEY `FK_nip` (`nip_dosen`),
  ADD KEY `FK_kd_mk` (`kd_mk`);

--
-- Indexes for table `Mata Kuliah`
--
ALTER TABLE `Mata Kuliah`
  ADD PRIMARY KEY (`kd_mk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Jadwal Mengajar`
--
ALTER TABLE `Jadwal Mengajar`
  MODIFY `kd_jadwal` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Jadwal Mengajar`
--
ALTER TABLE `Jadwal Mengajar`
  ADD CONSTRAINT `FK_kd_mk` FOREIGN KEY (`kd_mk`) REFERENCES `Mata Kuliah` (`kd_mk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_nip` FOREIGN KEY (`nip_dosen`) REFERENCES `Dosen` (`NIP`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
