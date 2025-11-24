<?php
include "koneksi.php";
include "cekSession.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");

echo "<script>alert('Barang berhasil dihapus'); window.location='barang.php';</script>";
?>
