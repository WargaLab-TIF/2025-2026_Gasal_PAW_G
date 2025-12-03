<?php
include "koneksi.php";

$transaksi_id = $_POST['transaksi_id'];
$barang_id = $_POST['barang_id'];
$qty = $_POST['qty'];

$cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Barang ini sudah ada di transaksi tersebut!');history.back();</script>";
    exit;
}

$barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'"));
$harga_total = $barang['harga'] * $qty;

mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                     VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')");

mysqli_query($conn, "UPDATE transaksi
                     SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id')
                     WHERE id='$transaksi_id'");

echo "<script>alert('Detail transaksi berhasil ditambahkan');window.location='tambah_detail.php';</script>";
?>
