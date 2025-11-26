<?php
if (!isset($_GET['awal']) || !isset($_GET['akhir'])) {
    die("Parameter tanggal tidak dikirim.");
}

$conn = mysqli_connect("localhost","root","","penjualan");

$awal  = $_GET['awal'];
$akhir = $_GET['akhir'];

// DATA GRAFIK
$q = mysqli_query($conn,"
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC
");

$dataTanggal = [];
$dataTotal   = [];

while ($r = mysqli_fetch_assoc($q)) {
    $dataTanggal[] = $r['tgl'];
    $dataTotal[]   = $r['total'];
}

// TOTAL
$qTotal = mysqli_query($conn,"
    SELECT COUNT(*) AS pelanggan, SUM(total) AS pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
");
$total = mysqli_fetch_assoc($qTotal);
?>
<!DOCTYPE html>
<html>
<head>
<title>Cetak Laporan Penjualan</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { 
    font-family: Arial; 
}


.header {
    background: #007bff;
    color: white;
    padding: 14px;
    font-size: 20px;
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid black;
    padding: 6px;
}

@media print {
    @page {
        size: A4;
        margin: 10mm;
    }
    #backBtn { display:none; }
}
</style>

</head>
<body>

<div class="header">
    Rekap Laporan Penjualan <?= $awal ?> sampai <?= $akhir ?>
</div>

<button id="backBtn" onclick="history.back()">Kembali</button>

<canvas id="grafik" height="120"></canvas>

<script>
const ctx = document.getElementById("grafik").getContext("2d");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: <?= json_encode($dataTanggal) ?>,
        datasets: [{
            label: "Total",
            data: <?= json_encode($dataTotal) ?>,
            borderWidth: 1
        }]
    }
});

setTimeout(() => {
    window.print();
}, 800);
</script>

<h4>Tabel Rekap</h4>
<table>
<tr>
    <th>No</th>
    <th>Total</th>
    <th>Tanggal</th>
</tr>

<?php
$no = 1;
mysqli_data_seek($q, 0);
while ($r = mysqli_fetch_assoc($q)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td>Rp<?= number_format($r['total'],0,",",".") ?></td>
    <td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
</tr>
<?php } ?>
</table>

<h4>Rangkuman</h4>
<table style="width:40%;">
<tr>
    <th>Jumlah Pelanggan</th>
    <th>Jumlah Pendapatan</th>
</tr>
<tr>
    <td><?= $total['pelanggan'] ?> Orang</td>
    <td>Rp<?= number_format($total['pendapatan'],0,",",".") ?></td>
</tr>
</table>

</body>
</html>
