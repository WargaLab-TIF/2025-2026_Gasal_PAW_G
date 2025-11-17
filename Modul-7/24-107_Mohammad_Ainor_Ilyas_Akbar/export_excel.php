<?php
require_once 'config.php';

$tanggal_awal = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-01');
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d');

// Query data
$query = "SELECT 
            DATE(t.tanggal_transaksi) as tanggal,
            COUNT(DISTINCT t.id_pelanggan) as jumlah_pelanggan,
            SUM(t.total_pembayaran) as total_penerimaan
          FROM transaksi t
          WHERE t.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
          GROUP BY DATE(t.tanggal_transaksi)
          ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);

// Header untuk download Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_penjualan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .total-row {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENJUALAN</h2>
        <p>Periode: <?= date('d-m-Y', strtotime($tanggal_awal)) ?> s/d <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></p>
    </div>

    <table>
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
            $total_pelanggan = 0;
            $total_penerimaan = 0;
            while($row = mysqli_fetch_assoc($result)): 
                $total_pelanggan += $row['jumlah_pelanggan'];
                $total_penerimaan += $row['total_penerimaan'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td><?= $row['jumlah_pelanggan'] ?></td>
                <td>Rp <?= number_format($row['total_penerimaan'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
            <tr class="total-row">
                <td colspan="2">TOTAL</td>
                <td><?= $total_pelanggan ?> Pelanggan</td>
                <td>Rp <?= number_format($total_penerimaan, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>