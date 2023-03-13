-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 04:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', '704b037a97fa9b25522b7c014c300f8a', '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) NOT NULL,
  `id_tipe` bigint(20) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `detail_barang` text NOT NULL,
  `foto_barang` varchar(100) DEFAULT NULL,
  `kondisi_barang` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

CREATE TABLE `contact_person` (
  `id` bigint(20) NOT NULL,
  `id_karyawan` bigint(20) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `hub_keluarga` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_kembali`
--

CREATE TABLE `inventaris_kembali` (
  `id` bigint(20) NOT NULL,
  `id_inventaris_terima` int(25) NOT NULL,
  `tgl_kembali` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kondisi_kembali` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris_terima`
--

CREATE TABLE `inventaris_terima` (
  `id` bigint(20) NOT NULL,
  `id_karyawan` bigint(20) NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `tgl_terima` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kondisi_terima` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) NOT NULL,
  `no_ktp` varchar(17) DEFAULT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `ttl` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email_pribadi` varchar(100) DEFAULT NULL,
  `email_kantor` varchar(100) DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL,
  `tgl_masuk_kerja` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_lokasi` bigint(20) NOT NULL,
  `status_karyawan` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_kerja`
--

CREATE TABLE `lokasi_kerja` (
  `id` bigint(20) NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi_kerja`
--

INSERT INTO `lokasi_kerja` (`id`, `lokasi`) VALUES
(1, 'SURABAYA'),
(2, 'JAKARTA'),
(3, 'BANDUNG');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_barang`
--

CREATE TABLE `tipe_barang` (
  `id` bigint(20) NOT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `form_input_barang` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_barang`
--

INSERT INTO `tipe_barang` (`id`, `tipe`, `form_input_barang`) VALUES
(1, 'Laptop', '[{\"key\":\"sn\",\"value\":\"S/N Laptop\"},{\"key\":\"model_l\",\"value\":\"Model Laptop\"},{\"key\":\"proc\",\"value\":\"Processor Laptop\"},{\"key\":\"memory\",\"value\":\"Memory RAM\"},{\"key\":\"hardisk\",\"value\":\"Ukuran HDD/SSD\"},{\"key\":\"monitor\",\"value\":\"Ukuran Monitor\"},{\"key\":\"so\",\"value\":\"Sistem Operasi & Lisensi\"},{\"key\":\"mac\",\"value\":\"MAC Address\"},{\"key\":\"ip\",\"value\":\"IP\"}]'),
(2, 'Handphone', '[{\"key\":\"model_h\",\"value\":\"Model Handphone\"},{\"key\":\"thn_p\",\"value\":\"Tahun Pengeluaran\"},{\"key\":\"memory_r\",\"value\":\"Memory RAM\"},{\"key\":\"memory_i\",\"value\":\"Memory Intenrnal\"},{\"key\":\"warna\",\"value\":\"Warna\"},{\"key\":\"versi_os\",\"value\":\"Versi OS\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventaris_kembali`
--
ALTER TABLE `inventaris_kembali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventaris_terima`
--
ALTER TABLE `inventaris_terima`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_kerja`
--
ALTER TABLE `lokasi_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris_kembali`
--
ALTER TABLE `inventaris_kembali`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris_terima`
--
ALTER TABLE `inventaris_terima`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_kerja`
--
ALTER TABLE `lokasi_kerja`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipe_barang`
--
ALTER TABLE `tipe_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
