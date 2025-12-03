<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["tambah"])){
    $id = $_GET["id"];
    $user_name = $_POST["username"];
    $password = $_POST["password"];
    $nama_user = $_POST["nama_user"];
    $alamat = $_POST["alamat"];
    $nomor = $_POST["nomor"];
    $jenis_user = $_POST["jenis_user"];

    $pw_md5 = md5($password);

    $edit_data = "UPDATE user SET username='$user_name',password='$pw_md5',nama='$nama_user',alamat='$alamat',hp'$nomor',level='$jenis_user' WHERE id_user='$id'";
    if($conn->query($edit_data)){
        header("location:../../tampilan/admin/data_master.php");
    }
}   
?>