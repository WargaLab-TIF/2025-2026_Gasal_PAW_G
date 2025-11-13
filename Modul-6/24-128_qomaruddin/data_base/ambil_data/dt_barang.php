<?php

require_once __DIR__. "../../koneksi.php";

$query_select = "SELECT * FROM barang";

$data = $conn->query($query_select);
$ls_barang = [];
while($row = $data->fetch_assoc()){
    $id = $row["supplier_id"];

    $ambil_nama = "SELECT nama FROM supplier WHERE id = '$id'";
    $dt = $conn->query($ambil_nama);
    $nilai = $dt->fetch_assoc();
    
    $row["supplier_id"] = $nilai["nama"];
    $ls_barang[] = $row;
}

?>