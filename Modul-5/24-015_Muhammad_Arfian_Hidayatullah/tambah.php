<?php
include 'config.php';

$nama = $telp = $alamat = "";
$errors = [];

if (isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    if (empty($nama)) {
        $errors['nama'] = "tidak boleh kosong, hanya boleh huruf";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors['nama'] = "tidak boleh kosong, hanya boleh huruf.";
    }

    if (empty($telp)) {
        $errors['telp'] = " telp : tidak boleh kosong, hanya boleh angka";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors['telp'] = " telp : tidak boleh kosong, hanya boleh angka.";
    }

    if (empty($alamat)) {
        $errors['alamat'] = "alamat : tidak boleh kosong, isian harus alfanumerik (minimal harus ada 1 angka dan 1 huruf)";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*[0-9]).+$/", $alamat)) {
        $errors['alamat'] = "alamat : tidak boleh kosong, isian harus alfanumerik (minimal harus ada 1angka dan 1 huruf).";
    }

    if (empty($errors)) {
        $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
        mysqli_query($conn, $query);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Supplier</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f5f5f5;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        form {
            width: 380px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type=text] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        input.error-field {
            border-color: red;
            background-color: #ffeaea;
        }
        .error-msg {
            color: red;
            font-size: 13px;
            margin-top: 3px;
        }
        .btn {
            margin-top: 20px;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Times New Roman', serif;
        }
        .simpan {
            background-color: #4CAF50;
            color: white;
        }
        .batal {
            background-color: #f44336;
            color: white;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Tambah Data Supplier</h2>

    <form method="POST">
        <label>Nama Supplier</label>
        <input type="text" name="nama" 
               value="<?= htmlspecialchars($nama) ?>" 
               class="<?= isset($errors['nama']) ? 'error-field' : '' ?>">
        <?php if (isset($errors['nama'])): ?>
            <div class="error-msg"><?= $errors['nama']; ?></div>
        <?php endif; ?>

        <label>No. Telepon</label>
        <input type="text" name="telp" 
               value="<?= htmlspecialchars($telp) ?>" 
               class="<?= isset($errors['telp']) ? 'error-field' : '' ?>">
        <?php if (isset($errors['telp'])): ?>
            <div class="error-msg"><?= $errors['telp']; ?></div>
        <?php endif; ?>

        <label>Alamat</label>
        <input type="text" name="alamat" 
               value="<?= htmlspecialchars($alamat) ?>" 
               class="<?= isset($errors['alamat']) ? 'error-field' : '' ?>">
        <?php if (isset($errors['alamat'])): ?>
            <div class="error-msg"><?= $errors['alamat']; ?></div>
        <?php endif; ?>

        <button type="submit" name="simpan" class="btn simpan">Simpan</button>
        <button type="button" class="btn batal" onclick="window.location='index.php'">Batal</button>
    </form>
</body>
</html>
