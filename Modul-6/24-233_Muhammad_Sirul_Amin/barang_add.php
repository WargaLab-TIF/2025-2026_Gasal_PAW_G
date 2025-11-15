<?php
require 'db.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $harga = intval($_POST['harga'] ?? 0);
  if ($nama === '' || $harga <= 0) $err = "Nama & harga harus diisi, harga > 0";
  else {
    $stmt = $mysqli->prepare("INSERT INTO barang (nama, harga_satuan) VALUES (?, ?)");
    $stmt->bind_param('si', $nama, $harga);
    $stmt->execute();
    header('Location: index.php'); exit;
  }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Barang</title><link rel="stylesheet" href="assets/styles.css"></head>
<body>
<div class="wrap"><div class="card">
<h2 class="title">Tambah Barang</h2>
<?php if($err) echo '<div class="alert alert-error">'.htmlspecialchars($err).'</div>'; ?>
<form method="post">
  <div class="form-group"><label>Nama</label><input name="nama" required></div>
  <div class="form-group"><label>Harga Satuan (angka)</label><input name="harga" type="number" min="1" required></div>
  <button class="btn" type="submit">Simpan</button>
</form>
</div></div>
</body></html>
