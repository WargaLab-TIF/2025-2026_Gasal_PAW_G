<?php
include 'koneksi.php';

$tgl_mulai = $_GET['tgl_mulai'] ?? null;
$tgl_akhir = $_GET['tgl_akhir'] ?? null;

$laporan_harian = [];
$js_labels = [];
$js_data = [];
$summary = ['total_pendapatan' => 0, 'jumlah_pelanggan' => 0];
$show_results = false;

if ($tgl_mulai && $tgl_akhir) {
    $show_results = true;

    $tgl_mulai_sql = $tgl_mulai . ' 00:00:00';
    $tgl_akhir_sql = $tgl_akhir . ' 23:59:59';

    $sql_harian = "SELECT 
                       DATE(waktu_transaksi) as tanggal, 
                       SUM(total) as total_harian 
                   FROM 
                       transaksi 
                   WHERE 
                       waktu_transaksi BETWEEN ? AND ? 
                   GROUP BY 
                       DATE(waktu_transaksi) 
                   ORDER BY 
                       tanggal ASC";

    $stmt_harian = mysqli_prepare($koneksi, $sql_harian);
    mysqli_stmt_bind_param($stmt_harian, "ss", $tgl_mulai_sql, $tgl_akhir_sql);
    mysqli_stmt_execute($stmt_harian);
    $result_harian = mysqli_stmt_get_result($stmt_harian);

    while ($row = mysqli_fetch_assoc($result_harian)) {
        $laporan_harian[] = $row;
        $js_labels[] = date('d-m-Y', strtotime($row['tanggal']));
        $js_data[] = $row['total_harian'];
    }
    mysqli_stmt_close($stmt_harian);

    $sql_summary = "SELECT 
                        SUM(total) as total_pendapatan, 
                        COUNT(DISTINCT pelanggan_id) as jumlah_pelanggan 
                    FROM 
                        transaksi 
                    WHERE 
                        waktu_transaksi BETWEEN ? AND ?";

    $stmt_summary = mysqli_prepare($koneksi, $sql_summary);
    mysqli_stmt_bind_param($stmt_summary, "ss", $tgl_mulai_sql, $tgl_akhir_sql);
    mysqli_stmt_execute($stmt_summary);
    $result_summary = mysqli_stmt_get_result($stmt_summary);
    $summary = mysqli_fetch_assoc($result_summary);
    mysqli_stmt_close($stmt_summary);
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 5px 10px;
        }

        .navbar .nav-links a.active {
            background-color: #555;
            border-radius: 5px;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            color: white;
            margin-right: 5px;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .btn.disabled {
            pointer-events: none;
            cursor: default;
            background-color: #a0a0a0;
            opacity: 0.65;
        }

        .report-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .filter-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .filter-box form {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }

        .filter-box input[type="date"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f8f9fa;
        }

        .rekap-harian th:nth-child(1),
        .rekap-harian td:nth-child(1) {
            width: 5%;
            text-align: center;
        }

        .rekap-harian th:nth-child(2),
        .rekap-harian td:nth-child(2) {
            width: 55%;
        }

        .total-summary-vertical {
            width: 50%;
            border: 1px solid #ddd;
            border-collapse: collapse;
        }

        .total-summary-vertical th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }


        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
            margin: 20px 0;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        @media print {

            .navbar,
            .filter-box {
                display: none;
            }

            .container {
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
            }

            .chart-container,
            table {
                page-break-inside: avoid;
            }

            .report-header {
                background-color: #007bff !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">Penjualan XYZ</div>
        <div class="nav-links">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="master_transaksi.php" class="active">Transaksi</a>
        </div>
    </nav>

    <div class="container">

        <div class="report-header">
            Rekap Laporan Penjualan
            <?php if ($show_results): ?>
                (Periode: <?php echo htmlspecialchars($tgl_mulai); ?> sampai <?php echo htmlspecialchars($tgl_akhir); ?>)
            <?php endif; ?>
        </div>

        <div class="filter-box">
            <a href="master_transaksi.php" class="btn btn-secondary">&lt; Kembali</a>
            <button onclick="window.print()" class="btn btn-warning">Cetak</button>

            <a href="<?php if ($show_results) echo 'export_excel.php?tgl_mulai=' . urlencode($tgl_mulai) . '&tgl_akhir=' . urlencode($tgl_akhir);
                        else echo '#'; ?>"
                class="btn btn-success <?php if (!$show_results) echo 'disabled'; ?>"
                <?php if ($show_results) echo 'target="_blank"'; ?>>
                Excel
            </a>

            <form action="report_transaksi.php" method="GET">
                <label for="tgl_mulai">Dari Tanggal:</label>
                <input type="date" id="tgl_mulai" name="tgl_mulai" value="<?php echo htmlspecialchars($tgl_mulai ?? ''); ?>" required>

                <label for="tgl_akhir">Sampai Tanggal:</label>
                <input type="date" id="tgl_akhir" name="tgl_akhir" value="<?php echo htmlspecialchars($tgl_akhir ?? ''); ?>" required>

                <button type="submit" class="btn btn-success">Tampilkan</button>
            </form>
        </div>

        <?php if ($show_results): ?>

            <hr>

            <h3>Grafik Penjualan Harian</h3>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>

            <h3>Rekap Total Penerimaan Harian</h3>
            <table class="rekap-harian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($laporan_harian) > 0): ?>
                        <?php $no = 1;
                        foreach ($laporan_harian as $row): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>Rp<?php echo number_format($row['total_harian'], 0, ',', '.'); ?></td>
                                <td><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada data pada periode ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h3>Total Keseluruhan</h3>
            <table class="total-summary-vertical">
                <tbody>
                    <tr>
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                    <tr>
                        <td><?php echo htmlspecialchars($summary['jumlah_pelanggan']); ?> Orang</td>
                        <td>Rp<?php echo number_format($summary['total_pendapatan'], 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>

        <?php else: ?>
            <p style="text-align:center; margin-top: 20px;">Silakan pilih rentang tanggal di atas dan klik "Tampilkan" untuk melihat laporan.</p>
        <?php endif; ?>

    </div> <?php if ($show_results): ?>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($js_labels); ?>,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: <?php echo json_encode($js_data); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0
                                        }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>

</body>

</html>