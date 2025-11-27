<?php 
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';
require_once 'functions.php';
cekLogin();

$id = htmlspecialchars($_GET['id']);
$transaksi = getData($conn, "SELECT * FROM transaksi WHERE id = $id")[0];

$errors = [];
if(isset($_POST['submit'])){
    $data = [
        'id' => $id,
        'waktu_transaksi' => htmlspecialchars($_POST['waktu_transaksi']),
        'keterangan' => htmlspecialchars($_POST['keterangan']),
        'total' => htmlspecialchars($_POST['total']),
        'pelanggan_id' => htmlspecialchars($_POST['pelanggan_id'])
    ];

    if($data['waktu_transaksi'] == "") {
        validateWaktuTransaksi($errors, $data['waktu_transaksi']);
    }
    validateKeterangan($errors, $data['keterangan']);
    validatePelangganID($errors, $data['pelanggan_id']);
    
    if ($errors === []) {
        if(updateTransaksi($conn, $data) > 0){
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
    <title>Edit Transaksi</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
<?php include '../template/navbar.php'; ?>
<div class="container">
    <h2>Edit Transaksi</h2>
    <div class="content">
        <form method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div>
                <label>Waktu Transaksi</label>
                <input type="date" name="waktu_transaksi" value="<?= htmlspecialchars($data['waktu_transaksi'] ?? $transaksi['waktu_transaksi']) ?>" placeholder="Masukkan waktu transaksi">
                <div class="error"><?= $errors["waktu_transaksi"] ?? "" ?></div>
            </div>
            <div>
                <label>Keterangan</label>
                <textarea name="keterangan" id="keterangan"><?= htmlspecialchars($data['keterangan'] ?? $transaksi['keterangan']) ?></textarea>
                <div class="error"><?= $errors["keterangan"] ?? "" ?></div>
            </div>
            <div>
                <label>Total</label>
                <input type="number" name="total" value="<?= htmlspecialchars($transaksi['total'] ?? '') ?>" readonly>
                <div class="error"><?= $errors["total"] ?? "" ?></div>
            </div>
            <div>
                <label>Pelanggan</label>
                <select name="pelanggan_id">
                    <option value="">Pilih Pelanggan</option>
                    <?php foreach(getData($conn, "SELECT * FROM pelanggan") as $pelanggan): ?>
                        <option value="<?= $pelanggan['id'] ?>" <?= ($data['pelanggan_id'] ?? $transaksi['pelanggan_id']) == $pelanggan['id'] ? 'selected' : '' ?>><?= htmlspecialchars($pelanggan['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error"><?= $errors["pelanggan_id"] ?? "" ?></div>
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