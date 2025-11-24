<?php
include '../cek_session.php'; 
include '../koneksi.php'; 


if($_SESSION['level'] != 1 && $_SESSION['level'] != 2) {
    header("location:home.php?pesan=akses_ditolak");
    exit(); 
}

$adaFilter = (isset($_GET['mulai']) && isset($_GET['selesai']) && !empty($_GET['mulai']) && !empty($_GET['selesai']));

$mulai = $adaFilter ? mysqli_real_escape_string($koneksi, $_GET['mulai']) : "";
$selesai = $adaFilter ? mysqli_real_escape_string($koneksi, $_GET['selesai']) : "";

$dataTransaksi = [];
$jumlahPelangganUnik = 0; 
$jumlahPendapatan = 0;
$tanggalData = [];
$totalData = [];
$idPelangganUnik = [];

if ($adaFilter) {
    $sql = "
        SELECT 
            t.tanggal, 
            t.total, 
            p.nama_pelanggan,
            t.id_pelanggan
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        WHERE t.tanggal BETWEEN '$mulai' AND '$selesai'
        ORDER BY t.tanggal ASC
    ";

    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Mengambil Keterangan (Asumsi Keterangan diambil dari nama pelanggan, 
            // jika ada kolom keterangan di transaksi, gunakan t.keterangan)
            $keterangan = $row['nama_pelanggan'] ? "Transaksi oleh " . $row['nama_pelanggan'] : "Transaksi Tanpa Pelanggan"; 
            
            $dataTransaksi[] = [
                'tanggal' => $row['tanggal'],
                'nama_pelanggan' => $row['nama_pelanggan'] ?? 'Umum',
                'keterangan' => $keterangan,
                'total' => $row['total'],
            ];
            
            $jumlahPendapatan += $row['total'];
            
            // Mengumpulkan data untuk Chart.js
            $tanggalData[] = $row['tanggal'];
            $totalData[] = (float)$row['total'];

            // Menghitung jumlah pelanggan unik
            if (!in_array($row['id_pelanggan'], $idPelangganUnik)) {
                $idPelangganUnik[] = $row['id_pelanggan'];
            }
        }
        $jumlahPelangganUnik = count($idPelangganUnik);
    } else {
         // Handle error query
         echo "<div class='alert alert-danger'>Gagal mengambil data transaksi: " . mysqli_error($koneksi) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Penjualan</title>
    <!-- Menggunakan CDN Bootstrap 4.5.2 -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Menggunakan CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f4f4f4;
            font-family: sans-serif;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin-top: 40px;
            padding: 0;
        }
        .judul-box {
            background: #007bff; /* Primary Blue */
            color: #fff;
            padding: 15px;
            font-size: 22px;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
        }
        .kontainer {
            background: #fff;
            border: 1px solid #ccc;
            padding: 25px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .form-inline .form-control {
            margin-right: 10px;
        }
        
        /* Chart specific styling */
        #grafikBar {
            max-height: 400px; 
            margin-bottom: 20px;
        }

        /* Print Styling */
        @media print {
            form, .btn-secondary, .btn-danger, .btn-success {
                display: none !important;
            }
            .kontainer {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
            .judul-box {
                 background: #fff !important;
                 color: #333 !important;
                 border-bottom: 2px solid #ccc;
                 border-radius: 0 !important;
            }
            table {
                font-size: 10pt;
                color: #000;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="judul-box">Rekap Laporan Penjualan</div>
    <div class="kontainer">
        <a href="../home.php" class="btn btn-secondary mb-3">← Kembali ke Home</a>
        
        <!-- Form Filter Tanggal -->
        <form class="form-inline mb-4" method="GET">
            <label for="mulai" class="mr-2">Mulai:</label>
            <input type="date" class="form-control mr-2" 
                   id="mulai" name="mulai" value="<?= htmlspecialchars($mulai) ?>" required>
            
            <label for="selesai" class="mr-2">Sampai:</label>
            <input type="date" class="form-control mr-2" 
                   id="selesai" name="selesai" value="<?= htmlspecialchars($selesai) ?>" required>
            
            <button class="btn btn-success">Tampilkan Laporan</button>
        </form>

        <?php if ($adaFilter): ?>
            <div class="alert alert-info">
                Laporan Penjualan dari tanggal **<?= htmlspecialchars(date('d F Y', strtotime($mulai))) ?>** sampai **<?= htmlspecialchars(date('d F Y', strtotime($selesai))) ?>**
            </div>

            <!-- Grafik Penjualan -->
            <div style="width:100%; height:360px;">
                <canvas id="grafikBar"></canvas>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('grafikBar').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            // Data Tanggal
                            labels: <?= json_encode($tanggalData); ?>, 
                            datasets: [{
                                label: 'Total Penjualan (Rp)',
                                // Data Total Pendapatan
                                data: <?= json_encode($totalData); ?>, 
                                backgroundColor: 'rgba(0, 123, 255, 0.7)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Pendapatan (Rp)'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>

            <hr class="my-4">

            <!-- Ringkasan -->
            <h5>Ringkasan Laporan</h5>
            <table class="table table-bordered text-center mb-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Total Transaksi (Baris)</th>
                        <th>Jumlah Pelanggan Unik</th>
                        <th>Total Pendapatan (Nett)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= count($dataTransaksi); ?> Transaksi</td>
                        <td><?= $jumlahPelangganUnik; ?> Orang</td>
                        <td>**Rp<?= number_format($jumlahPendapatan, 0, ',', '.'); ?>**</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Detail Transaksi -->
            <h5>Detail Transaksi</h5>
            <table class="table table-striped table-bordered text-left">
                <thead class="thead-light">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th class="text-right">Total (Rp)</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($dataTransaksi as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= $row['tanggal']; ?></td>
                        <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                        <td class="text-right">Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($dataTransaksi)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data transaksi pada periode ini.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            
            <div class="mt-4 text-center">
                <button onclick="window.print()" class="btn btn-primary mr-3">Cetak Laporan</button>
                <a href="cetak_excel.php?mulai=<?= htmlspecialchars($mulai) ?>&selesai=<?= htmlspecialchars($selesai) ?>"
                   class="btn btn-success">Export ke Excel</a>
            </div>

        <?php else: ?>
             <div class="alert alert-warning text-center">
                Silakan pilih rentang tanggal (Mulai dan Sampai) untuk menampilkan laporan penjualan.
             </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>