<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id']);

// cek apakah barang dipakai di transaksi_detail
$cek = $conn->query("SELECT COUNT(*) as cnt FROM transaksi_detail WHERE barang_id = {$id}")->fetch_assoc();
if ($cek['cnt'] > 0) {
    // barang sudah digunakan -> tampilkan alert & kembali
    echo "<script>alert('Barang ini sudah digunakan pada transaksi dan tidak bisa dihapus.'); window.location.href='index.php';</script>";
    exit;
}

// jika belum dipakai -> hapus
$res = $conn->query("DELETE FROM barang WHERE id = {$id}");
if ($res) {
    echo "<script>alert('Barang berhasil dihapus.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus barang: {$conn->error}'); window.location.href='index.php';</script>";
}
