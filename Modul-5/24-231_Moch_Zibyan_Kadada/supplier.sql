-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2025 pada 16.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT selalu', '085755310826', 'Jalan Pahlawan No. 25, RT 003/RW 005 Kelurahan Alun-alun Contong'),
(2, 'PT Adi Makmur', '081598765432', 'Perumahan Griya Indah Blok C5 No. 3A\r\nJalan Teratai Putih'),
(3, 'UD Sentosa', '081823456789', 'Jalan Pemuda No. 88 Kelurahan Pandansari, Kecamatan Semarang Tengah'),
(4, 'PT Makmur Jaya', '085210987654', 'Jalan Raya Kuta No. 101  Kecamatan Kuta, Bali'),
(5, 'CV Berkah Abadi', '085765432109', 'Jalan Gatot Subroto No. 45, Komplek Puri Indah Kelurahan Sei, Kota Medan'),
(6, 'PT Sejahtera', '087811223344', 'Jalan Urip Sumoharjo No. 7, Ruko Bisnis Center Kelurahan Panaikang'),
(7, 'CV Mandiri', '089644332211', 'Jalan Malioboro No. 23 Kelurahan Sosromenduran, Kecamatan Gedongtengen'),
(8, 'UD Lancar', '089644332211', 'Jalan Malioboro No. 23 Kelurahan Sosromenduran, Kecamatan Gedongtengen'),
(9, 'PT Busana Jaya', '083877889900', 'Jalan Argapura No. 50 Kelurahan Argapura, Kecamatan Jayapura Selatan'),
(10, 'PT Abdi Jaya', '081111111137', 'Jl Pucang Sewu Gg 7 No 35 Kec Gubeng Kota Surabaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
