<?php 
$hostname = "localhost";
$username = "root";
$pass = "";
$db = "penjualan";

$conn = mysqli_connect($hostname, $username, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
};
?>