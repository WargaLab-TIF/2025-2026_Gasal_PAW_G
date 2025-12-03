<?php
include "koneksi.php";

$id_pelanggan = $_POST['id_pelanggan'] ?? '';
$id_barang    = $_POST['id_barang'] ?? '';
$qty          = $_POST['qty'] ?? '';
$id_user      = 1; 

if(empty($id_pelanggan) || empty($id_barang) || empty($qty)){
    die("<script>alert('Data transaksi tidak lengkap!'); window.location='transaksi.php';</script>");
}

$barang_list = [$id_barang];
$qty_list    = [$qty];

$total = 0;
$details = [];

foreach($barang_list as $index => $id_b){
    $q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_b'");
    $b = mysqli_fetch_assoc($q);
    if(!$b) die("<script>alert('Barang tidak ditemukan!'); window.location='transaksi.php';</script>");

    if($qty_list[$index] > $b['stok']){
        die("<script>alert('Stok barang ".$b['nama_barang']." tidak cukup!'); window.location='transaksi.php';</script>");
    }

    $subtotal = $b['harga'] * $qty_list[$index];
    $total += $subtotal;

    $details[] = [
        'id_barang' => $id_b,
        'qty' => $qty_list[$index],
        'subtotal' => $subtotal,
        'stok' => $b['stok']
    ];
}

mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, id_pelanggan, total, id_user)
                        VALUES (CURDATE(), '$id_pelanggan', '$total', '$id_user')");
$id_transaksi = mysqli_insert_id($koneksi);

foreach($details as $d){
    mysqli_query($koneksi, "INSERT INTO `transaksi detail` (id_transaksi, id_barang, qty, subtotal)
                            VALUES ('$id_transaksi', '".$d['id_barang']."', '".$d['qty']."', '".$d['subtotal']."')");
    
    $stok_baru = $d['stok'] - $d['qty'];
    mysqli_query($koneksi, "UPDATE barang SET stok='$stok_baru' WHERE id_barang='".$d['id_barang']."'");
}

echo "<script>alert('Transaksi berhasil disimpan!'); window.location='transaksi.php';</script>";
?>