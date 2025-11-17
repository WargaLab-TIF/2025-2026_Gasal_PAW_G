<?php
require 'db.php';
$detail_id = intval($_GET['id'] ?? 0);
$transaksi_id = intval($_GET['transaksi_id'] ?? 0);
if (!$detail_id || !$transaksi_id) { echo 'Parameter tidak lengkap'; exit; }

// fetch detail and barang info
$stmt = $pdo->prepare('SELECT td.*, b.nama as barang_nama, b.harga_satuan FROM transaksi_detail td JOIN barang b ON td.barang_id=b.id WHERE td.id = ? AND td.transaksi_id = ?');
$stmt->execute([$detail_id, $transaksi_id]);
$detail = $stmt->fetch();
if (!$detail) { echo 'Detail tidak ditemukan'; exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qty = intval($_POST['qty'] ?? 0);
    if ($qty <= 0) $errors[] = 'Qty harus lebih dari 0.';
    if (empty($errors)) {
        $harga = $detail['harga_satuan'] * $qty;
        $upd = $pdo->prepare('UPDATE transaksi_detail SET qty = ?, harga = ? WHERE id = ?');
        $upd->execute([$qty, $harga, $detail_id]);

        // recalc total
        $sum = $pdo->prepare('SELECT COALESCE(SUM(harga),0) as tot FROM transaksi_detail WHERE transaksi_id = ?');
        $sum->execute([$transaksi_id]);
        $s = $sum->fetch();
        $total = $s['tot'] ?? 0;
        $upd2 = $pdo->prepare('UPDATE transaksi SET total = ? WHERE id = ?');
        $upd2->execute([$total, $transaksi_id]);

        header('Location: transaksi_detail.php?id=' . $transaksi_id);
        exit;
    }
}
?>
<!doctype html>
<html><head><title>Edit Detail</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Edit Detail #<?=htmlspecialchars($detail_id)?></h1>
  <p>Barang: <?=htmlspecialchars($detail['barang_nama'])?> | Harga Satuan: <?=number_format($detail['harga_satuan'])?></p>
  <?php if ($errors): foreach($errors as $e): ?><small class="error"><?=htmlspecialchars($e)?></small><?php endforeach; endif; ?>
  <form method="post">
    <div class="form-row"><label>Qty</label><input type="number" name="qty" min="1" value="<?=htmlspecialchars($detail['qty'])?>" required></div>
    <button class="button" type="submit">Simpan Perubahan</button>
  </form>
  <p><a href="transaksi_detail.php?id=<?=urlencode($transaksi_id)?>">Kembali</a></p>
</div>
</body></html>
