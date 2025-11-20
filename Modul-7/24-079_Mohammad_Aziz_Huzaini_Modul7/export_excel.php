<?php
include 'koneksi.php';

$tanggal_mulai = $_GET['tanggal_mulai'];
$tanggal_akhir = $_GET['tanggal_akhir'];

$query = "SELECT 
            DATE(waktu_transaksi) AS tanggal,
            SUM(total) AS total_penerimaan,
            COUNT(*) AS jml_pelanggan_harian
          FROM transaksi
          WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
          GROUP BY DATE(waktu_transaksi)
          ORDER BY tanggal ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $tanggal_mulai, $tanggal_akhir);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

$query2 = "SELECT SUM(total) AS total_pendapatan 
           FROM transaksi 
           WHERE DATE(waktu_transaksi) BETWEEN ? AND ?";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("ss", $tanggal_mulai, $tanggal_akhir);
$stmt2->execute();
$res2 = $stmt2->get_result();
$total_pendapatan = $res2->fetch_assoc()['total_pendapatan'] ?? 0;

$total_pelanggan = array_sum(array_column($data, 'jml_pelanggan_harian'));

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan_{$tanggal_mulai}_{$tanggal_akhir}.xls");
header("Cache-Control: max-age=0");

?>

<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            border-collapse: collapse;
            width: 40%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            font-weight: bold;
            text-align: center;
            background: #f3f3f3;
        }
        .judul {
            font-size: 16px;
            font-weight: bold;
        }
        .no-border td {
            border: none !important;
        }
    </style>
</head>
<body>

<table class="no-border">
    <tr>
        <td class="judul">
            Rekap Laporan Penjualan <?= $tanggal_mulai ?> sampai <?= $tanggal_akhir ?>
        </td>
    </tr>
</table>

<br>

<table>
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    foreach ($data as $d) { ?>
        <tr>
            <td style="text-align:center;"><?= $no++; ?></td>
            <td>Rp<?= number_format($d['total_penerimaan'], 0, ',', '.'); ?></td>
            <td><?= date('d-M-y', strtotime($d['tanggal'])); ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<table>
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total_pelanggan ?> Orang</td>
        <td>Rp<?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
    </tr>
</table>

</body>
</html>
