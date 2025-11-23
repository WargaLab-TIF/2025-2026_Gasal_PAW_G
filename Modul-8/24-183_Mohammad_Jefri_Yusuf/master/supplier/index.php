<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';
cekLogin();
cekOwner();

$supplier = getData($conn, "SELECT * FROM supplier");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier</title>
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
                <h2>Daftar Supplier</h2>
                <a href="tambah.php" class="btn btn-success">Tambah Supplier</a>
            </div>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($supplier as $s): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $s['nama'] ?></td>
                        <td><?= $s['telp'] ?></td>
                        <td><?= $s['alamat'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $s['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="hapus.php?id=<?= $s['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus supplier ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>