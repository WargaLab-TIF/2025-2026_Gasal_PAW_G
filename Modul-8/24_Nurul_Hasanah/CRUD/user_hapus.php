<?php
include "../proteksi.php";
include "../koneksi.php";

if($_SESSION["level"] != 1){
    die("Akses ditolak");
}

$id = $_GET["id"];

mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");

header("Location: user.php");
?>