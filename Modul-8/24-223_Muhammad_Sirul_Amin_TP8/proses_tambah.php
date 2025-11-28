<?php
include 'koneksi.php';

// Hanya admin (level 1) yang boleh tambah user
if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $hp       = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $level    = mysqli_real_escape_string($koneksi, $_POST['level']);

    // Hash MD5 agar cocok dengan login
    $password_md5 = md5($password);

    $query = "INSERT INTO user (username, password, nama, alamat, hp, level)
              VALUES ('$username', '$password_md5', '$nama', '$alamat', '$hp', '$level')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: crud_user.php?status=sukses_tambah");
        exit();
    } else {
        echo "Error: Gagal menambahkan user. Username mungkin duplikat.<br>";
        echo mysqli_error($koneksi);
    }
} else {
    header("Location: tambah_user.php");
    exit();
}
?>
