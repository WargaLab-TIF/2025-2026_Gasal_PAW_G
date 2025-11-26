<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT id_user, username, password, nama, level FROM user WHERE username = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);

if ($user && md5($password) === $user['password']) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['level'] = (int)$user['level'];
    header('Location: index.php');
    exit;
} else {
    echo "<script>alert('Login gagal: username atau password salah');window.location='login.php';</script>";
    exit;
}
?>