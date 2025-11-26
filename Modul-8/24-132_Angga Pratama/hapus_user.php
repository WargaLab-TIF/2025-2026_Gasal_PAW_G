<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
mysqli_query($koneksi, "DELETE FROM user WHERE id_user='".$_GET['id']."'");
header("Location: data_user.php");
?>