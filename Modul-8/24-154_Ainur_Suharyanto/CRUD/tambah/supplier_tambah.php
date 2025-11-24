<?php
session_start();
include "../../koneksi.php";

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: ../../proses/login.php");
    exit;
}

// Ambil data supplier untuk dropdown
$supplier = mysqli_query($koneksi, "SELECT * FROM supplier");

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id   = $_POST['id'];
    $nama = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat   = $_POST['alamat'];
    

    $q = "INSERT INTO supplier (id, nama, telp, alamat)
          VALUES ('$id', '$nama', '$telp', '$alamat')";

    if (mysqli_query($koneksi, $q)) {
        header("Location: ../../data_supplier.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Supplier</title>
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
<h2 align="center">Tambah Supplier</h2>

<form method="POST">

    <div class="it">

    <label>ID:</label>
    <input type="text" name="id" required>
    </div>

    <div class="it">
    <label>Nama:</label>
    <input type="text" name="nama" required>
    </div>

    <div class="it">
    <label>No Telp:</label>
    <input type="number" name="telp" required>
    </div>

    <div class="it">
    <label>Alamat:</label>
    <input type="text" name="alamat" required>
    <div class="it"><br><br>

    <div class="tmb">
    <button type="submit" class="sv"><b>Simpan</b></button>
    <a href="../../data_supplier.php" class="batal">Batal</a>
    </div>

</form>

</body>
</html>
