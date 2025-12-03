<?php
include "koneksi.php";
$id = $_GET['id'];

$data = $conn->query("SELECT * FROM user WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $nama     = $_POST['nama_lengkap'];
    $level    = $_POST['level'];
    if ($_POST['password'] != "") {
        $password = md5($_POST['password']);
        $conn->query("UPDATE user SET username='$username', password='$password', nama_lengkap='$nama', level='$level' WHERE id=$id");
    } else {
        $conn->query("UPDATE user SET username='$username', nama_lengkap='$nama', level='$level' WHERE id=$id");
    }

    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f4; 
            margin: 0; 
            padding: 20px;
        }
        .container {
            width: 450px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex; /* Menggunakan flexbox untuk layout tabel */
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            flex-basis: 150px; /* Lebar tetap untuk label, seperti kolom pertama tabel */
            padding-right: 15px;
            font-weight: bold;
            color: #555;
        }
        .form-group input, 
        .form-group select,
        .form-group button {
            flex-grow: 1; /* Input dan select mengambil sisa ruang, seperti kolom kedua tabel */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar total */
            width: 100%;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background-color: #4CAF50; /* Warna hijau untuk update */
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>EDIT USER</h2>

    <form method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($data['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak diganti">
        </div>

        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>
        </div>

        <div class="form-group">
            <label for="level">Level</label>
            <select id="level" name="level">
                <option value="admin" <?= ($data['level']=='admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?= ($data['level']=='user') ? 'selected' : ''; ?>>User</option>
            </select>
        </div>

        <button type="submit">UPDATE</button>
    </form>
</div>

</body>
</html>
