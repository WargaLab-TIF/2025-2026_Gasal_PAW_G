<?php
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';
require_once 'functions.php';
cekLogin();

$id = htmlspecialchars($_GET["id"]);
$barang_id = htmlspecialchars($_GET["barang_id"]);


$hasil = deleteTransaksiDetail($conn, $id, $barang_id);

if ($hasil > 0) {
    echo "<script>alert('Data berhasil dihapus'); location.href='detail.php?id=$id';</script>";
} elseif ($hasil == -1) {
    echo "<script>alert('Gagal: Barang ini sedang digunakan pada Data Transaksi!'); location.href='detail.php?id=$id';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); location.href='detail.php?id=$id';</script>";
}
?>