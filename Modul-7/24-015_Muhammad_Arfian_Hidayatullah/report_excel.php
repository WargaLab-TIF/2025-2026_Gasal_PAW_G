<?php
include "koneksi.php";

$tgl_dari = $_GET['tgl_dari'];
$tgl_sampai = $_GET['tgl_sampai'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

echo "<h2>Laporan Penjualan</h2>";
echo "<p>Periode: <b>$tgl_dari</b> sampai <b>$tgl_sampai</b></p>";

echo "
<table border='1' cellspacing='0' cellpadding='5'>
    <thead>
        <tr style='background:#ddd;'>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Pendapatan</th>
        </tr>
    </thead>
    <tbody>
";

$no = 1;
$rekap = mysqli_query($koneksi, "
    SELECT transaksi.waktu_transaksi, SUM(transaksi_detail.harga) AS total
    FROM transaksi
    JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    WHERE transaksi.waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
    GROUP BY transaksi.waktu_transaksi
    ORDER BY transaksi.waktu_transaksi ASC
");

while ($r = mysqli_fetch_assoc($rekap)) {
    echo "
    <tr>
        <td>$no</td>
        <td>{$r['waktu_transaksi']}</td>
        <td>Rp " . number_format($r['total']) . "</td>
    </tr>";
    $no++;
}

$total_pelanggan = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(DISTINCT pelanggan_id) AS total
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
    ")
)['total'];

$total_pendapatan = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT SUM(harga) AS total
        FROM transaksi_detail
        JOIN transaksi ON transaksi_detail.transaksi_id = transaksi.id
        WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
    ")
)['total'];

echo "
    </tbody>
</table>
<br><br>

<table border='1' cellspacing='0' cellpadding='5'>
    <tr style='background:#ddd;'>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td>{$total_pelanggan} Orang</td>
        <td>Rp " . number_format($total_pendapatan) . "</td>
    </tr>
</table>
";
?>
