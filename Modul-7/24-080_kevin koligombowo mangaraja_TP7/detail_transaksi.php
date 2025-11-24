<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID tidak valid!');
            window.location.href='data_transaksi.php';
          </script>";
    exit;
}

$id = intval($_GET['id']);
$q = $conn->query("
    SELECT id, tanggal, nama_pelanggan, keterangan, total
    FROM transaksi1
    WHERE id = $id
");

if ($q->num_rows == 0) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href='data_transaksi.php';
          </script>";
    exit;
}

$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detail Transaksi</title>
<style>
    body { font-family: Arial; background: #f0f2f5; }
    .container {
        width: 60%; margin: 30px auto;
        background: white; padding: 20px;
        border-radius: 8px; border:1px solid #ccc;
    }
    h2 {
        background: #1e88e5; color: white;
        padding: 12px; border-radius: 6px;
        margin-top: 0;
    }
    table {
        width: 100%; border-collapse: collapse;
        margin-top: 15px;
    }
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }
    .label { font-weight: bold; width: 30%; }
    .btn {
        display: inline-block;
        padding: 10px 15px;
        margin-top: 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
    }
</style>
</head>
<body>

<div class="container">

    <h2>Detail Transaksi</h2>

    <table>
        <tr>
            <td class="label">ID Transaksi</td>
            <td><?= $data['id'] ?></td>
        </tr>
        <tr>
            <td class="label">Waktu Transaksi</td>
            <td><?= $data['tanggal'] ?></td>
        </tr>
        <tr>
            <td class="label">Nama Pelanggan</td>
            <td><?= $data['nama_pelanggan'] ?></td>
        </tr>
        <tr>
            <td class="label">Keterangan</td>
            <td><?= $data['keterangan'] ?></td>
        </tr>
        <tr>
            <td class="label">Total Pembayaran</td>
            <td>Rp<?= number_format($data['total'],0,',','.') ?></td>
        </tr>
    </table>

    <a href="data_transaksi.php" class="btn">Kembali</a>

</div>

</body>
</html>
