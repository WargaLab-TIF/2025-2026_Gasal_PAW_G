<?php
require_once 'config.php';

// Ambil parameter filter
$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d');

// Query untuk data laporan
$query = "SELECT 
            DATE(t.tanggal_transaksi) as tanggal,
            COUNT(DISTINCT t.id_pelanggan) as jumlah_pelanggan,
            SUM(t.total_pembayaran) as total_penerimaan
          FROM transaksi t
          WHERE t.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
          GROUP BY DATE(t.tanggal_transaksi)
          ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);

// Query untuk total keseluruhan
$query_total = "SELECT 
                COUNT(DISTINCT id_pelanggan) as total_pelanggan,
                SUM(total_pembayaran) as total_pendapatan
                FROM transaksi
                WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$result_total = mysqli_query($conn, $query_total);
$total_data = mysqli_fetch_assoc($result_total);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .filter-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .filter-form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }
        .form-group {
            flex: 1;
            min-width: 200px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            margin-right: 10px;
        }
        .btn-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            color: white;
        }
        .chart-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .chart-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:hover {
            background: #f5f5f5;
        }
        .total-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .total-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
        }
        .total-card h3 {
            font-size: 0.9em;
            margin-bottom: 10px;
            opacity: 0.9;
        }
        .total-card .value {
            font-size: 2em;
            font-weight: bold;
        }
        .export-buttons {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                background: white;
                padding: 0;
            }
            .container {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header no-print">
            <h1>📊 Laporan Penjualan</h1>
            <p>Analisis dan Visualisasi Data Transaksi</p>
        </div>
        <div class="content">
            <a href="index.php" class="back-link no-print">← Kembali ke Data Transaksi</a>
            
            <!-- Filter Section -->
            <div class="filter-section no-print">
                <h3 style="margin-bottom: 15px;">🔍 Filter Laporan</h3>
                <form method="GET" class="filter-form">
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                </form>
            </div>

            <!-- Export Buttons -->
            <div class="export-buttons no-print">
                <button onclick="window.print()" class="btn btn-danger">🖨️ Cetak PDF</button>
                <a href="export_excel.php?tanggal_awal=<?= $tanggal_awal ?>&tanggal_akhir=<?= $tanggal_akhir ?>" class="btn btn-success">📑 Export Excel</a>
            </div>

            <!-- Chart Section -->
            <div class="chart-container">
                <h2>📈 Grafik Penerimaan Harian</h2>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- Table Rekap -->
            <div class="chart-container">
                <h2>📋 Tabel Rekap Penerimaan</h2>
                <table id="reportTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah Pelanggan</th>
                            <th>Total Penerimaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        mysqli_data_seek($result, 0); // Reset pointer
                        while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                            <td><?= $row['jumlah_pelanggan'] ?> orang</td>
                            <td>Rp <?= number_format($row['total_penerimaan'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="total-section">
                <div class="total-card">
                    <h3>👥 TOTAL PELANGGAN</h3>
                    <div class="value"><?= $total_data['total_pelanggan'] ?></div>
                </div>
                <div class="total-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <h3>💰 TOTAL PENDAPATAN</h3>
                    <div class="value">Rp <?= number_format($total_data['total_pendapatan'], 0, ',', '.') ?></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil data untuk chart
        fetch('get_chart_data.php?tanggal_awal=<?= $tanggal_awal ?>&tanggal_akhir=<?= $tanggal_akhir ?>')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Total Penerimaan (Rp)',
                            data: data.values,
                            backgroundColor: 'rgba(102, 126, 234, 0.7)',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            borderWidth: 2,
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>