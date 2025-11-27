<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}

if(isset($_POST["simpan"])){

    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    mysqli_query($koneksi, "INSERT INTO supplier VALUES(
        null, '$nama', '$alamat', '$telepon'
    )");

    header("Location: supplier.php");
}
?>

<h2>Tambah Supplier</h2>

<form method="post">
    Nama Supplier : <input type="text" name="nama" required><br><br>
    Alamat : <textarea name="alamat" required></textarea><br><br>
    Telepon : <input type="text" name="telepon" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>