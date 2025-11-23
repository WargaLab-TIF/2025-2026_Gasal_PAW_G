<?php
require_once 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="content-box">
            <h1 class="page-title">Transaksi</h1>
            <p>Halaman untuk mengelola transaksi penjualan</p>
            
            <div class="info-box">
                <h3>Menu Transaksi</h3>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Input Transaksi Penjualan</li>
                    <li>Lihat Daftar Transaksi</li>
                    <li>Edit Transaksi</li>
                    <li>Hapus Transaksi</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

