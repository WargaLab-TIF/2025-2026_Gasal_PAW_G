<?php
require_once __DIR__. "../../data_base/koneksi.php";


if (isset($_POST["tambah"])){
    $barang = $_POST["barang"];
    $id_transaksi = $_POST["id_transaksi"];
    $quantity = $_POST["quantity"];

    $ambil_id = "SELECT id FROM barang where nama_barang = '$barang'";
    $proses = $conn->query($ambil_id);
    $ls_id = $proses->fetch_assoc();
    $id = $ls_id["id"];

    $query_valid = "SELECT count(*) FROM transaksi_detail where transaksi_id = '$id_transaksi' and barang_id = '$id'";
    $hasil = $conn->query($query_valid);
    $row = $hasil->fetch_assoc();

    if(intval($row["count(*)"]) > 0){
        echo "<div class='alert alert-danger'>Barang ini sudah ditambahkan dalam transaksi!</div>";
    }else{
        echo "masuk";
        require_once __DIR__. "/.././data_base/tambah_data/tambah_detail_transaksi.php";
    }
}


?>