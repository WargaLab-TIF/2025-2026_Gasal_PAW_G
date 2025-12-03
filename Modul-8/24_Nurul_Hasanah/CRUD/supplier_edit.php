<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}

$id = $_GET["id"];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'"));

if(isset($_POST["update"])){

    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    mysqli_query($koneksi, "UPDATE supplier SET
        nama_supplier='$nama',
        alamat='$alamat',
        telepon='$telepon'
        WHERE id_supplier='$id'
    ");

    header("Location: supplier.php");
}
?>

<h2>Edit Supplier</h2>

<form method="post">
    Nama Supplier :
    <input type="text" name="nama" value="<?= $data['nama_supplier']; ?>" required><br><br>

    Alamat : 
    <textarea name="alamat" required><?= $data['alamat']; ?></textarea><br><br>

    Telepon :
    <input type="text" name="telepon" value="<?= $data['telepon']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>