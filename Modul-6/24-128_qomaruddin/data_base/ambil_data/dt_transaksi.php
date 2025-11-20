<?php

require_once __DIR__. "../../koneksi.php";

$query_select = "SELECT * FROM transaksi";

$data = $conn->query($query_select);
$ls_transaksi = [];
while($row = $data->fetch_assoc()){
    $id = $row["pelanggan_id"];

    $ambil_nama = "SELECT nama FROM pelanggan WHERE id = '$id'";
    $dt = $conn->query($ambil_nama);
    $nilai = $dt->fetch_assoc();
    
    $row["pelanggan_id"] = $nilai["nama"];
    $ls_transaksi[] = $row;
}

?>