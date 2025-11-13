<?php

require_once __DIR__. "../../koneksi.php";

$query_select = "SELECT * FROM transaksi_detail";

$data = $conn->query($query_select);
$ls_detail = [];
while($row = $data->fetch_assoc()){
    $id = $row["barang_id"];

    $ambil_nama = "SELECT nama_barang FROM barang WHERE id = '$id'";
    $dt = $conn->query($ambil_nama);
    $nilai = $dt->fetch_assoc();
    
    $row["barang_id"] = $nilai["nama_barang"];
    $ls_detail[] = $row;
}

?>