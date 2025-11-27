<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "penjualan";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

session_start();
?>
