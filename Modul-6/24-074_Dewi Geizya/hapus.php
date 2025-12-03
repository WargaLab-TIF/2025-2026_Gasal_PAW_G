<?php
include 'koneksi.php';
$id=$_GET['id']??0;

$cek=$conn->prepare("SELECT COUNT(*) FROM transaksi_detail WHERE barang_id=?");
$cek->bind_param("i",$id); $cek->execute();
$cek->bind_result($count); $cek->fetch(); $cek->close();

if($count>0){
    echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');window.location='index.php';</script>";
}else{
    $conn->query("DELETE FROM barang WHERE barang_id=$id");
    echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
}
?>
