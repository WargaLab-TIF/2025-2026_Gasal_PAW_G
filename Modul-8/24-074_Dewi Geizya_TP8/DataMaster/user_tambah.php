<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $level = $_POST['level'];

    $check = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
    $check->execute([$user]);
    
    if ($check->fetchColumn() > 0) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO user (username, password, nama, alamat, hp, level) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user, $pass, $nama, $alamat, $hp, $level]);
        header("Location: user_index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 400px; margin: auto; padding: 25px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="password"], textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #5cb85c; color: white; border: none; border-radius: 4px; cursor: pointer; float: right; }
        button:hover { background: #449d44; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Tambah User</h2>
    <a href="user_index.php" class="back">← Kembali</a>
    <hr>

    <form method="post">
        <div>
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="alamat" required></textarea>
        </div>
        <div>
            <label>No. HP</label>
            <input type="text" name="hp" required>
        </div>
        <div>
            <label>Level</label>
            <select name="level">
                <option value="1">Owner</option>
                <option value="2">Kasir</option>
            </select>
        </div>
        <div>
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>