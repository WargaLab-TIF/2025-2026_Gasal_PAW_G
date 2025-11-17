<?php
require 'db.php';
$transaksi_id = intval($_GET['id'] ?? 0);
if (!$transaksi_id) { echo 'id transaksi diperlukan'; exit; }

$stmt = $pdo->prepare('SELECT t.*, p.nama as pelanggan_nama FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id WHERE t.id = ?');
$stmt->execute([$transaksi_id]);
$transaksi = $stmt->fetch();
if (!$transaksi) { echo 'Transaksi tidak ditemukan'; exit; }

// handle delete detail if requested
if (isset($_GET['delete_detail_id'])) {
    $del_id = intval($_GET['delete_detail_id']);
    // delete the detail
    $del = $pdo->prepare('DELETE FROM transaksi_detail WHERE id = ? AND transaksi_id = ?');
    $del->execute([$del_id, $transaksi_id]);
    // recalc total
    $sum = $pdo->prepare('SELECT COALESCE(SUM(harga),0) as tot FROM transaksi_detail WHERE transaksi_id = ?');
    $sum->execute([$transaksi_id]);
    $s = $sum->fetch();
    $total = $s['tot'] ?? 0;
    $upd = $pdo->prepare('UPDATE transaksi SET total = ? WHERE id = ?');
    $upd->execute([$total, $transaksi_id]);
    header('Location: transaksi_detail.php?id=' . $transaksi_id);
    exit;
}

$details = $pdo->prepare('SELECT td.*, b.nama as barang_nama FROM transaksi_detail td JOIN barang b ON td.barang_id=b.id WHERE td.transaksi_id = ?');
$details->execute([$transaksi_id]);
$details = $details->fetchAll();
?>
<!doctype html><html><head><title>Detail Transaksi</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Detail Transaksi #<?=htmlspecialchars($transaksi_id)?></h1>
  <p>Waktu: <?=htmlspecialchars($transaksi['waktu'])?> | Pelanggan: <?=htmlspecialchars($transaksi['pelanggan_nama'])?> | Total: <?=number_format($transaksi['total'])?></p>

  <h2>Rincian</h2>
  <table>
    <tr><th>ID</th><th>Barang</th><th>Qty</th><th>Harga (subtotal)</th><th>Aksi</th></tr>
    <?php foreach($details as $d): ?>
    <tr>
      <td><?=htmlspecialchars($d['id'])?></td>
      <td><?=htmlspecialchars($d['barang_nama'])?></td>
      <td><?=htmlspecialchars($d['qty'])?></td>
      <td><?=number_format($d['harga'])?></td>
      <td>
        <a class="button" href="edit_detail.php?id=<?=urlencode($d['id'])?>&transaksi_id=<?=urlencode($transaksi_id)?>">Edit</a>
        <a class="button" href="javascript:void(0)" onclick="if(confirm('Yakin hapus detail ini?')){ window.location='transaksi_detail.php?id=<?=urlencode($transaksi_id)?>&delete_detail_id=' + encodeURIComponent(<?=json_encode($d['id'])?>); }">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <p><a class="button" href="add_detail.php?transaksi_id=<?=urlencode($transaksi_id)?>">Tambah Detail</a> | <a href="index.php">Kembali</a></p>
</div>
</body></html>
