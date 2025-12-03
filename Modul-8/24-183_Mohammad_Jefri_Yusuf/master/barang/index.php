<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';

cekLogin();
cekOwner();

$barang = getData($conn, "SELECT barang.*, supplier.nama AS nama_supplier FROM barang LEFT JOIN supplier ON barang.supplier_id = supplier.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>
<body>
    <?php include '../../template/navbar.php'; ?>
    <div class="container">
        <div class="content">
            <div class="table-header">
                <h2>Daftar Barang</h2>
                <a href="tambah.php" class="btn btn-success">Tambah Barang</a>
            </div>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Nama Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($barang as $b): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $b['kode_barang'] ?></td>
                        <td><?= $b['nama_barang'] ?></td>
                        <td>Rp<?= number_format($b['harga']) ?></td>
                        <td><?= $b['stok'] ?></td>
                        <td><?= $b['nama_supplier'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="hapus.php?id=<?= $b['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>