<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM supplier WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo "<script>alert('Gagal menghapus! Supplier ini sedang digunakan di data barang.');window.location='supplier_index.php';</script>";
        exit;
    }
}

header('Location: supplier_index.php');
exit;
?>