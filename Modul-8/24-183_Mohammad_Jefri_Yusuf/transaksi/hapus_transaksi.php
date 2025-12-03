<?php
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';
require_once 'functions.php';
cekLogin();

$id = htmlspecialchars($_GET["id"]);

// Fungsi deleteTransaksi mengembalikan -1 jika data sedang dipakai di tabel Transaksi
$hasil = deleteTransaksi($conn, $id);

if ($hasil > 0) {
    echo "<script>alert('Data berhasil dihapus'); location.href='index.php';</script>";
} elseif ($hasil == -1) {
    echo "<script>alert('Gagal: Transaksi ini sedang digunakan pada Data Transaksi Detail!'); location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); location.href='index.php';</script>";
}
?>