<?php
session_start(); include 'koneksi.php';
if (empty($_SESSION['is_login']) || $_SESSION['level'] != 1) { header("Location: index.php"); exit; }
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'"));
if (isset($_POST['update'])) {
    $nama = $_POST['nama_supplier']; $alamat = $_POST['alamat']; $telp = $_POST['telp'];
    mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', telp='$telp' WHERE id_supplier='$id'");
    header("Location: data_supplier.php");
}
?>
<h3>Edit Supplier</h3>
<form method="POST">
    Nama: <input type="text" name="nama_supplier" value="<?=$d['nama_supplier']?>"><br><br>
    Alamat: <textarea name="alamat"><?=$d['alamat']?></textarea><br><br>
    Telp: <input type="text" name="telp" value="<?=$d['telp']?>"><br><br>
    <button type="submit" name="update">Update</button>
</form>