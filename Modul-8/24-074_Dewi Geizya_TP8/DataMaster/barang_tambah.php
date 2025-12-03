<?php
include '../auth.php';
require '../koneksi.php';

if ($_SESSION['user']['level'] != 1) {
    echo "Tidak punya akses";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'] ?? null;

    $insert = $pdo->prepare("INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES (?, ?, ?, ?, ?)");
    $insert->execute([$kode, $nama, $harga, $stok, $supplier_id]);

    header("Location: barang_index.php");
    exit;
}

$suppliers = $pdo->query("SELECT id, nama FROM supplier")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef3ff; padding: 30px; }
        .box { background: white; width: 450px; margin: auto; padding: 25px; border-radius: 10px; box-shadow: 0 0 12px rgba(0,0,0,0.1); }
        h2 { color: #0057b7; text-align: center; }
        form div { margin-bottom: 15px; overflow: hidden; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 15px; background: #5cb85c; color: white; border: none; border-radius: 4px; cursor: pointer; float: right; }
        button:hover { background: #449d44; }
        .back { display: block; margin-top: 15px; text-decoration: none; color: #0057b7; font-weight: bold; }
    </style>
</head>
<body>

<div class="box">
    <h2>Tambah Data Barang</h2>
    <a href="barang_index.php" class="back">← Kembali</a>
    <hr>
    
    <form method="post">
        <div>
            <label for="kode_barang">Kode Barang</label>
            <input type="text" name="kode_barang" id="kode_barang" required>
        </div>
        <div>
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" required>
        </div>
        <div>
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" required min="0">
        </div>
        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" required min="0">
        </div>
        <div>
            <label for="supplier_id">Supplier</label>
            <select name="supplier_id" id="supplier_id">
                <option value="">Pilih Supplier (Opsional)</option>
                <?php foreach ($suppliers as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button type="submit">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>