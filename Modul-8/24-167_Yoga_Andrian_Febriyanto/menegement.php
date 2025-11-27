<?php
require_once __DIR__ . "/../data_base/koneksi/koneksi.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: form_login.php");
    exit();
}

$user_level = $_SESSION['level'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjualan</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Sistem Penjualan</a>
        
        <ul class="navbar-nav">
            <li><a class="nav-link active" href="menegement.php">Home</a></li>

            <?php if ($user_level == 1): ?>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle" href="#">Data Master</a>
                <ul class="dropdown-menu">
                    <li><a href="data_master.php?table=barang">Data Barang</a></li>
                    <li><a href="data_master.php?table=supplier">Data Supplier</a></li>
                    <li><a href="data_master.php?table=pelanggan">Data Pelanggan</a></li>
                    <li><a href="data_master.php?table=user">Data User</a></li>
                </ul>
            </li>
            <?php endif; ?>

            <li><a class="nav-link" href="transaksi.php">Transaksi</a></li>
            <li><a class="nav-link" href="report_transaksi.php">Laporan</a></li>
        </ul>

        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#"><?= htmlspecialchars($username) ?></a>
            <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard Sistem Penjualan</h4>
            </div>
            <div class="card-body">
                <p>Selamat datang!</p>
                <p>Anda telah berhasil login.</p>
            </div>
        </div>
    </div>
</body>
</html>