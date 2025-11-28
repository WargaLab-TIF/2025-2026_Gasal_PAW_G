<?php
require 'db.php';
$errors = [];
$pelanggan_res = $mysqli->query("SELECT id, nama FROM pelanggan ORDER BY nama");
$pelanggan_list = $pelanggan_res ? $pelanggan_res->fetch_all(MYSQLI_ASSOC) : [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $waktu = trim($_POST['waktu_transaksi'] ?? '');
    $keterangan = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = intval($_POST['pelanggan_id'] ?? 0);
    $today = date('Y-m-d');
    if ($waktu === '') $errors[] = "Waktu transaksi harus diisi.";
    else if (date('Y-m-d', strtotime($waktu)) < $today) $errors[] = "Tanggal transaksi tidak boleh sebelum hari ini ($today).";
    if (strlen($keterangan) < 3) $errors[] = "Keterangan minimal 3 karakter.";
    if ($pelanggan_id <= 0) $errors[] = "Silakan pilih pelanggan.";
    if (empty($errors)) {
        $stmt = $mysqli->prepare("INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)");
        $zero = 0;
        $stmt->bind_param('ssii', $waktu, $keterangan, $zero, $pelanggan_id);
        if ($stmt->execute()) { header('Location: index.php'); exit; }
        else $errors[] = "Gagal menyimpan data: ".$stmt->error;
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Tambah Transaksi</title><link rel="stylesheet" href="assets/styles.css"></head>
<body>
<div class="wrap"><div class="card">
<h2 class="title">Tambah Data Transaksi</h2>
<?php if(!empty($errors)): ?><div class="alert alert-error"><ul style="margin:0;padding-left:18px;"><?php foreach($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div><?php endif; ?>
<form method="post">
  <div class="form-group"><label>Waktu Transaksi</label><input name="waktu_transaksi" type="date" required></div>
  <div class="form-group"><label>Keterangan</label><textarea name="keterangan" minlength="3" required></textarea></div>
  <div class="form-group"><label>Pelanggan</label><select name="pelanggan_id" required><option value="">Pilih Pelanggan</option><?php foreach($pelanggan_list as $p) echo '<option value="'.(int)$p['id'].'">'.htmlspecialchars($p['nama']).'</option>'; ?></select></div>
  <button class="btn" type="submit">Tambah Transaksi</button>
</form>
<div class="small">Total di-set 0 saat membuat transaksi master. Tambah detail untuk mengubah total.</div>
</div></div>
</body></html>
