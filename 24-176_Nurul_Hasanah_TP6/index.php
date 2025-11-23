<?php
include "koneksi.php";
$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$detail = mysqli_query($koneksi, "SELECT * FROM transaksi_detail");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <h2 class="text-center mb-4">Pengelolaan Master Detail Penjualan</h2>

    <div class="mb-3 text-center">
        <a href="tambah_transaksi.php" class="btn btn-primary">Tambah Transaksi Baru</a>
        <a href="tambah_detail.php" class="btn btn-success">Tambah Detail Transaksi</a>
    </div>

    <h4>Data Barang</h4>
    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Nama Barang</th><th>Harga Satuan</th><th>Aksi</th></tr>
        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
        <tr>
            <td><?= $b['id_barang'] ?></td>
            <td><?= $b['nama_barang'] ?></td>
            <td><?= number_format($b['harga_satuan']) ?></td>
            <td><a href="hapus_barang.php?id=<?= $b['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus barang ini?')">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>

    <h4>Data Transaksi</h4>
    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Tanggal</th><th>Keterangan</th><th>Total</th></tr>
        <?php while ($t = mysqli_fetch_assoc($transaksi)) { ?>
        <tr>
            <td><?= $t['id_transaksi'] ?></td>
            <td><?= $t['waktu_transaksi'] ?></td>
            <td><?= $t['keterangan'] ?></td>
            <td><?= number_format($t['total']) ?></td>
        </tr>
        <?php } ?>
    </table>

    <h4>Data Detail Transaksi</h4>
    <table class="table table-bordered table-striped">
        <tr><th>ID</th><th>Transaksi ID</th><th>Barang ID</th><th>Qty</th><th>Harga</th></tr>
        <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
        <tr>
            <td><?= $d['id_detail'] ?></td>
            <td><?= $d['transaksi_id'] ?></td>
            <td><?= $d['barang_id'] ?></td>
            <td><?= $d['qty'] ?></td>
            <td><?= number_format($d['harga']) ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>