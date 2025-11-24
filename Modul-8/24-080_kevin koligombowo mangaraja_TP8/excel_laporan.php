<?php
include 'koneksi.php';

$tgl_awal  = $_GET['tgl_awal'] ?? date('Y-m-01');
$tgl_akhir = $_GET['tgl_akhir'] ?? date('Y-m-d');

// Query data
$sql = "
    SELECT 
        DATE(tanggal) AS tgl,
        SUM(total) AS total_harian,
        COUNT(DISTINCT pelanggan_id) AS jml_pelanggan
    FROM transaksi1
    WHERE DATE(tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'
    GROUP BY DATE(tanggal)
    ORDER BY tanggal ASC
";
$q = mysqli_query($conn, $sql);

// Filename
$filename = "laporan_penjualan_{$tgl_awal}_sd_{$tgl_akhir}.xls";

// Header agar otomatis download Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

echo "<h3>LAPORAN PENJUALAN</h3>";
echo "<p>Periode: <b>$tgl_awal</b> sampai <b>$tgl_akhir</b></p>";

// Tabel Excel
echo "
<table border='1'>
    <tr>
        <th>Tanggal</th>
        <th>Total Penjualan</th>
        <th>Jumlah Pelanggan</th>
    </tr>
";

$total_pelanggan = 0;
$total_pendapatan = 0;

while ($d = mysqli_fetch_assoc($q)) {
    echo "
    <tr>
        <td>{$d['tgl']}</td>
        <td>{$d['total_harian']}</td>
        <td>{$d['jml_pelanggan']}</td>
    </tr>
    ";
    $total_pelanggan += $d['jml_pelanggan'];
    $total_pendapatan += $d['total_harian'];
}

// Baris total
echo "
<tr>
    <th>Total</th>
    <th>Rp ".number_format($total_pendapatan)."</th>
    <th>$total_pelanggan</th>
</tr>
";

echo "</table>";
?>
