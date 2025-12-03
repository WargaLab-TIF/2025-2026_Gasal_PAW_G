<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = trim($_POST['pelanggan']);
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total_harga'];

    // cek pelanggan
    $q = $db->prepare("SELECT id FROM pelanggan WHERE nama=?");
    $q->execute([$nama]);
    $pid = $q->fetchColumn();

    if (!$pid) {
        $ins = $db->prepare("INSERT INTO pelanggan (nama) VALUES (?)");
        $ins->execute([$nama]);
        $pid = $db->lastInsertId();
    }

    $sql = $db->prepare("INSERT INTO transaksi (pelanggan_id,tanggal,keterangan,total_harga) VALUES (?,?,?,?)");
    $sql->execute([$pid,$tanggal,$keterangan,$total]);

    header("Location: data_transaksi.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tambah Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">

<h2>Tambah Transaksi</h2>

<form method="POST" class="card p-4">
  <label>Nama Pelanggan</label>
  <input type="text" name="pelanggan" class="form-control" required>

  <label class="mt-3">Tanggal</label>
  <input type="datetime-local" name="tanggal" class="form-control" required>

  <label class="mt-3">Keterangan</label>
  <input type="text" name="keterangan" class="form-control">

  <label class="mt-3">Total Harga</label>
  <input type="number" name="total_harga" class="form-control" required>

  <button class="btn btn-success mt-4">Simpan</button>
  <a href="data_transaksi.php" class="btn btn-secondary mt-4">Kembali</a>
</form>

</div>
</body>
</html>
