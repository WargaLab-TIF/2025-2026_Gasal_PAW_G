<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}

$id = $_GET["id"];

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'"));

if(isset($_POST["update"])){
    
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];

    mysqli_query($koneksi, "UPDATE barang SET 
        nama_barang='$nama',
        harga='$harga',
        stok='$stok'
        WHERE id_barang='$id'
    ");

    header("Location: barang.php");
}
?>

<h2>Edit Barang</h2>

<form method="post">
    Nama Barang : 
    <input type="text" name="nama" value="<?= $data['nama_barang']; ?>" required><br><br>

    Harga : 
    <input type="number" name="harga" value="<?= $data['harga']; ?>" required><br><br>

    Stok : 
    <input type="number" name="stok" value="<?= $data['stok']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>