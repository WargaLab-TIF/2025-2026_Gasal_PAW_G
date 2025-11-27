<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';

cekLogin();
cekOwner();

$user = getData($conn, "SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
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
                <h2>Daftar User</h2>
                <a href="tambah.php" class="btn btn-success">Tambah User</a>
            </div>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($user as $u): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= $u['nama'] ?></td>
                        <td>
                            <?php if($u['level'] == 1) {
                                echo "Admin"; 
                                } else { 
                                    echo "User Biasa"; 
                                } ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $u['id_user'] ?>" class="btn btn-primary">Edit</a>
                            <a href="hapus.php?id=<?= $u['id_user'] ?>" class="btn btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</body>
</html>