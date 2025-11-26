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
    padding: 30px;
    background: #f5f7fa;
}

.print-container {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
}

.header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    text-align: center;
}

.header h1 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.header p {
    font-size: 16px;
    opacity: 0.9;
}

#backBtn {
    padding: 12px 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

#backBtn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.chart-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 30px;
}

h4 {
    color: #333;
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: 600;
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px;
}

table tbody tr:hover {
    background: #f8f9fa;
}

table tbody tr:last-child td {
    border-bottom: none;
}

.summary-section {
    margin-top: 30px;
}

.summary-table {
    width: 60%;
    margin-top: 15px;
}

.summary-table th {
    background: #f8f9fa;
    color: #333;
}

@media print {
    @page {
        size: A4;
        margin: 15mm;
    }
    
    body {
        background: white;
        padding: 0;
    }
    
    .print-container {
        box-shadow: none;
        padding: 0;
    }
    
    #backBtn { 
        display: none; 
    }
    
    .header {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    table thead {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

</head>
<body>

<div class="print-container">
    <div class="header">
        <h1>🏪 Sistem Penjualan</h1>
        <p>Laporan Penjualan Periode <?= date('d/m/Y', strtotime($awal)) ?> - <?= date('d/m/Y', strtotime($akhir)) ?></p>
    </div>

    <button id="backBtn" onclick="history.back()">← Kembali</button>

    <div class="chart-section">
        <canvas id="grafik" height="100"></canvas>
    </div>

    <script>
    const ctx = document.getElementById("grafik").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?= json_encode($dataTanggal) ?>,
            datasets: [{
                label: "Total Penjualan (Rp)",
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

    setTimeout(() => {
        window.print();
    }, 1000);
    </script>

    <h4>📋 Tabel Rekap Harian</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>

    <div class="summary-section">
        <h4>📊 Rangkuman Total</h4>
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
    </div>
</div>

</body>
</html>