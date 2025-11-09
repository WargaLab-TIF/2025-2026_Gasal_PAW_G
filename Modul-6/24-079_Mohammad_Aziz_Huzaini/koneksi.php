<?php
$database = "localhost";
$username = "root";
$password = "";
$db = "penjualan";

$conn = mysqli_connect($database, $username, $password, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>