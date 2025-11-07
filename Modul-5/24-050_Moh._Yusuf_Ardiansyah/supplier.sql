-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 03:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Maju Jaya', '021-1110001', 'Jl. Raya Bogor No.1'),
(2, 'CV Makmur Sentosa', '021-1110002', 'Jl. Sudirman No.2'),
(3, 'UD Berkah Abadi', '021-1110003', 'Jl. Ahmad Yani No.3'),
(4, 'PT Sejahtera Bersama', '021-1110004', 'Jl. Diponegoro No.4'),
(5, 'CV Sumber Rejeki', '021-1110005', 'Jl. Gatot Subroto No.5'),
(6, 'PT Bintang Terang', '021-1110006', 'Jl. Merdeka No.6'),
(7, 'CV Cahaya Mulia', '021-1110007', 'Jl. Pahlawan No.7'),
(8, 'PT Sentosa Makmur', '021-1110008', 'Jl. Veteran No.8'),
(9, 'UD Makmur Jaya', '021-1110009', 'Jl. Imam Bonjol No.9'),
(10, 'PT Terang Abadi', '021-1110010', 'Jl. Kartini No.10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
