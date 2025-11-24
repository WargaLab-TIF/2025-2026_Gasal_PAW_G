<?php
include "koneksi.php";
$id = $_GET['id'];

$cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE barang_id='$id'");
if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');history.back();</script>";
    exit;
}

mysqli_query($conn, "DELETE FROM barang WHERE id='$id'");
echo "<script>alert('Barang berhasil dihapus!');location.href='index.php';</script>";
