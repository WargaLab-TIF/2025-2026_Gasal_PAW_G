-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2025 at 04:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `nama_pelanggan`, `total`, `keterangan`) VALUES
(1, '2025-11-01', 'Andi', 150000.00, 'Self Pickup'),
(2, '2025-11-01', 'Budi', 220000.00, 'Delivery Order'),
(3, '2025-11-02', 'Citra', 175000.00, 'Self Pickup'),
(4, '2025-11-02', 'Dina', 260000.00, 'Delivery Order'),
(5, '2025-11-03', 'Eko', 310000.00, 'Self Pickup'),
(6, '2025-11-03', 'Farhan', 185000.00, 'Delivery Order'),
(7, '2025-11-04', 'Gita', 295000.00, 'Self Pickup'),
(8, '2025-11-04', 'Hadi', 205000.00, 'Delivery Order'),
(9, '2025-11-05', 'Indra', 160000.00, 'Self Pickup'),
(10, '2025-11-05', 'Joko', 240000.00, 'Delivery Order'),
(11, '2025-11-06', 'Kania', 275000.00, 'Self Pickup'),
(12, '2025-11-06', 'Lia', 180000.00, 'Delivery Order'),
(13, '2025-11-07', 'Miko', 330000.00, 'Self Pickup'),
(14, '2025-11-07', 'Nina', 210000.00, 'Delivery Order'),
(15, '2025-11-08', 'Omar', 350000.00, 'Self Pickup'),
(16, '2025-11-08', 'Putri', 195000.00, 'Delivery Order'),
(17, '2025-11-09', 'Qori', 270000.00, 'Self Pickup'),
(18, '2025-11-09', 'Rafi', 250000.00, 'Delivery Order'),
(19, '2025-11-10', 'Santi', 300000.00, 'Self Pickup'),
(20, '2025-11-10', 'Tono', 220000.00, 'Delivery Order'),
(23, '2025-11-10', 'biyan', 150000.00, 'Self pickup');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
