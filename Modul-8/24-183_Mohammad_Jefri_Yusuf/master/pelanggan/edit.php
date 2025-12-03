<?php 
session_start();
require_once '../../config/conn.php';
require_once '../../helper/functions.php';
require_once 'functions.php';
cekLogin();
cekOwner();

$id = htmlspecialchars($_GET['id']);
$pelanggan = getData($conn, "SELECT * FROM pelanggan WHERE id = '$id'")[0];
$errors = [];
if(isset($_POST['submit'])){
    $data = [
        'id' => htmlspecialchars($_POST['id']),
        'nama' => htmlspecialchars($_POST['nama']),
        'jenis_kelamin' => htmlspecialchars($_POST['jenis_kelamin'] ?? ''),
        'telp' => htmlspecialchars($_POST['telp']),
        'alamat' => htmlspecialchars($_POST['alamat'])
    ];
    if ($data['id'] !== $pelanggan['id']) {
        validateIDPelanggan($conn, $errors, $data['id']);
    }
    validateNamaPelanggan($errors, $data['nama']);
    validateJenisKelamin($errors, $data['jenis_kelamin']);
    validatePhone($errors, $data['telp']);
    validateAddress($errors, $data['alamat']);
    
    if ($errors === []) {
        if(updatePelanggan($conn, $data) > 0){
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
    <title>Edit Pelanggan</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/form.css">

</head>
<body>
<?php include '../../template/navbar.php'; ?>
<div class="container">
    <h2>Edit Pelanggan</h2>
    <div class="content">
        <form method="post">
            <div>
                <label>ID Pelanggan</label>
                <input type="text" name="id" value="<?= htmlspecialchars($data['id'] ?? $pelanggan['id']) ?>" placeholder="Masukkan ID pelanggan">
                <div class="error"><?= $errors["id"] ?? "" ?></div>
            </div>
            <div>
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? $pelanggan['nama']) ?>" placeholder="Masukkan nama pelanggan">
                <div class="error"><?= $errors["nama"] ?? "" ?></div>
            </div>
            <div>
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <input type="radio" name="jenis_kelamin" id="laki_laki" value="L" <?= ($data['jenis_kelamin'] ?? $pelanggan['jenis_kelamin']) == 'L' ? 'checked' : '' ?>>
                    <label for="laki_laki">Laki-laki</label>
                    <input type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= ($data['jenis_kelamin'] ?? $pelanggan['jenis_kelamin']) == 'P' ? 'checked' : '' ?>>
                    <label for="perempuan">Perempuan</label>
                </div>
                <div class="error"><?= $errors["jenis_kelamin"] ?? "" ?></div>
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telp" value="<?= htmlspecialchars($data['telp'] ?? $pelanggan['telp']) ?>" placeholder="Masukkan telepon pelanggan">
                <div class="error"><?= $errors["telp"] ?? "" ?></div>
            </div>
            <div>
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Masukkan alamat pelanggan"><?= htmlspecialchars($data['alamat'] ?? $pelanggan['alamat']) ?></textarea>
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