<?php
require 'db.php';
$errors = []; $success = false;
$transaksi_id = intval($_POST['transaksi_id'] ?? 0);
$barang_id = intval($_POST['barang_id'] ?? 0);
$qty = intval($_POST['qty'] ?? 1);


$transaksi_res = $mysqli->query("SELECT t.id, t.waktu_transaksi, p.nama AS pelanggan FROM transaksi t JOIN pelanggan p ON t.pelanggan_id=p.id ORDER BY t.id DESC");
$transaksi_list = $transaksi_res ? $transaksi_res->fetch_all(MYSQLI_ASSOC) : [];

if (isset($_POST['add'])) {
    if ($transaksi_id <= 0) $errors[] = "Pilih transaksi.";
    if ($barang_id <= 0) $errors[] = "Pilih barang.";
    if ($qty <= 0) $errors[] = "Qty harus lebih dari 0.";
    if (!$errors) {
        $cek = $mysqli->prepare("SELECT COUNT(*) AS cnt FROM transaksi_detail WHERE transaksi_id=? AND barang_id=?");
        $cek->bind_param("ii", $transaksi_id, $barang_id);
        $cek->execute();
        $exists = $cek->get_result()->fetch_assoc()['cnt'] ?? 0;
        if ($exists > 0) $errors[] = "Barang ini sudah ada pada transaksi tersebut.";
    }
    if (!$errors) {
        $stmt = $mysqli->prepare("SELECT harga_satuan FROM barang WHERE id=? LIMIT 1");
        $stmt->bind_param("i", $barang_id);
        $stmt->execute();
        $harga_satuan = intval($stmt->get_result()->fetch_assoc()['harga_satuan'] ?? 0);
        $harga_total = $harga_satuan * $qty;
        $mysqli->begin_transaction();
        try {
            $ins = $mysqli->prepare("INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES (?, ?, ?, ?)");
            $ins->bind_param("iiii", $transaksi_id, $barang_id, $qty, $harga_total);
            $ins->execute();
            $upd = $mysqli->prepare("UPDATE transaksi SET total = (SELECT COALESCE(SUM(harga),0) FROM transaksi_detail WHERE transaksi_id=?) WHERE id=?");
            $upd->bind_param("ii", $transaksi_id, $transaksi_id);
            $upd->execute();
            $mysqli->commit();
            $success = true;
            // reset barang/qty 
            $barang_id = 0; $qty = 1;
        } catch (Exception $e) {
            $mysqli->rollback();
            $errors[] = "Gagal menyimpan: " . $e->getMessage();
        }
    }
}

$barang_list = [];
if (isset($_POST['load']) || $transaksi_id > 0) {
    if ($transaksi_id > 0) {
        $stmt = $mysqli->prepare("SELECT id, nama, harga_satuan FROM barang WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?) ORDER BY nama");
        $stmt->bind_param("i", $transaksi_id);
        $stmt->execute();
        $barang_list = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Detail Transaksi</title>
  <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
<div class="wrap"><div class="card">
  <h2 class="title">Tambah Detail Transaksi</h2>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-error"><ul style="margin:0;padding-left:18px;"><?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert alert-success">Detail transaksi berhasil ditambahkan. <a href="index.php">Kembali ke index</a></div>
  <?php endif; ?>

  <form method="post">
    <div class="form-group">
      <label>Transaksi</label>
      <select name="transaksi_id">
        <option value="">Pilih Transaksi</option>
        <?php foreach ($transaksi_list as $t): ?>
          <option value="<?= (int)$t['id'] ?>" <?= $transaksi_id === (int)$t['id'] ? 'selected' : '' ?>>
            ID <?= (int)$t['id'] ?> — <?= htmlspecialchars($t['pelanggan']) ?> (<?= htmlspecialchars($t['waktu_transaksi']) ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div style="display:flex;gap:8px;margin-bottom:12px;">
      <button type="submit" name="load" class="btn">Muat Barang</button>
      <span class="small hint">Tekan "Muat Barang" setelah memilih transaksi untuk menampilkan daftar barang tersisa.</span>
    </div>

    <div class="form-group">
      <label>Barang</label>
      <select name="barang_id">
        <option value="">-- Pilih Barang --</option>
        <?php foreach ($barang_list as $b): ?>
          <option value="<?= (int)$b['id'] ?>" <?= $barang_id === (int)$b['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($b['nama']) ?> — Rp<?= number_format($b['harga_satuan'],0,',','.') ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-group">
      <label>Qty</label>
      <input type="number" name="qty" min="1" value="<?= max(1, (int)$qty) ?>">
    </div>

    <div style="display:flex;gap:8px;">
      <button class="btn" type="submit" name="add">Tambah Detail</button>
      <a class="btn" href="index.php" style="background:#6b7280">Batal</a>
    </div>
  </form>

  <div class="small">Harga dihitung otomatis.</div>
</div></div>
</body>
</html>
