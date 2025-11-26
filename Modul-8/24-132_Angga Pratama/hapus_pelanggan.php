<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='".$_GET['id']."'");
header("Location: data_pelanggan.php");
?>