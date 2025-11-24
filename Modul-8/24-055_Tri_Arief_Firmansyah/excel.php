<?php
include "koneksi.php";
$mulai = $_GET['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? '';
if (!$mulai || !$selesai) { die("Periode tidak valid"); }

header("Content-Disposition: attachment; filename=\"rekap_penjualan_{$mulai}_{$selesai}.xls\"");
header("Content-Type: application/vnd.ms-excel");

$q = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan_nama
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    WHERE t.waktu_transaksi BETWEEN '$mulai' AND '$selesai'
    ORDER BY t.waktu_transaksi ASC
");

$totalPendapatan = 0; $jumlahTransaksi = 0;

echo "<h3>Rekap Penjualan Periode $mulai s.d $selesai</h3>";
echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr style='background:#eaeaea; font-weight:bold;'><th>Tanggal</th><th>Nama Pelanggan</th><th>Keterangan</th><th>Total (Rp)</th></tr>";

while($d = mysqli_fetch_assoc($q)) {
    echo "<tr>
        <td>{$d['waktu_transaksi']}</td>
        <td>".htmlspecialchars($d['pelanggan_nama'])."</td>
        <td>".htmlspecialchars($d['keterangan'])."</td>
        <td>{$d['total']}</td>
    </tr>";
    $jumlahTransaksi++;
    $totalPendapatan += $d['total'];
}

echo "</table><br><br>";
echo "<table border='1' cellpadding='8'><tr style='background:#eaeaea; font-weight:bold;'><th>Jumlah Transaksi</th><th>Total Pendapatan (Rp)</th></tr>";
echo "<tr><td>$jumlahTransaksi</td><td>$totalPendapatan</td></tr></table>";
