<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["tambah"])){
    $nama = $_POST["nama"];
    $telp = $_POST["nomor"];
    $stok = $_POST["alamat"];
    $id_supplier = $_POST["id_supplier"];

    $tambah_data = "INSERT INTO barang(nama,telp,alamat,supplier_id) VALUES('$nama','$telp','$alamat')";
    if($conn->query($tambah_data)){
        header("location:../../tampilan/admin/data_master.php");
    }
}
?>