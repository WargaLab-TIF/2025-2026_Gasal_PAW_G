<?php 
require_once "conn.php";
require_once "functions.php";


// Mengambil Data dari Database
$barang = getData($conn, "SELECT * FROM barang");
$transaksi = getData($conn, "SELECT * FROM transaksi");
$transaksi_detail = getData($conn, "SELECT * FROM transaksi_detail");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengelolaan Master Detail</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">     
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
    <h1>Pengelolaan Master Detail</h1>
    <h2>Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
        <?php foreach($barang as $b):?>
        <tr>
            <td><?= $b["id"] ?></td>
            <td><?= $b["kode_barang"] ?></td>
            <td><?= $b["nama_barang"] ?></td>
            <td><?= $b["harga"] ?></td>
            <td><?= $b["stok"] ?></td>
            <td>
                <?php
                $nama_supplier = getData($conn, "SELECT nama FROM supplier WHERE id = {$b['supplier_id']}");
                echo $nama_supplier["nama"];
                ?>
            </td>
            <td>
                 <a href="delete_barang.php?id=<?= $b["id"]?>" class="btn btn-delete" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endforeach?>
    </table>
    <div class="table-header">
        <h2>Transaksi</h2>
        <a href="transaksi.php" class="btn btn-add">Tambah Transaksi</a>
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
        <a href="transaksi_detail.php" class="btn btn-add">Tambah Transaki Detail</a>
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
</body>
</html>