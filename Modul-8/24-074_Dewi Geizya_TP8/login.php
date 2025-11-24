<?php
session_start();
require_once "koneksi.php";

// CEGAH AKSES HALAMAN LOGIN JIKA SUDAH LOGIN
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

$error = ""; // 🟢 FIX: definisikan variabel error supaya tidak undefined

// PROSES LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = md5($_POST['password']);

    if ($username === "" || $password === "") {
        $error = "Username dan password harus diisi!";
    } else {

        // Ambil user dari database
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username=? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            $valid = false;

            if (password_verify($password, $user['password'])) {
                $valid = true;
            } elseif ($password === $user['password']) { 
                $valid = true;
            }

            if ($valid) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id'      => $user['id'],
                    'username'=> $user['username'],
                    'name'    => $user['name'],
                    'level'   => (int)$user['level']
                ];

                header("Location: home.php");
                exit;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Sistem</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #4da3ff, #1e6edb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 350px;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-top: 0;
            color: #1e6edb;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #f8f8f8;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1e6edb;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #1559b7;
        }

        .error {
            background: #ffdddd;
            padding: 10px;
            border-left: 4px solid red;
            margin-bottom: 10px;
            color: #a10000;
            border-radius: 5px;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>Login Sistem</h2>

    <?php if ($error != ""): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" autocomplete="off" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>