<?php
include '../auth.php';
require '../koneksi.php';

// Ambil filter tanggal, default ke bulan ini jika kosong
$awal = $_GET['awal'] ?? date('Y-m-01');
$akhir = $_GET['akhir'] ?? date('Y-m-t');

// Query menggunakan PDO
$sql = "SELECT waktu_transaksi, SUM(total) as total_harian 
        FROM transaksi 
        WHERE waktu_transaksi BETWEEN ? AND ? 
        GROUP BY waktu_transaksi 
        ORDER BY waktu_transaksi ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$awal, $akhir]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Siapkan data untuk Grafik Chart.js
$labels = [];
$totals = [];
$total_periode = 0;

foreach ($data as $row) {
    $labels[] = date('d-m-Y', strtotime($row['waktu_transaksi']));
    $totals[] = (int)$row['total_harian'];
    $total_periode += $row['total_harian'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 900px; margin: auto; }
        h2 { color: #333; text-align: center; }
        .filter-box { background: #eef3ff; padding: 15px; border-radius: 6px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        input[type="date"] { padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .btn-excel { background: #28a745; text-decoration: none; padding: 8px 15px; color: white; border-radius: 4px; display: inline-block; }
        .btn-back { background: #6c757d; text-decoration: none; padding: 8px 15px; color: white; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>

<div class="container">
    <h2>Laporan Penjualan Periode</h2>
    
    <div class="filter-box">
        <form method="get">
            <label>Dari:</label>
            <input type="date" name="awal" value="<?= $awal ?>" required>
            <label>Sampai:</label>
            <input type="date" name="akhir" value="<?= $akhir ?>" required>
            <button type="submit">Filter</button>
        </form>
        
        <div>
            <a href="report_excel.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn-excel">Export Excel</a>
            <a href="laporan_index.php" class="btn-back">Kembali</a>
        </div>
    </div>

    <canvas id="salesChart"></canvas>

    <h3>Detail Transaksi</h3>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Total Pendapatan</th>
        </tr>
        <?php if (empty($data)): ?>
            <tr><td colspan="2" style="text-align:center">Tidak ada data pada periode ini</td></tr>
        <?php else: ?>
            <?php foreach ($data as $d): ?>
            <tr>
                <td><?= date('d-m-Y', strtotime($d['waktu_transaksi'])) ?></td>
                <td>Rp <?= number_format($d['total_harian'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th>Total Keseluruhan</th>
                <th>Rp <?= number_format($total_periode, 0, ',', '.') ?></th>
            </tr>
        <?php endif; ?>
    </table>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Tipe grafik batang
        data: {
            labels: <?= json_encode($labels) ?>, // Tanggal
            datasets: [{
                label: 'Pendapatan Harian',
                data: <?= json_encode($totals) ?>, // Total duit
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

</body>
</html>