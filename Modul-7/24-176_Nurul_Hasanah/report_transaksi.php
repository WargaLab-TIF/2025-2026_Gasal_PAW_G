<?php
include "koneksi.php";

if (isset($_GET['tgl_mulai']) && isset($_GET['tgl_selesai'])) {
    $tgl_mulai = $_GET['tgl_mulai'];
    $tgl_selesai = $_GET['tgl_selesai'];
} else {
    $tgl_mulai = date('Y-m-d', strtotime('-6 days'));
    $tgl_selesai = date('Y-m-d');
}

$query = mysqli_query($koneksi, "
    SELECT tanggal, 
           SUM(total) AS total_harian, 
           COUNT(*) AS jumlah_transaksi
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
    GROUP BY tanggal
    ORDER BY tanggal ASC
");

$labels = [];
$data_grafik = [];
$rekap = [];

while ($row = mysqli_fetch_assoc($query)) {
    $labels[] = $row['tanggal'];
    $data_grafik[] = ($row['total_harian'] ?? 0);  // amankan dari NULL
    $rekap[] = $row;
}

$q_total = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT customer_id) AS pelanggan, 
           SUM(total) AS pendapatan
    FROM transaksi
    WHERE tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'
");

$total = mysqli_fetch_assoc($q_total);

// amankan nilai NULL
$total_pelanggan = $total['pelanggan'] ?? 0;
$total_pendapatan = $total['pendapatan'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="p-4">

<div class="container">

    <h3 class="mb-3">Laporan Penjualan</h3>

    <form method="GET" class="form-inline mb-3">
        <label class="mr-2">Dari:</label>
        <input type="date" name="tgl_mulai" class="form-control mr-2"
               value="<?= $tgl_mulai ?>">

        <label class="mr-2">Sampai:</label>
        <input type="date" name="tgl_selesai" class="form-control mr-2"
               value="<?= $tgl_selesai ?>">

        <button class="btn btn-success mr-2">Filter</button>
        <a href="report_transaksi.php" class="btn btn-secondary">Reset</a>
    </form>

    <div class="card mb-3">
        <div class="card-header">Grafik Penjualan</div>
        <div class="card-body">
            <canvas id="grafikPenjualan" height="100"></canvas>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Tabel Rekap</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Pendapatan</th>
                        <th>Jumlah Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rekap)) { ?>
                        <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                    <?php } else { ?>
                        <?php foreach ($rekap as $r) { ?>
                        <tr>
                            <td><?= $r['tanggal'] ?></td>
                            <td>Rp <?= number_format(($r['total_harian'] ?? 0), 0, ',', '.') ?></td>
                            <td><?= $r['jumlah_transaksi'] ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Total Periode Ini</div>
        <div class="card-body">
            <p><b>Jumlah Pelanggan :</b> <?= $total_pelanggan ?></p>
            <p><b>Total Pendapatan :</b> Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
        </div>
    </div>

    <a href="cetak_laporan.php?tgl_mulai=<?= $tgl_mulai ?>&tgl_selesai=<?= $tgl_selesai ?>" 
       class="btn btn-danger" target="_blank">Print PDF</a>

    <a href="excel_laporan.php?tgl_mulai=<?= $tgl_mulai ?>&tgl_selesai=<?= $tgl_selesai ?>" 
       class="btn btn-success">Export Excel</a>

</div>

<script>
    const labels = <?= json_encode($labels) ?>;
    const dataGrafik = <?= json_encode($data_grafik) ?>;
</script>

<script src="grafik.js"></script>

</body>
</html>