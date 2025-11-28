<?php
include "koneksi.php";

$nama = $telp = $alamat = "";
$error = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $error["nama"] = "Nama tidak boleh kosong dan hanya boleh huruf ya!";
    }

    if (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $error["telp"] = "Nomor telepon harus angka semua!";
    }

    if (empty($alamat) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat)) {
        $error["alamat"] = "Alamat harus ada huruf dan angka!";
    }

    
    if (empty($error)) {
        $simpan = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        mysqli_query($koneksi, $simpan);
        header("Location: supplier.php");
    }
}
?>

<h3>Tambah Data Supplier</h3>
<form method="POST">
    <label>Nama Supplier:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($nama); ?>"><br>
    <small style="color:red;"><?= $error["nama"] ?? ""; ?></small><br>

    <label>No.Telepon:</label><br>
    <input type="text" name="telp" value="<?= htmlspecialchars($telp); ?>"><br>
    <small style="color:red;"><?= $error["telp"] ?? ""; ?></small><br>

    <label>Alamat:</label><br>
    <input type="text" name="alamat" value="<?= htmlspecialchars($alamat); ?>"><br>
    <small style="color:red;"><?= $error["alamat"] ?? ""; ?></small><br><br>

    <button type="submit">Simpan</button>
    <a href="supplier.php">Batal</a>
</form>