<?php
include "koneksi.php";

$tgl_mulai = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];

$query = mysqli_query($koneksi, "
    SELECT tanggal, SUM(total) AS total_harian, COUNT(*) AS jumlah_transaksi
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
    GROUP BY tanggal
    ORDER BY tanggal ASC
");

$q_total = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT customer_id) AS pelanggan,
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
");
$total = mysqli_fetch_assoc($q_total);

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
?>

<h3>Laporan Penjualan</h3>
<p>Periode: <?= $tgl_mulai ?> s/d <?= $tgl_selesai ?></p>

<table border="1">
    <tr>
        <th>Tanggal</th>
        <th>Total Pendapatan</th>
        <th>Jumlah Transaksi</th>
    </tr>

    <?php while ($r = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $r['tanggal'] ?></td>
        <td><?= $r['total_harian'] ?></td>
        <td><?= $r['jumlah_transaksi'] ?></td>
    </tr>
    <?php } ?>
</table>

<br>

<table border="1">
    <tr><th>Total Pelanggan</th><td><?= $total['pelanggan'] ?></td></tr>
    <tr><th>Total Pendapatan</th><td><?= $total['pendapatan'] ?></td></tr>
</table>