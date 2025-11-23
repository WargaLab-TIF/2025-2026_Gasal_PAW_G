<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard.php");
    exit();
}

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];
        $_SESSION['status'] = "login";

        header("location:dashboard.php");
    } else {
        $pesan = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Penjualan</title>
</head>
<body>
    <h2>Silahkan Login</h2>
    
    <?php 
    if(isset($pesan)){
        echo "<p style='color:red'>$pesan</p>";
    }
    ?>

    <form method="POST" action="">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit" name="masuk">LOGIN</button>
    </form>
</body>
</html>