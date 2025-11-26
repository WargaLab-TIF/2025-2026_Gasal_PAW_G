<?php
include 'koneksi.php';
if(!isset($_GET['tanggal_mulai']) || !isset($_GET['tanggal_akhir'])){ header('Location: report_transaksi.php'); exit; }
$tanggal_mulai = $_GET['tanggal_mulai']; $tanggal_akhir = $_GET['tanggal_akhir'];
$query = "SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_penerimaan FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ? GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC";
$st = mysqli_prepare($conn, $query); mysqli_stmt_bind_param($st, 'ss', $tanggal_mulai, $tanggal_akhir); mysqli_stmt_execute($st); $res = mysqli_stmt_get_result($st); $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
$query2 = "SELECT SUM(total) AS total_pendapatan FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ?"; $st2 = mysqli_prepare($conn,$query2); mysqli_stmt_bind_param($st2,'ss',$tanggal_mulai,$tanggal_akhir); mysqli_stmt_execute($st2); $total_pendapatan = mysqli_stmt_get_result($st2)->fetch_assoc()['total_pendapatan'] ?? 0;

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan_{$tanggal_mulai}_{$tanggal_akhir}.xls");
?>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <h3>Rekap Laporan <?= $tanggal_mulai ?> s/d <?= $tanggal_akhir ?></h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php $no=1; foreach($data as $d){ echo "<tr><td>".($no++)."</td><td>".date('d-M-Y', strtotime($d['tanggal']))."</td><td>Rp ".number_format($d['total_penerimaan'],0,',','.')."</td></tr>"; } ?>
    </table>
    <br>
    <table border='1'>
        <tr>
            <th>Jumlah Pendapatan</th>
        </tr>
        <tr>
            <td>Rp <?= number_format($total_pendapatan,0,',','.') ?></td>
        </tr>
    </table>
</body>

</html>