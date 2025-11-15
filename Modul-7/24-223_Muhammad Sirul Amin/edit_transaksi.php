<?php
require 'db.php';

$id = $_GET['id'];
$q = $db->prepare("SELECT * FROM transaksi WHERE id=?");
$q->execute([$id]);
$trx = $q->fetch(PDO::FETCH_ASSOC);

$nama = $db->query("SELECT nama FROM pelanggan WHERE id=".$trx['pelanggan_id'])->fetchColumn();

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nama = trim($_POST['pelanggan']);
    $tanggal = $_POST['tanggal'];
    $ket = $_POST['keterangan'];
    $total = $_POST['total'];

    $q = $db->prepare("SELECT id FROM pelanggan WHERE nama=?");
    $q->execute([$nama]);
    $pid = $q->fetchColumn();

    if (!$pid) {
        $add = $db->prepare("INSERT INTO pelanggan (nama) VALUES (?)");
        $add->execute([$nama]);
        $pid = $db->lastInsertId();
    }

    $up = $db->prepare("UPDATE transaksi SET pelanggan_id=?, tanggal=?, keterangan=?, total_harga=? WHERE id=?");
    $up->execute([$pid,$tanggal,$ket,$total,$id]);

    header("Location: detail_transaksi.php?id=$id");
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">

<h2>Edit Transaksi #<?= $id ?></h2>

<form method="POST" class="card p-4">

  <label>Nama Pelanggan</label>
  <input type="text" name="pelanggan" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>

  <label class="mt-3">Tanggal</label>
  <input type="datetime-local" name="tanggal" class="form-control"
         value="<?= date('Y-m-d\TH:i', strtotime($trx['tanggal'])) ?>" required>

  <label class="mt-3">Keterangan</label>
  <input type="text" name="keterangan" class="form-control" value="<?= htmlspecialchars($trx['keterangan']) ?>">

  <label class="mt-3">Total Harga</label>
  <input type="number" name="total" class="form-control" value="<?= $trx['total_harga'] ?>" required>

  <button class="btn btn-primary mt-4">Simpan</button>
  <a href="detail_transaksi.php?id=<?= $id ?>" class="btn btn-secondary mt-4">Batal</a>

</form>

</div>
</body>
</html>
