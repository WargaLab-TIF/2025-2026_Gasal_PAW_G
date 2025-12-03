<?php
// db.php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db   = 'toko';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
