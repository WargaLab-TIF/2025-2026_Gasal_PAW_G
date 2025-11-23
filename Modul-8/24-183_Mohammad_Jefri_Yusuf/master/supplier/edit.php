<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';
require_once 'functions.php';
cekLogin();
cekOwner();

$id = htmlspecialchars($_GET['id']);
$supplier = getData($conn, "SELECT * FROM supplier WHERE id = $id")[0];

$errors = [];
if(isset($_POST['submit'])){
    $data = [
        'id' => $_POST["id"],
        'nama' => htmlspecialchars($_POST['nama']),
        'telp' => htmlspecialchars($_POST['telp']),
        'alamat' => htmlspecialchars($_POST['alamat'])
    ];

    validateName($errors, $data['nama']);
    validatePhone($errors, $data['telp']);
    validateAddress($errors, $data['alamat']);
    
    if ($errors === []) {
        if(updateSupplier($conn, $data) > 0){
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
    <title>Edit Supplier</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/form.css">

</head>
<body>
<?php include '../../template/navbar.php'; ?>
<div class="container">
    <h2>Edit Supplier</h2>
    <div class="content">
        <form method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <div>
                <label>Nama</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? $supplier['nama']) ?>" placeholder="Masukkan nama supplier">
                <div class="error"><?= $errors["nama"] ?? "" ?></div>
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telp" value="<?= htmlspecialchars($data['telp'] ?? $supplier['telp']) ?>" placeholder="Masukkan nomor telepon">
                <div class="error"><?= $errors["telp"] ?? "" ?></div>
            </div>
            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat'] ?? $supplier['alamat']) ?>" placeholder="Masukkan alamat supplier">
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