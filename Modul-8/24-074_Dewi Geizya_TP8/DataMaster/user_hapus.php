<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? 0;

if ($id == $_SESSION['user']['id_user']) {
    echo "<script>alert('Tidak bisa menghapus akun sendiri!');window.location='user_index.php';</script>";
    exit;
}

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM user WHERE id_user = ?");
    $stmt->execute([$id]);
}

header('Location: user_index.php');
exit;
?>