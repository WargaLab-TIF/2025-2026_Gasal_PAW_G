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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 35px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .page-header h4 {
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .filter-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .form-inline {
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
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .chart-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        .summary-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .summary-table {
            width: auto;
            max-width: 500px;
        }

        .summary-table th {
            background: #f8f9fa;
            color: #333;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
        }

        .btn-warning:hover {
            background: #ffb300;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        }

        .btn-excel {
            background: #28a745;
            color: white;
        }

        .btn-excel:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
        }

        hr {
            border: none;
            border-top: 2px solid #f0f0f0;
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-inline {
                flex-direction: column;
            }

            .form-group {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="page-header">
        <h4>📊 Rekap Laporan Penjualan</h4>
        <a href="index.php" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="filter-card">
        <form method="GET" class="form-inline">
            <div class="form-group">
                <label>Tanggal Awal</label>
                <input type="date" name="awal" class="form-control" value="<?= $awal ?>">
            </div>
            <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" name="akhir" class="form-control" value="<?= $akhir ?>">
            </div>
            <button class="btn btn-success">🔍 Tampilkan</button>
        </form>
    </div>

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

    <div class="chart-container">
        <canvas id="grafik" height="90"></canvas>
    </div>

    <script>
    var ctx = document.getElementById("grafik").getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($dataTanggal) ?>,
            datasets: [{
                label: 'Total Penjualan',
                data: <?= json_encode($dataTotal) ?>,
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

    <div class="table-container">
        <h4 style="margin-bottom: 20px; color: #333;">Detail Transaksi Harian</h4>
        <table>
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
    </div>

<?php
// total pendapatan & jumlah pelanggan
$q3 = mysqli_query($conn,
"SELECT COUNT(*) pelanggan, SUM(total) pendapatan
 FROM transaksi
 WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'");
$total = mysqli_fetch_assoc($q3);
?>

    <div class="summary-card">
        <h4 style="margin-bottom: 20px; color: #333;">Ringkasan Total</h4>
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Jumlah Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong><?= $total['pelanggan'] ?> Orang</strong></td>
                    <td><strong>Rp<?= number_format($total['pendapatan'],0,",",".") ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="action-buttons">
            <a href="print_laporan.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-warning">🖨️ Cetak</a>
            <a href="export_excel.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-excel">📊 Export Excel</a>
        </div>
    </div>

</div>

</body>
</html>