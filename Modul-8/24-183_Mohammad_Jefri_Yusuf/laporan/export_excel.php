<?php
session_start();
require_once '../config/conn.php';
require_once '../helper/functions.php';
require_once 'functions.php';
cekLogin();

if(!isset($_GET['since']) || !isset($_GET['until'])){
   header("Location: index.php");
   exit;
}

$since = htmlspecialchars($_GET['since']);
$until = htmlspecialchars($_GET['until']);

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

$total = getData($conn, $sql_total)[0];

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
        <td>Rp<?= number_format($r['total_harian']) ?></td>
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
        <td>Rp<?= number_format($total['total_pendapatan']) ?></td>
    </tr>
</table>
