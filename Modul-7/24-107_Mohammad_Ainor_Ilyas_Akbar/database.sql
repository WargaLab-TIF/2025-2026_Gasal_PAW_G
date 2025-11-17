-- Buat Database
CREATE DATABASE IF NOT EXISTS db_penjualan;
USE db_penjualan;

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_pelanggan INT NOT NULL,
    tanggal_transaksi DATE NOT NULL,
    total_pembayaran DECIMAL(15,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'selesai',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id_pelanggan)
);

-- Insert Data Sample Pelanggan
INSERT INTO pelanggan (nama_pelanggan, email, telepon, alamat) VALUES
('Budi Santoso', 'budi@email.com', '081234567890', 'Jl. Merdeka No. 10, Surabaya'),
('Siti Nurhaliza', 'siti@email.com', '081234567891', 'Jl. Pahlawan No. 15, Surabaya'),
('Andi Wijaya', 'andi@email.com', '081234567892', 'Jl. Diponegoro No. 20, Surabaya'),
('Dewi Lestari', 'dewi@email.com', '081234567893', 'Jl. Sudirman No. 25, Surabaya'),
('Rudi Hartono', 'rudi@email.com', '081234567894', 'Jl. Gatot Subroto No. 30, Surabaya');

-- Insert Data Sample Transaksi
INSERT INTO transaksi (id_pelanggan, tanggal_transaksi, total_pembayaran, status) VALUES
(1, '2025-11-01', 150000, 'selesai'),
(2, '2025-11-02', 200000, 'selesai'),
(1, '2025-11-03', 175000, 'selesai'),
(3, '2025-11-05', 300000, 'selesai'),
(4, '2025-11-06', 250000, 'selesai'),
(2, '2025-11-08', 180000, 'selesai'),
(5, '2025-11-10', 220000, 'selesai'),
(3, '2025-11-12', 350000, 'selesai'),
(1, '2025-11-14', 190000, 'selesai'),
(4, '2025-11-15', 280000, 'selesai'),
(2, '2025-11-16', 210000, 'selesai'),
(5, '2025-11-17', 240000, 'selesai');