<?php
require 'koneksi.php';

$start = $_GET['mulai'];
$end   = $_GET['selesai'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"rekap_penjualan.xls\"");

$sql = "SELECT * FROM transaksi 
        WHERE tanggal BETWEEN '$start' AND '$end'
        ORDER BY tanggal ASC";

$result = mysqli_query($conn, $sql);

$totalOmset = 0;
$totalTransaksi = 0;

echo "<h3>Laporan Penjualan Periode $start sampai $end</h3>";

echo "
<table border='1' cellspacing='0' cellpadding='6'>
    <tr style='background:#dcdcdc; font-weight:bold;'>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Catatan</th>
        <th>Jumlah (Rp)</th>
    </tr>
";

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$row['tanggal']}</td>
        <td>{$row['nama_pelanggan']}</td>
        <td>{$row['keterangan']}</td>
        <td>{$row['total']}</td>
    </tr>
    ";

    $totalTransaksi++;
    $totalOmset += $row['total'];
}

echo "</table><br><br>";

echo "
<table border='1' cellpadding='6'>
    <tr style='background:#dcdcdc; font-weight:bold;'>
        <th>Jumlah Transaksi</th>
        <th>Total Pendapatan (Rp)</th>
    </tr>
    <tr>
        <td>$totalTransaksi</td>
        <td>$totalOmset</td>
    </tr>
</table>";
?>