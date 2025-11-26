<?php
require 'db.php';

$transaksi_id = intval($_GET['transaksi_id'] ?? 0);
if (!$transaksi_id) {
    echo 'transaksi_id diperlukan'; exit;
}

// fetch transaksi to display
$stmt = $pdo->prepare('SELECT * FROM transaksi WHERE id = ?');
$stmt->execute([$transaksi_id]);
$transaksi = $stmt->fetch();
if (!$transaksi) { echo 'Transaksi tidak ditemukan'; exit; }

// fetch barang list but exclude those already in this transaksi_detail
$stmt = $pdo->prepare('SELECT b.* FROM barang b WHERE b.id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?) ORDER BY b.nama');
$stmt->execute([$transaksi_id]);
$barang_list = $stmt->fetchAll();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = intval($_POST['barang_id'] ?? 0);
    $qty = intval($_POST['qty'] ?? 0);

    if ($barang_id <= 0) $errors[] = 'Pilih barang.';
    if ($qty <= 0) $errors[] = 'Qty harus > 0.';

    // check duplicate (server-side)
    $stmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM transaksi_detail WHERE transaksi_id=? AND barang_id=?');
    $stmt->execute([$transaksi_id, $barang_id]);
    $row = $stmt->fetch();
    if ($row && $row['cnt'] > 0) { $errors[] = 'Barang sudah ada pada transaksi ini.'; }

    if (empty($errors)) {
        // get harga_satuan
        $stmt = $pdo->prepare('SELECT harga_satuan FROM barang WHERE id = ?');
        $stmt->execute([$barang_id]);
        $b = $stmt->fetch();
        if (!$b) { $errors[] = 'Barang tidak ditemukan.'; }
        else {
            $harga = $b['harga_satuan'] * $qty;
            // insert detail
            $ins = $pdo->prepare('INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES (?, ?, ?, ?)');
            $ins->execute([$transaksi_id, $barang_id, $qty, $harga]);

            // update total in transaksi: sum harga where transaksi_id
            $sum = $pdo->prepare('SELECT COALESCE(SUM(harga),0) as tot FROM transaksi_detail WHERE transaksi_id = ?');
            $sum->execute([$transaksi_id]);
            $s = $sum->fetch();
            $total = $s['tot'] ?? 0;
            $upd = $pdo->prepare('UPDATE transaksi SET total = ? WHERE id = ?');
            $upd->execute([$total, $transaksi_id]);

            header('Location: transaksi_detail.php?id=' . $transaksi_id);
            exit;
        }
    }
}
?>
<!doctype html><html><head><title>Tambah Detail Transaksi</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Tambah Detail untuk Transaksi #<?=htmlspecialchars($transaksi_id)?></h1>
  <p>Waktu: <?=htmlspecialchars($transaksi['waktu'])?> | Keterangan: <?=htmlspecialchars($transaksi['keterangan'])?></p>
  <?php if ($errors): foreach($errors as $e): ?><small class="error"><?=htmlspecialchars($e)?></small><?php endforeach; endif; ?>

  <form method="post">
    <div class="form-row"><label>Barang</label>
      <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>
        <?php foreach($barang_list as $b): ?>
          <option value="<?=htmlspecialchars($b['id'])?>"><?=htmlspecialchars($b['nama'])?> (<?=number_format($b['harga_satuan'])?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-row"><label>Qty</label><input type="number" name="qty" min="1" value="1" required></div>
    <button class="button" type="submit">Tambahkan</button>
  </form>

  <p><a href="transaksi_detail.php?id=<?=urlencode($transaksi_id)?>">Lihat Detail</a> | <a href="index.php">Kembali</a></p>
</div>
</body></html>
