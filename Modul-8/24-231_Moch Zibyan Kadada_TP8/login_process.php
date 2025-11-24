<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); 
$username = mysqli_real_escape_string($koneksi, $username);
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($data);

if($cek > 0){
    $row = mysqli_fetch_assoc($data);

    $_SESSION['username'] = $username;
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['status'] = "login"; 
    header("location:home.php");
}else{
    header("location:index.php?pesan=gagal");
}
?>