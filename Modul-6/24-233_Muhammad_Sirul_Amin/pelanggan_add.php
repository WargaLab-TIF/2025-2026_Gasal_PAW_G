<?php
require 'db.php';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $alamat = trim($_POST['alamat'] ?? '');
  if ($nama === '') $err = "Nama harus diisi";
  else {
    $stmt = $mysqli->prepare("INSERT INTO pelanggan (nama, alamat) VALUES (?, ?)");
    $stmt->bind_param('ss', $nama, $alamat);
    $stmt->execute();
    header('Location: index.php'); exit;
  }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Pelanggan</title><link rel="stylesheet" href="assets/styles.css"></head>
<body>
<div class="wrap"><div class="card">
<h2 class="title">Tambah Pelanggan</h2>
<?php if($err) echo '<div class="alert alert-error">'.htmlspecialchars($err).'</div>'; ?>
<form method="post">
  <div class="form-group"><label>Nama</label><input name="nama" required></div>
  <div class="form-group"><label>Alamat</label><textarea name="alamat"></textarea></div>
  <button class="btn" type="submit">Simpan</button>
</form>
</div></div>
</body></html>
