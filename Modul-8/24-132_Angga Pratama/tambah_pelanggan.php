<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_pelanggan']; $alamat = $_POST['alamat']; $telp = $_POST['telp'];
    mysqli_query($koneksi, "INSERT INTO pelanggan VALUES (NULL, '$nama', '$alamat', '$telp')");
    header("Location: data_pelanggan.php");
}
?>
<h3>Tambah Pelanggan</h3>
<form method="POST">
    Nama: <input type="text" name="nama_pelanggan" required><br><br>
    Alamat: <textarea name="alamat"></textarea><br><br>
    Telp: <input type="text" name="telp"><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>