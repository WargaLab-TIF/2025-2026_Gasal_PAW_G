<?php
session_start();
include 'koneksi.php';

if (empty($_SESSION['is_login'])) {
    header("Location: login.php");
    exit;
}

$level = $_SESSION['level'];
$nama  = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penjualan</title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f9f9f9; }
        
        .navbar { background: #333; overflow: hidden; padding: 0 20px; }
        .navbar a { float: left; color: white; padding: 14px 16px; text-decoration: none; }
        .navbar a:hover, .dropdown:hover .dropbtn { background: #555; }
        
        .dropdown { float: left; overflow: hidden; }
        .dropdown .dropbtn { border: none; outline: none; color: white; padding: 14px 16px; background: inherit; font-size: 16px; margin: 0; cursor: pointer; }
        .dropdown-content { display: none; position: absolute; background: white; min-width: 160px; box-shadow: 0px 8px 16px rgba(0,0,0,0.2); z-index: 1; }
        
        .dropdown-content a { float: none; color: black; padding: 12px 16px; display: block; text-align: left; }
        .dropdown-content a:hover { background: #ddd; }
        .dropdown:hover .dropdown-content { display: block; }
        
        .content { padding: 20px; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">Home</a>

        <?php if ($level == 1) { ?>
        <div class="dropdown">
            <button class="dropbtn">Data Master &#9662;</button>
            <div class="dropdown-content">
                <a href="data_barang.php">Data Barang</a>
                <a href="data_supplier.php">Data Supplier</a>
                <a href="data_pelanggan.php">Data Pelanggan</a>
                <a href="data_user.php">Data User</a>
            </div>
        </div>
        <?php } ?>

        <a href="transaksi.php">Transaksi</a>
        <a href="laporan.php">Laporan</a>
        
        <a href="logout.php" style="float:right; background:#d9534f;">Logout</a>
    </div>

    <div class="content">
        <h1>Selamat Datang di Sistem Penjualan</h1>
        <p>Halo, <b><?= $nama; ?></b>.</p>
        <p>Anda login sebagai: <b><?= ($level == 1) ? 'Owner' : 'Kasir'; ?></b></p>
        
        <hr>
        <h3>Petunjuk Akses Menu:</h3>
        <ul>
            <li><b>Data Master:</b> Hanya bisa diklik oleh Owner (berisi CRUD Barang, Supplier, Pelanggan, User).</li>
            <li><b>Transaksi:</b> Input penjualan baru (Owner & Kasir).</li>
            <li><b>Laporan:</b> Lihat riwayat penjualan (Owner & Kasir).</li>
        </ul>
    </div>

</body>
</html>