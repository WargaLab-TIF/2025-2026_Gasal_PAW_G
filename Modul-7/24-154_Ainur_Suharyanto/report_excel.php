<?php
include "koneksi.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

$awal  = isset($_GET['start']) ? $_GET['start'] : '';
$akhir = isset($_GET['end']) ? $_GET['end'] : '';

if (!empty($awal) && !empty($akhir)) {
    $sql = "
        SELECT DATE(waktu_transaksi) AS tanggal,
               SUM(total) AS total,
               COUNT(id) AS jml_pelanggan
        FROM transaksi
        WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
        GROUP BY DATE(waktu_transaksi)
        ORDER BY DATE(waktu_transaksi)
    ";
} else {
    $sql = "
        SELECT DATE(waktu_transaksi) AS tanggal,
               SUM(total) AS total,
               COUNT(id) AS jml_pelanggan
        FROM transaksi
        GROUP BY DATE(waktu_transaksi)
        ORDER BY DATE(waktu_transaksi)
    ";
}

$result = $mysqli->query($sql);

$data = [];
$pendapatan = 0;
$pelanggan = 0;

while ($r = $result->fetch_assoc()) {
    $data[] = $r;
    $pendapatan += $r['total'];
    $pelanggan += $r['jml_pelanggan'];
}
?>

<h3>Rekap Laporan Penjualan <?= $awal ?> sampai <?= $akhir ?></h3>

<table border="1">
    <tr>
        <th style="width:150px; text-align:center;">No</th>
        <th style="width:150px; text-align:center;">Total</th>
        <th style="width:150px; text-align:center;">Tanggal</th>
    </tr>

<?php $no = 1; foreach ($data as $d) { ?>
    <tr>
        <td style="text-align:right;"><?= $no++ ?></td>
        <td style="text-align:right;">Rp<?= number_format($d['total']) ?></td>
        <td style="text-align:right;"><?= date('d-M-Y', strtotime($d['tanggal'])) ?></td>
    </tr>
<?php } ?>

</table>

<br>

<table border="1">
    <tr>
        <th style="width:150px; text-align:center;">Jumlah Pelanggan</th>
        <th style="width:150px; text-align:center;">Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td style="text-align:right;"><?= $pelanggan ?> Orang</td>
        <td style="text-align:right;">Rp<?= number_format($pendapatan) ?></td>
    </tr>
</table>
