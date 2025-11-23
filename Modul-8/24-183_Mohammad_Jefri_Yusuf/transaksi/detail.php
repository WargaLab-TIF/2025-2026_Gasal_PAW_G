<?php 
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';

cekLogin();

$id_transaksi = htmlspecialchars($_GET['id']);
$transaksi = getData($conn, "SELECT transaksi.*, pelanggan.nama as nama_pelanggan FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id WHERE transaksi.id = $id_transaksi")[0];
$transaksi_detail = getData($conn, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = $id_transaksi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/table.css">
</head>
<body>
    <?php include '../template/navbar.php'; ?>
    <div class="container">
        <div class="content">
            <div>
                <h3>Transaksi ID: <?= $transaksi['id'] ?></h3>
                <p>Waktu Transaksi: <?= $transaksi['waktu_transaksi'] ?></p>
                <p>Nama Pelanggan: <?= $transaksi['nama_pelanggan'] ?></p>
                <p>Total: Rp<?= number_format($transaksi['total']) ?></p>
                <div class="btn-group">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <a href="edit_transaksi.php?id=<?= $transaksi['id'] ?>" class="btn btn-primary">Edit Transaksi</a>
                </div>
            </div>
            <div class="table-header">
                <h2>Detail Transaksi</h2>
                <a href="tambah_detail.php?id=<?= $transaksi['id'] ?>" class="btn btn-success">Tambah Detail Transaksi</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($transaksi_detail as $t): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $t['nama_barang'] ?></td>
                        <td>Rp<?= number_format($t['harga']) ?></td>
                        <td><?= $t['qty'] ?></td>
                        <td>
                            <a href="hapus_detail.php?id=<?= $t['transaksi_id']?>&barang_id=<?= $t['barang_id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>