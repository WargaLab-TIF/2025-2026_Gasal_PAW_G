<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../proses/login.php");
    exit;
}

$awal  = isset($_GET['start']) ? $_GET['start'] : '';
$akhir = isset($_GET['end']) ? $_GET['end'] : '';

if (!empty($awal) && !empty($akhir)) {
    $sql = "
        SELECT DATE(waktu_transaksi) AS tanggal,
               SUM(total) AS total,
               COUNT(id) AS jml_pelanggan
        FROM transaksi
        WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
        GROUP BY DATE(waktu_transaksi)
        ORDER BY DATE(waktu_transaksi)
    ";
} else {
    $sql = "
        SELECT DATE(waktu_transaksi) AS tanggal,
               SUM(total) AS total,
               COUNT(id) AS jml_pelanggan
        FROM transaksi
        GROUP BY DATE(waktu_transaksi)
        ORDER BY DATE(waktu_transaksi)
    ";
}

$stok=" SELECT COUNT(id) AS jml FROM barang";

$result = $koneksi->query($sql);

$data = [];
$totalPendapatan = 0;
$totalPelanggan = 0;



while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $totalPelanggan += $row['jml_pelanggan'];
    $totalPendapatan += $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rekap Laporan Penjualan</title>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .al {
        width: 1200px;
        margin: auto;
        font-family: Arial, sans-serif;
        border: 1px solid black;
    }
    .laporan {
        background-color: #546cd7ff;
        padding: 10px;
        border-bottom: 1px solid black;
    }
    canvas {
        margin-right: 400px;
        margin-left: 20px;
    }
    .back {
        margin-top: 10px;
        margin-left: 20px;
        width: 100px;
        padding: 10px;
        background-color: blue;
        text-align: center;
        border-radius: 8px;

    }
    .tgl {
        margin-left: 20px;

    }
    .tb {
        margin-bottom: 20px;
        width: 500px;
    }
    .hd {
        background-color: #6cc5e2ff;
    }
    a {
        text-decoration: none;
        color: white;
    }
    .cetak, .export {
        display: inline-block;
        padding: 10px;
        background-color: green;
        color: white;
        text-align: center;
        border-radius: 8px;
        width: 100px;
    }
    .NTT{
        background-color: #6cc5e2ff;
    }
  </style>
</head>
<body>
<?php include "../navbar.php"; ?><br>
<div class="al">
<div class="laporan">
<h3>Rekap Laporan Penjualan <?= $awal ?> sampai <?= $akhir ?></h3>
</div><br>

<a href="../index.php"><div class="back"> < Kembali</div></a><br>

<div class="tgl">
<form method="GET" id="formFilter">
    <input type="date" name="start" value="<?= $awal ?>">
    <input type="date" name="end" value="<?= $akhir ?>">
    <button type="submit" name="tampilkan">Tampilkan</button>
</form>
</div>
<br>

<?php if (isset($_GET['tampilkan'])) {

    if (empty($awal) || empty($akhir)) {
        echo "<p style='color:red; margin-left:20px;'>Tanggal mulai dan tanggal akhir wajib diisi!</p>";
        return; 
    }?>

<div class class=CE>
<a href="report_pdf.php?start=<?= $awal ?>&end=<?= $akhir ?>" style="margin-left: 20px; margin-right: 20px;"><div class="cetak">Cetak</div></a>
<a href="report_excel.php?start=<?= $awal ?>&end=<?= $akhir ?>" style="margin-left: 20px; margin-right: 20px;"><div class="export">Excel</div></a>
</div>

<canvas id="myChart" width="400px" height="200px"></canvas>

<script>

  const labels = <?= json_encode(array_column($data, 'tanggal'))?>;
  const values = <?= json_encode(array_column($data, 'total')) ?>;

  const data = {
    labels: labels,
    datasets: [{
      label: "Total Pendapatan",
      data: values,
      backgroundColor: [
        "rgba(53, 61, 61, 0.21)"
      ],
      borderColor: [
        "rgba(35, 36, 36, 1)"
      ],
      borderWidth: 1
    }]
  };

  const options = {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  const ctx = document.getElementById('myChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
  });


</script>

<br>

<table border="1" cellpadding="20" cellspacing="0" style="margin-left: 20px; margin-right: 20px;">
    <tr class="NTT">
        <th style="width:200px; text-align:left;">No</th>
        <th style="width:500px; text-align:left;">Total</th>
        <th style="width:500px; text-align:left;">Tanggal</th>
    </tr>

    <?php $no = 1; foreach ($data as $d) { ?>
    <tr>
        <td style="text-align:left;"><?= $no++ ?></td>
        <td style="text-align:left;">Rp<?= number_format($d['total']) ?></td>
        <td style="text-align:left;"><?= date('d M Y', strtotime($d['tanggal'])) ?></td>
    </tr>
    <?php } ?>
</table>

<br>

<table border="1" cellpadding="10" cellspacing="0" style="margin-left: 20px; margin-right: 20px;" class="tb">
    <tr class="hd">
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $totalPelanggan ?> Orang</td>
        <td>Rp<?= number_format($totalPendapatan) ?></td>
    </tr>
</table>



<?php } ?>
</div>
</body>
</html>
