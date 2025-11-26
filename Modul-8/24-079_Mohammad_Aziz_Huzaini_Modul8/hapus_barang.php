<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level'] != 1){ echo 'Tidak ada akses'; exit; }

if(!isset($_GET['id'])){ header('Location: barang_list.php'); exit; }
$id = (int)$_GET['id'];

$check = mysqli_prepare($conn, "SELECT COUNT(*) as total FROM transaksi_detail WHERE barang_id = ?");
mysqli_stmt_bind_param($check, 'i', $id);
mysqli_stmt_execute($check);
$res = mysqli_stmt_get_result($check);
$c = mysqli_fetch_assoc($res);

if($c['total'] > 0){
    echo "<script>alert('Tidak dapat menghapus barang yang sudah digunakan pada transaksi');window.location='barang_list.php';</script>";
    exit;
}

$del = mysqli_prepare($conn, "DELETE FROM barang WHERE id = ?");
mysqli_stmt_bind_param($del, 'i', $id);
mysqli_stmt_execute($del);
header('Location: barang_list.php');
exit;
?>