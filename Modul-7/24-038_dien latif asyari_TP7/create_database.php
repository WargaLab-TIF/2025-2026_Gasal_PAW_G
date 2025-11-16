<?php
// Konfigurasi koneksi ke MySQL (tanpa nama database dulu)
$servername = "localhost";
$username   = "root";
$password   = "";

// Buat koneksi
$conn = new mysqli($servername, $username, $password);

$conn->query("DROP DATABASE IF EXISTS store");
$conn->query("CREATE DATABASE store");
$conn->select_db("store");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS store";
if ($conn->query($sql) === TRUE) {
    echo "Database 'store' berhasil dibuat atau sudah ada.<br>";
} else {
    die("Error membuat database: " . $conn->error);
}


$conn->select_db("store");

$sql = "
CREATE TABLE IF NOT EXISTS pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(15),
    alamat TEXT
);

CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    telp VARCHAR(15),
    alamat TEXT
);

CREATE TABLE IF NOT EXISTS barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(20),
    nama_barang VARCHAR(100),
    harga DECIMAL(10,2),
    stok INT,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATETIME,
    keterangan TEXT,
    total DECIMAL(10,2),
    pelanggan_id INT,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT,
    barang_id INT,
    harga DECIMAL(10,2),
    qty INT,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE IF NOT EXISTS pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total DECIMAL(10,2),
    metode ENUM('Tunai','Transfer','EDC'),
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE IF NOT EXISTS user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    nama VARCHAR(100),
    alamat TEXT,
    hp VARCHAR(15),
    level ENUM('admin','kasir','manager')
);
";

// Eksekusi query multi-statement
if ($conn->multi_query($sql)) {
    echo "Semua tabel berhasil dibuat.<br>";
} else {
    echo "Terjadi kesalahan saat membuat tabel: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
