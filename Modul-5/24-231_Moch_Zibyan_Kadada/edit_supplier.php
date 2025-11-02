<?php
$host = "localhost";
$username = "root";
$password = "";
$database   = "store"; 

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

$nama = $data['nama'];
$telp = $data['telp'];
$alamat = $data['alamat'];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    if (empty($nama) || !preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors['nama'] = "Nama tidak boleh kosong dan hanya boleh huruf.";
    }
    if (empty($telp) || !preg_match("/^[0-9]+$/", $telp)) {
        $errors['telp'] = "Telp tidak boleh kosong dan hanya boleh angka.";
    }
    if (empty($alamat) || !preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/", $alamat)) {
        $errors['alamat'] = "Alamat harus berisi huruf dan angka.";
    }

    if (empty($errors)) {
        $update = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
        if (mysqli_query($conn, $update)) {
            header("Location: supplier.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
        }
        form {
            width: 400px; 
            margin: 40px auto; 
            background: #fff; 
            padding: 20px; 
            border-radius: 6px;
        }
        label {
            display: block; 
            margin-bottom: 6px;
        }
        input[type="text"] {
            width: 100%; 
            padding: 8px; 
            margin-bottom: 10px;
        }
        .error {
            color: red; 
            font-size: 0.9em;
        }
        .btn {
            padding: 8px 12px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
        }
        .save {
            background: #ffc107; 
            color: white;
        }
        .cancel {
            background: #6c757d; 
            color: white;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Edit Data Supplier</h2>
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>">
        <div class="error"><?= $errors['nama'] ?? '' ?></div>

        <label>Telepon:</label>
        <input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>">
        <div class="error"><?= $errors['telp'] ?? '' ?></div>

        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($alamat) ?>">
        <div class="error"><?= $errors['alamat'] ?? '' ?></div>

        <button type="submit" class="btn save">Simpan Perubahan</button>
        <a href="supplier.php" class="btn cancel">Batal</a>
    </form>
</body>
</html>
