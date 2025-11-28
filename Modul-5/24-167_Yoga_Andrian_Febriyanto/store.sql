-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 04:40 PM
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
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BR1', 'buku_tulis', 500, 100, 1),
(2, 'BR2', 'pensil', 2000, 200, 2),
(3, 'BR3', 'penghapus', 1500, 150, 3),
(4, 'BR4', 'spidol_hitam', 8000, 40, 4),
(5, 'BR5', 'bulpen biru', 3000, 50, 5),
(6, 'BR6', 'baterai', 2500, 25, 6),
(7, 'BR7', 'flashdisk', 50000, 25, 7),
(8, 'BR8', 'kertas A4', 2500, 20, 8),
(9, 'BR9', 'tas', 70000, 40, 9),
(10, 'BR10', 'sepatu', 65000, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('1', 'andi', 'L', '081111111111', 'jl. telang no.1'),
('10', 'susi', 'P', '082101010101', 'jl. telang no.10'),
('2', 'ardi', 'L', '082222222222', 'jl. telang no.2'),
('3', 'sulhan', 'L', '082333333333', 'jl. telang no.3'),
('4', 'agus', 'L', '082444444444', 'jl. telang no.4'),
('5', 'rafi', 'L', '082555555555', 'jl. telang no.5'),
('6', 'qomar', 'L', '082666666666', 'jl. telang no.6'),
('7', 'zainur', 'L', '082777777777', 'jl. telang no.7'),
('8', 'ceillo', 'L', '082888888888', 'jl. telang no.8'),
('9', 'siti', 'P', '082999999999', 'jl. telang no.9');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('Tunai','Transfer','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 22:10:33', 50000, 'Tunai', 1),
(2, '2025-10-02 22:11:31', 25000, 'Transfer', 2),
(3, '2025-10-03 22:11:56', 70000, 'Tunai', 3),
(4, '2025-10-04 22:12:25', 65000, 'Transfer', 4),
(5, '2025-10-05 22:12:58', 12000, 'EDC', 5),
(6, '2025-10-06 22:13:21', 20000, 'Transfer', 6),
(7, '2025-10-07 22:13:50', 25000, 'Tunai', 7),
(8, '2025-10-08 22:14:18', 12000, 'Tunai', 8),
(9, '2025-10-09 22:14:53', 12000, 'Transfer', 9),
(10, '2025-10-10 22:15:13', 150000, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sales_data`
--

CREATE TABLE `sales_data` (
  `sale_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_age` int(11) DEFAULT NULL,
  `customer_gender` enum('Male','Female','Other') DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `store_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'Suplier A', '082111111111', 'jl. raya no. 1'),
(2, 'suplier B', '082222222222', 'jl. raya no.2'),
(3, 'suplier C', '082333333333', 'jl. raya no.3'),
(4, 'suplier D', '082444444444', 'jl. raya no.4'),
(5, 'suplier E', '082555555555', 'jl. raya no.5'),
(6, 'suplier F', '082666666666', 'jl. raya no.6'),
(7, 'suplier G', '082777777777', 'jl. raya no.7'),
(8, 'suplier H', '08288888888', 'jl. raya no.8'),
(9, 'suplier I', '082999999999', 'jl. raya no.9'),
(10, 'suplier J', '082101010101', 'jl. raya no.10'),
(14, 'qomar j', '082111111000', 'jl.suplier 11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'beli alat tulis', 30000, '1'),
(2, '2025-10-02', 'beli flashdisk', 50000, '2'),
(3, '2025-10-03', 'beli tas', 70000, '3'),
(4, '2025-10-04', 'beli sepatu', 65000, '4'),
(5, '2025-10-05', 'beli pensil', 9000, '5'),
(6, '2025-10-06', 'beli buku tulis', 15000, '6'),
(7, '2025-10-07', 'beli kertas A4', 25000, '7'),
(8, '2025-10-08', 'beli bulpen', 12000, '8'),
(9, '2025-10-09', 'beli spidol', 16000, '9'),
(10, '2025-10-10', 'beli perlengkapan sekolah', 150000, '10');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `qty`, `harga`) VALUES
(1, 1, 3, 50000),
(2, 2, 1, 2500),
(3, 3, 3, 70000),
(4, 4, 1, 65000),
(5, 5, 1, 5000),
(6, 6, 2, 15000),
(7, 6, 2, 25000),
(8, 8, 3, 30000),
(9, 9, 1, 12000),
(10, 10, 3, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'admin utama', 'jl. telang no.1', '081111111111', 2),
(2, 'kasir1', 'kasir123', 'kasir1', 'jl. kasir no.1', '082222222222', 1),
(3, 'kasir2', 'kasir2123', 'kasir2', 'jl kasir no.2', '082333333333', 1),
(4, 'gudang1', 'gudang123', 'gudang1', 'jalan gudang no.1', '082444444444', 1),
(5, 'gudang2', 'gudang231', 'gudang2', 'jl. gudang no.2', '082555555555', 1),
(6, 'manager', 'manager123', 'manager', 'jl manager no.1', '082666666666', 1),
(7, 'staf1', 'staf123', 'staf1', 'jl staf no.1', '082777777777', 1),
(8, 'staf2', 'staf231', 'staf2', 'jl staf no.2', '08288888888', 1),
(9, 'sales1', 'salses123', 'sales1', 'jl sales no.1', '082999999999', 1),
(10, 'sales2', 'sales 231', 'sales2', 'jl. sales no.2', '082101010101', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `sales_data`
--
ALTER TABLE `sales_data`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_data`
--
ALTER TABLE `sales_data`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
