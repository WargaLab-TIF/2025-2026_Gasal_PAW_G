<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["tambah"])){
    $nama = $_POST["nama"];
    $telp = $_POST["nomor"];
    $stok = $_POST["alamat"];
    $jenis = $_POST["jenis_kelamin"];

    $tambah_data = "INSERT INTO barang(nama,jenis_kelamin,alamat) VALUES('$nama','$jeni','$telp','$alamat')";
    if($conn->query($tambah_data)){
        header("location:../../tampilan/admin/data_master.php");
    }
}
?>