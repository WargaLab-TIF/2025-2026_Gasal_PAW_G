<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["edit"])){
    $id = $_GET["id"];
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $id_supplier = $_POST["id_supplier"];

    $edit_data = "UPDATE barang SET nama_barang='$nama_barang',harga='$harga',stok='$stok',id_supplier='$id_supplier' WHERE id='$id')";
    if($conn->query($edit_data)){
        header("location:../../tampilan/admin/data_master.php");
    }
}
?>