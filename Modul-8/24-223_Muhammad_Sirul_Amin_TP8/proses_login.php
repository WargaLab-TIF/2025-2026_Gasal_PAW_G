<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password_md5 = md5($password);

    $q = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password_md5'");

    if ($q && mysqli_num_rows($q) == 1) {

        $u = mysqli_fetch_assoc($q);

        $_SESSION['id_user']  = $u['id_user'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['nama']     = $u['nama'];
        $_SESSION['level']    = $u['level'];

        // Redirect sesuai level
        header("Location: index.php");
        exit();

    } else {
        $_SESSION['login_error'] = "Username atau password salah!";
        header("Location: login.php");
        exit();
    }
}

header("Location: login.php");
exit();
?>
