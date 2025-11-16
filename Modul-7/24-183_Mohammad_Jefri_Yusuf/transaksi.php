<?php 
require_once "conn.php";
require_once "functions.php";


// Mengambil Data dari Database
$transaksi = getData($conn, "SELECT * FROM transaksi");
$transaksi_detail = getData($conn, "SELECT * FROM transaksi_detail");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Warung Madura</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">     
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
    <div class="header">
        <h1 class="header-title">Warung Madura</h1>
        <div class="navbar">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="transaksi.php">Transaksi</a>
        </div>
    </div>
    <div class="content">
        <div class="table-header">
            <h2>Data Master Transaksi</h2>
            <div class="btn-group">
                <a href="report_transaksi.php" class="btn btn-primary">Lihat Laporan Penjualan</a>
                <a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
            <?php foreach($transaksi as $t):?>
            <tr>
                <td><?= $t["id"] ?></td>
                <td><?= $t["waktu_transaksi"] ?></td>
                <td><?= $t["keterangan"] ?></td>
                <td><?= $t["total"] ?></td>
                <td>
                    <?php
                    $nama_pelanggan = getData($conn, "SELECT nama FROM pelanggan WHERE id = '{$t["pelanggan_id"]}'");
                    echo $nama_pelanggan["nama"];
                    ?>
                </td>
            </tr>
            <?php endforeach?>
        </table>
        <div class="table-header">
            <h2>Transaksi Detail</h2>
            <div class="btn-group">
                <a href="transaksi_detail.php" class="btn btn-success">Tambah Transaki Detail</a>
            </div>
            
        </div>
        <table>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
            <?php foreach($transaksi_detail as $td):?>
            <tr>
                <td><?= $td["transaksi_id"] ?></td>
                <td>
                    <?php
                    $nama_barang = getData($conn, "SELECT nama_barang FROM barang WHERE id = '{$td["barang_id"]}'");
                    echo $nama_barang["nama_barang"];
                    ?>
                </td>
                <td><?= $td["harga"] ?></td>
                <td><?= $td["qty"] ?></td>
            </tr>
            <?php endforeach?>
        </table>
        </div>
    </div>
</body>
</html>