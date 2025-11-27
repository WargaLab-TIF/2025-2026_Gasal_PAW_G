<?php
include "proteksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f3f3f3;
            padding: 20px;
        }
        .menu-box {
            background: white;
            width: 300px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            text-align: center;
        }
        a {
            display: block;
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
            border-radius: 5px;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="menu-box">
    <h2>Menu Utama</h2>

    <a href="crud/barang.php">Data Barang</a>
    <a href="crud/supplier.php">Data Supplier</a>
    <a href="crud/pelanggan.php">Data Pelanggan</a>
    <a href="crud/user.php">Data User</a>

    <a href="transaksi.php" style="background:#28a745">Transaksi Penjualan</a>
    <a href="laporan.php" style="background:#17a2b8">Laporan Transaksi</a>

    <a href="logout.php" style="background:#dc3545">Logout</a>
</div>

</body>
</html>