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
        'kode_barang' => htmlspecialchars($_POST['kode_barang']),
        'nama_barang' => htmlspecialchars($_POST['nama_barang']),
        'harga' => htmlspecialchars($_POST['harga']),
        'stok' => htmlspecialchars($_POST['stok']),
        'supplier_id' => htmlspecialchars($_POST['supplier_id'])
    ];

    validateKodeBarang($conn, $errors, $data['kode_barang']);
    validateNamaBarang($errors, $data['nama_barang']);
    validateHarga($errors, $data['harga']);
    validateStok($errors, $data['stok']);
    validateSupplierId($errors, $data['supplier_id']);
    
    if ($errors === []) {
        if(insertBarang($conn, $data) > 0){
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
    <title>Tambah Barang</title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/form.css">

</head>
<body>
<?php include '../../template/navbar.php'; ?>
<div class="container">
    <h2>Tambah Barang</h2>
    <div class="content">
        <form method="post">
            <div>
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" value="<?= htmlspecialchars($data['kode_barang'] ?? '') ?>" placeholder="Masukkan kode barang">
                <div class="error"><?= $errors["kode_barang"] ?? "" ?></div>
            </div>
            <div>
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang'] ?? '') ?>" placeholder="Masukkan nama barang">
                <div class="error"><?= $errors["nama_barang"] ?? "" ?></div>
            </div>
            <div>
                <label>Harga</label>
                <input type="number" name="harga" value="<?= htmlspecialchars($data['harga'] ?? '') ?>" placeholder="Masukkan harga barang">
                <div class="error"><?= $errors["harga"] ?? "" ?></div>
            </div>
            <div>
                <label>Stok</label>
                <input type="number" name="stok" value="<?= htmlspecialchars($data['stok'] ?? '') ?>" placeholder="Masukkan stok barang">
                <div class="error"><?= $errors["stok"] ?? "" ?></div>
            </div>
            <div>
                <label>Supplier</label>
                <select name="supplier_id">
                    <option value="">Pilih Supplier</option>
                    <?php foreach(getData($conn, "SELECT * FROM supplier") as $supplier): ?>
                        <option value="<?= $supplier['id'] ?>" <?= (isset($data['supplier_id']) && $data['supplier_id'] == $supplier['id']) ? 'selected' : '' ?>><?= htmlspecialchars($supplier['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error"><?= $errors["supplier_id"] ?? "" ?></div>
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