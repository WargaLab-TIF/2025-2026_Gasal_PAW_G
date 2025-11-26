<?php
session_start();
include 'koneksi.php';
if(!isset($_SESSION['login'])){ header('Location: login.php'); exit; }
if (!isset($_POST['tanggal_mulai']) || !isset($_POST['tanggal_akhir'])) { header('Location: report_transaksi.php'); exit; }
$tanggal_mulai = $_POST['tanggal_mulai']; $tanggal_akhir = $_POST['tanggal_akhir'];

$sql = "SELECT DATE(waktu_transaksi) AS tanggal, SUM(total) AS total_penerimaan FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ? GROUP BY DATE(waktu_transaksi) ORDER BY tanggal ASC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $tanggal_mulai, $tanggal_akhir);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$laporan = mysqli_fetch_all($res, MYSQLI_ASSOC);

$sql2 = "SELECT COUNT(*) AS total FROM (SELECT DATE(waktu_transaksi) FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ? GROUP BY DATE(waktu_transaksi)) AS x";
$st2 = mysqli_prepare($conn, $sql2); mysqli_stmt_bind_param($st2, 'ss', $tanggal_mulai, $tanggal_akhir); mysqli_stmt_execute($st2); $total_pelanggan = mysqli_stmt_get_result($st2)->fetch_assoc()['total'] ?? 0;

$sql3 = "SELECT SUM(total) AS total FROM transaksi WHERE DATE(waktu_transaksi) BETWEEN ? AND ?";
$st3 = mysqli_prepare($conn, $sql3); mysqli_stmt_bind_param($st3, 'ss', $tanggal_mulai, $tanggal_akhir); mysqli_stmt_execute($st3); $total_pendapatan = mysqli_stmt_get_result($st3)->fetch_assoc()['total'] ?? 0;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Hasil Laporan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2>Rekap Laporan Penjualan <?= date('d-m-Y', strtotime($tanggal_mulai)) ?> s/d
        <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></h2>
    <a href="report_transaksi.php">Kembali</a> | <a onclick="window.print()">Cetak PDF</a> | <a
        href="export_excel.php?tanggal_mulai=<?= $tanggal_mulai ?>&tanggal_akhir=<?= $tanggal_akhir ?>">Export Excel</a>

    <?php if(count($laporan)>0){ ?>
    <h3>Grafik Penjualan</h3>
    <canvas id="grafik"></canvas>

    <h3>Rekap Penjualan</h3>
    <table border='1'>
        <tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
        <?php $no=1; foreach($laporan as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>Rp <?= number_format($row['total_penerimaan'],0,',','.') ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total Ringkasan</h3>
    <table border='1'>
        <tr>
            <th>Total Pelanggan</th>
            <th>Total Pendapatan</th>
        </tr>
        <tr>
            <td><?= $total_pelanggan ?></td>
            <td>Rp <?= number_format($total_pendapatan,0,',','.') ?></td>
        </tr>
    </table>
    <?php } else { echo "<p style='color:red'>Tidak ada data pada periode tersebut.</p>"; } ?>

    <script>
    let labels = <?= json_encode(array_column($laporan, 'tanggal')) ?>;
    let dataVals = <?= json_encode(array_column($laporan, 'total_penerimaan')) ?>;
    if (labels.length > 0) {
        new Chart(document.getElementById('grafik'), {
            type: 'bar',
            data: {
                labels: labels.map(t => new Date(t).toLocaleDateString('id-ID')),
                datasets: [{
                    label: 'Total Penerimaan (Rp)',
                    data: dataVals
                }]
            }
        });
    }
    </script>
</body>

</html>