<?php
require "conn.php";
require "functions.php";

$since = $_GET['since'];
$until = $_GET['until'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$sql = "SELECT 
            waktu_transaksi,
            SUM(total) AS total_harian
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$since' AND '$until'
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi";

$recap = getData($conn, $sql);

$sql_total = "SELECT 
                COUNT(id) AS jumlah_pelanggan,
                SUM(total) AS total_pendapatan
              FROM transaksi
              WHERE waktu_transaksi BETWEEN '$since' AND '$until'";

$total = getData($conn, $sql_total);

?>
<p><b>Rekap Laporan Penjualan</b> <?= $since. ' sampai '.$until ?></p>
<table border="1">
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>
    <?php 
    $num = 1;   
    foreach($recap as $r): ?>
    <tr>
        <td><?= $num++ ?></td>
        <td>Rp<?= number_format($r['total_harian'], 0, ',', '.') ?></td>
        <td><?= date("d M Y", strtotime($r['waktu_transaksi'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<table border="1">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total['jumlah_pelanggan'] ?></td>
        <td>Rp<?= number_format($total['total_pendapatan'], 0, ',', '.') ?></td>
    </tr>
</table>
