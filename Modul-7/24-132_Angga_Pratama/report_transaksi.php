<?php
include 'koneksi.php';

$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : '2023-11-08';
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : '2023-11-14';
$data_laporan = [];
$total_pendapatan = 0;
$total_pelanggan = 0;
$chart_labels = [];
$chart_data = [];

if (isset($_GET['tampilkan'])) {
    
    
    $stmt_harian = $mysqli->prepare("SELECT 
                                      DATE(waktu_transaksi) as tanggal, 
                                      SUM(total) as total_harian
                                    FROM transaksi 
                                    WHERE DATE(waktu_transaksi) BETWEEN ? AND ? 
                                    GROUP BY DATE(waktu_transaksi) 
                                    ORDER BY tanggal ASC");
    $stmt_harian->bind_param("ss", $tgl_mulai, $tgl_selesai);
    $stmt_harian->execute();
    $result_harian = $stmt_harian->get_result();
    $data_laporan = $result_harian->fetch_all(MYSQLI_ASSOC);

    $stmt_total = $mysqli->prepare("SELECT 
                                     SUM(total) as grand_total, 
                                     COUNT(DISTINCT nama_pelanggan) as unique_pelanggan 
                                   FROM transaksi 
                                   WHERE DATE(waktu_transaksi) BETWEEN ? AND ?");
    $stmt_total->bind_param("ss", $tgl_mulai, $tgl_selesai);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result();
    $total_result = $result_total->fetch_assoc();
    

    $total_pendapatan = $total_result['grand_total'] ? $total_result['grand_total'] : 0;
    $total_pelanggan = $total_result['unique_pelanggan'] ? $total_result['unique_pelanggan'] : 0;

    foreach ($data_laporan as $row) {
        $chart_labels[] = date('Y-m-d', strtotime($row['tanggal']));
        $chart_data[] = $row['total_harian'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Penjualan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Penjualan XYZ</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Supplier</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Barang</a></li>
                <li class="nav-item active"><a class="nav-link" href="index.php">Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Rekap Laporan Penjualan
            </div>
            <div class="card-body">
                <form action="" method="GET" class="form-inline mb-4">
                    <a href="index.php" class="btn btn-secondary mr-2">< Kembali</a>
                    <label for="tgl_mulai" class="mr-2">Dari Tanggal:</label>
                    <input type="date" class="form-control mr-2" id="tgl_mulai" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>">
                    <label for="tgl_selesai" class="mr-2">Sampai Tanggal:</label>
                    <input type="date" class="form-control mr-2" id="tgl_selesai" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
                    <button type="submit" name="tampilkan" value="true" class="btn btn-success">Tampilkan</button>
                </form>

                <?php if (isset($_GET['tampilkan'])) : ?>
                    <?php if (empty($data_laporan)) : ?>
                        <div class="alert alert-warning">Tidak ada data untuk rentang tanggal yang dipilih.</div>
                    <?php else : ?>
                        
                        <div class="mb-3">
                            <button id="btnCetak" class="btn btn-info">Cetak (PDF)</button>
                            <form action="export_excel.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>">
                                <input type="hidden" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>">
                                <button type="submit" class="btn btn-warning">Excel</button>
                            </form>
                        </div>

                        <div id="laporanCetak">
                            <h4 class="mb-3">Rekap Laporan Penjualan <?php echo $tgl_mulai; ?> sampai <?php echo $tgl_selesai; ?></h4>
                            <div class="mb-4">
                                <canvas id="myChart"></canvas>
                            </div>
                            <h5 class="mt-4">Rekap Harian</h5>
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_laporan as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo date('d Nov Y', strtotime($row['tanggal'])); ?></td>
                                            <td>Rp<?php echo number_format($row['total_harian'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <h5 class="mt-4">Total Keseluruhan</h5>
                            <table class="table table-bordered" style="width: 50%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Jumlah Pelanggan</th>
                                        <th>Jumlah Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $total_pelanggan; ?> Orang</td>
                                        <td>Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <script>
        <?php if (!empty($data_laporan)) : ?>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chart_labels); ?>,
                datasets: [{
                    label: 'Total Pendapatan Harian',
                    data: <?php echo json_encode($chart_data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        window.jsPDF = window.jspdf.jsPDF;
        document.getElementById('btnCetak').addEventListener('click', function () {
            const element = document.getElementById('laporanCetak');
            html2canvas(element, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF('p', 'mm', 'a4');
                const imgWidth = 210; 
                const pageHeight = 297; 
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                while (heightLeft > 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                pdf.save('laporan_penjualan.pdf');
            });
        });
        <?php endif; ?>
    </script>
</body>
</html>