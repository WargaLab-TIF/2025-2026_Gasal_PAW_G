<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}

if(isset($_POST["simpan"])){
    
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    mysqli_query($koneksi, "INSERT INTO barang VALUES(
        null,
        '$nama',
        '$harga',
        '$stok'
    )");

    header("Location: barang.php");
}
?>

<h2>Tambah Barang</h2>

<form method="post">
    Nama Barang : <input type="text" name="nama" required><br><br>
    Harga : <input type="number" name="harga" required><br><br>
    Stok : <input type="number" name="stok" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>