<?php
include "koneksi.php";

$id = $_GET["id"];
$cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Barang ini sudah digunakan di transaksi, tidak bisa dihapus!'); window.location='index.php';</script>";
} else {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    echo "<script>alert('Barang berhasil dihapus!'); window.location='index.php';</script>";
}
?>