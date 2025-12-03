<?php
require 'db.php';
$transaksi = $pdo->query('SELECT t.*, p.nama as pelanggan_nama FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.id DESC')->fetchAll();
?>
<!doctype html><html><head><title>Transaksi</title><link rel="stylesheet" href="assets/style.css"></head><body>
<div class="container">
  <h1>Daftar Transaksi</h1>
  <a class="button" href="add_transaksi.php">Tambah Transaksi</a>
  <table>
    <tr><th>ID</th><th>Waktu</th><th>Pelanggan</th><th>Total</th><th>Aksi</th></tr>
    <?php foreach($transaksi as $t): ?>
    <tr>
      <td><?=htmlspecialchars($t['id'])?></td>
      <td><?=htmlspecialchars($t['waktu'])?></td>
      <td><?=htmlspecialchars($t['pelanggan_nama'])?></td>
      <td><?=number_format($t['total'])?></td>
      <td><a class="button" href="transaksi_detail.php?id=<?=urlencode($t['id'])?>">Lihat</a></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <p><a href="index.php">Kembali</a></p>
</div>
</body></html>
