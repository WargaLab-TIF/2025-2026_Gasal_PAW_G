<?php

include "koneksi.php";

require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;

$tgl_mulai   = $_GET['tgl_mulai'];
$tgl_selesai = $_GET['tgl_selesai'];

$dataRekap = mysqli_query($koneksi, "
    SELECT tanggal, 
           SUM(total) AS total_harian,
           COUNT(*) AS jumlah_transaksi
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
    GROUP BY tanggal
    ORDER BY tanggal ASC
");

$totalKeseluruhan = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT customer_id) AS total_pelanggan,
           SUM(total) AS total_pendapatan
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
");
$hasilTotal = mysqli_fetch_assoc($totalKeseluruhan);

$html = "
<h2 style='text-align:center; margin-bottom:10px;'>Laporan Penjualan</h2>
<p>Periode: <b>$tgl_mulai</b> sampai <b>$tgl_selesai</b></p>

<h4 style='margin-top:20px;'>Rekap Data Penjualan</h4>

<table border='1' width='100%' cellspacing='0' cellpadding='6'>
    <tr style='background:#f0f0f0; font-weight:bold;'>
        <td>Tanggal</td>
        <td>Total Pendapatan</td>
        <td>Jumlah Transaksi</td>
    </tr>
";

while ($row = mysqli_fetch_assoc($dataRekap)) {
    $html .= "
    <tr>
        <td>{$row['tanggal']}</td>
        <td>Rp " . number_format(($row['total_harian'] ?? 0), 0, ',', '.') . "</td>
        <td>{$row['jumlah_transaksi']}</td>
    </tr>
    ";
}

$html .= "
</table>

<br><br>

<h4>Total Keseluruhan</h4>
<table border='1' width='50%' cellspacing='0' cellpadding='6'>
    <tr>
        <td><b>Total Pelanggan</b></td>
        <td>{$hasilTotal['total_pelanggan']}</td>
    </tr>
    <tr>
        <td><b>Total Pendapatan</b></td>
        <td>Rp " . number_format(($hasilTotal['total_pendapatan'] ?? 0), 0, ',', '.') . "</td>


    </tr>
</table>
";


$dompdf = new Dompdf();
$dompdf->loadHtml($html);

$dompdf->setPaper("A4", "portrait");

$dompdf->render();

$dompdf->stream("laporan_penjualan.pdf", ["Attachment" => true]);