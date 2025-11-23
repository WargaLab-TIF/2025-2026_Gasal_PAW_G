<?php
session_start();
require_once 'koneksi.php';

$sql_barang = "SELECT id, nama_barang, harga, stok FROM barang";
$hasil_barang = mysqli_query($koneksi, $sql_barang);

$sql_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama 
                  FROM transaksi t 
                  JOIN pelanggan p ON t.pelanggan_id = p.id";
$hasil_transaksi = mysqli_query($koneksi, $sql_transaksi);

$sql_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty 
               FROM transaksi_detail td 
               JOIN barang b ON td.barang_id = b.id";
$hasil_detail = mysqli_query($koneksi, $sql_detail);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengelolaan Master Detail</title>
</head>
<body>

    <h1>Pengelolaan Master Detail</h1>
    <hr>

    <h2>Barang</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($b = mysqli_fetch_assoc($hasil_barang)): ?>
            <tr>
                <td><?= htmlspecialchars($b['id']) ?></td>
                <td><?= htmlspecialchars($b['nama_barang']) ?></td>
                <td><?= number_format($b['harga']) ?></td>
                <td><?= htmlspecialchars($b['stok']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>

    <h2>Transaksi</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($t = mysqli_fetch_assoc($hasil_transaksi)): ?>
            <tr>
                <td><?= htmlspecialchars($t['id']) ?></td>
                <td><?= htmlspecialchars($t['waktu_transaksi']) ?></td>
                <td><?= htmlspecialchars($t['keterangan']) ?></td>
                <td><?= number_format($t['total']) ?></td>
                <td><?= htmlspecialchars($t['nama']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>

    <h2>Transaksi Detail</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($td = mysqli_fetch_assoc($hasil_detail)): ?>
            <tr>
                <td><?= htmlspecialchars($td['transaksi_id']) ?></td>
                <td><?= htmlspecialchars($td['nama_barang']) ?></td>
                <td><?= number_format($td['harga']) ?></td>
                <td><?= htmlspecialchars($td['qty']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <hr>

    <a href="tambah_transaksi.php">
        <button>Tambah Transaksi</button>
    </a>
    <a href="tambah_detail.php">
        <button>Tambah Transaksi Detail</button>
    </a>

</body>
</html>