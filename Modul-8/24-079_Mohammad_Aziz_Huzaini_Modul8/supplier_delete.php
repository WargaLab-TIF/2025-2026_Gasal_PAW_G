<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])) header('Location: supplier_list.php');
$id=(int)$_GET['id'];
mysqli_query($conn,"DELETE FROM supplier WHERE id=$id");
header('Location: supplier_list.php');
exit;
?>
