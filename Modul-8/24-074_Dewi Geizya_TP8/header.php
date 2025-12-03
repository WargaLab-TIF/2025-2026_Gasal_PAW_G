<?php
session_start();
$user = $_SESSION['user'] ?? null; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjualan</title>
    <style>
        nav { background: #333; color: white; padding: 10px 0; }
        nav ul { list-style: none; padding: 0; margin: 0; text-align: center; }
        nav ul li { display: inline-block; position: relative; }
        nav ul li a { color: white; text-decoration: none; padding: 10px 15px; display: block; }
        nav ul li:hover > a { background: #555; }
        nav ul ul { display: none; position: absolute; background: #444; min-width: 160px; z-index: 1000;}
        nav ul li:hover > ul { display: block; }
        nav ul ul li { display: block; }
        nav ul ul li a { padding: 8px 15px; }
        .user-info { float: right; margin-right: 20px; line-height: 40px; }
    </style>
</head>
<body>

<nav>
    <ul>
        <?php if (!$user): ?>
            <li><a href="login.php">Login</a></li>
        <?php else: ?>
            <li><a href="home.php">Home</a></li>
            
            <?php if ($user['level'] == 1): ?>
                
                <li>
                    <a href="master/data_master.php">Data Master</a>
                    <ul>
                        <li><a href="master/barang_index.php">Data Barang</a></li>
                        <li><a href="master/supplier_index.php">Data Supplier</a></li>
                        <li><a href="master/pelanggan_index.php">Data Pelanggan</a></li>
                        <li><a href="master/user_index.php">Data User</a></li>
                    </ul>
                </li>
                <li><a href="transaksi/transaksi_index.php">Transaksi</a></li>
                <li><a href="laporan/laporan_index.php">Laporan</a></li>

            <?php elseif ($user['level'] == 2): ?>
                
                <li><a href="transaksi/transaksi_index.php">Transaksi</a></li>
                <li><a href="laporan/laporan_index.php">Laporan</a></li>
            
            <?php endif; ?>

            <li class="user-info">
                Selamat Datang, <b><?= htmlspecialchars($user['nama'] ?? $user['username']) ?></b>
                | 
                <a href="logout.php" style="background: red; border-radius: 4px; padding: 5px 10px;">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<div style="padding: 20px;"></div>