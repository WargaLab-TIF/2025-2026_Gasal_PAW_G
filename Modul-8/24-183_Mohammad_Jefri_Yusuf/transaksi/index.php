<?php 
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';

cekLogin();

$transaksi = getData($conn, "SELECT transaksi.*, pelanggan.nama as nama_pelanggan FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id ORDER BY transaksi.waktu_transaksi DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/table.css">
</head>
<body>
    <?php include '../template/navbar.php'; ?>
    <div class="container">
        <div class="content">
            <div class="table-header">
                <h2>Daftar Transaksi</h2>
                <a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>
            </div>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Waktu Transaksi</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                        <th>Nama Pelanggan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($transaksi as $t): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $t['id'] ?></td>
                        <td><?= $t['waktu_transaksi'] ?></td>
                        <td><?= $t['keterangan'] ?></td>
                        <td>Rp<?= number_format($t['total']) ?></td>
                        <td><?= $t['nama_pelanggan'] ?></td>
                        <td>
                            <a href="detail.php?id=<?= $t['id'] ?>" class="btn btn-primary">Detail</a>
                            <a href="hapus_transaksi.php?id=<?= $t['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>