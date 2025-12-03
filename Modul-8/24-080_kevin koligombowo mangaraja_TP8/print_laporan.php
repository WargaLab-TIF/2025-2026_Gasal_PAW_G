<?php
include 'koneksi.php';

// --- Filter tanggal ---
$tgl_awal  = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

// Query transaksi per hari
$sql = "
    SELECT 
        t.tanggal,
        SUM(t.total) AS total_harian,
        COUNT(DISTINCT t.pelanggan_id) AS jml_pelanggan
    FROM transaksi1 t
    WHERE DATE(t.tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'
    GROUP BY DATE(t.tanggal)
    ORDER BY t.tanggal ASC
";
$q = mysqli_query($conn, $sql);

// Siapkan array untuk grafik
$tanggal = [];
$pendapatan = [];
$pelanggan = [];
$total_pendapatan = 0;
$total_pelanggan  = 0;

while ($row = mysqli_fetch_assoc($q)) {
    $tanggal[]       = $row['tanggal'];
    $pendapatan[]    = $row['total_harian'];
    $pelanggan[]     = $row['jml_pelanggan'];
    $total_pendapatan += $row['total_harian'];
    $total_pelanggan  += $row['jml_pelanggan'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: center; }
    </style>
</head>

<body>

<h2>LAPORAN PENJUALAN</h2>

<!-- FILTER TANGGAL -->
<form method="GET">
    <label>Dari:</label>
    <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>">
    <label>Sampai:</label>
    <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>">
    <button type="submit">Filter</button>

    <a href="print_laporan.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" 
       class="btn btn-info">Cetak PDF</a>

    <a href="excel_laporan.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" 
       class="btn btn-success">Download Excel</a>
</form>

<hr>

<!-- GRAFIK -->
<canvas id="grafikPenjualan" height="100"></canvas>

<script>
const ctx = document.getElementById('grafikPenjualan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($tanggal) ?>,
        datasets: [{
            label: 'Total Penjualan',
            data: <?= json_encode($pendapatan) ?>
        }]
    }
});
</script>

<hr>

<!-- TABEL REKAP -->
<h3>Rekap Penjualan</h3>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Total Penjualan</th>
            <th>Jumlah Pelanggan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $q2 = mysqli_query($conn, $sql);
        while ($d = mysqli_fetch_assoc($q2)) { ?>
            <tr>
                <td><?= $d['tanggal'] ?></td>
                <td>Rp <?= number_format($d['total_harian']) ?></td>
                <td><?= $d['jml_pelanggan'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<hr>

<!-- TOTAL -->
<h3>Total</h3>
<table>
    <tr>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total_pelanggan ?></td>
        <td>Rp <?= number_format($total_pendapatan) ?></td>
    </tr>
</table>

</body>
</html>
