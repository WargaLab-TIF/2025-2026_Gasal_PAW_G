<?php
include 'koneksi.php';
include 'header.php';
if (!isset($_SESSION['level'])) { header('Location: login.php'); exit(); }
?>
<div class="container mt-4"><h2>Halaman Transaksi</h2><p>Fitur transaksi ada di modul sebelumnya.</p></div>
