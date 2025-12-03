<?php
include "koneksi.php";

$sql = $mysqli->query("
    SELECT 
        t.id AS id_transaksi,
        t.waktu_transaksi,
        p.nama AS nama_pelanggan,
        t.keterangan,
        t.total
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    ORDER BY t.id ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Master Transaksi</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 1500px;
        max-width: 1100px;
        background: white;
        margin: 20px auto;
        padding: 20px;
        border-radius: 5px;
    }

    h3 {
        margin: 0 0 10px 0;
    }

    .btn {
        padding: 8px 14px;
        font-size: 14px;
        text-decoration: none;
        border-radius: 4px;
        color: white;
        margin-right: 5px;
    }

    .btn-primary { background: #007bff; 
                   margin-left: 750px;}
    .btn-success { background: #28a745; }
    .btn-info    { background: #17a2b8; }
    .btn-danger  { background: #dc3545; }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    thead {
        background: #0d6efd;
        color: white;
    }
    .dmt{
        background-color: #546cd7ff;
        padding: 10px;
        border-bottom: 1px solid black;
        margin-bottom: 20px;
    }
</style>

</head>
<body>

<div class="container">
    <div class="dmt">
    <h3 style="color: white;">Data Master Transaksi</h3>
    </div>

    <a href="report_transaksi.php" class="btn btn-primary">Lihat Laporan Penjualan</a>
    <a href="#" class="btn btn-success">Tambah Transaksi</a>

    <table border="1" cellpadding="10" cellspacing="20">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
        <?php 
        $no = 1;
        while ($d = $sql->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['waktu_transaksi'] ?></td>
                <td><?= $d['nama_pelanggan'] ?></td>
                <td><?= $d['keterangan'] ?></td>
                <td>Rp<?= number_format($d['total'],0,',','.') ?></td>
                <td>
                    <a href="#?id=<?= $d['id_transaksi'] ?>" class="btn btn-info">Lihat Detail</a>
                    <a href="hapus_transaksi.php?id=<?= $d['id_transaksi'] ?>" 
                       onclick="return confirm('Hapus transaksi ini?')" 
                       class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>

</body>
</html>
