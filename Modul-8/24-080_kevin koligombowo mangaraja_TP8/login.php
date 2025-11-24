<?php 
session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level    = $_POST['level'];

    // Validasi user + level
    $query = $conn->query("SELECT * FROM user 
                           WHERE username='$username' 
                           AND password='$password'
                           AND level='$level'");

    if ($query->num_rows > 0) {
        $data = $query->fetch_assoc();

        // Set session
        $_SESSION['login']    = true;
        $_SESSION['id']       = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['level']    = $data['level'];

        header("Location: dashboard.php");
        exit;

    } else {
        $message = "Username, Password atau Level salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f0f0f0; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            width: 300px; 
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 4px; 
        }
        .login-title {
            color: #318ce7;
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 20px;
            text-align: left;
        }
        input, input[type="password"], select { 
            width: 100%; 
            padding: 10px;
            margin: 0 0 0px 0;
            border: 1px solid #ccc;
            box-sizing: border-box; 
            font-size: 14px;
        }
        input {
            border-bottom: none;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        select {
            border-radius: 0 0 4px 4px;
            margin-bottom: 15px;
        }
        button { 
            width: 100%; 
            padding: 10px; 
            background-color: #318ce7; 
            color: #fff; 
            border: none;
            border-radius: 4px; 
            font-size: 16px;
            cursor: pointer;
        }
        .error { 
            color: red; 
            text-align: center; 
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="login-title">Login Admin</div>

    <?php 
    if ($message != "") {
        echo "<p class='error'>$message</p>"; 
    } 
    ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <select name="level" required>
            <option value="">Pilih Level</option>
            <option value="1">Owner</option>
            <option value="2">Kasir</option>
        </select>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
