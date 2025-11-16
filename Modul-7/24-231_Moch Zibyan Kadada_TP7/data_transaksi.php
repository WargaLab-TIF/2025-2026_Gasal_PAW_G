<?php
require_once "koneksi.php";

$transaksi = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #f2f2f2;
        }
        .box-title {
            background: #054a91;
            color: white;
            padding: 14px 18px;
            border-radius: 6px 6px 0 0;
            font-size: 20px;
            font-weight: 600;
        }
        .btn-add {
            background: #218838;
            color: #fff;
        }
        .btn-report {
            background: #0b5ed7;
            color: #fff;
        }
        th {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <div class="box-title">Daftar Transaksi</div>
    <div class="my-3">
        <a href="report_transaksi.php" class="btn btn-report">Rekap Penjualan</a>
        <a href="tambah_data.php" class="btn btn-add">Input Transaksi</a>
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Catatan</th>
                <th>Nominal (Rp)</th>
                <th>Menu</th>
            </tr>
        </thead>

        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_transaksi']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['keterangan']; ?></td>

                    <td>
                        <?= "Rp " . number_format($row['total'], 0, ',', '.'); ?>
                    </td>

                    <td>
                        <a href="detail_transaksi.php?id=<?= $row['id_transaksi']; ?>" 
                           class="btn btn-info btn-sm">
                           Lihat
                        </a>

                        <a href="hapus_data.php?id=<?= $row['id_transaksi']; ?>"
                           onclick="return confirm('Hapus transaksi ini?')"
                           class="btn btn-danger btn-sm">
                           Hapus
                        </a>
                    </td>
                </tr>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
