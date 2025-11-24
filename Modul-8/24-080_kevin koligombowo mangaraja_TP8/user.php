<?php
include "koneksi.php";
$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f9f9f9; 
        }

        h2 {
            color: #1A73E8;
            margin-left: 60px;
        }

        .btn-tambah {
            background: #4CAF50;
            color: white;
            padding: 8px 15px;
            border: none;
            text-decoration: none;
            border-radius: 4px;
            float: right;
            margin-right: 60px;
            margin-top: -40px;
        }

        table {
            width: 85%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #E3F2FD;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .btn-edit {
            background: #FF9800;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-hapus {
            background: #F44336;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .aksi {
            width: 150px;
        }
    </style>
</head>
<body>

<h2>Daftar User</h2>
<a href="user_tambah.php" class="btn-tambah">Tambah User</a>

<table>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Level</th>
        <th class="aksi">Tindakan</th>
    </tr>

    <?php 
    $no = 1;
    while ($row = $result->fetch_assoc()) { 
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['nama_lengkap']; ?></td>
        <td>
            <?= ($row['level'] == "admin") ? "Admin" : "User Biasa"; ?>
        </td>
        <td>
            <a class="btn-edit" href="user_edit.php?id=<?= $row['id']; ?>">Edit</a>
            <a class="btn-hapus" href="user_hapus.php?id=<?= $row['id']; ?>" 
               onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
