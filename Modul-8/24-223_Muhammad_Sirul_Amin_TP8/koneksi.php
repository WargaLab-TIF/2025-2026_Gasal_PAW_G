<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'praktikum';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    // In dev you can echo the error; in production better to log
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>