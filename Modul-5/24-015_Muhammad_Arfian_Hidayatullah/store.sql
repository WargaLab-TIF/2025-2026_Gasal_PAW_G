-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 11:15 AM
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
  `kode_barang` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras Cap Mawar 5kg', 65000.00, 50, 1),
(2, 'BRG002', 'Minyak Goreng 1L', 18000.00, 100, 2),
(3, 'BRG003', 'Gula Pasir 1kg', 15000.00, 80, 3),
(4, 'BRG004', 'Sabun Mandi Lifebuoy', 5000.00, 120, 4),
(5, 'BRG005', 'Sampo Sunsilk 200ml', 18000.00, 60, 5),
(6, 'BRG006', 'Kopi Kapal Api 165gr', 12000.00, 70, 6),
(7, 'BRG007', 'Teh Sariwangi 50pcs', 14000.00, 90, 7),
(8, 'BRG008', 'Susu Dancow 400gr', 50000.00, 40, 8),
(9, 'BRG009', 'Mie Sedap Goreng', 3500.00, 200, 9),
(10, 'BRG010', 'Detergen Rinso 1kg', 24000.00, 60, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Andi Saputra', 'L', '081234567890', 'Jl. Merdeka No.1, Sidoarjo'),
(2, 'Siti Aisyah', 'P', '081345678901', 'Jl. Raya Gubeng, Surabaya'),
(3, 'Rizky Pratama', 'L', '082134567890', 'Jl. Taman Pelangi, Malang'),
(4, 'Dewi Lestari', 'P', '081278945612', 'Jl. Basuki Rahmat, Kediri'),
(5, 'Ahmad Fauzan', 'L', '085678912345', 'Jl. KH. Ahmad Dahlan, Gresik'),
(6, 'Fitri Handayani', 'P', '087654321098', 'Jl. Pahlawan, Mojokerto'),
(7, 'Budi Santoso', 'L', '081298765432', 'Jl. Veteran, Pasuruan'),
(8, 'Rina Marlina', 'P', '082345678912', 'Jl. Mawar No.10, Blitar'),
(9, 'Arif Nugroho', 'L', '085234567890', 'Jl. Diponegoro, Jombang'),
(10, 'Mega Puspita', 'P', '081334455667', 'Jl. Suroyo, Probolinggo');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metode` enum('Tunai','Transfer','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-20 10:30:00', 185000.00, 'Tunai', 1),
(2, '2025-10-20 11:45:00', 25000.00, 'EDC', 2),
(3, '2025-10-21 09:10:00', 60000.00, 'Transfer', 3),
(4, '2025-10-21 14:00:00', 32000.00, 'Tunai', 4),
(5, '2025-10-22 08:30:00', 54000.00, 'Tunai', 5),
(6, '2025-10-22 15:15:00', 71000.00, 'Transfer', 6),
(7, '2025-10-23 10:30:00', 123000.00, 'EDC', 7),
(8, '2025-10-23 18:00:00', 225000.00, 'Tunai', 8),
(9, '2025-10-24 09:50:00', 31000.00, 'Tunai', 9),
(10, '2025-10-24 16:40:00', 38000.00, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Maju Jaya', '0317896543', 'Jl. Industri No.5, Sidoarjo'),
(2, 'CV Sejahtera', '0317654321', 'Jl. Gatot Subroto No.12, Surabaya'),
(3, 'PT Sumber Makmur', '0321456789', 'Jl. Raya Pandaan, Pasuruan'),
(4, 'UD Barokah', '0331456123', 'Jl. Mangga Dua, Malang'),
(5, 'PT Sinar Abadi', '0315566778', 'Jl. Kalijudan, Surabaya'),
(6, 'CV Mulia Sentosa', '0316677889', 'Jl. Imam Bonjol, Mojokerto'),
(7, 'PT Cahaya Baru', '0341789654', 'Jl. Letjen Sutoyo, Kediri'),
(8, 'UD Berkah Niaga', '0334567890', 'Jl. Hasanudin, Probolinggo'),
(9, 'PT Nusantara', '0321543987', 'Jl. Soekarno Hatta, Gresik'),
(10, 'CV Sentosa Makmur', '0315467891', 'Jl. Raya Waru, Sidoarjo');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-20 10:15:00', 'Pembelian kebutuhan rumah tangga', 185000.00, 1),
(2, '2025-10-20 11:30:00', 'Pembelian produk harian', 25000.00, 2),
(3, '2025-10-21 09:00:00', 'Pembelian makanan ringan', 60000.00, 3),
(4, '2025-10-21 13:45:00', 'Pembelian perlengkapan mandi', 32000.00, 4),
(5, '2025-10-22 08:10:00', 'Pembelian kebutuhan dapur', 54000.00, 5),
(6, '2025-10-22 15:00:00', 'Pembelian stok rumah', 71000.00, 6),
(7, '2025-10-23 10:20:00', 'Pembelian bahan pokok', 123000.00, 7),
(8, '2025-10-23 17:50:00', 'Pembelian bulanan', 225000.00, 8),
(9, '2025-10-24 09:40:00', 'Pembelian ringan', 31000.00, 9),
(10, '2025-10-24 16:25:00', 'Pembelian sabun dan mie', 38000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000.00, 1),
(1, 2, 18000.00, 2),
(2, 3, 15000.00, 1),
(3, 9, 3500.00, 10),
(4, 4, 5000.00, 3),
(4, 5, 18000.00, 1),
(5, 2, 18000.00, 3),
(6, 6, 12000.00, 2),
(7, 7, 14000.00, 3),
(8, 8, 50000.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` enum('admin','kasir','pemilik') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', 'admin123', 'Andi Admin', 'Jl. Mawar No.1', '081234567890', 'admin'),
(2, 'kasir1', 'kasir123', 'Rina Kasir', 'Jl. Melati No.2', '081345678901', 'kasir'),
(3, 'owner1', 'owner123', 'Dewi Owner', 'Jl. Kenanga No.3', '081278945612', 'pemilik'),
(4, 'admin2', '123admin', 'Budi Santoso', 'Jl. Diponegoro No.10', '081245678912', 'admin'),
(5, 'kasir2', '123kasir', 'Fitri Lestari', 'Jl. Anggrek No.5', '082145678912', 'kasir'),
(6, 'owner2', '123owner', 'Rizky Pratama', 'Jl. Melur No.6', '085612345678', 'pemilik'),
(7, 'admin3', 'adminxx', 'Mega Puspita', 'Jl. Dahlia No.7', '081223344556', 'admin'),
(8, 'kasir3', 'kasirxx', 'Arif Nugroho', 'Jl. Cempaka No.8', '082233445566', 'kasir'),
(9, 'owner3', 'ownerxx', 'Ahmad Fauzan', 'Jl. Flamboyan No.9', '085233445577', 'pemilik'),
(10, 'admin4', 'adminkuy', 'Dian Saputra', 'Jl. Nangka No.10', '081211223344', 'admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
