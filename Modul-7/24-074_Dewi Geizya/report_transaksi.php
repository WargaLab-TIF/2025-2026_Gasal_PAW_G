<?php
require __DIR__ . '/koneksi.php';

$tanggal_awal  = isset($_GET['awal']) ? trim($_GET['awal']) : '';
$tanggal_akhir = isset($_GET['akhir']) ? trim($_GET['akhir']) : '';
$has_filter = ($tanggal_awal !== '' && $tanggal_akhir !== '' && isset($_GET['go']));

$rekap = [];
$labels = [];
$totals = [];
$total_pendapatan = 0;
$jumlah_pelanggan = 0;

if ($has_filter) {
    $sql = "SELECT waktu_transaksi AS tanggal, SUM(total) AS total_harian
            FROM transaksi
            WHERE waktu_transaksi BETWEEN ? AND ?
            GROUP BY waktu_transaksi
            ORDER BY waktu_transaksi";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $tanggal_awal, $tanggal_akhir);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $rekap[] = $row;
        $labels[] = $row['tanggal'];
        $totals[] = (int)$row['total_harian'];
        $total_pendapatan += (int)$row['total_harian'];
    }
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);

    $sql2 = "SELECT COUNT(*) AS jml FROM transaksi WHERE waktu_transaksi BETWEEN ? AND ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, 'ss', $tanggal_awal, $tanggal_akhir);
    mysqli_stmt_execute($stmt2);
    $res2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($res2);
    $jumlah_pelanggan = (int)$row2['jml'];
    mysqli_free_result($res2);
    mysqli_stmt_close($stmt2);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="nav">
    <a href="transaksi.php">Penjualan XYZ</a>
    <a href="#" style="opacity:.7">Supplier</a>
    <a href="#" style="opacity:.7">Barang</a>
    <a href="transaksi.php" style="text-decoration:underline">Transaksi</a>
    <span style="margin-left:auto;opacity:.8">Laporan Penjualan</span>
</div>

<div class="wrap">
    <div class="header-bar">Rekap Laporan Penjualan <?php echo htmlspecialchars($tanggal_awal); ?> sampai <?php echo htmlspecialchars($tanggal_akhir); ?></div>
    <form method="get" style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
        <label>Awal</label>
        <input type="date" name="awal" value="<?php echo htmlspecialchars($tanggal_awal); ?>">
        <label>Akhir</label>
        <input type="date" name="akhir" value="<?php echo htmlspecialchars($tanggal_akhir); ?>">
        <button type="submit" name="go" value="1" class="btn btn-success">Tampilkan</button>
        <?php if ($has_filter): ?>
            <button type="button" class="btn btn-warning" onclick="downloadPDF()">Cetak</button>
            <a href="report_excel.php?awal=<?php echo urlencode($tanggal_awal); ?>&akhir=<?php echo urlencode($tanggal_akhir); ?>" class="btn btn-warning">Excel</a>
        <?php endif; ?>
        <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php if ($has_filter): ?>
        <div style="margin-top:10px"><canvas id="chart" height="140"></canvas></div>

        <h3 class="mt-2">Tabel Rekap</h3>
        <table id="rekapTable" class="table">
            <thead><tr><th>No</th><th>Total</th><th>Tanggal</th></tr></thead>
            <tbody>
            <?php if (empty($rekap)): ?>
                <tr><td colspan="3" style="text-align:center;color:#6b7280;">Tidak ada data pada rentang tanggal ini</td></tr>
            <?php else: ?>
                <?php $no=1; foreach ($rekap as $r): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td class="text-right">Rp<?php echo number_format((int)$r['total_harian'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($r['tanggal']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <h3 class="mt-2">Total</h3>
        <table id="totalTable" class="table">
            <tr><th>Jumlah Pelanggan</th><th colspan="2">Jumlah Pendapatan</th></tr>
            <tr><td><?php echo $jumlah_pelanggan; ?> Orang</td><td colspan="2">Rp<?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td></tr>
        </table>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf-autotable@3.5.28/dist/jspdf.plugin.autotable.min.js"></script>
<script>
var hasFilter = <?php echo $has_filter ? 'true':'false'; ?>;
if(hasFilter){
    const ctx = document.getElementById('chart').getContext('2d');
    const labels = <?php echo json_encode($labels); ?>;
    const data = <?php echo json_encode($totals); ?>;
    new Chart(ctx, {
        type: 'bar',
        data: { labels: labels, datasets: [{ label: 'Total Penjualan', data: data, backgroundColor: 'rgba(37,99,235,0.4)', borderColor: 'rgba(37,99,235,1)', borderWidth: 1 }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
}

function downloadPDF(){
    if(!hasFilter){ alert('Pilih tanggal dulu'); return; }
    if(!window.jspdf){ alert('PDF library gagal dimuat'); return; }
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p','pt','a4');
    const marginLeft = 40; let cursorY = 40;
    doc.setFont('helvetica','bold'); doc.setFontSize(14);
    doc.text('Rekap Laporan Penjualan <?php echo htmlspecialchars($tanggal_awal); ?> sampai <?php echo htmlspecialchars($tanggal_akhir); ?>', marginLeft, cursorY);
    cursorY += 20;
    try {
        const chartCanvas = document.getElementById('chart');
        const imgData = chartCanvas.toDataURL('image/png',1.0);
        const imgWidth = 500; const imgHeight = chartCanvas.height * (imgWidth / chartCanvas.width);
        doc.addImage(imgData, 'PNG', marginLeft, cursorY, imgWidth, imgHeight);
        cursorY += imgHeight + 20;
    } catch(e){}
    doc.setFontSize(12); doc.setFont('helvetica','bold'); doc.text('Tabel Rekap', marginLeft, cursorY); cursorY += 10;
    doc.autoTable({ html: '#rekapTable', startY: cursorY, styles:{ fontSize:9 }, headStyles:{ fillColor:[13,110,253] } });
    cursorY = doc.lastAutoTable.finalY + 20;
    doc.setFont('helvetica','bold'); doc.text('Total', marginLeft, cursorY); cursorY += 10;
    doc.autoTable({ html: '#totalTable', startY: cursorY, styles:{ fontSize:9 }, headStyles:{ fillColor:[13,110,253] } });
    doc.save('laporan_penjualan.pdf');
}
</script>
</body>
</html>
