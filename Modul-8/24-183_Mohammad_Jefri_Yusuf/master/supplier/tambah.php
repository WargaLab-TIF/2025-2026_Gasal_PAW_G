<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';
require_once 'functions.php';
cekLogin();
cekOwner();

$errors = [];
if(isset($_POST['submit'])){
    $data = [
        'nama' => htmlspecialchars($_POST['nama']),
        'telp' => htmlspecialchars($_POST['telp']),
        'alamat' => htmlspecialchars($_POST['alamat'])
    ];

    validateName($errors, $data['nama']);
    validatePhone($errors, $data['telp']);
    validateAddress($errors, $data['alamat']);
    
    if ($errors === []) {
        if(insertSupplier($conn, $data) > 0){
            echo "<script>alert('Berhasil');
            location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/form.css">

</head>
<body>
<?php include '../../template/navbar.php'; ?>
<div class="container">
    <h2>Tambah Supplier</h2>
    <div class="content">
        <form method="post">
            <div>
                <label>Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" placeholder="Masukkan nama supplier">
                <div class="error"><?= $errors["nama"] ?? "" ?></div>
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telp" value="<?= htmlspecialchars($data['telp'] ?? '') ?>" placeholder="Masukkan nomor telepon">
                <div class="error"><?= $errors["telp"] ?? "" ?></div>
            </div>
            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat'] ?? '') ?>" placeholder="Masukkan alamat supplier">
                <div class="error"><?= $errors["alamat"] ?? "" ?></div>
            </div>
            <div>
                <button class="btn btn-primary" name="submit">Simpan</button>
                <a href="index.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>