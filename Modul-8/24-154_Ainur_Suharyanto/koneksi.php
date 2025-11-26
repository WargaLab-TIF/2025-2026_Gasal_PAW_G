<?php
$koneksi = mysqli_connect("localhost", "root", "Ryan2025", "store");

if (!$koneksi) {
    die("Gagal koneksi: " . mysqli_connect_error());
}
?>
