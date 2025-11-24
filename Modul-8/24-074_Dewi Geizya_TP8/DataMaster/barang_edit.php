<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    echo "Tidak punya akses.";
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id=?");
$stmt->execute([$id]);
$barang = $stmt->fetch();

if (!$barang) {
    echo "Data tidak ditemukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'] ?? null;

    $update = $pdo->prepare("UPDATE barang SET kode_barang=?, nama_barang=?, harga=?, stok=?, supplier_id=? WHERE id=?");
    $update->execute([$kode, $nama, $harga, $stok, $supplier_id, $id]);

    header("Location: barang_index.php");
    exit;
}

$stmt_supplier = $pdo->query("SELECT * FROM supplier ORDER BY nama ASC");
$suppliers = $stmt_supplier->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 450px; margin: auto; padding: 25px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; text-align: center; }
        form div { margin-bottom: 15px; overflow: hidden; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #f0ad4e; color: white; border: none; border-radius: 4px; cursor: pointer; float: right; }
        button:hover { background: #ed9c28; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit Barang</h2>
    <a href="barang_index.php" class="back">← Kembali</a>
    <hr>

    <form method="post">
        <div>
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= $barang['kode_barang'] ?>" required>
        </div>
        <div>
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required>
        </div>
        <div>
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="<?= $barang['harga'] ?>" required min="0">
        </div>
        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" value="<?= $barang['stok'] ?>" required min="0">
        </div>
        <div>
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="supplier_id">
                <option value="">Pilih Supplier (Opsional)</option>
                <?php foreach ($suppliers as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $barang['supplier_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button type="submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

</body>
</html>