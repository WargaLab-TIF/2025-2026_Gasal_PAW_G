<?php
include 'koneksi.php';

// ---- Filter tanggal ----
$tgl_awal  = $_GET['tgl_awal']  ?? date('Y-m-01');
$tgl_akhir = $_GET['tgl_akhir'] ?? date('Y-m-d');

// Query transaksi per hari
$sql = "
    SELECT 
        DATE(tanggal) AS tgl,
        SUM(total) AS total_harian,
        COUNT(DISTINCT pelanggan_id) AS jml_pelanggan
    FROM transaksi1
    WHERE DATE(tanggal) BETWEEN '$tgl_awal' AND '$tgl_akhir'
    GROUP BY DATE(tanggal)
    ORDER BY tanggal ASC
";
$q = mysqli_query($conn, $sql);

$tanggal = [];
$pendapatan = [];
$pelanggan = [];
$total_pendapatan = 0;
$total_pelanggan  = 0;

// --- PERBAIKAN 1: Pengecekan error untuk kueri pertama ($q) ---
if ($q) {
    while ($row = mysqli_fetch_assoc($q)) {
        $tanggal[] = $row['tgl'];
        $pendapatan[] = $row['total_harian'];
        $pelanggan[] = $row['jml_pelanggan'];
        $total_pendapatan += $row['total_harian'];
        $total_pelanggan  += $row['jml_pelanggan'];
    }
    // Setel ulang pointer hasil untuk loop kedua
    mysqli_data_seek($q, 0); 
} else {
    // Jika kueri gagal, tampilkan error dan hentikan eksekusi skrip untuk menghindari error fatal lain
    die("Error dalam kueri SQL pertama: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { font-family: Arial, sans-serif; padding: 20px; }

/* ================= STYLE MODE PRINT ================= */
@media print {
    #btnPrint, #filterBox {
        display: none;
    }
    @page {
        size: A4;
        margin: 12mm;
    }
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 8px;
    text-align: center;
}
.error-message {
    color: red;
    text-align: left !important;
}
</style>
</head>

<body>

<h2 style="margin-bottom:5px;">LAPORAN PENJUALAN</h2>
<p>Periode: <b><?= $tgl_awal ?></b> sampai <b><?= $tgl_akhir ?></b></p>

<!-- ================= FILTER ================= -->
<div id="filterBox">
<form method="GET" style="margin-bottom:20px;">
    <label>Dari:</label>
    <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>">
    <label>Sampai:</label>
    <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>">
    <button type="submit">Filter</button>

    <button type="button" id="btnPrint"
            onclick="printPage()"
            style="padding:8px 15px; background:#2196F3; color:white; border:0; border-radius:4px;">
        Cetak Laporan
    </button>
    <a href="excel_laporan.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>" class="btn btn-success">Download Excel</a>
</form>
</div>

<hr>

<!-- ================= GRAFIK ================= -->
<canvas id="grafikPenjualan" height="110"></canvas>

<script>
const ctx = document.getElementById('grafikPenjualan');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($tanggal) ?>,
        datasets: [{
            label: 'Total Penjualan',
            data: <?= json_encode($pendapatan) ?>,
            backgroundColor: '#4C9AFF'
        }]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});


// Tombol Print
function printPage() {
    document.title = "laporan_penjualan";
    window.print();
}
</script>

<hr>

<!-- ================= TABEL REKAP ================= -->
<h3>Rekap Penjualan</h3>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Total Penjualan</th>
            <th>Jumlah Pelanggan</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // --- PERBAIKAN 2: Gunakan kembali hasil kueri yang sudah diperiksa ($q) ---
    // Tidak perlu menjalankan kueri kedua ($q2) karena datanya sama
    if ($q) {
        while ($d = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $d['tgl'] ?></td>
                <td>Rp <?= number_format($d['total_harian']) ?></td>
                <td><?= $d['jml_pelanggan'] ?></td>
            </tr>
        <?php }
    } else {
         echo '<tr><td colspan="3" class="error-message">Data tidak dapat dimuat karena kesalahan SQL.</td></tr>';
    } ?>
    </tbody>
</table>

<hr>

<!-- ================= TOTAL ================= -->
<h3>Total Keseluruhan</h3>
<table>
    <tr>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan</th>
    </tr>
    <tr>
        <!-- Variabel ini sudah dihitung di bagian atas, jadi aman -->
        <td><?= $total_pelanggan ?></td>
        <td>Rp <?= number_format($total_pendapatan) ?></td>
    </tr>
</table>

</body>
</html>
