<?php
require 'db.php';

/* Ambil filter tanggal */
$tgl1 = $_GET['tgl1'] ?? '';
$tgl2 = $_GET['tgl2'] ?? '';
$show = ($tgl1 && $tgl2);

/* Cek apakah transaksi memiliki kolom pelanggan_id */
$hasPelanggan = $db->query("SHOW COLUMNS FROM transaksi LIKE 'pelanggan_id'")
                   ->fetch();

/* Siapkan variabel */
$data = [];
$labels = $values = [];
$totalPendapatan = 0;
$totalPelangganUnik = 0;

/* Ambil data ketika filter aktif */
if ($show) {
    $query = "
        SELECT DATE(tanggal) AS tgl,
               COUNT(*) AS jml,
               " . ($hasPelanggan ? "COUNT(DISTINCT pelanggan_id) AS unik," : "") . "
               SUM(total_harga) AS total
        FROM transaksi
        WHERE DATE(tanggal) BETWEEN ? AND ?
        GROUP BY DATE(tanggal)
        ORDER BY DATE(tanggal)
    ";

    $st = $db->prepare($query);
    $st->execute([$tgl1, $tgl2]);
    $data = $st->fetchAll();

    foreach ($data as $r) {
        $labels[] = $r['tgl'];
        $values[] = (int)$r['total'];
        $totalPendapatan += (int)$r['total'];
    }

    /* Hitung pelanggan unik keseluruhan */
    if ($hasPelanggan) {
        $q = $db->prepare("
            SELECT COUNT(DISTINCT pelanggan_id)
            FROM transaksi
            WHERE DATE(tanggal) BETWEEN ? AND ?
        ");
        $q->execute([$tgl1, $tgl2]);
        $totalPelangganUnik = $q->fetchColumn();
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Penjualan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>

  <style>.header-blue{background:#0d6efd;color:#fff;padding:10px;border-radius:6px}</style>
</head>

<body class="bg-light">
<div class="container py-4">

  <div class="header-blue"><h5>Laporan Penjualan</h5></div>

  <!-- FORM FILTER -->
  <?php if (!$show): ?>
    <div class="card mt-3"><div class="card-body">
      <a href="data_transaksi.php" class="btn btn-secondary btn-sm">&laquo; Kembali</a>

      <form method="GET" class="row g-2 mt-3">
        <div class="col-md-3"><label>Dari</label><input type="date" name="tgl1" class="form-control"></div>
        <div class="col-md-3"><label>Sampai</label><input type="date" name="tgl2" class="form-control"></div>
        <div class="col-md-2"><label>&nbsp;</label><button class="btn btn-success w-100">Tampilkan</button></div>
        <div class="col-md-2"><label>&nbsp;</label><a href="report_transaksi.php" class="btn btn-secondary w-100">Reset</a></div>
      </form>
    </div></div>

  <?php else: ?>

    <!-- Tombol kembali + export -->
    <div class="mt-2">
      <a href="data_transaksi.php" class="btn btn-secondary btn-sm">&laquo; Kembali</a><br>
      <a href="export_excel.php?tgl1=<?= $tgl1 ?>&tgl2=<?= $tgl2 ?>" class="btn btn-warning btn-sm">Excel</a>
      <button id="btnCetak" class="btn btn-primary btn-sm">Cetak PDF</button>
    </div>

    <!-- Grafik -->
    <div class="card mt-4"><div class="card-body">
      <h6>Grafik Pendapatan</h6>
      <canvas id="salesChart" style="max-height:300px"></canvas>
    </div></div>

    <!-- Tabel Rekap -->
    <div class="card my-3"><div class="card-body">
      <h6>Rekap Penjualan</h6>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Jumlah Transaksi</th>
            <?php if ($hasPelanggan): ?><th>Pelanggan</th><?php endif; ?>
            <th>Pendapatan</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!$data): ?>
            <tr><td colspan="4" class="text-center">Tidak ada data.</td></tr>
          <?php else: ?>
            <?php foreach ($data as $r): ?>
              <tr>
                <td><?= $r['tgl'] ?></td>
                <td><?= $r['jml'] ?></td>
                <?php if ($hasPelanggan): ?><td><?= $r['unik'] ?></td><?php endif; ?>
                <td><?= number_format($r['total']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Total -->
      <h6>Total</h6>
      <table class="table table-sm table-bordered" style="max-width:400px">
        <tr><th>Pelanggan Unik</th><th>Pendapatan</th></tr>
        <tr>
          <td><?= $hasPelanggan ? number_format($totalPelangganUnik) : '-' ?></td>
          <td><?= number_format($totalPendapatan) ?></td>
        </tr>
      </table>

    </div></div>

  <?php endif; ?>

</div>

<?php if ($show): ?>
<script>
// Grafik
new Chart(document.getElementById('salesChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{ data: <?= json_encode($values) ?> }]
    },
    options: { scales:{ y:{ beginAtZero:true }}, plugins:{ legend:{ display:false }} }
});

// Cetak PDF
document.getElementById('btnCetak').onclick = async () => {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p','pt','a4');

    const canvas = await html2canvas(document.body, { scale:2 });
    const img = canvas.toDataURL('image/png');

    pdf.addImage(img,'PNG',0,0,pdf.internal.pageSize.getWidth(),
        canvas.height*(pdf.internal.pageSize.getWidth()/canvas.width)
    );
    pdf.save('laporan_penjualan.pdf');
};
</script>
<?php endif; ?>

</body>
</html>
