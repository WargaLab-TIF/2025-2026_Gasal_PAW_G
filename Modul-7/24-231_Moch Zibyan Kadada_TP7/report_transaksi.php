<?php
include "koneksi.php";

$adaFilter = (isset($_GET['mulai']) && isset($_GET['selesai']));

$mulai  = $adaFilter ? $_GET['mulai']  : "";
$selesai = $adaFilter ? $_GET['selesai'] : "";

$dataTransaksi = [];
$jumlahPelanggan = 0;
$jumlahPendapatan = 0;

if ($adaFilter) {

    $sql = "
        SELECT * 
        FROM transaksi
        WHERE tanggal BETWEEN '$mulai' AND '$selesai'
        ORDER BY tanggal ASC
    ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $dataTransaksi[] = $row;
        $jumlahPendapatan += $row['total'];
        $jumlahPelanggan++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Penjualan</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #e9ecef;
        }
        .judul-box {
            background: #0d6efd;
            color: #fff;
            padding: 12px;
            font-size: 19px;
            border-radius: 6px 6px 0 0;
        }
        .kontainer {
            background: #fff;
            border: 1px solid #ccc;
            padding: 18px;
            border-radius: 0 0 6px 6px;
        }
        @media print {
            form, .btn {
                display: none!important;
            }
            .kontainer {
                border: none!important;
                padding: 0!important;
            }
            table {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="judul-box">Rekap Laporan Penjualan</div>
    <div class="kontainer">
        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>
        <form class="form-inline mb-4" method="GET">
            <input type="date" class="form-control mr-2" 
                   name="mulai" value="<?= $mulai ?>" required>
            <input type="date" class="form-control mr-2" 
                   name="selesai" value="<?= $selesai ?>" required>
            <button class="btn btn-success">Tampilkan Data</button>
        </form>

        <?php if ($adaFilter): ?>

            <div style="width:100%; height:360px;">
                <canvas id="grafikBar"></canvas>
            </div>
            <script>
                new Chart(document.getElementById('grafikBar'), {
                    type: 'bar',
                    data: {
                        labels: <?= json_encode(array_column($dataTransaksi, 'tanggal')); ?>,
                        datasets: [{
                            label: 'Total Penjualan (Rp)',
                            data: <?= json_encode(array_column($dataTransaksi, 'total')); ?>,
                            backgroundColor: 'rgba(0, 123, 255, 0.5)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            </script>

            <hr>

            <h5>Detail Transaksi</h5>

            <table class="table table-bordered text-center">
                <thead class="thead-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total (Rp)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($dataTransaksi as $row): ?>
                    <tr>
                        <td><?= $row['tanggal']; ?></td>
                        <td><?= $row['nama_pelanggan']; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                        <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <h5>Ringkasan</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Total Pelanggan</th>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $jumlahPelanggan; ?></td>
                    <td>Rp<?= number_format($jumlahPendapatan, 0, ',', '.'); ?></td>
                </tr>
            </table>

            <button onclick="window.print()" class="btn btn-danger">Cetak PDF</button>

            <a href="cetak_excel.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>"
               class="btn btn-success">Export ke Excel</a>

        <?php endif; ?>
    </div>
</div>
</body>
</html>