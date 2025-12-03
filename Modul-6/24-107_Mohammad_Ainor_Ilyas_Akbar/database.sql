-- Create database schema and sample data
CREATE DATABASE IF NOT EXISTS master_detail_db;
USE master_detail_db;

-- Pelanggan table
CREATE TABLE IF NOT EXISTS pelanggan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL
);

-- Barang table
CREATE TABLE IF NOT EXISTS barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  harga_satuan INT NOT NULL
);

-- Transaksi (master)
CREATE TABLE IF NOT EXISTS transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu DATE NOT NULL,
  keterangan TEXT,
  total BIGINT DEFAULT 0,
  pelanggan_id INT,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL
);

-- Transaksi detail
CREATE TABLE IF NOT EXISTS transaksi_detail (
  id INT AUTO_INCREMENT PRIMARY KEY,
  transaksi_id INT NOT NULL,
  barang_id INT NOT NULL,
  qty INT NOT NULL,
  harga BIGINT NOT NULL,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

-- Sample data
INSERT INTO pelanggan (nama) VALUES ('Budi'), ('Siti'), ('Andi');

INSERT INTO barang (nama, harga_satuan) VALUES
('Pensil', 2000),
('Buku', 15000),
('Pulpen', 5000),
('Penghapus', 1000);
