<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["tambah"])){
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $id_supplier = $_POST["id_supplier"];

    $tambah_data = "INSERT INTO barang(nama_barang,harga,stok,supplier_id) VALUES('$nama_barang','$harga','$stok','$id_supplier')";
    if($conn->query($tambah_data)){
        header("location:../../tampilan/admin/data_master.php");
    }
}
?>