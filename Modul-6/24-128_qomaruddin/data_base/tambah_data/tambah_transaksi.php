<?php

require_once __DIR__. "../../koneksi.php";


if(isset($_POST["tambah"])){
    $waktu = $_POST["waktu"];
    $total = $_POST["total"];
    $keterengan = $_POST["keterangan"];
    $pelanggan = $_POST["pelanggan"];

    $select_Idpelanggan = "SELECT id FROM pelanggan WHERE nama = '$pelanggan'";
    $data = $conn->query($select_Idpelanggan);
    $row = $data->fetch_assoc();
    $id_pelanggan = $row["id"];
    
    $query_insert = "INSERT INTO transaksi(waktu_transaksi, total,keterangan , pelanggan_id) VALUES('$waktu','$total','$keterengan','$id_pelanggan')";
    if($conn->query($query_insert)){
        header("location:.././index.php");
    }
}

?>