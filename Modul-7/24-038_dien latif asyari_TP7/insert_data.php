<?php
include 'koneksi.php';

/* =======================
   INSERT DATA PELANGGAN
======================= */
$conn->query("INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat)
VALUES 
('Rizal', 'L', '08121112233', 'Yogyakarta'),
('Lina', 'P', '08132223344', 'Bandung'),
('Farhan', 'L', '08143334455', 'Surabaya'),
('Nadia', 'P', '08154445566', 'Denpasar'),
('Rafi', 'L', '08165556677', 'Medan'),
('Salsa', 'P', '08176667788', 'Makassar'),
('Ilham', 'L', '08187778899', 'Semarang'),
('Putri', 'P', '08198889900', 'Palembang'),
('Yoga', 'L', '08209990011', 'Pontianak'),
('Mira', 'P', '08211001122', 'Malang')");

/* =======================
   INSERT DATA SUPPLIER
======================= */
$conn->query("INSERT INTO supplier (nama, telp, alamat)
VALUES 
('PT Karya Sejahtera','021987321','Jakarta'),
('CV Bintang Terang','022876543','Bandung'),
('UD Sukses Makmur','031765432','Surabaya'),
('PT Amanah Sentosa','036187654','Denpasar'),
('CV Maju Bersama','041176543','Makassar'),
('PT Berkah Abadi','061234567','Medan'),
('CV Sentosa Baru','075165432','Padang'),
('PT Cahaya Baru','056154321','Pontianak'),
('UD Berkat Mulia','071198765','Palembang'),
('PT Jaya Lestari','024187653','Semarang')");

/* =======================
   INSERT DATA BARANG
======================= */
$conn->query("INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
VALUES
('BRG011', 'Meja Kantor', 650000, 25, 1),
('BRG012', 'Kursi Putar', 350000, 40, 2),
('BRG013', 'Lemari Arsip', 820000, 15, 3),
('BRG014', 'Kasur Lipat', 700000, 30, 4),
('BRG015', 'Rak Sepatu', 180000, 35, 5),
('BRG016', 'Sofa Sudut', 1650000, 8, 6),
('BRG017', 'Lampu Tidur', 95000, 70, 7),
('BRG018', 'Kipas Meja', 150000, 50, 8),
('BRG019', 'TV LED 43 Inch', 2750000, 12, 9),
('BRG020', 'Kulkas Mini', 2100000, 10, 10)");

/* =======================
   INSERT DATA TRANSAKSI
======================= */
$conn->query("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
VALUES
('2025-10-28 09:10:00','Pembelian perabot kantor', 3150000, 1),
('2025-10-28 10:15:00','Pembelian peralatan elektronik', 5400000, 2),
('2025-10-28 11:30:00','Pembelian perlengkapan rumah tangga', 1300000, 3),
('2025-10-28 12:20:00','Pembelian sofa & meja', 2300000, 4),
('2025-10-28 13:25:00','Pembelian lemari dan rak', 950000, 5),
('2025-10-28 14:40:00','Pembelian lampu dan kipas', 310000, 6),
('2025-10-28 15:15:00','Pembelian kasur lipat', 700000, 7),
('2025-10-28 16:05:00','Pembelian elektronik rumah tangga', 4600000, 8),
('2025-10-28 17:10:00','Pembelian campuran furnitur', 1800000, 9),
('2025-10-28 18:00:00','Pembelian kulkas mini', 2100000, 10)");

/* =======================
   INSERT DATA TRANSAKSI_DETAIL
======================= */
$conn->query("INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
VALUES
(1,1,650000,2),
(1,2,350000,1),
(2,9,2750000,2),
(3,5,180000,3),
(4,6,1650000,1),
(4,2,350000,1),
(5,3,820000,1),
(5,5,180000,1),
(6,7,95000,2),
(6,8,150000,1),
(7,4,700000,1),
(8,9,2750000,1),
(8,10,2100000,1),
(9,1,650000,1),
(9,5,180000,2),
(10,10,2100000,1)");

/* =======================
   INSERT DATA PEMBAYARAN
======================= */
$conn->query("INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id)
VALUES
('2025-10-28 09:15:00', 3150000, 'Tunai', 1),
('2025-10-28 10:20:00', 5400000, 'Transfer', 2),
('2025-10-28 11:35:00', 1300000, 'Tunai', 3),
('2025-10-28 12:25:00', 2300000, 'EDC', 4),
('2025-10-28 13:30:00', 950000, 'Tunai', 5),
('2025-10-28 14:45:00', 310000, 'Transfer', 6),
('2025-10-28 15:20:00', 700000, 'EDC', 7),
('2025-10-28 16:10:00', 4600000, 'Transfer', 8),
('2025-10-28 17:15:00', 1800000, 'Tunai', 9),
('2025-10-28 18:05:00', 2100000, 'EDC', 10)");

/* =======================
   INSERT DATA USER
======================= */
$conn->query("INSERT INTO user (username, password, nama, alamat, hp, level)
VALUES
('admin01', MD5('admin001'), 'Admin Pusat', 'Jakarta', '081200000001', 'admin'),
('kasirA', MD5('kasirA321'), 'Kasir Satu', 'Bandung', '081211112222', 'kasir'),
('kasirB', MD5('kasirB654'), 'Kasir Dua', 'Surabaya', '081322223333', 'kasir'),
('managerA', MD5('managerA987'), 'Manajer Utama', 'Yogyakarta', '081433334444', 'manager'),
('staffG', MD5('staffG123'), 'Staff Gudang', 'Medan', '081544445555', 'kasir'),
('staffK', MD5('staffK456'), 'Staff Kurir', 'Makassar', '081655556666', 'kasir'),
('supportX', MD5('supportX789'), 'Support Teknis', 'Denpasar', '081766667777', 'kasir'),
('itAdmin', MD5('itadmin999'), 'IT Administrator', 'Semarang', '081877778888', 'admin'),
('auditorX', MD5('auditX321'), 'Auditor Keuangan', 'Palembang', '081988889999', 'manager'),
('ownerX', MD5('ownerX555'), 'Pemilik Usaha', 'Jakarta', '082099990000', 'admin')");

echo "✅ Semua data baru berhasil dimasukkan ke database 'store'.";
?>
