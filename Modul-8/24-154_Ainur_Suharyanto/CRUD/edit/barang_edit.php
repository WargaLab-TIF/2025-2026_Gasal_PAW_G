<?php
session_start();
include "../../koneksi.php";

// Proteksi halaman
if (!isset($_SESSION['login'])) {
    header("Location: ../../proses/login.php");
    exit;
}

// Pastikan ada ID di URL
if (!isset($_GET['id'])) {
    echo "ID barang tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data barang berdasarkan ID
$q = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "Data barang tidak ditemukan!";
    exit;
}

// Jika tombol update ditekan
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama  = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi, "UPDATE barang SET 
        nama_barang='$nama',
        harga='$harga',
        stok='$stok'
        WHERE id='$id'
    ");

    header("Location: ../../data_barang.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
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

<h2>Edit Barang</h2>
<div class="semua">

<form method="POST">

    <div class="ip">
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Harga</label>
    <input type="number" name="harga" value="<?= $data['harga']; ?>" required>
    </div><br>

    <div class="ip">
    <label>Stok</label>
    <input type="number" name="stok" value="<?= $data['stok']; ?>" required>
    </div>

    <div class="btm">
    <button type="submit" class="btn">Update</button>
    <a href="../../data_barang.php" class="batal">Batal</a>
    </div>

</form>
</div>
</body>
</html>
