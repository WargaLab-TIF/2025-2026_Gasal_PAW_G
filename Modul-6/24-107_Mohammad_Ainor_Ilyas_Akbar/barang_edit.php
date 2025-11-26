<?php
require 'db.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM barang WHERE id = ?');
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) {
    echo 'Barang tidak ditemukan'; exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = intval($_POST['harga'] ?? 0);
    $stmt = $pdo->prepare('UPDATE barang SET nama=?, harga_satuan=? WHERE id=?');
    $stmt->execute([$nama, $harga, $id]);
    header('Location: barang.php');
    exit;
}
?>
<!doctype html><html><head><title>Edit Barang</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Edit Barang</h1>
  <form method="post">
    <div class="form-row"><label>Nama</label><input name="nama" value="<?=htmlspecialchars($item['nama'])?>" required></div>
    <div class="form-row"><label>Harga Satuan</label><input name="harga" type="number" value="<?=htmlspecialchars($item['harga_satuan'])?>" required></div>
    <button class="button" type="submit">Simpan</button>
  </form>
  <p><a href="barang.php">Kembali</a></p>
</div>
</body></html>
