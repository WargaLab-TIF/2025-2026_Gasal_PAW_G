<?php
session_start();
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if($_SESSION['level'] != 1){ echo 'Anda tidak memiliki akses ke Data Master'; exit; }
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="utf-8"><title>Data Master</title></head><body>
<h2>Data Master</h2>
<ul>
    <li><a href="barang_list.php">Data Barang</a></li>
    <li><a href="supplier_list.php">Data Supplier</a></li>
    <li><a href="pelanggan_list.php">Data Pelanggan</a></li>
    <li><a href="user_list.php">Data User</a></li>
</ul>
<a href="index.php">Kembali</a>
</body></html>
