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
        'username' => htmlspecialchars($_POST['username']),
        'password' => htmlspecialchars($_POST['password']),
        'nama' => htmlspecialchars($_POST['nama']),
        'alamat' => htmlspecialchars($_POST['alamat']),
        'hp' => htmlspecialchars($_POST['hp']),
        'level' => htmlspecialchars($_POST['level'])
    ];
    validateUsername($conn, $errors, $data['username']);
    validatePassword($errors, $data['password']);
    validateNama($errors, $data['nama']);
    validateAddress($errors, $data['alamat']);
    validatePhone($errors, $data['hp']);
    validateLevel($errors, $data['level']);
    
    if ($errors === []) {
        if(insertUser($conn, $data) > 0){
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
    <title>Tambah User</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/form.css">

</head>
<body>
<?php include '../../template/navbar.php'; ?>
<div class="container">
    <h2>Tambah User</h2>
    <div class="content">
        <form method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?= htmlspecialchars($data['username'] ?? '') ?>" placeholder="Masukkan username">
                <div class="error"><?= $errors["username"] ?? "" ?></div>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" value="<?= htmlspecialchars($data['password'] ?? '') ?>" placeholder="Masukkan password">
                <div class="error"><?= $errors["password"] ?? "" ?></div>
            </div>
            <div>
                <label>Nama User</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" placeholder="Masukkan nama user">
                <div class="error"><?= $errors["nama"] ?? "" ?></div>
            </div>
            <div>
                <label>Alamat</label>
                <textarea name="alamat" id="alamat"><?= htmlspecialchars($data['alamat'] ?? '') ?></textarea>
                <div class="error"><?= $errors["alamat"] ?? "" ?></div>
            </div>
            <div>
                <label>Nomor HP</label>
                <input type="text" name="hp" value="<?= htmlspecialchars($data['hp'] ?? '') ?>" placeholder="Masukkan nomor HP">
                <div class="error"><?= $errors["hp"] ?? "" ?></div>
            </div>
            <div>
                <label>Pilih Jenis User</label>
                <select name="level">
                    <option value="">Pilih Jenis User</option>
                    <option value="1" <?= (isset($data['level']) && $data['level'] == 1) ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= (isset($data['level']) && $data['level'] == 2) ? 'selected' : '' ?>>User Biasa</option>
                </select>
                <div class="error"><?= $errors["level"] ?? "" ?></div>
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