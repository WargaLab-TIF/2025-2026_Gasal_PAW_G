<?php 
include 'header.php';

if ($_SESSION['level'] != 1) {
    echo "<h3>Akses Ditolak! Halaman ini hanya untuk Owner.</h3>";
    exit;
}
?>

<h2>Menu Data Master</h2>
<ul>
    <li><a href="barang.php">Data Barang</a></li>
    <li><a href="supplier.php">Data Supplier</a></li>
    <li><a href="pelanggan.php">Data Pelanggan</a></li>
    <li><a href="user.php">Data User</a></li>
</ul>
