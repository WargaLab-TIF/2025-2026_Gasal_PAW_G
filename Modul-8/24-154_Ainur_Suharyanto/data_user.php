<?php
session_start();

include "koneksi.php";
include "navbar.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM user ");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <style>
        .tb {
            background-color: #008CBA;
            padding: 8px;            
        }
        .h {
            background-color: #f44336;
            padding: 10px 25px 10px 25px;
            font-size: medium;
        }
        .e{
            background-color: #4CAF50;
            padding: 10px 30px 10px 30px;
            font-size: medium;
            
        }
        body {
            font-family: Arial;
        }
        .oll {
            margin-top: 20px;
            width: 100%;
            
        }
        .hd{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: auto;
            
        }
        th{
            background-color: #28a4d5ff;
        }
        table{
            width: 100%;
        }
        .aksi{
            width: 200px;
        }
    </style>
</head>
<body>

<div class="oll">
<div class="hd">
<h2>Data User</h2>
<a href="CRUD/tambah/user_tambah.php" class="tb">+ Tambah User</a>
</div>
<table border="1" cellpadding="30" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id_user']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['password']; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['alamat']; ?></td>
        <td><?= $row['hp']; ?></td>
        <td><?= $row['level']; ?></td>

        <td class="aksi">
            <a href="CRUD/edit/user_edit.php?id_user=<?= $row['id_user'];?>" class="e">Edit</a> 
            <a href="CRUD/hapus/hapus_user.php?id_user=<?= $row['id_user']; ?>" onclick="return confirm('Yakin hapus?')" class="h">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>
</div>
</body>
</html>