<?php
ob_end_clean();
ob_start();

$conn = mysqli_connect("localhost","root","","penjualan");

$awal  = isset($_GET['awal']) ? $_GET['awal'] : '';
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : '';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!-- JUDUL LAPORAN -->
<h3>Rekap Laporan Penjualan <?= $awal ?> sampai <?= $akhir ?></h3>
<br>

<?php
// DATA REKAP
$q = mysqli_query($conn,
"SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
 FROM transaksi
 WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
 GROUP BY DATE(waktu_transaksi)
 ORDER BY tgl ASC");
?>

<table border="1">
<tr>
    <th>No</th>
    <th>Total</th>
    <th>Tanggal</th>
</tr>

<?php
$no = 1;
while($r = mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['total'] ?></td>
    <td><?= $r['tgl'] ?></td>
</tr>
<?php } ?>
</table>

<?php
// TOTAL
$qTotal = mysqli_query($conn,
"SELECT COUNT(*) AS pelanggan, SUM(total) AS pendapatan
 FROM transaksi
 WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'");
$total = mysqli_fetch_assoc($qTotal);
?>

<br><br>

<table border="1">
<tr>
    <th>Jumlah Pelanggan</th>
    <th>Jumlah Pendapatan</th>
</tr>
<tr>
    <td><?= $total['pelanggan'] ?> Orang</td>
    <td>Rp<?= number_format($total['pendapatan'],0,",",".") ?></td>
</tr>
</table>

<?php
ob_end_flush();
?>
