<?php

$server = "localhost";
$user ="root";
$pass ="";
$db ="db_paw";

$koneksi = mysqli_connect($server, $user, $pass, $db);

if (!$koneksi) {
    die("Gagal terhubung ke database: " . mysqli_connect_error());
}
?>