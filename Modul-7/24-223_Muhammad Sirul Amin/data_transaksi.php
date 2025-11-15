<?php
require 'db.php';

$sql = "
    SELECT t.id, t.tanggal, t.total_harga, t.keterangan,
           COALESCE(p.nama, '-') AS nama_pelanggan
    FROM transaksi t
    LEFT JOIN pelanggan p ON p.id = t.pelanggan_id
    ORDER BY t.id DESC
";
$data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4 bg-light">
<div class="container">

  <h2>Data Transaksi</h2>

  <div class="mb-3 text-end">
    <a href="tambah_transaksi.php" class="btn btn-success">Tambah Transaksi</a>
    <a href="report_transaksi.php" class="btn btn-primary">Laporan</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>ID</th>
        <th>Waktu</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php if (!$data): ?>
        <tr><td colspan="7" class="text-center">Tidak ada data.</td></tr>
      <?php else: $no=1; foreach($data as $t): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $t['id'] ?></td>
          <td><?= $t['tanggal'] ?></td>
          <td><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
          <td><?= htmlspecialchars($t['keterangan']) ?></td>
          <td>Rp <?= number_format($t['total_harga']) ?></td>
          <td>
            <a href="detail_transaksi.php?id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Detail</a>
            <a href="edit_transaksi.php?id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          </td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>

  </table>

</div>
</body>
</html>
