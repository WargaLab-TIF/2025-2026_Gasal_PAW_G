<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistem_penjualan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['level']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

function getUserLevel() {
    return isset($_SESSION['level']) ? $_SESSION['level'] : null;
}
?>

