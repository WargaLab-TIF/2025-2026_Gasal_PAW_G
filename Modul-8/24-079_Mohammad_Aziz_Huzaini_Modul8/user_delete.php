<?php
include 'koneksi.php';
session_start();
if(!isset($_SESSION['login'])||$_SESSION['level']!=1){ header('Location: login.php'); exit; }
if(!isset($_GET['id'])) header('Location: user_list.php');
$id=(int)$_GET['id'];
mysqli_query($conn,"DELETE FROM user WHERE id_user=$id");
header('Location: user_list.php'); exit;
?>
