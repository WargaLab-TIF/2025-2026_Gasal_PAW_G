<?php
require_once 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan - Laporan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container">
        <div class="content-box">
            <h1 class="page-title">Laporan</h1>
            <p>Halaman untuk melihat laporan penjualan</p>
            
            <div class="info-box">
                <h3>Menu Laporan</h3>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Laporan Penjualan Harian</li>
                    <li>Laporan Penjualan Bulanan</li>
                    <li>Laporan Penjualan Tahunan</li>
                    <li>Laporan Stok Barang</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

