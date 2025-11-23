CREATE DATABASE IF NOT EXISTS db_toko;

USE db_toko;

CREATE TABLE IF NOT EXISTS pelanggan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS supplier (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS barang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode_barang VARCHAR(50) UNIQUE NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga_satuan DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    supplier_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATETIME NOT NULL,
    keterangan TEXT,
    total DECIMAL(10,2) DEFAULT 0,
    pelanggan_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS transaksi_detail (
    id INT PRIMARY KEY AUTO_INCREMENT,
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    qty INT NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT,
    UNIQUE KEY unique_transaksi_barang (transaksi_id, barang_id)
);

-- Insert sample data
INSERT INTO supplier (nama, alamat, telepon) VALUES
('PT. Sumber Berkah', 'Jl. Raya Jakarta No. 123', '021-1234567'),
('CV. Maju Jaya', 'Jl. Merdeka No. 45', '021-2345678'),
('CV. Sentosa Abadi', 'Jl. Sudirman No. 67', '021-3456789');

INSERT INTO pelanggan (nama, alamat, telepon) VALUES
('Budi Santoso', 'Jl. Gatot Subroto No. 10', '081234567890'),
('Siti Nurhaliza', 'Jl. Thamrin No. 20', '081234567891'),
('Ahmad Yani', 'Jl. Kebon Jeruk No. 30', '081234567892');

INSERT INTO barang (kode_barang, nama_barang, harga_satuan, stok, supplier_id) VALUES
('BRG001', 'Beras Premium', 100000, 50, 1),
('BRG002', 'Minyak Goreng', 30000, 200, 2),
('BRG003', 'Gula Pasir', 15000, 150, 1),
('BRG004', 'Garam', 5000, 300, 2),
('BRG005', 'Kecap Manis', 12000, 100, 1),
('BRG006', 'Sambal ABC', 8000, 250, 2),
('BRG007', 'Mie Instan', 3500, 500, 1),
('BRG008', 'Telur Ayam', 25000, 80, 2),
('BRG009', 'Susu UHT', 15000, 120, 1),
('BRG010', 'Tepung Maizena', 18000, 70, 3);

