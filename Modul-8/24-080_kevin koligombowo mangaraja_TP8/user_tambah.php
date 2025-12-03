<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp       = $_POST['hp'];
    $jenis    = $_POST['jenis'];

    $query = "INSERT INTO user (username, password, nama_lengkap, alamat, hp, level)
              VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$jenis')";
    $conn->query($query);

    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User Baru</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; }
        h2 { color:#1A73E8; margin-left:40px; }

        .form-container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px 40px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #eaf3ff;
        }

        textarea { height: 30px; }

        .btn-simpan {
            background: #4CAF50;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
        }

        .btn-batal {
            background: #F44336;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<h2>Tambah User Baru</h2>
<hr style="width: 60%;">

<div class="form-container">
<form method="POST">

    <label for="username" >Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Nama User</label>
    <input type="text" name="nama" placeholder="Nama User" required>

    <label>Alamat</label>
    <textarea name="alamat"></textarea>

    <label>Nomor HP</label>
    <input type="text" name="hp" placeholder="Nomor HP">

    <label>Jenis User</label>
    <select name="jenis" required>
        <option value="">--- Pilih Jenis User ---</option>
        <option value="admin">Admin</option>
        <option value="user">User Biasa</option>
    </select>

    <button type="submit" class="btn-simpan">Simpan</button>
    <a href="user.php"><button type="button" class="btn-batal">Batal</button></a>

</form>
</div>

</body>
</html>
