<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengelolaan Master Detail Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">Pengelolaan Master Detail Data</h2>

    <h4>Data Barang</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $barang = mysqli_query($koneksi, "SELECT * FROM barang");
        if (mysqli_num_rows($barang) > 0) {
            while($b = mysqli_fetch_assoc($barang)) {
        ?>
        <tr>
            <td><?= $b['kode_barang']; ?></td>
            <td><?= $b['nama']; ?></td>
            <td><?= number_format($b['harga']); ?></td>
            <td><?= $b['stok']; ?></td>
            <td class="text-center">
                <a href="hapus_barang.php?id=<?= $b['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada data barang</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
        <h4 class="mb-0">Data Transaksi</h4>
        <a href="tambah_transaksi.php" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-secondary text-center">
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Pelanggan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $transaksi = mysqli_query($koneksi, "SELECT transaksi.*, pelanggan.nama AS pelanggan
                                            FROM transaksi 
                                            JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id");
        if (mysqli_num_rows($transaksi) > 0) {
            while ($t = mysqli_fetch_assoc($transaksi)) {
        ?>
        <tr>
            <td><?= $t['id']; ?></td>
            <td><?= $t['waktu_transaksi']; ?></td>
            <td><?= $t['keterangan']; ?></td>
            <td><?= $t['pelanggan']; ?></td>
            <td><?= number_format($t['total']); ?></td>
        </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5' class='text-center text-muted'>Belum ada transaksi</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-2">
        <h4 class="mb-0">Data Detail Transaksi</h4>
        <a href="tambah_detail.php" class="btn btn-success">+ Tambah Detail Transaksi</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-success text-center">
            <tr>
                <th>ID Transaksi</th>
                <th>Barang</th>
                <th>Qty</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.nama AS barang 
                                          FROM transaksi_detail 
                                          JOIN barang ON transaksi_detail.barang_id = barang.id");
        if (mysqli_num_rows($detail) > 0) {
            while($d = mysqli_fetch_assoc($detail)) {
        ?>
        <tr>
            <td><?= $d['transaksi_id']; ?></td>
            <td><?= $d['barang']; ?></td>
            <td><?= $d['qty']; ?></td>
            <td><?= number_format($d['harga']); ?></td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='4' class='text-center text-muted'>Belum ada detail transaksi</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
