<?php

function tanggal_indo_singkat($tanggal) {
    $bulan = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];
    $split = explode('-', $tanggal); 
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan.xls");
require_once __DIR__. "../../../data_base/koneksi.php";
$tanggal_awal = $_GET['awal'];
$tanggal_akhir = $_GET['akhir'];
echo"<b>Rekap Laporan Panjualan $tanggal_awal sampai $tanggal_akhir</b>";
echo"<br>";
echo"<br>";
echo "
<table border='1'>
    <tr>
        <th>No</th>
        <th>Waktu Transaksi</th>
        <th>Total</th>
    </tr>
";

// ambil data sesuai filter

$select_data = "SELECT waktu_transaksi, FORMAT(sum(total),0,'id_ID') AS total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY DATE(waktu_transaksi) ORDER BY waktu_transaksi ASC";
$q = $conn->query($select_data);

$no = 1;
while($row = $q->fetch_assoc()){
    $tanggal = tanggal_indo_singkat($row['waktu_transaksi']);
    echo "
    <tr>
        <td>$no</td>
        <td>{$tanggal}</td>
        <td>{$row['total']}</td>
    </tr>";
    $no++;
}
echo "</table>";
echo "<br>";
echo "<br>";
echo "
<table border='1'>
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
";
$select_total = "SELECT FORMAT(sum(total),0,'id_ID') AS total,COUNT(DISTINCT pelanggan_id) AS total_pelanggan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
    
    $find_total = $conn->query($select_total);
    $ls_total = [];
    while($row = $find_total->fetch_assoc()){
        echo "<tr>
            <td>{$row['total_pelanggan']}</td>
            <td>{$row['total']}</td>
            </tr>";
    }
echo "</table>";
?>