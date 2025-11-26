<?php
include 'koneksi.php';
if(!isset($_GET['tanggal_mulai']) || !isset($_GET['tanggal_akhir'])){ header('Location: report_transaksi.php'); exit; }
$tanggal_mulai = $_GET['tanggal_mulai']; $tanggal_akhir = $_GET['tanggal_akhir'];
$q = mysqli_prepare($conn, "SELECT DATE(waktu_transaksi) as tanggal, SUM(total) as total_penerimaan FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ? GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC");
mysqli_stmt_bind_param($q,'ss',$tanggal_mulai,$tanggal_akhir); mysqli_stmt_execute($q); $res = mysqli_stmt_get_result($q); $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Export PDF</title>
</head>

<body>
    <h2>Rekap Laporan <?= $tanggal_mulai ?> s/d <?= $tanggal_akhir ?></h2>
    <table border='1'>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
        <?php $no=1; foreach($data as $d){ echo "<tr><td>{$no}</td><td>".date('d-m-Y', strtotime($d['tanggal']))."</td><td>Rp ".number_format($d['total_penerimaan'],0,',','.')."</td></tr>"; $no++; } ?>
    </table>
    <script>
    window.print()
    </script>
</body>

</html>