<?php 
session_start();
require_once 'helper/functions.php';
cekLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php include "template/navbar.php"; ?>
        <div class="content">
            <h1>Dashboard</h1>
            <p>Selamat datang, <?= $_SESSION['nama']; ?>!</p>
            <div class="card-container">
                <div class="card">
                    <h3>Transaksi Baru</h3>
                    <p>Input penjualan baru disini</p>
                    <a href="transaksi/index.php" class="btn btn-success">Buka Transaksi</a>
                </div>
                <div class="card">
                    <h3>Laporan</h3>
                    <p>Lihat rekapitulasi penjualan</p>
                    <a href="laporan/index.php" class="btn btn-success">Buka Laporan</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>