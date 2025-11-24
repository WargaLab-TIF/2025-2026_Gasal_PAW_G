<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    echo "Tidak punya akses.";
    exit;
}

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo "Gagal menghapus data. Pastikan data tidak terikat dengan tabel transaksi detail.";
        exit;
    }
}

header('Location: barang_index.php');
exit;
?>