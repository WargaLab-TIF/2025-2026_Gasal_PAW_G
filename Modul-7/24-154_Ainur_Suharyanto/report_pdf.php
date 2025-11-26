<?php
include "koneksi.php";

$awal  = $_GET['start'];
$akhir = $_GET['end'];

$sql = "
    SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total, COUNT(id) AS jml_pelanggan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY DATE(waktu_transaksi)
";

$result = $mysqli->query($sql);

$tanggal = [];
$total = [];
$pelanggan = [];

$totalPendapatan = 0;
$totalPelanggan = 0;

while ($row = $result->fetch_assoc()) {
    $tanggal[]   = $row['tanggal'];
    $total[]     = $row['total'];
    $pelanggan[] = $row['jml_pelanggan'];

    $totalPendapatan += $row['total'];
    $totalPelanggan  += $row['jml_pelanggan'];
}
?>
<html>
<head>
<title>Cetak Laporan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body { font-family: Arial; }
    table { margin-top: 10px; }
    canvas { margin-bottom: 20px; }
    h2, h3 { margin-bottom: 10px; }

    .all {
        width: 800px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

</style>

</head>

<body onload="window.print()">
<div class="all">
<h2>Rekap Laporan Penjualan <?= $awal ?> sampai <?= $akhir ?></h2>

<canvas id="grafik" height="120"></canvas>

<script>
    const ctx = document.getElementById('grafik').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($tanggal) ?>,
            datasets: [{
                label: 'Total Pendapatan',
                data: <?= json_encode($total) ?>,
                backgroundColor: [
                    "rgba(53, 61, 61, 0.21)"
                ],
                borderColor: [
                    "rgba(35, 36, 36, 1)"
                ],
                borderWidth: 1

            }]
        },
        options: {
            responsive: true,
            animation: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<table border="1" cellpadding="10" cellspacing="0">
    <tr >
        <th style="width:200px; text-align:left;">No</th>
        <th style="width:500px; text-align:left;">Total</th>
        <th style="width:500px; text-align:left;">Tanggal</th>
    </tr>

    <?php 
    $no = 1;
    for ($i = 0; $i < count($tanggal); $i++) { ?>
    <tr>
        <td style="text-align:left;"><?= $no++ ?></td>
        <td style="text-align:left;">Rp&nbsp;<?= number_format($total[$i], 0, ',', '.') ?></td>
        <td style="text-align:left;"><?= date('d M Y', strtotime($tanggal[$i])) ?></td>


    </tr>
    <?php } ?>
</table>

<br>

<table border="1" cellpadding="20" cellspacing="0" style="width: 500px;">
    <tr >
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?> Orang</td>
        <td>Rp&nbsp;<?= number_format($totalPendapatan, 0, ',', '.') ?></td>
    </tr>
</table>
</div>
</body>
</html>
