<?php
include "config.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if (isset($_POST['edit'])) {
    mysqli_query($conn, "UPDATE barang SET 
        kode_barang='$_POST[kode_barang]',
        nama_barang='$_POST[nama_barang]',
        harga='$_POST[harga]',
        stok='$_POST[stok]'
        WHERE id=$id");

    echo "<script>alert('Data berhasil diupdate'); window.location='index.php?page=data_barang';</script>";
}
?>

<h2>Edit Barang</h2>

<form method="POST">
    <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" required>
    <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
    <input type="number" name="stok" value="<?= $data['stok'] ?>" required>
    <button name="edit">Update</button>
</form>
