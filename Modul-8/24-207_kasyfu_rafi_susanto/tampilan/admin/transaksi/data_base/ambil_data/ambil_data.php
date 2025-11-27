<?php 
require_once __DIR__. "../../koneksi.php";

$ambil_data = "SELECT transaksi.id, transaksi.waktu_transaksi, transaksi.keterangan, FORMAT(transaksi.total,0,'id_ID') AS total, pelanggan.nama FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id";
$find_data = $conn->query($ambil_data);
$ls_data = [];

while($row = $find_data->fetch_assoc()){
    $ls_data[] = $row; 
}



?>