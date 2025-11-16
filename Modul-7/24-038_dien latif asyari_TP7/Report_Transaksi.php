<?php
// report_transaksi.php
// Me-require koneksi.php (already ada di project)
include 'koneksi.php';

// Ambil filter tanggal jika ada
$start = $_GET['start'] ?? date('Y-m-01');
$end   = $_GET['end'] ?? date('Y-m-d');

// Sanitasi input (sederhana)
$start_safe = $conn->real_escape_string($start);
$end_safe   = $conn->real_escape_string($end);

// Ambil data transaksi dalam rentang tanggal
$sql = "SELECT t.id, DATE(t.waktu_transaksi) AS tgl, t.waktu_transaksi, t.total, p.nama AS pelanggan
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE DATE(t.waktu_transaksi) BETWEEN '$start_safe' AND '$end_safe'
        ORDER BY t.waktu_transaksi ASC";
$result = $conn->query($sql);

$rows = [];
while($r = $result->fetch_assoc()){
    $rows[] = $r;
}

// Siapkan data rekap harian (total per tanggal)
$rekap = [];
foreach($rows as $r){
    $d = $r['tgl'];
    if(!isset($rekap[$d])){ $rekap[$d] = 0; }
    $rekap[$d] += (float)$r['total'];
}

// Hitung total pelanggan unik dan total pendapatan
$total_pendapatan = 0;
$unique_customers = [];
foreach($rows as $r){
    $total_pendapatan += (float)$r['total'];
    if($r['pelanggan']) $unique_customers[$r['pelanggan']] = true;
}
$total_pelanggan = count($unique_customers);

?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Laporan Penjualan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<style>
body{font-family:Arial,Helvetica,sans-serif;padding:20px;background:#f7f9fb;color:#0b1526}
.card{background:white;padding:18px;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,0.08);margin-bottom:16px}
.row{display:flex;gap:12px;align-items:center}
.controls input{padding:8px;border:1px solid #ddd;border-radius:6px}
.btn{padding:8px 12px;border-radius:6px;border:none;cursor:pointer}
.btn-primary{background:#0b79d0;color:white}
.table{width:100%;border-collapse:collapse;margin-top:12px}
.table th,.table td{padding:8px;border:1px solid #eee;text-align:left}
.summary{display:flex;gap:12px}
.summary .item{flex:1;background:#f1f6ff;padding:12px;border-radius:8px}

@media (max-width:700px){.row{flex-direction:column;align-items:stretch}}
</style>
</head>
<body>
<div class="card">
  <h2>Laporan Penjualan</h2>
  <form id="filterForm" method="get" class="row controls">
    <label>Start: <input type="date" name="start" value="<?php echo htmlspecialchars($start); ?>"></label>
    <label>End: <input type="date" name="end" value="<?php echo htmlspecialchars($end); ?>"></label>
    <button class="btn btn-primary" type="submit">Filter</button>
    <button class="btn" type="button" id="btnReset" onclick="location.href='report_transaksi.php'">Reset</button>
  </form>
</div>

<div class="card">
  <div class="summary">
    <div class="item">
      <strong>Total Pelanggan (unik)</strong>
      <div style="font-size:24px;margin-top:6px"><?php echo $total_pelanggan; ?></div>
    </div>
    <div class="item">
      <strong>Total Pendapatan</strong>
      <div style="font-size:24px;margin-top:6px">Rp <?php echo number_format($total_pendapatan,0,',','.'); ?></div>
    </div>
  </div>
</div>

<div class="card">
  <h3>Grafik Pendapatan per Hari</h3>
  <canvas id="chartBar" height="100"></canvas>
</div>

<div class="card" id="rekapArea">
  <h3>Rekap Tabel</h3>
  <table class="table" id="rekapTable">
    <thead>
      <tr><th>Tanggal</th><th>Total Pendapatan</th></tr>
    </thead>
    <tbody>
    <?php foreach($rekap as $d => $val): ?>
      <tr><td><?php echo $d; ?></td><td><?php echo number_format($val,0,',','.'); ?></td></tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="card">
  <h3>Daftar Transaksi</h3>
  <table class="table">
    <thead><tr><th>ID</th><th>Waktu</th><th>Pelanggan</th><th>Total</th></tr></thead>
    <tbody>
    <?php foreach($rows as $r): ?>
      <tr>
        <td><?php echo $r['id']; ?></td>
        <td><?php echo $r['waktu_transaksi']; ?></td>
        <td><?php echo $r['pelanggan'] ?? '-'; ?></td>
        <td>Rp <?php echo number_format($r['total'],0,',','.'); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div style="display:flex;gap:8px;margin-bottom:40px">
  <button class="btn" id="btnPrint">Cetak (PDF)</button>
  <button class="btn" id="btnExcel">Download Excel</button>
  <button class="btn" id="btnBrowserPrint">Print Halaman</button>
</div>

<!-- Libraries: Chart.js, html2pdf, SheetJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
// Data untuk chart
const rekap = <?php echo json_encode($rekap); ?>;
const labels = Object.keys(rekap);
const dataBar = Object.values(rekap).map(v => Number(v));

const ctx = document.getElementById('chartBar').getContext('2d');
const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      label: 'Pendapatan (Rp)',
      data: dataBar,
      backgroundColor: 'rgba(11,121,208,0.6)'
    }]
  },
  options: {scales:{y:{beginAtZero:true}}}
});

// PDF export (mengambil area laporan utama)
document.getElementById('btnPrint').addEventListener('click', function(){
  // Buat clone dari body yang hanya berisi bagian-bagian penting
  const element = document.createElement('div');
  const title = document.createElement('h2');
  title.textContent = 'Laporan Penjualan';
  element.appendChild(title);

  // Chart: convert canvas to image
  const canvasImg = document.createElement('img');
  canvasImg.src = document.getElementById('chartBar').toDataURL('image/png');
  canvasImg.style.maxWidth = '100%';
  element.appendChild(canvasImg);

  // Clone rekap table
  const rekapClone = document.getElementById('rekapArea').cloneNode(true);
  element.appendChild(rekapClone);

  // Summaries
  const summ = document.createElement('div');
  summ.innerHTML = '<p>Total Pelanggan: <?php echo $total_pelanggan; ?> <br> Total Pendapatan: Rp <?php echo number_format($total_pendapatan,0,',','.'); ?></p>';
  element.appendChild(summ);

  const opt = { margin:0.4, filename: 'laporan_penjualan.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale:2 }, jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' } };
  html2pdf().set(opt).from(element).save();
});

document.getElementById('btnExcel').addEventListener('click', function(){

  const table = document.getElementById('rekapTable');
  const wb = XLSX.utils.table_to_book(table,{sheet:'Laporan'});
  XLSX.writeFile(wb,'laporan_penjualan.xls');
});

document.getElementById('btnBrowserPrint').addEventListener('click', function(){ window.print(); });
</script>
</body>
</html>
