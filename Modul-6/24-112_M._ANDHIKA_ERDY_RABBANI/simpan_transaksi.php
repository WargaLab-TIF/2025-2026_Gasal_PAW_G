<?php
include "koneksi.php";

$tanggal = $_POST['waktu_transaksi'];
$keterangan = trim($_POST['keterangan']);
$total = 0;
$pelanggan = $_POST['pelanggan_id'];
$user_id = 1;

if ($tanggal < date('Y-m-d')) {
    echo "<script>alert('Tanggal tidak boleh kurang dari hari ini!');history.back();</script>";
    exit;
}
if (strlen($keterangan) < 3) {
    echo "<script>alert('Keterangan minimal 3 karakter!');history.back();</script>";
    exit;
}

mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
                     VALUES ('$tanggal', '$keterangan', '$total', '$pelanggan', '$user_id')");

echo "<script>alert('Transaksi berhasil ditambahkan');window.location='tambah_detail.php';</script>";
?>
