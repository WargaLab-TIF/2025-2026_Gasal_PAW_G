<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['is_login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        $_SESSION['username'] = $username;
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['level']    = $data['level'];
        $_SESSION['is_login'] = true;
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; margin: 0; }
        .login-box { background: white; padding: 30px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 8px; width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
        .error { color: red; text-align: center; margin-bottom: 10px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 align="center">Login Sistem</h3>
        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>
</body>
</html>