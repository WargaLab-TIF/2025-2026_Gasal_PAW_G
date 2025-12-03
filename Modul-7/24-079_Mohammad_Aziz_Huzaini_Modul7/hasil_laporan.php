<?php
session_start();
include 'koneksi.php';

if (!isset($_POST['tanggal_mulai']) || !isset($_POST['tanggal_akhir'])) {
    header("Location: report_transaksi.php");
    exit();
}

$tanggal_mulai  = $_POST['tanggal_mulai'];
$tanggal_akhir  = $_POST['tanggal_akhir'];

$sql = "
    SELECT 
        DATE(waktu_transaksi) AS tanggal,
        SUM(total) AS total_penerimaan
    FROM transaksi
    WHERE waktu_transaksi BETWEEN ? AND ?
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tanggal ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $tanggal_mulai, $tanggal_akhir);
$stmt->execute();
$laporan = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sql_pelanggan = "
    SELECT COUNT(*) AS total
    FROM (
        SELECT DATE(waktu_transaksi)
        FROM transaksi
        WHERE waktu_transaksi BETWEEN ? AND ?
        GROUP BY DATE(waktu_transaksi)
    ) AS x
";

$stmt2 = $conn->prepare($sql_pelanggan);
$stmt2->bind_param("ss", $tanggal_mulai, $tanggal_akhir);
$stmt2->execute();
$total_pelanggan = $stmt2->get_result()->fetch_assoc()['total'] ?? 0;

$sql_pendapatan = "
    SELECT SUM(total) AS total
    FROM transaksi
    WHERE waktu_transaksi BETWEEN ? AND ?
";

$stmt3 = $conn->prepare($sql_pendapatan);
$stmt3->bind_param("ss", $tanggal_mulai, $tanggal_akhir);
$stmt3->execute();
$total_pendapatan = $stmt3->get_result()->fetch_assoc()['total'] ?? 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Laporan Penjualan</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        h2 { 
            margin-bottom: 15px; 
            background: #1b66deff;
            color: white;
            padding-left:10px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #2196F3; color: white; }
        .btn { padding: 8px 12px; margin-right: 5px; display: inline-block; background: #2196F3; color: white; text-decoration: none; }
        
        .navbar {
            display: flex;
            justify-content: space-between; 
            align-items: center;            
            padding: 10px;
            background: #000000ff;
            color: white;
        }
        .kiri a, .kanan a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="kiri" style="align-left">
        <a href="#">Penjualan</a>
    </div>
    <div class="kanan" style="align-right">
        <a href="#">Supplier</a>
        <a href="#">Barang</a>
        <a href="#">Transaksi</a>
    </div>
</div>

<h2>Rekap Laporan Penjualan <?= date('d-m-Y', strtotime($tanggal_mulai)) ?> s/d <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></h2>

<div class="no-print">
    <a class="btn" href="report_transaksi.php">Kembali</a> <br> <br>
    <a class="btn" onclick="window.print()">Cetak PDF</a>
    <a class="btn" href="export_excel.php?tanggal_mulai=<?= $tanggal_mulai ?>&tanggal_akhir=<?= $tanggal_akhir ?>">Export Excel</a>
</div>

<?php if (count($laporan) > 0) { ?>

<h3>Grafik Penjualan</h3>
<canvas id="grafik"></canvas>

<h3>Rekap Penjualan</h3>
<table>
    <tr>
        <th>No</th>
        <th>Total</th>
        <th>Tanggal</th>
    </tr>

    <?php 
    $no = 1; 
    foreach ($laporan as $row): 
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td>Rp <?= number_format($row['total_penerimaan'], 0, ',', '.') ?></td>
        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Total Ringkasan</h3>
<table>
    <tr>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total_pelanggan ?></td>
        <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
    </tr>
</table>

<?php } else { ?>
    <p style="color:red;">Tidak ada data pada periode tersebut.</p>
<?php } ?>

<script>
let tanggal = <?= json_encode(array_column($laporan, "tanggal")) ?>;
let pendapatan = <?= json_encode(array_column($laporan, "total_penerimaan")) ?>;

new Chart(document.getElementById("grafik"), {
    type: "bar",
    data: {
        labels: tanggal.map(t => new Date(t).toLocaleDateString("id-ID")),
        datasets: [{
            label: "Total Penerimaan (Rp)",
            data: pendapatan,
            backgroundColor: "#2196F3"
        }]
    }
});
</script>

</body>
</html>
