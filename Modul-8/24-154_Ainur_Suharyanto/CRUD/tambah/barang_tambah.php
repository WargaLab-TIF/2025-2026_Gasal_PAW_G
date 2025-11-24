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

    $id          = $_POST['id'];
    $nama        = $_POST['nama_barang'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    $q = "INSERT INTO barang (id, nama_barang, harga, stok, supplier_id)
          VALUES ('$id', '$nama', '$harga', '$stok', '$supplier_id')";

    if (mysqli_query($koneksi, $q)) {
        header("Location: ../../data_barang.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
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
<h2 align="center">Tambah Barang</h2>

<form method="POST">

    <div class="it">

    <label>ID Barang:</label>
    <input type="text" name="id" required>
    </div>

    <div class="it">
    <label>Nama Barang:</label>
    <input type="text" name="nama_barang" required>
    </div>

    <div class="it">
    <label>Harga:</label>
    <input type="number" name="harga" required>
    </div>

    <div class="it">
    <label>Stok:</label>
    <input type="number" name="stok" required>
    </div>

    <div class="it">
    <label>Supplier:</label>
    <select name="supplier_id" required>
        <option value="" class="slc">-- Pilih Supplier --</option>
        <?php while ($sup = mysqli_fetch_assoc($supplier)) { ?>
            <option value="<?= $sup['id']; ?>" class="slc"><?= $sup['nama']; ?></option>
        <?php } ?>
    </select>
    <div class="it"><br><br>

    <div class="tmb">
    <button type="submit" class="sv"><b>Simpan</b></button>
    <a href="../../data_barang.php" class="batal">Batal</a>
    </div>

</form>

</body>
</html>
