<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'"));
if (isset($_POST['update'])) {
    $nama = $_POST['nama_pelanggan']; $alamat = $_POST['alamat']; $telp = $_POST['telp'];
    mysqli_query($koneksi, "UPDATE pelanggan SET nama_pelanggan='$nama', alamat='$alamat', telp='$telp' WHERE id_pelanggan='$id'");
    header("Location: data_pelanggan.php");
}
?>
<h3>Edit Pelanggan</h3>
<form method="POST">
    Nama: <input type="text" name="nama_pelanggan" value="<?=$d['nama_pelanggan']?>"><br><br>
    Alamat: <textarea name="alamat"><?=$d['alamat']?></textarea><br><br>
    Telp: <input type="text" name="telp" value="<?=$d['telp']?>"><br><br>
    <button type="submit" name="update">Update</button>
</form>