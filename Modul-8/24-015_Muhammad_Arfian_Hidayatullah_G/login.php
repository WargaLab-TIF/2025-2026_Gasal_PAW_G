<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['status_login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['status_login'] = true;
        $_SESSION['username']     = $data['username'];
        $_SESSION['level']        = $data['level'];

        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>

<form method="POST">
    Username:<br>
    <input type="text" name="username"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <button name="login">Login</button>
</form>
