<?php
require 'db.php';

// fetch pelanggan list
$pelanggan = $pdo->query('SELECT * FROM pelanggan')->fetchAll();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $waktu = $_POST['waktu'] ?? '';
    $keterangan = trim($_POST['keterangan'] ?? '');
    $pelanggan_id = $_POST['pelanggan_id'] ?? null;

    // validation: waktu >= today
    $today = date('Y-m-d');
    if (!$waktu || $waktu < $today) {
        $errors[] = 'Tanggal transaksi tidak boleh kurang dari hari ini.';
    }
    if (strlen($keterangan) < 3) {
        $errors[] = 'Keterangan minimal 3 karakter.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('INSERT INTO transaksi (waktu, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)');
        $stmt->execute([$waktu, $keterangan, $pelanggan_id ?: null]);
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html><html><head><title>Tambah Transaksi</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Tambah Transaksi</h1>
  <?php if ($errors): foreach($errors as $e): ?><small class="error"><?=htmlspecialchars($e)?></small><?php endforeach; endif; ?>
  <form method="post">
    <div class="form-row"><label>Waktu (tanggal)</label><input type="date" name="waktu" value="<?=htmlspecialchars($_POST['waktu'] ?? '')?>" required></div>
    <div class="form-row"><label>Keterangan</label><textarea name="keterangan" required><?=htmlspecialchars($_POST['keterangan'] ?? '')?></textarea></div>
    <div class="form-row"><label>Pelanggan</label>
      <select name="pelanggan_id">
        <option value="">-- Pilih Pelanggan --</option>
        <?php foreach($pelanggan as $p): ?>
          <option value="<?=htmlspecialchars($p['id'])?>" <?=isset($_POST['pelanggan_id']) && $_POST['pelanggan_id']==$p['id'] ? 'selected' : ''?>><?=htmlspecialchars($p['nama'])?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button class="button" type="submit">Simpan Transaksi</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</div>
</body></html>
