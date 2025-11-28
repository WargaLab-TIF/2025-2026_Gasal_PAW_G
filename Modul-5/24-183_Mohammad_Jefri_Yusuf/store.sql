-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 06:30 AM
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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Buku Tulis Sinar Dunia 38', 5000, 200, 1),
(2, 'BRG002', 'Pulpen Pilot G2', 15000, 150, 2),
(3, 'BRG003', 'Penghapus Faber-Castell', 3000, 300, 1),
(4, 'BRG004', 'Penggaris 30cm', 4000, 100, 3),
(5, 'BRG005', 'Tipe-X Kertas', 8000, 80, 2),
(6, 'BRG006', 'Stapler Joyko HD-10', 12000, 50, 4),
(7, 'BRG007', 'Isi Stapler No. 10', 2000, 500, 4),
(8, 'BRG008', 'Kertas A4 70gr Sidu', 50000, 100, 1),
(9, 'BRG009', 'Map Snelhecter Biru', 2000, 250, 5),
(10, 'BRG010', 'Spidol Snowman Boardmarker', 9000, 120, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Budi Santoso', 'L', '081234567890', 'Jl. Merdeka No. 1, Jakarta'),
(2, 'Ani Wijaya', 'P', '081234567891', 'Jl. Sudirman No. 2, Surabaya'),
(3, 'Citra Lestari', 'P', '081234567892', 'Jl. Diponegoro No. 3, Bandung'),
(4, 'Doni Hartanto', 'L', '081234567893', 'Jl. Gajah Mada No. 4, Yogyakarta'),
(5, 'Eka Putri', 'P', '081234567894', 'Jl. Pahlawan No. 5, Semarang'),
(6, 'Fajar Nugroho', 'L', '081234567895', 'Jl. Asia Afrika No. 6, Medan'),
(7, 'Gita Permata', 'P', '081234567896', 'Jl. Kartini No. 7, Makassar'),
(8, 'Hadi Prasetyo', 'L', '081234567897', 'Jl. Imam Bonjol No. 8, Palembang'),
(9, 'Indah Cahyani', 'P', '081234567898', 'Jl. Teuku Umar No. 9, Denpasar'),
(10, 'Joko Susilo', 'L', '081234567899', 'Jl. Pattimura No. 10, Balikpapan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 10:30:00', 71000, 'TUNAI', 1),
(2, '2025-10-01 11:15:00', 150000, 'TRANSFER', 2),
(3, '2025-10-02 09:05:00', 8000, 'TUNAI', 3),
(4, '2025-10-03 14:00:00', 500000, 'EDC', 4),
(5, '2025-10-03 16:20:00', 18000, 'TUNAI', 5),
(6, '2025-10-04 10:00:00', 30000, 'TRANSFER', 6),
(7, '2025-10-05 13:10:00', 20000, 'TUNAI', 7),
(8, '2025-10-05 15:45:00', 30000, 'EDC', 8),
(9, '2025-10-06 08:30:00', 100000, 'TRANSFER', 9),
(10, '2025-10-07 11:00:00', 17000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Sumber Rezeki', '021555001', 'Jl. Industri Blok A1, Cikarang'),
(2, 'CV. Jaya Abadi', '031555002', 'Jl. Rungkut Industri No.5C, Surabaya'),
(3, 'UD. Makmur Sentosa', '022555003', 'Jl. Kopo No.2A, Bandung'),
(4, 'PT. Tani Jaya', '0274555004', 'Jl. Magelang No.9, Yogyakarta'),
(5, 'CV. Sinar Terang', '024555005', 'Jl. Pandanaran No.12, Semarang'),
(20, 'PT Berkah Abadi', '081234567890', 'Jl. Melati No.10, Jakarta'),
(21, 'CV Maju Jaya Sentosa', '082345678901', 'Jl. Mawar No.25, Bandung'),
(22, 'UD Tani Sejahtera', '083456789012', 'Jl. Anggrek No.7, Surabaya'),
(29, 'PT Sinar Mentari', '084567890123', 'Jl. Kenanga No.18, Yogyakarta'),
(30, 'PT Global Indah Asri', '081234567845', 'Jl. Sakura No.5, Tangerang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01', 'Pembelian ATK', 71000, 1),
(2, '2025-10-01', 'Stok bulanan', 150000, 3),
(3, '2025-10-02', 'Kebutuhan kantor', 8000, 2),
(4, '2025-10-03', 'Pembelian pribadi', 500000, 5),
(5, '2025-10-03', 'Beli spidol', 18000, 4),
(6, '2025-10-04', 'Stok ulang', 30000, 7),
(7, '2025-10-05', 'Pembelian map', 20000, 6),
(8, '2025-10-05', 'Beli pulpen', 30000, 9),
(9, '2025-10-06', 'Kertas A4', 100000, 8),
(10, '2025-10-07', 'Lain-lain', 17000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 10),
(1, 2, 15000, 1),
(1, 3, 3000, 2),
(2, 8, 50000, 3),
(3, 4, 4000, 2),
(4, 8, 50000, 10),
(5, 10, 9000, 2),
(6, 5, 8000, 1),
(6, 6, 12000, 1),
(6, 7, 2000, 5),
(7, 9, 2000, 10),
(8, 2, 15000, 2),
(9, 8, 50000, 2),
(10, 3, 3000, 3),
(10, 5, 8000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Kantor Pusat, Jakarta', '0811000001', 1),
(2, 'kasir1', 'kasir123', 'Beni', 'Jl. Kasir 1, Jakarta', '0811000002', 2),
(3, 'kasir2', 'kasir456', 'Susi', 'Jl. Kasir 2, Surabaya', '0811000003', 2),
(4, 'gudang', 'gudang123', 'Wawan', 'Area Gudang, Cikarang', '0811000004', 3),
(5, 'manager', 'manager123', 'Sarah', 'Kantor Manajer, Jakarta', '0811000005', 1),
(6, 'kasir3', 'kasir789', 'Tika', 'Jl. Kasir 3, Bandung', '0811000006', 2),
(7, 'gudang2', 'gudang456', 'Rudi', 'Area Gudang, Surabaya', '0811000007', 3),
(8, 'supervisor', 'super123', 'Anton', 'Kantor Supervisor, Jakarta', '0811000008', 1),
(9, 'kasir4', 'kasir101', 'Dewi', 'Jl. Kasir 4, Yogyakarta', '0811000009', 2),
(10, 'gudang3', 'gudang789', 'Hendra', 'Area Gudang, Medan', '0811000010', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
