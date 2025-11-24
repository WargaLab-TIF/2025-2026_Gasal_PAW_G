<?php
session_start();
include "../../koneksi.php";

// Proteksi halaman
if (!isset($_SESSION['login'])) {
    header("Location: ../../proses/login.php");
    exit;
}

// Pastikan ada ID di URL
if (!isset($_GET['id_user'])) {
    echo "ID user tidak ditemukan!";
    exit;
}

$id_user = $_GET['id_user'];

// Ambil data barang berdasarkan ID
$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "Data user tidak ditemukan!";
    exit;
}

// Jika tombol update ditekan
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password   = $_POST['password'];
    $nama   = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp   = $_POST['hp'];
    $level   = $_POST['level'];

    mysqli_query($koneksi, "UPDATE user SET

        username='$username',
        password='$password',
        nama='$nama',
        alamat='$alamat',
        hp='$hp',
        level='$level'
        WHERE id_user='$id_user'
    ");

    header("Location: ../../data_user.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial;
        }
        form {
            width: 300px;
            padding: 20px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 430px;
        }
        .btn {
            margin-top: 15px;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
        }
        .batal {
            background-color: #f44336;
            text-decoration: none;
            padding: 10px 20px;
            color: white;
        }
        .ip{
            width: 400px;
        }
        .ip label{
           width: 200px;
        }
        .semua{
            margin-left: 510px;
            margin-top: 50px;
            border: 1px solid #aaa;
            width: 500px;
            border-radius: 5px;
        }
        h2{
            text-align: center;
        }
        .btm{
            display: flex;
            gap: 10px;
            justify-content: end;
            align-items: end;
            margin-top: 20px;
            margin-left: 450px ;
        }
    </style>
</head>
<body>

<h2>Edit User</h2>
<div class="semua">

<form method="POST">

    <div class="ip">
    <label>Username</label>
    <input type="text" name="username" value="<?= $data['username']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Password</label>
    <input type="text" name="password" value="<?= $data['password']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= $data['alamat']; ?>" required>
    </div>

    <div class="ip">
    <label>hp</label>
    <input type="number" name="hp" value="<?= $data['hp']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Level</label>
    <select name="level" class="slc" required>
        <option value="1" <?= $data['level'] == '1' ? 'selected' : '' ; ?>>Owner</option>
        <option value="2" <?= $data['level'] == '2' ? 'selected' : '' ; ?>>Kasir</option>
    </select>
    </div>


    <div class="btm">
    <button type="submit" class="btn">Update</button>
    <a href="../../data_user.php" class="batal">Batal</a>
    </div>

</form>
</div>
</body>
</html>
