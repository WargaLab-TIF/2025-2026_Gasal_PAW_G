<?php
require 'db.php';

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$q = $db->prepare("
    SELECT DATE(tanggal) tgl, COUNT(*) jml, SUM(total_harga) total
    FROM transaksi
    WHERE DATE(tanggal) BETWEEN ? AND ?
    GROUP BY DATE(tanggal)
");
$q->execute([$tgl1,$tgl2]);
$data = $q->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

echo "<table border='1'>
<tr><th>Tanggal</th><th>Jumlah</th><th>Pendapatan</th></tr>";

foreach ($data as $d) {
    echo "<tr>
          <td>{$d['tgl']}</td>
          <td>{$d['jml']}</td>
          <td>{$d['total']}</td>
          </tr>";
}

echo "</table>";
