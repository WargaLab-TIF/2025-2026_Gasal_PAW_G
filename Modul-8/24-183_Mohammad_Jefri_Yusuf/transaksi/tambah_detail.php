<?php 
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';
require_once 'functions.php';
cekLogin();

$id_transaksi = htmlspecialchars($_GET['id']);
$errors = [];
if(isset($_POST['submit'])){
    $data = [
        'barang_id' => htmlspecialchars($_POST['barang_id']),
        'transaksi_id' => htmlspecialchars($_POST['transaksi_id']),
        'qty' => htmlspecialchars($_POST['qty'])
    ];

    validateBarangID($conn, $errors, $data['barang_id'], $data['transaksi_id']);
    validateTransaksiID($errors, $data['transaksi_id']);
    validateQty($errors, $data['qty']);
    
    if ($errors === []) {
        if(insertTransaksiDetail($conn, $data) > 0){
            echo "<script>alert('Berhasil');
            location.href='detail.php?id=$id_transaksi';</script>";
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
    <title>Tambah Transaksi Detail</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
<?php include '../template/navbar.php'; ?>
<div class="container">
    <h2>Tambah Transaksi Detail</h2>
    <div class="content">
        <form method="post">
            <div>
                <label>Pilih Barang</label>
                <select name="barang_id" id="barang_id">
                    <option value="">Pilih Barang</option>
                    <?php foreach(getData($conn, "SELECT * FROM barang") as $barang): ?>
                        <option value="<?= $barang['id'] ?>" <?= (isset($data['barang_id']) && $data['barang_id'] == $barang['id']) ? 'selected' : '' ?>><?= htmlspecialchars($barang['nama_barang']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error"><?= $errors["barang_id"] ?? "" ?></div>
            </div>
            <div>
                <label>ID Transaksi</label>
                <select name="transaksi_id" id="transaksi_id">
                    <?php foreach(getData($conn, "SELECT * FROM transaksi") as $transaksi): ?>
                    <option value="<?= $transaksi['id'] ?>" <?= ($transaksi['id'] == $id_transaksi) ? 'selected' : '' ?>><?= $transaksi['id'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error"><?= $errors["transaksi_id"] ?? "" ?></div>
            </div>
            <div>
                <label>Quantity</label>
                <input type="number" name="qty" value="<?= htmlspecialchars($data['qty'] ?? '') ?>" placeholder="Masukkan jumlah barang">
                <div class="error"><?= $errors["qty"] ?? "" ?></div>
            </div>
            <div>
                <button class="btn btn-primary" name="submit">Simpan</button>
                <a href="detail.php?id=<?= $id_transaksi ?>" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>