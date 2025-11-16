<?php
include "koneksi.php";

$tgl_dari = isset($_GET['tgl_dari']) ? $_GET['tgl_dari'] : "";
$tgl_sampai = isset($_GET['tgl_sampai']) ? $_GET['tgl_sampai'] : "";

$data = [];
$total_pelanggan = 0;
$total_pendapatan = 0;

if (!empty($tgl_dari) && !empty($tgl_sampai)) {

    $data = mysqli_query($koneksi, "
        SELECT transaksi.waktu_transaksi, SUM(transaksi_detail.harga) AS total
        FROM transaksi
        JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
        WHERE transaksi.waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
        GROUP BY transaksi.waktu_transaksi
        ORDER BY transaksi.waktu_transaksi ASC
    ");

    $total_pelanggan = mysqli_fetch_assoc(
        mysqli_query($koneksi, "
            SELECT COUNT(DISTINCT pelanggan_id) AS total
            FROM transaksi
            WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
        ")
    )['total'];

    $total_pendapatan = mysqli_fetch_assoc(
        mysqli_query($koneksi, "
            SELECT SUM(harga) AS total
            FROM transaksi_detail
            JOIN transaksi ON transaksi_detail.transaksi_id = transaksi.id
            WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
        ")
    )['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>

</head>
<body class="p-4 bg-light">

<div class="container">

    <h2 class="mb-4"> Laporan Penjualan</h2>

    <form method="GET" class="card p-3 mb-4 shadow-sm no-print">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">Dari Tanggal</label>
                <input type="date" name="tgl_dari" class="form-control" required value="<?= $tgl_dari ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Sampai Tanggal</label>
                <input type="date" name="tgl_sampai" class="form-control" required value="<?= $tgl_sampai ?>">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">Tampilkan</button>
            </div>
        </div>
    </form>

    <?php if (!empty($tgl_dari) && !empty($tgl_sampai)): ?>

    <button onclick="window.print()" class="btn btn-danger mb-3 no-print">
         CETAK PDF
    </button>

    <a href="report_excel.php?tgl_dari=<?= $tgl_dari ?>&tgl_sampai=<?= $tgl_sampai ?>" 
    class="btn btn-success mb-3 no-print"> Download Excel</a>


    <div class="alert alert-primary">
        <h4 class="m-0">Rekap Laporan Penjualan <?= $tgl_dari ?> sampai <?= $tgl_sampai ?></h4>
    </div>

    <div class="card p-3 shadow mb-4">
        <canvas id="grafik"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('grafik');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php 
                    $labels = mysqli_query($koneksi, "
                        SELECT waktu_transaksi FROM transaksi
                        WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
                        GROUP BY waktu_transaksi
                        ORDER BY waktu_transaksi ASC
                    ");
                    while ($l = mysqli_fetch_assoc($labels)) {
                        echo "'".$l['waktu_transaksi']."',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Total',
                    backgroundColor: 'rgba(100, 100, 100, 0.5)',
                    data: [
                        <?php 
                        $values = mysqli_query($koneksi, "
                            SELECT SUM(harga) AS total FROM transaksi_detail
                            JOIN transaksi ON transaksi.id = transaksi_detail.transaksi_id
                            WHERE waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
                            GROUP BY waktu_transaksi
                            ORDER BY waktu_transaksi ASC
                        ");
                        while ($v = mysqli_fetch_assoc($values)) {
                            echo $v['total'] . ",";
                        }
                        ?>
                    ]
                }]
            }
        });
    </script>

    <table class="table table-bordered mt-4">
        <thead class="table-secondary text-center">
            <tr>
                <th>No</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $result = mysqli_query($koneksi, "
                SELECT transaksi.waktu_transaksi, SUM(transaksi_detail.harga) AS total
                FROM transaksi
                JOIN transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
                WHERE transaksi.waktu_transaksi BETWEEN '$tgl_dari' AND '$tgl_sampai'
                GROUP BY transaksi.waktu_transaksi
                ORDER BY transaksi.waktu_transaksi ASC
            ");
            while ($r = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>Rp <?= number_format($r['total']); ?></td>
                <td><?= $r['waktu_transaksi']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <table class="table table-bordered mt-4">
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Jumlah Pendapatan</th>
        </tr>
        <tr>
            <td><?= $total_pelanggan ?> Orang</td>
            <td>Rp <?= number_format($total_pendapatan) ?></td>
        </tr>
    </table>

    <?php endif; ?>

</div>

</body>
</html>
