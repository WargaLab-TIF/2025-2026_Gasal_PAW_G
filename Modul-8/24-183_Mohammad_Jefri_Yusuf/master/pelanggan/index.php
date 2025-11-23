<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';

cekLogin();
cekOwner();

$pelanggan = getData($conn, "SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
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
                <h2>Daftar Pelanggan</h2>
                <a href="tambah.php" class="btn btn-success">Tambah Pelanggan</a>
            </div>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($pelanggan as $p): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['jenis_kelamin'] ?></td>
                        <td><?= $p['telp'] ?></td>
                        <td><?= $p['alamat'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="hapus.php?id=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>