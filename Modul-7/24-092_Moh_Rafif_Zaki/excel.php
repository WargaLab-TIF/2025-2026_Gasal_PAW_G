<?php
$tanggal_aw = $_GET['aw'];
$tanggal_ak = $_GET['ak'];
$conn = mysqli_connect("localhost", "root", "", "penjualan");
$query = "SELECT t.waktu_transaksi,SUM(t.total) AS total,t.pelanggan_id FROM transaksi AS t WHERE t.waktu_transaksi BETWEEN '$tanggal_aw' AND '$tanggal_ak' GROUP BY t.waktu_transaksi ORDER BY t.waktu_transaksi ASC";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$waktu = [];
foreach ($data as $d) {
    $w = $d['waktu_transaksi'];
    $waktu[] = $w;
}

$waktu2 = [];
foreach ($waktu as $wk) {
    $tanggal = date("d M Y", strtotime($wk));
    $waktu2[] = $tanggal;
}

$total = [];
foreach ($data as $d) {
    $t = $d['total'];
    $total[] = $t;
}

$query = "SELECT t.pelanggan_id FROM transaksi AS t WHERE t.waktu_transaksi BETWEEN '$tanggal_aw' AND '$tanggal_ak' GROUP BY t.pelanggan_id";
$result = mysqli_query($conn, $query);
$id_pelanggan = mysqli_fetch_all($result, MYSQLI_ASSOC);
$pelanggan = [];
foreach ($id_pelanggan as $id) {
    $p = $id['pelanggan_id'];
    $pelanggan[] = $p;
}
$jumlah_total = 0;
foreach ($total as $t) {
    $jumlah_total = $jumlah_total + $t;
}
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=laporan.xls");

echo "<h5>Rekap Laporan Penjualan $tanggal_aw sampai $tanggal_ak</h5>";
echo "<table border='1'>";
echo "<tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>";
for ($rows = 0; $rows < count($waktu); $rows++) {
    echo "<tr>";
    echo "<td>" . ($rows + 1) . "</td>";
    echo "<td>" . $total[$rows] . "</td>";
    echo "<td>" . $waktu2[$rows] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br>";
echo"<table border='1'>";
    echo"<tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>";
    echo "<tr>";
        echo"<td>".count($pelanggan)." orang </td>";
        echo"<td>".$jumlah_total."</td>";
    echo"</tr>";
echo"</table>";
exit;
?>