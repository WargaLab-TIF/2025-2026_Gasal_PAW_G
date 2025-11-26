<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang']; $harga = $_POST['harga']; $stok = $_POST['stok'];
    mysqli_query($koneksi, "INSERT INTO barang VALUES (NULL, '$nama', '$harga', '$stok')");
    header("Location: data_barang.php");
}
?>
<h3>Tambah Barang</h3>
<form method="POST">
    Nama: <input type="text" name="nama_barang" required><br><br>
    Harga: <input type="number" name="harga" required><br><br>
    Stok: <input type="number" name="stok" required><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>