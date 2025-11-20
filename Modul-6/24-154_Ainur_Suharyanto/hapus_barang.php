<?php
$koneksi = mysqli_connect("localhost", "root", "Ryan2025", "store");
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM barang WHERE id=$id");

header("Location: index.php");
exit;
?>