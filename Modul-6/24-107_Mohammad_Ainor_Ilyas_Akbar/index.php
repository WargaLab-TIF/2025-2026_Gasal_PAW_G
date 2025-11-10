<?php
require 'db.php';
$barang = $pdo->query('SELECT * FROM barang')->fetchAll();
$pelanggan = $pdo->query('SELECT * FROM pelanggan')->fetchAll();
$transaksi = $pdo->query('SELECT t.*, p.nama as pelanggan_nama FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id = p.id ORDER BY t.id DESC')->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard - Master Detail</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
  <h1>Dashboard - Master-Detail</h1>

  <h2>Barang <a class="button" href="barang.php">Kelola Barang</a></h2>
  <table>
    <tr><th>ID</th><th>Nama</th><th>Harga Satuan</th></tr>
    <?php foreach($barang as $b): ?>
    <tr><td><?=htmlspecialchars($b['id'])?></td><td><?=htmlspecialchars($b['nama'])?></td><td><?=number_format($b['harga_satuan'])?></td></tr>
    <?php endforeach; ?>
  </table>

  <h2>Pelanggan <a class="button" href="pelanggan.php">Kelola Pelanggan</a></h2>
  <table>
    <tr><th>ID</th><th>Nama</th></tr>
    <?php foreach($pelanggan as $p): ?>
    <tr><td><?=htmlspecialchars($p['id'])?></td><td><?=htmlspecialchars($p['nama'])?></td></tr>
    <?php endforeach; ?>
  </table>

  <h2>Transaksi <a class="button" href="add_transaksi.php">Tambah Transaksi</a></h2>
  <table>
    <tr><th>ID</th><th>Waktu</th><th>Keterangan</th><th>Pelanggan</th><th>Total</th><th>Aksi</th></tr>
    <?php foreach($transaksi as $t): ?>
    <tr>
      <td><?=htmlspecialchars($t['id'])?></td>
      <td><?=htmlspecialchars($t['waktu'])?></td>
      <td><?=htmlspecialchars($t['keterangan'])?></td>
      <td><?=htmlspecialchars($t['pelanggan_nama'])?></td>
      <td><?=number_format($t['total'])?></td>
      <td>
        <a class="button" href="transaksi_detail.php?id=<?=urlencode($t['id'])?>">Lihat Detail</a>
        <a class="button" href="add_detail.php?transaksi_id=<?=urlencode($t['id'])?>">Tambah Detail</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
