<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])){ header('Location: data_master_transaksi.php'); exit; }
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id=$id");
mysqli_query($conn, "DELETE FROM transaksi WHERE id=$id");
header('Location: data_master_transaksi.php');
exit;
?>