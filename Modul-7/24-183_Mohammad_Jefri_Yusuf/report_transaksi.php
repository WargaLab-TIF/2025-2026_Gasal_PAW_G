<?php 
require "conn.php";
require "functions.php";
require "validate.php";

// Logika untuk mengambil data laporan

$errors = [];
if(isset($_POST["submit"])){

    $since = $_POST["since"];
    $until = $_POST["until"];

    validateDateRange($errors, $since, $until);

    if($errors == []){
        $sql_grafik = "SELECT 
        waktu_transaksi,
        SUM(total) AS total_harian
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$since' AND '$until'
        GROUP BY waktu_transaksi
        ORDER BY waktu_transaksi ASC;
        ";

        $recap_transaksi = getDataReport($conn, $sql_grafik);

        $tanggal = array_map(function ($r) {
                return $r['waktu_transaksi'];
            }, $recap_transaksi);

        $total_harian = array_map(function ($r) {
                return $r['total_harian'];
            }, $recap_transaksi);

        $sql_total = "SELECT 
            COUNT(id) AS jumlah_pelanggan,
            SUM(total) AS total_pendapatan
            FROM transaksi
            WHERE waktu_transaksi BETWEEN '$since' AND '$until'
        ";

        $total_transaksi = getData($conn, $sql_total);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($_POST['submit']) ? "laporan_penjualan" : "Rekap Laporan Penjualan"?></title>
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet"> 
    <link rel="stylesheet" href="css/report.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
    <div class="header">
        <h1 class="header-title">Warung Madura</h1>
        <div class="navbar">
            <a href="#">Supplier</a>
            <a href="#">Barang</a>
            <a href="transaksi.php" class="active">Transaksi</a>
        </div>
    </div>
    <div class="content">
        <?php if(!isset($_POST["submit"]) || $errors != []):?>
        <div class="table-header">
            <h3>Rekap Laporan Penjualan</h3>
            <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
        </div>
        
        <form action="" method="post" class="form-laporan">
            <label for="since">Dari Tanggal:</label>
            <input type="date" name="since" id="since" value="<?= $_POST["since"] ?? "" ?>">
            <label for="until">Sampai Tanggal:</label>
            <input type="date" name="until" id="until" value="<?= $_POST["until"] ?? "" ?>">
            <button type="submit" name="submit" class="btn btn-primary">Tampilkan Laporan</button>
        </form>
        <ul class="error">
            <li><?= $errors["since"] ?? "" ?></li>
            <li><?= $errors["until"] ?? "" ?></li>
            <li><?= $errors["range"] ?? "" ?></li>
        </ul>
        <?php endif; ?>
        <?php if(isset($_POST["submit"]) && $errors == []):?>
        <div class="table-header">
            <h3>Rekap Laporan Penjualan <?= $since ?> sampai <?= $until ?></h3>
            <div class="btn-group">
                <a href="report_transaksi.php" class="btn btn-secondary">Kembali</a>
                <a onclick="window.print()" class="btn btn-warning">Cetak</a>
                <a href="export_excel.php?since=<?= $since ?>&until=<?= $until ?>" target="_blank" class="btn btn-success">Excel</a>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="transaksi"></canvas>
        </div>
        
        <div class="table-header">
            <h3>Laporan Harian</h3>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
            <?php
            $num = 1;
            foreach ($recap_transaksi as $t):
            ?>
            <tr>
                <td><?= $num ?></td>
                <td>Rp<?= number_format($t['total_harian'], 0, ',', '.') ?></td>
                <td><?= date("d M Y", strtotime($t['waktu_transaksi'])) ?></td>
            </tr>
            <?php 
            $num++;
            endforeach;
            ?>
        </table>
        
        <div class="table-header">
            <h3>Ringkasan</h3>
        </div>
        <table>
            <tr>
                <th>Jumlah Pelanggan</th>
                <th>Total Pendapatan</th>
            </tr>
            <tr>
                <td><?= $total_transaksi['jumlah_pelanggan'] ?></td>
                <td>Rp<?= number_format($total_transaksi['total_pendapatan'], 0, ',', '.') ?></td>
            </tr>
        </table>
        
        <script>
        const ctx = document.getElementById('transaksi');
        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: <?= json_encode($tanggal) ?>,
            datasets: [{
                label: "Total",
                data: <?= json_encode($total_harian) ?>,
                backgroundColor: '#478ECC',
                borderColor: '#2E608A',
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
        </script>
        <?php endif;?>
    </div>
    </div> 
</body>
</html>