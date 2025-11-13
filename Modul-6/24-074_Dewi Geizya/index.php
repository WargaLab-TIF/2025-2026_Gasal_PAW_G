<?php
include 'koneksi.php';
$barang=$conn->query("SELECT * FROM barang");
$transaksi=$conn->query("SELECT * FROM transaksi");
$detail=$conn->query("SELECT * FROM transaksi_detail");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Master Detail Data</title>
<style>
body{font-family:Arial;background:#f8f9fa;}
table{border-collapse:collapse;width:90%;margin:20px auto;background:#fff;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
th{background:#ccc;color:white;}
h2{text-align:center;}
.btn{padding:5px 10px;background: #2b08dcff;;color:white;text-decoration:none;border-radius:4px;margin:2px;}
</style>
</head>
<body>
<h2>Data Barang</h2>
<a class="btn" href="transaksi_tambah.php">Tambah Transaksi</a>
<a class="btn" href="transaksi_detail_tambah.php">Tambah Detail</a>

<table>
<tr><th>ID</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Action</th></tr>
<?php while($b=$barang->fetch_assoc()): ?>
<tr>
<td><?= $b['barang_id'] ?></td>
<td><?= $b['nama_barang'] ?></td>
<td><?= number_format($b['harga']) ?></td>
<td><?= $b['stok'] ?></td>
<td><a href="barang_hapus.php?id=<?= $b['barang_id'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>

<h2>Data Transaksi</h2>
<table>
<tr><th>ID</th><th>Waktu</th><th>Keterangan</th><th>Total</th><th>Pelanggan ID</th></tr>
<?php while($t=$transaksi->fetch_assoc()): ?>
<tr>
<td><?= $t['transaksi_id'] ?></td>
<td><?= $t['waktu_transaksi'] ?></td>
<td><?= $t['keterangan'] ?></td>
<td><?= number_format($t['total']) ?></td>
<td><?= $t['pelanggan_id'] ?></td>
</tr>
<?php endwhile; ?>
</table>

<h2>Data Detail Transaksi</h2>
<table>
<tr><th>ID</th><th>Transaksi ID</th><th>Barang ID</th><th>Harga</th><th>Qty</th></tr>
<?php while($d=$detail->fetch_assoc()): ?>
<tr>
<td><?= $d['transaksi_detail_id'] ?></td>
<td><?= $d['transaksi_id'] ?></td>
<td><?= $d['barang_id'] ?></td>
<td><?= number_format($d['harga']) ?></td>
<td><?= $d['qty'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
