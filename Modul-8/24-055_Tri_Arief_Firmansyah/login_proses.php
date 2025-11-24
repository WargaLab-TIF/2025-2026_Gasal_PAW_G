<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
$password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

$q = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
if(!$q){
    die("Query error: ".mysqli_error($conn));
}
$data = mysqli_fetch_assoc($q);
if($data){
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama']    = $data['nama'];
    $_SESSION['level']   = $data['level'];
    header("Location: index.php");
    exit;
}else{
    echo "<script>alert('Login gagal. Cek username/password'); window.location='login.php';</script>";
}
?>
