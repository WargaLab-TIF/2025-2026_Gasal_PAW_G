<?php
require_once 'config/config.php';

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-d', strtotime('-7 days'));
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d');

$stmt = $pdo->prepare("
    SELECT 
        DATE(waktu_transaksi) as tanggal,
        SUM(total) as total_harian,
        COUNT(DISTINCT nama_pelanggan) as jumlah_pelanggan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tanggal ASC
");
$stmt->execute([$tanggal_awal, $tanggal_akhir]);
$data_harian = $stmt->fetchAll(PDO::FETCH_ASSOC);

// total keseluruhan
$stmt = $pdo->prepare("
    SELECT 
        COUNT(DISTINCT nama_pelanggan) as total_pelanggan,
        SUM(total) as total_pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN ? AND ?
");
$stmt->execute([$tanggal_awal, $tanggal_akhir]);
$total = $stmt->fetch(PDO::FETCH_ASSOC);

// data untuk chart
$chart_labels = [];
$chart_data = [];
foreach ($data_harian as $row) {
    $chart_labels[] = date('d M Y', strtotime($row['tanggal']));
    $chart_data[] = (float)$row['total_harian'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
        }
        .header-app {
            background-color: #007bff;
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .page-title {
            background-color: #007bff;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            margin-bottom: 20px;
        }
        .filter-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .summary-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .btn-export {
            margin: 5px;
        }
        .date-input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="header-app">
        <div class="container">
            <h2 class="mb-0">Penjualan</h2>
        </div>
    </div>

    <div class="container">
        <div class="page-title">
            <h3 class="mb-0">Rekap Laporan Penjualan <?= date('d/m/Y', strtotime($tanggal_awal)) ?> sampai <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></h3>
        </div>

        <a href="index.php" class="btn btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="filter-container">
            <form method="GET" action="report_transaksi.php" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>" required>
                </div>
                <div class="col-md-1 text-center">
                    <span class="fs-4">-</span>
                </div>
                <div class="col-md-4">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <?php if (!empty($data_harian)): ?>
            <div class="chart-container">
                <h4 class="mb-4">Grafik Penjualan Harian</h4>
                <canvas id="salesChart" height="100"></canvas>
            </div>

            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Rekap Penjualan Harian</h4>
                    <div>
                        <button onclick="window.print()" class="btn btn-primary btn-export">
                            <i class="bi bi-printer"></i> Print
                        </button>
                        <button onclick="exportToExcel()" class="btn btn-success btn-export">
                            <i class="bi bi-file-earmark-excel"></i> Excel
                        </button>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="rekapTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_harian as $index => $row): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>Rp<?= number_format($row['total_harian'], 0, ',', '.') ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="summary-container">
                <h4 class="mb-4">Total</h4>
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>Jumlah Pelanggan</th>
                            <th>Jumlah Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $total['total_pelanggan'] ?> Orang</td>
                            <td>Rp<?= number_format($total['total_pendapatan'], 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Tidak ada data penjualan untuk rentang tanggal yang dipilih.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if (!empty($chart_labels)): ?>
        // Inisialisasi Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($chart_labels) ?>,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: <?= json_encode($chart_data) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Total: Rp' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
        <?php endif; ?>

        // export ke Excel
        function exportToExcel() {
            const table = document.getElementById('rekapTable');
            let html = table.outerHTML;
            
            // data total
            html += '<table class="table table-bordered"><thead class="table-secondary"><tr><th>Jumlah Pelanggan</th><th>Jumlah Pendapatan</th></tr></thead><tbody><tr><td><?= $total['total_pelanggan'] ?? 0 ?> Orang</td><td>Rp<?= number_format($total['total_pendapatan'] ?? 0, 0, ',', '.') ?></td></tr></tbody></table>';
            
            // blob dan download
            const blob = new Blob([`
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <style>
                            table { border-collapse: collapse; width: 100%; }
                            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                        </style>
                    </head>
                    <body>
                        <h2>Laporan Penjualan <?= date('d/m/Y', strtotime($tanggal_awal)) ?> - <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></h2>
                        ${html}
                    </body>
                </html>
            `], { type: 'application/vnd.ms-excel' });
            
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Laporan_Penjualan_<?= date('Y-m-d', strtotime($tanggal_awal)) ?>_<?= date('Y-m-d', strtotime($tanggal_akhir)) ?>.xls';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }

        window.addEventListener('beforeprint', function() {
            document.body.style.background = 'white';
        });
        
        window.addEventListener('afterprint', function() {
            document.body.style.background = '#f5f5f5';
        });
    </script>
    <style media="print">
        @media print {
            body {
                background: white;
            }
            .header-app, .btn-back, .filter-container, .btn-export {
                display: none;
            }
            .page-title, .chart-container, .table-container, .summary-container {
                box-shadow: none;
                page-break-inside: avoid;
            }
        }
    </style>
</body>
</html>

