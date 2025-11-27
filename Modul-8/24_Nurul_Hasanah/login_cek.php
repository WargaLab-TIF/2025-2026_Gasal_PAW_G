<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($query) == 1){

    $data = mysqli_fetch_assoc($query);

    $_SESSION["user_id"] = $data["id"];
    $_SESSION["nama"] = $data["nama"];
    $_SESSION["level"] = $data["level"];

    header("Location: index.php");
}

else{
    echo "<script> alert('Username atau Password salah!');
                   window.location='login.php';
          </script>";
}

?>