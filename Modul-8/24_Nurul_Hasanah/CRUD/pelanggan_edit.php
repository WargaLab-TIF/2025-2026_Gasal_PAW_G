<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("No Akses");
}

$id = $_GET["id"];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'"));

if(isset($_POST["update"])){

    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    mysqli_query($koneksi, "UPDATE pelanggan SET
        nama_pelanggan='$nama',
        alamat='$alamat',
        telepon='$telepon'
        WHERE id_pelanggan='$id'
    ");

    header("Location: pelanggan.php");
}
?>

<h2>Edit Pelanggan</h2>

<form method="post">
    Nama :
    <input type="text" name="nama" value="<?= $data['nama_pelanggan']; ?>" required><br><br>

    Alamat :
    <textarea name="alamat" required><?= $data['alamat']; ?></textarea><br><br>

    Telepon :
    <input type="text" name="telepon" value="<?= $data['telepon']; ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>