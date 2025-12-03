<?php
include 'koneksi.php';

$hasil_laporan_harian = null;
$hasil_total_pendapatan = 0;
$hasil_total_pelanggan = 0;
$data_ditemukan = false;
$chart_labels = [];
$chart_data = [];

$tgl_mulai_default = '2025-11-01';
$tgl_akhir_default = '2025-11-04';

$tgl_mulai = $tgl_mulai_default;
$tgl_akhir = $tgl_akhir_default;

if (isset($_POST['tampilkan'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_akhir = $_POST['tgl_akhir'];

    $sql_laporan = "SELECT 
                        waktu_transaksi, 
                        SUM(total) as total_per_hari
                    FROM 
                        transaksi
                    WHERE 
                        waktu_transaksi BETWEEN ? AND ?
                    GROUP BY 
                        waktu_transaksi
                    ORDER BY 
                        waktu_transaksi ASC";
    
    $stmt_laporan = mysqli_prepare($koneksi, $sql_laporan);
    mysqli_stmt_bind_param($stmt_laporan, "ss", $tgl_mulai, $tgl_akhir);
    mysqli_stmt_execute($stmt_laporan);
    $hasil_laporan_harian = mysqli_stmt_get_result($stmt_laporan);

    if ($hasil_laporan_harian && mysqli_num_rows($hasil_laporan_harian) > 0) {
        $data_ditemukan = true;
        while($row = mysqli_fetch_assoc($hasil_laporan_harian)) {
            $chart_labels[] = $row['waktu_transaksi'];
            $chart_data[] = $row['total_per_hari'];
        }
        mysqli_data_seek($hasil_laporan_harian, 0); 
    }

    $sql_pendapatan = "SELECT SUM(total) as total_pendapatan
                       FROM transaksi
                       WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt_pendapatan = mysqli_prepare($koneksi, $sql_pendapatan);
    mysqli_stmt_bind_param($stmt_pendapatan, "ss", $tgl_mulai, $tgl_akhir);
    mysqli_stmt_execute($stmt_pendapatan);
    $hasil_pendapatan_query = mysqli_stmt_get_result($stmt_pendapatan);
    $row_pendapatan = mysqli_fetch_assoc($hasil_pendapatan_query);
    $hasil_total_pendapatan = $row_pendapatan['total_pendapatan'] ?? 0;

    $sql_pelanggan = "SELECT COUNT(DISTINCT pelanggan_id) as total_pelanggan
                      FROM transaksi
                      WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt_pelanggan = mysqli_prepare($koneksi, $sql_pelanggan);
    mysqli_stmt_bind_param($stmt_pelanggan, "ss", $tgl_mulai, $tgl_akhir);
    mysqli_stmt_execute($stmt_pelanggan);
    $hasil_pelanggan_query = mysqli_stmt_get_result($stmt_pelanggan);
    $row_pelanggan = mysqli_fetch_assoc($hasil_pelanggan_query);
    $hasil_total_pelanggan = $row_pelanggan['total_pelanggan'] ?? 0;

    mysqli_stmt_close($stmt_laporan);
    mysqli_stmt_close($stmt_pendapatan);
    mysqli_stmt_close($stmt_pelanggan);
}
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laporan_penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media print {
            body {
                padding-top: 0;
            }
            .navbar, #btn-kembali, #btn-cetak, #btn-excel, #form-filter, .card-body hr {
                display: none !important;
            }
            .container, .card, .card-body {
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            .card-header {
                border: none !important;
                background: none !important;
                color: #000 !important;
                font-size: 1.5rem;
                font-weight: bold;
                padding: 0 0 1rem 0 !important;
            }
            canvas {
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Penjualan XYZ</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="data_transaksi.php">Transaksi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Rekap Laporan Penjualan
                <?php if (isset($_POST['tampilkan']) || !isset($_POST['tampilkan'])): ?>
                    <small class="d-block"><?php echo $tgl_mulai; ?> sampai <?php echo $tgl_akhir; ?></small>
                <?php endif; ?>
            </div>
            <div class="card-body">
                
                <a href="data_transaksi.php" class="btn btn-primary mb-3 me-2" id="btn-kembali">&laquo; Kembali</a>

                <a href="#" onclick="window.print(); return false;" class="btn btn-warning mb-3 me-2" id="btn-cetak">
                    Cetak
                </a>
                <a href="export_excel.php?tgl_mulai=<?php echo $tgl_mulai; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" class="btn btn-success mb-3" id="btn-excel">
                    Excel
                </a>
                
                <form action="" method="POST" class="border p-3 mb-4 rounded bg-light" id="form-filter">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label for="tgl_mulai" class="form-label">Dari Tanggal</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?php echo $tgl_mulai; ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="tgl_akhir" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php echo $tgl_akhir; ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="tampilkan" class="btn btn-success w-100">Tampilkan</button>
                        </div>
                    </div>
                </form>
                
                <hr>

                <?php if (isset($_POST['tampilkan'])): ?>
                    
                    <?php if ($data_ditemukan): ?>
                        
                        <h4 class="mb-3">Grafik Pendapatan Harian</h4>
                        <div class="mb-4" style="width: 100%; height: 350px;">
                            <canvas id="myChart"></canvas>
                        </div>
                        
                        <h4 class="mb-3">Rekap Total Penerimaan Harian</h4>
                        <table class="table table-bordered table-striped">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($hasil_laporan_harian)) {
                                    $tanggal_obj = date_create($row['waktu_transaksi']);
                                    $tanggal_format = date_format($tanggal_obj, 'd M Y');
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-end">Rp<?php echo number_format($row['total_per_hari'], 0, ',', '.'); ?></td>
                                    <td class="text-center"><?php echo $tanggal_format; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h4 class="mt-5 mb-3">Total Kumulatif</h4>
                        <table class="table table-bordered" style="max-width: 400px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Jumlah Pelanggan</th>
                                    <th>Jumlah Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $hasil_total_pelanggan; ?> Orang</td>
                                    <td class="text-end fw-bold">Rp<?php echo number_format($hasil_total_pendapatan, 0, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Tidak ada data transaksi ditemukan untuk rentang tanggal yang dipilih (<?php echo $tgl_mulai; ?> s/d <?php echo $tgl_akhir; ?>).
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php
        if (isset($_POST['tampilkan']) && $data_ditemukan): 
        ?>
            const labels = <?php echo json_encode($chart_labels); ?>;
            const data = <?php echo json_encode($chart_data); ?>;
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: data,
                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, ticks: { callback: function(value) { return new Intl.NumberFormat('id-ID').format(value); } } } },
                    plugins: { tooltip: { callbacks: { label: function(context) { let label = context.dataset.label || ''; if (label) { label += ': '; } if (context.parsed.y !== null) { label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y); } return label; } } } }
                }
            });
        <?php endif; ?>
    </script>

</body>
</html>