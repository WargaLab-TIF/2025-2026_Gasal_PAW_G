<?php
include 'koneksi.php';
include 'header.php';
if (!isset($_SESSION['level'])) { header('Location: login.php'); exit(); }
?>
<div class="container mt-4"><h2>Halaman Laporan</h2><p>Halaman laporan.</p></div>
