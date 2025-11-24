<?php
session_start();
include "../../koneksi.php";


if (!isset($_SESSION['login'])) {
    header("Location: ../../proses/login.php");
    exit;
}

$supplier = mysqli_query($koneksi, "SELECT * FROM user");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_user   = $_POST['id_user'];
    $username = $_POST['username'];
    $password   = $_POST['password'];
    $nama   = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $hp   = $_POST['hp'];
    $level   = $_POST['level'];

    $q = "INSERT INTO user (id_user, username, password, nama, alamat, hp, level)
          VALUES ('$id', '$username', '$password', '$nama', '$alamat', '$hp', '$level')";

    if (mysqli_query($koneksi, $q)) {
        header("Location: ../../data_user.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah user</title>
    <style>
        body { font-family: Arial; }
        form {
            width: 350px;
            margin: 40px auto;
            padding: 40px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        button:hover { opacity: .8; }
        .it {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }
        input, select {
            padding: 8px;
            font-size: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .slc {
            background-color: white;
            color: black;
        }
        .tmb {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: end;
        }
        .batal {
            background-color: #f44336;
            text-decoration: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
        }
        .sv {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            
        }
    </style>
</head>
<body>
<h2 align="center">Tambah User</h2>

<form method="POST">

    <div class="it">

    <label>ID:</label>
    <input type="text" name="id_user" required>
    </div>

    <div class="it">
    <label>Username:</label>
    <input type="text" name="username" required>
    </div>

    <div class="it">
    <label>Password:</label>
    <input type="text" name="password" required>
    </div>

    <div class="it">
    <label>Nama:</label>
    <input type="text" name="nama" required>
    </div>

    <div class="it">
    <label>Alamat:</label>
    <input type="text" name="alamat" required>
    </div>

    <div class="it">
    <label>Hp:</label>
    <input type="number" name="hp" required>
    </div>

    <div class="it">
    <label>Level:</label>
    <select name="level" class="slc" required>
        <option value="" disabled selected>Pilih Level</option>
        <option value="1">Owner</option>
        <option value="2">kasir</option>
    </select>
    </div>
    

    <div class="tmb">
    <button type="submit" class="sv"><b>Simpan</b></button>
    <a href="../../data_user.php" class="batal">Batal</a>
    </div>

</form>

</body>
</html>
