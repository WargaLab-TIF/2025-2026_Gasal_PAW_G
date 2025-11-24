<?php
require_once "db.php";
require_once "auth.php"; 

$sql_user = "SELECT id_user, level FROM user WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $_SESSION['username']);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$args = $result_user->fetch_all(MYSQLI_ASSOC);
$stmt_user->close();

if (empty($args)) {
    header("location: index.php");
    exit;
}

$halaman_aktif = 'laporan'; 

$start_date = isset($_GET['dari']) ? $_GET['dari'] : '';
$end_date = isset($_GET['sampai']) ? $_GET['sampai'] : '';
$show_report = isset($_GET['tampilkan']) && $_GET['tampilkan'] == 'true' && !empty($start_date) && !empty($end_date);

if ($show_report) {
    $sql_rekap = "SELECT waktu_transaksi, SUM(total) as total_harian 
                  FROM transaksi 
                  WHERE waktu_transaksi BETWEEN ? AND ?
                  GROUP BY waktu_transaksi
                  ORDER BY waktu_transaksi ASC";
    $stmt_rekap = $conn->prepare($sql_rekap);
    $stmt_rekap->bind_param("ss", $start_date, $end_date);
    $stmt_rekap->execute();
    $result_rekap = $stmt_rekap->get_result();
    $rekap_harian = $result_rekap->fetch_all(MYSQLI_ASSOC);
    $stmt_rekap->close();

    $sql_total = "SELECT COUNT(DISTINCT pelanggan_id) as total_pelanggan, SUM(total) as total_pendapatan
                  FROM transaksi
                  WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("ss", $start_date, $end_date);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $total_keseluruhan = $result_total->fetch_assoc();
    $stmt_total->close();

} else {
    $rekap_harian = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <style>
        .report-box { border: 1px solid #ccc; padding: 20px; border-radius: 5px; background-color: #fff; }
    </style>
</head>
<body>

    <?php require_once "navbar.php"; ?>

    <div class="container mt-4">
        <div class="report-box">
            <div class="bg-primary text-white p-3 mb-4 rounded-top">
                <h4 class="mb-0">Rekap Laporan Penjualan
                    <?php if ($show_report) { 
                        echo "(Periode: " . date('Y-m-d', strtotime($start_date)) . " sampai " . date('Y-m-d', strtotime($end_date)) . ")"; 
                    } ?>
                </h4>
            </div>

            <div class="d-flex align-items-end mb-4 flex-wrap">
                <a href="index.php" class="btn btn-secondary me-2">< Kembali</a>
                <button class="btn btn-warning me-2" onclick="window.print()">Cetak</button>
                
                <?php if ($show_report): ?>
                    <a href="laporan_export.php?dari=<?php echo $start_date; ?>&sampai=<?php echo $end_date; ?>" class="btn btn-secondary me-4">Excel</a>
                <?php else: ?>
                    <button class="btn btn-secondary me-4" disabled>Excel</button>
                <?php endif; ?>
                
                <form method="GET" class="d-flex align-items-end">
                    <div class="me-2">
                        <label for="dari_tanggal">Dari Tanggal:</label>
                        <input type="date" id="dari_tanggal" name="dari" class="form-control" 
                               value="<?php echo htmlspecialchars($start_date); ?>" required>
                    </div>
                    <div class="me-2">
                        <label for="sampai_tanggal">Sampai Tanggal:</label>
                        <input type="date" id="sampai_tanggal" name="sampai" class="form-control" 
                               value="<?php echo htmlspecialchars($end_date); ?>" required>
                    </div>
                    <input type="hidden" name="tampilkan" value="true">
                    <button type="submit" class="btn btn-success">Tampilkan</button>
                </form>
            </div>

            <?php if (!$show_report): ?>
                <p class="text-center text-muted mt-5">Silakan pilih rentang tanggal di atas dan klik "Tampilkan" untuk melihat laporan.</p>
            <?php elseif (empty($rekap_harian)): ?>
                <div class="alert alert-warning">Tidak ada data penjualan pada periode ini.</div>
            <?php else: ?>
                
                <hr>
                
                <h4 class="mt-4">Grafik Penjualan Harian</h4>
                <canvas id="penjualanChart" height="100"></canvas>
                
                <hr>

                <h4 class="mt-4">Rekap Total Penerimaan Harian</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($rekap_harian as $rekap) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>Rp <?php echo number_format($rekap['total_harian'], 0, ',', '.'); ?></td>
                                <td><?php echo date('d M Y', strtotime($rekap['waktu_transaksi'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <hr>

                <h4 class="mt-4">Total Keseluruhan</h4>
                <table class="table table-bordered" style="max-width: 400px;">
                    <tbody>
                        <tr>
                            <td class="fw-bold">Jumlah Pelanggan</td>
                            <td><?php echo number_format($total_keseluruhan['total_pelanggan']); ?> Orang</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Jumlah Pendapatan</td>
                            <td>Rp <?php echo number_format($total_keseluruhan['total_pendapatan'], 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
    </div>
    
    <script>
    <?php if ($show_report && !empty($rekap_harian)): ?>
        const ctx = document.getElementById('penjualanChart').getContext('2d');
        const labels = [
            <?php foreach ($rekap_harian as $rekap) { echo "'" . date('d-M-Y', strtotime($rekap['waktu_transaksi'])) . "',"; } ?>
        ];
        const dataValues = [
            <?php foreach ($rekap_harian as $rekap) { echo $rekap['total_harian'] . ","; } ?>
        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: dataValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rp'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    <?php endif; ?>
    </script>
</body>
</html>