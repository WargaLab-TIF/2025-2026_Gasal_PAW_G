<?php 

require_once __DIR__. "../../koneksi/koneksi.php";

if(isset($_POST["tambah"])){
    $user_name = $_POST["username"];
    $password = $_POST["password"];
    $nama_user = $_POST["nama_user"];
    $alamat = $_POST["alamat"];
    $nomor = $_POST["nomor"];
    $jenis_user = $_POST["jenis_user"];

    $pw_md5 = md5($password);

    $tambah_data = "INSERT INTO user(username,password,nama,alamat,hp,level) VALUES('$user_name','$pw_md5','$nama_user','$alamat','$nomor','$jenis_user')";
    if($conn->query($tambah_data)){
        header("location:../menegement.php");
    }
}
?>