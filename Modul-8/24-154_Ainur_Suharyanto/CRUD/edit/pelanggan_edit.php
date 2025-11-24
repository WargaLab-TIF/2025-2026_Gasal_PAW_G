<?php
session_start();
include "../../koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../../proses/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID pelanggan tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$q = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "Data pelanggan tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama  = $_POST['nama'];
    $jk = $_POST['jenis_kelamin'];
    $telp  = $_POST['telp'];
    $alamat  = $_POST['alamat'];

    mysqli_query($koneksi, "UPDATE pelanggan SET 
        nama='$nama',
        jenis_kelamin='$jk',
        telp='$telp',
        alamat='$alamat'
        WHERE id='$id'
    ");

    header("Location: ../../data_pelanggan.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
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

<h2>Edit Pelanggan</h2>
<div class="semua">

<form method="POST">

    <div class="ip">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Jenis Kelamin</label>
    <input type="text" name="jenis_kelamin" value="<?= $data['jenis_kelamin']; ?>" required>
    </div><br>

    <div class="ip">
    <label>telp</label>
    <input type="number" name="telp" value="<?= $data['telp']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= $data['alamat']; ?>" required>
    </div>

    <div class="btm">
    <button type="submit" class="btn">Update</button>
    <a href="../../data_pelanggan.php" class="batal">Batal</a>
    </div>

</form>
</div>
</body>
</html>
