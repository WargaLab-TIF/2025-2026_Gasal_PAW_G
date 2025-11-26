<?php
$conn = mysqli_connect("localhost","root","","penjualan");

// ambil tanggal (default hari ini)
$awal  = isset($_GET['awal']) ? $_GET['awal'] : date("Y-m-d");
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-3">

    <h4>Rekap Laporan Penjualan</h4>
    <a href="index.php" class="btn btn-secondary btn-sm">Kembali</a>

    <form method="GET" class="form-inline mt-3">
        <input type="date" name="awal" class="form-control mr-2" value="<?= $awal ?>">
        <input type="date" name="akhir" class="form-control mr-2" value="<?= $akhir ?>">
        <button class="btn btn-success">Tampilkan</button>
    </form>

    <hr>
<?php
// Query grafik dan rekap
$q = mysqli_query($conn,
"SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
 FROM transaksi
 WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
 GROUP BY DATE(waktu_transaksi)"
);

$dataTanggal = [];
$dataTotal   = [];

while($row = mysqli_fetch_assoc($q)){
    $dataTanggal[] = $row['tgl'];
    $dataTotal[]   = $row['total'];
}
?>

<!-- GRAFIK -->
<canvas id="grafik" height="90"></canvas>
<script>
var ctx = document.getElementById("grafik").getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($dataTanggal) ?>,
        datasets: [{
            label: 'Total',
            data: <?= json_encode($dataTotal) ?>,
            borderWidth: 1
        }]
    }
});
</script>

<br>

<!-- TABEL REKAP -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th><th>Total</th><th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1; 
        $q2 = mysqli_query($conn,
        "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
        FROM transaksi
        WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
        GROUP BY DATE(waktu_transaksi)");
        
        while($r=mysqli_fetch_assoc($q2)){ ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>Rp<?= number_format($r['total'],0,",",".") ?></td>
            <td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
// total pendapatan & jumlah pelanggan
$q3 = mysqli_query($conn,
"SELECT COUNT(*) pelanggan, SUM(total) pendapatan
 FROM transaksi
 WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'");
$total = mysqli_fetch_assoc($q3);
?>

<table class="table table-bordered" style="width:40%">
<tr>
    <th>Jumlah Pelanggan</th>
    <th>Jumlah Pendapatan</th>
</tr>
<tr>
    <td><?= $total['pelanggan'] ?> Orang</td>
    <td>Rp<?= number_format($total['pendapatan'],0,",",".") ?></td>
</tr>
</table>
<a href="print_laporan.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-warning">Cetak</a>
<a href="export_excel.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-success">Excel</a>

</div>
</body>
</html>
