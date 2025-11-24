<?php
include 'koneksi.php';

$result = $conn->query("
    SELECT t.id, t.tanggal, t.nama_pelanggan, t.keterangan, t.total
    FROM transaksi1 t
    ORDER BY t.tanggal DESC, t.id ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafik Penjualan Bunga</title>
  <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>


</head>
<body>
  
  <h2>Grafik Penjualan Bunga per Bulan</h2>
  <canvas id="myChart" width="400" height="200"></canvas>
  <button onclick="window.print()">Cetak Laporan</button>
  <script src="script.js"></script>
  <h1>stok barang</h1>
  <?php
  
  ?>
</body>
</html>
