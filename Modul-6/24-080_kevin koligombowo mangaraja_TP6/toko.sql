-- buat database (jika perlu)
CREATE DATABASE IF NOT EXISTS toko;
USE toko;

-- tabel pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL
);

-- tabel barang
CREATE TABLE IF NOT EXISTS barang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  harga INT NOT NULL
);

-- tabel transaksi (master)
CREATE TABLE IF NOT EXISTS transaksi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  waktu DATE NOT NULL,
  keterangan TEXT,
  total BIGINT NOT NULL DEFAULT 0,
  pelanggan_id INT NOT NULL,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- tabel transaksi_detail (detail)
CREATE TABLE IF NOT EXISTS transaksi_detail (
  id INT AUTO_INCREMENT PRIMARY KEY,
  transaksi_id INT NOT NULL,
  barang_id INT NOT NULL,
  qty INT NOT NULL,
  harga BIGINT NOT NULL, -- harga = barang.harga * qty
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
  FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

-- contoh data
INSERT INTO pelanggan (nama) VALUES ('Andi'), ('Budi'), ('Citra');
INSERT INTO barang (nama, harga) VALUES ('Bunga Mawar', 10000), ('Bunga Matahari', 15000), ('Vas Kecil', 5000);
