<?php
require 'db.php';

$id = $_GET['id'];
$q = $db->prepare("
    SELECT t.*, COALESCE(p.nama,'-') AS nama
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id=t.pelanggan_id
    WHERE t.id=?");
$q->execute([$id]);
$d = $q->fetch(PDO::FETCH_ASSOC);

if(!$d) die("Data tidak ditemukan.");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Detail Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">

<h2>Detail Transaksi #<?= $d['id'] ?></h2>

<div class="card p-4">
  <table class="table table-bordered">
    <tr><th>ID</th><td><?= $d['id'] ?></td></tr>
    <tr><th>Pelanggan</th><td><?= htmlspecialchars($d['nama']) ?></td></tr>
    <tr><th>Tanggal</th><td><?= $d['tanggal'] ?></td></tr>
    <tr><th>Keterangan</th><td><?= nl2br($d['keterangan']) ?></td></tr>
    <tr><th>Total Harga</th><td>Rp <?= number_format($d['total_harga']) ?></td></tr>
  </table>
</div>

<a href="edit_transaksi.php?id=<?= $d['id'] ?>" class="btn btn-warning mt-3">Edit</a>
<a href="data_transaksi.php" class="btn btn-secondary mt-3">Kembali</a>

</div>
</body>
</html>
