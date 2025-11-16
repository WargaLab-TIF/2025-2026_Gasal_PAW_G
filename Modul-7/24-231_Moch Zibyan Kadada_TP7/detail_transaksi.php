<?php
require_once "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit;
}

$kode = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$kode'");
$info = mysqli_fetch_assoc($query);

if (!$info) {
    echo "<script>alert('Transaksi tidak ditemukan'); window.location='data_transaksi.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #ededed;
        }
        .header-section {
            background: #085cc9;
            padding: 14px 18px;
            color: #fff;
            font-weight: 600;
            font-size: 20px;
            border-radius: 6px 6px 0 0;
        }
        .box-body {
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 6px 6px;
        }
        .label-field {
            font-weight: 600;
            width: 220px;
        }
    </style>
</head>

<body>

<div class="container mt-4">
    <div class="header-section">Detail Informasi Transaksi</div>
    <div class="box-body">
        <a href="data_transaksi.php" class="btn btn-dark mb-3">← Kembali</a>
        <table class="table table-bordered">
            <tr>
                <td class="label-field">Kode Transaksi</td>
                <td><?= $info['id_transaksi']; ?></td>
            </tr>
            <tr>
                <td class="label-field">Tanggal Transaksi</td>
                <td><?= $info['tanggal']; ?></td>
            </tr>
            <tr>
                <td class="label-field">Pelanggan</td>
                <td><?= $info['nama_pelanggan']; ?></td>
            </tr>
            <tr>
                <td class="label-field">Catatan</td>
                <td><?= $info['keterangan']; ?></td>
            </tr>
            <tr>
                <td class="label-field">Nominal Pembayaran</td>
                <td>Rp <?= number_format($info['total'], 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
