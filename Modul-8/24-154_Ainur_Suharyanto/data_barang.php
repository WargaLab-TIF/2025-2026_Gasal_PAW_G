<?php
session_start();

include "koneksi.php";
include "navbar.php";

if (!isset($_SESSION['login'])) {
    header("Location: proses/login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM barang ");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <style>
        .tb {
            background-color: #008CBA;
            padding: 8px;
            display: flex;
            align-items: center;
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

            
        }
        .hd{
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
           
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
<h2>Data Barang</h2>
<a href="CRUD/tambah/barang_tambah.php" class="tb">+ Tambah Barang</a>
</div>
<table border="1" cellpadding="30" cellspacing="0">
    <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['nama_barang']; ?></td>
        <td><?= number_format($row['harga']); ?></td>
        <td><?= $row['stok']; ?></td>

        <td class="aksi">
            <a href="CRUD/edit/barang_edit.php?id=<?= $row['id'];?>" class="e">Edit</a> 
            <a href="CRUD/hapus/hapus_barang.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')" class="h">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>
</div>
</body>
</html>



